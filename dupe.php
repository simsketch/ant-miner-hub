<?php
$query = array();
parse_str($_SERVER['QUERY_STRING'], $query);
$add = $query['transactionid'];
echo 'This order id has already been submitted. You can check the status of the order and view the deposit address and QR code at any time either by clicking <a href="status.php?transactionid='.$add.'">here</a> or in the email you received.';
?>