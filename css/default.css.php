<?php
	include('../config.php');
	include('common.css.php');
	header('Content-type: text/css');
?>
/* 
 * Open Sans font.
 */
@font-face {
	font-family: 'Open Sans';
	font-style: normal;
	font-weight: 400;
	src: local('Open Sans'), local('OpenSans'), url(/fonts/OpenSans-Regular.ttf), url(http://fonts.gstatic.com/s/opensans/v10/cJZKeOuBrn4kERxqtaUH3T8E0i7KZn-EPnyo3HZu7kw.woff) format('woff');
}
@font-face {
	font-family: 'Open Sans';
	font-style: normal;
	font-weight: 700;
	src: local('Open Sans Bold'), local('OpenSans-Bold'), url(/fonts/OpenSans-Bold.ttf), url(http://fonts.gstatic.com/s/opensans/v10/k3k702ZOKiLJc3WVjuplzHhCUOGz7vYGh680lGh-uXM.woff) format('woff');
}
@font-face {
	font-family: 'Open Sans';
	font-style: normal;
	font-weight: 800;
	src: local('Open Sans Extrabold'), local('OpenSans-Extrabold'), url(/fonts/OpenSans-ExtraBold.ttf), url(http://fonts.gstatic.com/s/opensans/v10/EInbV5DfGHOiMmvb1Xr-hnhCUOGz7vYGh680lGh-uXM.woff) format('woff');
}
@font-face {
	font-family: 'Open Sans';
	font-style: italic;
	font-weight: 400;
	src: local('Open Sans Italic'), local('OpenSans-Italic'), url(/fonts/OpenSans-Italic.ttf), url(http://fonts.gstatic.com/s/opensans/v10/xjAJXh38I15wypJXxuGMBobN6UDyHWBl620a-IRfuBk.woff) format('woff');
}

/* 
 * Verela Round font.
 */
@font-face {
  font-family: 'Varela Round';
  font-style: normal;
  font-weight: 400;
  src: local('Varela Round'), local('VarelaRound-Regular'), url(http://fonts.gstatic.com/s/varelaround/v6/APH4jr0uSos5wiut5cpjrnhCUOGz7vYGh680lGh-uXM.woff) format('woff');
}

/* 
 * Roboto font.
 */
@font-face {
  font-family: 'Roboto';
  font-style: normal;
  font-weight: 400;
  src: local('Roboto Regular'), local('Roboto-Regular'), url(http://fonts.gstatic.com/s/roboto/v14/2UX7WLTfW3W8TclTUvlFyQ.woff) format('woff');
}

/* 
 * Droid Serif font.
 */
@font-face {
  font-family: 'Droid Serif';
  font-style: normal;
  font-weight: 400;
  src: local('Droid Serif'), local('DroidSerif'), url(http://fonts.gstatic.com/s/droidserif/v6/0AKsP294HTD-nvJgucYTaIbN6UDyHWBl620a-IRfuBk.woff) format('woff');
}

/* 
 * Orbitron font.
 */
@font-face {
  font-family: 'Orbitron';
  font-style: normal;
  font-weight: 400;
  src: local('Orbitron-Light'), local('Orbitron-Regular'), url(http://fonts.gstatic.com/s/orbitron/v6/94ug0rEgQO_WuI_xKJMFc_esZW2xOQ-xsNqO47m55DA.woff) format('woff');
}

/* 
 * Default styles.
 */
html {
	height: 100%;
	font-family: 'Open Sans', sans-serif;
}

body {
	background-color: #E0E0E0;
	/*background-color: #F5F5F5;*/
	margin: 0 10px 0;
	height: 100%;
	box-sizing: border-box;
}

#wrapper {
	margin: 0 auto 0;
	right: 10px;
	min-width: 280px;
	max-width: 744px;
	min-height: 100%;
	/*min-height: calc(100% - 90px);*/
	
	background-color: #F0F0F0;
	/*background-color: #E5E5E5;*/
	border-left: 10px solid white;
	border-right: 10px solid white;
}

#content {
	border-top: 1px solid transparent;
	/*margin: 0 10px;*/
	margin: 0;
	padding: 0 10px;
	padding-bottom: 15px;
	overflow: auto;
}

a:focus {
	outline: 0;
}

#logo {
	display: inline-block;
	color: #92C250;
	text-shadow: 3px 3px 0px rgba(0,0,0,.1);
	text-decoration: none;
	font-family: 'Droid Serif', serif;
	white-space: nowrap;
	transition: transform .1s ease 0s;
}

#logo:hover, #logo:focus {
	color: #A0D060 !important;
	/*transform: scale(1.05,1.05) rotate(1deg);*/
}

#logo sup {
	font-family: 'Open Sans', sans-serif;
}

#sessionbar {
	margin: 20px;
	text-align: center;
	position: relative;
}

#sessionbar-alt {
	display: block;
	margin: -15px 0px 15px;
	text-align: center;
	padding: 5px;
	background-color: #3E3E3E;
	border-color: #202020;
}

#sessionbar-alt a {
	color: #A9E071;
}

#sessionbar-alt a:active, #sessionbar-alt a:focus {
	color: #609000;
}

/*a {
	color: #00B000;
	text-decoration: none;
}

a:hover {
	color: #40B040;
	text-decoration: underline;
}

a:active, a:focus {
	color: #008000;
	text-decoration: underline;
}*/

a {
	color: #7BB640;
	text-decoration: none;
}

a:hover {
	color: #A0D060;
	text-decoration: underline;
}

a:active, a:focus {
	color: #5B7D2C;
	text-decoration: underline;
}

a[href^="/yyg"]::before, a[href*="http://sandbox.yoyogames.com/users"]::before {
	display: inline-block;
	vertical-align: middle;
	content: '';
	background-image: url(/img/yyg.png);
	width: 16px;
	height: 16px;
	margin-right: 3px;
}

#message {
	border: 1px solid #C0C0C0;
	padding: 2px;
	font-size: .9em;
	margin: 5px 0px 5px;
	background: #F7F7F7;
	
	animation: greenmessage 6s ease 0s forwards;
	-webkit-animation: greenmessage 6s ease 0s forwards;
}

.errormessage {
	border: 1px solid #FF0000;
	padding: 2px;
	font-size: .9em;
	margin: 5px 0px 5px;
	background: #FFF0F0;
	
	animation: redmessage 4s linear 0s forwards;
	-webkit-animation: redmessage 4s linear 0s forwards;
}

.redfield {
	border: 1px solid red;
}

.container, .container-lt, .category {
	position: relative;
	border: 2px solid #454545;
	padding: 5px;
	/*background-color: rgba(255,255,255,0.5);*/
	background-color: white;
	box-shadow: 3px 3px 0px rgba(0,0,0,.1);
	float: left;
	min-height: 100px;
	margin: 0px 0px 15px;
	border-top-left-radius: 4px;
	border-top-right-radius: 4px;
	overflow: hidden;
	
	/*transition: all .5s ease;*/
}

.category {
	padding: 0;
	background-color: #454545;
	min-height: 191px !important;
}

.category .game-spotlight, .category .game-spotlight > a {
	background-color: #454545;
}

.category .container-title {
	margin: 0;
}

.container-window, .container-window-lt {
	position: fixed;
	left: 100px;
	top: 100px;
	right: 100px;
	bottom: 100px;
	border: 2px solid #454545;
	padding: 5px;
	background-color: rgba(255,255,255,.9);
	/*background-color: white;*/
	box-shadow: 3px 3px 0px rgba(0,0,0,.1), 0px 0px 0px 200px rgba(0,0,0,.25);
	min-height: 100px;
	margin: 0px 0px 15px;
	border-top-left-radius: 4px;
	border-top-right-radius: 4px;
	z-index: 10000;
}

.container-lt, .container-window-lt {
	border-color: #E5E5E5;
}

.category {
	min-height: 200px;
	width: 44.5%;
	width: calc(50% - 11.5px);
}

.category-seamless {
	min-height: 200px;
	width: 44.5%;
	width: calc(50% - 21.5px);
	padding: 5px;
}

.category-list {
	/*min-height: 513px;*/
}

.container-title, .container-title-lt {
	background-color: #454545;
	margin: -5px -5px 5px;
	padding: 2px;
	color: white;
}

.container-title-lt {
	background-color: #E5E5E5;
	color: #606060;
}

.container-title a {
	color: #CCFF00 !important;
	text-transform: uppercase;
}

.dark {
	background-color: #505050;
	color: white;
	border: 2px solid #404040;
}

.dark a {
	color: #7BB640/*#80F040*/;
}

.dark a:hover {
	color: #C0F070;
}

.dark a:active, .dark a:focus {
	color: #5b7d2c;
}

.dark2 {
	background-color: #3E3E3E;
}

.shine {
	position: absolute;
	left: 0;
	top: 0;
	right: 0;
	bottom: 0;
	
	background: -moz-linear-gradient(-45deg, rgba(255,255,255,0) 0%, rgba(255,255,255,0) 45%, rgba(255,255,255,1) 55%, rgba(255,255,255,0) 55.1%, rgba(255,255,255,0) 100%) no-repeat;
	background: -webkit-linear-gradient(-45deg, rgba(255,255,255,0) 0%,rgba(255,255,255,0) 45%,rgba(255,255,255,1) 55%,rgba(255,255,255,0) 55.1%,rgba(255,255,255,0) 100%) no-repeat;
	background: linear-gradient(135deg, rgba(255,255,255,0) 0%,rgba(255,255,255,0) 45%,rgba(255,255,255,1) 55%,rgba(255,255,255,0) 55.1%,rgba(255,255,255,0) 100%) no-repeat;
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00ffffff', endColorstr='#00ffffff',GradientType=1);
	
	background-position: -724px 0;
	animation: shine 3s ease 2s forwards;
	-webkit-animation: shine 3s ease 2s forwards;
	
	pointer-events: none;
}

