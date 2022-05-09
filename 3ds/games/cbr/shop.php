<?php
session_start();
include("../../../detect.php");
?>


<html>
	<head>
		<script src="polyfill.js"></script>
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
				overflow-y: scroll;
			}
			
			#contentbot {
				background-color: #f0f0f0;
				height: <?php echo $height2;?>px;
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
		window.appData = [{"name":"Sporkbob Schitbag","desc":"Created by Slinkybenis<br />This comic is based off of SpongeBob SquarePants"},{"name":"Then and Now","desc":"Based off of OmegaReploid's Madness Combat au Then and Now, join Hank J Wimbleton and his brothers as we dive into the past...<br/><br/>Working on Then and Now as a comic has been challenging, not just as a writer, but an artist as well. With writing, the reader can let their mind run wild while reading the book, but with a comic, the artist has to go wild with drawing every single pannel. My main issue with drawing every human is the far away shots and to make sure that they don't look like men's penises. I've drawn so many things and often my mother has looked at it and said \"Hm. looks like a penis.\" The fun part about drawing this, however, is that I get to combine diffrent type of art styles. I hope you enjoy reading Then and Now, as this is one of my favorite fan fics to work on, not just to type up but to now offically draw.<br/><br/><a href='https://archiveofourown.org/works/34034140'>Then and Now can be read in text form over here</a>"},{"name":"[Esc] DESTINY","desc":"Coming soon!"}];
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
				document.getElementById("cname").innerText = window.appData[window.selected].name;
				document.getElementById("cdesc").innerHTML = window.appData[window.selected].desc;
				
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
			function selectNew(x){
				window.previousSel = window.selected;
				window.selected = x;
				changeSelection();
			}
		</script>
		<title>Comic Book Reader 1.0 (Beta)</title>
		<meta name="viewport" content="width=<?php echo $width; ?>">
		<meta name="description" content="Welcome to 3DSTownSquare Here you can find many apps and games designed for the 3DS!">
	</head>
	<body onkeydown="kcheck(event);">
		<div id="contenttop">
			<img src="../../../images/header3ds.png" width="<?php echo $width; ?>" alt="Oops! Our header could not be displayed!" />
			<b><u><center id="cname">Comic Book Reader 1.0 (Beta)</center></u></b>
			<center id="cdesc">Welcome to Comic Book Reader!<br />Click the background of a row to see the comic's information!</center>
		</div>
		<div id="contentbot">
			<div class="upperheader">Welcome, Anonymous! You have 0 points. <span onclick="alert('All of the comic books are 100% free!');" style="color: #0080ff">Info</span> <span onclick="window.location = '../'" style="color: #0080ff">Back</span></div>
			<div class="scrolly">
				<div class="crow active" id="c0" onclick="selectNew(0)">
				<span id="c0n" class="mature">Sporkbob Schitbag</span> [FREE] <button onclick="read(0);">Read</button>
				</div>
				<div class="crow" id="c1" onclick="selectNew(1)">
				<span id="c1n">Then and Now</span> [FREE] <button onclick="read(1);">Read</button>
				</div>
				<div class="crow" id="c2" onclick="selectNew(2)">
				<span id="c2n">ESC [Destiny]</span> [FREE] <button onclick="read(2);">Read</button>
				</div>
			</div>
		</div>
	</body>
</html>