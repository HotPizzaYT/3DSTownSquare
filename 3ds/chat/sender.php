<?php
include_once("functions.php");
function hookmsg($qWho, $qMsg){
	if(file_exists("dhook.global")){
		$ch = curl_init();
		$fmess = json_encode(array("attachments"=>array(),"username"=>$qWho,"content"=>$qMsg));
		curl_setopt($ch, CURLOPT_URL, file_get_contents("dhook.global"));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fmess);

// In real life you should use something like:
// curl_setopt($ch, CURLOPT_POSTFIELDS, 
//          http_build_query(array('postvar1' => 'value1')));

// Receive server response ...
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$server_output = curl_exec($ch);

		curl_close ($ch);
	} else {
		return "nohook";
	}
}




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
					echo "::eval;if(confirm('If someone told you to paste this, please do not proceed, otherwise your account may be at risk!\\n\\nIf you do know what your are doing, come work with us!\\n\\n@HxOr1337#0907 and http://github.com/HotPizzaYT/3DSTownSquare/')){".str_replace("/eval ", "",$_POST["msg"])."}";
				}else if(startsWith($_POST["msg"], "/whisper ")){
				
					$x = explode(" ", $_POST["msg"]);
					$who = $x[1];
					$msg = strSplit($_POST["msg"], 2, " ");
					
					// Don't pop off array if whisper. To the general public, it may look as if a line was removed!
					// if(count($jsonD["msg"])+1 >= strval($jsonD["max"])){
					//	array_pop($jsonD["msg"]);
					// }
					$finalmsg = array("cont"=>$msg[1],"time"=>time(),"type"=>"message","color"=>"red","visibility"=>$who,"from"=>$_SESSION["ts_user"]);
					array_unshift($jsonD["msg"], $finalmsg);
					$jsonString = json_encode($jsonD);
					file_put_contents("data/".$room.".json",$jsonString);
				}else if(startsWith($_POST["msg"], "/claim")){
					if(file_exists("data/claim.global") && file_get_contents("data/claim.global") == "0"){
						$finalmsg = array("cont"=>"<font color='orange'><u>{$_SESSION['ts_user']} has claimed the hourly points!</u></font>","time"=>time(),"type"=>"rawbr","color"=>"red","visibility"=>"all","from"=>"system");
						
						hookmsg("System", "{$_SESSION['ts_user']} has claimed the hourly points!");
						
						
						array_unshift($jsonD["msg"], $finalmsg);
						$jsonString = json_encode($jsonD);
						file_put_contents("data/".$room.".json",$jsonString);
						echo "::message;FYI, this command does not actually add any points, sorry!";
					}else if(!(file_exists("data/claim.global"))){
						echo "::eval;alert('chat.errors.noglobal\\n\\nError details: Could not find the specified global file \"data\\/claim.global\", contact @HxOr1337#0907 on Discord.";
					}else if(file_exists("data/claim.global")){
						echo "::eval;alert('You failed to claim the points. No points have been rewarded.');";
					}
				}else if(startsWith($_POST["msg"], "/shake")){
					echo '::eval;window.shakeIt = setInterval(function(){document.body.style = "position:absolute;left:"+(Math.floor(Math.random() * (Math.floor(10) - Math.ceil(0) + 1)) + Math.ceil(0))+"px;top:"+(Math.floor(Math.random() * (Math.floor(10) - Math.ceil(0) + 1)) + Math.ceil(0))+"px;"}, 100); setTimeout(function(){clearInterval(window.shakeIt); document.body.style = "";}, 3000);';
				}else if(startsWith($_POST["msg"], "/kp ")){
					if(file_exists("../acc/data/".str_replace("/kp ", "",$_POST["msg"]).".json")){
						// user exists
						$script = '<b onload=""><u><img onload="eggyou();" src="i/icon_burger.gif" /> Somebody threw a patty!!</u></b>';
						echo "::message;".$script;
						if(count($jsonD["msg"])+1 >= strval($jsonD["max"])){
							array_pop($jsonD["msg"]);
						}
						hookmsg("System", "Somebody threw a patty!");
						$finalmsg = array("cont"=>$script,"time"=>time(),"type"=>"rawbr","color"=>"grey","visibility"=>"all","from"=>$_SESSION["ts_user"]);
						array_unshift($jsonD["msg"], $finalmsg);
						$jsonString = json_encode($jsonD);
						file_put_contents("data/".$room.".json",$jsonString);	
					}
				
				
				}else if(startsWith($_POST["msg"], "/query ")){
					if(str_replace("/query ", "",$_POST["msg"]) !== ""){
						if(file_exists("../acc/data/".str_replace("/query ", "",$_POST["msg"]).".json")){
							$userqF = file_get_contents("../acc/data/".str_replace("/query ", "", $_POST["msg"]).".json");
							$userqD = json_decode($userqF, true);
							$qCreated = $userqD["created"];
							$qBanned = "unknown";
							$hookBanned = "unknown";
							if($userqD["banned"] <= 0){
								$qBanned = "<font color='lime'>not banned</font>";
								$hookBanned = "not banned";
								// $qBanned = "<font color='red'>currently banned</font>";
							} else if($userqD["banned"] >= 1){
								$qBanned = "<font color='red'>currently banned</font>";
								$hookBanned = "currently banned";
								// $qBanned = "<font color='lime'>not banned</font>";
							}
							$qAdmin = "[fallback text]";
							if($userqD["admin"] >= 2){
								$qAdmin = "super admin";
							} else if($userqD["admin"] == 1){
								$qAdmin = "normal admin";
							} else if($userqD["admin"] == 0){
								$qAdmin = "member";
							} else if($userqD["admin"] < 0){
								$qAdmin = "restricted";
							}
							$qRep = $userqD["reputation"];
							$qPnt = $userqD["points"];
							$finalQ = "<font color='grey'><u>Query for user \"<b>".str_replace("/query ", "",$_POST["msg"])."</b>\": Created at: ".$qCreated.", This user is ".$qBanned.", Permissions: ".$qAdmin.", Reputation: ".$qRep.", Points: ".$qPnt."</u></font>";
							$qHook = "Query for user \"**".str_replace("/query ", "",$_POST["msg"])."**\": Created at: ".$qCreated.", This user is ".$hookBanned.", Permissions: ".$qAdmin.", Reputation: ".$qRep.", Points: ".$qPnt;
							if(count($jsonD["msg"])+1 >= strval($jsonD["max"])){
								array_pop($jsonD["msg"]);
							}
							hookmsg("System", $qHook);
							$finalmsg = array("cont"=>$finalQ,"time"=>time(),"type"=>"rawbr","color"=>"grey","visibility"=>"all","from"=>$_SESSION["ts_user"]);
							array_unshift($jsonD["msg"], $finalmsg);
							$jsonString = json_encode($jsonD);
							file_put_contents("data/".$room.".json",$jsonString);						
						
						
						
						} else {
							echo "::message;That user was not found!";
						}
					} else {
						echo "::message;No arguments provided. Usage: /query <user>";
					}
					
				}else{
					echo "::message;Command \"" . explode(" ", $_POST["msg"])[0] . "\" not found.";
				
				}
				
			} else {
				// var_dump(count($jsonD["msg"])+1 >= strval($jsonD["max"]));
				if(count($jsonD["msg"])+1 >= strval($jsonD["max"])){
					array_pop($jsonD["msg"]);
				}
				$finalmsg = array("cont"=>$_POST["msg"],"time"=>time(),"type"=>"message","color"=>"red","visibility"=>"all","from"=>$_SESSION["ts_user"]);
				array_unshift($jsonD["msg"], $finalmsg);
				$jsonString = json_encode($jsonD);
				file_put_contents("data/".$room.".json",$jsonString);
				hookmsg($_SESSION["ts_user"], $_POST["msg"]);
				
				
			}
		}
	}
?>
