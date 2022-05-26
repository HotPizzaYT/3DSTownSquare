<?php
$dir = "acc/data";
$myfiles = array_diff(scandir($dir), array('.', '..', '.htaccess'));
foreach($myfiles as $filename){
    if(is_file("acc/data/" . $filename)){
        echo str_replace(".json", "", $filename) . '<br>'; 
    }   
}