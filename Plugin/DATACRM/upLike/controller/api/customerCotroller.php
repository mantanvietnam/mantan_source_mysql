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


    if($isRequestPost){
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['token'])  && !empty($dataSend['id_page']) && $dataSend['number_up']){

            $user =  getCustomerByToken($dataSend['token']);
            if(!empty($user)){
                $startOfDay = strtotime("today 00:00:00");
                $checktoday =  $modelTransactionHistories->find()->where(['type'=>'customer','create_at >'=>$startOfDay, 'id_member'=>$user->id])->first();
                if(!empty($checktoday)){
                    return array('code'=>4,'mess'=>'Bạn dùng tăng like Fanpage hôm nay rồi ');
                }

                if(!empty($user->up_like>=300)){
                    return array('code'=>4,'mess'=>'dùng hiết 300 like rồi ');
                }

                if(empty($dataSend['number_up'])){
                  /*  if($user->up_like==0){
                        $dataSend['number_up'] = 100;
                    }else{
                         $dataSend['number_up'] = 10;
                    }*/
                }else{
                    // if($user->up_like==0){
                        if($dataSend['number_up']>300){
                            return array('code'=>5,'mess'=>'số lượng bạn không vượt quá 300');
                        }
              //      }

                    /*else{
                        if($dataSend['number_up']>10){
                            return array('code'=>5,'mess'=>'số lượng bạn không vượt quá 10');
                        }
                    }*/
                }

                    // gửi yêu cầu sang hệ thống tăng like
                    $sendOngTrum = sendRequestBuffOngTrum($type_api, $dataSend['id_page'], $data_value['chanel'], $dataSend['number_up'], $dataSend['url_page'], $user->id);

                    if($sendOngTrum['code']==200){
                        $mess= '<p class="text-success">Tạo yêu cầu thành công</p>';
                        $save = $modelCustomer->get($user->id);
                        // trừ tiền tài khoản
                        $save->up_like += (int) $dataSend['number_up'];
                        $modelCustomer->save($save);
                        // lưu yêu cầu
                        $saveRequest = $modelUplikeHistories->newEmptyEntity();

                        $saveRequest->id_member = $user->id;
                        $saveRequest->id_system = 0;
                        $saveRequest->id_page = $dataSend['id_page'];
                        $saveRequest->type_page = $type_api;
                        $saveRequest->money = 0;
                        $saveRequest->number_up = $dataSend['number_up'];
                        $saveRequest->chanel = $data_value['chanel'];
                        $saveRequest->url_page = $dataSend['url_page'];
                        $saveRequest->price = 0;
                        $saveRequest->type = 'customer';
                        $saveRequest->create_at = time();
                        $saveRequest->status = 'Running';
                        $saveRequest->run = 0;
                        $saveRequest->id_request_buff = $sendOngTrum['id'];
                        $saveRequest->note_buff = json_encode($sendOngTrum);

                        $modelUplikeHistories->save($saveRequest);
                        return array('code'=>1,'mess'=>'Bạn sử dụng tăng like thành công');
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
 ?>