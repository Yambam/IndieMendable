<?php
	define('indiemendable',true,true);
	
	session_start();
	require_once "config.php";
	$css_extra = '';
	
	$domain_sql = mysqli_escape_string($con,$_SESSION['domain']);
	
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
		
		$game_info['screenshots'] = array();
		$result = mysqli_query($con,"SELECT * FROM uploaded_files WHERE type = 2 AND place = '$game_id' AND visibility = 1 ORDER BY filename ASC");
		while($row = mysqli_fetch_array($result)) {
			$game_info['screenshots'][] = $row;
		}
		
		$game_author_id = mysqli_escape_string($con,$game_info['author']);
		$game_author_str = mysqli_escape_string($con,$game_info['author_str']);
		$result = mysqli_query($con,"SELECT * FROM users WHERE id = '$game_author_id'");
		if (mysqli_num_rows($result)>=1) {
			$game_author = mysqli_fetch_assoc($result);
			if ($game_author['picture']=='') {
				$game_author['picture'] = $no_picture;
			}
		} elseif ($game_info['domain']=='yoyogames') {
			$game_author = array(
				'picture'=>'http://web.archive.org'.$game_info['author_picture'],
				'username'=>$game_info['author_str']
			);
			if (!empty($game_info['screenshots'])) {
				$game_info['header_picture'] = $game_info['screenshots'][0]['filename'];
			} else {
				$game_info['header_picture'] = $game_info['picture'];
			}
			if (empty($game_info['description'])) {
				$game_info['description'] = '_Some information is missing on this game. A downloadable file however is still available! :)_';
			} else {
				$game_info['description'] = str_replace("\r<br />","\r\n",$game_info['description']);
			}
			$game_info['description'] .= "\r\n\r\n__Source:__ [WayBack Machine](http://web.archive.org/web/20160608203511/http://sandbox.yoyogames.com".$_SERVER['REQUEST_URI'].")";
			$game_info['description'] = preg_replace('"\/web\/[0-9]*?im_/http:\/\/sandbox\.yoyogames\.com\/images\/smilies\/icon_smile\.gif"','/Smileys/smiley.gif',$game_info['description']);
			$game_info['plays'] += $game_info['yyg_plays'];
			$yyg = true;
		} else {
			header("HTTP/1.1 404 Not Found");
			include("error-404.php");
			exit;
		}
		
		$new_descr = preg_replace('/\[\s*bloody\s*\](.*?)\[\s*\/\s*bloody\s*\]/i','<span style="font-family: bloodynormal; color: red;">\1</span>',$game_info['description'],-1,$matches);
		if ($new_descr!=$game_info['description']) {
			$game_info['description'] = $new_descr;
			$css_extra .= '/bloody';
		}
	} else {
		header("HTTP/1.1 404 Not Found");
		include("error-404.php");
		exit;
	}
	
	$rating_given = false;
	$rating_count = $game_info['yyg_rating_count'];
	$game_info['rating'] = $game_info['yyg_rating_count'] * $game_info['yyg_rating'];
	$result = mysqli_query($con,"SELECT * FROM ratings WHERE type = 1 AND place = {$game_info['id']}");
	if (mysqli_num_rows($result)>=1) {
		$rating_count += mysqli_num_rows($result);
		while($row = mysqli_fetch_assoc($result)) {
			$game_info['rating'] += $row['rating'];
			if (!empty($_SESSION['user_id'])&&$row['author']==$_SESSION['user_id']) {
				$rating_given = true;
			}
		}
	}
	if ($rating_count>0) {
		$game_info['rating'] /= $rating_count;
	}
	mysqli_query($con,"UPDATE games SET rating = {$game_info['rating']} WHERE id = {$game_info['id']}");
	
	if (isset($_SESSION['user_id'])) {
		$result = mysqli_query($con,"SELECT * FROM favorites WHERE type = 1 AND place = '$game_id' AND author = '{$_SESSION['user_id']}'");
		if (mysqli_num_rows($result)>=1) {
			$game_favorite = 1;
		} else {
			$game_favorite = 0;
		}
	}
	
	if (!empty($_POST['comment']['content'])) {
		$id = $game_info['id'];
		$ip = mysql_escape_string($_SERVER['REMOTE_ADDR']);
		$author = $_SESSION['user_id'];
		$content = mysql_escape_string($_POST['comment']['content']);
		$result = mysqli_query($con,"INSERT INTO comments (type,place,ip,author,content) VALUES (2,$id,'$ip',$author,'$content')");
		if (!$result) {
			echo mysqli_error($con);
		}
		header("Location: " . $_SERVER['REQUEST_URI'], true, 302);
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
				<div class="container dark dark2" style="width: 100%; box-sizing: border-box/*; padding-bottom: 40%;*/; background-color: #212121;">
<?php
	if (!empty($game_info['header_picture'])) {
?>
					<div class="game-header" style="background-image: url('<?php echo str_replace('/original/','/large/',$game_info['header_picture']); ?>');"></div>
					<div class="game-header-offset">
						<div class="container-title" style="font-size: 1.1em; background-color: #454545;"><span class="float-right smallfont2" style="margin-left: 8px;"><?php echo gettext('View more'); ?> <a href="/browse?category=<?php echo $game_info['category']; ?>"><?php echo gettext(ucfirst($game_info['category']) . ' games'); ?></a></span><a href="<?php echo $_SERVER['REQUEST_URI']; ?>"><?php echo htmlspecialchars($game_info['name']); if ($game_info['state']==0) echo ' (Uploading)'; elseif ($game_info['state']==1) echo ' (Not yet scanned)'; ?></a> <?php echo gettext('created by'); ?> <a href="<?php echo $language_url; if ($game_info['domain']=='yoyogames') echo '/yyg'; ?>/users/<?php echo $game_author['username']; ?>"><?php echo $game_author['username']; ?></a></div>
					</div>
<?php
	} else {
?>
					<div class="container-title" style="font-size: 1.1em; background-color: #454545;"><span class="float-right smallfont2" style="margin-left: 8px;"><?php echo gettext('View more'); ?> <a href="/browse?category=<?php echo $game_info['category']; ?>"><?php echo ucfirst($game_info['category']) . ' games'; ?></a></span><a href="<?php echo $_SERVER['REQUEST_URI']; ?>"><?php echo htmlspecialchars($game_info['name']); if ($game_info['state']==0) echo ' ('.gettext('Uploading').')'; elseif ($game_info['state']==1) echo ' ('.gettext('Not yet scanned').')'; elseif ($game_info['state']==1) echo ' ('.gettext('WARNING: Virus detected').')'; ?></a> <?php echo gettext('created by'); ?> <a href="<?php echo $language_url; if ($game_info['domain']=='yoyogames') echo '/yyg'; ?>/users/<?php echo $game_author['username']; ?>"><?php echo $game_author['username']; ?></a></div>
<?php
	}
?>
					<div class="game-info container-seamless smallfont2">
						<div class="user-link" style="height: 60px; margin-right: 4px; vertical-align: top;"><strong><?php echo gettext('Created by'); ?>: </strong><a href="<?php if ($game_info['domain']=='yoyogames') echo '/yyg'; ?>/users/<?php echo $game_author['username']; ?>"><div class="picture-alt" style="margin: 8px; background-image: url('<?php echo htmlspecialchars(str_replace('/original/','/thumb/',$game_author['picture'])); ?>');"></div><?php echo $game_author['username']; ?></a><br>
						<strong><?php echo gettext('Last updated'); ?>: </strong><?php echo date('d F Y',strtotime($game_info['last_updated'])); ?><br>
						<strong><?php echo gettext('Version'); ?>: </strong><?php if ($game_info['stage']==2) echo gettext('Beta')+' '; if ($game_info['stage']==3) echo gettext('WIP')+' '; echo htmlspecialchars($game_info['version']); ?><br></div>
						<div style="margin: 13px 6px;" class="game-description<?php if (strlen($game_info['description'])>240) echo ' less'; ?>" tabindex="0">
							<?php echo $Parsedown->setBreaksEnabled(true)->text(filter_tags($game_info['description'])); ?>
							<div class="game-short-fade"></div>
						</div>
						<div style="background-color: #303030; padding-left: 2px;" class="game-tags<?php if (strlen(implode(', ',$game_info['tags']))>240) echo ' less'; ?>" tabindex="0">
							<strong><?php echo gettext('Tags'); ?>: </strong>
<?php foreach($game_info['tags'] as $tag) { ?><a href="/search?q=<?php echo htmlspecialchars($tag); if ($game_info['domain']=='yoyogames') echo '&yyg=yes'; ?>"><?php echo htmlspecialchars($tag); ?></a><?php } ?>
							<div class="game-short-fade"></div>
						</div>
						<a href="<?php echo $_SERVER['REQUEST_URI'] . '/more_information'; ?>" class="game-button-play"><?php echo gettext('Downloads'); ?></a><?php
	if (!empty($_SESSION['username'])&&$game_info['author']==$_SESSION['user_id']||$_SESSION['user_info']['type']==2) {
		?><a href="<?php echo $_SERVER['REQUEST_URI'] . '/edit'; ?>" class="game-button-edit"><span class="fa fa-pencil"></span><?php /*echo gettext('Edit');*/ ?></a><?php
	}
?>
						<div style="background-color: #303030;">
							<ul class="share-buttons">
								<li><a href="https://www.facebook.com/sharer/sharer.php?u=&t=" target="_blank" title="Facebook" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(document.URL) + '&t=' + encodeURIComponent(document.URL)); return false;"><img src="/img/simple_icons/Facebook.png"></a></li>
								<li><a href="https://twitter.com/intent/tweet?source=&text=:%20" target="_blank" title="Tweet" onclick="window.open('https://twitter.com/intent/tweet?text=' + encodeURIComponent(document.title) + ':%20'  + encodeURIComponent(document.URL)); return false;"><img src="/img/simple_icons/Twitter.png"></a></li>
								<li><a href="https://plus.google.com/share?url=" target="_blank" title="Share on Google+" onclick="window.open('https://plus.google.com/share?url=' + encodeURIComponent(document.URL)); return false;"><img src="/img/simple_icons/Google+.png"></a></li>
								<li><a href="http://www.tumblr.com/share?v=3&u=&t=&s=" target="_blank" title="Post to Tumblr" onclick="window.open('http://www.tumblr.com/share?v=3&u=' + encodeURIComponent(document.URL) + '&t=' +  encodeURIComponent(document.title)); return false;"><img src="/img/simple_icons/Tumblr.png"></a></li>
								<li><a href="http://www.reddit.com/submit?url=&title=" target="_blank" title="Submit to Reddit" onclick="window.open('http://www.reddit.com/submit?url=' + encodeURIComponent(document.URL) + '&title=' +  encodeURIComponent(document.title)); return false;"><img src="/img/simple_icons/Reddit.png"></a></li>
								<li><a href="mailto:?subject=&body=:%20" target="_blank" title="Email" onclick="window.open('mailto:?subject=' + encodeURIComponent(document.title) + '&body=' +  encodeURIComponent(document.URL)); return false;"><img src="/img/simple_icons/Email.png"></a></li>
							</ul>
						</div>
					</div>
					<div class="game-main-info container-seamless" style="overflow: auto; margin-right: 310px;">
						<div class="game-screenshots">
