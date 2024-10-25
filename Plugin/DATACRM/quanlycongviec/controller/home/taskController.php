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

        if(@$user->type=='member'){
            $conditions = array();

             $listProject = $modelProjects->find()->where($conditions)->all()->toList();
        }else{
            $conditions = array('id_staff'=>$user->id);
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

        }

        $id_project = array();
        if(!empty($listProject)){
            foreach($listProject as $key => $item){
                if(!empty($item->id)){
                    $id_project[] = $item->id;
                }
            }
        }

        $conditions = array();

        if(!empty($_GET['id_project'])){
            $conditions['id_project'] =  $_GET['id_project'];
        }else{
            $conditions['id_project IN'] =  $id_project;
        }

        if(!empty($_GET['id_staff'])){
            $conditions['id_staff'] =  $_GET['id_staff'];
        }

        $order = array('id'=>'desc');
        $conditions['status'] =  'new';
        $listTasknew = $modelTask->find()->where($conditions)->order($order)->all()->toList();

        $conditions['status'] =  'process';
        $listTaskprocess = $modelTask->find()->where($conditions)->order($order)->all()->toList();

        $conditions['status'] =  'done';
        $listTaskdone = $modelTask->find()->where($conditions)->order($order)->all()->toList();

        $conditions['status'] =  'bug';
        $listTaskbug = $modelTask->find()->where($conditions)->order($order)->all()->toList();

        $conditions['status'] =  'cancel';
        $listTaskcancel = $modelTask->find()->where($conditions)->order($order)->all()->toList();


        if(!empty($listTasknew)){
            foreach($listTasknew as $key => $item){
                $listTasknew[$key]->project = $modelProjects->find()->where(['id'=>$item->id_project])->first();
                $listTasknew[$key]->staff = $modelStaff->find()->where(['id'=>$item->id_staff])->first();
            }
        }

        if(!empty($listTaskdone)){
            foreach($listTaskdone as $key => $item){
                $listTaskdone[$key]->project = $modelProjects->find()->where(['id'=>$item->id_project])->first();
                $listTaskdone[$key]->staff = $modelStaff->find()->where(['id'=>$item->id_staff])->first();
            }
        }

        if(!empty($listTaskprocess)){
            foreach($listTaskprocess as $key => $item){
                $listTaskprocess[$key]->project = $modelProjects->find()->where(['id'=>$item->id_project])->first();
                $listTaskprocess[$key]->staff = $modelStaff->find()->where(['id'=>$item->id_staff])->first();
            }
        }

        if(!empty($listTaskbug)){
            foreach($listTaskbug as $key => $item){
                $listTaskbug[$key]->project = $modelProjects->find()->where(['id'=>$item->id_project])->first();
                $listTaskbug[$key]->staff = $modelStaff->find()->where(['id'=>$item->id_staff])->first();
            }
        }

        if(!empty($listTaskcancel)){
            foreach($listTaskcancel as $key => $item){
                $listTaskcancel[$key]->project = $modelProjects->find()->where(['id'=>$item->id_project])->first();
                $listTaskcancel[$key]->staff = $modelStaff->find()->where(['id'=>$item->id_staff])->first();
            }
        }

        $mess ='';
        if(@$_GET['mess']=='saveSuccess'){
            $mess= '<p class="text-success" style="padding: 0px 1.5em;">Lưu dữ liệu thành công</p>';
        }elseif(@$_GET['mess']=='deleteSuccess'){
            $mess= '<p class="text-success" style="padding: 0px 1.5em;">Xóa dữ liệu thành công</p>';
        }elseif(@$_GET['mess']=='deleteError'){
            $mess= '<p class="text-danger" style="padding: 0px 1.5em;">Xóa dữ liệu không thành công</p>';
        }


        setVariable('mess', $mess);        
        setVariable('user', $user);        
        setVariable('listTasknew', $listTasknew);
        setVariable('listTaskdone', $listTaskdone);
        setVariable('listTaskprocess', $listTaskprocess);
        setVariable('listTaskbug', $listTaskbug);
        setVariable('listTaskcancel', $listTaskcancel);
        setVariable('listProject', $listProject);


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
	$user = checklogin('deteleTask');
    $modelTask = $controller->loadModel('Tasks');
	if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/listTask');
        }

        if(!empty($user->id_father)){
            return $controller->redirect('/');
        }
	

		if(!empty($_GET['id'])){
			$data = $modelTask->get($_GET['id']);
			if($data){
				$note = $user->type_tv.' '. $user->name.' xóa thông tin nhiệm vụ '.$data->title.' có id là:'.$data->id;
                

            addActivityHistory($user,$note,'deletePost',$data->id);
				$modelTask->delete($data);

				deleteSlugURL($data->slug);
				 return $controller->redirect('/listTask?mess=deleteSuccess');
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
        }else{
            $listData = array();
        }

	    return array('code'=>1, 'data'=>$listData);
	}
}

function getTasksAPI($input){
    global $controller;
    global $isRequestPost;


    $modelStaffProject = $controller->loadModel('StaffProjects');
    $modelStaff = $controller->loadModel('Staffs');
    $modelTask = $controller->loadModel('Tasks');
    $modelProjects = $controller->loadModel('Projects');
    if($isRequestPost){
        $dataSend = $input['request']->getData();

        $conditions = [];

        if(!empty($dataSend['id'])){
            $data = $modelTask->find()->where(['id'=>(int) $dataSend['id']])->first();
            if(!empty($data)){
                $data->infoProject = $modelProjects->find()->where(['id'=>$data->id_project])->first();
                $data->infoStaff = $modelStaff->find()->where(['id'=>$data->id_staff])->first();
            }

        }else{
            $data = array();
        }

        return array('code'=>1, 'data'=>$data);
    }
}

function editTask($input){
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
        
            if(!empty($_GET['id'])){

                if(!empty($_GET['name'])){
                    $data->name = $_GET['name'];
                }

                if(!empty($_GET['content'])){
                    $data->content = $_GET['content'];
                }


                if(!empty($_GET['status'])){
                    $data->status = $_GET['status'];
                }

                if(!empty($_GET['level'])){
                    $data->level = $_GET['level'];
                }

                if(!empty($_GET['start_date'])){
                    $start_date = explode('/', $_GET['start_date']);
                    $data->start_date = mktime(0,0,0,$start_date[1],$start_date[0],$start_date[2]);
                }

                if(!empty($_GET['end_date'])){
                    $end_date = explode('/', $_GET['end_date']);
                    $data->end_date = mktime(23,59,59,$end_date[1],$end_date[0],$end_date[2]);
                }
        
                $modelTask->save($data);
            }

                return $controller->redirect('/listTask?mess=saveSuccess');
        }
        return $controller->redirect('/listTask?mess=saveSuccess');

        
        
    }else{
        return $controller->redirect('/login');
    }
}
?>
