<?php
class Database{
    
    private static $link = null ;

    private static function getLink() 
    {
        if ( self::$link ) {
            return self::$link ;
        };

       // $ini = _BASE_DIR . "config.ini" ;
        $ini = "config.ini" ;
        $parse = parse_ini_file ( $ini , true ) ;

        $driver = $parse [ "db_driver" ] ;
        $dsn = "${driver}:" ;
        $user = $parse [ "db_user" ] ;
        $password = $parse [ "db_password" ] ;
        $options = $parse [ "db_options" ] ;
        $attributes = $parse [ "db_attributes" ] ;

        foreach ( $parse [ "dsn" ] as $k => $v ) {
            $dsn .= "${k}=${v};" ;
        }

        //echo $dsn;

        self::$link = new PDO ( $dsn, $user, $password, $options ) ;

        foreach ( $attributes as $k => $v ) {
            self::$link->setAttribute(constant( "PDO::{$k}" )
                ,constant("PDO::{$v}" ));
        }

        return self::$link;
        
    }

    public static function __callStatic ( $name, $args ) {
        $callback = array ( self :: getLink ( ), $name ) ;
        return call_user_func_array ( $callback , $args ) ;
    }
    
    /// To dela od prej

    /*
    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "secrestfull";
    private $username = "sec";
    private $password = "restfull";
    public PDO $conn;
    // get the database connection
    public function getConnection(){
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
            
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
    */
}


?>