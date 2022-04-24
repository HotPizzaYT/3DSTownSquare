<?php
		$jsonF = file_get_contents("acc/data/" . $_SESSION["ts_user"] . ".json");
		$jsonD = json_decode($jsonF, true);
		$_SESSION["ts_points"] = $jsonD["points"];
?>