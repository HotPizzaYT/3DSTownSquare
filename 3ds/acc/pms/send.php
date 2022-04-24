<?php
session_start();
if(isset($_SESSION["ts_user"]) && isset($_SESSION["ts_points"])){

?>
<!DOCTYPE html>
<html>
<head>
<title>3DSTownSquare Send PM</title>
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
<?php
if($_SERVER['REQUEST_METHOD'] === 'POST'){ 
	if(file_exists("../data/".$_POST["to"].".json")){
		$jsonF = file_get_contents("../data/".$_POST["to"].".json");
		$jsonD = json_decode($jsonF, true);
		array_unshift($jsonD["pms"], array("subject"=>$_POST["subject"],"from"=>$_SESSION["ts_user"],"cont"=>$_POST["cont"]));
		$jsonFinal = json_encode($jsonD);
		file_put_contents("../data/".$_POST["to"].".json", $jsonFinal);
		// Done sending
?>
<h1>Your PM was sent</h1>
<div style="width: 320px; outline: 1px solid black;">
<b>Subject: <?php echo htmlspecialchars($_POST["subject"]); ?></b><br />
From: <a href="../profile/view.php?pf=<?php echo htmlspecialchars($_SESSION["ts_user"]); ?>"><?php echo htmlspecialchars($_SESSION["ts_user"]); ?></a><br /><br />
<?php echo str_ireplace("\\n", "<br />", htmlspecialchars($_POST["cont"])); ?><br /><br />
</div>
<?php
	} else {
		echo "Invalid user. <a href='send.php'>Try again</a>";
	}
} else {
?>
</div>
<h1>Send PM</h1>
<form action="send.php" method="post">
To who: <input type="text" id="to" name="to" required></br>
Subject: <input type="text" id="sub" name="subject" required></br>
<textarea width="320" height="240" name="cont" placeholder="PM contents here" required></textarea>
<input type="submit" value="Send!">
</form>

</form>

</div>

<?php } ?>
<a href="../">Back</a>
</body>
<?php
} else {
header("Location: ../acc.php");
} ?>