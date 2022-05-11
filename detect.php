<?php
$isDSi = false;
$width = "320";
$height1 = "218";
$height2 = "212";
if(strpos($_SERVER["HTTP_USER_AGENT"], "Nintendo DSi") !== false){
	$width = "240";
	$height1 = "176";
	$height2 = "176";
	$isDSi = true;
} else {
	$width = "320";
}
$cbp = (78.125 / 100) * intval($width);
$cbp1 = strval($cbp);
echo "<style>
body {
	font-size: 10px !important;
}
</style>
<script>setTimeout(\"document.body.scrollTop = " . $height1 . ";\", 100);</script>";
if(count(get_included_files()) == 1 && count(get_required_files()) == 1){
	echo "Top screen: ". $width . "x" . $height1 . ", bottom screen: " . $width . "x" . $height2;
}
?>