<?php if ($game_info['featured']==1) { ?>
							<img class="game-featured" title="This game has been featured on the front page of the site." src="/img/game-featured.svg" width="100" height="100" style="position: absolute; z-index: 1; left: 0; top: 0;"></img>
<?php } ?>
							<div class="shift" data-count="<?php echo 1+sizeof($game_info['screenshots']); ?>" style="margin-left: 0;">
							</div><a href="<?php echo $game_info['picture']; ?>" data-lightbox="screenshots" style="background-image: url('<?php echo str_replace('/original/','/large/',$game_info['picture']); ?>')">
							</a><?php
	foreach($game_info['screenshots'] as $screenshot) { ?><a href="<?php echo $screenshot['filename']; ?>" data-lightbox="screenshots" style="background-image: url('<?php echo str_replace('/original/','/large/',$screenshot['filename']); ?>')">
	</a><?php } ?>
						</div>
						<div class="smallfont2" style="background-color: #303030; color: #D0D0D0; padding: 3px; margin: 12px 0;">
							<?php
	if ($rating_count>=1) {
		?><?php echo sprintf(gettext('Rated <strong>%s of 5</strong> by'),number_format($game_info['rating'],1)); ?> <strong><?php echo $rating_count; ?></strong> <?php echo lcfirst(ngettext('Member','Members',$rating_count)) . '.';
	} else {
		echo gettext('No ratings yet!');
	}
	?> <?php echo $game_info['plays']==1 ? gettext('Played <strong>once</strong>.') : sprintf(gettext('Played <strong>%d</strong> times.'),$game_info['plays']); ?>
						</div>
						<div style="display: inline-block; vertical-align: top; width: 50%; width: calc(50% - 5px); margin: 5px 0; margin-right: 5px;">
