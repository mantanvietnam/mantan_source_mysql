<?php 
function listOrderAffiliateAdmin($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Đơn hàng CTV Affiliate';

    $modelProduct = $controller->loadModel('Products');
    $modelOrder = $controller->loadModel('Orders');
    $modelOrderDetail = $controller->loadModel('OrderDetails');
    $modelAffiliater = $controller->loadModel('Affiliaters');

    $conditions = array('id_aff >'=>0);
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }

    if(!empty($_GET['full_name'])){
        $conditions['full_name LIKE'] = '%'.$_GET['full_name'].'%';
    }

    if(!empty($_GET['phone'])){
        $conditions['phone'] = $_GET['phone'];
    }

    if(!empty($_GET['status'])){
        $conditions['status'] = $_GET['status'];
    }

    if(!empty($_GET['id_user'])){
        $conditions['id_user'] = (int) $_GET['id_user'];
    }

    if(!empty($_GET['id_aff'])){
        $conditions['id_aff'] = (int) $_GET['id_aff'];
    }

    if(!empty($_GET['date_start'])){
        $date_start = explode('/', $_GET['date_start']);
        $conditions['create_at >='] = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
    }

    if(!empty($_GET['date_end'])){
        $date_end = explode('/', $_GET['date_end']);
        $conditions['create_at <='] = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
            
    }

    if(!empty($_GET['action']) && $_GET['action']=='Excel'){
        $listData = $modelOrder->find()->where($conditions)->order($order)->all()->toList();
        $titleExcel =   [
            ['name'=>'Thời gian', 'type'=>'text', 'width'=>25],
            ['name'=>'Họ và tên', 'type'=>'text', 'width'=>25],
            ['name'=>'Số điện thoại', 'type'=>'text', 'width'=>25],
            ['name'=>'Địa chỉ', 'type'=>'text', 'width'=>25],
            ['name'=>'Model', 'type'=>'text', 'width'=>15],
            ['name'=>'Số lượng', 'type'=>'text', 'width'=>35],
            ['name'=>'Màu sắc ', 'type'=>'text', 'width'=>15],
            ['name'=>'Thành tiền ', 'type'=>'text', 'width'=>10],
            ['name'=>'Thu khách ', 'type'=>'text', 'width'=>15],
            ['name'=>'NV chốt ', 'type'=>'text', 'width'=>15],
            ['name'=>'Chú ý', 'type'=>'text', 'width'=>15],
            ['name'=>'Mã vận đơn', 'type'=>'text', 'width'=>15],
            ['name'=>'phí shíp', 'type'=>'text', 'width'=>15],
            ['name'=>'tình trạng', 'type'=>'text', 'width'=>15],    
        ];
        $dataExcel = [];
        if(!empty($listData)){
            foreach ($listData as $key => $value) {
                $discount = '';
                if($value->discount){
                   $pay = json_decode($value->discount, true);

                   if(!empty($pay['code1']) && !empty($pay['discount_price1'])){
                        $discount .=  $pay['code1'] .': -'.number_format($pay['discount_price1']).'đ';
                    }
                    if(!empty($pay['code2']) && !empty($pay['discount_price2'])){
                        $discount .=  $pay['code2'] .': -'.number_format($pay['discount_price2']).'đ';
                    }
                    if(!empty($pay['code3']) && !empty($pay['discount_price3'])){
                        $discount .=  $pay['code3'] .': -'.number_format($pay['discount_price3']).'đ';
                    }
                    if(!empty($pay['code4']) && !empty($pay['discount_price4'])){
                        $discount .=  $pay['code4'] .': -'.number_format($pay['discount_price4']).'đ';
                    }
                }
                $status= '';
                if($value->status=='new'){ 
                    $status= 'Đơn mới';
                 }elseif($value->status=='browser'){
                    $status= 'Đã duyệt';
                 }elseif($value->status=='delivery'){
                    $status= 'Đang giao';
                 }elseif($value->status=='done'){
                    $status= 'Đã xong';
                 }else{
                    $status= 'Đã hủy';
                 }

                $detail_order = $modelOrderDetail->find()->where(['id_order'=>$value->id])->all()->toList();
                if(!empty($detail_order)){
                    foreach ($detail_order as $k => $item) {
                        $product = $modelProduct->find()->where(['id'=>$item->id_product ])->first();
                        if(!empty($product)){
                            $dataExcel[] = [
                                            date('H:i d/m/Y', $value->create_at), 
                                            @$value->full_name,   
                                            @$value->phone,   
                                            @$value->address,   
                                            $product->title,
                                            $item->quantity,
                                            '',
                                            $item->price*$item->quantity,
                                            '', 
                                            '',
                                            @$value->note_user,
                                            @$value->id,
                                            '',
                                            $status,
                                        ];
                        }
                    }
                }
            }
        }
       export_excel($titleExcel,$dataExcel,'danh_sach_don_hang_ctv');
    }else{
        $listData = $modelOrder->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
    }
    if(!empty($listData)){
        foreach($listData as $key => $item){
            // người giới thiệu
            $listData[$key]->aff = $modelAffiliater->find()->where(['id'=>$item->id_aff ])->first();

            // chi tiết đơn hàng
            $detail_order = $modelOrderDetail->find()->where(['id_order'=>$item->id])->all()->toList();
            if(!empty($detail_order)){
                foreach ($detail_order as $k => $value) {
                    $product = $modelProduct->find()->where(['id'=>$value->id_product ])->first();
                    if(!empty($product)){
                        $detail_order[$k]->product = $product->title;
                        $detail_order[$k]->price = $product->price;
                    }
                }

                $listData[$key]->detail_order = $detail_order;
            }
        }
    }

    // phân trang
    $totalData = $modelOrder->find()->where($conditions)->all()->toList();
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

