<?php
function listUtmAdmin($input){

		global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;

    $metaTitleMantan = 'Danh sách nguồn khách vào ';

	$modelUtm = $controller->loadModel('Utms');

	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
	$order = array('id'=>'desc');

	if(!empty($_GET['id'])){
		$conditions['id'] = (int) $_GET['id'];
	}
	
	if(!empty($_GET['utm_source'])){
		$conditions['utm_source LIKE'] = '%'.$_GET['utm_source'].'%';
	}

	if(!empty($_GET['utm_medium'])){
		$conditions['utm_medium LIKE'] = '%'.$_GET['utm_medium'].'%';
	}

	if(!empty($_GET['utm_campaign'])){
		$conditions['utm_campaign LIKE'] = '%'.$_GET['utm_campaign'].'%';
	}


	if(!empty($_GET['date_start'])){
		$date_start = explode('/', $_GET['date_start']);
		$date_start = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
		$conditions['created_at >='] = date('Y-m-d H:i:s', $date_start);
	}

	if(!empty($_GET['date_end'])){
		$date_end = explode('/', $_GET['date_end']);
		$date_end = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
		$conditions['created_at <='] = date('Y-m-d H:i:s', $date_end);
	}


	

    $listData = $modelUtm->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();


    $totalData = $modelUtm->find()->where($conditions)->all()->toList();
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
    if(@$_GET['status']==1){
        $mess= '<p class="text-success" style="padding-left: 1.5em;">Thêm mới dữ liệu thành công</p>';

    }elseif(@$_GET['status']==2){
       $mess= '<p class="text-success" style="padding-left: 1.5em;">Sửa dữ liệu thành công</p>';

    }elseif(@$_GET['status']==3){
        $mess= '<p class="text-success" style="padding-left: 1.5em;">Xóa dữ liệu thành công</p>';
    }


    setVariable('mess', $mess);
    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    setVariable('totalData', $totalData);
    
    setVariable('listData', $listData);
}

function chartUtmAdmin($input){
		global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;

    $metaTitleMantan = 'Danh sách nguồn khách vào ';

	$modelUtm = $controller->loadModel('Utms');

	$conditions = array();

	if(!empty($_GET['date_start'])){
		$date_start = explode('/', $_GET['date_start']);
		$date_start = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
		$conditions['created_at >='] = date('Y-m-d H:i:s', $date_start);
	}else{
        $conditions['created_at LIKE'] = "%".date('Y-m')."%";
    }

	if(!empty($_GET['date_end'])){
		$date_end = explode('/', $_GET['date_end']);
		$date_end = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
		$conditions['created_at <='] = date('Y-m-d H:i:s', $date_end);
	}else{
        $conditions['created_at LIKE'] = "%".date('Y-m')."%";
    }

    $conditions['utm_source']= 'FacebookAds';

	 $FacebookAds = $modelUtm->find()->where($conditions)->all()->toList();
    $facebookAds = count($FacebookAds);

     $conditions['utm_source']= 'Facebook';

	 $Facebook = $modelUtm->find()->where($conditions)->all()->toList();
    $Facebook = count($Facebook);

     $conditions['utm_source']= 'zalo';

	 $zalo = $modelUtm->find()->where($conditions)->all()->toList();
    $zalo = count($zalo);

    setVariable('facebookAds', $facebookAds);
    setVariable('Facebook', $Facebook);
    setVariable('zalo', $zalo);

}
?>