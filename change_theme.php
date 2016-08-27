<?php
	session_start();
	include('config.php');
	$_SESSION['theme'] = $_POST['theme'];
	if (!empty($_POST['snowy'])) {
		$_SESSION['snowy'] = true;
	} else {
		$_SESSION['snowy'] = false;
	}
	
	if ($_POST['domain']=='gamemaker') {
		$_SESSION['domain_international'] = 'gamemaker';
	} else {
		$user_id_sql = $_SESSION['user_id'];
		$result = mysqli_query($con,"SELECT * FROM domains WHERE user_id = $user_id_sql");
		while($row = mysqli_fetch_assoc($result)) {
			if ($row['name']==$_POST['domain']) {
				$_SESSION['domain_international'] = $row['name'];
			}
		}
	}
	
	/*if (!empty($_SESSION['last_page'])) {
		$return_url = $_SESSION['last_page'];
	} else {
		$return_url = 'http://gamemaker.mooo.com/';
	}
	header("Location: $return_url", true, 302);*/
	header("Location: {$_POST['location']}", true, 302);
?>