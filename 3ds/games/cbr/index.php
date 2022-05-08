<?php
session_start();
$width = "320";
$height1 = "208";
$height2 = "222";
if(strpos($_SERVER["HTTP_USER_AGENT"], "Nintendo DSi") !== false){
	$width = "240";
	$height1 = "176";
	$height2 = "176";
} else {
	$width = "320";
}
$cbp = (78.125 / 100) * intval($width);
$cbp1 = strval($cbp);
?>



<html>
	<head>
		<style>
			body {
				margin: 0px;
				width: <?php echo $width; ?>px;
				background-color: #ffffff;
				font-size: 12px;
			}
			#contenttop {
				background-color: #f0f0f0;
				height: <?php echo $height1; ?>px;
			}
			
			#contentbot {
				background-color: #f0f0f0;
				height: <?php echo $height2; ?>px;
			}
		</style>
		<script>
		function shop(){
			window.location = "shop.php";
		}
		function myComics(){
			window.location = "mc.php";
		}
		</script>
		<title>Comic Book Reader 1.0 (Beta)</title>
		<meta name="viewport" content="width=<?php echo $width;?>">
		<meta name="description" content="Comic Book Reader - Read all your favorites here!">
	</head>
	<body>
		<div id="contenttop">
			<img src="../../../images/header3ds.png" width="<?php echo $width;?>" alt="Oops! Our header could not be displayed!" />
			<center>Comic Book Reader 1.0 (Beta)</center>
			<marquee>Welcome to Comic Book Reader! Our first comic comes from Slinkybenis. When asked what he had to say on the comic he said "sporkbob schitbag is a masterpiece sent by the gods of creation and writing it was a perilous journey i will never forget." Those are his exact words. Stay tuned next time where we review Omega's untitled comic!</marquee>
		</div>
		<div id="contentbot">
			<center>
				<button onclick="shop()">Shop</button><br/>
				<button onclick="myComics()">My Comics</button><br/>
				<button onclick="window.location = '../'">Back to apps</button>
			</center>
		</div>
	</body>
</html>