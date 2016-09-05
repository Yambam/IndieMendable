<?php
	$query = $_GET['q'];
	$query_url = urlencode($_GET['q']);
	$no_picture = '/yyg/images/user_missing_large.gif'
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb">
<head>
    <script type="text/javascript" src="/static/js/analytics.js"></script>
    <link type="text/css" rel="stylesheet" href="/static/css/banner-styles.css" />

    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta name="keywords" content="YoYo Games Bumps Bumps game download play free">
    <meta name="description" content="YoYo Games Download and Play Bumps">
    <title>YoYo Games | <?php if (empty($_GET['q'])) echo "Search"; else echo "{$_GET['q']} - Searching for games"; ?></title>

    <link href="/yyg/stylesheets/reset.css" media="screen" rel="Stylesheet" type="text/css" />
    <link href="/yyg/stylesheets/fonts.css" media="screen" rel="Stylesheet" type="text/css" />
    <link href="/yyg/stylesheets/carousel.css" media="screen" rel="Stylesheet" type="text/css" />
    <link href="/yyg/stylesheets/screen.css" media="screen" rel="Stylesheet" type="text/css" />
    <link href="/yyg/stylesheets/default.css" media="screen" rel="Stylesheet" type="text/css" />

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="icon" href="/favicon.ico" type="image/x-icon" />

    <script src="/yyg/javascripts/prototype.js" type="text/javascript"></script>
    <script src="/yyg/javascripts/effects.js" type="text/javascript"></script>
    <script src="/yyg/javascripts/dragdrop.js" type="text/javascript"></script>
    <script src="/yyg/javascripts/controls.js" type="text/javascript"></script>
    <script src="/yyg/javascripts/validation.js" type="text/javascript"></script>
    <script src="/yyg/javascripts/application.js" type="text/javascript"></script>

    <script src="/yyg/javascripts/yahoo.js" type="text/javascript"></script>
    <script src="/yyg/javascripts/event.js" type="text/javascript"></script>
    <script src="/yyg/javascripts/container_core.js" type="text/javascript"></script>
    <script src="/yyg/javascripts/dom.js" type="text/javascript"></script>
    <script src="/yyg/javascripts/animation.js" type="text/javascript"></script>
    <script src="/yyg/javascripts/carousel.js" type="text/javascript"></script>
    <script src="/yyg/javascripts/addevent.js" type="text/javascript"></script>
    <script src="/yyg/javascripts/sweettitles.js" type="text/javascript"></script>

    <script type="text/javascript">
        var handlePrevButtonState = function (type, args) {

            var enabling = args[0];
            var leftImage = args[1];
            if (enabling) {
                leftImage.src = "/yyg/images/slider/left-enabled.gif";
            } else {
                leftImage.src = "/yyg/images/slider/left-disabled.gif";
            }

        };

        var handleNextButtonState = function (type, args) {

            var enabling = args[0];
            var rightImage = args[1];

            if (enabling) {
                rightImage.src = "/yyg/images/slider/right-enabled.gif";
            } else {
                rightImage.src = "/yyg/images/slider/right-disabled.gif";
            }

        };

        var handlePrevGameButtonState = function (type, args) {

            var enabling = args[0];
            var leftImage = args[1];
            if (enabling) {
                leftImage.src = "/yyg/images/nav/black-page-nav-prev.gif";
            } else {
                leftImage.src = "/yyg/images/nav/black-page-nav-stop.gif";
            }

        };

        var handleNextGameButtonState = function (type, args) {

            var enabling = args[0];
            var rightImage = args[1];

            if (enabling) {
                rightImage.src = "/yyg/images/nav/black-page-nav-next.gif";
            } else {
                rightImage.src = "/yyg/images/nav/black-page-nav-stop.gif";
            }
        };
    </script>
</head>

