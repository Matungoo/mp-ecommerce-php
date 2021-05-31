<?php
header("HTTP/1.1 200 OK");

// $key = "APP_USR-6317427424180639-042414-47e969706991d3a442922b0702a0da44-469485398";
// $payment = $_GET["id"];

// $json = file_get_contents("https://api.mercadopago.com/v1/payments/$payment?access_token=$key");
$notifications = file_get_contents("php://input");
$file = __DIR__ . "/responses/test.txt";

$actual = file_get_contents($file);
$actual .= "$notifications \n";

file_put_contents($file, $actual);


?>  