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
		<title>3DSTownSquare forums</title>
		<meta name="viewport" content="width=320">
		<meta name="description" content="Welcome to 3DSTownSquare forums. It's a place to post about whatever you want!">
	</head>
	<body>
		<div id="contenttop">
			<img src="../../images/header3ds.png" alt="Oops! Our header could not be displayed!" />
			<center><b><u>Welcome to 3DSTownSquare forums!</u></b></center>
		</div>
		<div id="contentbot">
		<center>
	<div class="commentbox">
		<div class="aqua">
			Topics
		</div>
		<div id="comments">
		<?php
		$files = scandir('data/topic');
		foreach($files as $file) {
			// echo $file;
			if(is_file("data/topic/".$file)){
				$jsonF = file_get_contents("data/topic/".$file);
				$jsonD = json_decode($jsonF, true);
				$name = "<a href='topic.php?t=".str_replace(".json","",$file)."'>".$jsonD["name"]."</a>";
				$desc = $jsonD["description"];
				$latestPost = "Latest post by: ".$jsonD["posts"][0]["from"].", \"".htmlspecialchars($jsonD["posts"][0]["title"])."\"";
				echo "<div class='crow' alt='".$desc."'>" . $name . "<br/><font color='grey'>".$latestPost."</font></div>";
			}
		}
		?>
		
		</div>
	</div>
	<a href="../">Back</a>
		</center>
		</div>
	</body>
</html>