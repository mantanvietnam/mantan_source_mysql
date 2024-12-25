<?php 	
function listCustomerGreenCheckRequest($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $modelCategoryConnects;
    $user = checklogin('listCustomerGreenCheckRequest');   

    if(!empty($user)){
      if(empty($user->grant_permission)){
        return $controller->redirect('/statisticAgency');
      }


        $metaTitleMantan = 'Danh sách khách hàng';

        $modelCustomers = $controller->loadModel('Customers');
        $modelMakeFriend = $controller->loadModel('MakeFriends');
        $modelMember = $controller->loadModel('Members');
        $modelVerifyAccount = $controller->loadModel('VerifyAccounts');
        $modelPointCustomer = $controller->loadModel('PointCustomers');
        $modelCustomerHistories = $controller->loadModel('CustomerHistories');

        // danh sách nhóm khách hàng
        $conditions = array();
        

        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        $order = array('updated_at'=>'desc');
       

       

        if(!empty($_GET['id'])){
            $conditions['id'] = (int) $_GET['id'];
        }

      

        if(!empty($_GET['full_name'])){
            $conditions['full_name LIKE'] = '%'.$_GET['full_name'].'%';
        }

        if(!empty($_GET['phone'])){
            $conditions['phone LIKE'] = $_GET['phone'];
        }


        if(!empty($_GET['blue_check'])){
            $conditions['blue_check'] = $_GET['blue_check'];
        }else{
        	$conditions['blue_check IN']=['request','active'];
        }

        if(!empty($_GET['action']) && $_GET['action']=='Excel'){
            $listData = $modelCustomers->find()->where($conditions)->order($order)->all()->toList();
            
            $titleExcel =   [
                ['name'=>'Họ và tên', 'type'=>'text', 'width'=>25],
                ['name'=>'Số điện thoại', 'type'=>'text', 'width'=>25],
                ['name'=>'Địa chỉ', 'type'=>'text', 'width'=>25],
                ['name'=>'Email', 'type'=>'text', 'width'=>25],
                ['name'=>'Giới tính', 'type'=>'text', 'width'=>25],
                ['name'=>'Trạng thái', 'type'=>'text', 'width'=>25],
                ['name'=>'Ngày sinh', 'type'=>'text', 'width'=>25], 
            ];

            $dataExcel = [];
            if(!empty($listData)){
                foreach ($listData as $key => $value) {
                    $status= 'Khóa';
                    if($value->status=='active'){ 
                        $status= 'Kích hoạt';
                    }

                    $sex= 'Nữ';
                    if($value->sex==1){ 
                        $sex= 'Nam';
                    }

                    $birthday = '';
                    if(!empty($value->birthday_date) && !empty($value->birthday_month) && !empty($value->birthday_year)){
                        $birthday = $value->birthday_date.'/'.$value->birthday_month.'/'.$value->birthday_year;
                    }

                    $dataExcel[] = [
                        $value->full_name,   
                        $value->phone,   
                        $value->address,   
                        $value->email,   
                        $sex,
                        $status,
                        $birthday
                    ];
                }
            }
            export_excel($titleExcel,$dataExcel,'danh_sach_khach_hang');
        }else{
            $listData = $modelCustomers->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        }

        if(!empty($listData)){
        	foreach($listData as $key => $item){
        		$conditionFriend = ['status'=>"agree"];

                $conditionFriend['OR'] = [ 
                    ['id_customer_request'=>$item->id],
                    ['id_customer_confirm'=>$item->id],
                ];
                $listData[$key]->total_friend = $modelMakeFriend->find()->where($conditionFriend)->count();
                $member = $modelMember->find()->where(['id_father'=>0])->first();
                $listData[$key]->point = $modelPointCustomer->find()->where(['id_member'=>$member->id, 'id_customer'=>$item->id])->first()->point;
                $listData[$key]->verify = $modelVerifyAccount->find()->where(['id_customer'=>$item->id])->first();
        	}
        }

        // phân trang
        $totalData = $modelCustomers->find()->where($conditions)->count();

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

        setVariable('page', $page);
        setVariable('totalPage', $totalPage);
        setVariable('back', $back);
        setVariable('next', $next);
        setVariable('urlPage', $urlPage);
        setVariable('totalData', $totalData);
        
        setVariable('listData', $listData);
    }else{
        return $controller->redirect('/login');
    }
}

function updateGreenCheckRequest($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $modelCategoryConnects;
    $user = checklogin('updateGreenCheckRequest');   

    if(!empty($user)){
      if(empty($user->grant_permission)){
        return $controller->redirect('/statisticAgency');
      }


        $metaTitleMantan = 'Danh sách khách hàng';

        $modelCustomers = $controller->loadModel('Customers');

        if(!empty($_GET['id'])){
           $data = $modelCustomers->find()->where(['id'=>(int) $_GET['id']])->first();
        }
        if(!empty($data)){
        	$data->blue_check = $_GET['blue_check'];

        	$modelCustomers->save($data);
        	if($_GET['blue_check']=='active'){
        		$dataSendNotification= array('title'=>'Lên tích xanh thành công',
                            'time'=>date('H:i d/m/Y'),
                            'content'=>"chúc mừng bạn đã lên tích xanh",
                            'action'=>'sendGreenCheckRequest');

	            if(!empty($data->token_device)){
	                sendNotification($dataSendNotification, $data->token_device);
	                saveNotification($dataSendNotification, $data->id,0);
	            }
        	}
        	  return $controller->redirect('/listCustomerGreenCheckRequest');
        	
        }
      

    }else{
        return $controller->redirect('/login');
    }
}
?>