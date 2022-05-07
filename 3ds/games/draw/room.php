<?php
	session_start();
	$login = false;
	$roomset = false;
	$playing = false;
	$error = "";
	if(isset($_SESSION["ts_user"])){
		$login = true;
	}
	if(isset($_GET["r"])){
		$roomset = true;
	}
	if(isset($_GET["p"]) && $roomset){
		if(password_verify($_GET["p"], file_get_contents("live/".$_GET["r"]."/.key"){
			$playing = true;
			// ths039212__
		}
	}?>
<html>
<style>
body, html {
	width: 320px;
	margin: 0px;
}
</style>
<title>DrawTown Room</title>
<meta name="viewport" content="width=320">
    <script type="text/javascript">
    </script>
	<style>
	body {
		overscroll-behavior: contain;
	}
	.color {
		display: inline-block;
	}
	</style>
    <body onload="init()">
	        <div style="">Choose Color</div>
        <div style="width:10px;height:10px;background:green;" class="color" id="green" onclick="color(this)"></div>
        <div style="width:10px;height:10px;background:blue;" class="color" id="blue" onclick="color(this)"></div>
        <div style="width:10px;height:10px;background:red;" class="color" id="red" onclick="color(this)"></div>
        <div style="width:10px;height:10px;background:yellow;" class="color" id="yellow" onclick="color(this)"></div>
        <div style="width:10px;height:10px;background:orange;" class="color" id="orange" onclick="color(this)"></div>
        <div style="width:10px;height:10px;background:black;" class="color" id="black" onclick="color(this)"></div>
		<div style="width:10px;height:10px;background:white;outline:1px solid black" class="color" id="custom" onclick="color(this)"></div>
        <div style="">Eraser</div>
        <div style="width:15px;height:15px;background:white;border:2px solid;" id="white" onclick="color(this)"></div>
		<button onclick="window.location=window.location">Refresh</button>
		<div id="width">
		<div id="pensize" style="width: 5px; height: 5px; border-radius: 1px; background-color: black;"></div>
		<input type="range" min="1" max="100" value="1" class="slider" id="thickness" onchange="window.lw = this.value; changeSize();" /></div>

        <img id="canvasimg" style="" style="display:none;">

        <canvas id="can" width="320" height="240" style="outline: 1px solid black;"></canvas>
		<br />
        <input type="button" value="save" id="btn" size="30" onclick="save()" style="">
        <input type="button" value="clear" id="clr" size="23" onclick="erase()" style="">
		<input type="button" value="exit" onclick="window.location='../'">
		<input type="button" value="view works" onclick="window.location='works.php'">
		<input type="button" value="play game" onclick="window.location='rooms.php'">
		
    </body>
    </html>