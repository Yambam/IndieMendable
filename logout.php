<?php
	include('config.php');
	//session_start();
	//session_destroy();
	unset($_SESSION['logged_in']);
	unset($_SESSION['username']);
	unset($_SESSION['user_id']);
	unset($_SESSION['betabeta']);
	
	setcookie('SMFCookie378','none',1,'/');
	
	header("Location: http://gamemaker.mooo.com$language_url/", true, 302);
?>