#spotlight, #spotlight-extra, .category {
	background: #404040;
	background:         linear-gradient(to bottom,#404040,#505050);
	background:      -o-linear-gradient(to bottom,#404040,#505050);
	background:     -ms-linear-gradient(to bottom,#404040,#505050);
	background:    -moz-linear-gradient(to bottom,#404040,#505050);
	background: -webkit-gradient(linear,left top,left bottom,color-stop(0%,#404040),color-stop(100%,#505050));
	background: -webkit-linear-gradient(to bottom,#404040,#505050);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#404040',endColorstr='#505050',GradientType=0);
	padding: 0;
}

#spotlight > .container-title {
	margin: 0;
}

.game-screenshots.game-spotlight > a, .game-screenshots.game-other-games > a {
	position: relative;
	filter: none !important;
	text-decoration: none;
	text-shadow: 1px 1px 2px rgba(0,0,0,.8);
}

.game-screenshots.game-spotlight > a > div, .game-screenshots.game-other-games > a > div {
	width: 100%;
	height: 50px;
	
	position: absolute;
	bottom: 0;
	overflow: hidden;
	
	font-size: 1.4em;
	background: linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.25)) no-repeat scroll center top / 100% 50px transparent;
	background-size: 100% 50px;
	transition: padding-top .2s ease 0s, height .2s ease 0s, bottom .2s ease 0s;
	color: white;
	text-align: center;
}

.game-screenshots.game-other-games > a > div {
	background: none;
	font-size: 1.1em;
}

.game-screenshots.game-other-games > a > div.not-available {
	color: #606060;
	text-shadow: none;
	height: 50px !important;
}

.game-screenshots.game-spotlight > a:hover > div, .game-screenshots.game-other-games > a:hover > div {
	height: 0;
}

.game-screenshots.game-spotlight > a > div > div, .game-screenshots.game-other-games > a > div > div {
	width: 100%;
	height: 50px;
	padding-top: 15px;
}

.statistics {
	background-color: #3E3E3E;
	color: #CDCDCD;
	padding: 8px;
	border-radius: 4px;
	font-size: .9em;
}

.login-form {
	table-layout: fixed;
	width: 100%;
	min-width: 400px;
	
	margin: 0 auto;
}

.login-form col {
	width: 150px;
}

.register-form {
	table-layout: fixed;
	width: 100%;
	min-width: 490px;
}

.upload-form {
	table-layout: fixed;
	width: 100%;
}

td {
	vertical-align: top;
}

input[type="password"], input[type="text"], input[type="file"], textarea {
	width: 100%;
	float: right;
	box-sizing: border-box;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	
	font: 99% arial, helvetica, clean, sans-serif;
	font-size: .85rem;
}

.dark textarea, .dark2 input {
	background-color: #404040;
	color: white;
	border: 1px solid #606060;
	padding: 5px;
	transition: .3s ease 0s background-color, .3s ease 0s color, .3s ease 0s border-color;
}

.dark textarea:hover, .dark2 input:hover {
	background-color: #353535;
}

.dark textarea[disabled]:hover, .dark2 input[disabled]:hover {
	background-color: #404040;
}

.dark textarea[disabled], .dark2 input[disabled] {
	color: #C0C0C0;
}

.dark textarea:focus {
	background-color: white;
	border-color: white;
	color: black;
}

.dark2 input:focus {
	background-color: white;
	border-color: white;
	color: black;
}

#captcha_code {
	width: 247px;
	float: none;
}

#login_email, #login_password {
	width: 100%;
}

input.search-field {
	float: none;
	width: 100%;
	width: calc(100% - <?php if ($language_abbr=='el') echo '80px'; else echo '60px'; ?>);
	outline: 0;
	
	border: 1px solid #C0C0C0;
	border-right: 0px;
	border-top-left-radius: 4px;
	border-bottom-left-radius: 4px;
	border-top-right-radius: 0px;
	border-bottom-right-radius: 0px;
	background: white;
	
	height: 28px;
	
	font-size: .99em;
	font-family: arial;
	padding: 4px;
}

.container-lt input.search-field {
	width: calc(100% - 80px);
}

.search-field-submit {
	position: relative;
	float: right;
	outline: 0;
	
	border: 1px solid #E0E0E0;
	border-radius: 0;
	border-top-right-radius: 4px;
	border-bottom-right-radius: 4px;
	background: linear-gradient(to bottom, #F0F0F0, #E8E8E8);
	box-shadow: -3px 0px 8px #E0E0E0;
	opacity: 1 !important;
	-webkit-appearance: none;
	
	width: <?php if ($language_abbr=='el') echo '80px'; else echo '60px'; ?>;
	height: 28px;
	
	font: 0.7em Arial, Helvetica, Clean, Sans-Serif;
	font-weight: bold;
	padding: 4px;
	color: #B0B0B0;
	
	text-align: center;
	
	transition: .1s ease 0s background, .1s ease 0s box-shadow, .1s ease 0s padding;
}

.container-lt .search-field-submit {
	width: 80px;
}

.search-field-submit:not([disabled]):active {
	/*background: linear-gradient(to bottom, #E0E0E0, #F0F0F0);*/
	border: 1px solid #C0C0C0;
	background: #E0E0E0;
	box-shadow: 1px 1px 2px rgba(0,0,0,.2) inset;
	padding: 6px 4px 4px 6px;
}

.search-field-submit:not([disabled]) {
	color: #5F5F5F;
	cursor: pointer;
}

#category-chooser a {
	display: block;
	background-color: #585858;
	margin-bottom: 3px;
	border-radius: 3px;
	padding-left: 5px;
	color: #E6E6E6;
	text-decoration: underline;
	height: 22px;
	font: 0.7rem Arial, Helvetica, Clean, Sans-Serif;
	line-height: 22px;
}

#category-chooser a:hover {
	color: #CCFF00;
	text-decoration: none;
	background-color: #4C4C4C;
	border-bottom: 1px solid #CCFF00;
	margin-bottom: 2px;
}

#category-chooser a:active, #category-chooser a:focus {
	/*color: #5B7D2C;*/
	color: #CCFF00;
}

#category-chooser a.selected {
	color: #CCFF00;
}

#search-tags > div {
	background-color: white;
	color: black;
	margin-top: 30px;
	
	max-height: 0;
	padding: 0 6px;
	transition: max-height .3s ease 0s, padding .3s ease 0s;
	overflow: hidden;
}

#search-tags > input:focus + div,
#search-tags:focus > div {
	max-height: 200px;
	padding: 3px 5px;
	overflow: auto;
	border-top: 1px solid #F0F0F0;
}

#search-tags > input {
	padding: 5px 7px;
}

#search-tags > input:focus,
#search-tags:focus > input {
	background-color: white;
	border-color: white;
	color: black;
}

#search-tags > div > a {
	display: block;
	padding: 2px 2px;
	color: black;
	text-decoration: none;
	cursor: default;
}

#search-tags > div > a:hover {
	background-color: #F0F0F0;
}

#sorted-by-chooser {
	overflow: auto;
	border-top-right-radius: 3px;
	box-shadow: 3px 3px 0px rgba(0,0,0,.1);
}

#sorted-by-chooser a {
	display: block;
	float: right;
	margin-left: 8px;
	box-sizing: border-box;
	
	background-color: #808080;
	color: white;
	height: 28px;
	line-height: 28px;
	border-top-left-radius: 3px;
	border-top-right-radius: 3px;
	border-bottom: 0 solid #E5E5E5;
	padding: 0 8px;
	
	box-shadow: 3px 3px 0px rgba(0,0,0,.1), 0px -3px 0px rgba(0,0,0,.1) inset;
	transition: .3s ease 0s background-color, .3s ease 0s color, .3s ease 0s border-bottom, .3s ease 0s box-shadow;
}

#sorted-by-chooser a.active, #sorted-by-chooser a.active:hover, #sorted-by-chooser a.active:active {
	background-color: #E5E5E5;
	color: #606060;
	box-shadow: 3px 3px 0px rgba(0,0,0,.1);
}

#sorted-by-chooser a:hover {
	/*background-color: #E5E5E5;*/
	border-bottom: 25px solid #E5E5E5;
	color: #606060;
	box-shadow: 3px 3px 0px rgba(0,0,0,.1), 0px -3px 0px #8BC650 inset;
}

#sorted-by-chooser a:active {
	background-color: #E0E0E0;
	border-bottom: 0 solid #E5E5E5;
	color: #606060;
	transition: .3s ease 0s color, .3s ease 0s border-bottom, .3s ease 0s padding-top;
	padding-top: 3px;
}

/*.user-link, .user-link-alt {
	height: 30px;
}*/

.user-link-alt {
	height: 48px;
	display: inline-block;
	margin-right: 4px;
	vertical-align: top;
}

.game {
	display: inline-block;
	box-sizing: border-box;
	width: 50%;
	width: calc(50% - 8px);
	margin: 4px;
	border: 1px solid #C0C0C0;
	box-shadow: 3px 3px 3px rgba(0,0,0,.125);
	vertical-align: top;
	transition: .3s ease 0s box-shadow, .3s ease 0s border-color;
}

.game-label {
	box-sizing: border-box;
	overflow: auto;
	margin: 0;
	margin-bottom: -1px;
	border: 1px solid #C0C0C0;
	box-shadow: 3px 3px 3px rgba(0,0,0,.25);
	vertical-align: top;
	transition: .3s ease 0s box-shadow, .3s ease 0s border-color;
	background-color: white;
}

.name-box {
	position: relative;
	background-color: #F0F0F0;
	box-shadow: 0px 0px 3px rgba(0,0,0,.25);
	overflow: hidden;
	margin-top: -1px;
	/*-webkit-transform: translate(0,0);*/
}

.game-dark .name-box {
	background-color: #202020;
	/*-webkit-transform: translate(0,0);*/
}

.game > a .name, .game-alt > a .name, .game-label > a .name {
	position: relative;
	color: rgba(0,0,0,.7);
	text-shadow: 0px 0px 3px rgba(255,255,255,.5);
	text-decoration: none;
}

.game-dark > a .name {
	position: relative;
	color: rgba(255,255,255,.7);
	text-shadow: 0px 0px 3px rgba(0,0,0,.5);
	text-decoration: none;
}

.game > a .name-box-bg, .game-alt > a .name-box-bg, .game-dark > a .name-box-bg, .game-label > a .name-box-bg {
	position: absolute;
	left: -4px;
	top: -4px;
	right: -4px;
	bottom: -4px;
	/*left: -4px;
	top: auto;
	right: -4px;
	bottom: -4px;
	padding-bottom: 75%;*/
	background-size: cover;
	background-position: center bottom;
	background-repeat: no-repeat;
	filter: blur(2px) opacity(.7);
	-webkit-filter: blur(2px) opacity(.7);
}

.game > a:hover .name, .game-alt > a:hover .name, .game-label > a .name {
	color: black;
}

.game-dark > a:hover .name {
	color: white;
}

.game > a:hover, .game-alt > a:hover, .game-dark > a:hover, .game-label > a:hover {
	text-decoration: none;
}

.game:hover, .game-alt:hover, .game-dark:hover {
	/*box-shadow: 2px 2px 3px rgba(0,0,0,.125);*/
	/*background-color: #F8F8F8;*/
	box-shadow: 3px 3px 3px rgba(123,160,14,.3);
	/*box-shadow: none;*/
	border-color: #7BA60D;
}

.game-dark:hover {
	box-shadow: 0px 0px 3px 3px rgba(123,160,14,.3);
}

.game > a {
	display: block;
	font-size: 1.1em;
	border-bottom: 1px solid #E0E0E0;
	box-shadow: 3px 3px 3px rgba(0,0,0,.0625);
}

.game-alt {
	display: inline-block;
	box-sizing: border-box;
	width: 33%;
	width: calc(33% - 8px);
	margin: 4px;
	border: 1px solid #C0C0C0;
	box-shadow: 3px 3px 3px rgba(0,0,0,.125);
	vertical-align: top;
	transition: .3s ease 0s box-shadow, .3s ease 0s border-color;
}

.game-alt > a {
	display: block;
	font-size: .9em;
	border-bottom: 1px solid #E0E0E0;
	box-shadow: 3px 3px 3px rgba(0,0,0,.0625);
}

.game .picture-large, .game-alt .picture-large {
	box-shadow: none;
	border: none;
}

.game-dark {
	/*position: relative;*/
	display: inline-block;
	box-sizing: border-box;
	width: 50%;
	width: calc(50% - 8px);
	margin: 4px;
	border: 1px solid #454545;
	box-shadow: 3px 3px 3px rgba(0,0,0,.125);
	vertical-align: top;
	transition: .3s ease 0s box-shadow, .3s ease 0s border-color;
}

.game-dark > a {
	display: block;
	font-size: 1.1em;
	border-bottom: 1px solid #505050;
	box-shadow: 3px 3px 3px rgba(0,0,0,.0625);
}

/*.game-dark > .game-info-summary {
	position: absolute;
	top: auto;
	bottom: 0;
}*/

.game-dark .picture-large, .game-dark:hover .picture-large {
	box-shadow: none;
	border: none;
	background-color: #202020;
}

.game-dark > a.game-action {
	text-align: center;
	color: #FFFF40;
	font-size: .9em;
}

.game-dark > a.game-action:hover {
	background-color: #454545;
}

.game-dark > a.game-action.upload {
	color: #FF8040;
}

/*.game .rating {
	opacity: 0;
	transition: .2s ease 0s opacity;
}

.game .rating {
	opacity: 1;
}*/

.user {
	display: inline-block;
	width: 25%;
	width: calc(25% - 8px);
	margin: 4px;
	vertical-align: top;
}

