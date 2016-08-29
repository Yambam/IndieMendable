<?php
	session_start();
	require_once "config.php";
	require_once "password.php";
	
	if (empty($_SESSION['username'])) {
		header("Location: http://gamemaker.mooo.com/login", true, 302);
		exit;
	}
	$user = $_SESSION['username'];
	
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
				$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
			} else {
				unset($string[$k]);
			}
		}
		
		if (!$full) $string = array_slice($string, 0, 1);
		return $string ? implode(', ', $string) . ' ago' : 'just now';
	}
	
	function get_user_info($con,$user) {
		$user = mysql_escape_string($user);
		$result = mysqli_query($con,"SELECT * FROM users WHERE username = '$user'");
		if (mysqli_num_rows($result) >= 1) {
			$user_info = mysqli_fetch_array($result);
			if ($user_info['picture']==''||!file_exists($user_info['picture'])) {
				$user_info['picture'] = '/img/no-picture.png';
				if (!empty($_SESSION['theme'])) {
					if ($_SESSION['theme']=='dark') {
						$user_info['picture'] = '/img/no-picture-dark.png';
					}
				}
			}
			
			if (time() - strtotime($user_info['last_active']) < 600) {
				$user_info['state'] = 'Online';
			} else {
				$user_info['state'] = 'Offline';
			}
			
			$picture_size=getimagesize($_SERVER['DOCUMENT_ROOT'].$user_info['picture']);
			$user_info['picture_size'][0]=max($picture_size[0],1);
			$user_info['picture_size'][1]=max($picture_size[1],1);
		} else {
			header("HTTP/1.1 404 Not Found");
			include("error-404.php");
			exit;
		}
		
		return $user_info;
	}
	
	$user_info = get_user_info($con,$user);
	
	if (!empty($_POST)) {
		$errors = array();
		$messages = array();
		
		if (!empty($_POST['user']['login'])) {
			if ($_POST['user']['login']!=$_SESSION['username']) {
				if (strlen($_POST['user']['login'])<3) {
					$errors['username']='Username should be at least 3 characters long.';
				} elseif (strlen($_POST['user']['login'])>32) {
					$errors['username']='Username is too long (max. 32 characters).';
				} elseif (preg_match('/^[A-Za-z][A-Za-z0-9_ -]*$/',$_POST['user']['login'])!==1) {
					$errors['username']='The username may only contain letters, digits, underscores (_), dashes (-) and spaces ( ), and should start with a letter.';
				} else {
					$result = mysqli_query($con,"SELECT username FROM users WHERE username=\"{$_POST['user']['login']}\"");
					if (mysqli_num_rows($result)>0) {
						$errors['username']='A user with the same username already exists.';
					}
				}
			}
			
			if (!empty($_FILES['user']['tmp_name']['image'])) {
				$detectedType = exif_imagetype($_FILES['user']['tmp_name']['image']);
				if (!in_array($detectedType, array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF, IMAGETYPE_BMP))) {
					$errors['picture']='Please upload a valid image for your profile. Allowed extensions: .bmp, .png, .jpg, .jpeg, .gif.';
				}
			}
		}
		if (!empty($_POST['user']['new_password'])) {
			$correct = false;
			$result = mysqli_query($con,"SELECT username,password,type FROM users WHERE username = \"{$_SESSION['username']}\"");
			if (mysqli_num_rows($result) >= 1) {
				$row = mysqli_fetch_array($result);
				$password = $_POST['user']['password'];
				$correct = true;
				if (!password_verify($password,$row['password'])) {
					$correct = false;
					$errors['password']='The password you typed is incorrect.';
				}
			}
			if ($correct) {
				if (strlen($_POST['user']['new_password'])<6) {
					$errors['password']='The password should be at least 6 characters long.';
				} elseif ($_POST['user']['new_password_confirmation']!=$_POST['user']['new_password']) {
					$errors['password']='The password confirmation field does not match the password field.';
				}
			}
		}
		
		if (!empty($_POST['user']['email'])) {
			if ($_POST['user']['email']!=$user_info['email']) {
				$errors['email']='The email you typed is incorrect.';
			} else {
				if (!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/',strtolower($_POST['user']['email']))) {
					$errors['email']='Please enter a valid email address, this address will be used to send a verification link.';
				} else {
					$result = mysqli_query($con,"SELECT email FROM users WHERE email=\"{$_POST['user']['email']}\"");
					if (mysqli_num_rows($result)>0) {
						$errors['email']='A user with the same email already exists.';
					}
				}
			}
		}
		
		if (empty($errors)) {
			/*
			//$registered = date("Y-m-d H:i:s",time());
			$date_of_birth = "{$_POST['user']['date_of_birth_year']}-{$_POST['user']['date_of_birth_month']}-{$_POST['user']['date_of_birth_day']}";
			$options = intval($_POST['user']['age_visible']);
			$description = $con->real_escape_string($_POST['user']['description']);
			$location = ''; //$con->real_escape_string($_POST['user']['location']);*/
			
			if (!empty($_POST['user']['login'])) {
				$login = $con->real_escape_string($_POST['user']['login']);
				if (!empty($_FILES['user']['name']['image'])) {
					$picture_dir = '/img/user/' . mt_rand(1,999) . '/' . mt_rand(1,999999) . '/original/';
					$picture = $picture_dir . $_FILES['user']['name']['image'];
				} else {
					$picture = $user_info['picture'];
				}
				$picture_sql = $con->real_escape_string($picture);
				
				$firstname = $con->real_escape_string($_POST['user']['firstname']);
				$lastname = $con->real_escape_string($_POST['user']['lastname']);
				$description = $con->real_escape_string($_POST['user']['description']);
				$signature = $con->real_escape_string($_POST['user']['signature']);
				$location = $con->real_escape_string($_POST['user']['location']);
				
				$year = $con->real_escape_string($_POST['user']['date_of_birth_year']);
				$month = $con->real_escape_string($_POST['user']['date_of_birth_month']);
				$day = $con->real_escape_string($_POST['user']['date_of_birth_day']);
				$date_of_birth = "$year-$month-$day";
				if ($date_of_birth==date('Y-m-d')) {
					$date_of_birth = '';
				} else {
					$date_of_birth = ", date_of_birth = '$date_of_birth'";
				}
				
				if (!empty($_POST['user']['age_visible'])) {
					$options = 1;
				} else {
					$options = 0;
				}
				
				$query = "UPDATE users SET username='$login', picture='$picture', firstname='$firstname', lastname='$lastname', description='$description', signature='$signature', location='$location'$date_of_birth, options=$options WHERE username='$user'";
				//$_SESSION['message'] = $query;
				$user = $_POST['user']['login'];
				$_SESSION['username'] = $user;
			} else {
				$picture = '';
			}
			
			if (!empty($_POST['user']['password'])) {
				$password = $con->real_escape_string(password_hash($_POST['user']['new_password'],PASSWORD_BCRYPT));
				$query = "UPDATE users SET password='$password' WHERE username='$user'";
			}
			
			if (!empty($_POST['user']['email'])) {
				$email = $con->real_escape_string($_POST['user']['email']);
				$query = "UPDATE users SET email='$email' WHERE username='$user'"; 
			}
			
			if (!mysqli_query($con,$query)) {
				$page_title = "My account";
				include("default-top.php");
?>
			<h2>Oops...</h2>
			<p>
				An error occurred: <pre><?php echo mysqli_error($con); ?></pre>
<?php
				include("default-bottom.php");
				exit;
			}
			
			//Picture
			if ($picture!=''&&empty($errors['picture'])&&$picture!=$user_info['picture']) {
				mkdir(dirname(__FILE__) . $picture_dir,0777,true);
				move_uploaded_file($_FILES['user']['tmp_name']['image'],dirname(__FILE__) . $picture);
			}
			
			file_get_contents('http://gamemaker.mooo.com/update-notifications');
		}
	}
	
	$user_info = get_user_info($con,$user);
	
	$css[] = '/css/responsive-alt.css';
	$page_title = 'My account';
	include("default-top.php");
