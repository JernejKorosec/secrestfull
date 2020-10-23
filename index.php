<?php
require('lib/database.php');
require('lib/dal.php');
require('lib/functions.php');
require('lib/webparser.php');
require('lib/recursion.php');
// Gremo po vrsti
// Delaj dokler v arrayu ni več zipov oziroma zapišeš vse datoteke
$dir = $starting_dr = getcwd();
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
    return $results;}


function printDirContents($array){
    foreach ($array as $item) {
        echo $item;
        echo "<br/>";
    }}

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
    return $extension_filtered_array;}

function extractProper($Zip_path,$currDir){
    umask(0);
    $zip = new ZipArchive;
    if ($zip->open($Zip_path) === TRUE) {
        //$dir_postfix = time();
        $stat = $zip->statIndex( $i ); 
        $bn = "_";
        $bn .= basename( $stat['name'] );
        //$currDir .= "/".$dir_postfix."/";
        $currDir .= "/";
        $zip->extractTo($currDir);
        $zip->close();
    } else {
        echo 'failed';
    }}



/*
$array = getDirContents($dir);
$zips = getSpecificExt($array,"zip");
$timestampString = date("Y_d_m_H_i_s");
$currDir = getcwd();
$currDir.="/";
$currDir.="/unzipped/$timestampString";
echo "===================================== EXECUTION STARTED ====================================";
foreach ($zips as $item) {
    if(stripos($item,'RPE'))
    {
        extractProper($item,$currDir);
        echo "Found:";
        echo $item;
        echo "<br/>";
    }
    else
    {
        //extractProper($item,$currDir);
        echo "Other Directory:";
        echo $item;
        echo "<br/>";
    }
}
echo "===================================== EXECUTION ENDED ====================================";
*/

echo "<br/>===================================== EXECUTION ENDED ====================================<br/>";
echo "The factorial of 5 is: " . factorial( 5 );
echo "<br/>===================================== EXECUTION ENDED ====================================<br/>";
$starting_point=0;
traverse($starting_point, $global_array);
echo "<br/>===================================== EXECUTION ENDED ====================================<br/>";









?>