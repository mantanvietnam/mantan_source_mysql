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

function getOrderLarkSuite($id){

    global $modelOptions;
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $isRequestPost;
    global $session;

     $conditions = array('key_word' => 'lark_suite');
     $modelUtm = $controller->loadModel('Utms');
    $data = $modelOptions->find()->where($conditions)->first();
    if(!empty($data->value)){
        $static = json_decode(@$data->value, true);
    
     
        $dataPost= array("app_id"=> $static['app_id'],"app_secret"=>$static['secret']);

        $listData= sendDataConnectMantan($static['get_access_token'], $dataPost);
            $listData= str_replace('ï»¿', '', utf8_encode($listData));
            $s= json_decode($listData, true);



        $headers = array(
                'Authorization: Bearer ' .$s['app_access_token'],
                'Content-Type: application/json; charset=utf-8');
   
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
                if(!empty($infoOrder)){
                    foreach($infoOrder as $key => $item){
                        // $info .= "{";
                        $product = $modelProduct->find()->where(['id'=>$item->id_product])->first();
                        $info .= $product->title.' Số lượng: '.$item->quantity.' Đơn giá: '.number_format($item->price).'đ ' ;
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
                    $order->discount = $discount;
                    $order->discount_name = $discount_name;
                    
                    
                     $order->infoOrder = $info;
                     // $order->utm_source = 'web';
                      $order->utm_source = '';
                      $order->utm_campaign = '';
                      $order->utm_id = '';
                      $order->utm_term = '';
                      $order->utm_content = '';
                      $order->createat = '';
                     if(!empty($session->read('id_utm'))){
                        $utm = $modelUtm->find()->where(array('id'=> (int)$session->read('id_utm')))->first();
                       
                        if(!empty($utm)){
                            $order->utm_source = $utm->utm_source;
                            $order->utm_campaign = $utm->utm_campaign;
                            $order->utm_id = $utm->utm_id;
                            $order->utm_term = $utm->utm_term;
                            $order->utm_content = $utm->utm_content;
                            $order->createat = $utm->created_at;
                        }
                         $session->write('id_utm', '');
                     }

                    
                }
                $dataO = array('fields'=>$order);
            

                $list= sendDataConnectMantan('https://open.larksuite.com/open-apis/bitable/v1/apps/'.$static['base_id'].'/tables/'.$static['table_id'].'/records', $dataO,$headers, 'raw');

            $list= str_replace('ï»¿', '', utf8_encode($list));
             $list= json_decode($list, true);
  
    

             $return = array('code'=> 1 , 'data'=>$list);
            }else{
                $return = array('code'=> 3 , 'mess'=> 'Đơn hàng không tồn tại');
            }
        }else{
            $return = array('code'=> 2 , 'mess'=> 'Bạn thiếu dữ liệu');
        }
    }else{
         $return = array('code'=> 4 , 'mess'=> 'không thành công');
    }
    // debug($return);
    // die;
    return $return;   
}

?>