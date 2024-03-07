<?php
$configArray = parse_ini_file("config.ini");
$inventorySheetId = $configArray["inventorySheetId"];
$inventoryMacroId = $configArray["inventoryMacroId"];
$ordersSheetId = $configArray["ordersSheetId"];
$ordersMacroId = $configArray["ordersMacroId"];
$apiKey = $configArray["apiKey"];
$bitcoinWallet = $configArray["bitcoinWallet"];
$litecoinWallet = $configArray["litecoinWallet"];

function guid(){
    if (function_exists('com_create_guid')){
        return com_create_guid();
    }else{
        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid = substr($charid, 0, 8).$hyphen
                .substr($charid, 8, 4).$hyphen
                .substr($charid,12, 4).$hyphen
                .substr($charid,16, 4).$hyphen
                .substr($charid,20,12);
        return $uuid;
    }
}
$GLOBALS['orderid'] = guid();
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
    margin: 30px auto;
    text-align: left;
    max-width: 980px;
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
    cursor:pointer;
}
/* ul.exchange-rates li:before{
    content:"|";
    position:absolute;
    margin-left: -20px;
} */
/*ul.exchange-rates li:first-of-type:before{
    content:"";
}*/
#exchange-container {
    text-align:center;
}
.currency-container {
    background: #142745;
    color: #fff;
    padding: 20px 20px 30px;
    border: 4px solid white;
    cursor:pointer;
}
.currency-container:nth-of-type(7) {
    background:#081730;
}
.currency-container:nth-of-type(6) {
    background:#142745;
}
.currency-container:nth-of-type(5) {
    background:#2B4060;
}
.currency-container:nth-of-type(4) {
    background:#344C72;
}
.currency-container:nth-of-type(3) {
    background:#52709E;
}
.currency-container:nth-of-type(2) {
    background:#6D8DBC;
}
.currency-container:nth-of-type(1) {
    background:#93acd3;
}
.currency-container div:before{
    content:"$";
}
/*@media (min-width: 768px) {
    .currency-container {
        width: 14.25%;
    }
}*/
#ifeatures.sfeatures {
    padding: 100px 0;
}
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
</style>
<style>
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
    #quote-amount {
        display:none;
    }
</style>
<body>

<div id="header-holder" class="inner-header">
    <div class="bg-animation"></div>
    <?php include('header.php') ?>
    <div id="page-head" class="container-fluid inner-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div id="page-title" class="page-title">Review Order</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container" style="max-width:800px;">

<!-- shipping information -->
<div id="step-one" class="steps">
<div class="form-title">Shipping Information<button onclick="restoreFormValues()" class="ybtn ybtn-white ybtn-shadow ybtn-small" style="float:right">Restore Form Values</button></div>
<p>*denotes required field</p>
<form id="shippingInfo">
<div class="row">
    <div class="col-sm-4">
    <div class="form-group">
        <label>First Name*</label>
        <input type="text" name="firstname" value="" class="form-control firstname" id="firstname" dir="auto" aria-label="First Name" placeholder="First Name">
    </div>
    </div>
    <div class="col-sm-4">
    <div class="form-group">
        <label>Last Name*</label>
        <input type="text" name="lastname" value="" class="form-control lastname" id="lastname" dir="auto" aria-label="Last Name" placeholder="Last Name">
    </div>
    </div>
    <div class="col-sm-4">
    <div class="form-group">
        <label>Email Address*</label>
        <input type="text" name="email" value="" class="form-control email" id="email" dir="auto" aria-label="Email" placeholder="Email">
    </div>
    </div>
    <div class="col-sm-12">
    <div class="form-group">
        <label>Mailing Address*</label>
        <input type="text" name="address" value="" class="form-control address" id="address" dir="auto" aria-label="Mailing Address" placeholder="Mailing Address">
    </div>
    </div>
    <div class="col-sm-6">
    <div class="form-group">
        <label>City*</label>
        <input type="text" name="city" value="" class="form-control city" id="city" dir="auto" aria-label="City" placeholder="City">
    </div>
    </div>
    <div class="col-sm-3">
    <div class="form-group">
        <label>Country*</label>
        <select name="country" class="form-control countries order-alpha presel-byip  group-continents group-order-alpha" id="countryId">
            <option value="">Select Country</option>
        </select>
    </div>
    </div>
    <div class="col-sm-3">
    <div class="form-group">
        <label>State/Province*</label>
        <select name="state" class="form-control states order-alpha" id="stateId">
            <option value="">Select State/Province</option>
        </select>
    </div>
    </div>
    <div class="col-sm-6">
    <div class="form-group">
        <label>Postal Code*</label>
        <input type="text" name="zip" value="" class="form-control zip" id="zip" dir="auto" aria-label="Zip" placeholder="Postal Code">
    </div>
    </div>
    <div class="col-sm-6">
    <div class="form-group">
        <label>Phone Number</label>
        <input type="text" name="phone" value="" class="form-control phone" id="phone" dir="auto" aria-label="Phone Number" placeholder="Phone Number">
    </div>
    </div>
    <div class="col-sm-12">
    <div class="form-group">
        <label>Message</label>
        <textarea name="message" value="" class="form-control message" id="message" dir="auto" aria-label="Message" placeholder="Message"></textarea>
    </div>
    </div>