<?php
	if (empty($_SESSION['logged_in'])) {
?>
							<div class="dark-inset-button" href="<?php echo $_SERVER['REQUEST_URI']; ?>/favorite">
								<span class="fa fa-star" style="margin-right: 10px;"></span><?php echo gettext('Add to favorites'); ?>
							</div>
<?php
	} elseif (empty($game_favorite)) {
?>
							<a class="dark-inset-button" href="<?php echo $_SERVER['REQUEST_URI']; ?>/favorite">
								<span class="fa fa-star" style="margin-right: 10px;"></span><?php echo gettext('Add to favorites'); ?>
							</a>
<?php
	} else {
?>
							<a class="dark-inset-button" href="<?php echo $_SERVER['REQUEST_URI']; ?>/favorite">
								<span class="fa fa-star" style="margin-right: 10px;"></span><?php echo gettext('Remove from favorites'); ?>
							</a>
<?php
	}
?>
							<a class="dark-inset-button" href="/report/game/<?php echo $game_info['id']; ?>">
								<span class="fa fa-times" style="margin-right: 10px;"></span><?php echo gettext('Report game'); ?>
							</a>
							<a class="dark-inset-button" href="mailto:?subject=&body=:%20" href="mailto:?subject=&body=:%20" target="_blank" onclick="window.open('mailto:?subject=' + encodeURIComponent(document.title) + '&body=' +  encodeURIComponent(document.URL)); return false;">
								<span class="fa fa-user" style="margin-right: 10px;"></span><?php echo gettext('Send to friend'); ?>
							</a>
						</div><div style="display: inline-block; vertical-align: top; width: 50%; margin: 5px 0;">
							<div class="dark-inset" style="white-space: nowrap;">
								<div style="float: right;/* width: calc(100% - 60px);*/ height: 15px;">
									<ul class="star-rating-dark<?php if (!empty($_SESSION['logged_in'])&&!$rating_given&&$_SESSION['user_id']!=$game_info['author']) echo ' rateable'; ?>"><?php
	if (!empty($_SESSION['logged_in'])&&!$rating_given&&$_SESSION['user_id']!=$game_info['author']) {
		for($i=5;$i>=1;$i-=1) {
			?><a class="new-rating" style="width: <?php echo 12*$i; ?>px; padding: 0;" href="<?php echo $_SERVER['REQUEST_URI']; ?>/rating?r=<?php echo $i; ?>"></a><?php
		}
	}?><li class="current-rating" style="width: <?php echo $game_info['rating']*60/5; ?>px; padding: 0;"><?php echo gettext('Rating'); ?>: <?php echo $game_info['rating']; ?>/5.</li></ul>
								</div><span class="smallfont float-left"><?php
	if (empty($_SESSION['logged_in'])) {
		echo sprintf(gettext('Please <a href="%s/login">log in</a> to rate'),$language_url);
	} else {
		if ($rating_given) {
			echo gettext('Thanks for rating!') . sprintf(' <a href="%s/rating">',$_SERVER['REQUEST_URI']) . gettext('Undo?') . '</a>';
		} else {
			echo gettext('Current rating');
		}
	}
