<!DOCTYPE html>
<html>
	<head>
		<script>
			/*setTimeout(function(){
			   window.location.reload(1);
			}, 300000);*/
		</script>
	</head>
	<body>
<?php
	echo file_get_contents('http://gamemaker.mooo.com/update-notifications');
?>
		<h1>IndieMendable Virus Scanner</h1>
		<pre>
<?php
	include('config.php');
	require_once('vendor/autoload.php');
	$apiKey = '4b53495900004807386de6f5dca477457830e31ff3c70a3ccac0b4e2f95e57cb';
	
	$result = mysqli_query($con,"SELECT * FROM games WHERE state = 1 ORDER BY id DESC");
	if (!$result) {
		echo "ERROR: ".mysqli_error($con);
		exit;
	}
	//echo mysqli_num__rows($result);
	if (mysqli_num_rows($result)==0) {
		echo 'DONE';
		exit;
	}
	while($row = mysqli_fetch_assoc($result)) {
		$game_id = mysqli_escape_string($con,$row['id']);
		$_result = mysqli_query($con,"SELECT * FROM games WHERE id = '$game_id'");
		if (mysqli_num_rows($_result) >= 1) {
			$game_info = mysqli_fetch_array($_result);
			//$game_info['tags'] = explode(',',$game_info['tags']);
			
			$game_author_id = mysqli_escape_string($con,$game_info['author']);
			$_result = mysqli_query($con,"SELECT * FROM users WHERE id = '$game_author_id'");
			if (mysqli_num_rows($_result) >= 1) {
				$game_author = mysqli_fetch_assoc($_result);
			} else {
				header("HTTP/1.1 404 Not Found");
				include("error-404.php");
				exit;
			}
		} else {
			header("HTTP/1.1 404 Not Found");
			include("error-404.php");
			exit;
		}
		
		$version = mysqli_escape_string($con,$game_info['version']);
		$stage = mysqli_escape_string($con,$game_info['stage']);
		$_result = mysqli_query($con,"SELECT * FROM uploaded_files WHERE version = '$version' AND stage = $stage AND type = 1 AND place = $game_id");

echo "SELECT * FROM uploaded_files WHERE version = '$version' AND stage = $stage AND type = 1 AND place = $game_id";
		if (mysqli_num_rows($_result)>=1) {
			$_row = mysqli_fetch_assoc($_result);
			$file_id = $_row['id'];
			$type = $_row['type'];
			echo "\r\n----------------------------------------------------------------------------------------------------------------------------";
			$filename = $_row['filename'];
			echo "\r\n</pre><b>";
			echo $filename;
			echo ":</b>\r\n<pre>";
			$fname = basename($filename);
			$last_modified = filemtime(dirname(__FILE__) . $filename);
			$last_modified = date('d ',$last_modified) . substr(date('F',$last_modified),0,3) . date(' Y H:i:s',$last_modified) . ' +0000';
			$date_created = filectime(dirname(__FILE__) . $filename);
			$date_created = date('d ',$date_created) . substr(date('F',$date_created),0,3) . date(' Y H:i:s',$date_created) . ' +0000';
			$filesize = filesize(dirname(__FILE__) . $filename);
			
			$file = new VirusTotal\File($apiKey);
			$resourceObj = $file->scan($_SERVER['DOCUMENT_ROOT'].$filename);
			
			var_dump($resourceObj);
			echo '------------------------------------------------------------------------------------------------------------------------------------------------';
			echo "\r\n</pre><b>Result:</b>\r\n<pre>";
			sleep(120);
			$report = $file->getReport($resourceObj['resource']);
			var_dump($report);
			
			$name_sql = mysqli_escape_string($con,$row['name']);
			$added_sql = mysqli_escape_string($con,date('d F Y',strtotime($row['added'])));
			
			if ($report->positives==0) {
				$_result = mysqli_query($con,"UPDATE games SET state = 2 WHERE id = '$game_id'");
				echo "\r\n\r\nSuccessfully marked as playable.";
				
				$subject = mysqli_escape_string($con,"Virus scan result for ".$row['name']);
				$sent_to = mysqli_escape_string($con,$_row['author']);
				$_result = mysqli_query($con,"INSERT INTO `gamemaker`.`messages` (`ip`, `sent_from`, `sent_to`, `subject`, `body`) VALUES ('127.0.0.1', '38', '$sent_to', '$subject', 'Dear user,\r\n\r\nI''m writing to inform you that your game, $name_sql, which you submitted on $added_sql is free of viruses and has been made publically available.\r\n\r\n[i]This is an automatically generated virus scanner notification.[/i]')");
			} else {
				$_result = mysqli_query($con,"UPDATE games SET state = -2 WHERE id = '$game_id'");
				echo "\r\n\r\Marked as virus detection.";
				
				$subject = mysqli_escape_string($con,"Virus scan result for ".$row['name']." (virus detected)");
				$sent_to = mysqli_escape_string($con,$_row['author']);
				$_result = mysqli_query($con,"INSERT INTO `gamemaker`.`messages` (`ip`, `sent_from`, `sent_to`, `subject`, `body`) VALUES ('127.0.0.1', '38', '$sent_to', '$subject', 'Dear user,\r\n\r\nI'm writing to inform you that your game, $name_sql, which you submitted on $added_sql has been detected as a virus and therefore has [i]not[/i] been made publically available.\r\n\r\n[i]This is an automatically generated virus scanner notification.[/i]')");
			}
		}
	}
?>
		</pre>
	</body>
</html>
