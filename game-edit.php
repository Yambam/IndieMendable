<?php
	define('indiemendable',true,true);
	include('config.php');
	
	if (empty($_SESSION['username'])) {
		header("Location: http://gamemaker.mooo.com/login", true, 302);
		exit;
	}
	
	$game_id = mysqli_escape_string($con,explode('/',$_GET['q'])[0]);
	$game_id2 = mysqli_escape_string($con,2000000+explode('/',$_GET['q'])[0]);
	
	$result = mysqli_query($con,"SELECT * FROM games WHERE id = '$game_id'");
	if (mysqli_num_rows($result)>=1) {
		$game_info = mysqli_fetch_array($result);
		$game_info['tags'] = explode(',',$game_info['tags']);
		for($i=0;$i<sizeof($game_info['tags']);$i+=1) {
			$game_info['tags'][$i] = preg_replace('/^\s*(.*)\s*$/','$1',$game_info['tags'][$i]);
		}
		
		$game_author_id = mysql_escape_string($game_info['author']);
		if ($game_author_id==$_SESSION['user_id']||$_SESSION['user_info']['type']==2) {
			$result = mysqli_query($con,"SELECT * FROM users WHERE id = '$game_author_id'");
			if (mysqli_num_rows($result)>=1) {
				$game_author = mysqli_fetch_assoc($result);
				if ($game_author['picture']=='') {
					$game_author['picture'] = $no_picture;
				}
			} elseif ($_SESSION['user_info']['type']!=2) {
				header("HTTP/1.1 404 Not Found");
				include("error-404.php");
				exit;
			}
		} else {
			header("HTTP/1.1 404 Not Found");
			include("error-404.php");
			exit;
		}
		
		$result = mysqli_query($con,"SELECT * FROM uploaded_files WHERE type = 2 AND place = '$game_id'");
		while($row = mysqli_fetch_array($result)) {
			$game_info['screenshots'][] = $row;
		}
	} else {
		//header("HTTP/1.1 404 Not Found");
		//include("error-404.php");
		//exit;
		echo "SELECT * FROM games WHERE id = '$game_id'";
	}
	
	$categories = array('adventure','arcade','platform','puzzle','shooter','strategy','utility','other');
	$stages = array('complete','wip','beta');
	
	if (!empty($_POST)) {
		$errors = array();
		
		if (empty($_POST['game']['name'])) {
			$errors['name'] = 'Please enter a name.';
		}
		
		if (empty($_POST['game']['description'])) {
			$errors['description'] = 'Please enter a description.';
		}
		
		if (empty($_POST['game']['version'])) {
			$errors['version'] = 'Please enter a version number.';
		} elseif (preg_match('/^[A-Za-z0-9][A-Za-z0-9\.]*[A-Za-z0-9]$/',$_POST['game']['version'])!==1) {
			$errors['version'] = 'Please enter a valid version number. Use letters, digits and periods. Don\'t start or end with a period.';
		}
		
		if (!in_array($_POST['game']['stage'],$stages)) {
			$errors['stage'] = 'Please choose the stage your game is in.';
		}
		
		if (!in_array($_POST['game']['category'],$categories)) {
			$errors['stage'] = 'Please choose the category of your game.';
		}
		
		if (empty($errors)) {
			$id = $con->real_escape_string($game_info['id']);
			$author = $con->real_escape_string($_SESSION['user_id']);
			$ip = $con->real_escape_string($_SERVER['REMOTE_ADDR']);
			$name = $con->real_escape_string($_POST['game']['name']);
			$description = $con->real_escape_string($_POST['game']['description']);
			$tags = $con->real_escape_string($_POST['game']['tags']);
			$stage = array_search($_POST['game']['stage'],$stages)+1;
			$category = $con->real_escape_string($_POST['game']['category']);
			$version = $con->real_escape_string($_POST['game']['version']);
			
			$result = mysqli_query($con,"UPDATE games SET author = '$author', ip = '$ip', name = '$name', description = '$description', tags = '$tags', stage = '$stage', category = '$category', version = '$version' WHERE id = '$id'");
			if (!$result) {
				$errors['mysql'] = mysqli_error($con);
			} else {
				header("Location: http://gamemaker.mooo.com/games/$id/updated_info", true, 302);
				exit;
			}
		}
	}
	
	$css[] = '/css/jquery-ui.css';
	$js[] = '//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js';
	
	$css[] = '/my_files/css/elfinder.min.css';
	$css[] = '/my_files/css/theme.css';
	
	$js[] = '/my_files/js/elfinder.full.js';
	
	$page_title = "Share";
	include("default-top.php");
	
	if (!empty($_SESSION['betabeta'])||$version_info['gamemaker_sandbox']>=3) {
?>
				<h2>Share your games</h2>
				<p>
					Update your game info and files.
				<div class="container dark dark2" style="width: 200px; margin-right: 15px;">
					<div class="container-title">Your games</div>
<?php
	if (!empty($_SESSION['betabeta'])||$version_info['gamemaker_sandbox']>=3) {
		$author_id = mysql_escape_string($_SESSION['user_id']);
		$result = mysqli_query($con,"SELECT * FROM games WHERE author = $author_id ORDER BY id DESC");
		
		if (mysqli_num_rows($result)==0) { ?>
					<div class="item smallfont2" style="text-align: center; margin: 2em 0 2em; border-top: 2px solid transparent;">
						You haven't uploaded any games yet.
					</div>
<?php
		} else {
?>
					<div class="games items" style="max-height: 146px; overflow: auto;" data-columns="2" data-per-page="6">
<?php
			while($row = mysqli_fetch_assoc($result)) {
			//for($i=0;$i<64;$i+=1) {
				$game_author_id = mysql_escape_string($row['author']);
				$game_author = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM users WHERE id = $game_author_id"));
?>
<div class="game-dark item">
							<a href="/games/<?php echo $row['id'] ?>"><div class="picture-large" style="background-image: url('<?php echo htmlspecialchars(str_replace('/original/','/large/',$row['picture'])); ?>');"></div>
								<div class="name-box">
									<div class="name-box-bg" style="background-image: url('<?php echo htmlspecialchars(str_replace('/original/','/large/',$row['picture'])); ?>');"></div>
									<span class="name smallfont2"><?php
	echo $row['name'];
	if ($row['state']==0) {
		echo ' (Uploading)';
	} elseif ($row['state']==1) {
		echo ' (Scanning)';
	}
?></span>
								</div>
							</a><?php
	if ($row['state']==0) {
?><a class="game-action upload smallfont2" href="/share/upload/<?php echo $row['id']; ?>" title="Upload <?php echo $row['name']; ?>"><span class="fa fa-upload"></span></a><?php
	} else {
?><a class="game-action edit smallfont2" href="/games/<?php echo $row['id']; ?>/edit" title="Edit <?php echo $row['name']; ?>"><span class="fa fa-pencil"></span></a><?php
	}
?>
							<div class="game-info-summary">
								<span style="font-size: .7em;">By <a href="/users/<?php echo $game_author['username']; ?>"><?php echo $game_author['username']; ?></a></span><br>
								<ul class="star-rating-dark"><li class="current-rating" style="width: <?php echo $row['rating']*60/5; ?>px; padding: 0;">Rating: <?php echo $row['rating']; ?>/5.</li></ul>
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
				<div class="container-lt float-right" style="min-height: 200px; overflow: auto; float: none;">
					<div class="container-title-lt">Game details</div>
<?php $i=0; if (!empty($errors)) foreach($errors as $error) { ?>
					<div class="errormessage" style="animation-delay: <?php echo 1+($i++)/50; ?>s;"><?php echo $error; ?></div>
<?php } ?>
					<form action="/games/<?php echo $game_info['id']; ?>/edit" enctype="multipart/form-data" method="post">
						<table class="upload-form">
							<col width="120px" />
							<tr>
								<td>
									<label for="game_name"><strong>Name:</strong></label>
								</td>
								<td>
									<input type="text" id="game_name" name="game[name]" size="30" <?php if (isset($errors['name'])) echo 'class="redfield" '; ?> value="<?php if (!empty($_POST['game']['name'])) echo $_POST['game']['name']; elseif (!empty($game_info['name'])) echo $game_info['name']; ?>" />
								</td>
							</tr>
							<tr>
								<td>
									<label for="game_description"><strong>Description:</strong></label>
								</td>
								<td>
									<textarea id="game_description" name="game[description]" cols="40" rows="4" <?php if (isset($errors['description'])) echo 'class="redfield" '; ?>><?php if (!empty($_POST['game']['description'])) echo $_POST['game']['description']; elseif (!empty($game_info['description'])) echo $game_info['description']; ?></textarea>
								</td>
							</tr>
							<tr>
								<td>
									<label for="game_tags"><strong>Tags*:</strong></label>
								</td>
								<td>
									<input type="text" id="game_tags" name="game[tags]" value="<?php if (!empty($_POST['game']['tags'])) echo $_POST['game']['tags']; elseif (!empty($game_info['tags'])) echo implode(', ',$game_info['tags']); ?>" />
								</td>
							</tr>
							
							<tr>
								<td>
									<label for="game_category"><strong>Category:</strong></label>
								</td>
								<td>
									<select id="game_category" name="game[category]">
										<option value="">== Select a category ==</option>
<?php
	foreach($categories as $category) {
?>
										<option <?php if ((!empty($_POST['game']['category'])&&$_POST['game']['category']==$category)||(!empty($game_info['category'])&&$game_info['category']==$category)) echo 'selected="selected" '; ?>value="<?php echo $category; ?>"><?php echo ucfirst($category); ?></option>
<?php
	}
?>
									</select>
								</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td>
									<label for="game_stage"><strong>Stage:</strong></label>
								</td>
								<td>
									<select id="game_stage" name="game[stage]">
										<option <?php if ((!empty($_POST['game']['stage'])&&$_POST['game']['stage']=='complete')||(!empty($game_info['stage'])&&$game_info['stage']==1)) echo 'selected="selected" '; ?>value="complete">Complete</option>
										<option <?php if ((!empty($_POST['game']['stage'])&&$_POST['game']['stage']=='wip')||(!empty($game_info['stage'])&&$game_info['stage']==2)) echo 'selected="selected" '; ?>value="wip">Work in progress</option>
										<option <?php if ((!empty($_POST['game']['stage'])&&$_POST['game']['stage']=='beta')||(!empty($game_info['stage'])&&$game_info['stage']==3)) echo 'selected="selected" '; ?>value="beta">Beta</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<label for="game_version"><strong>Version:</strong></label>
								</td>
								<td>
									<input type="text" id="game_version" name="game[version]" size="30" <?php if (isset($errors['version'])) echo 'class="redfield" '; ?> value="<?php if (!empty($_POST['game']['version'])) echo $_POST['game']['version']; elseif (!empty($game_info['version'])) echo $game_info['version']; elseif (empty($_POST)) echo '1.0'; ?>" />
								</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td>* Seperate tags with commas.</td>
								<td>
									<input name="commit" type="submit" value="Submit" style="display: block; margin: 0 auto; width: 80px" />
								</td>
							</tr>
						</table>
					</form>
				</div>
				
				<div class="container-lt" style="padding: 0;/* overflow: auto; float: none; margin-left: 229px;*/">
					<div class="container-title-lt" style="margin: 0;">Game files</div>
					
					<script type="text/javascript" charset="utf-8">
						// Documentation for client options:
						// https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
						$(document).ready(function() {
							$('#elfinder').elfinder({
								url : '/my_files/php/connector.minimal.php',  // connector URL (REQUIRED)
								uiOptions : {
									navbar : {
										minWidth : 100,	
										maxWidth : 200
									}
								}
							});
						});
					</script>

					<!-- Element where elFinder will be created (REQUIRED) -->
					<div id="elfinder"></div>
				</div>
<?php
	} else {
?>
				<h2>Share your games</h2>
				<p>
					NOTE: Uploading games isn't done yet. Come back later! :D
<?php
	}
	include("default-bottom.php"); 
?>