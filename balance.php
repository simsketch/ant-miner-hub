<?php

function userLogin() {
    $url = 'http://87.233.64.194:8093/v1/user/login';
    $params = 'grant_type=password&username=pizza&password=hut';
    $base64auth = base64_encode("pizza:hut");
    // var_dump($base64auth);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: Basic '.$base64auth)
    );
    $response = curl_exec($ch);
    $json = json_decode($response, true);
    curl_close($ch);
    // print_r("login: ".$response);
    return ($json['access_token']);
}
function walletBalance() {
	$query = array();
	parse_str($_SERVER['QUERY_STRING'], $query);

	switch ($query["type"]) {
            case "ltc":
                $GLOBALS['typeCode']=2;
                // $address = "mtHqsgAcymaVtQ8cVdFdoj6WiW3YkgdmZQ";
                break;
            case "eth":
                $GLOBALS['typeCode']=3;
                // $address = "0xf74899a7355cec28cffdad4d74f0d043b9cd86cb";
                break;
            case "etc":
                $GLOBALS['typeCode']=7;
                // $address = "0xee4fc2d38eb38478d3a17b0aed6cc0c1019e9ee9";
                break;
            case "dash":
                $GLOBALS['typeCode']=4;
                // $address = "yhF5LQT1NL7wP7mHzkGuZ7ztTCVWRHJQRk";
                break;
            //case "btg":
                //not supported natively
                //$GLOBALS['typeCode']=0;
                //processCryptoPaymentCurl();
                // break;
            case "btc":
                $GLOBALS['typeCode']=1;
                // $address = "2NCKRWfdvbgRScDCmFsjrQfVQndAtgtrjKK";
                break;
            case "bch":
                $GLOBALS['typeCode']=6;
                // $address = "bchtest:qqqhxhzhr4qdl95mh2hx2yupfe2fvv3r0c0qgjd46w";
                break;
            default:
                $GLOBALS['typeCode']=1;
        }

	$token = userLogin();
	$data = 
	array(
		"id"=>1,
		"type"=>$GLOBALS['typeCode'],
        "address"=>$query["address"]
	);
    $data_string = json_encode($data);
    // var_dump($data_string);
    $url = 'http://87.233.64.194:8093/v1/wallet/getreceivedbyaddress';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer '.$token,
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data_string))  
    );
    $response = curl_exec($ch);
    // print_r($response);
    $json = json_decode($response, true);
    curl_close($ch);
    print_r($json["amount"]/100000000);

    // $data =
    // array(
    //     "type"=>$GLOBALS['typeCode'],"address"=>$query["address"]
    // );
    // $data_string = json_encode($data);
    // var_dump($data_string);
    // $url = 'http://87.233.64.194:8093/v1/wallet/getreceivedbyaddress';
    // $ch = curl_init($url);
    // curl_setopt($ch, CURLOPT_POST, 1);
    // curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    //     'Authorization: Bearer '.$token,
    //     'Content-Type: application/json',                                                                               
    //     'Content-Length: ' . strlen($data_string))
    // );
    // $response = curl_exec($ch);
    // $json = json_decode($response, true);
    // curl_close($ch);
    // print_r($json["amounts"][0]/100000000);
    
}
walletBalance();
?>