<?php
session_start();
include_once("process.php");
if(isset($_GET["room"]) && file_exists("data/".$_GET["room"].".json")){
	$jsonF = file_get_contents("data/".$_GET["room"].".json");
	$jsonD = json_decode($jsonF, true);
	// echo $jsonD["msg"][1]["type"];
	if(count($jsonD["msg"]) != 0){
	foreach($jsonD["msg"] as $key => $message){
		
		$toYou = (isset($_SESSION["ts_user"]) && $_SESSION["ts_user"] == $message["visibility"] && $message["type"] != "rawbr");
		if($message["visibility"] !== "all"){
			$color = bin2hex(substr($message["from"], 0, 3));
			if($toYou){
				echo "<span id='".$message["time"]."'><font color='".$color."'><b><u>".$message["from"].":</u></b></font> ".process($message["cont"])." <span class='whisper'>To you</span></span><br /><!--endmsg-->";
			}
			if(isset($_SESSION["ts_user"]) && $message["from"] == $_SESSION["ts_user"] && $message["visibility"] != $_SESSION["ts_user"] && $message["visibility"] != "dall"){
				echo "<span id='".$message["time"]."'><font color='".$color."'><b><u>".$message["from"].":</u></b></font> ".process($message["cont"])." <span class='whisper'>To ".$message["visibility"]."</span></span><br /><!--endmsg-->";
			}
		}
			 if($message["type"] === "message" && $message["visibility"] === "all"){
				$color = bin2hex(substr($message["from"], 0, 3));
				echo "<span id='".$message["time"]."'><font color='".$color."'><b><u>".$message["from"].":</u></b></font> ".process($message["cont"])."</span><br /><!--endmsg-->";
			 } else if($message["type"] === "message" && $message["visibility"] === "dall"){
				$color = bin2hex(substr($message["from"], 0, 3));
				echo "<span id='".$message["time"]."'><img src='discord.png' alt='D' /> <font color='".$color."'><b><u>".$message["from"].":</u></b></font> ".process($message["cont"])."</span><br /><!--endmsg-->";
			
			} else if($message["type"] === "rawbr" && $message["visibility"] === "all"){
				echo "<span id='".$message["time"]."'>".$message["cont"]."</span><br /><!--endmsg-->";
			}
		}
		
	}
	}