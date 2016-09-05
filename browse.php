<?php
	define('indiemendable',true,true);
	
	$js[] = '/js/seedrandom.js';
	$js[] = '/js/tagcanvas.js.min';
	
	$page_title = 'Browse';
	include("default-top.php");
	
	$current_page = $_SERVER['REQUEST_URI'];
	if (strpos($current_page,'?')>=0) {
		$current_page_query = $current_page . '&';
	} else {
		$current_page_query = $current_page . '?';
	}
	
	$categories = array('all','adventure','arcade','platform','puzzle','shooter','strategy','utility','other');
	
	if (empty($_GET['category'])) {
		$_GET['category'] = 'all';
	} else {
		$_GET['category'] = strtolower($_GET['category']);
		if (!in_array($_GET['category'],$categories)) {
			$_GET['category'] = 'all';
		}
	}
	
	$stages = array('complete','work in progress','beta');
	$stage_assoc = array('complete' => 1,'work in progress' => 2,'beta' => 3);
	
	if (empty($_GET['stage'])) {
		$_GET['stage'] = 'complete';
	} else {
		$_GET['stage'] = strtolower($_GET['stage']);
		if (!in_array($_GET['stage'],$stages)) {
			$_GET['stage'] = 'complete';
		}
	}
	
	$sorted_by = array('featured','popular','rating');
	
	if (empty($_GET['sorted-by'])) {
		$_GET['sorted-by'] = 'featured';
	} else {
		$_GET['sorted-by'] = strtolower($_GET['sorted-by']);
		if (!in_array($_GET['sorted-by'],$sorted_by)) {
			$_GET['sorted-by'] = 'featured';
		}
	}
	
	if (isset($_GET['yyg'])) {
		$yyg = false;
	} else {
		$yyg = !empty($_GET['yyg']);
	}
	
	function query_add($query_list,$query,$value) {
		$query_list[$query] = $value;
		return parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH) . '?' . http_build_query($query_list);
	}
	
	if (stristr($_SERVER['HTTP_USER_AGENT'],'XML Sitemaps Generator')) {
		exit;
	}
?>
				<div class="container dark dark2" style="width: 200px; margin-right: 15px;">
					<div class="container-title"><?php echo gettext('Categories'); ?></div>
					<div id="category-chooser" class="smallfont2">
<?php foreach($categories as $category) { ?>
						<a <?php if ($_GET['category']==$category) { echo 'class="selected" '; } ?>href="<?php if ($_GET['category']!=$category) { echo query_add($_GET,'category',$category); } ?>"><?php echo ucfirst($category); ?></a>
<?php } ?>
					</div>
					<div style="display: none">
						<div id="taglist">
							<ul style="display: block; width: 200px; float: left">
<?php foreach($categories as $category) { ?>
						<li><a <?php if ($_GET['category']==$category) { echo 'class="selected" '; } ?>href="<?php if ($_GET['category']!=$category) { echo query_add($_GET,'category',$category); } ?>" onclick="return tpu(this)"><?php echo ucfirst($category); ?></a>
<?php } ?>
							</ul>
						</div>
					</div>
					<div style="text-align: center;"><canvas id="tagcanvas" style="display: inline-block; max-width: 100%" width="400" height="200"></canvas></div>
					<script>
						Math.seedrandom('hallo');
						TagCanvas.textFont = 'Trebuchet MS, Helvetica, sans-serif';
						TagCanvas.textColour = '#CCFF00';
						TagCanvas.textHeight = 25;
						TagCanvas.outlineMethod = 'block';
						TagCanvas.outlineColour = '#333';
						TagCanvas.maxSpeed = 0.03;
						TagCanvas.minBrightness = 0.2;
						TagCanvas.depth = 0.92;
						TagCanvas.pulsateTo = 0.6;
						TagCanvas.initial = [0.1,-0.1];
						TagCanvas.maxSpeed = 0.03;
						TagCanvas.decel = 0.98;
						TagCanvas.reverse = true;
						TagCanvas.hideTags = false;
						TagCanvas.shadow = '#000';
						TagCanvas.shadowBlur = 3;
						TagCanvas.weight = false;
						TagCanvas.imageScale = null;
						TagCanvas.fadeIn = 0;
						TagCanvas.clickToFront = 600;
						try {
							TagCanvas.Start('tagcanvas','taglist');
							TagCanvas.TagToFront('tagcanvas', {text: "<?php echo ucfirst($_GET['category']); ?>",time:0});
						} catch(e) {
							document.getElementById('cmsg').style.display='none';
							document.getElementsByTagName('canvas')[0].style.border='0';
						}
					</script>
					<form id="search-tags" action="/search_tags" method="GET" tabindex="0">
						<input placeholder="Search tags..." value="" type="text" />
						<div>
							<a href="<?php echo query_add($_GET,'tags','popular'); ?>"><?php echo gettext('Popular'); ?></a>
							<a href="<?php echo query_add($_GET,'tags','1w'); ?>"><?php echo gettext('Popular last week'); ?></a>
							<a href="<?php echo query_add($_GET,'tags','today'); ?>"><?php echo gettext('Trending today'); ?></a>
							<a href="<?php echo query_add($_GET,'tags','2d'); ?>"><?php echo gettext('Trending last 2 days'); ?></a>
						</div>
					</form>
				</div>
				<div class="container dark dark2 clear-left" style="width: 200px; margin-right: 15px;">
					<div class="container-title"><?php echo gettext('Stages'); ?></div>
					<div id="category-chooser" class="smallfont2">
