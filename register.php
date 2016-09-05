<?php
	define('indiemendable',true,true);
	if (!empty($_POST)) {
		$errors = array();
		
		require_once dirname(__FILE__) . '/securimage/securimage.php';
		$securimage = new Securimage();
		
		require_once "config.php";

		if ($securimage->check($_POST['ct_captcha']) == false) {
			$errors['captcha'] = 'Word verification response is incorrect, please try again.';
		} else {
			if (!$_POST['user']['terms_and_conditions']) {
				$errors['terms']='Please agree to the terms and conditions to register.';
			}
			
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
			
			if (!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/',strtolower($_POST['user']['email']))) {
				$errors['email']='Please enter a valid email address, this address will be used to send a verification link.';
			} else {
				$result = mysqli_query($con,"SELECT email FROM users WHERE username=\"{$_POST['user']['email']}\"");
				if (mysqli_num_rows($result)>0) {
					//$errors['email']='A user with the same email already exists.';
				}
			}
			
			if (strlen($_POST['user']['password'])<6) {
				$errors['password']='The password should be at least 6 characters long.';
			} elseif ($_POST['user']['password']!=$_POST['user']['password_confirmation']) {
				$errors['password']='The password confirmation field does not match the password field.';
			}
			
			$date_of_birth = "{$_POST['user']['date_of_birth_year']}-{$_POST['user']['date_of_birth_month']}-{$_POST['user']['date_of_birth_day']}";
			if ($date_of_birth==date('Y-m-d')) {
				$errors['date_of_birth']='Please choose your date of birth.';
			}
			
			if (!empty($_FILES['user']['tmp_name']['image'])) {
				$detectedType = exif_imagetype($_FILES['user']['tmp_name']['image']);
				if (!in_array($detectedType, array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF, IMAGETYPE_BMP))) {
					$errors['picture']='Please upload a valid image for your profile. Allowed extensions: .bmp, .png, .jpg, .jpeg, .gif.';
				}
			}
			
			if (empty($errors))  {
				require_once "password.php";
				
				$login = $con->real_escape_string($_POST['user']['login']);
				$email = $con->real_escape_string($_POST['user']['email']);
				$password = $con->real_escape_string(password_hash($_POST['user']['password'],PASSWORD_BCRYPT));
				$firstname = $con->real_escape_string($_POST['user']['firstname']);
				$lastname = $con->real_escape_string($_POST['user']['lastname']);
				$signature = $con->real_escape_string($_POST['user']['signature']);
				$date_of_birth = "{$_POST['user']['date_of_birth_year']}-{$_POST['user']['date_of_birth_month']}-{$_POST['user']['date_of_birth_day']}";
				if (!empty($_POST['user']['age_visible'])) {
					$options = 1;
				} else {
					$options = 0;
				}
				if (!empty($_FILES['user']['name']['image'])) {
					//$picture_dir = '/img/user/' . substr_replace(substr_replace(sha1(date('r', time())),'/',4,0),'/',2,0) . '/original/';
					$picture_dir = '/img/user/' . mt_rand(1,999) . '/' . mt_rand(1,999999) . '/original/';
					$picture = $picture_dir . $_FILES['user']['name']['image'];
					$picture_sql = $con->real_escape_string($picture);
				} else {
					$picture = '';
					$picture_sql = '';
				}
				$description = $con->real_escape_string($_POST['user']['description']);
				$location = $con->real_escape_string($_POST['user']['location']);
				$query = "INSERT INTO users (username, email, password, type, firstname, lastname, signature, date_of_birth, options, picture, description, location, friends) VALUES ('$login', '$email', '$password', 0, '$firstname', '$lastname', '$signature', '$date_of_birth', $options, '$picture_sql', '$description', '$location', '')";
				if (!mysqli_query($con,$query)) {
					$page_title = "Register";
					include("default-top.php");
?>
				<h2>Oops...</h2>
				<p>
					An error occurred: <pre><?php echo mysqli_error($con); ?></pre>
<?php
					include("default-bottom.php");
					exit;
				}
				
				$user_id = mysqli_insert_id($con);
				
				//Picture
				if ($picture!=''&&empty($errors['picture'])) {
					umask(0);
					mkdir(dirname(__FILE__) . $picture_dir,0777,true);
					move_uploaded_file($_FILES['user']['tmp_name']['image'],dirname(__FILE__) . $picture);
				}
				
				//Activation link
				$activation_uid = sha1(date('r',time()));
				$expiration = date("Y-m-d H:i:s",time()+2592000); //Expires after 30 days
				if (!mysqli_query($con,"INSERT INTO expiring_links (type, uid, info, expiration) VALUES ('email_verification', '$activation_uid', $user_id, '$expiration')")) {
					include("default-top.php");
?>
				<h2>Oops...</h2>
				<p>
					An error occurred: <pre><?php echo mysqli_error($con); ?></pre>
<?php
					include("default-bottom.php");
					exit;
				}
				
				$headers  = "From: IndieMendable <info@gamemaker.mooo.com>\r\n";
				$headers .= "Reply-To: ima.habekotte@gmail.com\r\n";
				
				mail($_POST['user']['email'], "IndieMendable - Thank you for registering!", "Thank you for registering. In order to complete your registration, please click this link: http://gamemaker.mooo.com/activation?uid=$activation_uid", $headers);
				
				$page_title = "Register";
				include("default-top.php");
?>
				<h2>You're almost done!</h2>
				<p>
					To complete your registration, check your mail and click the activation link. After you've done
					that, you'll be able to login using your email and password. :)
<?php
				/*echo "<pre>";
				print_r($_POST);
				echo "</pre>";*/
				include("default-bottom.php");
				exit;
			}
		}
	}
	
	$page_title = "Register";
	include("default-top.php");