<div id="wrapper">
	<div id="container">
		<div id="header">
			<h2><a href="/">YOYO Games<span></span></a></h2>

                <form method="get" action="/yyg/search">
                    <input id="q" type="text" class="text" name="tag" value="" onkeyup="if (value.length < 3){$('search').disabled = true;$('search').src='/yyg/images/layout/search-button-header-disabled.gif';}else{$('search').disabled = false;$('search').src='/yyg/images/layout/search-button-header.gif';}" onkeypress="if ($('q').value.length < 3){ return event.keyCode!=13 }" />
                    <input id="search" type="image" src="/yyg/images/layout/search-button-header-disabled.gif" alt="Submit" value="Submit" />
                    <script type="text/javascript">
                        if ($('q').value.length < 3) {
                            $('search').disabled = true;
                            $('search').src = '/yyg/images/layout/search-button-header-disabled.gif';
                        } else {
                            $('search').disabled = false;
                            $('search').src = '/yyg/images/layout/search-button-header.gif';
                        }
                    </script>
                </form>
            </div>
            <div id="topnav">
                <ul>
                    <li id="topnav-play" class="current"><a href="/yyg/browse">Play<span></span></a>
                    </li>
                    <li id="topnav-make"><a href="/yyg/make">Make<span></span></a>
                    </li>
                    <li id="topnav-share"><a href="/yyg/publish">Share<span></span></a>
                    </li>
                    <li id="topnav-help"><a href="/yyg/help">Help<span></span></a>
                    </li>
                </ul>
            </div>

            <div id="membernav">
                <ul class="left">
					<li><a href="/yyg">Home</a></li>
					<li><a href="http://gmc.yoyogames.com">Forums</a></li>
					<li><a href="/yyg/gamemaker">GameMaker</a> </li>
					<li class="last"><a href="http://wiki.yoyogames.com">Wiki</a></li>
				</ul>

				<ul class="right">
					<li><a href="/yyg/login">Login</a></li>
					<li><a href="/yyg/register">Register</a></li>
					
					<li class="last"><a href="/yyg/feedback">Feedback</a></li>
				</ul>
            </div>

<div id="main">  
		  <noscript>Please Enable Javascript to use YoYoGames</noscript>        
                       
                       
                       
        
      <div class="block">
	<div id="search-legend">
    	<img src="/yyg/images/layout/browse-play-arrow.gif" alt="Play" /><p>Searching For '<?php echo $query; ?>'</p>
	</div>
</div>

<div class="block">
  <div id="subnav-container">
	  <div id="subnav">
	    <h1>Search Tips</h1>
	    <ul>
	      <li><strong>And :</strong> game &amp; maker</li>
	      <li><strong>Or :</strong> game | maker</li>
	      <li><strong>Not :</strong> game -maker</li>
	    </ul>
	  </div> 
  </div>  
  
  <div id="game-list" class="game-list-larger">
	  <div id="game-list-tabs-large">
  <ul>
		<li class="current"><a href="/yyg/search?q=<?php echo $query_url; ?>">Games</a></li>
		<li><a href="/yyg/search?q=<?php echo $query_url; ?>&amp;type=users">Members</a></li>
  </ul>
</div>

<div id="game-list-no-subnav"></div>

    <br />



 
  
  
  
  <ol>
