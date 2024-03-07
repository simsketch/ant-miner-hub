<?php
    $configArray = parse_ini_file("config.ini");
    $inventorySheetId = $configArray["inventorySheetId"];
    $inventoryMacroId = $configArray["inventoryMacroId"];
    $ordersSheetId = $configArray["ordersSheetId"];
    $ordersMacroId = $configArray["ordersMacroId"];
    $apiKey = $configArray["apiKey"];
    $s9price = $configArray["s9price"];
    $l3price = $configArray["l3price"];
    $d3price = $configArray["d3price"];
    $s9hosting = $configArray["s9hosting"];
    $l3hosting = $configArray["l3hosting"];
    $d3hosting = $configArray["d3hosting"];
    $psuprice = $configArray["psuprice"];
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
<link rel="stylesheet" href="css/swiper.css" />
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
    .pricing-box .pricing-content .pricing-details p {
        margin-bottom:-10px;
    }
    .pricing-price {
        margin-bottom:0;
    }
    .pricing-link {
        margin-top:30px;
    }
    .inventory-amount {
        font-style:italic;
        margin-bottom:30px;
    }
    .inventory-amount span {
        font-weight:bold;
        color:#403d5a;
    }
    .pricing-box .pricing-content .pricing-title {
        margin-bottom:initial;
    }
    .pricing-box .pricing-content {
        padding-top:45px;
    }
    .add-miner-psu, .add-miner-hosting {
        display:none;
    }
    .ybtn {
        font-size:14px;
    }
    .swiper-container {
    width: 210px;
    height: 204px;
}
.swiper-button-prev, .swiper-button-next {
    position: absolute;
    top: 50%;
    width: 12px;
    height: 62px;
    margin-top: -45px;
    z-index: 10;
    cursor: pointer;
    background-size: 20px 21px;
    background-position: center;
    background-repeat: no-repeat;
    filter: brightness(2) hue-rotate(-40deg);
}
</style>
</head>
<body>
<div id="header-holder">
    <div class="bg-animation"></div>
    <?php include('header.php') ?>
    <div id="top-content" class="container-fluid" style="display:none">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="main-slider">
                        <div class="slide domainsearch-slide">
                            <div class="big-title">Great prices<br> on awesome <span>crypto hardware.</span>
                                <div id="view-hardware" class="support-button-holder">
                                    <a onclick="scrollToHardware()" class="support-button">View Hardware</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="pricing" class="container-fluid">
    <div class="bg-color"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row-title">Antminer ASIC miners. Fast shipping.</div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <div class="pricing-box pricing-color1">
                    <div class="pricing-content">
                        <div class="pricing-title" data-id="s9">Bitmain Antminer S9</div>
                        <div class="pricing-details">
                            <p>The world’s most efficient miner and world's first bitcoin mining ASIC based on the 16nm process node.</p>
                        </div>
                        
                        <!-- Slider main container -->
                        <div class="swiper-container">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">
                                <!-- Slides -->
                                <div class="swiper-slide"><img src="images/s9-1.jpg" data-id="s9" style="width:100%;" /></div>
                                <div class="swiper-slide"><img src="images/s9-2.jpg" data-id="s9" style="width:100%;" /></div>
                                ...
                            </div>
                            <!-- If we need pagination -->
                            <div class="swiper-pagination"></div>
                         
                            <!-- If we need navigation buttons -->
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>

                        <div class="inventory-amount">Only <span id="s9inventory"></span> remaining!</div>
                        <div class="price-title">$4999</div>
                        <div class="pricing-price">$<?php echo $s9price ?></div>
                        <label><input type="checkbox" class="s9-hosting-checkbox"/> Add Icelandic hosting to order for $<?php echo $s9hosting ?>/month</label>
                        <label><input type="checkbox" class="psu-checkbox"/> Add PSU to order for $<?php echo $psuprice ?></label>
                        <div class="pricing-link">
                            <a class="ybtn add-to-cart add-miner" href="javascript:addToCart('s9')" id="s9-miner">+Add Miner to Cart</a>
                            <a class="ybtn add-to-cart add-miner-psu" href="javascript:addToCart('s9');addToCart('psu')" id="s9-miner-psu">+Add Miner &amp; PSU to Cart</a>
                            <a class="ybtn add-to-cart add-miner-hosting" href="javascript:addToCart('s9');addToCart('psu');addToCart('s9hosting')" id="s9-miner-hosting">+Add Miner, PSU &amp; Hosting</a>
                        </div>
                        <div class="pricing-information"><b>Hash Rate:</b> 13.5TH/s ±5%
                                <br/><b>Power Consumption:</b> 1300W + 12% (at the wall, with APW3 ,93% efficiency, 25C ambient temp)
                                <br/><b>Power Efficiency:</b> 0.1 J/GH + 12%(at the wall, with APW3 93% efficiency, 25°C ambient temp)
                                <br/><b>Rated Voltage:</b> 11.60 ~13.00V
                                <br/><b>Chip quantity per unit:</b> 189 x BM1387
                                <br/><b>Dimensions:</b> 350mm(L)*135mm(W)*158mm(H)
                                <br/><b>Cooling:</b> 2 x 12038 fan
                                <br/><b>Operating Temperature:</b> 0 °C to 40 °C
                                <br/><b>Network Connection:</b> Ethernet 
                                <br/><b>Default Frequency:</b> 550M +</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="pricing-box pricing-color2 featured">
                    <div class="pricing-content">
                        <div class="pricing-title" data-id="l3">Bitmain Antminer L3</div>
                        <div class="pricing-details">
                            <p>The Bitmain Antminer L3 is the most powerful Litecoin miner on the market at 504 MH/s.</p>
                        </div>
                        
                        <!-- Slider main container -->
                        <div class="swiper-container">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">
                                <!-- Slides -->
                                <div class="swiper-slide"><img src="images/l3-1.jpg" data-id="l3" style="width:100%;" /></div>
                                <div class="swiper-slide"><img src="images/l3-2.jpg" data-id="l3" style="width:100%;" /></div>
                                ...
                            </div>
                            <!-- If we need pagination -->
                            <div class="swiper-pagination"></div>
                         
                            <!-- If we need navigation buttons -->
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                        
                        <div class="inventory-amount">Only <span id="l3inventory"></span> remaining!</div>
                        <div class="price-title">$3999</div>
                        <div class="pricing-price">$<?php echo $l3price ?></div>
                        <label><input type="checkbox" class="l3-hosting-checkbox"/> Add Icelandic hosting to order for $<?php echo $l3hosting ?>/month</label>
                        <label><input type="checkbox" class="psu-checkbox" /> Add PSU to order for $<?php echo $psuprice ?></label>
                        <div class="pricing-link">
                            <a class="ybtn add-to-cart add-miner" href="javascript:addToCart('l3')" id="l3-miner-psu">+Add Miner to Cart</a>
                            <a class="ybtn add-to-cart add-miner-psu" href="javascript:addToCart('l3');addToCart('psu')" id="l3-miner-psu">+Add Miner &amp; PSU to Cart</a>
                            <a class="ybtn add-to-cart add-miner-hosting" href="javascript:addToCart('l3');addToCart('psu');addToCart('l3hosting')" id="l3-miner-hosting">+Add Miner, PSU &amp; Hosting</a>
                        </div>
                        <div class="pricing-information">
                                <b>Machine arithmetic:</b> 504M / S
                                <br/><b>Wall power consumption:</b> 800W ± 10% (ordinary APW3 + + power / multi-port version of APW3 + + power supply, AC / DC 93% efficiency, 25 ℃ ambient temperature)
                                <br/><b>Power efficiency:</b> 1.6J / MH ± 10% (wall, AC / DC 93% efficiency, 25 ° C ambient temperature)
                                <br/><b>Input voltage:</b> 11.6 ~ 13.0V
                                <br/><b>Number of chips:</b> 288PCS
                                <br/><b>The number of arithmetic boards in the machine:</b> 4PCS
                                <br/><b>Carton size:</b> 465 mm (L) * 215 mm (W) * 305 mm (H)
                                <br/><b>Machine weight (including packaging):</b> 5.2kg
                                <br/><b>Operating temperature:</b> 0 ℃ to 40 ℃
                                <br/><b>Operating humidity:</b> 5% RH-95% RH, non-condensing
                                <br/><b>Network connection:</b> Ethernet
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="pricing-box pricing-color3">
                    <div class="pricing-content">
                        <div class="pricing-title" data-id="d3">Bitmain Antminer D3</div>
                        <div class="pricing-details">
                            <p>The Bitmain Antminer D3 is the most powerful Dash coin miner on the market at 19.3 GH/s</p>
                        </div>
                        
                        <!-- Slider main container -->
                        <div class="swiper-container">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">
                                <!-- Slides -->
                                <div class="swiper-slide"><img src="images/d3-1.jpg" data-id="d3" style="width:100%;" /></div>
                                <div class="swiper-slide"><img src="images/d3.png" data-id="d3" style="width:100%;" /></div>
                                ...
                            </div>
                            <!-- If we need pagination -->
                            <div class="swiper-pagination"></div>
                         
                            <!-- If we need navigation buttons -->
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                        
                        <div class="inventory-amount">Only <span id="d3inventory"></span> remaining!</div>  
                        <div class="price-title">$1999</div>
                        <div class="pricing-price">$<?php echo $d3price ?></div>
                        <label><input type="checkbox" class="d3-hosting-checkbox"/> Add Icelandic hosting to order for $<?php echo $d3hosting ?>/month</label>
                        <label><input type="checkbox" class="psu-checkbox" /> Add PSU to order for $<?php echo $psuprice ?></label>
                        <div class="pricing-link">
                            <a class="ybtn add-to-cart add-miner" href="javascript:addToCart('d3')" id="d3-miner-psu">+Add Miner to Cart</a>
                            <a class="ybtn add-to-cart add-miner-psu" href="javascript:addToCart('d3');addToCart('psu')" id="d3-miner-psu">+Add Miner &amp; PSU to Cart</a>
                            <a class="ybtn add-to-cart add-miner-hosting" href="javascript:addToCart('d3');addToCart('psu');addToCart('d3hosting')" id="d3-miner-hosting">+Add Miner, PSU &amp; Hosting</a>
                        </div>
                        <div class="pricing-information">
                                <b>Hash rate:</b> 19.3 GH/s (Variation of ±5% is expected)
                                <br/><b>Power consumption:</b> 1200W (at the wall, with Bitmain’s APW3 PSU, 93% efficiency, 25°C ambient temp).
                                <br/><b>Dimensions of the miner:</b> 320*130*190mm
                                <br/><b>Hashing algorithm:</b> X11
                                <br/><b>Weight:</b> 5.5KG
                                <br/><b>Temperature Range:</b> 0-40&deg;C
                                <br/><b>Network:</b> Ethernet
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="more-features" class="container-fluid">
    <div class="container">
        <!-- <div class="row">
            <div class="col-md-12">
                <div class="row-title">Our Promise</div>
            </div>
        </div> -->
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <div class="mfeature-box">
                    <div class="mfeature-icon">
                        <i class="htfy htfy-tick"></i>
                    </div>
                    <div class="mfeature-title">Authentic Hardware</div>
                    <div class="mfeature-details">Genuine equipment from the best name in the business.</div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="mfeature-box">
                    <div class="mfeature-icon">
                        <i class="htfy htfy-tick"></i>
                    </div>
                    <div class="mfeature-title">Plug 'n Play</div>
                    <div class="mfeature-details">Minimal configuration means you can start mining coins immediately.</div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="mfeature-box">
                    <div class="mfeature-icon">
                        <i class="htfy htfy-tick"></i>
                    </div>
                    <div class="mfeature-title">Fast Shipping</div>
                    <div class="mfeature-details">Get a coin mining server shipped straight to your doorstep.</div>
                </div>
            </div>
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
<?php include('footer.php') ?>
<script src="js/swiper.js"></script>
<script>
$(document).ready( function() {
    var mySwiper = new Swiper ('.swiper-container', {
    // Optional parameters
    //direction: 'vertical',
    loop: true,

    // If we need pagination
    pagination: {
      el: '.swiper-pagination',
    },

    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },

    // And if we need scrollbar
    // scrollbar: {
    //   el: '.swiper-scrollbar',
    // },
  })
    //https://docs.google.com/spreadsheets/d/1m0c5SPmni_YWBGsr6FhKMjuyF7B5jTQjpl1uCUlHE4k/edit#gid=0
    var settings = {
        "async": true,
        "crossDomain": true,
        "url": "https://sheets.googleapis.com/v4/spreadsheets/<?php echo $inventorySheetId ?>/values/B2:B4?key=<?php echo $apiKey ?>&majorDimension=ROWS",
        "method": "GET",
        "headers": {
          "cache-control": "no-cache"
        }
      }
  
      $.ajax(settings).done(function (response) {
        var s9inventory = response.values[0][0];
        var l3inventory = response.values[1][0];
        var d3inventory = response.values[2][0];
        $('#s9inventory').text(s9inventory);
        $('#l3inventory').text(l3inventory);
        $('#d3inventory').text(d3inventory);
        localStorage.setItem("s9inventory",s9inventory);
        localStorage.setItem("l3inventory",l3inventory);
        localStorage.setItem("d3inventory",d3inventory);
        // console.log(s9inventory);
        // console.log(l3inventory);
        // console.log(d3inventory);
      });

    $('.pricing-color1 .psu-checkbox').change(function(e){
        console.log(e);
        if(!e.target.checked) {
            //only miner
            $('.pricing-color1 .add-miner').show();
            $('.pricing-color1 .add-miner-psu').hide();
            $('.pricing-color1 .add-miner-hosting').hide();
            $('.pricing-color1 .psu-checkbox')[0].checked = false;
            $('.pricing-color1 .s9-hosting-checkbox')[0].checked = false;
        } else  {
            //miner and psu
            $('.pricing-color1 .add-miner').hide();
            $('.pricing-color1 .add-miner-psu').show();
            $('.pricing-color1 .add-miner-hosting').hide();
            $('.pricing-color1 .psu-checkbox')[0].checked = true;
        }
    });
    $('.pricing-color2 .psu-checkbox').change(function(e){
        if(!e.target.checked) {
            //only miner
            $('.pricing-color2 .add-miner').show();
            $('.pricing-color2 .add-miner-psu').hide();
            $('.pricing-color2 .add-miner-hosting').hide();
            $('.pricing-color2 .psu-checkbox')[0].checked = false;
            $('.pricing-color2 .l3-hosting-checkbox')[0].checked = false;
        } else  {
            //miner and psu
            $('.pricing-color2 .add-miner').hide();
            $('.pricing-color2 .add-miner-psu').show();
            $('.pricing-color2 .add-miner-hosting').hide();
            $('.pricing-color2 .psu-checkbox')[0].checked = true;
        }
    });
    $('.pricing-color3 .psu-checkbox').change(function(e){
        if(!e.target.checked) {
            //only miner
            $('.pricing-color3 .add-miner').show();
            $('.pricing-color3 .add-miner-psu').hide();
            $('.pricing-color3 .add-miner-hosting').hide();
            $('.pricing-color3 .psu-checkbox')[0].checked = false;
            $('.pricing-color3 .d3-hosting-checkbox')[0].checked = false;
        } else  {
            //miner and psu
            $('.pricing-color3 .add-miner').hide();
            $('.pricing-color3 .add-miner-psu').show();
            $('.pricing-color3 .add-miner-hosting').hide();
            $('.pricing-color3 .psu-checkbox')[0].checked = true;
        }
    });
    $('.pricing-color1 .s9-hosting-checkbox').change(function(e){
        if(e.target.checked) {
            //miner, psu, and hosting
            $('.pricing-color1 .add-miner').hide();
            $('.pricing-color1 .add-miner-psu').hide();
            $('.pricing-color1 .add-miner-hosting').show();
            $('.pricing-color1 .psu-checkbox')[0].checked = true;
            $('.pricing-color1 .psu-checkbox')[0].disabled = true;
        } else  {
            //only miner
            $('.pricing-color1 .add-miner').show();
            $('.pricing-color1 .add-miner-psu').hide();
            $('.pricing-color1 .add-miner-hosting').hide();
            $('.pricing-color1 .psu-checkbox')[0].checked = false;
            $('.pricing-color1 .psu-checkbox')[0].disabled = false;
            $('.pricing-color1 .s9-hosting-checkbox')[0].checked = false;
        }
    });
    $('.pricing-color2 .l3-hosting-checkbox').change(function(e){
        if(e.target.checked) {
            //miner, psu, and hosting
            $('.pricing-color2 .add-miner').hide();
            $('.pricing-color2 .add-miner-psu').hide();
            $('.pricing-color2 .add-miner-hosting').show();
            $('.pricing-color2 .psu-checkbox')[0].checked = true;
            $('.pricing-color2 .psu-checkbox')[0].disabled = true;
        } else  {
            //only miner
            $('.pricing-color2 .add-miner').show();
            $('.pricing-color2 .add-miner-psu').hide();
            $('.pricing-color2 .add-miner-hosting').hide();
            $('.pricing-color2 .psu-checkbox')[0].checked = false;
            $('.pricing-color2 .psu-checkbox')[0].disabled = false;
            $('.pricing-color2 .l3-hosting-checkbox')[0].checked = false;
        }
    });
    $('.pricing-color3 .d3-hosting-checkbox').change(function(e){
        if(e.target.checked) {
            //miner, psu, and hosting
            $('.pricing-color3 .add-miner').hide();
            $('.pricing-color3 .add-miner-psu').hide();
            $('.pricing-color3 .add-miner-hosting').show();
            $('.pricing-color3 .psu-checkbox')[0].checked = true;
            $('.pricing-color3 .psu-checkbox')[0].disabled = true;
        } else  {
            //only miner
            $('.pricing-color3 .add-miner').show();
            $('.pricing-color3 .add-miner-psu').hide();
            $('.pricing-color3 #d3-miner-hosting').hide();
            $('.pricing-color3 .psu-checkbox')[0].checked = false;
            $('.pricing-color3 .psu-checkbox')[0].disabled = false;
            $('.pricing-color3 .d3-hosting-checkbox')[0].checked = false;
        }
    });
});
      </script>
</body>
</html>
