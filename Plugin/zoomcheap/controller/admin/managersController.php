<?php 
function addManagerExcel($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Nhập dữ liệu khách hàng';

    $modelManagers = $controller->loadModel('Managers');

    $mess = '';
    if($isRequestPost){
        $managerExcel = uploadAndReadExcelData('managerExcel');

        if($managerExcel){
            unset($managerExcel[0]);

            foreach ($managerExcel as $row) {
                $row[1] = str_replace(array(' ','.','-'), '', $row[1]);
                $row[1] = str_replace('+84','0',$row[1]);

                $checkPhone = $modelManagers->find()->where(array('phone'=>$row[1]))->first();

                if(empty($checkPhone)){
                    // tạo người dùng mới
                    $data = $modelManagers->newEmptyEntity();

                    $data->fullname = $row[0];
                    $data->phone = $row[1];
                    $data->email = $row[2];
                    $data->password = $row[3];
                    $data->coin = (int) $row[4];
                    $data->modified = $row[5];
                    $data->created = $row[5];
                    $data->lastLogin = $row[6];
                    $data->avatar = 'https://apis.ezpics.vn/plugins/ezpics_api/view/image/default-avatar.png';

                    $modelManagers->save($data);
                }

            }

            $mess = 'Lưu dữ liệu thành công';
        }
    }

    setVariable('mess', $mess);
}

function listManagerAdmin($input)
{
	global $controller;
	global $urlCurrent;
	global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách khách hàng';

	$modelManagers = $controller->loadModel('Managers');

	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
    $order = array('id'=>'desc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }

    if(!empty($_GET['fullname'])){
        $conditions['fullname LIKE'] = '%'.$_GET['fullname'].'%';
    }

    if(!empty($_GET['phone'])){
        $conditions['phone'] = $_GET['phone'];
    }

    if(!empty($_GET['email'])){
        $conditions['email'] = $_GET['email'];
    }
    
    $listData = $modelManagers->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    // phân trang
    $totalData = $modelManagers->find()->where($conditions)->all()->toList();
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
    setVariable('listData', $listData);

}

?>