<?php
	require_once "config.php";
	
	$uid = mysqli_real_escape_string($con,$_GET['uid']);
	$result = mysqli_query($con,"SELECT type,uid,info,expiration FROM expiring_links WHERE uid = '$uid'");
	if (!$result) {
		echo mysqli_error($con);
		exit;
	}
	if (mysqli_num_rows($result)==0) {
		echo "UID cannot be found ($uid).";
		exit;
	}
	$row = mysqli_fetch_array($result);
	if ($row['type']!='reset_password') {
		echo "Sorry, but this isn't the UID of a forgot password link ({$row['type']}).";
		exit;
	}
	
	$username = mysqli_real_escape_string($con,$row['info']);
	$result = mysqli_query($con,"SELECT email FROM users WHERE username = '$username'");
	$row = mysqli_fetch_array($result);
	$email = $row['email'];
	if (!$result) {
		echo mysqli_error($con);
		exit;
	}
	if (mysqli_num_rows($result)==0) {
		exit;
		echo "User cannot be found ($username).";
	}
	
	$headers  = "From: IndieMendable <info@gamemaker.mooo.com>\r\n";
	$headers .= "To: $email\r\n";
	
	mail($email, "Reset password", "If you want to reset your password click this link (expires in 48 hours): http://gamemaker.mooo.com/forgot_password?uid={$_GET['uid']}

If you did not click \"Reset password\", simply don't click the link.", $headers);
?>