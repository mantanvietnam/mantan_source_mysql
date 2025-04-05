<?php 
    $menus= array();
    $menus[0]['title']= 'Lark suite';
    $menus[0]['sub'][0]= array( 'title'=>'Lark suite Setting',
                            'url'=>'/plugins/admin/larksuite-settingLarkSuite',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'settingLarkSuite'
                        );
 addMenuAdminMantan($menus);

    
function getLarkSuite(){
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Cài đặt giao diện trang chủ ';
    $static= '';

    $conditions = array('key_word' => 'lark_suite');
    $data = $modelOptions->find()->where($conditions)->first();
    if(!empty($data->value)){
         $static = json_decode(@$data->value, true);
    }
     return $static;
}

function getLarkAccessToken($app_id, $app_secret) {
    $url = "https://open.larksuite.com/open-apis/auth/v3/tenant_access_token/internal/";

    $data = [
        "app_id" => $app_id,
        "app_secret" => $app_secret
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $res = curl_exec($ch);
    curl_close($ch);

    $res = json_decode($res, true);
    return $res['tenant_access_token'] ?? null;
}

function createLarkBaseRecord($access_token, $app_token, $table_id, $orderData) {
    $url = "https://open.larksuite.com/open-apis/bitable/v1/apps/{$app_token}/tables/{$table_id}/records";

    $record = [
        "fields" => $orderData
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($record));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "Authorization: Bearer {$access_token}"
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}



function getOrderLarkSuite($id){

    global $modelOptions;
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $isRequestPost;
    global $session;
     
    $modelUtm = $controller->loadModel('Utms');

    $conditions = array('key_word' => 'lark_suite');
    $data = $modelOptions->find()->where($conditions)->first();
    
    if(!empty($data->value)){
        $static = json_decode(@$data->value, true);
    
        /*
        $dataPost= array("app_id"=> $static['app_id'],"app_secret"=>$static['secret']);
        $listData= sendDataConnectMantan($static['get_access_token'], $dataPost);
        $listData= str_replace('ï»¿', '', utf8_encode($listData));
        $s= json_decode($listData, true);

        $headers = array(
                'Authorization: Bearer ' .$s['app_access_token'],
                'Content-Type: application/json; charset=utf-8'
            );
        */
        
   
        $modelProduct = $controller->loadModel('Products');
        $modelOrder = $controller->loadModel('Orders');
        $modelOrderDetail = $controller->loadModel('OrderDetails');
        $return = [];

        if(!empty($id)){
            $order = $modelOrder->find()->where(['id'=>$id])->first();
            
            if(!empty($order)){
                $infoOrder = $modelOrderDetail->find()->where(['id_order'=>$id])->all()->toList();
                unset($order->note_user);
                unset($order->note_admin);
                unset($order->id_utm);
                $info = ''; 
                $str = "*";
                $order->shipp = 35000;
                $order->quantity = 0;

                if(!empty($infoOrder)){
                    foreach($infoOrder as $key => $item){
                        // $info .= "{";
                        $product = $modelProduct->find()->where(['id'=>$item->id_product])->first();
                        $info .= $product->title.' Số lượng: '.$item->quantity.' Đơn giá: '.number_format($item->price).'đ ' ;
                        $order->quantity += $item->quantity;
                        
                        if(!empty(@$product->id_product)){
                            $id_product = explode(',', @$product->id_product);
                            $present = [];
                            $info .= "(Quà tặng: ";
                            foreach($id_product as $k => $value){
                                $presentf = $modelProduct->find()->where(['code'=>$value])->first()->title;
                                $info .= $presentf.'; ';
                                

                            }
                            $info .= ")";
                        }
                        // $info .= '} \n\t\r '.str_repeat($str, $key+1);
                            $info .= '<br/>';
                            $item->name = $product->title;
                            $infoOrder[$key] = $item;

                    }
                    $pay = json_decode($order->discount, true);
                    $discount_name = '';
                    $discount = 0;
                    if(!empty($pay['code1']) && !empty($pay['discount_price1'])){                   
                        $discount += $pay['discount_price1'];
                        $discount_name .= $pay['code1'].',';
                    }
                    if(!empty($pay['code2']) && !empty($pay['discount_price2'])){
                        $discount += $pay['discount_price2'];
                        $discount_name .= $pay['code2'].',';
                    }
                    if(!empty($pay['code3']) && !empty($pay['discount_price3'])){                   
                       $discount += $pay['discount_price3'];
                       $discount_name .= $pay['code3'].',';
                    }
                    if(!empty($pay['code4']) && !empty($pay['discount_price4'])){                   
                        $discount += $pay['discount_price4'];
                        $discount_name .= $pay['code4'].',';
                    }
                    $order->discount =(string) $discount;
                    $order->discount_name = $discount_name;
                    
                    
                     $order->infoOrder = $info;
                     // $order->utm_source = 'web';
                      $order->utm_source = '';
                      $order->utm_campaign = '';
                      $order->utm_id = '';
                      $order->utm_term = '';
                      $order->utm_content = '';
                      $order->utm_medium = '';
                      $order->utm_name = '';
                      

                      $order->createat = '';
                     if(!empty($session->read('id_utm'))){
                        $utm = $modelUtm->find()->where(array('id'=> (int)$session->read('id_utm')))->first();
                       
                        if(!empty($utm)){
                            $order->utm_source = $utm->utm_source;
                            $order->utm_campaign = $utm->utm_campaign;
                            $order->utm_id = $utm->utm_id;
                            $order->utm_term = $utm->utm_term;
                            $order->utm_content = $utm->utm_content;
                            $order->utm_medium = $utm->utm_medium;
                            $order->utm_name = $utm->utm_name;
                            
                            $order->createat = $utm->created_at;
                        }
                         $session->write('id_utm', '');
                     }

                    
                }

                // lưu dữ liệu sang Lark
                $app_id = $static['app_id'];
                $app_secret = $static['secret'];
                $app_token = $static['base_id']; // Lấy từ Lark Base
                $table_id = $static['table_id'];

                $access_token = getLarkAccessToken($app_id, $app_secret);
                //debug($access_token);
                $orderData = $order;

                $response = createLarkBaseRecord($access_token, $app_token, $table_id, $orderData);
                //debug($response);
                $response= str_replace('ï»¿', '', utf8_encode($response));
                
                $response= json_decode($response, true);

                $return = array('code'=> 1 , 'data'=>$response, 'info_order'=>['fields'=>$order]);
            }else{
                $return = array('code'=> 3 , 'mess'=> 'Đơn hàng không tồn tại');
            }
        }else{
            $return = array('code'=> 2 , 'mess'=> 'Bạn thiếu dữ liệu');
        }
    }else{
         $return = array('code'=> 4 , 'mess'=> 'không thành công');
    }
    // debug($dataO);
    // debug($return);
    // die;
    return $return;   
}

?>