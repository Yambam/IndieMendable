<?php
	include('../config.php');
	header('Content-type: text/css');
?>
/* 
 * Open Sans font.
 */
@font-face {
	font-family: 'Open Sans';
	font-style: normal;
	font-weight: 400;
	src: local('Open Sans'), local('OpenSans'), url(http://fonts.gstatic.com/s/opensans/v10/cJZKeOuBrn4kERxqtaUH3T8E0i7KZn-EPnyo3HZu7kw.woff) format('woff');
}
@font-face {
	font-family: 'Open Sans';
	font-style: normal;
	font-weight: 700;
	src: local('Open Sans Bold'), local('OpenSans-Bold'), url(http://fonts.gstatic.com/s/opensans/v10/k3k702ZOKiLJc3WVjuplzHhCUOGz7vYGh680lGh-uXM.woff) format('woff');
}
@font-face {
	font-family: 'Open Sans';
	font-style: normal;
	font-weight: 800;
	src: local('Open Sans Extrabold'), local('OpenSans-Extrabold'), url(http://fonts.gstatic.com/s/opensans/v10/EInbV5DfGHOiMmvb1Xr-hnhCUOGz7vYGh680lGh-uXM.woff) format('woff');
}
@font-face {
	font-family: 'Open Sans';
	font-style: italic;
	font-weight: 400;
	src: local('Open Sans Italic'), local('OpenSans-Italic'), url(http://fonts.gstatic.com/s/opensans/v10/xjAJXh38I15wypJXxuGMBobN6UDyHWBl620a-IRfuBk.woff) format('woff');
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
 * Orbitron font.
 */
@font-face {
  font-family: 'Orbitron';
  font-style: normal;
  font-weight: 400;
  src: local('Orbitron-Light'), local('Orbitron-Regular'), url(http://fonts.gstatic.com/s/orbitron/v6/94ug0rEgQO_WuI_xKJMFc_esZW2xOQ-xsNqO47m55DA.woff) format('woff');
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
 * Default styles.
 */
html {
	height: 100%;
	font-family: 'Open Sans', sans-serif;
}

body {
	background-color: #202020;
	color: #A0A0A0;
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
	
	background-color: #151515;
	border: 1px dotted #606060;
	border-top: 0px;
	border-bottom: 0px;
}

#content {
	border-top: 1px solid transparent;
	font-family: 'Open Sans', sans-serif;
	margin: 0 10px;
	padding-bottom: 15px;
	overflow: auto;
}

a:focus {
	outline: 0;
}

#logo {
	color: #92C250;
	text-shadow: 3px 3px 0px rgba(255,255,255,.2);
	text-decoration: none;
	font-family: 'Droid Serif', serif;
	white-space: nowrap;
}

#logo:hover, #logo:focus {
	color: #A0D060 !important;
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

#message {
	border: 1px solid #C0C0C0;
	padding: 2px;
	font-size: .9em;
	margin: 5px 0px 5px;
	background: #404040;
	color: white;
	
	animation: greenmessage 6s ease 0s forwards;
	-webkit-animation: greenmessage 6s ease 0s forwards;
}

.errormessage {
	border: 1px solid #FF0000;
	padding: 2px;
	font-size: .9em;
	margin: 5px 0px 5px;
	background: #FFF0F0;
	color: black;
	
	animation: redmessage 4s linear 0s forwards;
	-webkit-animation: redmessage 4s linear 0s forwards;
}

.redfield {
	border: 1px solid red;
}

.container, .container-lt, .category {
	position: relative;
	border: 2px solid #404040;
	padding: 5px;
	background-color: #404040;
	float: left;
	min-height: 100px;
	margin: 0px 0px 15px;
	
	/*transition: all .5s ease;*/
}
.container-lt {
	/*border-color: #E5E5E5;*/
}

.category {
	padding: 0;
	background-color: #454545;
	min-height: 191px !important;
}

.category {
	min-height: 200px;
	width: 44.5%;
}

.category .game-spotlight, .category .game-spotlight > a {
	background-color: #303030;
}

.category .container-title {
	margin: 0;
}

.category-list {
	/*min-height: 513px;*/
}

.container-title, .container-title-lt {
	background-color: #365620;
	margin: -5px -5px 5px;
	padding: 2px;
	color: white;
}

.container-title-lt {
	background-color: #72A240;
	margin: -5px -5px 5px;
	padding: 2px;
	color: white;
}

.container-title-lt a {
	color: #CCFF00 !important;
}

.dark {
	/*background-color: #505050;*/
	color: white;
	/*border: 2px solid #404040;*/
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

#spotlight, #spotlight-extra, .category {
	background: #303030;
	/*background:         linear-gradient(to bottom,#303030,#353535);
	background:      -o-linear-gradient(to bottom,#303030,#353535);
	background:     -ms-linear-gradient(to bottom,#303030,#353535);
	background:    -moz-linear-gradient(to bottom,#303030,#353535);
	background: -webkit-gradient(linear,left top,left bottom,color-stop(0%,#303030),color-stop(100%,#353535));
	background: -webkit-linear-gradient(to bottom,#303030,#353535);
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#303030',endColorstr='#353535',GradientType=0);*/
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
	background-color: #303030;
	padding: 8px;
	font-size: .9em;
}

.login-form {
	table-layout: fixed;
	width: 100%;
	min-width: 400px;
	background-color: #404040;
	
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
	background-color: #353535;
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
	width: calc(100% - <?php if ($language_abbr=='el') echo '100px'; else echo '80px'; ?>);
	outline: 0;
	
	border: 0;
	border-radius: 4px;
	background: white;
	color: black;
	
	height: 28px;
	
	font-size: .99em;
	font-family: arial;
	padding: 4px;
}

.search-field-submit {
	float: right;
	outline: 0;
	
	border: 0;
	background: #7BA60D;
	opacity: 1 !important;
	cursor: pointer;
	-webkit-appearance: none;
	-webkit-tap-highlight-color: transparent;
	border-radius: 0;
	
	width: <?php if ($language_abbr=='el') echo '95px'; else echo '75px'; ?>;
	height: 28px;
	
	font-size: .99em;
	font-family: arial;
	padding: 4px;
	color: white;
	
	text-align: center;
}

.search-field-submit[disabled]:active, .search-field-submit[disabled]:focus {
	background: #5B8600;
	/*color: white;*/
}

.search-field-submit:active, .search-field-submit:focus {
	background: #365620;
	/*color: white;*/
}

#category-chooser a {
	display: block;
	background-color: #3D3D3D;
	box-shadow: 1px 1px 5px rgba(0,0,0,.1) inset;
	margin-bottom: 3px;
	border-radius: 3px;
	padding: 2px;
	transition: .1s ease 0s background-color, .1s ease 0s box-shadow, .1s ease 0s border-bottom;
	box-sizing: border-box;
	height: 24px;
	overflow: hidden;
	white-space: nowrap;
}

#category-chooser a.selected {
	background-color: #505050;
	box-shadow: 1px 1px 2px rgba(0,0,0,.5);
	color: #A0D060;
	font-weight: bold;
	text-decoration: none;
}

#category-chooser a:hover {
	box-shadow: none;
	border-bottom: 2px solid #7BB640;
}

#category-chooser a:active {
	background-color: #303030;
	box-shadow: 1px 1px 2px rgba(0,0,0,.5) inset;
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
	margin-bottom: -2px;
	position: relative;
	z-index: 1;
}

