<?php
	header('Content-type: text/css');
?>
/* 
 * Snow.
 */
.snow {
	color: rgb(255, 255, 255);
	transform: translate3d(0px, 0px, 0px);
	width: 8px;
	height: 8px;
	font-family: arial,verdana;
	cursor: default;
	overflow: hidden;
	font-weight: normal;
	z-index: 0;
	display: block;
	padding: 0px;
	margin: 0px;
	font-size: 16px;
	line-height: 10px;
	text-align: center;
	vertical-align: baseline;
}

body {
	background: <?php if (true||((time()%86400)/3600>=7&&(time()%86400)/3600<=18)) echo '#8899AA'; else echo 'linear-gradient(to bottom,#100020,#200040) fixed'; ?>;
	background-repeat: no-repeat;
}
/*	overflow: hidden;
	margin-left: 0;
	margin-right: 0;
}

#parallax {
	position: relative;
	left: 0;
	top: 0;
	right: 0;
	bottom: 0;
	perspective: 1px;
	overflow-x: hidden;
	overflow-y: auto;
	padding-left: 10px;
	padding-right: 10px;
}

#parallax-fireworks {
	position: absolute;
	left: 0;
	top: 0;
	right: 0;
	bottom: 0;
	transform: translateZ(-1px) scale(2);
	z-index: -1000;
}*/

/*body {
	background-image: url('/img/fireworks.jpg');
	background-size: contain;
	background-repeat: repeat;
}*/

/*<?php echo time()/86400; ?> <?php echo (time()/86400)%1; ?>*/