<?php
    @ini_set('zlib.output_compression',0);
    @ini_set('implicit_flush',1);
    @ob_end_clean();
    set_time_limit(0);
	ob_start();
	
	$page_title = 'Search';
	if (!empty($_GET['q'])) {
		$page_title = "{$_GET['q']} - Searching for games";
	} else {
		header("Location: http://gamemaker.mooo.com/browse", true, 302);
	}
	include("default-top.php");
	
	if ($_SERVER['REQUEST_METHOD']=='HEAD') {
		exit;
	}
	
	$current_page = $_SERVER['REQUEST_URI'];
	if (strpos($current_page,'?')>=0) {
		$current_page_query = $current_page . '&';
	} else {
		$current_page_query = $current_page . '?';
	}
	
	$categories = array('all','adventure','arcade','platform','puzzle','shooter','strategy','utility','other');
	
	if (empty($_GET['category'])) {
		$_GET['category'] = 'all';
	} else {
		$_GET['category'] = strtolower($_GET['category']);
		if (!in_array($_GET['category'],$categories)) {
			$_GET['category'] = 'all';
		}
	}
	
	$stages = array('complete','work in progress','beta');
	$stage_assoc = array('complete' => 1,'work in progress' => 2,'beta' => 3);
	
	if (empty($_GET['stage'])) {
		$_GET['stage'] = 'complete';
	} else {
		$_GET['stage'] = strtolower($_GET['stage']);
		if (!in_array($_GET['stage'],$stages)) {
			$_GET['stage'] = 'complete';
		}
	}
	
	$sorted_by = array('featured','popular','rating','relevance');
	
	if (empty($_GET['sorted-by'])) {
		$_GET['sorted-by'] = 'relevance';
	} else {
		$_GET['sorted-by'] = strtolower($_GET['sorted-by']);
		if (!in_array($_GET['sorted-by'],$sorted_by)) {
			$_GET['sorted-by'] = 'relevance';
		}
	}
	
	$yyg = !empty($_GET['yyg']);
	
	$query = $_GET['q'];
	
	function query_add($query_list,$query,$value) {
		$query_list[$query] = $value;
		return parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH) . '?' . http_build_query($query_list);
	}
	
	if (stristr($_SERVER['HTTP_USER_AGENT'],'Googlebot')) {
		exit;
	}
?>
				<div class="container dark dark2" style="width: 200px; margin-right: 15px;">
					<div class="container-title"><?php echo gettext('Categories'); ?></div>
					<div id="category-chooser" class="smallfont2">
<?php foreach($categories as $category) { ?>
						<a <?php if ($_GET['category']==$category) { echo 'class="selected" '; } ?>href="<?php if ($_GET['category']!=$category) { echo query_add($_GET,'category',$category); } ?>"><?php echo ucfirst($category); ?></a>
<?php } ?>
					</div>
				</div>
				<div class="container dark dark2 clear-left" style="width: 200px; margin-right: 15px;">
					<div class="container-title"><?php echo gettext('Stages'); ?></div>
					<div id="category-chooser" class="smallfont2">
<?php foreach($stages as $category) { ?>
						<a <?php if ($_GET['stage']==$category) { echo 'class="selected" '; } ?>href="<?php if ($_GET['stage']!=$category) { echo query_add($_GET,'stage',$category); } ?>"><?php echo ucfirst($category); ?></a>
<?php } ?>
					</div>
				</div>
				<div class="container dark dark2 clear-left" style="width: 200px; margin-right: 15px; min-height: 0;">
					<div class="container-title"><?php echo gettext('Website'); ?></div>
					<div id="category-chooser" class="smallfont2">
						<a <?php if ($yyg) { echo 'class="selected" '; } ?>href="<?php echo query_add($_GET,'yyg','yes'); ?>"><?php echo gettext('YoYo Games Sandbox'); ?></a>
						<a <?php if (!$yyg) { echo 'class="selected" '; } ?>href="<?php echo query_add($_GET,'yyg',''); ?>"><?php echo gettext('IndieMendable'); ?></a>
					</div>
				</div>
				<div id="sorted-by-chooser"><a <?php
	if ($_GET['sorted-by']=='relevance') { echo 'class="active" '; } ?> href="<?php
	echo query_add($_GET,'sorted-by','relevance') ?>"><?php echo gettext('Most Relevant'); ?></a> <a <?php
	if ($_GET['sorted-by']=='popular') { echo 'class="active" '; } ?> href="<?php
	echo query_add($_GET,'sorted-by','popular') ?>"><?php echo gettext('Popular Today'); ?></a> <a <?php
	if ($_GET['sorted-by']=='rating') { echo 'class="active" '; } ?> href="<?php
	echo query_add($_GET,'sorted-by','rating') ?>"><?php echo gettext('Highest Rating'); ?></a></div>
				<div class="container-lt float-right" style="overflow: auto; float: none; border-top-right-radius: 0;">
					<div class="container-title-lt">Searching for "<?php echo $_GET['q']; ?>"</div>