<?php
	$con = mysqli_connect("localhost","root","imaHab2","gamemaker");
	if (mysqli_connect_errno($con)) {
		echo "Error: " . mysqli_connect_error();
	}
	
	$query_url = urlencode($query);
	//$url = "http://www.google.com/search?q=$query_url+yoyogames+sandbox&gbv=1&filter=0";
	$url = "http://www.bing.com/search?q=$query_url+site%3Ahttp%3A%2F%2Fsandbox.yoyogames.com%2Fgames";
	$content = file_get_contents($url);
	//echo $content;
	$content = '';
	/*for($i=0;$i<30;$i+=10) {
		$content .= file_get_contents($url . "&start=$i");
	}*/
	for($i=1;$i<41;$i+=10) {
		$content .= file_get_contents($url . "&first=$i");
	}
	//echo $content;
	$content = str_replace('<b>','',$content);
	$content = str_replace('</b>','',$content);
	$content = str_replace('<strong>','',$content);
	$content = str_replace('</strong>','',$content);
	$result = array();
	//preg_match_all('/<h3 class="r"><a href="\/url\?q=(http:\/\/sandbox.yoyogames.com\/games\/.*?)&amp;.*">(.*?)<\/a><\/h3>/',$content,$result);
	preg_match_all('/<div class="b_title".*?><h2><a href="(http:\/\/sandbox.yoyogames.com\/games\/.*?)" h=".*?">(.*?)<\/a><\/h2>/',$content,$result);
	//print_r($result);
	//preg_match_all('/' . preg_quote('<h3 class="r"><a href="/url?q=(') . '(http://sandbox.yoyogames.com/games/)' . '.*' . preg_quote(')&amp;.*">(.*)</a></h3>/'),$content,$result);
	
	$search_sql = '';
	$query_split = explode(' ',preg_quote($query));
	while($query_split[sizeof($query_split)-1]==='') {
		array_pop($query_split);
	}
	//print_r($query_split);
	for($j=min(3,sizeof($query_split)-1);$j>=0;$j-=1) {
		if (!empty($search_sql)) {
			$search_sql .= "\r\nUNION\r\n";
		}
		
		$_search_sql = '';
		for($i=0;$i<sizeof($query_split)-$j;$i+=1) {
			if (!empty($_search_sql)) {
				$_search_sql .= '|';
			}
			for($k=0;$k<=$j;$k+=1) {
				if ($k!=0) {
					$_search_sql .= '-';
				}
				$_search_sql .= $query_split[$i+$k];
			}
		}
		$search_sql .= "(SELECT * FROM yyg_games_list WHERE CONCAT(name) REGEXP '([^a-zA-Z0-9_]|^)(" . $_search_sql . ")([^a-zA-Z0-9_]|$)' LIMIT 50)";
	}
	//$search_sql = "CONCAT(name) REGEXP '([^a-zA-Z0-9_]|^)(" . $_search_sql . ")([^a-zA-Z0-9_]|$)'";
	$query = $search_sql; //"SELECT * FROM yyg_games_list WHERE $search_sql";
	//echo '<pre style="font-size: .7em;">'.$query.'</pre>';
	$_result = mysqli_query($con,$query);
	if (!$result) {
		echo "ERROR: ".mysqli_error($con);
	}
	while($row = mysqli_fetch_assoc($_result)) {
		$result[0][] = ucfirst(str_replace('-',' ',$row['name']));
		$result[1][] = 'http://sandbox.yoyogames.com/games/'.$row['id'].'-'.$row['name'];
		$result[2][] = ucfirst(str_replace('-',' ',$row['name']));
	}
?>
					<div class="games-alt items" style="max-height: 505px; overflow: auto;" data-columns="3" data-per-page="12">
