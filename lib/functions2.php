
<?php





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

                    /*
                    echo "Exists:  ";
                    echo $dirToCreate;
                    echo "<br/>";

                    echo "delete($dirToCreate)";
                    */
                    $this->delete_files($dirToCreate);
                    /*
                    echo "Does " . $dirToCreate . " exists: " . is_dir($dirToCreate);
                    echo "<br/>";
                    */
                }
                else
                {
                    /*
                    echo "Doesn't exists:  ";
                    echo $dirToCreate;
                    echo "<br/>";
                    */
                    $old_umask = umask(0);
                    mkdir($dirToCreate,0777);
                    umask($old_umask);
                    /*
                    echo "mkdir($dirToCreate,0777);";
                    echo "Does " . $dirToCreate . " exists: " . is_dir($dirToCreate);
                    echo "<br/>";
                    */
                }
                
                /*
                echo $fullFilePath;
                echo "<br/>";
                echo $dirToCreate;
                echo "<br/>";
                */
                echo $fullDataDir;
                echo "<br/>";
                $zip = new ZipArchive;
                if ($zip->open($fullFilePath) === TRUE) 
                {

                    // Gre čez zip in izpise kaj je vsebin
                    for ($i = 0; $i < $zip->numFiles; $i++) {
                        //echo "index: $i\n";
                        //print_r($zip->statIndex($i));
                        //$unzipPath = $fullFilePath
                        $stat = $zip->statIndex( $i );
                        // echo $stat['name'];
                        
                        $zip->statIndex( $i ); 

                        echo $zipDirName = basename( $stat['name'] );
                        echo "<br/>";

                        //echo $bn = basename( $stat['name'] );
                        //$currDir .= "/".$dir_postfix."/";
                        //$currDir .= "/";
                        //$zip->extractTo($currDir);

                        $zip->extractTo($fullDataDir);

                    }
                    
                    /*
                    echo "closing Zip file:". $fullFilePath;
                    echo "<br/>";
                    */
                    $zip->close();

                }
                
            }

        }
        


    }

   
    function delete_files($target) {
        if(is_dir($target))
        {
            $files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned
            foreach( $files as $file ){
                $this->delete_files( $file );      
            }
            
            if(rmdir( $target ))
            {
                //echo "Dir $target deleted.";
            }
            else
            {
                //echo "Dir $target NOT deleted.";
            }
        } 
        else if(is_file($target)) {
            unlink( $target );  
        }
    }
}


?>