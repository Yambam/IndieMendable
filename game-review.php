<?php
	session_start();
	require_once "config.php";
	
	if (empty($_SESSION['betabeta'])&&$version_info['gamemaker_sandbox']<3) {
		header("HTTP/1.1 404 Not Found");
		include("error-404.php");
		exit;
	}
	
	$game_id = mysql_escape_string(explode('/',$_GET['q'])[0]);
	$result = mysqli_query($con,"SELECT * FROM games WHERE id = '$game_id'");
	if (mysqli_num_rows($result) >= 1) {
		$game_info = mysqli_fetch_array($result);
		$game_info['tags'] = explode(',',$game_info['tags']);
		for($i=0;$i<sizeof($game_info['tags']);$i+=1) {
			$game_info['tags'][$i] = preg_replace('/^\s*(.*)\s*$/','$1',$game_info['tags'][$i]);
		}
		
		$game_author_id = mysql_escape_string($game_info['author']);
		$result = mysqli_query($con,"SELECT * FROM users WHERE id = '$game_author_id'");
		if (mysqli_num_rows($result)>=1) {
			$game_author = mysqli_fetch_assoc($result);
			if ($game_author['picture']=='') {
				$game_author['picture'] = $no_picture;
			}
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
	
	$review_id = mysql_escape_string($_GET['reviewid']);
	
	$rating_count = 0;
	$rating_given = false;
	$game_info['rating'] = 0;
	$result = mysqli_query($con,"SELECT * FROM ratings WHERE type = 1 AND place = {$game_info['id']}");
	if (mysqli_num_rows($result)>=1) {
		$rating_count = mysqli_num_rows($result);
		while($row = mysqli_fetch_assoc($result)) {
			$game_info['rating'] += $row['rating'];
			if (!empty($_SESSION['user_id'])&&$row['author']==$_SESSION['user_id']) {
				$rating_given = true;
			}
		}
		$game_info['rating'] /= $rating_count;
	}
	mysqli_query($con,"UPDATE games SET rating = {$game_info['rating']} WHERE id = {$game_info['id']}");
	
	$_POST['comment']['type'] = 3;
	comment_add($con,$review_id);
	
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
				<div class="container-lt" style="overflow: auto; float: none;">
					<div class="container-title-lt">Viewing review on <a href="/games/<?php echo htmlspecialchars($game_info['id']); ?>"><?php echo htmlspecialchars($game_info['name']); ?></a></div>
<?php
	$id = mysql_escape_string($game_info['id']);
	$result = mysqli_query($con,"SELECT * FROM reviews WHERE type = 1 AND place = $id AND id = $review_id ORDER BY id DESC");
	
	if (mysqli_num_rows($result)==0) { ?>
					<div class="item" style="text-align: center; margin: 3em 0 3em; border-top: 1px solid transparent;">
						Oops, we couldn't find the review you were looking for.
					</div>
<?php
	} else {
		$row = mysqli_fetch_assoc($result);
		$comment_author_id = mysql_escape_string($row['author']);
		$comment_author = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM users WHERE id = $comment_author_id"))
?>
					<div class="review item">
						<div class="smallfont" style="padding: 5px;">
							<div class="review-star-ratings">
								<div style="background-color: #151515; color: white;">Overall score: <ul class="star-rating-dark"><li class="current-rating" style="width: <?php echo $row['overall_rating']*60/5; ?>px; padding: 0;"><?php echo gettext('Rating'); ?>: <?php echo $row['overall_rating']; ?>/5.</li></ul></div>
<?php
		$result2 = mysqli_query($con,"SELECT * FROM ratings WHERE type = 2 AND place = {$row['id']} ORDER BY id ASC");
		while($row2 = mysqli_fetch_assoc($result2)) {
?>
								<div><?php echo $row2['info']; ?>: <ul class="star-rating"><li class="current-rating" style="width: <?php echo $row2['rating']*60/5; ?>px; padding: 0;"><?php echo gettext('Rating'); ?>: <?php echo $row2['rating']; ?>/5.</li></ul></div>

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
										<strong>Added: </strong><?php echo time_elapsed_string($row['posted']); ?><br>
										<strong>Created by: </strong><a style="font-size: 1em;" href="/users/<?php echo $comment_author['username']; ?>"><?php echo $comment_author['username']; ?></a>
									</span>
								</div>
								<p>
									<strong>Pros: </strong><span><?php echo htmlspecialchars($row['pros']); ?></span><br>
									<strong>Cons: </strong><span><?php echo htmlspecialchars($row['cons']); ?></span>
							</div>
							<div style="clear: both;"></div>
							<p>
								<strong><?php echo htmlspecialchars($row['title']); ?></strong><br>
								<?php echo str_replace("\r\n",'<br>',htmlspecialchars($row['body'])); ?>
							<p style="text-align: right;">
								<a href="/games/<?php echo $game_info['id'] ?>/reviews">View all reviews on this game</a><br>
								<a href="/games/<?php echo $game_info['id'] ?>/reviews/make">Add your own review</a><br>
								<a href="/games/<?php echo $game_info['id'] ?>">Go back to the game</a>
						</div>
							
<?php
		$id = mysql_escape_string($game_info['id']);
		$result = mysqli_query($con,"SELECT * FROM comments WHERE type = 3 AND place = $id AND domain = '{$_SESSION['domain']}' ORDER BY id DESC");
?>
					<div class="even-odd seperators comments items">
<?php
		while($row = mysqli_fetch_assoc($result)) {
			$comment_author_id = mysql_escape_string($row['author']);
			$comment_author = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM users WHERE id = $comment_author_id"))
?>
						<div class="comment item">
							<div class="user-link" style="height: 48px; display: inline-block; margin-right: 4px; vertical-align: top;">
								<a href="/users/<?php echo $comment_author['username']; ?>">
								<div class="picture" style="background-image: url('<?php echo str_replace('/original/','/thumb/',$comment_author['picture']); ?>'); height: 40px; width: 40px;"></div>
								<?php echo $comment_author['username']; ?></a> said <?php echo time_elapsed_string($row['posted']); ?>
							</div>
							<div class="content">
								<?php echo $Parsedown->text($row['content']); ?>
							</div>
						</div>
<?php
		}
		if (mysqli_num_rows($result)==0) { /* ?>
						<div class="comment item smallfont2" style="text-align: center; vertical-align: center; height: 94px; line-height: 94px;">No comments yet.</div>
<?php
*/		}
?>
					</div>
					<form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post" style="margin-top: 5px; display: block; height: 113px;">
						<textarea name="comment[content]" rows="4" cols="30"<?php if (empty($_SESSION['logged_in'])) echo ' disabled=""'; ?>><?php if (empty($_SESSION['logged_in'])) echo 'Please log in to leave a comment.'; ?></textarea>
						<input id="post-comment" type="submit" value="Post comment" style="box-sizing: border-box; width: 120px; float: right;"<?php if (empty($_SESSION['logged_in'])) echo ' disabled=""'; ?>>
					</form>
<?php
	}
?>
					</div>
				</div>
<?php include("default-bottom.php") ?>