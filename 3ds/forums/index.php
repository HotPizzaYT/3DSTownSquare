<?php
session_start();
include("../../detect.php");
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
		<title>3DSTownSquare forums</title>
		<meta name="viewport" content="width=<?php echo $width; ?>">
		<meta name="description" content="Welcome to 3DSTownSquare forums. It's a place to post about whatever you want!">
	</head>
	<body>
		<div id="contenttop">
			<img src="../../images/header3ds.png" width="<?php echo $width; ?>" alt="Oops! Our header could not be displayed!" />
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
				
				$latest = count($jsonD["posts"]) - 1;
				
				$lpc = "grey";
				if(count($jsonD["posts"]) == 0){
					$lpc = "red";
					$latestPost = "This topic is empty! Be the first one to post something!";
				} else {
					$lpc = "grey";
					$latestPost = "Latest post by: ".$jsonD["posts"][$latest]["from"].", \"".htmlspecialchars($jsonD["posts"][$latest]["title"])."\"";
				}
				echo "<div class='crow' alt='".$desc."'>" . $name . "<br/><font color='{$lpc}'>".$latestPost."</font></div>";
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