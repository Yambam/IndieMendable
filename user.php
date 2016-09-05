<?php
	session_start();
	require_once "config.php";
	
	if (preg_match('/^[0-9]+$/',$_GET['q'])>=1) {
		$result = mysqli_query($con,"SELECT * FROM users WHERE id = {$_GET['q']}");
		if (mysqli_num_rows($result)>=1) {
			$row = mysqli_fetch_assoc($result);
			$_GET['q'] = $row['username'];
		}
	}
	
	$q = mysqli_escape_string($con,$_GET['q']);
	$result = mysqli_query($con,"SELECT * FROM users WHERE username = '$q'");
	if (mysqli_num_rows($result) >= 1) {
		$user_info = mysqli_fetch_array($result);
		if ($user_info['picture']==''||!file_exists(dirname(__FILE__) . $user_info['picture'])) {
			$user_info['picture'] = $no_picture;
		}
		
		$picture_size=getimagesize($_SERVER['DOCUMENT_ROOT'].$user_info['picture']);
		$picture_size[0]=max($picture_size[0],1);
		$picture_size[1]=max($picture_size[1],1);
		
		if (time() - strtotime($user_info['last_active']) < 600) {
			$user_info['state'] = 'Online';
		} else {
			$user_info['state'] = 'Offline';
		}
		
		if (!empty($user_info['time_zone'])) {
			$user_time_zone = timezone_open($user_info['time_zone']);
			$user_info['time_zone_nice'] = ''; //timezone_location_get($user_time_zone)['comments'];
			$user_info['time_zone_nice'] = $user_info['time_zone'] . (empty($user_info['time_zone_nice']) ? '' : ' - ' . $user_info['time_zone_nice']);
		}
	} else {
		header("HTTP/1.1 404 Not Found");
		include("error-404.php");
		exit;
	}
	
	$_POST['comment']['type'] = 1;
	comment_add($con,$user_info['id']);
	
	if (!empty($_GET['action'])) {
		if ($_GET['action']=='friend') {
			$ip = mysql_escape_string($_SERVER['REMOTE_ADDR']);
			$friend1 = $_SESSION['user_id'];
			$friend2 = $user_info['id'];
			
			$result = mysqli_query($con,"SELECT * FROM friends WHERE (friend1 = $friend1 AND friend2 = $friend2) OR (friend1 = $friend2 AND friend2 = $friend1)");
			if (mysqli_num_rows($result)==0) {
				$result = mysqli_query($con,"INSERT INTO friends (ip,friend1,friend2) VALUES ('$ip','$friend1','$friend2')");
				if (!$result) {
					$_SESSION['message'] = mysqli_error($con);
				}
				$request_id = mysqli_insert_id($con);
				
				$uid = sha1(date('r',time()));
				$subject = mysql_escape_string("{$_SESSION['username']} sent you a friend request");
				$body = mysql_escape_string("Click [url=http://gamemaker.mooo.com/users/$friend1/friend/approve?uid=$uid]here[/url] to approve.");
				$result = mysqli_query($con,"INSERT INTO messages (ip,sent_from,sent_to,subject,body) VALUES ('$ip','$friend1','$friend2','$subject','$body')");
				if (!$result) {
					$_SESSION['message'] = mysqli_error($con);
				}
				
				$expiration = date("Y-m-d H:i:s",time()+1209600); //Expires after 2 weeks
				$result = mysqli_query($con,"INSERT INTO expiring_links (type,uid,info,expiration) VALUES ('friend_request','$uid','$request_id','$expiration')");
				if (!$result) {
					$_SESSION['message'] = mysqli_error($con);
				}
				
				$_SESSION['message'] = "You've sent {$user_info['username']} a friend request!";
			} else {
				$result = mysqli_query($con,"SELECT * FROM friends WHERE friend1 = $friend1 AND friend2 = $friend2");
				if (mysqli_num_rows($result)>=1) {
					$row = mysqli_fetch_assoc($result);
					if ($row['approved']==1) {
						$_SESSION['message'] = "{$user_info['username']} is not in your friends list anymore.";
					} else {
						$_SESSION['message'] = "You've cancelled your friend request to {$user_info['username']}.";
					}
					$result = mysqli_query($con,"DELETE FROM friends WHERE friend1 = $friend1 AND friend2 = $friend2");
				} else {
					$result = mysqli_query($con,"SELECT * FROM friends WHERE friend1 = $friend2 AND friend2 = $friend1");
					$row = mysqli_fetch_assoc($result);
					if ($row['approved']==1) {
						$_SESSION['message'] = "{$user_info['username']} is not in your friends list anymore.";
					} else {
						$_SESSION['message'] = "You've cancelled your friend request from {$user_info['username']}.";
					}
					$result = mysqli_query($con,"DELETE FROM friends WHERE friend1 = $friend2 AND friend2 = $friend1");
				}
				
				if (!$result) {
					$_SESSION['message'] = mysqli_error($con);
				}
			}
		} elseif ($_GET['action']=='friend/approve') {
			$uid = mysql_escape_string($_GET['uid']);
			$friend2 = $_SESSION['user_id'];
			
			$result = mysqli_query($con,"SELECT * FROM expiring_links WHERE uid = '$uid'");
			if (mysqli_num_rows($result)>=1) {
				$row = mysqli_fetch_assoc($result);
				$result2 = mysqli_query($con,"SELECT * FROM friends WHERE id = {$row['info']} AND friend1 != $friend2 AND friend2 = $friend2 AND approved = 0");
				if (mysqli_num_rows($result2)>=1) {
					$row2 = mysqli_fetch_assoc($result2);
					$friend1 = $row2['friend1'];
					$friend2 = $row2['friend2'];
					$result = mysqli_query($con,"UPDATE friends SET approved = 1 WHERE id = {$row['info']} AND approved = 0");
					if (mysqli_affected_rows($con)>=1) {
						$friend1_info = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM users WHERE id = $friend1"));
						$_SESSION['message'] = "You've added {$friend1_info['username']} to your friends list!";
						
						$result = mysqli_query($con,"DELETE FROM expiring_links WHERE uid = '$uid'");
					} else {
						$_SESSION['message'] = "Sorry, this link isn't available anymore.";
					}
				} else {
					$_SESSION['message'] = "Sorry, this link isn't available anymore.";
				}
				
				if (!$result) {
					$_SESSION['message'] = mysqli_error($con);
				}
			} else {
				$_SESSION['message'] = "Sorry, this link isn't available anymore.";
				
				if (!$result) {
					$_SESSION['message'] = mysqli_error($con);
				}
			}
		}
		/*if ($_GET['action']) {
			$id = $user_info['id'];
			$ip = mysql_escape_string($_SERVER['REMOTE_ADDR']);
			$author = $_SESSION['user_id'];
			$content = mysql_escape_string($_POST['comment']['content']);
		}*/
		
		header("Location: http://gamemaker.mooo.com$language_url/users/{$user_info['username']}", true, 302);
		exit;
	}
	
	function processString($s) {
		//$s=preg_replace('/https?:\/\/[\w\-\.!~#?&=+\*\'"(),\/]+/','<a href="$0">$0</a>',$s);
		/*$s=preg_replace('/\[b\](.*)\[\/b\]/','<b>$1</b>',$s);
		$s=preg_replace('/\[i\](.*)\[\/i\]/','<i>$1</i>',$s);
		$s=preg_replace('/\[u\](.*)\[\/u\]/','<span style="text-decoration: line-through;">$1</span>',$s);
		$s=preg_replace('/\[url\=(.*)\](.*)\[\/url\]/','<a href="$1">$2</a>',$s);
		$s=preg_replace('/\[url\](.*)\[\/url\]/','<a href="$1">$2</a>',$s);
		$s=preg_replace('/\[code\](.*)\[\/code\]/','<pre>$1</pre>',$s);*/
		
		return $s;
	}
	
	$_SESSION['meta'] = array(
		'picture' => 'http://gamemaker.mooo.com'.$user_info['picture'],
		'picture_w' => $picture_size[0],
		'picture_h' => $picture_size[1],
		'description' => strip_tags($user_info['description'])
	);
	
	$page_title = $user_info['username'];
	include("default-top.php");