</form>
    <div class="col-sm-12 text-center">
     <a href="javascript:document.getElementById('shippingInfo').reset();" class="ybtn ybtn-white ybtn-shadow">Clear</a>
     <a href="javascript:stepTwo();" class="ybtn ybtn-accent-color">Next</a>
     </div>
</div>
</div>

<div id="step-two" class="steps">
<div class="form-title">Select Form of Payment <span style="font-size:12px;">(prices refresh every 10 seconds)</span></div>
<div id="exchange-container">
    <div class="row">
        <div class="col-sm-2 currency-container">
            <h3>LTC</h3>
            <div id="ltc">&nbsp;<img src="images/loading-dots.gif" /></div>
        </div>
        <div class="col-sm-2 currency-container">
            <h3>ETH</h3>
            <div id="eth">&nbsp;<img src="images/loading-dots.gif" /></div>
        </div>
        <div class="col-sm-2 currency-container">
            <h3>ETC</h3>
            <div id="etc">&nbsp;<img src="images/loading-dots.gif" /></div>
        </div>
        <div class="col-sm-2 currency-container">
            <h3>DASH</h3>
            <div id="dash">&nbsp;<img src="images/loading-dots.gif" /></div>
        </div>
        <div class="col-sm-2 currency-container">
            <h3>BTC</h3>
            <div id="btc">&nbsp;<img src="images/loading-dots.gif" /></div>
        </div>
        <div class="col-sm-2 currency-container">
            <h3>BCH</h3>
            <div id="bch">&nbsp;<img src="images/loading-dots.gif" /></div>
        </div>
        <div class="col-sm-12 text-center" style="margin-top:30px;">
            <a href="javascript:startOver();" class="ybtn ybtn-white ybtn-shadow">Go Back</a>
            <a href="" id="complete-order" class="ybtn ybtn-accent-color ybtn-shadow">Get Deposit Address</a>
        </div>
    </div>
</div>
</div>

