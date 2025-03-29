<?php 
function testViettelpost(){

	$url = 'order/getPriceAllNlp	';
	$data = '{
    "SENDER_ADDRESS": "Liên Mạc, Mê Linh, Hà Nội",
    "RECEIVER_ADDRESS": "Định Công, Hoàng Mai, Hà Nội",
    "RECEIVER_PROVINCE": 1,
    "PRODUCT_TYPE": "HH",
    "PRODUCT_WEIGHT": 100,
    "PRODUCT_PRICE": 5000000,
    "MONEY_COLLECTION": "5000000",
    "PRODUCT_LENGTH": 0,
    "PRODUCT_WIDTH": 0,
    "PRODUCT_HEIGHT": 0,
    "TYPE": 1
}
';

	$token = 'eyJhbGciOiJFUzI1NiJ9.eyJzdWIiOiIwOTMzMTc3NDU0IiwiVXNlcklkIjo3ODc2Nzk3LCJGcm9tU291cmNlIjo1LCJUb2tlbiI6IkhSQzdBS09FREpXVkExIiwiZXhwIjoxNzQzMjExOTUwLCJQYXJ0bmVyIjo3ODc2Nzk3fQ.xmjeUjOKMIsMDQIw04N8Fy3tPDqtZlRz0hN0LJCqvqZZ3xoafSl6_CnJEkuOFqZAyzLmZFB8V-SPHALKi-Zx7g';

	$dataapi =callApiViettelpost($url, $data, $token);

	debug($dataapi);
	die;
 }

 ?>