function listOrderMemberAdmin($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Đơn hàng lẻ đại lý';

    $modelProduct = $controller->loadModel('Products');
    $modelOrder = $controller->loadModel('Orders');
    $modelOrderDetail = $controller->loadModel('OrderDetails');
    $modelMember = $controller->loadModel('Members');

    $conditions = array('id_agency >'=>0);
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }

    if(!empty($_GET['full_name'])){
        $conditions['full_name LIKE'] = '%'.$_GET['full_name'].'%';
    }

    if(!empty($_GET['phone'])){
        $conditions['phone'] = $_GET['phone'];
    }

    if(!empty($_GET['status'])){
        $conditions['status'] = $_GET['status'];
    }

    if(!empty($_GET['id_user'])){
        $conditions['id_user'] = (int) $_GET['id_user'];
    }

    if(!empty($_GET['id_agency'])){
        $conditions['id_agency'] = (int) $_GET['id_agency'];
    }

    if(!empty($_GET['date_start'])){
        $date_start = explode('/', $_GET['date_start']);
        $conditions['create_at >='] = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
    }

    if(!empty($_GET['date_end'])){
        $date_end = explode('/', $_GET['date_end']);
        $conditions['create_at <='] = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
            
    }

    if(!empty($_GET['action']) && $_GET['action']=='Excel'){
        $listData = $modelOrder->find()->where($conditions)->order($order)->all()->toList();
        $titleExcel =   [
            ['name'=>'Thời gian', 'type'=>'text', 'width'=>25],
            ['name'=>'Họ và tên', 'type'=>'text', 'width'=>25],
            ['name'=>'Số điện thoại', 'type'=>'text', 'width'=>25],
            ['name'=>'Địa chỉ', 'type'=>'text', 'width'=>25],
            ['name'=>'Model', 'type'=>'text', 'width'=>15],
            ['name'=>'Số lượng', 'type'=>'text', 'width'=>35],
            ['name'=>'Màu sắc ', 'type'=>'text', 'width'=>15],
            ['name'=>'Thành tiền ', 'type'=>'text', 'width'=>10],
            ['name'=>'Thu khách ', 'type'=>'text', 'width'=>15],
            ['name'=>'NV chốt ', 'type'=>'text', 'width'=>15],
            ['name'=>'Chú ý', 'type'=>'text', 'width'=>15],
            ['name'=>'Mã vận đơn', 'type'=>'text', 'width'=>15],
            ['name'=>'Phí shíp', 'type'=>'text', 'width'=>15],
            ['name'=>'Tình trạng', 'type'=>'text', 'width'=>15],    
        ];
        $dataExcel = [];
        if(!empty($listData)){
            foreach ($listData as $key => $value) {
                $discount = '';
                if($value->discount){
                   $pay = json_decode($value->discount, true);

                   if(!empty($pay['code1']) && !empty($pay['discount_price1'])){
                        $discount .=  $pay['code1'] .': -'.number_format($pay['discount_price1']).'đ';
                    }
                    if(!empty($pay['code2']) && !empty($pay['discount_price2'])){
                        $discount .=  $pay['code2'] .': -'.number_format($pay['discount_price2']).'đ';
                    }
                    if(!empty($pay['code3']) && !empty($pay['discount_price3'])){
                        $discount .=  $pay['code3'] .': -'.number_format($pay['discount_price3']).'đ';
                    }
                    if(!empty($pay['code4']) && !empty($pay['discount_price4'])){
                        $discount .=  $pay['code4'] .': -'.number_format($pay['discount_price4']).'đ';
                    }
                }
                $status= '';
                if($value->status=='new'){ 
                    $status= 'Đơn mới';
                 }elseif($value->status=='browser'){
                    $status= 'Đã duyệt';
                 }elseif($value->status=='delivery'){
                    $status= 'Đang giao';
                 }elseif($value->status=='done'){
                    $status= 'Đã xong';
                 }else{
                    $status= 'Đã hủy';
                 }

                $detail_order = $modelOrderDetail->find()->where(['id_order'=>$value->id])->all()->toList();
                if(!empty($detail_order)){
                    foreach ($detail_order as $k => $item) {
                        $product = $modelProduct->find()->where(['id'=>$item->id_product ])->first();
                        if(!empty($product)){
                            $dataExcel[] = [
                                            date('H:i d/m/Y', $value->create_at), 
                                            @$value->full_name,   
                                            @$value->phone,   
                                            @$value->address,   
                                            $product->title,
                                            $item->quantity,
                                            '',
                                            $item->price*$item->quantity,
                                            '', 
                                            '',
                                            @$value->note_user,
                                            @$value->id,
                                            '',
                                            $status,
                                        ];
                        }
                    }
                }
            }
        }
       export_excel($titleExcel,$dataExcel,'danh_sach_don_hang_le_dai_ly');
    }else{
        $listData = $modelOrder->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
    }

    if(!empty($listData)){
        foreach($listData as $key => $item){
            // người giới thiệu
            $listData[$key]->member = $modelMember->find()->where(['id'=>$item->id_agency ])->first();

            // chi tiết đơn hàng
            $detail_order = $modelOrderDetail->find()->where(['id_order'=>$item->id])->all()->toList();
            if(!empty($detail_order)){
                foreach ($detail_order as $k => $value) {
                    $product = $modelProduct->find()->where(['id'=>$value->id_product ])->first();
                    if(!empty($product)){
                        $detail_order[$k]->product = $product->title;
                        $detail_order[$k]->price = $product->price;
                    }
                }

                $listData[$key]->detail_order = $detail_order;
            }
        }
    }

    // phân trang
    $totalData = $modelOrder->find()->where($conditions)->all()->toList();
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

