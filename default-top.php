<?php
	if (!function_exists('mostRecentModifiedFileTime')) {
		function mostRecentModifiedFileTime($dirName,$doRecursive) {
			$d = dir($dirName);
			$lastModified = 0;
			while($entry = $d->read()) {
				if ($entry != "." && $entry != "..") {
					if (!is_dir($dirName."/".$entry)) {
						$currentModified = filemtime($dirName."/".$entry);
					} else if ($doRecursive && is_dir($dirName."/".$entry)) {
						$currentModified = mostRecentModifiedFileTime($dirName."/".$entry,true);
					}
					if (isset($currentModified)
					&&  $currentModified > $lastModified) {
						$lastModified = $currentModified;
					}
				}
			}
			$d->close();
			return $lastModified;
		}
	}
	
	if (!isset($no_modified_header)) {
		$length = ob_get_length();
		$last_modified = date ("D, d M Y H:i:s", mostRecentModifiedFileTime(dirname(__FILE__),false));
		header("Content-Length: $length");
		header("Last-Modified: $last_modified GMT time");
	}
	
	header('Content-Type: text/html; charset=utf-8');
	
	//Start session
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	
	//Messages
	if (!empty($_SESSION['message'])) {
		$_GET['message'] = $_SESSION['message'];
		$_SESSION['message'] = '';
	}
	
	//Notifications
	require_once('config.php');
	$_SESSION['notifications'] = array();
	
	update_notifications($con);
	
	$notifications_unread = 0;
	foreach($_SESSION['notifications'] as $notification) {
		$notifications_unread += 1;
	}
	
	//Last active
	if (!empty($_SESSION['logged_in'])) {
		$user = mysqli_escape_string($con,$_SESSION['username']);
		if (!mysqli_query($con,"UPDATE users SET last_active = CURRENT_TIMESTAMP WHERE username = '$user'")) {
			echo mysqli_error($con);
		}
	}
	
	//Theme
	if (empty($_SESSION['theme'])) {
		$_SESSION['theme'] = 'light';
	}
	$css_default = '/css/default.css';
	if ($_SESSION['theme']=='dark') {
		$css_default = '/css/default-dark.css';
	}
	if (!isset($css_extra)) {
		$css_extra = '';
	}
	
	//Snowy extras
	if (!isset($_SESSION['snowy'])) {
		$_SESSION['snowy'] = false;
	}
	
	if (!empty($_SESSION['snowy'])) {
		$css[] = '/css/snowy.css';
		$css[] = '/css/snowy-' . $_SESSION['theme'] . '.css';
		$js[] = '/js/snowstorm.js';
	}
	
	//Current page
	if (strpos(__FILE__,'error-404.php')===false) {
		$_SESSION['last_page'] = $_SERVER['REQUEST_URI'];
	}
	
	$uri = str_replace("http://{$_SERVER['SERVER_NAME']}",'',explode('?',$_SERVER["REQUEST_URI"])[0]);
	
	if (isset($doctype)) {
		if (!empty($doctype)) { 
			echo "$doctype\r\n";
		}
	} else {
?>
<!DOCTYPE html>
<?php } ?>
<html lang="<?php echo $language_abbr; ?>">
	<head>
		<script src="/js/jquery-1.11.0.min.js"></script>
		<script src="/js/lightbox.min.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo $language_url . $css_extra . $css_default; ?>">
		<link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
		<link rel="stylesheet" href="/css/lightbox.css">
<?php if (isset($css)) foreach($css as $current_css) { ?>
		<link rel="stylesheet" type="text/css" href="<?php echo $current_css; ?>">
<?php } ?>
		<link rel="shortcut icon" href="/favicon.ico" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="theme-color" content="#A0D060">
		<title>IndieMendable | <?php echo trim($page_title); ?></title>
		<link rel="search" type="application/opensearchdescription+xml" href="/opensearch.xml" title="<?php echo gettext('Search on IndieMendable'); ?>">
<?php if (isset($js)) foreach($js as $current_js) { ?>
		<script src="<?php echo $current_js; ?>"></script>
<?php } ?>
		<script src="<?php echo $language_url; ?>/js/application.js"></script>
		<script src="/js/jstz-1.0.4.min.js"></script>
		<script src="/js/moment.min.js"></script>
		<script src="/js/hyphenator.js"></script>
		<script type="text/javascript">
			Hyphenator.run();
		</script>
		<link rel='stylesheet' id='es-widget-css-css'  href='/blog/wp-content/plugins/email-subscribers/widget/es-widget.css?ver=4.5.2' type='text/css' media='all' />
		<meta property="fb:admins" content="100007712491996">