?>
				<h2>Make your account</h2>
<?php $i=0; if (!empty($errors)) foreach($errors as $error) { ?>
				<div class="errormessage" style="animation-delay: <?php echo 1+($i++)/50; ?>s;"><?php echo $error; ?></div>
<?php } ?>
				<form action="/register" enctype="multipart/form-data" method="post">
					<table class="register-form">
						<col width="220px" />
						<tr>
							<td>
								<label for="user_login"><strong>Desired username*</strong>:</label>
							</td>
							<td>
								<input id="user_login" name="user[login]" <?php if (isset($errors['username'])) echo 'class="redfield" '; ?>size="30" type="text" value="<?php if (!empty($_POST['user']['login'])) echo $_POST['user']['login']; ?>" />
							</td>
						</tr>
						<tr>
							<td>
								<label for="user_email"><strong>Email*</strong>:</label>
							</td>
							<td>
								<input id="user_email" name="user[email]" <?php if (isset($errors['email'])) echo 'class="redfield" '; ?>size="30" type="text" value="<?php if (!empty($_POST['user']['email'])) echo $_POST['user']['email']; ?>" />
							</td>
						</tr>
						
						<tr>
							<td>
								<label for="user_firstname">First name</label>
							</td>
							<td>
								<input id="user_firstname" name="user[firstname]" size="30" type="text" value="<?php if (!empty($_POST['user']['firstname'])) echo $_POST['user']['firstname']; ?>" />
							</td>
						</tr>
						<tr>
							<td>
								<label for="user_lastname">Last name</label>
							</td>
							<td>
								<input id="user_lastname" name="user[lastname]" size="30" type="text" value="<?php if (!empty($_POST['user']['lastname'])) echo $_POST['user']['lastname']; ?>" />
							</td>
						</tr>
						<tr>
							<td>
								<label for="user_signature">Message signature
									<br /><span>(max. 200 characters)</span>
								</label>
							</td>
							<td>
								<textarea cols="40" id="user_signature" name="user[signature]" <?php if (isset($errors['signature'])) echo 'class="redfield" '; ?>rows="4"><?php if (!empty($_POST['user']['signature'])) echo $_POST['user']['signature']; ?></textarea>
							</td>
						</tr>
						<tr>
							<td>
								<label for="user_location">Location</label>
							</td>
							<td>
								<input id="user_location" name="user[location]" size="30" type="text" value="<?php if (!empty($_POST['user']['location'])) echo $_POST['user']['location']; ?>" />
							</td>
						</tr>
						<tr>
							<td>
								<label for="user_description">Description</label>
							</td>
							<td>
								<textarea cols="40" id="user_description" name="user[description]" rows="4" value=""><?php if (!empty($_POST['user']['description'])) echo $_POST['user']['description']; ?></textarea>
							</td>
						</tr>
						<tr>
							<td>
								<label>Avatar:</label>
							</td>
							<td>
								<input id="user_image" name="user[image]" size="30" type="file" />
							</td>
						</tr>
						<tr>
							<td>
								<label><strong>Date of birth*:</strong></label>
							</td>
							<td>
								<select id="user_date_of_birth_day" name="user[date_of_birth_day]"<?php if (isset($errors['date_of_birth'])) echo ' class="redfield"'; ?>>
