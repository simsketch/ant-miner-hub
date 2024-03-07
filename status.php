<?php
$configArray = parse_ini_file("config.ini");
$GLOBALS['inventorySheetId'] = $configArray["inventorySheetId"];
$GLOBALS['inventoryMacroId'] = $configArray["inventoryMacroId"];
$GLOBALS['ordersSheetId'] = $configArray["ordersSheetId"];
$GLOBALS['ordersMacroId'] = $configArray["ordersMacroId"];
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
    #status-list {
        max-width:800px;
        margin:0 auto;
        font-size:24px;
        padding:0;
    }
    #status-list li{
        list-style-type:none;
        font-weight:normal;
    }
    #status-list li:before{
        font-weight:bold;
    }
    #status:before {
        content:"Status: ";
    }
    #depositAddress:before {
        content:"Deposit Address: ";
    }
    #withdraw:before {
        content:"Withdraw: ";
    }
    #incomingCoin:before {
        content:"Incoming Coin: ";
    }
    #incomingType:before {
        content:"Incoming Type: ";
    }
    #orderId:before {
        content:"Order Id: ";
    }
    #orderStatus:before {
        content:"Order Status: ";
    }
    #cart:before {
        content:"Cart: ";
    }
    #total:before {
        content:"Total: $";
    }
    #depositAmount:before {
        content:"Deposit Amount: ";
    }
    #currencyPair:before {
        content:"Currency: ";
    }
    #customerName:before {
        content:"Name: ";
    }
    #address:before {
        content:"Address: ";
    }
    #city:before {
        content:"City: ";
    }
    #state:before {
        content:"State: ";
    }
    #country:before {
        content:"Country: ";
    }
    #zip:before {
        content:"Zip: ";
    }
    #email:before {
        content:"Email: ";
    }
    #phone:before {
        content:"Phone: ";
    }
    #timestamp:before {
        content:"Timestamp: ";
    }
    #paymentReceived:before {
        content:"Payment Received: ";
    }
#cart-container .htfy-pricing-table-holder .htfy-table .row.trow:hover, #cart-container .htfy-pricing-table-holder .htfy-table .row.trow:focus {
    z-index: initial;
}
#cart-container .htfy-pricing-table-holder .htfy-table .row.trow:before, #cart-container .htfy-pricing-table-holder .htfy-table .row .td {
    height: 140px;
    line-height:72px;
}
#cart-container .htfy-pricing-table-holder .htfy-table {
    max-width: 980px;
    min-width:450px;
    margin-left:auto;
    margin-right:auto;
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
    #countdown {
        font-size:48px;
        font-weight:bold;
    }
</style>
<?php
$query = array();
parse_str($_SERVER['QUERY_STRING'], $query);
$GLOBALS['orderid'] = $query["transactionid"];