<?php
	$games_listed = array();
	$games_done = array();
	for($i=0;$i<sizeof($result[0]);$i+=1) {
		unset($row);
		$row['picture'] = '';
		$row['author'] = '';
		//echo $result[1][$i];
		$row['url_filtered'] = str_replace('/send_download','',str_replace('/reviews','#',str_replace('/download','',/*urldecode*/($result[1][$i]))));
		$row['url_orig'] = preg_replace('/(.*?\/games\/.*?)[\/-].*/','\1',$row['url_filtered']);
		$row['url'] = "http://web.archive.org/web/".date('YmdHis')."/".$row['url_orig'];
		$row['url_download'] = "http://www.yoyogames.com/web/*/".$row['url_filtered']."/*";
		$downloads = json_decode(file_get_contents("http://web.archive.org/cdx/search/cdx?limit=1000&output=json&url=".preg_replace('/(.*?\/games\/.*?)[\/-].*/','\1',$result[1][$i])."-*"));
		//echo preg_replace('/(.*?\/games\/.*?)[\/-].*/','\1',$result[1][$i]);
		for($j=1;$j<sizeof($downloads);$j+=1) {
			if (stristr($downloads[$j][0],'/send_download'))
			if ($downloads[$j][4]=='200')
			if (strpos($downloads[$j][1],'2014')==0
			||  strpos($downloads[$j][1],'2015')==0
			||  strpos($downloads[$j][1],'2016')==0)
			if (strlen(explode('?',$downloads[$j][0])[1])>=1) {
				$row['url_download'] = str_replace('com,yoyogames,sandbox)',"http://web.archive.org/web/".date('YmdHis').'/http://sandbox.yoyogames.com',$downloads[$j][0]);
				break;
			}
		}
		//print_r($downloads);
		$row['name'] = str_replace('Downloading Game | ','',str_replace('Reviews: Listing All Reviews for ','',str_replace('Reviews for ','',str_replace('YoYo Games | ','',$result[2][$i]))));
		if (in_array($row['url_orig'],$games_listed)) {
			continue;
		} else {
			$games_listed[] = $row['url_orig'];
			//echo $row['url_orig'];
		}
		
		//echo $result[1][$i];
		//echo $row['url'];
		$content = file_get_contents($row['url']);
		//echo "http://web.archive.org/web/"+date('YmdHis')+"/"+$row['url'];
		$result2 = array();
		if (preg_match('/\<li id\="gameimages\-carousel\-item\-1"\>\s*?\<span\>\<\/span\>\<a href\=".*?" rel\="lightbox\[gameimage\]"\>\<img alt\=".*?" src\="(.*?)" \/\>\<\/a\>/',$content,$result2)>=1) {
			$row['picture'] = 'http://web.archive.org' . str_replace('/large/','/large/',$result2[1]);
		}
		if (preg_match('/<strong>Created by:<\/strong> <a href=".*?\/users\/.*?">(.*?)<\/a>/',$content,$result2)>=1) {
			$row['author'] = $result2[1];
		}
		if (preg_match('/<li class=\'current-rating\' style=\'width:(.*?);\'>Currently .*? /',$content,$result2)>=1) {
			$row['rating'] = intval($result2[1])/12;
		}
		if (preg_match('/Played <strong>(.*?)<\/strong>/',$content,$result2)>=1) {
			$row['plays'] = $result2[1];
			//echo $row['plays'];
		}
		if (preg_match('/<strong>Added:<\/strong> (.*?)<br \/>/',$content,$result2)>=1) {
			$row['created'] = date('d/m/y',strtotime($result2[1]));
			//echo $row['created'];
		}
		if (preg_match('/<title>(.*?)<\/title>/',$content,$result2)>=1) if (strlen($result2[1])>10) {
			//$row['name'] = $result2[1];
			$row['name'] = str_replace('Downloading Game | ','',str_replace('Reviews: Listing All Reviews for ','',str_replace('Reviews for ','',str_replace('YoYo Games | ','',$result2[1]))));
		}
		
		if ($row['picture']=='') {
			$row['picture'] = $no_picture;
		}
?>
      <li>
          <div class="game-thumb-large"><span></span><a href="<?php echo $row['url_download'] ?>" title="<?php echo $row['name'] ?>"><img style="max-width: 116px; max-height: 92px;" src="<?php echo $row['picture'] ?>" alt="<?php echo $row['name'] ?>" /></a></div><a href="<?php echo $row['url'] ?>" title="<?php echo $row['name'] ?>"><?php echo $row['name'] ?></a><br /><small>By <a target="_blank" href="<?php echo "http://web.archive.org/web/".date('YmdHis')."/http://sandbox.yoyogames.com/users/".$row['author']; ?>"><?php echo $row['author']; ?></a></small><br /><small>Plays: <?php echo $row['plays']; ?><br />Created: <?php echo $row['created']; ?></small><br /><ul class='star-rating'><li class="current-rating" style="width: <?php echo $row['rating']*60/5; ?>px; padding: 0;">Rating: <?php echo number_format($row['rating'],2,'.',''); ?>/5 Stars.</li></ul>
      </li><?php
			//echo str_repeat('<!----->',1024*8);
		flush();
		ob_flush();
	}
	if (sizeof($result[0])==0) { ?>
					<div class="item" style="text-align: center; height: 130px; line-height: 130px;">No results found.</div>
<?php
	} else {
		//echo '<a href="' . $url . '">' . $url . '</a>';
		?><li>
          <div class="game-thumb-large"><span></span><a href="<?php echo $url; ?>" title="More..."><img style="max-width: 116px; max-height: 92px;" src="<?php echo $no_picture ?>" alt="More..." /></a></div><a href="<?php echo $url; ?>" title="More...">More...</a>
      </li><?php
	}
?>
				</div>
		</div>
	</div>
	</body>
</html>