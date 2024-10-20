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
	$modelOrder = $controller->loadModel('Orders');

	$conditions = array();

	if(!empty($_GET['date_start'])){
		$date_start = explode('/', $_GET['date_start']);
		$date_start = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
		$conditions['created_at >='] = date('Y-m-d H:i:s', $date_start);
    }
	// }else{
 //          $conditions['created_at LIKE'] = "%".date('Y-m')."%";
 //    }

	if(!empty($_GET['date_end'])){
		$date_end = explode('/', $_GET['date_end']);
		$date_end = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
		$conditions['created_at <='] = date('Y-m-d H:i:s', $date_end);
    }
	// }else{
 //          $conditions['created_at LIKE'] = "%".date('Y-m')."%";
 //    }


   

    // $facebookAds =  $modelUtm->find()->where($conditions)->all()->toList();
    $query = $modelUtm->find()->where($conditions);
    $utm_source = $query->select(['utm_source', 'count' => $query->func()->count('*')])->group(['utm_source'])->toArray();
    $utm_medium = $query->select(['utm_medium', 'count' => $query->func()->count('*')])->group(['utm_medium'])->toArray();
    $utm_campaign = $query->select(['utm_campaign', 'count' => $query->func()->count('*')])->group(['utm_campaign'])->toArray();
    $utm_id = $query->select(['utm_id', 'count' => $query->func()->count('*')])->group(['utm_id'])->toArray();
    $utm_term = $query->select(['utm_term', 'count' => $query->func()->count('*')])->group(['utm_term'])->toArray();
    $utm_content = $query->select(['utm_content', 'count' => $query->func()->count('*')])->group(['utm_content'])->toArray();


    // debug($utm_source);
    // debug($utm_medium);
    // debug($utm_campaign);
    // debug($utm_term);
    // debug($utm_id);
    // debug($utm_content);
    // die();



    $groupedDatautm_source = [];
    $groupedDatautm_medium = [];
    $groupedDatautm_campaign = [];
    $groupedDatautm_id = [];
    $groupedDatautm_term = [];
    $groupedDatautm_content = [];


    /*foreach ($facebookAds as $entity){

        // utm_source
        $utmsource = $entity->utm_source;
        if (array_key_exists($utmsource, $groupedDatautm_source)) {
            $groupedDatautm_source[$utmsource]['count'] += 1;
            $order = $modelOrder->find()->where(array('id_utm'=>$entity->id))->first();
            if(!empty($order)){
                $groupedDatautm_source[$utmsource]['countorder'] += 1;
            }
            

        } else {
            $countorder = 0;
            $order = $modelOrder->find()->where(array('id_utm'=>$entity->id))->first();
            if(!empty($order)){
                $countorder += 1;
            }
            $groupedDatautm_source[$utmsource] = [
                'utm_source' => $utmsource,
                'count' => 1,
                'countorder' => $countorder,
            ];
        }

        // utm_medium
        $utmmedium = $entity->utm_medium;
        if (array_key_exists($utmmedium, $groupedDatautm_medium)) {
            $groupedDatautm_medium[$utmmedium]['count'] += 1;
            $order = $modelOrder->find()->where(array('id_utm'=>$entity->id))->first();
            if(!empty($order)){
                $groupedDatautm_medium[$utmmedium]['countorder'] += 1;
            }
            
        } else {
            $countorder = 0;
            $order = $modelOrder->find()->where(array('id_utm'=>$entity->id))->first();
            if(!empty($order)){
                $countorder += 1;
            }
            $groupedDatautm_medium[$utmmedium] = [
                'utm_medium' => $utmmedium,
                'count' => 1,
                'countorder' => $countorder,
            ];
        }

        // campaign

        $utmcampaign = $entity->utm_campaign;
        if (array_key_exists($utmcampaign, $groupedDatautm_campaign)) {
            $groupedDatautm_campaign[$utmcampaign]['count'] += 1;
            $order = $modelOrder->find()->where(array('id_utm'=>$entity->id))->first();
            if(!empty($order)){
                $groupedDatautm_campaign[$utmcampaign]['countorder'] += 1;
            }
            
        } else {
            $countorder = 0;
            $order = $modelOrder->find()->where(array('id_utm'=>$entity->id))->first();
            if(!empty($order)){
                $countorder += 1;
            }
            $groupedDatautm_campaign[$utmcampaign] = [
                'utm_campaign' => $utmcampaign,
                'count' => 1,
                'countorder' => $countorder,
            ];
        }

        // id
        $utmid = $entity->utm_id;
        if (array_key_exists($utmid, $groupedDatautm_id)) {
            $groupedDatautm_id[$utmid]['count'] += 1;
            $order = $modelOrder->find()->where(array('id_utm'=>$entity->id))->first();
            if(!empty($order)){
                $groupedDatautm_id[$utmid]['countorder'] += 1;
            }

        } else {
            $countorder = 0;
            $order = $modelOrder->find()->where(array('id_utm'=>$entity->id))->first();
            if(!empty($order)){
                $countorder += 1;
            }
            $groupedDatautm_id[$utmid] = [
                'utm_id' => $utmid,
                'count' => 1,
                'countorder' => $countorder,
            ];
        }

        // term

        $utmterm = $entity->utm_term;
        if (array_key_exists($utmterm, $groupedDatautm_term)) {
            $groupedDatautm_term[$utmterm]['count'] += 1;
            $order = $modelOrder->find()->where(array('id_utm'=>$entity->id))->first();
            if(!empty($order)){
                $groupedDatautm_term[$utmterm]['countorder'] += 1;
            }
            
        } else {
            $countorder = 0;
            $order = $modelOrder->find()->where(array('id_utm'=>$entity->id))->first();
            if(!empty($order)){
                $countorder += 1;
            }
            $groupedDatautm_term[$utmterm] = [
                'utm_term' => $utmterm,
                'count' => 1,
                'countorder' => $countorder,
            ];
        }

        //content

        $utmcontent = $entity->utm_content;
        if (array_key_exists($utmcontent, $groupedDatautm_content)) {
            $groupedDatautm_content[$utmcontent]['count'] += 1;
            $order = $modelOrder->find()->where(array('id_utm'=>$entity->id))->first();
            if(!empty($order)){
                $groupedDatautm_content[$utmcontent]['countorder'] += 1;
            }
            
        } else {
            $countorder = 0;
            $order = $modelOrder->find()->where(array('id_utm'=>$entity->id))->first();
            if(!empty($order)){
                $countorder += 1;
            }
            $groupedDatautm_content[$utmcontent] = [
                'utm_content' => $utmcontent,
                'count' => 1,
                'countorder' => $countorder,
            ];
        }

    }*/
    foreach($utm_source as $entity){
        $source = $entity->utm_source;
        $count = $entity->count;
        if (isset($groupedDatautm_source[$source])) {
            $groupedDatautm_source[$source] += $count; // Nếu đã tồn tại thì cộng thêm vào
        } else {
            $groupedDatautm_source[$source] = $count; // Nếu chưa tồn tại thì tạo mới
        }
    }

    foreach($utm_medium as $entity){
        $medium = $entity->utm_medium;
        $count = $entity->count;
        if (isset($groupedDatautm_medium[$medium])) {
            $groupedDatautm_medium[$medium] += $count; // Nếu đã tồn tại thì cộng thêm vào
        } else {
            $groupedDatautm_medium[$medium] = $count; // Nếu chưa tồn tại thì tạo mới
        }
    }

    foreach($utm_campaign as $entity){
        $campaign = $entity->utm_campaign;
        $count = $entity->count;
        if (isset($groupedDatautm_campaign[$campaign])) {
            $groupedDatautm_campaign[$campaign] += $count; // Nếu đã tồn tại thì cộng thêm vào
        } else {
            $groupedDatautm_campaign[$campaign] = $count; // Nếu chưa tồn tại thì tạo mới
        }
    }

    foreach($utm_id as $entity){
        $id = $entity->utm_id;
        $count = $entity->count;
        if (isset($groupedDatautm_id[$id])) {
            $groupedDatautm_id[$id] += $count; // Nếu đã tồn tại thì cộng thêm vào
        } else {
            $groupedDatautm_id[$id] = $count; // Nếu chưa tồn tại thì tạo mới
        }
    }

    foreach($utm_term as $entity){
        $term = $entity->utm_term;
        $count = $entity->count;
        if (isset($groupedDatautm_term[$term])) {
            $groupedDatautm_term[$term] += $count; // Nếu đã tồn tại thì cộng thêm vào
        } else {
            $groupedDatautm_term[$term] = $count; // Nếu chưa tồn tại thì tạo mới
        }
    }

    foreach($utm_content as $entity){
        $content = $entity->utm_content;
        $count = $entity->count;
        if (isset($groupedDatautm_content[$content])) {
            $groupedDatautm_content[$content] += $count; // Nếu đã tồn tại thì cộng thêm vào
        } else {
            $groupedDatautm_content[$content] = $count; // Nếu chưa tồn tại thì tạo mới
        }
    }


    // $utm_source = array_values($groupedDatautm_source);
    // $utm_medium = array_values($groupedDatautm_medium);
    // $utm_campaign = array_values($groupedDatautm_campaign);
    // $utm_id = array_values($groupedDatautm_id);
    // $utm_term = array_values($groupedDatautm_term);
    // $utm_content = array_values($groupedDatautm_content);
    /*debug($groupedDatautm_source);
    debug($utm_medium);
    debug($utm_campaign);
    debug($utm_term);
    debug($utm_id);
    debug($utm_content);
    die();*/
    

    setVariable('utm_source', $groupedDatautm_source);
    setVariable('utm_medium', $groupedDatautm_medium);
    setVariable('utm_campaign', $groupedDatautm_campaign);
    setVariable('utm_id', $groupedDatautm_id);
    setVariable('utm_term', $groupedDatautm_term);
    setVariable('utm_content', $groupedDatautm_content);
}
?>
