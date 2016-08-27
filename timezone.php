<?php
	session_start();
	require_once('config.php');
	if (!empty($_SESSION['user_id'])) {
		$time_offset = mysql_escape_string(floor($_GET['offset']/30)*30);
		$time_zone = mysql_escape_string($_GET['timezone_name']);
		
		$time_zone_id = 31;
		
		$time_offset_sql = -mysql_escape_string($time_offset/60);
		$result = mysqli_query($con,"SELECT id FROM time_zones WHERE offset = $time_offset_sql");
		if (mysqli_num_rows($result)>0) {
			$time_zone_id = mysqli_fetch_assoc($result)['id'];
		}
		
		$_SESSION['time_offset'] = $time_offset;
		$_SESSION['time_zone'] = $time_zone;
		$_SESSION['time_zone_id'] = $time_zone_id;
		
		/*$time_zone = timezone_name_from_abbr(null,$time_offset*60,true);
		if ($time_zone === false) {
			$time_zone = timezone_name_from_abbr(null,$time_offset*60,false);
		}
		$time_zone_sql = mysql_escape_string($time_zone);*/
		
		if ($time_zone!=='undefined') {
			$time_zone_sql = "time_zone = '$time_zone', ";
		} else {
			$time_zone_sql = '';
		}
		
		$result = mysqli_query($con,"UPDATE users SET time_offset = $time_offset, {$time_zone_sql}time_zone_id = $time_zone_id WHERE id = {$_SESSION['user_id']}");
		if (!$result) {
			report_error($con,'timezone.php');
		}
	}
?>