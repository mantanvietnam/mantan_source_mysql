<?php 
function listRoomAPI($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $controller;

 
    if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listRoom','room');
			if(!empty($infoUser)){
		        $modelRoom = $controller->loadModel('Rooms');
		        $modelBed = $controller->loadModel('Beds');
		        $conditions = array( 'id_member'=>$infoUser->id_member,'id_spa'=>$infoUser->id_spa);
		        $listData = $modelRoom->find()->where($conditions)->all()->toList();
		        if(!empty($listData)){
		            foreach($listData as $key => $item){
		                $listData[$key]->bed = $modelBed->find()->where(['id_room'=>$item->id])->count();
		            }
		        }
		        $totalData = $modelRoom->find()->where($conditions)->count();
      			return apiResponse(1,'lấy dữ liệu thành công',$listData, $totalData);		  	
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}


function addRoomAPI($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;

    $modelRoom = $controller->loadModel('Rooms');

    if ($isRequestPost) {
    	$dataSend = $input['request']->getData();
        if(!empty($dataSend['token']) && !empty($dataSend['name'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listRoom','room');
			if(!empty($infoUser)){
	            // tính ID category
	            if(!empty($dataSend['id'])){
	                $data = $modelRoom->get( (int) $dataSend['id']);
	            }else{
	                $data = $modelRoom->newEmptyEntity();
	                $data->created_at = time();
	            }
	            // tạo dữ liệu save
	            $data->name = $dataSend['name'];
	            $data->status = 1;
	            $data->id_spa = $infoUser->id_spa;
	            $data->id_member = $infoUser->id_member;
	            $modelRoom->save($data);

	            return apiResponse(1,'Lưu dữ liệu thành công',$data);
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}

	return apiResponse(0,'Gửi sai phương thức POST');
}


function deleteRoomAPI($input){
    global $isRequestPost;
    global $controller;

	$modelBed = $controller->loadModel('Beds');
    if($isRequestPost){
    	$dataSend = $input['request']->getData();
        if(!empty($dataSend['token']) && !empty($dataSend['id'])){
			$infoUser = getMemberByToken($dataSend['token'], 'deleteRoom','room');
			if(!empty($infoUser)){
        
	        	$modelRoom = $controller->loadModel('Rooms');
	            $conditions = array('id'=> $dataSend['id'], 'id_member'=>$infoUser->id_member);
	            
	            $data = $modelRoom->find()->where($conditions)->first();
	            $checkBeb = $modelBed->find()->where(['id_room'=>$data->id])->first();
	            if(empty($checkBeb)){
	            	if(!empty($data)){
	                $modelRoom->delete($data);
	           			return apiResponse(1,'Xóa dữ liệu thành công');
					}
					return apiResponse(4,'Dữ liệu không tồn tại' );
				}
				return apiResponse(4,'Phòng này không xóa được' );
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}

function detailRoomAPI($input){	
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    $modelMembers = $controller->loadModel('Members');
	$modelSpas = $controller->loadModel('Spas');
	$modelService = $controller->loadModel('Services');

	$modelBed = $controller->loadModel('Beds');
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token']) && !empty($dataSend['id'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listBook','calendar');
			if(!empty($infoUser)){

	        $data = $modelBed->find()->where(['id'=> (int) $dataSend['id'], 'id_member'=>$infoUser->id_member])->first();
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


function listBedAPI($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;

   	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listBed','room');
			if(!empty($infoUser)){
		        $modelRoom = $controller->loadModel('Rooms');
		        $modelBed = $controller->loadModel('Beds');
		        
		        $conditions = array( 'id_member'=>$infoUser->id_member,'id_spa'=>$infoUser->id_spa);
		        
		        $listData = $modelBed->find()->where($conditions)->order(['id_room'=>'desc'])->all()->toList();
		        
		        if(!empty($listData)){
		            foreach ($listData as $key => $value) {
		                $room = $modelRoom->find()->where(['id'=>$value->id_room])->first();
		                if(!empty($room)){
		                    $listData[$key]->room = $room;
		                }
		            }
		        }

        		$totalData = $modelBed->find()->where($conditions)->count();
      			return apiResponse(1,'lấy dữ liệu thành công',$listData, $totalData);		  	
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}


function addBedAPI($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;

    $modelBed = $controller->loadModel('Beds');

    if ($isRequestPost) {	
    	$dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listRoom','room');
			if(!empty($infoUser)){
	            // tính ID category
	            if(!empty($dataSend['id'])){
	                $data = $modelBed->get( (int) $dataSend['id']);
	            }else{
	                $data = $modelBed->newEmptyEntity();
	                $data->created_at = time();
	            }
	            
	            // tạo dữ liệu save
	            if(!empty($dataSend['name'])){
	            	$data->name = $dataSend['name'];
	        	}
	            $data->status = 1;
	            if(!empty($dataSend['id_room'])){
	            	$data->id_room = $dataSend['id_room'];
	        	}
	            $data->id_spa = $infoUser->id_spa;
	            $data->id_member = $infoUser->id_member;
	            $modelBed->save($data);

	            return apiResponse(1,'Lưu dữ liệu thành công',$data);
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}

function deleteBedAPI($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;

    if ($isRequestPost) {	
    	$dataSend = $input['request']->getData();
        if(!empty($dataSend['token']) && !empty($dataSend['id'])){
			$infoUser = getMemberByToken($dataSend['token'], 'deleteBed','room');
			if(!empty($infoUser)){
        
        		$modelBed = $controller->loadModel('Beds');
        		$modelUserserviceHistories = $controller->loadModel('UserserviceHistories');

        
            $conditions = array('id'=> $_GET['id'], 'id_member'=>$infoUser->id_member);
            
            $data = $modelBed->find()->where($conditions)->first();
            $checkUserservice = $modelUserserviceHistories->find()->where(['id_bed'=>$data->id])->first();
	            if(!empty($checkUserservice)){
		            if(!empty($data)){
		                $modelBed->delete($data);
		            	return apiResponse(1,'Xóa dữ liệu thành công');
					}
					return apiResponse(4,'Dữ liệu không tồn tại' );
				}
				return apiResponse(4,'Phòng này không xóa được' );
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}


function detailBedAPI($input){	
	global $isRequestPost;
    global $controller;

	$modelRoom = $controller->loadModel('Rooms');
	$modelBed = $controller->loadModel('Beds');
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token']) && !empty($dataSend['id'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listBook','calendar');
			if(!empty($infoUser)){

	        $data = $modelBed->find()->where(['id'=> (int) $dataSend['id'], 'id_member'=>$infoUser->id_member])->first();
	        if(!empty($data)){
	        	$data->inforoom = $modelRoom->find()->where(['id'=>$data->id_room])->first();
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

function listRoomBedAPI($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $controller;

 
    if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listRoom','room');
			if(!empty($infoUser)){
		        $modelRoom = $controller->loadModel('Rooms');
		        $modelBed = $controller->loadModel('Beds');
		        // danh sách giường
			    $conditionsRoom = array( 'id_member'=>$infoUser->id_member,'id_spa'=>$infoUser->id_spa);
			   	$listRoom = $modelRoom->find()->where($conditionsRoom)->all()->toList();
		        
		        if(!empty($listRoom)){
		            foreach($listRoom as $key => $item){
		                $listRoom[$key]->bed = $modelBed->find()->where( array('id_room'=>$item->id, 'id_member'=>$infoUser->id_member,'id_spa'=>$session->read('id_spa'), 'status'=>1))->all()->toList();
		            }
		        }
      			return apiResponse(1,'lấy dữ liệu thành công',$listData,);		  	
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}
 ?>