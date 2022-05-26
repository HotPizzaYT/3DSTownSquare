<?php
// WeInRe proxy v1.0.0
$prx = file_get_contents("http://localhost:8080/".$_GET["g"]);
$file_info = new finfo(FILEINFO_MIME_TYPE);
$mime_type = $file_info->buffer($prx);
header("Content-Type: ".$mime_type);
echo $prx
?> 