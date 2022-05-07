<?php
// CBR include data 1.0 beta

$cbname = "Then and Now";
$cbprefix = "page";
$startsWithZero = true;


$cbPages = 1;

if($startsWithZero){
	$cbPages += 1;
}

$pageText = array(
"We'll be back, Toby.
p-please, don't leave me

We have to, Toby

NO! PLEASE!!

Please, don't leave...",
"THEN AND NOW\nCHAPTER 1\nBITTER MEDICINE OF THE PAST\n\n\n\nhic...\nsob...\nmommy...\ndaddy...\n\n\n\nMore of the comic is coming soon!");
$pt = json_encode($pageText);
?>