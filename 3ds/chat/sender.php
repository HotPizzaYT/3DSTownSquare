<?php
include_once("functions.php");





	function startsWith ($string, $startString)
	{
		$len = strlen($startString);
		return (substr($string, 0, $len) === $startString);	
	}
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
		
		$userF = file_get_contents("../acc/data/".$_SESSION["ts_user"].".json");
		$userD = json_decode($userF, true);
		if($userD["banned"] == 1 && $userD["banexpire"] <= time()){
			$userD["banned"] = 0;
			$userD["banexpire"] = 0;
			$finalD = json_encode($userD);
			file_put_contents("../acc/data/".$_SESSION["ts_user"].".json");
			
		}
		
		
		if(isset($_SESSION["ts_user"]) && $userD["banned"] != 1){
			// Actually send it
			if(startsWith($_POST["msg"], "/")){
				// This is a command!
				/*
				Types of responses:
				::message;text - Message for client
				::eval;code - Javascript code to execute
				::setmsg;text - Set message box text
				::addmsg;text - Add text to message box
				*/
				if(startsWith($_POST["msg"], "/clear")){
					echo "::eval;getfullchat()";
				}else if(startsWith($_POST["msg"], "/eval ")){
					echo "::eval;".str_replace("/eval ", "",$_POST["msg"]);
				}else if(startsWith($_POST["msg"], "/whisper ")){
					$x = explode(" ", $_POST["msg"]);
					$who = $x[1];
					$msg = strSplit($_POST["msg"], 2, " ");
					if(count($jsonD["msg"])+1 >= strval($jsonD["max"])){
						array_pop($jsonD["msg"]);
					}
					$finalmsg = array("cont"=>$msg[1],"time"=>time(),"type"=>"message","color"=>"red","visibility"=>$who,"from"=>$_SESSION["ts_user"]);
					array_unshift($jsonD["msg"], $finalmsg);
					$jsonString = json_encode($jsonD);
					file_put_contents("data/".$room.".json",$jsonString);
				}else{
					echo "::message;Command \"" . explode(" ", $_POST["msg"])[0] . "\" not found.";
				
				}
				
			} else {
				var_dump(count($jsonD["msg"])+1 >= strval($jsonD["max"]));
				if(count($jsonD["msg"])+1 >= strval($jsonD["max"])){
					array_pop($jsonD["msg"]);
				}
				$finalmsg = array("cont"=>$_POST["msg"],"time"=>time(),"type"=>"message","color"=>"red","visibility"=>"all","from"=>$_SESSION["ts_user"]);
				array_unshift($jsonD["msg"], $finalmsg);
				$jsonString = json_encode($jsonD);
				file_put_contents("data/".$room.".json",$jsonString);
			}
		}
	}
?>