#sorted-by-chooser a {
	display: block;
	float: right;
	margin-right: 8px;
	box-sizing: border-box;
	
	border-bottom: 0 solid #7BB640;
	background-color: #303030;
	color: white;
	height: 28px;
	line-height: 28px;
	border-top-left-radius: 3px;
	border-top-right-radius: 3px;
	padding: 0 8px;
	
	box-shadow: 3px 3px 0px rgba(0,0,0,.1), 0px -3px 0px rgba(0,0,0,.1) inset;
	transition: .05s ease 0s border-bottom;
}

#sorted-by-chooser a:hover {
	box-shadow: 3px 3px 0px rgba(0,0,0,.1);
	border-bottom: 2px solid #7BB640;
}

#sorted-by-chooser a.active:hover {
	box-shadow: none;
	border-bottom: 0 solid #7BB640;
	/*text-decoration: none;
	cursor: default;*/
}

#sorted-by-chooser a.active {
	background-color: #72A240;
	color: white;
	box-shadow: 3px 3px 0px rgba(0,0,0,.1);
}

/*.user-link {
	height: 30px;
}*/

.user-link-alt {
	height: 48px;
	display: inline-block;
	margin-right: 4px;
	vertical-align: top;
}

.user-link a, .user-link-alt a {
	/*color: #D0D0D0;*/
	font-size: 1.1em;
}

.game {
	display: inline-block;
	box-sizing: border-box;
	width: 50%;
	width: calc(50% - 8px);
	margin: 4px;
	border: 1px solid #454545;
	box-shadow: 3px 3px 3px rgba(0,0,0,.125);
}

.game > a {
	display: block;
	font-size: 1.1em;
	border-bottom: 1px solid #505050;
	box-shadow: 3px 3px 3px rgba(0,0,0,.0625);
}

.game-alt {
	display: inline-block;
	box-sizing: border-box;
	width: 33%;
	width: calc(33% - 8px);
	margin: 4px;
	border: 1px solid #454545;
	box-shadow: 3px 3px 3px rgba(0,0,0,.125);
}

.game-alt > a {
	display: block;
	font-size: .9em;
	border-bottom: 1px solid #505050;
	box-shadow: 3px 3px 3px rgba(0,0,0,.0625);
}

.game .picture-large, .game-alt .picture-large, .game:hover .picture-large, .game-alt:hover .picture-large {
	box-shadow: none;
	border: none;
}

.game-dark {
	display: inline-block;
	box-sizing: border-box;
	width: 50%;
	width: calc(50% - 8px);
	margin: 4px;
	border: 1px solid #454545;
	box-shadow: 3px 3px 3px rgba(0,0,0,.125);
}

.game-dark > a {
	display: block;
	font-size: 1.1em;
	border-bottom: 1px solid #505050;
	box-shadow: 3px 3px 3px rgba(0,0,0,.0625);
}

