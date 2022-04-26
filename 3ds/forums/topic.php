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
		<?php
		$error = "";
		if(isset($_GET["t"]) && file_exists("data/topic/".$_GET["t"].".json")){
			$jsonF = file_get_contents("data/topic/".$_GET["t"].".json");
			$jsonD = json_decode($jsonF, true);
		} else {
			$error = "There are no posts in this topic.";
		}
		?>
	<div class="commentbox">
		<div class="aqua">
			<?php if($error == ""){
				?>
				Posts in <?php echo htmlspecialchars($jsonD["name"]) ?>
				<?php
			} else {
				echo "Error";
			}
			?>
		</div>
		<div id="comments">
			<?php if($error == ""){
				foreach($jsonD["posts"] as $key => $post){
					echo "<div class='crow'><a href='view.php?topic=".$_GET["t"]."&post=".$key."'>\"".$post["title"]."\" from " . $post["from"] . "</a></div>";
				}
			} else {
				echo $error;
			}
			?>
		
		</div>
	</div>
	<a href="../forums">Back</a>
		</center>
		</div>
	</body>
</html>