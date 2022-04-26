<title>Error 403</title>
<?php
$rand = array("It looks like you're in our images. What are you doing here?","What are you doing here?","Are you sure you're supposed to be here?","Oops! You must have been redirected to this URL by accident, <a href='../3ds/'>go home</a>!");
echo $rand[array_rand($rand)];