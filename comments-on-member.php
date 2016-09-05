<?php
	session_start();
	require_once "config.php";
	
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
	comment_add($con,$user_info);
	
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
	
	$page_title = "Comments on ".$user_info['username']."'".(strtolower(substr($user_info['username'],-1,1))!='s' ? 's' : '')." profile";
	include("default-top.php");
?>

				<div class="container dark" style="box-sizing: border-box; width: 100%;/* min-height: 500px;*/">
					<div class="container-title">Viewing comments on <a href="/users/<?php echo $user_info['username']?>"><?php
	echo $user_info['username'] . "'" . (strtolower(substr($user_info['username'],-1,1))!='s' ? 's' : '');
?></a> profile <span class="last-active last-active-<?php
	echo strtolower($user_info['state']);
?>" title="Last active: <?php
	if ($user_info['last_active']>0) echo time_elapsed_string($user_info['last_active']);
?>

Local time: <?php
	if ($user_info['time_offset']!=-1) echo date('d F Y H:i:s',time()-3600-60*$user_info['time_offset']);
	if ($user_info['time_zone']!='') echo ' ('.$user_info['time_zone_nice'].')';
?>"><?php echo $user_info['state']; ?></span></div>
					<?php
	if (!empty($user_info['picture'])) {
		?><img style="width: 100%; max-width: <?php
			echo min($picture_size[0],720/$picture_size[1]*$picture_size[0]);
		?>px; margin: 0 <?php
			echo $picture_size[0]>=300 ? 'auto' : '0';
		?> -10px; display: block;" alt="<?php
			echo htmlspecialchars($user_info['username']);
		?>" src="<?php
			echo str_replace('/original/','/larger/',$user_info['picture']);
		?>"><?php
	}
?>
					<div class="smallfont user-details" style="color: #CDCDCD; word-wrap: break-word; padding: 23px 0;">
						<br><strong>Name: </strong><?php
if (!empty($user_info['firstname'])||!empty($user_info['lastname'])) {
	echo htmlspecialchars("{$user_info['firstname']} {$user_info['lastname']}");
}
if (!empty($_SESSION['logged_in'])&&$user_info['username']==$_SESSION['username']) {
	?> (<a href="/my_account">Edit my details</a>)<?php
}
if ($user_info['options']&1) { ?>

						<br><strong>Age: </strong><?php
	echo floor((time()-strtotime($user_info['date_of_birth']))/31556926);
} ?>

						<br><strong>Location: </strong><?php
if (!empty($user_info['location'])) {
	echo htmlspecialchars($user_info['location']);
} ?>

						<br><?php
if (!empty($user_info['description'])) {
	echo $Parsedown->setBreaksEnabled(true)->text("**Description:**\r\n".$user_info['description']);
}

if (!empty($user_info['registered'])) { ?>
						<br><strong>Registered: </strong><?php
	echo date('d F Y',strtotime(htmlspecialchars($user_info['registered'])));
} ?><br><br>
						
						<a href="/forums/users/<?php echo $user_info['id']; ?>">View User's Forum Profile</a>
					</div>
				</div>
				<div class="container dark" style="box-sizing: border-box; width: 100%; min-height: 217px;">
					<div class="container-title">Comments</div>
<?php
	$id = mysql_escape_string($user_info['id']);
	$result = mysqli_query($con,"SELECT * FROM comments WHERE type = 1 AND place = $id AND domain = '{$_SESSION['domain']}' AND author!=0 ORDER BY id DESC");
?>
					<div class="even-odd-dark seperators comments items" data-per-page="7">
<?php
	while($row = mysqli_fetch_assoc($result)) {
		$comment_author_id = mysql_escape_string($row['author']);
		$comment_author = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM users WHERE id = $comment_author_id"));
		if ($comment_author['picture']=='') {
			$comment_author['picture'] = $no_picture;
		}
?>
						<div class="comment item">
							<?php
	if (!empty($_SESSION['logged_in'])) {
		?><div class="extra-options smallfont2">
			<a href="<?php echo "/users/{$user_info['username']}/all_comments/report/{$row['id']}" ?>">
				<span class="fa fa-times" style="margin-right: 5px;"></span>Report to staff
			</a>
		</div><?php
	} ?>
							<div class="user-link-alt">
								<a href="/users/<?php echo $comment_author['username']; ?>">
									<div class="picture-alt" style="background-image: url('<?php echo str_replace('/original/','/thumb/',$comment_author['picture']); ?>');"></div>
									<?php echo $comment_author['username']; ?>
								</a> said <span class="date-time" title="<?php echo date('d F Y H:i:s',strtotime($row['posted'])-3600-$time_offset_seconds); ?>"><?php echo time_elapsed_string($row['posted']); ?></span>
							</div>
							<div class="content"><?php echo preg_replace('/&lt;3/','❤',$Parsedown->setBreaksEnabled(true)->text(filter_tags($row['content']))); ?></div>
						</div>
<?php
	}
	if (mysqli_num_rows($result)==0) { ?>
					<div class="comment item" style="text-align: center; vertical-align: center; height: 94px; line-height: 81px;">No comments yet.</div>
<?php
	}
?>
					</div>
					<form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post" style="margin-top: 5px; display: block; height: 113px;">
						<textarea name="comment[content]" rows="4" cols="30"<?php if (empty($_SESSION['logged_in'])) echo ' disabled=""'; ?>><?php if (empty($_SESSION['logged_in'])) echo 'Please log in to leave a comment.'; ?></textarea>
						<input id="post-comment" type="submit" value="Post comment" style="box-sizing: border-box; width: 120px; float: right;"<?php if (empty($_SESSION['logged_in'])) echo ' disabled=""'; ?>>
					</form>
				</div>
				<?php if (empty($_SESSION['logged_in'])) { ?><i class="smallfont2">NOTE: To report a comment, you need to be logged in.</i><?php } ?>

<?php include("default-bottom.php"); ?>
