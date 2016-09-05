<?php
	define('indiemendable',true,true);
	
	session_start();
	require_once "config.php";
	
	$page_title = 'Viewing all members';
	include('default-top.php');
?>

				<div class="container dark dark2" style="width: 200px; margin-right: 15px;">
					<div class="container-title">Moderators</div>
					<div id="category-chooser" class="smallfont2">
						<div style="border-bottom: 1px solid #D0D0D0; margin-bottom: 4px; font-size: 1.1em; font-family: Roboto;">Moderators</div>
<?php
	$result = mysqli_query($con,"SELECT * FROM users WHERE type = 3");
	while($row = mysqli_fetch_assoc($result)) { ?>
						<a href="/users/<?php echo $row['username']; ?>"><?php echo $row['username']; ?></a>
<?php
	}
	if (mysqli_num_rows($result)==0) { ?>
						<div style="margin-bottom: 4px; font-size: 1.1em; text-align: center; color: #A0A0A0; font-family: Roboto;">No moderators yet.</div>
<?php
	}
?>
						<div style="border-bottom: 1px solid #D0D0D0; margin-bottom: 4px; font-size: 1.1em; font-family: Roboto;">Inactive members</div>
<?php
	$result = mysqli_query($con,"SELECT * FROM users WHERE type != 0 AND visible = 0");
	while($row = mysqli_fetch_assoc($result)) { ?>
						<a href="/users/<?php echo $row['username']; ?>"><?php echo $row['username']; ?></a>
<?php
	}
	if (mysqli_num_rows($result)==0) { ?>
						<div style="margin-bottom: 4px; font-size: 1.1em; text-align: center; color: #A0A0A0; font-family: Roboto;">No inactive members.</div>
<?php
	}
?>
						<div style="border-bottom: 1px solid #D0D0D0; margin-bottom: 4px; margin-top: 8px; font-size: 1.1em; font-family: Roboto;">Administrators</div>
<?php
	$result = mysqli_query($con,"SELECT * FROM users WHERE type = 2");
	while($row = mysqli_fetch_assoc($result)) { ?>
						<a href="/users/<?php echo $row['username']; ?>"><?php echo $row['username']; ?></a>
<?php
	}
?>
					</div>
				</div>
				<div id="sorted-by-chooser"><a class="active" href="">Members</a></div>
				<div class="container-lt float-right" style="overflow: auto; float: none; border-top-right-radius: 0;">
					<div class="container-title-lt">Viewing all members</div>
<?php
	if (!empty($_GET['q'])) {
		$query = $_GET['q'];
		
		/*$category_sql = mysql_escape_string($_GET['category']);
		if ($category_sql=='all') {
			$extra_sql = '';
		} else {
			$extra_sql = " AND category = '$category_sql'";
		}*/
		
		$extra_sql = '';
		
		$sorted_by_sql = 'id DESC';
		/*if ($_GET['sorted-by']=='rating') {
			$sorted_by_sql = 'rating DESC';
		}*/
		
		$search_sql = str_replace(' ','|',preg_quote($query));
		$search_sql = " AND username REGEXP '([^a-zA-Z0-9_]|^)(" . $search_sql . ")([^a-zA-Z0-9_]|$)'";
		$extra_sql .= $search_sql;
		
		$query = "SELECT * FROM users WHERE type!=0$extra_sql ORDER BY $sorted_by_sql";
		//echo $query;
		$result = mysqli_query($con,$query);
	} else {
		$result = mysqli_query($con,"SELECT * FROM users WHERE type != 0 AND visible = 1 ORDER BY id DESC");
	}
?>
					<div class="users items" style="max-height: 505px; overflow: auto;" data-columns="4" data-per-page="16">
<?php
		while($row = mysqli_fetch_assoc($result)) {
			//for($i=0;$i<13;$i+=1) {
			if ($row['picture']=='') {
				$row['picture'] = $no_picture;
			}
?><div class="user item"><a href="/users/<?php echo $row['username'] ?>"><div class="picture-large" style="background-image: url('<?php echo htmlspecialchars(str_replace('/original/','/extra-small/',$row['picture'])); ?>');"></div>
						<div><?php echo $row['username'] ?></div></a></div><?php
			//}
		}
		if (mysqli_num_rows($result)==0) { ?>
						<div class="item" style="text-align: center; height: 130px; line-height: 130px;">No results found.</div>
<?php
		}
?>
					</div>
				</div>

<?php include('default-bottom.php'); ?>