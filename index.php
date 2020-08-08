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

$stmt=Database::prepare( "SELECT operating_system FROM secrestfull.supported;" );
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_OBJ);
$objekt1 = $result[0];
// var_dump($objekt1);
// var_dump($stmt->fetchAll());
echo $objekt1->operating_system;
$stmt->closeCursor();

?>