<?php
require('lib/database.php');
require('lib/dal.php');
require('lib/functions.php');
require('lib/webparser.php');

// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");

$s = new settings();
/* set working dir to data -> get files in that directory -> return those files as array */
$s->set_zip_dir('data')->getDirFiles()->returnFileArr();
//Smo v data direktoriju
if (count($s->fileArray) > 0){
    echo $extension = ".zip";
    echo $br = "<br/>";
    foreach ($s->fileArray as $key => $value) {
        $lowerValue = strtolower($s->fileArray[$key]);
        $pos = strpos($lowerValue, $extension);
        $is_zip_ext = ($pos > -1) ? 1 : 0;
        if ($is_zip_ext===0) {
            unset($s->fileArray[$key]);
        };
    }
    foreach ($s->fileArray as $key => $file) {
        echo $file;
        echo " Contains ";
        $zip = zip_open($file);
        if (is_resource($zip)) 
        {
            while ($zipentry = zip_read($zip)) {
                $size = 0;
                $size += zip_entry_filesize($zipentry);
                $filename = basename(zip_entry_name($zipentry));
                $filename_full = getcwd() . "/" . $filename;
                $size = $size/(1024*1024); // Koliko MB
                $velikost = number_format($size, 2, '.', ',');
                echo $filename;
                echo " - ";
                echo $velikost;
                echo "MB";
                echo $br;
                zip_close($zip);
            }
        };
    };
};

?>