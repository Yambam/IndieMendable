<?php
	//require_once(dirname(__FILE__) . '/forums/index.php');
	
	session_start();
	
	if (empty($_SESSION['username'])) {
		header("Location: http://gamemaker.mooo.com$language_url/login", true, 302);
		exit;
	}
	
	//if ($_GET['action']=='compose') {
		$js[] = '/js/ask_unload.js';
	//}
	
	if (empty($_GET['action'])||!in_array($_GET['action'],array('inbox','sent','trash','view','compose','preview'))) {
		$_GET['action'] = 'inbox';
	}
	
	require_once('config.php');
	$user_info = user_info($con,$_SESSION['user_id']);
	
	function date_short($timestamp,$time_offset_seconds) {
		global $language_abbr;
		if (date('d M Y',$timestamp)==date('d M Y')) {
			return time_elapsed_string(date('d-m-Y H:i:s',$timestamp));
		} else {
			if (date('Y',$timestamp)==date('Y')&&$language_abbr=='en') {
				return date('d F',$timestamp-3600-$time_offset_seconds);
			} else {
				//return date('d M \'',$timestamp) . substr(date('Y',$timestamp),2,2);
				return date('d/m/Y',$timestamp-3600-$time_offset_seconds);
			}
		}
	}
	
	if (!empty($_GET['reply_to'])) {
		$reply_to = mysql_escape_string($_GET['reply_to']);
		$result = mysqli_query($con,"SELECT * FROM messages WHERE id = $reply_to AND (sent_to = {$_SESSION['user_id']} OR sent_from = {$_SESSION['user_id']})");
		$row = mysqli_fetch_assoc($result);
		$sent_from_info = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM users WHERE id = {$row['sent_from']}"));
		$_POST['message']['send_to'] = $sent_from_info['username'];
		$_POST['message']['subject'] = 'Re: ' . $row['subject'];
		$_POST['message']['body'] = "[quote=/messages/$reply_to]\r\n{$row['body']}\r\n[/quote]\r\n";
	}
	
	function message_preview($con,$BBHandler,$user_info,$time_offset_seconds) {
		global $language_url;
		
?>
					<div class="container-title-lt"><?php echo gettext('Message preview (Last saved draft: '); ?><span id="draft-last-saved"><?php echo date('d F Y H:i:s',time()-3600-$time_offset_seconds); ?></span>)</div>
					<div <?php if (!empty($_POST['message']['body'])) { ?>style="border-bottom: 1px dotted #808080; padding-bottom: 5px; box-shadow: 0px 3px 2px rgba(0,0,0,.1);"<?php } ?>>
						<a href="/users/<?php echo $user_info['username']; ?>">
							<div class="picture" style="background-image: url('<?php echo str_replace('/original/','/thumb/',$user_info['picture']); ?>'); height: 40px; width: 40px; margin: 10px; margin-left: 4px;"></div>
						</a><h2 style="margin: 4px;"><?php echo empty($_POST['message']['subject']) ? gettext('Message preview') : htmlspecialchars($_POST['message']['subject']); ?></h2>
						<a href="/users/<?php echo $user_info['username']; ?>"><?php echo htmlspecialchars($user_info['username']); ?></a>, 
						<?php echo date('l d F Y H:i:s',time()-3600-$time_offset_seconds); ?><br>
					</div>
