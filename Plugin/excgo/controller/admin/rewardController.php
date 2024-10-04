<?php 
function listRewardAdmin($input){
	global $controller;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách phần thưởng';
    $modelReward = $controller->loadModel('Rewards');

    $conditions = array();
    $limit = (!empty($_GET['limit'])) ? (int)$_GET['limit'] : 20;
    $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;

    if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
        $conditions['id'] = $_GET['id'];
    }

    if (!empty($_GET['name'])) {
        $conditions['name LIKE'] = '%' . $_GET['name'] . '%';
    }

    if (!empty($_GET['phone_number'])) {
        $conditions['phone_number LIKE'] = '%' . $_GET['phone_number'] . '%';
    }

    if (!empty($_GET['email'])) {
        $conditions['email LIKE'] = '%' . $_GET['email'] . '%';
    }

    if (isset($_GET['type']) && $_GET['type'] !== '' && is_numeric($_GET['type'])) {
        $conditions['type'] = $_GET['type'];
    }

    if (isset($_GET['status']) && $_GET['status'] !== '' && is_numeric($_GET['status'])) {
        $conditions['status'] = $_GET['status'];
    }

    $listData = $modelReward->find()
        ->limit($limit)
        ->page($page)
        ->where($conditions)
        ->order(['id' => 'desc'])
        ->all()
        ->toList();
    $totalReward = $modelReward->find()
        ->where($conditions)
        ->all()
        ->toList();
    $paginationMeta = createPaginationMetaData(
        count($totalReward),
        $limit,
        $page
    );

    setVariable('page', $page);
    setVariable('totalPage', $paginationMeta['totalPage']);
    setVariable('back', $paginationMeta['back']);
    setVariable('next', $paginationMeta['next']);
    setVariable('urlPage', $paginationMeta['urlPage']);
    setVariable('listData', $listData);

}

function addRewardAdmin($input){
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    global $session;
   

    $metaTitleMantan = 'Thông tin phần thưởng';
    $modelReward = $controller->loadModel('Rewards');
    $conditions = array();

	$mess= '';

	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelReward->get( (int) $_GET['id']);

    }else{
        $data = $modelReward->newEmptyEntity();
        $data->created_at = time();
    }

    // Tạo subquery để tìm giá trị point_min cao nhất
        $subquery = $modelReward->find();
        $subquery->select(['max_end_date' => $subquery->func()->max('end_date')]);
	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['name'])){
	        // tạo dữ liệu save
            $data->name = @$dataSend['name'];
             if(!empty($dataSend['start_date'])){
                $date_start = explode('/', $dataSend['start_date']);
                $start_date = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
            }

            if(!empty($dataSend['end_date'])){
                $date_end = explode('/', $dataSend['end_date']);
                $end_date = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
                    
            }
            if(!empty($_GET['id'])){
                $conditions =array('end_date' => $subquery, 'id !='=>$data->id);
            }else{
                 $conditions =array('end_date' => $subquery);
            }
            $query = $modelReward->find()->where($conditions)->first();
            $time= 0;
            if(!empty($query->end_date)){
                $time = $query->end_date;
            }


            if($start_date > $time){
                if($start_date < $end_date){
                    $data->updated_at = time();
                    $data->quantity_booking = (int) @$dataSend['quantity_booking'];
                    $data->money = (int) @$dataSend['money'];
                    $data->type = (int) @$dataSend['type'];
                    $data->status =(int) @$dataSend['status'];
                    $data->note = @$dataSend['note'];
                    $data->image = @$dataSend['image'];
                    $data->content = @$dataSend['content'];
                    $data->end_date = @$end_date;
                    $data->start_date = @$start_date;

                    $bonu = [];
                    if(!empty($dataSend['soluong_cuoc'])){
                        foreach($dataSend['soluong_cuoc'] as $key => $item){
                         $bonu[]=['soluong_cuoc' =>(int)$item,
                           'tien_thuong' =>(int)@$dataSend['tien_thuong'][$key],
                            ];
                        }
                    }

                    $data->bonu = json_encode(@$bonu);   
                   
        	        $modelReward->save($data);

        	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
                }else{
                     $mess= '<p class="text-success">Thời gian bắt đầu nhỏ hơi thời gian kết thúc </p>';
                }
            }else{
                $mess= '<p class="text-success">Thời gian bắt đầu nhỏ hơi thời gian kết thúc </p>';
            }
            
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập tên </p>';
	    }
	      $data = $modelReward->get($data->id);
    }

    if(!empty($data->bonu)){
            $data->bonu = json_decode($data->bonu, true);
        }   




    setVariable('data', $data);
    setVariable('mess', $mess);
}

function deleteRewardAdmin($input){
    global $controller;

    // $modelHistoricalsite = $controller->loadModel('Historicalsites');
    $modelReward = $controller->loadModel('Rewards');
    if(!empty($_GET['id'])){
        $data = $modelReward->get($_GET['id']);
        
        if($data){
            $modelReward->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/excgo-view-admin-reward-listRewardAdmin.php');
}
?>