.game-dark .picture-large, .game-dark:hover .picture-large {
	box-shadow: none;
	border: none;
}

.game-dark > a.game-edit {
	text-align: center;
	color: #FFFF40;
	font-size: .9em;
}

.game-dark > a.game-edit:hover {
	background-color: #404040;
}

.user {
	display: inline-block;
	width: 25%;
	width: calc(25% - 8px);
	margin: 4px;
}

.user a {
	display: block;
	font-size: .8em;
}

a .picture, a .picture-alt, a .picture-large {
	float: left;
	clear: left;
	width: 24px;
	height: 24px;
	margin: 2px;
	border: 1px dotted #808080;
	background-color: #202020;
	background-size: contain;
	background-position: center;
	background-repeat: no-repeat;
	margin-right: 8px;
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
	margin: 5px 2px;
	padding-bottom: 75%;
}

a:hover .picture, a:hover .picture-alt, a:hover .picture-large {
	border: 1px solid rgba(255,255,255,.5);
}

.links-bar {
	position: relative;
	margin: 0 auto;
	min-width: 282px;
	max-width: 746px;
	min-height: 20px;
	margin-top: 16px;
	overflow: hidden;
	background-color: #404040;
	color: white;
	border-top-left-radius: 4px;
	border-top-right-radius: 4px;
}

.links-bar2 {
	margin: 0 auto;
	min-width: 282px;
	max-width: 746px;
	height: 20px;
	/*margin: 0 8px;*/
	overflow: hidden;
	background-color: #404040;
	color: white;
	border-bottom-left-radius: 4px;
	border-bottom-right-radius: 4px;
}

.links-bar a, .links-bar2 a {
	line-height: 20px;
	font-weight: bold;
	color: #A9E071;
	margin: 0 8px;
}

#main-bar, #moderation-bar {
	display: inline-block;
	
	width: 100%;
	padding: 0;
	margin: 2px auto 21px;
	
	background-color: #264610;
	border-bottom-left-radius: 8px;
	border-bottom-right-radius: 8px;
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
	margin-top: 0;
}

#moderation-bar > span {
	display: inline-block;
	width: 102px;
	height: 20px;
	padding: 5px;
	padding-left: 18px;
	color: #7BA60D;
}

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
	
	/*background-color: #72A240;*/
	background-color: #7BA60D;
	color: white;
	border-bottom-left-radius: 8px;
	border-bottom-right-radius: 8px;
	
	transition: .4s ease 0s background, .4s ease 0s box-shadow, .4s ease 0s left, .4s ease 0s top;
	
	padding: 4px;
	text-align: center;
	text-decoration: none;
	
	font-weight: bold;
}

#main-bar a:hover, #main-bar a:focus, #moderation-bar a:hover, #moderation-bar a:focus {
	background-color: #5B8600;
	box-shadow: 2px 2px 4px rgba(0,0,0,.5), 0px 0px 0px 2px rgba(123,166,13,1);
	/*left: -1px;
	top: -1px;*/
	transition: .2s ease 0s left, .2s ease 0s top, .2s ease 0s box-shadow;
}

#main-bar a:active, #moderation-bar a:active {
	background-color: #406028;
	box-shadow: none;
	left: 0px;
	top: 0px;
}

#main-bar a.selected, #main-bar a.selected:hover:active, #main-bar a.selected:focus:active,
#moderation-bar a.selected, #moderation-bar a.selected:hover:active, #moderation-bar a.selected:focus:active {
	background-color: white;
	color: #7BA60D;
	/*background-color: #406028;
	box-shadow: 2px 2px 2px rgba(0,0,0,.5) inset;*/
	/*color: #7BA60D;*/
	left: 0px;
	top: 0px;
}

#main-bar a.selected:hover, #moderation-bar a.selected:hover {
	/*box-shadow: 2px 2px 2px rgba(0,0,0,.5) inset;*/
	box-shadow: 0px 0px 0px 2px rgba(255,255,255,.3);
}

#main-bar a.selected:active, #moderation-bar a.selected:active {
	box-shadow: none;
}

.comments {
	max-height: 407px;
	overflow: auto;
	-webkit-overflow-scrolling: touch;
}

.comment {
	padding: 4px;
}

.comment > p {
	margin: 13px 8px 0px 8px;
	border-bottom: 13px solid transparent;
	font-size: 0.85em;
	word-wrap: break-word;
}

.comment > .extra-options {
	float: right;
	opacity: .2;
	transition: .1s ease 0s opacity;
}

.comment:hover > .extra-options {
	opacity: 1;
}

.page-chooser {
	background: #454545;
	color: white;
	margin-top: 10px;
	padding: 2px;
	padding-top: 0;
	border-radius: 4px;
    line-height: 25px;
}

.page-chooser .goto-page {
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
	background-color: #505050;
	color: white !important;
	
	text-decoration: none;
}

.page-chooser .goto-page:hover {
	background-color: #303030;
	cursor: pointer;
}

.page-chooser .goto-page.active {
	background-color: transparent;
	border: 1px solid rgba(0,0,0,.1);
	cursor: default;
}

