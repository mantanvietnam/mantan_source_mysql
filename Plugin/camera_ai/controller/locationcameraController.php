<?php 
function listAdminLocationcamera($input){
    
    global $controller;
	global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;

    $metaTitleMantan = 'Danh sách camera';

    $modelcameralocation = $controller->loadModel('cameralocation');
    $modelprecinct = $controller->loadModel('precinct');
    $listData = $listData = $modelprecinct->find()->all()->toList();
    $conditions = array('type' => 'category_groupcamera');
    $listgroupcamera = $modelCategories->find()->where($conditions)->all()->toList();
    $conditions = array('type' => 'Category_deportment');
    $listdeportment = $modelCategories->find()->where($conditions)->all()->toList();
	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
    $order = array('id'=>'asc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }
    if(!empty($_GET['name'])){
        $conditions['name LIKE'] = '%'.$_GET['name'].'%';
    }
    
    $listData = $modelcameralocation->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
 
    // phân trang
    $totalData = $modelcameralocation->find()->where($conditions)->all()->toList();
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
    if (!empty($_GET['action']) && $_GET['action'] == 'Excel') {

        $listData = $modelcameralocation->find()->where($conditions)->order($order)->all()->toList();
    
    
        $titleExcel = [
            ['name' => 'Thời gian', 'type' => 'text', 'width' => 25],
            ['name' => 'Tên', 'type' => 'text', 'width' => 25],
            ['name' => 'Hình ảnh', 'type' => 'text', 'width' => 25],
            ['name' => 'Số điện thoại', 'type' => 'text', 'width' => 25],
            ['name' => 'Địa chỉ', 'type' => 'text', 'width' => 25],
            ['name' => 'Vị trí', 'type' => 'text', 'width' => 25],
            ['name' => 'Khu vực', 'type' => 'text', 'width' => 25],
            ['name' => 'Loại camera', 'type' => 'text', 'width' => 25],
            ['name' => 'Phòng ban', 'type' => 'text', 'width' => 25],
            ['name' => 'Mô tả', 'type' => 'text', 'width' => 50],
            ['name' => 'Ghi chú', 'type' => 'text', 'width' => 25],
            ['name' => 'ID', 'type' => 'text', 'width' => 15],
            ['name' => 'Tình trạng', 'type' => 'text', 'width' => 15],
        ];
    
        $dataExcel = [];
    
        if (!empty($listData)) {
            foreach ($listData as $value) {

                $status = '';
                switch ($value->status) {
                    case 'active':
                        $status = 'Hoạt động';
                        break;
                    case 'inactive':
                        $status = 'Không hoạt động';
                        break;
                    default:
                        $status = 'Chưa xác định';
                        break;
                }
    
                $dataExcel[] = [
                    date('H:i d/m/Y', $value->create_at),
                    $value->name, 
                    $value->image, 
                    $value->phone, 
                    $value->address, 
                    $value->location, 
                    $value->precinct, 
                    $value->cameratype, 
                    $value->deportment, 
                    $value->description, 
                    $value->note_user, 
                    $value->id, 
                    $status, 
                ];
            }
        }
    
        export_excel($titleExcel, $dataExcel, 'danh_sach_camera');
    } else {
        $listData = $modelcameralocation->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
    }
    
    setVariable('listData', $listData);
    setVariable('listgroupcamera', $listgroupcamera);
    setVariable('listdeportment', $listdeportment);
    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    setVariable('totalData', $totalData);
    setVariable('listData', $listData);
    
}
function addLocationCamera($input){
    global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    $metaTitleMantan = 'Thêm camera';
    $mess ="";
    $modelcameralocation = $controller->loadModel('cameralocation');
    $modelprecinct = $controller->loadModel('precinct');
    $listData =  $modelprecinct->find()->all()->toList();
    $conditions = array('type' => 'category_groupcamera');
    $listgroupcamera = $modelCategories->find()->where($conditions)->all()->toList();
    $conditions = array('type' => 'Category_deportment');
    $listdeportment = $modelCategories->find()->where($conditions)->all()->toList();
    if(!empty($_GET['id'])){
        $data = $modelcameralocation->get( (int) $_GET['id']);
    }else{
        $data = $modelcameralocation->newEmptyEntity();
    }

	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['name'])){
            $data->name = $dataSend['name'];
            $data->image = $dataSend['image'];
            $data->phone = $dataSend['phone'];
            $data->address = $dataSend['address'];
            $data->location = $dataSend['location'];
            $data->precinct = $dataSend['precinct'];
            $data->cameratype = $dataSend['cameratype'];
            $data->deportment = $dataSend['deportment'];
            $data->description = $dataSend['description'];
            $modelcameralocation->save($data);   
	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập đầy đủ thông tin/p>';
	    }
    }

    setVariable('listData', $listData);
    setVariable('listgroupcamera', $listgroupcamera);
    setVariable('listdeportment', $listdeportment);
    setVariable('data', $data);
    setVariable('mess', $mess);
 
}
function deletelocationcamera($input){
    global $controller;

    $modelcameralocation = $controller->loadModel('cameralocation');
    
    if(!empty($_GET['id'])){
        $data = $modelcameralocation->get($_GET['id']);
        
        if($data){
            $modelcameralocation->delete($data);
        }
    }

    return $controller->redirect('/plugins/admin/camera_ai-view-admin-locationcamera-listAdminLocationcamera');
}
?>