?>

				<div class="container dark" style="width: 295px; min-height: 500px; margin-right: 15px;">
					<div class="container-title"><?php
	echo $user_info['username']; if ($user_info['type']==2) echo ' (Administrator)'; if ($user_info['type']==3) echo ' (Moderator)';
?> <span class="last-active last-active-<?php
	echo strtolower($user_info['state']);
?>" title="<?php echo gettext('Last active'); ?>: <?php
	if ($user_info['last_active']>0) echo time_elapsed_string($user_info['last_active']);
?>

<?php echo gettext('Local time'); ?>: <?php
	if ($user_info['time_offset']!=-1) echo date('d F Y H:i:s',time()-$utc_offset-60*$user_info['time_offset']);
	if ($user_info['time_zone']!='') echo ' ('.$user_info['time_zone_nice'].')';
?>" data-datetime="<?php
	if ($user_info['last_active']>0) echo date('Y-m-d H:i:s',strtotime($user_info['last_active'])); ?>"><?php echo $user_info['state']; ?></span></div>
					<?php
	if (!empty($user_info['picture'])) {
		?><img style="width: 100%; max-width: <?php
			echo min($picture_size[0],550/$picture_size[1]*$picture_size[0]);
		?>px; margin: 0 <?php
			echo $picture_size[0]>=300 ? 'auto' : '0';
		?> -10px; display: block;" alt="<?php
			echo htmlspecialchars($user_info['username']);
		?>" src="<?php
			echo str_replace('/original/','/large/',$user_info['picture']);
		?>"><?php
	}
