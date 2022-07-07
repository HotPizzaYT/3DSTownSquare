<style>
body, html {
	width: 320px;
}
</style>
<meta name="viewport" content="width=320">
<?php
error_reporting(E_ALL);

if(isset($_COOKIE["cd"]) && intval($_COOKIE["cd"]) >= time()){
	// unset($_COOKIE["cd"]);
	setCookie("cd", "", -1);
	$iscd = true;
} else if(isset($_COOKIE["cd"])){
	$iscd = false;
} else {
	$iscd = true;
}
	session_start();
	if(isset($_SESSION["ts_user"]) && $_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["topic"]) && isset($_POST["title"]) && isset($_POST["cont"]) && true){
		if($_POST["title"] != "" && $_POST["cont"] != "" && strlen($_POST["title"]) <= 32 && strlen($_POST["cont"]) <= 5000){
			if(file_exists("data/topic/".$_POST["topic"].".json") && json_decode(file_get_contents("../acc/data/".$_SESSION["ts_user"].".json"),true)["banned"] <= 0 && $iscd){
				setCookie("cd", time()+30000, time()+30000);
				$jsonF = file_get_contents("data/topic/".$_POST["topic"].".json");
				$jsonD = json_decode($jsonF, true);
				$posts = $jsonD["posts"];
				$newPost = array("title"=>$_POST["title"],"from"=>$_SESSION["ts_user"],"cont"=>$_POST["cont"],"time"=>time(),"com"=>array());
				array_push($jsonD["posts"], $newPost);
				$newj = json_encode($jsonD);
				file_put_contents("data/topic/".$_POST["topic"].".json", $newj);
				$id = count($jsonD["posts"]) - 1;
				echo "Your post has been submitted<a href='view.php?topic=0&post=".$id."'>here</a>.";
				
				
			} else {
				echo "You're banned, probably.";
			}
		}else{
			echo "forums.error.unknown";
		}
	} else {
		echo "Something went wrong.<br />";
		echo "Debug info: ".var_dump($_SERVER["REQUEST_METHOD"]);
	}
