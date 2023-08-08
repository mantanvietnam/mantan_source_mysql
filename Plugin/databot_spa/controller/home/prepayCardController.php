<?php 
function listPrepayCard($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
    global $session;

    $metaTitleMantan = 'Danh sách khách hàng';

	$modelPrepayCard = $controller->loadModel('PrepayCards');
	$infoUser = $session->read('infoUser');
	if(!empty($infoUser)){

		$conditions = array('id_member'=>$infoUser->id_member, 'id_spa'=>$session->read('id_spa'));
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		$order = array('id'=>'desc');

		if(!empty($_GET['id'])){
			$conditions['id'] = (int) $_GET['id'];
		}

		if(!empty($_GET['status'])){
			$conditions['status'] = $_GET['status'];
		}

		if(!empty($_GET['name'])){
			$conditions['name LIKE'] = '%'.$_GET['name'].'%';
		}

	    $listData = $modelPrepayCard->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

	    $totalData = $modelPrepayCard->find()->where($conditions)->all()->toList();
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
	}else{
		return $controller->redirect('/login');
	}
}

function addPrepayCard($input){
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    $metaTitleMantan = 'Danh sách danh mục sản phẩm';
    if(!empty($session->read('infoUser'))){
        $modelMembers = $controller->loadModel('Members');
		$modelPrepayCard = $controller->loadModel('PrepayCards');
        $infoUser = $session->read('infoUser');
        
        $modelTrademarks = $controller->loadModel('Trademarks');
        $mess= '';

        // lấy data edit
        if(!empty($_GET['id'])){
            $data = $modelPrepayCard->get( (int) $_GET['id']);

        }else{
            $data = $modelPrepayCard->newEmptyEntity();
             $data->created_at = date('Y-m-d H:i:s');
        }

        if ($isRequestPost) {
            $dataSend = $input['request']->getData();
            if(!empty($dataSend['name'])){
                // tạo dữ liệu save
                $data->name = @$dataSend['name'];
                $data->id_member = $infoUser->id_member;
                $data->id_spa = (int) $session->read('id_spa');
                $data->status = @$dataSend['status'];
                $data->price = @$dataSend['price'];
                $data->discount_money = @$dataSend['discount_money'];
                $data->total_price = @$dataSend['total_price'];
                $data->special_price_momo = @$dataSend['special_price_momo'];
                $data->note = @$dataSend['note'];
                $data->use_time = @$dataSend['use_time'];                
                
                $modelPrepayCard->save($data);

                $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

                 if(!empty($_GET['id'])){
                    return $controller->redirect('/listPrepayCard?mess=2');
                }else{
                    return $controller->redirect('/listPrepayCard?mess=1');
                }
                
            }else{
                $mess= '<p class="text-danger">Bạn chưa nhập tên</p>';
            }
        }

        setVariable('data', $data);
    }else{
        return $controller->redirect('/login');
    }
}

function deletePrepayCard($input){
    global $controller;
    global $session;
    $modelPrepayCard = $controller->loadModel('PrepayCards');
    $infoUser = $session->read('infoUser');
    if(!empty($infoUser)){
    
        if(!empty($_GET['id'])){
            $data = $modelPrepayCard->get($_GET['id']);
            
            if($data){
                $modelPrepayCard->delete($data);
            }
        }

        return $controller->redirect('/listPrepayCard');
    }else{
        return $controller->redirect('/login');
    }
}

 ?>