<?php 
function listProject($input){

	global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $user = checklogin('listProject');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/statisticAgency');
        }
        $metaTitleMantan = 'Danh sách dự án';
		$modelMembers = $controller->loadModel('Members');
		$modelProjects = $controller->loadModel('Projects');
		$modelStaffProject = $controller->loadModel('StaffProjects');
		 $modelStaff = $controller->loadModel('Staffs');


    	$conditions = array('id_member'=>$user->id);
        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        $order = array('id'=>'desc');

        if(!empty($_GET['id'])){
            $conditions['id'] = (int) $_GET['id'];
        }

        if(!empty($_GET['date_start'])){
            $date_start = explode('/', $_GET['date_start']);
            $conditions['created_at >='] = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
        }

        if(!empty($_GET['date_end'])){
            $date_end = explode('/', $_GET['date_end']);
            $conditions['created_at <='] = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
                
        }


        $listData = $modelProjects->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        

        if(!empty($listData)){
            foreach($listData as $key => $item){
                if(!empty($item->id)){
                    $listData[$key]->number_staff = count( json_decode($item->list_staff, true));
                    $listData[$key]->leader = $modelStaff->find()->where(['id'=>$item->id_staff])->first();
                }
            }
        }
        // phân trang
        $totalData = $modelProjects->find()->where($conditions)->all()->toList();

        $totalMoney = 0;
        if(!empty($totalData)){
            foreach ($totalData as $key => $value) {
                $totalMoney += $value->total;
            }
        }

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

        $mess ='';
        if(@$_GET['mess']=='saveSuccess'){
            $mess= '<p class="text-success" style="padding: 0px 1.5em;">Lưu dữ liệu thành công</p>';
        }elseif(@$_GET['mess']=='deleteSuccess'){
            $mess= '<p class="text-success" style="padding: 0px 1.5em;">Xóa dữ liệu thành công</p>';
        }elseif(@$_GET['mess']=='deleteError'){
            $mess= '<p class="text-danger" style="padding: 0px 1.5em;">Xóa dữ liệu không thành công</p>';
        }

        $data = getListFileDrive('1YqqwVCYr2w14FD7AtIcRS8BV-WMkkRTU');
        debug($data);
        die;

        setVariable('page', $page);
        setVariable('totalPage', $totalPage);
        setVariable('back', $back);
        setVariable('next', $next);
        setVariable('mess', $mess);        
        setVariable('totalMoney', $totalMoney);
        setVariable('urlPage', $urlPage);
        
        setVariable('listData', $listData);


    }else{
        return $controller->redirect('/login');
    }

}

function addProject($input){
	global $controller;
    global $isRequestPost;
    
    $metaTitleMantan = 'Thông tinh dự án';
	$modelMembers = $controller->loadModel('Members');
		$modelProjects = $controller->loadModel('Projects');
		$modelStaffProject = $controller->loadModel('StaffProjects');
		 $modelStaff = $controller->loadModel('Staffs');
        $modelGroupStaff = $controller->loadModel('GroupStaffs');
    $mess =  '';
    if(function_exists('checklogin')){
    	$user = checklogin('addProject');   
    }
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/listProject');
        }
        if(!empty($user->id_father)){
          return $controller->redirect('/');
        }

        // lấy data edit
        if(!empty($_GET['id'])){
            $data = $modelProjects->get( (int) $_GET['id']);
        }else{
            $data = $modelProjects->newEmptyEntity();
            $data->created_at = time();
			$data->id_member = $user->id;
			$data->id_staff = $user->id_staff;
        }

        if($isRequestPost) {
			$dataSend = $input['request']->getData();

			if(!empty($dataSend['name']) && !empty($dataSend['start_date']) && !empty($dataSend['end_date']) && !empty($dataSend['id_staff'])){
				$data->name = $dataSend['name'];
				$start_date = explode('/', $dataSend['start_date']);
	            $data->start_date = mktime(0,0,0,$start_date[1],$start_date[0],$start_date[2]);
	            $data->id_staff = (int)$dataSend['id_staff'];
	             $end_date = explode('/', $dataSend['end_date']);
	            $data->end_date = mktime(23,59,59,$end_date[1],$end_date[0],$end_date[2]);

				$data->content = @$dataSend['content'];
				$data->status = @$dataSend['status'];          
				$data->state = @$dataSend['state'];          
				$data->list_staff = json_encode(@$dataSend['list_staff']);      
			
	           	
				$modelProjects->save($data);

	            return $controller->redirect('/listProject?mess=saveSuccess');
	        }else{
	        	 $mess= '<p class="text-danger">bạn thiếu dữ liệu</p>';
	        }

        }
        if(!empty($data->list_staff)){
            $data->list_staff = json_decode($data->list_staff, true);
        }
        $dataGroupStaff = $modelGroupStaff->find()->where(['id_member'=>$user->id])->all()->toList();
        $liststaff = $modelStaff->find()->where(['id_member'=>$user->id])->all()->toList();

        if(!empty($dataGroupStaff)){
        	foreach($dataGroupStaff as $key => $item){
        		 $dataGroupStaff[$key]->staff = $modelStaff->find()->where(['id_group'=>$item->id])->all()->toList();
        	}
        }

    	setVariable('data', $data);
    	setVariable('dataGroupStaff', $dataGroupStaff);
    	setVariable('mess', $mess);
    	setVariable('liststaff', $liststaff);
    }else{
        return $controller->redirect('/login');
    }
}


function deteleProject($input){
    global $urlCurrent;
	global $modelPosts;
	global $modelCategories;
	global $controller;
	$user = checklogin('deletePost');
	if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/listPost');
        }

        if(!empty($user->id_father)){
            return $controller->redirect('/');
        }
	

		if(!empty($_GET['id'])){
			$data = $modelPosts->get($_GET['id']);
			if($data){
				$note = $user->type_tv.' '. $user->name.' xóa thông tin nhóm tin tức '.$data->title.' có id là:'.$data->id;
                

            addActivityHistory($user,$note,'deletePost',$data->id);
				$modelPosts->delete($data);

				deleteSlugURL($data->slug);
				 return $controller->redirect('/listPost?mess=deleteSuccess');
            }
        }

    return $controller->redirect('/listPost?mess=deleteError');

	}else{
        return $controller->redirect('/login');
    }
}
?>