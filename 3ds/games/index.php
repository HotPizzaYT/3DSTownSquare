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
				overflow-y: scroll;
				
			}
			.approw {
				padding-top: 8px;
				padding-bottom: 8px;
			}
			.active {
				background-color: #33CCFF;
			}
			
		</style>
		<script>
			window.selected = 0;
			window.appData = [{"name":"Comic Book Reader 1.0","desc":"A comic book reader for the Nintendo 3DS! (beta)","rating":"Varies"},{"name":"Pong","desc":"Classic singleplayer pong! Note that only PC is supported.","rating":"Everyone"},{"name":"Venmite MMORPG","desc":"This is a beta for an upcoming MMORPG!","rating":"13+"},{"name":"DrawTown","desc":"Draw and save to the DrawTown gallery!","rating":""},{"name":"BackApp","desc":"Opening this app goes back to the homepage.","rating":"Not rated"}];
			window.previousSel = 0;
			function kcheck(event){
				if(event.keyCode == 38){
					// Up arrow
					if(window.selected !== 0){
						window.previousSel = window.selected;
						window.selected--;
						changeSelection();
					}
				}
				if(event.keyCode == 40){
					// Down arrow
					if(window.selected !== window.appData.length - 1){
						window.previousSel = window.selected;
						window.selected++;
						changeSelection();
					}
				}
				if(event.keyCode == 13){
					chooseSelection();
				}
			}
			function changeSelection(){
				prev = document.getElementById("app" + window.previousSel.toString());
				now = document.getElementById("app" + window.selected.toString());
				prev.classList.remove("active");
				now.classList.add("active");
				document.getElementById("appname").innerText = window.appData[window.selected].name;
				document.getElementById("appdesc").innerText = window.appData[window.selected].desc;
				document.getElementById("apprating").innerText = window.appData[window.selected].rating;
				
			}
			function chooseSelection(){
				window.location = document.getElementById("app"+window.selected.toString()).getElementsByTagName('a')[0].href;
			}
				
		</script>
		<title>3DSTownSquare - Game Center</title>
		<meta name="viewport" content="width=320">
		<meta name="description" content="Play 3DSTownSquare games here!">
	</head>
	<body onkeydown="kcheck(event)" >
		<div id="contenttop">
			<img src="../../images/header3ds.png" alt="Oops! Our header could not be displayed!" />
			<center><b><u id="appname">Comic Book Reader 1.0</u></b>
			<br />
			Description: <span id="appdesc">A comic book reader for the Nintendo 3DS! (beta)</span><br />
			Rating: <span id="apprating">Varies</span>
			</center>
		</div>
		<div id="contentbot">
		<center>
			<a href="../">Back</a><br/>
			<div id="app0" class="approw active">
				<a href="cbr/">Comic Book Reader 1.0</a>
			</div>
			<div id="app1" class="approw">
				<a href="pong/">Pong (3DS and DSi unsupported)</a>
			</div>
			<div id="app2" class="approw">
				<a href="venmite/">Venmite MMORPG</a>
			</div>
			<div id="app3" class="approw">
				<a href="draw/">DrawTown</a>
			</div>
			<div id="app4" class="approw">
				<a href="../">BackApp</a>
			</div>
		</center>
		</div>
	</body>
</html>