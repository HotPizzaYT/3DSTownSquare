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
		<title>DrawTown - Works</title>
		<meta name="viewport" content="width=<?php echo $width; ?>">
		<meta name="description" content="DrawTown current works">
	</head>
	<body>
		<div id="contenttop">
			<img src="../../../images/header3ds.png" width="<?php echo $width; ?>" alt="Oops! Our header could not be displayed!" />
			<center><b><u>DrawTown list of works</u></b></center>
		</div>
		<div id="contentbot">
		<center>
	<div class="commentbox">
		<div class="aqua">
			Current works
		</div>
		<div id="comments">
		<?php
		$files = scandir('data/');
		foreach($files as $file) {
			// echo $file;
			if(is_file("data/".$file)){
				$jsonF = file_get_contents("data/".$file);
				$jsonD = json_decode($jsonF, true);
				$name = "<a href='view.php?v=".str_replace(".json","",$file)."'>\"".htmlspecialchars($jsonD["title"])."\" from ".$jsonD["from"]."</a>";
				echo "<div class='crow' alt='This is a work'>" . $name . "<br/></div>";
			}
		}
		?>
		
		</div>
	</div>
	<a href="index.php">Back</a>
		</center>
		</div>
	</body>
</html>