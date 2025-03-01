<?php 
function addMoneyApplePayAPI($input)
{
    global $controller;
    global $isRequestPost;
    
    $modelUser = $controller->loadModel('Users');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['access_token']) && !empty($dataSend['money'])){
            if(function_exists('getUserByToken')){
                $user =  getUserByToken($dataSend['access_token']);
            }
            
            if (!empty($user)) {
                $infodata = array();
               $totalPrice = (int)$dataSend['money'];

               $sms = $user->phone.' NAPTIEN';          

               if(function_exists('checkpayos')){
                    $infobank =  checkpayos($totalPrice,$sms);
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
              return apiResponse(1,'Tạo yêu cầu thanh toán thành công',$data);

            }

            return apiResponse(3,'Tài khoản không tồn tại hoặc chưa đăng nhập');

        }

        return apiResponse(2,'Gửi thiếu dữ liệu');

    }

    return apiResponse(0,'Gửi sai kiểu POST');

}


function listHistorieAPI($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
    global $session;
	global $isRequestPost;

	$modelUser = $controller->loadModel('Users');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['access_token'])){
            if(function_exists('getUserByToken')){
                $user =  getUserByToken($dataSend['access_token']);
            }
	   		$modelTransactionHistory = $controller->loadModel('TransactionHistorys');

			if(!empty($user)){

				$conditions = array('id_user'=>$user->id);
				$limit = 20;
				$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
				if($page<1) $page = 1;
				$order = array('id'=>'desc');

				if(!empty($dataSend['id'])){
					$conditions['id'] = (int) $dataSend['id'];
				}

				if(!empty($dataSend['type'])){
					$conditions['type'] = (int) $dataSend['type'];
				}

			    $listData = $modelTransactionHistory->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

			    $totalData = $modelTransactionHistory->find()->where($conditions)->count();
			    return apiResponse(3,'Bạn lấy dữ liệu thành công',$listData, $totalData);		   
			}
            return apiResponse(3,'Tài khoản không tồn tại hoặc chưa đăng nhập');
    	}
        return apiResponse(2,'Gửi thiếu dữ liệu');
    }
    return apiResponse(0,'Gửi sai kiểu POST');
}


 ?>