?></span>
							</div>
							<a href="<?php echo $_SERVER['REQUEST_URI'] . '/download'; ?>" class="game-button-play" style="margin-top: 2px;"><?php echo gettext('Play now'); ?></a>
						</div>
					</div>
					<div class="game-long-fade"></div>
				</div>
				<div class="container-lt float-right" style="width: 291px; min-height: 120px; padding: 0;">
					<div class="container-title-lt" style="margin: 0;"><?php echo gettext('More games') . ' ' . lcfirst(gettext('By')) . ' ' . htmlspecialchars($game_author['username']); ?></div>
					<div style="overflow: hidden;" class="game-screenshots game-other-games">
<?php
	$result = mysqli_query($con,"SELECT * FROM games WHERE domain = '$domain_sql' AND author = '$game_author_id' OR (author_str != '' && author_str = '$game_author_str') AND id != '$game_id' ORDER BY added DESC");
	if (!$result) {
		echo mysqli_error($con);
	}
?>
						<div class="shift" data-count="<?php echo mysqli_num_rows($result); ?>" style="margin-left: 0;">
						</div><?php if (mysqli_num_rows($result)>=1) while($row = mysqli_fetch_assoc($result)) { ?><a href="<?php echo $language_url; ?>/games/<?php echo $row['id'].'-'.slugify($row['name']); ?>" tabindex="-1" style="background-image: url('<?php echo str_replace('/original/','/large/',$row['picture']); ?>')">
							<div><div><?php echo $row['name']; ?></div></div>
						</a><?php } else {
?>
						<a tabindex="-1" style="width: 100%;">
							<div class="not-available"><div><?php echo gettext('No other games available.'); ?></div></div>
						</a>
<?php
	} ?>

					</div>
				</div>
				<div class="container-lt" style="min-height: 0; overflow: auto; margin-right: 320px; float: none;">
					<div class="container-title-lt"><?php echo gettext('Reviews'); ?></div>
