<?php
	include('config.php');
	$result = mysqli_query($con,"SELECT u.* FROM (
		(SELECT id,author,place,type,posted,content,'' AS name FROM comments WHERE domain = 'gamemaker') 
			UNION
		(SELECT id,author,0 as place,10 AS type,added,CONCAT('New game: ',name) AS content,name FROM games WHERE picture != '')
			UNION
		(SELECT id,0 AS author,0 as place,20 AS type,registered,CONCAT('New user: ',username) AS content,username FROM users)
	) AS u ORDER BY u.posted DESC LIMIT 20");
	if (!$result) {
		echo mysqli_error($con);
	}
?>
<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0"
	xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	xmlns:atom="http://www.w3.org/2005/Atom"
	xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
	>

<channel>
	<title>IndieMendable</title>
	<atom:link href="http://gamemaker.mooo.com/activityfeed.rss" rel="self" type="application/rss+xml" />
	<link>http://gamemaker.mooo.com/</link>
	<description>Welcome to IndieMendable</description>
	<lastBuildDate><?php echo date('D, d F Y H:i:s +0000'); ?></lastBuildDate>
	<language>en-US</language>
		<sy:updatePeriod>hourly</sy:updatePeriod>
		<sy:updateFrequency>1</sy:updateFrequency>
<?php
	while($row = mysqli_fetch_assoc($result)) {
		$comment_author_id = mysql_escape_string($row['author']);
		$comment_author = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM users WHERE id = $comment_author_id"));
		
		$type_filter = '';
		
		$place_id = mysql_escape_string($row['place']);
		if ($row['type']==1) {
			$place = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM users WHERE id = $place_id"));
		} elseif ($row['type']==2) {
			$place = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM games WHERE id = $place_id"));
		} elseif ($row['type']==3) {
			$place = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM reviews WHERE id = $place_id"));
			$place['place_info'] = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM games WHERE id = {$place['place']}"));
			$place['picture'] = $place['place_info']['picture'];
		}
		
		if (empty($place['picture'])) {
			$place['picture'] = $no_picture;
		}
?>
		<item>
		<title>
			<?php /*echo ucfirst(time_elapsed_string($row['posted']));*/ if ($row['type']!==20) echo $comment_author['username']; if ($row['type']==1) { ?> commented on the member <?php echo htmlspecialchars($place['username']); } elseif ($row['type']==2) { ?> commented on the game <?php echo htmlspecialchars($place['name']); } elseif ($row['type']==3) { ?> commented on the review <?php echo htmlspecialchars($place['title']); ?> commented on on the game <?php echo htmlspecialchars($place['place_info']['name']); } elseif ($row['type']==10) { ?> posted the game <?php echo htmlspecialchars($row['name']); } elseif ($row['type']==20) { ?> A new user is registered called <?php echo htmlspecialchars($row['name']); } ?>
		</title>
		<link>http://gamemaker.mooo.com/</link>
		<pubDate><?php echo date('D, d F Y H:i:s +0000',strtotime($row['posted'])); ?></pubDate>
		<dc:creator><![CDATA[@Yambam on gamemaker.mooo.com]]></dc:creator>
				<category><![CDATA[Activity]]></category>
		<guid isPermaLink="false">comment_<?php echo $row['id']; ?>@gamemaker.mooo.com</guid>
		<description><![CDATA[<?php echo $Parsedown->setBreaksEnabled(true)->text($row['content']); ?>]]></description>
		</item>
<?php
	}
	/*if (mysqli_num_rows($result)==0) { ?>
					<div class="comment item" style="text-align: center; vertical-align: center; height: 94px; line-height: 94px;">No comments yet.</div>
<?php
	}*/
?>
	</channel>
</rss>
