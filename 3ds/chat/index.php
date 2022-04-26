<?php
session_start();
if(isset($_GET["room"])){
	if(file_exists("data/".$_GET["room"].".json")){
		$room = $_GET["room"];
		$jsonF = file_get_contents("data/".$_GET["room"].".json");
	} else {
		$room = "original";
		$jsonF = file_get_contents("data/original.json");
	}
	$jsonD = json_decode($jsonF, true);

?>

<html>
	<head>
		<style>
			body {
				margin: 0px;
				width: 320px;
				background-color: #fffff;
				font-size: 12px;
			}
			#contenttop {
				background-color: #f0f0f0;
				height: 208px;
			}
			
			#contentbot {
				background-color: #f0f0f0;
				height: 222px;
				background-color: <?php echo $jsonD["color"] ?>;
			}
			#chatscreen {
				height: 200px;
				background-color: #ffffff;
				overflow-y: scroll;
			}
			#msg {
				width: 272px;
			}
			.whisper{
				background-color: #00FFFF;
			}
		</style>
		
		<!-- Insert polyfill -->
		<script src="https://polyfill.io/v3/polyfill.min.js?features=Promise%2CPromise.allSettled%2CPromise.any%2CPromise.prototype.finally"></script>
		<script>
			function getfullchat(){
				var xhr = new XMLHttpRequest();
				xhr.onreadystatechange = function() {
				if (xhr.readyState == XMLHttpRequest.DONE) {
					document.getElementById("chatscreen").innerHTML = (xhr.responseText);
				}
				};
				xhr.open('GET', 'innerchat.php?room=<?php echo $room ?>', true);
				xhr.send(null);
			}
			function chatload(){
				var xhr = new XMLHttpRequest();
				xhr.onreadystatechange = function() {
				if (xhr.readyState == XMLHttpRequest.DONE) {
					last="";
					console.log("Hey: "+(document.getElementById("chatscreen").innerHTML.split("<!--endmsg-->")[0].replace("<br>","<br />").replace(/"/gi, "'").endsWith("<!--endmsg-->")));
					if((document.getElementById("chatscreen").innerHTML.split("<!--endmsg-->")[0].replace("<br>","<br />").replace(/"/gi, "'").endsWith("<!--endmsg-->"))){
						console.log("Chatscreen has no endmsg!");
						
					}
					last = "<!--endmsg-->";
					console.log("Fixed: " + document.getElementById("chatscreen").innerHTML.split("<!--endmsg-->")[0].replace("<br>","<br />").replace(/"/gi, "'")+last);
					console.log("This must be true always: true");
					// console.log("XHR: " + xhr.responseText);
					
					if(!(document.getElementById("chatscreen").innerHTML.split("<!--endmsg-->")[0].replace("<br>","<br />").replace(/"/gi, "'").endsWith("<!--endmsg-->"))){
						chatInner = document.getElementById("chatscreen").innerHTML.split("<!--endmsg-->")[0].replace("<br>","<br />").replace(/"/gi, "'")+"<!--endmsg-->";
					} else {
						chatInner = document.getElementById("chatscreen").innerHTML.split("<!--endmsg-->")[0].replace("<br>","<br />").replace(/"/gi, "'");
					}
					if(xhr.responseText.replace(/' \/>/gi, "'>").replace(/\x3C/gi, "<") != chatInner){
						
						console.log("XHR: " + xhr.responseText.replace(/' \/>/gi, "'>")+last);
						document.getElementById("chatscreen").innerHTML = xhr.responseText+ "<!--endmsg-->" + document.getElementById("chatscreen").innerHTML;
						getMax().then(res => {window.maxMsg = res});
						if(window.maxMsg <= document.getElementById("chatscreen").innerHTML.split("<!--endmsg-->").length){
							getfullchat();
						}
					} else {
						console.log("No new chat updates");
					}
				}
				};
				xhr.open('GET', 'latest.php?room=<?php echo $room ?>', true);
				xhr.send(null);
			}
			function getMax(){
			return new Promise((resolve) => {
				var xhr = new XMLHttpRequest();
				xhr.onreadystatechange = function() {
				if (xhr.readyState == XMLHttpRequest.DONE) {
						resolve(xhr.responseText);
					}
				};
				xhr.open('GET', 'max.php?room=<?php echo $room ?>', false);
				xhr.send(null);
			});
			}
			function sendmess(){
				x = document.getElementById("msg").value;
				if(document.getElementById("msg").value != "" || document.getElementById("msg").value == null){
					var http = new XMLHttpRequest();
					var url = 'sender.php';
					var params = 'msg='+encodeURIComponent(x)+"&&room=<?php echo $room; ?>";
					http.open('POST', url, true);

					//Send the proper header information along with the request
					http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

					http.onreadystatechange = function() {//Call a function when the state changes.
						if(http.readyState == 4 && http.status == 200) {
							// We don't need to do anything with the response text.
							// alert(http.responseText);
							document.getElementById("msg").value = "";
							if(http.responseText.startsWith("::message;")){
								alert(http.responseText.replace("::message;",""));
							}
							if(http.responseText.startsWith("::eval;")){
								eval(http.responseText.replace("::eval;",""));
							}
							
						}
					};
					http.send(params);
				} else {
					console.log("Got empty textbox");
				}
				
			}
			function check(event){
				if(event.keyCode === 13){
					sendmess();
				}
			}
		</script>
		<title>3DSTownSquare</title>
		<meta name="viewport" content="width=320">
		<meta name="description" content="3DSTownSquare Timezone Settings">
	</head>
	<!-- I had to set it to normal full long polling because this IN MY HAIR code keeps repeating latest message -->
	<body onload="getfullchat(); setInterval(function(){getfullchat()},1000);">
		<div id="contenttop">
		<a href="../">Back</a><br/>
		<iframe src="icons.php" width="316" height="190" frameborder="0"></iframe>
		</div>
		<div id="contentbot">
		<div id="chatscreen"></div>
<?php if(isset($_SESSION["ts_user"])){?><input id="msg" onkeydown="check(event)"></input><button onclick="sendmess()">Send</button><?php } else { ?> You have to be logged in! <a href="../acc/index.php">Login here</a><?php }?>
		</div>
<?php } else {
	header("Location: index.php?room=original");
}
	?>
	</body>
</html>