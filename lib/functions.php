
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
        chdir($zipDir);
        $this->workingPath = getcwd();
        $this->fileArray = scandir($this->workingPath);
        $this->rem_arr_value(".");
        $this->rem_arr_value("..");
        $this->fileArray  = array_values($this->fileArray);
        chdir("..");
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



?>