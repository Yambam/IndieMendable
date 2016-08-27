<?php
$status_header = '';

function file_force_contents($dir, $contents) {
	$parts = explode('/', $dir);
	$file = array_pop($parts);
	
	$dir = '';
	foreach($parts as $part) {
		$dir .= "$part/";
		if (!is_dir($dir)) mkdir($dir);
	}
	
	//file_put_contents("$dir$file", fopen($contents, "r"));
	file_put_contents("$dir$file", $contents);
}

function write_log($txt) {
  file_put_contents("put_log.txt", $txt, FILE_APPEND);
  //chmod("put_log.txt", 0666);
}
require 'dauth.php';
// customize the following defines:-
define('AUTH_REALM', $_SERVER['SERVER_NAME'].'/api');
define('URL_BASE', 'http://'.$_SERVER['SERVER_NAME'].'/locale');

/* ---
  The following sample authorization function uses an array of
  user names and passwords defined and fixed here.

  An actual implementation might read the array from an external
resource.
  The use of an ArrayIterator makes it moderately easy to extend this
  mechanism.
--- */

function authorize() {
  $auth = new authorizer(AUTH_REALM, new ArrayIterator(array('user' => 'user', 'user2' => 'password2')));
  $auth->check(); // dies if not OK
}

function puterror($status, $body, $log = FALSE) {
  global $status_header;
  header ("HTTP/1.1 $status");
  $status_header = "HTTP/1.1 $status";
  if ($log) write_log($log);
  die("<html><head><title>Error
$status</title></head><body>$body</body></html>");
}

function putfile() {
	global $status_header;
	$f = pathinfo($fname = preg_replace('/\/\.+/','',$_SERVER['REQUEST_URI']));
	if (!in_array($f['extension'],array('po','mo'))) puterror('403 Forbidden', "Bad file type in $fname");
	if (!in_array($f['basename'],array('messages.po','messages.mo'))) puterror('403 Forbidden', "Bad file name in $fname
	(only messages.po and messages.mo allowed)");
	$fname = preg_replace('/^(?:\/locale)?\/?(.*)$/','\1',$fname);
	$i = 1;
	$move = false;
	$_fname = $fname;
	while(file_exists($_fname)) {
		$_fname = preg_replace('/^(.*?)(?:\.[0-9]+)?$/','\1.'.strval($i++),$_fname);
		$move = true;
	}
	$f = fopen('temp.txt', 'w');
	if (!$f) puterror('409 Create error', "Couldn't create file $fname");
	$s = fopen('php://input', 'r'); // read from standard input
	if (!$s) puterror('404 Input Unavailable', "Couldn't open input");
	while($kb = fread($s, 1024)) fwrite($f, $kb, 1024);
	fclose($f);
	fclose($s);
	if ($move) {
		if (file_exists(str_replace('.po','.mo',$fname))) {
			rename(str_replace('.po','.mo',$fname),str_replace('.po','.mo',$_fname));
		}
		rename($fname,$_fname);
	}
	file_force_contents($fname,file_get_contents('temp.txt'));
	//chmod($fname, 0666);
	$url = URL_BASE . '/' . $fname;
	header("Location: $url");
	header("HTTP/1.1 201 Created");
	$status_header = "HTTP/1.1 201 Created";
	echo "<html><head><title>Success</title></head><body>";
	echo "<p>Created <a href='$url'>$url</a> OK.</p></body></html>";
	//mail('ima.habekotte@gmail.com',"New language file uploaded","Check it out at $url");
	file_put_contents('uploaded_files.txt',serialize(array(
		'subject' => 'New language file uploaded',
		'content' => 'Check it out at '.$url.'<h2>Command</h2><p><b><pre>msgfmt -v --output-file="/media/silicon/htdocs/gamemaker/locale/'.str_replace('.po','.mo',$fname).'" "/media/silicon/htdocs/gamemaker/locale/'.$fname.'" 2>&1</b></pre><h2>Output</h2><p><pre style="background-color: black; color: #00FF00;">'.preg_replace('/\r?\n/','<br>',shell_exec('msgfmt -v --output-file="/media/silicon/htdocs/gamemaker/locale/'.str_replace('.po','.mo',$fname).'" "/media/silicon/htdocs/gamemaker/locale/'.$fname.'" 2>&1')).'</pre>',
		'posted' => time(),
		'ip' => $_SERVER['REMOTE_ADDR']
	))."\r\n",FILE_APPEND);
}

if ($_SERVER['REQUEST_METHOD'] != 'PUT')
  header("HTTP/1.1 403 Bad Request");
else {
  //authorize();
  putfile();
  // uncommment the next line to debug misbehaviour
  write_log(date('Y-m-d H:i:s') . "\r\n" . $_SERVER['REQUEST_URI'] . "\r\n\r\nHeaders:\r\n$status_header\r\n" . print_r(headers_list(),true) . "\r\n");
}