.user a {
	display: block;
	font-size: .8em;
}

.user-link a, .user-link-alt a {
	font-size: 1.1em;
}

a .picture, a .picture-alt, a .picture-large {
	float: left;
	clear: left;
	width: 24px;
	height: 24px;
	margin: 2px;
	border: 1px dotted #808080;
	background-color: #D0D0D0;
	background-size: contain;
	background-position: center;
	background-repeat: no-repeat;
	margin-right: 8px;
	
	box-shadow: 3px 3px 0px rgba(0,0,0,.1);
}

a .picture-alt {
	width: 40px;
	height: 40px;
	margin-bottom: 5px;
}

a .picture-large {
	float: none;
	width: auto;
	height: auto;
	margin: 0;
	padding-bottom: 75%;
}

.links-bar {
	position: relative;
	margin: 0 auto;
	min-width: 280px;
	max-width: 744px;
	min-height: 20px;
	margin-top: 16px;
	overflow: hidden;
	background-color: #404040;
	color: white;
	border-top-left-radius: 4px;
	border-top-right-radius: 4px;
	border-left: 10px solid #606060;
	border-right: 10px solid #606060;
}

.links-bar2 {
	margin: 0 auto;
	min-width: 280px;
	max-width: 744px;
	height: 20px;
	/*margin: 0 8px;*/
	overflow: hidden;
	background-color: #404040;
	color: white;
	border-bottom-left-radius: 4px;
	border-bottom-right-radius: 4px;
	border-left: 10px solid #606060;
	border-right: 10px solid #606060;
}

.links-bar a, .links-bar2 a {
	line-height: 20px;
	font-weight: bold;
	color: #A9E071;
	margin: 0 8px;
}

/*.links-bar, .links-bar2, #wrapper {
	box-shadow: 3px 3px 0px rgba(0,0,0,.1);
}*/

#main-bar, #moderation-bar {
	display: inline-block;
	
	width: 100%;
	padding: 0;
	margin: 2px auto 21px;
	
	background-color: #E9E9E9;
	border-bottom-left-radius: 8px;
	border-bottom-right-radius: 8px;
	
	box-shadow: 0px 3px 4px rgba(0,0,0,.1);
	transition: .5s ease 1s opacity, .5s ease 1s box-shadow;
}

#moderation-bar {
	position: relative;
	margin-bottom: 0;
	border-bottom-left-radius: 0;
	border-bottom-right-radius: 0;
	z-index: 1;
	padding-bottom: 4px;
}

#moderation-bar + #main-bar {
	position: relative;
	border-top-left-radius: 0;
	border-top-right-radius: 0;
	z-index: 2;
	padding-top: 4px;
}

#moderation-bar > span {
	display: inline-block;
	width: 102px;
	height: 20px;
	padding: 5px;
	padding-left: 18px;
	color: #808080;
	text-shadow: 3px 3px 0px rgba(0,0,0,.1);
}

/*
 * Auto-hide.
 * /
#main-bar.autohide:not(:hover) {
	box-shadow: none;
}

#main-bar.autohide {
	opacity: .75;
}

#main-bar:hover {
	opacity: 1;
	transition: 0s;
}
/**/

#main-bar a, #moderation-bar a {
	display: inline-block;
	box-sizing: border-box;
	
	position: relative;
	left: 0px;
	top: 0px;
	
	width: 15%;
	max-width: 120px;
	/*min-width: 64px;*/
	/*height: 32px;*/
	margin: 0 10px 0;
	
	color: white;
	background-color: #D8D8D8;
	text-shadow: -1px -1px 1px rgba(0,0,0,.2);
	
	border: 2px solid #D0D0D0;
	border-bottom-left-radius: 8px;
	border-bottom-right-radius: 8px;
	/*border-radius: 8px;*/
	
	/*box-shadow: 0px 0px 4px rgba(0,0,0,.05);*/
	box-shadow: 0px 0px 0px rgba(0,0,0,.1);
	transition: .4s ease 0s background-color, .4s ease 0s box-shadow, .4s ease 0s left, .4s ease 0s top;
	
	padding: 2px;
	text-align: center;
	text-decoration: none;
	text-transform: uppercase;
	line-height: 22px;
	
	font-weight: bold;
}

#main-bar a:hover, #moderation-bar a:hover {
	background-color: #E0E0E0;
	/*box-shadow: 1px 1px 5px rgba(0,0,0,.1);*/
	box-shadow: 3px 3px 0px rgba(0,0,0,.1);
	/*text-shadow: 1px 1px 2px rgba(0,0,0,.2);*/
	left: -3px;
	top: -3px;
	transition: .2s ease 0s background-color, .2s ease 0s box-shadow, .2s ease 0s left, .2s ease 0s top;
}

#main-bar a.selected, #main-bar a.selected:active,
#moderation-bar a.selected, #moderation-bar a.selected:active {
	background-color: #7BB640;
	border-color: #8BC650;
	color: white;
}

#main-bar a.selected:hover, #moderation-bar a.selected:hover {
	background-color: #8BC650;
}

#main-bar a:active, #moderation-bar a:active {
	box-shadow: none !important;/*1px 1px 5px rgba(0,0,0,.4) inset;*/
	background: #C0C0C0;
	transition: .2s ease 0s background, .2s ease 0s box-shadow, .2s ease 0s left, .2s ease 0s top;
	left: 0px;
	top: 0px;
}

#main-bar a:focus, #moderation-bar a:focus {
	box-shadow: 0px 0px 0px rgba(0,0,0,.1), 0px 0px 0px 2px rgba(255,255,255,.5);
}

.comments {
	max-height: 407px;
	overflow: auto;
	-webkit-overflow-scrolling: touch;
}

.comment {
	padding: 4px;
	overflow: hidden;
}

.page-chooser {
	background: #F0F0F0;
	border: 1px solid transparent;
	color: black;
	margin-top: 10px;
	padding: 2px;
	padding-top: 0;
	border-radius: 4px;
    line-height: 25px;
}

div:focus + .page-chooser {
	border: 1px solid rgba(128,128,128,.15);
}

.dark div:focus + .page-chooser {
	border: 1px solid rgba(0,0,0,.1);
}

.page-chooser .goto-page, .page-chooser .pseudo-page-number {
    display: inline-block;
	box-sizing: border-box;
	width: 20px;
    height: 23px;
	margin-top: 2px;
	margin-right: 4px;
	text-align: center;
	vertical-align: top;
    line-height: 23px;
	border-radius: 3px;
	background-color: white;
	color: black !important;
	
	text-decoration: none;
	
	transition: .2s ease 0s box-shadow, .2s ease 0s background-color;
}

.page-chooser .goto-page:hover, .page-chooser .pseudo-page-number:hover {
	background-color: #D0D0D0;
	box-shadow: 0px 0px 0px 5px #D0D0D0 inset;
	cursor: pointer;
}

/*.page-chooser .goto-page:active {
	background-color: #A0A0A0;
	box-shadow: 0px 0px 0px 15px #A0A0A0 inset;
}*/

.dark .page-chooser .goto-page, .dark .page-chooser .pseudo-page-number {
	background: #505050;
	color: white !important;
}

.dark .page-chooser .goto-page:hover, .dark .page-chooser .pseudo-page-number:hover {
	background-color: #303030;
	box-shadow: 0px 0px 0px 5px #303030 inset;
}

.page-chooser .pseudo-page-number {
	width: auto;
	padding-left: 4px;
	padding-right: 4px;
}

.page-chooser .pseudo-page-number:active, .page-chooser .pseudo-page-number.active {
	padding-right: 2px;
}

/*.dark .page-chooser .goto-page:active {
	background-color: #101010;
	box-shadow: 0px 0px 0px 15px #101010 inset;
}*/

.page-chooser .goto-page.active, .dark .page-chooser .goto-page.active {
	background-color: transparent;
	box-shadow: none;
	border: 1px solid rgba(0,0,0,.1);
	cursor: default;
}

.dark .page-chooser {
	background: #454545;
	color: white;
}

.page-chooser .goto-page:active, .page-chooser .pseudo-page-number:active, .dark .page-chooser .goto-page:active, .dark .page-chooser .pseudo-page-number:active {
	border: 1px solid rgba(0,0,0,.1);
}

.comment > .content {
	font-size: 0.85em;
}

.comment > .content {
	margin: 0 8px;
	word-wrap: break-word;
}

.comment > .extra-options {
	float: right;
	opacity: 0;
	transition: .1s ease 0s opacity;
}

.comment:hover > .extra-options {
	opacity: 1;
}

/*.comment > .extra-options a {
	color: black !important;
}*/

.last-active {
    display: inline-block;
    font-size: 9px;
    font-weight: bold;
    text-transform: uppercase;
    color: #FFF;
    border-radius: 4px;
    vertical-align: middle;
	cursor: default;
	transition: .2s ease 0s box-shadow, .2s ease 0s background-color, .2s ease 0s border;
	
	border: 1px solid rgba(255,255,255,0.1);
    height: 13px;
	line-height: 13px;
	padding: 0px 4px;
}

.last-active:hover {
	border: 1px solid rgba(255,255,255,0.2);
    height: 13px;
	line-height: 13px;
	padding: 0px 4px;
}

.last-active-online, .last-active-online-lt {
    background-color: #7BA60D;
    box-shadow: 0px 0px 3px #7BA60D;
}

.last-active-online:hover, .last-active-online-lt:hover {
    box-shadow: 0px 0px 5px #7BA60D;
}

.last-active-offline {
	/*background-color: #B3B3B3;*/
	/*background-color: rgba(255,255,255,0.2);*/
	/*border: 1px solid rgba(255,255,255,0.2);
    height: 13px;
	line-height: 13px;
	padding: 0px 4px;*/
}

.last-active-offline-lt {
	background-color: #5B5B5B;
}

.last-active-offline:hover, .last-active-offline-lt:hover {
    background-color: rgba(0,0,0,.1);
}