<?php
	if (!empty($_SESSION['user_id'])) {
?>
		<script>if ((new Date()).getTimezoneOffset()!=<?php echo $time_offset; ?>) updateTimezone();</script>
<?php
	}
	if (!empty($_SESSION['betabeta'])) {
	//*
?>
		<!--<script src="http://jsconsole.com/remote.js?3F8889B5-0702-4B56-BA51-26F1A32E90D6"></script>-->
		<!--<script type="text/javascript" src="http://livejs.com/live.js#css,js,html"></script>-->
<?php
	//*/
	}
	if (!empty($_SESSION['meta'])) {
?>
		<meta property="og:title" content="IndieMendable | <?php echo $page_title; ?>">
		<meta property="og:description" content="<?php echo $_SESSION['meta']['description']; ?>">
		<meta property="og:image" content="<?php echo $_SESSION['meta']['picture']; ?>">
		<meta property="og:type" content="website">
		<meta property="fb:page_id" content="588511824655434">
<?php
		if (!empty($_SESSION['meta']['picture_w'])) {
?>
		<meta property="og:image:width" content="<?php echo $_SESSION['meta']['picture_w']; ?>">
		<meta property="og:image:height" content="<?php echo $_SESSION['meta']['picture_h']; ?>">
<?php
		}
?>
		<meta property="og:url" content="http://gamemaker.mooo.com<?php echo $_SERVER['REQUEST_URI']; ?>">
		<meta name="twitter:title" content="IndieMendable | <?php echo $page_title; ?>">
		<meta name="twitter:description" content="<?php echo $_SESSION['meta']['description']; ?>">
		<meta name="twitter:image" content="<?php echo $_SESSION['meta']['picture']; ?>">
		<meta name="twitter:card" content="summary_large_image">
<?php
	}
?>
		<!--[if IE]>
			<link rel="stylesheet" type="text/css" href="/css/iehacks.css" />
		<![endif]-->
		<!--[if lte IE 6]>
			<script type="text/javascript" src="/css/iescripts.js"></script>
		<![endif]-->
		<!--[if lte IE 8]>
			<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400" /> 
			<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:700" /> 
			<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:800" />
			<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic" /> 
			
			<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Droid+Serif:400" /> 
			<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400" /> 
		<![endif]-->
		<meta name="keywords" content="<?php echo gettext('YoYoGames YoYo IndieMendable Sandbox forum free games downloads community GameMaker Game Maker GM minigames share make play gaming fun game creation design software'); ?>" />
		<meta name="description" content="<?php echo gettext('A new website for GameMaker creations!'); ?>" />
	</head>
	<body ontouchstart="" lang="<?php echo $language_abbr; ?>">
