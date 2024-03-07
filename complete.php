<?php
// vars to pass
// address and name info get sent in the email and to the google sheet, so they need to be in the POST/query values
// deposit amount, address, and currency type are all that's necessary, along with thank you and reminder

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

$configArray = parse_ini_file("config.ini");
$GLOBALS['inventorySheetId'] = $configArray["inventorySheetId"];
$GLOBALS['inventoryMacroId'] = $configArray["inventoryMacroId"];
$GLOBALS['ordersSheetId'] = $configArray["ordersSheetId"];
$GLOBALS['ordersMacroId'] = $configArray["ordersMacroId"];
$GLOBALS['apiKey'] = $configArray["apiKey"];


    $query = array();
    parse_str($_SERVER['QUERY_STRING'], $query);
    $GLOBALS['orderid'] = $query['orderId'];

function recursive_array_search($needle,$haystack) {
foreach($haystack as $key=>$value) {
    $current_key=$key;
    if($needle===$value OR (is_array($value) && recursive_array_search($needle,$value) !== false)) {
        return $current_key;
    }
}
return false;
}

function completeOrder() {
        $query = array();
        parse_str($_SERVER['QUERY_STRING'], $query);
        switch ($query["pair"]) {
            case "ltc":
                $GLOBALS['pairCode']=2;
                $GLOBALS['currency']="litecoin";
                // $address = "mtHqsgAcymaVtQ8cVdFdoj6WiW3YkgdmZQ";
                break;
            case "eth":
                $GLOBALS['pairCode']=3;
                $GLOBALS['currency']="ethereum";
                // $address = "0xf74899a7355cec28cffdad4d74f0d043b9cd86cb";
                break;
            case "etc":
                $GLOBALS['pairCode']=7;
                $GLOBALS['currency']="ethereumclassic";
                // $address = "0xee4fc2d38eb38478d3a17b0aed6cc0c1019e9ee9";
                break;
            case "dash":
                $GLOBALS['pairCode']=4;
                $GLOBALS['currency']="dash";
                // $address = "yhF5LQT1NL7wP7mHzkGuZ7ztTCVWRHJQRk";
                break;
            //case "btg":
                //not supported natively
                //$GLOBALS['pairCode']=0;
                //processCryptoPaymentCurl();
                // break;
            case "btc":
                $GLOBALS['pairCode']=1;
                $GLOBALS['currency']="bitcoin";
                // $address = "2NCKRWfdvbgRScDCmFsjrQfVQndAtgtrjKK";
                break;
            case "bch":
                $GLOBALS['pairCode']=6;
                $GLOBALS['currency']="bitcoincash";
                // $address = "bchtest:qqqhxhzhr4qdl95mh2hx2yupfe2fvv3r0c0qgjd46w";
                break;
            default:
        }
        loginGenerateVerifyWatchAddress();
}
function loginGenerateVerifyWatchAddress() {
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
    if($response === false)
    {
        echo '<script>alert(Curl error: ' . $response . ')</script>';
    }
    curl_close($ch);
    // print_r("login: ".$response);
        generateAddress($json['access_token']);
}
function generateAddress($token) {
    $data = array("type" => $GLOBALS['pairCode'], "name" => "1_AntMinerWallet");
    $data_string = json_encode($data);
    $url = 'http://87.233.64.194:8093/v1/wallet/address/generate';
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
    $json = json_decode($response, true);
    if($response === false)
    {
        echo '<script>alert(Curl error: ' . $response . ')</script>';
    }
    curl_close($ch);
    // print_r("generate: ".$response);
    // print_r("<br />".json_encode($json["wallet"]["accounts"][0]["addresses"][0]));
    // die();
    $address = $json["wallet"]["accounts"][0]["addresses"][0];
    $address = $address;
    $GLOBALS['depositAddress'] = $address;
        verifyAddress($token, $GLOBALS['pairCode'], $address);
}
function verifyAddress($token, $pair, $address) {
    $data = array("type" => $pair, "address" => $address);
    $data_string = json_encode($data);
    $url = 'http://87.233.64.194:8093/v1/wallet/address/verify';
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
    $json = json_decode($response, true);
    if($response === false)
    {
        echo '<script>alert(Curl error: ' . $response . ')</script>';
    }
    curl_close($ch);
    // print_r("verify: ".$response);
    if ($json['status'] == true) {
        watchAddress($token, $pair, $address);
    }
}
function watchAddress($token, $pair, $address) {
    //var_dump("watchVars: ".$token, $pair, $address);
    $query = array();
    parse_str($_SERVER['QUERY_STRING'], $query);
    $myurl = $_SERVER['REQUEST_URI']; //returns the current URL
    $parts = explode('/',$myurl);
    $directory = $parts[1];
    $data = array(
        "type" => $pair,
        "address" => $address,
        "callback" => "http://{$_SERVER['HTTP_HOST']}/{$directory}/confirmation.php?orderId={$query['orderId']}",
        "callbackEmail" => "pizza@gmail.com"
    );
    // print_r('callback address: http://'.$_SERVER['HTTP_HOST'].'/'.$parts[1].'confirmation.php?orderId='.$query['orderId']);
    $data_string = json_encode($data);
    // print_r($data_string);
    $url = 'http://87.233.64.194:8093/v1/wallet/address/watch';
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
    $json = json_decode($response, true);
    if($response === false)
    {
        echo '<script>alert(Curl error: ' . $response . ')</script>';
    }
    curl_close($ch);
    // print_r("watch: ".$response);
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
if($response === false)
{
    echo '<script>alert(Curl error: ' . $response . ')</script>';
}
curl_close($ch);
//var_dump($json["values"][1]);
$key = recursive_array_search($query['orderId'], $json["values"]); // $key = 2;
$values = $json["values"];
//orderid does not already exist
if($key == false) {
    completeOrder();
}
else {
    header('Location: status.php?transactionid='.$values[$key][4]);
    exit();
}
//var_dump($GLOBALS['depositAddress']);
$date = gmdate(DATE_COOKIE);

// server-side call is asking for Google credentials in order to post data so using client-side call for now

// $url = 'https://script.google.com/macros/s/'.$GLOBALS['ordersMacroId'].'/exec';
// $url .= 'orderId='.$_POST['orderId'].'&orderStatus=new&cart='.$_POST['cart'].'&total='.$_POST['total'].'&depositAddress='.$depositAddress.'&depositAmount='.$_POST['depositAmount'].'&pair='.$_POST['pair'].'&name='.$_POST['name'].'&address='.$_POST['address'].'&city='.$_POST['city'].'&state='.$_POST['state'].'&country='.$_POST['country'].'&zip='.$_POST['zip'].'&email='.$_POST['email'].'&phone='.$_POST['phone'].'&timestamp='.$date.'&paymentReceived=FALSE&message='.$_POST['message'];
// $ch = curl_init($url);
// curl_setopt($ch, CURLOPT_POST, FALSE);
// curl_setopt($ch, CURLOPT_HTTPGET, TRUE);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// $response = curl_exec($ch);
// $json = json_decode($response, true);
// curl_close($ch);
// print_r($response);

// $response = curl_exec($ch);
// $json = json_decode($response, true);
// curl_close($ch);

$GLOBALS['depositAmount'] = $query['depositAmount'];

echo '<script src="js/jquery.min.js"></script><script type="text/javascript">
            $.ajax({
            url: "https://script.google.com/macros/s/'.$ordersMacroId.'/exec",
            method: "GET",
            dataType: "json",
            data: {
                "orderId":"'. $query['orderId'] .'",
                "orderStatus":"new",
                "cart":'. $query['cart'] .',
                "total":"'. $query['total'] .'",
                "depositAddress":"'. $GLOBALS['depositAddress'] .'",
                "depositAmount":"'. $query['depositAmount'] .'",
                "pair":"'. $query['pair'] .'",
                "name":"'. $query['name'] .'",
                "address":"'. $query['address'] .'",
                "city":"'. $query['city'] .'",
                "state":"'. $query['state'] .'",
                "country":"'. $query['country'] .'",
                "zip":"'. $query['zip'] .'",
                "email":"'. $query['email'] .'",
                "phone":"'. $query['phone'] .'",
                "timestamp": new Date().toUTCString(),
                "paymentReceived": "NO",
                "message": "'. $query['message'] .'"
            }
          }).success(function () {
            emptyCart();
            console.log("Order Received");
            setTimeout(function(){
                $(".completing_transaction").hide();
                $(".thanks").fadeIn();
                $(".step-three").fadeIn();
            }, 2000);
            });
            </script>';
//Send order completion email to user, then admin
$mailUser = new PHPMailer(false);                              // Passing `true` enables exceptions
try {
    $query = array();
    parse_str($_SERVER['QUERY_STRING'], $query);
    $orderInfo = 'Order ID: '. $query['orderId'] .'<br/>Name: '. $query['name'] .'<br/>Address: '. $query['address'] .'<br/>City: '. $query['city'] .'<br/>State: '. $query['state'] .'<br/>Country: '. $query['country'] .'<br/>Zip Code: '. $query['zip'] .'<br/>Email: '. $query['email'] .'<br/>Phone: '. $query['phone'] .'<br/>Message: '. $query['message'] .'<br/>Total: $'. $query['total'] .'<br/>Currency: '. strtoupper($query['pair']) .'<br/>Deposit Address: '. $GLOBALS['depositAddress'] .'<br/>Deposit Amount: '. $query['depositAmount'];
    $orderInfoNonHtml = 'Order ID: '. $query['orderId'] .'<br/>Name: '. $query['name'] .'<br/>Address: '. $query['address'] .'<br/>City: '. $query['city'] .'<br/>State: '. $query['state'] .'<br/>Country: '. $query['country'] .'<br/>Zip Code: '. $query['zip'] .'<br/>Email: '. $query['email'] .'<br/>Phone: '. $query['phone'] .'<br/>Message: '. $query['message'] .'<br/>Total: $'. $query['total'] .'<br/>Currency: '. strtoupper($query['pair']) .'<br/>Deposit Address: '. $GLOBALS['depositAddress'] .'<br/>Deposit Amount: '. $query['depositAmount'];
    include('user-message.php');
    $mailUser->SMTPDebug = 0;                                 // Enable verbose debug output
    $mailUser->isSMTP();                                      // Set mailer to use SMTP
    $mailUser->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mailUser->Host = 'mail1.antminerhub.com';  // Specify main and backup SMTP servers
    $mailUser->Port = 587;                                    // TCP port to connect to
    $mailUser->SMTPAuth = true;                               // Enable SMTP authentication
    $mailUser->Username = 'orders@antminerhub.com';                 // SMTP username
    $mailUser->Password = 'JxCMqFjzMY';                           // SMTP password
    // $mailUser->SMTPKeepAlive = true;  
    // $mailUser->SMTPAutoTLS  = false;                            // Enable TLS encryption, `ssl` also accepted

    //Recipients
    $mailUser->setFrom('orders@antminerhub.com', 'Antminerhub Orders');
    $mailUser->addAddress($query['email'], 'Antminerhub User');     // Add a recipient
    $mailUser->addAddress('orders@antminerhub.com');               // Name is optional
    $mailUser->addReplyTo('orders@antminerhub.com', 'Antminerhub Support');
    // $mailUser->addCC('cc@example.com');
    // $mailUser->addBCC('bcc@example.com');

    //Attachments
    //$mailUser->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mailUser->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mailUser->isHTML(true);                                  // Set email format to HTML
    $mailUser->Subject = 'Antminerhub Order Confirmation';
    $mailUser->Body    = $userMessage;
    // $mailUser->AltBody = $orderInfoNonHtml;

    $mailUser->send();
    echo '<script>console.log("User email sent successfully.");</script>';
} catch (Exception $e) {
    echo '<script>alert("Could not send mail during order completion: '.$mailUser->ErrorInfo.', please start a new order or contact info@antminerhub.com for assistance.");</script>';
}


$mailAdmin = new PHPMailer(false);                              // Passing `true` enables exceptions
try {
    $query = array();
    parse_str($_SERVER['QUERY_STRING'], $query);
    $adminMessage = 'Order ID: '. $query['orderId'] .'<br/>Name: '. $query['name'] .'<br/>Address: '. $query['address'] .'<br/>City: '. $query['city'] .'<br/>State: '. $query['state'] .'<br/>Country: '. $query['country'] .'<br/>Zip Code: '. $query['zip'] .'<br/>Email: '. $query['email'] .'<br/>Phone: '. $query['phone'] .'<br/>Message: '. $query['message'] .'<br/>Total: $'. $query['total'] .'<br/>Cart: '. $query['cart'] .'<br/>Currency: '. strtoupper($query['pair']) .'<br/>Deposit Address: '. $GLOBALS['depositAddress'] .'<br/>Deposit Amount: '. $query['depositAmount'];

    $mailAdmin->SMTPDebug = 0;                                 // Enable verbose debug output
    $mailAdmin->isSMTP();                                      // Set mailer to use SMTP
    $mailAdmin->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mailAdmin->Host = 'mail1.antminerhub.com';  // Specify main and backup SMTP servers
    $mailAdmin->Port = 587;                                    // TCP port to connect to
    $mailAdmin->SMTPAuth = true;                               // Enable SMTP authentication
    $mailAdmin->Username = 'orders@antminerhub.com';                 // SMTP username
    $mailAdmin->Password = 'JxCMqFjzMY';                           // SMTP password
    // $mailAdmin->SMTPKeepAlive = true;  
    // $mailAdmin->SMTPAutoTLS  = false;                            // Enable TLS encryption, `ssl` also accepted

    //Recipients
    $mailAdmin->setFrom('orders@antminerhub.com', 'Antminerhub Orders');
    $mailUser->addAddress('pizza@gmail.com', 'Antminerhub Admin');     // Add a recipient
    $mailUser->addAddress('orders@antminerhub.com');               // Name is optional
    $mailAdmin->addReplyTo('info@antminerhub.com', 'Antminerhub Support');
    // $mailAdmin->addCC('cc@example.com');
    // $mailAdmin->addBCC('bcc@example.com');

    //Attachments
    //$mailAdmin->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mailAdmin->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mailAdmin->isHTML(true);                                  // Set email format to HTML
    $mailAdmin->Subject = 'Antminerhub Order Confirmation - Admin';
    $mailAdmin->Body    = $adminMessage;

    $mailAdmin->send();
    echo '<script>console.log("Admin email sent successfully.");</script>';
} catch (Exception $e) {
    //echo 'Message could not be sent. Mailer Error: ', $mailAdmin->ErrorInfo;
    echo error_log($mailAdmin->ErrorInfo);
}

?>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
<title>Ant Miner Hub | Antminer ASIC Miners. Fast Shipping.</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-slider.min.css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/slick.css">
<link rel="stylesheet" type="text/css" href="css/style-darkblue.css">
</head>
<style>
    #header-holder.serverspage-header {
    background-color: #142745;
}
</style>
<style>
    .crypto-accepted {
        display:inline-block;
        background:#fff;
        font-weight: bold;
        padding:10px 12px 5px 12px;
        -webkit-border-radius:50px;
        border-radius:50px;
    }
    .crypto-dropdown {
        width:250px;
        padding:0 20px;
        text-align:center;
        line-height:48px;
    }
    .price-title {
        text-decoration: line-through;
    }
    .email {
        white-space:nowrap;
    }
    #header-holder .bg-animation {
        height:135%;
        -webkit-transform: skewY(-2deg);
        transform: skewY(-2deg);
    }
    .cart {
        font-size: 1.5em;
        position: fixed;
        bottom:0;
        right: 0;
        overflow: hidden;
        height: 64px;
        padding: 0 1.195em;
        cursor: pointer;
        color: #abacae;
        border: none;
        background-color: transparent;
    }
    .text-hidden {
        position: absolute;
        top: 200%;
    }
    .cart__count {
        font-size: 9px;
        font-weight: bold;
        line-height: 15px;
        position: absolute;
        top: 50%;
        right: 20px;
        width: 15px;
        height: 15px;
        margin: -16px 0 0 0;
        text-align: center;
        color: #fff;
        border-radius: 50%;
        background: #5c5edc;
    }
    #view-hardware .support-button {
        background-color: #274679;
    }
    #view-hardware .support-button:hover {
        background-color: #3c66ac!important;
        text-decoration:none;
    }
    .pricing-info {
        font-style:italic;
    }
    .pricing-information {
        text-align:left;
        font-size:12px;
        margin-top:20px;
        line-height:20px;
        overflow-y: auto;
        height: 280px;
    }
    .pricing-content img, .pricing-title {
        cursor:pointer;
    }
    .pricing-box {
        margin-top: 20px;
    }
    #pricing {
        padding-top:40px;
    }
    .row-title {
        font-size:30px;
        font-weight:bold;
    }
    .row-title:after {
        display:none;
    }
    ::-webkit-scrollbar-track
    {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        border-radius: 10px;
        background-color: #ffffff;
    }

    ::-webkit-scrollbar
    {
        width: 12px;
        background-color: #ffffff;
    }

    ::-webkit-scrollbar-thumb
    {
        border-radius: 10px;
        -webkit-box-shadow: inset 0 0 6px rgba(255,255,255,.3);
        background-color: #d6e0f5;
    }
    /* @media screen and (max-width:900px) {
        .cart {
            top:initial;
            bottom:0;
        }
    } */