.game-long-fade {
	width: 725px;
	height: 50%;
	height: calc(100% - 560px);
	min-height: 50px;
	
	position: absolute;
	left: -5px;
	top: 530px;
	overflow: hidden;
	
	z-index: 1;
	pointer-events: none;
	
	font-size: 1.4em;
	background: linear-gradient(to bottom, transparent, #F0F0F0) no-repeat scroll center top / 100% 100% transparent;
	background-size: 100% 100%;
	transition: padding-top .2s ease 0s, height .2s ease 0s, bottom .2s ease 0s;
	color: white;
	padding-left: 30px;
	padding-top: 30px;
}

.game-featured {
	transition: transform .2s ease 0s, opacity .2s ease .0s, filter .2s ease 0s;
	cursor: default;
	opacity: .8;
}

.game-featured:hover {
	/*filter: drop-shadow(2px 2px 4px rgba(0,0,0,.5));*/
	opacity: 1;
	cursor: help;
}

.game-header {
	position: absolute;
	left: 0;
	top: 0;
	right: 0;
	bottom: auto;
	height: 128px;
	background-size: cover;
	background-position: center;
	z-index: 2;
	/*padding-bottom: 161.8%;*/
}

.game-header-offset {
	position: relative;
	height: 128px;
	margin: -2px;
	margin-bottom: 2px;
}

.game-header-offset .container-title {
	background-color: rgba(70,70,70,.5) !important;
	
	position: relative;
	/*position: absolute;*/
	
	z-index: 3;
	margin-top: 3px;
}

/*:hover > .game-featured {
	opacity: .5;
}*/

.game-screenshots {
	position: relative;
	background-color: #303030;
	border-radius: 2px;
	white-space: nowrap;
	overflow: auto;
	-webkit-overflow-scrolling: touch;
}

.container-lt .game-screenshots {
	background-color: #E0E0E0;
	border-radius: 0;
}

/*.container-lt .game-screenshots, .container-lt .game-screenshots a {
	background-color: #E0E0E0;
}

.container-lt .game-screenshots .prev, .container-lt .game-screenshots .next {
	background-color: rgba(224,224,224,.5);
}*/

.game-screenshots .shift {
	display: inline-block;
	transition: .3s cubic-bezier(0,1.5,.5,1) 0s margin-left;
}

.game-screenshots a {
	display: inline-block;
	box-sizing: border-box;
	width: 50%;
	border: 2px solid transparent;
	border-top: 4px solid transparent;
	border-bottom: 4px solid transparent;
	vertical-align: top;
	/*margin: 0;
	width: 50%;*/
	height: 165px;
	
	transition: .2s ease 0s opacity, filter .2s ease 0s;
	background-color: #303030;
	background-size: contain;
	background-position: center;
	background-repeat: no-repeat;
	
	/*filter: grayscale(.3);*/
}

.container-lt .game-screenshots a {
	background-color: #E5E5E5;
}

.game-screenshots.game-other-games a {
	height: 120px;
}

.game-screenshots:hover a {
	filter: contrast(.8);
}

.game-screenshots a:hover {
	/*opacity: .6;*/
	filter: contrast(1);
	/*filter: grayscale(0);*/
}

.game-screenshots .prev {
	background: url('../img/prev.png') no-repeat scroll left 48% transparent;
	position: absolute;
	left: 0;
	top: 0;
}

.game-screenshots .next {
	background: url('../img/next.png') no-repeat scroll right 48% transparent;
	position: absolute;
	right: 0;
	top: 0;
}

.game-screenshots .prev, .game-screenshots .next {
	opacity: .2;
	transition: opacity 0.2s ease 0s, width 0.2s ease 0s;
	width: 25px;
	height: 178px;
	background-color: rgba(0,0,0,.2);
	background-size: 100%;
	
	z-index: 2;
}

.game-screenshots.game-other-games .prev, .game-screenshots.game-other-games .next {
	height: 120px;
}

.game-screenshots .next:hover, .game-screenshots .prev:hover {
	opacity: 1;
	cursor: pointer;
	/*width: 50px;*/
	background-size: 100%;
}

.game-screenshots .prev:active, .game-screenshots .next:active {
	opacity: .5;
}

.game-screenshots .disabled,
.game-screenshots .disabled:hover,
.game-screenshots .disabled:active {
	opacity: 0;
	width: 25px;
	cursor: default;
}

.game-info {
	float: right;
	width: 300px;
	background-color: #454545;
	color: #D0D0D0;
	border-radius: 4px;
	border-bottom: 1px solid transparent;
	z-index: 2;
	position: relative;
}

.game-description.less, .game-tags.less, .newsletter.less {
	position: relative;
	transition: max-height .2s ease .2s, background .2s ease .2s;
	max-height: 100px;
	overflow: hidden;
}

.newsletter.less {
	max-height: 65px;
}

.game-description.less .game-short-fade, .game-tags.less .game-short-fade, .newsletter.less .game-short-fade {
	position: absolute;
	width: 102%;
	height: 40px;
	left: -5px;
	bottom: 0;
	border-bottom: 2px dashed #CCFF00;
	
	background: linear-gradient(to bottom, transparent, #454545) no-repeat scroll center bottom / 100% 100% transparent;
	background-size: 100% 40px;
	transition: padding-top .2s ease .2s, height .2s ease .2s, bottom .2s ease .2s, background .2s ease .2s;
	max-height: 80px;
	overflow: hidden;
	
	cursor: pointer;
}

.game-tags.less .game-short-fade, .newsletter.less .game-short-fade {
	border-bottom: none;
}

.game-description.less .game-short-fade::after {
	display: block;
	text-align: center;
	color: #CCFF00;
	content: 'SHOW MORE';
	position: relative;
	top: 23px;
	width: 100%;
	transition: opacity .2s ease .2s;
}

.newsletter.less .game-short-fade {
	background: linear-gradient(to bottom, transparent, white) no-repeat scroll center bottom / 100% 100% transparent;
}

.less:focus, .newsletter.less:hover {
	max-height: 1000px;
}

.less:focus .game-short-fade::after, .newsletter.less:hover .game-short-fade::after {
	opacity: 0;
}

.less:focus .game-short-fade, .newsletter.less:hover .game-short-fade {
	background: linear-gradient(to bottom, transparent, #454545) no-repeat scroll center bottom / 100% 0 transparent;
	border-bottom: none;
	cursor: auto;
	pointer-events: none;
}

.newsletter.less:hover .game-short-fade {
	background: linear-gradient(to bottom, transparent, white) no-repeat scroll center bottom / 100% 0 transparent;
}

.game-info a {
	color: #D0D0D0 !important;
	text-decoration: underline;
}

.game-description table {
	width: 100%;
}

.game-description ul, .game-description ol, .user-details ul, .user-details ol, .comments ul, .comments ol {
	padding-left: 1.5em;
}

.comments pre, .game-description pre, .user-details pre {
	overflow: auto;
	background-color: #E0E0E0;
	color: black;
	padding: 5px;
	border: 1px solid #C0C0C0;
	border-radius: 4px;
}

.dark .comments pre, .game-description pre, .user-details pre {
	background-color: #404040;
	color: white;
	border-color: #808080;
}

.game-description ul, .user-details ul {
	list-style: square url(/img/bullet.png);
}

.comments ul {
	list-style: square;
}

.game-description img, .comments img {
	max-width: 100%;
}

.user-details p + ul, .user-details p + ol, .comments p + ul, .comments p + ol {
	margin-top: -11px;
}

.game-description :first-child {
	margin-top: 0;
}

.game-description {
	text-align: justify;
}

.game-info a:hover {
	color: #CCFF00 !important;
}

.container-lt .game-info a {
	color: #7BB640 !important;
}

.container-lt  .game-info a:hover, .container-lt  .game-info a:focus {
	color: #5B8600 !important;
	text-decoration: none;
}

.game-info a.game-button-play, a.game-button-play, .container-lt .game-info a.game-button-play {
	display: block;
	box-sizing: border-box;
	width: 150px;
	height: 40px;
	margin: 8px auto;
	
	/*background-color: #AADD00;*/
	background-color: #7BB640;
	border-bottom: 4px solid #6BA630;
	border-radius: 4px;
	box-shadow: 0px 1px 0px 1px rgba(0,0,0,.125);
	transition: .2s ease 0s background-color, .2s ease 0s border-bottom, .2s ease 0s margin-top, .2s ease 0s line-height;
	
	color: white !important;
	text-decoration: none !important;
	/*text-transform: uppercase;*/
	font-size: 1rem;
	font-weight: bold;
	text-align: center;
	line-height: 36px;
}

a.game-button-play {
	width: auto;
	font-size: <?php if ($language_abbr=='de'||$language_abbr=='pl') echo '.8rem'; else echo '1.1rem'; ?>;
}

.game-info a.game-button-play:hover, a.game-button-play:hover {
	/*background-color: #CCFF00;*/
	background-color: #AADD00;
}

.game-info a.game-button-play:active, a.game-button-play:active {
	/*background-color: #88BB00;*/
	background-color: #88BB00;
	border-bottom: 0 solid #7BB640;
	line-height: 40px;
	/*box-shadow: none !important;*/
	box-shadow: 0px 1px 0px 1px rgba(0,0,0,.125) inset !important;
}

.game-info a.game-button-play:focus, a.game-button-play:focus {
	box-shadow: 0px 0px 0px 2px rgba(255,255,255,.5) inset;
	transition: .2s ease 0s background-color, .2s ease 0s border-bottom, .2s ease 0s margin-top, .2s ease 0s line-height, .2s ease .2s box-shadow;
}

.game-main-info {
	margin-top: 5px;
	z-index: 2;
	position: relative;
}

.game-tags a {
	display: inline-block;
	border: 1px dotted #808080;
	padding: 2px;
	margin: 1px;
	transition: .2s ease 0s background-color;
}

.game-tags a::before {
	display: inline-block;
	content: '#';
	color: #A0A0A0;
}

.game-tags a:hover, .game-tags a:focus {
	text-decoration: none;
	border-radius: 2px;
	border: 1px solid rgba(128,128,128,.5);
	background-color: rgba(128,128,128,.25);
	color: #CCFF00 !important;
	/*box-shadow: 1px 1px 0px rgba(255,255,255,.25);*/
}

.star-rating {
    list-style: outside none none;
    margin: 0px;
    padding: 0px;
    width: 60px;
    height: 15px;
    position: relative;
    background: url("/img/alt_star.gif") repeat-x scroll left top transparent;
}

.star-rating li.current-rating {
    background: url("/img/alt_star.gif") repeat-x scroll left bottom transparent;
    position: absolute;
    height: 15px;
    display: block;
    /*text-indent: -9000px;*/
	text-indent: -200px;
	overflow: hidden;
    z-index: 1;
    margin: 0px;
}

.star-rating-dark {
    list-style: outside none none;
    margin: 0px;
    padding: 0px;
    width: 60px;
    height: 15px;
    position: relative;
    background: url("/img/star_dark.gif") repeat-x scroll left top transparent;
}

.star-rating-dark li.current-rating {
    background: url("/img/star_dark.gif") repeat-x scroll left bottom transparent;
    position: absolute;
    height: 15px;
    display: block;
	text-indent: -200px;
	overflow: hidden;
    z-index: 1;
    margin: 0px;
	opacity: 1;
	/*transition: .2s ease 0s opacity;*/
}

.star-rating-dark.rateable:hover li.current-rating {
    opacity: .5;
}

.star-rating-dark a.new-rating {
    background: url("/img/star_dark.gif") repeat-x scroll left center transparent;
    position: absolute;
    height: 15px;
    display: block;
	text-indent: -200px;
	overflow: hidden;
    z-index: 2;
    margin: 0px;
	opacity: 0;
	/*transition: .2s ease 0s opacity;*/
	cursor: pointer;
}

.star-rating-dark a.new-rating:hover {
    opacity: 1;
}

.review {
	clear: both;
}

.review-star-ratings {
	float: left;
	width: 40%;
	min-width: 140px;
	max-width: 152px;
	margin-right: 8px;
}

.review-star-ratings > div {
	border-radius: 3px;
	padding: 2px;
	padding-left: 3px;
	margin: 2px;
	height: 14px;
	line-height: 14px;
	background-color: #E0E0E0;
}

.review-star-ratings .star-rating-dark, .review-star-ratings .star-rating {
	float: right;
}

.dark-inset, .dark-inset-button, .dark-inset-button-alt {
	display: block;
	padding: 1px 5px;
	min-height: 19px;
	line-height: 10px;
	font-size: 1em;
	margin: 2px 0px 0px;
	color: #CCFF00;
	overflow: hidden;
	box-sizing: border-box;
	/*background-image: url(/img/button-background.gif);*/
	/*border: 1px solid transparent;*/
	
    border: 1px solid transparent;
	border-image: url(/img/button-background.gif) 1 1 stretch;
	background-color: #151515;
}

a.dark-inset-button:focus {
	background: rgba(255,255,255,.03);
}

/*a.dark-inset-button-alt:focus {
	background: rgba(0,0,0,.1);
	box-shadow: 1px 1px 1px rgba(0,0,0,.5) inset;
}

a.dark-inset-button-alt:focus:active, a.dark-inset-button-alt:active {
	background: transparent;
	box-shadow: none;
}*/

.member-actions {
	position: absolute;
	bottom: 10px;
	left: 10px;
	right: 10px;
}

.member-actions .dark-inset-button-alt  {
	/*width: 50%;
	width: calc(50% - 10px);*/
}

.dark-inset-button-alt {
	background: transparent;
	border: 1px solid #404040;
	color: white !important;
}

a.dark-inset-button-alt:hover {
	border: 1px solid #202020;
}

a.dark-inset-button-alt:hover .fa-user, a.dark-inset-button:hover .fa-user {
	color: #80F040;
}

a.dark-inset-button-alt:hover .fa-envelope, a.dark-inset-button:hover .fa-envelope {
	/*color: #FFFF40;*/
	color: #FF8040;
}

a.dark-inset-button-alt:hover .fa-times, a.dark-inset-button:hover .fa-times {
	color: #FF4040;
}

a.dark-inset-button-alt:hover .fa-star, a.dark-inset-button:hover .fa-star {
	color: #FFFF40;
}

.dark-inset a, .dark-inset a:hover, .dark-inset a:focus, .dark-inset a:active {
	color: #D0D0D0;
	text-decoration: underline;
}

a.dark-inset-button-alt, a.dark-inset-button:hover {
	color: white !important;
}

.dark-inset-button, .dark-inset-button-alt {
	/*font-family: Orbitron;*/
	color: #808080 !important;
	font-size: .6em;
	letter-spacing: .15em;
	text-transform: uppercase;
	line-height: 15px;
}

a.dark-inset-button:hover, a.dark-inset-button:focus, a.dark-inset-button-alt:hover, a.dark-inset-button-alt:focus {
	color: white;
	text-decoration: none;
}

.version-table {
	width: 100%;
	box-sizing: border-box;
	border-spacing: 0;
}

.version-table thead td {
	background-color: #F0F0F0;
	border-bottom: 1px dotted #808080;
}

.version-table thead:last-child td {
	border-bottom: 0;
	display: none;
}

.version-table td {
	border-bottom: 1px dotted #C0C0C0;
}

.version-table tr:hover {
	background-color: #F0F0F0;
}

.version-table tr:hover a, .version-table a:active, .version-table a:focus {
	color: black;
}

.version-table a {
	color: #707070;
}

.messages-hrow {
	background-color: #F0F0F0;
	border-bottom: 1px dotted #808080;
}

.messages-hcolumn {
	margin-right: 8px;
}

.message {
	display: block;
	border-bottom: 1px dotted #C0C0C0;
	min-height: 38px;
	overflow: hidden;
	clear: both;
}

.messages-column {
	overflow: hidden;
	margin-right: 8px;
}

.messages-column-sent {
	color: #808080;
	margin-left: 8px;
	transition: width .2s ease 0s, margin-top .2s ease 0s;
	white-space: nowrap;
}

.messages-column-hide {
	width: 0;
	min-height: 38px;
	line-height: 38px;
	margin: 0 -8px;
	padding: 0 8px;
	transition: width .2s ease 0s, opacity .05s ease 0s;
	white-space: nowrap;
	border-left: 1px dashed transparent;
	opacity: .75;
}

.message:hover .messages-column-hide {
	width: 125px;
	/*box-shadow: -2px 1px 6px rgba(0,0,0,.15);*/
	opacity: 1;
	background-color: #F0F0F0;
	border-left: 1px dashed #D0D0D0;
}

.message:hover .messages-column-hide + .messages-column-sent {
	width: 0 !important;
	margin-top: 14px;
}

a.messages-column-subject {
	color: black !important;
	text-decoration: none;
	min-height: 38px;
}

a.messages-column-subject:hover {
	color: #A0A0A0 !important;
	text-decoration: none;
}

a.fa-envelope {
	color: #D0D0D0;
	text-decoration: none;
}

a.fa-envelope:hover, a.fa-envelope:focus {
	/*color: #FFFF40;*/
	color: #FF8040;
}

.friend {
	padding: 3px;
	overflow: hidden;
}

.footer {
	padding: 16px;
	border-top: 1px solid #C0C0C0;
	border-bottom: 1px solid #C0C0C0;
	margin: 16px 0;
	/*height: 24px;*/
	overflow: hidden;
}

.items {
	position: relative;
	transform: translate(0,0);
	-webkit-transform: translate(0,0);
}

.items:focus{
	outline: 0;
}

.files-preview {
	border: 1px solid #D0D0D0;
	border-left: none;
	border-right: none;
	padding: 3px;
	margin-top: 32px;
	margin-left: -132px;
	min-height: 92px;
	text-align: center;
}

.files-preview > div {
	position: relative;
	
	display: inline-block;
	border-radius: 3px;
	padding: 3px;
	box-shadow: 1px 2px 4px rgba(0,0,0,.25);
	margin: 3px;
	
	font-size: 0;
	
	cursor: pointer;
}

.files-preview > div .remove {
	position: absolute;
	left: auto;
	bottom: auto;
	top: 3px;
	right: 3px;
	
	width: 20px;
	height: 20px;
	font-size: 1.1rem;
	text-align: center;
	line-height: 20px;
	
	background-color: #C85050;
	color: white;
	opacity: 0;
	transition: opacity .2s ease 0s;
	
	cursor: default;
}

.files-preview > div:hover .remove {
	opacity: 1;
}

.files-preview > div .remove:hover {
	background-color: #E04343;
}

.files-preview > div .remove:active {
	background-color: #993D3D;
}

.files-preview > div .info {
	position: absolute;
	left: 3px;
	top: auto;
	bottom: 3px;
	right: 3px;
	
	font-size: .7rem;
	text-align: center;
	line-height: 20px;
	
	background-color: rgba(0,0,0,.5);
	color: white;
	opacity: 0;
	transition: opacity .2s ease 0s;
	
	cursor: default;
}

.files-preview > div:hover .info, .files-preview > div.no-image:hover .info {
	opacity: 1;
}

.files-preview > div.no-image .info {
	position: static;
	padding: 16px;
	
	background-color: transparent;
	color: black;
	opacity: .8;
}

.files-preview > div img {
	max-width: 150px;
	max-height: 80px;
	vertical-align: middle;
}

.files-preview .seperator {
	display: none;
}

.files-preview.seperators-visible .seperator {
	display: block;
	height: 1px;
	margin: 10px 0;
	padding: 0;
	box-shadow: none;
}

/* 
 * Messages.
 */
.new-message-count .fa-envelope-o {
	color: #808080;
}

.new-message-count:hover .fa-envelope-o {
	color: #C0C0C0;
}

.new-message-count .fa-envelope {
	color: #FF8040;
}

.new-message-count:hover .fa-envelope {
	color: #F0B0A0;
}

/* 
 * Notifications.
 */
.notifications-icon {
	background-color: white;
	color: #C0C0C0;
	/*position: fixed;*/
	position: absolute;
	left: 50%;
	margin-left: 366px;
	top: 80px;
	border-radius: 100%;
	padding: 3px;
	text-shadow: 0px 0px 0px 2px white;
	cursor: pointer;
	z-index: 99;
}

.notifications-icon .new {
	/*display: none;*/
	opacity: 0;
	position: absolute;
	left: 0;
	top: 0;
	/*font-size: 1.5em;
	color: #C00000;*/
	background-color: #D00000;
	/*width: 22px;
	height: 22px;*/
	border-radius: 100%;
	margin-left: 11px;
	margin-top: 11px;
	animation: new-notification-icon 1s cubic-bezier(0.16,3.25,0.5,1.13) 2s 1 forwards;
	-webkit-animation: new-notification-icon 1s cubic-bezier(0.16,3.25,0.5,1.13) 2s 1 forwards;
	overflow: hidden;
	z-index: 100;
}

.notifications-icon .new .fa-bell {
	position: absolute;
	left: 3px;
	top: 3px;
	font-size: 1rem;
	color: white;
	animation: new-notification-icon-2 1s cubic-bezier(0.16,3.25,0.5,1.13) 2s 1 forwards;
	-webkit-animation: new-notification-icon-2 1s cubic-bezier(0.16,3.25,0.5,1.13) 2s 1 forwards;
}

.notifications-icon .new-count {
	font-weight: bold;
	position: absolute;
	color: white;
	font-family: Open Sans;
	top: 0px;
	line-height: 22px;
	padding: 0px 12px 0px 4px;
	right: 0;/*-14px;*/
	max-width: 0;
	opacity: 0;
	background-color: #D00000;
	z-index: 99;
	border-top-left-radius: 100%;
	border-bottom-left-radius: 100%;
	animation: new-notification-count 1s cubic-bezier(0.16,3.25,0.5,1.13) 2s 1 forwards;
	-webkit-animation: new-notification-count 1s cubic-bezier(0.16,3.25,0.5,1.13) 2s 1 forwards;
}

.notifications-exit {
	pointer-events: none;
	position: fixed;
	z-index: 98;
	left: 0;
	top: 0;
	right: 0;
	bottom: 0;
	background-color: rgba(0,0,0,.5);
	opacity: 0;
	transition: opacity .5s ease 0s;
}

/*.notifications-exit:hover {
	display: block;
	background-color: blue;
}*/

#wrapper {
	animation: new-notification-border .5s ease 2s 1 forwards paused;
	-webkit-animation: new-notification-border .5s ease 2s 1 forwards paused;
}

.notifications-icon:hover, .notifications-icon:focus {
	color: #D0D0D0;
	text-decoration: none;
}

.notifications-icon:focus {
	border: 1px solid #D0D0D0;
	padding: 2px;
	outline: none;
}

.notifications-icon:active {
	color: #A0A0A0;
	text-decoration: none;
}

.notifications-icon:hover .new, .notifications-icon:focus .new {
	background-color: #E00000;
	text-decoration: none;
}

.notifications-icon:focus .new {
	border: 1px solid #FF0000;
	box-shadow: 0px 2px 2px rgba(255,0,0,.5);
	box-sizing: border-box;
	outline: none;
	left: -1px;
	top: -1px;
}

.notifications-icon:focus .new .fa-bell {
	left: 2px;
	top: 2px;
}

.notifications-icon:active .new {
	background-color: #C00000;
	text-decoration: none;
}

.notifications-window {
	box-sizing: border-box;
	width: 300px;
	border-top: 0 solid transparent;
	
	/*position: fixed;*/
	position: absolute;
	top: 98px;
	left: 50%;
	margin-left: 104px;
	z-index: 101;
	
	opacity: 0;
	height: 0;
	transition: opacity .3s ease .3s, height .3s ease .3s, right .3s ease .3s, padding .3s ease .3s, border .3s ease .3s;
}

.notifications-window::before {
	content: '';
	
	position: absolute;
	right: 19px;
	top: -8px;
	/*width: 16px;
	height: 16px;*/
	pointer-events: none;
	
	/*transform: rotate(45deg);
	-webkit-transform: rotate(45deg);*/
	border-width: 10px;
	border-style: solid;
	border-color: transparent;
	border-top: 0;
	border-bottom-color: #C0C0C0;
	/*box-shadow: 2px 2px 2px 2px rgba(0,0,0,.125);*/
	
	transition: transform .3s ease .3s;
}

.notifications-window::after {
	content: '';
	
	position: absolute;
	right: 21px;
	top: -7px;
	/*width: 16px;
	height: 16px;*/
	pointer-events: none;
	
	/*transform: rotate(45deg);
	-webkit-transform: rotate(45deg);*/
	border-width: 8px;
	border-style: solid;
	border-color: transparent;
	border-top: 0;
	border-bottom-color: white;
	/*box-shadow: 2px 2px 2px 2px rgba(0,0,0,.125);*/
	
	transition: transform .3s ease .3s;
}

.notifications-window > div {
	box-sizing: border-box;
	width: 300px;
	padding: 0 10px;
	border: 0 solid white;
	border-left: 2px solid white;
	border-right: 2px solid white;
	
	position: absolute;
	left: 0;
	top: 0;
	
	max-height: 0;
	transition: opacity .3s ease .3s, max-height .3s ease .3s, right .3s ease .3s, padding .3s ease .3s, border .3s ease .3s;
	
	background-color: white;
	box-shadow: 0px 2px 2px 2px rgba(0,0,0,.125);
	
	outline: 1px solid #C0C0C0;
}

.notifications-window > div:hover {
	/*overflow: auto;*/
}

.notifications-window > div h2 {
	font-size: 1.3em;
	font-weight: normal;
	margin: 0;
	display: block;
	padding-bottom: 10px;
	pointer-events: none;
	color: #808080;
}

.notifications-window .notifications {
	overflow: auto;
	-webkit-overflow-scrolling: touch;
	max-height: 0;
	transition: max-height .3s ease .3s;
	border: 1px solid #F0F0F0;
}

.notifications-window .notifications > div {
	padding: 3px;
	cursor: default;
	/*text-align: justify;*/
}

.notifications-window .notifications > a {
	display: block;
	padding: 3px;
	text-align: left;
	color: black;
}

.notifications-window .notifications > div a {
	color: black;
	text-decoration: none;
}

.notifications-window .notifications > :hover , .notifications > :focus {
	background-color: #F8F8F8;
	text-decoration: none;
}

.notifications-window:hover,
.notifications-icon:hover + .notifications-window, .notifications-icon:focus + .notifications-window {
	opacity: 1;
	/*height: 400px;*/
	border-top: 20px solid transparent;
}

.notifications-window:hover > div,
.notifications-icon:hover + .notifications-window > div, .notifications-icon:focus + .notifications-window > div {
	opacity: 1;
	max-height: 400px;
	padding: 10px;
	border-top: 2px solid white;
	border-bottom: 2px solid white;
}

.notifications-window:hover > div > div,
.notifications-icon:hover + .notifications-window .notifications, .notifications-icon:focus + .notifications-window .notifications {
	max-height: 323px;
	pointer-events: auto;
}

.notifications-window > div > div {
	pointer-events: none;
}

/* 
 * YoYo Quote.
 */
span.bb_quote, span.bb_code {
	display: block;
	border: 1px dashed #888;
	margin-bottom: 1em;
	padding: .5em;
	background-color: #EEEEEE;
	color: #747474;
}

span.bb_quote {
	border-left: 2px solid #7BB640;
}

span.bb_quote_title {
	color: #7BB640;
}

span.bb_code {
	width: 98%;
	overflow: scroll;
	font-family: Courier New;
}

.bb_code_title,
.bb_quote_title {
	display: block;
	font-size: .9em;
}

/* 
 * Colorful quotes.
 */

/**/

span.bb_quote span.bb_quote {
	border-left: 2px solid #407BB6;
}

span.bb_quote span.bb_quote_title {
	color: #407BB6;
}

span.bb_quote span.bb_quote span.bb_quote {
	border-left: 2px solid #B6407B;
}

span.bb_quote span.bb_quote span.bb_quote_title {
	color: #B6407B;
}

span.bb_quote span.bb_quote span.bb_quote span.bb_quote {
	border-left: 2px solid #A0C020;
}

span.bb_quote span.bb_quote span.bb_quote span.bb_quote_title {
	color: #A0C020;
}

span.bb_quote span.bb_quote span.bb_quote span.bb_quote span.bb_quote {
	border-left: 2px solid #3B9620;
}

span.bb_quote span.bb_quote span.bb_quote span.bb_quote span.bb_quote_title {
	color: #3B9620;
}

span.bb_quote span.bb_quote span.bb_quote span.bb_quote span.bb_quote span.bb_quote {
	border-left: 2px solid black;
}

span.bb_quote span.bb_quote span.bb_quote span.bb_quote span.bb_quote span.bb_quote_title {
	color: black;
}

/**

span.bb_quote span.bb_quote {
	border-left: 2px solid #407BB6;
}

span.bb_quote span.bb_quote_title, span.bb_quote span.bb_quote_title a {
	color: #407BB6;
}

span.bb_quote span.bb_quote span.bb_quote {
	border-left: 2px solid #B6407B;
}

span.bb_quote span.bb_quote span.bb_quote_title, span.bb_quote span.bb_quote span.bb_quote_title a {
	color: #B6407B;
}

span.bb_quote span.bb_quote span.bb_quote span.bb_quote {
	border-left: 2px solid #A0C020;
}

span.bb_quote span.bb_quote span.bb_quote span.bb_quote_title, span.bb_quote span.bb_quote span.bb_quote span.bb_quote_title a {
	color: #A0C020;
}

span.bb_quote span.bb_quote span.bb_quote span.bb_quote span.bb_quote {
	border-left: 2px solid #3B9620;
}

span.bb_quote span.bb_quote span.bb_quote span.bb_quote span.bb_quote_title, span.bb_quote span.bb_quote span.bb_quote span.bb_quote span.bb_quote_title a {
	color: #3B9620;
}

span.bb_quote span.bb_quote span.bb_quote span.bb_quote span.bb_quote span.bb_quote {
	border-left: 2px solid black;
}

span.bb_quote span.bb_quote span.bb_quote span.bb_quote span.bb_quote span.bb_quote_title, span.bb_quote span.bb_quote span.bb_quote span.bb_quote span.bb_quote span.bb_quote_title a {
	color: black;
}

/**/

/* 
 * Arrow link.
 */
.arrow-link {
	display: block;
	float: right;
	
	background-color: white;
	width: 19px;
	height: 19px;
	border-radius: 3px;
	border: 1px solid white;
	overflow: hidden;
	
	text-decoration: none !important;
	
	transition: .2s ease 0s background-color, .2s ease 0s border-color;
}

.arrow-link::after, .arrow-link::before {
	display: block;
	content: '\f061';
	width: 19px;
	font-size: 14px;
	font-family: fontawesome;
	line-height: 19px;
	color: #303030;
	text-align: center;
	text-decoration: none !important;
	
	transition: .2s ease 0s color;
}

.arrow-link::before {
	margin-left: -38px;
}

.arrow-link::after {
	margin-top: -19px;
}

.arrow-link:hover {
	background-color: #CCFF00;
	border-color: #CCFF00;
	transition: .2s ease 0s background-color, .2s ease 0s border-color;
}

.arrow-link:active {
	background-color: transparent;
	border-color: white;
	transition: .2s ease 0s background-color, .2s ease 0s border-color;
}

.arrow-link:hover::after {
	color: black;
	transition: .2s ease 0s color;
}

.arrow-link:hover::before {
	color: white;
	transition: .2s ease 0s color;
}

.arrow-link:active::after {
	margin-left: 38px;
	color: white;
	
	transition: .2s ease 0s margin-left, .2s ease 0s color;
}

.arrow-link:active::before {
	margin-left: 0;
	color: white;
	
	transition: .2s ease 0s margin-left, .2s ease 0s color;
}

/* 
 * Arrow link (light).
 */
.arrow-link-lt {
	display: block;
	float: right;
	
	background-color: transparent;
	width: 19px;
	height: 19px;
	border-radius: 3px;
	border: 1px solid #808080;
	box-shadow: 1px 1px #404040;
	overflow: hidden;
	
	text-decoration: none !important;
	
	transition: .3s ease 0s background-color, .3s ease 0s border-color;
}

.arrow-link-lt::after, .arrow-link-lt::before {
	display: block;
	content: '\f061';
	width: 19px;
	font-size: 14px;
	font-family: fontawesome;
	line-height: 19px;
	color: #808080;
	text-align: center;
	text-decoration: none !important;
	
	transition: .3s ease 0s margin-left, .3s ease 0s color;
}

.arrow-link-lt::before {
	margin-left: -38px;
}

.arrow-link-lt::after {
	margin-top: -19px;
}

.arrow-link-lt:hover {
	background-color: #92C250;
	border-color: #92C250;
}

.arrow-link-lt:hover::after {
	margin-left: 38px;
	color: white;
}

.arrow-link-lt:hover::before {
	margin-left: 0;
	color: white;
}

.arrow-link-lt:active {
	box-shadow: none;
}

/* 
 * Simple Sharing Buttons.
 */
.share-buttons{
	list-style: none;
	padding: 8px;
	font-size: 0;
	margin: 13px 0;
}

.share-buttons li{
	display: inline-block;
	/*margin: 7.6px;*/
	margin-right: 5px;
}

.share-buttons li a img {
	transition: .1s ease 0s opacity;
}

.share-buttons li a:hover img, .share-buttons li a:focus img {
	opacity: .3;
}

.share-buttons li a:active img {
	opacity: .1;
}

img {
	-webkit-backface-visibility: hidden;
	-webkit-transform: rotate(0);
	-moz-transform: rotate(0);
	transform: rotate(0);
}

/* 
 * Default heading sizes.
 */
h1 {
	font-size: 2em;
}

h2 {
	font-size: 1.5em;
}

h3 {
	font-size: 1.17em;
	text-shadow: 3px 3px 0px rgba(0,0,0,.1);
}

h4 {
	font-size: 1.00em;
}

h5 {
	font-size: 0.83em;
}

h6 {
	font-size: 0.67em;
}

/* 
 * Animations.
 */

.animation-running {
	animation-play-state: running !important;
	-webkit-animation-play-state: running !important;
}

.animation-paused {
	animation-play-state: paused !important;
	-webkit-animation-play-state: paused !important;
}

/* Standard */
@keyframes greenmessage {
	from {
		background: #AADD00;
	}
	to {
		background: #F7F7F7;
	}
}

@keyframes redmessage {
	from {
		background: #FF8080;
	}
	to {
		background: #FFF0F0;
	}
}

@keyframes marquee {
	from {
		margin-left: 100%;	
		width: 0;
	}
	to {
		margin-left: 0;
		width: 100%;
	}
}

@keyframes marquee-div {
	from {
		margin-left: 100px;
	}
	to {
		margin-left: -100%;
	}
}

@keyframes new-notification-icon {
	from {
		width: 0;
		height: 0;
		margin-left: 11px;
		margin-top: 11px;
		opacity: 0;
	}
	to {
		width: 22px;
		height: 22px;
		margin-left: 0;
		margin-top: 0;
		opacity: 1;
	}
}

@keyframes new-notification-icon-2 {
	from {
		margin-left: -11px;
		margin-top: -11px;
	}
	to {
		margin-left: 0;
		margin-top: 0;
	}
}

@keyframes new-notification-count {
	from {
		right: 0;
		max-width: 0;
		opacity: 0;
	}
	to {
		right: 14px;
		max-width: 50px;
		opacity: 1;
	}
}

@keyframes new-notification-border {
	from {
		border-right-color: white;
	}
	25% {
		border-right-color: #D00000;
	}
	50% {
		border-right-color: #D00000;
	}
	to {
		border-right-color: white;
	}
}

@keyframes shine {
	from {
		background-position: -724px 0;
	}
	to {
		background-position: 724px 0;
	}
}

/* Webkit */

@-webkit-keyframes greenmessage {
	from {
		background: #AADD00;
	}
	to {
		background: #F7F7F7;
	}
}

@-webkit-keyframes redmessage {
	from {
		background: #FF8080;
	}
	to {
		background: #FFF0F0;
	}
}

@-webkit-keyframes marquee {
	from {
		margin-left: 100%;	
		width: 0;
	}
	to {
		margin-left: 0;
		width: 100%;
	}
}

@-webkit-keyframes marquee-div {
	from {
		margin-left: 100px;
	}
	to {
		margin-left: -100%;
	}
}

@-webkit-keyframes new-notification-icon {
	from {
		width: 0;
		height: 0;
		margin-left: 11px;
		margin-top: 11px;
		opacity: 0;
	}
	to {
		width: 22px;
		height: 22px;
		margin-left: 0;
		margin-top: 0;
		opacity: 1;
	}
}

@-webkit-keyframes new-notification-icon-2 {
	from {
		margin-left: -11px;
		margin-top: -11px;
	}
	to {
		margin-left: 0;
		margin-top: 0;
	}
}

@-webkit-keyframes new-notification-count {
	from {
		right: 0;
		max-width: 0;
		opacity: 0;
	}
	to {
		right: 14px;
		max-width: 50px;
		opacity: 1;
	}
}

@-webkit-keyframes new-notification-border {
	from {
		border-right-color: white;
	}
	25% {
		border-right-color: #D00000;
	}
	50% {
		border-right-color: #D00000;
	}
	to {
		border-right-color: white;
	}
}

@-webkit-keyframes shine {
	from {
		background-position: -724px 0;
	}
	to {
		background-position: 724px 0;
	}
}

/* 
 * Special styles.
 */
#horizontal-line {
	display: inline-block;
	
	width: 100%;
	height: 1px;
	font-size: 1px;
	background-color: #D0D0D0;
	margin: 2px auto 21px;
}

.float-left {
	float: left;
	display: block;
}

.float-right {
	float: right;
	display: block;
}

/*.clearfix::after {
    content: "&nbsp;";
    clear: both;
    display: table;
}*/

.clear-left {
	clear: left;
}

.clearfix:before,
.clearfix:after {
    content: " ";
    display: table;
}

.clearfix:after {
    clear: both;
}

.clearfix {
    *zoom: 1;
}

.even-odd > *:nth-child(even):not(.container-title):not(.container-title-lt) {
	background-color: #F0F0F0;
}

.even-odd-dark > *:nth-child(even):not(.container-title):not(.container-title-lt) {
	background-color: #606060;
}

.seperators > div + div {
	border-top: 1px dotted #909090;
}

.news-item + .news-item {
	border-top: 1px dotted #909090;
	padding-top: 4px;
	margin-top: 6px;
}

.black-links a {
	color: black;
}

.smallfont {
	font: 0.7em Arial, Helvetica, Clean, Sans-Serif;
}

.smallfont2 {
	font-size: 0.85em;
}

.date-time, abbr {
	/*color: #606060;*/
	/*font-style: italic;*/
	border-bottom: 1px dashed #808080;
	cursor: default;
	font-variant: none;
	text-decoration: none !important;
}

.dark .date-time {
	/*color: #C0C0C0;*/
	/*font-style: italic;*/
	border-bottom: 1px dashed #808080;
	cursor: default;
}

.date-time:hover, abbr:hover {
	border-bottom: 1px solid #7BB640;
}

/*.editable-inside {
	transition: .5s ease 0s background-color;
}

.editable-inside:hover {
	background-color: #F0F0F0;
}*/

.editable-inside div {
	border-radius: 4px;
}

.editable-inside div.picture, .editable-inside div.container-title-lt {
	border-radius: 0;
}

[contenteditable] {
	position: relative;
	display: inline-block;
	border: 1px solid transparent;
	box-shadow: 0px 0px 0px 0px rgba(0,0,0,.1);
	transition: .2s ease 0s padding, .2s ease 0s line-height, .2s ease 0s box-shadow;
	min-width: .2em;
	min-height: 1.2em;
}

.editable-inside [contenteditable] {
	border: 1px dashed #E0E0E0;
	vertical-align: top;
	transition: padding .2s ease .8s;
}

.editable-inside:hover [contenteditable] {
	border: 1px dashed #A0A0A0;
	padding: 4px;
	transition: padding 1s ease 0s;
}

[contenteditable]:hover {
	background-color: white;
	border: 1px solid rgba(0,0,0,.3) !important;
	box-shadow: 0 1px 3px #AAAAAA;
}

[contenteditable]:focus:active {
	outline: 0;
	background-color: white;
	transition: .2s ease 0s padding, .2s ease 0s line-height, .2s ease 0s box-shadow;
}

[contenteditable]:focus {
	/*font-family: Open Sans;*/
	z-index: 2;
	outline: 0;
	background-color: white;
	border: 1px solid rgba(0,0,0,.3) !important;
	padding: 4px;
	box-shadow: 0 1px 3px #AAAAAA, 0px 0px 0px 700px rgba(0,0,0,.125);
	transition: .2s ease .2s padding, .2s ease .2s line-height, .2s ease 0s box-shadow;
}

/*[contenteditable]::after {
	content: '.';
	color: transparent;
}*/

/* 
 * Marquee.
 */
.marquee {
	background-color: #92C250;
	color: white;
	overflow: hidden;
}
.marquee > div {
	box-sizing: border-box;
	position: relative;
	animation: marquee 5s linear 0s infinite normal;
	-webkit-animation: marquee 5s linear 0s infinite normal;
}

.marquee > div > div {
	display: inline-block;
	margin: 0;
}

.marquee > div > div > div {
	animation: marquee-div 5s linear 0s infinite normal;
	-webkit-animation: marquee-div 5s linear 0s infinite normal;
	white-space: nowrap;
	overflow: hidden;
}

/*#logo, #sessionbar {
	transition: font-size .5s ease;
}*/

/* 
 * Placeholder input elements.
 */
::-webkit-input-placeholder {
	color: #A0A0A0;
}
::-moz-placeholder {
	color: #A0A0A0;
	opacity: 1;
}
:-ms-input-placeholder {  
	color: #A0A0A0;
}

*:focus::-webkit-input-placeholder {
	color: white;
}
*:focus::-moz-placeholder {
	color: white;
}
*:focus:-ms-input-placeholder {  
	color: white;
}

/* 
 * Buttons.
 * /
button {
	background: #7ba60d;
	background: -moz-linear-gradient(top, #7ba60d 0%, #ace542 16%, #bef713 16%, #99d310 76%, #bef713 93%, #e8efd5 100%);
	background: -webkit-linear-gradient(top, #7ba60d 0%,#ace542 16%,#bef713 16%,#99d310 76%,#bef713 93%,#e8efd5 100%);
	background: linear-gradient(to bottom, #7ba60d 0%,#ace542 16%,#bef713 16%,#99d310 76%,#bef713 93%,#e8efd5 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#7ba60d', endColorstr='#e8efd5',GradientType=0 );
	border: 1px solid black;
	border-radius: 5px;
	box-shadow: 1px 2px 2px rgba(0,0,0,.3);
	font-family: Open Sans;
	padding: 2px;
}

button:hover:active {
	background: #e8efd5;
	background: -moz-linear-gradient(top, #e8efd5 0%, #bef713 7%, #99d310 24%, #bef713 78%, #ace542 80%, #7ba60d 100%);
	background: -webkit-linear-gradient(top, #e8efd5 0%,#bef713 7%,#99d310 24%,#bef713 78%,#ace542 80%,#7ba60d 100%);
	background: linear-gradient(to bottom, #e8efd5 0%,#bef713 7%,#99d310 24%,#bef713 78%,#ace542 80%,#7ba60d 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e8efd5', endColorstr='#7ba60d',GradientType=0 );
	padding-top: 1px;
	padding-bottom: 3px;
}
/*/

/* 
 * Native-like elements.
 */
.game-screenshots, .game-button-play, .page-chooser, #main-bar a, #category-chooser, #lightbox, #lightboxOverlay {
	user-select: none;
	-moz-user-select: none;
	-webkit-user-select: none;
	-webkit-tap-highlight-color: transparent;
}