<div id="cart-container" class="container-fluid">
<div class="form-title">Cart</div>
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
                            //debugger;
                        if (cart != "" && cart != null) {
                            cart = JSON.parse(cart);
                        var totalItems = 0;
                        Object.keys(cart).forEach(function(k){
                            if (k !="total") {
                            //console.log(k + ' - ' + JSON.stringify(cart[k]));
                            totalItems += parseInt(cart[k].qty);
                            }
                        });
                        }
                        //console.log(totalItems);
                        if(totalItems > 0) {
                            Object.keys(cart).forEach(function(i){
                                if (i !="total" && cart[i].qty != 0) {
                            document.write('<div class="row trow"><div class="col-xs-4 td"><img src="images/'+i+'.png" style="width:100px"/>'+i+'</div><div class="col-xs-1 td qty">'+cart[i].qty+'</div><div class="col-xs-3 td">'+cart[i].description+'</div><div class="col-xs-2 td"><a class="register-button" onclick="removeFromCart(\''+i+'\')">X</a></div><div class="col-xs-2 td prices">'+cart[i].price+'</div></div>');
                                }
                            });
                        }
                        else {
                            document.write('<div class="row trow"><div class="col-xs-12 td" style="text-transform:initial"><a href="index.php">There are no items in your cart. Click here to add items.</a><input type="hidden" value="true" name="zeroItems" id="zeroItems"/></div></div>');
                        }
                        var prices = document.querySelectorAll('.prices');
                        var qty = document.querySelectorAll('.qty');
                        var total = 0;
                        //debugger;
                        for (i=0;i<prices.length;i++) {
                            var amount = parseInt(prices[i].innerText)*parseInt(qty[i].innerText);
                            total += amount;
                        }
                        if(total<5000) {
                        document.write('<div class="row trow"><div class="col-md-10 col-xs-6 td">Total</div><div class="col-md-2 col-xs-6 td" id="total-price">'+total+'<input type="hidden" name="total" value="'+total+'"/></div></div>');
                        }
                        else {
                        document.write('<div class="row trow"><div class="col-md-10 col-xs-6 td">Total</div><div class="col-md-2 col-xs-6 td" id="total-price" style="font-weight:bold;color:red;">'+total+'<input type="hidden" name="total" value="'+total+'"/></div> Because of cryptocurrency exchange limits, please keep total below $5000.</div>');
                        }
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
            <div id="cart-buttons" class="container-fluid text-row">
                <div class="row" style="margin-left:auto;margin-right:auto;">
                    <div class="col-md-12" style="margin-right:0;margin-top:30px;">
                        <div class="text-holder">
                        <a href="#" class="ybtn ybtn-white ybtn-shadow" onclick='emptyCart()'>Clear Cart</a>
                        <a href="index.php" class="ybtn ybtn-blue ybtn-shadow">Keep Shopping</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<!-- <input type="hidden" id="" name="" value="" />
<input type="hidden" id="" name="" value="" />
<input type="hidden" id="" name="" value="" />
<input type="hidden" id="" name="" value="" />
<input type="hidden" id="" name="" value="" />
<input type="hidden" id="" name="" value="" />
<input type="hidden" id="" name="" value="" />
<input type="hidden" id="" name="" value="" />
<input type="hidden" id="" name="" value="" />
<input type="hidden" id="" name="" value="" />
<input type="hidden" id="" name="" value="" />
<input type="hidden" id="" name="" value="" />
<input type="hidden" id="" name="" value="" />
<input type="hidden" id="" name="" value="" />
<input type="hidden" id="" name="" value="" />
<input type="hidden" id="" name="" value="" />
<input type="hidden" id="" name="" value="" /> -->
</div>
<?php include('footer.php') ?>

</body>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-slider.min.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/main.js"></script>
<script src="js/countrystate.js"></script>
<script>
function restoreFormValues() {
    var details = JSON.parse(localStorage.getItem('shippingForm'));
    var name = details[0].split(' ');
    jQuery('#step-one input[name=firstname]').val(name[0]);
    jQuery('#step-one input[name=lastname]').val(name[1]);
    jQuery('#step-one input[name=address]').val(details[1]);
    jQuery('#step-one input[name=city]').val(details[2]);
    jQuery('#step-one select[name=state]').val(details[3]);
    jQuery('#step-one select[name=country]').val(details[4]);
    jQuery('#step-one input[name=zip]').val(details[5]);
    jQuery('#step-one input[name=email]').val(details[6]);
    jQuery('#step-one input[name=phone]').val(details[7]);
    jQuery('#step-one textarea').val(details[8]);
}
function retrievePrices() {
    var settings = {
        "async": true,
        "crossDomain": true,
        "url": "https://api.paybear.io/v2/exchange/usd/rate",
        "method": "GET"
    }
    jQuery('#exchange-container div div div').html('<img src="images/loading-dots.gif"/>');
    jQuery.ajax(settings)
    .done(function (response) {
        Object.keys(response.data).forEach(function(i){
            $('#'+i).text(response.data[i].mid.toFixed(2));
        });
    })
    .fail(function(xhr) {
        console.log('error: ', xhr);
    });
}
retrievePrices();
setInterval(function(){
    retrievePrices();
}, 10000);

