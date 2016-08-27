<?php
	// hide notices
	@ini_set('error_reporting', E_ALL & ~ E_NOTICE);
	 
	//- turn off compression on the server
	@apache_setenv('no-gzip', 1);
	@ini_set('zlib.output_compression', 'Off');
	
	session_start();
	require_once "config.php";
	
	if ($_GET['q']=='random') {
		$result = mysqli_query($con,"SELECT * FROM games ORDER BY RAND() LIMIT 1");
		$game_id = mysqli_fetch_assoc($result)['id'];
		$game_id2 = 2000000+$game_id;
	} elseif ($_GET['q']=='latest') {
		$result = mysqli_query($con,"SELECT * FROM games ORDER BY id DESC LIMIT 1");
		$game_id = mysqli_fetch_assoc($result)['id'];
		$game_id2 = 2000000+$game_id;
	} else {
		$game_id = mysqli_escape_string($con,explode('/',$_GET['q'])[0]);
		$game_id2 = mysqli_escape_string($con,2000000+explode('/',$_GET['q'])[0]);
	}
	
	$result = mysqli_query($con,"SELECT * FROM games WHERE id = '$game_id' AND state >= 1");
	if (mysqli_num_rows($result)>=1) {
		$game_info = mysqli_fetch_array($result);
		$game_info['tags'] = explode(',',$game_info['tags']);
		for($i=0;$i<sizeof($game_info['tags']);$i+=1) {
			$game_info['tags'][$i] = preg_replace('/^\s*(.*)\s*$/','$1',$game_info['tags'][$i]);
		}
		
		$result = mysqli_query($con,"SELECT * FROM uploaded_files WHERE type = 2 AND place = '$game_id'");
		while($row = mysqli_fetch_array($result)) {
			$game_info['screenshots'][] = $row;
		}
		
		$game_author_id = mysqli_escape_string($con,$game_info['author']);
		$result = mysqli_query($con,"SELECT * FROM users WHERE id = '$game_author_id'");
		if (mysqli_num_rows($result)>=1) {
			$game_author = mysqli_fetch_assoc($result);
			if ($game_author['picture']=='') {
				$game_author['picture'] = $no_picture;
			}
		} elseif ($game_info['domain']!='yoyogames') {
			header("HTTP/1.1 404 Not Found");
			include("error-404.php");
			exit;
		}
	} else {
		header("HTTP/1.1 404 Not Found");
		include("error-404.php");
		exit;
	}
	
	if (!empty($_GET['fileid'])) {
		$file_id = $_GET['fileid'];
	} else {
		$file_id = -1;
		$_GET['alt'] = 1;
		$_GET['notalt'] = 1;
	}
	if (intval($file_id)>=0) {
		$extra_sql = " (id = $file_id OR id = $file_id + 3000000) AND";
		$extra_sql2 = " (id = $file_id OR id = $file_id + 3000000) AND";
		$type_sql = ' OR type = 5';
	} else {
		$version = mysqli_escape_string($con,$game_info['version']);
		$stage = mysqli_escape_string($con,$game_info['stage']);
		$extra_sql = " version = '$version' AND stage = '$stage' AND";
		$extra_sql2 = " table4.version = '$version' AND table4.stage = '$stage' AND";
		$type_sql = '';
	}
	$extra_sql_left = " ".$_GET['alt']." AND";
	$extra_sql_right = " ".$_GET['notalt']." AND";
	report_error($con,"SELECT id, type, place, filename, stage, version, posted, alt, content, downloads, mime
	FROM
	((SELECT id, type, place, filename, stage, version, posted, 1 AS alt, '' AS content, downloads, 'application/octet-stream' AS mime FROM uploaded_files WHERE$extra_sql{$extra_sql_left} (type = 1$type_sql) AND place = $game_id) UNION
	(SELECT id, type, parent_id, name, stage, version, mtime, alt, content, downloads, mime FROM (SELECT id, 1 AS type, parent_id, name, IF(INSTR(LOWER(name),'beta'),2,IF(INSTR(LOWER(name),'WIP'),3,1)) AS stage, IF(name REGEXP '^.*?\\\\.?([0-9\\\\.]+)(?:\\\\..*)?$',REGEXP_REPLACE(name,'^.*?\\\\.?([0-9\\\\.]+[a|b|c|d|e|f]?)(?:\\\\..*)?$','\\\\1'),'1.0.0') AS version, FROM_UNIXTIME(mtime) as mtime, 0 AS alt, content, downloads, mime FROM elfinder_file) table4 WHERE$extra_sql2{$extra_sql_right} 1)) table3 ORDER BY version DESC");
	$result = mysqli_query($con,"SELECT id, type, place, filename, stage, version, posted, alt, content, downloads, mime
	FROM
	((SELECT id, type, place, filename, stage, version, posted, 1 AS alt, '' AS content, downloads, 'application/octet-stream' AS mime FROM uploaded_files WHERE$extra_sql{$extra_sql_left} (type = 1$type_sql) AND place = $game_id) UNION
	(SELECT id, type, parent_id, name, stage, version, mtime, alt, content, downloads, mime FROM (SELECT id, 1 AS type, parent_id, name, IF(INSTR(LOWER(name),'beta'),2,IF(INSTR(LOWER(name),'WIP'),3,1)) AS stage, IF(name REGEXP '^.*?\\\\.?([0-9\\\\.]+)(?:\\\\..*)?$',REGEXP_REPLACE(name,'^.*?\\\\.?([0-9\\\\.]+[a|b|c|d|e|f]?)(?:\\\\..*)?$','\\\\1'),'1.0.0') AS version, FROM_UNIXTIME(mtime) as mtime, 0 AS alt, content, downloads, mime FROM elfinder_file) table4 WHERE$extra_sql2{$extra_sql_right} 1)) table3 ORDER BY version DESC"); // parent_id = $game_id2
	//echo mysqli_num_rows($result);
	
	if (!$result) {
		report_error($con,'game-download.php-04');
	}
	
	$ip = mysqli_escape_string($con,$_SESSION['ip']);
	$author = (!empty($_SESSION['user_id'])) ? $_SESSION['user_id'] : 0;
	$bot = in_array($ip,$_SESSION['bots']);
	
	if (mysqli_num_rows($result)>=1) {
		while($row = mysqli_fetch_assoc($result)) {
			//unset($row['content']);
			//print_r($row);
			$file_id = $row['id'];
			report_error($con,strval($row['id']));
			$place_id = $row['place'];
			$type = $row['type'];
			$filename = $row['filename'];
			$fname = basename($filename);
			
			$last_modified = filemtime(dirname(__FILE__) . $filename);
			$last_modified = date('d ',$last_modified) . substr(date('F',$last_modified),0,3) . date(' Y H:i:s',$last_modified) . ' +0000';
			$date_created = filectime(dirname(__FILE__) . $filename);
			$date_created = date('d ',$date_created) . substr(date('F',$date_created),0,3) . date(' Y H:i:s',$date_created) . ' +0000';
			$filesize = filesize(dirname(__FILE__) . $filename);
			
			if (!file_exists(dirname(__FILE__) . $row['filename'])) {
				$last_modified = $row['posted'];
				$date_created = $row['posted'];
				$filesize = strlen($row['content']);
			}
			
			$content_type = 'application/octet-stream';
			/*$ext = strtolower(array_pop(explode('.',$fname)));
			if ($ext=='exe') {
					
			}*/
			
			header("Pragma: public");
			header("Expires: -1");
			header("Cache-Control: public, must-revalidate, post-check=0, pre-check=0");
			header("Content-Type: $content_type");
			header("Content-Disposition: attachment; filename=\"$fname\"; modification-date=\"$last_modified\"; creation-date=\"$date_created\"");
			header("Content-Length: $filesize");
			
			if (file_exists(dirname(__FILE__) . $row['filename'])) {
				//readfile(dirname(__FILE__) . $filename);
				$file_size = filesize(dirname(__FILE__) . $filename);
				
				if (isset($_SERVER['HTTP_RANGE'])) {
					list($size_unit, $range_orig) = explode('=', $_SERVER['HTTP_RANGE'], 2);
					if ($size_unit == 'bytes') {
						//multiple ranges could be specified at the same time, but for simplicity only serve the first range
						//http://tools.ietf.org/id/draft-ietf-http-range-retrieval-00.txt
						list($range, $extra_ranges) = explode(',', $range_orig, 2);
					} else {
						$range = '';
						header('HTTP/1.1 416 Requested Range Not Satisfiable');
						exit;
					}
				} else {
					$range = '';
				}
				
				list($seek_start, $seek_end) = explode('-', $range, 2);
				$seek_end   = (empty($seek_end)) ? ($file_size - 1) : min(abs(intval($seek_end)),($file_size - 1));
				$seek_start = (empty($seek_start) || $seek_end < abs(intval($seek_start))) ? 0 : max(abs(intval($seek_start)),0);
				
				if ($seek_start > 0 || $seek_end < ($file_size - 1)) {
					header('HTTP/1.1 206 Partial Content');
					header('Content-Range: bytes '.$seek_start.'-'.$seek_end.'/'.$file_size);
					header('Content-Length: '.($seek_end - $seek_start + 1));
				} else {
					header("Content-Length: $file_size");
				}
		 
				header('Accept-Ranges: bytes');
				
				set_time_limit(0);
				
				$file = @fopen(dirname(__FILE__).$filename,"rb");
				if ($file) {
					fseek($file, $seek_start);
				}
				while(!feof($file)) {
					print(@fread($file,1024*8));
					ob_flush();
					flush();
					if (connection_status()!=0) {
						if (ftell($file)>=$file_size-1) {
							$result = mysqli_query($con,"UPDATE uploaded_files SET downloads = downloads + 1 WHERE id = $file_id");
							if (!$result) {
								report_error($con,'game-download.php-01');
							}
						}
						@fclose($file);
						exit;
					}
				}
				if (feof($file)) {
					$result = mysqli_query($con,"UPDATE uploaded_files SET downloads = downloads + 1 WHERE id = $file_id");
					if (!$result) {
						report_error($con,'game-download.php-01');
					}
				}
			} else {
				echo $row['content'];
				$result = mysqli_query($con,"UPDATE elfinder_file SET downloads = downloads + 1 WHERE id = $file_id OR id = $file_id + 3000000");
				if (!$result) {
					report_error($con,'game-download.php-01b');
				}
			}
			
			if (!$bot&&$type==1) {
				$result = mysqli_query($con,"UPDATE games SET plays = plays + 1 WHERE id = $place_id");
				if (!$result) {
					report_error($con,'game-download.php-02');
				}
			}
			$result = mysqli_query($con,"INSERT INTO downloads (type,place,author,ip) VALUES (1,$file_id,$author,'$ip')");
			if (!$result) {
				report_error($con,'game-download.php-03');
			}
			break;
		}
	} else {
		if (!empty($game_info['game'])) {
			if (!$bot) {
				$result = mysqli_query($con,"UPDATE games SET plays = plays + 1 WHERE id = $game_id");
				if (!$result) {
					report_error($con,'game-download.php-02');
				}
			}
			$result = mysqli_query($con,"INSERT INTO downloads (type,place,author,ip) VALUES (2,{$game_info['id']},$author,'$ip')");
			if (!$result) {
				report_error($con,'game-download.php-03');
			}
			header("Location: ".$game_info['game'], true, 302);
		} else {
			header("HTTP/1.1 404 Not Found");
			include("error-404.php");
			exit;
		}
	}
?>
