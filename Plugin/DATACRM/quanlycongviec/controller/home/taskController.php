<?php 
function listTask($input){

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
		$modelTask = $controller->loadModel('Tasks');


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


        $listData = $modelTask->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        

        if(!empty($listData)){
            foreach($listData as $key => $item){
                if(!empty($item->id)){
                    $listData[$key]->number_staff = $modelStaff->find()->where(['id'=>$item->id_staff])->first();
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

        // $data = getListFileDrive('1YqqwVCYr2w14FD7AtIcRS8BV-WMkkRTU');
        // debug($data);
        // die;

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

function addTask($input){
	global $controller;
    global $isRequestPost;
    
    $metaTitleMantan = 'Thông tinh dự án';
	$modelMembers = $controller->loadModel('Members');
	$modelProjects = $controller->loadModel('Projects');
	$modelStaffProject = $controller->loadModel('StaffProjects');
	$modelStaff = $controller->loadModel('Staffs');
    $modelGroupStaff = $controller->loadModel('GroupStaffs');
    $modelTask = $controller->loadModel('Tasks');
    $mess =  '';
    if(function_exists('checklogin')){
    	$user = checklogin('addTask');   
    }
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/listTask');
        }
        if(!empty($user->id_father)){
          return $controller->redirect('/');
        }

        // lấy data edit
        if(!empty($_GET['id'])){
            $data = $modelTask->get( (int) $_GET['id']);
        }else{
            $data = $modelTask->newEmptyEntity();
            $data->created_at = time();
			$data->id_member = $user->id;
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
				$data->level = (int)@$dataSend['level'];			
				$data->id_project = (int)@$dataSend['id_project'];			
	           	
				$modelTask->save($data);

	            return $controller->redirect('/listTask?mess=saveSuccess');
	        }else{
	        	 $mess= '<p class="text-danger">bạn thiếu dữ liệu</p>';
	        }

        }
        if($user->type=='staff'){
        	$conditions=  array('staff.id_staff'=>$user->id);
        
       	 	$join = [
                [
                    'table' => 'staff_projects',
                    'alias' => 'staff',
                    'type' => 'LEFT',
                    'conditions' => [
                        'Projects.id = staff.id_project'
                    ],
                ]
            ];

            $select = ['Courses.id','Courses.title','Courses.image','Courses.description','Courses.slug','Courses.view','Courses.youtube_code','Courses.id_category','Courses.status','Courses.content','Courses.id_group_customer','Courses.public'];

        

        	$listProject = $modelProjects->find()->join($join)->where($conditions)->all()->toList();
        }else{
        	$listProject = $modelProjects->find()->where(array())->all()->toList();
        }

        $liststaff = array();
        if(!empty($data->id_project)){
        	$conditions = ['staffproject.id_project'=>$data->id_project];

	    $join = [
	                [
	                    'table' => 'staff_projects',
	                    'alias' => 'staffproject',
	                    'type' => 'LEFT',
	                    'conditions' => [
	                        'Staffs.id = staffproject.id_staff'
	                    ],
	                ]
	            ];
	    $liststaff = $modelStaff->find()->join($join)->where($conditions)->all()->toList();
        }
       
    	setVariable('data', $data);	
    	setVariable('mess', $mess);
    	setVariable('listProject', $listProject);
    	setVariable('liststaff', $liststaff);
        
    }else{
        return $controller->redirect('/login');
    }
}


function deteleTask($input){
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

function getStaffProjectAPI($input){
	global $controller;
    global $isRequestPost;


	$modelStaffProject = $controller->loadModel('StaffProjects');
	$modelStaff = $controller->loadModel('Staffs');
	if($isRequestPost){
		$dataSend = $input['request']->getData();

		$conditions = [];

		if(!empty($dataSend['id_project'])){
	        $conditions['staffproject.id_project'] = $dataSend['id_project'];
	    }

	    $join = [
	                [
	                    'table' => 'staff_projects',
	                    'alias' => 'staffproject',
	                    'type' => 'LEFT',
	                    'conditions' => [
	                        'Staffs.id = staffproject.id_staff'
	                    ],
	                ]
	            ];
	    $listData = $modelStaff->find()->join($join)->where($conditions)->all()->toList();

	    return array('code'=>1, 'data'=>$listData);
	}
}
?>
