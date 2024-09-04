<?php 
function listAppointmentAgency($input){
	global $controller;
	global $session;
	global $metaTitleMantan;
	global $urlCurrent;

	if(!empty($session->read('infoUser'))){
        $metaTitleMantan = 'Danh sách lịch hẹn';

        $modelAppointment = $controller->loadModel('Appointments');
        $modelMembers = $controller->loadModel('Members');

        $conditions = array();
        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;

        $order = array('id'=>'desc');

        if(!empty($_GET['name'])){
            $conditions['name LIKE'] = '%'.$_GET['name'].'%';
        }

        if(!empty($_GET['id_customer'])){
            $conditions['id_customer'] = $_GET['id_customer'];
        }

        if(!empty($_GET['id_parent'])){
            $conditions['id_parent'] = $_GET['id_parent'];
        }

        if(isset($_GET['status'])){
        	if($_GET['status']!=''){
            	$conditions['status'] = $_GET['status'];
            }
        }

        if(!empty($_GET['date_start'])){
			$date_start = explode('/', $_GET['date_start']);
			$date_start = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
			$conditions['time >='] = date('Y-m-d H:i:s', $date_start);
		}

		if(!empty($_GET['date_end'])){
			$date_end = explode('/', $_GET['date_end']);
			$date_end = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
			$conditions['time <='] = date('Y-m-d H:i:s', $date_end);
		}
		$listData = $modelAppointment->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
		if(!empty($listData)){
            foreach ($listData as $key => $value) {
                if(!empty($value->id_parent)){
                    $listData[$key]->parent = $modelMembers->find()->where(['id'=>$value->id_parent])->first();
                } 
            }
        }
		$totalData = $modelAppointment->find()->where($conditions)->all()->toList();
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


function addAppointmentAgency($input){
	global $controller;
	global $session;
	global $metaTitleMantan;
	global $urlCurrent;
	global $isRequestPost;

	if(!empty($session->read('infoUser'))){
        $metaTitleMantan = 'Thông tin đặt lịch hẹn';

        $modelAppointment = $controller->loadModel('Appointments');

        $mess= '';

		// lấy data edit
	    if(!empty($_GET['id'])){
	        $save = $modelAppointment->get( (int) $_GET['id']);
	    }else{
	        $save = $modelAppointment->newEmptyEntity();
			$save->created_at = date('Y-m-d H:i:s');
			
	    }

		if ($isRequestPost) {
	        $dataSend = $input['request']->getData();
	      
	        $save->name = $dataSend['name'];
	        $save->id_customer = $dataSend['id_customer'];
	        $save->phone = $dataSend['phone'];
	        $save->email = $dataSend['email'];
	        $save->time = $dataSend['time'].':00';
	        $save->status = $dataSend['status'];
	        $save->note = $dataSend['note'];
	        $save->id_parent =$session->read('infoUser')->id;

	        $modelAppointment->save($save);

	        return $controller->redirect('/calendarAppointmentAgency?mess=saveSuccess');
	        $save = $modelAppointment->get( (int) $save->id);
	    }

	    
	    setVariable('data', $save);
	    setVariable('mess', $mess);

    }else{
    	return $controller->redirect('/login');
    }
}

function calendarAppointmentAgency(){
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
    global $session;

    $metaTitleMantan = 'Lịch hẹn';

    $modelAppointment = $controller->loadModel('Appointments');
    $modelMembers = $controller->loadModel('Members');

	
	if(!empty($session->read('infoUser'))){
		$infoUser = $session->read('infoUser');

		$conditions = array();
		
		if(!empty($_GET['name'])){
            $conditions['name LIKE'] = '%'.$_GET['name'].'%';
        }

        if(!empty($_GET['id_customer'])){
            $conditions['id_customer'] = $_GET['id_customer'];
        }

        if(!empty($_GET['id_parent'])){
            $conditions['id_parent'] = $_GET['id_parent'];
        }

        if(isset($_GET['status'])){
        	if($_GET['status']!=''){
            	$conditions['status'] = $_GET['status'];
            }
        }

        if(!empty($_GET['date_start'])){
			$date_start = explode('/', $_GET['date_start']);
			$date_start = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
			$conditions['time >='] = date('Y-m-d H:i:s', $date_start);
		}

		if(!empty($_GET['date_end'])){
			$date_end = explode('/', $_GET['date_end']);
			$date_end = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
			$conditions['time <='] = date('Y-m-d H:i:s', $date_end);
		}

	    $listData = $modelAppointment->find()->where($conditions)->all()->toList();
	    if(!empty($listData)){
            foreach ($listData as $key => $value) {
                if(!empty($value->id_parent)){
                    $listData[$key]->parent = $modelMembers->find()->where(['id'=>$value->id_parent])->first();
                } 
            }
        }

         if(@$_GET['mess']=='saveSuccess'){
            $mess= '<p class="text-success" style="padding: 0px 1.5em;">Lưu dữ liệu thành công</p>';
        }elseif(@$_GET['mess']=='deleteSuccess'){
            $mess= '<p class="text-success" style="padding: 0px 1.5em;">Xóa dữ liệu thành công</p>';
        }elseif(@$_GET['mess']=='deleteError'){
            $mess= '<p class="text-danger" style="padding: 0px 1.5em;">Xóa dữ liệu không thành công</p>';
        }
	    
	    setVariable('listData', $listData);
	    setVariable('mess', $mess);
	}else{
		return $controller->redirect('/');
	}
}


 ?>