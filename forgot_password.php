<?php
	define('indiemendable',true,true);
	require_once "config.php";
	
	if (!empty($_POST['user']['email'])||!empty($_POST['user']['login'])) {
		$errors = array();
		
		require_once dirname(__FILE__) . '/securimage/securimage.php';
		$securimage = new Securimage();
		
		require_once "password.php";
		
		if ($securimage->check($_POST['ct_captcha']) == false) {
			$errors['captcha'] = 'Word verification response is incorrect, please try again.';
		} else {
			$correct = false;
			if (!empty($_POST['user']['email'])) {
				$email = mysql_escape_string($_POST['user']['email']);
				$result = mysqli_query($con,"SELECT id, username from users WHERE email = '$email'");
				if (!$result) {
					$page_title = gettext("Forgot password");
					include("default-top.php");
		?>
				<h2>Oops...</h2>
				<p>
					An error occurred: <pre><?php echo mysqli_error($con); ?></pre>
		<?php
					include("default-bottom.php");
					exit;
				}
				if (mysqli_num_rows($result)>=1) {
					$row = mysqli_fetch_assoc($result);
					$user_id = mysql_escape_string($row['id']);
					$_POST['user']['login'] = $row['username'];
					$correct = true;
				}
			} elseif (!empty($_POST['user']['login'])) {
				$login = mysql_escape_string($_POST['user']['login']);
				$result = mysqli_query($con,"SELECT id, email from users WHERE username = '$login'");
				if (mysqli_num_rows($result)>=1) {
					$row = mysqli_fetch_assoc($result);
					$user_id = mysql_escape_string($row['id']);
					$_POST['user']['email'] = $row['email'];
					$correct = true;
				}
			}
			
			
			
			if (!$correct) {
				/*$page_title = gettext("Forgot password");
				include("default-top.php");
	?>
			<h2>Oops...</h2>
			<p>
				You probably mistyped your email/username... Please try again.
	<?php
				include("default-bottom.php");
				exit;*/
				$errors['email'] = 'You probably mistyped your email/username... Please try again.';
			}
			
			//Activation link
			if (empty($errors)) {
				$forgot_uid = sha1(date('r', time()));
				$expiration = date("Y-m-d H:i:s", time()+172800); //Expires after 48 hours
				$login = mysql_escape_string($_POST['user']['login']);
				if (!mysqli_query($con,"INSERT INTO expiring_links (type, uid, info, expiration) VALUES ('reset_password', '$forgot_uid', $user_id, '$expiration')")) {
					$page_title = gettext("Forgot password");
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
				$headers .= "To: {$_POST['user']['email']}\r\n";
				
				mail($_POST['user']['email'], "Reset password", "If you want to reset your password click this link (expires in 48 hours): http://gamemaker.mooo.com/forgot_password?uid=$forgot_uid

If you did not click \"Reset password\", simply don't click the link.", $headers);
				
				$page_title = gettext("Forgot password");
				include("default-top.php");
		?>
				<h2>The email has been sent!</h2>
				<p>
					Check your mail, to see whether you have received it. If you haven't, please try again later.
		<?php
				include("default-bottom.php");
				exit;
			}
		}
	}
	
	if (!empty($_GET['uid'])) {
		$page_title = gettext("Forgot password");
		include("default-top.php");
?>
				<h2><?php echo gettext("Forgot password"); ?></h2>
				<p>
					Choose your new password.
				<table style="table-layout: fixed; width: 100%;">
					<col width="150">
					<tr>
						<td>
							<img src="<?php
	$url = '/img/login-picture.png';
	if (!empty($_SESSION['theme'])) {
		if ($_SESSION['theme']=='dark') {
			$url = '/img/login-picture-dark.png';
		}
	}
	echo $url;
?>">
						</td>
						<td>
							<form action="/forgot_password" method="post">
								<input name="uid" value="<?php echo htmlspecialchars($_GET['uid']); ?>" type="hidden">
								<table class="login-form smallfont2">
									<col>
									<tbody>
										<tr>
											<td class="first-column"><b>New password</b></td>
											<td>
												<input id="user_password" name="user[new_password]" <?php if (isset($errors['password'])) echo 'class="redfield" '; ?> placeholder="New password" size="30" type="password">
											</td>
										</tr>
										<tr>
											<td class="first-column"><b>Confirmation*</b></td>
											<td>
												<input id="user_password_confirmation" name="user[new_password_confirmation]" <?php if (isset($errors['password'])) echo 'class="redfield" '; ?> placeholder="Confirmation" size="30" type="password">
											</td>
										</tr>
										<tr>
											<td style="height: 12px;"></td>
										</tr>
										<tr>
											<td class="first-column">* Type your new password here again.</td>
											<td>
												<input name="commit" value="Reset password" type="submit" style="display: block; margin: 0 auto; width: 120px;">
											</td>
										</tr>
										<tr>
											<td style="height: 12px;"></td>
										</tr>
									</tbody>
								</table>	
							</form>
						</td>
					</tr>
				</table>
<?php
		include("default-bottom.php");
		exit;
	}
	
	if (!empty($_POST['uid'])&&!empty($_POST['user']['new_password'])) {
		$errors = array();
		
		require_once "config.php";
		require_once "password.php";
		
		if ($_POST['user']['new_password']!=$_POST['user']['new_password_confirmation']) {
			$errors['password'] = 'The password confirmation field does not match the password field.';
		}
		if (empty($errors)) {
			$uid = mysqli_real_escape_string($con,$_POST['uid']);
			$result = mysqli_query($con,"SELECT type,uid,info,expiration FROM expiring_links WHERE uid = '$uid' AND type = 'reset_password'");
			if (!$result) {
				$page_title = gettext("Forgot password");
				include("default-top.php");
		?>
				<h2>Oops...</h2>
				<p>
					An error occurred: <pre><?php echo mysqli_error($con); ?></pre>
		<?php
				include("default-bottom.php");
				exit;
			}
			if (mysqli_num_rows($result)>=1) {
				$row = mysqli_fetch_array($result);
				if (true) { //(time()<strtotime($row['expiration'])) {
					$user_id = mysql_escape_string($row['info']);
					$password = $con->real_escape_string(password_hash($_POST['user']['new_password'],PASSWORD_BCRYPT));
					if (!mysqli_query($con,"UPDATE users SET password = '$password' WHERE id = $user_id")) {
						$page_title = gettext("Forgot password");
						include("default-top.php");
		?>
				<h2>Oops...</h2>
				<p>
					An error occurred: <pre><?php echo mysqli_error($con); ?></pre>
		<?php
						include("default-bottom.php");
						exit;
					}
					
					if (!mysqli_query($con,"DELETE FROM expiring_links WHERE uid = '$uid'")) {
						$page_title = gettext("Forgot password");
						include("default-top.php");
		?>
				<h2>Oops...</h2>
				<p>
					An error occurred: <pre><?php echo mysqli_error($con); ?></pre>
		<?php
						include("default-bottom.php");
						exit;
					}
					
					$page_title = gettext("Forgot password");
					include("default-top.php");
		?>
				<h1>Your password has been changed!</h1>
				<p>
					Congratulations! You are now able to <a href="/login">login</a> on this website using your email and your new password.
		<?php
					include("default-bottom.php");
					exit;
				}
			}
			
			$page_title = gettext("Forgot password");
			include("default-top.php");
		?>
				<h1>Sorry, your link is invalid</h1>
				<p>
					Your link is probably outdated, so you can't use it anymore. If you need to reset your password, please go to the log in page and click "Help! I've forgotten my password".
		<?php
			include("default-bottom.php");
			exit;
		}
	}
	
	$page_title = gettext("Forgot password");
	include("default-top.php");
?>
				<h2><?php echo gettext("Forgot password"); ?></h2>
				<p>
					<?php echo gettext("Fill in either your email, or your username and click \"Reset password\". You will be sent an email with a link to reset your password."); ?>
<?php $i=0; if (!empty($errors)) foreach($errors as $error) { ?>
				<div class="errormessage" style="animation-delay: <?php echo 1+($i++)/50; ?>s;"><?php echo $error; ?></div>
<?php } ?>
				<table style="table-layout: fixed; width: 100%;">
					<col width="150">
					<tr>
						<td>
							<img src="<?php
	$url = '/img/login-picture.png';
	if (!empty($_SESSION['theme'])) {
		if ($_SESSION['theme']=='dark') {
			$url = '/img/login-picture-dark.png';
		}
	}
	echo $url;
?>">
						</td>
						<td>
							<form action="/forgot_password" method="post">
								<table class="login-form">
									<col>
									<tbody>
										<tr>
											<td class="first-column"><?php echo gettext("Email"); ?></td>
											<td>
												<input id="login_email" name="user[email]" <?php if (isset($errors['email'])) echo 'class="redfield" '; ?> placeholder="<?php echo gettext("Email"); ?>" size="30" type="text">
											</td>
										</tr>
										<tr>
											<td class="first-column"><?php echo gettext("...or username"); ?></td>
											<td>
												<input id="login_username" name="user[login]" <?php if (isset($errors['email'])) echo 'class="redfield" '; ?> placeholder="<?php echo gettext("...or username"); ?>" size="30" type="text">
											</td>
										</tr>
										<tr>
											<td class="first-column"></td>
											<td>
												<div style="float: right; padding-right: 0px;">
													<input name="commit" value="<?php echo gettext('Reset password'); ?>" type="submit">
												</div>
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
														$options['input_text'] = gettext('Type the text');

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
									</tbody>
								</table>	
							</form>
						</td>
					</tr>
				</table>
<?php include("default-bottom.php"); ?>