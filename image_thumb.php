<?php
	/*$thumb = new Imagick(dirname(__FILE__) . '/' . str_replace($_GET['type'],'original',$_GET['q']));
	$thumb->resizeimage(320,240,Imagick::FILTER_LANCZOS,1);
	
	header("Content-Type: image/{$thumb->getimageFormat()}");
	$data = $thumb->getimageBlob();
	echo $data;

	$thumb->destroy();*/
	
	$type = $_GET['type'];
	
	$max_size = 60;
	if ($type=='extra-small') {
		$max_size = 30;
	}
	if ($type=='medium') {
		$max_size = 200;
	}
	if ($type=='large') {
		$max_size = 400;
	}
	if ($type=='larger') {
		$max_size = 720;
	}
	
	function file_force_contents($dir, $contents, $echo = false) {
		$parts = explode('/', $dir);
		$file = array_pop($parts);
		if ($file === "") {
			return;// $file = "index.html";
		}
		
		$dir = '';
		foreach($parts as $part) {
			$dir .= "$part/";
			if (!is_dir($dir)) mkdir($dir);
		}
		
		//file_put_contents("$dir$file", fopen($contents, "r"));
		file_put_contents("$dir$file", $contents);
		if ($echo) {
			echo $contents;
		}
	}
	
	//$_GET['q'] = str_replace(basename($_GET['q']),urlencode(basename($_GET['q'])),$_GET['q']);
	$image_fname = implode('.',array_slice(explode('.',dirname(__FILE__) . '/' . $_GET['q']),0,-1)).'.png';
	$file_type = 'png'; //array_pop(explode('.',$image_fname));
	if (file_exists($image_fname)) {
		$size = getimagesize($image_fname);
	} else {
		$image_fname = dirname(__FILE__) . '/' . str_replace($_GET['type'],'original',$_GET['q']);
		$file_type = array_pop(explode('.',$image_fname));
		$size = getimagesize($image_fname);
	}
	
	if ($file_type=="gif"&&$type!="original") {
		header("Location: http://gamemaker.mooo.com".str_replace("/$type/","/original/",$_SERVER['REQUEST_URI']), true, 302);
		exit;
	} elseif (($size[0]>$max_size||$size[1]>$max_size)) {
		if ($size[0]>$size[1]) {
			$width = $max_size;
			$height = round($width*$size[1]/$size[0]);
		} else {
			$height = $max_size;
			$width = round($height*$size[0]/$size[1]);
		}
		$image_orig = imageCreateFromString(file_get_contents($image_fname));
		imageAlphaBlending($image_orig,false);
		imageSaveAlpha($image_orig,true);
		$photoX = imagesX($image_orig);
		$photoY = imagesY($image_orig);
		$image_new = imageCreateTrueColor($width,$height);
		imageAlphaBlending($image_new,false);
		imageSaveAlpha($image_new,true);
		imageCopyResampled($image_new,$image_orig,0,0,0,0,$width,$height,$photoX,$photoY);
		
		ob_start();
		header('Content-Type: image/png');
		imagePNG($image_new);
		file_force_contents(implode('.',array_slice(explode('.',dirname(__FILE__) . '/' . $_GET['q']),0,-1)).'.png',ob_get_clean(),true);
		
		imageDestroy($image_orig);
		imageDestroy($image_new);
	} else {
		if ($file_type=='jpg') {
			header('Content-Type: image/jpeg');
		} elseif (in_array($file_type,array('bmp','jpeg','png','gif'))) {
			header('Content-Type: image/' . $file_type);
		}
		echo file_get_contents($image_fname);
	}
?>