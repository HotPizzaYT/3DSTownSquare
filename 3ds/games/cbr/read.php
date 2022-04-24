<?php
if(isset($_GET["id"]) && file_exists("data/" . $_GET["id"] . "/info.php")){
	include_once("data/".$_GET["id"]."/info.php");
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
			.upperheader {
				background-color: #ff8000;
			}
			.crow {
				border-top: 1px solid #000;
				border-bottom: 1px solid #000;
				padding-top: 8px;
				padding-bottom: 8px;
			}
			.active {
				background-color: #33CCFF;
			}
			.comicPage {
				width: 320px;
			}

		</style>
		<script>
			script = <?php echo $pt; ?>;
			page = <?php if($startsWithZero){ echo "0"; } else { echo "1"; }?>;
			pageMax = <?php echo $cbPages ?>;
			pagePrefix = "data/<?php echo $_GET["id"] ?>/pages/<?php echo $cbprefix; ?>";
			function load(){
				document.getElementById("ss").innerHTML = script[page].replace(/\\n/gi, "<br />");
			}
			function next(){
				inRange = ((page + 1) <= <?php if($startsWithZero){ echo "(pageMax - 1)"; } else { echo "pageMax"; }?>);
				if(inRange){
					page++;
					document.getElementById("page").src = pagePrefix + page.toString() + ".png";
					document.getElementById("ss").innerHTML = script[page].replace(/\n/g, "<br />");
					
				} else {
					
				}
			}
			function back(){
				inRange = ((page - 1) <= <?php if($startsWithZero){ echo "(pageMax - 1)"; } else { echo "pageMax"; }?> && (page-1) !== -1 && (page-1) !== -2);
				if(inRange){
					page--;
					document.getElementById("page").src = pagePrefix + page.toString() + ".png";
					document.getElementById("ss").innerHTML = script[page].replace(/\n/g, "<br />");
					
				} else {
					
				}
			}
		</script>
		<title>Comic Book Reader 1.0 (Beta)</title>
		<meta name="viewport" content="width=320">
		<meta name="description" content="Welcome to 3DSTownSquare Here you can find many apps and games designed for the 3DS!">
	</head>
	<body onload="setTimeout(load(), 2000)">
		<div id="contenttop">
			<img src="../../../images/header3ds.png" alt="Oops! Our header could not be displayed!" />
			<center>You are now reading "<?php echo $cbname; ?>"</center>
			<div style="overflow-y: scroll; height: 130px;" id="ss">
				Loading script...
			</div>
		</div>
		<div id="contentbot">
			<button onclick="back();">Back</button><button onclick="next();">Next</button> <a href="shop.php">Back to shop</a>
			
			<!-- Insert comic page -->
			
			<img id="page" src="data/<?php echo $_GET["id"]; ?>/pages/page0.png" class="comicPage">
			<br />
			<button onclick="back();">Back</button><button onclick="next();">Next</button>

		</div>
	</body>
</html>
<?php } else if(isset($_GET["id"]) && $_GET["id"] === "1"){ 
?>
That comic is coming soon! While you wait, why don't you play some games? <a href="../">Back</a>
<?php } else { ?>
That comic doesn't exist! <a href="../">Back</a>
<?php } ?>