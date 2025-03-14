<?php 
function customerUpLikePageFacebookAPI($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;   
    global $modelOptions;
    global $isRequestPost;
    global $modelOptions;
    
    $modelCustomer = $controller->loadModel('Customers');
    $modelUplikeHistories = $controller->loadModel('UplikeHistories');
    $modelTransactionHistories = $controller->loadModel('TransactionHistories');

    // kiểm tra cái đặt token
    
    $type_api = 'facebook.buff.likepage';

     $conditions = array('key_word' => 'settingUpLikeCustomerAdmin');
    $data = $modelOptions->find()->where($conditions)->first();
    $data_value =[];
    if(!empty($data)){
         $data_value = json_decode($data->value, true);
    }

    if($data_value['function_customerUpLikePage']=='off'){
         return array('code'=>5,'mess'=>'Chương trình này đã hết');
    }
    if($isRequestPost){
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['token'])  && !empty($dataSend['id_page'])){

            $user =  getCustomerByToken($dataSend['token']);
            if(!empty($user)){
                $startOfDay = strtotime("today 00:00:00");
                $checktoday =  $modelUplikeHistories->find()->where(['type'=>'customer','create_at >'=>$startOfDay, 'id_member'=>$user->id])->first();
                $checkIdpage =  $modelUplikeHistories->find()->where(['type'=>'customer','create_at >'=>$startOfDay, 'id_page'=> $dataSend['id_page']])->first();
                $checkTokenDevice =  $modelUplikeHistories->find()->where(['type'=>'customer','create_at >'=>$startOfDay, 'token_device'=>$user->token_device])->first();
                
                if(!empty($checktoday)){
                    return array('code'=>4,'mess'=>'Tài khoản của bạn dùng tăng like Fanpage hôm nay rồi ');
                }

                if(!empty($checkIdpage)){
                    return array('code'=>4,'mess'=>'Fanpage của bạn dùng tăng like Fanpage hôm nay rồi ');
                }

                if(!empty($checkTokenDevice)){
                    return array('code'=>4,'mess'=>'thiết bị của bạn dùng tăng like Fanpage hôm nay rồi ');
                }

                if(!empty($user->up_like>300)){
                    return array('code'=>4,'mess'=>'Bạn đạt hết mốc 300 rồi');
                }



                $save = $modelCustomer->get($user->id);
                // trừ tiền tài khoản
                if(!empty($save->up_like)){
                    $save->up_like += 10;
                }else{
                    $save->up_like = 100;
                }
                // gửi yêu cầu sang hệ thống tăng like
                $sendOngTrum = sendRequestBuffOngTrum($type_api, $dataSend['id_page'], $data_value['chanel'], $save->up_like, $dataSend['url_page'], $user->id);

                if($sendOngTrum['code']==200){
                    $mess= '<p class="text-success">Tạo yêu cầu thành công</p>';
          
                    $modelCustomer->save($save);
                    // lưu yêu cầu
                    $saveRequest = $modelUplikeHistories->newEmptyEntity();
                    $saveRequest->id_member = $user->id;
                    $saveRequest->id_system = 0;
                    $saveRequest->id_page = $dataSend['id_page'];
                    $saveRequest->type_page = $type_api;
                    $saveRequest->money = 0;
                    $saveRequest->number_up = $save->up_like;
                    $saveRequest->chanel = $data_value['chanel'];
                    $saveRequest->url_page = $dataSend['url_page'];
                    $saveRequest->price = 0;
                    $saveRequest->type = 'customer';
                    $saveRequest->create_at = time();
                    $saveRequest->status = 'Running';
                    $saveRequest->run = 0;
                    $saveRequest->token_device = $user->token_device;
                    $saveRequest->id_request_buff = $sendOngTrum['id'];
                    $saveRequest->note_buff = json_encode($sendOngTrum);
                    $modelUplikeHistories->save($saveRequest);
                    return array('code'=>1,'mess'=>'Bạn sử dụng tăng like thành công', 'number_uplike'=>$save->up_like);
                }else{
                    return array('code'=>5, 'mess'=>$sendOngTrum['message']);
                }
            }else{
                 return array('code'=>3,'mess'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
            }
        }else{
            return array('code'=>2,'mess'=>'Gửi thiếu dữ liệu');
        }
    }
    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
}

