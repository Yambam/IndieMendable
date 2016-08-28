<?php
	//Start session
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
		//$_SESSION = array();
	}
	
	require_once('global_passwd.php');
	//echo 'self' . $_SERVER['PHP_SELF'];
	
	$host   = "localhost";
	$user   = "root";
	$pass   = $_GLOBALS['mysql_passwd'];
	$dbname = "gamemaker";
	if (!empty($_SESSION['testbed'])) {
		$dbname = "gamemaker_testbed";
	}
	$con    = mysqli_connect($host,$user,$pass,$dbname);
	if (mysqli_connect_errno($con)) {
		echo "Error: " . mysqli_connect_error();
	}
	
	$con_forums = mysqli_connect($host,$user,$pass,"gamemaker_forums");
	if (mysqli_connect_errno($con)) {
		echo "Error: " . mysqli_connect_error();
	}
	
	$no_picture = '/img/original/no-picture.png';
	if (!empty($_SESSION['theme'])) {
		if ($_SESSION['theme']=='dark') {
			$no_picture = '/img/original/no-picture-dark.png';
		}
	}
	if (empty($_SESSION['domain_international'])) {
		$_SESSION['domain_international'] = 'gamemaker';
		$_SESSION['domain'] = 'gamemaker';
	}
	
	$_SESSION['ip'] = $_SERVER["REMOTE_ADDR"];
	if (isset($_SERVER["HTTP_USER_AGENT"]) && (stristr($_SERVER["HTTP_USER_AGENT"], "facebook") || stristr($_SERVER["HTTP_USER_AGENT"], "facebot"))) {
		$_SESSION['ip'] = "facebook";
	}
	if (isset($_SERVER["HTTP_USER_AGENT"]) && (stristr($_SERVER["HTTP_USER_AGENT"], "google"))) {
		$_SESSION['ip'] = "google";
	}
	$_SESSION['bots'] = array("facebook","google");
	
	//$slug_generator = "Any-Latin; NFD; [:Nonspacing Mark:] Remove; NFC; [:Punctuation:] Remove; Lower();";
	
	// I18N support information here
	$language = 'en_US.utf8';
	$language_abbr = 'en';
	$languages = array(
		'af'=>'af_ZA.utf8',
		'ar'=>'ar_SA.utf8',
		'da'=>'da_DK.utf8',
		'de'=>'de_DE.utf8',
		'el'=>'el_GR.utf8',
		'en'=>'en_US.utf8',
		'es'=>'es_ES.utf8',
		'fr'=>'fr_FR.utf8',
		'fy'=>'fy_NL.utf8',
		'he'=>'he_IL.utf8',
		'id'=>'id_ID.utf8',
		'it'=>'it_IT.utf8',
		'nl'=>'nl_NL.utf8',
		'nn'=>'nn_NO.utf8',
		'pl'=>'pl_PL.utf8',
		'pt'=>'pt_PT.utf8',
		'ru'=>'ru_RU.utf8',
		'sv'=>'sv_SE.utf8',
		'zh'=>'zh_CN.utf8'
	);
	if (!isset($_GET['lang'])) {
		$_GET['lang'] = 'en';
	}
	if (isset($languages[$_GET['lang']])) {
		$language = $languages[$_GET['lang']];
		$language_abbr = $_GET['lang'];
	}
	putenv("LANG=$language"); 
	setlocale(LC_ALL, $language);
	//echo '//'.gettext('Pages')."\r\n";
	
	$language_url = ($language_abbr=='en') ? '' : '/' . $language_abbr;
	if ($language_url=='/en') {
		$language_domain = '';
	} else {
		$language_domain = $language_url;
	}
	
	$_SESSION['domain'] = $_SESSION['domain_international'] . $language_domain;

	// Set the text domain as 'messages'
	$domain = 'messages';
	bindtextdomain($domain, "/media/seagate/htdocs/gamemaker/locale"); 
	textdomain($domain);
	
	if (!function_exists('slugify')) {
		function slugify($text) {
			// replace non letter or digits by -
			$text = preg_replace('~[^\pL\d]+~u', '-', $text);

			// transliterate
			$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

			// remove unwanted characters
			$text = preg_replace('~[^-\w]+~', '', $text);

			// trim
			$text = trim($text, '-');

			// remove duplicate -
			$text = preg_replace('~-+~', '-', $text);

			// lowercase
			$text = strtolower($text);

			if (empty($text)) {
				return 'n-a';
			}

			return $text;
		}
	}
	
	if (!function_exists('time_elapsed_string')) {
		function time_elapsed_string($datetime, $full = false) {
			$now = new DateTime;
			$ago = new DateTime($datetime);
			$diff = $now->diff($ago);
			
			$diff->w = floor($diff->d / 7);
			$diff->d -= $diff->w * 7;
			
			$string = array(
				'y' => 'year',
				'm' => 'month',
				'w' => 'week',
				'd' => 'day',
				'h' => 'hour',
				'i' => 'minute',
				's' => 'second',
			);
			foreach ($string as $k => &$v) {
				if ($diff->$k) {
					$v = $diff->$k . ' ' . ngettext($v, $v . 's',$diff->$k);
				} else {
					unset($string[$k]);
				}
			}
			
			if (!$full) $string = array_slice($string, 0, 1);
			return $string ? implode(', ', $string) . ' ' . gettext('ago') : gettext('just now');
		}
	}
	
	//Users
	if (!function_exists('user_info')) {
		function user_info($con,$user_id) {
			$user_id = mysqli_escape_string($con,$user_id);
			$result = mysqli_query($con,"SELECT * FROM users WHERE id = $user_id");
			if (mysqli_num_rows($result) >= 1) {
				$user_info = mysqli_fetch_array($result);
				if ($user_info['picture']=='') {
					$user_info['picture'] = $no_picture;
				}
				
				$user_info['picture_size']=getimagesize($_SERVER['DOCUMENT_ROOT'].$user_info['picture']);
				$user_info['picture_size'][0]=max($user_info['picture_size'][0],1);
				$user_info['picture_size'][1]=max($user_info['picture_size'][1],1);
				
				return $user_info;
			} else {
				return false;
			}
		}
	}
	
	$_SESSION['user_info'] = array();
	if (!empty($_SESSION['user_id'])) {
		$_SESSION['user_info'] = user_info($con,$_SESSION['user_id']);
	}
	
	//Errors
	if (!function_exists('report_error')) {
		function report_error($con,$type,$error = '') {
			$type = mysqli_escape_string($con,$type);
			if (empty($error)) {
				$error = mysqli_escape_string($con,mysqli_error($con));
			}
			$result = mysqli_query($con,"INSERT INTO errors (place,content) VALUES ('$type','$error')");
			if (!$result) {
				echo mysqli_error($con);
			}
		}
	}
	
	//Comments
	if (!function_exists('comment_add')) {
		function comment_add($con,$place) {
			if (!empty($_POST['comment']['content'])) {
				$type = mysqli_escape_string($con,$_POST['comment']['type']);
				$ip = mysqli_escape_string($con,$_SESSION['ip']);
				$author = empty($_SESSION['user_id']) ? 0 : $_SESSION['user_id'];
				$content = mysqli_escape_string($con,$_POST['comment']['content']);
				$domain = empty($_SESSION['domain']) ? 'unassigned' : $_SESSION['domain'];
				
				$comment_hash = sha1($content);
				if ($_SESSION['comment_hash']==$comment_hash) {
					$_SESSION['message'] .= ' NOTE: Double post prevented.';
					header("Location: " . $_SERVER['REQUEST_URI'], true, 302);
					exit;
				} else {
					$_SESSION['comment_hash'] = $comment_hash;
					$result = mysqli_query($con,"INSERT INTO comments (type,place,domain,ip,author,content) VALUES ($type,$place,'$domain','$ip',$author,'$content')");
					if (!$result) {
						report_error(mysqli_error($con),'comments');
					}
					
					if (empty($_SESSION['user_id'])) {
						header("Location: http://gamemaker.mooo.com$language_url/login", true, 302);
						exit;
					} else {
						header("Location: " . $_SERVER['REQUEST_URI'], true, 302);
						exit;
					}
				}
			}
		}
	}
	
	//Notifications
	if (!function_exists('cmp')) {
		function cmp($a,$b) {
			return $b['posted']-$a['posted'];
		}
	}
	if (!function_exists('update_notifications')) {
		function update_notifications($con) {
			if (!empty($_SESSION['logged_in'])) {
				$result = mysqli_query($con,"SELECT * FROM subscriptions WHERE type = 1 AND author = {$_SESSION['user_id']} ORDER BY id DESC");
				
				while($row = mysqli_fetch_assoc($result)) {
					$place_id = mysqli_escape_string($con,$row['place']);
					$place = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM users WHERE id = $place_id"));
					if ($place['picture']=='') {
						$place['picture'] = $no_picture;
					}
					
					if ($row['type']==1) {
						$result2 = mysqli_query($con,"SELECT * FROM comments WHERE place = $place_id ORDER BY id DESC LIMIT 10");
						while($row2 = mysqli_fetch_assoc($result2)) {
							$author_id = mysqli_escape_string($con,$row2['author']);
							if ($row2['author']==$_SESSION['user_id']) {
								continue;
							}
							$author = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM users WHERE id = $author_id"));
							if ($author['picture']=='') {
								$author['picture'] = $no_picture;
							}
							
							$_SESSION['notifications'][] = array(
								'msg' => time_elapsed_string($row2['posted']).' '.$author['username'].' commented on the member '.$place['username'],
								'url' => '/users/' . $author['username'],
								'image' => $place['picture'],
								'image_url' => '/users/' . $place['username'],
								'posted' => strtotime($row2['posted']),
							);
						}
					}
				}
				
				//Own user profile.
				$place_id = mysqli_escape_string($con,$_SESSION['user_id']);
				$place = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM users WHERE id = $place_id"));
				if ($place['picture']=='') {
					$place['picture'] = $no_picture;
				}
				
				$result2 = mysqli_query($con,"SELECT * FROM comments WHERE place = $place_id ORDER BY id DESC LIMIT 10");
				while($row2 = mysqli_fetch_assoc($result2)) {
					$author_id = mysqli_escape_string($con,$row2['author']);
					if ($row2['author']==$_SESSION['user_id']) {
						continue;
					}
					$author = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM users WHERE id = $author_id"));
					if ($author['picture']=='') {
						$author['picture'] = $no_picture;
					}
					
					$_SESSION['notifications'][] = array(
						'msg' => time_elapsed_string($row2['posted']).' '.$author['username'].' commented on the member '.$place['username'],
						'url' => '/users/' . $author['username'],
						'image' => $place['picture'],
						'image_url' => '/users/' . $place['username'],
						'posted' => strtotime($row2['posted']),
					);
				}
			}
			
			usort($_SESSION['notifications'],"cmp");
		}
	}
	
	//Messages
	if (!function_exists('message_parse')) {
		function message_parse($msg,$BBHandler,$con) {
			$html = htmlspecialchars($msg);
			$html = preg_replace('/\[quote(.*?)\]\s*/','[quote$1]',$html);
			//echo "<pre>$html</pre>";
			$html = preg_replace('/\s*\[\/quote\]\s*/','[/quote]',$html);
			$html = str_replace("\r\n",'<br>',$html);
			$html = bbcode_parse($BBHandler,$html);
			
			$ref_list = array();
			preg_match_all('/.*<!-- Message: (?:\/..)?\/messages\/([0-9]*?) -->/',$html,$ref_list);
			for($i=0;$i<sizeof($ref_list[0]);$i+=1) {
				$id = mysqli_escape_string($con,$ref_list[1][$i]);
				$result = mysqli_query($con,"SELECT * FROM messages WHERE id = $id AND (sent_to = {$_SESSION['user_id']} OR sent_from = {$_SESSION['user_id']})");
				if (mysqli_num_rows($result)>=1) {
					$row = mysqli_fetch_assoc($result);
					$name = htmlspecialchars($row['subject']);
					$html = preg_replace('/<span class="fa fa-reply" style="margin-right: 4px;"><\/span>.*<!-- Message: (?:\/..)?\/messages\/([0-9]*?) -->/','<span class="fa fa-reply" style="margin-right: 4px;"></span>'.$name,$html,1);
				} else {
					$html = preg_replace('/<span class="fa fa-reply" style="margin-right: 4px;"><\/span>.*<!-- Message: (?:\/..)?\/messages\/([0-9]*?) -->/','<span title="Message not found" style="color: #600000; text-decoration: underline;"><span class="fa fa-reply" style="margin-right: 4px;"></span>'.gettext('Original message (not found)').'</span>',$html,1);
				}
			}
			
			$ref_list = array();
			preg_match_all('/.*<!-- Message: (?:\/..)?\/users\/(.*?) -->/',$html,$ref_list);
			for($i=0;$i<sizeof($ref_list[0]);$i+=1) {
				$username = mysqli_escape_string($con,$ref_list[1][$i]);
				$result = mysqli_query($con,"SELECT * FROM users WHERE username = '$username'");
				if (mysqli_num_rows($result)>=1) {
					$row = mysqli_fetch_assoc($result);
					$name = 'User: '.htmlspecialchars($row['username']);
					$html = preg_replace('/<span class="fa fa-reply" style="margin-right: 4px;"><\/span>.*<!-- Message: (?:\/..)?\/users\/(.*?) -->/','<span class="fa fa-reply" style="margin-right: 4px;"></span>'.$name,$html,1);
				} else {
					$html = preg_replace('/<span class="fa fa-reply" style="margin-right: 4px;"><\/span>.*<!-- Message: (?:\/..)?\/users\/(.*?) -->/','<span title="Message not found" style="color: #600000; text-decoration: underline;"><span class="fa fa-reply" style="margin-right: 4px;"></span>'.gettext('Original message (not found)').'</span>',$html,1);
				}
			}
			
			/*$ref_list = array();
			preg_match_all('//',$html,$ref_list);
			for($i=0;$i<sizeof($ref_list[0]);$i+=1) {
				$id = mysqli_escape_string($con,$ref_list[1][$i]);
				$result = mysqli_query($con,"SELECT * FROM messages WHERE id = $id AND (sent_to = {$_SESSION['user_id']} OR sent_from = {$_SESSION['user_id']})");
				if (mysqli_num_rows($result)>=1) {
					$row = mysqli_fetch_assoc($result);
					$name = htmlspecialchars($row['subject']);
					$html = preg_replace('/<span class="fa fa-reply" style="margin-right: 4px;"><\/span>Original message<!-- Message: \/messages\/([0-9]*?) -->/','<span class="fa fa-reply" style="margin-right: 4px;"></span>'.$name,$html,1);
				} else {
					$html = preg_replace('/<span class="fa fa-reply" style="margin-right: 4px;"><\/span>Original message<!-- Message: \/messages\/([0-9]*?) -->/','<span title="Message not found" style="color: #600000; text-decoration: underline;"><span class="fa fa-reply" style="margin-right: 4px;"></span>Original message (not found)</span>',$html,1);
				}
			}*/
			
			return $html;
		}
	}
	
	//Time zone
	if (!empty($_SESSION['user_info'])) {
		$time_zone_autodetect = $_SESSION['user_info']['time_zone_autodetect'];
	} else {
		$time_zone_autodetect = true;
	}
	
	if (isset($_SESSION['time_offset'])) {
		$time_offset = $_SESSION['time_offset'];
	}
	if (isset($_SESSION['time_zone_id'])) {
		$time_zone_id = $_SESSION['time_zone_id'];
	}
	
	if ($time_zone_autodetect) {
		if (!empty($_SESSION['user_id'])) {
			$result = mysqli_query($con,"SELECT time_offset, time_zone_id FROM users WHERE id = {$_SESSION['user_id']}");
			$time_offset = mysqli_fetch_assoc($result)['time_offset'];
			$time_zone_id = mysqli_fetch_assoc($result)['time_zone_id'];
		} else {
			$time_offset = -60;
			$time_zone_id = 31;
		}
	}
	
	$time_offset_seconds = $time_offset * 60;
	$time_offset_hours = $time_offset / 60;
	
	date_default_timezone_set('Europe/Amsterdam');
	$utc_offset =  date('Z');
	
	//Website version info
	if (!isset($version_info)) {
		$version_info = array();
	}
	
	$result = mysqli_query($con,"SELECT * FROM version_info");
	while($row = mysqli_fetch_assoc($result)) {
		$version_info[$row['name']] = $row['version'];
	}
	
	//BBCode
	$arrayBBCode=array(
		''=>		array('type'=>BBCODE_TYPE_ROOT,  'childs'=>'!'),
		'url'=>		array('type'=>BBCODE_TYPE_OPTARG,
						'open_tag'=>'<a href="{PARAM}">', 'close_tag'=>'</a>',
						'default_arg'=>'{CONTENT}',
						'childs'=>'font,b,i,u,color,img'),
		'img'=>		array('type'=>BBCODE_TYPE_NOARG,
						'open_tag'=>'<a href="{CONTENT}"><img src="', 'close_tag'=>'" style="max-width: 100%;" /></a>',
						'childs'=>''),
		'move'=>	array('type'=>BBCODE_TYPE_OPTARG,
						'open_tag'=>'<div class="marquee" style="background-color: {PARAM}; color: inherit;"><div><div><div>', 'close_tag'=>'</div></div></div></div>',
						'default_arg'=>'#92C250',
						'childs'=>'font,b,i,u,color,img'),
		'b'=>		array('type'=>BBCODE_TYPE_NOARG, 'open_tag'=>'<b>',
						'close_tag'=>'</b>'),
		'i'=>		array('type'=>BBCODE_TYPE_NOARG, 'open_tag'=>'<i>',
						'close_tag'=>'</i>'),
		'u'=>		array('type'=>BBCODE_TYPE_NOARG, 'open_tag'=>'<span style="text-decoration: underline">',
						'close_tag'=>'</span>'),
		'color'=>	array('type'=>BBCODE_TYPE_ARG,
						'open_tag'=>'<span style="color: {PARAM}">', 'close_tag'=>'</span>'),
		'font'=>	array('type'=>BBCODE_TYPE_ARG,
						'open_tag'=>'<span style="font-family: {PARAM}">', 'close_tag'=>'</span>'),
		'size'=>	array('type'=>BBCODE_TYPE_ARG,
						'open_tag'=>'<span style="font-size: {PARAM}">', 'close_tag'=>'</span>'),
		'code'=>	array('type'=>BBCODE_TYPE_NOARG,
						'open_tag'=>'<pre>', 'close_tag'=>'</pre>',
						'childs'=>''),
		'quote'=>	array('type'=>BBCODE_TYPE_OPTARG,
					    'open_tag'=>'<span class="bb_quote_title">QUOTE<a href="{PARAM}" style="float: right; font-size: .8em;"><span class="fa fa-reply" style="margin-right: 4px;"></span>'.gettext('Original message').'<!-- Message: {PARAM} --></a></span><span class="bb_quote">', 'close_tag'=>'</span>',
						'default_arg'=>''));
	$BBHandler=bbcode_create($arrayBBCode);
	
	bbcode_add_smiley($BBHandler, "::)", "<img src=\"/Smileys/rolleyes.gif\" alt=\"::-)\" />");
	bbcode_add_smiley($BBHandler, ":)", "<img src=\"/Smileys/smiley.gif\" alt=\":)\" />");
	bbcode_add_smiley($BBHandler, ":(", "<img src=\"/Smileys/sad.gif\" alt=\":(\" />");
	bbcode_add_smiley($BBHandler, ":D", "<img src=\"/Smileys/grin.gif\" alt=\":D\" />");
	bbcode_add_smiley($BBHandler, "xD", "<img src=\"/Smileys/laugh.gif\" alt=\"xD\" />");
	bbcode_add_smiley($BBHandler, "XD", "<img src=\"/Smileys/laugh.gif\" alt=\"XD\" />");
	bbcode_add_smiley($BBHandler, ":P", "<img src=\"/Smileys/tongue.gif\" alt=\":P\" />");
	bbcode_add_smiley($BBHandler, ":O", "<img src=\"/Smileys/shocked.gif\" alt=\":O\" />");
	bbcode_add_smiley($BBHandler, ":o", "<img src=\"/Smileys/shocked.gif\" alt=\":o\" />");
	bbcode_add_smiley($BBHandler, ";)", "<img src=\"/Smileys/wink.gif\" alt=\";)\" />");
	
	$result = mysqli_query($con,"SELECT username FROM users ORDER BY LENGTH(username) DESC");
	$_SESSION['UserList'] = preg_quote(mysqli_fetch_assoc($result)['username']);
	while($row = mysqli_fetch_assoc($result)) {
		$_SESSION['UserList'] .= '|'.preg_quote($row['username']);
	}
	//echo $_SESSION['UserList'];
	
	//require_once('Parsedown.php');
	//require_once('ParsedownExtra.php');
	require_once('vendor/autoload.php');
	$Parsedown = new ParsedownExtra();
?>
