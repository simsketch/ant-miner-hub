<?php

$query = array();
parse_str($_SERVER['QUERY_STRING'], $query);
$cart = json_decode(json_decode($query['cart']));
// $cart = json_decode($query['cart']);
// var_dump("cart: ".json_encode($cart));
// $x = get_object_vars($cart);
// var_dump("x: ".$x);
// print_r($x[0]);

// print_r($cart->s9->qty);

// print_r($cart['s9']['qty']);
// print_r($cart->s9->qty);

$items = array();

foreach ($cart as $key => $value) {
    // print_r($key);
	array_push($items, $key);
}
foreach ($cart as $key => $value) {
    // print_r($value);
}

// print_r($items);

// foreach ($cart as $key => $value) {
//    print "$key => $value\n";
// }
// print_r($cart['s9']);
// echo '<p>'.$cart->$items[0]->qty.'</p>';
// echo '<p>'.$cart->$items[1]->qty.'</p>';
// echo '<p>'.$cart->$items[2]->qty.'</p>';
// echo '<p>'.$cart->$items[3]->qty.'</p>';
for ($i = 0; $i <= count($items); $i++) {
	// echo '<p>'.$cart->$items[$i]->qty.'</p>';
	if($cart->$items[$i]->qty > 0) {
	    echo '<div class="row trow"><div class="col-xs-4 td"><img src="images/'.$items[$i].'.png" style="width:100px"/>'.$items[$i].'</div><div class="col-xs-2 td qty">'.$cart->$items[$i]->qty.'</div><div class="col-xs-4 td">'.$cart->$items[$i]->description.'</div><div class="col-xs-2 td prices">'.$cart->$items[$i]->price.'</div>';
	}
}
?>