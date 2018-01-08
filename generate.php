<?php

ini_set('display_errors',1);
error_reporting(E_ALL);

require('./pdf.php');
$date_value=$_GET["date"];
$lot_number=$_GET["lotnumber"];
generatePdf($date_value, $lot_number);
?>