.last-active {
    display: inline-block;
    height: 15px;
    line-height: 15px;
    padding: 0px 5px;
    font-size: 9px;
    font-weight: bold;
    text-transform: uppercase;
    color: #FFF;
    border-radius: 4px;
    vertical-align: middle;
	cursor: default;
}

.last-active-online, .last-active-online-lt {
    background: none repeat scroll 0% 0% #7BA60D;
}

.last-active-offline {
	background: none repeat scroll 0% 0% #B3B3B3;
}

.last-active-offline-lt {
	background: none repeat scroll 0% 0% #5B5B5B;
}

.game-screenshots {
	position: relative;
	background-color: #303030;
	border-radius: 2px;
	white-space: nowrap;
	overflow: auto;
	-webkit-overflow-scrolling: touch;
}

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
}

.game-info a {
	color: #D0D0D0 !important;
	text-decoration: underline;
}

.game-info a:hover {
	color: #7BA60D !important;
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
    background: url("/img/star_dark.gif") repeat-x scroll left top transparent;
}

.star-rating li.current-rating {
    background: url("/img/star_dark.gif") repeat-x scroll left bottom transparent;
    position: absolute;
    height: 15px;
    display: block;
    text-indent: -9000px;
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
    text-indent: -9000px;
    z-index: 1;
    margin: 0px;
	opacity: 1;
	/*transition: .2s ease 0s opacity;*/
}

.star-rating-dark.rateable:hover li.current-rating {
    opacity: .25;
}

.star-rating-dark a.new-rating {
    background: url("/img/star_dark.gif") repeat-x scroll left center transparent;
    position: absolute;
    height: 15px;
    display: block;
    text-indent: -9000px;
    z-index: 2;
    margin: 0px;
	opacity: 0;
	/*transition: .2s ease 0s opacity;*/
	cursor: pointer;
}

.star-rating-dark a.new-rating:hover {
    opacity: 1;
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
	background-color: #303030;
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
	background: rgba(255,255,255,.2);
}

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
	border: 1px solid #505050;
	color: white !important;
}

a.dark-inset-button-alt:hover {
	border: 1px solid #202020;
}

a.dark-inset-button-alt:hover .fa-user, a.dark-inset-button:hover .fa-user {
	color: #80F040;
}

a.dark-inset-button-alt:hover .fa-envelope, a.dark-inset-button:hover .fa-envelope {
	color: #FFFF40;
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
}

.version-table thead td {
	background-color: #505050;
	color: white;
	border-bottom: 1px dotted #808080;
}

.version-table td {
	border-bottom: 1px dotted #606060;
}

.version-table a {
	color: #D0D0D0;
	text-decoration: underline;
}

.version-table a:hover {
	text-decoration: none;
}

.messages-hrow {
	background-color: #505050;
	border-bottom: 1px dotted #808080;
}

.messages-hcolumn {
	margin-right: 8px;
}

.message {
	display: block;
	border-bottom: 1px dotted #606060;
	min-height: 38px;
	clear: both;
}

.messages-column {
	overflow: hidden;
	margin-right: 8px;
}

a.messages-column-subject {
	color: white !important;
	text-decoration: none;
	min-height: 38px;
}

a.messages-column-subject:hover {
	color: #606060 !important;
	text-decoration: none;
}

.messages-column-sent {
	color: #808080;
	margin-left: 8px;
}

a.fa-envelope {
	color: #B0B0B0;
	text-decoration: none;
}

a.fa-envelope:hover, a.fa-envelope:focus {
	color: #FFFF40;
}

.friend {
	padding: 3px;
	overflow: hidden;
}

.footer {
	padding: 16px;
	border-top: 1px solid #808080;
	border-bottom: 1px solid #808080;
	margin: 16px 0;
}

.items {
	position: relative;
}

.items:focus{
	outline: 0;
}

.game-description.less, .game-tags.less {
	position: relative;
	transition: max-height .2s ease 0s;
	max-height: 100px;
	overflow: hidden;
}

.newsletter.less {
	position: relative;
	transition: max-height .2s ease 0s;
	max-height: 65px;
	overflow: hidden;
}

