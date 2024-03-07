<?php
// page is hit
// some parameters such as string orderid or string depositaddress [bool success]
// jquery ajax gets data and using orderid cycles through to gather other information
// confirmation email goes out
// inventory gets reduced

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//set config params to local vars
$configArray = parse_ini_file("config.ini");
// $inventorySheetId = $configArray["inventorySheetId"];
// $inventoryMacroId = $configArray["inventoryMacroId"];
// $ordersSheetId = $configArray["ordersSheetId"];
// $ordersMacroId = $configArray["ordersMacroId"];
// $apiKey = $configArray["apiKey"];
$bitcoinWallet = $configArray["bitcoinWallet"];
$GLOBALS['inventorySheetId'] = $configArray["inventorySheetId"];
$GLOBALS['inventoryMacroId'] = $configArray["inventoryMacroId"];
$GLOBALS['ordersSheetId'] = $configArray["ordersSheetId"];
$GLOBALS['apiKey'] = $configArray["apiKey"];
$GLOBALS['ordersMacroId'] = "AKfycbym06mKtxYc3IadjTF3kqbb--SsOUVi28qkqKnc1a6cRIJbvBM";

function recursive_array_search($needle,$haystack) {
foreach($haystack as $key=>$value) {
    $current_key=$key;
    if($needle===$value OR (is_array($value) && recursive_array_search($needle,$value) !== false)) {
        return $current_key;
    }
}
return false;
}
//check query string for order details
// $query = array();
// parse_str($_SERVER['QUERY_STRING'], $query);
// $GLOBALS['orderid'] = $query["orderid"];
// $depositAddress = $query["depositAddress"];
// $currency = $query["currency"];
// $sourceAddress = $query["sourceAddress"];

// $url = 'https://sheets.googleapis.com/v4/spreadsheets/'.$ordersSheetId.'/values/A1:P500?key='.$apiKey.'&majorDimension=ROWS';
// $ch = curl_init($url);
// curl_setopt($ch, CURLOPT_POST, FALSE);
// curl_setopt($ch, CURLOPT_HTTPGET, TRUE);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
// $response = curl_exec($ch);
// $json = json_decode($response, true);
// curl_close($ch);
// print_r($response);
$query = array();
parse_str($_SERVER['QUERY_STRING'], $query);
$GLOBALS['orderid'] = $query['orderId'];

