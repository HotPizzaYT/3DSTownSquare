window.eggActive = false;

function eggyou(){
						if(window.eggActive == false){
							if(!document.getElementById("burg")){
							x = document.createElement("div");
							x.id = "burg"; x.style="zindex: 200000; transition-timing-function: ease-out; transition: 4.0s; position: absolute; top: 25px; left: 50%";
							img = document.createElement("img");
							img.src = "i/icon_burger.gif";
							img.id="burger";
							img.width = "16";
							img.height = "16";
							img.style = "transition: all 4s bilinear; width: 32px; height: auto;"; x.appendChild(img); document.body.appendChild(x);
							window.burgerPix = 32;
							img.style.height = "auto";
							window.burgerInt = setInterval(function(){
								window.burgerPix += 5;
								img.style.width = window.burgerPix + "px";
							}, 100);
							setTimeout(function(){ clearInterval(window.burgerInt); window.eggActive = true; document.getElementById("burg").remove(); }, 4000); 
							}
						}
}