.game-description.less .game-short-fade, .game-tags.less .game-short-fade, .newsletter.less .game-short-fade, .news-letter.less:focus .game-short-fade {
	position: absolute;
	width: 102%;
	height: 40px;
	left: -5px;
	bottom: 0;
	border-bottom: 2px dashed #CCFF00;
	
	background: linear-gradient(to bottom, transparent, #454545) no-repeat scroll center bottom / 100% 100% transparent;
	background-size: 100% 40px;
	transition: padding-top .2s ease 0s, height .2s ease 0s, bottom .2s ease 0s;
	max-height: 80px;
	overflow: hidden;
	
	cursor: pointer;
}

.game-tags.less .game-short-fade, .newsletter.less .game-short-fade {
	border-bottom: 0;
}

.game-description.less .game-short-fade::after {
	display: block;
	text-align: center;
	color: #CCFF00;
	content: 'SHOW MORE';
	position: relative;
	top: 23px;
	width: 100%;
	transition: opacity .2s ease 0s;
}

.newsletter.less .game-short-fade {
	background: linear-gradient(to bottom, transparent, #404040) no-repeat scroll center bottom / 100% 100% transparent;
}

.less:focus, .newsletter.less:hover {
	max-height: 500px;
}

.less:focus .game-short-fade::after, .newsletter.less:hover .game-short-fade::after {
	opacity: 0;
}

.less:focus .game-short-fade, .newsletter.less:hover .game-short-fade {
	background: none;
	border-bottom: none;
	cursor: auto;
	pointer-events: none;
}

.game-info a {
	color: #D0D0D0 !important;
	text-decoration: underline;
}

.game-description table {
	width: 100%;
}

.game-description ul, .game-description ol {
	padding-left: 1.5em;
	list-style: square url(/img/bullet.png);
}

.game-description :first-child {
	margin-top: 0;
}

.game-description {
	text-align: justify;
}

.container-lt .game-info a {
	color: #7BA60D !important;
}

.container-lt  .game-info a:hover {
	color: #5B8600 !important;
	text-decoration: none;
}

.game-info a.game-button-play, a.game-button-play, .container-lt .game-info a.game-button-play {
	display: block;
	box-sizing: border-box;
	width: 150px;
	height: 40px;
	margin: 8px auto;
	
	background-color: #7BA60D;
	border-bottom: 4px solid #5B8600;
	border-radius: 4px;
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
	font-size: 1.1rem;
}

.game-info a.game-button-play:hover, a.game-button-play:hover {
	background-color: #AADD00;
}

.game-info a.game-button-play:active, a.game-button-play:active {
	background-color: #88BB00;
	border-bottom: 0 solid #7BB640;
	line-height: 40px;
	box-shadow: none !important;
}

.game-info a.game-button-play:focus, a.game-button-play:focus {
	box-shadow: 0px 0px 0px 2px rgba(255,255,255,.5) inset;
	transition: .2s ease 0s background-color, .2s ease 0s border-bottom, .2s ease 0s margin-top, .2s ease 0s line-height, .2s ease .2s box-shadow;
}

.game-main-info {
	margin-top: 5px;
}

/* 
 * Notifications.
 */
.notifications-icon {
	background-color: #303030;
	color: #C0C0C0;
	/*position: fixed;*/
	position: absolute;
	left: 50%;
	margin-left: 362px;
	top: 80px;
	border-radius: 100%;
	padding: 3px;
	text-shadow: 0px 0px 0px 2px #303030;
	cursor: pointer;
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
	margin-left: 100px;
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
	border-bottom-color: #505050;
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
	border-bottom-color: #303030;
	/*box-shadow: 2px 2px 2px 2px rgba(0,0,0,.125);*/
	
	transition: transform .3s ease .3s;
}

.notifications-window > div {
	box-sizing: border-box;
	width: 300px;
	padding: 0 10px;
	border: 0 solid #303030;
	border-left: 2px solid #303030;
	border-right: 2px solid #303030;
	
	position: absolute;
	left: 0;
	top: 0;
	
	max-height: 0;
	transition: opacity .3s ease .3s, max-height .3s ease .3s, right .3s ease .3s, padding .3s ease .3s, border .3s ease .3s;
	
	background-color: #303030;
	box-shadow: 0px 2px 2px 2px rgba(0,0,0,.125);
	
	outline: 1px solid #505050;
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
	border: 1px solid #404040;
}

.notifications-window .notifications > div {
	padding: 3px;
	cursor: default;
	text-align: left;
}

.notifications-window .notifications > a {
	display: block;
	padding: 3px;
	text-align: left;
	color: white;
}

.notifications-window .notifications > div a {
	color: white;
	text-decoration: none;
}

.notifications-window .notifications > :hover , .notifications > :focus {
	background-color: #505050;
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
	border-top: 2px solid #303030;
	border-bottom: 2px solid #303030;
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
  border: 1px dashed #505050;
  margin-bottom: 1em;
  padding: .5em;
  background-color: #282828;
  color: #747474;
}

span.bb_code {
  width: 98%;
  overflow: scroll;
}

.bb_code_title,
.bb_quote_title {
  margin-top: 1em;
}

span.bb_code {
  font-family: Courier New;
}

/* 
 * Arrow link.
 */
.arrow-link {
	display: block;
	float: right;
	
	background-color: #404040;
	width: 19px;
	height: 19px;
	border-radius: 3px;
	border: 1px solid #303030;
	overflow: hidden;
	
	text-decoration: none !important;
	
	transition: .3s ease 0s background-color, .3s ease 0s border-color;
}

.arrow-link::after, .arrow-link::before {
	display: block;
	content: '\f061';
	width: 19px;
	font-size: 14px;
	font-family: fontawesome;
	line-height: 19px;
	color: #FFFFFF;
	text-align: center;
	text-decoration: none !important;
	
	transition: .3s ease 0s margin-left, .3s ease 0s color;
}

.arrow-link::before {
	margin-left: -38px;
}

.arrow-link::after {
	margin-top: -19px;
}

.arrow-link:hover {
	background-color: white;
	border-color: white;
}

.arrow-link:hover::after {
	margin-left: 38px;
	color: #303030;
}

.arrow-link:hover::before {
	margin-left: 0;
	color: #303030;
}

/* 
 * Arrow link (light).
 */
.arrow-link-lt {
	display: block;
	float: right;
	
	background-color: #404040;
	width: 19px;
	height: 19px;
	border-radius: 3px;
	border: 1px solid #303030;
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
	color: white;
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
	background-color: white;
	border-color: white;
}

.arrow-link-lt:hover::after {
	margin-left: 38px;
	color: black;
}

.arrow-link-lt:hover::before {
	margin-left: 0;
	color: black;
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
	color: #D0D0D0;
}

h3 {
	font-size: 1.17em;
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

/* Standard */
@keyframes greenmessage {
	from {
		background: #72A240;
	}
	to {
		background: #404040;
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

/* Webkit */
@-webkit-keyframes greenmessage {
	from {
		background: #72A240;
	}
	to {
		background: #404040;
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

.clearfix::after {
    content: "";
    clear: both;
    display: block;
}

.clear-left {
	clear: left;
}

.even-odd > *:nth-child(even):not(.container-title):not(.container-title-lt) {
	background-color: #383838;
}

.even-odd-dark > *:nth-child(even):not(.container-title):not(.container-title-lt) {
	background-color: #383838;
}

.seperators > div + div {
	border-top: 1px dotted #C0C0C0;
}

.news-item + .news-item {
	border-top: 1px dotted #808080;
	padding-top: 4px;
	margin-top: 6px;
}

.news-item i {
	color: #E0E0E0;
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
	border: 1px dashed #505050;
	vertical-align: top;
}

.editable-inside:hover [contenteditable] {
	border: 1px dashed #808080;
}

[contenteditable]:hover {
	background-color: #303030;
	border: 1px solid rgba(0,0,0,.3) !important;
	box-shadow: 0 1px 3px rgba(0,0,0,.3);
}

[contenteditable]:focus:active {
	outline: 0;
	background-color: #303030;
	transition: .2s ease 0s padding, .2s ease 0s line-height, .2s ease 0s box-shadow;
}

[contenteditable]:focus {
	/*font-family: Open Sans;*/
	z-index: 2;
	outline: 0;
	background-color: #303030;
	border: 1px solid rgba(0,0,0,.3) !important;
	padding: 4px;
	box-shadow: 0 1px 3px rgba(0,0,0,.3), 0px 0px 0px 700px rgba(0,0,0,.125);
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

/* 
 * Native-like elements.
 */
.game-screenshots, .game-button-play, .page-chooser, #main-bar a, #category-chooser, #lightbox, #lightboxOverlay {
	user-select: none;
	-moz-user-select: none;
	-webkit-user-select: none;
	-webkit-tap-highlight-color: transparent;
}

/*#logo, #sessionbar {
	transition: font-size .5s ease;
}*/

/* 
 * Placeholder input elements.
 */
::-webkit-input-placeholder {
	color: #808080;
}
::-moz-placeholder {
	color: #808080;
	opacity: 1;
}
:-ms-input-placeholder {  
	color: #808080;
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

@media (max-width: 788px) {
	.notifications-icon {
		position: fixed;
		left: auto;
		right: 0px;
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
		height: 100vh;
	}
	.notifications-icon:focus + .notifications-window > div {
		box-shadow: 0px 100vh 0px 100vh rgba(0,0,0,.5);
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
}


.category {
	width: calc(50% - 11.5px);
}

/* 
 * Country flags.
 */
.lang,.region,.lang-ca,.lang-eo,.lang-eu,.variant-wales,.region-gb.lang-cy,.variant-scotland,.region-gb.lang-gd{color:#fff;background:#2e892e;display:inline-block;text-transform:uppercase;overflow:hidden;font-family:Verdana,Arial,sans-serif;font-size:9px;font-weight:normal;font-style:normal;line-height:12px;text-align:center;white-space:normal;text-shadow:none}.lang{width:20px;height:12px;line-height:12px;vertical-align:middle}.lang:before{content:attr(lang)}.lang-el{background-color:#1d48a3}.lang-el:before{content:"\0395\03BB"}.region,.lang-ca,.lang-eo,.lang-eu,.variant-wales,.region-gb.lang-cy,.variant-scotland,.region-gb.lang-gd{width:16px;height:12px;margin:0 2px;background-image:url(/img/flags/flags.png);background-repeat:no-repeat;background-color:transparent}.region:before,.lang-ca:before,.lang-eo:before,.lang-eu:before,.variant-wales:before,.region-gb.lang-cy:before,.variant-scotland:before,.region-gb.lang-gd:before{content:"\0A";display:none}.lang-zh{background-color:#b90000}.lang-zh.script-hans:before{content:"\4E2D\56FD"}.lang-zh.script-hant:before{content:"\4E2D\570B"}.__{background-position:0 0}.lang-ca{background-position:0 -12px}.lang-eo{background-position:0 -24px}.lang-eu{background-position:0 -36px}.region-ad{background-position:0 -48px}.region-ae{background-position:0 -60px}.region-af{background-position:0 -72px}.region-ag{background-position:0 -84px}.region-ai{background-position:0 -96px}.region-al{background-position:0 -108px}.region-am{background-position:0 -120px}.region-an{background-position:0 -132px}.region-ao{background-position:0 -144px}.region-aq{background-position:0 -156px}.region-ar{background-position:0 -173px}.region-as{background-position:0 -185px}.region-at{background-position:0 -197px}.region-au{background-position:0 -209px}.region-aw{background-position:0 -221px}.region-ax{background-position:0 -233px}.region-az{background-position:0 -245px}.region-ba{background-position:0 -257px}.region-bb{background-position:0 -269px}.region-bd{background-position:0 -281px}.region-be{background-position:0 -293px}.region-bf{background-position:0 -305px}.region-bg{background-position:0 -317px}.region-bh{background-position:0 -329px}.region-bi{background-position:0 -341px}.region-bj{background-position:0 -353px}.region-bl{background-position:0 -365px}.region-bm{background-position:0 -382px}.region-bn{background-position:0 -394px}.region-bo{background-position:0 -406px}.region-bq{background-position:0 -418px}.region-br{background-position:0 -430px}.region-bs{background-position:0 -442px}.region-bt{background-position:0 -454px}.region-bv{background-position:0 -466px}.region-bw{background-position:0 -478px}.region-by{background-position:0 -490px}.region-bz{background-position:0 -502px}.region-ca{background-position:0 -514px}.region-cc{background-position:0 -526px}.region-cd{background-position:0 -538px}.region-cf{background-position:0 -550px}.region-cg{background-position:0 -562px}.region-ch{background-position:0 -574px}.region-ci{background-position:0 -586px}.region-ck{background-position:0 -598px}.region-cl{background-position:0 -610px}.region-cm{background-position:0 -622px}.region-cn{background-position:0 -634px}.region-co{background-position:0 -646px}.region-cr{background-position:0 -658px}.region-cs{background-position:0 -670px}.region-cu{background-position:0 -682px}.region-cv{background-position:0 -694px}.region-cw{background-position:0 -706px}.region-cx{background-position:0 -723px}.region-cy{background-position:0 -735px}.region-cz{background-position:0 -747px}.region-de{background-position:0 -759px}.region-dj{background-position:0 -771px}.region-dk{background-position:0 -783px}.region-dm{background-position:0 -795px}.region-do{background-position:0 -807px}.region-dz{background-position:0 -819px}.region-ec{background-position:0 -831px}.region-ee{background-position:0 -843px}.region-eg{background-position:0 -855px}.region-eh{background-position:0 -867px}.region-er{background-position:0 -879px}.region-es{background-position:0 -891px}.region-et{background-position:0 -903px}.region-fi{background-position:0 -915px}.region-fj{background-position:0 -927px}.region-fk{background-position:0 -939px}.region-fm{background-position:0 -951px}.region-fo{background-position:0 -963px}.region-fr{background-position:0 -975px}.lang-fy.region-nl{background-position:0 -3141px}.region-ga{background-position:0 -987px}.region-gb{background-position:0 -999px}.region-gd{background-position:0 -1011px}.region-ge{background-position:0 -1023px}.region-gf{background-position:0 -1035px}.region-gg{background-position:0 -1047px}.region-gh{background-position:0 -1064px}.region-gi{background-position:0 -1076px}.region-gl{background-position:0 -1088px}.region-gm{background-position:0 -1100px}.region-gn{background-position:0 -1112px}.region-gp{background-position:0 -1124px}.region-gq{background-position:0 -1136px}.region-gr{background-position:0 -1148px}.region-gs{background-position:0 -1160px}.region-gt{background-position:0 -1172px}.region-gu{background-position:0 -1184px}.region-gw{background-position:0 -1196px}.region-gy{background-position:0 -1208px}.region-hk{background-position:0 -1220px}.region-hm{background-position:0 -1232px}.region-hn{background-position:0 -1244px}.region-hr{background-position:0 -1256px}.region-ht{background-position:0 -1268px}.region-hu{background-position:0 -1280px}.region-id{background-position:0 -1292px}.region-ie{background-position:0 -1304px}.region-il{background-position:0 -1316px}.region-im{background-position:0 -1328px}.region-in{background-position:0 -1345px}.region-io{background-position:0 -1357px}.region-iq{background-position:0 -1369px}.region-ir{background-position:0 -1381px}.region-is{background-position:0 -1393px}.region-it{background-position:0 -1405px}.region-je{background-position:0 -1417px}.region-jm{background-position:0 -1434px}.region-jo{background-position:0 -1446px}.region-jp{background-position:0 -1458px}.region-ke{background-position:0 -1470px}.region-kg{background-position:0 -1482px}.region-kh{background-position:0 -1494px}.region-ki{background-position:0 -1506px}.region-km{background-position:0 -1518px}.region-kn{background-position:0 -1530px}.region-kp{background-position:0 -1542px}.region-kr{background-position:0 -1554px}.region-kw{background-position:0 -1566px}.region-ky{background-position:0 -1578px}.region-kz{background-position:0 -1590px}.region-la{background-position:0 -1602px}.region-lb{background-position:0 -1614px}.region-lc{background-position:0 -1626px}.region-li{background-position:0 -1638px}.region-lk{background-position:0 -1650px}.region-lr{background-position:0 -1662px}.region-ls{background-position:0 -1674px}.region-lt{background-position:0 -1686px}.region-lu{background-position:0 -1698px}.region-lv{background-position:0 -1710px}.region-ly{background-position:0 -1722px}.region-ma{background-position:0 -1734px}.region-mc{background-position:0 -1746px}.region-md{background-position:0 -1758px}.region-me{background-position:0 -1770px}.region-mf{background-position:0 -1783px}.region-mg{background-position:0 -1800px}.region-mh{background-position:0 -1812px}.region-mk{background-position:0 -1824px}.region-ml{background-position:0 -1836px}.region-mm{background-position:0 -1848px}.region-mn{background-position:0 -1860px}.region-mo{background-position:0 -1872px}.region-mp{background-position:0 -1884px}.region-mq{background-position:0 -1896px}.region-mr{background-position:0 -1908px}.region-ms{background-position:0 -1920px}.region-mt{background-position:0 -1932px}.region-mu{background-position:0 -1944px}.region-mv{background-position:0 -1956px}.region-mw{background-position:0 -1968px}.region-mx{background-position:0 -1980px}.region-my{background-position:0 -1992px}.region-mz{background-position:0 -2004px}.region-na{background-position:0 -2016px}.region-nc{background-position:0 -2028px}.region-ne{background-position:0 -2040px}.region-nf{background-position:0 -2052px}.region-ng{background-position:0 -2064px}.region-ni{background-position:0 -2076px}.region-nl{background-position:0 -2088px}.region-no{background-position:0 -2100px}.region-np{background-position:0 -2112px}.region-nr{background-position:0 -2124px}.region-nu{background-position:0 -2136px}.region-nz{background-position:0 -2148px}.region-om{background-position:0 -2160px}.region-pa{background-position:0 -2172px}.region-pe{background-position:0 -2184px}.region-pf{background-position:0 -2196px}.region-pg{background-position:0 -2208px}.region-ph{background-position:0 -2220px}.region-pk{background-position:0 -2232px}.region-pl{background-position:0 -2244px}.region-pm{background-position:0 -2256px}.region-pn{background-position:0 -2268px}.region-pr{background-position:0 -2280px}.region-ps{background-position:0 -2292px}.region-pt{background-position:0 -2304px}.region-pw{background-position:0 -2316px}.region-py{background-position:0 -2328px}.region-qa{background-position:0 -2340px}.region-re{background-position:0 -2352px}.region-ro{background-position:0 -2364px}.region-rs{background-position:0 -2376px}.region-ru{background-position:0 -2388px}.region-rw{background-position:0 -2400px}.region-sa{background-position:0 -2412px}.region-sb{background-position:0 -2424px}.region-sc{background-position:0 -2436px}.region-sd{background-position:0 -2448px}.region-se{background-position:0 -2460px}.region-sg{background-position:0 -2472px}.region-sh{background-position:0 -2484px}.region-si{background-position:0 -2496px}.region-sj{background-position:0 -2508px}.region-sk{background-position:0 -2520px}.region-sl{background-position:0 -2532px}.region-sm{background-position:0 -2544px}.region-sn{background-position:0 -2556px}.region-so{background-position:0 -2568px}.region-sr{background-position:0 -2580px}.region-ss{background-position:0 -2592px}.region-st{background-position:0 -2609px}.region-sv{background-position:0 -2621px}.region-sx{background-position:0 -2633px}.region-sy{background-position:0 -2650px}.region-sz{background-position:0 -2662px}.region-tc{background-position:0 -2674px}.region-td{background-position:0 -2686px}.region-tf{background-position:0 -2698px}.region-tg{background-position:0 -2710px}.region-th{background-position:0 -2722px}.region-tj{background-position:0 -2734px}.region-tk{background-position:0 -2746px}.region-tl{background-position:0 -2758px}.region-tm{background-position:0 -2770px}.region-tn{background-position:0 -2782px}.region-to{background-position:0 -2794px}.region-tr{background-position:0 -2806px}.region-tt{background-position:0 -2818px}.region-tv{background-position:0 -2830px}.region-tw{background-position:0 -2842px}.region-tz{background-position:0 -2854px}.region-ua{background-position:0 -2866px}.region-ug{background-position:0 -2878px}.region-um{background-position:0 -2890px}.region-us{background-position:0 -2902px}.region-uy{background-position:0 -2914px}.region-uz{background-position:0 -2926px}.region-va{background-position:0 -2938px}.region-vc{background-position:0 -2950px}.region-ve{background-position:0 -2962px}.region-vg{background-position:0 -2974px}.region-vi{background-position:0 -2986px}.region-vn{background-position:0 -2998px}.region-vu{background-position:0 -3010px}.region-wf{background-position:0 -3022px}.region-ws{background-position:0 -3034px}.region-ye{background-position:0 -3046px}.region-yt{background-position:0 -3058px}.region-za{background-position:0 -3070px}.region-zm{background-position:0 -3082px}.region-zw{background-position:0 -3094px}.variant-scotland,.region-gb.lang-gd{background-position:0 -3106px}.variant-wales,.region-gb.lang-cy{background-position:0 -3118px}.x-eu{background-position:0 -3130px}

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