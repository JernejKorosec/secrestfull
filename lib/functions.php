
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

//echo "<br/>===================================== EXECUTION ENDED ====================================<br/>";
//echo "The factorial of 5 is: " . factorial( 5 );
//echo "<br/>===================================== EXECUTION ENDED ====================================<br/>";
//$starting_point=0;
//traverse($starting_point, $global_array);
//echo "<br/>===================================== EXECUTION ENDED ====================================<br/>";




/*
echo $dir;
echo "<br/>";
echo $starting_dr;
echo "<br/>";
echo getcwd();
*/



//echo $starting_dr;
//$files1 = scandir($starting_dr);
//$scanned_directory = array_diff(scandir($starting_dr), array('..', '.'));


//vd($files1);

function isZip($path){

}

function isDir($path){
    return is_dir($path);
}

function isFile(){

}


function rec($starting_dr){
    $files1 = array_diff(scandir($starting_dr), array('..', '.'));

    foreach ($files1 as &$value) {
        $polna_pot = realpath($starting_dr . DIRECTORY_SEPARATOR . $value);

        if(!is_dir($polna_pot)) 
        {
            
            // IF IS ZIP
            $file_ext = strtolower(pathinfo($value,PATHINFO_EXTENSION));
            $ext = strtolower("ZiP");
            if($file_ext === $ext)
            {
                echo '<span style="color:green">';
                echo " ZIP___:";



            }
            else
            {
                echo '<span style="color:blue">';
                echo " FILE__:";
            }
            
            echo $polna_pot;
            echo '</span>';
            echo "<br/>"; // Izpiše kar je treba
        }
        else
        {
            echo '<span style="color:red">';
            echo " DIR___:";
            echo $polna_pot;
            echo '</span>';
            echo "<br/>"; 

            rec($polna_pot);
            
        }
        
    }
}


class Kewl{
    public $var = 'a default value';
    public $ZipExtractionPath;
    public $ZipSearchRootPath;
    public $ZipsStackFiles  = array("RPE_HS.ZIP", "RPE_PE.ZIP", "RPE_UL.ZIP");
    public $ZipStackFilesFullPath = array();
    

    function __construct() {
        $this->ZipExtractionPath = getcwd(). DIRECTORY_SEPARATOR . "unziped";
        $this->ZipSearchRootPath = getcwd();
    }
    
    public function displayVar() {
        //echo $this->var;
        echo "Zip extraction path:  ";
        echo $this->ZipExtractionPath;
        echo "<br/>";
        echo "<br/>";

        echo "Zip files to search for:  ";
        echo "<br/>";
        foreach ($this->ZipsStackFiles as $value) {
            echo $value;
            echo "<br/>";
        }
        echo "<br/>";

        echo "Absolute Zip Files Path:  ";
        echo "<br/>";
        foreach ($this->ZipStackFilesFullPath as $value) {
            echo $value;
            echo "<br/>";
        }
    }

    public function findFiles($ZipsStackFiles1  = array("RPE_HS.ZIP", "RPE_PE.ZIP", "RPE_UL.ZIP"))
    {
        // Torej gre čez vse mape in najde točno določene zip datoteke
        $dir = $this->ZipSearchRootPath;
        
        $results = $this->getDirContents3($dir);

        /*
        echo "<PRE>";
        var_dump($results);
        echo "</PRE>";
        */
        return $ZipsStackFiles1; 
    }

