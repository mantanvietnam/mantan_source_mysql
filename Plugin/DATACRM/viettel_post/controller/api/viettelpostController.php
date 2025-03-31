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

 function checkpriceship($input){
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategories;
    global $urlHomes;

    $modelMember = $controller->loadModel('Members');

    $modelLinkInfo = $controller->loadModel('LinkInfos');

    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        $checkPhone = checklogin(); 
        if(empty($checkPhone)){
            if(!empty($dataSend['token'])){
                $checkPhone = getMemberByToken($dataSend['token']);
                if(empty($checkPhone)){
                    return array('code'=>3, 'mess'=>'không tồn tại tài khoản đại lý hoặc sai mã token');
                }
            }else{
               return array('code'=>2, 'mess'=>'thiếu dữ liệu'); 
            }
        }


        $url = 'order/getPriceNlp';


        $data = '{"PRODUCT_WEIGHT": '.@$dataSend['product_weight'].', 
        "PRODUCT_PRICE": '.@$dataSend['product_price'].', 
        "MONEY_COLLECTION": '.@$dataSend['money_collection'].', 
        "ORDER_SERVICE_ADD": "'.@$dataSend['order_service_add'].'", 
        "ORDER_SERVICE": "'.@$dataSend['order_service'].'", 
        "SENDER_ADDRESS": "'.@$dataSend['sender_address'].'", 
        "RECEIVER_ADDRESS": "'.@$dataSend['receiver_address'].'", 
        "PRODUCT_LENGTH": '.@$dataSend['product_length'].', 
        "PRODUCT_WIDTH": '.@$dataSend['product_width'].', 
        "PRODUCT_HEIGHT": '.@$dataSend['product_height'].', 
        "PRODUCT_TYPE": "HH", 
        "NATIONAL_TYPE": 1
        }';

        $token = '3DC732BCA39EB7F1A0819DD7D14C0202';

        $data =callApiViettelpost($url, $data, $token);

        if($data['error']==false){
             return array('code'=>1,'mess'=>'tính cước thành công ', 'data'=> $data['data'] );
         }
          return array('code'=>2,'mess'=>'Địa chỉ không hợp lệ');
      
    }
    return array('code'=>0, 'mess'=>' gửi sai kiểu POST ');

 }

 ?>
