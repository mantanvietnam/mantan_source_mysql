<?php 
function listPriceAPI($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $controller;
    global $session;

    $metaTitleMantan = 'Cài đặt bản giá ';

    $modelPriceList = $controller->loadModel('PriceLists');
    
     
        $conditions = array('status'=>'active');
        $listData = $modelPriceList->find()->where($conditions)->all()->toList();
        $totalData = count($listData);
        return apiResponse(1, 'Lấy dữ liệu thành công', $listData,$totalData);
    
}

function paymEntextendUserAPI($input){
    global $controller;
    global $metaTitleMantan;
    global $isRequestPost;
    global $transactionKey;

    $modelTransactions = $controller->loadModel('Transactions');
    
    $modelPriceList = $controller->loadModel('PriceLists');
    $modelUser = $controller->loadModel('Users');
    if($isRequestPost){
        $dataSend = $input['request']->getData();
         if (!empty($dataSend['token']) && !empty($dataSend['id'])) {
            $conditions = ['token' => $dataSend['token']];
            $conditions['status'] = 'active';
            $user = $modelUser->find()->where($conditions)->first();

            
            if (!empty($user)) {
            $conditions = array('id'=>(int) $dataSend['id'],'status'=>'active');
            
            $data = $modelPriceList->find()->where($conditions)->first();

            if(!empty($data)){
                $checkTransaction = $modelTransactions->find()->where(['id_package'=>$data->id,'id_user'=>$user->id, 'status'=>1])->first();
                if(empty($checkTransaction)){
                    $checkTransaction = $modelTransactions->newEmptyEntity();
                    $checkTransaction->id_user = $user->id;
                    $checkTransaction->name = $data->name;
                    $checkTransaction->name_en = $data->name_en;
                    $checkTransaction->total = $data->price;
                    $checkTransaction->id_course = 0;
                    $checkTransaction->id_package = 0;
                    $checkTransaction->id_challenge = 0;
                    $checkTransaction->id_price = $data->id;
                    $checkTransaction->status = 1;
                    $checkTransaction->type = 4;
                    $checkTransaction->created_at = time();
                    $checkTransaction->code = time().$user->id.rand(0,10000);

                    

                }else{
                    $checkTransaction->type_use = @$dataSend['id_price'];
                    $checkTransaction->updated_at = time();
                }


                $modelTransactions->save($checkTransaction);
                $bank = getBankAccount();


                $sms = $checkTransaction->id.' '.$transactionKey;

                $link_qr_bank = 'https://img.vietqr.io/image/'.$bank['bank_code'].'-'.$bank['bank_number'].'-compact2.png?amount='.$data->price.'&addInfo='.$sms.'&accountName='.$bank['bank_name'];
                $data->infoQR =   array('name_bank'=>$bank['bank_code'],
                                'account_holders_bank'=>$bank['bank_name'],
                                'link_qr_bank'=>$link_qr_bank,
                                'money'=>$bank['bank_number'],
                                'content'=>$sms,
                                'money'=>$data->price
                            );

  
            }
       
            
            return apiResponse(0, 'Tạo yêu câu thành công', $data);
            }
            return apiResponse(3, 'Tài khoản không tồn tại hoặc chưa đăng nhập');
        } 
        return apiResponse(2, 'Gửi thiếu dữ liệu');  
    }
    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}


 ?>