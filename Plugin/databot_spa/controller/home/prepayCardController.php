<?php 
function listPrepayCard($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
    global $session;

    $metaTitleMantan = 'Thẻ dịch vụ';

	$modelPrepayCard = $controller->loadModel('PrepayCards');
	
	if(!empty($session->read('infoUser'))){
		$infoUser = $session->read('infoUser');

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

		if(!empty($_GET['price'])){
			$conditions['price'] = (int) $_GET['price'];
		}

		if(!empty($_GET['price_sell'])){
			$conditions['price_sell'] = (int) $_GET['price_sell'];
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

    $metaTitleMantan = 'Thông tin thẻ dịch vụ';
    
    if(!empty($session->read('infoUser'))){
        $modelMembers = $controller->loadModel('Members');
		$modelPrepayCard = $controller->loadModel('PrepayCards');
		$modelTrademarks = $controller->loadModel('Trademarks');
        
        $infoUser = $session->read('infoUser');

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
                $data->price_sell = @$dataSend['price_sell'];
                $data->note = @$dataSend['note'];
                $data->use_time = (int) $dataSend['use_time'];                
                $data->commission_staff_fix = (int) $dataSend['commission_staff_fix'];                
                $data->commission_staff_percent = (int) $dataSend['commission_staff_percent'];                
                
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
    
    if(!empty($session->read('infoUser'))){
    	$infoUser = $session->read('infoUser');

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

function buyPrepayCard($input){
	global $controller;
	global $isRequestPost;
	global $urlCurrent;
	global $metaTitleMantan;
    global $session;

    $metaTitleMantan = 'Bán Thẻ trả trước';

    $mess = "";

	$modelPrepayCard = $controller->loadModel('PrepayCards');
	$modelCustomerPrepaycard = $controller->loadModel('CustomerPrepaycards');
	$modelBill = $controller->loadModel('Bills');
	$modelMembers = $controller->loadModel('Members');
	if(!empty($session->read('infoUser'))){
		$infoUser = $session->read('infoUser');
		$order = array('id'=>'desc');
		$conditions = array('id_member'=>$infoUser->id_member, 'id_spa'=>$session->read('id_spa'));
		$conditionsStaff['OR'] = [ 
									['id'=>$infoUser->id_member],
									['id_member'=>$infoUser->id_member],
								];
		
		$listStaffs = $modelMembers->find()->where($conditionsStaff)->all()->toList();
	    $listData = $modelPrepayCard->find()->where($conditions)->order($order)->all()->toList();
	    if ($isRequestPost) {
            $dataSend = $input['request']->getData();

            $bill = $modelBill->newEmptyEntity();
            $bill->id_member = @$infoUser->id_member;
            $bill->id_spa = $session->read('id_spa');
            $bill->id_staff = (int)@$dataSend['id_staff'];
            $bill->total = (int)@$dataSend['totalPays'];
            $bill->note = 'Bán hàng Mã thẻ trả trước, thời gian '.date('Y-m-d H:i:s');
            $bill->type = 0; //0: Thu, 1: chi
            $bill->created_at = date('Y-m-d H:i:s');
            $bill->updated_at = date('Y-m-d H:i:s');
            $bill->type_collection_bill = @$dataSend['type_collection_bill'];
            $bill->id_customer = (int)@$dataSend['id_customer'];
            $bill->full_name = @$dataSend['full_name'];
            $bill->moneyCustomerPay = @$dataSend['moneyCustomerPay'];

            if(!empty($dataSend['time'])){
                $time = explode(' ', $dataSend['time']);
                $date = explode('/', $time[0]);
                $hour = explode(':', $time[1]);
                $bill->time = mktime($hour[0], $hour[1], 0, $date[1], $date[0], $date[2]);
            }else{
                $bill->time = time();
            }
                   
            $modelBill->save($bill);

            foreach($dataSend['idHangHoa'] as $key => $value){
                $card = $modelCustomerPrepaycard->newEmptyEntity();

                $card->id_member = $infoUser->id_member;
                $card->id_bill = $bill->id;
                $card->id_spa = $session->read('id_spa');;
                $card->id_prepaycard = $value;
                $card->id_customer = @$dataSend['id_customer'];
                $card->price_sell = (int) $dataSend['money'][$key];
                $card->price = (int) $dataSend['priceCard'][$key];
                $card->total = (int) $dataSend['priceCard'][$key] *(int) $dataSend['soluong'][$key];
                $card->quantity = (int) $dataSend['soluong'][$key];
            	$card->created_at = date('Y-m-d H:i:s');
            	$card->updated_at = date('Y-m-d H:i:s');
            	$card->status = 'active';

                $modelCustomerPrepaycard->save($card);

            }
            return $controller->redirect('/printInfoBillCard?id='.$bill->id);
			
        }
	    
	    setVariable('listStaffs', $listStaffs);
	    setVariable('listData', $listData);
	}else{
		return $controller->redirect('/login');
	}
}

function printInfoBillCard($input){
	global $controller;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;
    global $isRequestPost;
    global $session;

    $metaTitleMantan = 'in đơn hàng';

    if(!empty($session->read('infoUser'))){
        $user = $session->read('infoUser');

        $modelBill = $controller->loadModel('Bills');
        $modelCustomer = $controller->loadModel('Customers');
		$modelPrepayCard = $controller->loadModel('PrepayCards');
		$modelCustomerPrepaycard = $controller->loadModel('CustomerPrepaycards');


        if(!empty($_GET['id'])){
            $data = $modelBill->find()->where(array('id'=>$_GET['id']))->first();
            
           
            $dataCustomerPrepaycard = $modelCustomerPrepaycard->find()->where(array('id_bill'=>$data->id))->all()->toList();

            if(!empty($dataCustomerPrepaycard)){
            	foreach($dataCustomerPrepaycard as $key => $item){

            		$item->infoPrepayCard = $modelPrepayCard->find()->where(array('id'=>$item->id_prepaycard))->first();
            		if(!empty($item->infoPrepayCard)){
						$dataCustomerPrepaycard[$key] = $item;
					}
            	}
            	$data->CustomerCard =  $dataCustomerPrepaycard;
            }
             $data->spa = getSpa($user->id_spa);
            /*debug($data);
           	die();*/

            setVariable('user', $user);
            setVariable('data', $data);
        }else{
        	return $controller->redirect('/dashboard');
        }
    }else{
        return $controller->redirect('/login');
    }
}

function listCustomerPrepayCard($input){
    global $controller;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;
    global $isRequestPost;
    global $session;

    $metaTitleMantan = 'Danh sách thẻ trước';

    if(!empty($session->read('infoUser'))){
        $user = $session->read('infoUser');

        $modelBill = $controller->loadModel('Bills');
        $modelCustomer = $controller->loadModel('Customers');
        $modelPrepayCard = $controller->loadModel('PrepayCards');
        $modelCustomerPrepaycard = $controller->loadModel('CustomerPrepaycards');

        $conditions = array('id_member'=>$user->id_member);

        if(!empty($_GET['id_customer'])){
           $conditions['id_customer'] = $_GET['id_customer'];
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
           
        $listData = $modelCustomerPrepaycard->find()->where($conditions)->all()->toList();

        if(!empty($listData)){
            foreach($listData as $key => $item){

                $item->infoPrepayCard = $modelPrepayCard->find()->where(array('id'=>$item->id_prepaycard))->first();
                $item->infoCustomer = $modelCustomer->find()->where(array('id'=>$item->id_customer))->first();
                $listData[$key] = $item;
                
            }
        }

            setVariable('user', $user);
            setVariable('listData', $listData);
        
    }else{
        return $controller->redirect('/login');
    }
}

function listCustomerPrepayCardAPI($input){
    global $controller;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;
    global $isRequestPost;
    global $session;

    $metaTitleMantan = 'Danh sách thẻ trước';
    $return = array();

    if(!empty($session->read('infoUser'))){
        $user = $session->read('infoUser');

        
        $modelCustomerPrepaycard = $controller->loadModel('CustomerPrepaycards');
        $modelPrepayCard = $controller->loadModel('PrepayCards');

        $conditions = array('id_member'=>$user->id_member, 'total >' => 0);


        $conditions['id_customer'] = $_GET['id_customer'];
        $conditions['total >='] = $_GET['total'];
        
           
        $listData = $modelCustomerPrepaycard->find()->where($conditions)->all()->toList();

        if(!empty($listData)){
            foreach($listData as $key => $item){

                $item->infoPrepayCard = $modelPrepayCard->find()->where(array('id'=>$item->id_prepaycard))->first();
                $listData[$key] = $item;
                
            }
        }

        $return =  array('data'=>$listData);
        
    }

    return $return;
}
?>