<?php
		if (!empty($_POST['message']['body'])) {
?>
					<p>
						<?php echo message_parse(str_replace("[quote=/messages/","[quote=$language_url/messages/",empty($_POST['message']['body']) ? '' : $_POST['message']['body']),$BBHandler,$con); ?>
<?php
		}
	}
	
	function show_header($con) {
		global $language_url,$language_abbr,$languages,$language;
		
		if ($_GET['action']=='compose') {
			$js[] = '/js/ask_unload.js';
		}
		$page_title = ucfirst(ngettext('Message','Messages',2)); include('default-top.php');
?>

				<div class="container dark dark2 clear-left" style="width: 178px; margin-right: 15px;">
					<div class="container-title">Inbox</div>
					<div id="category-chooser" class="smallfont2" style="max-height: initial;">
						<a <?php if ($_GET['action']=='compose') { ?> class="selected" <?php } ?> href="<?php echo $language_url; ?>/messages/compose"><span class="fa fa-envelope" style="margin-right: 10px;"></span><?php echo gettext('Compose new message'); ?></a>
						<div style="height: 5px;"></div>
						<a <?php if ($_GET['action']=='inbox') { ?> class="selected" <?php } ?> href="<?php echo $language_url; ?>/messages"><span class="fa fa-inbox" style="margin-right: 12px;"></span>Inbox</a>
						<a <?php if ($_GET['action']=='sent') { ?> class="selected" <?php } ?> href="<?php echo $language_url; ?>/messages/sent"><span class="fa fa-plane" style="margin-right: 12px;"></span><?php echo gettext('Sent items'); ?></a>
						<a <?php if ($_GET['action']=='trash') { ?> class="selected" <?php } ?> href="<?php echo $language_url; ?>/messages/trash"><span class="fa fa-trash" style="margin-right: 12px;"></span><?php echo gettext('Deleted items'); ?></a>
					</div>
				</div>
<?php
		$friend1 = $_SESSION['user_id'];
		$result = mysqli_query($con,"SELECT * FROM ((SELECT *, friend2 AS other FROM friends WHERE approved = 1 AND friend1 = $friend1) UNION
													(SELECT *, friend1 AS other FROM friends WHERE approved = 1 AND friend2 = $friend1)) AS x
									ORDER BY (SELECT MIN(UNIX_TIMESTAMP(last_active)) FROM users WHERE id = other) DESC");
		
		if (mysqli_num_rows($result)==0) {
?>
				<div class="container dark" style="width: 178px; min-height: 0; margin-right: 15px; clear: left;">
					<div class="container-title"><?php echo ngettext('Friend','Friends',2); ?></div>
					<div class="item smallfont2" style="text-align: center; margin: 2em 0 2em; border-top: 1px solid transparent;">
						<?php echo gettext('You haven\'t added any friends yet.'); ?>
					</div>
				</div>
<?php
		} else {
?>
				<div class="container dark" style="width: 178px; min-height: 0; margin-right: 15px; clear: left;">
					<div class="container-title"><?php echo ngettext('Friend','Friends',2); ?></div>
					<div class="friends items even-odd-dark seperators smallfont2" style="max-height: 223px; overflow: auto;">
<?php
			while($row = mysqli_fetch_assoc($result)) {
				if ($row['friend1']==$friend1) {
					$friend_id = $row['friend2'];
				} else {
					$friend_id = $row['friend1'];
				}
				$friend = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM users WHERE id = $friend_id"));
				if ($friend['picture']=='') {
					$friend['picture'] = $no_picture;
				}
				
				if (time() - strtotime($friend['last_active']) < 600) {
					$friend['state'] = 'Online';
				} else {
					$friend['state'] = 'Offline';
				}
?>
						<div class="friend item">
							<div class="user-link">
								<a href="/users/<?php echo $friend['username']; ?>">
									<div class="picture-alt" style="background-image: url('<?php echo str_replace('/original/','/thumb/',$friend['picture']); ?>');"></div>
									<?php echo $friend['username']; ?></a> <a class="fa fa-envelope" href="<?php echo $language_url; ?>/messages/compose?to=<?php echo $friend['username']; ?>" title="<?php echo gettext('Send message to'); ?> <?php echo $friend['username']; ?>"></a> <span class="last-active last-active-<?php echo strtolower($friend['state']); ?>" title="<?php echo gettext('Last active'); ?>: <?php
				if ($friend['last_active']>0) echo time_elapsed_string($friend['last_active']); ?>" data-datetime="<?php
				if ($friend['last_active']>0) echo date('Y-m-d H:i:s',strtotime($friend['last_active'])); ?>"><?php echo $friend['state']; ?></span><br>
									<?php echo $friend['location']; ?>
									<div style="clear: both;"></div>
							</div>
						</div>
<?php
			}
?>
					</div>
				</div>
<?php
		}
	}