if(isset($query["orderId"])) {
    //grab our order data from the google sheet based on the orderid param in the URL
    $url = 'https://sheets.googleapis.com/v4/spreadsheets/'.$GLOBALS['ordersSheetId'].'/values/A1:Q500?key='.$GLOBALS['apiKey'].'&majorDimension=ROWS';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, FALSE);
    curl_setopt($ch, CURLOPT_HTTPGET, TRUE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $json = json_decode($response, true);
    if($response === false)
    {
        echo '<script>alert(Curl error: ' . $response . ')</script>';
    }
    curl_close($ch);
    $key = recursive_array_search($GLOBALS['orderid'], $json["values"]); // $key = 2;
    // print_r("key: ".$key."<br/>");
    $values = $json["values"];
    // print_r(json_encode($values[$key]));
    $GLOBALS['keyIndex'] = $key;
    $GLOBALS['paymentReceived'] = $values[$key][16];
    $GLOBALS['depositAddress'] = $values[$key][4];
    // var_dump($json["values"][$key]);
    $GLOBALS['depositAmount'] = floatval($values[$key][5]);
    $GLOBALS['pair'] = $values[$key][6];
    $GLOBALS['name'] = $values[$key][7];
    $GLOBALS['userEmail'] = $values[$key][13];

    switch ($GLOBALS['pair']) {
            case "ltc":
                $GLOBALS['pairCode']="ltc";
                $GLOBALS['currency']="litecoin";
                // $address = "mtHqsgAcymaVtQ8cVdFdoj6WiW3YkgdmZQ";
                break;
            case "eth":
                $GLOBALS['pairCode']="eth";
                $GLOBALS['currency']="ethereum";
                // $address = "0xf74899a7355cec28cffdad4d74f0d043b9cd86cb";
                break;
            case "etc":
                $GLOBALS['pairCode']="etc";
                $GLOBALS['currency']="ethereumclassic";
                // $address = "0xee4fc2d38eb38478d3a17b0aed6cc0c1019e9ee9";
                break;
            case "dash":
                $GLOBALS['pairCode']="dash";
                $GLOBALS['currency']="dash";
                // $address = "yhF5LQT1NL7wP7mHzkGuZ7ztTCVWRHJQRk";
                break;
            //case "btg":
                //not supported natively
                //$GLOBALS['pairCode']=0;
                //processCryptoPaymentCurl();
                // break;
            case "btc":
                $GLOBALS['pairCode']="btc";
                $GLOBALS['currency']="bitcoin";
                // $address = "2NCKRWfdvbgRScDCmFsjrQfVQndAtgtrjKK";
                break;
            case "bch":
                $GLOBALS['pairCode']="bch";
                $GLOBALS['currency']="bitcoincash";
                // $address = "bchtest:qqqhxhzhr4qdl95mh2hx2yupfe2fvv3r0c0qgjd46w";
                break;
            default:
    }

    $url = $_SERVER['REQUEST_URI']; //returns the current URL
    $parts = explode('/',$url);
    // print_r($parts);
    $query = array();
    parse_str($_SERVER['QUERY_STRING'], $query);
    $url = 'http://'.$_SERVER['HTTP_HOST'].'/'.$parts[1].'/balance.php?type='.$GLOBALS['pair'].'&address='.$GLOBALS['depositAddress'];

    // var_dump($url);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $response = floatval($response);
    if($response === false)
    {
        echo '<script>alert(Curl error: ' . $response . ')</script>';
    }
    //this is the actual, current balance...the total of all partial payments
    $GLOBALS['walletBalance'] = floatval($response);
    $recordedBalance = floatval($values[$key][1]);
    //$GLOBALS['depositAmount'] - ;
    //$GLOBALS['depositsBalance'] = $recordedBalance + $GLOBALS['walletBalance'];
    $GLOBALS['depositsBalance'] = $GLOBALS['walletBalance'];
    $GLOBALS['timestamp'] = $values[$key][15];
    $time1 = $GLOBALS['timestamp'];
	$datetimeFormat = 'Y-m-d H:i:s';
	$date = new DateTime();
	$date->setTimestamp(time());
	$time2 = $date->format($datetimeFormat);
	$secondsInterval = strtotime($time2) - strtotime($time1);
	if ($secondsInterval < 900) {
		$GLOBALS['expired'] = 'YES';
	}
	else {
		$GLOBALS['expired'] = 'NO';
	}
    curl_close($ch);
    // print_r($response);
    print_r('deposited: '.round($response, 5).'<br/>');
    print_r('expected: '.round($GLOBALS['depositAmount'], 5).'<br/>');
    $amountDeposited = $response + 0.00005;
    if ($amountDeposited < $GLOBALS['depositAmount']) {
        print_r('The balance is not yet paid in full.');
        $keyIndex = $GLOBALS['keyIndex'];
        $keyIndex += 1;
        $rounded = round($response, 5);
        $params = 'B'.$keyIndex.'='.$rounded;
        $fullUrl = "https://script.google.com/macros/s/AKfycbym06mKtxYc3IadjTF3kqbb--SsOUVi28qkqKnc1a6cRIJbvBM/exec?".$params;
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $fullUrl,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "",
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/x-www-form-urlencoded",
            "Content-Length: 0"
          ),
        ));

        $responseWrite = curl_exec($curl);
        $err = curl_error($curl);
        // var_dump($responseWrite);
        curl_close($curl);

        if ($err) {
          echo "<br>cURL Error #:" . $err;
        } else {
          // echo $responseWrite;
          print_r('<br/>order status changed to amount of partial payment received: '. $GLOBALS['orderid']);
        }

        //change order status value to true
        // $urlf = 'https://script.google.com/macros/s/AKfycbym06mKtxYc3IadjTF3kqbb--SsOUVi28qkqKnc1a6cRIJbvBM/exec';
        // $chf = curl_init($urlf);
        // $keyPlus = $key + 1;

        // $params = 'B'.$keyPlus.'='.round($response, 5);
        // $chf = curl_init($urlf);
        // print_r($params);
        // curl_setopt($chf, CURLOPT_POST, 1);
        // curl_setopt($chf, CURLOPT_POSTFIELDS, $params);
        // curl_setopt($chf, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($chf, CURLOPT_FOLLOWLOCATION, TRUE);
        // $responsef = curl_exec($chf);

        // print_r('<br/>'.$responsef);
        // if($responsef === false)
        // {
        //     echo '<script>alert(Curl error: ' . $responsef . ')</script>';
        // }
        // curl_close($chf);
        // print_r('<br/>order status changed to partial payment received: '. $GLOBALS['orderid']);
        $confirmationMessage = 'The balance is not yet paid in full.<br>orderId: '.$GLOBALS['orderid'].'<br>amount deposited: '.$response.'<br>amount expected: '.$GLOBALS['depositAmount'];
        $confirmationMessage .= '<br>request URL: http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

        $orderInfo = '<br/><br/>Order ID: '. $GLOBALS['orderid'] .'<br/>Name: '. $values[$key][7] .'<br/>Address: '. $values[$key][8] .'<br/>City: '. $values[$key][9] .'<br/>State: '. $values[$key][10] .'<br/>Country: '. $values[$key][11] .'<br/>Zip Code: '. $values[$key][12] .'<br/>Email: '. $values[$key][13] .'<br/>Phone: '. $values[$key][14] .'<br/>Total: $'. $values[$key][3] .'<br/>Currency: '. $values[$key][6] .'<br/>Deposit Address: '. $values[$key][4] .'<br/>Order Total: '. $values[$key][5];

        $remainingBalance =  $values[$key][5] - floatval($values[$key][1]);
        $totalBalance = floatval($values[$key][5]);
        $currentDeposits = floatval($values[$key][1]);
        $remainingBalance =  $totalBalance - $currentDeposits;
        $partialBalanceMessage = '<span style="font-size:14px;">We have received a partial payment(s) in the amount of: '.$response.'.<br><br>Your remaining balance is: '.$remainingBalance.'<br><br>Please scan the QR code below to send the remaining balance, or send the funds to this address:<br><br>'.$GLOBALS['depositAddress'].'</span><br><br>'.

            '<img align="center" src="https://chart.googleapis.com/chart?chs=125x125&chld=L|0&cht=qr&chl='.$GLOBALS['currency'].':'.$GLOBALS['depositAddress'].'?amount='.$remainingBalance.'%26label=antminerhub.com%26message=antminerhub.com transaction" />'

            .'<br>'.$orderInfo;
        $partialBalanceMessage .= '<br><br><table border="1" id="cart" cellpadding="1" cellspacing="1" width="100%" style="border-collapse:collapse;text-align:center;">
                                    <tr>
                                        <th></th>
                                        <th>Item</th>
                                        <th>Qty</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                    </tr>';
                                    $cart = json_decode($values[$key][2]);
                                    $myurl = $_SERVER['REQUEST_URI']; //returns the current URL
                                    $parts = explode('/',$myurl);
                                    $directory = $parts[1];
                                    $imgUrl = 'http://'.$_SERVER['HTTP_HOST'].'/'.$directory.'/images/';
                                    // print_r($cart);
                                    $items = array();
                                    foreach ($cart as $key => $value) {
                                        // print_r($key);
                                      array_push($items, $key);
                                    }
                                    for ($i = 0; $i < count($items); $i++) {
                                      $currentItem = $items[$i];
                                      if ($currentItem != "total") {
                                        if ($cart->$currentItem->qty > 0) {
                                            $partialBalanceMessage .= '<tr><td><img src="'.$imgUrl.$currentItem.'.png" style="width:100px"/></td><td>'.$currentItem.'</td><td>'.$cart->$currentItem->qty.'</td><td>'.$cart->$currentItem->description.'</td><td>'.$cart->$currentItem->price.'</td>';
                                          }
                                      }
                                    }
                                    $partialBalanceMessage .= '<tr><td>Total</td><td></td><td></td><td></td><td>'.$values[$key][3].'</td></tr>';
        error_log($partialBalanceMessage);
        include ('partial-balance-message.php');

        $mailAdmin = new PHPMailer(false);                              // Passing `true` enables exceptions
        try {
            $query = array();
            parse_str($_SERVER['QUERY_STRING'], $query);
            $mailAdmin->SMTPDebug = 0;                                 // Enable verbose debug output
            $mailAdmin->isSMTP();                                      // Set mailer to use SMTP
            $mailAdmin->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mailAdmin->Host = 'mail1.antminerhub.com';  // Specify main and backup SMTP servers
            $mailAdmin->Port = 587;                                    // TCP port to connect to
            $mailAdmin->SMTPAuth = true;                               // Enable SMTP authentication
            $mailAdmin->Username = 'orders@antminerhub.com';                 // SMTP username
            $mailAdmin->Password = 'JxCMqFjzMY';                           // SMTP password

            //Recipients
            $mailAdmin->setFrom('orders@antminerhub.com', 'Antminerhub Orders');
            $mailAdmin->addAddress('pizza@gmail.com', 'Antminerhub Admin');     // Add a recipient
            $mailAdmin->addAddress('orders@antminerhub.com');               // Name is optional
            $mailAdmin->addReplyTo('orders@antminerhub.com', 'Antminerhub Support');

            //Content
            $mailAdmin->isHTML(true);                                  // Set email format to HTML
            $mailAdmin->Subject = 'Ant Miner Hub Callback Fired';
            $mailAdmin->Body = $confirmationMessage;

            $mailAdmin->send();
            echo '<script>console.log("Admin email sent successfully.");</script>';
        } catch (Exception $e) {
            echo '<script>console.log("Could not send admin mail during order completion: '.$mailAdmin->ErrorInfo.'");</script>';
        }

        $mailUser = new PHPMailer(false);                              // Passing `true` enables exceptions
        try {
            $query = array();
            parse_str($_SERVER['QUERY_STRING'], $query);
            $mailUser->SMTPDebug = 0;                                 // Enable verbose debug output
            $mailUser->isSMTP();                                      // Set mailer to use SMTP
            $mailUser->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mailUser->Host = 'mail1.antminerhub.com';  // Specify main and backup SMTP servers
            $mailUser->Port = 587;                                    // TCP port to connect to
            $mailUser->SMTPAuth = true;                               // Enable SMTP authentication
            $mailUser->Username = 'orders@antminerhub.com';                 // SMTP username
            $mailUser->Password = 'JxCMqFjzMY';                           // SMTP password

            //Recipients
            $mailUser->setFrom('orders@antminerhub.com', 'Antminerhub Orders');
            $mailUser->addAddress($GLOBALS['userEmail'], $GLOBALS['name']);     // Add a recipient
            $mailUser->addAddress('orders@antminerhub.com');               // Name is optional
            $mailUser->addReplyTo('orders@antminerhub.com', 'Antminerhub Support');

            //Content
            $mailUser->isHTML(true);                                  // Set email format to HTML
            $mailUser->Subject = 'Antminerhub Partial Payment Received';
            $mailUser->Body = $userBalanceMessage;

            $mailUser->send();
            echo '<script>console.log("User email sent successfully.");</script>';
        } catch (Exception $e) {
            echo '<script>console.log("Could not send user mail during order completion: '.$mailUser->ErrorInfo.'");</script>';
        }
        die();
    }
    //check if we've received payment ie: the callback for this orderid/depositAddress has already been fired off
    //print_r("<br/>paymentReceived: ".$GLOBALS['paymentReceived']);
    // dd($key);

    if ($GLOBALS['paymentReceived'] != "YES" && $amountDeposited >= $GLOBALS['depositAmount'] && $GLOBALS['expired'] == 'NO') {
        //check inventory so we can be sure to edit the correct number
        $urli = 'https://sheets.googleapis.com/v4/spreadsheets/'.$inventorySheetId.'/values/B2:B4?key='.$GLOBALS['apiKey'].'&majorDimension=ROWS';
        $chi = curl_init($urli);
        curl_setopt($chi, CURLOPT_POST, FALSE);
        curl_setopt($chi, CURLOPT_HTTPGET, TRUE);
        curl_setopt($chi, CURLOPT_RETURNTRANSFER, true);
        $inventoryResponse = curl_exec($chi);
        $inventoryJson = json_decode($inventoryResponse, true);
        if($inventoryResponse === false)
        {
            echo '<script>alert(Curl error: ' . $inventoryResponse . ')</script>';
        }
        curl_close($chi);
        // var_dump($inventoryResponse);
        $inventoryValues = $inventoryJson["values"];

        $s9inventory = $inventoryValues[0][0];
        $l3inventory = $inventoryValues[1][0];
        $d3inventory = $inventoryValues[2][0];
        // var_dump($s9inventory);
        // var_dump($l3inventory);
        // var_dump($d3inventory);

        //decode cart data
        // $cart = str_replace("\\", "", $cart);
        $cart = json_decode($values[$key][2]);
        // var_dump($cart);
        // print_r($cart);
        $s9amount = $cart->s9->qty;
        $l3amount = $cart->l3->qty;
        $d3amount = $cart->d3->qty;
        // var_dump('s9: '.$s9amount);
        // die();

        //reduce inventory based on cart data
        $s9inventory = $s9inventory - $s9amount;
        $l3inventory = $l3inventory - $l3amount;
        $d3inventory = $d3inventory - $d3amount;

        //write values to google sheet
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://script.google.com/macros/s/AKfycbzNAOCuAwFp2YnS7lSc0fO6coLhihzgKV-f72jmOyWvWISNiBc/exec?B2=$s9inventory&B3=$l3inventory&B4=$d3inventory",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 2,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "",
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/x-www-form-urlencoded"
          ),
        ));
        $response = curl_exec($curl);
        $json = json_decode($response, true);
        if($response === false)
        {
            echo '<script>alert(Curl error: ' . $response . ')</script>';
        }
        curl_close($curl);
        // $url = 'https://script.google.com/macros/s/'.$inventoryMacroId.'/exec?B2='.$s9inventory.'&B3='.$l3inventory.'&B4='.$d3inventory;
        // $ch = curl_init($url);
        // curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // $response = curl_exec($ch);
        // $json = json_decode($response, true);
        // curl_close($ch);
        //print_r($json);

        //send user and admin payment confirmation mail
        $userEmail = $values[$key][13];
        $adminEmail = 'pizza@gmail.com';
        $userSubject = "Ant Miner Hub Payment Confirmation";
        $adminSubject = "Ant Miner Hub Payment Confirmation - Admin";
        $confirmationMessage = "Payment has been received from user. Please ship the following order.";
        $orderInfo = '<br/><br/>Order ID: '. $GLOBALS['orderid'] .'<br/>Name: '. $values[$key][7] .'<br/>Address: '. $values[$key][8] .'<br/>City: '. $values[$key][9] .'<br/>State: '. $values[$key][10] .'<br/>Country: '. $values[$key][11] .'<br/>Zip Code: '. $values[$key][12] .'<br/>Email: '. $values[$key][13] .'<br/>Phone: '. $values[$key][14] .'<br/>Total: $'. $values[$key][3] .'<br/>Currency: '. $values[$key][6] .'<br/>Deposit Address: '. $values[$key][4] .'<br/>Deposit Amount: '. $values[$key][5];
        include ('confirmation-message.php');
        // var_dump($orderid);
        // mail($userEmail, $userSubject, $styledMessage, $userHeaders);

        //Send order completion email to user, then admin
        $mailUser = new PHPMailer(false);                              // Passing `true` enables exceptions
        try {
            $query = array();
            parse_str($_SERVER['QUERY_STRING'], $query);
            $mailUser->SMTPDebug = 0;                                 // Enable verbose debug output
            $mailUser->isSMTP();                                      // Set mailer to use SMTP
            $mailUser->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mailUser->Host = 'mail1.antminerhub.com';  // Specify main and backup SMTP servers
            $mailUser->Port = 587;                                    // TCP port to connect to
            $mailUser->SMTPAuth = true;                               // Enable SMTP authentication
            $mailUser->Username = 'orders@antminerhub.com';                 // SMTP username
            $mailUser->Password = 'JxCMqFjzMY';                           // SMTP password

            //Recipients
            $mailUser->setFrom('orders@antminerhub.com', 'Antminerhub Orders');
            $mailUser->addAddress($userEmail, 'Antminerhub Admin');     // Add a recipient
            $mailUser->addAddress('orders@antminerhub.com');               // Name is optional
            $mailUser->addAddress($adminEmail);
            $mailUser->addReplyTo('orders@antminerhub.com', 'Antminerhub Support');

            //Content
            $mailUser->isHTML(true);                                  // Set email format to HTML
            $mailUser->CharSet = "text/html; charset=UTF-8;";
            $mailUser->Subject = $userSubject;
            $mailUser->Body    = $styledMessage;
            // $mailUser->AltBody = $orderInfo;

            $mailUser->send();
            echo '<script>console.log("User email for payment confirmation sent successfully.");</script>';
        } catch (Exception $e) {
            echo '<script>console.log("Could not send mail during order completion: '.$mailUser->ErrorInfo.'");</script>';
        }

        // if(mail($adminEmail, $userSubject, $confirmationMessage.$orderInfo, $userHeaders)) { echo 'admin mail success<br>';}

        //Send order completion email to user, then admin
        $mailAdmin = new PHPMailer(false);                              // Passing `true` enables exceptions
        try {
            $query = array();
            parse_str($_SERVER['QUERY_STRING'], $query);
            $mailAdmin->SMTPDebug = 0;                                 // Enable verbose debug output
            $mailAdmin->isSMTP();                                      // Set mailer to use SMTP
            $mailAdmin->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mailAdmin->Host = 'mail1.antminerhub.com';  // Specify main and backup SMTP servers
            $mailAdmin->Port = 587;                                    // TCP port to connect to
            $mailAdmin->SMTPAuth = true;                               // Enable SMTP authentication
            $mailAdmin->Username = 'orders@antminerhub.com';                 // SMTP username
            $mailAdmin->Password = 'JxCMqFjzMY';                           // SMTP password

            //Recipients
            $mailAdmin->setFrom('orders@antminerhub.com', 'Antminerhub Orders');
            $mailAdmin->addAddress($adminEmail, 'Antminerhub Admin');     // Add a recipient
            $mailAdmin->addAddress('orders@antminerhub.com');               // Name is optional
            $mailAdmin->addReplyTo('orders@antminerhub.com', 'Antminerhub Support');

            //Content
            $mailAdmin->isHTML(true);                                  // Set email format to HTML
            $mailAdmin->Subject = $adminSubject;
            $mailAdmin->Body = $confirmationMessage.$orderInfo;

            $mailAdmin->send();
            echo '<script>console.log("Admin email for payment confirmation sent successfully.");</script>';
        } catch (Exception $e) {
            echo '<script>console.log("Could not send mail during order completion: '.$mailAdmin->ErrorInfo.'");</script>';
        }

        //change paymentReceived value to true
        $keyIndex = $GLOBALS['keyIndex'];
        $keyIndex += 1;
        $params = 'Q'.$keyIndex.'=YES';
        $urlt = 'https://script.google.com/macros/s/AKfycbym06mKtxYc3IadjTF3kqbb--SsOUVi28qkqKnc1a6cRIJbvBM/exec?'.$params;
        $cht = curl_init($urlt);
        $cht = curl_init($urlt);
        curl_setopt($cht, CURLOPT_POST, 1);
        curl_setopt($cht, CURLOPT_POSTFIELDS, "");
        curl_setopt($cht, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cht, CURLOPT_FOLLOWLOCATION, TRUE);
        $responset = curl_exec($cht);
        $jsont = json_decode($responset, true);
        // echo $responset;
        if($responset === false)
        {
            echo '<script>alert(Curl error: ' . $responset . ')</script>';
        }
        curl_close($cht);
        print_r('Transaction complete for Order ID: '. $GLOBALS['orderid']);
        // $finalDeposit = $amountDeposited - 0.00005;
        $params = 'B'.$keyIndex.'='.$GLOBALS['depositsBalance'];
        // var_dump($params);
        $fullUrl = 'https://script.google.com/macros/s/AKfycbym06mKtxYc3IadjTF3kqbb--SsOUVi28qkqKnc1a6cRIJbvBM/exec?'.$params;
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $fullUrl,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "",
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/x-www-form-urlencoded",
            "Content-Length: 0"
          ),
        ));

        $responseWrite = curl_exec($curl);
        $err = curl_error($curl);
        // var_dump($responseWrite);
        curl_close($curl);

        if ($err) {
          echo "<br>cURL Error #:" . $err;
        } else {
          // echo $responseWrite;
          print_r('<br/>order status changed to amount of partial payment received: '. $GLOBALS['orderid']);
        }
    }
    else {
        echo 'This callback has already been fired.';
        //send mail
        $userEmail = 'pizza@gmail.com';
        $userSubject = "Ant Miner Hub Additional Callback Attempt";
        $confirmationMessage = "You are receiving this email because the callback for Order ID: ".$GLOBALS['orderid']." has already been fired.";
        $userHeaders = "From: " . $userEmail . "\r\n";
        $userHeaders .= "Reply-To: ". $userEmail . "\r\n";
        $userHeaders .= "MIME-Version: 1.0\r\n";
        $userHeaders .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        error_log($userEmail.$userSubject.$confirmationMessage.$userHeaders);
        // print_r(mail($userEmail, $userSubject, $confirmationMessage, $userHeaders));
    }
}
else {
    echo 'Missing or invalid <b>orderId</b>.';
    //send invalid or missing order id mail
    $userEmail = 'pizza@gmail.com';
    $userSubject = "Ant Miner Hub Missing or Invalid Order ID";
    $confirmationMessage = "You are receiving this email because the confirmation page was hit with either a missing or invalid Order ID: ".$GLOBALS['orderid'];
    $userHeaders = "From: " . $userEmail . "\r\n";
    $userHeaders .= "MIME-Version: 1.0\r\n";
    $userHeaders .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
    $userHeaders .= "Reply-To: ". $userEmail . "\r\n".
    "X-Mailer: PHP/" . phpversion();
    error_log($userEmail.$userSubject.$confirmationMessage.$userHeaders);
    // print_r(mail($userEmail, $userSubject, $confirmationMessage, $userHeaders));
}

?>