<?php	if (!empty($_SESSION['betabeta'])) { ?>
		<div id="fireworks"></div>
<?php	}?>
<?php if (!isset($minimal)) { ?>
		<div class="links-bar smallfont">
			<a href="<?php echo $language_url; ?>/"><?php echo gettext("Home"); ?></a> | <a href="/forums"><?php echo gettext("Forums"); ?></a> | <a href="http://www.yoyogames.com/gamemaker"><?php echo gettext("GameMaker"); ?></a> | <a href="http://enigma-dev.org/"><?php echo gettext("ENIGMA"); ?></a> | <a href="http://yygwiki.mooo.com/"><?php echo gettext("Wiki"); ?></a> | <a href="/blog"><?php echo gettext("Blog"); ?></a>
			<div style="float: right;"><a href="/yyg/"><?php echo gettext("Go to our YoYo Games Archive"); ?></a> | <div class="language-select" tabindex="0">
				<div class="lang lang-<?php echo explode("_",$language)[0]; ?> region region-<?php echo strtolower(end((explode("_",substr($language,0,5))))); ?>" onclick="if (document.activeElement==this) this.blur(); else this.focus();"></div>
<?php
			foreach($languages as $_language) if ($_language!=$language) {
				$_language_abbr = explode("_",$_language)[0];
				$_region = strtolower(end((explode("_",substr($_language,0,5)))));
				
?>
				<a href="<?php echo preg_replace('/^(?:\/?(?:af|ar|da|de|el|en|es|fr|fy|he|id|it|nl|nn|pl|pt|ru|sv|zh|)\/)(.*)$/','/'.$_language_abbr.'/\1',$_SERVER['REQUEST_URI']); ?>" class="lang lang-<?php echo $_language_abbr; ?> region region-<?php echo $_region; ?>" tabindex="-1" title="<?php echo $_language_abbr.'-'.strtoupper($_region); ?>"><?php echo $_language_abbr.'-'.strtoupper($_region); ?></a>
<?php
			}
?>
			</div></div>
			<div class="translation-help">
<?php
				echo sprintf(gettext('<p>We need more translators! Machine translation will never match up with your translation skills. :)<p><a href="%s/language-updater" style="font-weight: 300;">Select a flag and go to our Language Updater</a>'),$language_url);
?>

			</div>
		</div>
<?php
			if (!empty($_SESSION['user_id'])) {
?>
		<div class="fa fa-bell-o notifications-icon" tabindex="0" title="<?php echo gettext('No notifications'); ?>">
<?php
				if (!empty($_SESSION['notifications'])) {
					if ($notifications_unread>=2) { ?>
			<div class="new-count">
				<?php echo $notifications_unread; ?>
			</div>
<?php
					}
?>
			<div class="new">
				<i class="fa fa-bell"></i>
			</div>
<?php
				}
?>

		</div>
		<div class="notifications-window hyphenate" tabindex="0">
			<div>
<?php
				if (!empty($_SESSION['notifications'])) {
?>
				<h2 style="color: #7BB640;"><?php echo gettext('Notifications'); ?> (<?php echo $notifications_unread; ?>)</h2>
				<div class="notifications">
<?php
					foreach($_SESSION['notifications'] as $notification) {
?>
					<div data-href="<?php echo $notification['url']; ?>" style="min-height: 60px;">
						<a href="<?php echo $notification['image_url']; ?>">
							<div class="picture-alt" style="background-image: url('<?php echo str_replace('/original/','/thumb/',$notification['image']); ?>');"></div>
						</a>
						<a href="<?php echo $notification['url']; ?>">
							<?php echo $notification['msg']; ?>

						</a>
					</div>
<?php
					}
?>
					<!--<div>1 hour ago Yambam commented on the member Ace Sword24</div>
					<div>18 hours ago Yambam commented on the member 3 Wiki</div>
					<div>1 day ago Yambam commented on the member Yambam</div>
					<div>1 hour ago Yambam commented on the member Ace Sword24</div>
					<div>18 hours ago Yambam commented on the member 3 Wiki</div>
					<div>1 day ago Yambam commented on the member Yambam</div>-->
				</div>
<?php
				} else {
?>
				<h2><?php echo gettext('Notifications'); ?> (0)</h2>
				<div>
					<div style="text-align: center;"><?php echo gettext('No notifications'); ?></div>
				</div>
<?php
				}
?>
			</div>
		</div>
		<div class="notifications-exit" onclick="this.focus()" tabindex="1">
		</div>
<?php
			}
?>
<?php } ?>
		<div id="wrapper"<?php if (!empty($_SESSION['notifications'])) { ?> class="animation-running"<?php } ?>>
			<div id="content">
