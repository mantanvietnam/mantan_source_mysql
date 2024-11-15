<?php 
function listPartner($input)
{
	global $controller;
	global $modelCategories;
	global $urlCurrent;
	global $metaTitleMantan;
    global $session;

    $metaTitleMantan = 'Danh sách đối tác';

	$modelPartner = $controller->loadModel('Partners');
	
    $user = checklogin('listPartner');  

    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/statisticAgency');
        }

        if(!empty($user->id_father)){
            return $controller->redirect('/');
        }

		$conditions = array('id_member'=>$user->id);
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

		// xử lý xuất excel
	    if(!empty($_GET['action']) && $_GET['action']=='Excel'){
    		$listData = $modelPartner->find()->where($conditions)->order($order)->all()->toList();

    		$titleExcel = 	[
								['name'=>'ID', 'type'=>'text', 'width'=>10],
								['name'=>'Họ tên', 'type'=>'text', 'width'=>25],
								['name'=>'Điện thoại', 'type'=>'text', 'width'=>15],
								['name'=>'Email', 'type'=>'text', 'width'=>35],
								['name'=>'Địa chỉ', 'type'=>'text', 'width'=>35],
						];

			$dataExcel = [];
			if(!empty($listData)){
				foreach ($listData as $key => $value) {
					

					$dataExcel[] = [
									$value->id, 
									$value->name, 
									$value->phone, 
									$value->email, 
									$value->address,
								];
				}
			}
			
			export_excel($titleExcel, $dataExcel, 'danh-sach-doi-tac'.date('d-m-Y'));
	    }else{
	    	$listData = $modelPartner->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
	    }

	    $totalData = $modelPartner->find()->where($conditions)->all()->toList();
	    $totalData = count($totalData);
	    $balance = $totalData % $limit;
	    $totalPage = ($totalData - $balance) / $limit;
	    if ($balance > 0)
	        $totalPage+=1;

	    $back = $page - 1;
	    $next = $page + 1;
	    if ($back <= 0)
	        $back = 1;
	    if ($next >= $totalPage)
	        $next = $totalPage;

	    if (isset($_GET['page'])) {
	        $urlPage = str_replace('&page=' . $_GET['page'], '', $urlCurrent);
	        $urlPage = str_replace('page=' . $_GET['page'], '', $urlPage);
	    } else {
	        $urlPage = $urlCurrent;
	    }
	    if (strpos($urlPage, '?') !== false) {
	        if (count($_GET) >= 1) {
	            $urlPage = $urlPage . '&page=';
	        } else {
	            $urlPage = $urlPage . 'page=';
	        }
	    } else {
	        $urlPage = $urlPage . '?page=';
	    }

	    $mess= '';
        
        if(!empty($_GET['error'])){
            switch ($_GET['error']) {
                case 'requestWarehouse':
                    $mess= '<p class="text-danger">Bạn cần tạo đối tác trước</p>';
                    break;
            }
        }

	    setVariable('page', $page);
	    setVariable('totalPage', $totalPage);
	    setVariable('back', $back);
	    setVariable('next', $next);
	    setVariable('urlPage', $urlPage);
	    setVariable('mess', $mess);
	    
	    setVariable('listData', $listData);
	}else{
		return $controller->redirect('/login');
	}
}

function addPartner($input)
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
	
	$mess= '';
	
	
    $user = checklogin('addPartner');  

    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/listPartner');
        }

        if(!empty($user->id_father)){
            return $controller->redirect('/');
        }

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

	        	$conditions = ['phone'=>$dataSend['phone'],'id_member'=>$user->id];
	        	$checkPhone = $modelPartner->find()->where($conditions)->first();

	        	if(empty($checkPhone) || (!empty($_GET['id']) && $_GET['id']==$checkPhone->id) ){
			        // tạo dữ liệu save
			        $data->name = $dataSend['name'];
			        $data->phone = $dataSend['phone'];
			        $data->address = $dataSend['address'];
			        $data->email = $dataSend['email'];
			        $data->note = $dataSend['note'];
			        $data->id_member = $user->id;
			        $data->updated_at = time();

			        $modelPartner->save($data);

			        if(!empty($_GET['id'])){
                      $note = $user->type_tv.' '. $user->name.' sửa thông tin đối tác '.$data->name.' có id là:'.$data->id;
                	}else{
                      $note = $user->type_tv.' '. $user->name.' thêm thông tin đối tác '.$data->name.' có id là:'.$data->id;
                	}

                	addActivityHistory($user,$note,'addPartner',$data->id);

			        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
			    }else{
			    	$mess= '<p class="text-danger">Số điện thoại đã tồn tại</p>';
			    }
		    }else{
		    	$mess= '<p class="text-danger">Bạn chưa nhập dữ liệu bắt buộc</p>';
		    }
	    }

	    setVariable('data', $data);
	    setVariable('mess', $mess);
	    setVariable('infoUser', $user);
    }else{
		return $controller->redirect('/login');
	}
}

function deletePartner($input){
	global $controller;
	global $session;
	
	$modelPartner = $controller->loadModel('Partners');
	
	$user = checklogin('deletePartner');  

    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/listPartner');
        }

        if(!empty($user->id_father)){
            return $controller->redirect('/');
        }
		if(!empty($_GET['id'])){
			$data = $modelPartner->get($_GET['id']);
			
			if(!empty($data)){
				$note = $user->type_tv.' '. $user->name.' xóa thông tin sản phẩm '.$data->name.' có id là:'.$data->id;
                addActivityHistory($user,$note,'deletePartner',$data->id);
	         	$modelPartner->delete($data);
	        }
		}

		return $controller->redirect('/listPartner');
	}else{
		return $controller->redirect('/login');
	}
}

function searchPartnerAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $modelCategories;

    $return= array();
    $modelPartner = $controller->loadModel('Partners');

    $dataSend = $_REQUEST;

    
    $conditions = [];

    if(!empty($dataSend['term'])){
        $conditions['OR'] = ['name LIKE' => '%'.$dataSend['term'].'%', 'phone LIKE' => '%'.$dataSend['term'].'%'];
    }

    if(!empty($dataSend['id'])){
        $conditions['id'] = (int) $dataSend['id'];
    }

    if(!empty($dataSend['phone'])){
        $dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone']));
        $dataSend['phone LIKE'] = '%'.str_replace('+84','0',$dataSend['phone']).'%';

        $conditions['phone LIKE'] = '%'.$dataSend['phone'].'%';
    }

    if(!empty($dataSend['email'])){
        $conditions['email LIKE'] =  '%'.$dataSend['email'].'%';
    }

    if(!empty($dataSend['status'])){
        $conditions['status'] = $dataSend['status'];
    }

    $listData= $modelPartner->find()->where($conditions)->all()->toList();
    
    if($listData){
        foreach($listData as $data){
            $return[]= array(   'id'=>$data->id,
                'label'=>$data->name.' '.$data->phone,
                'value'=>$data->id,
                'name'=>$data->name,
                'phone'=>$data->phone,
                'id_member'=>$data->id_member,
                'email'=>$data->email,
                'created_at'=>$data->created_at,
                'address'=>$data->address,
            );
        }
    }else{
        $return= array(array(   'id'=>0, 
            'label'=>'Không tìm được khách hàng, hãy tạo thông tin cho khách hàng mới', 
            'value'=>'', 
        )
    );
    }


    return $return;
}
 ?>