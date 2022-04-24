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
<h1>Welcome to your account.</h1>
<p>Username: <?php echo $_SESSION["ts_user"]; ?></p>
<p>Points: <?php echo $_SESSION["ts_points"]; ?></p>
<li><a href="changePass.php">Change password</a></li>
<li><a href="logout.php">Log out</a></li>
<li><a href="delete.php">Delete my account (WILL BE DELETED FOREVER!)</a></li>
<li><a href="pms/">View my PMs</a></li>
<li><a href="profile/view.php?pf=<?php echo $_SESSION["ts_user"]; ?>">View my profile</a></li>
<li><a href="../">Go back home</a></li>
</body>
<?php
} else {
header("Location: index.php");
} ?>