<?php
	session_start();
	require_once "config.php";
	
	if (empty($_SESSION['betabeta'])&&$version_info['gamemaker_sandbox']<3) {
		header("HTTP/1.1 404 Not Found");
		/*print_r($_SESSION['betabeta']);*/
		include("error-404.php");
		exit;
	}
	
	$game_id = mysql_escape_string(explode('/',$_GET['q'])[0]);
	$result = mysqli_query($con,"SELECT * FROM games WHERE id = '$game_id'");
	if (mysqli_num_rows($result) >= 1) {
		$game_info = mysqli_fetch_array($result);
		$game_info['tags'] = explode(',',$game_info['tags']);
		for($i=0;$i<sizeof($game_info['tags']);$i+=1) {
			$game_info['tags'][$i] = preg_replace('/\s*(.*)\s*/','$1',$game_info['tags'][$i]);
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
				<div class="container-lt" style="overflow: auto; float: none;">
					<div class="container-title-lt">Reviews for <a href="/games/<?php echo htmlspecialchars($game_info['id']); ?>"><?php echo htmlspecialchars($game_info['name']); ?></a></div>
<?php
	if (!empty($_SESSION['betabeta'])||$version_info['gamemaker_sandbox']>=2) {
		$id = mysql_escape_string($game_info['id']);
		$result = mysqli_query($con,"SELECT * FROM reviews WHERE type = 1 AND place = $id ORDER BY id DESC");
?>
					<div class="reviews items even-odd" data-per-page="5" style="max-height: 734px; overflow: auto;">
<?php
		while($row = mysqli_fetch_assoc($result)) {
			for($i=0;$i<8;$i+=1) {
			$comment_author_id = mysql_escape_string($row['author']);
			$comment_author = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM users WHERE id = $comment_author_id"))
?>
						<div class="review item smallfont">
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
								<p>
									<?php echo htmlspecialchars(strlen($row['body'])>103 ? substr($row['body'],0,100) . '...' : $row['body']); ?>
								<p style="text-align: right;">
									<a href="/games/<?php echo $game_info['id'] ?>/reviews/<?php echo $row['id']; ?>">Read full review</a>
							</div>
						</div>
<?php
			}
		}
		if (mysqli_num_rows($result)==0) { ?>
						<div class="item" style="text-align: center; vertical-align: center; height: 94px; line-height: 94px;">No reviews yet.</div>
<?php
		} else {
?>
						<a class="pseudo-page-number smallfont2" href="/games/<?php echo $game_info['id'] ?>/reviews/make">Add your own review</a>
<?php
		}
?>
					</div>
<?php
	}
?>
				</div>
<?php include("default-bottom.php") ?>