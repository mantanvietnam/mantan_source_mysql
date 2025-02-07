<?php 
// Danh sách Phiếu thu
function listAgency($input){
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;
	global $type_collection_bill;
	setVariable('page_view', 'listAgency');
	if(!empty(checkLoginManager('listAgency', 'static'))){
	    $metaTitleMantan = 'Hoa hồng cho nhân viên';

	    $modelMember = $controller->loadModel('Members');
	    $modelService = $controller->loadModel('Services');
		$modelAgency = $controller->loadModel('Agencys');
		$modelOrder = $controller->loadModel('Orders');
		$modelCustomer = $controller->loadModel('Customers');
		$user = $session->read('infoUser');

		$conditions = array( 'id_member'=>$user->id_member, 'id_spa'=>$session->read('id_spa'));
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		$order = array('id'=>'desc');
		
		if(!empty($_GET['id'])){
			$conditions['id'] = (int) $_GET['id'];
		}

		if(!empty($_GET['id_staff'])){
			$conditions['id_staff'] = (int) $_GET['id_staff'];
		}

		if(!empty($_GET['id_debt'])){
			$conditions['id_debt'] = (int) $_GET['id_debt'];
		}

		/*if(!empty($_GET['full_name'])){
			$conditions['full_name LIKE'] = '%'.$_GET['full_name'].'%';
		}*/

		if(!empty($_GET['date_start'])){
	        $date_start = explode('/', $_GET['date_start']);
	        $date_start = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
	        $conditions['created_at >='] = $date_start;

	    }

	    if(!empty($_GET['date_end'])){
	        $date_end = explode('/', $_GET['date_end']);
	        $date_end = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
	        $conditions['created_at <='] = $date_end;

	    }

		if(!empty($_GET['id_customer'])){
			$conditions['id_customer'] = (int) $_GET['id_customer'];
		}

	    	$listData = $modelAgency->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

	    	

	    if(!empty($listData)){
			foreach($listData as $key =>$item){
				$staff = $modelMember->find()->where(array('id'=>$item->id_staff))->first();
				if(!empty($staff)){
					$listData[$key]->staff = $staff;
				}
				$service = $modelService->find()->where(array('id'=>$item->id_service))->first();

				if(!empty($service)){
					$listData[$key]->service = $service->name;
				}

				$order = $modelOrder->find()->where(['id'=>$item->id_order])->first();
				if(!empty($order)){
					$order->customer = $modelCustomer->find()->where(['id'=>$order->id_customer])->first();
				}

				$listData[$key]->order= $order;

			}
		}


	    

		$totalData = $modelAgency->find()->where($conditions)->all()->toList();
	    
	    $totalMoney = 0;
	     if(!empty($totalData)){
			foreach($totalData as $key =>$item){
				$totalMoney += $item->money;
			}
		}
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
	    if(@$_GET['mess']==3){
	    	$mess = '<p class="text-success">Xóa thành công</p>';
	    }

	    $conditionsStaff['OR'] = [ 
									['id'=>$user->id_member],
									['id_member'=>$user->id_member],
								];
	    $listStaffs = $modelMember->find()->where($conditionsStaff)->all()->toList();

		setVariable('page', $page);
	    setVariable('totalPage', $totalPage);
	    setVariable('back', $back);
	    setVariable('next', $next);
	    setVariable('urlPage', $urlPage);
	    setVariable('totalData', $totalData);
	    
	    setVariable('listData', $listData);
	    setVariable('totalMoney', $totalMoney);
	    setVariable('mess', $mess);
	    setVariable('listStaffs', $listStaffs);
	}else{
		return $controller->redirect('/');
	}
}

function payAgency($input)
{
    global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;
	global $type_collection_bill;
    $modelBill = $controller->loadModel('Bills');
    if(!empty(checkLoginManager('listAgency', 'static'))){
	    $metaTitleMantan = 'Hoa hồng cho nhân viên';

	    $modelMember = $controller->loadModel('Members');
	    $modelService = $controller->loadModel('Services');
		$modelAgency = $controller->loadModel('Agencys');
		$user =  $session->read('infoUser');
		
       /* if(empty($user->grant_permission)){
            return $controller->redirect('/listAgency');
        }*/
        if(!empty($_GET['id'])){
            $data = $modelAgency->get($_GET['id']);
            
            if(!empty($data)){
                $data->status = 1;

                $modelAgency->save($data);
                $time= time();
                 // bill cho người mua
                $bill = $modelBill->newEmptyEntity();

                $info_staff = $modelMember->find()->where(['id'=>$data->id_staff])->first();
                $service = $modelService->find()->where(array('id'=>$data->id_service))->first();
                
                $bill->created_at = time();
                $bill->time = time();
                $bill->id_member = @$user->id_member;
                $bill->id_spa = $session->read('id_spa');
                $bill->id_staff = $user->id;
                $bill->total = (int) $data->money;
                $bill->note = 'thanh toán tiền hoan hồng cho nhân viên '.$info_staff->name.' ngày '. date('Y-m-d H:i:s');
                $bill->type = 1; //0: Thu, 1: chi
                $bill->updated_at = time();
                $bill->type_collection_bill = $_GET['type_collection_bill'];
                $bill->id_customer = 0;
                $bill->full_name =0;
                $bill->id_warehouse_product = 0;
                $bill->id_agency=(int)$_GET['id'];
                $modelBill->save($bill);
            }
        }

        return $controller->redirect('/listAgency');
    }else{
        return $controller->redirect('/login');
    }
}
 ?>