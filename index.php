<?php

require('lib/database.php');
require('lib/dal.php');


//echo "SECRestFull Security Framework";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


function remove_arr_value(&$arr, $value){ 
    if (in_array($value, $arr)) {   
        $key = array_search($value, $arr);
        $key=$key+0;    
        if($key !== false){ 
            unset($arr[$key]);
        }
    }
}



$currDir = getcwd();
chdir('data');
$currDir = getcwd();
$files1 = scandir($currDir);

remove_arr_value($files1,".");
remove_arr_value($files1,"..");

// Reindex the array
$files1  = array_values($files1);


$file = $files1[0];
$zip = zip_open($file);

if (is_resource($zip)) 
{
    //var_dump($zip);
    $zipentry = zip_read($zip);
    var_dump($zipentry);

    echo $file = basename(zip_entry_name($zipentry));


    zip_close($zip);
};


?>