?>
<?php $i=0; if (!empty($errors)) foreach($errors as $error) { ?>
				<div class="errormessage" style="animation-delay: <?php echo 1+($i++)/50; ?>s;"><?php echo $error; ?></div>
<?php } ?>
				<div class="container dark" style="width: 295px; min-height: 500px; margin-right: 15px; margin-bottom: 50px;">
					<div class="container-title"><?php echo $_SESSION['username']; if ($user_info['type']==2) echo ' (Administrator)'; if ($user_info['type']==3) echo ' (Moderator)'; ?> <span class="last-active last-active-<?php echo strtolower($user_info['state']); ?>" title="Last active: <?php
	if ($user_info['last_active']>0) echo time_elapsed_string($user_info['last_active']); ?>"><?php echo $user_info['state']; ?></span></div>
					<?php if (!empty($user_info['picture'])) { ?><img style="width: 100%; max-width: <?php echo min($user_info['picture_size'][0],550/$user_info['picture_size'][1]*$user_info['picture_size'][0]); ?>px; margin: 0 <?php echo $user_info['picture_size'][0]>=300 ? 'auto' : '0'; ?> -10px; display: block;" alt="<?php echo $_SESSION['username']; ?>" src="<?php echo $user_info['picture']; ?>"><?php } ?>
					<div class="smallfont user-details" style="color: #CDCDCD; word-wrap: break-word; padding: 23px 0;">
						<br><strong>Name: </strong><?php if (!empty($user_info['firstname'])||!empty($user_info['lastname'])) { ?><?php echo htmlspecialchars("{$user_info['firstname']} {$user_info['lastname']}"); } ?>
						<?php if ($user_info['options']&1) { ?><br><strong>Age: </strong><?php echo floor((time()-strtotime($user_info['date_of_birth']))/31556926); } ?>
						<br><strong>Location: </strong><?php if (!empty($user_info['location'])) { ?><?php echo htmlspecialchars($user_info['location']); } ?>
						<br><?php
	if (!empty($user_info['description'])) {
		echo $Parsedown->setBreaksEnabled(true)->text("**Description:**\r\n".$user_info['description']);
	}

	if (!empty($user_info['registered'])) { ?>
						<strong>Registered: </strong><?php
		echo date('d F Y',strtotime(htmlspecialchars($user_info['registered'])));
	} ?>
					</div>
				</div>
				<div class="container-lt float-right" style="min-height: 200px; overflow: auto; float: none; margin-left: 324px;">
					<div class="container-title-lt">Edit details</div>
					<form action="/my_account" enctype="multipart/form-data" method="post">
						<table style="table-layout: fixed; width: 100%;" class="smallfont2">
							<col width="130">
							<tbody>
								<tr>
									<td><strong>First name:</strong></td>
									<td><input type="text" name="user[firstname]" value="<?php echo $user_info['firstname']; ?>" size="30" /></td>
								</tr>
								<tr>
									<td><strong>Last name:</strong></td>
									<td><input type="text" name="user[lastname]" value="<?php echo $user_info['lastname']; ?>" size="30" /></td>
								</tr>
								<tr>
									<td><strong>Username:</strong></td>
									<td><input type="text" name="user[login]" value="<?php echo $user_info['username']; ?>" size="30" /></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td><strong>Description:</strong></td>
									<td><textarea name="user[description]" cols="40" rows="4"><?php echo $user_info['description']; ?></textarea></td>
								</tr>
								<tr>
									<td><strong>Forum signature:</strong></td>
									<td><textarea name="user[signature]" cols="40" rows="4"><?php echo $user_info['signature']; ?></textarea></td>
								</tr>
								<tr>
									<td style="text-align: right;"><i>Tip:</i></td>
									<td><i>Use Markdown for the description<br>and use BBCode for the forums.</i></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td><strong>Location:</strong></td>
									<td><input type="text" name="user[location]" value="<?php echo $user_info['location']; ?>" size="30" /></td>
								</tr>
								<tr>
									<td><strong>Avatar:</strong></td>
									<td><input type="file" name="user[image]" /></td>
								</tr>
								<tr>
									<td>
										<label><strong>Date of birth*:</strong></label>
									</td>
									<td style="white-space: nowrap; overflow: hidden;">
										<select id="user_date_of_birth_day" name="user[date_of_birth_day]"<?php if (isset($errors['date_of_birth'])) echo ' class="redfield"'; ?>>
