<?php
class Supported{
    private PDO $conn;
    private $db;
    private $table_name = "supported";
    private $operating_system;
    private $SQL_supportedOS = 'SELECT operating_system FROM secrestfull.supported;';

    public function __construct(Database $db){
        echo "constructor called";
        echo "\n\n";
        $this->db = $db;
        $this->conn = $db->getConnection();
        var_dump($db);
        echo "\n\n";
        var_dump($this->conn);
        echo "\n\n";
    }
    
   
    // Naredit moram 2 generični funkciji
    // prva bo uporabljena za PDO prepared statements
    // druga bo narejena za izključno exec brez argumentov ? v SQLu


    public function read()
    {
        //var_dump($conn);
        //echo $rezultat = $this->conn->exec($this->SQL_supportedOS);
        // vrne nič
        
        $stmt = $this->conn->prepare($this->SQL_supportedOS);

        //if($num>0){
    
            // products array
            $products_arr=array();
            $products_arr["records"]=array();
        
            // retrieve our table contents
            // fetch() is faster than fetchAll()
            // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
            // Pripravit moramo 
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                echo $row;
                // extract row
                // this will make $row['name'] to
                // just $name only
                extract($row);
        
                $product_item=array(
                    "id" => $id,
                    "operating_system" => $name,
                    //"description" => html_entity_decode($description),
                    //"price" => $price,
                    //"category_id" => $category_id,
                    //"category_name" => $category_name
                );
        
                array_push($products_arr["records"], $product_item);
            }
        
            // //set response code - 200 OK
            //http_response_code(200);
        
            // //show products data in json format
            //echo json_encode($products_arr);
        //}
    }





}
?>