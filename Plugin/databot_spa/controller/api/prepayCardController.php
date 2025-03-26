<?php 
function listPrepayCardAPI($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Thẻ dịch vụ';

	$modelPrepayCard = $controller->loadModel('PrepayCards');
    if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listPrepayCard','prepaid_cards');
			if(!empty($infoUser)){

				$conditions = array('id_member'=>$infoUser->id_member, 'id_spa'=>$infoUser->id_spa);
				$limit = 20;
				$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
				if($page<1) $page = 1;
				$order = array('id'=>'desc');

				if(!empty($dataSend['id'])){
					$conditions['id'] = (int) $dataSend['id'];
				}

				if(!empty($dataSend['status'])){
					$conditions['status'] = $dataSend['status'];
				}

				if(!empty($dataSend['name'])){
					$conditions['name LIKE'] = '%'.$dataSend['name'].'%';
				}

				if(!empty($dataSend['price'])){
					$conditions['price'] = (int) $dataSend['price'];
				}

				if(!empty($dataSend['price_sell'])){
					$conditions['price_sell'] = (int) $dataSend['price_sell'];
				}

				$listData = $modelPrepayCard->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

				$totalData = $modelPrepayCard->find()->where($conditions)->count();
				return apiResponse(1,'lấy dữ liệu thành công',$listData, $totalData);		  	
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}

function detailPrepayCardAPI($input){	
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;
	
	$modelPrepayCard = $controller->loadModel('PrepayCards');
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token']) && !empty($dataSend['id'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listPrepayCard','prepaid_cards');
			if(!empty($infoUser)){

	        $data = $modelPrepayCard->find()->where(['id'=> (int) $dataSend['id'], 'id_member'=>$infoUser->id_member])->first();
	        if(!empty($data)){
			    return apiResponse(1,'Bạn lấy dữ liệu thành công',$data);
			}
			return apiResponse(4,'Dữ liệu không tồn tại' );
		}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}

function addPrepayCardAPI($input){
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    $modelPrepayCard = $controller->loadModel('PrepayCards');
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$infoUser = getMemberByToken($dataSend['token'], 'addPrepayCard','prepaid_cards');
			if(!empty($infoUser)){
		        $modelMembers = $controller->loadModel('Members');
				$modelPrepayCard = $controller->loadModel('PrepayCards');
				$modelTrademarks = $controller->loadModel('Trademarks');

		        // lấy data edit
		        if(!empty($dataSend['id'])){
		            $data = $modelPrepayCard->get( (int) $dataSend['id']);

		        }else{
		            $data = $modelPrepayCard->newEmptyEntity();
		            $data->created_at = time();
		        }

                // tạo dữ liệu save
                $data->name = @$dataSend['name'];
                $data->id_member = $infoUser->id_member;
                $data->id_spa = (int) $infoUser->id_spa;
                $data->status = @$dataSend['status'];
                $data->price =  @$dataSend['price'];
                $data->price_sell = @$dataSend['price_sell'];
                $data->note = @$dataSend['note'];
                $data->use_time = (int) $dataSend['use_time'];                
                $data->commission_staff_fix = (int) $dataSend['commission_staff_fix'];                
                $data->commission_staff_percent = (int) $dataSend['commission_staff_percent'];                
                
                $modelPrepayCard->save($data);

               return apiResponse(1,'Lưu dữ liệu thành công',$data);
			     
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}

	return apiResponse(0,'Gửi sai phương thức POST');
}

function deletePrepayCardAPI($input){
    global $controller;
    global $session;

    $modelPrepayCard = $controller->loadModel('PrepayCards');
    setVariable('page_view', 'deletePrepayCard');
    if(!empty(checkLoginManager('deletePrepayCard', 'prepaid_cards'))){
    	$infoUser = $session->read('infoUser');

        if(!empty($_GET['id'])){
            $data = $modelPrepayCard->get($_GET['id']);
            
            if($data){
                $modelPrepayCard->delete($data);
            }
        }

        return $controller->redirect('/listPrepayCard');
    }else{
        return $controller->redirect('/');
    }
}

 ?>