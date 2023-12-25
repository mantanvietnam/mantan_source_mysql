<?php 
function listStyleTextAdmin($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;

    $metaTitleMantan = 'Danh sách mẫu chữ';

	$modelStyleTexts = $controller->loadModel('StyleTexts');

	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
	$order = array('id'=>'desc');

	
    $listData = $modelStyleTexts->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
    

    $totalData = $modelStyleTexts->find()->where($conditions)->all()->toList();
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
    setVariable('totalData', $totalData);

    setVariable('listData', $listData);
}

function deleteStyleTextAdmin($input){
	global $controller;

	$modelStyleTexts = $controller->loadModel('StyleTexts');
	
	if(!empty($_GET['id'])){
		$data = $modelStyleTexts->get($_GET['id']);
		
		if($data){
         	// xóa mẫu thiết kế
			$modelStyleTexts->delete($data);
        }
	}

	return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-styleText-listStyleTextAdmin');
}

function addStyleTextAdmin($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $controller;

    global $urlCurrent;

    $metaTitleMantan = 'Thông tin mẫu chữ';
    $modelStyleTexts = $controller->loadModel('StyleTexts');
    $modelFont = $controller->loadModel('Font');

    if(!empty($_GET['id'])){
        $data = $modelStyleTexts->get( (int) $_GET['id']);

        $data->content = json_decode($data->content, true);

        $data->content['size'] = str_replace('vw', '', $data->content['size']);
        $data->content['rotate'] = str_replace('deg', '', $data->content['rotate']);
        $data->content['width'] = str_replace('vw', '', $data->content['width']);

        $data->color_first = $data->content['gradient_color'][0]['color'];
        $data->color_after = $data->content['gradient_color'][1]['color'];
    }else{
        $data = $modelStyleTexts->newEmptyEntity();

        $data->content = [];
        $data->content['color'] = '#000';
        $data->content['size'] = '10';
        $data->content['font'] = 'Arial';
        $data->content['brightness'] = '100';
        $data->content['contrast'] = '100';
        $data->content['saturate'] = '100';
        $data->content['rotate'] = '0';
        $data->content['gianchu'] = '0';
        $data->content['giandong'] = '0';
        $data->content['opacity'] = '1';
        $data->content['width'] = '100';
        $data->content['gradient'] = 0;
        $data->color_first = '#000';
        $data->color_after = '#000';
    }

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
      
        $data->name = str_replace(array('"', "'"), '’', @$dataSend['name']);
        $data->status = $dataSend['status'];

        // xử lý dữ liệu
        if(empty($dataSend['color'])) $dataSend['color'] = '#000';
        if(empty($dataSend['gianchu'])) $dataSend['gianchu'] = 'normal';
        if(empty($dataSend['giandong'])) $dataSend['giandong'] = 'normal';

        $dataSend['size'] = $dataSend['size'].'vw';
        $dataSend['rotate'] = $dataSend['rotate'].'deg';
        $dataSend['width'] = $dataSend['width'].'vw';

        $content = [
            'type' => 'text',
            'text' => 'Ezpics',
            'color' => $dataSend['color'],
            'size' => $dataSend['size'],
            'font' => $dataSend['font'],
            'status' => 1,
            'text_align' => $dataSend['text_align'],
            'postion_left' => 50,
            'postion_top' => 50,
            'brightness' => $dataSend['brightness'],
            'contrast' => $dataSend['contrast'],
            'saturate' => $dataSend['saturate'],
            'opacity' => $dataSend['opacity'],
            'gachchan' => $dataSend['gachchan'],
            'uppercase' => $dataSend['uppercase'],
            'innghieng' => $dataSend['innghieng'],
            'indam' => $dataSend['indam'],
            'linear_position' => $dataSend['linear_position'],
            'border' => 0,
            'rotate' => $dataSend['rotate'],
            'banner' => '',
            'gianchu' => $dataSend['gianchu'],
            'giandong' => $dataSend['giandong'],
            'width' => $dataSend['width'],
            'gradient' => (int) $dataSend['gradient'],
            'gradient_color' => [['position'=>0,'color'=>$dataSend['color_first']],['position'=>1,'color'=>$dataSend['color_after']]],
            'variable' => '',
            'variableLabel' => '',
            'typeShowTextVariable' => '',
            'removeBackgroundAuto' => 0,
        ];
        
        $data->content = json_encode($content);

        $modelStyleTexts->save($data);
        
        return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-styleText-listStyleTextAdmin');
    }

    $listFont = $modelFont->find()->all()->toList();
    
    setVariable('data', $data);
    setVariable('listFont', $listFont);
}