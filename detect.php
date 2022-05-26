<?php
$isDSi = false;
$width = "320";
$height1 = "215";
$height2 = "240";
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
if(!(isset($noXtraDetect))){
echo "<style>
body {
	font-size: 10px !important;
}
</style>
<script>setTimeout(\"document.body.scrollTop = " . $height1 . ";\", 4000);</script>";
}
if(count(get_included_files()) == 1 && count(get_required_files()) == 1){
	echo "Top screen: ". $width . "x" . $height1 . ", bottom screen: " . $width . "x" . $height2;
}
?>

<?php
// Totally not stolen from Triniate...
function eregi($input, $check)
{
	return strpos(strtolower($check), strtolower($input));
}

// This is a secondary detect system script, used for Venmite

function detect_system()
{
	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	if(eregi('Nintendo 3DS', $_SERVER['HTTP_USER_AGENT']))
	{
		if(eregi('New', $_SERVER['HTTP_USER_AGENT']))
		{
			return 'new3ds';
		}
		return '3ds';
	}
	else if(eregi('mobile', $_SERVER['HTTP_USER_AGENT']))
	{
		return '3ds';
	}
	else
	{
		return 'wiiu';
	}
	if(true)
	{
		
	}
	elseif(eregi('Nintendo DSi', $_SERVER['HTTP_USER_AGENT']))
	{
		return 'dsi';
	}
	elseif(eregi('Nintendo WiiU', $_SERVER['HTTP_USER_AGENT']))
	{
		return 'wiiu';
	}
	else
	{
		return 'pc';
	}
}
?>