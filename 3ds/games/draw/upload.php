<?php
error_reporting(E_ALL);
session_start();
if(isset($_POST["i"]) && isset($_POST["t"]) && isset($_SESSION["ts_user"])){
	$data = $_POST["i"];
	$isLimit = (strlen($_POST["t"]) <= 32);
	if($isLimit){
		
		$id = rand(1000,3999);
		$arry = array("from"=>$_SESSION["ts_user"],"time"=>time(),"src"=>"default","title"=>$_POST["t"]);
		$aencode = json_encode($arry);
		if(!(file_exists("data/".$id.".json"))){
			file_put_contents("data/".$id.".json",$aencode);
			list($type, $data) = explode(';', $data);
			list(, $data)      = explode(',', $data);
			$png = base64_decode($data);

			file_put_contents('out/'.$id.'.png', $png);
		} else {
			echo "file_exists";
		}
	} else {
		echo "title2long";
	}
	
} else {
	echo "notSetOrNotLoggedIn";
}
