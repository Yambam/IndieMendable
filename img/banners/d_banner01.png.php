<?php
	include('../../config.php');
	
	//$_GET['q'] = str_replace(basename($_GET['q']),urlencode(basename($_GET['q'])),$_GET['q']);
	$image_fname = dirname(__FILE__) . '/banner01c.png';
	$size = getimagesize($image_fname);
	
	function imagettftext_cr(&$im, $size, $angle, $x, $y, $color, $fontfile, $text) {
		// retrieve boundingbox
		$bbox = imagettfbbox($size, $angle, $fontfile, $text);
		// calculate deviation
		$dx = ($bbox[2]-$bbox[0])/2.0 - ($bbox[2]-$bbox[4])/2.0;         // deviation left-right
		$dy = ($bbox[3]-$bbox[1])/2.0 + ($bbox[7]-$bbox[1])/2.0;        // deviation top-bottom
		// new pivotpoint
		$px = $x-$dx;
		$py = $y-$dy;
		return imagettftext($im, $size, $angle, $px, $y, $color, $fontfile, $text);
	}
	
	if (true) {
		//$width = $size[0];
		//$height = $size[1];
		$image_orig = imageCreateFromString(file_get_contents($image_fname));
		imageAlphaBlending($image_orig,false);
		imageSaveAlpha($image_orig,true);
		$photoX = imagesX($image_orig);
		$photoY = imagesY($image_orig);
		$image_new = imageCreateTrueColor($photoX,$photoY);
		imageAlphaBlending($image_new,false);
		imageSaveAlpha($image_new,true);
		imageCopyResampled($image_new,$image_orig,0,0,0,0,$photoX,$photoY,$photoX,$photoY);
		
		$result = mysqli_query($con,"SELECT * FROM users_online");
		$count_online = mysqli_num_rows($result);
		
		$result = mysqli_query($con,"SELECT * FROM games WHERE state >= 2 AND domain = 'gamemaker'");
		$count_games = mysqli_num_rows($result);
		
		$result = mysqli_query($con,"SELECT * FROM games WHERE state >= 2 AND domain = 'yoyogames'");
		$count_games_yyg = mysqli_num_rows($result);
		
		$time_start = strtotime(date('d F Y 00:00:00'));
		$result = mysqli_query($con,"SELECT * FROM games WHERE state >= 2 AND UNIX_TIMESTAMP(added) > '$time_start'");
		$count_games_today = mysqli_num_rows($result);
		
		imageAlphaBlending($image_new,true);
		imagettftext_cr($image_new,10,0,$photoX/2,44,imagecolorallocate($image_new,255,255,255),dirname(__FILE__).'/OpenSans-Regular.ttf',"Gebruikers online: $count_online  Games geüpload: $count_games (nieuw: $count_games_today)"); //Archief grootte: $count_games_yyg
		
		ob_start();
		header('Content-Type: image/png');
		imagePNG($image_new);
		echo ob_get_clean();
		
		imageDestroy($image_orig);
		imageDestroy($image_new);
	} else {
		header('Content-Type: image/png');
		echo file_get_contents($image_fname);
	}
?>