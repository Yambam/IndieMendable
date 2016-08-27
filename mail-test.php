<?php
	$headers  = "From: GameMaker Sandbox <info@gamemaker.mooo.com>\r\n";
	$headers .= "To: ima.habekotte@gmail.com\r\n";
	
	mail("ima.habekotte@gmail.com", "Thank you for registering!", "Thank you for registering. In order to complete your registration, please click this link: http://gamemaker.mooo.com/activation?uid=123456", $headers);
?>