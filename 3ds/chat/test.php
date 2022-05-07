<?php
$threeds = true;
if(strpos($_SERVER["HTTP_USER_AGENT"], "Nintendo DSi") !== false){
	$threeds = false;
} else {
	// Is using 3DS
}
?>