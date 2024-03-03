<?php 
function requestProductAgency($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    if(!empty($session->read('infoUser'))){
        $metaTitleMantan = 'Danh sách yêu cầu nhập hàng';

        $modelProducts = $controller->loadModel('Products');
        $modelOrderMembers = $controller->loadModel('OrderMembers');
        $modelOrderMemberDetails = $controller->loadModel('OrderMemberDetails');

        $conditions = array('id_member_buy'=>$session->read('infoUser')->id);
        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        $order = array('id'=>'desc');

        if(!empty($_GET['id'])){
            $conditions['id'] = (int) $_GET['id'];
        }

        if(!empty($_GET['status_pay'])){
            $conditions['status_pay'] = $_GET['status_pay'];
        }

        if(!empty($_GET['status'])){
            $conditions['status'] = $_GET['status'];
        }

        if(!empty($_GET['date_start'])){
            $date_start = explode('/', $_GET['date_start']);
            $conditions['create_at >='] = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
        }

        if(!empty($_GET['date_end'])){
            $date_end = explode('/', $_GET['date_end']);
            $conditions['create_at <='] = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
                
        }

        
        $listData = $modelOrderMembers->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        

        if(!empty($listData)){
            foreach($listData as $key => $item){
                $detail_order = $modelOrderMemberDetails->find()->where(['id_order_member'=>$item->id])->all()->toList();
                
                if(!empty($detail_order)){
                    foreach ($detail_order as $k => $value) {
                        $product = $modelProducts->find()->where(['id'=>$value->id_product ])->first();
                        if(!empty($product)){
                            $detail_order[$k]->product = $product->title;
                        }
                    }

                    $listData[$key]->detail_order = $detail_order;
                }
            }
        }

        // phân trang
        $totalData = $modelOrderMembers->find()->where($conditions)->all()->toList();
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

function addRequestProductAgency($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;

    if(!empty($session->read('infoUser'))){
        $metaTitleMantan = 'Tạo yêu cầu nhập hàng';

        $modelProducts = $controller->loadModel('Products');
        $modelOrderMembers = $controller->loadModel('OrderMembers');
        $modelOrderMemberDetails = $controller->loadModel('OrderMemberDetails');
        $modelMembers = $controller->loadModel('Members');

        $mess = '';

        if($isRequestPost){
            $dataSend = $input['request']->getData();

            if(!empty($dataSend['idHangHoa'])){
                $save = $modelOrderMembers->newEmptyEntity();

                $save->id_member_sell = $session->read('infoUser')->id_father;
                $save->id_member_buy = $session->read('infoUser')->id;
                $save->note_sell = '';
                $save->note_buy = $dataSend['note'];
                $save->status = 'new';
                $save->create_at = time();
                $save->money = (int) $dataSend['total'];
                $save->total = (int) $dataSend['totalPays'];
                $save->status_pay = 'wait';
                $save->discount = $dataSend['promotion'];

                $modelOrderMembers->save($save);

                foreach ($dataSend['idHangHoa'] as $key => $value) {
                    $saveDetail = $modelOrderMemberDetails->newEmptyEntity();

                    $saveDetail->id_product = $value;
                    $saveDetail->id_order_member = $save->id;
                    $saveDetail->quantity = $dataSend['soluong'][$key];
                    $saveDetail->price = $dataSend['money'][$key];

                    $modelOrderMemberDetails->save($saveDetail);
                }

                $mess= '<p class="text-success">Gửi yêu cầu thành công</p>';
            }else{
                $mess= '<p class="text-danger">Không thể tạo đơn do bạn chưa chọn sản phẩm</p>';
            }
        }

        $listProduct = [];
        if(function_exists('getAllProductActive')){
            $listProduct = getAllProductActive();
        }

        $position = $modelCategories->find()->where(array('id'=>$session->read('infoUser')->id_position))->first();

        $father = $modelMembers->find()->where(array('id'=>$session->read('infoUser')->id_father))->first();

        setVariable('listProduct', $listProduct);
        setVariable('position', $position);
        setVariable('father', $father);
        setVariable('mess', $mess);
    }else{
        return $controller->redirect('/login');
    }
}

function orderMemberAgency($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    if(!empty($session->read('infoUser'))){
        $metaTitleMantan = 'Danh sách đơn hàng đại lý';

        $modelProducts = $controller->loadModel('Products');
        $modelOrderMembers = $controller->loadModel('OrderMembers');
        $modelOrderMemberDetails = $controller->loadModel('OrderMemberDetails');

        $conditions = array('id_member_sell'=>$session->read('infoUser')->id);
        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        $order = array('id'=>'desc');

        if(!empty($_GET['id'])){
            $conditions['id'] = (int) $_GET['id'];
        }

        if(!empty($_GET['status_pay'])){
            $conditions['status_pay'] = $_GET['status_pay'];
        }

        if(!empty($_GET['status'])){
            $conditions['status'] = $_GET['status'];
        }

        if(!empty($_GET['date_start'])){
            $date_start = explode('/', $_GET['date_start']);
            $conditions['create_at >='] = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
        }

        if(!empty($_GET['date_end'])){
            $date_end = explode('/', $_GET['date_end']);
            $conditions['create_at <='] = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
                
        }

        
        $listData = $modelOrderMembers->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        

        if(!empty($listData)){
            foreach($listData as $key => $item){
                $detail_order = $modelOrderMemberDetails->find()->where(['id_order_member'=>$item->id])->all()->toList();
                
                if(!empty($detail_order)){
                    foreach ($detail_order as $k => $value) {
                        $product = $modelProducts->find()->where(['id'=>$value->id_product ])->first();
                        if(!empty($product)){
                            $detail_order[$k]->product = $product->title;
                        }
                    }

                    $listData[$key]->detail_order = $detail_order;
                }
            }
        }

        // phân trang
        $totalData = $modelOrderMembers->find()->where($conditions)->all()->toList();
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