$url = 'https://sheets.googleapis.com/v4/spreadsheets/'.$GLOBALS['ordersSheetId'].'/values/A1:Q500?key='.$GLOBALS['apiKey'].'&majorDimension=ROWS';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, FALSE);
curl_setopt($ch, CURLOPT_HTTPGET, TRUE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$json = json_decode($response, true);
curl_close($ch);
//var_dump($json["values"][1]);
$key = recursive_array_search($GLOBALS['orderid'], $json["values"]); // $key = 2;
//print_r("key: ".$key);
$values = $json["values"];
$GLOBALS['cart'] = $values[$key][2];
$GLOBALS['timestamp'] = $values[$key][15];
$GLOBALS['orderid'] = $values[$key][0];
$GLOBALS['totalDeposited'] = $values[$key][1];
$GLOBALS['depositRequired'] = $values[$key][5];

echo '<body><div id="header-holder" class="inner-header serverspage-header">';

include('header.php');

echo '</div>
<div id="ifeatures" class="container-fluid sfeatures">
    <div class="container">
        <div class="col-md-12">
            <div class="row-title grey-color">Transaction Status</div>';
switch ($values[$key][6]) {
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
if (!$key) {
echo 'No such order with this deposit address exists in our system.';
} else {
echo '<div id="countdown-box">
<p style="font-size:16px;margin-top:40px;">This rate expires in</p>
<p id="countdown"></p>
<p style="font-size:16px;margin-bottom:40px;">If funds are received after the quote has expired,<br>they will be credited at the market rate at the time the funds were received.</p>
</div>

    <ul id="status-list">
        <li id="orderId">'. $values[$key][0] .'</li>
        <li id="orderStatus">'. $values[$key][1] .'</li>';
        // <li id="cart">'. $values[$key][2] .'</li>
echo '<li id="total">'. $values[$key][3] .'</li>
        <li id="depositAddress">'. $values[$key][4] .'</li>
        <li id="depositAmount">'. round($values[$key][5], 5) .'</li>
        <li id="currencyPair">'. $values[$key][6] .'</li>
        <li id="paymentReceived">'. $values[$key][16] .'</li>
        <li id="">&nbsp;</li>';
        if ($values[$key][16] == "NO") {
        echo '
            <p style="font-size:16px;">Scan the QR Code below if using a wallet app</p><img src="https://chart.googleapis.com/chart?chs=125x125&chld=L|0&cht=qr&chl='.$GLOBALS['currency'].':'.$values[$key][4].'?amount='.round($values[$key][5],5).'%26label=antminerhub.com%26message=antminerhub.com transaction" /><li id="">&nbsp;</li>';
        }
        echo '
        <li id="customerName">'. $values[$key][7] .'</li>
        <li id="address">'. $values[$key][8] .'</li>
        <li id="city">'. $values[$key][9] .'</li>
        <li id="state">'. $values[$key][10] .'</li>
        <li id="country">'. $values[$key][11] .'</li>
        <li id="zip">'. $values[$key][12] .'</li>
        <li id="email">'. $values[$key][13] .'</li>
        <li id="phone">'. $values[$key][14] .'</li>
        <li id="timestamp">'. $values[$key][15] .'</li>';
}

echo '</div>
    </div>
</div>';
if (!$key) {} else {
echo '<div id="cart-container" class="container-fluid">
<div class="row">
            <div class="col-md-12">
                <div class="htfy-pricing-table-holder">
                    <div class="htfy-table">
                        <div class="row thead">
                            <div class="col-xs-4 th">Item</div>
                            <div class="col-xs-2 th">Qty</div>
                            <div class="col-xs-4 th">Description</div>
                            <div class="col-xs-2 th">Price</div>
                        </div>
                        <div class="row trow"><div class="col-md-10 col-xs-6 td">Total</div><div class="col-md-2 col-xs-6 td" id="total-price"><input type="hidden" name="total" value=""></div></div>
                    </div>
                </div>
            </div>
        </div>
</div>';
}
echo '<div id="message2" class="container-fluid message-area normal-bg" style="margin-top: 100px;">
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
</div>';
include('footer.php');
?>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-slider.min.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/main.js"></script>
<script src="js/moment.js"></script>
<script>
    if (!Array.prototype.filter){
  Array.prototype.filter = function(func, thisArg) {
    'use strict';
    if ( ! ((typeof func === 'Function' || typeof func === 'function') && this) )
        throw new TypeError();
   
    var len = this.length >>> 0,
        res = new Array(len), // preallocate array
        t = this, c = 0, i = -1;
    if (thisArg === undefined){
      while (++i !== len){
        // checks to see if the key was set
        if (i in this){
          if (func(t[i], i, t)){
            res[c++] = t[i];
          }
        }
      }
    }
    else{
      while (++i !== len){
        // checks to see if the key was set
        if (i in this){
          if (func.call(thisArg, t[i], i, t)){
            res[c++] = t[i];
          }
        }
      }
    }
   
    res.length = c; // shrink down array to proper size
    return res;
  };
}
// function search(nameKey, myArray){
//     for (var i=0; i < myArray.length; i++) {
//         if (myArray[i][0] === nameKey) {
//             return myArray[i];
//         }
//     }
// }
// function searchFilter(array,orderid) {
//     var result = array.filter(function (orderid) {
//       return array.indexOf(el.id) > -1;
//     });
//     return result;
// }
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
    var paymentReceived = searchArrayOfArraysOnColumnId(window.items.values, '<?php echo $GLOBALS['orderid'] ?>', 16);
    var totalDeposited = searchArrayOfArraysOnColumnId(window.items.values, '<?php echo $GLOBALS['orderid'] ?>', 1);
    var depositRequired = searchArrayOfArraysOnColumnId(window.items.values, '<?php echo $GLOBALS['orderid'] ?>', 5);
    totalDeposited = parseFloat(totalDeposited);
    depositRequired = parseFloat(depositRequired);
    depositRequired = depositRequired - 0.00005;
    if (totalDeposited >= depositRequired) {
        window.location.reload();
    }
    // if (paymentReceived == "YES") {
    //     window.location.reload();
    // }
});
},5000);
var timestamp = '<?php echo $GLOBALS['timestamp'] ?>';
    timestamp = timestamp.replace(' GMT','');
    timestamp = moment(timestamp).utc(-4).add(15, 'm').toDate();
// "Sep 5, 2018 15:37:25"
var countDownDate = new Date(timestamp).getTime();

// Update the count down every 1 second
var x = setInterval(function() {

    // Get todays date and time
    var now = new Date().getTime();
    
    // Find the distance between now an the count down date
    var distance = countDownDate - now;
    
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
</body>
<script>
    var cart = JSON.parse('<?php echo $GLOBALS["cart"] ?>');
        Object.keys(cart).forEach(function(i){
        if (cart[i].qty != undefined && cart[i].qty != 0) {
            $('.thead').after('<div class="row trow"><div class="col-xs-4 td"><img src="images/'+i+'.png" style="width:100px"/>'+i+'</div><div class="col-xs-2 td qty">'+cart[i].qty+'</div><div class="col-xs-4 td">'+cart[i].description+'</div><div class="col-xs-2 td prices">'+cart[i].price+'</div>');
        }
        });
    </script>
</html>