<?php
session_start();

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=320">
    
<style>
body, html {
	width: 320px;
	margin: 0px;
}
.commentbox {
	width: 200px;
	outline: 1px solid black;
	min-height: 200px;
}
.aqua {
	background-color: #33CCFF;
}
.crow {
	padding-top: 8px;
	padding-bottom: 8px;
	border-bottom: 1px solid black;
}
</style>
</head>
<body onload="loadComments()">
<?php
if(isset($_GET["pf"]) && file_exists("../data/" . $_GET["pf"] . ".json")){
	$jsonF = file_get_contents("../data/".$_GET["pf"].".json");
	$jsonD = json_decode($jsonF, true);
?>
<img src="../../../images/header3ds.png" />
<center>
<script>
function loadComments(){
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if (xhr.readyState == XMLHttpRequest.DONE) {
			console.log(xhr.responseText);
			commentArry = JSON.parse(xhr.responseText);
			if(commentArry.length === 0){
				document.getElementById("comments").innerText="No comments here!";
			} else {
				commentArry.forEach(addComment);
			}
		}
	}
	xhr.open('GET', 'fetchcomments.php?pf=<?php echo $_GET["pf"]; ?>', true);
	xhr.send(null);
}
function addComment(item, index){
	from = commentArry[index]["from"];
	cont = commentArry[index]["cont"];
	var element = document.createElement("div");
	element.classList.add("crow");
	element.innerHTML = from + " says: " + cont;
	document.getElementById("comments").appendChild(element);
	
	
}
</script>

	<img src="default.png">
	<title><?php echo $jsonD["username"]; ?></title>
	<h1><?php echo $jsonD["username"]; ?></h1>
	<meta name="description" content="<?php echo htmlspecialchars($jsonD["profile"]); ?>">
	<p>Created on <?php echo $jsonD["created"]; ?></p>
	<p>Banned: <?php echo $jsonD["banned"]; ?></p>
	<p>Admin: <?php echo $jsonD["admin"]; ?></p>
	<p><?php echo str_ireplace("\\n", "<br />", htmlspecialchars($jsonD["profile"])); ?></p>
	<br /><br />
	<div class="commentbox">
		<div class="aqua">
			Comments
		</div>
		<div id="comments"></div>
	</div>
	<a href="../">Back</a>
</center>
<?php } else { ?>
<title>Error</title>
That person doesn't exist!
<?php } ?>
</body>
