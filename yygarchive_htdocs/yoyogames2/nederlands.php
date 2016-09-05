<?php
	if (array_key_exists('lang', $_GET)) {
		$translate = $_GET['lang'] == 'nl';
	} else {
		$translate = false;
	}
	if ($translate) {
		// Front page
		$body_new = str_replace('<h1>Spotlight</h1>', '<h1>Uitgelicht</h1>', $body_new);
		$body_new = str_replace('<h1>YoYo Games News</h1>', '<h1>YoYo Games Nieuws</h1>', $body_new);
		$body_new = str_replace("<h1>What's Hot</h1>", '<h1>Uitgelicht</h1>', $body_new);
		$body_new = str_replace("\">View All What's Hot", '">Bekijk alles Uitgelicht', $body_new);
		$body_new = str_replace('">View All ', '">Bekijk alle ', $body_new);
		
		// General
		$body_new = str_replace('<small>created by ', '<small>gemaakt door ', $body_new);
		
		// User profile pages
		$body_new = str_replace('<h1>Friends', '<h1>Vrienden', $body_new);
		$body_new = str_replace('<strong>Name:</strong>', '<strong>Naam:</strong>', $body_new);
		$body_new = str_replace('<strong>Age:</strong>', '<strong>Leeftijd:</strong>', $body_new);
		$body_new = str_replace('<strong>Location:</strong>', '<strong>Locatie:</strong>', $body_new);
		$body_new = str_replace('<strong>Description:</strong>', '<strong>Beschrijving:</strong>', $body_new);
		$body_new = str_replace('<strong>Registered:</strong>', '<strong>Geregistreerd:</strong>', $body_new);
		$body_new = str_replace('By This Member', 'van deze gebruiker', $body_new);
		$body_new = str_replace('By This', 'van deze', $body_new);
		$body_new = str_replace('Member', 'Gebruiker', $body_new);
		$body_new = str_replace('<h2>Recently Played Games', '<h2>Laatst gespeelde games', $body_new);
		$body_new = str_replace('<h2>Favourite games', '<h2>Favoriete games', $body_new);
		$body_new = str_replace('Creator</h1>', 'maker</h1>', $body_new);
		$body_new = str_replace('<h1>More Games', '<h1>Meer games', $body_new);
		$body_new = str_replace('<h1>More', '<h1>Meer', $body_new);
		
		// Game pages
		$body_new = str_replace('<small>By <a href="', '<small>door <a href="', $body_new);
		$body_new = str_replace('<strong>Added:</strong>', '<strong>Geplaatst:</strong>', $body_new);
		$body_new = str_replace('<strong>Created by:</strong>', '<strong>Gemaakt door:</strong>', $body_new);
		$body_new = str_replace('<strong>Version:</strong>', '<strong>Versie:</strong>', $body_new);
		$body_new = str_replace('<h1>Reviews</h1>', '<h1>Recensies</h1>', $body_new);
		$body_new = str_replace('<h1>Comments</h1>', '<h1>Reacties</h1>', $body_new);
		$body_new = str_replace('<p>Category: <a href="/browse?category=', '<p>Categorie: <a href="/browse?category=', $body_new);
		$body_new = str_replace('<strong>Game description:</strong>', '<strong>Beschrijving:</strong>', $body_new);
		
		// Browse
		$body_new = str_replace('<small>Plays: ', '<small>Downloads: ', $body_new);
		$body_new = str_replace('<br />Created: ', '<br />Gemaakt: ', $body_new);
		
		// Comments
		$special = ' said ';
		$special2 = ' schreef ';
		for($i=0; $i<2; $i++) {
			$body_new = str_replace($special . 'over ', $special2 . 'meer dan ', $body_new);
			$body_new = str_replace($special . 'almost ', $special2 . 'bijna ', $body_new);
			$body_new = str_replace($special . 'about ', $special2 . 'ongeveer ', $body_new);
			$body_new = str_replace($special, $special2, $body_new);
			$special = "      \n             \n  \n	\n	<h3>\n	  ";
			$special2 = $special;
		}
		
		$body_new = str_replace("</a> commented on  \n	\n  	\n  	   the member <a href=\"", '</a>, gereageerd op de gebruiker <a href="', $body_new);
		$body_new = str_replace("</a> commented on  \n	\n  	\n  	   the game <a href=\"", '</a>, gereageerd op de game <a href="', $body_new);
		
		
		// Time
		$special = "</p>\n			\n    			<p class=\"spam\" id=\"comment-";
		for($i=0; $i<2; $i++) {
			$body_new = str_replace(' minute ago' . $special, ' minuut geleden' . $special, $body_new);
			$body_new = str_replace(' minutes ago' . $special, ' minuten geleden' . $special, $body_new);
			$body_new = str_replace(' hour ago' . $special, ' uur geleden' . $special, $body_new);
			$body_new = str_replace(' hours ago' . $special, ' uur geleden' . $special, $body_new);
			$body_new = str_replace(' day ago' . $special, ' dag geleden' . $special, $body_new);
			$body_new = str_replace(' days ago' . $special, ' dagen geleden' . $special, $body_new);
			$body_new = str_replace(' month ago' . $special, ' maand geleden' . $special, $body_new);
			$body_new = str_replace(' months ago' . $special, ' maanden geleden' . $special, $body_new);
			$body_new = str_replace(' year ago' . $special, ' jaar geleden' . $special, $body_new);
			$body_new = str_replace(' years ago' . $special, ' jaar geleden' . $special, $body_new);
			$special =  ' <a href="';
		}
		
		// Links
		$body_new = preg_replace('/<a href="(.*?\?.*?)"/', '<a href="$1&lang=nl"', $body_new);
		$body_new = preg_replace('/<a href="([^\?]*?)"/', '<a href="$1?lang=nl"', $body_new);
		
		// Language switcher
		$alt_url = str_replace('&lang=nl', '', $request);
		$alt_url = preg_replace('/(.*)\?lang=nl/', '$1', $alt_url);
		$alt_url = str_replace('lang=nl&', '', $alt_url);
		$body_new = preg_replace(
		'/<li class="last"><a href="(.*)">(.*)<\/a><\/li>/',
		'<li><a href="$1">$2</a></li> <li class="last"><a href="' . $alt_url . '">EN</a></li>', $body_new, 1);
	} else {
		// Language switcher
		if (strpos($request, '?')) {
			$alt_url = $request . '&lang=nl';
		} else {
			$alt_url = $request . '?lang=nl';
		}
		$body_new = preg_replace(
		'/<li class="last"><a href="(.*)">(.*)<\/a><\/li>/',
		'<li><a href="$1">$2</a></li> <li class="last"><a href="' . $alt_url . '">NL</a></li>', $body_new, 1);
	}
?>