<?php
echo $_SERVER['SERVER_NAME']; // may output e.g,: sandie

// Or, an option that also works before PHP 5.3
echo php_uname('n'); // may output e.g,: sandie
?>