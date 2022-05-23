<?php
date_default_timezone_set('America/Chicago');
header("TimeZone: America/Chicago");
$timeWeek = date('H:i A, l');
echo $timeWeek;