<?php 
function customerUpLikePageFacebookAPI($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;
    global $modelOptions;
    
    $modelMembers = $controller->loadModel('Members');
    $modelUplikeHistories = $controller->loadModel('UplikeHistories');
    $modelTransactionHistories = $controller->loadModel('TransactionHistories');

    // kiểm tra cái đặt token
    
        $type_api = 'facebook.buff.likepage';

        if($isRequestPost){
            $dataSend = $input['request']->getData();

            if(!empty($dataSend['token'])  && !empty($dataSend['id_page']) && !empty($dataSend['chanel']) && !empty($dataSend['number_up']) && !empty($dataSend['url_page'])){

                $user =  getCustomerByToken($dataSend['token']);


                if(!empty($user)){
                    // gửi yêu cầu sang hệ thống tăng like
                    $sendOngTrum = sendRequestBuffOngTrum($type_api, $dataSend['id_page'], $dataSend['chanel'], $dataSend['number_up'], $dataSend['url_page'], $user->id);

                    if($sendOngTrum['code']==200){
                        $mess= '<p class="text-success">Tạo yêu cầu thành công</p>';

                        // trừ tiền tài khoản
                        $user->coin -= $dataSend['total_pay'];
                        $modelMembers->save($user);

                        // tạo lịch sử giao dịch
                        $histories = $modelTransactionHistories->newEmptyEntity();

                       

                        // lưu yêu cầu
                        $saveRequest = $modelUplikeHistories->newEmptyEntity();

                        $saveRequest->id_member = $user->id;
                        $saveRequest->id_system = 0;
                        $saveRequest->id_page = $dataSend['id_page'];
                        $saveRequest->type_page = $type_api;
                        $saveRequest->money = $dataSend['total_pay'];
                        $saveRequest->number_up = $dataSend['number_up'];
                        $saveRequest->chanel = $dataSend['chanel'];
                        $saveRequest->url_page = $dataSend['url_page'];
                        $saveRequest->price = 0;
                        $saveRequest->type = 'staff';
                        $saveRequest->create_at = time();
                        $saveRequest->status = 'Running';
                        $saveRequest->run = 0;
                        $saveRequest->id_request_buff = $sendOngTrum['id'];
                        $saveRequest->note_buff = json_encode($sendOngTrum);

                        $modelUplikeHistories->save($saveRequest);
                    }else{
                        $mess= '<p class="text-danger">'.$sendOngTrum['message'].'</p>';
                    }
                }else{
                    $mess= '<p class="text-danger">Số dư tài khoản của bạn không đủ, vui lòng <a href="/listTransactionHistories">NẠP TIỀN</a></p>';
                }
            }else{
                $mess= '<p class="text-danger">Gửi thiếu dữ liệu</p>';
            }
        }

    
    return array('code'=>0,'data'=>null,'messages'=>'Gửi sai kiểu POST');
}
 ?>