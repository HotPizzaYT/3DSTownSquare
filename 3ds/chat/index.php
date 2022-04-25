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
					console.log(document.getElementById("chatscreen").innerHTML.split("<!--endmsg-->")[0].replace("<br>","<br />"));
					console.log(xhr.responseText);
					if(xhr.responseText !== document.getElementById("chatscreen").innerHTML.split("<!--endmsg-->")[0].replace("<br>","<br />").replace(/"/gi, "'")){
						
						console.log(xhr.responseText);
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
	<body onload="getfullchat(); setInterval(function(){chatload()},1000);">
		<div id="contenttop">
		<a href="../">Back</a> Online List:
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