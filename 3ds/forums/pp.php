<style>
body, html {
	width: 320px;
}
</style>
<meta name="viewport" content="width=320">
<?php
// Haha, PP
	session_start();
	if(isset($_SESSION["ts_user"]) && $_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["topic"]) && isset($_POST["post"]) && isset($_POST["cont"])){
		if($_POST["cont"] != "" strlen($_POST["post"]) <= 3000){
			if(file_exists("data/topic/".$_POST["topic"].".json")){
				$jsonF = file_get_contents("data/topic/".$_POST["topic"].".json");
				$jsonD = json_decode($jsonF, true);
				$posts = $jsonD["posts"][$_POST["post"]];
				$newPost = array("from"=>$_SESSION["ts_user"],"cont"=>$_POST["cont"],"time"=>time());
				array_push($jsonD["posts"], $newPost);
				$newj = json_encode($jsonD);
				file_put_contents("data/topic/".$_POST["topic"].".json", $newj);
				$id = count($jsonD["posts"]) - 1;
				echo "Your post has been submitted<a href='view.php?topic=0&post=".$id."'>here</a>.";
				
				
			}
		}else{
			echo "forums.error.unknown";
		}
	} else {
		echo "Something went wrong.<br />";
		echo "Debug info: ".var_dump($_SERVER["REQUEST_METHOD"]);
	}