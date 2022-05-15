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
		<script src="burger.js"></script>
		<style>
			body {
				position: relative;
				margin: 0px;
				width: 240px;
				background-color: #ffffff;
				font-size: 12px;
			}
			#contenttop {
				position: relative;
				background-color: <?php echo $jsonD["color"] ?>;
				height: 176px;
			}
			.conttop {
				background-color: #f0f0f0;
				height: 138px;
			}
			#contentbot {
				background-color: #f0f0f0;
				height: 176px;
				background-color: <?php echo $jsonD["color"] ?>;
			}
			#chatscreen {
				font-size: 10px;
				height: 160px;
				background-color: #ffffff;
				overflow-y: scroll;
				overflow-x: hidden;
			}
			.scrollable {
				overflow-y: scroll;
			}
			.test {
				height: 138px;
			}
			.h200 {
				height: 123px;
				background-color: #fff;
			}
			#msg {
				width: 272px;
			}
			.whisper{
				background-color: #00FFFF;
			}
			b {
				font-weight: heavy;
			}
		</style>
		
		<!-- Insert polyfill -->
		<script type="text/javascript" src="https://polyfill.io/v3/polyfill.min.js?features=XMLHttpRequest%2CMediaQueryList.prototype.addEventListener"></script>
		<script type="text/javascript">
			function lc(xhr){
				document.getElementById("chatscreen").innerHTML = (xhr.responseText);
			}
			function getfullchat(){
				var xhr = new XMLHttpRequest();
				// xhr.onload = lc;
				xhr.onreadystatechange = function(){
					if(this.readyState == 4 && this.status == 200){
						lc(xhr);
					}
				}
				xhr.open('GET', 'innerch.php?room=<?php echo $room ?>', true);
				xhr.send(null);
			}
			function getIcons(){
				var xhr = new XMLHttpRequest();
				xhr.onreadystatechange = function() {
				if (xhr.readyState == 4 && xhr.status == 200) {
					document.getElementById("nav").innerHTML = (xhr.responseText);
				}
				};
				xhr.open('GET', 'icons.php', true);
				xhr.send(null);
			}
			function repos(){
				scroll = document.getElementById("chatscreen").scrollTop;
				document.getElementById("nav").innerHTML = document.getElementById("chatscreen").innerHTML;
				document.getElementById("nav").scrollTop = scroll;
			}
			/*
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
			
			/*
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
			*/
			function sendmess(){
				x = document.getElementById("msg").value;
				if(document.getElementById("msg").value != "" || document.getElementById("msg").value == null){
					var http = new XMLHttpRequest();
					var url = 'sender.php';
					var params = 'msg='+encodeURIComponent(x)+"&&room=<?php echo $room; ?>";
					http.open('POST', url, true);

					//Send the proper header information along with the request
					http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
					document.getElementById("msg").value = "";
					http.onreadystatechange = function() {//Call a function when the state changes.
						if(http.readyState == 4 && http.status == 200) {
							// We don't need to do anything with the response text.
							// alert(http.responseText);
							
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
				// repos();
				if(event.keyCode === 13){
					sendmess();
				}
			}
			function x(){
				getfullchat();
			}
			speed = 10;
			function scrollup(){
				if(scrolling=='yes'){
					scroll = document.getElementById("chatscreen").scrollTop - speed;
					document.getElementById("chatscreen").scrollTop = scroll;
					speed = speed + 2;
					setTimeout("scrollup()", 100);
				} else {
					speed = 10;
				}
			}
			scrolling = "no";
			function scrolldown(){
				if(scrolling=='yes'){
					scroll = document.getElementById("chatscreen").scrollTop + speed;
					document.getElementById("chatscreen").scrollTop = scroll;
					speed = speed + 2;
					setTimeout("scrolldown()", 100);
				} else {
					speed = 10;
				}
			}
			x();
		</script>
		<title>3DSTownSquare</title>
		<meta name="viewport" content="width=240">
		<meta name="description" content="3DSTownSquare Timezone Settings">
	</head>
	<!-- I had to set it to normal full long polling because this IN MY HAIR code keeps repeating latest message -->
	<body onload="getIcons(); setInterval(getfullchat, 1000);">
		<div id="contenttop" class="conttop">
		<a href="../../">Back</a><br/>
		<div id="chatscreen" class="scrollable h200">Loading chat...</div>
		</div>
		<div id="contentbot">
		<div id="nav" class="scrollable test">Loading nav</div>
<?php if(isset($_SESSION["ts_user"])){?><input onclick="" onfocus="" id="msg" style="width: 120px" onkeydown="check(event)"></input><button onclick="sendmess()">Send</button>
- <img src="u.png" onmousedown="scrolling='yes'; scrollup()" onmouseup="scrolling='no';" onmouseout="scrolling='no'" /> <img src="d.png" onmousedown="scrolling='yes'; scrolldown()" onmouseup="scrolling='no';" onmouseout="scrolling='no'" />
<?php } else { ?> You have to be logged in! <a href="../acc/index.php">Login here</a><?php }?>
		</div>
<?php } else {
	header("Location: index.php?room=original");
}
	?>
	</body>
</html>