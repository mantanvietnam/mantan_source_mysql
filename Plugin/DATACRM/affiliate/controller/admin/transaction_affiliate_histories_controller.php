<?php 
function listTransactionAffiliaterAdmin($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $metaTitleMantan = 'Lịch sử giao dịch';

    $modelAffiliaters = $controller->loadModel('Affiliaters');
    $modelTransactionAffiliateHistories = $controller->loadModel('TransactionAffiliateHistories');

    $conditions = array();
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }

    if(!empty($_GET['id_affiliater'])){
        $conditions['id_affiliater'] = (int) $_GET['id_affiliater'];
    }

    if(!empty($_GET['id_order'])){
        $conditions['id_order'] = (int) $_GET['id_order'];
    }

    if(!empty($_GET['status'])){
        $conditions['status'] = $_GET['status'];
    }

    if(!empty($_GET['action']) && $_GET['action']=='Excel'){
        $listData = $modelTransactionAffiliateHistories->find()->where($conditions)->order($order)->all()->toList();
        
        $titleExcel =   [
            ['name'=>'Họ và tên', 'type'=>'text', 'width'=>25],
            ['name'=>'Số điện thoại', 'type'=>'text', 'width'=>25],
            ['name'=>'ID đơn hàng', 'type'=>'text', 'width'=>25],
            ['name'=>'Giá trị đơn hàng', 'type'=>'text', 'width'=>25],
            ['name'=>'Tiền hoa hồng', 'type'=>'text', 'width'=>25],
            ['name'=>'Phần trăm chiết khấu', 'type'=>'text', 'width'=>25],
            ['name'=>'Trạng thái', 'type'=>'text', 'width'=>25],
            
        ];

        $dataExcel = [];
        if(!empty($listData)){
            foreach ($listData as $key => $value) {
                $aff = $modelAffiliaters->find()->where(['id'=>$value->id_affiliater])->first();

                $status = 'Chưa thanh toán';
                if($value->status == 'done'){
                    $status = 'Đã thanh toán';
                }

                $dataExcel[] = [
                                    @$aff->name,   
                                    $aff->phone,   
                                    $value->id_order,   
                                    $value->money_total,   
                                    $value->money_back,   
                                    $value->percent,   
                                    $status
                                ];
            }
        }
       export_excel($titleExcel,$dataExcel,'danh_sach_lich_su_giao_dich_tiep_thi_lien_ket');
    }else{
        $listData = $modelTransactionAffiliateHistories->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

        if(!empty($listData)){
            foreach ($listData as $key => $value) {
                $listData[$key]->aff = $modelAffiliaters->find()->where(['id'=>$value->id_affiliater])->first();
            }
        }
    }

    // phân trang
    $totalData = $modelTransactionAffiliateHistories->find()->where($conditions)->all()->toList();
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
   
}

function payTransactionAffiliaterAdmin($input)
{
    global $controller;

    $modelTransactionAffiliateHistories = $controller->loadModel('TransactionAffiliateHistories');
    
    if(!empty($_GET['id'])){
        $data = $modelTransactionAffiliateHistories->get($_GET['id']);
        
        if($data){
            $data->status = 'done';

            $modelTransactionAffiliateHistories->save($data);
        }
    }

    return $controller->redirect('/plugins/admin/affiliate-view-admin-transaction-listTransactionAffiliaterAdmin');
}