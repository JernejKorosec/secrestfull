<?php
global $parsedUrl;

$url = 'https://egp.gu.gov.si/egp/login.html';


/*
nekemaičl@gmail.com
ARWGAERGAREg
*/

$user_name = "nekemaičl@gmail.com";
$pass_word = "ARWGAERGAREg";

$postdata = http_build_query(
    array(
        'username' => $user_name,
        'password' => $pass_word
    )
);
/*
$content = http_build_query($params, '', '&');
$header = array(
    "Content-Type: application/x-www-form-urlencoded",
    "Content-Length: ".strlen($content)
);
*/
$arrContextOptions = array(
    
    "ssl" => array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    ),
    "http" => array(
        'method'  => 'POST',
        'header'  => 'Content-Type: application/x-www-form-urlencoded',
        'content' => $postdata
    )
);  

//$response = file_get_contents("https://maps.co.weber.ut.us/arcgis/rest/services/SDE_composite_locator/GeocodeServer/findAddressCandidates?Street=&SingleLine=3042+N+1050+W&outFields=*&outSR=102100&searchExtent=&f=json", false, stream_context_create($arrContextOptions));
// $parsedUrl = file_get_contents($url);

/*
$_POST['username'] = 'jernejk.alfa@gmail.com';
$_POST['password'] = 'BUFJ27';
$x = $_POST;
*/

// $parsedUrl = file_get_contents($url, false, stream_context_create($arrContextOptions));
//phpinfo();


if (!function_exists('file_post_contents')) {
	function file_post_contents($url, $params) {
		
		
		$content = http_build_query($params, '', '&');
		$header = array(
			"Content-Type: application/x-www-form-urlencoded",
			"Content-Length: ".strlen($content)
		);
		$options = array(
			'http' => array(
				'method' => 'POST',
				'content' => $content,
				'header' => implode("\r\n", $header)
			)
			
		);
		return file_get_contents($url, false, stream_context_create($options));
	}
}

?>