?>

					<div class="smallfont user-details" style="color: #CDCDCD; word-wrap: break-word; padding: 23px 0;">
						<strong><?php echo gettext('Name'); ?>: </strong><?php
if (!empty($user_info['firstname'])||!empty($user_info['lastname'])) {
	echo htmlspecialchars("{$user_info['firstname']} {$user_info['lastname']}");
}
if (!empty($_SESSION['username'])&&$user_info['username']==$_SESSION['username']) {
	?> (<a href="/my_account"><?php echo gettext('Edit my details'); ?></a>)<?php
}
if ($user_info['options']&1) { ?>

						<br><strong><?php echo gettext('Age'); ?>: </strong><?php
	echo floor((time()-strtotime($user_info['date_of_birth']))/31556926);
} ?>

						<br><strong><?php echo gettext('Location'); ?>: </strong><?php
if (!empty($user_info['location'])) {
	echo htmlspecialchars($user_info['location']);
}

/*if ($user_info['time_offset']!=-1) { ?>
						<br><strong>Local time: </strong><?php
	echo date('d F Y H:i:s',time()+3600+60*$user_info['time_offset']);
}*/?>

						<br><?php
if (!empty($user_info['description'])) {
	echo $Parsedown->setBreaksEnabled(true)->text("**".gettext('Description').":**\r\n".filter_tags($user_info['description']));
}

if (!empty($user_info['registered'])) { ?>
						<strong><?php echo gettext('Registered'); ?>: </strong><?php
	echo date('d F Y',strtotime(htmlspecialchars($user_info['registered'])));
} ?><br><br>
						
						<a href="/forums/users/<?php echo $user_info['id']; ?>"><?php echo gettext('View user\'s forum profile') ?></a>
					</div>
					
					<div style="height: 65px;"></div>
					<div class="member-actions">
