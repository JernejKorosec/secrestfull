<?php

require('lib/database.php');
require('lib/dal.php');


//echo "SECRestFull Security Framework";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");




/*
$database = new Database();
//var_dump($database);


$supported = new Supported($database);

$supported->read();
*/
/*
$stmt=Database::prepare( "SELECT operating_system FROM secrestfull.supported;" );
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_OBJ);
$objekt1 = $result[0];
// var_dump($objekt1);
// var_dump($stmt->fetchAll());
echo $objekt1->operating_system;
$stmt->closeCursor();
*/

/*

if (($key = array_search($del_val, $messages)) !== false) {
    unset($messages[$key]);
}

*/


function remove_arr_value(&$arr, $value){ 
    if (in_array($value, $arr)) {   
        $key = array_search($value, $arr);
        $key=$key+0;    
        if($key !== false){ 
            unset($arr[$key]);
        }
    }
}



//echo "Trenutni Direktorij:\n";
$currDir = getcwd();
//echo $currDir;

//echo  "\n";
chdir('data');
$currDir = getcwd();
//echo $currDir;
$files1 = scandir($currDir);
//echo "\n\n";
//var_dump($files1);
/*
if (in_array(".", $files1)) {
    $key = array_search(".", $files1);
    if($key !== false) unset($files1[$key]);
}
if (in_array("..", $files1)) {
    echo "Got ..\n";
}
if (in_array("...", $files1)) {
    echo "Got ...\n";
}
*/
//$key = array_search(".", $files1);
//echo $key."\n";

remove_arr_value($files1,".");
remove_arr_value($files1,"..");

// Reindex the array
$files1  = array_values($files1);

//var_dump($files1);

/*
array(3) {
  [2]=>
  string(10) "RPE_HS.ZIP"
  [3]=>
  string(10) "RPE_PE.ZIP"
  [4]=>
  string(10) "RPE_UL.ZIP"
}
*/

$file = $files1[0];
$zip = zip_open($file);

if (is_resource($zip)) 
{
    //var_dump($zip);
    $zipentry = zip_read($zip);
    var_dump($zipentry);

    echo $file = basename(zip_entry_name($zipentry));


    /*
    zip_entry_open($zip, $zipentry, "r");
    $entry_content = zip_entry_read($zipentry, zip_entry_filesize($zipentry));

    zip_entry_close($zipentry);
    */
    zip_close($zip);
};



/*
$za = new ZipArchive();

$za->open('test_with_comment.zip');
print_r($za);
var_dump($za);
echo "numFiles: " . $za->numFiles . "\n";
echo "status: " . $za->status  . "\n";
echo "statusSys: " . $za->statusSys . "\n";
echo "filename: " . $za->filename . "\n";
echo "comment: " . $za->comment . "\n";

for ($i=0; $i<$za->numFiles;$i++) {
    echo "index: $i\n";
    print_r($za->statIndex($i));
}
echo "numFile:" . $za->numFiles . "\n";
*/
?>