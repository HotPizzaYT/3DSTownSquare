<?php
session_start();
?>

<html>
	<head>
		<style>
			body {
				margin: 0px;
				width: 320px;
				background-color: #fffff;
				font-size: 12px;
			}
			#contenttop {
				background-color: #f0f0f0;
				height: 208px;
			}
			
			#contentbot {
				background-color: #f0f0f0;
				height: 222px;
			}
		</style>
		<title>3DSTownSquare Home</title>
		<meta name="viewport" content="width=320">
		<meta name="description" content="Welcome to 3DSTownSquare Here you can find many apps and games designed for the 3DS!">
	</head>
	<body>
		<div id="contenttop">
			<img src="../images/header3ds.png" alt="Oops! Our header could not be displayed!" />
			<center>Welcome to 3DSTownSquare</center>
			<center><?php 
			echo "Ever since " . date("Y/m/d G:i:s", filectime("index.php")) . " UTC";
			?></center>
			<center><font color="grey">What is this?</font></center>
			<center>3DSTS (3DSTownSquare) is a website targeted for 3DS and DSi users. This site contains many apps and games for people to play.</center>
			<br/>
			The site is under construction at the moment.
			<br />
			Please check back later!
		</div>
		<div id="contentbot">
		<center>
		<?php if(isset($_SESSION["ts_user"]) && isset($_SESSION["ts_points"])){ 
		
		// Refresh points
		
		$jsonF = file_get_contents("acc/data/" . $_SESSION["ts_user"] . ".json");
		$jsonD = json_decode($jsonF, true);
		$_SESSION["ts_points"] = $jsonD["points"];
		?>Welcome, <?php echo "<a href='acc/acc.php'>" . $_SESSION["ts_user"] . "</a>"; ?>, you have <?php echo $_SESSION["ts_points"] . " points!"; } else { ?><a href="acc/log.php">Login</a><?php } ?></center>
		
		
		<center>
		<a href="games/"><img src="../images/games.png"></img></a>
		<a href="chat/"><img src="../images/chat.png"></img></a>
		<a href="javascript:if(confirm('Forums is in beta! Are you sure you want to go to the forums?\n\nPlease send bugs and errors to HxOr1337#0907 on Discord!')){window.location='forums/';}void(0)"><img src="../images/forums.png"></img></a>
		</center>
		</div>
	</body>
</html>