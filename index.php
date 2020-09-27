<?php
require('lib/database.php');
require('lib/dal.php');
require('lib/functions.php');
require('lib/webparser.php');

// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");

$s = new settings();
$s->set_zip_dir('data')->getDirFiles()->returnFileArr();

//var_dump($s);
//Smo v data direktoriju
if (count($s->fileArray) > 0){



    // $s->fileArray
    array_push($s->fileArray, "apple", "raspberry","blabla.dot","blabla123.gnom","blabla123.gzip","blabla11233.zip");
    /*
    echo "<PRE>";
    var_dump($s->fileArray);
    echo "</PRE>";
    */
    $extension = ".zip";
    $br = "<br/>";
    foreach ($s->fileArray as $key => $value) {
        //$is_in_array = in_array(array_map("strtolower", $value), array_map("strtolower", $extension));
        //$is_in_array = in_array($value, array_map("strtolower", $extension));
        //$is_in_array = in_array($value, "apple");
        
        $lowerValue = strtolower($s->fileArray[$key]);
        $pos = strpos($lowerValue, $extension);
        
        //$is_zip_ext = ($pos !== FALSE) ? true : false; // ENAKO DELA
        //$is_zip_ext = ($pos > -1) ? true : false; // DELA
        
        $is_zip_ext = ($pos > -1) ? 1 : 0;
        echo "{$key} => {$value} [$is_zip_ext]\n<br/>";

        //echo "{$key} => {$value} [$is_in_array]\n<br/>";
        //print_r($s->fileArray);
        //if(!in_array($value,$extension)) {  

        //if (!in_array(array_map("strtolower", $value), array_map("strtolower", $extension))) {
        if ($is_zip_ext===0) {
            unset($s->fileArray[$key]);
        };
    }

    echo $br;
    echo $br;
    echo $br;
    echo "<PRE>";
    var_dump($s->fileArray);
    echo "</PRE>";

    $file = $s->fileArray[0];
    $zip = zip_open($file);
    if (is_resource($zip)) 
    {
        //var_dump($zip);     // resource(3) of type (Zip Directory) 
        $zipentry = zip_read($zip);
        //var_dump($zipentry);    //resource(4) of type (Zip Entry)
        $size = 0;
        $size += zip_entry_filesize($zipentry);
        $filename = basename(zip_entry_name($zipentry));
        $size = $size/(1024*1024); // Koliko MB
        $velikost = number_format($size, 2, '.', ',');

        echo $filename;
        echo "\n";
        echo $velikost;
        echo "MB";
        echo "\n";
        zip_close($zip);

        //$zipentry = zip_read($zip);
    };
};
//echo $parsedUrl;



?>