function resetCompleteOrderButton() {
    jQuery('#complete-order').attr("disabled", false).css({"backgroundColor":"#689af1"});
}

function startOver() {
    jQuery('.steps').hide();
    jQuery('#step-one').show();
    jQuery('input[name=currency]').val("");
    jQuery(".currency-container").css({"border":"4px solid #fff"});
    jQuery('#complete-order').attr("href","javascript:alert('Please select a cryptocurrency');");
}
startOver();

function stepTwo() {
    var name = jQuery('#step-one input[name=firstname]').val() + ' ' + jQuery('#step-one input[name=lastname]').val();
    var address = jQuery('#step-one input[name=address]').val();
    var city = jQuery('#step-one input[name=city]').val();
    var state = jQuery('#step-one select[name=state]').val();
    var country = jQuery('#step-one select[name=country]').val();
    var zip = jQuery('#step-one input[name=zip]').val();
    var email = jQuery('#step-one input[name=email]').val();
    var phone = jQuery('#step-one input[name=phone]').val();
    var message = jQuery('#step-one textarea').val();
    var details = [name,address,city,state,country,zip,email,phone,message];
    localStorage.setItem('shippingForm',JSON.stringify(details));
    var re = /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/i;
    var validEmail = email.match(re);
    if (!validEmail) {
        alert("Please enter a valid email address.");
    }
    else {
        if ((jQuery('input[name=firstname]').val() != "") && (jQuery('input[name=lastname]').val() != "") && (jQuery('input[name=address]').val() != "") && (jQuery('input[name=city]').val() != "") && (jQuery('input[name=state]').val() != "") && (jQuery('input[name=country]').val() != "") && (jQuery('input[name=zip]').val() != "") && (jQuery('input[name=email]').val() != "")) {
            jQuery('#step-one').hide();
            jQuery('#step-two').show();
        }
        else {
            alert("Please fill out all required form fields.");
        }
    }
}

jQuery( ".currency-container" ).click(function() {
    jQuery('#quote-amount').show();
    var selectedCurrency = $(this)[0].lastElementChild.id;
    jQuery(".currency-container").css({"border":"4px solid #fff"});
    jQuery('input[name=currency]').val(selectedCurrency);
    jQuery(this).css({"border":"4px solid #3cff94"});
    var total = $('#total-price').text();
    var amount = parseFloat(total)/parseFloat($('#'+selectedCurrency).text());
    amount = amount.toFixed(5);
    var cart = localStorage.getItem('ant-cart');
    var name = jQuery('#step-one input[name=firstname]').val() + ' ' + jQuery('#step-one input[name=lastname]').val();
    var address = jQuery('#step-one input[name=address]').val();
    var city = jQuery('#step-one input[name=city]').val();
    var state = jQuery('#step-one select[name=state]').val();
    var country = jQuery('#step-one select[name=country]').val();
    var zip = jQuery('#step-one input[name=zip]').val();
    var email = jQuery('#step-one input[name=email]').val();
    var phone = jQuery('#step-one input[name=phone]').val();
    var message = jQuery('#step-one textarea').val();
    cart = JSON.stringify(cart);
    jQuery('#complete-order').attr("href","complete.php?orderId=<?php echo $GLOBALS['orderid'] ?>&cart="+cart+"&total="+total+"&pair="+selectedCurrency+"&depositAmount="+amount+"&name="+name+"&address="+address+"&city="+city+"&state="+state+"&country="+country+"&zip="+zip+"&email="+email+"&phone="+phone+"&message="+message);

});
jQuery('#complete-order').click(function() {
    if(jQuery(this).attr("href").includes("complete")) {
        jQuery(this).attr("disabled", "disabled").css({"backgroundColor":"#959595"});
    }
});

</script>
</html>