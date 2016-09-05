<?php
	define('indiemendable',true,true);
	require_once "config.php";
	
	if (empty($_SESSION['username'])) {
		header("Location: http://gamemaker.mooo.com$language_url/login", true, 302);
		exit;
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
			$author = $con->real_escape_string($_SESSION['user_id']);
			$ip = $con->real_escape_string($_SERVER['REMOTE_ADDR']);
			$name = $con->real_escape_string($_POST['game']['name']);
			$description = $con->real_escape_string($_POST['game']['description']);
			$tags = $con->real_escape_string($_POST['game']['tags']);
			$stage = array_search($_POST['game']['stage'],$stages)+1;
			$category = $con->real_escape_string($_POST['game']['category']);
			$version = $con->real_escape_string($_POST['game']['version']);
			$domain = $con->real_escape_string($_SESSION['domain']);
			
			$result = mysqli_query($con,"INSERT INTO games (domain,author,ip,name,description,tags,stage,category,version) VALUES ('$domain','$author','$ip','$name','$description','$tags','$stage','$category','$version')");
			if (!$result) {
				$errors['mysql'] = mysqli_error($con);
			} else {
				$id = mysqli_insert_id($con);
				header("Location: http://gamemaker.mooo.com$language_url/share/upload/$id", true, 302);
				exit;
			}
		}
	}
	
	$page_title = "Share";
	include("default-top.php");
	
	if (!empty($_SESSION['betabeta'])||$version_info['gamemaker_sandbox']>=3) {
?>
				<h2><?php echo gettext('Share your games'); ?></h2>
				<p>
					<?php echo gettext('Fill in the details of your game. Click submit to continue and start uploading the files.'); ?>
				<div class="container dark dark2" style="width: 200px; margin-right: 15px;">
					<div class="container-title"><?php echo gettext('Your games'); ?></div>
<?php
	if (!empty($_SESSION['betabeta'])||$version_info['gamemaker_sandbox']>=3) {
		$author_id = mysql_escape_string($_SESSION['user_id']);
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
				<div class="container-lt float-right" style="min-height: 200px; overflow: auto; float: none;">
					<div class="container-title-lt"><?php echo gettext('Game details'); ?></div>
<?php $i=0; if (!empty($errors)) foreach($errors as $error) { ?>
					<div class="errormessage" style="animation-delay: <?php echo 1+($i++)/50; ?>s;"><?php echo $error; ?></div>
<?php } ?>
					<form action="/share" enctype="multipart/form-data" method="post">
						<table class="upload-form">
							<col width="120px" />
							<tr>
								<td>
									<label for="game_name"><strong><?php echo gettext('Name'); ?>:</strong></label>
								</td>
								<td>
									<input type="text" id="game_name" name="game[name]" size="30" <?php if (isset($errors['name'])) echo 'class="redfield" '; ?> value="<?php if (!empty($_POST['game']['name'])) echo $_POST['game']['name']; ?>" />
								</td>
							</tr>
							<tr>
								<td>
									<label for="game_description"><strong><?php echo gettext('Description'); ?>:</strong></label>
								</td>
								<td>
									<textarea id="game_description" name="game[description]" cols="40" rows="4" <?php if (isset($errors['description'])) echo 'class="redfield" '; ?>><?php if (!empty($_POST['game']['description'])) echo $_POST['game']['description']; ?></textarea>
								</td>
							</tr>
							<tr>
								<td>
									<label for="game_tags"><strong><?php echo gettext('Tags'); ?>*:</strong></label>
								</td>
								<td>
									<input type="text" id="game_tags" name="game[tags]" value="<?php if (!empty($_POST['game']['tags'])) echo $_POST['game']['tags']; ?>" />
								</td>
							</tr>
							
							<tr>
								<td>
									<label for="game_category"><strong><?php echo gettext('Category'); ?>:</strong></label>
								</td>
								<td>
									<select id="game_category" name="game[category]">
										<option value=""><?php echo gettext('== Select a category =='); ?></option>
<?php
	foreach($categories as $category) {
?>
										<option <?php if (!empty($_POST['game']['category'])&&$_POST['game']['category']==$category) echo 'selected="selected" '; ?>value="<?php echo $category; ?>"><?php echo ucfirst($category); ?></option>
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
									<label for="game_stage"><strong><?php echo gettext('Stage'); ?>:</strong></label>
								</td>
								<td>
									<select id="game_stage" name="game[stage]">
										<option <?php if (!empty($_POST['game']['stage'])&&$_POST['game']['stage']=='complete') echo 'selected="selected" '; ?>value="complete"><?php echo gettext('Complete'); ?></option>
										<option <?php if (!empty($_POST['game']['stage'])&&$_POST['game']['stage']=='wip') echo 'selected="selected" '; ?>value="wip"><?php echo gettext('Work in progress'); ?></option>
										<option <?php if (!empty($_POST['game']['stage'])&&$_POST['game']['stage']=='beta') echo 'selected="selected" '; ?>value="beta"><?php echo gettext('Beta'); ?></option>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									<label for="game_version"><strong><?php echo gettext('Version'); ?>:</strong></label>
								</td>
								<td>
									<input type="text" id="game_version" name="game[version]" size="30" <?php if (isset($errors['version'])) echo 'class="redfield" '; ?> value="<?php if (!empty($_POST['game']['version'])) echo $_POST['game']['version']; elseif (empty($_POST)) echo '1.0.0'; ?>" />
								</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td><?php echo gettext('* Seperate tags with commas.'); ?></td>
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