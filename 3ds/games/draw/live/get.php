<?php
	if(isset($_GET["r"])){
		echo "data:image/png;base64,".base64_encode(file_get_contents($_GET["r"]."/img.png"));
	}