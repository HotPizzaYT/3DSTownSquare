// OH MY GOD, I HAD TO REWRITE THIS TRASH SCRIPT
var keymap = [];

window.gameCtrl = {"y":false,"x":false,"attack":false,"nxt":false,"up":false,"down":false,"left":false,"right":false};
function dpadActive(){
		if(window.gameCtrl.up == true && !window.gameCtrl.down){
			return true;
		} else if(window.gameCtrl.left == true && !window.gameCtrl.right){
			return true;
		} else if(window.gameCtrl.down == true && !window.gameCtrl.up){
			return true;
		} else if(window.gameCtrl.right == true && !window.gameCtrl.left){
			return true;
		} else {
			return false;
		}
}

    function arrayRemove(arr, value) { 
    
        return arr.filter(function(ele){ 
            return ele != value; 
        });
    }

ctrlRoutine = setInterval(function(){
	if(dpadActive() && window.gameCtrl.left == true){
		window.pos.x -= 5;
		document.getElementById("objtest_1").style.left = window.pos.x + "px";
		// setDir("up");
	}
	
	if(dpadActive() && window.gameCtrl.right == true){
		window.pos.x += 5;
		document.getElementById("objtest_1").style.left = window.pos.x + "px";
		// setDir("down");
	}
	
	if(dpadActive() && window.gameCtrl.up == true){
		window.pos.y -= 5;
		document.getElementById("objtest_1").style.top = window.pos.y + "px";
		// setDir("left");
	}
	
	if(dpadActive() && window.gameCtrl.down == true){
		window.pos.y += 5;
		document.getElementById("objtest_1").style.top = window.pos.y + "px";
		// setDir("right");
	}
	
}, 100);
function setDir(dir){
	switch(dir){
		case "up": document.getElementById("objtest_1").getElementsByTagName("img")[0].src = "test/u.png"; break;
		case "down": document.getElementById("objtest_1").getElementsByTagName("img")[0].src = "test/d.png"; break;
		case "left": document.getElementById("objtest_1").getElementsByTagName("img")[0].src = "test/l.png"; break;
		case "right": document.getElementById("objtest_1").getElementsByTagName("img")[0].src = "test/r.png"; break;
		
	}
}
function eightway(){
	if(keymap.includes(37) && keymap.includes(38)){
		// up left
		document.getElementById("objtest_1").getElementsByTagName("img")[0].src = "test/ul.png";
	}
	if(keymap.includes(38) && keymap.includes(39)){
		// up right
		document.getElementById("objtest_1").getElementsByTagName("img")[0].src = "test/ur.png";
	}
	if(keymap.includes(37) && keymap.includes(40)){
		// down left
		document.getElementById("objtest_1").getElementsByTagName("img")[0].src = "test/dl.png";
	}
	if(keymap.includes(39) && keymap.includes(40)){
		// down right
		document.getElementById("objtest_1").getElementsByTagName("img")[0].src = "test/dr.png";
	}
}
function kdown(event){
	keymap.push(window.event.keyCode);
	if(window.event.keyCode == 38){
		
		window.pkey = "up";
		setDir(window.pkey);
		eightway();
		window.gameCtrl.up = true;
		window.gameCtrl.down = false;
	}
	if(window.event.keyCode == 40){
		window.pkey = "down";
		setDir(window.pkey);
		eightway();
		window.gameCtrl.down = true;
		window.gameCtrl.up = false;
	}
	if(window.event.keyCode == 37){
		window.pkey = "left";
		setDir(window.pkey);
		eightway();
		window.gameCtrl.left = true;
		window.gameCtrl.right = false;
	}
	if(window.event.keyCode == 39){
		window.pkey = "right";
		setDir(window.pkey);
		eightway();
		window.gameCtrl.right = true;
		window.gameCtrl.left = false;
	}
	
	
}
function kup(event){
	keymap = arrayRemove(keymap, event.keyCode);
	if(event.keyCode == 38){
		window.gameCtrl.up = false;
	}
	if(event.keyCode == 40){
		window.gameCtrl.down = false;
	}
	if(event.keyCode == 37){
		window.gameCtrl.left = false;
	}
	if(event.keyCode == 39){
		window.gameCtrl.right = false;
	}
	setDir(window.pkey);
}