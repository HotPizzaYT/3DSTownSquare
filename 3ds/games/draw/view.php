<?php
session_start();
include("../../../detect.php");
?>

<html>
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
				overflow-y: scroll;
				overflow-x: hidden;
				word-wrap: break-word;
			}
.commentbox {
	width: <?php echo $cbp1; ?>px;
	outline: 1px solid black;
	min-height: 200px;
}
.aqua {
	background-color: #33CCFF;
}
.crow {
	padding-top: 8px;
	padding-bottom: 8px;
	border-bottom: 1px solid black;
	text-align: left;
}
		</style>
		<title>DrawTown - View drawing</title>
		<meta name="viewport" content="width=<?php echo $width; ?>">
		<meta name="description" content="DrawTown current works">
	</head>
	<body>
		<div id="contenttop">
			<img src="../../../images/header3ds.png" width="<?php echo $width; ?>" alt="Oops! Our header could not be displayed!" />
			<center><b><u>DrawTown view drawing</u></b></center>
		</div>
		<div id="contentbot">
		<center>
		<?php
		if(isset($_GET["v"]) && file_exists("data/".$_GET["v"].".json")){
			$jsonF = file_get_contents("data/".$_GET["v"].".json");
			$jsonD = json_decode($jsonF, true);
			$title = htmlspecialchars($jsonD["title"]);
			$from = $jsonD["from"];
			$src = "out/".$_GET["v"].".png";
			echo "<h2>".$title."</h2><a href='".$src."'><img src='".$src."' alt='".$title."' /></a>";
		} else {
			echo "Drawing not found";
		}
		?>
	<a href="works.php">Back</a>
		</center>
		</div>
	</body>
</html>