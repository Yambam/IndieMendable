 <?php
	define('indiemendable',true,true);
	include('config.php');
	$domain_sql = mysqli_escape_string($con,$_SESSION['domain']);
	
	$css[] = '/css/responsive-alt.css';
	$js[] = '/blog/wp-content/plugins/email-subscribers/widget/es-widget.js';
	$page_title = gettext("Home");
	include("default-top.php");
	include('blog/wp-load.php');
?>
				<div class="container-lt float-right" style="width: 250px; min-height: 0; margin-bottom: -40px;">
					<div class="container-title-lt"><?php echo gettext("News"); ?>
						<a class="arrow-link-lt" href="/blog" title="<?php echo gettext("News"); ?>"></a>
					</div>
<?php
	global $post;
	$recent_posts = wp_get_recent_posts(array('numberposts' => 1,'post_status' => 'publish'));
	foreach($recent_posts as $_post) { $post = $_post['ID']; setup_postdata($post);
		//if ($_post['post_status']!='publish') continue; ?>
					<div class="news-item"><h3 style="margin-bottom: 5px;"><a href="<?php echo the_permalink(); ?>"><?php echo $_post['post_title']; ?></a></h3><i><?php echo get_the_date(); ?></i><br><?php echo substr(strip_tags($_post['post_content']),0,80); if (strlen(strip_tags($_post['post_content']))>80) echo '...'; ?></div><?php
	}
?>
					<div class="news-item"><a href="/blog"><?php echo gettext("View all news..."); ?></a></div>
				</div>
				<div class="container-lt float-right" style="clear: right; width: 250px; min-height: 0; margin-top: 55px;">
					<div class="container-title-lt"><?php echo gettext("Community"); ?>
						<a class="arrow-link-lt" href="/users" title="<?php echo gettext("Community"); ?>"></a>
					</div>
<?php if (empty($_SESSION['logged_in'])) { ?>
					<div><i><?php echo gettext("Hello! Click <a href=\"register\">register</a> to make your account!"); ?></i></div>
<?php } ?>
					<h4 style="margin: 15px 0 10px; text-align: center;"><?php echo ngettext("Newest member","Newest members",10); ?></h4>
					<div class="seperators even-odd" style="line-height: 30px;">
						<div></div>
<?php
	require_once 'config.php';
	$result = mysqli_query($con,"SELECT * FROM users WHERE type != 0 AND visible != 0 ORDER BY id DESC LIMIT 5");
	if ($result) {
		while($row = mysqli_fetch_assoc($result)) {
			if ($row['picture']=='') {
				$row['picture'] = $no_picture;
			}
?>
						<div class="user-link" style="text-align: center;"><a href="/users/<?php echo $row['username']; ?>"><div class="picture" style="background-image: url('<?php echo str_replace('/original/','/thumb/',$row['picture']); ?>');"></div><?php echo $row['username']; ?></a></div>
<?php	}
	} else {
		echo 'An error occurred: ' . mysqli_error($con);
	}
?>
						<div></div>
					</div>
					
					<p style="text-align: center;">
						<i><?php echo gettext("Note for older members: log in again to show your account here."); ?></i>
					
					<h4 style="margin: 15px 0 10px; text-align: center;"><?php echo ngettext("Statistic","Statistics",2); ?></h4>
					<div class="statistics">
						<?php echo ngettext("Member","Members",10); ?>: <span style="color: #7BB640;"><?php $result = mysqli_query($con,"SELECT username FROM users WHERE type != 0 AND visible != 0"); echo mysqli_num_rows($result); ?></span><br>
						<?php echo ngettext("Game created","Games created",10); ?>: <span style="color: #7BB640;"><?php $result = mysqli_query($con,"SELECT id FROM games WHERE state >= 1 AND domain = '$domain_sql'"); echo mysqli_num_rows($result); ?></span><br>
						<?php echo ngettext("Game played","Games played",10); ?>: <span style="color: #7BB640;"><?php $result = mysqli_query($con,"SELECT id FROM downloads WHERE type = 1 AND ip != 'google' AND ip != 'facebook'"); echo mysqli_num_rows($result); ?></span><br>
					</div>
					<h5 style="margin: 15px 0 5px; text-align: center;"><?php echo gettext("YYG archive"); ?></h5>
					<div class="statistics">
						<?php echo ngettext("Game indexed","Games indexed",10); ?>: <span style="color: #7BB640;"><?php $result = mysqli_query($con,"SELECT id FROM games WHERE state >= 1 AND domain = 'yoyogames' AND game != ''"); echo mysqli_num_rows($result); ?></span><br>
						<?php echo ngettext("Game archived","Games archived",10); ?>: <span style="color: #7BB640;"><?php $result = mysqli_query($con,"SELECT id FROM games WHERE state >= 1 AND domain = 'yoyogames' AND game != '' AND !INSTR(game,'http://')"); echo mysqli_num_rows($result); ?></span>
					</div>
					
					<div class="newsletter less" tabindex="2">
						<h4 style="margin: 30px 0 10px; text-align: center;"><?php echo gettext("Subscribe to the newsletter..."); ?></h4>
						<?php /*es_subbox( $namefield = "YES", $desc = "", $group = "" );*/ ?>
						<div class="game-short-fade"></div>	
					</div>
				</div>
				<div id="spotlight" class="container dark" style="overflow: auto; float: none; margin-right: 280px;">
					<!--<div class="container-title" style="font-size: 1.1em;"><?php echo gettext("Spotlight"); ?></div>-->
					<div style="text-align: center; margin: 30px 0;"><?php echo gettext('This section of IndieMendable is still empty.<br>Help us by adding more content! :)'); ?></div>
				</div>
				<div class="container dark" style="overflow: auto; float: none; margin-right: 280px; margin-top: 30px; padding: 0;">
					<div class="container-title" style="font-size: 1.1em; margin: 0;"><?php echo gettext('Latest archive additions'); ?></div>
					<div class="game-screenshots game-spotlight">
<?php
	$result = mysqli_query($con,"SELECT * FROM games WHERE domain = 'yoyogames' AND picture != '' ORDER BY last_updated DESC LIMIT 8");
	if (!$result) {
		echo mysqli_error($con);
	}
?>
						<div class="shift" data-count="<?php echo mysqli_num_rows($result); ?>" style="margin-left: 0;">
						</div><?php while($row = mysqli_fetch_assoc($result)) { ?><a href="/games/<?php echo $row['id'].'-'.slugify($row['name']); ?>" tabindex="-1" style="background-image: url('<?php echo str_replace('/original/','/large/',$row['picture']); ?>')">
							<div><div><?php echo $row['name']; ?></div></div>
						</a><?php } ?>

					</div>
				</div>
<?php include("default-bottom.php"); ?>