<?php
	if (!$yyg&&(!empty($_SESSION['betabeta'])||$version_info['gamemaker_sandbox']>=3)) {
		$category_sql = mysqli_escape_string($con,$_GET['category']);
		if ($category_sql=='all') {
			$extra_sql = '';
		} else {
			$extra_sql = " AND category = '$category_sql'";
		}
		
		$stage_sql = $stage_assoc[$_GET['stage']];
		$extra_sql .= " AND stage = $stage_sql";
		
		$sorted_by_sql = 'id DESC';
		if ($_GET['sorted-by']=='rating') {
			$sorted_by_sql = 'rating DESC';
		}
		
		/*$search_sql = str_replace(' ','|',preg_quote($query));
		$search_sql = " AND CONCAT(name,' ',description,' ',tags) REGEXP '([^a-zA-Z0-9_]|^)(" . $search_sql . ")([^a-zA-Z0-9_]|$)'";
		$extra_sql .= $search_sql;*/
		
		$search_sql = '';
		$query_split = explode(' ',preg_quote($query));
		while($query_split[sizeof($query_split)-1]==='') {
			array_pop($query_split);
		}
		//print_r($query_split);
		for($j=min(3,sizeof($query_split)-1);$j>=0;$j-=1) {
			if (!empty($search_sql)) {
				$search_sql .= "\r\nUNION\r\n";
			}
			
			$_search_sql = '';
			for($i=0;$i<sizeof($query_split)-$j;$i+=1) {
				if (!empty($_search_sql)) {
					$_search_sql .= '|';
				}
				for($k=0;$k<=$j;$k+=1) {
					if ($k!=0) {
						$_search_sql .= ' ';
					}
					$_search_sql .= $query_split[$i+$k];
				}
			}
			$search_sql .= "(SELECT * FROM games WHERE CONCAT(name,' ',description,' ',tags) REGEXP '([^a-zA-Z0-9_]|^)(" . $_search_sql . ")([^a-zA-Z0-9_]|$)' AND stage != 0$extra_sql LIMIT 50)";
		}
		//$search_sql = "CONCAT(name) REGEXP '([^a-zA-Z0-9_]|^)(" . $_search_sql . ")([^a-zA-Z0-9_]|$)'";
		$query = $search_sql." ORDER BY $sorted_by_sql"; //"SELECT * FROM yyg_games_list WHERE $search_sql";
		
		
		//$query = "SELECT * FROM games WHERE stage != 0$extra_sql ORDER BY $sorted_by_sql";
		//echo '<pre>'.$query.'</pre>';
		//echo $query;
		$result = mysqli_query($con,$query);
?>
					<div class="games-alt items" style="max-height: 505px; overflow: auto;" data-columns="3" data-per-page="12">
<?php
		while($row = mysqli_fetch_assoc($result)) {
			$game_author_id = mysqli_escape_string($con,$row['author']);
			$game_author = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM users WHERE id = $game_author_id"));
			//for($i=0;$i<32;$i+=1) {
			if ($row['picture']=='') {
				$row['picture'] = $no_picture;
			}
			if (!empty($row['author_str'])) {
				$game_author['username'] = $row['author_str'];
			}
/*?><div class="game-alt item"><a href="/games/<?php echo $row['id'] ?>"><div class="picture-large" style="background-image: url('<?php echo htmlspecialchars(str_replace('/original/','/extra-small/',$row['picture'])); ?>');"></div>
						<div><?php echo $row['name'] ?></div></a><span style="font-size: .7em;"><?php echo gettext('By'); ?> <a href="/users/<?php echo $game_author['username']; ?>"><?php echo $game_author['username']; ?></a></span><br>
						<ul class="star-rating"><li class="current-rating" style="width: <?php echo $row['rating']*60/5; ?>px; padding: 0;"><?php echo gettext('Rating:'); ?> <?php echo $row['rating']; ?>/5.</li></ul></div><?php*/
?><div class="game-alt item">
					<a target="_blank" href="<?php echo $language_url; ?>/games/<?php echo $row['id'].'-'.slugify($row['name']); ?>">
						<div class="picture-large" style="background-image: url('<?php echo htmlspecialchars(str_replace('/original/','/extra-small/',$row['picture'])); ?>');"></div>
						<div class="name-box">
							<div class="name-box-bg" style="background-image: url('<?php echo htmlspecialchars(str_replace('/original/','/extra-small/',$row['picture'])); ?>');"></div>
							<span class="name"><?php echo $row['name'] ?></span>
						</div>
					</a>
					<span style="font-size: .7em;"><?php echo gettext('By'); ?> <a target="_blank" href="<?php echo $language_url; if ($row['domain']=='yoyogames'&&!empty($game_author['username'])) echo '/yyg'; ?>/users/<?php echo $game_author['username']; ?>"><?php echo $game_author['username']; ?></a></span><br>
					
					<ul class="star-rating"><li class="current-rating" style="width: <?php echo $row['rating']*60/5; ?>px; padding: 0;"><?php echo gettext('Rating:'); ?> <?php echo number_format($row['rating'],2,'.',''); ?>/5.</li></ul>
				</div><?php
			//}
		}
		if (mysqli_num_rows($result)==0) { ?>
						<div class="item" style="text-align: center; height: 130px; line-height: 130px;"><?php echo gettext('No results found.'); ?></div>
<?php
		}
?>
					</div>
<?php
	} elseif ($yyg) {
		$query_url = urlencode($query);
		//$url = "http://www.google.com/search?q=$query_url+yoyogames+sandbox&gbv=1&filter=0";
		$url = "http://www.bing.com/search?q=$query_url+site%3Ahttp%3A%2F%2Fsandbox.yoyogames.com%2Fgames";
		$content = file_get_contents($url);
		//echo $content;
		$content = '';
		/*for($i=0;$i<30;$i+=10) {
			$content .= file_get_contents($url . "&start=$i");
		}*/
		for($i=1;$i<41;$i+=10) {
			$content .= file_get_contents($url . "&first=$i");
		}
		//echo $content;
		$content = str_replace('<b>','',$content);
		$content = str_replace('</b>','',$content);
		$content = str_replace('<strong>','',$content);
		$content = str_replace('</strong>','',$content);
		$result = array();
		//preg_match_all('/<h3 class="r"><a href="\/url\?q=(http:\/\/sandbox.yoyogames.com\/games\/.*?)&amp;.*">(.*?)<\/a><\/h3>/',$content,$result);
		preg_match_all('/<div class="b_title".*?><h2><a href="(http:\/\/sandbox.yoyogames.com\/games\/.*?)" h=".*?">(.*?)<\/a><\/h2>/',$content,$result);
		//print_r($result);
		//preg_match_all('/' . preg_quote('<h3 class="r"><a href="/url?q=(') . '(http://sandbox.yoyogames.com/games/)' . '.*' . preg_quote(')&amp;.*">(.*)</a></h3>/'),$content,$result);
		
		$search_sql = '';
		$query_split = explode(' ',preg_quote($query));
		while($query_split[sizeof($query_split)-1]==='') {
			array_pop($query_split);
		}
		//print_r($query_split);
		for($j=min(3,sizeof($query_split)-1);$j>=0;$j-=1) {
			if (!empty($search_sql)) {
				$search_sql .= "\r\nUNION\r\n";
			}
			
			$_search_sql = '';
			for($i=0;$i<sizeof($query_split)-$j;$i+=1) {
				if (!empty($_search_sql)) {
					$_search_sql .= '|';
				}
				for($k=0;$k<=$j;$k+=1) {
					if ($k!=0) {
						$_search_sql .= '-';
					}
					$_search_sql .= $query_split[$i+$k];
				}
			}
			$search_sql .= "(SELECT * FROM yyg_games_list WHERE name REGEXP '([^a-zA-Z0-9_]|^)(" . $_search_sql . ")([^a-zA-Z0-9_]|$)' LIMIT 50)";
		}
		//$search_sql = "name REGEXP '([^a-zA-Z0-9_]|^)(" . $_search_sql . ")([^a-zA-Z0-9_]|$)'";
		$query = $search_sql; //"SELECT * FROM yyg_games_list WHERE $search_sql";
		//echo '<pre style="font-size: .7em;">'.$query.'</pre>';
		$_result = mysqli_query($con,$query);
		if (!$result) {
			echo "ERROR: ".mysqli_error($con);
		}
		while($row = mysqli_fetch_assoc($_result)) {
			$result[0][] = ucfirst(str_replace('-',' ',$row['name']));
			$result[1][] = 'http://sandbox.yoyogames.com/games/'.$row['id'].'-'.$row['name'];
			$result[2][] = ucfirst(str_replace('-',' ',$row['name']));
			//echo $row['name'].'|';
		}
?>
					<div class="games-alt items" style="max-height: 505px; overflow: auto;" data-columns="3" data-per-page="12">
<?php
		$games_listed = array();
		$games_done = array();
		for($i=0;$i<sizeof($result[0]);$i+=1) {
			$row['url_orig'] = preg_replace('/(.*?\/games\/.*?)[\/-].*/','\1',str_replace('/send_download','',str_replace('/reviews','#',str_replace('/download','',/*urldecode*/($result[1][$i])))));
			$row = array(
				'id'=>'',
				'name'=>'',
				'author'=>'Unknown',
				'author_picture'=>'',
				'description'=>'',
				'tags'=>'',
				'picture'=>'',
				'picture_large'=>'',
				'picture2_large'=>'',
				'version'=>'1',
				'added'=>0,
				'rating'=>0,
				'rating_count'=>0,
				'plays'=>0,
				'url_orig'=>$row['url_orig'],
				'url'=>"http://web.archive.org/web/".date('YmdHis',strtotime('1-05-2015'))."/".$row['url_orig'],
				'url_download'=>"http://web.archive.org/web/*/".$result[1][$i]."/*"
			);
			//echo $row['url'];
			
			//$row['url_orig'] = preg_replace('/(.*?\/games\/.*?)[\/-].*/','\1',str_replace('/send_download','',str_replace('/reviews','#',str_replace('/download','',/*urldecode*/($result[1][$i])))));
			//$row['url'] = "http://web.archive.org/web/".date('YmdHis')."/".$row['url_orig'];
			//$row['url_download'] = "http://web.archive.org/web/*/".$result[1][$i]."/*";
			$downloads = json_decode(file_get_contents("http://web.archive.org/cdx/search/cdx?limit=1000&output=json&url=".preg_replace('/(.*?\/games\/.*?)[\/-].*/','\1',$result[1][$i])."-*"));
			
			for($j=1;$j<sizeof($downloads);$j+=1) {
				if (stristr($downloads[$j][0],'/send_download'))
				if (strpos($downloads[$j][1],'2014')==0
				||  strpos($downloads[$j][1],'2015')==0
				||  strpos($downloads[$j][1],'2016')==0)
				if (strlen(explode('?',$downloads[$j][0])[1])>=1) {
					$row['url_download'] = str_replace('com,yoyogames,sandbox)',"http://web.archive.org/web/".date('YmdHis').'/http://sandbox.yoyogames.com',$downloads[$j][0]);
					break;
				}
			}
			
			$row['name'] = str_replace('Downloading Game | ','',str_replace('Reviews: Listing All Reviews for ','',str_replace('Reviews for ','',str_replace('YoYo Games | ','',$result[2][$i]))));
			if (in_array($row['url_orig'],$games_listed)) {
				continue;
			} else {
				$games_listed[] = $row['url_orig'];
			}
			
			$content = @file_get_contents($row['url']);
			
			$result2 = array();
			if (preg_match('/\<li id\="gameimages\-carousel\-item\-1"\>\s*?\<span\>\<\/span\>\<a href\=".*?" rel\="lightbox\[gameimage\]"\>\<img alt\=".*?" src\="(.*?)" \/\>\<\/a\>/',$content,$result2)>=1) {
				$row['picture'] = 'http://web.archive.org' . str_replace('/large/','/thumb/',$result2[1]);
				$row['picture_large'] = 'http://web.archive.org' . $result2[1];
			}
			if (preg_match('/\<li id\="gameimages\-carousel\-item\-2"\>\s*?\<span\>\<\/span\>\<a href\=".*?" rel\="lightbox\[gameimage\]"\>\<img alt\=".*?" src\="(.*?)" \/\>\<\/a\>/',$content,$result2)>=1) {
				$row['picture2'] = 'http://web.archive.org' . str_replace('/large/','/thumb/',$result2[1]);
				$row['picture2_large'] = 'http://web.archive.org' . $result2[1];
			}
			if (preg_match('/<strong>Created by:<\/strong> <a href=".*?\/users\/.*?">(.*?)<\/a>/',$content,$result2)>=1) {
				$row['author'] = $result2[1];
			}
			if (preg_match('/<li class=\'current-rating\' style=\'width:(.*?);\'>Currently .*? /',$content,$result2)>=1) {
				$row['rating'] = intval($result2[1])/12;
			}
			if (preg_match('/Rated <strong>.*?<\/strong> by <strong>([0-9]+)<\/strong> members\./',$content,$result2)>=1) {
				$row['rating_count'] = intval($result2[1]);
			}
			if (preg_match('/Played <strong>([0-9]+)<\/strong> times\./',$content,$result2)>=1) {
				$row['plays'] = intval($result2[1]);
			}
			if (preg_match('/<title>(.*?)<\/title>/',$content,$result2)>=1) if (strlen($result2[1])>10) {
				//$row['name'] = $result2[1];
				$row['name'] = ucfirst(str_replace('Downloading Game | ','',str_replace('Reviews: Listing All Reviews for ','',str_replace('Reviews for ','',str_replace('YoYo Games | ','',$result2[1])))));
			}
			if (preg_match('/<p><strong>Game description:<\/strong><\/p>\s+<p>(.*?)<\/p>/s',$content,$result2)>=1) {
				$row['description'] = $result2[1];
			}
			if (preg_match('/<strong>Added:<\/strong>\s+(.*?)<br \/>/s',$content,$result2)>=1) {
				$row['added'] = strtotime($result2[1]);
				//echo $row['added'];
			}
			if (preg_match('/<strong>Version:<\/strong>\s+([0-9]+)/s',$content,$result2)>=1) {
				$row['version'] = $result2[1];
				//echo $row['version'];
			}
			if (preg_match('/<h2>Tags:<\/h2>\s+<ul>\s+(<li>.*?)\s+<\/ul>/s',$content,$result2)>=1) {
				$row['tags'] = preg_replace('/\s\s+/',', ',strip_tags($result2[1]));
			}
			if (preg_match('/<div class="developer-thumb-small"><span><\/span><img alt=".*?" src="(.*?)"/',$content,$result2)>=1) {
				$row['author_picture'] = $result2[1];
			}
			
			if ($row['picture']=='') {
				$row['picture'] = $no_picture;
			}
			if (preg_match('/\/games\/([0-9]+)/',$row['url_orig'],$result2)>=1) {
				$row['id'] = $result2[1];
				//echo $row['id'];
			}
			
			
			$id_sql = mysqli_escape_string($con,$row['id']);
			$name_sql = mysqli_escape_string($con,$row['name']);
			$author_sql = mysqli_escape_string($con,$row['author']);
			$author_picture_sql = mysqli_escape_string($con,$row['author_picture']);
			$description_sql = mysqli_escape_string($con,$row['description']);
			$tags_sql = mysqli_escape_string($con,$row['tags']);
			$picture_sql = mysqli_escape_string($con,$row['picture_large']);
			$picture2_sql = mysqli_escape_string($con,$row['picture2_large']);
			$version_sql = mysqli_escape_string($con,$row['version']);
			$added_sql = mysqli_escape_string($con,date('Y-m-d H:i:s',$row['added']));
			$rating_sql = mysqli_escape_string($con,$row['rating']);
			$rating_count_sql = mysqli_escape_string($con,$row['rating_count']);
			$plays_sql = mysqli_escape_string($con,$row['plays']);
			$game_sql = mysqli_escape_string($con,$row['url_download']);
			if ($result2 = mysqli_query($con,"UPDATE games SET name = '$name_sql', author_str = '$author_sql', author_picture = '$author_picture_sql', game = '$game_sql', description = '$description_sql', tags = '$tags_sql', picture = '$picture_sql', version = '$version_sql', added = '$added_sql', state = 2, stage = 1, yyg_rating = '$rating_sql', yyg_rating_count = '$rating_count_sql', yyg_plays = '$plays_sql' WHERE id = '$id_sql' AND domain = 'yoyogames'")) {
				
			} else {
				echo 'Error: ' . mysqli_error($con);
				exit;
			}
			list($matched, $changed, $warnings) = sscanf(mysqli_info($con), "Rows matched: %d Changed: %d Warnings: %d");
			if ($matched==0) {
				$result2 = mysqli_query($con,"SELECT * FROM games WHERE id = '$id_sql' AND domain = 'yoyogames'");
				if (mysqli_num_rows($result2)==0) {
					if ($result2 = mysqli_query($con,"INSERT INTO games (id, domain, name, author_str, author_picture, game, description, tags, picture, version, added, state, stage, yyg_rating, yyg_rating_count, yyg_plays) VALUES ('$id_sql', 'yoyogames', '$name_sql', '$author_sql', '$author_picture_sql', '$game_sql', '$description_sql', '$tags_sql', '$picture_sql', '$version_sql', '$added_sql', 2, 1, '$rating_sql', '$rating_count_sql', '$plays_sql')")) {
						
					} else {
						echo 'Error: ' . mysqli_error($con);
						exit;
					}
					//echo 'Created new game '.$member_name;
				} else {
					//echo 'Updated game '.$name_sql;
				}
			}
			
			if ($result2 = mysqli_query($con,"UPDATE uploaded_files SET filename = '$picture2_sql' WHERE type = 2 AND place = '$id_sql' AND domain = 'yoyogames'")) {
				
			} else {
				echo 'Error: ' . mysqli_error($con);
				exit;
			}
			list($matched, $changed, $warnings) = sscanf(mysqli_info($con), "Rows matched: %d Changed: %d Warnings: %d");
			if ($matched==0) {
				if ($result2 = mysqli_query($con,"INSERT INTO uploaded_files (domain, filename, author_str, type, place, description, version, posted, stage) VALUES ('yoyogames', '$picture2_sql', '$author_sql', 2, '$id_sql', '$description_sql', '$version_sql', '$added_sql', 1)")) {
					
				} else {
					echo 'Error: ' . mysqli_error($con);
					exit;
				}
				//echo 'Created new game '.$member_name;
			} else {
				//echo 'Updated game '.$name_sql;
			}
?><div class="game-alt item">
					<a target="_blank" href="<?php echo $row['url_download'] ?>">
						<div class="picture-large" style="background-image: url('<?php echo htmlspecialchars(str_replace('/original/','/extra-small/',$row['picture'])); ?>');"></div>
						<div class="name-box">
							<div class="name-box-bg" style="background-image: url('<?php echo htmlspecialchars(str_replace('/original/','/extra-small/',$row['picture'])); ?>');"></div>
							<span class="name"><?php echo $row['name'] ?></span>
						</div>
					</a>
					<span style="font-size: .7em;"><?php echo gettext('By'); ?> <a target="_blank" href="<?php echo empty($row['author']) ? '' : "http://web.archive.org/web/".date('YmdHis')."/http://sandbox.yoyogames.com/users/".$row['author']; ?>"><?php echo $row['author']; ?></a></span><br>
					
					<ul class="star-rating"><li class="current-rating" style="width: <?php echo $row['rating']*60/5; ?>px; padding: 0;"><?php echo gettext('Rating:'); ?> <?php echo number_format($row['rating'],2,'.',''); ?>/5.</li></ul>
				</div><?php
			//echo str_repeat('<!----->',1024*8);
			flush();
			ob_flush();
		}
		if (sizeof($result[0])==0) { ?>
						<div class="item" style="text-align: center; height: 130px; line-height: 130px;"><?php echo gettext('No results found.'); ?></div>
<?php
		} else {
			//echo '<a href="' . $url . '">' . $url . '</a>';
			?><div class="game-alt item"><a target="_blank" href="<?php echo $url; ?>"><div class="picture-large" style="background-image: url('<?php echo htmlspecialchars(str_replace('/original/','/extra-small/',$no_picture)); ?>');"></div>
						<div><?php echo gettext('More...'); ?></div></a></div><?php
		}
?>
				</div>
<?php
	} else {
?>
					<div class="item" style="text-align: center; height: 130px; line-height: 130px;"><?php echo gettext('No results found.'); ?></div>
<?php
	}
?>
				</div>
<?php include("default-bottom.php"); ?>
