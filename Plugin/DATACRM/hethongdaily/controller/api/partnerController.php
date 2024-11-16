<?php 
function listPartnerAPI($input)
{
	global $controller;
	global $modelCategories;
	global $urlCurrent;
	global $metaTitleMantan;
	global $isRequestPost;

    $metaTitleMantan = 'Danh sách đối tác';

	$modelPartner = $controller->loadModel('Partners');
 

   	if ($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token'],'listPartner');

            if(!empty($infoMember)){
                if(empty($infoMember->grant_permission)){
                    return array('code'=>4, 'mess'=>'Bạn không có quyền');
                }
                if(!empty($infoMember->id_father)){
                	return array('code'=>5, 'mess'=>'Tài khoản của bạn không phải boss');
                }

				$conditions = array('id_member'=>$infoMember->id);
				$limit = 20;
				$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
				if($page<1) $page = 1;
				$order = array('id'=>'desc');

				if(!empty($_GET['id'])){
					$conditions['id'] = (int) $_GET['id'];
				}

				if(!empty($_GET['phone'])){
					$conditions['phone'] = $_GET['phone'];
				}

				if(!empty($_GET['email'])){
					$conditions['email'] = $_GET['email'];
				}

				if(!empty($_GET['name'])){
					$conditions['name LIKE'] = '%'.$_GET['name'].'%';
				}

			
		    	$listData = $modelPartner->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
		    

		    	$totalData = $modelPartner->find()->where($conditions)->all()->toList();
		    	$totalData = count($totalData);
		     	$return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công', 'listData'=>$listData, 'totalData'=>$totalData);
        	}else{
                $return = array('code'=>3, 'mess'=>'Sai mã token');
            }
        }else{
            $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
            $return = array('code'=>0, 'mess'=>'gửi sai kiểu POST');

    }

    return $return;
}

function addPartnerAPI($input)
{
	global $controller;
	global $isRequestPost;
    global $modelCategories;
	global $metaTitleMantan;
	global $urlHomes;

    $metaTitleMantan = 'Thông tin đối tác';

	$modelPartner = $controller->loadModel('Partners');
	$modelMembers = $controller->loadModel('Members');
	
	$mess= '';
	 

    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token']) && !empty($dataSend['name']) && !empty($dataSend['phone'])){
          $infoMember = getMemberByToken($dataSend['token'],'addPartner');

            if(!empty($infoMember)){
                if(empty($infoMember->grant_permission)){
                    return array('code'=>4, 'mess'=>'Bạn không có quyền');
                }
                if(!empty($infoMember->id_father)){
                	return array('code'=>5, 'mess'=>'Tài khoản của bạn không phải boss');
                }

				// lấy data edit
			    if(!empty($dataSend['id'])){
			        $data = $modelPartner->get( (int) $dataSend['id']);
			    }else{
			        $data = $modelPartner->newEmptyEntity();
					$data->created_at = time();
			    }
			    // tạo dữ liệu save
			    $data->name = $dataSend['name'];
			    $data->phone = $dataSend['phone'];
			    $data->address = $dataSend['address'];
			    $data->email = $dataSend['email'];
			    $data->note = $dataSend['note'];
			    $data->id_member = $infoMember->id;
		        $data->updated_at = time();

			    $modelPartner->save($data);

			    if(!empty($dataSend['id'])){
                  $note = $infoMember->type_tv.' '. $infoMember->name.' sửa thông tin đối tác '.$data->name.' có id là:'.$data->id;
             	}else{
                  $note = $infoMember->type_tv.' '. $infoMember->name.' thêm thông tin đối tác '.$data->name.' có id là:'.$data->id;
             	}

               	addActivityHistory($infoMember,$note,'addPartner',$data->id);

			    $return = array('code'=>1, 'mess'=>'Lưu dữ liệu thành công','data'=>$data);
            }else{
                $return = array('code'=>3, 'mess'=>'Sai mã token');
            }
        }else{
            $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
         $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
    }

    return $return;
}

function deletePartnerAPI($input){
	global $controller;
	global $isRequestPost;
	
	$modelPartner = $controller->loadModel('Partners');
	
	$user = checklogin('deletePartner');  

   if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token']) && !empty($dataSend['id'])){
          $infoMember = getMemberByToken($dataSend['token'],'addPartner');

            if(!empty($infoMember)){
                if(empty($infoMember->grant_permission)){
                    return array('code'=>4, 'mess'=>'Bạn không có quyền');
                }
                if(!empty($infoMember->id_father)){
                	return array('code'=>5, 'mess'=>'Tài khoản của bạn không phải boss');
                }
				$data = $modelPartner->get($dataSend['id']);
				
				if(!empty($data)){
					$note = $user->type_tv.' '. $user->name.' xóa thông tin sản phẩm '.$data->name.' có id là:'.$data->id;
	                addActivityHistory($user,$note,'deletePartner',$data->id);
		         	$modelPartner->delete($data);
		        }
		        $return = array('code'=>1, 'mess'=>'xóa dữ liệu thành công');
	        }else{
	 	       $return = array('code'=>3, 'mess'=>'Sai mã token');
	        }
        }else{
            $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
         $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
    }

    return $return;
} 

function getPartnerByIdAPI($input){
	global $controller;
	global $isRequestPost;
	
	$modelPartner = $controller->loadModel('Partners');
	
	$user = checklogin('deletePartner');  

   if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token']) && !empty($dataSend['id'])){
          $infoMember = getMemberByToken($dataSend['token'],'addPartner');

            if(!empty($infoMember)){
                if(empty($infoMember->grant_permission)){
                    return array('code'=>4, 'mess'=>'Bạn không có quyền');
                }
                if(!empty($infoMember->id_father)){
                	return array('code'=>5, 'mess'=>'Tài khoản của bạn không phải boss');
                }
				$data = $modelPartner->get($dataSend['id']);
				if(!empty($data)){
					$return = array('code'=>1, 'mess'=>'lấy dữ liệu thành công','data'=>$data);
		        }else{
		        	$return = array('code'=>1, 'mess'=>'xóa dữ liệu thành công');		        	
		        }
	        }else{
	 	       $return = array('code'=>3, 'mess'=>'Sai mã token');
	        }
        }else{
            $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
         $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
    }

    return $return;
}


 ?>