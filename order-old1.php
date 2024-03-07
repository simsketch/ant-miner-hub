<?php
    function processCryptoPaymentPaybear() {
        $orderId = 12345;
        $apiSecret = 'pizzahutpizzahutpizzahut'; //your api key
        $callbackUrl = './thanks.php?id='.$orderId;
        $currency = $_POST['currency'];
        $url = sprintf('https://api.paybear.io/v2/'.$currency.'/payment/%s?token=%s', urlencode($callbackUrl), $apiSecret);
        if ($response = file_get_contents($url)) {
            $response = json_decode($response);
            if (isset($response->data->address)) {
                echo $response->data->address;
                //save $response->data->invoice and keep it secret
            }
        }
    }
    function processCryptoPayment() {
        $request = new HttpRequest();
        $request->setUrl('https://shapeshift.io/sendamount');
        $request->setMethod(HTTP_METH_POST);

        $request->setHeaders(array(
        'Content-Type' => 'application/x-www-form-urlencoded'
        ));

        $request->setContentType('application/x-www-form-urlencoded');
        $request->setPostFields(array(
        'amount' => '.0002',
        'pair' => 'ltc_btc',
        'withdrawal' => 'pizzahutpizzahutpizzahut'
        ));

        try {
        $response = $request->send();

        echo $response->getBody();
        } catch (HttpException $ex) {
        echo $ex;
        }
    }
    function processCryptoPaymentTest() {
        $request = new HttpRequest();
        $request->setUrl('https://shapeshift.io/sendamount');
        $request->setMethod(HTTP_METH_POST);

        $request->setHeaders(array(
        'Content-Type' => 'application/x-www-form-urlencoded'
        ));

        $request->setContentType('application/x-www-form-urlencoded');
        $request->setPostFields(array(
        'amount' => '.0002',
        'pair' => 'ltc_btc'
        ));

        try {
        $response = $request->send();

        echo $response->getBody();
        var_dump($response);
        } catch (HttpException $ex) {
        echo $ex;
        }
    }


    function checkRateOfCryptoPaymentCurl() {
        $url = 'https://shapeshift.io/sendamount';
        // Example parameters
        // $params = 'pair=ltc_btc&amount=.0002';
		$query = array();
		parse_str($_SERVER['QUERY_STRING'], $query);
        $params = 'pair='.$query["pair"].'&amount='.$query["amount"];
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $json = json_decode($response, true);
        curl_close($ch);
        print_r($json);
    }
    function processCryptoPaymentCurl() {
        $url = 'https://shapeshift.io/sendamount';
        // Example parameters
        // $params = 'pair=ltc_btc&amount=.0002&withdrawal=pizzahutpizzahutpizzahut';
		$query = array();
		parse_str($_SERVER['QUERY_STRING'], $query);
        $params = 'pair='.$query["pair"].'&amount='.$query["amount"].'&withdrawal='.$query["withdrawal"];
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $json = json_decode($response, true);
        curl_close($ch);
        print_r($json);
    }
    
	$query = array();
	parse_str($_SERVER['QUERY_STRING'], $query);
    if (!empty($_SERVER['QUERY_STRING'])) {
    	if(!empty($query["withdrawal"])) {
    		processCryptoPaymentCurl();
    	}
    	else {
    		checkRateOfCryptoPaymentCurl();
    	}
	}
  // ------------- BEGIN OF CUSTOMIZABLE INFO ------------------
  // email of the person receiving the contact form (your email)
  $to = 'pizza@gmail.com';
  // your site url (for info in the email)
  $site_url = 'http://antminerhub.com';
  $form_email_label = "Your email:";
  $form_message_label = "Your message:";
  $form_submit_label = "Send";
  $attack_detected = "Sending information to administrator";
  $missing_from =    "Please provide an email address";
  $invalid_from =    "Please provide a valid email address - like name@domain.com";
  $missing_message = "Please insert some text in the message";
  $could_not_send =  "There was a problem while sending the email. Please try again a bit later.";
  // ------------- END OF CUSTOMIZABLE INFO ------------------
  $from_errors = array();
  $message_errors = array();
  $sending_error = array();
  function cleanEmail($email) {
    return trim(strip_tags($email));
  }
  function validEmail($email) {
    $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i";
    return preg_match($pattern, cleanEmail($email));
  }
  function verifyFrom($from){
    if(empty($from))       { array_push($from_errors, $missing_from); }
    if(!validEmail($from)) { array_push($from_errors, $invalid_from); }
    return count($from_errors) == 0;
  }
  function verifyMessage($message) {
    if(empty($message))    { array_push($message_errors, $missing_message); }
    return count($message_errors) == 0;
  }
  if($_POST) {
    $from = $_POST['from'];
    $message = 'Name: '. $_POST['name'] .'<br/>Address: '. $_POST['address'] .'<br/>City: '. $_POST['city'] .'<br/>State: '. $_POST['state'] .'<br/>Country: '. $_POST['country'] .'<br/>Zip Code: '. $_POST['zip'] .'<br/>Email: '. $_POST['email'] .'<br/>Phone: '. $_POST['phone'] .'<br/>Message: '. $_POST['message'] .'<br/>Total: $'. $_POST['total'] .'<br/>Cart: '. $_POST['cart'];
    if (verifyFrom($from) && verifyMessage($message)) {
      $cleanFrom = cleanEmail($from);
      $subject = 'Contact - '. $site_url;
      $headers = "From: " . $cleanFrom . "\r\n";
      $headers .= "Reply-To: ". $cleanFrom . "\r\n";
      $headers .= "MIME-Version: 1.0\r\n";
      $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
      if (mail($to, $subject, $message, $headers)) {
        header('Location: thanks.php');
        die();
      } else {
        array_push($sending_errors, $could_not_send);
      }
    }
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
.form-title {
    color: #756de7;
    font-weight: 300;
    font-size: 19px;
    margin: 30px 0;
    text-align: left;
}
ul.exchange-rates {
    text-align:center;
    margin:30px 0;
}
ul.exchange-rates li{
    list-style-type:none;
    display:inline;
    padding: 30px 20px 10px;
    border: 1px solid #142745;
    border-radius:10px;
    font-weight: bold;
    color:#142745;
}
/* ul.exchange-rates li:before{
    content:"|";
    position:absolute;
    margin-left: -20px;
} */
ul.exchange-rates li:first-of-type:before{
    content:"";
}
ul.exchange-rates li:after {
    margin-top: -30px;
    margin-left: -30px;
    font-weight: normal;
}
#ltc:after {
    content:"LTC";
    position:absolute;
    margin-left: -44px;
}
#eth:after {
    content:"ETH";
    position:absolute;
    margin-left: -44px;
}
#etc:after {
    content:"ETC";
    position:absolute;
    margin-left: -34px;
}
#dash:after {
    content:"DASH";
    position:absolute;
    margin-left: -44px;
}
#btg:after {
    content:"BTG";
    position:absolute;
    margin-left: -34px;
}
#btc:after {
    content:"BTC";
    position:absolute;
    margin-left: -54px;
}
#bch:after {
    content:"BCH";
    position:absolute;
    margin-left: -50px;
}
</style>
<style>
#domain-pricing .htfy-pricing-table-holder .htfy-table .row.trow:before, #domain-pricing .htfy-pricing-table-holder .htfy-table .row .td {
    height: 140px;
    line-height:72px;
}
#domain-pricing .htfy-pricing-table-holder .htfy-table {
    max-width: 980px;
    min-width:450px;
    margin-left:auto;
    margin-right:auto;
}
#total-price::before {
    content:"$";
    position:absolute;
    margin-left:-10px;
}
.register-button {
    cursor:pointer;
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
</style>
<body>

<div id="header-holder" class="inner-header">
    <div class="bg-animation"></div>
    <?php include('header.php') ?>
    <div id="page-head" class="container-fluid inner-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="page-title">Review Order</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="domain-pricing" class="container-fluid" style="max-width:1010px;">
    
<div class="form-title">Select Form of Payment <span style="font-size:12px;">(prices refresh every 10 seconds)</span></div>
<div id="exchange-container">
    <div class="row">
        <div class="col-sm-12">
            <ul class="exchange-rates">
                <li id="ltc"></li>
                <li id="eth"></li>
                <li id="etc"></li>
                <li id="dash"></li>
                <li id="btg"></li>
                <li id="btc"></li>
                <li id="bch"></li>
            </ul>
        </div>
    </div>
</div>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" id="application-form">
<div class="form-title">Payment Information</div>

<!-- <div class="form-title">Payment Information</div>

        <div class="row">
            <div class="col-sm-12">
            <div class="form-group">
                <input type="text" name="name" value="" class="form-control withdrawal" id="name" dir="auto" aria-label="Name" aria-required="true" placeholder="Name">
            </div>
            </div>
        </div> -->
    
<div class="form-title">Shipping Information</div>
        <div class="row">
            <div class="col-sm-12">
            <div class="form-group">
                <input type="text" name="name" value="" class="form-control name" id="name" dir="auto" aria-label="Name" aria-required="true" placeholder="Name">
            </div>
            </div>
            <div class="col-sm-12">
            <div class="form-group">
                <input type="text" name="address" value="" class="form-control address" id="address" dir="auto" aria-label="Address" aria-required="true" placeholder="Address">
            </div>
            </div>
            <div class="col-sm-5">
            <div class="form-group">
                <input type="text" name="city" value="" class="form-control city" id="city" dir="auto" aria-label="City" aria-required="true" placeholder="City">
            </div>
            </div>
            <div class="col-sm-2">
            <div class="form-group">
                <input type="text" name="state" value="" class="form-control state" id="state" dir="auto" aria-label="State" aria-required="true" placeholder="State">
            </div>
            </div>
            <div class="col-sm-3">
            <div class="form-group">
                <input type="text" name="country" value="" class="form-control country" id="country" dir="auto" aria-label="Country" aria-required="true" placeholder="Country">
            </div>
            </div>
            <div class="col-sm-2">
            <div class="form-group">
                <input type="text" name="zip" value="" class="form-control zip" id="zip" dir="auto" aria-label="Zip" aria-required="true" placeholder="Zip Code">
            </div>
            </div>
            <div class="col-sm-6">
            <div class="form-group">
                <input type="text" name="email" value="" class="form-control email" id="email" dir="auto" aria-label="Email" aria-required="true" placeholder="Email">
            </div>
            </div>
            <div class="col-sm-6">
            <div class="form-group">
                <input type="text" name="phone" value="" class="form-control phone" id="phone" dir="auto" aria-label="Phone Number" aria-required="true" placeholder="Phone Number">
            </div>
            </div>
            <div class="col-sm-12">
            <div class="form-group">
                <textarea name="message" value="" class="form-control message" id="message" dir="auto" aria-label="Message" aria-required="true" placeholder="Message"></textarea>
                <input type="hidden" name="cart" value="" class="form-control cart" id="cart" dir="auto" aria-label="Cart" aria-required="true" placeholder="Cart">
                <input type="hidden" name="currency" value="" class="form-control currency" id="currency" dir="auto" aria-label="Currency" aria-required="true" placeholder="Currency">                
            </div>
            </div>
        </div>
<div class="form-title">Cart</div>
</div>
<div id="domain-pricing" class="container-fluid">
<div class="row">
            <div class="col-md-12">
                <div class="htfy-pricing-table-holder">
                    <div class="htfy-table">
                        <div class="row thead">
                            <div class="col-xs-4 th">Item</div>
                            <div class="col-xs-1 th">Qty</div>
                            <div class="col-xs-3 th">Description</div>
                            <div class="col-xs-2 th">Remove</div>
                            <div class="col-xs-2 th">Price</div>
                        </div>
                        <script>
                        var cart = localStorage.getItem("ant-cart");
                        document.getElementById('cart').value = cart;
                            //debugger;
                        if (cart != "" && cart != null) {
                            cart = JSON.parse(cart);
                        var totalItems = 0;
                        Object.keys(cart).forEach(function(k){
                            if (k !="total") {
                            console.log(k + ' - ' + JSON.stringify(cart[k]));
                            totalItems += parseInt(cart[k].qty);
                            }
                        });
                        }
                        console.log(totalItems);
                        if(totalItems > 0) {
                            Object.keys(cart).forEach(function(i){
                                if (i !="total" && cart[i].qty != 0) {
                            document.write('<div class="row trow"><div class="col-xs-4 td"><img src="images/'+i+'.png" style="width:100px"/>'+i+'</div><div class="col-xs-1 td">'+cart[i].qty+'</div><div class="col-xs-3 td">'+cart[i].description+'</div><div class="col-xs-2 td"><a class="register-button" onclick="removeFromCart(\''+i+'\')">X</a></div><div class="col-xs-2 td prices">'+cart[i].price+'</div></div>');
                                }
                            });
                        }
                        else {
                            document.write('<div class="row trow"><div class="col-xs-12 td" style="text-transform:initial"><a href="index.php">There are no items in your cart. Click here to add items.</a></div></div>');
                        }
                        var prices = document.querySelectorAll('.prices');
                        var total = 0;
                        //debugger;
                        for (i=0;i<prices.length;i++) {
                            total += parseInt(prices[i].innerText);
                        }
                        document.write('<div class="row trow"><div class="col-md-10 col-xs-6 td">Total</div><div class="col-md-2 col-xs-6 td" id="total-price">'+total+'<input type="hidden" name="total" value="'+total+'"/></div></div>');
                        // for(i=0;i<Object.keys(cart)-1;i++) {
                        // document.write('<div class="row trow"><div class="col-xs-2 td">'+cart[i]+'</div><div class="col-xs-2 td">'+cart[i].price+'</div><div class="col-xs-2 td">'+cart[i].qty+'</div><div class="col-xs-2 td">'+cart[i].description+'</div><div class="col-xs-2 td"><a onclick="addToCart(\'psu\')">Add PSU</div><div class="col-xs-2 td"><a class="register-button" href="removeFromCart('+cart[i]+')">X</a></div></div>');
                        // }
                        </script>
                    </div>
                </div>
            </div>
            <!-- <div class="col-md-12">
            shipping info
            </div> -->
        </div>
</div>
<div class="container-fluid text-row">
    <div class="container">
        <div class="row" style="max-width:1010;text-align:right;margin-left:auto;margin-right:auto;">
            <div class="col-md-12">
                <div class="text-holder">
                <a href="#" class="ybtn ybtn-white ybtn-shadow" onclick='emptyCart()'>Clear Cart</a>
                <a href="index.php" class="ybtn ybtn-blue ybtn-shadow">Keep Shopping</a>
                <input type="submit" class="ybtn ybtn-accent-color" value="Submit Order"/>
                </div>
            </div>
        </div>
    </div>
</div>
                        </form>
<?php include('footer.php') ?>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-slider.min.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/main.js"></script>
<script>
function retrievePrices() {
    var settings = {
        "async": true,
        "crossDomain": true,
        "url": "https://api.paybear.io/v2/exchange/usd/rate",
        "method": "GET"
    }

    $.ajax(settings)
    .done(function (response) {
        //console.log(response.data);
        Object.keys(response.data).forEach(function(i){
            $('#'+i).text(response.data[i].mid.toFixed(2));
        //console.log(i+' - '+response.data[i].mid);
        });
        // debugger;
        var litecoin_price = parseFloat($('#total-price').text())/parseFloat($('#ltc').text());
        var settings = {
        "async": true,
        "crossDomain": true,
        "url": "https://shapeshift.io/sendamount",
        "method": "POST",
        "headers": {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        "data": {
            "amount": litecoin_price,
            "pair": "ltc_btc"
        }
        }

        // $.ajax(settings).done(function (response) {
        // console.log(response);
        // });
    })
    .fail(function(xhr) {
        console.log('error: ', xhr);
    });
}
retrievePrices();
setInterval(function(){ retrievePrices(); }, 10000);
$( "ul.exchange-rates li" ).click(function() {
    $("ul.exchange-rates li").css({"border":"1px solid #142745"});
    $('input[name=currency]').val($(this)[0].id);
    $(this).css({"border":"2px solid green"});
});

</script>
</body>
</html>
