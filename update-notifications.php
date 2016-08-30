<h1>Update notifications and forum users</h1>
<pre>
<?php
	require_once('config.php');
	require_once('vendor/autoload.php');
	require_once('global_passwd.php');
	
	//Forum users and elFinder folders
	$result = mysqli_query($con,"SELECT * FROM users WHERE type != 0");
	while($row = mysqli_fetch_assoc($result)) {
		//print_r($row);
		
		$id_member = mysql_escape_string($row['id']);
		$member_name = mysql_escape_string($row['username']);
		$date_registered = mysql_escape_string(strtotime($row['registered']));
		$real_name = mysql_escape_string($member_name);
		
		$converter = new Converter\HTMLConverter($Parsedown->setBreaksEnabled(true)->text($row['description']),'description');
		
		$cust_descri = mysql_escape_string($converter->toBBCode());
		//$real_name = $row['firstname'] . ' ' . $row['lastname'];
		if ($real_name==' ') {
			$real_name = $member_name;
		}
		$passwd = mysql_escape_string(sha1(strtolower($member_name).$_GLOBALS['forum_passwd'])); //$row['password'];
		$email_address = mysql_escape_string($row['email']);
		$birthdate = mysql_escape_string($row['date_of_birth']);
		$location = mysql_escape_string($row['location']);
		$signature = mysql_escape_string($row['signature']);
		$avatar = mysql_escape_string('http://gamemaker.mooo.com' . $row['picture']);
		
		/*if ($result2 = mysqli_query($con_forums,"UPDATE gmf_members SET member_name = '$member_name', date_registered = '$date_registered', real_name = '$real_name', passwd = '$passwd', email_address = '$email_address', birthdate = '$birthdate', location = '$location', signature = '$signature', avatar = '$avatar' WHERE id_member = '$id_member'")) {
			
		} else {
			echo 'Error: ' . mysqli_error($con_forums);
			exit;
		}
		list($matched, $changed, $warnings) = sscanf(mysqli_info($con_forums), "Rows matched: %d Changed: %d Warnings: %d");
		if ($matched==0) {
			if ($result2 = mysqli_query($con_forums,"INSERT INTO gmf_members (id_member, member_name, date_registered, real_name, message_labels, buddy_list, passwd, openid_uri, email_address, birthdate, location, hide_email, signature, avatar, pm_email_notify, ignore_boards) VALUES ('$id_member', '$member_name', '$date_registered', '$real_name', '', '', '$passwd', '', '$email_address', '$birthdate', '$location', 1, '$signature', '$avatar', '1', '')")) {
				
			} else {
				echo 'Error: ' . mysqli_error($con_forums);
				exit;
			}
			echo 'Created new account '.$member_name;
		} else {
			echo 'Updated account '.$member_name;
		}
		
		if (!mysqli_query($con_forums,"UPDATE gmf_settings SET value = '$id_member' WHERE variable = 'latestMember'")) {
			echo 'Error: ' . mysqli_error($con_forums);
		}
		if (!mysqli_query($con_forums,"UPDATE gmf_settings SET value = '$member_name' WHERE variable = 'latestRealName'")) {
			echo 'Error: ' . mysqli_error($con_forums);
		}
		
		if (!mysqli_query($con_forums,"UPDATE gmf_themes SET value = '$cust_descri' WHERE id_member = '$id_member' AND variable = 'cust_descri'")) {
			echo 'Error: ' . mysqli_error($con_forums);
		}
		list($matched, $changed, $warnings) = sscanf(mysqli_info($con_forums), "Rows matched: %d Changed: %d Warnings: %d");
		if ($matched==0) {
			if ($result2 = mysqli_query($con_forums,"INSERT INTO gmf_themes (id_member, variable, value) VALUES ('$id_member', 'cust_descri', '$cust_descri')")) {
				
			} else {
				echo 'Error: ' . mysqli_error($con_forums);
				exit;
			}
			echo "\r\n    Created new description ".$member_name;
		} else {
			echo "\r\n    Updated description ".$member_name;
		}*/
		
		echo "\n";
		
		$id_folder = mysql_escape_string(1000000+$row['id']);
		if ($result2 = mysqli_query($con,"UPDATE elfinder_file SET name = 'Games by $member_name', `write` = '0' WHERE id = '$id_folder'")) {
			/*, passwd = '$passwd'*/
		} else {
			echo 'Error: ' . mysqli_error($con);
			exit;
		}
		list($matched, $changed, $warnings) = sscanf(mysqli_info($con), "Rows matched: %d Changed: %d Warnings: %d");
		if ($matched==0) {
			$mtime = time();
			if ($result2 = mysqli_query($con,"INSERT INTO elfinder_file (id, parent_id, name, content, mtime, mime, width, height, `write`) VALUES ('$id_folder', 0, 'Games by $member_name', '', '$mtime', 'directory', '0', '0', '0')")) {
				
			} else {
				echo 'Error: ' . mysqli_error($con);
				exit;
			}
			echo 'Created new elFinder entry '.$member_name;
		} else {
			echo 'Updated elFinder entry '.$member_name;
		}
		
		$_result = mysqli_query($con,"SELECT * FROM games WHERE state >= 2 AND author = $id_member");
		while($_row = mysqli_fetch_assoc($_result)) {
			$id_game = mysqli_escape_string($con,2000000+$_row['id']);
			$game_name = mysqli_escape_string($con,$_row['name']);
			if ($result2 = mysqli_query($con,"UPDATE elfinder_file SET name = '$game_name' WHERE id = '$id_game'")) {
				/*, passwd = '$passwd'*/
			} else {
				echo 'Error: ' . mysqli_error($con);
				exit;
			}
			list($matched, $changed, $warnings) = sscanf(mysqli_info($con), "Rows matched: %d Changed: %d Warnings: %d");
			if ($matched==0) {
				$mtime = time();
				if ($result2 = mysqli_query($con,"INSERT INTO elfinder_file (id, parent_id, name, content, mtime, mime, width, height) VALUES ('$id_game', '$id_folder', '$game_name', '', '$mtime', 'directory', '0', '0')")) {
					
				} else {
					echo 'Error: ' . mysqli_error($con);
					exit;
				}
				//echo 'Created new elFinder entry '.$member_name;
			} else {
				//echo 'Updated elFinder entry '.$member_name;
			}
		}
		
		echo "\n\n";
		flush();
		ob_flush();
	}
	
	//Notifications
	$_SESSION['notifications'] = array();
	
	function cmp($a,$b) {
		return $b['posted']-$a['posted'];
	}
	
	$result_users = mysqli_query($con,"SELECT * FROM users WHERE type >= 1");
	while($row_user = mysqli_fetch_assoc($result_users)) {
		$result = mysqli_query($con,"SELECT * FROM subscriptions WHERE type = 1 AND author = {$row_user['id']} ORDER BY id DESC");
		
		while($row = mysqli_fetch_assoc($result)) {
			$place_id = mysql_escape_string($row['place']);
			$place = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM users WHERE id = $place_id"));
			if ($place['picture']=='') {
				$place['picture'] = $no_picture;
			}
			
			if ($row['type']==1) {
				$result2 = mysqli_query($con,"SELECT * FROM comments WHERE type = 1 AND place = $place_id AND domain != 'unassigned' AND author != 0 ORDER BY id DESC");
				while($row2 = mysqli_fetch_assoc($result2)) {
					$author_id = mysql_escape_string($row2['author']);
					if ($row2['author']==$row_user['id']) {
						continue;
					}
					$author = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM users WHERE id = $author_id"));
					if ($author['picture']=='') {
						$author['picture'] = $no_picture;
					}
					
					$notification_info = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM notifications WHERE type = 1 AND place = '$place_id' AND item_id = '{$row2['id']}'"));
					if ($notification_info['notified']&1) {
						$url = '/users/' . $author['username'];
						$image_url = '/users/' . $place['username'];
						if (strpos('/',$row2['domain'])>=1) {
							$url = explode('/',$row2['domain'])[1] . $url;
							$image_url = explode('/',$row2['domain'])[1] . $image_url;
						}
						$_SESSION['notifications'][] = array(
							'msg' => time_elapsed_string($row2['posted']).' '.$author['username'].' commented on the member '.$place['username'],
							'msg2' => $author['username'].' commented on the member '.$place['username'],
							'url' => $url,
							'image' => $place['picture'],
							'image_url' => $image_url,
							'posted' => strtotime($row2['posted']),
							'domain' => $row2['domain'],
						);
						echo 'Just notified about '.time_elapsed_string($row2['posted'])." (comment {$row2['id']}) \r\n";
					} else {
						//echo 'Already notified about '.time_elapsed_string($row2['posted'])." ({$row2['id']}) \r\n";
					}
				}
			}
		}
		//echo "\r\n";
		
		//Own user profile.
		$place_id = mysql_escape_string($row_user['id']);
		$place = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM users WHERE id = $place_id"));
		if ($place['picture']=='') {
			$place['picture'] = $no_picture;
		}
		
		$result2 = mysqli_query($con,"SELECT * FROM comments WHERE type = 1 AND place = $place_id AND domain != 'unassigned' AND author != 0 ORDER BY id DESC");
		while($row2 = mysqli_fetch_assoc($result2)) {
			$author_id = mysql_escape_string($row2['author']);
			if ($row2['author']==$row_user['id']) {
				continue;
			}
			$author = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM users WHERE id = $author_id"));
			if ($author['picture']=='') {
				$author['picture'] = $no_picture;
			}
			
			$notification_info = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM notifications WHERE type = 1 AND place = '$place_id' AND item_id = '{$row2['id']}'"));
			if (!$notification_info['notified']) {
				$url = '/users/' . $author['username'];
				$image_url = '/users/' . $place['username'];
				if (strpos('/',$row2['domain'])>=1) {
					$url = explode('/',$row2['domain'])[1] . $url;
					$image_url = explode('/',$row2['domain'])[1] . $image_url;
				}
				$_SESSION['notifications'][] = array(
					'msg' => time_elapsed_string($row2['posted']).' '.$author['username'].' commented on the member '.$place['username'],
					'msg2' => $author['username'].' commented on the member '.$place['username'],
					'url' => $url,
					'image' => $place['picture'],
					'image_url' => $image_url,
					'posted' => strtotime($row2['posted']),
					'domain' => $row2['domain'],
					
					'id' => $row2['id'],
					'content' => $row2['content'],
					'type' => 1,
					'place' => $place_id,
					'author' => $author_id,
					'read' => strtotime($notification_info['read']),
					'notified' => strtotime($notification_info['notified']),
					
					'email' => $row_user['email'],
					'username' => $row_user['username'],
				);
				echo 'Just notified about '.time_elapsed_string($row2['posted'])." ({$row2['id']}) \r\n";
			} else {
				//echo 'Already notified about '.time_elapsed_string($row2['posted'])." ({$row2['id']}) \r\n";
			}
		}
		//echo "\r\n";
		
		//Own games.
		$result_games = mysqli_query($con,"SELECT * FROM games WHERE state >= 2 AND author = {$row_user['id']}");
		while($row_game = mysqli_fetch_assoc($result_games)) {
			//print_r($row_game);
			$place_id = mysql_escape_string($row_game['id']);
			$place = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM games WHERE id = $place_id"));
			if ($place['picture']=='') {
				$place['picture'] = $no_picture;
			}
			
			$result2 = mysqli_query($con,"SELECT * FROM comments WHERE type = 2 AND place = $place_id AND domain != 'unassigned' AND author != 0 ORDER BY id DESC");
			while($row2 = mysqli_fetch_assoc($result2)) {
				$author_id = mysql_escape_string($row2['author']);
				if ($row2['author']==$row_user['id']) {
					continue;
				}
				$author = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM users WHERE id = $author_id"));
				if ($author['picture']=='') {
					$author['picture'] = $no_picture;
				}
				//print_r($author);
				
				$notification_info = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM notifications WHERE type = 2 AND place = '$place_id' AND item_id = '{$row2['id']}'"));
				//echo "\r\nSELECT * FROM notifications WHERE type = 2 AND place = '$place_id' AND item_id = '{$row2['id']}'\r\n";
				if (!$notification_info['notified']) {
					$url = '/users/' . $author['username'];
					$image_url = '/games/' . $place['id'];
					if (strpos('/',$row2['domain'])>=1) {
						$url = explode('/',$row2['domain'])[1] . $url;
						$image_url = explode('/',$row2['domain'])[1] . $image_url;
					}
					$_SESSION['notifications'][] = array(
						'msg' => time_elapsed_string($row2['posted']).' '.$author['username'].' commented on the game '.$place['name'],
						'msg2' => $author['username'].' commented on the game '.$place['name'],
						'url' => $url,
						'image' => $place['picture'],
						'image_url' => $image_url,
						'posted' => strtotime($row2['posted']),
						'domain' => $row2['domain'],
						
						'id' => $row2['id'],
						'content' => $row2['content'],
						'type' => 2,
						'place' => $place_id,
						'author' => $author_id,
						'read' => strtotime($notification_info['read']),
						'notified' => strtotime($notification_info['notified']),
						
						'email' => $row_user['email'],
						'username' => $row_user['username'],
					);
					echo 'Just notified about '.time_elapsed_string($row2['posted'])." ({$row2['id']}) \r\n";
				} else {
					//echo 'Already notified about '.time_elapsed_string($row2['posted'])." ({$row2['id']}) \r\n";
				}
			}
		}
		//echo "\r\n";
	}
	
	usort($_SESSION['notifications'],"cmp");
	
	foreach($_SESSION['notifications'] as $notification) {
		$i[$notification['email']] = 0;
	}
	/*foreach($_SESSION['notifications'] as $notification) {
		$i[$notification['email']]+=1;
	}*/
	foreach($_SESSION['notifications'] as $notification) {
		$email = $notification['email'];
		if (empty($email)) {
			continue;
		}
		$headers  = "From: IndieMendable <info@gamemaker.mooo.com>\r\n";
		$headers .= "To: $email\r\n";
		
		//if ($i[$email]<7) {
			//echo $headers;
			//echo $notification['content']."\r\n\r\n";
			
			if ($email=='ima.habekotte@gmail.com') {
				mail($email, $notification['msg2'], "Dear {$notification['username']},\r\n\r\nYou received a notification from our website.\r\n{$notification['msg']}:\r\n\r\n{$notification['content']}\r\n\r\nURL: http://gamemaker.mooo.com{$notification['image_url']} (Domain: {$notification['domain']})\r\n\r\n- IndieMendable", $headers);
				sleep(1);
			}
			
			echo $headers . "Dear {$notification['username']},\r\n\r\nYou received a notification from our website.\r\n{$notification['msg']}:\r\n\r\n{$notification['content']}\r\n\r\nURL: http://gamemaker.mooo.com{$notification['image_url']} (Domain: {$notification['domain']})\r\n\r\n- IndieMendable\r\n";
			
			echo str_repeat('<!----->',1024*8);
			flush();
			ob_flush();
		//}
		
		$type_sql = mysqli_escape_string($con,$notification['type']);
		$place_sql = mysqli_escape_string($con,$notification['place']);
		$author_sql = mysqli_escape_string($con,$notification['author']);
		$domain_sql = mysqli_escape_string($con,$notification['domain']);
		$ip = mysqli_escape_string($con,$_SESSION['ip']);
		$item_id_sql = mysqli_escape_string($con,$notification['id']);
		
		if ($result = mysqli_query($con,"UPDATE notifications SET notified = notified | 1 WHERE type = '$type_sql' AND place = '$place_sql' AND item_id = '$item_id_sql'")) {
			
		} else {
			echo 'Error: ' . mysqli_error($con);
			exit;
		}
		list($matched, $changed, $warnings) = sscanf(mysqli_info($con), "Rows matched: %d Changed: %d Warnings: %d");
		if ($matched==0) {
			if ($result2 = mysqli_query($con,"INSERT INTO notifications (type,place,domain,ip,author,item_id,notified) VALUES ($type_sql,$place_sql,'$domain_sql','$ip','$author_sql','$item_id_sql',1)")) {
				
			} else {
				echo 'Error: ' . mysqli_error($con);
				exit;
			}
			//echo 'Created new account '.$member_name;
		} else {
			//echo 'Updated account '.$member_name;
		}
		
		$i[$email]+=1;
	}
?>
</pre>
