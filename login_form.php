				<h2><?php echo gettext('Log in'); ?></h2>
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
							<form action="<?php echo $language_url; ?>/user_sessions" method="post">
								<table class="login-form">
									<col>
									<tbody>
										<tr>
											<td class="first-column"><?php echo gettext('Email'); ?></td>
											<td>
												<input id="login_email" name="user[email]" placeholder="<?php echo gettext('Email'); ?>" autocomplete="on" <?php if (!empty($_GET['email'])) {
													echo "value={$_GET['email']}";
												}?> size="30" type="text">
											</td>
										</tr>
										<tr>
											<td class="first-column"><?php echo gettext('Password'); ?></td>
											<td>
												<input id="login_password" name="user[password]" placeholder="<?php echo gettext('Password'); ?>" size="30" type="password">
											</td>
										</tr>
										<tr>
											<td class="first-column"><?php echo gettext('Remember me'); ?></td>
											<td>
												<div style="float: left;">
													<input name="rememberme" id="rememberme" value="1" checked="" type="checkbox" autocomplete="on">
													<label for="rememberme" style="display: none;"><?php echo gettext('Remember me'); ?></label>
												</div>
												<div style="float: right; padding-right: 0px;">
													<input name="commit" value="<?php echo gettext('Log in'); ?>" type="submit">
												</div>
											</td>
										</tr>

										<tr>
											<td colspan="2">
												<br>
												<a href="<?php echo $language_url; ?>/register"><?php echo gettext('I don\'t have a login, but I would like to register for an account'); ?></a>
												<br>
												<a href="<?php echo $language_url; ?>/forgot_password"><?php echo gettext('Help! I\'ve forgotten my password'); ?></a>
											</td>
										</tr>
									</tbody>
								</table>
							</form>
						</td>
					</tr>
				</table>