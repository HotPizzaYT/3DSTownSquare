<?php
session_start();
include("../../../detect.php");
if($isDSi){
	$cheight = "132";
} else {
	$cheight = "240";
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=<?php echo $width; ?>">
		
		<script>
			function color(x){
				x = x.replace(/\\\[31m/g, "<font color='red'>");
				x = x.replace(/\\\[30m/g, "<font color='black'>");
				x = x.replace(/\\\[32m/g, "<font color='green'>");
				x = x.replace(/\\\[33m/g, "<font color='yellow'>");
				x = x.replace(/\\\[34m/g, "<font color='blue'>");
				x = x.replace(/\\\[35m/g, "<font color='magenta'>");
				x = x.replace(/\\\[36m/g, "<font color='cyan'>");
				x = x.replace(/\\\[31m/g, "<font color='white'>");
				x = x.replace(/\\\[0m/g, "</font>");
				// console.log(x);
				return x;
				
			}
			window.isDestroy = false;
			function type(x, id, f){
				id = document.getElementById(id);
				window.i = 0;
				id.innerHTML = "";
				typex(x.length, x, id, f);
			}
			function typex(len, x, id, f){
				setTimeout(function(){
					id.innerHTML += x.charAt(i);
					window.i++
					if(window.i < len){
						typex(len, x, id, f);
					} else {
						setTimeout(function(){eval(f)}, 10);
						// eval(f);
					}
				},50);
			}
			function output(out){
				if(document.getElementById("previous").innerHTML !== ""){
					brsp = "<br />";
				} else {
					brsp = "";
				}
				previous.innerHTML += brsp + currentline.innerHTML.replace(/<span id=\"/gi, "<span class=\"") + "<br />" + color(out);
				document.getElementById("cmd").innerHTML = "";
				document.getElementById("tops").scrollTop = Infinity;
			}
			// Now time for commands
			function destroy(){
				if(!(window.isDestroy)){
					type('sudo rm -rfv --no-preserve-root /', "cmd", 'window.isDestroy = true; output("haxxed by haxors!!!!")');
				} else {
					output("lol no, you already destroyed this pc, or i mean... simulator");
				}
				
			}
			function echo(){
				window.echoprompt = prompt("What do you want to echo? Escape sequences like \\[31m (red) are supported");
				type("echo \""+window.echoprompt.replace(/\"/g, "\\\"")+"\"", "cmd", "output(window.echoprompt)");
			}
		</script>
		<style>
			body {
				font-family: monospace;
				background-color: #fff;
				font-size: 10px;
				color: #fff;
				margin: 0px;
				width: <?php echo $width; ?>px;
				height: <?php echo $height2;?>px;
			}
			.screen {
				background-color: #000;
			}
			#tops {
				height: <?php echo $height1; ?>px;
				overflow-y: scroll;
			}
			#bots {
				height: <?php echo $height2; ?>px;
			}
			.system {
				color: #80DC31
			}
			.dir {
				color: #6C9CCE;
			}
			.btn {
				background-color: #f0f0f0;
				color: #000;
				user-select: none;
			}
			.btn:active {
				background-color: #e0e0e0;
			}
		</style>

		<title>*nix Simulator</title>
	</head>
	<body>
		<div class="screen" id="tops">
		<div id="previous"></div>
		<div id="currentline"><b><span class="system">root@nixsim</span>:<span class="dir">~</span><span id="mode">#</span>&nbsp;</b><span id="cmd"></span></div>
		</div>
		<div class="screen" id="bots">
		<center>
			<span class="btn" onclick="destroy()">Destroy</span> - 
			<span class="btn" onclick="echo()">Echo</span> - 
			<span class="btn" onclick="destroy()">Destroy</span>
			
		</center>
		</div>
	</body>
</html>