<?php
session_start();
include("../../../detect.php");
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
				overflow-y: scroll;
				word-wrap: break-word;
			}
.commentbox {
	width: 250px;
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
		<title>DrawGuessr</title>
		<meta name="viewport" content="width=320">
		<meta name="description" content="DrawTown current works">
	</head>
	<body>
		<div id="contenttop">
			<img src="../../../images/header3ds.png" alt="Oops! Our header could not be displayed!" />
			<center><b><u>DrawTown DrawGuessr Rooms</u></b></center>
		</div>
		<div id="contentbot">
		<center>
	<div class="commentbox">
		<div class="aqua">
			DrawTown DrawGuessr Rooms
		</div>
		<div id="comments">
		<?php
		$files = array_diff(scandir('live/'), array('..', '.'));;
		foreach($files as $file) {
			// echo $file;
			if(is_dir("live/".$file) && file_exists("live/".$file."/game.json")){
				$jsonF = file_get_contents("live/".$file."/game.json");
				$jsonD = json_decode($jsonF, true);
			$name = "<a href='room.php?v=".str_replace(".json","",$file)."'>".htmlspecialchars($jsonD["name"])."\" (".count($jsonD["players"])." players)</a>";
				echo "<div class='crow' alt='the h'>" . $name . "<br/></div>";
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