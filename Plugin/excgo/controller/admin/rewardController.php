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
        $data->created_at = date('Y-m-d H:i:s');

    }else{
        $data = $modelReward->newEmptyEntity();
    }
	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['name'])){
	        // tạo dữ liệu save
            $data->name = @$dataSend['name'];
            if(!empty($dataSend['start_day'])){
                $data->start_day = DateTime::createFromFormat('d/m/Y', @$dataSend['start_day'])->format('Y-m-d 00:00:00');
            }

              if(!empty($dataSend['end_date'])){
                $data->end_date = DateTime::createFromFormat('d/m/Y', @$dataSend['end_date'])->format('Y-m-d 23:59:59');
            }
            $data->updated_at = date('Y-m-d H:i:s');
            $data->quantity_booking = (int) @$dataSend['quantity_booking'];
            $data->money = (int) @$dataSend['money'];
            $data->status = @$dataSend['status'];
            $data->note = @$dataSend['note'];
	        $modelReward->save($data);

	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
            
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập tên </p>';
	    }
	      $data = $modelReward->get( (int) $_GET['id']);
    }




    setVariable('data', $data);
    setVariable('mess', $mess);
}


?>
