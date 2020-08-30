<?php
require('lib/database.php');
require('lib/dal.php');
require('lib/functions.php');

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


$s = new settings();

$s->set_zip_dir('data')->getDirFiles()->returnFileArr();

//var_dump($s,true);


//echo $currDir = getcwd();
/*  chdir('data');
$dataDir = getcwd();
$files1 = scandir($dataDir);
*/
/*
remove_arr_value($files1,".");
remove_arr_value($files1,"..");
*/
// Reindex the array
//$files1  = array_values($files1);

$file = $s->fileArray[0];
//$file = $files1[0];
$zip = zip_open($file);

if (is_resource($zip)) 
{
    //var_dump($zip);
    $zipentry = zip_read($zip);
    //var_dump($zipentry);
    $size = 0;
    $size += zip_entry_filesize($zipentry);
    $filename = basename(zip_entry_name($zipentry));
    $size = $size/1024;
    $size = $size/1024;
    $velikost = $nombre_format_francais = number_format($size, 2, '.', ',');
    echo $filename;
    echo "\n";
    echo $velikost;
    echo "MB";
    echo "\n";

    zip_close($zip);
};


?>