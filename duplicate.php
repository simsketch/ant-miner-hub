<?php
$configArray = parse_ini_file("config.ini");

$GLOBALS['ordersSheetId'] = $configArray["ordersSheetId"];
$GLOBALS['apiKey'] = $configArray["apiKey"];

function recursive_array_search($needle,$haystack) {
foreach($haystack as $key=>$value) {
    $current_key=$key;
    if($needle===$value OR (is_array($value) && recursive_array_search($needle,$value) !== false)) {
        return $current_key;
    }
}
return false;
}

$query = array();
parse_str($_SERVER['QUERY_STRING'], $query);

$url = 'https://sheets.googleapis.com/v4/spreadsheets/'.$GLOBALS['ordersSheetId'].'/values/A1:Q500?key='.$GLOBALS['apiKey'].'&majorDimension=ROWS';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, FALSE);
curl_setopt($ch, CURLOPT_HTTPGET, TRUE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$json = json_decode($response, true);
curl_close($ch);
//var_dump($json["values"][1]);
$key = recursive_array_search($query['orderId'], $json["values"]); // $key = 2;
//print_r("key: ".$key);
//orderid does not already exist
if($key) {
	print_r("it's a fresh one.");
}
else {
	print_r("This order id has already been submitted.")
}
?>