/* 
 * Responsive design.
 */
@media (max-width: 640px) {
	.container, .container-lt, .container-seamless, .category {
		float: none !important;
		width: auto !important;
		right: 0 !important;
		margin-left: 0 !important;
		margin-right: 0 !important;
	}
	
	#category-chooser {
		overflow: auto;
		max-height: 100px;
		-webkit-overflow-scrolling: touch;
	}
	
	.login-form col {
		width: 0px;
	}
	
	.login-form tbody tr .first-column {
		visibility: hidden;
	}
	
	label[for="rememberme"] {
		display: inline-block !important;
	}
	
	#main-bar a {
		width: 22%;
		margin: 0 1.5% 0;
	}
	
	.container > .game-long-fade {
		display: none;
	}
}

@media (max-width: 725px) {
	.category {
		width: 43%;
	}
	#logo, #sessionbar {
		font-size: .85em;
	}
}

@media (max-width: 630px) {
	#logo {
		font-size: .7em;
	}
	#sessionbar {
		display: none;
	}
	#sessionbar-alt {
		display: block !important;
	}
	h1 {
		text-align: center;
	}
}

@media (max-width: 804px) {
	.notifications-icon {
		position: fixed;
		left: auto;
		right: 4px;
		margin-left: 0;
	}
	.notifications-icon .new {
		z-index: 102;
	}
	.notifications-window {
		position: fixed;
		/*left: auto;
		right: -11px;*/
		margin-left: 0;
		left: 0;
		top: -20px;
		right: 0;
		width: auto;
	}
	.notifications-icon:focus + .notifications-window {
		/*height: 100vh;*/
	}
	.notifications-icon:focus + .notifications-window > div {
		box-shadow: none;/*0px 100vh 0px 100vh rgba(0,0,0,.5);*/
	}
	.notifications-window > div {
		width: 100%;
		box-shadow: 0px 100vh 0px 100vh rgba(0,0,0,.25);
	}
	.notifications-window:hover > div,
	.notifications-icon:hover + .notifications-window > div, .notifications-icon:focus + .notifications-window > div {
		max-height: calc(100vh - 20px);
	}
	.notifications {
		width: 100%;
	}
	.notifications-window:hover > div > div,
	.notifications-icon:hover + .notifications-window .notifications, .notifications-icon:focus + .notifications-window .notifications {
		max-height: calc(100vh - 97px);
	}
	.notifications-window:hover + .notifications-exit,
	.notifications-icon:hover + .notifications-window + .notifications-exit, .notifications-icon:focus + .notifications-window + .notifications-exit {
		pointer-events: initial;
		opacity: 1;
	}
}

