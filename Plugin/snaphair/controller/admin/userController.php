<?php 
function listUserAdmin($input){
	global $controller;
	global $urlCurrent;
	global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách khách hàng';

	$modelUsers = $controller->loadModel('Users');

	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
    $order = array('id'=>'desc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }

    if(!empty($_GET['full_name'])){
        $conditions['full_name LIKE'] = '%'.$_GET['full_name'].'%';
    }

    if(!empty($_GET['phone'])){
        $conditions['phone'] = $_GET['phone'];
    }

    if(!empty($_GET['email'])){
        $conditions['email'] = $_GET['email'];
    }
    
    $listData = $modelUsers->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    // phân trang
    $totalData = $modelUsers->find()->where($conditions)->all()->toList();
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
    $mess = '';
    if(@$_GET['mess']=='saveSuccess'){
            $mess= '<p class="text-success" style="padding: 0px 1.5em;">Lưu dữ liệu thành công</p>';
        }elseif(@$_GET['mess']=='lock'){
            $mess= '<p class="text-success" style="padding: 0px 1.5em;">khóa tài khoản thành công</p>';
        }elseif(@$_GET['mess']=='active'){
            $mess= '<p class="text-success" style="padding: 0px 1.5em;">khích hoạt thành công</p>';
        }


    setVariable('page', $page);
    setVariable('mess', $mess);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);    
    setVariable('listData', $listData);

}

function updateStatusUserAdmin($input)
{
    global $controller;

    $modelUser = $controller->loadModel('Users');

    if (!empty($_GET['id'])) {
        $data = $modelUser->find()->where([
            'id' => $_GET['id']
        ])->first();

        if ($data && isset($_GET['status'])) {
            $data->status = $_GET['status'];
            $modelUser->save($data);
        }
    }

    return $controller->redirect('/plugins/admin/snaphair-view-admin-user-listUserAdmin?mess='.$_GET['status']);
}

function editUserAdmin($input)
{
    global $controller;
    global $metaTitleMantan;
    global $isRequestPost;

    $modelUser = $controller->loadModel('Users');
    $metaTitleMantan = 'Thông tin người dùng';
    $mess = '';

    if (!empty($_GET['id'])) {
        $data = $modelUser->find()
            ->where([
                'id' => (int)$_GET['id']
            ])->first();
    } else {
        $data = $modelUser->newEmptyEntity();
    }

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['full_name'])){
            $data->full_name = $dataSend['full_name'];
            $data->avatar = $dataSend['avatar'];
            $data->email = $dataSend['email'] ?? null;
            $data->address = $dataSend['address'] ?? null;
            if (!empty($dataSend['birthday'])) {
                $date = explode("/", $dataSend['birthday']);
                $data->birthday =  mktime(0, 0, 0, $date[1], $date[0], $date[2]);
            }   
            $modelUser->save($data);
             return $controller->redirect('/plugins/admin/snaphair-view-admin-user-listUserAdmin?mess=saveSuccess');
            $mess = '<p class="text-success">Lưu dữ liệu thành công</p>';
        } else {
            $mess = '<p class="text-danger">Bạn chưa nhập đúng thông tin</p>';
        }
    }
   
    setVariable('data', $data);
    setVariable('mess', $mess);
}


 ?>