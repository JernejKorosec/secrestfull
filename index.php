<?php
// test
require('lib/database.php');
require('lib/dal.php');
require('lib/functions2.php');
require('lib/webparser.php');
require('lib/recursion.php');
// Gremo po vrsti
// Delaj dokler v arrayu ni več zipov oziroma zapišeš vse datoteke
//$dir = $starting_dr = getcwd();

//rec($starting_dr);


/*
echo $ZipsStackFiles = array("RPE_HS.ZIP", "RPE_PE.ZIP", "RPE_UL.ZIP");
echo "<br/>";
echo $ZipStackFullPath = array();
echo "<br/>";
echo $ZipExtractionPath = getcwd(). DIRECTORY_SEPARATOR . "unziped";
echo "<br/>";
*/

// Kaj rabim

// Od tu naprej gre rekruzivno in išče za naše RPE datoteke
//$where_to_start_searching = $starting_dr;
//$what_to_find = $ZipsStack;

// Od tu naprej najde root mapo kjer so naše ZIP datoteke
//$where_zips_are;

// To je spisek datotek katere išče
//$what_zips_to_search = $ZipsStack;

// To je mapa kamor naj shrani naše DBF datoteke
//$where_to_put_dbfs;

//$k = new Kewl();

/*$k->displayVar();
$nekineki = $k->findFiles();
*/
//var_dump($nekineki);



//phpinfo();
$z = new zipUtils();
$z->find();
?>
