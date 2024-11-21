<?php 
function listOrderPointAdmin($input)
{
    global $controller, $transactionType;
    global $isRequestPost;
    global $bookingStatus;
    global $bookingType;

    
    $modelUser = $controller->loadModel('Users');
    $modelOrderPoint = $controller->loadModel('OrderPoints');
    $modelNotification = $controller->loadModel('Notifications');

    $parameter = parameter();
    $convertPointMoney = (int) $parameter['convertPointMoney'];
    $minimumPointSold = (int) $parameter['minimumPointSold'];

    $conditions = array();
    $limit = (!empty($_GET['limit'])) ? (int)$_GET['limit'] : 20;
    $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;

    if (!empty($_GET['id'])) {
        $conditions['id'] = (int)$_GET['id'];
    }

    if (!empty($_GET['status'])) {
        $conditions['status'] = (int)$_GET['status'];
    }

    if (!empty($_GET['type'])) {
        $conditions['type'] = (int)$_GET['type'];
    }

    if(!empty($_GET['id_sell'])){
    	$user_sell = $modelUser->find()->where(['id'=>$_GET['id_sell']])->first();

    	if(!empty($user_sell)){
		    $conditions['user_sell'] = $user_sell->id;
		}else{
		    $conditions['user_sell'] = -1;
		}
    }

    if(!empty($_GET['id_buy'])){
    	$user_buy = $modelUser->find()->where(['id'=>$_GET['id_buy']])->first();

    	if(!empty($user_buy)){
		    $conditions['user_buy'] = $user_buy->id;
		}else{
		    $conditions['user_buy'] = -1;
		}
    }

    $listData = $modelOrderPoint->find()->limit($limit)->page($page)->where($conditions)->order(['id' => 'desc'])->all()->toList();

    if(!empty($listData)){
    	foreach($listData as $key => $item){
    		$user_sell = array();
    		if(!empty($item->user_sell)){
    			$user_sell = $modelUser->find()->where(['id'=>$item->user_sell])->first();

    			unset($user_sell->password);
    		}

    		$item->infoUser_sell = $user_sell;
    		$user_buy = array();
    		if(!empty($item->user_buy)){
    			$user_buy = $modelUser->find()->where(['id'=>$item->user_buy])->first();

    			unset($user_buy->password);
    		}

    		$item->infoUser_buy = $user_buy;

    		$listData[$key]= $item;

    	}
    }

    $totalData = $modelOrderPoint->find()->where($conditions)->all()->toList();
    $paginationMeta = createPaginationMetaData(count($totalData),$limit,$page); 

    setVariable('page', $page);
    setVariable('totalPage', $paginationMeta['totalPage']);
    setVariable('back', $paginationMeta['back']);
    setVariable('next', $paginationMeta['next']);
    setVariable('urlPage', $paginationMeta['urlPage']);
    setVariable('listData', $listData);


}
 ?>