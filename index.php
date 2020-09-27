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

//var_dump($s);
//Smo v data direktoriju
if (count($s->fileArray) > 0){
    $extension = ".zip";
    $br = "<br/>";

    /*
     * Scisti array od datotek ki niso zip datoteke
     */
    foreach ($s->fileArray as $key => $value) {
        $lowerValue = strtolower($s->fileArray[$key]);
        $pos = strpos($lowerValue, $extension);
        $is_zip_ext = ($pos > -1) ? 1 : 0;
        if ($is_zip_ext===0) {
            unset($s->fileArray[$key]);
        };
    }

    /*
    echo $br;
    echo $br;
    echo $br;
    echo "<PRE>";
    var_dump($s->fileArray);
    echo "</PRE>";
    */

    foreach ($s->fileArray as $key => $file) {

        echo $file;
        echo " Contains ";
        //$file = $s->fileArray[0];
        $zip = zip_open($file);

        //var_dump($zip);

        if (is_resource($zip)) 
        {
            //var_dump($zip);     // resource(3) of type (Zip Directory) 
            //$zipentry = zip_read($zip);
            /*
            echo "<PRE>";
            var_dump($zip);
            echo "</PRE>";
            */
          

            while ($zipentry = zip_read($zip)) {

                //$zipentry2 = zip_entry_read($zipentry);
                /*
                echo "<PRE>";
                var_dump($zip);
                echo "</PRE>";

                echo "<PRE>";
                var_dump($zipentry);
                echo "</PRE>";
                */

                /*
                echo "<PRE>";
                var_dump($zipentry2);
                echo "</PRE>";
                */

                //echo  zip_entry_name($file).PHP_EOL;
                //var_dump($zipentry);    //resource(4) of type (Zip Entry)
                $size = 0;
                $size += zip_entry_filesize($zipentry);
                //$filename_full = zip_entry_name($zipentry);
                $filename = basename(zip_entry_name($zipentry));
                $filename_full = getcwd() . "/" . $filename;
                $size = $size/(1024*1024); // Koliko MB
                $velikost = number_format($size, 2, '.', ',');
                /*
                echo $filename;
                echo $br;
                */
                echo $filename;
                echo " - ";
                echo $velikost;
                echo "MB";
                echo $br;
                zip_close($zip);
            }
            //$zipentry = zip_read($zip);
        };
    };


};
//echo $parsedUrl;



?>