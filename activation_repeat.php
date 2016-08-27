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
	if ($row['type']!='email_verification') {
		echo "Sorry, but this isn't the UID of an email verification link ({$row['type']}).";
		exit;
	}
	
	$user_id = mysqli_real_escape_string($con,$row['info']);
	$result = mysqli_query($con,"SELECT username,email FROM users WHERE id = $user_id");
	$row = mysqli_fetch_array($result);
	$username = mysqli_real_escape_string($con,$row['username']);
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
	
	mail($email, "Thank you for registering!", "Thank you for registering. In order to complete your registration, please click this link: http://gamemaker.mooo.com/activation?uid={$_GET['uid']}
	
	P.S. This is a repeated email, you should have received a similar email earlier, but I noticed you didn't seem to receive it. If you're still having problems, please contact me at <ima.habekotte@gmail.com>", $headers);
?>