<?php 
function listSpaAPI($input){
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    $modelMember = $controller->loadModel('Members');
	$modelSpas = $controller->loadModel('Spas');
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listSpa');
			if(!empty($infoUser)){ 
					$conditions = array();
					$limit = 20;
					$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
					if($page<1) $page = 1;
					$order = array('id'=>'desc');

					$conditions['id_member']= $infoUser->id_member;

					if(!empty($dataSend['name'])){
						$conditions['name LIKE'] = '%'.$dataSend['name'].'%';
					}

					if(!empty($dataSend['id'])){
						$conditions['id'] = (int) $dataSend['id'];
					}

					if(!empty($dataSend['phone'])){
						$conditions['phone'] = $dataSend['phone'];
					}

					if(!empty($dataSend['email'])){
						$conditions['email'] = $dataSend['email'];
					}

					$listData = $modelSpas->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

					$totalData = $modelSpas->find()->where($conditions)->count();
				    return apiResponse(1,'Bạn lấy dữ liệu thành công',$listData, $totalData );
				}
				return apiResponse(3,'Tài khoản không tồn tại' );
			}
			return apiResponse(2,'thếu dữ liệu' );
		}

	return apiResponse(0,'Gửi sai phương thức POST');
}

function detailSpaAPI($input){
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    $modelMember = $controller->loadModel('Members');
	$modelSpas = $controller->loadModel('Spas');
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		$infoUser = getMemberByToken($dataSend['token'], 'listSpa');
		if(!empty($infoUser)){ 
				$conditions = array();
				

				$conditions['id_member']= $infoUser->id_member;
				$conditions['id']= $dataSend['id'];

				$data = $modelSpas->find()->where($conditions)->first();

			    	return apiResponse(1,'Bạn lấy dữ liệu thành công',$data);
			}else{
				return apiResponse(3,'Tài khoản không tồn tại' );
			}
		
		}else{
			return apiResponse(2,'Gửi sai phương thức POST' );
		}

	return apiResponse(0,'Gửi sai phương thức POST');
}

function addSpaAPI($input){
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    $metaTitleMantan = 'Thông tin cơ sở kinh doanh';

    if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$infoUser = getMemberByToken($dataSend['token'], 'addSpa');
			if(!empty($infoUser)){
				$modelSpas = $controller->loadModel('Spas');
				$modelWarehouse = $controller->loadModel('Warehouses');

				$conditions = array();
				$conditions['id_member']= $infoUser->id_member;

				$totalData = $modelSpas->find()->where($conditions)->all()->toList();
				$totalData = count($totalData);
		
				// lấy data edit
	    		if(!empty($dataSend['id'])){
	        		$data = $modelSpas->get( (int) $dataSend['id']);

	    		}else{
	    			if ($infoUser->number_spa > $totalData){ 
		    	    	$data = $modelSpas->newEmptyEntity();
		    	    	$data->created_at = time();
	    			}else{
	    				return apiResponse(5,'không tạo được Spa mới');
	    			}
	    		}
	    	
		    	$data->name = $dataSend['name'];
		    	$data->phone = $dataSend['phone'];
	    		$data->address = $dataSend['address'];
	    		$data->email = $dataSend['email'];
		    	$data->note = $dataSend['note'];
		    	$data->updated_at =time();
	    		$data->slug = createSlugMantan($dataSend['name']).'-'.time();
	    		$data->id_member = $infoUser->id_member;

		    	$data->facebook = $dataSend['facebook'];
				$data->website = $dataSend['website'];
				$data->zalo = $dataSend['zalo'];
				if(isset($_FILES['image']) && empty($_FILES['image']["error"])){
					$avatar = uploadImage($checkUser->id, 'image', 'image_sap'.$checkUser->id);
				}

				if(!empty($avatar['linkOnline'])){

					$data->image = $avatar['linkOnline'].'?time='.time();
	    		}
	    		$modelSpas->save($data);
	    	
	    		if(empty($dataSend['id'])){
	    			// tạo kho mới
					$dataWarehouse = $modelWarehouse->newEmptyEntity();
				
					$dataWarehouse->name = $dataSend['address'];
					$dataWarehouse->credit = 1; // 1: cho bán âm, 0: không cho bán âm
					$dataWarehouse->id_member = $infoUser->id_member;
					$dataWarehouse->id_spa = $data->id;
					$dataWarehouse->created_at = time();
					$modelWarehouse->save($dataWarehouse);
	    		}
	    		return apiResponse(1,'Bạn lưu dữ liệu thành công',$data);
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		
			}
			return apiResponse(2,'thếu dữ liệu' );
		}

	return apiResponse(0,'Gửi sai phương thức POST');
}


function deleteSpaAPI($input){
	global $controller;
	global $session;
    global $controller;
    global $urlCurrent;

	$modelSpas = $controller->loadModel('Spas');
	
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token']) && !empty($dataSend['id'])){
			$infoUser = getMemberByToken($dataSend['token'], 'deteleSpa');
			if(!empty($infoUser)){
			        $data = $modelSpas->find()->where(['id'=>(int) $dataSend['id'], 'id_member'=>$infoUser->id_member])->first();
			        
			        if($data){
			            $modelSpas->delete($data);
			        }
			    

				return apiResponse(1,'Bạn xóa dữ liệu thành công');
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		
			}
			return apiResponse(2,'thếu dữ liệu' );
		}

	return apiResponse(0,'Gửi sai phương thức POST');
}

 ?>