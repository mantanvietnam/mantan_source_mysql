<?php 
/*di tich lich sử */
function listHistoricalSitesAdmin($input)
{
	global $controller;
	global $urlCurrent;
	global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách điểm đến di tích và danh lam';

	$modelHistoricalsite = $controller->loadModel('Historicalsites');
    
	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
    $order = array('id'=>'desc');
    
    $listData = $modelHistoricalsite->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $conditions_scan = array('id'=>$value->id);
            $static = $modelHistoricalsite->find()->where($conditions_scan)->all()->toList();
            $listData[$key]->number_scan = count($static);
        }
    }

    // phân trang
    $totalData = $modelHistoricalsite->find()->where($conditions)->all()->toList();
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
    
    if(@$_GET['status']==1){
        $mess= '<p class="text-success" style="padding-left: 1.5em;">Thêm mới dữ liệu thành công</p>';

    }elseif(@$_GET['status']==2){
        $mess= '<p class="text-success" style="padding-left: 1.5em;">Sửa dữ liệu thành công</p>';

    }elseif(@$_GET['status']==3){

        $mess= '<p class="text-success" style="padding-left: 1.5em;">Xóa dữ liệu thành công</p>';
    }

    setVariable('mess', @$mess);
    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    
    setVariable('listData', $listData);
}


function addHistoricalSitesAdmin($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    global $session;
    
    $metaTitleMantan = 'Thông tin điểm đến di tích và danh lam';

	$modelHistoricalsite = $controller->loadModel('Historicalsites');
	$mess= '';

	// lấy data edit
    if(!empty($_GET['id'])){
        $data = $modelHistoricalsite->get( (int) $_GET['id']);

    }else{
        $data = $modelHistoricalsite->newEmptyEntity();
         $data->created = getdate()[0];
    }


	if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['name'])){
	        // tạo dữ liệu save
            $data->name = @$dataSend['name'];
            $data->address = @$dataSend['address'];
            $data->phone = @$dataSend['phone'];
            $data->email = @$dataSend['email'];
            $data->image = @$dataSend['image'];
            $data->introductory = @$dataSend['introductory'];
            $data->latitude = @$dataSend['latitude'];
            $data->longitude = @$dataSend['longitude'];
            $data->image360 = @$dataSend['image360'];
            $data->content = @$dataSend['content'];
            $data->urlSlug = createSlugMantan(trim($dataSend['name']));

            


	        $modelHistoricalsite->save($data);

	        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

             if(!empty($_GET['id'])){
                return $controller->redirect('/plugins/admin/ditichhienvat-admin-historicalSites-listHistoricalSitesAdmin.php?status=2');
            }else{
                return $controller->redirect('/plugins/admin/ditichhienvat-admin-historicalSites-listHistoricalSitesAdmin.php?status=1');
            }
            
	    }else{
	    	$mess= '<p class="text-danger">Bạn chưa nhập tên mã QR</p>';
	    }
    }



    setVariable('data', $data);
    setVariable('mess', $mess);
}

function deleteHistoricalSitesAdmin($input){
	global $controller;

	$modelHistoricalsite = $controller->loadModel('Historicalsites');
	if(!empty($_GET['id'])){
		$data = $modelHistoricalsite->get($_GET['id']);
		
		if($data){
         	$modelHistoricalsite->delete($data);
        }
	}

	return $controller->redirect('/plugins/admin/ditichhienvat-admin-historicalSites-listHistoricalSitesAdmin.php?status=3');
}


 ?>