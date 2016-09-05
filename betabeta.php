<?php
	define('indiemendable',true,true);
	
	$page_title = "Home";
	/*include("default-top.php");
	include('blog/wp-load.php');*/
	require_once('config.php');
	
	if (empty($_SESSION['betabeta'])) { //time() % 2 < 1) { //
		$_SESSION['betabeta'] = true;
		echo 'BETABETA';
	} elseif (empty($_SESSION['testbed'])) {
		$_SESSION['testbed'] = true;
		echo 'TESTBED';
	} else {
		unset($_SESSION['betabeta']);
		unset($_SESSION['testbed']);
		echo 'BETA';
	}
	/*
?>
				<div class="container-lt float-right" style="width: 250px; min-height: 0;">
					<div class="container-title-lt">News</div>
					<!--<div class="news-item"><i>October 25th</i><br>I added a new dark theme (it's the new default). And there's a new search field at the top of the website.</div>
					<div class="news-item"><i>October 11th</i><br>This is GameMaker Sandbox Beta! I just started working on it today. :)</div>-->
<?php
	global $post;
	$recent_posts = wp_get_recent_posts(array('numberposts' => 4));
	foreach($recent_posts as $_post) { $post = $_post['ID']; setup_postdata($post); ?>
		<div class="news-item"><h3 style="margin-bottom: 5px;"><a href="<?php echo the_permalink(); ?>"><?php echo $_post['post_title']; ?></a></h3><i><?php echo get_the_date(); ?></i><br><?php echo substr($_post['post_content'],0,80); if (strlen($_post['post_content'])>80) echo '...'; ?></div><?php
	}
?>
					<div class="news-item"><a href="/blog">View all news...</a></div>
				</div>
				<div class="container-lt float-right" style="clear: right; width: 250px; min-height: 0;">
					<div class="container-title-lt">Community</div>
<?php if (empty($_SESSION['logged_in'])) { ?>
					<div><i>Hello! Click <a href="register">register</a> to make your account!</i></div>
<?php } ?>
					<h4 style="margin: 15px 0 10px; text-align: center;">Newest members</h4>
					<div class="seperators even-odd">
						<div></div>
<?php
	require_once 'config.php';
	$result = mysqli_query($con,"SELECT * FROM users ORDER BY id DESC LIMIT 5");
	if ($result) {
		while($row = mysqli_fetch_assoc($result)) { ?>
						<div class="user-link" style="text-align: center;"><a href="/users/<?php echo $row['username']; ?>"><div class="picture" style="background-image: url('<?php echo $row['picture']; ?>');"></div><?php echo $row['username']; ?></a></div>
<?php	}
	} else {
		echo 'An error occurred: ' . mysqli_error($con);
	}
?>
						<div></div>
					</div>
					
					<h4 style="margin: 15px 0 10px; text-align: center;">Statistics</h4>
					<div id="statistics">
						Members: <span style="color: #7BB640;"><?php $result = mysqli_query($con,"SELECT username FROM users"); echo mysqli_num_rows($result); ?></span>
					</div>
				</div>
				<div id="spotlight" class="container dark" style="min-height: 200px; overflow: auto; float: none; margin-right: 280px;">
					<div class="container-title" style="font-size: 1.1em;">Spotlight</div>
					<div style="position: relative; top: 85px; margin-top: -.5em; text-align: center"><i>Spotlight isn't available yet. :)</i></div>
				</div>
				<div class="container-seamless category-list" style="margin-right: 280px; overflow: auto; float: none;">
					<div class="category">
						<div class="container-title">What's hot</div>
						
					</div>
					<div class="category float-right">
						<div class="container-title">Popular</div>
						
					</div>
					
					<div class="category">
						<div class="container-title">Puzzle games</div>
						
					</div>
					<div class="category float-right">
						<div class="container-title">Platform games</div>
						
					</div>
					
					<div class="category">
						<div class="container-title">Adventure games</div>
						
					</div>
					<div class="category float-right">
						<div class="container-title">Shooter games</div>
						
					</div>
					
					<div class="category">
						<div class="container-title">Strategy games</div>
						
					</div>
					<div class="category float-right">
						<div class="container-title">Arcade games</div>
						
					</div>
				</div>
<?php include("default-bottom.php"); /**/ ?>