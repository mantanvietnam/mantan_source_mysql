<?php
function createOrderProductAPI($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;

    $return = array('code'=>1);

    $modelProduct = $controller->loadModel('Products');
    $modelOrder = $controller->loadModel('Orders');
    $modelOrderDetail = $controller->loadModel('OrderDetails');

    /*
        $dataSend['data_order'] = [
                                    ['id_product'=>1, 'quantity'=>2, 'price'=>0],
                                    ['id_product'=>2, 'quantity'=>2, 'price'=>1000],
                                ];
    */

    if($isRequestPost){
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['full_name']) && !empty($dataSend['phone']) && !empty($dataSend['data_order'])){
            $dataSend['data_order'] = json_decode($dataSend['data_order'], true);
            
            if(!empty($dataSend['data_order'])){
                $dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
                $dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

                $product_name = [];

                // thông tin đơn hàng
                if(!empty($dataSend['token_customer'])){
                    if(function_exists('getInfoCustomerMember')){
                       $infoUser = getInfoCustomerMember('token', $dataSend['token_customer']);
                    }
                }else{
                    $infoUser = [];
                    if(function_exists('createCustomerNew')){
                        $infoUser = createCustomerNew($dataSend['full_name'], $dataSend['phone'], @$dataSend['email'], @$dataSend['address'], @$dataSend['sex'], @$dataSend['id_city'], @$dataSend['id_agency'], @$dataSend['id_aff'], @$dataSend['name_agency'], @$dataSend['id_messenger'], @$dataSend['avatar'], @$dataSend['birthday_date'], @$dataSend['birthday_month'], @$dataSend['birthday_year']);
                    }
                }

                // tạo đơn hàng
                $data = $modelOrder->newEmptyEntity();

                $data->id_user = (!empty($infoUser->id))?$infoUser->id:0;
                $data->full_name = $dataSend['full_name'];
                $data->email = @$dataSend['email'];
                $data->phone = $dataSend['phone'];
                $data->address = @$dataSend['address'];
                $data->note_user = @$dataSend['note_user'];
                $data->payment = @$dataSend['payment'];
                $data->note_admin = '';
                $data->status = 'new';
                $data->create_at = time();
                $data->id_agency = (int) @$dataSend['id_agency'];
                $data->id_aff = (int) @$dataSend['id_aff'];
                $data->money = (int) @$dataSend['money']; // tổng tiền ban đầu
                $data->total = (int) @$dataSend['total']; // tổng tiền sau giảm giá
                $data->discount = '';

                $modelOrder->save($data);

                // chi tiết đơn hàng
                $listproduct = [];
                foreach ($dataSend['data_order'] as $data_order) {
                    $product = $modelProduct->find()->where(['id'=>(int) $data_order['id_product']])->first();

                    if(!empty($product)){
                        $product_name[] = $product->title;

                        $dataDetail = $modelOrderDetail->newEmptyEntity();

                        $dataDetail->id_product = $data_order['id_product'];
                        $dataDetail->quantity = (int) $data_order['quantity'];
                        //$dataDetail->present = $product->id_product;
                        $dataDetail->id_order = $data->id;
                        $dataDetail->price = (int) $data_order['price'];

                        $modelOrderDetail->save($dataDetail);

                        // trừ hàng trong kho tổng
                        $product->quantity -= (int) $data_order['quantity']; // tồn kho
                        $product->sold += (int) $data_order['quantity']; // tổng hàng đã bán

                        $modelProduct->save($product);

                        $product->numberOrder = (int) $data_order['quantity'];
                        $listproduct[] = $product;
                    }
                }

                // gửi cho khách 
                if(!empty($dataSend['email'])){
                    getContentEmailOrderSuccess(@$dataSend['full_name'],@$dataSend['email'],@$dataSend['phone'],@$dataSend['address'],@$dataSend['note_user'],$listproduct, [], $data);
                }

                // gửi cho admin
                getContentEmailAdmin(@$dataSend['full_name'],@$dataSend['email'],@$dataSend['phone'],@$dataSend['address'],@$dataSend['note_user'],$listproduct, [], $data);

                // gửi cho đại lý
                if(!empty($dataSend['id_agency']) && function_exists('sendNotification')){
                    $modelTokenDevices = $controller->loadModel('TokenDevices');
                    $modelMembers = $controller->loadModel('Members');

                    $infoMember = $modelMembers->find()->where(['id'=>$dataSend['id_agency']])->first();

                    if(!empty($infoMember->noti_new_order)){
                        $dataSendNotification= array('title'=>'Đơn hàng mới','time'=>date('H:i d/m/Y'),'content'=>'Đơn hàng #'.$data->id.' của khách hàng '.$data->full_name.' trị giá '.number_format($data->total).'đ','action'=>'createOrder','id_order'=>$data->id);
                        $token_device = [];

                        $listTokenDevice =  $modelTokenDevices->find()->where(['id_member'=>$infoMember->id])->all()->toList();

                        if(!empty($listTokenDevice)){
                            foreach ($listTokenDevice as $tokenDevice) {
                                if(!empty($tokenDevice->token_device)){
                                    $token_device[] = $tokenDevice->token_device;
                                }
                            }

                            if(!empty($token_device)){
                                $return = sendNotification($dataSendNotification, $token_device);
                            }
                        }
                    }
                }

                // tính hoa hồng cho CTV
                if(function_exists('calculateAffiliate')){
                    calculateAffiliate($data->total, $data->id);
                }

                // gửi tin nhắn ZALO OA
                if(function_exists('sendZNSDataBot')){
                    $product_name = implode(',', $product_name);
                    $product_name = substr($product_name, 0, 100);
                    $agency = @$dataSend['name_agency'];
                    $name_system = @$dataSend['name_system'];

                    sendZNSDataBot($data, $product_name, $name_system, $agency);
                }

                $return = array('code'=>0, 'id_order'=>$data->id);
            }else{
                $return = array('code'=>3, 'mess'=>'Dữ liệu đơn hàng trống');
            }
        }else{
            $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }

    return $return;
}

function getListOrdersAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $session;

    $modelProduct = $controller->loadModel('Products');
    $modelOrder = $controller->loadModel('Orders');
    $modelOrderDetail = $controller->loadModel('OrderDetails');

    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token']);

            if(!empty($infoMember)){
                $conditions = array('id_agency'=>$infoMember->id);
                if(!empty($dataSend['id'])){
                    $conditions['id'] = (int) $dataSend['id'];
                }

                if(!empty($dataSend['full_name'])){
                    $conditions['full_name LIKE'] = '%'.$dataSend['full_name'].'%';
                }

                if(!empty($dataSend['phone'])){
                    $conditions['phone'] = $dataSend['phone'];
                }

                if(!empty($dataSend['status'])){
                    $conditions['status'] = $dataSend['status'];
                }

                if(!empty($dataSend['id_user'])){
                    $conditions['id_user'] = (int) $dataSend['id_user'];
                }

                if(!empty($dataSend['date_start'])){
                    $date_start = explode('/', $dataSend['date_start']);
                    $conditions['create_at >='] = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
                }

                if(!empty($dataSend['date_end'])){
                    $date_end = explode('/', $dataSend['date_end']);
                    $conditions['create_at <='] = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
                        
                }

                $limit = (!empty($dataSend['limit']))?(int)$dataSend['limit']:20;
                $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
                if($page<1) $page = 1;
                $order = array('id'=>'desc');

                $listData = $modelOrder->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

                if(!empty($listData)){
                    foreach($listData as $key => $item){
                        $detail_order = $modelOrderDetail->find()->where(['id_order'=>$item->id])->all()->toList();
                        
                        if(!empty($detail_order)){
                            foreach ($detail_order as $k => $value) {
                                $product = $modelProduct->find()->where(['id'=>$value->id_product ])->first();
                                if(!empty($product)){
                                    $detail_order[$k]->product = $product->title;
                                    //$detail_order[$k]->price = $value->price;
                                }
                            }

                            $listData[$key]->detail_order = $detail_order;
                        }
                    }
                }
                
                $totalData = $modelOrder->find()->where($conditions)->all()->toList();
                
                $return = array('code'=>0, 'listData'=>$listData, 'totalData'=>count($totalData));
            }else{
                $return = array('code'=>3, 'mess'=>'Sai mã token');
            }
        }else{
            $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }

    return $return;
}
?>