<?php
	if (!empty($_SESSION['betabeta'])||$version_info['gamemaker_sandbox']>=2) {
		$id = mysql_escape_string($game_info['id']);
		$result = mysqli_query($con,"SELECT * FROM reviews WHERE type = 1 AND place = $id ORDER BY id DESC");
		if (mysqli_num_rows($result)==0) { ?>
					<div class="item smallfont" style="text-align: center; vertical-align: center; line-height: 50px; height: 50px; border-top: 2px solid transparent;"><?php echo gettext('No reviews yet.'); ?> <a href="/games/<?php echo $game_info['id'] ?>/reviews/make"><?php echo gettext('Write a review?'); ?></a></div>
<?php
		} else {
?>
					<div class="reviews items" data-per-page="1" style="max-height: 122px; overflow: auto;">
<?php
			while($row = mysqli_fetch_assoc($result)) {
				for($i=0;$i<32;$i+=1) {
				$comment_author_id = mysql_escape_string($row['author']);
				$comment_author = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM users WHERE id = $comment_author_id"))
?>
						<div class="review item smallfont">
							<div class="review-star-ratings">
								<div style="background-color: #151515; color: white;"><?php echo gettext('Overall score'); ?>: <ul class="star-rating-dark"><li class="current-rating" style="width: <?php echo $row['overall_rating']*60/5; ?>px; padding: 0;"><?php echo gettext('Rating'); ?>: <?php echo $row['overall_rating']; ?>/5.</li></ul></div>
<?php
				$result2 = mysqli_query($con,"SELECT * FROM ratings WHERE type = 2 AND place = {$row['id']} ORDER BY id ASC");
				while($row2 = mysqli_fetch_assoc($result2)) {
?>
								<div><?php echo gettext($row2['info']); ?>: <ul class="star-rating"><li class="current-rating" style="width: <?php echo $row2['rating']*60/5; ?>px; padding: 0;"><?php echo gettext('Rating'); ?>: <?php echo $row2['rating']; ?>/5.</li></ul></div>

<?php
				}
?>
							</div>
							<div style="overflow: hidden;">
								<div class="user-link-alt" style="width: 100%; height: initial; overflow: hidden; display: inline-block; margin-right: 4px; vertical-align: top;">
									<a href="/users/<?php echo $comment_author['username']; ?>">
										<div class="picture" style="background-image: url('<?php echo str_replace('/original/','/thumb/',$comment_author['picture']); ?>'); height: 40px; width: 40px;"></div>
									</a>
									<span>
										<strong><?php echo $row['title']; ?></strong><br>
										<strong><?php echo gettext('Added'); ?>: </strong><?php echo time_elapsed_string($row['posted']); ?><br>
										<strong><?php echo gettext('Created by'); ?>: </strong><a style="font-size: 1em;" href="/users/<?php echo $comment_author['username']; ?>"><?php echo $comment_author['username']; ?></a>
									</span>
								</div>
								<p>
									<strong><?php echo gettext('Pros'); ?>: </strong><span><?php echo htmlspecialchars($row['pros']); ?></span><br>
									<strong><?php echo gettext('Cons'); ?>: </strong><span><?php echo htmlspecialchars($row['cons']); ?></span>
								<p style="text-align: right;">
									<a href="/games/<?php echo $game_info['id'] ?>/reviews/<?php echo $row['id']; ?>"><?php echo gettext('Read full review'); ?></a>
							</div>
						</div>
<?php
				}
			}
?>
						<a class="pseudo-page-number smallfont2" href="/games/<?php echo $game_info['id'] ?>/reviews"><?php echo gettext('View all reviews'); ?></a>
					</div>
<?php
		}
	}