<?php
	if (!empty($_SESSION['user_id'])&&$_SESSION['user_id']!=$user_info['id']) {
		$friend_text = gettext('Send friend request');
		$friend1 = $user_info['id'];
		$friend2 = $_SESSION['user_id'];
		$result = mysqli_query($con,"SELECT * FROM friends WHERE (friend1 = $friend1 AND friend2 = $friend2) OR (friend1 = $friend2 AND friend2 = $friend1)");
		if (mysqli_num_rows($result)>=1) {
			$row = mysqli_fetch_assoc($result);
			if ($row['approved']==1) {
				$friend_text = gettext('Remove as friend');
			} else {
				$friend_text = gettext('Cancel friend request');
			}
		}
?>
						<a class="dark-inset-button-alt" href="<?php echo $language_url; ?>/users/<?php echo $user_info['username']; ?>/friend"><span class="fa fa-user" style="margin-right: 12px;"></span><?php echo $friend_text; ?></a>
						<a class="dark-inset-button-alt" href="/messages/compose?to=<?php echo urlencode($user_info['username']); ?>"><span class="fa fa-envelope" style="margin-right: 10px;"></span><?php echo gettext('Send personal message'); ?></a>
<?php
	} else {
?>
						<div class="dark-inset-button-alt"><span class="fa fa-user" style="margin-right: 12px;"></span><?php echo gettext('Send friend request'); ?></div>
						<div class="dark-inset-button-alt"><span class="fa fa-envelope" style="margin-right: 10px;"></span><?php echo gettext('Send personal message'); ?></div>
<?php
	}
	
	if (!empty($_SESSION['user_id'])) {
?>
						<a class="dark-inset-button-alt" href="/report/user/<?php echo $user_info['id'] ?>"><span class="fa fa-times" style="margin-right: 12px;"></span><?php echo gettext('Report'); ?></a>
<?php
	} else {
?>
						<div class="dark-inset-button-alt" href="/report/user/<?php echo $user_info['id'] ?>"><span class="fa fa-times" style="margin-right: 12px;"></span><?php echo gettext('Report'); ?></div>
<?php
	}
?>
					</div>
				</div>
<?php
	$me = !empty($_SESSION['user_id'])&&$_SESSION['user_id']==$user_info['id'];
	
	$friend1 = $user_info['id'];
	$result = mysqli_query($con,"SELECT * FROM ((SELECT *, friend2 AS other FROM friends WHERE approved = 1 AND friend1 = $friend1) UNION
								                (SELECT *, friend1 AS other FROM friends WHERE approved = 1 AND friend2 = $friend1)) AS x
								ORDER BY (SELECT MIN(UNIX_TIMESTAMP(last_active)) FROM users WHERE id = other) DESC");
	if (!$result) {
		echo mysqli_error($con);
	}
	if (($me&&mysqli_num_rows($result)==0)&&!empty($_SESSION['logged_in'])) {
?>
				<div class="container dark" style="width: 295px; min-height: 0; margin-right: 15px; clear: left;">
					<div class="container-title"><?php echo ngettext('Friend','Friends',2); ?></div>
					<div class="item smallfont2" style="text-align: center; margin: 2em 0 2em; border-top: 1px solid transparent;">
						<?php echo gettext('You haven\'t added any friends yet.'); ?>
					</div>
				</div>
<?php
	} elseif (mysqli_num_rows($result)>=1&&!(empty($_SESSION['logged_in'])&&mysqli_num_rows($result)==0)) {
?>
				<div class="container dark" style="width: 295px; min-height: 0; margin-right: 15px; clear: left;">
					<div class="container-title"><?php echo ngettext('Friend','Friends',2); ?></div>
					<div class="friends items even-odd-dark seperators" style="max-height: 223px; overflow: auto;">
<?php
	while($row = mysqli_fetch_assoc($result)) {
		if ($row['friend1']==$friend1) {
			$friend_id = $row['friend2'];
		} else {
			$friend_id = $row['friend1'];
		}
		$friend = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM users WHERE id = $friend_id"));
		if ($friend['picture']=='') {
			$friend['picture'] = $no_picture;
		}
		
		if (time() - strtotime($friend['last_active']) < 600) {
			$friend['state'] = 'Online';
		} else {
			$friend['state'] = 'Offline';
		}
?>
						<div class="friend item">
							<div class="user-link">
								<a href="<?php echo $language_url; ?>/users/<?php echo $friend['username']; ?>">
									<div class="picture-alt" style="background-image: url('<?php echo str_replace('/original/','/thumb/',$friend['picture']); ?>');"></div>
									<?php echo $friend['username']; ?></a>
								<span class="last-active last-active-<?php echo strtolower($friend['state']); ?>" title="<?php echo gettext('Last active'); ?>: <?php
	if ($friend['last_active']>0) echo time_elapsed_string($friend['last_active']); ?>" data-datetime="<?php
	if ($friend['last_active']>0) echo date('Y-m-d H:i:s',strtotime($friend['last_active'])); ?>"><?php echo $friend['state']; ?></span><br>
								<?php echo $friend['location']; ?>

								<div style="clear: both;"></div>
							</div>
						</div>
<?php
	}
?>
					</div>
				</div>
<?php
	}
