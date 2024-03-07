"use strict";

window.s9price = 4;
window.l3price = 3;
window.d3price = 2;
window.s9hosting = 1.99;
window.l3hosting = 1.19;
window.d3hosting = 1.79;
window.psuprice = 1;

$('button.cart').click( function() {
    window.location.href = "checkout.php";
});

$(document).ready( function() {
    $('.pricing-content img').click( function() {
        addToCart(this.dataset.id);
    });
    $('.pricing-title').click( function() {
        addToCart(this.dataset.id);
    });
    var cart = localStorage.getItem("ant-cart");
    if (cart != "" && cart != null) {
    cart = JSON.parse(cart);
    }
    else {
    cart = { "s9":{"qty":0,"price":s9price,"description":"Antminer S9 - 13.5TH/s"}, "l3":{"qty":0,"price":l3price,"description":"Antminer L3 - 504MH/s"}, "d3":{"qty":0,"price":d3price,"description":"Antminer D3 - 19.3GH/s"}, "psu":{"qty":0,"price":psuprice,"description":"Power Supply Unit"},"s9hosting":{"qty":0,"price":s9hosting,"description":"1 month of S9 hosting in an iceland data center"}, "l3hosting":{"qty":0,"price":l3hosting,"description":"1 month of L3 hosting in an iceland data center"}, "d3hosting":{"qty":0,"price":d3hosting,"description":"1 month of D3 hosting in an iceland data center"}, "total":0}
    }
    $('.cart__count').text(cart.s9.qty + cart.l3.qty + cart.d3.qty + cart.psu.qty + cart.s9hosting.qty + cart.l3hosting.qty + cart.d3hosting.qty);
    if(window.location.href.includes('checkout') || window.location.href.includes('order') || window.location.href.includes('thanks') || window.location.href.includes('status')) {
        $('.cart').hide();
    }
});

function addToCart(item) {
    var cart = localStorage.getItem("ant-cart");
        //debugger;
    if (cart != "" && cart != null) {
        cart = JSON.parse(cart);
    }
    else {
    cart = { "s9":{"qty":0,"price":s9price,"description":"Antminer S9 - 13.5TH/s"}, "l3":{"qty":0,"price":l3price,"description":"Antminer L3 - 504MH/s"}, "d3":{"qty":0,"price":d3price,"description":"Antminer D3 - 19.3GH/s"}, "psu":{"qty":0,"price":psuprice,"description":"Power Supply Unit"},"s9hosting":{"qty":0,"price":s9hosting,"description":"1 month of S9 hosting in an iceland data center"}, "l3hosting":{"qty":0,"price":l3hosting,"description":"1 month of L3 hosting in an iceland data center"}, "d3hosting":{"qty":0,"price":d3hosting,"description":"1 month of D3 hosting in an iceland data center"}, "total":0}
    }
    switch(item) {
        case "s9":
            cart.s9.qty = cart.s9.qty + 1;
            cart.total += s9price;
            //cart.s9.push({id:"s9",price:s9price,qty:1});
            break;
        case "l3":
            cart.l3.qty = cart.l3.qty + 1;
            cart.total += l3price;
            //cart.l3.push({id:"l3",price:l3price,qty:1});
            break;
        case "d3":
            cart.d3.qty = cart.d3.qty + 1;
            cart.total += d3price;
            //cart.d3.push({id:"d3",price:d3price,qty:1});
            break;
        case "s9hosting":
            cart.s9hosting.qty = cart.s9hosting.qty + 1;
            cart.total += s9hosting;
            //cart.s9.push({id:"s9",price:s9price,qty:1});
            break;
        case "l3hosting":
            cart.l3hosting.qty = cart.l3hosting.qty + 1;
            cart.total += l3hosting;
            //cart.l3.push({id:"l3",price:l3price,qty:1});
            break;
        case "d3hosting":
            cart.d3hosting.qty = cart.d3hosting.qty + 1;
            cart.total += d3hosting;
            //cart.d3.push({id:"d3",price:d3price,qty:1});
            break;
        case "psu":
            cart.psu.qty = cart.psu.qty + 1;
            cart.total += psuprice;
            //cart.psu.push({id:"psu",price:psuprice,qty:1});
            break;
        default:
            return;
    }
    document.getElementsByClassName("cart")[0].style.transform = "scale(2)";
    setTimeout( function() {
    document.getElementsByClassName("cart")[0].style.transform = "scale(1)";
    }, 800);
    var x = $('.cart__count').text();
    x = parseInt(x) + 1;
    console.log(x);
    $('.cart__count').text(x);
    cart = JSON.stringify(cart);
    localStorage.setItem("ant-cart",cart);
}

