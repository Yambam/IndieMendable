<?php
	if (!defined('indiemendable'))
		die();
?>
			</div>
		</div>
<?php	if (!isset($minimal)) { ?>
<?php		if (true||isset($_SESSION['betabeta'])) { ?>
		<div class="links-bar2 smallfont">
			<a href="<?php echo $language_url; ?>/"><?php echo gettext("Home"); ?></a> | <a href="/forums"><?php echo gettext("Forums"); ?></a> | <a href="http://www.yoyogames.com/gamemaker"><?php echo gettext("GameMaker"); ?></a> | <a href="http://enigma-dev.org/"><?php echo gettext("ENIGMA"); ?></a> | <a href="http://yygwiki.mooo.com/"><?php echo gettext("Wiki"); ?></a> | <a href="/blog"><?php echo gettext("Blog"); ?></a>
			<div style="float: right;"><a href="/yyg"><?php echo gettext("Go to our YoYo Games Archive"); ?></a></div>
		</div>
<?php		} ?>
		<div class="footer">
			<form action="/change_theme" method="post" style="display: block; float: right; clear: both;">
				<input type="hidden" name="location" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
				<label class="smallfont2" style="margin-right: 32px;">
					<?php echo gettext('Snow'); ?>:
					<input type="checkbox" name="snowy" value="snowy" onchange="this.form.submit()"<?php if ($_SESSION['snowy']) echo ' checked="checked"'; ?> />
				</label>
				<label class="smallfont2" style="margin-right: 32px;">
					<?php echo gettext('Theme'); ?>:
					<select name="theme" onchange="this.form.submit()" style="width: 120px;">
						<option <?php if ($_SESSION['theme']=='light') echo 'selected="selected" '; ?>value="light"><?php echo gettext('Light'); ?></option>
						<option <?php if ($_SESSION['theme']=='dark') echo 'selected="selected" '; ?>value="dark"><?php echo gettext('Dark'); ?></option>
					</select>
				</label>
				<label class="smallfont2">
					<?php echo gettext('Domain'); ?>:
					<select name="domain" onchange="this.form.submit()" style="width: 120px;">
						<option <?php if ($_SESSION['domain_international']=='gamemaker') echo 'selected="selected" '; ?>value="gamemaker">gamemaker</option>
<?php
	if (!empty($_SESSION['user_id'])) {
		$user_id_sql = $_SESSION['user_id'];
	} else {
		$user_id_sql = 0;
	}
	$result = mysqli_query($con,"SELECT * FROM domains WHERE user_id = $user_id_sql");
	while($row = mysqli_fetch_assoc($result)) {
?>
						<option <?php if ($_SESSION['domain_international']==$row['name']) echo 'selected="selected" '; ?>value="<?php echo $row['name']; ?>"><?php echo $row['name']; if ($row['name']==$_SESSION['username']) echo ' (private domain)'; ?></option>
<?php
	}
?>
					</select> <?php echo $language_domain; ?>
				</label>
			</form>
			<div style="display: inline-block; max-width: 350px; text-align: center;">
				<i class="smallfont2"><?php echo gettext('This site is not affiliated with YoYo Games in any way.'); ?></i><br>
			</div>
			<div style="text-align: left; margin-top: 16px;">
				<span class="smallfont2"><?php
	$session = session_id();
	$time = mysqli_escape_string($con,date("Y-m-d H:i:s"));
	$time_check = mysqli_escape_string($con,strval(strtotime($time)-300)); //We Have Set Time 5 Minutes
	//echo $time_check;
	$username = empty($_SESSION['username']) ? '' : mysqli_escape_string($con,$_SESSION['username']);
	
	$result = mysqli_query($con,"SELECT * FROM users_online WHERE session = '$session' OR (username != '' AND username = '$username')");
	$count = mysqli_num_rows($result); 
	
	/*if ($socket = @fsockopen('api.ipinfodb.com', 80, $errno, $errstr, .1)) {
		$service = "http://api.ipinfodb.com/v3/ip-country/?key=c90a3ef9923ca4c460c5387155042421d3eee2f03ea5b0d20e4def4291cf1e94&format=json&ip=";
	} else*/if ($socket = @fsockopen('ip-api.com', 80, $errno, $errstr, .1)) {
		fclose($socket);
		$service = "http://ip-api.com/json/";
	} else { //if ($socket = @fsockopen('freegeoip.net', 80, $errno, $errstr, .1)) {
		//fclose($socket);
		$service = "http://freegeoip.net/json/";
	}/* else {
		$service = "http://api.hostip.info/get_json.php?ip=";
	}*/
	
	$when = date("Y-m-d H:i",time());
	$ip = $_SESSION['ip'];
	$puffin = array('107.178.33', '107.178.34', '107.178.35', '107.178.37', '107.178.38', '107.178.39', 
					'107.178.41', '107.178.42', '107.178.43', '107.178.44', '107.178.45', '107.178.46', 
					'107.178.47', '206.173.221');
	$bots = array('93.158.152','5.255.253');
	if (substr($ip, 0, 10) == "192.168.1." || $ip == "127.0.0.1") {
		$ip = "thuis";
		$info = json_decode(utf8_encode(file_get_contents($service)));
	} else {
		$info = json_decode(utf8_encode(file_get_contents($service . $ip)));
	}
	if (in_array(implode(".", array_slice(explode(".", $ip), 0, 3)), $puffin)) {
		$ip = "puffin";
	}
	if (in_array(implode(".", array_slice(explode(".", $ip), 0, 3)), $bots)) {
		$ip = "bot";
	}
	if (stristr($_SERVER["HTTP_USER_AGENT"], "facebook") || stristr($_SERVER["HTTP_USER_AGENT"], "facebot")) {
		$ip = "facebook";
	}
	
	//print_r($info);
	
	if (isset($info->country)) {
		$info->country_name = $info->country;
	}
	if (!isset($info->isp)) {
		$info->isp = "N/A";
	}
	$info->country_name = ucwords(strtolower($info->country_name));
	if (!isset($info->country_name)) {
		$info->country_name = "N/A";
	}
	
	//echo 'Country: '.$info->country_name;
	
	//If count is 0 , then enter the values
	$ip = mysqli_escape_string($con,$ip);
	
	//report_error($con,implode('.',array_slice(explode('.',$ip),0,2)));
	if (!in_array(implode('.',array_slice(explode('.',$ip),0,2)),array('91.200','91.213'))) {
		if ($count==0) {
			$result = mysqli_query($con,"INSERT INTO users_online (session,username,ip,country,time) VALUES ('$session','$username','$ip','{$info->country_name}','$time')");
			if (!$result) {
				echo mysqli_error($con);
			}
			
			$result = mysqli_query($con,"INSERT INTO visits (session,username,ip,country,time) VALUES ('$session','$username','$ip','{$info->country_name}','$time')");
			if (!$result) {
				echo mysqli_error($con);
			}
		} else {
			$result = mysqli_query($con,"UPDATE users_online SET time = '$time', username = '$username', session = '$session' WHERE session = '$session' OR (username != '' AND username = '$username')"); 
		}
		
		if ($count==0) {
			$time_begin = strtotime(date('d F Y 00:00:00'));
			$time_end = strtotime(date('d F Y 23:59:59'));
			$result = mysqli_query($con,"SELECT * FROM visits_daily WHERE UNIX_TIMESTAMP(time) >= $time_begin AND UNIX_TIMESTAMP(time) <= $time_end");
			$_count = mysqli_num_rows($result);
			if ($_count==0) { 
				$result = mysqli_query($con,"INSERT INTO visits_daily (session,username,ip,country,time) VALUES ('$session','$username','$ip','{$info->country_name}','$time')");
				if (!$result) {
					echo mysqli_error($con);
				}
			} else {
				$result = mysqli_query($con,"UPDATE visits_daily SET time = '$time', username = '$username', session = '$session', visits = visits + 1 WHERE UNIX_TIMESTAMP(time) >= $time_begin AND UNIX_TIMESTAMP(time) <= $time_end"); 
			}
		}
	}
	
	$result = mysqli_query($con,"SELECT * FROM users_online WHERE username != ''");
	$count_users_online = mysqli_num_rows($result);
	echo ngettext('User','Users',10) . ' ' . lcfirst(gettext('Online')) . ": $count_users_online"; 
	
?></span><span class="smallfont2" style="margin-left: 16px;"><?php
	$result = mysqli_query($con,"SELECT * FROM users_online WHERE username = ''");
	$count_guests_online = mysqli_num_rows($result);
	echo ngettext('Guest','Guests',10) . ' ' . lcfirst(gettext('Online')) . ": $count_guests_online"; 

	// after 5 minutes, session will be deleted 
	$sql4 = "DELETE FROM users_online WHERE UNIX_TIMESTAMP(time) < '$time_check'"; 
	$result4 = mysqli_query($con,$sql4);
?></span><span class="smallfont2" style="margin-left: 16px;"><?php
	echo gettext('Online') . ': ';
	$result = mysqli_query($con,"SELECT * FROM users_online WHERE username != ''");
	while($row = mysqli_fetch_assoc($result)) {
		$username = htmlspecialchars($row['username']);
		echo "<a href=\"/users/$username\" style=\"color: #505050; margin-right: 10px; display: inline-block;\">$username</a> ";
	}

	// after 5 minutes, session will be deleted 
	$sql4 = "DELETE FROM users_online WHERE UNIX_TIMESTAMP(time) < '$time_check'"; 
	$result4 = mysqli_query($con,$sql4);
?>

				</span>
			</div>
		</div>
		<div style="height: 1px;"></div>
<?php	} ?>
	</body>
</html>
<?php
    /*$length = ob_get_length();
    $last_modified = date ("F d Y H:i:s", getlastmod());
    header("Content-Length: $length");
    header("Last-Modified: $last_modified GMT time");*/
?>
