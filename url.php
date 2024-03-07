<?php
echo $_SERVER['SERVER_NAME'].'<br>';
echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'<br>';
$url = $_SERVER['REQUEST_URI']; //returns the current URL
$parts = explode('/',$url);
// print_r($parts);
$query = array();
parse_str($_SERVER['QUERY_STRING'], $query);
echo 'http://'.$_SERVER['HTTP_HOST'].'/'.$parts[1].'/confirmation.php?orderid='.$query['orderid'];
?>