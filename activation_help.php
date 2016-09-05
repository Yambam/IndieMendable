<?php
	$mail_recipient = 'ido@netboom.co.il';
	$mail_subject = 'Need help activating your account?';
	$mail_content = "Dear idoen,

If you are experiencing trouble activating your account, please contact the administrator using the following email address: ima.habekotte@gmail.com

NOTE: This is automated message, do not try to reply to info@gamemaker.mooo.com! We won't be able to receive your message that way.";
	$mail_headers  = "From: info@gamemaker.mooo.com\r\n";
	$mail_headers .= "Reply-To: ima.habekotte@gmail.com\r\n";
	
	/*
	if (mail($mail_recipient,$mail_subject,$mail_content,$mail_headers)) {
		echo 'To: '.$mail_recipient.'; Subject: "'.$mail_subject.'"; Email sent successfully!';
	}
	exit;
	//*/
	
	echo 'Nothing to send!';
?>
