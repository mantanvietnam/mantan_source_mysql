<?php 
function bookOnline($input)
{
    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $metaImageMantan;
    global $metaDescriptionMantan;
    global $session;
    global $urlHomes;

    $modelAffiliaters = $controller->loadModel('Affiliaters');
    $modelMembers = $controller->loadModel('Members');
    $modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
    $modelWarehouseHistories = $controller->loadModel('WarehouseHistories');
    $session->write('infoUser', []);

    if(!empty($_GET['aff'])){
        $_GET['aff'] = trim(str_replace(array(' ','.','-'), '', $_GET['aff']));
        $_GET['aff'] = str_replace('+84','0',$_GET['aff']);

        $info = $modelAffiliaters->find()->where(['phone'=> $_GET['aff']])->first();

        if(!empty($info)){
            $metaTitleMantan = $info->name;
            $metaImageMantan = (!empty($info->banner))?$info->banner:$info->avatar;
            $metaDescriptionMantan = strip_tags($info->description);

            // tăng lượt xem
            $info->view ++;
            $modelAffiliaters->save($info);
            $info->view += 1000;

            $system = $modelCategories->find()->where(array('id'=>$info->id_system ))->first();
                
            $info->name_system = @$system->name;
            $info->image_system = @$system->image;

            $members = $modelMembers->find()->where(array('id'=>@$info->id_member))->first();

            if(function_exists('getAllProductActive') && !empty($members)){
                // lấy sản phẩm trong kho
                $conditions = array('id_member'=>$members->id);
                $warehouseProduct = $modelWarehouseProducts->find()->where($conditions)->all()->toList();
                if($members->product_distribution=='allPoduct'){
                    $allProduct = getAllProductActive();
                }else{
                    $allProduct = [];
                    if(!empty($warehouseProduct)){
                        foreach ($warehouseProduct as $product) {
                            if($product->quantity > 0){
                                $infoProduct = getProduct($product->id_product);

                                if(!empty($infoProduct)){
                                    $allProduct[] = $infoProduct;
                                }
                            }
                        }
                    }
                }



                $allCategoryProduct = getAllCategoryProduct();
                $listProduct = [];

                if(!empty($allCategoryProduct)){
                    foreach ($allCategoryProduct as $category) {
                        $listProduct[$category->id]['category'] = $category;
                    }
                }

                if(!empty($allProduct)){
                    foreach ($allProduct as $product) {
                        $listProduct[$product->id_category]['product'][$product->id] = $product;
                    }
                }
                
                setVariable('listProduct', $listProduct);
            }

            $system = $modelCategories->find()->where(array('id'=>$members->id_system ))->first();
                
            $members->name_position = @$position->name;
            $members->name_system = @$system->name;
            $members->image_system = @$system->image;
        
            setVariable('info', $info);
            setVariable('members', $members);
        }else{
            return $controller->redirect('/');
        }
    }else{
        return $controller->redirect('/');
    }
}

function listOrderAffiliater($input){

    global $controller;
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $metaImageMantan;
    global $metaDescriptionMantan;
    global $session;
    global $urlHomes;
    global $urlCurrent;

    $modelAffiliaters = $controller->loadModel('Affiliaters');
    $modelMembers = $controller->loadModel('Members');
    $modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
    $modelWarehouseHistories = $controller->loadModel('WarehouseHistories');

    if(!empty($session->read('infoAff'))){
        $user = $session->read('infoAff');
        $modelProduct = $controller->loadModel('Products');
        $modelOrder = $controller->loadModel('Orders');
        $modelTransactionAffiliateHistorie = $controller->loadModel('TransactionAffiliateHistories');
        $modelOrderDetail = $controller->loadModel('OrderDetails');
        $modelCustomers = $controller->loadModel('Customers');
        $modelUnitConversion = $controller->loadModel('UnitConversions');
        $modelStaff = $controller->loadModel('Staffs');


        $conditions = array('id_aff'=>$user->id);
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
           export_excel($titleExcel,$dataExcel,'danh_sach_don_hang');
        }else{
            $listData = $modelOrder->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        }

        if(!empty($listData)){
            foreach($listData as $key => $item){
                $detail_order = $modelOrderDetail->find()->where(['id_order'=>$item->id])->all()->toList();
                
                if(!empty($detail_order)){
                    foreach ($detail_order as $k => $value) {
                        $product = $modelProduct->find()->where(['id'=>$value->id_product ])->first();
                        if(!empty($product)){
                             $product->unitConversion =   $modelUnitConversion->find()->where(['id_product'=>$value->id_product])->all()->toList();
                            $detail_order[$k]->product = $product;
                            //$detail_order[$k]->price = $product->price;
                        }
                    }

                    $listData[$key]->affiliate = $modelTransactionAffiliateHistorie->find()->where(['id_order'=>$item->id])->first();


                    $listData[$key]->detail_order = $detail_order;
                }

                if(!empty($item->id_staff)){
                $listData[$key]->staff = $modelStaff->find()->where(['id'=>(int) $item->id_staff])->first();

                }
                $listData[$key]->customer = $modelCustomers->find()->where(['id'=>(int) $item->id_user])->first();
            }
        }
        // phân trang
        $totalData = $modelOrder->find()->where($conditions)->all()->toList();
         $totalMoney = 0;
        if(!empty($totalData)){
            foreach ($totalData as $key => $value) {
                $totalMoney += $value->total;
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


        $conditions = array('id_member'=>$user->id);
        $listStaff = $modelStaff->find()->where($conditions)->all()->toList();

        setVariable('listStaff', $listStaff);
        setVariable('page', $page);
        setVariable('totalPage', $totalPage);
        setVariable('back', $back);
        setVariable('next', $next);
        setVariable('urlPage', $urlPage);
        
        setVariable('listData', $listData);
        setVariable('totalMoney', $totalMoney);

    }else{
        return $controller->redirect('/affiliaterLogout');
    }

}
?>