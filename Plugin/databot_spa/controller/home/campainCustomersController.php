<?php 
function listCustomerCampaign($input)
{
    global $controller;
    global $session;
    global $urlCurrent;
    global $isRequestPost;
    
    $modelCampains = $controller->loadModel('Campains');
    $modelCampainCustomers = $controller->loadModel('CampainCustomers');
    $modelCustomer = $controller->loadModel('Customers');
    
    if(!empty(checkLoginManager('listCustomerCampaign', 'campain'))){
        $mess= '';

        if(!empty($_GET['idCampaign'])){
            $infoCampaign = $modelCampains->find()->where(['id'=>(int) $_GET['idCampaign']])->first();

            if(!empty($infoCampaign)){
            	if($isRequestPost){
            		$dataSend = $input['request']->getData();

            		if(!empty($dataSend['id_customer'])){
            			$infoCustomer = $modelCustomer->find()->where(['id'=>(int) $dataSend['id_customer']])->first();

            			if(!empty($infoCustomer)){
            				$checkCampainCustomers = $modelCampainCustomers->find()->where(['id_customer'=>(int) $dataSend['id_customer'], 'id_campain'=>(int) $_GET['idCampaign']])->first();

            				if(empty($checkCampainCustomers)){
            					$infoCampaign->codeUser ++;
					    		$modelCampains->save($infoCampaign);

					    		$dataCampainCustomers = $modelCampainCustomers->newEmptyEntity();

					    		$dataCampainCustomers->id_campain = (int) $infoCampaign->id;
					    		$dataCampainCustomers->id_customer = $infoCustomer->id;
					    		$dataCampainCustomers->create_at = time();
					    		$dataCampainCustomers->code = $infoCampaign->codeUser;
					    		$dataCampainCustomers->note = '';

					    		$modelCampainCustomers->save($dataCampainCustomers);
            				}
            			}
            		}
            	}

                $conditions = array('id_campain'=>$infoCampaign->id);
                $limit = 20;
                $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
                if($page<1) $page = 1;
                $order = array('CampainCustomers.id'=>'desc');

                if(!empty($_GET['id_customer'])){
                    $conditions['id_customer'] = (int) $_GET['id_customer'];
                }

                if(!empty($_GET['phone'])){
					$conditions['customers.phone'] = $_GET['phone'];
				}

				if(!empty($_GET['email'])){
					$conditions['customers.email'] = $_GET['email'];
				}

				if(!empty($_GET['name'])){
					$conditions['customers.name LIKE'] = '%'.$_GET['name'].'%';
				}

               
                $listData = $modelCampainCustomers->find()
                		->select([
					        'CampainCustomers.id',
					        'CampainCustomers.code',
					        'customers.name', 
					        'customers.phone', 
					        'customers.email', 
					    ])
                		->join([
					        'table' => 'customers',
					        'alias' => 'customers',
					        'type' => 'INNER',
					        'conditions' => 'customers.id = CampainCustomers.id_customer',
					    ])
					    ->limit($limit)
					    ->page($page)
					    ->where($conditions)
					    ->order($order)
					    ->all()
					    ->toList();
            	
                $totalData = $modelCampainCustomers->find()->where($conditions)->all()->toList();
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
                setVariable('mess', $mess);
            }else{
            	return $controller->redirect('/listCampain');
            }
        }else{
        	return $controller->redirect('/listCampain');
        }
    }else{
        return $controller->redirect('/');
    }
}

function deleteCustomerCampain($input){
	global $controller;
	global $session;
	
	$modelCampainCustomers = $controller->loadModel('CampainCustomers');
	
	if(!empty(checkLoginManager('deleteCustomerCampain','campain'))){
		$infoUser = $session->read('infoUser');

		if(!empty($_GET['id'])){
			$data = $modelCampainCustomers->get($_GET['id']);
			
			if(!empty($data)){
	         	$modelCampainCustomers->delete($data);
	        }
		}

		return $controller->redirect('/listCustomerCampaign/?idCampaign='.$data->id_campain);
	}else{
		return $controller->redirect('/');
	}
}
?>