.spinner {
  width: 40px;
  height: 40px;

  position: relative;
  margin: 100px auto;
}

.double-bounce1, .double-bounce2 {
  width: 100%;
  height: 100%;
  border-radius: 50%;
  background-color: #333;
  opacity: 0.6;
  position: absolute;
  top: 0;
  left: 0;
  
  -webkit-animation: sk-bounce 2.0s infinite ease-in-out;
  animation: sk-bounce 2.0s infinite ease-in-out;
}

.double-bounce2 {
  -webkit-animation-delay: -1.0s;
  animation-delay: -1.0s;
}

@-webkit-keyframes sk-bounce {
  0%, 100% { -webkit-transform: scale(0.0) }
  50% { -webkit-transform: scale(1.0) }
}

@keyframes sk-bounce {
  0%, 100% { 
    transform: scale(0.0);
    -webkit-transform: scale(0.0);
  } 50% { 
    transform: scale(1.0);
    -webkit-transform: scale(1.0);
  }
}
.steps h1 {
    margin-top: 0;
    margin-bottom: 40px;
}
label {
    font-weight:16px;
}

#countdown {
    font-size:48px;
    font-weight:bold;
}
</style>
<body>

<div id="header-holder" class="inner-header serverspage-header">
    <?php include('header.php'); ?>