/* 
 * Country flags.
 */
.lang,.region,.lang-ca,.lang-eo,.lang-eu,.variant-wales,.region-gb.lang-cy,.variant-scotland,.region-gb.lang-gd{color:#fff;background:#2e892e;display:inline-block;text-transform:uppercase;overflow:hidden;font-family:Verdana,Arial,sans-serif;font-size:9px;font-weight:normal;font-style:normal;line-height:12px;text-align:center;white-space:normal;text-shadow:none}.lang{width:20px;height:12px;line-height:12px;vertical-align:middle}.lang:before{content:attr(lang)}.lang-el{background-color:#1d48a3}.lang-el:before{content:"\0395\03BB"}.region,.lang-ca,.lang-eo,.lang-eu,.variant-wales,.region-gb.lang-cy,.variant-scotland,.region-gb.lang-gd{width:16px;height:12px;margin:0 2px;background-image:url(/img/flags/flags.png);background-repeat:no-repeat;background-color:transparent}.region:before,.lang-ca:before,.lang-eo:before,.lang-eu:before,.variant-wales:before,.region-gb.lang-cy:before,.variant-scotland:before,.region-gb.lang-gd:before{content:"\0A";display:none}.lang-zh{background-color:#b90000}.lang-zh.script-hans:before{content:"\4E2D\56FD"}.lang-zh.script-hant:before{content:"\4E2D\570B"}.__{background-position:0 0}.lang-ca{background-position:0 -12px}.lang-eo{background-position:0 -24px}.lang-eu{background-position:0 -36px}.region-ad{background-position:0 -48px}.region-ae{background-position:0 -60px}.region-af{background-position:0 -72px}.region-ag{background-position:0 -84px}.region-ai{background-position:0 -96px}.region-al{background-position:0 -108px}.region-am{background-position:0 -120px}.region-an{background-position:0 -132px}.region-ao{background-position:0 -144px}.region-aq{background-position:0 -156px}.region-ar{background-position:0 -173px}.region-as{background-position:0 -185px}.region-at{background-position:0 -197px}.region-au{background-position:0 -209px}.region-aw{background-position:0 -221px}.region-ax{background-position:0 -233px}.region-az{background-position:0 -245px}.region-ba{background-position:0 -257px}.region-bb{background-position:0 -269px}.region-bd{background-position:0 -281px}.region-be{background-position:0 -293px}.region-bf{background-position:0 -305px}.region-bg{background-position:0 -317px}.region-bh{background-position:0 -329px}.region-bi{background-position:0 -341px}.region-bj{background-position:0 -353px}.region-bl{background-position:0 -365px}.region-bm{background-position:0 -382px}.region-bn{background-position:0 -394px}.region-bo{background-position:0 -406px}.region-bq{background-position:0 -418px}.region-br{background-position:0 -430px}.region-bs{background-position:0 -442px}.region-bt{background-position:0 -454px}.region-bv{background-position:0 -466px}.region-bw{background-position:0 -478px}.region-by{background-position:0 -490px}.region-bz{background-position:0 -502px}.region-ca{background-position:0 -514px}.region-cc{background-position:0 -526px}.region-cd{background-position:0 -538px}.region-cf{background-position:0 -550px}.region-cg{background-position:0 -562px}.region-ch{background-position:0 -574px}.region-ci{background-position:0 -586px}.region-ck{background-position:0 -598px}.region-cl{background-position:0 -610px}.region-cm{background-position:0 -622px}.region-cn{background-position:0 -634px}.region-co{background-position:0 -646px}.region-cr{background-position:0 -658px}.region-cs{background-position:0 -670px}.region-cu{background-position:0 -682px}.region-cv{background-position:0 -694px}.region-cw{background-position:0 -706px}.region-cx{background-position:0 -723px}.region-cy{background-position:0 -735px}.region-cz{background-position:0 -747px}.region-de{background-position:0 -759px}.region-dj{background-position:0 -771px}.region-dk{background-position:0 -783px}.region-dm{background-position:0 -795px}.region-do{background-position:0 -807px}.region-dz{background-position:0 -819px}.region-ec{background-position:0 -831px}.region-ee{background-position:0 -843px}.region-eg{background-position:0 -855px}.region-eh{background-position:0 -867px}.region-er{background-position:0 -879px}.region-es{background-position:0 -891px}.region-et{background-position:0 -903px}.region-fi{background-position:0 -915px}.region-fj{background-position:0 -927px}.region-fk{background-position:0 -939px}.region-fm{background-position:0 -951px}.region-fo{background-position:0 -963px}.region-fr{background-position:0 -975px}.region-yt{background-position:0 -3141}.lang-fy.region-nl{background-position:0 -3141px}.region-ga{background-position:0 -987px}.region-gb{background-position:0 -999px}.region-gd{background-position:0 -1011px}.region-ge{background-position:0 -1023px}.region-gf{background-position:0 -1035px}.region-gg{background-position:0 -1047px}.region-gh{background-position:0 -1064px}.region-gi{background-position:0 -1076px}.region-gl{background-position:0 -1088px}.region-gm{background-position:0 -1100px}.region-gn{background-position:0 -1112px}.region-gp{background-position:0 -1124px}.region-gq{background-position:0 -1136px}.region-gr{background-position:0 -1148px}.region-gs{background-position:0 -1160px}.region-gt{background-position:0 -1172px}.region-gu{background-position:0 -1184px}.region-gw{background-position:0 -1196px}.region-gy{background-position:0 -1208px}.region-hk{background-position:0 -1220px}.region-hm{background-position:0 -1232px}.region-hn{background-position:0 -1244px}.region-hr{background-position:0 -1256px}.region-ht{background-position:0 -1268px}.region-hu{background-position:0 -1280px}.region-id{background-position:0 -1292px}.region-ie{background-position:0 -1304px}.region-il{background-position:0 -1316px}.region-im{background-position:0 -1328px}.region-in{background-position:0 -1345px}.region-io{background-position:0 -1357px}.region-iq{background-position:0 -1369px}.region-ir{background-position:0 -1381px}.region-is{background-position:0 -1393px}.region-it{background-position:0 -1405px}.region-je{background-position:0 -1417px}.region-jm{background-position:0 -1434px}.region-jo{background-position:0 -1446px}.region-jp{background-position:0 -1458px}.region-ke{background-position:0 -1470px}.region-kg{background-position:0 -1482px}.region-kh{background-position:0 -1494px}.region-ki{background-position:0 -1506px}.region-km{background-position:0 -1518px}.region-kn{background-position:0 -1530px}.region-kp{background-position:0 -1542px}.region-kr{background-position:0 -1554px}.region-kw{background-position:0 -1566px}.region-ky{background-position:0 -1578px}.region-kz{background-position:0 -1590px}.region-la{background-position:0 -1602px}.region-lb{background-position:0 -1614px}.region-lc{background-position:0 -1626px}.region-li{background-position:0 -1638px}.region-lk{background-position:0 -1650px}.region-lr{background-position:0 -1662px}.region-ls{background-position:0 -1674px}.region-lt{background-position:0 -1686px}.region-lu{background-position:0 -1698px}.region-lv{background-position:0 -1710px}.region-ly{background-position:0 -1722px}.region-ma{background-position:0 -1734px}.region-mc{background-position:0 -1746px}.region-md{background-position:0 -1758px}.region-me{background-position:0 -1770px}.region-mf{background-position:0 -1783px}.region-mg{background-position:0 -1800px}.region-mh{background-position:0 -1812px}.region-mk{background-position:0 -1824px}.region-ml{background-position:0 -1836px}.region-mm{background-position:0 -1848px}.region-mn{background-position:0 -1860px}.region-mo{background-position:0 -1872px}.region-mp{background-position:0 -1884px}.region-mq{background-position:0 -1896px}.region-mr{background-position:0 -1908px}.region-ms{background-position:0 -1920px}.region-mt{background-position:0 -1932px}.region-mu{background-position:0 -1944px}.region-mv{background-position:0 -1956px}.region-mw{background-position:0 -1968px}.region-mx{background-position:0 -1980px}.region-my{background-position:0 -1992px}.region-mz{background-position:0 -2004px}.region-na{background-position:0 -2016px}.region-nc{background-position:0 -2028px}.region-ne{background-position:0 -2040px}.region-nf{background-position:0 -2052px}.region-ng{background-position:0 -2064px}.region-ni{background-position:0 -2076px}.region-nl{background-position:0 -2088px}.region-no{background-position:0 -2100px}.region-np{background-position:0 -2112px}.region-nr{background-position:0 -2124px}.region-nu{background-position:0 -2136px}.region-nz{background-position:0 -2148px}.region-om{background-position:0 -2160px}.region-pa{background-position:0 -2172px}.region-pe{background-position:0 -2184px}.region-pf{background-position:0 -2196px}.region-pg{background-position:0 -2208px}.region-ph{background-position:0 -2220px}.region-pk{background-position:0 -2232px}.region-pl{background-position:0 -2244px}.region-pm{background-position:0 -2256px}.region-pn{background-position:0 -2268px}.region-pr{background-position:0 -2280px}.region-ps{background-position:0 -2292px}.region-pt{background-position:0 -2304px}.region-pw{background-position:0 -2316px}.region-py{background-position:0 -2328px}.region-qa{background-position:0 -2340px}.region-re{background-position:0 -2352px}.region-ro{background-position:0 -2364px}.region-rs{background-position:0 -2376px}.region-ru{background-position:0 -2388px}.region-rw{background-position:0 -2400px}.region-sa{background-position:0 -2412px}.region-sb{background-position:0 -2424px}.region-sc{background-position:0 -2436px}.region-sd{background-position:0 -2448px}.region-se{background-position:0 -2460px}.region-sg{background-position:0 -2472px}.region-sh{background-position:0 -2484px}.region-si{background-position:0 -2496px}.region-sj{background-position:0 -2508px}.region-sk{background-position:0 -2520px}.region-sl{background-position:0 -2532px}.region-sm{background-position:0 -2544px}.region-sn{background-position:0 -2556px}.region-so{background-position:0 -2568px}.region-sr{background-position:0 -2580px}.region-ss{background-position:0 -2592px}.region-st{background-position:0 -2609px}.region-sv{background-position:0 -2621px}.region-sx{background-position:0 -2633px}.region-sy{background-position:0 -2650px}.region-sz{background-position:0 -2662px}.region-tc{background-position:0 -2674px}.region-td{background-position:0 -2686px}.region-tf{background-position:0 -2698px}.region-tg{background-position:0 -2710px}.region-th{background-position:0 -2722px}.region-tj{background-position:0 -2734px}.region-tk{background-position:0 -2746px}.region-tl{background-position:0 -2758px}.region-tm{background-position:0 -2770px}.region-tn{background-position:0 -2782px}.region-to{background-position:0 -2794px}.region-tr{background-position:0 -2806px}.region-tt{background-position:0 -2818px}.region-tv{background-position:0 -2830px}.region-tw{background-position:0 -2842px}.region-tz{background-position:0 -2854px}.region-ua{background-position:0 -2866px}.region-ug{background-position:0 -2878px}.region-um{background-position:0 -2890px}.region-us{background-position:0 -2902px}.region-uy{background-position:0 -2914px}.region-uz{background-position:0 -2926px}.region-va{background-position:0 -2938px}.region-vc{background-position:0 -2950px}.region-ve{background-position:0 -2962px}.region-vg{background-position:0 -2974px}.region-vi{background-position:0 -2986px}.region-vn{background-position:0 -2998px}.region-vu{background-position:0 -3010px}.region-wf{background-position:0 -3022px}.region-ws{background-position:0 -3034px}.region-ye{background-position:0 -3046px}.region-yt{background-position:0 -3058px}.region-za{background-position:0 -3070px}.region-zm{background-position:0 -3082px}.region-zw{background-position:0 -3094px}.variant-scotland,.region-gb.lang-gd{background-position:0 -3106px}.variant-wales,.region-gb.lang-cy{background-position:0 -3118px}.x-eu{background-position:0 -3130px}

.language-select {
	position: relative;
	display: inline-block;
	vertical-align: top;
	max-height: 20px;
	transition: max-height .7s ease .3s;
	background-color: #303030;
	z-index: 200;
}

.language-select:hover, .language-select:focus {
	background-color: black;
}

.language-select:focus {
	max-height: 308px;
}

.language-select > a, .language-select > :first-child {
	margin: 4px;
	vertical-align: middle;
	display: block;
	cursor: pointer;
	
    text-indent: 100%;
    white-space: nowrap;
    overflow: hidden;
}

.translation-help {
	position: absolute;
	left: 8px;
	top: 104px;
	font-family: Open Sans;
	font-size: 1.5em;
	font-weight: 300;
	text-align: center;
	margin-right: 32px;
}

#language-updater textarea {
	box-sizing: border-box;
    border: none;
    width: 100%;
	height: 100%;
    font-size: 14px;
    padding: 4px 3px;
	resize: vertical;
}

#language-updater textarea:hover {
    background-color: #eee;
}

#language-updater textarea:focus {
    background-color: #f3ffc2;
}

#language-updater textarea[disabled] {
	background-color: #999;
	margin: -1px 0;
}

table#language-updater {
    border-collapse: collapse;
	margin-left: -120px;
}

#language-updater td {
    border: 1px solid #999;
    padding: 0;
	height: 100%;
}

#language-updater tr:first-child td, #language-updater td:first-child {
    background-color: #F0F0F0;
    padding: 1px 3px;
    font-weight: bold;
    text-align: center;
	vertical-align: middle;
	font-size: .85em;
}