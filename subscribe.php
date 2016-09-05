<?php
	define('indiemendable',true,true);
	session_start();
	require_once "config.php";
	
	if (!empty($_SESSION['user_id'])) {
		$type = mysql_escape_string($_GET['type']);
		$id = $_GET['id'];
		$ip = mysql_escape_string($_SERVER['REMOTE_ADDR']);
		$author = $_SESSION['user_id'];
		
		if (empty($_SESSION['betabeta'])&&$version_info['gamemaker_sandbox']<3) {
			header("HTTP/1.1 404 Not Found");
			include("error-404.php");
			exit;
		}
		
		$result = mysqli_query($con,"INSERT INTO subscriptions (type,place,ip,author) VALUES ($type,$id,'$ip',$author)");
		if (!$result) {
			echo mysqli_error($con);
		}
	} else {
		header("Location: http://gamemaker.mooo.com/login", true, 302);
	}
	
	header("Location: " . $_SERVER["HTTP_REFERER"], true, 302);
?>