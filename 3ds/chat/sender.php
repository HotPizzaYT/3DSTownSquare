<?php
	session_start();
	if(isset($_POST["room"])){
		if(file_exists("data/".$_POST["room"].".json")){
			$room = $_POST["room"];
			$jsonF = file_get_contents("data/".$_POST["room"].".json");
		} else {
			$room = "original";
			$jsonF = file_get_contents("data/original.json");
		}
		$jsonD = json_decode($jsonF, true);
		if(isset($_SESSION["ts_user"])){
			// Actually send it
			$finalmsg = array("cont"=>$_POST["msg"],"time"=>time(),"type"=>"message","color"=>"red","visibility"=>"all","from"=>$_SESSION["ts_user"]);
			array_unshift($jsonD["msg"], $finalmsg);
			$jsonString = json_encode($jsonD);
			file_put_contents("data/".$room.".json",$jsonString);
		}
	}
?>