<?php
												$current_day = intval(date("d"));
												$current_month = intval(date("m"));
												$current_year = intval(date("Y"));
												
												$date_of_birth = strtotime($user_info['date_of_birth']);
												$year = intval(date("Y",$date_of_birth));
												$month = intval(date("m",$date_of_birth));
												$day = intval(date("d",$date_of_birth));
												
												//$last_number = cal_days_in_month(CAL_GREGORIAN,$current_month,$current_year);
												for($i=1;$i<=31;$i++) { ?>
											<option value="<?php echo $i; ?>"<?php if ($i==$day) echo ' selected="selected"'; ?>><?php echo $i; ?></option>
<?php } ?>
										</select>
										<select id="user_date_of_birth_month" name="user[date_of_birth_month]"<?php if (isset($errors['date_of_birth'])) echo ' class="redfield"'; ?>>
<?php for($i=1;$i<=12;$i++) { ?>
											<option value="<?php echo $i; ?>"<?php if ($i==$month) echo ' selected="selected"'; ?>><?php echo date('F',strtotime('2014-' . strval($i) . '-1')); ?></option>
<?php } ?>
										</select>
										<select id="user_date_of_birth_year" name="user[date_of_birth_year]"<?php if (isset($errors['date_of_birth'])) echo ' class="redfield"'; ?>>