</div>

<div id="ifeatures" class="completing_transaction col-md-12" style="z-index:2;text-align:center;">
    <div class="row-title grey-color">Completing transaction...</div>
    <p>Please wait a moment.</p>
    <div class="spinner">
      <div class="double-bounce1"></div>
      <div class="double-bounce2"></div>
    </div>
</div>
<div id="ifeatures" class="step-three steps sfeatures" style="display:none;text-align:center;">
<!-- <div class="row-title">Deposit to the address below to complete your transaction</div> -->
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
        <label for="pair">Payment Currency</label>
            <h1 id="pair" style="text-transform: uppercase;"><?php echo $query['pair']; ?></h1>
            <!-- <input type="text" name="pair" value="" class="form-control pair" id="pair" dir="auto" aria-label="pair" aria-required="true" placeholder="Pair"> -->
        </div>
        <div class="form-group">
        <label for="depositAddress">Deposit Address</label>
            <h1 id="depositAddress"><?php echo $GLOBALS['depositAddress']; ?></h1>
            <!-- <input type="text" name="depositAddress" value="" class="form-control depositAddress" id="depositAddress" dir="auto" aria-label="depositAddress" aria-required="true" placeholder="Deposit Address"> -->
        </div>
        <div class="form-group">
        <label for="depositAmount">Deposit Amount</label>
            <h1 id="depositAmount"><?php echo $query['depositAmount']; ?></h1>
            <!-- <input type="text" name="depositAmount" value="" class="form-control depositAmount" id="depositAmount" dir="auto" aria-label="depositAmount" aria-required="true" placeholder="Deposit Amount"> -->
        </div>
        <div style="text-align:center;">
            <p>Scan the QR Code below if using a wallet app</p>
            <img src="https://chart.googleapis.com/chart?chs=150x150&chld=L|0&cht=qr&chl=<?php echo $GLOBALS['currency']; ?>:<?php echo $GLOBALS['depositAddress']; ?>?amount=<?php echo $query['depositAmount']; ?>%26label=antminerhub.com%26message=antminerhub.com transaction" />
        </div>
        <div style="text-align:center;">
            <div id="countdown-box">
                <p style="font-size:16px;margin-top:40px;">This rate expires in</p>
                <p id="countdown"></p>
                <p style="font-size:16px;margin-bottom:40px;">If funds are received after the quote has expired,<br>they will be credited at the market rate at the time the funds were received.</p>
            </div>
        </div>
    </div>
