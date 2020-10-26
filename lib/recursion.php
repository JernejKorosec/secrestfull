<?php

function factorial( $n ) {

    // Base case
    if ( $n == 0 ) {
      echo "Base case: $n = 0. Returning 1...<br>";
      return 1;
    }
  
    // Recursion
    echo "$n = $n: Computing $n * factorial( " . ($n-1) . " )...<br>";
    $result = ( $n * factorial( $n-1 ) );
    echo "Result of $n * factorial( " . ($n-1) . " ) = $result. Returning $result...<br>";
    return $result;
  }
  
  

function traverse($starting_point, $global_array)
{
    //echo $starting_point;
    echo "function$starting_point callstack <br/>";
    //debug_zval_dump(&$var1);

    if($starting_point >= 20){
        return;
    }
    else if($starting_point < 20){
        $starting_point++;
        traverse($starting_point, $global_array);
    }

}

// Direktorij kjer se nahajajo originalne zip datoteke
$starting_dir = "";

// Direktorij Kjer se shranjujejo vse ostale datoteke
// v temp zipi in podzipi v root tega direktorija
// pa tisti dbf katere potrebujem
$unzip_dir = "";


?>