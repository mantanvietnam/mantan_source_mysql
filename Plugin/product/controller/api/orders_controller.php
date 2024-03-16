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
                                    ['id_product'=>1, 'quantity'=>2],
                                    ['id_product'=>2, 'quantity'=>2],
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
                $infoUser = [];
                if(function_exists('createCustomerNew')){
                    $infoUser = createCustomerNew($dataSend['full_name'], $dataSend['phone'], @$dataSend['email'], @$dataSend['address'], @$dataSend['sex'], @$dataSend['id_city'], @$dataSend['id_agency'], @$dataSend['id_aff'], @$dataSend['name_agency'], @$dataSend['id_messenger'], @$dataSend['avatar'], @$dataSend['birthday_date'], @$dataSend['birthday_month'], @$dataSend['birthday_year']);
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
                        $dataDetail->present = $product->id_product;
                        $dataDetail->id_order = $data->id;
                        $dataDetail->price = $product->price;

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
?>