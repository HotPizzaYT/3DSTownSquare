<meta name="viewport" content="width=320">
<style>
body, html {
	width: 320px;
	margin: 0px;
}
</style>
<?php
session_start();
if(isset($_SESSION["ts_user"]) && isset($_SESSION["ts_points"])){

if(file_exists("data/" . $_SESSION["ts_user"] . ".json")){
	unlink("data/" . $_SESSION["ts_user"] . ".json");
}

unset($_SESSION["ts_user"]);
unset($_SESSION["ts_points"]);
?>
Account deleted.
<?php } else { ?>
You don't have an account!
<?php } ?>
