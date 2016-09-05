<?php
	define('indiemendable',true,true);
	
	session_start();
	require_once "password.php";
	require_once "config.php";
	require_once "global_passwd.php";
	
	$correct = false;
	$email_sql = mysqli_escape_string($con,$_POST['user']['email']);
	$result = mysqli_query($con,"SELECT id,username,password,type FROM users WHERE email = '$email_sql'");
	//$result = mysqli_query($con,"SELECT id,username,password,type FROM users WHERE email = \"{$_POST['user']['email']}\"");
	if (mysqli_num_rows($result) >= 1) if ($row = mysqli_fetch_array($result)) {
		$password = $_POST['user']['password'];
		if (password_verify($password,$row['password'])) {
			$correct = true;
			if ($row['type']==0) {
				include("default-top.php");
?>
				<h2>You're almost done!</h2>
				<p>
					To complete your registration, check your mail and click the activation link. After you've done
					that, you'll be able to login using your email and password. :)
<?php
				include("default-bottom.php");
			} else {
				file_get_contents('http://gamemaker.mooo.com/update-notifications');
				
				/*
				$username_url = urlencode($row['username']);
				
				$cookies = Array();
				function curlResponseHeaderCallback($ch, $headerLine) {
					global $cookies;
					if (preg_match('/^Set-Cookie:\s*([^;]*)/mi', $headerLine, $cookie) == 1)
						$cookie = explode('=',$cookie[1]);
						$cookies[$cookie[0]] = $cookie[1];
					return strlen($headerLine); // Needed by curl
				}
				
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_HEADER, true);
				curl_setopt($ch, CURLOPT_VERBOSE, 1);
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
				curl_setopt($ch, CURLOPT_TIMEOUT, 10);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
				//curl_setopt($ch, CURLOPT_COOKIE, "PHPSESSID=".$_COOKIE['PHPSESSID']);
				curl_setopt($ch, CURLOPT_COOKIEJAR, $_SERVER['DOCUMENT_ROOT']."/forums/cookie.txt");
				curl_setopt($ch, CURLOPT_URL, "http://gamemaker.mooo.com/forums/index.php");
				curl_setopt($ch, CURLOPT_POSTFIELDS, "action=login2&user=$username_url&passwrd={$_GLOBALS['forum_passwd']}&cookielength=-1&submit=Login");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_HEADERFUNCTION, "curlResponseHeaderCallback");
				
				$result = curl_exec($ch);
				
				$sersess = serialize($_SESSION);
				session_destroy();
				
				session_id($cookies['PHPSESSID']);
				session_start();
				$_SESSION = unserialize($sersess);
				
				setcookie('SMFCOOKIE378',urldecode($cookies['SMFCOOKIE378']),time() + 60*60*24*30);
				//echo session_id().":".explode('=',$cookies[3][1])[1];
				//print_r($cookies);
				//print_r($_SESSION);
				
				curl_close($ch);
				//*/
				
				$_SESSION['logged_in'] = true;
				$_SESSION['username'] = $row['username'];
				$_SESSION['user_id'] = $row['id'];
				
				$_SESSION['message'] = 'You are now logged in.';
				if (!empty($_SESSION['return_url'])) {
					$_SESSION['message'] .= ' If you want to go back to your original page, please click here: <a href="'.htmlspecialchars($_SESSION['return_url']).'"><q>'.htmlspecialchars(!empty($_SESSION['return_url_title']) ? $_SESSION['return_url_title'] : 'Untitled').'</q></a>';
				}
				
				if ($_SESSION['user_id']==1) {
					$_SESSION['betabeta'] = true;
					/*$_SESSION['username'] = 'ndke';
					$_SESSION['user_id'] = 47;
					$result = mysqli_query($con,"SELECT id,username,password,type FROM users WHERE id = 47");
					if (mysqli_num_rows($result) >= 1) if ($row_ = mysqli_fetch_array($result)) {
						$row = $row_;
					}*/
				}
				
				$author = mysqli_escape_string($con,$row['id']);
				$ip = mysqli_escape_string($con,$_SERVER['REMOTE_ADDR']);
				$result = mysqli_query($con,"UPDATE users SET visible = 1 WHERE email = '$email_sql'");
				if (!$result) {
					report_error(mysqli_error($con));
				}
				$result = mysqli_query($con,"UPDATE comments SET author = $author, domain = 'gamemaker' WHERE author = 0 AND ip = '$ip'");
				if (!$result) {
					report_error(mysqli_error($con));
				}
				
				/*echo $_COOKIE[session_name()]."<br>\r\n";
				echo $cookies['PHPSESSID']."<br>\r\n";
				echo session_id();*/
				
				if ($_POST['rememberme']=="1") {
					$params = session_get_cookie_params();
					setcookie(session_name(), session_id(), time() + 60*60*24*30, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
					//$_SESSION['message'] .= ' '.session_name();
				}
				
				//print_r($_SESSION);
				
				//echo $result; 
				/*if ($_SESSION['betabeta']) {
					echo $_SESSION['return_url'];
				} else {*/
					header("Location: http://gamemaker.mooo.com$language_url/", true, 302);
				//}
			}
			break;
		}
	} else {
		$correct = false;
	}
	
	if (!$correct) {
		$page_title = "Login";
		$_SESSION['message'] = "Incorrect email/password";
		/*include("default-top.php");
		echo file_get_contents("http://gamemaker.mooo.com/login_form?email=" . urlencode($_POST['user']['email']));
		include("default-bottom.php");*/
		header("Location: http://gamemaker.mooo.com$language_url/login", true, 302);
	}
?>
