<?php
if($_SERVER['REQUEST_METHOD'] === 'POST'){
if(isset($_POST["ts_user"]) && isset($_POST["password"])){
	if(file_exists("data/" . $_POST["ts_user"] . ".json")){
		// echo "User exists<br />";
		$json = file_get_contents("data/" . $_POST["ts_user"] . ".json");
		$jsonD = json_decode($json, true);
		if(password_verify($_POST["password"], $jsonD["password"])){
// Initiate page.
			session_start();
			$_SESSION["ts_user"] = $jsonD["username"];
			$_SESSION["ts_points"] = $jsonD["points"];
			$_SESSION["email"] = $jsonD["email"];
			header("Location: acc.php");
			echo "<script>window.location = 'acc.php';</script>";
		} else {
			header("Location: index.php?err=2");
			echo "<script>window.location = 'index.php?err=2';</script>";
		}
		
	} else {
		header("Location: index.php?err=3");
		
		echo "<script>window.location = 'acc.php?err=3';</script>";
	}
	
} else {
}
}
