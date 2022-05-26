<?php
// If I didn't ignore dkey.global and dhook.global, things would be a disaster. That is why Discord keys and Discord webhooks will not be provided.

if(isset($_POST["msg"]) && isset($_POST["usr"]) && isset($_POST["room"])){
	if(!(file_exists("dkey.global")) && !(file_exists("dhook.global"))){
		echo "tunnel.setupfailure";
	} else if(isset($_POST["key"]) && $_POST["key"] == file_get_contents("dkey.global")){
		if(file_exists("data/".$_POST["room"].".json")){
			// Room exists
				// Set needed variables
				$jsonF = file_get_contents("data/".$_POST["room"].".json");
				$jsonD = json_decode($jsonF, true);
				
				if(count($jsonD["msg"])+1 >= strval($jsonD["max"])){
					array_pop($jsonD["msg"]);
				}
				$finalmsg = array("cont"=>$_POST["msg"],"time"=>time(),"type"=>"message","color"=>"red","visibility"=>"dall","from"=>$_POST["usr"]);
				array_unshift($jsonD["msg"], $finalmsg);
				$jsonString = json_encode($jsonD);
		file_put_contents("data/".$_POST["room"].".json",$jsonString);
		} else {
			echo "tunnel.roomnotexistorhooknotexist";
		}
	} else {
		echo "tunnel.security.invalidkey";
	}
}