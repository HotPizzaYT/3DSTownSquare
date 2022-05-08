<?php
session_start();
include_once("../chat/process.php");
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
		<link rel="stylesheet"
			href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.5.1/styles/default.min.css">
		<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.5.1/highlight.min.js"></script>
		<script>hljs.highlightAll();</script>
		<style>
			body {
				margin: 0px;
				width: <?php echo $width; ?>px;
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
pre {
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
		
	<?php
		$error = "";
		if(isset($_GET["topic"]) && isset($_GET["post"]) && file_exists("data/topic/".$_GET["topic"].".json")){
			$jsonF = file_get_contents("data/topic/".$_GET["topic"].".json");
			$jsonD = json_decode($jsonF, true);
			if(isset($_GET["post"]) && (count($jsonD["posts"])-1) >= strval($_GET["post"])){
				$post = $jsonD["posts"][strval($_GET["post"])];
				$cont = process($post["cont"]);
				$cont = str_ireplace("\n", "<br />", $cont	);
				
				$cont = str_ireplace("[code]", "<pre><code>", $cont);
				$cont = str_ireplace("[/code]", "</pre></code>", $cont);
				
			} else {
				$error = "forums.errors.postnotfound";
			}
		} else {
			$error = "forums.errors.notfound";
		}
	?>
	<div class="commentbox">
		<div class="aqua">
		<?php
				if($error == ""){
					echo htmlspecialchars($post["title"]);
				} else {
					echo $error;
				}
		?>
		</div>
		<div id="comments" style="text-align: left">
		<?php
			if($error == ""){
				echo $post["from"]." says:<br/>";
				echo $cont;
			} else {
				echo $error;
			}
			?>
		
		</div>
		

	</div>
	
	<a href="topic.php?t=<?php if(isset($_GET["topic"])){ echo $_GET["topic"]; } else { echo "0"; } ?>">Back</a>
		</center>
		</div>
	</body>
</html>