<?php
	function verifyPNG($data){
		if ( base64_encode(base64_decode($data, true)) === $data){
			return true;
		} else {
			return false;
		}
	}
	if(isset($_POST["f"]) && isset($_POST["r"])){
			$data = $_POST["f"];
			list($type, $data) = explode(';', $data);
			list(, $data)      = explode(',', $data);
			if(verifyPNG($data)){
				$raw = base64_decode($data);
				file_put_contents($_POST["r"]."/img.png",$raw);
				echo "refresh";
			} else {
				echo "invalid";
			}
		
	}