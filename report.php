<?php
	session_start();
	include('config.php');
	
	if (empty($_SESSION['user_id'])) {
		header("Location: http://gamemaker.mooo.com/login",true,302);
		exit;
	}
	
	if (!empty($_POST)) {
		$type = mysql_escape_string($_SESSION['report']['type']);
		$place = mysql_escape_string($_SESSION['report']['place']);
		$author = mysql_escape_string($_SESSION['user_id']);
		$ip = mysql_escape_string($_SERVER['REMOTE_ADDR']);
		$content = mysql_escape_string($_POST['report']['reason']);
		mysqli_query($con,"INSERT INTO reported (type,place,author,ip,content) VALUES ('$type','$place','$author','$ip','$content')");
		$_SESSION['message'] = str_replace('Your user','This user','Your ' . $_SESSION['report']['type']) . ' has been reported to the staff. Thank you for your feedback.';
		unset($_SESSION['report']);
		header("Location: " . $_SERVER['HTTP_REFERER'],true,302);
	} else {
		$_SESSION['report'] = $_GET;
		$_SESSION['report_url'] = $_SERVER['HTTP_REFERER'];
		header("Location: " . $_SERVER['HTTP_REFERER'],true,302);
	}
?>