function removeFromCart(item) {
    var cart = localStorage.getItem("ant-cart");
    cart = JSON.parse(cart);
    switch(item) {
        case "s9":
            cart.s9.qty = cart.s9.qty - 1;
            cart.total -= s9price;
            //cart.s9.push({id:"s9",price:s9price,qty:1});
            break;
        case "l3":
            cart.l3.qty = cart.l3.qty - 1;
            cart.total -= l3price;
            //cart.l3.push({id:"l3",price:l3price,qty:1});
            break;
        case "d3":
            cart.d3.qty = cart.d3.qty - 1;
            cart.total -= d3price;
            //cart.d3.push({id:"d3",price:d3price,qty:1});
            break;
        case "s9hosting":
            cart.s9hosting.qty = cart.s9hosting.qty - 1;
            cart.total += s9hosting;
            //cart.s9.push({id:"s9",price:s9price,qty:1});
            break;
        case "l3hosting":
            cart.l3hosting.qty = cart.l3hosting.qty - 1;
            cart.total += l3hosting;
            //cart.l3.push({id:"l3",price:l3price,qty:1});
            break;
        case "d3hosting":
            cart.d3hosting.qty = cart.d3hosting.qty - 1;
            cart.total += d3hosting;
            //cart.d3.push({id:"d3",price:d3price,qty:1});
            break;
        case "psu":
            cart.psu.qty = cart.psu.qty - 1;
            cart.total -= psuprice;
            //cart.psu.push({id:"psu",price:psuprice,qty:1});
            break;
        default:
            return;
    }
    if(window.location.href.includes('checkout')) {
        window.location.reload();
    }
    var x = $('.cart__count').text();
    x = parseInt(x) + 1;
    console.log(x);
    $('.cart__count').text(x);
    cart = JSON.stringify(cart);
    localStorage.setItem("ant-cart",cart);
    location.reload();
}

