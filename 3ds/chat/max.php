<?php
	session_start();
	if(isset($_GET["room"])){
		if(file_exists("data/".$_GET["room"].".json")){
			$room = $_GET["room"];
			$jsonF = file_get_contents("data/".$_GET["room"].".json");
		} else {
			$room = "original";
			$jsonF = file_get_contents("data/original.json");
		}
		$jsonD = json_decode($jsonF, true);
		echo $jsonD["max"];
	}
?>
