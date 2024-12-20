<?php 
function checkInfommtcAPI($input)
{
	global $controller;
    global $isRequestPost;
    
    $modelCustomer = $controller->loadModel('Customers');

    $modelCustomerHistorieMmtt = $controller->loadModel('CustomerHistorieMmtts');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token'])) {
        	if(function_exists('getCustomerByToken')){
            	$user =  getCustomerByToken($dataSend['token']);
        	}
            
            if (!empty($user)) {
                $infodata = array();
               $data = getMemberById($user->id_parent);
               $number_user_mmtc = count($modelCustomerHistorieMmtt->find()->where(['id_user'=>$user->id])->all()->toList());
               if(!empty($user->max_export_mmtc)){
                $infodata['max_export_mmtc'] = $user->max_export_mmtc; 
               }else{
                $infodata['max_export_mmtc'] = $data->infosystem->max_export_mmtc; 
               }
               $infodata['price_export_mmtc'] = $data->infosystem->price_export_mmtc; 
               
               $infodata['number_user_mmtc'] = $number_user_mmtc; 


              return array('code'=>1,'messages'=>'Bạn lấy dữ liệu thành công', 'data'=>$infodata);
            }

            return array('code'=>3, 'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2, 'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
}

function buyExportmmtcAPI($input)
{
    global $controller;
    global $isRequestPost;
    
    $modelCustomer = $controller->loadModel('Customers');

    $modelCustomerHistorieMmtt = $controller->loadModel('CustomerHistorieMmtts');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token']) && !empty($dataSend['quantity'])){
            if(function_exists('getCustomerByToken')){
                $user =  getCustomerByToken($dataSend['token']);
            }
            
            if (!empty($user)) {
                $infodata = array();
               $data = getMemberById($user->id_parent);
               $number_user_mmtc = count($modelCustomerHistorieMmtt->find()->where(['id_user'=>$user->id])->all()->toList());
               $totalPrice = $dataSend['quantity'] * $data->infosystem->price_export_mmtc;

               $sms = $user->phone.' MMTC';          

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
              return array('code'=>1,'messages'=>'Tạo yêu cầu thanh toán thành công', 'data'=>$data);
            }

            return array('code'=>3, 'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2, 'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
}

function addMoneyApplePayAPI($input)
{
    global $controller;
    global $isRequestPost;
    
    $modelCustomer = $controller->loadModel('Customers');

    $modelCustomerHistorieMmtt = $controller->loadModel('CustomerHistorieMmtts');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token']) && !empty($dataSend['money'])){
            if(function_exists('getCustomerByToken')){
                $user =  getCustomerByToken($dataSend['token']);
            }
            
            if (!empty($user)) {
                $infodata = array();
               $data = getMemberById($user->id_parent);
               $number_user_mmtc = count($modelCustomerHistorieMmtt->find()->where(['id_user'=>$user->id])->all()->toList());
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
              return array('code'=>1,'messages'=>'Tạo yêu cầu thanh toán thành công', 'data'=>$data);
            }

            return array('code'=>3, 'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2, 'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
}

?>