<?php
										$current_day = intval(date("d"));
										$current_month = intval(date("m"));
										$current_year = intval(date("Y"));
										
										//$last_number = cal_days_in_month(CAL_GREGORIAN,$current_month,$current_year);
										for($i=1;$i<=31;$i++) { ?>
									<option value="<?php echo $i; ?>"<?php if ($i==$current_day) echo ' selected="selected"'; ?>><?php echo $i; ?></option>
<?php } ?>
								</select>
								<select id="user_date_of_birth_month" name="user[date_of_birth_month]"<?php if (isset($errors['date_of_birth'])) echo ' class="redfield"'; ?>>
<?php for($i=1;$i<=12;$i++) { ?>
									<option value="<?php echo $i; ?>"<?php if ($i==$current_month) echo ' selected="selected"'; ?>><?php echo date('F',strtotime('2014-' . strval($i) . '-1')); ?></option>
<?php } ?>
								</select>
								<select id="user_date_of_birth_year" name="user[date_of_birth_year]"<?php if (isset($errors['date_of_birth'])) echo ' class="redfield"'; ?>>
<?php $current_year = intval(date("Y")); for($i=1900;$i<$current_year;$i++) { ?>
									<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
<?php } ?>
									<option value="<?php echo $current_year; ?>" selected="selected"><?php echo $current_year; ?></option>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								<label for="user_age_visible"><strong>Show my age*:</strong></label>
							</td>
							<td>
								<input name="user[age_visible]" type="hidden" value="0" />
								<input checked="checked" id="user_age_visible" name="user[age_visible]" type="checkbox" value="1" />
							</td>
						</tr>
						<tr>
							<td>
								<label for="user_password"><strong>Password*</strong>:</label>
							</td>
							<td>
								<input id="user_password" name="user[password]" <?php if (isset($errors['password'])) echo 'class="redfield" '; ?>size="30" type="password" />
							</td>
						</tr>
						<tr>
							<td>
								<label for="user_password_confirmation"><strong>Password confirmation*</strong>:</label>
							</td>
							<td>
								<input id="user_password_confirmation" name="user[password_confirmation]" <?php if (isset($errors['password'])) echo 'class="redfield" '; ?>size="30" type="password" />
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<input name="user[opt_in_news]" type="hidden" value="0" />
								<label><input id="user_opt_in_news" name="user[opt_in_news]" type="checkbox" value="1" /> I would like to receive news and information from gamemaker.mooo.com in future.</label>
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<input name="user[terms_and_conditions]" type="hidden" value="0" />
								<label><input id="user_terms_and_conditions" name="user[terms_and_conditions]" <?php if (isset($errors['terms'])) echo 'class="redfield" '; ?>type="checkbox" value="1" /> * <strong>I agree to the <a href="/terms" onclick="window.open(this.href);return false;">Terms & Conditions</a></strong></label>
							</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<div style="margin: 0 auto; border: 1px solid #505050; padding: 5px; background-color: white; width: 247px;">
									<?php
										// show captcha HTML using Securimage::getCaptchaHtml()
										require_once 'securimage/securimage.php';
										$options = array();
										$options['input_name'] = 'ct_captcha'; // change name of input element for form post

										if (!empty($_SESSION['ctform']['captcha_error'])) {
											// error html to show in captcha output
											$options['error_html'] = $_SESSION['ctform']['captcha_error'];
										}

										echo Securimage::getCaptchaHtml($options);
										echo "\n";
									?>
								</div>
							</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>
								<strong>(* = Required Field)</strong>
							</td>
							<td>
								<input name="commit" type="submit" value="Register" style="display: block; margin: 0 auto; width: 150px" />
							</td>
						</tr>
					</table>
				</form><br>
<?php include("default-bottom.php"); ?>
