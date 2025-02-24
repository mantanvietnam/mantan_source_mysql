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
                
                if(!empty($checktoday)){
                    return array('code'=>4,'mess'=>'Bạn dùng tăng like Fanpage hôm nay rồi ');
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
 ?>