?>
<?php
	if (true||!empty($_SESSION['betabeta'])) {
		if ($_GET['action']=='view') {
			$message_id = mysql_escape_string($_GET['q']);
			$result = mysqli_query($con,"SELECT * FROM messages WHERE id = $message_id AND (sent_to = {$_SESSION['user_id']} OR sent_from = {$_SESSION['user_id']})");
			if (mysqli_num_rows($result)==0) {
				show_header($con);
?>
				<div class="container-lt float-right" style="overflow: auto; float: none;">
					<div class="container-title-lt"><?php echo gettext('Viewing message'); ?></div>
					<div class="item smallfont2" style="text-align: center; margin: 3em 0 3em; border-top: 1px solid transparent;">
						<?php echo gettext('Oops, we couldn\'t find the message you were looking for.'); ?>
					</div>
				</div>
<?php
			} else {
				$row = mysqli_fetch_assoc($result);
				$message_author = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM users WHERE id = {$row['sent_from']}"));
				
				//Mark as read
				$result = mysqli_query($con,"UPDATE messages SET `read` = 1 WHERE id = $message_id AND sent_to = {$_SESSION['user_id']}");
				$read = mysqli_num_rows(mysqli_query($con,"SELECT id FROM messages WHERE id = $message_id AND `read` = 1 AND sent_from = {$_SESSION['user_id']}"))>=1;
				
				show_header($con);
?>
				<div class="container-lt float-right" style="overflow: auto; float: none;">
					<div class="container-title-lt"><?php echo gettext('Viewing message'); ?></div>
					<div style="border-bottom: 1px dotted #808080; padding-bottom: 5px; box-shadow: 0px 3px 2px rgba(0,0,0,.1);">
						<?php
	if ($message_author['id']!=$_SESSION['user_id']) {
		?><a href="<?php echo $language_url; ?>/messages/compose?reply_to=<?php echo $message_id; ?>" style="float: right; font-size: .8em;"><span class="fa fa-reply" style="margin-right: 5px;"></span><?php echo gettext('Reply'); ?></a><?php
	} ?><a href="/users/<?php echo $message_author['username']; ?>">
							<div class="picture" style="background-image: url('<?php echo str_replace('/original/','/thumb/',$message_author['picture']); ?>'); height: 40px; width: 40px; margin: 10px; margin-left: 4px;"></div>
						</a><h2 style="margin: 4px;"><?php echo htmlspecialchars($row['subject']); ?></h2>
						<a href="/users/<?php echo $message_author['username']; ?>"><?php echo htmlspecialchars($message_author['username']); ?></a>, 
						<?php echo date('l d F Y H:i:s',strtotime($row['posted'])-3600-$time_offset_seconds); if ($read) echo ' [READ]';?><br>
					</div>
					<p>
						<?php echo message_parse(str_replace("[quote=/messages/","[quote=$language_url/messages/",empty($row['body']) ? '' : $row['body']),$BBHandler,$con); ?>
				</div>
<?php
			}
		} elseif ($_GET['action']=='preview') {
			message_preview($con,$BBHandler,$user_info,$time_offset_seconds);
			exit;
		} elseif ($_GET['action']=='compose') {
			if (false&&empty($_SESSION['betabeta'])) {
				show_header($con);
?>
				<div class="container-lt float-right" style="overflow: auto; float: none;">
					<div class="container-title-lt"><?php echo gettext('Composing new message'); ?></div>
					<div class="item smallfont2" style="text-align: center; margin: 5em 0 5em; border-top: 1px solid transparent;">
						Oops. This feature is not completely done yet. Come back later. :)
					</div>
				</div>
					
<?php
			} else {
				if (!empty($_POST)&&empty($_GET['reply_to'])) {
					$errors = array();
					
					if (empty($_POST['message']['send_to'])) {
						$errors['send_to'] = 'Please enter a username here.';
					} else {
						$username = mysql_escape_string($_POST['message']['send_to']);
						$result = mysqli_query($con,"SELECT * FROM users WHERE username = '$username'");
						$send_to_info = mysqli_fetch_assoc($result);
						if (mysqli_num_rows($result)==0) {
							$errors['send_to'] = 'Can\'t find user "' . htmlspecialchars($_POST['message']['send_to']) . '".';
						}
					}
					
					if (empty($_POST['message']['subject'])) {
						$errors['subject'] = 'Please enter a subject for the message.';
					}
					
					if (empty($_POST['message']['body'])) {
						$errors['body'] = 'Please enter a message.';
					}
					
					if (empty($errors)) {
						$ip = $con->real_escape_string($_SERVER['REMOTE_ADDR']);
						$sent_from = $_SESSION['user_id'];
						$sent_to = $send_to_info['id'];
						$subject = $con->real_escape_string($_POST['message']['subject']);
						$body = $con->real_escape_string($_POST['message']['body']);
						
						$result = mysqli_query($con,"INSERT INTO messages (ip,sent_from,sent_to,subject,body) VALUES ('$ip',$sent_from,$sent_to,'$subject','$body')");
						$_SESSION['message'] = 'You successfully sent your message to ' . htmlspecialchars($send_to_info['username']) . '!';
						if (!$result) {
							$_SESSION['message'] = mysqli_error($con);
						}
						header("Location: http://gamemaker.mooo.com$language_url/messages/sent", true, 302);
					}
				}
				
				$autofocus = '';
				if (empty($_POST['message']['send_to'])&&empty($_GET['to'])) {
					$autofocus = 'send_to';
				} elseif (empty($_POST['message']['subject'])) {
					$autofocus = 'subject';
				} elseif (empty($_POST['message']['body'])) {
					$autofocus = 'body';
				}
				show_header($con);
?>
				<div class="container-lt float-right" style="overflow: auto; float: none;">
					<div class="container-title-lt"><?php echo gettext('Composing new message'); ?></div>
<?php $i=0; if (!empty($errors)) foreach($errors as $error) { ?>
					<div class="errormessage" style="animation-delay: <?php echo 1+($i++)/50; ?>s;"><?php echo $error; ?></div>
<?php } ?>
					<form action="<?php echo $language_url; ?>/messages/compose" enctype="multipart/form-data" method="post">
						<label style="display: block; margin-bottom: 2px;"><?php echo gettext('To'); ?>: <input id="message_send_to" name="message[send_to]" <?php if ($autofocus=='send_to') echo 'autofocus="" '; if (isset($errors['send_to'])) echo 'class="redfield" '; ?> type="text" style="width: 80%; width: calc(100% - 100px);" value="<?php if (!empty($_POST['message']['send_to'])) echo htmlspecialchars($_POST['message']['send_to']); elseif (!empty($_GET['to'])) echo htmlspecialchars($_GET['to']); ?>" /></label>
						<label style="display: block; margin-bottom: 2px;"><?php echo gettext('Subject'); ?>: <input id="message_subject" name="message[subject]" <?php if ($autofocus=='subject') echo 'autofocus="" '; if (isset($errors['subject'])) echo 'class="redfield" '; ?> type="text" style="width: 80%; width: calc(100% - 100px);" value="<?php if (!empty($_POST['message']['subject'])) echo htmlspecialchars($_POST['message']['subject']); ?>" /></label><br>
						<label><?php echo gettext('Message'); ?>:<br>
						<textarea id="message_body" name="message[body]" <?php if ($autofocus=='body') echo 'autofocus="" '; if (isset($errors['body'])) echo 'class="redfield" '; ?> style="float: none; height: 200px; resize: vertical;"><?php if (!empty($_POST['message']['body'])) echo htmlspecialchars($_POST['message']['body']); ?></textarea></label><br><br>
						<input id="post-comment" type="submit" value="<?php echo gettext('Send message'); ?>" style="box-sizing: border-box; width: 120px; float: right;">
						<span style="color: #808080;" class="smallfont2"><?php echo gettext('Tip: You can use BBCode in messages. :)'); ?></span>
					</form>
				</div>
				<div id="message_preview" class="container-lt float-right" style="overflow: auto; float: none; min-height: 0; margin-left: 208px;">
					<?php message_preview($con,$BBHandler,$user_info,$time_offset_seconds); ?>
				</div>
<?php
			}
			
			/*global $smcFunc;
			define('SMF',true);
			
			require_once(dirname(__FILE__) . '/forums/Sources/Load.php');
			$boarddir = dirname(__FILE__) . '/forums';
			$sourcedir = dirname(__FILE__) . '/forums/Sources';

			// Load the settings...
			require_once(dirname(__FILE__) . '/forums/Settings.php');

			// Make absolutely sure the cache directory is defined.
			if ((empty($cachedir) || !file_exists($cachedir)) && file_exists($boarddir . '/cache'))
				$cachedir = $boarddir . '/cache';

			// And important includes.
			require_once($sourcedir . '/QueryString.php');
			require_once($sourcedir . '/Subs.php');
			require_once($sourcedir . '/Errors.php');
			require_once($sourcedir . '/Load.php');
			require_once($sourcedir . '/Security.php');
			require_once($sourcedir . '/DbPackages-mysql.php');
			include(dirname(__FILE__) . '/forums/Sources/Subs-Editor.php');
			include(dirname(__FILE__) . '/forums/Themes/default/GenericControls.template.php');
			
			//print_r($smcFunc);
			
			$editorOptions = array(
				'id' => 'message',
				'value' => '',
				'height' => '175px',
				'width' => '100%',
				'labels' => array(
					'post_button' => 'Send message',
				),
			);
			create_control_richedit($editorOptions);*/
?>
					
<?php
		} else {
			show_header($con);
?>
				<div class="container-lt float-right" style="overflow: auto; float: none;">
					<div class="container-title-lt"><?php echo ucfirst(ngettext('Message','Messages',2)); ?></div>
<?php
			if ($_GET['action']=='sent') {
				$result = mysqli_query($con,"SELECT * FROM messages WHERE (type = 1 OR type = -1 OR type = -3) AND sent_from = {$_SESSION['user_id']} ORDER BY id DESC");
			} elseif ($_GET['action']=='trash') {
				if (!empty($_GET['id'])) {
					$message_id = mysql_escape_string($_GET['id']);
					$result = mysqli_query($con,"UPDATE messages SET type = -4 WHERE id = $message_id AND type < 0 AND place = {$_SESSION['user_id']}");
					if (!mysqli_affected_rows($con)) {
						$result = mysqli_query($con,"UPDATE messages SET type = -1, place = {$_SESSION['user_id']} WHERE id = $message_id AND sent_to = {$_SESSION['user_id']}");
						$result = mysqli_query($con,"UPDATE messages SET type = -2, place = {$_SESSION['user_id']} WHERE id = $message_id AND sent_from = {$_SESSION['user_id']}");
						$result = mysqli_query($con,"UPDATE messages SET type = -3, place = {$_SESSION['user_id']} WHERE id = $message_id AND sent_to = {$_SESSION['user_id']} AND sent_from = {$_SESSION['user_id']}");
					}
				}
				$result = mysqli_query($con,"SELECT * FROM messages WHERE place = {$_SESSION['user_id']} AND type < 0 AND type != -4 ORDER BY id DESC");
			} else {
				$result = mysqli_query($con,"SELECT * FROM messages WHERE type = 1 AND sent_to = {$_SESSION['user_id']} ORDER BY id DESC");
			}
			if (mysqli_num_rows($result)==0) {
?>
					<div class="item" style="text-align: center; height: 120px; line-height: 120px;"><?php echo gettext('No messages found.'); ?></div>
<?php
			} else {
				if (!empty($_GET['action'])&&$_GET['action']=='sent') {
?>
					<div class="messages-hrow">
						<div class="messages-hcolumn" style="width: 120px; float: left"><?php echo gettext('To'); ?></div>
						<div class="messages-hcolumn" style="width: 125px; float: right; margin-left: 4px;"><?php echo gettext('Sent'); ?></div>
						<div class="messages-hcolumn" style="overflow: auto; float: none;"><?php echo gettext('Subject'); ?></div>
					</div>
					<div class="messages items smallfont2" data-per-page="12">
<?php
				while($row = mysqli_fetch_assoc($result)) {
					$to = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM users WHERE id = {$row['sent_to']}"));
					//for($i=0;$i<32;$i+=1) {
?>
						<div class="message item">
							<div class="messages-column" style="width: 120px; float: left"><a href="/users/<?php echo $to['username']; ?>"><?php echo htmlspecialchars($to['username']); ?></a></div>
							<div class="messages-column messages-column-sent" style="width: 125px; float: right;"><?php echo date_short(strtotime($row['posted']),$time_offset_seconds); ?></div>
							<a class="messages-column messages-column-subject" href="<?php echo $language_url; ?>/messages/<?php echo $row['id']; ?>" style="display: block; overflow: auto; float: none;"><?php echo htmlspecialchars($row['subject']); ?></a>
						</div>

<?php
					//}
				}
?>
					</div>
<?php
				} else {
?>
					<div class="messages-hrow">
						<div class="messages-hcolumn" style="width: 120px; float: left"><?php echo gettext('From'); ?></div>
						<div class="messages-hcolumn" style="width: 125px; float: right; margin-left: 4px;"><?php echo gettext('Sent'); ?></div>
						<div class="messages-hcolumn" style="overflow: auto; float: none;"><?php echo gettext('Subject'); ?></div>
					</div>
					<div class="messages items smallfont2" data-per-page="12">
<?php
				while($row = mysqli_fetch_assoc($result)) {
					//for($i=0;$i<32;$i+=1) {
					$from = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM users WHERE id = {$row['sent_from']}"));
?>
						<div class="message item">
							<div class="messages-column" style="width: 120px; float: left"><a href="/users/<?php echo $from['username']; ?>"><?php echo htmlspecialchars($from['username']); ?></a></div>
							<div class="messages-column messages-column-hide" style="float: right;"><a href="<?php echo $language_url; ?>/messages/compose?reply_to=<?php echo $row['id']; ?>"><span class="fa fa-reply" style="margin-right: 5px;"></span><?php echo gettext('Reply'); ?></a> <a href="<?php echo $language_url; ?>/messages/trash?id=<?php echo $row['id']; ?>" style="margin-left: 40px; color: rgba(0,0,0,.5);" title="<?php echo gettext('Delete message'); ?>"><span class="fa fa-times" style="margin: 0 5px;"></span></a></div>
							<div class="messages-column messages-column-sent" style="width: 125px; float: right;"><?php echo date_short(strtotime($row['posted']),$time_offset_seconds); ?></div>
							<a class="messages-column messages-column-subject" href="<?php echo $language_url; ?>/messages/<?php echo $row['id']; ?>" style="display: block; overflow: auto; float: none;<?php if ($row['read']==0) { ?> font-weight: bold;<?php } ?>"><?php echo htmlspecialchars($row['subject']); ?></a>
						</div>

<?php
					//}
				}
?>
					</div>
<?php
				}
			}
?>
				</div>
<?php
		}
	}/* else {
		show_header($con);
?>
					<div class="item" style="text-align: center; height: 120px; line-height: 120px;">No messages found.</div>
				</div>
<?php
	}*/
?>

<?php include('default-bottom.php'); ?>
