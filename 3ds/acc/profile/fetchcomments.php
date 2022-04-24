<?php
if(isset($_GET["pf"]) && file_exists("../data/" . $_GET["pf"] . ".json")){
	$jsonF = file_get_contents("../data/".$_GET["pf"].".json");
	$jsonD = json_decode($jsonF, true);
	$x = json_encode($jsonD["profilecomments"]);
	echo $x;
} else {
	echo "[]";
}