<?php
session_start();
if(isset($_SESSION["ts_user"]) && isset($_SESSION["ts_points"])){
header("Location: acc.php");
}





?>
<head>
<meta name="viewport" content="width=320">
<style>
body, html {
	width: 320px;
	margin: 0px;
}
</style>
<script language="javascript" type="text/javascript">
function login(u, p){
	document.getElementById("un").value = u;
	document.getElementById("pw").value = p;
	document.getElementById("login").click();
	void(0);
}
</script>
<!-- Remove WeInRe script -->
<title>3DSTownSquare Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<form action="index.php" method="post" enctype="multipart/form-data">
<h1>3DSTownSquare Login</h1>
<p>Username:</p>
<input type="text" id="un" maxlength="16" required name="ts_user" >
<p>Password:</p>
<input type="password" id="pw" required name="password" >
<input type="submit" id="login" name="submit" value="Log in" >
</form>
<a href="register.php">I don't have an account!</a>
<br />
<?php
if($_SERVER['REQUEST_METHOD'] === 'POST'){
if(isset($_POST["ts_user"]) && isset($_POST["password"])){
	if(file_exists("data/" . $_POST["ts_user"] . ".json")){
		// echo "User exists<br />";
		$json = file_get_contents("data/" . $_POST["ts_user"] . ".json");
		$jsonD = json_decode($json, true);
		if(password_verify($_POST["password"], $jsonD["password"])){
// Initiate page.
			session_start();
			$_SESSION["ts_user"] = $jsonD["username"];
			$_SESSION["ts_points"] = $jsonD["points"];
			$_SESSION["email"] = $jsonD["email"];
			header("Location: acc.php");
			echo "<script>window.location = 'acc.php';</script>";
		} else {
			header("Location: index.php?err=2");
			echo "<script>window.location = 'index.php?err=2';</script>";
		}
		
	} else {
		header("Location: index.php?err=3");
		
		echo "<script>window.location = 'acc.php?err=3';</script>";
	}
	
} else {
}
}





if(isset($_GET["err"])){
	if($_GET["err"] === "1"){
		// This will most likely never happen unless the user goes to log.php in their browser.
		echo "Error: You did not fill in all forms";
	}
	if($_GET["err"] === "2"){
		echo "Error: Invalid password";
	}
	if($_GET["err"] === "3"){
		echo "Error: That account does not exist";
	}
}
?>
</body>