?>
				<div class="container dark" style="width: 295px; min-height: 217px; margin-right: 15px; clear: left;">
					<div class="container-title"><?php echo ngettext('Comment','Comments',2); ?>
						<a class="arrow-link" href="<?php echo $_SERVER['REQUEST_URI']; ?>/all_comments" title="<?php echo gettext('View all comments (also use to report comments)'); ?>"></a>
					</div>
<?php
	$id = mysql_escape_string($user_info['id']);
	$result = mysqli_query($con,"SELECT * FROM comments WHERE type = 1 AND place = $id AND author!=0 AND domain = '{$_SESSION['domain']}' ORDER BY id DESC");
?>
					<div class="even-odd-dark seperators comments items">
<?php
	while($row = mysqli_fetch_assoc($result)) {
		$comment_author_id = mysql_escape_string($row['author']);
		$comment_author = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM users WHERE id = $comment_author_id"));
		if ($comment_author['picture']=='') {
			$comment_author['picture'] = $no_picture;
		}
?>
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
					<div class="comment item" style="text-align: center; vertical-align: center; height: 94px; line-height: 81px;"><?php echo gettext('No comments yet.'); ?></div>
<?php
	}
?>
					</div>
					<form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post" style="margin-top: 5px; display: block;">
						<textarea name="comment[content]" rows="4" cols="30"<?php if (empty($_SESSION['logged_in'])) echo ' disabled=""'; ?>><?php if (empty($_SESSION['logged_in'])) echo gettext('Please log in to leave a comment.'); ?></textarea>
						<button id="post-comment" style="box-sizing: border-box; width: 120px; float: right;"<?php if (empty($_SESSION['logged_in'])) echo ' disabled=""'; ?>><?php echo gettext('Post comment'); ?></button>
<?php
	if (!empty($_SESSION['username'])&&$user_info['username']!=$_SESSION['username']) {
?>
						<label style="display: inline-block; overflow: hidden; max-width: 174px; text-overflow: ellipsis; white-space: nowrap;"><input checked="checked" name="comment[subscribe]" type="checkbox" value="1" style="margin-left: 0;"></input> <span class="smallfont2"><?php echo gettext('Follow') . ' ' . $user_info['username']; ?></span></label>
<?php
	}
?>
					</form>
				</div>
				<div class="container-lt float-right" style="overflow: auto; float: none;">
					<div class="container-title-lt"><?php echo gettext('Games by this creator'); ?></div>
<?php
	if (!empty($_SESSION['betabeta'])||$version_info['gamemaker_sandbox']>=3) {
		$author_id = mysql_escape_string($user_info['id']);
		$result = mysqli_query($con,"SELECT * FROM games WHERE author = $author_id ORDER BY id DESC");
?>
					<div class="games items" style="max-height: 300px; overflow: auto;" data-columns="2">
<?php
		while($row = mysqli_fetch_assoc($result)) {
			$game_author_id = mysql_escape_string($row['author']);
			$game_author = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM users WHERE id = $game_author_id"));
			?><div class="game item">
				<a href="<?php echo $language_url; ?>/games/<?php echo $row['id'].'-'.slugify($row['name']); ?>">
					<div class="picture-large" style="background-image: url('<?php echo htmlspecialchars(str_replace('/original/','/large/',$row['picture'])); ?>');"></div>
					<div class="name-box">
						<div class="name-box-bg" style="background-image: url('<?php echo htmlspecialchars(str_replace('/original/','/large/',$row['picture'])); ?>');"></div>
						<span class="name"><?php echo $row['name'] ?></span>
					</div>
				</a>
				<span style="font-size: .7em;"><?php echo gettext('By'); ?> <a href="<?php echo $language_url; ?>/users/<?php echo $game_author['username']; ?>"><?php echo $game_author['username']; ?></a></span><br>
				
				<ul class="star-rating"><li class="current-rating" style="width: <?php echo $row['rating']*60/5; ?>px; padding: 0;"><?php echo gettext('Rating'); ?>: <?php echo $row['rating']; ?>/5.</li></ul>
			</div><?php
		}
		if (mysqli_num_rows($result)==0) { ?>
						<div class="item" style="text-align: center; height: 130px; line-height: 130px;"><?php echo gettext('No games yet.'); ?></div>
<?php
		}
?>
					</div>
<?php
	}