<?php foreach($stages as $category) { ?>
						<a <?php if ($_GET['stage']==$category) { echo 'class="selected" '; } ?>href="<?php if ($_GET['stage']!=$category) { echo query_add($_GET,'stage',$category); } ?>"><?php echo ucfirst($category); ?></a>
<?php } ?>
					</div>
				</div>
				<div class="container dark dark2 clear-left" style="width: 200px; margin-right: 15px; min-height: 0;">
					<div class="container-title"><?php echo gettext('Website'); ?></div>
					<div id="category-chooser" class="smallfont2">
						<a <?php if ($yyg) { echo 'class="selected" '; } ?>href="<?php echo query_add($_GET,'yyg','yes'); ?>">YoYo Games Sandbox</a>
						<a <?php if (!$yyg) { echo 'class="selected" '; } ?>href="<?php echo query_add($_GET,'yyg',''); ?>">IndieMendable</a>
					</div>
				</div>
				<div id="sorted-by-chooser"><a <?php
	if ($_GET['sorted-by']=='featured') { echo 'class="active" '; } ?> href="<?php
	echo query_add($_GET,'sorted-by','featured') ?>"><?php echo gettext('Featured'); ?></a> <a <?php
	if ($_GET['sorted-by']=='popular') { echo 'class="active" '; } ?> href="<?php
	echo query_add($_GET,'sorted-by','popular') ?>"><?php echo gettext('Popular Today'); ?></a> <a <?php
	if ($_GET['sorted-by']=='rating') { echo 'class="active" '; } ?> href="<?php
	echo query_add($_GET,'sorted-by','rating') ?>"><?php echo gettext('Highest Rating'); ?></a></div>
				<div class="container-lt float-right" style="overflow: auto; float: none; border-top-right-radius: 0;">
					<div class="container-title-lt"><?php echo gettext('Browsing games'); ?></div>
<?php
	if (true) {
		$category_sql = mysql_escape_string($_GET['category']);
		if ($category_sql=='all') {
			$extra_sql = '';
		} else {
			$extra_sql = " AND category = '$category_sql'";
		}
		
		$stage_sql = $stage_assoc[$_GET['stage']];
		$extra_sql .= " AND stage = '$stage_sql'";
		
		$sorted_by_sql = 'id DESC';
		if ($_GET['sorted-by']=='rating') {
			$sorted_by_sql = 'rating DESC';
		}
		
		if ($_GET['sorted-by']=='featured') {
			$extra_sql .= ' AND featured >= 1';
		}
		
		if ($yyg) {
			$extra_sql .= " AND domain = 'yoyogames'";
		} else {
			$domain_sql = mysqli_escape_string($con,$_SESSION['domain']);
			$extra_sql .= " AND domain = '$domain_sql'";
		}
		
		$result = mysqli_query($con,"SELECT * FROM games WHERE stage != 0$extra_sql ORDER BY $sorted_by_sql");
?>
					<div class="games-alt items" style="max-height: 505px; overflow: auto;" data-columns="3" data-per-page="12">
<?php
		while($row = mysqli_fetch_assoc($result)) {
			$game_author_id = mysql_escape_string($row['author']);
			$game_author = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM users WHERE id = $game_author_id"));
			if (!empty($row['author_str'])) {
				$game_author['username'] = $row['author_str'];
			}
			//for($i=0;$i<64;$i+=1) {
				if ($row['picture']=='') {
					$row['picture'] = $no_picture;
				}
				?><div class="game-alt item">
					<a href="/games/<?php echo $row['id'].'-'.slugify($row['name']); ?>">
						<div class="picture-large" style="background-image: url('<?php echo htmlspecialchars(str_replace('/original/','/extra-small/',$row['picture'])); ?>');"></div>
						<div class="name-box">
							<div class="name-box-bg" style="background-image: url('<?php echo htmlspecialchars(str_replace('/original/','/extra-small/',$row['picture'])); ?>');"></div>
							<span class="name"><?php echo $row['name']; ?></span>
						</div>
					</a>
					<span style="font-size: .7em;"><?php echo gettext('By'); ?> <a href="/users/<?php echo $game_author['username']; ?>"><?php echo $game_author['username']; ?></a></span><br>
					
					<ul class="star-rating"><li class="current-rating" style="width: <?php echo $row['rating']*60/5; ?>px; padding: 0;"><?php echo gettext('Rating'); ?>: <?php echo $row['rating']; ?>/5.</li></ul>
				</div><?php
			//}
		}
		if (mysqli_num_rows($result)==0) { ?>
						<div class="item" style="text-align: center; height: 130px; line-height: 130px;"><?php echo gettext('No results found.'); ?></div>
<?php
		}
?>
					</div>
<?php
	} else {
?>
					<div class="item" style="text-align: center; height: 130px; line-height: 130px;"><?php echo gettext('No results found.'); ?></div>
<?php
	}
?>
				</div>
<?php include("default-bottom.php"); ?>