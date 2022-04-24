<?php
session_start();
if(isset($_SESSION["username"]) && isset($_SESSION["email"])){

?>
<title>Deleting your account</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<h1>Deleting your account</h1>
<p>Are you sure you want to delete account "<?php echo $_SESSION["username"]; ?>" with email "<?php echo $_SESSION["email"] ?>"?</p>
<p><a href="reallyDelete.php">Yes</a> - <a href="acc.php">No</a>
<?php
} else {
header("Location: index.php");
} ?>