?>
				</div>
				<div class="container-seamless" style="overflow: auto; float: none;">
					<div class="category-seamless container-lt" style="min-height: 70px; border-style: solid; border-color: transparent; background-color: transparent; border-radius: 0; box-shadow: none;">
						<div class="container-title-lt" style="background-color: transparent;"><?php echo gettext('Favorite games'); ?></div>
<?php
	$author_id = mysqli_escape_string($con,$user_info['id']);
	$_result = mysqli_query($con,"SELECT * FROM favorites WHERE author = $author_id ORDER BY id DESC");
	
	while($row = mysqli_fetch_assoc($_result)) {
		$result = mysqli_query($con,"SELECT * FROM games WHERE id = '{$row['place']}' ORDER BY id DESC");
		$row = mysqli_fetch_assoc($result);
		$game_author_id = mysqli_escape_string($con,$row['author']);
		$game_author = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM users WHERE id = $game_author_id"));
		?><div class="game-label item">
			<a href="<?php echo $language_url; ?>/games/<?php echo $row['id'].'-'.slugify($row['name']); ?>">
				<div class="name-box">
					<div class="name-box-bg" style="background-image: url('<?php echo htmlspecialchars(str_replace('/original/','/large/',$row['picture'])); ?>');"></div>
					<span class="name"><?php echo $row['name']; ?></span>
				</div>
			</a>
			<span style="font-size: .7em;"><?php echo gettext('By'); ?> <a href="<?php echo $language_url; ?>/users/<?php echo $game_author['username']; ?>"><?php echo $game_author['username']; ?></a></span><br>
			
			<ul class="star-rating"><li class="current-rating" style="width: <?php echo $row['rating']*60/5; ?>px; padding: 0;"><?php echo gettext('Rating'); ?>: <?php echo $row['rating']; ?>/5.</li></ul>
		</div><?php
	}
?>
					</div>
					<div class="category-seamless container-lt float-right" style="min-height: 70px; border-style: solid; border-color: transparent; background-color: transparent; border-radius: 0; box-shadow: none;">
						<div class="container-title-lt" style="background-color: transparent;"><?php echo gettext('Recently played games'); ?></div>
<?php
	$author_id = mysql_escape_string($user_info['id']);
	$_result = mysqli_query($con,"SELECT * FROM downloads WHERE type = 1 AND author = $author_id ORDER BY id DESC");
	
	$games_listed = array();
	
	while($row = mysqli_fetch_assoc($_result)) {
		$result = mysqli_query($con,"SELECT * FROM uploaded_files WHERE type = 1 AND id = {$row['place']} ORDER BY id DESC");
		$row = mysqli_fetch_assoc($result);
		
		if (isset($row['place'])) {
			$result = mysqli_query($con,"SELECT * FROM games WHERE id = '{$row['place']}' ORDER BY id DESC");
			if (!$result) {
				report_error($con,'user.php');
			}
			$row = mysqli_fetch_assoc($result);
			
			if (in_array($row['id'],$games_listed)||empty($row)) {
				continue;
			} else {
				$games_listed[] = $row['id'];
			}
			
			$game_author_id = mysql_escape_string($row['author']);
			$game_author = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM users WHERE id = $game_author_id"));
			?><div class="game-label item">
				<a href="<?php echo $language_url; ?>/games/<?php echo $row['id'].'-'.slugify($row['name']); ?>">
					<div class="name-box">
						<div class="name-box-bg" style="background-image: url('<?php echo htmlspecialchars(str_replace('/original/','/large/',$row['picture'])); ?>');"></div>
						<span class="name"><?php echo $row['name']; ?></span>
					</div>
				</a>
				<span style="font-size: .7em;"><?php echo gettext('By'); ?> <a href="<?php echo $language_url; ?>/users/<?php echo $game_author['username']; ?>"><?php echo $game_author['username']; ?></a></span><br>
				
				<ul class="star-rating"><li class="current-rating" style="width: <?php echo $row['rating']*60/5; ?>px; padding: 0;"><?php echo gettext('Rating'); ?>: <?php echo $row['rating']; ?>/5.</li></ul>
			</div><?php
		}
		
		if (sizeof($games_listed)>=5) {
			break;
		}
	}
