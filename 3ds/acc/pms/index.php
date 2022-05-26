<?php
session_start();
if(isset($_SESSION["ts_user"]) && isset($_SESSION["ts_points"])){

?>
<!DOCTYPE html>
<html>
<head>
<title>3DSTownSquare Accounts</title>
<meta name="viewport" content="width=320">
    <meta name="description" content="this wont ever show up anywhere!!!">
<style>
body, html {
	width: 320px;
	margin: 0px;
}
</style> 
</head>
<body>
<h1>Your PMs</h1>
<center><a href="send.php">Send a PM</a></center>
<?php
$jsonF = file_get_contents("../data/" . $_SESSION["ts_user"] . ".json");
$jsonD = json_decode($jsonF, true);
if(count($jsonD["pms"]) !== 0){
	foreach($jsonD["pms"] as $val=>$pmcont){
		echo "<a href='view.php?id={$val}'>\"{$pmcont["subject"]}\" from \"{$pmcont['from']}\"</a><br />";
	}
} else {
	echo "You have no PMs!";
}
?>
<br/>
<br/>
<a href="../">&lt; &lt; Back</a>
</body>
<?php
} else {
header("Location: index.php");
} ?>