</div>
</div>

<div id="ifeatures" class="thanks container-fluid sfeatures" style="display:none;">
    <div class="container">
        <div class="col-md-12">
            <div class="row-title grey-color">Thanks for your order!</div>
            <p>You will receive an email confirmation for your order shortly.</p>
            <p style="font-weight: bold;">DON'T FORGET TO MAKE DEPOSIT OR TRANSACTION WILL NOT COMPLETE.</p>
            <a href="status.php?transactionid=<?php echo $GLOBALS['depositAddress']; ?>" class="ybtn ybtn-accent-color ybtn-shadow">View Status Page</a>
            <a href="index.php" class="ybtn ybtn-blue ybtn-shadow">Continue Shopping</a>
        </div>
    </div>
</div>

<div id="message2" class="container-fluid message-area normal-bg">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="text-other-color1">Questions or comments?</div>
                <div class="text-other-color2">send us an email</div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="buttons-holder"><a href="mailto:info@antminerhub.com" class="ybtn ybtn-white ybtn-shadow">Contact Us</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>
</body>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-slider.min.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/main.js"></script>
<script src="js/moment.js"></script>

<script>
function searchArrayOfArraysOnColumnId(array, orderid, columnId) {
    var orderIdIndex;
    for(var i=1;i<array.length;i++) {
        if (orderid == array[i][columnId]) {
            orderIdIndex = i;
        }
    }
    return orderIdIndex;
}
jQuery(document).ready( function() {
    emptyCart();
    setTimeout( function() {
$.ajax({
    url: "https://sheets.googleapis.com/v4/spreadsheets/<?php echo $GLOBALS['ordersSheetId'] ?>/values/A1:Q500?key=<?php echo $GLOBALS['apiKey'] ?>&majorDimension=ROWS",
    method: "GET",
    dataType: "json"
}).success(function (data) {
    console.log(data);
    window.items = data;
    //console.log(searchFilter(window.items,'<?php echo $GLOBALS['orderid'] ?>'));
    // console.log(search('<?php echo $GLOBALS['orderid'] ?>', window.items));
    //console.log(searchArrayOfArraysOnColumnId(window.items.values, '<?php echo $GLOBALS['orderid'] ?>', 0));
    //console.log(searchArrayOfArraysOnColumnId(window.items.values, '<?php echo $GLOBALS['orderid'] ?>', 16));

    var totalDeposited = searchArrayOfArraysOnColumnId(window.items.values, '<?php echo $GLOBALS['orderid'] ?>', 1);
    var depositRequired = searchArrayOfArraysOnColumnId(window.items.values, '<?php echo $GLOBALS['orderid'] ?>', 5);
    totalDeposited = parseFloat(totalDeposited);
    depositRequired = parseFloat(depositRequired);
    depositRequired = depositRequired - 0.00005;
    if (totalDeposited >= depositRequired) {
        window.location.reload();
    }
    
    // var paymentReceived = searchArrayOfArraysOnColumnId(window.items.values, '<?php echo $GLOBALS['orderid'] ?>', 16);
    //var depositAddress = searchArrayOfArraysOnColumnId(window.items.values, '<?php echo $GLOBALS['orderid'] ?>', 4);
    // if (paymentReceived == "YES") {
    //     window.location.href = 'status.php?transactionid=<?php echo $GLOBALS['depositAddress']; ?>';
    // }
});
},5000);
var timestamp = moment().add(15, 'm').toDate();
console.log('timestamp now: '+moment(timestamp).format('MM-DD-YYYY HH:MM:SS'));
// "Sep 5, 2018 15:37:25"
var countDownDate = new Date(timestamp).getTime();
console.log('countDownDate: '+countDownDate);
// Update the count down every 1 second
var x = setInterval(function() {

    // Get todays date and time
    var now = new Date().getTime();
    console.log('now: '+now);
    // Find the distance between now an the count down date
    var distance = countDownDate - now;
    console.log('distance: '+distance);
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    // Output the result in an element with id="demo"
    document.getElementById("countdown").innerHTML = days + "d " + hours + "h "
    + minutes + "m " + seconds + "s ";
    
    // If the count down is over, write some text 
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("countdown-box").innerHTML = "This rate has EXPIRED";
    }
}, 1000);
if ($('#paymentReceived').text() == "YES") {
    document.getElementById("countdown-box").innerHTML = "FUNDS RECEIVED";
}
});
</script>
</html>