<?php
session_start();
if(isset($_SESSION["ts_points"]) && isset($_SESSION["ts_user"])){
unset($_SESSION["ts_user"]);
unset($_SESSION["ts_points"]);
session_destroy();
header("Location: index.php");
} else {
// Already logged out.
header("Location: index.php");
}
?>