?>
				</div>
				<div class="container-lt" style="overflow: auto; margin-right: 320px; float: none;">
					<div class="container-title-lt"><?php echo gettext('Comments'); ?></div>
<?php
	if (!empty($_SESSION['betabeta'])||$version_info['gamemaker_sandbox']>=2) {
		$result = mysqli_query($con,"SELECT * FROM comments WHERE type = 2 AND place = '$game_id' AND domain = '$domain_sql' AND author!=0 ORDER BY id DESC");
?>
					<div class="even-odd seperators comments items">
<?php
		while($row = mysqli_fetch_assoc($result)) {
			$comment_author_id = mysql_escape_string($row['author']);
			$comment_author = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM users WHERE id = $comment_author_id"))
/*?>
						<!--<div class="comment item">
							<div class="user-link" style="height: 48px; display: inline-block; margin-right: 4px; vertical-align: top;">
								<a href="/users/<?php echo $comment_author['username']; ?>">
									<div class="picture" style="background-image: url('<?php echo str_replace('/original/','/thumb/',$comment_author['picture']); ?>'); height: 40px; width: 40px;"></div><?php echo $comment_author['username']; ?>
								</a> <?php echo gettext('said'); ?> <?php echo time_elapsed_string($row['posted']); ?>
							</div>
							<p>
								<?php echo str_replace("\r\n",'<br>',htmlspecialchars($row['content'])); ?>
							</p>
						</div>--><?php */; ?>
						
						<div class="comment item">
							<div class="user-link-alt">
								<a href="<?php echo $language_url; ?>/users/<?php echo $comment_author['username']; ?>">
									<div class="picture-alt" style="background-image: url('<?php echo str_replace('/original/','/thumb/',$comment_author['picture']); ?>');">
								</div>
								<?php echo $comment_author['username']; ?></a> <?php echo gettext('said'); ?> <span class="date-time" title="<?php echo date('d F Y H:i:s',strtotime($row['posted'])-$utc_offset-$time_offset_seconds); ?>"><?php echo time_elapsed_string($row['posted']); ?></span>
							</div>
							<div class="content">
								<?php echo $Parsedown->setBreaksEnabled(true)->text(filter_tags($row['content'])); ?>
							</div>
						</div>
<?php
		}
		if (mysqli_num_rows($result)==0) { ?>
						<div class="comment item" style="text-align: center; vertical-align: center; height: 94px; line-height: 94px;"><?php echo gettext('No comments yet.'); ?></div>
<?php
		}
?>
					</div>
					<form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post" style="margin-top: 5px; display: block; height: 113px;">
						<textarea name="comment[content]" rows="4" cols="30"<?php if (empty($_SESSION['logged_in'])) echo ' disabled=""'; ?>><?php if (empty($_SESSION['logged_in'])) echo gettext('Please log in to leave a comment.'); ?></textarea>
						<input id="post-comment" type="submit" value="Post comment" style="box-sizing: border-box; width: 120px; float: right;"<?php if (empty($_SESSION['logged_in'])) echo ' disabled=""'; ?>>
					</form>
<?php
	}
?>
				</div>
<?php include("default-bottom.php") ?>