function listOrderSystemAdmin($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Đơn hàng trong hệ thống';

    $modelProducts = $controller->loadModel('Products');
    $modelMembers = $controller->loadModel('Members');
    $modelOrderMembers = $controller->loadModel('OrderMembers');
    $modelOrderMemberDetails = $controller->loadModel('OrderMemberDetails');

    $conditions = array();
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }

    // số điện thoại đại lý bán
    if(!empty($_GET['phone_sell'])){
        $checkMember = $modelMembers->find()->where(['phone'=>$_GET['phone_sell']])->first();

        if(!empty($checkMember)){
            $conditions['id_member_sell'] = $checkMember->id;
        }
    }

    // số điện thoại đại lý mua
    if(!empty($_GET['phone_buy'])){
        $checkMember = $modelMembers->find()->where(['phone'=>$_GET['phone_buy']])->first();

        if(!empty($checkMember)){
            $conditions['id_member_buy'] = $checkMember->id;
        }
    }

    if(!empty($_GET['status'])){
        $conditions['status'] = $_GET['status'];
    }

    if(!empty($_GET['status_pay'])){
        $conditions['status_pay'] = $_GET['status_pay'];
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
            // người bán
            $listData[$key]->member_sell = $modelMembers->find()->where(['id'=>$item->id_member_sell])->first();

            // người mua
            $listData[$key]->member_buy = $modelMembers->find()->where(['id'=>$item->id_member_buy])->first();

            // chi tiết đơn hàng
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
}