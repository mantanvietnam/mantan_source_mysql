<?php 
function listPackageApi($input){
	global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $isRequestPost;


	$modelPackage = $controller->loadModel('Packages');
	$modelDocumentinfo = $controller->loadModel('Documentinfos');
    $modelMember = $controller->loadModel('Members');

	$return = array('code'=>1);	
	if($isRequestPost){
        $dataSend = $input['request']->getData();
        
                $conditions = array('status'=>'active');
			    if(!empty($dataSend['name'])){
			        $key=createSlugMantan($dataSend['name']);
			        $conditions['slug LIKE']= '%'.$key.'%';
			    }
			    $limit = 20;
			    $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
			    if($page<1) $page = 1;
			    $order = array('id'=>'desc');
			    
			    $listData = $modelPackage->find()->where($conditions)->order($order)->all()->toList();

			    // phân trang
			    $totalData = $modelPackage->find()->where($conditions)->count();
			    
			    $return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'listData'=>$listData, 'totalData'=>$totalData);
    }else{
        $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
    }

    return $return;
}

function detailPackageApi($input){
	global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $isRequestPost;


	$modelPackage = $controller->loadModel('Packages');
	$modelDocumentinfo = $controller->loadModel('Documentinfos');
    $modelMember = $controller->loadModel('Members');

	$return = array('code'=>1);	
	if($isRequestPost){
        $dataSend = $input['request']->getData();
		if(!empty($dataSend['id'])){
            $conditions = array('status'=>'active','id'=>(int)$dataSend['id']);    
			    
			$listData = $modelPackage->find()->where($conditions)->first();
			    
		    $return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công', 'data'=>$listData);
   		}else{
   			$return = array('code'=>2, 'mess'=>'Thiếu dữ liệu');
   		}
    }else{
        $return = array('code'=>0, 'mess'=>'Gửi sai kiểu POST');
    }

    return $return;
}

function buyPackageAPI($input)
{
    global $controller;
    global $isRequestPost;
    
    $modelCustomer = $controller->loadModel('Customers');

    $modelPackage = $controller->loadModel('Packages');

    $modelTransactionCustomers = $controller->loadModel('TransactionCustomers');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token']) && !empty($dataSend['id'])){
            if(function_exists('getCustomerByToken')){
                $user =  getCustomerByToken($dataSend['token']);
            }
            
            if(!empty($user)){
                $conditions = array('status'=>'active','id'=>(int)$dataSend['id']);
				$data = $modelPackage->find()->where($conditions)->first();
				if(!empty($data)){
					$histories = $modelTransactionCustomers->newEmptyEntity();

                    $histories->id_customer = $user->id;
                    $histories->id_system = 1;
                    $histories->id_package = $data->id;
                    $histories->coin = (int) $data->price;
                    $histories->type = 'plus';
                    $histories->status = 'new';
                    $histories->note = 'Mua gói '.$data->name;
                    $histories->create_at = time();

                    $modelTransactionCustomers->save($histories);

	               	$sms = $user->phone.' P'.$histories->id;          

	               if(function_exists('checkpayos')){
	                    $infobank =  checkpayos($data->price,$sms);
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
	              return array('code'=>1,'mess'=>'Tạo yêu cầu thanh toán thành công', 'data'=>$data);
	          	}
            	return array('code'=>1, 'mess'=>'Không tim thấy gói');
            }

            return array('code'=>3, 'mess'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'mess'=>'Gửi sai kiểu POST');
}

function checkPayPackageAPI($input)
{
    global $controller;
    global $isRequestPost;
    
    $modelCustomer = $controller->loadModel('Customers');

    $modelPackage = $controller->loadModel('Packages');

    $modelTransactionCustomers = $controller->loadModel('TransactionCustomers');
   
    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token']) && !empty($dataSend['note'])){
            if(function_exists('getCustomerByToken')){
                $user =  getCustomerByToken($dataSend['token']);
            }
            
            if(!empty($user)){
                $conditions = array('status'=>'done','id_customer'=>(int)$user->id,'meta_payment'=>$dataSend['note'], 'status'=>'done');
				$data = $modelTransactionCustomers->find()->where($conditions)->first();
				if(!empty($data)){
	              return array('code'=>1,'mess'=>'Đã thanh toán thành công', 'data'=>$data);
	          	}
            	return array('code'=>4, 'mess'=>'Chưa thanh toán toán');
            }

            return array('code'=>3, 'mess'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'mess'=>'Gửi sai kiểu POST');
}
?>