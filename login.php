<?php
	include('config.php');
	$_SERVER['HTTP_REFERER'] = str_replace('/'.$language_abbr,'',$_SERVER['HTTP_REFERER']);
	
	if (!isset($_SESSION['return_url'])||(!empty($_SERVER['HTTP_REFERER'])&&$_SERVER['HTTP_REFERER']!='http://gamemaker.mooo.com/'&&strpos($_SERVER['HTTP_REFERER'],'/login')===FALSE)) {
		$_SESSION['return_url'] = str_replace('http://gamemaker.mooo.com','',$_SERVER['HTTP_REFERER']);
		$_SESSION['return_url_title'] = isset($_SESSION['url_title'][$_SESSION['return_url']]) ? $_SESSION['url_title'][$_SESSION['return_url']] : '';
	} else {
		$_SESSION['return_url'] = '';
		$_SESSION['return_url_title'] = '';
	}
	echo $_SESSION['return_url'];
	
	$page_title = "Log in";
	include("default-top.php");
	include("login_form.php");
	include("default-bottom.php");
?>