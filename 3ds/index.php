<?php
session_start();
include("../detect.php");
?>

<html>
	<meta charset="UTF-32BE">
	<head>
		<style>
			body {
				margin: 0px;
				width: <?php echo $width; ?>px;
				background-color: #fffff;
				font-size: 12px;
			}
			#contenttop {
				background-color: #f0f0f0;
				height: <?php echo $height1; ?>px;
			}
			
			#contentbot {
				background-color: #f0f0f0;
				height: <?php echo $height2; ?>px;
				overflow-y: auto;
			}
			.ctop {
				background-color: #f0f0f0;
				height: <?php echo $height1; ?>px;
			}
			
			.cbot {
				background-color: #f0f0f0;
				height: <?php echo $height2; ?>px;
			}
		</style>
		<title>3DSTownSquare Home</title>
		<meta name="viewport" content="width=<?php echo $width; ?>">
		<meta name="description" content="Welcome to 3DSTownSquare Here you can find many apps and games designed for the 3DS!">
	</head>
	<body>
		<div id="contenttop" class="ctop">
			<img src="../images/header3ds.png" style="width: <?php echo $width . "px"; ?>;" alt="Oops! Our header could not be displayed!" />
			<center>Welcome to 3DSTownSquare, guest!</center>
			<center><?php 
			echo "Ever since " . date("Y/m/d G:i:s", filectime("index.php")) . " UTC";
			?></center>
			<center><font color="grey">What is this?</font></center>
			<center>3DSTS (3DSTownSquare) is a website targeted for 3DS and DSi users. This site contains many apps and games for people to play.</center>
			<br/>
			<marquee>News: 3DSTownSquare is now in beta testing! Please wait for release 1.0 on <a href="http://3dstownsquare.com/" target="_blank">http://3dstownsquare.com/</a></marquee>
			<marquee>
			<b>[WEBSITE ABOUT ME]</b>
Ever since I first created the site's main index file (2022/04/23, 20:33:47 UTC), I've come to realize how much the site has become similar to 3DSPlaza and Home4DSi. I give credit to the admins of 3DSPlaza and Home4DSi for what it was.
This site is basically backpedaling what 3DSPlaza and Home4DSi did and rewriting the system and standards.
Sure it's not perfect, but it feels so right to keep the legacy alive.
And some might say the 3DS community died years ago, along with 3DSPlaza and Home4DSi which soon was replaced  by technologies such as TeamSpeak, Skype, and Discord.
In the end when development for the original website for what transformed into a chat-only clone (Chromebook Gang) ended up becoming a little stale, since there was a little bit too much freedom with development.
One can agree that development for both of these sites are very similar to Home4DSi and 3DSPlaza, with Home4DSi rarely getting updated and 3DSPlaza getting all the goodies.
It's hard to think that all of this started merely 3 years ago, or possibly even more, with the inception of HxUnbloxx when I started writing code for real.
Unfortunately, gone are the days of writing in a code in a notebook at school and writing said code on the computer at home. Anyways, back to my main point.
I do whatever I can to help make this site better by providing bugfixes on demand ASAP. I will continue working on this site for as long as possible. 3DSTownSquare is receiving updates in the Comic Book department as we speak.
			</marquee>
		</div>
		<div id="contentbot" class="cbot">
		<center>
		<?php if(isset($_SESSION["ts_user"]) && isset($_SESSION["ts_points"])){ 
		
		// Refresh points
		
		$jsonF = file_get_contents("acc/data/" . $_SESSION["ts_user"] . ".json");
		$jsonD = json_decode($jsonF, true);
		$_SESSION["ts_points"] = $jsonD["points"];
		?>Welcome, <?php echo "<a href='acc/acc.php'>" . $_SESSION["ts_user"] . "</a>"; ?>, you have <?php echo $_SESSION["ts_points"] . " points!"; } else { ?><a href="acc/log.php">Login</a><?php } ?></center>
		
		<center>
		<a href="games/"><img src="../images/games.png"></img></a>
		<a href="chat/"><img src="../images/ch.png"></img></a>
		<a href="javascript:if(confirm('Forums is in beta! Are you sure you want to go to the forums?\n\nPlease send bugs and errors to HxOr1337#0907 on Discord!')){window.location='forums/';}void(0)"><img src="../images/forums.png"></img></a>
		</center>
		<span style="color:grey;">Beta 1.3.0_0 (05132022) <img src="copyleft.png" onclick="alert('Fun fact: Copyleft is NOT the opposite of copyright!');" alt="" /> Copyleft <?php echo date("Y"); ?> - Licensed under the <a href='https://www.gnu.org/licenses/gpl-3.0.en.html'>GNU General Public License 3.0 (GPLv3)</a>, Read more <a href="license.html">here</a></span>
		</div>
		
	</body>
</html>