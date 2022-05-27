<title>Register</title>
<meta name="viewport" content="width=320">
    <meta name="description" content="Register for an account on 3DSTownSquare!">
<style>
body, html {
	width: 320px;
	margin: 0px;
}
</style> 
<form action="register.php" method="post" enctype="multipart/form-data">
<h1>Register for an account</h1>
<p>Username:</p>
<input type="text" maxlength="16" required name="username" >
<p>Password:</p>
<input type="password" required name="password" >
<p>Email:</p>
<input type="email" required name="email" >
<input type="submit" name="submit" value="Register" >
</form>
<a href="index.php">I already have an account!</a>

<?php

if(isset($_POST["username"]) && $_POST["username"] !== "" && isset($_POST["password"]) && $_POST["password"] !== "" && isset($_POST["email"]) && $_POST["email"] !== ""){
if(!file_exists("data/" . $_POST["username"] . ".json") && !preg_match_all('/([<>\[\]\(\).,\/\\&?$=!%^#* ])/', $_POST["username"]) && strlen($_POST["username"]) >= 3){
	$passHash = password_hash($_POST["password"], PASSWORD_ARGON2ID);
	$date = date('Y/m/d H:i:s');
	$details = array("username" => $_POST["username"], "password" => $passHash, "email" => $_POST["email"], "timezone" => "UTC", "created"=>$date,"createdmt"=>microtime(),"profile"=>"I have not filled this in yet","profilecomments"=>array(),"apps"=>array(),"hasPublishedCB"=>false,"comicbooks"=>array(0),"ownedComics"=>array(),"points"=>30,"cmsg"=>0,"forumPosts"=>array(),"reputation"=>1500,"banned"=>1,"admin"=>0,"ownedApps"=>array(),"drawings"=>array(),"pms"=>array());
	$detailsEncoded = json_encode($details, true);
	file_put_contents("data/" . $_POST["username"] . ".json", $detailsEncoded);
	echo "<p>SUCCESS: Account created successfully!</p>";
	} else if ((strlen($_POST["username"]) <= 3)){
		echo "<p>ERROR: Username cannot be shorter than 3 characters!";
	} else {
		echo "<p>ERROR: That account already exists or contains symbols! (<>[]().,/\\&?$=!%^#*)</p>";
	}
}
?>
