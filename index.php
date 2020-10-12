<?php
require('lib/database.php');
require('lib/dal.php');
require('lib/functions.php');
require('lib/webparser.php');

// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");

//$s = new settings();
/* set working dir to data -> get files in that directory -> return those files as array */

/*
$s->set_zip_dir('data')->getDirFiles()->returnFileArr();
//Smo v data direktoriju


if (count($s->fileArray) > 0){
    echo $extension = ".zip";
    echo $br = "<br/>";


    // REMOVES non zip files
    foreach ($s->fileArray as $key => $value) {
        $lowerValue = strtolower($s->fileArray[$key]);  // spremeni zapis datoteke v lower case
        $pos = strpos($lowerValue, $extension);         // pogleda na kateri poziciji v lowercase zapisu datoteke je .zip
        $is_zip_ext = ($pos > -1) ? 1 : 0;              // preveri če sploh obstaja .zip v datoteki
        if ($is_zip_ext===0) {                          // če ne obstaja .zip v imenu datoteke 
            unset($s->fileArray[$key]);                     // odstrani zapis datoteke iz arraya vseh datotek
        };
    }


    // Odpre datoteko in teoretično vse datoteke v njej
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
*/



// Gremo po vrsti

// Delaj dokler v arrayu ni več zipov oziroma zapišeš vse datoteke
$dir = $starting_dr = getcwd();


//echo $dir1 = getcwd();
$dir1 = getcwd();
//echo "<br/>";
/*
$depth1 = 0;
rPrint($dir1,$depth1);
echo "=============================<br/>";
echo spaces(10);
echo "!<br/>";
*/


function getDirContents($dir, &$results = array()) {
    $files = scandir($dir);
    foreach ($files as $key => $value) {
        $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
        if (!is_dir($path)) {
            $results[] = $path;
        } else if ($value != "." && $value != "..") {
            getDirContents($path, $results);
            $results[] = $path;
        }
    }
    return $results;
}


function printDirContents($array){
    foreach ($array as $item) {
        echo $item;
        echo "<br/>";
    }
}

function getSpecificExt($results = array(),$ext){
    
    $extension_filtered_array = array();
    foreach ($results as $filename) {
        //$path_parts = pathinfo($filename); //returns array of file name properties
        $file_ext = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
        $ext = strtolower($ext);
        if($file_ext === $ext)
        {
            array_push($extension_filtered_array,$filename);
            //echo $filename;
            //echo "<br/>";
        }
    }
    return $extension_filtered_array;
}

$array = getDirContents($dir);
//printDirContents($array);
// Iz direktorija pobere vse zipe
$zips = getSpecificExt($array,"zip");
var_dump($zips);



?>