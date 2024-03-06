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
		$conditions['utm_source'] =$_GET['utm_source'];
	}

	if(!empty($_GET['utm_medium'])){
		$conditions['utm_medium'] = $_GET['utm_medium'];
	}

	if(!empty($_GET['utm_campaign'])){
		$conditions['utm_campaign'] = $_GET['utm_campaign'];
	}

	if(!empty($_GET['utm_id'])){
		$conditions['utm_id'] = $_GET['utm_id'];
	}

	if(!empty($_GET['utm_term'])){
		$conditions['utm_term'] = $_GET['utm_term'];
	}

	if(!empty($_GET['utm_content'])){
		$conditions['utm_content'] = $_GET['utm_content'];
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
	}

	if(!empty($_GET['date_end'])){
		$date_end = explode('/', $_GET['date_end']);
		$date_end = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
		$conditions['created_at <='] = date('Y-m-d H:i:s', $date_end);
	}

   /* $conditions['utm_source']= 'FacebookAds';

	 $FacebookAds = $modelUtm->find()->where($conditions)->all()->toList();
    $facebookAds = count($FacebookAds);

     $conditions['utm_source']= 'Facebook';

	 $Facebook = $modelUtm->find()->where($conditions)->all()->toList();
    $Facebook = count($Facebook);

     $conditions['utm_source']= 'zalo';

	 $zalo = $modelUtm->find()->where($conditions)->all()->toList();
    $zalo = count($zalo);*/


    $facebookAds =  $modelUtm->find()->where($conditions)->group(['utm_source'])->all()->toList();
    $query = $modelUtm->find()->where($conditions);
    $utm_source = $query->select(['utm_source', 'count' => $query->func()->count('*')])->group(['utm_source'])->toArray();
    $utm_medium = $query->select(['utm_medium', 'count' => $query->func()->count('*')])->group(['utm_medium'])->toArray();
    $utm_campaign = $query->select(['utm_campaign', 'count' => $query->func()->count('*')])->group(['utm_campaign'])->toArray();
    $utm_id = $query->select(['utm_id', 'count' => $query->func()->count('*')])->group(['utm_id'])->toArray();
    $utm_term = $query->select(['utm_term', 'count' => $query->func()->count('*')])->group(['utm_term'])->toArray();
    $utm_content = $query->select(['utm_content', 'count' => $query->func()->count('*')])->group(['utm_content'])->toArray();




$groupedDatautm_id = [];

foreach ($utm_id as $entity) {
    $utmId = $entity->utm_id;
    if (array_key_exists($utmId, $groupedDatautm_id)) {
        $groupedDatautm_id[$utmId]['count'] += $entity->count;
    } else {
        $groupedDatautm_id[$utmId] = [
            'utm_id' => $utmId,
            'count' => $entity->count,
        ];
    }
}
$utm_id = array_values($groupedDatautm_id);

$groupedDatautm_source = [];

foreach ($utm_source as $entity) {
    $utmId = $entity->utm_source;
    if (array_key_exists($utmId, $groupedDatautm_source)) {
        $groupedDatautm_source[$utmId]['count'] += $entity->count;
    } else {
        $groupedDatautm_source[$utmId] = [
            'utm_source' => $utmId,
            'count' => $entity->count,
        ];
    }
}
$utm_source = array_values($groupedDatautm_source);

$groupedDatautm_medium = [];

foreach ($utm_medium as $entity) {
    $utmId = $entity->utm_medium;
    if (array_key_exists($utmId, $groupedDatautm_medium)) {
        $groupedDatautm_medium[$utmId]['count'] += $entity->count;
    } else {
        $groupedDatautm_medium[$utmId] = [
            'utm_medium' => $utmId,
            'count' => $entity->count,
        ];
    }
}
$utm_medium = array_values($groupedDatautm_medium);

$groupedDatautm_campaign = [];

foreach ($utm_campaign as $entity) {
    $utmId = $entity->utm_campaign;
    if (array_key_exists($utmId, $groupedDatautm_campaign)) {
        $groupedDatautm_campaign[$utmId]['count'] += $entity->count;
    } else {
        $groupedDatautm_campaign[$utmId] = [
            'utm_campaign' => $utmId,
            'count' => $entity->count,
        ];
    }
}
$utm_campaign = array_values($groupedDatautm_campaign);



$groupedDatautm_term = [];

foreach ($utm_term as $entity) {
    $utmId = $entity->utm_term;
    if (array_key_exists($utmId, $groupedDatautm_term)) {
        $groupedDatautm_term[$utmId]['count'] += $entity->count;
    } else {
        $groupedDatautm_term[$utmId] = [
            'utm_term' => $utmId,
            'count' => $entity->count,
        ];
    }
}
$utm_term = array_values($groupedDatautm_term);

$groupedDatautm_content = [];

foreach ($utm_content as $entity) {
    $utmId = $entity->utm_content;
    if (array_key_exists($utmId, $groupedDatautm_content)) {
        $groupedDatautm_content[$utmId]['count'] += $entity->count;
    } else {
        $groupedDatautm_content[$utmId] = [
            'utm_content' => $utmId,
            'count' => $entity->count,
        ];
    }
}
$utm_content = array_values($groupedDatautm_content);

    setVariable('utm_source', $utm_source);
    setVariable('utm_medium', $utm_medium);
    setVariable('utm_campaign', $utm_campaign);
    setVariable('utm_id', $utm_id);
    setVariable('utm_term', $utm_term);
    setVariable('utm_content', $utm_content);
}
?>
