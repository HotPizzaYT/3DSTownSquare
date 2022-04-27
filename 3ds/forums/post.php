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
				<?php
		$error = "";
		if(isset($_GET["t"]) && file_exists("data/topic/".$_GET["t"].".json")){
			$jsonF = file_get_contents("data/topic/".$_GET["t"].".json");
			$jsonD = json_decode($jsonF, true);
		} else {
			$error = "There are no posts in this topic.";
		}
		?>
			<img src="../../images/header3ds.png" alt="Oops! Our header could not be displayed!" />
			<center><b><u><?php if($error == ""){ echo $jsonD["name"]; } else { echo "Error!"; } ?></u></b></center>
			<center><?php if($error == ""){ $jsonD["description"]; } else { echo "<font color='red'>".$error."</font>"; } ?></center>
		</div>
		<div id="contentbot">
		<?php if($error == ""){
		?>
		<form action="pa.php" method="post">
			<?php if(isset($_SESSION["ts_user"])){
			?>
				<input type="text" name="topic" hidden value="<?php echo $_GET["t"] ?>" />
				<h2>Post</h2>
				Title: <input type="text" name="title" placeholder="This is where your title goes" maxlength="32" /><br />
				Content:<br />
				<textarea style="width: 303px; height: 100px" name="cont" maxlength="5000" ></textarea>
				<br />
				<input type="submit" value="Post" />
				<br />
			<?php } else {
			?>
			<h3>Error</h3>
			You must be logged in to post!
			<?php
			} ?>
		<?php
		} else {
			echo "<h1>Whoops!</h1>\r\n<span style='color: grey'>We're afraid that topic doesn't exist!</span>";
		}?>
	<a href="../forums">Back</a>
		</div>
	</body>
</html>