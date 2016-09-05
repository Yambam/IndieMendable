<?php
	define('indiemendable',true,true);
	require_once "config.php";
	
	$uid = mysqli_real_escape_string($con,$_GET['uid']);
	$result = mysqli_query($con,"SELECT type,uid,info,expiration FROM expiring_links WHERE uid = '$uid'");
	if (!$result) {
		$page_title = "Verification email";
		include("default-top.php");
?>
				<h2>Oops...</h2>
				<p>
					An error occurred: <pre><?php echo mysqli_error($con); ?></pre>
<?php
		include("default-bottom.php");
		exit;
	}
	if (mysqli_num_rows($result)>=1) {
		$row = mysqli_fetch_array($result);
		if (time()<strtotime($row['expiration'])) {
			if (!mysqli_query($con,"UPDATE users SET type = 1 WHERE id = {$row['info']}")) {
				$page_title = "Verification email";
				include("default-top.php");
?>
				<h2>Oops...</h2>
				<p>
					An error occurred: <pre><?php echo mysqli_error($con); ?></pre>
<?php
				include("default-bottom.php");
				exit;
			}
			
			if (!mysqli_query($con,"DELETE FROM expiring_links WHERE uid = '$uid'")) {
				$page_title = "Verification email";
				include("default-top.php");
?>
				<h2>Oops...</h2>
				<p>
					An error occurred: <pre><?php echo mysqli_error($con); ?></pre>
<?php
				include("default-bottom.php");
				exit;
			}
			
			$page_title = "Verification email";
			include("default-top.php");
?>
				<h1>Your account is now activated</h1>
				<p>
					Congratulations! You are now able to <a href="/login">login</a> on this website using your email and password.
<?php
			include("default-bottom.php");
			exit;
		}
	}
	
	$page_title = "Verification email";
	include("default-top.php");
?>
				<h1>Sorry, your link is invalid</h1>
				<p>
					Your verification link is probably outdated, so you can't use it anymore. If you need an account, just make a new one.
<?php
	include("default-bottom.php");
?>