<?php 	if (!isset($minimal)) { ?>
				<div id="sessionbar" class="float-right">
<?php		if (isset($_SESSION['logged_in'])) { ?>
					<?php echo gettext('Welcome'); ?> <a href="<?php echo gettext("$language_url/users") . '/' . urlencode($_SESSION['username']); ?>"><?php echo htmlspecialchars($_SESSION['username']); ?></a> - 
					<a href="<?php echo gettext("$language_url/logout"); ?>"><?php echo gettext('Log out'); ?></a><br>
					<?php
	$result = mysqli_query($con,"SELECT id FROM messages WHERE sent_to = {$_SESSION['user_id']} AND `read` = 0");
	if (mysqli_num_rows($result)==0) {
		?><a class="new-message-count" href="<?php echo $language_url; ?>/messages"><span class="fa fa-envelope-o" style="margin-right: 6px;"></span>0 <?php echo gettext('new') . ' ' . ngettext('message','messages',0); ?></a><?php
	} elseif (mysqli_num_rows($result)==1) {
		?><a class="new-message-count" href="<?php echo $language_url; ?>/messages" style="font-weight: bold;"><span class="fa fa-envelope" style="margin-right: 6px;"></span>1 <?php echo gettext('new') . ' ' . ngettext('message','messages',1); ?></a><?php
	} else {
		?><a class="new-message-count" href="<?php echo $language_url; ?>/messages" style="font-weight: bold;"><span class="fa fa-envelope" style="margin-right: 6px;"></span><?php echo mysqli_num_rows($result); ?> <?php echo gettext('new') . ' ' . ngettext('message','messages',mysqli_num_rows($result)); ?></a><?php
	}	?>
<?php		} else { ?>
					<a href="<?php echo gettext("$language_url/login"); ?>"><?php echo gettext('Log in'); ?></a><br>
					<a href="<?php echo gettext("$language_url/register"); ?>"><?php echo gettext('Register'); ?></a>
<?php		} ?>

				</div>
				
				<h1><a href="<?php echo $language_url; ?>/" id="logo">IndieMendable <sup style="color: #808080; font-size: .5em;"><?php
	if ($_SESSION['domain']=='gamemaker_old') {
		echo 'OLD';
	} elseif (!empty($_SESSION['domain'])&&!empty($_SESSION['username'])&&$_SESSION['domain']==$_SESSION['username']) {
		echo 'OWN DOMAIN';
	} elseif (empty($_SESSION['betabeta'])) {
		echo 'BETA?';
	} elseif (empty($_SESSION['testbed'])) {
		echo 'BETABETA';
	} else {
		echo 'TESTBED';
	}
?></sup></a></h1>
				
				<div id="sessionbar-alt" class="dark" style="display: none">
<?php	if (isset($_SESSION['logged_in'])) { ?>
					<?php echo gettext('Welcome'); ?> <a href="<?php echo gettext("$language_url/users") . '/' . urlencode($_SESSION['username']); ?>"><?php echo htmlspecialchars($_SESSION['username']); ?></a>
					<?php
	$result = mysqli_query($con,"SELECT id FROM messages WHERE sent_to = {$_SESSION['user_id']} AND `read` = 0");
	if (mysqli_num_rows($result)==0) {
		?><a href="<?php echo gettext("$language_url/messages"); ?>">(0 <?php echo ngettext('message','messages',0); ?>)</a><?php
	} elseif (mysqli_num_rows($result)==1) {
		?><a href="<?php echo gettext("$language_url/messages"); ?>" style="font-weight: bold;">(1 <?php echo ngettext('message','messages',1); ?>)</a><?php
	} else {
		?><a href="<?php echo gettext("$language_url/messages"); ?>" style="font-weight: bold;">(<?php echo mysqli_num_rows($result); ?> <?php echo ngettext('message','messages',mysqli_num_rows($result)); ?>)</a><?php
	}	?> - 
					<a href="<?php echo gettext("$language_url/logout"); ?>"><?php echo gettext('Log out'); ?></a>
<?php	} else { ?>
					<a href="<?php echo gettext("$language_url/login"); ?>"><?php echo gettext('Log in'); ?></a> - 
					<a href="<?php echo gettext("$language_url/register"); ?>"><?php echo gettext('Register'); ?></a>
<?php	} ?>
				</div>
				<form action="<?php echo (strncmp($uri,gettext("$language_url/users"),strlen(gettext("$language_url/users"))))==0 ? gettext("$language_url/users") : gettext("$language_url/search"); ?>" method="get" style="overflow: auto; margin-bottom: 15px;">
					<input type="submit" class="search-field-submit" value="<?php echo gettext('Search'); ?>" disabled="">
					<input type="text" name="q" class="search-field" onkeypress="if (document.getElementById('search-field').value.length < 3) { return event.keyCode!=13; }" placeholder="<?php echo gettext('Search for '.((strtolower(substr($uri,0,6))=='/users') ? 'users...' :  (isset($yyg) ? "YoYo Games archived games..." : 'games...'))); ?>" value="<?php if (!empty($_GET['q'])&&(strtolower(substr($uri,0,7))=='/search'||strncmp($uri,gettext("$language_url/users"),strlen(gettext("$language_url/users")))==0)) echo $_GET['q']; ?>">
<?php
		if (strncmp($uri,gettext("$language_url/users"),strlen(gettext("$language_url/users")))==0) {
?>
					
<?php
		} else {
?>
					<input type="hidden" name="yyg" value="<?php if (!empty($_GET['yyg'])||isset($yyg)) echo 'yes'; ?>">
					<input type="hidden" name="category" value="<?php if (!empty($_GET['category'])) echo $_GET['category']; else echo 'all'; ?>">
					<input type="hidden" name="stage" value="<?php if (!empty($_GET['stage'])) echo $_GET['stage']; else echo 'complete'; ?>">
<?php
		}
?>
				</form>
<?php
		$moderation_bar = array("$language_url/moderation/games","$language_url/moderation/comments","$language_url/moderation/users");
		if (isset($_SESSION['user_info']['type'])&&$_SESSION['user_info']['type']>=2) {
?>
				<div id="moderation-bar"<?php if (!in_array($uri,$moderation_bar)) { ?> class="autohide"<?php } ?>>
					<span class="label"><?php echo gettext('Moderation'); ?>:</span>
					<a href="<?php echo $language_url; ?>/moderation/games"<?php if ($uri=="$language_url/moderation/games") { ?> class="selected"<?php } ?>><?php echo ngettext('Game','Games',10); ?></a><a
					   href="<?php echo $language_url; ?>/moderation/comments"<?php if ($uri=="$language_url/moderation/comments") { ?> class="selected"<?php } ?>><?php echo ngettext('Comment','Comments',10); ?></a><a
					   href="<?php echo $language_url; ?>/moderation/users"<?php if ($uri=="$language_url/moderation/users") { ?> class="selected"<?php } ?>><?php echo ngettext('User','Users',10); ?></a>
				</div>
<?php
		}
		$main_bar = array(gettext("$language_url/browse"),gettext("$language_url/search"),gettext("$language_url/games"),gettext("$language_url/make"),gettext("$language_url/share"),gettext("$language_url/help"));
		//print_r($main_bar);
?>
				<div id="main-bar"<?php if (!in_array($uri,$main_bar)) { ?> class="autohide"<?php } ?>>
					<a href="<?php echo gettext($language_url.'/browse'); ?>"<?php if (strncmp($uri,$main_bar[0],strlen($main_bar[0]))==0||strncmp($uri,$main_bar[1],strlen($main_bar[1]))==0||strncmp($uri,$main_bar[2],strlen($main_bar[2]))==0) { ?> class="selected"<?php } ?>><?php echo gettext('Play'); ?></a><a
					   href="<?php echo gettext($language_url.'/make'); ?>"<?php if (strncmp($uri,$main_bar[3],strlen($main_bar[3]))==0) { ?> class="selected"<?php } ?>><?php echo gettext('Make'); ?></a><a
					   href="<?php echo gettext($language_url.'/share'); ?>"<?php if (strncmp($uri,$main_bar[4],strlen($main_bar[4]))==0) { ?> class="selected"<?php } ?>><?php echo gettext('Share'); ?></a><a
					   href="<?php echo gettext($language_url.'/help'); ?>"<?php if (strncmp($uri,$main_bar[5],strlen($main_bar[5]))==0) { ?> class="selected"<?php } ?>><?php echo gettext('Help'); ?></a>
				</div>
<?php
		if (!empty($_GET['message'])) {
?>
				<div id="message" style="margin-bottom: 8px;"><?php echo gettext($_GET['message']); ?></div>
<?php
		}
		if (!empty($_SESSION['report'])) {
			if ('http://gamemaker.mooo.com'.$_SERVER['REQUEST_URI']!=$_SESSION['report_url']) {
				unset($_SESSION['report']);
			} else {
?>
				<div class="container-lt float-right" style="overflow: auto; float: none; min-height: 0;">
					<div class="container-title-lt"><?php echo gettext('Reporting a') . ' ' . lcfirst(gettext(ucfirst($_SESSION['report']['type']))); ?></div>
					<form action="/report/<?php echo $_SESSION['report']['type']; ?>/<?php echo $_SESSION['report']['place']; ?>" enctype="multipart/form-data" method="post">
						<table class="upload-form">
							<col width="240" />
							<tr>
								<td>
									<label for="report_reason"><?php echo gettext('What would you tell us about this ' . $_SESSION['report']['type'] . '?'); ?></label>
								</td>
								<td>
									<textarea id="report_reason" name="report[reason]" cols="40" rows="4" <?php if (isset($errors['reason'])) echo 'class="redfield" '; ?>><?php if (!empty($_POST['report']['reason'])) echo $_POST['report']['reason']; ?></textarea>
								</td>
							</tr>
							<tr>
								<td></td>
								<td>
									<input name="commit" type="submit" value="<?php echo gettext('Submit'); ?>" style="display: block; float: right; width: 80px" />
								</td>
							</tr>
						</table>
					</form>
				</div>
<?php
			}
		}
?>
				<!--<div id="horizontal-line"></div>-->
<?php
	}
?>