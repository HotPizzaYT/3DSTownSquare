<?php
session_start();
if(isset($_SESSION["ts_user"]) && isset($_SESSION["ts_points"]) && isset($_GET["id"])){

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
<h1>View PM</h1>
<?php
$jsonF = file_get_contents("../data/" . $_SESSION["ts_user"] . ".json");
$jsonD = json_decode($jsonF, true);
$pm = $jsonD["pms"][$_GET["id"]];
?>
<div style="width: 320px; outline: 1px solid black;">
<b>Subject: <?php echo htmlspecialchars($pm["subject"]); ?></b><br />
From: <a href="../profile/view.php?pf=<?php echo htmlspecialchars($pm["from"]); ?>"><?php echo htmlspecialchars($pm["from"]); ?></a><br /><br />
<?php echo str_ireplace("\\n", "<br />", htmlspecialchars($pm["cont"])); ?><br /><br />

</div>
<a href="index.php">Back</a>
</body>
<?php
} else {
header("Location: ../acc.php");
} ?>