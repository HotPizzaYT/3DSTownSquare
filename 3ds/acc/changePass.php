<?php
session_start();
if(isset($_SESSION["ts_user"]) && isset($_SESSION["ts_points"]) && !isset($_POST["old"]) && !isset($_POST["new"])){

?>
<meta name="viewport" content="width=320">
    <meta name="description" content="this wont ever show up anywhere!!!">
<style>
body, html {
	width: 320px;
	margin: 0px;
}
</style> 
<title>Change password</title>
<form action="changePass.php" method="post" enctype="multipart/form-data">
<h1>Change your password</h1>
<p>Old password</p>
<input type="password" name="old" required>
<p>New password</p>
<input type="password" name="new" required>
<p><input type="submit" name="submit" value="Change password"></p>
</form>

<a href="acc.php">Nevermind</a>
<?php
} else {
if(isset($_POST["old"]) && isset($_POST["new"])){
// Code to change password!
$json = file_get_contents("data/" . $_SESSION["ts_user"] . ".json");
$jsonD = json_decode($json, true);
$passHash = $jsonD["password"];
if(password_verify($_POST["old"], $passHash)){
// Password verified!
// Set the brand new password
$jsonD["password"] = password_hash($_POST["new"], PASSWORD_ARGON2ID);
$newAccDetails = json_encode($jsonD);
file_put_contents("data/" . $_SESSION["ts_user"] . ".json", $newAccDetails);
echo "Congratulations, your brand new password is \"" . $_POST["new"] . "\"!";
echo "<br />You will now be logged out for security reasons.";
unset($_SESSION["ts_user"]);
unset($_SESSION["ts_points"]);


} else {
echo "Wrong password. <a href='changePass.php'>Click here to try again</a>";
}

} else {
  // Not logged in!
header("Location: index.php");
}
} ?>
