<?php 
function searchPartnerApi($input)
{
	global $controller;
	global $session;

	$return = [];

	if(!empty($session->read('infoUser'))){
		$modelPartner = $controller->loadModel('Partners');

		if(!empty($_GET['key'])){
            $conditions = array('id_member'=>$session->read('infoUser')->id_member);
            $conditions['OR'] = [['name LIKE' => '%'.$_GET['key'].'%'], ['phone' => $_GET['key']], ['email' => $_GET['key']]];
          
            $order = array('name' => 'asc');

            $listData = $modelPartner->find()->where($conditions)->order($order)->all()->toList();
            
            if($listData){
                foreach($listData as $data){
                    $return[]= array('id'=>$data->id,
                    				'label'=>$data->name.' '.$data->phone,
                    				'value'=>$data->id,
                    				'name'=>$data->name,
                    				'phone'=>$data->phone,
                    				'email'=>$data->email,
                    				'address'=>$data->address,
                    			);
                }
            }
        }
	}

	return $return;
}

function addPartnerAjax($input)
{
	global $controller;
	global $isRequestPost;
    global $modelCategories;
	global $metaTitleMantan;
	global $session;
	global $urlHomes;

    $metaTitleMantan = 'Thông tin đối tác';

	$modelPartner = $controller->loadModel('Partners');
	$modelMembers = $controller->loadModel('Members');
	
	$mess= array('code'=> 0,'mess'=>'<p class="text-danger">Bạn chưa nhập dữ liệu bắt buộc</p>');
	
	if(!empty(checkLoginManager('addPartner', 'product'))){
		$infoUser = $session->read('infoUser');

		// lấy data edit
	    if(!empty($_GET['id'])){
	        $data = $modelPartner->get( (int) $_GET['id']);
	    }else{
	        $data = $modelPartner->newEmptyEntity();
			$data->created_at = time();
	    }

		if ($isRequestPost) {
	        $dataSend = $input['request']->getData();

	        if(!empty($dataSend['name']) && !empty($dataSend['phone'])){
	        	$dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone']));
	        	$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

	        	$conditions = ['phone'=>$dataSend['phone'],'id_member'=>$infoUser->id_member];
	        	$checkPhone = $modelPartner->find()->where($conditions)->first();

	        	if(empty($checkPhone) || (!empty($_GET['id']) && $_GET['id']==$checkPhone->id) ){
			        // tạo dữ liệu save
			        $data->name = $dataSend['name'];
			        $data->phone = $dataSend['phone'];
			        $data->address = $dataSend['address'];
			        $data->email = $dataSend['email'];
			        $data->id_member = $infoUser->id_member;
			        $data->updated_at = time();

			        $modelPartner->save($data);

			        $mess= array('code'=> 1, 'mess'=>'<p class="text-success">Lưu dữ liệu thành công</p>');
			    }else{
			    	$mess= array('code'=> 2, 'mess'=>'<p class="text-danger">Số điện thoại đã tồn tại</p>');
			    }
		    }else{
		    	$mess= array('code'=> 3, 'mess'=>'<p class="text-danger">Bạn chưa nhập dữ liệu bắt buộc</p>');
		    }
	    }

	    return $mess;
    }else{
		return $controller->redirect('/');
	}
}

function listPartnerAPI($input)
{
	global $controller;
	global $modelCategories;
	global $urlCurrent;
	global $isRequestPost;
    global $session;

	$modelPartner = $controller->loadModel('Partners');

	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listPartner','product');
			if(!empty($infoUser)){

		$conditions = array('id_member'=>$infoUser->id_member);
		$limit = 20;
		$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
		if($page<1) $page = 1;
		$order = array('id'=>'desc');

		if(!empty($dataSend['id'])){
			$conditions['id'] = (int) $dataSend['id'];
		}

		if(!empty($dataSend['phone'])){
			$conditions['phone'] = $dataSend['phone'];
		}

		if(!empty($dataSend['email'])){
			$conditions['email'] = $dataSend['email'];
		}

		if(!empty($dataSend['name'])){
			$conditions['name LIKE'] = '%'.$dataSend['name'].'%';
		}

	    $listData = $modelPartner->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
	    

	    $totalData = $modelPartner->find()->where($conditions)->all()->toList();
	    $totalData = count($totalData);
	    return apiResponse(1,'Bạn lấy dữ liệu thành công',$listData, $totalData );
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST'); 
}

function detailPartnerAPI($input){	
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    $modelMembers = $controller->loadModel('Members');
    $modelPartner = $controller->loadModel('Partners');
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token']) && !empty($dataSend['id'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listPartner','product');
			if(!empty($infoUser)){

	        $data = $modelPartner->find()->where(['id'=> (int) $dataSend['id'], 'id_member'=>$infoUser->id_member])->first();
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

function addPartnerAPI($input)
{
	global $controller;
	global $isRequestPost;
    global $modelCategories;
	global $metaTitleMantan;
	global $session;
	global $urlHomes;

    $metaTitleMantan = 'Thông tin đối tác';

	$modelPartner = $controller->loadModel('Partners');
	$modelMembers = $controller->loadModel('Members');
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token']) && !empty($dataSend['name']) && !empty($dataSend['phone'])){
			$infoUser = getMemberByToken($dataSend['token'], 'addPartner','product');
			if(!empty($infoUser)){

				// lấy data edit
			    if(!empty($dataSend['id'])){
			        $data = $modelPartner->get( (int) $dataSend['id']);
			    }else{
			        $data = $modelPartner->newEmptyEntity();
					$data->created_at = time();
			    }
			    $dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone']));
			   	$dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

			    $conditions = ['phone'=>$dataSend['phone'],'id_member'=>$infoUser->id_member];
		    	$checkPhone = $modelPartner->find()->where($conditions)->first();

	        	if(empty($checkPhone) || (!empty($dataSend['id']) && $dataSend['id']==$checkPhone->id) ){
			        // tạo dữ liệu save
			        $data->name = $dataSend['name'];
			        $data->phone = $dataSend['phone'];
			        $data->address = @$dataSend['address'];
			        $data->email = @$dataSend['email'];
			        $data->note = @$dataSend['note'];
			        $data->id_member = @$infoUser->id_member;
			        $data->updated_at = time();

			        $modelPartner->save($data);

			        return apiResponse(1,'Lưu dữ liệu thành công',$data);
			        }
				return apiResponse(3,'Số điện thoại đã tồn tại' );

			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}

	return apiResponse(0,'Gửi sai phương thức POST');
}


function deletePartnerAPI($input){
	global $controller;
	global $session;
	
	$modelPartner = $controller->loadModel('Partners');

	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token']) && !empty($dataSend['id'])){
			$infoUser = getMemberByToken($dataSend['token'], 'deletePartner','product');
			if(!empty($infoUser)){
				$data = $modelPartner->find()->where(['id'=>$dataSend['id'],'id_member'=>$infoUser->id_member])->first();
			
				if(!empty($data)){
	        	 	$modelPartner->delete($data);
					return apiResponse(1,'Xóa dữ liệu thành công');
				}
				return apiResponse(4,'Dữ liệu không tồn tại' );
			}
			
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}
?>