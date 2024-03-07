<!doctype html>
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
#cart-container .htfy-pricing-table-holder .htfy-table .row.trow:before, #cart-container .htfy-pricing-table-holder .htfy-table .row .td {
    height: 140px;
    line-height:72px;
}
#cart-container .htfy-pricing-table-holder .htfy-table {
    max-width: 980px;
    min-width:325px;
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
                    <div class="page-title">Checkout</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="banner-image" style="text-align:center;margin-top:20px;">
    <a href="#" onclick="addToCart('psu');window.location.reload();"><img src="images/add-psu-to-cart.jpg" style="width:100%;max-width:728px;" /></a>
</div>
<div id="cart-container" class="container-fluid">
<div class="row">
            <div class="col-md-12">
                <div class="htfy-pricing-table-holder">
                    <div class="htfy-table">
                        <div class="row thead">
                            <div class="col-xs-4 th">Item</div>
                            <div class="col-xs-2 col-sm-1 th">Qty</div>
                            <div class="col-xs-3 hidden-xs th">Description</div>
                            <div class="col-xs-3 col-sm-2 th">Remove</div>
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
                            console.log(k + ' - ' + JSON.stringify(cart[k]));
                            totalItems += parseInt(cart[k].qty);
                            }
                        });
                        }
                        console.log(totalItems);
                        if(totalItems > 0) {
                            Object.keys(cart).forEach(function(i){
                                if (i !="total" && cart[i].qty != 0) {
                            document.write('<div class="row trow"><div class="col-xs-4 td" style="line-height:10px;"><img src="images/'+i+'.png" style="width:100px"/>'+i+'</div><div class="col-xs-2 col-sm-1 td qty">'+cart[i].qty+'</div><div class="col-xs-3 hidden-xs td">'+cart[i].description+'</div><div class="col-xs-3 col-sm-2 td"><a class="register-button" onclick="removeFromCart(\''+i+'\')">X</a></div><div class="col-xs-2 td prices">'+cart[i].price+'</div></div>');
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
                        document.write('<div class="row trow"><div class="col-md-10 col-xs-12 td">Total</div><div class="col-md-2 col-xs-12 td" id="total-price">'+total+'<input type="hidden" name="total" value="'+total+'"/></div></div>');
                        }
                        else {
                        document.write('<div class="row trow"><div class="col-md-10 col-xs-12 td">Total</div><div class="col-md-2 col-xs-12 td" id="total-price" style="font-weight:bold;color:red;">'+total+'<input type="hidden" name="total" value="'+total+'"/></div> Because of cryptocurrency exchange limits, please keep total below $5000.</div>');
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
        </div>
</div>
<div class="container-fluid text-row">
    <div class="container">
        <div class="row">
            <div class="col-md-12" style="text-align:right">
                <div class="text-holder">
                <a href="#" class="ybtn ybtn-white ybtn-shadow" onclick='emptyCartAndReload()'>Clear Cart</a>
                <a href="index.php" class="ybtn ybtn-blue ybtn-shadow">Keep Shopping</a>
                <script>
                    if(document.getElementById('zeroItems') == null )
                document.write('<a href="order.php" class="ybtn ybtn-accent-color">Finish Checkout</a>');
                </script>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php') ?>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-slider.min.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
