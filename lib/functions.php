
<?php



class settings{
    public $workingPath;
    public $currentPath;
    public $fileArray = array();

    function remove_arr_value(&$arr, $value){ 
        if (in_array($value, $arr)) {   
            $key = array_search($value, $arr);
            $key=$key+0;    
            if($key !== false){ 
                unset($arr[$key]);
            }
        }
        return $this;
    }

    function rem_arr_value($value){ 
        if (in_array($value, $this->fileArray)) {   
            $key = array_search($value, $this->fileArray);
            $key=$key+0;    
            if($key !== false){ 
                unset($this->fileArray[$key]);
            }
        }
        return $this;
    }

    function set_zip_dir($zipDir)
    {
        $this->currentPath = getcwd();
        //echo $this->currentPath = getcwd();
        //echo $zipDir;
        if(is_dir($zipDir)){
            //echo "Direktorij obstaja"."\n";
        }
        else{
            //echo "Direktorij ne obstaja"."\n";
            //mkdir("/path/to/my/dir", 0700);
            $oldmask = umask(0);
            //mkdir("test", 0777);
            if(mkdir($zipDir, 0777)){
                umask($oldmask);
                //echo "Direktorij skreiran"."\n";
            }
            else{
                //echo "Nimam pravic za ustvarjanje direktorija"."\n";
            }
        }

        chdir($zipDir);
        $this->workingPath = getcwd();
        $this->fileArray = scandir($this->workingPath);
        $this->rem_arr_value(".");
        $this->rem_arr_value("..");
        $this->fileArray  = array_values($this->fileArray);
        //chdir("..");
        return $this;
    }

    function getDirFiles(){
        if(!empty($workingPath))
        $this->fileArray = scandir($workingPath);
        return $this;
    }

    function returnFileArr(){
        return $this->fileArray;
    }



}

/*
$zip = new ZipArchive();
$res = $zip->open('test.zip', ZipArchive::CHECKCONS);
function rPrint($cDir) // current Directory
{
    if(is_dir()){
        echo "[$cDir]";
        rPrint($cDir);
    } else if(is_file($cDir)){
        echo "[$cDir]";
        rPrint($cDir);
    };// else if()
}
*/

function spaces($num){
    /*
    for ($i=0; $i < $num; $i++) { 
     $str = $str . "-";
     
    }
    */
    $str  = str_repeat("=", $num);
    return $str;
}

function rPrint($dir,$depth){
//if($depth>4) return null;
//echo $dir;
//echo "<br/>";

    if (is_dir($dir)) {
        //echo "isdir<br/>";
        
        if ($dh = opendir($dir)) 
        {// dh = directory handle

            //$dh
            while (($file = readdir($dh)) !== false) {
                
                if ($file != "." && $file != "..") 
                {
                    //echo $depth;
                    $space = spaces($depth);
                    //echo $space.$file;
                    //echo $space.$dir.$file;
                    //echo  "\n<br/>";
                    //echo $dir;
                    echo $file_name = $dir . DIRECTORY_SEPARATOR . $file; // En direktorij premalo gre dol rekurzija
                    $file_type = filetype($file_name);
                    //echo "[$file_type]  " . "filename: $file_name";
                    //echo $space.$file_name;
                    echo  "\n<br/>";
                    if(is_file($file_name))
                    {
                        //echo "  Je datoteka!";
                    }
                    else if(is_dir($file_name)) 
                    {
                        //echo "  Je mapa!";
                        //$dir = $file_name; //PAZI !!!! TOLE POPRAV
                        $depth++;
                        rPrint($dir,$depth);
                    }
                    
                }
                /*
                else{
                    echo "test izpise . ali . in ..<br/>";
                }
                */
            }
            closedir($dh);
        }
    }
    
    else if(is_file($dir))
    {
        echo $dir;

    }
    

}

//function var_dump_pre($mixed = null) {
function vd($mixed = null) {
    echo '<pre>';
    var_dump($mixed);
    echo '</pre>';
    return null;
  }

?>