<?php
	session_start();
	require_once "config.php";
	
	if (empty($_SESSION['betabeta'])&&$version_info['gamemaker_sandbox']<3) {
		header("HTTP/1.1 404 Not Found");
		/*print_r($_SESSION['betabeta']);*/
		include("error-404.php");
		exit;
	}
	
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
		
		$new_descr = preg_replace('/\[\s*bloody\s*\](.*?)\[\s*\/\s*bloody\s*\]/i','<span style="font-family: bloodynormal; color: red;">\1</span>',$game_info['description'],-1,$matches);
		if ($new_descr!=$game_info['description']) {
			$game_info['description'] = $new_descr;
			$css_extra = '/bloody';
		}
	} else {
		header("HTTP/1.1 404 Not Found");
		include("error-404.php");
		exit;
	}
	
	$rating_average = 5;
	$rating_count = 1;
	
	$stages = array('complete','wip','beta');
	
	if (!empty($_POST['comment']['content'])) {
		$id = $game_info['id'];
		$ip = mysql_escape_string($_SERVER['REMOTE_ADDR']);
		$author = $_SESSION['user_id'];
		$content = mysql_escape_string($_POST['comment']['content']);
		$result = mysqli_query($con,"INSERT INTO comments (type,place,ip,author,content) VALUES (2,$id,'$ip',$author,'$content')");
		if (!$result) {
			echo mysqli_error($con);
		}
	}
	
	function time_elapsed_string($datetime, $full = false) {
		$now = new DateTime;
		$ago = new DateTime($datetime);
		$diff = $now->diff($ago);
		
		$diff->w = floor($diff->d / 7);
		$diff->d -= $diff->w * 7;
		
		$string = array(
			'y' => 'year',
			'm' => 'month',
			'w' => 'week',
			'd' => 'day',
			'h' => 'hour',
			'i' => 'minute',
			's' => 'second',
		);
		foreach ($string as $k => &$v) {
			if ($diff->$k) {
				$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
			} else {
				unset($string[$k]);
			}
		}
		
		if (!$full) $string = array_slice($string, 0, 1);
		return $string ? implode(', ', $string) . ' ago' : 'just now';
	}
	
	$page_title = $game_info['name'];
	include("default-top.php");
