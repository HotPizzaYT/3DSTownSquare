<?php
session_start();
include_once("process.php");

if(isset($_GET["room"]) && file_exists("data/".$_GET["room"].".json")){
	$jsonF = file_get_contents("data/".$_GET["room"].".json");
	$jsonD = json_decode($jsonF, true);
	// echo $jsonD["msg"][1]["type"];
	foreach($jsonD["msg"] as $key => $message){
		
		
		if($message["visibility"] !== "all"){
			if(isset($_SESSION["ts_user"]) && $_SESSION["ts_user"] == $message["visibility"] && $message["type"] != "rawbr"){
				echo "<span id='".$message["time"]."'><font color='".$message["color"]."'><b><u>".$message["from"].":</u></b></font> ".process($message["cont"])." [To you]</span><br /><!--endmsg-->";
			}
		} else {
			 if($message["type"] === "message" && $message["visibility"] === "all"){
				echo "<span id='".$message["time"]."'><font color='".$message["color"]."'><b><u>".$message["from"].":</u></b></font> ".process($message["cont"])."</span><br /><!--endmsg-->";
			} else if($message["type"] === "rawbr" && $message["visibility"] === "all"){
				echo "<span id='".$message["time"]."'>".$message["cont"]."</span><br /><!--endmsg-->";
			}
		}
		
	}
}