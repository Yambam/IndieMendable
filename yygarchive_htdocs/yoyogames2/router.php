<?php
	function system_extension_mime_types() {
		# Returns the system MIME type mapping of extensions to MIME types, as defined in /etc/mime.types.
		$out = array();
		$file = fopen('/etc/mime.types', 'r');
		while(($line = fgets($file)) !== false) {
			$line = trim(preg_replace('/#.*/', '', $line));
			if(!$line)
				continue;
			$parts = preg_split('/\s+/', $line);
			if(count($parts) == 1)
				continue;
			$type = array_shift($parts);
			foreach($parts as $part)
				$out[$part] = $type;
		}
		fclose($file);
		return $out;
	}

	function system_extension_mime_type($file) {
		# Returns the system MIME type (as defined in /etc/mime.types) for the filename specified.
		#
		# $file - the filename to examine
		static $types;
		if(!isset($types))
			$types = system_extension_mime_types();
		$ext = pathinfo($file, PATHINFO_EXTENSION);
		if(!$ext)
			$ext = "html";
		$ext = strtolower($ext);
		return isset($types[$ext]) ? $types[$ext] : null;
	}

	function system_mime_type_extensions() {
		# Returns the system MIME type mapping of MIME types to extensions, as defined in /etc/mime.types (considering the first
		# extension listed to be canonical).
		$out = array();
		$file = fopen('/etc/mime.types', 'r');
		while(($line = fgets($file)) !== false) {
			$line = trim(preg_replace('/#.*/', '', $line));
			if(!$line)
				continue;
			$parts = preg_split('/\s+/', $line);
			if(count($parts) == 1)
				continue;
			$type = array_shift($parts);
			if(!isset($out[$type]))
				$out[$type] = array_shift($parts);
		}
		fclose($file);
		return $out;
	}

	function system_mime_type_extension($type) {
		# Returns the canonical file extension for the MIME type specified, as defined in /etc/mime.types (considering the first
		# extension listed to be canonical).
		#
		# $type - the MIME type
		static $exts;
		if(!isset($exts))
			$exts = system_mime_type_extensions();
		return isset($exts[$type]) ? $exts[$type] : null;
	}
	
	function file_force_contents($dir, $contents) {
		$parts = explode('/', $dir);
		$file = array_pop($parts);
		if ($file === "") {
			$file = "index.html";
		}
		
		$dir = '';
		foreach($parts as $part) {
			$dir .= "$part/";
			if (!is_dir($dir)) mkdir($dir);
		}
		
		//file_put_contents("$dir$file", fopen($contents, "r"));
		file_put_contents("$dir$file", $contents);
	}
	
	function allowed_chars_dir($fname) {
		$fname = $_SERVER['DOCUMENT_ROOT'] . '/original' . $fname;
		$fname = str_replace('?lang=nl', '', $fname);
		$fname = str_replace('&lang=nl', '', $fname);
		$fname = str_replace('?refresh=1', '', $fname);
		$fname = str_replace('&refresh=1', '', $fname);
		$parts = explode('?', $fname);
		$test = array_pop($parts);
		if (is_numeric($test) || substr($test, 0, 5) == 'code=') {
			$fname = implode($parts);
		}
		$fname = str_replace('?', '_', $fname);
		
		$file = end(explode('/', $fname));
		if ($file === "") {
			$fname .= "index.html";
			$file = "index.html";
		}
		if (!pathinfo($file, PATHINFO_EXTENSION)) {
			$fname .= ".html";
		}
		
		return $fname;
	}
		
	// Modifications
	function modify($body_new, $request, $fname) {
		//include('nederlands.php');
		
		// Cache-related additions
		if (strpos($request, '?')) {
			$alt_url = $request . '&refresh=1';
		} else {
			$alt_url = $request . '?refresh=1';
		}
		if (is_file($fname)) {
			$last_updated = date('Y-m-d H:i', filemtime($fname));
		} else {
			$last_updated = date('Y-m-d H:i') . ' (new!)';
		}
		$body_new = preg_replace(
		'/<li class="last"><a href="(.*)">(.*)<\/a><\/li>/',
		'<li><a href="$1">$2</a></li> <li class="last"><a href="' . $alt_url . '" title="Last refresh of this page: ' . $last_updated . '">Refresh</a></li>', $body_new, 1);
		
		return $body_new;
	}
	
	$debug = "";
	
	$request = $_SERVER['REQUEST_URI'];
	$request = str_replace('/members', '/users', $request);
	
	$redirect = false;
	$redirect_location = '';
	
	$offline = true;
	$fast = true;
	$fast_html = true;
	$fname = allowed_chars_dir($request);
	$fname_ext = pathinfo($fname, PATHINFO_EXTENSION);
	
	//$debug .= $fname;
	
	// Refresh parameter
	$refresh = array_key_exists('refresh', $_GET) && $_GET['refresh'] == 1;
	if ($refresh) {
		$redirect = true;
		$redirect_location = str_replace('&refresh=1', '', $_SERVER['REQUEST_URI']);
		$redirect_location = preg_replace('/(.*)\?refresh=1/', '$1', $redirect_location);
		$redirect_location = str_replace('refresh=1&', '', $redirect_location);
	}
	
	// Download new file after 12 hours, or if the 'refresh' parameter is given
	if ((is_file($fname) && time() - filemtime($fname) > 43200) || $refresh) {
		$fast = false;
		$fast_html = false;
	}
	
	if ($offline || (is_file($fname) && (pathinfo($fname, PATHINFO_BASENAME) == 'download.html' ? false : ($fname_ext == 'html' ? $fast_html : $fast)))) {
		$fp = false;
	} else {
		$fp = fsockopen("sandbox.yoyogames.com", 80, $errno, $errstr, 30);
	}
	if (!$fp) {
		if (is_file($fname)) {
			header("Content-type: " . system_extension_mime_type($fname));
			$body = file_get_contents($fname);
			if ($fname_ext == "html") {
				$body = modify($body, $request, $fname);
			}
			
			echo $body;
		} else {
			echo "<b>404 Not found</b>";
		}
	} else {
		/*if (empty($_POST)) {
			$out = "GET {$request} HTTP/1.1\r\n";
			$out .= "Host: sandbox.yoyogames.com\r\n";
			$out .= "Connection: Close\r\n\r\n";
			fwrite($fp, $out);
		} else {
			$out = "POST {$request} HTTP/1.1\r\n";
			$out .= "Host: sandbox.yoyogames.com\r\n";
			$out .= "Content-type: application/x-www-form-urlencoded\r\n";
			$out .= "Connection: Close\r\n\r\n";
			
			$out .= $_SERVER['QUERY_STRING'] . "\r\n";
			$out .= file_get_contents('php://input');
			
			fwrite($fp, $out);
			$debug = $out;
		}*/
		
		// Apache request headers
		$headers = apache_request_headers();
		$header_filter = array('Accept-Encoding');
		
		$out = "{$_SERVER['REQUEST_METHOD']} $request HTTP/1.1\r\n";
		foreach ($headers as $header => $value) {
			if (!in_array($header, $header_filter)) {
				$out .= str_replace('www.yoyogames.com', 'sandbox.yoyogames.com', "$header: $value\r\n");
			}
		}
		
		// Apache request content
		$out .= "\r\n" . file_get_contents('php://input');
		
		// Request YoYo Games
		fwrite($fp, $out);
		$debug .= $out . "\r\n\r\n";
		
		// Receive from YoYo Games
		$str = "";
		while (!feof($fp)) {
			$str_part = str_replace('sandbox.yoyogames.com', 'www.yoyogames.com', fgets($fp));
			$str_part = str_replace('/images/layout/logo.png', '/images/layout/logo.gif', $str_part);
			$str .= $str_part;
		}
		fclose($fp);
		
		// Split headers and body
		$pos = strpos($str, "\r\n\r\n");
		$header = substr($str, 0, $pos);
		$body = substr($str, $pos + 4);
		
		// Decompress gzip if necessary
		if (strpos($header, 'Content-Encoding: gzip') === 0) {
			$body_raw = gzuncompress($body);
		} else {
			$body_raw = $body;
		}
		
		// Send headers
		if (!$redirect) {
			$header_split = explode("\r\n", $header);
			foreach($header_split as $part) {
				if ($part != "" && substr($part, 0, 16) != "Content-Encoding") {
				//if ($part != "") {
					header($part);
					$debug .= $part . "\r\n";
				}
			}
		}
		
	    /*header("Pragma-directive: no-cache");
		header("Cache-directive: no-cache");
		header("Cache-control: no-cache");
		header("Pragma: no-cache");
		header("Expires: 0");*/
		
		$body_new = $body_raw;
		if ($fname_ext == "html") {
			$body_new = modify($body_raw, $request, $fname);
		}
		
		// Echo body
		if (!$redirect) {
			echo $body_new;
		}
		
		// Store on hard disk
		if (substr($body_raw, 0, 26) != '<html><body>You are being ') {
			file_force_contents($fname, $body_raw);
		}
		
		// Redirect
		if ($redirect) {
			header("Location: $redirect_location", true, 307);
		}
		
		// Debugging
		echo "<pre>$debug</pre>";
	}
?>