function customerUpAPI($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;   
    global $modelOptions;
    global $isRequestPost;
    global $modelOptions;
    
    $modelCustomer = $controller->loadModel('Customers');
    $modelUplikeHistories = $controller->loadModel('UplikeHistories');
    $modelTransactionHistories = $controller->loadModel('TransactionHistories');

    // kiểm tra cái đặt token
    
    $type_api = 'facebook.buff.likepage';

     $conditions = array('key_word' => 'settingUpLikeCustomerAdmin');
    $data = $modelOptions->find()->where($conditions)->first();
    $data_value =[];
    if(!empty($data)){
         $data_value = json_decode($data->value, true);
    }

    if($data_value['function_customerUpLikePage']=='off'){
         return array('code'=>5,'mess'=>'Chương trình này đã hết');
    }
    if($isRequestPost){
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['token'])  && !empty($dataSend['id_page'])){

            $user =  getCustomerByToken($dataSend['token']);
            if(!empty($user)){

                $save = $modelCustomer->get($user->id);
                // trừ tiền tài khoản
                if(!empty($save->up_like)){
                    $save->up_like += 10;
                }else{
                    $save->up_like = 100;
                }
                // gửi yêu cầu sang hệ thống tăng like
              //  $sendOngTrum = sendRequestBuffOngTrum($type_api, $dataSend['id_page'], $data_value['chanel'], $save->up_like, $dataSend['url_page'], $user->id);

               /* if($sendOngTrum['code']==200){ */
          
                    $modelCustomer->save($save);
                    // lưu yêu cầu
                    $saveRequest = $modelUplikeHistories->newEmptyEntity();
                    $saveRequest->id_member = $user->id;
                    $saveRequest->id_system = 0;
                    $saveRequest->id_page = $dataSend['id_page'];
                    $saveRequest->type_page = $dataSend['type_api'];
                    $saveRequest->money = $dataSend['total_pay'];
                    $saveRequest->number_up = $dataSend['number_up'];
                    $saveRequest->chanel = $data_value['chanel'];
                    $saveRequest->url_page = $dataSend['url_page'];
                    $saveRequest->price = $dataSend['price'];
                    $saveRequest->type = 'customer';
                    $saveRequest->create_at = time();
                    $saveRequest->status = 'new';
                    $saveRequest->run = 0;
                    $saveRequest->token_device = $user->token_device;
                    // $saveRequest->id_request_buff = $sendOngTrum['id'];
                    // $saveRequest->note_buff = json_encode($sendOngTrum);

                    $modelUplikeHistories->save($saveRequest);

                    $sms = $user->phone.' upLike'.$saveRequest->id;          

                   if(function_exists('checkpayos')){
                        $infobank =  checkpayos($saveRequest->money,$sms);
                        if(!empty($infobank)){
                            $bank_code = $infobank['bin'];
                            $account_holders_bank = $infobank['accountName'];
                            $number_bank = $infobank['accountNumber'];
                            $sms = $infobank['description'];
                            $amount = $infobank['amount'];
                            $code_bank = $infobank['code_bank'];

                        }
                    }

                    $link_qr_bank = 'https://img.vietqr.io/image/'.$bank_code.'-'.$number_bank.'-compact2.png?amount='.$amount.'&addInfo='.$sms.'&accountName='.$account_holders_bank;

                    $data = array('number_bank'=>$number_bank,
                                    'name_bank'=>$code_bank,
                                    'name_account_bank'=>$account_holders_bank,
                                    'link_qr_bank'=>$link_qr_bank,
                                    'content'=>$sms,
                                    'amount'=>$amount,
                                    'note'=>"Vui lòng nhập đúng nội dung chuyển tiền, nhập sai không thanh toán được, chúng tôi không chịu trách nhiệm."
                                );


                    return array('code'=>1,'mess'=>'Bạn sử dụng tăng like thành công', 'data'=>$saveRequest, 'infobank'=> $data);
               /* }else{
                    return array('code'=>5, 'mess'=>$sendOngTrum['message']);
                }*/
            }else{
                 return array('code'=>3,'mess'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
            }
        }else{
            return array('code'=>2,'mess'=>'Gửi thiếu dữ liệu');
        }
    }
    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
}
 ?>