<?php $current_year = intval(date("Y")); for($i=1900;$i<=$current_year;$i++) { ?>
											<option value="<?php echo $i; ?>"<?php if ($i==$year) echo ' selected="selected"'; ?>><?php echo $i; ?></option>
<?php } ?>
										</select>
									</td>
								</tr>
								<tr>
									<td><strong>Show my age:</strong></td>
									<td><input type="checkbox" value="1"<?php if ($user_info['options']&1) echo ' checked="checked"'; ?> name="user[age_visible]" /></td>
								</tr>
								<tr>
									<td style="height: 12px"></td>
								</tr>
								<tr>
									<td>* Optional</td>
									<td><input type="submit" value="Save changes" style="display: block; margin: 0 auto; width: 100%; max-width: 150px;" /></td>
								</tr>
							</tbody>
						</table>
					</form>
				</div>
				<div class="container-lt float-right" style="min-height: 200px; overflow: auto; float: none; margin-left: 324px;">
					<div class="container-title-lt">Edit password</div>
					<form action="/my_account" enctype="multipart/form-data" method="post">
						<table style="table-layout: fixed; width: 100%;" class="smallfont2">
							<col width="160">
							<tbody>
								<tr>
									<td><strong>Password:</strong></td>
									<td><input type="password" name="user[password]" size="30" /></td>
								</tr>
								<tr>
									<td style="height: 12px"></td>
								</tr>
								<tr>
									<td><strong>New password:</strong></td>
									<td><input type="password" name="user[new_password]" size="30" /></td>
								</tr>
								<tr>
									<td><strong>Confirmation*:</strong></td>
									<td><input type="password" name="user[new_password_confirmation]" size="30" /></td>
								</tr>
								<tr>
									<td style="height: 12px"></td>
								</tr>
								<tr>
									<td>* Type your new password here again.</td>
									<td><input type="submit" value="Save changes" style="display: block; margin: 0 auto; width: 100%; max-width: 150px;" /></td>
								</tr>
							</tbody>
						</table>
					</form>
				</div>
				<div class="container-lt float-right" style="min-height: 0; overflow: auto; float: none; margin-left: 324px;">
					<div class="container-title-lt">Edit email</div>
					<form action="/my_account" enctype="multipart/form-data" method="post">
						<table style="table-layout: fixed; width: 100%;" class="smallfont2">
							<col width="160">
							<tbody>
								<tr>
									<td><strong>Current email:</strong></td>
									<td><input type="text" name="user[password]" size="255" /></td>
								</tr>
								<tr>
									<td><strong>New email:</strong></td>
									<td><input type="text" name="user[new_email]" size="255" /></td>
								</tr>
								<tr>
									<td style="height: 12px"></td>
								</tr>
								<tr>
									<td></td>
									<td><input type="submit" value="Save changes" style="display: block; margin: 0 auto; width: 100%; max-width: 150px;" /></td>
								</tr>
							</tbody>
						</table>
					</form>
				</div>
				<div class="container-lt float-right" style="min-height: 0; overflow: auto; float: none; margin-left: 324px;">
					<div class="container-title-lt">Time zone</div>
					<form action="/my_account" enctype="multipart/form-data" method="post">
						<table style="table-layout: fixed; width: 100%;" class="smallfont2">
							<col width="90">
							<tbody>
								<tr>
									<td><strong>Time zone<?php echo $time_zone_id; ?>:</strong></td>
									<td>
										<select style="max-width: 100%;">
											<option timeZoneId="0"<?php if ($time_zone_id==0) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT-12:00" useDaylightTime="0" value="-12">Auto-detect</option>
											<option timeZoneId="1"<?php if ($time_zone_id==1) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT-12:00" useDaylightTime="0" value="-12">(GMT-12:00) International Date Line West</option>
											<option timeZoneId="2"<?php if ($time_zone_id==2) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT-11:00" useDaylightTime="0" value="-11">(GMT-11:00) Midway Island, Samoa</option>
											<option timeZoneId="3"<?php if ($time_zone_id==3) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT-10:00" useDaylightTime="0" value="-10">(GMT-10:00) Hawaii</option>
											<option timeZoneId="4"<?php if ($time_zone_id==4) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT-09:00" useDaylightTime="1" value="-9">(GMT-09:00) Alaska</option>
											<option timeZoneId="5"<?php if ($time_zone_id==5) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT-08:00" useDaylightTime="1" value="-8">(GMT-08:00) Pacific Time (US & Canada)</option>
											<option timeZoneId="6"<?php if ($time_zone_id==6) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT-08:00" useDaylightTime="1" value="-8">(GMT-08:00) Tijuana, Baja California</option>
											<option timeZoneId="7"<?php if ($time_zone_id==7) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT-07:00" useDaylightTime="0" value="-7">(GMT-07:00) Arizona</option>
											<option timeZoneId="8"<?php if ($time_zone_id==8) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT-07:00" useDaylightTime="1" value="-7">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
											<option timeZoneId="9"<?php if ($time_zone_id==9) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT-07:00" useDaylightTime="1" value="-7">(GMT-07:00) Mountain Time (US & Canada)</option>
											<option timeZoneId="10"<?php if ($time_zone_id==10) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT-06:00" useDaylightTime="0" value="-6">(GMT-06:00) Central America</option>
											<option timeZoneId="11"<?php if ($time_zone_id==11) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT-06:00" useDaylightTime="1" value="-6">(GMT-06:00) Central Time (US & Canada)</option>
											<option timeZoneId="12"<?php if ($time_zone_id==12) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT-06:00" useDaylightTime="1" value="-6">(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
											<option timeZoneId="13"<?php if ($time_zone_id==13) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT-06:00" useDaylightTime="0" value="-6">(GMT-06:00) Saskatchewan</option>
											<option timeZoneId="14"<?php if ($time_zone_id==14) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT-05:00" useDaylightTime="0" value="-5">(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
											<option timeZoneId="15"<?php if ($time_zone_id==15) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT-05:00" useDaylightTime="1" value="-5">(GMT-05:00) Eastern Time (US & Canada)</option>
											<option timeZoneId="16"<?php if ($time_zone_id==16) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT-05:00" useDaylightTime="1" value="-5">(GMT-05:00) Indiana (East)</option>
											<option timeZoneId="17"<?php if ($time_zone_id==17) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT-04:00" useDaylightTime="1" value="-4">(GMT-04:00) Atlantic Time (Canada)</option>
											<option timeZoneId="18"<?php if ($time_zone_id==18) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT-04:00" useDaylightTime="0" value="-4">(GMT-04:00) Caracas, La Paz</option>
											<option timeZoneId="19"<?php if ($time_zone_id==19) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT-04:00" useDaylightTime="0" value="-4">(GMT-04:00) Manaus</option>
											<option timeZoneId="20"<?php if ($time_zone_id==20) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT-04:00" useDaylightTime="1" value="-4">(GMT-04:00) Santiago</option>
											<option timeZoneId="21"<?php if ($time_zone_id==21) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT-03:30" useDaylightTime="1" value="-3.5">(GMT-03:30) Newfoundland</option>
											<option timeZoneId="22"<?php if ($time_zone_id==22) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT-03:00" useDaylightTime="1" value="-3">(GMT-03:00) Brasilia</option>
											<option timeZoneId="23"<?php if ($time_zone_id==23) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT-03:00" useDaylightTime="0" value="-3">(GMT-03:00) Buenos Aires, Georgetown</option>
											<option timeZoneId="24"<?php if ($time_zone_id==24) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT-03:00" useDaylightTime="1" value="-3">(GMT-03:00) Greenland</option>
											<option timeZoneId="25"<?php if ($time_zone_id==25) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT-03:00" useDaylightTime="1" value="-3">(GMT-03:00) Montevideo</option>
											<option timeZoneId="26"<?php if ($time_zone_id==26) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT-02:00" useDaylightTime="1" value="-2">(GMT-02:00) Mid-Atlantic</option>
											<option timeZoneId="27"<?php if ($time_zone_id==27) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT-01:00" useDaylightTime="0" value="-1">(GMT-01:00) Cape Verde Is.</option>
											<option timeZoneId="28"<?php if ($time_zone_id==28) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT-01:00" useDaylightTime="1" value="-1">(GMT-01:00) Azores</option>
											<option timeZoneId="29"<?php if ($time_zone_id==29) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+00:00" useDaylightTime="0" value="0">(GMT+00:00) Casablanca, Monrovia, Reykjavik</option>
											<option timeZoneId="30"<?php if ($time_zone_id==30) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+00:00" useDaylightTime="1" value="0">(GMT+00:00) Greenwich Mean Time : Dublin, Edinburgh, Lisbon, London</option>
											<option timeZoneId="31"<?php if ($time_zone_id==31) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+01:00" useDaylightTime="1" value="1">(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna</option>
											<option timeZoneId="32"<?php if ($time_zone_id==32) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+01:00" useDaylightTime="1" value="1">(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague</option>
											<option timeZoneId="33"<?php if ($time_zone_id==33) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+01:00" useDaylightTime="1" value="1">(GMT+01:00) Brussels, Copenhagen, Madrid, Paris</option>
											<option timeZoneId="34"<?php if ($time_zone_id==34) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+01:00" useDaylightTime="1" value="1">(GMT+01:00) Sarajevo, Skopje, Warsaw, Zagreb</option>
											<option timeZoneId="35"<?php if ($time_zone_id==35) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+01:00" useDaylightTime="1" value="1">(GMT+01:00) West Central Africa</option>
											<option timeZoneId="36"<?php if ($time_zone_id==36) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Amman</option>
											<option timeZoneId="37"<?php if ($time_zone_id==37) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Athens, Bucharest, Istanbul</option>
											<option timeZoneId="38"<?php if ($time_zone_id==38) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Beirut</option>
											<option timeZoneId="39"<?php if ($time_zone_id==39) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Cairo</option>
											<option timeZoneId="40"<?php if ($time_zone_id==40) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+02:00" useDaylightTime="0" value="2">(GMT+02:00) Harare, Pretoria</option>
											<option timeZoneId="41"<?php if ($time_zone_id==41) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Helsinki, Kyiv, Riga, Sofia, Tallinn, Vilnius</option>
											<option timeZoneId="42"<?php if ($time_zone_id==42) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Jerusalem</option>
											<option timeZoneId="43"<?php if ($time_zone_id==43) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Minsk</option>
											<option timeZoneId="44"<?php if ($time_zone_id==44) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+02:00" useDaylightTime="1" value="2">(GMT+02:00) Windhoek</option>
											<option timeZoneId="45"<?php if ($time_zone_id==45) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+03:00" useDaylightTime="0" value="3">(GMT+03:00) Kuwait, Riyadh, Baghdad</option>
											<option timeZoneId="46"<?php if ($time_zone_id==46) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+03:00" useDaylightTime="1" value="3">(GMT+03:00) Moscow, St. Petersburg, Volgograd</option>
											<option timeZoneId="47"<?php if ($time_zone_id==47) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+03:00" useDaylightTime="0" value="3">(GMT+03:00) Nairobi</option>
											<option timeZoneId="48"<?php if ($time_zone_id==48) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+03:00" useDaylightTime="0" value="3">(GMT+03:00) Tbilisi</option>
											<option timeZoneId="49"<?php if ($time_zone_id==49) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+03:30" useDaylightTime="1" value="3.5">(GMT+03:30) Tehran</option>
											<option timeZoneId="50"<?php if ($time_zone_id==50) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+04:00" useDaylightTime="0" value="4">(GMT+04:00) Abu Dhabi, Muscat</option>
											<option timeZoneId="51"<?php if ($time_zone_id==51) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+04:00" useDaylightTime="1" value="4">(GMT+04:00) Baku</option>
											<option timeZoneId="52"<?php if ($time_zone_id==52) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+04:00" useDaylightTime="1" value="4">(GMT+04:00) Yerevan</option>
											<option timeZoneId="53"<?php if ($time_zone_id==53) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+04:30" useDaylightTime="0" value="4.5">(GMT+04:30) Kabul</option>
											<option timeZoneId="54"<?php if ($time_zone_id==54) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+05:00" useDaylightTime="1" value="5">(GMT+05:00) Yekaterinburg</option>
											<option timeZoneId="55"<?php if ($time_zone_id==55) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+05:00" useDaylightTime="0" value="5">(GMT+05:00) Islamabad, Karachi, Tashkent</option>
											<option timeZoneId="56"<?php if ($time_zone_id==56) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+05:30" useDaylightTime="0" value="5.5">(GMT+05:30) Sri Jayawardenapura</option>
											<option timeZoneId="57"<?php if ($time_zone_id==57) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+05:30" useDaylightTime="0" value="5.5">(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi</option>
											<option timeZoneId="58"<?php if ($time_zone_id==58) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+05:45" useDaylightTime="0" value="5.75">(GMT+05:45) Kathmandu</option>
											<option timeZoneId="59"<?php if ($time_zone_id==59) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+06:00" useDaylightTime="1" value="6">(GMT+06:00) Almaty, Novosibirsk</option>
											<option timeZoneId="60"<?php if ($time_zone_id==60) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+06:00" useDaylightTime="0" value="6">(GMT+06:00) Astana, Dhaka</option>
											<option timeZoneId="61"<?php if ($time_zone_id==61) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+06:30" useDaylightTime="0" value="6.5">(GMT+06:30) Yangon (Rangoon)</option>
											<option timeZoneId="62"<?php if ($time_zone_id==62) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+07:00" useDaylightTime="0" value="7">(GMT+07:00) Bangkok, Hanoi, Jakarta</option>
											<option timeZoneId="63"<?php if ($time_zone_id==63) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+07:00" useDaylightTime="1" value="7">(GMT+07:00) Krasnoyarsk</option>
											<option timeZoneId="64"<?php if ($time_zone_id==64) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+08:00" useDaylightTime="0" value="8">(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi</option>
											<option timeZoneId="65"<?php if ($time_zone_id==65) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+08:00" useDaylightTime="0" value="8">(GMT+08:00) Kuala Lumpur, Singapore</option>
											<option timeZoneId="66"<?php if ($time_zone_id==66) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+08:00" useDaylightTime="0" value="8">(GMT+08:00) Irkutsk, Ulaan Bataar</option>
											<option timeZoneId="67"<?php if ($time_zone_id==67) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+08:00" useDaylightTime="0" value="8">(GMT+08:00) Perth</option>
											<option timeZoneId="68"<?php if ($time_zone_id==68) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+08:00" useDaylightTime="0" value="8">(GMT+08:00) Taipei</option>
											<option timeZoneId="69"<?php if ($time_zone_id==69) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+09:00" useDaylightTime="0" value="9">(GMT+09:00) Osaka, Sapporo, Tokyo</option>
											<option timeZoneId="70"<?php if ($time_zone_id==70) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+09:00" useDaylightTime="0" value="9">(GMT+09:00) Seoul</option>
											<option timeZoneId="71"<?php if ($time_zone_id==71) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+09:00" useDaylightTime="1" value="9">(GMT+09:00) Yakutsk</option>
											<option timeZoneId="72"<?php if ($time_zone_id==72) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+09:30" useDaylightTime="0" value="9.5">(GMT+09:30) Adelaide</option>
											<option timeZoneId="73"<?php if ($time_zone_id==73) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+09:30" useDaylightTime="0" value="9.5">(GMT+09:30) Darwin</option>
											<option timeZoneId="74"<?php if ($time_zone_id==74) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+10:00" useDaylightTime="0" value="10">(GMT+10:00) Brisbane</option>
											<option timeZoneId="75"<?php if ($time_zone_id==75) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+10:00" useDaylightTime="1" value="10">(GMT+10:00) Canberra, Melbourne, Sydney</option>
											<option timeZoneId="76"<?php if ($time_zone_id==76) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+10:00" useDaylightTime="1" value="10">(GMT+10:00) Hobart</option>
											<option timeZoneId="77"<?php if ($time_zone_id==77) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+10:00" useDaylightTime="0" value="10">(GMT+10:00) Guam, Port Moresby</option>
											<option timeZoneId="78"<?php if ($time_zone_id==78) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+10:00" useDaylightTime="1" value="10">(GMT+10:00) Vladivostok</option>
											<option timeZoneId="79"<?php if ($time_zone_id==79) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+11:00" useDaylightTime="1" value="11">(GMT+11:00) Magadan, Solomon Is., New Caledonia</option>
											<option timeZoneId="80"<?php if ($time_zone_id==80) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+12:00" useDaylightTime="1" value="12">(GMT+12:00) Auckland, Wellington</option>
											<option timeZoneId="81"<?php if ($time_zone_id==81) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+12:00" useDaylightTime="0" value="12">(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option>
											<option timeZoneId="82"<?php if ($time_zone_id==82) { ?> selected="selected"<?php } ?> gmtAdjustment="GMT+13:00" useDaylightTime="0" value="13">(GMT+13:00) Nuku'alofa</option>
										</select>
									</td>
								</tr>
								<tr>
									<td></td>
									<td><input type="submit" value="Save changes" style="display: block; margin: 0 auto; width: 100%; max-width: 150px;" /></td>
								</tr>
							</tbody>
						</table>
					</form>
				</div>
<?php include("default-bottom.php"); ?>