<?php
session_start();
include("../../../detect.php");
?>

<html>
	<head>
	

<script type='text/javascript' src='//www.midijs.net/lib/midi.js'></script>

		<style>
			body {
				margin: 0px;
				width: <?php echo $width; ?>px;
				background-color: #fffff;
				font-size: 12px;
			}
			#contenttop {
				background-color: #f0f0f0;
				height: <?php echo $height1; ?>px;
			}
			
			#contentbot {
				background-color: #f0f0f0;
				height: <?php echo $height2; ?>px;
				overflow-y: scroll;
				overflow-x: hidden;
				word-wrap: break-word;
			}
.commentbox {
	width: <?php echo $cbp1; ?>px;
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
	text-align: left;
}
		</style>
		<script>
		var console = {
			"log": function(x){
				return x;
			}
		};
		</script>
		<script src="polyfill.js"></script>
		<script src="https://code.createjs.com/1.0.0/createjs.min.js"></script>
		<script src="http://api.html5media.info/1.1.8/html5media.min.js"></script>
		<script>
			function load(){
				var audio = new Audio('mid/hr.mid');
				audio.play();
			}
		</script>
		<title>MIDIMaster</title>
		<meta name="viewport" content="width=<?php echo $width; ?>">
		<meta name="description" content="DrawTown current works">
	</head>
	<body onload="load()">
		<div id="contenttop">
		<a href="javascript:void(0);" onclick="alert(MIDIjs.play('mid/hr.mid'));">Play Home - Resonance</a>
		<br />
		 <audio controls>
  <source src="mid/hr.mid" type="audio/midi">
  
  <source src="mid/hr.mid" type="audio/mid">
  <source src="mid/hrabr.ogg" type="audio/ogg">
  Your browser does not support the audio tag.
</audio> 
		<br />
		<div id="MIDIjs.message"></div>
		<div id="MIDIjs.audio_time"></div>
		<br />
		 <a href="#" onClick="MIDIjs.stop();">Stop MIDI Playback</a>
		 <br />
		
		
	<a href="works.php">Back</a>
		</center>
		</div>
	</body>
</html>