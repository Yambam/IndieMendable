<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    	  		<meta name="keywords" content="YoYoGames YoYo free games downloads community GameMaker Game Maker GM minigames share make play gaming fun game creation design software" />
  		<meta name="description" content="Where the world comes to Play, Make, Share and Find games!" />
  	    <title>YoYo Games</title>

  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"/>
  <link rel="icon" href="/favicon.ico" type="image/x-icon"/>
  
  <link href="/stylesheets/screen.css?1394015079" media="screen" rel="stylesheet" type="text/css" />
    
  
  <script src="/javascripts/application.js?1394015079" type="text/javascript"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
  <script>
    $.noConflict();
  </script>
  
  
  
  
  
  
  
  
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-2711665-1']);
  _gaq.push(['_setDomainName', '.yoyogames.com']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
  
</head>
<body>



<div id="wrapper">
	<div id="container">
		<div id="header">
			<h2><a href="/">YOYO Games<span></span></a></h2>
			<p class="access"><a href="#content">Skip navigation</a></p>		

		    <form method="get" action="/search">
		    <p>
		      <input id="q" type="text" class="text" name="q" value="" onkeyup="checkSearchBox();" onkeypress="if ($('q').value.length < 3){ return event.keyCode!=13 }" />
		      <input type="submit" alt="Submit" value="" id="search" />
	      </p>
	      		    
		    <script type="text/javascript">
		      function checkSearchBox() {
  		      if ($('q').value.length < 3){
  		        $('search').disabled = true;
  		        $('search').style.backgroundImage = 'url(/images/layout/search-button-header-disabled.gif)';
  		      }
  		      else{
  		        $('search').disabled = false;
  		        $('search').style.backgroundImage = 'url(/images/layout/search-button-header.gif)';
  		      }
	        }
	        
	        checkSearchBox();
		    </script> 
		  </form>		
			
		</div>
				<div id="topnav">
			<ul>
				<li id="topnav-play" ><a href="/browse">Play<span></span></a></li>
				<li id="topnav-make" ><a href="/make">Make<span></span></a></li>
				<li id="topnav-share" ><a href="/publish/new">Share<span></span></a></li>
				<li id="topnav-help" ><a href="http://www.yoyogames.com/help">Help<span></span></a></li>
			</ul>
		</div>
	
		<div id="membernav">
	    <ul class="left">
    <li><a href="http://www.yoyogames.com">Home</a></li>
    <li><a href="http://gmc.yoyogames.com">Forums</a></li>
    <li><a href="http://www.yoyogames.com/gamemaker">GameMaker</a> </li>
    <li class="last"><a href="http://wiki.yoyogames.com">Wiki</a></li>
</ul>

<ul class="right">
       <li><a href="http://www.yoyogames.com/login">Login</a></li>
     <li><a href="http://www.yoyogames.com/register">Register</a></li>
  

     <li class="last"><a href="http://www.yoyogames.com/feedback">Feedback</a></li>
</ul>

		</div>
	
		<div id="main">  
		  <noscript>Please Enable Javascript to use YoYoGames</noscript>        
                       
                       
                       
        
      
<?php if (array_key_exists('install', $_GET)) { ?>
    <OBJECT ID="YYGInstantPlay1" WIDTH=746 HEIGHT=43 ALIGN=CENTER 
      CODEBASE="/plugins/activex/YoYo.cab#Version=1,1,0,17"
      CLASSID="CLSID:C49134CC-B5EF-458C-A442-E8DFE7B4645F">
     <param name="_Version" value="65536">
     <param name="_ExtentX" value="19738">
     <param name="_ExtentY" value="1138">
     <param name="_StockProps" value="0">
     <param name="GameID" value="225344">
    </OBJECT>
<?php } ?>
<div class="block">
  <div id="subnav">
	<h1>Help</h1>
	
	<ul style="margin-bottom: 10px;">      
	  <li class="even"><a href="http://www.yoyogames.com/help"><span title='Frequently Asked Questions'>FAQ</span></a></li>                
	  <li class="odd"><a href="http://www.yoyogames.com/help/activex">ActiveX Control</a></li>
		<li class="even"><a href="http://www.yoyogames.com/help/firefox">Firefox Plugin</a></li>
	</ul>
</div>

  <div class="col-box-full staticcontent">
    <div class="col-box-full-top">
      <h1>ActiveX Control</h1>
    </div>
    <div id="gmhome-content-right">
      <h2 style="margin-top: -10px;">The YoYoGames InstantPlay Control (ActiveX Version for Internet Explorer)</h2>

      <p>Installing this neat control for your browser will allow you to play your favourite games from the YoYoGames website using a single click of your mouse. Not only will it save you the trouble of downloading and unzipping game archives, but it's safer than running all those different executables too. It's even digitally signed so that you know it's come directly to your computer from the lovely people at YoYoGames.</p>

<?php if (!array_key_exists('install', $_GET)) { ?>
      
		    <p><a href="/help/activex?install=1"><img border="0" src="/images/activex/Install.jpg" width="88" height="21" /></a></p>
<?php } ?>
      

      <h2><em>Minimum Requirements</em></h2>
      <ul>
        <li>Windows 2000</li>
        <li>Internet Explorer 6</li>
        <li>DirectX 8.1</li>
      </ul>

      <h2>Windows 2000</h2>
      <p>When you click on the install button you will be presented with a Security Warning like the one below asking if you want to install and run the "YoYo Games Instant Play Control." You should check that it is signed by YoYoGames Limited and click on "Yes" to proceed.</p>
      <img src="/images/activex/2K.jpg" alt="Security Warning for Windows 2000" />
<br/><br/>
      <h2>Windows XP and Vista</h2>
      <p>Clicking on the install button will cause a bar similar to this one to appear at the top of your browser window:</p>
      <img src="/images/activex/XPVista.jpg" alt="Security Warning for Windows XP and Vista" />

      <p>Click on the bar and select "Install ActiveX Control" from the menu that appears. Now a security warning will appear like the one below asking you to confirm that you want to install the YoYo Games Instant Play Control. Click on the install button and you're done!</p>
      <img src="/images/activex/Security.jpg" alt="Security Warning part 2 for Windows XP and Vista" />
      
      <br/><br/>	
	
	    <h2>UAC Under Vista:</h2>
      <p>If you have UAC activated under Vista then you will also need to add the YoYo Games website to your list of "Trusted Sites" like this:</p>
      <ul>
          <li>- Go to Tools->Internet Options and select the "Security Tab"</li>
          <li>- Select "Trusted Sites" and click on the "Sites" button.</li>
          <li>- In the box that appears: uncheck the "Require server verification" and click on the "Add" button.</li>
          <li>- Close and return to the YoYo website.</li>
      </ul>
      <img src="/images/activex/Trusted.jpg" alt="add to trusted sites" />
      
	
		<br/><br/>
		Looking for the Firefox plugin? <a href="http://www.yoyogames.com/help/firefox">click here</a>


    </div> <!-- gmhome-content-right -->
  </div> <!-- col-box-full -->
</div> <!-- block -->

		</div>
		
		<div id="footer">	
  <p>&copy; 2007-2014 YoYo Games </p>
  
  <ul>
  	<li class="first"><a href="http://www.yoyogames.com/terms">Terms &amp; Conditions</a></li>
  	<li><a href="http://wiki.yoyogames.com/index.php/YoYoGames_Wiki:Privacy_policy" onclick="window.open(this.href);return false;">Privacy guidelines</a></li>
  	<li><a href="http://wiki.yoyogames.com/index.php/YoYoGames_Wiki:Advertise_With_Us" onclick="window.open(this.href);return false;">Advertise with us</a></li>
  	<li><a href="http://wiki.yoyogames.com/index.php/YoYoGames_Wiki:About_Us" onclick="window.open(this.href);return false;">About us</a></li>			
  	<li><a href="http://help.yoyogames.com">Contact us</a></li>		
  	<li><a href="http://help.yoyogames.com">Help</a></li>			
  </ul>  	
</div>
		
	</div> 
	
	
	<div id="skyscraper">
    <script type="text/javascript"><!--
    google_ad_client = "pub-3773400329573214";
    /* 120x600, created 09/06/10 */
    google_ad_slot = "9652207337";
    google_ad_width = 120;
    google_ad_height = 600;
    //-->
    </script>
    <script type="text/javascript"
    src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
    </script>
    
    <script type="text/javascript"><!--
    google_ad_client = "pub-3773400329573214";
    /* 120x600, created 09/06/10 */
    google_ad_slot = "9652207337";
    google_ad_width = 120;
    google_ad_height = 600;
    //-->
    </script>
    <script type="text/javascript"
    src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
    </script>    
	</div>
	
</div>   



</body>
</html>