function emptyCartAndReload() {
    localStorage.setItem("ant-cart","");
    localStorage.setItem("depositAddress","");
    localStorage.setItem("depositAmount","");
    localStorage.setItem("error","");
    localStorage.setItem("pair","");
    localStorage.setItem("quotedRate","");
    localStorage.setItem("selectedCurrency","");
    window.location.reload();
}
function emptyCart() {
    localStorage.setItem("ant-cart","");
    localStorage.setItem("depositAddress","");
    localStorage.setItem("depositAmount","");
    localStorage.setItem("error","");
    localStorage.setItem("pair","");
    localStorage.setItem("quotedRate","");
    localStorage.setItem("selectedCurrency","");
}
// Add Slider functionality to the top of home page in #top-content section.
var mainSlider = $("#main-slider","#top-content");
mainSlider.slick({
    dots: true,
    speed: 1000,
    autoplay: true,
    autoplaySpeed: 5000,
    arrows: false,
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1
});
// Adding animation to the #main-slider
mainSlider.on('afterChange', function(event, slick, currentSlide, nextSlide){
    $('.slide > div:nth-child(1)','#main-slider').removeClass("animated");
    $('.slide > div:nth-child(2)','#main-slider').removeClass("animated animation-delay1");
 
    $('.slick-active > div:nth-child(1)','#main-slider').addClass("animated");
    $('.slick-active > div:nth-child(2)','#main-slider').addClass("animated animation-delay1");
});
// Add Slider functionality to the #testimonials section in the home page.
var testimonialsSlider = $("#testimonials-slider","#testimonials");
testimonialsSlider.slick({
    dots: false,
    arrows: true,
    infinite: false,
    slidesToShow: 1,
    slidesToScroll: 1
});
// Add Slider functionality to the testimonials in the "Sign in" and "Sign out" pages.
var miniTestimonialsSlider = $(".mini-testimonials-slider","#form-section");
miniTestimonialsSlider.slick({
    dots: true,
    arrows: false,
    infinite: false,
    autoplay: true,
    speed: 200
});
// Add Slider functionality to the info-slider in the about page.
var infoSlider = $(".info-slider","#page-head");
infoSlider.slick({
    dots: true,
    arrows: false,
    infinite: false,
    autoplay: true,
    speed: 200
});
$(window).on("load", function() {
    // Adding animation to the #main-slider
    $('.slick-active > div:nth-child(1)','#main-slider').addClass("animated");
    $('.slick-active > div:nth-child(2)','#main-slider').addClass("animated animation-delay1");
    // Counter slider functions in "CUSTOM HOSTING PLAN" section on the homepage
    var cPlan = $('#c-plan');
    cPlan.slider({
        tooltip: 'always'
    });
    cPlan.on("slide", function(e) {
        $('.slider .tooltip-up','#custom-plan').text(e.value/20);
    });
    cPlan.value = cPlan.data("slider-value");
    $('.slider .tooltip','#custom-plan').append('<div class="tooltip-up"></div>');
    $('.slider .tooltip-up','#custom-plan').text(cPlan.value/20);
    $('.slider .tooltip-inner','#custom-plan').attr("data-unit",cPlan.data("unit"));
    $('.slider .tooltip-up','#custom-plan').attr("data-currency",cPlan.data("currency"));
    
    // Features Section click function
    var featureIconHolder = $(".feature-icon-holder", "#features-links-holder");
    
    featureIconHolder.on("click",function(){
        featureIconHolder.removeClass("opened");
        $(this).addClass("opened");
        $(".show-details","#features-holder").removeClass("show-details");
        $(".feature-d"+$(this).data("id"), "#features-holder").addClass("show-details");
    });
    
    // Fix #features-holder height in features section
    var featuresHolder = $("#features-holder");
    var featuresLinksHolder = $("#features-links-holder");
    var featureBox = $(".show-details","#features-holder");
    
    featuresHolder.css("height",featureBox.height()+120);
    featuresLinksHolder.css("height",featureBox.height()+120);

    // Fix #features-holder height in features section
    $(window).on("resize",function() {
        featuresHolder.css("height",featureBox.height()+120);
        featuresLinksHolder.css("height",featureBox.height()+120);
        return false;
    });
    
    // Apps Section hover function
    var appHolder = $(".app-icon-holder", "#apps");
    
    appHolder.on("mouseover",function(){
        appHolder.removeClass("opened");
        $(this).addClass("opened");
        $(".show-details", "#apps").removeClass("show-details");
        $(".app-details"+$(this).data("id"), "#apps").addClass("show-details");
    });
    
    // More Info Section hover function
    var infoLink = $(".info-link", "#more-info");
    
    infoLink.on("mouseover",function(){
        infoLink.removeClass("opened");
        $(this).addClass("opened");
        $(".show-details", "#more-info").removeClass("show-details");
        $(".info-d"+$(this).data("id"), "#more-info").addClass("show-details");
    });
    
    // Servers Marker Location in our servers page
    var locationsList = [["California",97,48,"r"],["Costa Rika",212,31,"l"],["Vancouver",136,161,"r"],["Brazil",303,233,"r"],["Alexandria",149,349,"l"],["Dubai",174,469,"l"],["Delhi",204,605,"r"],["Munech",91,417,"r"],["Barcelona",112,279,"l"],["Moscow",41,554,"r"],["Hong Kong",151,663,"r"],["Melborne",356,688,"l"],["Pulau Ujong",265,578,"l"]];
    
    var serversLocationHolder = $('.servers-location-holder','#serversmap.st');
    for(var i=0;i<=locationsList.length-1;i++){
        var sMarkerDir = locationsList[i][3];
        var leftText = "";
        var rightText = "";
        if(sMarkerDir=="r"){
            leftText = "";
            rightText = locationsList[i][0];
        }else if(sMarkerDir=="l"){
            leftText = locationsList[i][0];
            rightText = "";
        }
        serversLocationHolder.append('<div class="server-marker" style="top:'+locationsList[i][1]+'px;left:'+locationsList[i][2]+'px;"><span class="left-text">'+leftText+'</span><span class="marker-icon"></span><span class="right-text">'+rightText+'</span></div>');
    }
    
});