?>
<?php /*
				<div class="container-lt" style="width: 100%; box-sizing: border-box; background-color: #F0F0F0;">
					<div class="container-title-lt" style="font-size: 1.1em;"><span class="float-right smallfont2" style="margin-left: 8px;">View more <a href="/browse?category=platform">Platform</a> games</span><a href="<?php echo $_SERVER['REQUEST_URI']; ?>"><?php echo htmlspecialchars($game_info['name']); ?></a> created&nbsp;by&nbsp;<a href="/users/<?php echo $game_author['username']; ?>"><?php echo $game_author['username']; ?></a></div>
					<div class="game-info container-seamless smallfont2" style="background-color: #E0E0E0; color: black;">
						<div class="user-link" style="height: 60px; margin-right: 4px; vertical-align: top;"><strong>Created by: </strong><a href="/users/<?php echo $game_author['username']; ?>"><div class="picture-alt" style="margin: 8px; background-image: url('<?php echo htmlspecialchars(str_replace('/original/','/thumb/',$game_author['picture'])); ?>');"></div><?php echo $game_author['username']; ?></a><br>
						<strong>Last updated: </strong><?php echo date('d F Y',strtotime($game_info['last_updated'])); ?><br>
						<strong>Version: </strong>1<br></div>
						<p style="margin: 13px 6px;">
							<?php echo htmlspecialchars(str_replace("\r\n",'<br>',$game_info['description'])); ?>
						<a href="<?php echo str_replace('/more_information','/download',$_SERVER['REQUEST_URI']); ?>" class="game-button-play">Latest version</a>
					</div>
					<div class="game-main-info container-seamless" style="overflow: auto; margin-right: 310px;">
						<h2 style="color: black;"><q><?php echo htmlspecialchars($game_info['name']); ?></q> files</h2>
						<!--<div class="smallfont2" style="background-color: #E8E8E8; color: black; padding: 3px; margin: 12px 0;">
							Rated <strong><?php echo $rating_average; ?> out of 5</strong> by <strong><?php echo $rating_count; ?></strong> <?php echo 'member' . ($rating_count==1 ? '' : 's'); ?>. Played <strong><?php echo $game_info['plays']; ?></strong> <?php echo 'time' . ($game_info['plays']==1 ? '' : 's'); ?>
						</div>-->
					</div>
				</div>
*/ ?>
				<div class="container-lt" style="width: 100%; box-sizing: border-box;">
					<div class="container-title-lt" style="font-size: 1.1em;"><span class="float-right smallfont2" style="margin-left: 8px;">View more <a href="<?php echo $language_url; ?>/browse?category=<?php echo $game_info['category']; ?>"><?php echo ucfirst($game_info['category']); ?></a> games</span><a href="<?php echo $_SERVER['REQUEST_URI']; ?>"><?php echo htmlspecialchars($game_info['name']); ?></a> created&nbsp;by&nbsp;<a href="<?php echo $language_url; ?>/users/<?php echo $game_author['username']; ?>"><?php echo $game_author['username']; ?></a></div>
					<h2 style="text-align: center;">"<?php echo htmlspecialchars($game_info['name']); ?>" <span style="font-size: 1rem; font-weight: 300;">by <a href="<?php echo $language_url; ?>/users/<?php echo $game_author['username']; ?>"><?php echo $game_author['username']; ?></a></span></h2>
					<div style="margin: 6px;">
						<strong>Game description:</strong>
						<div>
							<?php echo $Parsedown->setBreaksEnabled(true)->text($game_info['description']); ?>
						</div>
						<!--<div class="game-screenshots">
							<div class="shift" data-count="2" style="margin-left: 0;">
							</div><a href="/img/game/763/70763/original/karoshi_logo.jpg" data-lightbox="screenshots" style="background-image: url(/img/game/763/70763/large/karoshi_logo.jpg)">
							</a><a href="/img/game/764/70764/original/karoshi_1.jpg" data-lightbox="screenshots" style="background-image: url(/img/game/764/70764/large/karoshi_1.jpg)">
							</a><a href="/img/game/765/70765/original/karoshi_2.jpg" data-lightbox="screenshots" style="background-image: url(/img/game/765/70765/large/karoshi_2.jpg)">
							</a>
							<div class="prev disabled"></div>
							<div class="next"></div>
						</div>-->
					</div>
					<h3 style="text-align: center;">Version history</h3>
					<div style="margin: 0 auto; max-width: 180px;">
						<a href="<?php echo str_replace('/more_information','/download',$_SERVER['REQUEST_URI']); ?>" class="game-button-play" style="max-width: 180px; margin-top: 20px;">Latest version</a>
						<div style="text-align: right; color: #808080; font-size: .8em;">
							<strong>Version: </strong><?php if ($game_info['stage']==2) echo 'Beta '; if ($game_info['stage']==3) echo 'WIP '; echo htmlspecialchars($game_info['version']); ?><br>
							<?php echo date('d F Y',strtotime($game_info['last_updated'])); ?>
						</div>
					</div>
					<table class="version-table" style="width: 100%; box-sizing: border-box; margin-top: 16px;">
						<thead>
							<td>Filename</td>
							<td style="text-align: right;">Version</td>
							<td style="text-align: right;">Size</td>
							<td style="text-align: right;">Added</td>
						</thead>
<?php
	$result = mysqli_query($con,"SELECT * FROM uploaded_files WHERE type = 1 AND place = $game_id ORDER BY id DESC");
	while($row = mysqli_fetch_assoc($result)) { ?>
						<tr>
							<td><a href="/games/<?php echo $_GET['q']; ?>/download/<?php echo $row['id']; ?>"><?php echo basename($row['filename']); ?></a></td>
							<td style="text-align: right;"><?php if ($row['stage']==2) echo 'Beta '; if ($row['stage']==3) echo 'WIP '; echo $row['version']; ?></td>
							<td style="text-align: right;"><?php echo number_format(filesize(dirname(__FILE__) . $row['filename']) / 1000000,2); ?> MB</td>
							<td style="text-align: right;"><?php echo date('d F Y H:i:s',strtotime($row['posted'])); ?></td>
						</tr>

<?php
	}
	
	if (mysqli_num_rows($result)==0) {
		?><tr>
			<td>No files found.</td>
			<td style="text-align: right;">-</td>
			<td style="text-align: right;">-</td>
			<td style="text-align: right;">-</td>
		</tr><?php
	}
?>
					</table>
				</div>
<?php include("default-bottom.php") ?>