?>
					</div>
				</div>
				<div class="container-lt" style="min-height: 99px; overflow: auto; float: none;">
					<div class="container-title-lt"><?php echo gettext('Comments by this member'); ?></div>
					<div class="even-odd seperators comments items">
<?php
	$type_filter = '';
	
	$id = mysql_escape_string($user_info['id']);
	$result = mysqli_query($con,"SELECT * FROM comments WHERE author = $id AND author!=0 AND domain = '{$_SESSION['domain']}'" . $type_filter . " ORDER BY id DESC");
	
	while($row = mysqli_fetch_assoc($result)) {
		$comment_author_id = mysql_escape_string($row['author']);
		$comment_author = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM users WHERE id = $comment_author_id"));
		
		/*if (empty($_SESSION['betabeta'])) {
			$type_filter = ' AND type = 1';
		} else {*/
			$type_filter = '';
		//}
		$place_id = mysql_escape_string($row['place']);
		if ($row['type']==1) {
			$place = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM users WHERE id = $place_id"));
		} elseif ($row['type']==2) {
			$place = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM games WHERE id = $place_id"));
		} elseif ($row['type']==3) {
			$place = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM reviews WHERE id = $place_id"));
			$place['place_info'] = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM games WHERE id = {$place['place']}"));
			$place['picture'] = $place['place_info']['picture'];
		}
		
		if (empty($place['picture'])) {
			$place['picture'] = $no_picture;
		}
?>
						<div class="comment item">
							<div class="user-link-alt" style="height: initial; overflow: hidden;">
								<?php if ($row['type']==1) { ?><a href="<?php echo $language_url; ?>/users/<?php echo htmlspecialchars($place['username']); ?>"><?php
								} elseif ($row['type']==2) { ?><a href="<?php echo $language_url; ?>/games/<?php echo htmlspecialchars($place['id']); ?>"><?php
								} elseif ($row['type']==3) { ?><a href="<?php echo $language_url; ?>/games/<?php echo htmlspecialchars($place['place']); ?>/reviews/<?php echo htmlspecialchars($place['id']); ?>"><?php
								} ?><div class="picture-alt" style="background-image: url('<?php echo str_replace('/original/','/thumb/',$place['picture']); ?>');"></div>
								</a>
								<span class="date-time" title="<?php echo date('d F Y H:i:s',strtotime($row['posted'])-$utc_offset-$time_offset_seconds); ?>"><?php echo ucfirst(time_elapsed_string($row['posted'])); ?></span>
								
								<?php if ($language_abbr=='nl') echo gettext('said'); ?>
								<a href="<?php echo $language_url; ?>/users/<?php echo $comment_author['username']; ?>"><?php echo $comment_author['username']; ?></a>
								<?php echo ($language_abbr!='nl' ? gettext('said') . ' ' : '') . gettext('on') . ' ';
								if ($row['type']==1) { echo gettext('the member'); ?>
								<a href="<?php echo $language_url; ?>/users/<?php echo htmlspecialchars($place['username']); ?>"><?php echo htmlspecialchars($place['username']); ?></a>
								<?php } elseif ($row['type']==2) { echo gettext('the game'); ?>
								<a href="<?php echo $language_url; ?>/games/<?php echo htmlspecialchars($place['id']); ?>"><?php echo htmlspecialchars($place['name']); ?></a>
								<?php } elseif ($row['type']==3) { echo gettext('the review'); ?>
								<a href="<?php echo $language_url; ?>/games/<?php echo htmlspecialchars($place['place']); ?>/reviews/<?php echo htmlspecialchars($place['id']); ?>"><?php echo htmlspecialchars($place['title']); ?></a> <?php echo gettext('on the game') ?>
								<a href="<?php echo $language_url; ?>/games/<?php echo htmlspecialchars($place['place']); ?>"><?php echo htmlspecialchars($place['place_info']['name']); ?></a>
								<?php } ?>
								
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
				</div>
<?php include("default-bottom.php"); ?>
