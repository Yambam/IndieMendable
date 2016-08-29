<?php
	session_start();
	require_once('config.php');
	
	error_reporting(E_ALL & ~E_STRICT);
	ini_set("display_errors", 1);
	
	if (empty($_SESSION['username'])) {
		header("Location: http://gamemaker.mooo.com/login", true, 302);
		exit;
	}
	
	$game_id = mysqli_escape_string($con,explode('/',$_GET['q'])[0]);
	$result = mysqli_query($con,"SELECT * FROM games WHERE id = '$game_id'");
	if (mysqli_num_rows($result) >= 1) {
		$game_info = mysqli_fetch_array($result);
		$game_info['tags'] = explode(',',$game_info['tags']);
		for($i=0;$i<sizeof($game_info['tags']);$i+=1) {
			$game_info['tags'][$i] = preg_replace('/^\s*(.*)\s*$/','$1',$game_info['tags'][$i]);
		}
		
		$game_author_id = mysqli_escape_string($con,$game_info['author']);
		$result = mysqli_query($con,"SELECT * FROM users WHERE id = '$game_author_id'");
		if (mysqli_num_rows($result)>=1) {
			$game_author = mysqli_fetch_assoc($result);
			if ($game_author['picture']=='') {
				$game_author['picture'] = $no_picture;
			}
		} else {
			header("HTTP/1.1 404 Not Found");
			include("error-404.php");
			exit;
		}
	} else {
		header("HTTP/1.1 404 Not Found");
		include("error-404.php");
		exit;
	}
	
	$categories = array('adventure','arcade','platform','puzzle','shooter','strategy','utility','other');
	$stages = array('complete','wip','beta');
	
	if (!empty($_POST)) {
		$errors = array();
		require_once "config.php";
		
		if (empty($_POST['game']['version'])) {
			$errors['version'] = 'Please enter a version number.';
		} elseif (preg_match('/^[A-Za-z0-9][A-Za-z0-9\.]*[A-Za-z0-9]$/',$_POST['game']['version'])!==1) {
			$errors['version'] = 'Please enter a valid version number. Use letters, digits and periods. Don\'t start or end with a period.';
		}
		
		if (!in_array($_POST['game']['stage'],$stages)) {
			$errors['stage'] = 'Please choose the stage your game is in.';
		}
		
		if (!empty($_FILES['game']['tmp_name']['latest_version'])) {
			$detectedType = pathinfo($_FILES['game']['name']['latest_version'],PATHINFO_EXTENSION);
			if (!in_array($detectedType, array('exe','zip'))) {
				$errors['latest_version'] = 'Please upload a valid executable or archive for your game. Allowed extensions: .exe, .zip.<br><br>Tip: You can add .gmk files and other files later.';
			}
		}
		
		/*?><h2>$_POST</h2><pre><?php print_r($_POST); ?></pre><?php
		?><h2>$_FILES</h2><pre><?php print_r($_FILES); ?></pre><?php*/
		if (empty($errors)) {/*
?>
				<pre><?php print_r($_FILES); ?></pre>
<?php*/
			$game_file_dir = '/uploaded-files/games/' . mt_rand(1,999) . '/' . mt_rand(1,999999) . '/';
			$game_file = $game_file_dir . $_FILES['game']['name']['latest_version'];
			
			$author = $con->real_escape_string($_SESSION['user_id']);
			$ip = $con->real_escape_string($_SERVER['REMOTE_ADDR']);
			$stage = array_search($_POST['game']['stage'],$stages)+1;
			$version = $con->real_escape_string($_POST['game']['version']);
			$description = $con->real_escape_string($game_info['description']);
			$game_file_sql = mysqli_escape_string($con,$game_file);
			
			//Screenshots
			for($i=0;$i<sizeof($_FILES['game']['tmp_name']['screenshots']);$i+=1) {
			//foreach($_FILES['game']['tmp_name']['screenshots'] as $screenshot) {
				if (!empty($_FILES['game']['tmp_name']['screenshots'][$i])) {
					$screenshot_file_dir = '/img/game/' . mt_rand(1,999) . '/' . mt_rand(1,999999) . '/original/';
					$screenshot_file = $screenshot_file_dir . $_FILES['game']['name']['screenshots'][$i];
					
					$screenshot_file_sql = mysqli_escape_string($con,$screenshot_file);
					
					mkdir(dirname(__FILE__) . $screenshot_file_dir,0777,true);
					if (!move_uploaded_file($_FILES['game']['tmp_name']['screenshots'][$i],dirname(__FILE__) . $screenshot_file)) {
						$errors['screenshots'] = 'An error occurred, one or more of your screenshots could not be uploaded.';
					} else {
						$result = mysqli_query($con,"INSERT INTO uploaded_files (type,version,stage,place,ip,author,visibility,description,filename) VALUES (2,'$version','','$game_id','$ip','$author',1,'','$screenshot_file_sql')");
						if (!$result) {
							$errors['mysql'] = mysqli_error($con);
						}
					}
				}
			}
			
			$header_picture_sql = $game_info['header_picture'];
			if (!empty($_FILES['game']['tmp_name']['header_picture'])) {
				$header_picture_dir = '/img/game/' . mt_rand(1,999) . '/' . mt_rand(1,999999) . '/original/';
				$header_picture = $header_picture_dir . $_FILES['game']['name']['header_picture'];
				
				$header_picture_sql = mysqli_escape_string($con,$header_picture);
				
				mkdir(dirname(__FILE__) . $header_picture_dir,777,true);
				if (!move_uploaded_file($_FILES['game']['tmp_name']['header_picture'],dirname(__FILE__) . $header_picture)) {
					$errors['header_picture'] = 'An error occurred, your header picture could not be uploaded.';
				} else {
					$result = mysqli_query($con,"INSERT INTO uploaded_files (type,version,stage,place,ip,author,visibility,description,filename) VALUES (3,'$version','','$game_id','$ip','$author',1,'','$header_picture_sql')");
					if (!$result) {
						$errors['mysql'] = mysqli_error($con);
					}
				}
			}
			
			$thumbnail_sql = $game_info['picture'];
			if (!empty($_FILES['game']['tmp_name']['thumbnail'])) {
				$thumbnail_dir = '/img/game/' . mt_rand(1,999) . '/' . mt_rand(1,999999) . '/original/';
				$thumbnail = $thumbnail_dir . $_FILES['game']['name']['thumbnail'];
				
				$thumbnail_sql = mysqli_escape_string($con,$thumbnail);
				
				mkdir(dirname(__FILE__) . $thumbnail_dir,777,true);
				if (!move_uploaded_file($_FILES['game']['tmp_name']['thumbnail'],dirname(__FILE__) . $thumbnail)) {
					$errors['thumbnail'] = 'An error occurred, your header picture could not be uploaded.';
				} else {
					$result = mysqli_query($con,"INSERT INTO uploaded_files (type,version,stage,place,ip,author,visibility,description,filename) VALUES (4,'$version','','$game_id','$ip','$author',1,'','$thumbnail_sql')");
					if (!$result) {
						$errors['mysql'] = mysqli_error($con);
					}
				}
			}
			
			$result = mysqli_query($con,"UPDATE games SET state = 1, stage = $stage, version = '$version', game = '$game_file_sql', picture = '$thumbnail_sql', header_picture = '$header_picture_sql' WHERE id = $game_id");
			if (!$result) {
				$errors['mysql'] = mysqli_error($con);
			} else {
				
				
				mkdir(dirname(__FILE__) . $game_file_dir,777,true);
				if (!move_uploaded_file($_FILES['game']['tmp_name']['latest_version'],dirname(__FILE__) . $game_file)) {
					$errors['latest_version'] = 'An error occurred, your game could not be uploaded.';
				} else {
					$result = mysqli_query($con,"INSERT INTO uploaded_files (type,version,stage,place,ip,author,visibility,description,filename) VALUES (1,'$version','$stage','$game_id','$ip','$author',1,'$description','$game_file_sql')");
					if (!$result) {
						$errors['mysql'] = mysqli_error($con);
					}
				}
			}
		} else {
			foreach($errors as $error) {
				report_error($con,'share-upload.php-error',$error);
			}
		}
	}
	
	$page_title = "Share";
	include("default-top.php");
	
	if (!empty($_SESSION['betabeta'])||$version_info['gamemaker_sandbox']>=3) {
?>
				<h2><?php echo gettext('Share your games'); ?></h2>
				<p>
					<?php echo gettext('Upload your game files and screenshots here.'); ?>
				<div class="container dark dark2" style="width: 200px; margin-right: 15px;">
					<div class="container-title"><?php echo gettext('Your games'); ?></div>
<?php
	if (!empty($_SESSION['betabeta'])||$version_info['gamemaker_sandbox']>=3) {
		$author_id = mysqli_escape_string($con,$_SESSION['user_id']);
		$result = mysqli_query($con,"SELECT * FROM games WHERE author = $author_id ORDER BY id DESC");
		
		if (mysqli_num_rows($result)==0) { ?>
					<div class="item smallfont2" style="text-align: center; margin: 2em 0 2em; border-top: 2px solid transparent;">
						<?php echo gettext('You haven\'t uploaded any games yet.'); ?>
					</div>
<?php
		} else {
?>
					<div class="games items" style="max-height: 146px; overflow: auto;" data-columns="2" data-per-page="6">
<?php
			while($row = mysqli_fetch_assoc($result)) {
			//for($i=0;$i<13;$i+=1) {
				$game_author_id = mysqli_escape_string($con,$row['author']);
				$game_author = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM users WHERE id = $game_author_id"));
?>
<div class="game-dark item">
							<a href="/games/<?php echo $row['id'] ?>"><div class="picture-large" style="background-image: url('<?php echo htmlspecialchars(str_replace('/original/','/large/',$row['picture'])); ?>');"></div>
								<div class="name-box">
									<div class="name-box-bg" style="background-image: url('<?php echo htmlspecialchars(str_replace('/original/','/large/',$row['picture'])); ?>');"></div>
									<span class="name smallfont2"><?php
	echo $row['name'];
	if ($row['state']==0) {
		echo ' ('.gettext('Uploading').')';
	} elseif ($row['state']==1) {
		echo ' ('.gettext('Scanning').')';
	}
?></span>
								</div>
							</a><?php
	if ($row['state']==0) {
?><a class="game-action upload smallfont2" href="/share/upload/<?php echo $row['id']; ?>" title="<?php echo gettext('Upload') . ' ' . $row['name']; ?>"><span class="fa fa-upload"></span></a><?php
	} else {
?><a class="game-action edit smallfont2" href="/games/<?php echo $row['id']; ?>/edit" title="<?php echo gettext('Edit') . ' ' . $row['name']; ?>"><span class="fa fa-pencil"></span></a><?php
	}
?>
							<div class="game-info-summary">
								<span style="font-size: .7em;"><?php echo gettext('By'); ?> <a href="/users/<?php echo $game_author['username']; ?>"><?php echo $game_author['username']; ?></a></span><br>
								<ul class="star-rating-dark"><li class="current-rating" style="width: <?php echo $row['rating']*60/5; ?>px; padding: 0;"><?php echo gettext('Rating'); ?>: <?php echo $row['rating']; ?>/5.</li></ul>
							</div>
						</div><?php
			//}
			}
?>
					</div>
<?php
		}
	}
?>
				</div>
				<div class="container-lt float-right" style="min-height: 200px; overflow: auto; float: none; margin-left: 229px;">
					<div class="container-title-lt"><?php echo gettext('Game details for'); ?> <a href="/games/<?php echo $game_info['id']; ?>"><?php echo $game_info['name']; ?></a></div>
					<table class="upload-form">
						<col width="120px" />
						<tr>
							<td>
								<label for="game_name"><strong><?php echo gettext('Name'); ?>:</strong></label>
							</td>
							<td>
								<?php echo htmlspecialchars($game_info['name']); ?>
							</td>
						</tr>
						<tr>
							<td>
								<label for="game_description"><strong><?php echo gettext('Description'); ?>:</strong></label>
							</td>
							<td>
								<?php echo str_replace("\r\n",'<br>',htmlspecialchars($game_info['description'])); ?>
							</td>
						</tr>
						<tr>
							<td>
								<label for="game_tags"><strong><?php echo gettext('Tags'); ?>*:</strong></label>
							</td>
							<td>
								<?php
for($i=0;$i<sizeof($game_info['tags']);$i+=1) {
	if ($i!=0) {
		echo ', ';
	}
	echo htmlspecialchars($game_info['tags'][$i]);
} ?>
							</td>
						</tr>
						
						<tr>
							<td>
								<label for="game_category"><strong><?php echo gettext('Category'); ?>:</strong></label>
							</td>
							<td>
								<?php echo ucfirst($game_info['category']); ?>
							</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>
								<label for="game_stage"><strong><?php echo gettext('Stage'); ?>:</strong></label>
							</td>
							<td>
								<?php echo ucfirst($stages[$game_info['stage']-1]); ?>
							</td>
						</tr>
						<tr>
							<td>
								<label for="game_version"><strong><?php echo gettext('Version'); ?>:</strong></label>
							</td>
							<td>
								<?php echo htmlspecialchars($game_info['version']); ?>
							</td>
						</tr>
					</table>
				</div>
				<div class="container-lt float-right" style="min-height: 200px; overflow: auto; float: none; margin-left: 229px;">
					<div class="container-title-lt"><?php echo gettext('Upload files for'); ?> <a href="/games/<?php echo $game_info['id']; ?>"><?php echo $game_info['name']; ?></a></div>
<?php $i=0; if (!empty($errors)) foreach($errors as $error) { ?>
					<div class="errormessage" style="animation-delay: <?php echo 1+($i++)/50; ?>s;"><?php echo $error; ?></div>
<?php } ?>
					<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" enctype="multipart/form-data" method="post">
						<table class="upload-form">
							<col width="130px" />
							<tr>
								<td>
									<label for="game_latest_version"><strong><?php echo gettext('Latest version'); ?>:</strong></label>
								</td>
								<td>
									<input type="file" name="game[latest_version]" data-allowed-executable="" />
								</td>
							</tr>
							<tr>
								<td>
									<label for="game_stage"><strong><?php echo gettext('Stage'); ?>:</strong></label>
								</td>
								<td>
									<select id="game_stage" name="game[stage]">
										<option <?php if (!empty($_POST['game']['stage'])&&$_POST['game']['stage']=='complete') echo 'selected="selected" '; elseif (!empty($game_info['stage'])&&$game_info['stage']=='complete') echo 'selected="selected" '; ?>value="complete"><?php echo gettext('Complete'); ?></option>
										<option <?php if (!empty($_POST['game']['stage'])&&$_POST['game']['stage']=='wip') echo 'selected="selected" '; elseif (!empty($game_info['stage'])&&$game_info['stage']=='wip') echo 'selected="selected" '; ?>value="wip"><?php echo gettext('Work in progress'); ?></option>
										<option <?php if (!empty($_POST['game']['stage'])&&$_POST['game']['stage']=='beta') echo 'selected="selected" '; elseif (!empty($game_info['stage'])&&$game_info['stage']=='beta') echo 'selected="selected" '; ?>value="beta"><?php echo gettext('Beta'); ?></option>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<label for="game_version"><strong><?php echo gettext('Version'); ?>:</strong></label>
								</td>
								<td>
									<input type="text" id="game_version" name="game[version]" size="30" <?php if (isset($errors['version'])) echo 'class="redfield" '; ?> value="<?php if (!empty($_POST['game']['version'])) echo $_POST['game']['version']; elseif (!empty($game_info['version'])) echo $game_info['version']; elseif (empty($_POST)) echo '1.0'; ?>" />
								</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td>
									<label for="game_thumbnail"><strong><?php echo gettext('Thumbnail'); ?>:</strong></label>
								</td>
								<td>
									<input type="file" name="game[thumbnail]" />
								</td>
							</tr>
							<tr>
								<td>
									<label for="game_header_picture"><strong><?php echo gettext('Header picture'); ?>:</strong></label>
								</td>
								<td>
									<input type="file" name="game[header_picture]" />
								</td>
							</tr>
							<tr>
								<td>
									<label for="game_front_picture"><strong><?php echo gettext('Screenshots'); ?>:</strong></label>
								</td>
								<td>
									<input id="game_front_picture" type="file" name="game[screenshots][]" multiple />
								</td>
							</tr>
							<tr>
								<td></td>
								<td>
									<input name="commit" type="submit" value="<?php echo gettext('Submit'); ?>" style="display: block; margin: 0 auto; width: 80px" />
								</td>
							</tr>
						</table>
					</form>
				</div>
<?php
	}
	include("default-bottom.php"); 
?>
