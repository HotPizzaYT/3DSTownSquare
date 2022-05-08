<?php
// CBR include data 1.0 beta

$cbname = "Then and Now";
$cbprefix = "page";
$startsWithZero = true;


$cbPages = 6;

if($startsWithZero){
	$cbPages += 1;
}

$pageText = array(
"We'll be back, Toby.
p-please, don't leave me

We have to, Toby

NO! PLEASE!!

Please, don't leave...",
"THEN AND NOW\nCHAPTER 1\nBITTER MEDICINE OF THE PAST\n\n\n\nhic...\nsob...\nmommy...\ndaddy...\n\n\n\nMore of the comic is coming soon!",
"Toby, your parents aren't going to return

HOLD ON

How do you know that *ramble* *ramble*

No, it's right

AUTHOR'S NOTE:

Page 3. I hand wrote these panels out by hand. These strange creatures are only imaginary beings thought up by Toby's mind. They are often referred to as it because they aren't really Toby's imaginary friends and that they're hallucinations caused by the child. 
Madness Combat is owned by Krinkels. Then and Now is written and drawn by Rachel Medic aka \"OmegaReploid\"",
"Maybe his parents are dead and...
He's going to die.

I hope someone finds him",
"Rachel Medic has yet to add a description to this panel...",
"<!-- page5.png -->
*BANG*

THERE'S A CHILD IN HERE!

Author's note:

The child! Originally, I was going to have him open his eyes, but I prefer his eyes closed. 
Madness Combat is owned by Krinkels 
Then and Now, The Flames of Anger will soon die out is written and drawn by OmegaReploid",
"hmmm... maybe Ares was right after all

Author's note:

This is the last time we'll see the Auditor, which is a major bummer. This \"Ares\" the Auditor mentions is a character from my other works \"The Flames of Anger (Will soon die out)\" and is the man that two other characters, who will appear, are cloned after. Ares will not appear in Then and Now at all. 

This is the last outdoors scene for this chapter.

So the Auditor's text is based off of MC10, without the weird glitchy lines. 

Also, yes, that is hints of bluud

Madness Combat is owned by Krinkles");

$pt = json_encode($pageText);
?>