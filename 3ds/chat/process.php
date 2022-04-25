<?php
	function process($txt){
		$arr = explode("\r\n", file_get_contents("badwords.txt"));

		foreach ($arr as $word)
		{
			$txt = str_ireplace($word, "****", $txt);
		}
		return htmlspecialchars($txt);
	}