<html>
<style>
body, html {
	width: 320px;
	margin: 0px;
}
</style>
<title>DrawTown - New Drawing</title>
<meta name="viewport" content="width=320">
    <script type="text/javascript">
	lw = 5;
    var canvas, ctx, flag = false,
        prevX = 0,
        currX = 0,
        prevY = 0,
        currY = 0,
        dot_flag = false;

    var x = "black",
        y = window.lw;
    
    function init() {
        canvas = document.getElementById('can');
        ctx = canvas.getContext("2d");
		ctx.imageSmoothingEnabled = false;
		ctx.lineWidth = 20;
		ctx.lineCap = 'round';
        w = canvas.width;
        h = canvas.height;
    
        canvas.addEventListener("mousemove", function (e) {
            findxy('move', e)
        }, false);
        canvas.addEventListener("mousedown", function (e) {
            findxy('down', e)
        }, false);
        canvas.addEventListener("mouseup", function (e) {
            findxy('up', e)
        }, false);
        canvas.addEventListener("mouseout", function (e) {
            findxy('out', e)
        }, false);
		canvas.addEventListener("touchstart", function (e){
			findxy('down', e);
		
		}, false);
		canvas.addEventListener("touchend", function (e){
			findxy('up', e);
		
		}, false);
		canvas.addEventListener("touchcancel", function (e){
			findxy('out', e);
		
		}, false);
		
		canvas.addEventListener("touchmove", function (e){
			findxy('move', e);
		
		}, false);
    }

    
    function color(obj) {
        switch (obj.id) {
            case "green":
                x = "green";
                break;
            case "blue":
                x = "blue";
                break;
            case "red":
                x = "red";
                break;
            case "yellow":
                x = "yellow";
                break;
            case "orange":
                x = "orange";
                break;
            case "black":
                x = "black";
                break;
            case "white":
                x = "white";
                break;
			case "skin":
				x = "#ffd090";
				break;
			case "brown":
				x = "#804000";
				break;
			// Add more colors
			case "custom":
				x = prompt("Custom color?");
				break;
        }
		document.getElementById("pensize").style.backgroundColor = x;
    
    }
    
    function draw() {
		ctx.imageSmoothingEnabled = false;
        ctx.beginPath();
        ctx.moveTo(prevX, prevY);
        ctx.lineTo(currX, currY);
        ctx.strokeStyle = x;
        ctx.lineWidth = y;
        ctx.stroke();
        ctx.closePath();
    }
    
    function erase() {
        var m = confirm("Want to clear");
        if (m) {
            ctx.clearRect(0, 0, w, h);
            document.getElementById("canvasimg").style.display = "none";
        }
    }
    
    function save() {
var http = new XMLHttpRequest();
var url = 'upload.php';
var t = encodeURIComponent(prompt("What should you name this arwork?"));
var params = 'i=' + encodeURIComponent(canvas.toDataURL()) + "&t=" + t;
http.open('POST', url, true);

//Send the proper header information along with the request
http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

http.onreadystatechange = function() {//Call a function when the state changes.
    if(http.readyState == 4 && http.status == 200) {
        alert("Uploaded");
    }
}
http.send(params);
    }
	function findxy(res, e) {
        if (res == 'down') {

            prevX = currX;
            prevY = currY;
			// alert(e.type == 'touchstart');
			if(e.type == 'touchstart'){
				console.log(e);
				currX = e.touches[0].clientX - canvas.offsetLeft;
				currY = e.touches[0].clientY - canvas.offsetTop;
			} else {
				currX = e.pageX - canvas.offsetLeft;
				currY = e.pageY - canvas.offsetTop;
			}
			ctx.lineWidth = 64;    
            flag = true;
            dot_flag = true;
            if (dot_flag) {
				ctx.arc(currX, currY, 1, 0, 2 * Math.PI, true);
                ctx.beginPath();
                ctx.fillStyle = x;
				
				ctx.strokeStyle = x;
				ctx.stroke();
                ctx.closePath();
                dot_flag = false;
            }
        }
        if (res == 'up' || res == "out") {
            flag = false;
        }
        if (res == 'move') {
            if (flag) {
                prevX = currX;
                prevY = currY;
			if(e.type == 'touchstart' || e.type == 'touchmove' || e.type == 'touchend' || e.type == 'touchcancel'){
				currX = e.touches[0].clientX - canvas.offsetLeft;
				currY = e.touches[0].clientY - canvas.offsetTop;
			} else {
				currX = e.pageX - canvas.offsetLeft;
				currY = e.pageY - canvas.offsetTop;
			}
                draw();
            }
        }
    }
	function changeSize(){
		y = window.lw;
		document.getElementById("pensize").style.width = y;
		document.getElementById("pensize").style.height = y;
		document.getElementById("pensize").style.borderRadius = y+"px";
		document.getElementById("pensize").style.backgroundColor = x;
		
	}
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