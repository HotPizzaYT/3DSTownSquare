<html>
	<head>
		<script src="polyfill.js"></script>
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
			.upperheader {
				background-color: #ff8000;
			}
			.crow {
				border-top: 1px solid #000;
				border-bottom: 1px solid #000;
				padding-top: 8px;
				padding-bottom: 8px;
			}
			.active {
				background-color: #33CCFF;
			}

		</style>
		<script>
		function shop(){
			window.location = "shop.php";
		}
		function myComics(){
			window.location = "mc.php";
		}
		window.matureTitles = ["Sporkbob Schitbag"];
		// Selection code
			window.selected = 0;
			window.previousSel = 0;
			function kcheck(event){
				// Basically disabled
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
					if(window.selected !== document.getElementsByClassName("crow").length - 1){
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
				prev = document.getElementById("c" + window.previousSel.toString());
				now = document.getElementById("c" + window.selected.toString());
				prev.classList.remove("active");
				now.classList.add("active");
				
			}
			function chooseSelection(){
				document.getElementById("c"+window.selected.toString()).getElementsByTagName('button')[0].click();
			}
			function read(id){
				if(window.matureTitles.includes(document.getElementById("c"+id.toString()+"n").innerText)){
					if(confirm("This comic book is mature, are you sure you want to read it?")){
						window.location = "read.php?id=" + id;
					}
				 } else {
					window.location = "read.php?id="+id;
				 }
				
				
			}
		</script>
		<title>Comic Book Reader 1.0 (Beta)</title>
		<meta name="viewport" content="width=320">
		<meta name="description" content="Welcome to 3DSTownSquare Here you can find many apps and games designed for the 3DS!">
	</head>
	<body onkeydown="kcheck(event);">
		<div id="contenttop">
			<img src="../../../images/header3ds.png" alt="Oops! Our header could not be displayed!" />
			<center>Comic Book Reader 1.0 (Beta)</center>
		</div>
		<div id="contentbot">
			<div class="upperheader">Welcome, Anonymous! You have 0 points. <span onclick="alert('All of the comic books are 100% free!');" style="color: #0080ff">Info</span> <span onclick="window.location = '../'" style="color: #0080ff">Back</span></div>
			<div class="scrolly">
				<div class="crow active" id="c0">
				<span id="c0n" class="mature">Sporkbob Schitbag</span> [FREE] <button onclick="read(0);">Read</button>
				</div>
				<div class="crow" id="c1">
				<span id="c1n">Omega's untitled comic</span> [FREE] <button onclick="read(1);">Read</button>
				</div>
				<div class="crow" id="c2">
				<span id="c2n">ESC [Destiny]</span> [FREE] <button onclick="read(2);">Read</button>
				</div>
			</div>
		</div>
	</body>
</html>