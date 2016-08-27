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
		if (mysqli_num_rows($result) >= 1) {
			$game_author = mysqli_fetch_assoc($result);
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
	
	if (empty($_GET['r'])) {
		$new_rating = 0;
	} else {
		$new_rating = min(5,max(1,intval($_GET['r'])));
	}
	$ip = mysql_escape_string($_SERVER['REMOTE_ADDR']);
	
	$result = mysqli_query($con,"SELECT * FROM favorites WHERE type = 1 AND place = '$game_id' AND author = '{$_SESSION['user_id']}'");
	if (mysqli_num_rows($result)>=1) {
		$row = mysqli_fetch_assoc($result);
		if ($new_rating>0) {
			$result2 = mysqli_query($con,"UPDATE favorites SET rating = '$new_rating', posted = CURRENT_TIMESTAMP WHERE type = 1 AND place = '$game_id' AND author = {$_SESSION['user_id']}");
		} else {
			$result2 = mysqli_query($con,"DELETE FROM favorites WHERE type = 1 AND place = '$game_id' AND author = {$_SESSION['user_info']['id']}");
		}
	} else {
		if (!$result2 = mysqli_query($con,"INSERT INTO favorites (type,place,author,ip,rating) VALUES (1,'$game_id','{$_SESSION['user_info']['id']}','$ip',$new_rating)")) {
			echo mysqli_error($con);
		}
	}
	
	header("Location: " . $_SERVER["HTTP_REFERER"], true, 302);
?>