<?php
	/*if (substr($_SERVER['REQUEST_URI'],1,2)=='//') {
		$_SERVER['REQUEST_URI'] = substr($_SERVER['REQUEST_URI'],1);
	}*/
	//echo $_SERVER['REQUEST_URI']."\r\n\r\n";
	
	$date_exist = strtotime('2015/12/31');
	
	if( !function_exists( 'http_parse_headers' ) ) {
		function http_parse_headers( $header )
		{
			$retVal = array();
			$fields = explode("\r\n", preg_replace('/\x0D\x0A[\x09\x20]+/', ' ', $header));
			foreach( $fields as $field ) {
				if( preg_match('/([^:]+): (.+)/m', $field, $match) ) {
					$match[1] = preg_replace('/(?<=^|[\x09\x20\x2D])./e', 'strtoupper("\0")', strtolower(trim($match[1])));
					if( isset($retVal[$match[1]]) ) {
						$retVal[$match[1]] = array($retVal[$match[1]], $match[2]);
					} else {
						$retVal[$match[1]] = trim($match[2]);
					}
				}
			}
			return $retVal;
		}
	}

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
		$dir = str_replace("/yoyogames2/","/yoyogames/",$dir);
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
		$fname = preg_replace('/\/web\/.*?\/http:\/\/sandbox\.yoyogames\.com\//','/',$fname);
		$fname = preg_replace('/\/web\/.*?\//','/',$fname);
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
		$fname = str_replace('http://', '', $fname);
		
		$fname = str_replace('send_download','Download.exe',$fname);
		
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
		/*$body_new = preg_replace(
		'/<li class="last"><a href="(.*)">(.*)<\/a><\/li>/',
		'<li><a href="$1">$2</a></li> <li class="last"><a href="' . $alt_url . '" title="Last refresh of this page: ' . $last_updated . '">Refresh</a></li>', $body_new, 1);*/
		if (strpos($request, '/games/')) {
			$request = preg_replace('/\/web\/.*?\//','',$_SERVER['REQUEST_URI']);
			$url_download = "http://gamemaker.mooo.com/yyg/web/*/".$request."/*";
			$downloads = json_decode(file_get_contents("http://web.archive.org/cdx/search/cdx?limit=1000&output=json&url=".preg_replace('/(.*?\/games\/.*?)[\/-].*/','\1',$request)."-*"));
			//echo preg_replace('/(.*?\/games\/.*?)[\/-].*/','\1',$result[1][$i]."-*");
			for($j=1;$j<sizeof($downloads);$j+=1) {
				if (stristr($downloads[$j][0],'/send_download'))
				if (strpos($downloads[$j][1],'2014')==0
				||  strpos($downloads[$j][1],'2015')==0
				||  strpos($downloads[$j][1],'2016')==0)
				if (strlen(explode('?',$downloads[$j][0])[1])>=1) {
					$url_download = str_replace('com,yoyogames,sandbox)',"http://web.archive.org/web/".date('YmdHis').'/http://sandbox.yoyogames.com',$downloads[$j][0]);
					break;
				}
			}
			$url_download = str_replace('web.archive.org','www.yoyogames.com',$url_download);
			$body_new = preg_replace('/\/games\/.*\/download/',$url_download,$body_new,1);
			$body_new = str_replace('<div id="main">','<div id="main"><object width="746" height="43" align="CENTER" id="YYGInstantPlay1" classid="CLSID:C49134CC-B5EF-458C-A442-E8DFE7B4645F" codebase="/plugins/activex/YoYo.cab#Version=1,1,0,17"><PARAM NAME="_Version" VALUE="65537"><PARAM NAME="_ExtentX" VALUE="19738"><PARAM NAME="_ExtentY" VALUE="1138"><PARAM NAME="_StockProps" VALUE="0">
		 <param name="_Version" value="10">
		 <param name="_ExtentX" value="19738">
		 <param name="_ExtentY" value="1138">
		 <param name="_StockProps" value="0">
		 <param name="GameID" value="225344">
		</object>',$body_new);
			//$body_new = str_replace('<script','<script src="/javascripts/admin_tools.js" ></script><script',$body_new);
		}
		
		//if (strpos($request, '/yyg/')) {
			$body_new = str_replace('/extras/','/yyg/extras/',$body_new);
			$body_new = str_replace('/javascripts/','/yyg/javascripts/',$body_new);
			$body_new = str_replace('/stylesheets/','/yyg/stylesheets/',$body_new);
			$body_new = str_replace('/plugins/','/yyg/plugins/',$body_new);
			$body_new = str_replace('/images/','/yyg/images/',$body_new);
			$body_new = str_replace('/browse','/yyg/browse',$body_new);
			$body_new = str_replace('/make','/yyg/make',$body_new);
			$body_new = str_replace('/share','/yyg/share',$body_new);
			$body_new = str_replace('/help','/yyg/help',$body_new);
			$body_new = str_replace('"/search','"/yyg/search',$body_new);
			$body_new = str_replace('/games','/yyg/games',$body_new);
			$body_new = str_replace('/users','/yyg/users',$body_new);
			$body_new = str_replace('/my_account','/yyg/my_account',$body_new);
			$body_new = str_replace('/web','/yyg/web',$body_new);
			$body_new = str_replace('/favicon.ico','/yyg/favicon.ico',$body_new);
		//}
		
		return $body_new;
	}
	
	$debug = "";
	
	$request = $_SERVER['REQUEST_URI'];
	$request = str_replace('/members', '/users', $request);
	
	$redirect = false;
	$redirect_location = $request;
	
	$offline = false;
	$fast = true;
	$fast_html = true;
	$fname = allowed_chars_dir($request);
	$fname_ext = pathinfo($fname, PATHINFO_EXTENSION);
	
	if (!is_file($fname)&&is_file(str_replace("/original/","",$fname))) {
		$fname = str_replace("/original/","",$fname);
		//echo $fname;
	}
	//echo is_file($fname) ? 'yes' : 'no';
	//echo $fname;
	if (!is_file($fname)&&is_file(str_replace("/yoyogames/","/yoyogames2/",$fname))) {
		$fname = str_replace("/yoyogames/","/yoyogames2/",$fname);
		//echo $fname;
	}
	//echo is_file($fname) ? 'yes' : 'no';
	//echo str_replace("/yoyogames/","/yoyogames2/",$fname)
	/*if (is_file(preg_replace("/\/original\/comments\/paginate_/","@",$fname,1))) {
		$fname = preg_replace("\/original\/comments\/paginate_/","@",$fname,1);
		echo $fname;
	}*/
	//echo is_file($fname) ? 'yes' : 'no';
	//echo preg_replace("/_/","@",$fname,1);
	
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
	if ((is_file($fname) && (/*time() - filemtime($fname) > 43200 || */filesize($fname) == 0)) || $refresh) {
		$fast = false;
		$fast_html = false;
	}
	
	if ($offline || (is_file($fname) && (pathinfo($fname, PATHINFO_BASENAME) == 'download.html' ? false : ($fname_ext == 'html' ? $fast_html : $fast)))) {
		$fp = false;
	} else {
		$fp = fsockopen("web.archive.org", 80, $errno, $errstr, 30);
		
		if (!stristr($redirect_location,"/web/")) {
			$redirect = true;
			$redirect_location = "/yyg/web/".date('YmdHis',$date_exist)."/http://sandbox.yoyogames.com".$redirect_location;
			echo "Location: $redirect_location";
			//header("Location: $redirect_location", true, 307);
			exit;
		}
		/*if (!stristr($redirect_location,"/yyg")) {
			$redirect = true;
			$redirect_location = "/yyg".$redirect_location;
			header("Location: $redirect_location", true, 307);
			exit;
		}*/
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
			$out .= "Host: web.archive.org\r\n";
			$out .= "Connection: Close\r\n\r\n";
			fwrite($fp, $out);
		} else {
			$out = "POST {$request} HTTP/1.1\r\n";
			$out .= "Host: web.archive.org\r\n";
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
				$out .= str_replace('www.yoyogames.com', 'web.archive.org', "$header: $value\r\n");
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
			$str_part = str_replace('web.archive.org', 'www.yoyogames.com', fgets($fp));
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
			$header_parse = http_parse_headers($header);
			foreach($header_split as $part) {
				if ($part != "" && substr($part, 0, 16) != "Content-Encoding" && substr($part, 0, 8) != "Location") {
				//if ($part != "") {
					header(str_replace('/web/','/yyg/web/',$part));
					$debug .= $part . "\r\n";
				}
			}
			if (isset($header_parse['Content-Displacement'])) {
				$fname = str_replace('Download.exe',explode('"',$header_parse['Content-Displacement'])[1],$fname);
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
			//header("Location: $redirect_location", true, 307);
			echo $redirect_location;
		}
		
		// Debugging
		//echo "<pre>$debug</pre>";
	}
?>
