<?php
// CBR include data 1.0 beta

$cbname = "Esc [DESTINY]";
$cbprefix = "page";
$startsWithZero = true;


$cbPages = 0;

if($startsWithZero){
	$cbPages += 1;
}

$pageText = array(
"Hello! If you're reading this, text and images will be added soon\n\nMake sure to be informed for more updates."
);
$pt = json_encode($pageText);
?>