    function getDirContents($dir, &$results = array()) 
    {
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

    function getDirContents2($dir, &$results = array()) 
    {
        
        $files = scandir($dir);

        echo "<PRE>";
        var_dump($files);
        echo "</PRE>";

        foreach ($files as $key => $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            // echo $path . "<br/>";
            if (!is_dir($path)) {
                $results[] = $path;
            } else if ($value != "." && $value != "..") {
                getDirContents2($path, $results);
                $results[] = $path;
            }
        }

    return $results;
    }

    function getDirContents3($dir, &$results = array()) 
    {
        
        $files = scandir($dir);

        
        echo "<PRE>";
        var_dump($files);
        echo "</PRE>";

        
        foreach ($files as $key => $value) {

            /*
            echo $value;
            echo "<br/>";
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            echo $path . "<br/>";
            if (!is_dir($path)) 
            {
                echo "ni direktorij";
                $results[] = $path;
            } 
            else if ($value != "." && $value != "..") 
            {
                echo "je direktorij";
                $results[] = $path;
                getDirContents3($path, $results);
            }
            else{
                echo "je direktorij";
            }
            */
        }

    return $results;
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
        return $extension_filtered_array;}


}


class zipUtils
{
    function find()
    {
        $currDir = getcwd();
        $fullDataDir = $currDir.DIRECTORY_SEPARATOR . "data";
        //echo $fullDataDir;

        $files = scandir($fullDataDir);

        foreach ($files as $key => $value) {
            $fullFilePath = $fullDataDir.DIRECTORY_SEPARATOR.$value;
            //echo $fullDataDir;
            //echo "<br/>";

            $ext = pathinfo($fullFilePath, PATHINFO_EXTENSION);
            
            if(strcasecmp("zip", $ext) == 0){

                $file = basename($fullFilePath); 
                $dirMadeFromFileName = basename($fullFilePath); 
                $dirMadeFromFileName = str_replace(".","_",$dirMadeFromFileName);
                $dirToCreate = $fullDataDir.DIRECTORY_SEPARATOR.$dirMadeFromFileName;
                
                if(is_dir($dirToCreate))
                {

                    echo "Exists:  ";
                    echo $dirToCreate;
                    echo "<br/>";

                    echo "delete($dirToCreate)";
                    $this->delete_files($dirToCreate);

                    echo "Does " . $dirToCreate . " exists: " . is_dir($dirToCreate);
                    echo "<br/>";
                }
                else
                {
                    
                    echo "Doesn't exists:  ";
                    echo $dirToCreate;
                    echo "<br/>";

                    $old_umask = umask(0);
                    mkdir($dirToCreate,0777);
                    umask($old_umask);

                    echo "mkdir($dirToCreate,0777);";
                    echo "Does " . $dirToCreate . " exists: " . is_dir($dirToCreate);
                    echo "<br/>";
                    
                }
                

                $zip = new ZipArchive;
                if ($zip->open($fullFilePath) === TRUE) 
                {

                    // Gre čez zip in izpise kaj je vsebin
                    /*
                    for ($i = 0; $i < $zip->numFiles; $i++) {
                        echo "index: $i\n";
                        print_r($zip->statIndex($i));
                        echo "<br/>";
                    }
                    */
                    /*
                    echo "closing Zip file:". $fullFilePath;
                    echo "<br/>";
                    */
                    $zip->close();

                }
                
            }

        }
        
        
/*

        $zip = new ZipArchive;
        if ($zip->open('E:\pathto\zip\ashok_subedi.zip') === TRUE) {
            $zip->extractTo('E:\pathto\extrac\myzip');
            $zip->close();
            echo 'ok';
        } else {
            echo 'failed';
        }
*/

    }

    // delete_files('/path/for/the/directory/');
    /* 
    * php delete function that deals with directories recursively
    */
    function delete_files($target) {
        if(is_dir($target))
        {
            $files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned
            foreach( $files as $file ){
                $this->delete_files( $file );      
            }
            // Hack to delete dir, open it and close it, so it can be deleted
            //$old_umask = umask(0);
            
            /*
            $temp = opendir($target);
            closedir($temp);
            */
            if(rmdir( $target ))
            {
                echo "Dir $target deleted.";
            }
            else
            {
                echo "Dir $target NOT deleted.";
            }
            //umask($old_umask);
        } 
        else if(is_file($target)) {
            unlink( $target );  
        }
    }
}


?>