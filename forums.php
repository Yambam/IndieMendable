<?php
	session_start();
	if (!empty($_GET['user'])&&!stristr($_SERVER['HTTP_USER_AGENT'],'XML Sitemaps Generator')) {
		file_get_contents('http://gamemaker.mooo.com/update-notifications');
		header('Location: http://gamemaker.mooo.com/forums/index.php?action=profile;u=' . $_GET['user']);
		exit;
	}
	if (empty($_GET['user'])) {
		file_get_contents('http://gamemaker.mooo.com/update-notifications');
		header('Location: http://gamemaker.mooo.com/forums/index.php');
		exit;
	}
	
	$page_title = "Forums";
	$minimal = true;
	$doctype = '';
	$css = array('/css/new-website.css');
	include("default-top.php");
?>
				<div id="center" style="margin-top: -67.5px;">
					<h1<?php if ($_SESSION['theme']=='dark') { ?> style="color: white;"<?php } ?>>Coming soon... again...</h1>
					<p>
						Sorry for taking the forums down again (it didn't seem to be used anyway though...), but the forums are constantly causing inconveniences on the main website like not being able to log in on it. Because it KEEPS on crashing.
				</div>
<?php include("default-bottom.php"); ?>
