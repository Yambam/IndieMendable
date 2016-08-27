<?php
	$uploaded_files = file('uploaded_files.txt', FILE_IGNORE_NEW_LINES);
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
	<title>IndieMendable language files</title>
	<atom:link href="http://gamemaker.mooo.com/locale/uploaded_files.rss" rel="self" type="application/rss+xml" />
	<link>http://gamemaker.mooo.com/</link>
	<description>IndieMendable language files</description>
	<lastBuildDate><?php echo date('D, d F Y H:i:s +0000'); ?></lastBuildDate>
	<language>en-US</language>
		<sy:updatePeriod>hourly</sy:updatePeriod>
		<sy:updateFrequency>1</sy:updateFrequency>
<?php
	foreach($uploaded_files as $row) {
		$row = unserialize($row);
?>
		<item>
		<title>
			<?php echo htmlspecialchars($row['subject']); ?>
		</title>
		<link>http://gamemaker.mooo.com/</link>
		<pubDate><?php echo date('D, d F Y H:i:s +0000',$row['posted']); ?></pubDate>
		<dc:creator><![CDATA[@Yambam on gamemaker.mooo.com]]></dc:creator>
				<category><![CDATA[Files]]></category>
		<guid isPermaLink="false">langfile_<?php echo $row['posted']; ?>@gamemaker.mooo.com</guid>
		<description><![CDATA[<?php echo str_replace('\r\n',"\r\n",$row['content']); ?>]]></description>
		</item>
<?php
	}
?>
	</channel>
</rss>
