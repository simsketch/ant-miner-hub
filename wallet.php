<?php
    function walletCreate() {
    	$apiKey = '5673452';
	    $apiSecret = '493838094404959387';
	    $apiUrl = 'http://87.233.64.194:8093/v1/wallet/create';
	    $message = json_encode(
	        array('id'=>1)
	    );
	    $sign = hash_hmac('sha512', $message, $apiSecret);
	    $requestHeaders = [
	        'api-key:' . $apiKey,
	        'sign:' . $sign,
	        'Content-type: application/json'
	    ];
	    $ch = curl_init($apiUrl);
	    curl_setopt($ch, CURLOPT_POST, 1);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $message);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, $requestHeaders);
	    
	    $response = curl_exec($ch);
	    curl_close($ch);
	    var_dump($response);
    }
    //walletCreate();
	function userCreate() {
		$url = 'http://87.233.64.194:8093/v1/user/create';
		$data = array("user" => array ("name" => "Elon Zito", "role" => 1,"countryCode"=>54,"phoneNumber"=>"561-503-9444","attributes" => array ("street" => "3314 Lowson Blvd")),"unverifiedEmail"=>"pizza@gmail.com","password"=>"hut","userName"=>"pizza");                                                                    
		$data_string = json_encode($data);                                                                                   
		                                                                                                                     
		$ch = curl_init($url);                               
        curl_setopt($ch, CURLOPT_POST, 1);                                                                 
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		//var_dump($data_string);                       
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		    'Content-Type: application/json',                                                                                
		    'Content-Length: ' . strlen($data_string))                                                                       
		);                                                                                                                   
		                                                                                                                     
		$result = curl_exec($ch);
        $json = json_decode($response, true);
        print_r($result);
	}
	function userLogin() {
		$curl = curl_init('http://87.233.64.194:8093/v1/user/login');
		$data = array("grant_type" => "password","username"=>"pizza","password"=>"hut");
		$data_string = json_encode($data);
		$base64auth = base64_encode("pizza:hut");
	    curl_setopt($curl, CURLOPT_POST, 1);
	    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		//var_dump($data_string.$base64auth);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
		    'Authorization: Basic '.$base64auth,
		    'Content-Type: application/json',
		    'Content-Length: ' . strlen($data_string))
		);

	    $result = curl_exec($curl);
	    var_dump($result);
	    curl_close ($curl);
	}
	function userLoginOne() {
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
        if($response === false)
		{
		    echo '<script>alert(Curl error: ' . $response . ')</script>';
		}
        curl_close($ch);
        print_r($response);
        $json = json_decode($response, true);
        // walletSend($json['access_token']);
	}
	function walletSend($token) {
		$url = 'http://87.233.64.194:8093/v1/wallet/sendto';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    'Authorization: Bearer '.$token)
		);
        $response = curl_exec($ch);
        $json = json_decode($response, true);
        if($response === false)
		{
		    echo '<script>alert(Curl error: ' . $response . ')</script>';
		}
        curl_close($ch);
        print_r($response);
	}
	// userCreateOne();
	userLoginOne();
	// walletSend();
?>
<script src="js/jquery.min.js"></script>
<script>
// $( document ).ready(function() {
// 	var url = 'https://87.233.64.194:8093/v1/wallet/create';

// 	var jqxhr = $.ajax({
// 		url: url,
// 		method: "POST",
// 		dataType: "json",
// 		contentType: "application/json",
// 		data: {"type":1,"name":"ElonZito"}
// 		}).success(function(data){
// 			console.log(data);
// 		});
// });
// $( document ).ready(function() {
// 	var url = 'https://87.233.64.194:8093/v1/user/create';

// 	var jqxhr = $.ajax({
// 		url: url,
// 		method: "POST",
// 		dataType: "json",
// 		contentType: "application/json",
// 		data: {
// 			 "user":{
// 			 "name":"Elon Zito",
// 			 "role":1,
// 			 "countryCode":54,
// 			 "phoneNumber":"561-503-9444",
// 			 "attributes":{"street":"3314 Lowson Blvd"}
// 			 },
// 			 "unverifiedEmail":"pizza@gmail.com",
// 			 "password":"hut",
// 			 "userName":"pizza"
// 		}
// 		}).success(function(data){
// 			console.log(data);
// 		});
// });
</script>
