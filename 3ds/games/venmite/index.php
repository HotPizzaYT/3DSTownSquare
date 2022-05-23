<?php
include("../../../detect.php");
if(strpos($_SERVER["HTTP_USER_AGENT"], "Nintendo DSi") !== false){
	header("Location: unsupported.php");
} else {
	$isSup = true;
}
?>
<html>
	<head>
		<style>
			body {
				margin: 0px;
				width: 320px;
				background-color: #fffff;
			}
			#contenttop {
				background-color: #f0f0f0;
				height: 215px;
			}
			
			#contentbot {
				background-color: #000;
				height: 240px;
			}
			th, td {
				width: 16px;
				height: 16px;
				outline: 1px solid #000;
				padding: 12px
			}
			.loading {
				position: relative;
				left: 40%;
				text-align: center;
			}
		</style>
		<title>Venmite Game</title>
		<meta name="viewport" content="width=320">
		<meta name="description" content="An MMORPG for the Nintendo 3DS!">
	</head>
	<body onload="setTimeout(function(){window.location = 'client.php'}, 5000)">
		<div id="contenttop">
			<div id="status" style="background-color: #e0e0e0"><marquee>Please wait while the game is loading...</marquee></div>
			<span class="loading">Loading... <img src="loading.gif" /></span>
		</div>
		<div id="contentbot">
		<span style="color: #fff;">The game is loading. Please wait.</span>
		</div>
	</body>
</html>