<?php 
function listCategoryProduct($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $metaTitleMantan = 'Danh sách danh mục sản phẩm';
    
    if(!empty($session->read('infoUser'))){
        $infoUser = $session->read('infoUser');

        $mess = '';
        if(!empty($_GET['error'])){
            switch ($_GET['error']) {
                case 'requestCategoryProduct':
                    $mess= '<p class="text-danger">Bạn cần tạo nhóm sản phẩm trước</p>';
                    break;
                case 'requestCategoryDelete':
                    $mess= '<p class="text-danger">Bạn không được xóa danh mục này</p>';
                    break;

                case 'requestCategoryDeleteSuccess':
                    $mess= '<p class="text-success">Bạn xóa thành công</p>';
                    break;    
            }
        }

        if ($isRequestPost) {
            $dataSend = $input['request']->getData();
            
            if(!empty($dataSend['idCategoryEdit'])){
                $infoCategory = $modelCategories->get( (int) $dataSend['idCategoryEdit']);
            }else{
                $infoCategory = $modelCategories->newEmptyEntity();
            }

            // tạo dữ liệu save
            $infoCategory->name = str_replace(array('"', "'"), '’', $dataSend['name']);
            $infoCategory->parent = 0;
            $infoCategory->image = $dataSend['image'];
            $infoCategory->id_member = $infoUser->id_member;
            $infoCategory->keyword = str_replace(array('"', "'"), '’', $dataSend['keyword']);
            $infoCategory->description = str_replace(array('"', "'"), '’', $dataSend['description']);
            $infoCategory->type = 'category_product';
            $infoCategory->slug = createSlugMantan($infoCategory->name).'-'.time();
            $modelCategories->save($infoCategory);

            $mess= '<p class="text-success">Lưu thông tin thành công</p>';
        }

        $conditions = array('type' => 'category_product', 'id_member'=>$infoUser->id_member);
        $listData = $modelCategories->find()->where($conditions)->all()->toList();

        setVariable('listData', $listData);
        setVariable('mess', $mess);
    }else{
        return $controller->redirect('/login');
    }
}

function deleteCategoryProduct($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;

    $metaTitleMantan = 'Xóa danh mục sản phẩm';

    if(!empty($session->read('infoUser'))){
        $infoUser = $session->read('infoUser');
        $modelProducts = $controller->loadModel('Products');

        if(!empty($_GET['id'])){
            $conditions = array('id'=> $_GET['id'], 'type' => 'category_product', 'id_member'=>$infoUser->id_member);

            
            $data = $modelCategories->find()->where($conditions)->first();

            $checkProduct = $modelProducts->find()->where(array('id_category'=>$data->id))->all()->toList();
            if(empty($checkProduct)){
            
                if(!empty($data)){
                    $modelCategories->delete($data);
                    return array('code'=>1);
                }else{
                     return array('code'=>0);
                 }
            }else{
                 return array('code'=>0);
            }
        }
    }else{
        return $controller->redirect('/login');
    }
}

function listTrademarkProduct($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;

    $metaTitleMantan = 'Nhãn hiệu sản phẩm';

    if(!empty($session->read('infoUser'))){
        $infoUser = $session->read('infoUser');

        $mess = '';
        if(!empty($_GET['error'])){
            switch ($_GET['error']) {
                case 'requestCategoryTrademark':
                    $mess= '<p class="text-danger">Bạn cần tạo nhãn hiệu sản phẩm trước</p>';
                    break;
                case 'requestTrademarkDelete':
                    $mess= '<p class="text-danger">Bạn không được xóa nhãn hiệu này</p>';
                    break;

                case 'requestTrademarkDeleteSuccess':
                    $mess= '<p class="text-success">Bạn xóa thành công</p>';
                    break;
            }
        }
        
        $modelTrademarks = $controller->loadModel('Trademarks');

        if ($isRequestPost) {
            $dataSend = $input['request']->getData();
            
            // tính ID category
            if(!empty($dataSend['idEdit'])){
                $data = $modelTrademarks->get( (int) $dataSend['idEdit']);
            }else{
                $data = $modelTrademarks->newEmptyEntity();
                $data->created_at =date('Y-m-d H:i:s');
            }

            // tạo dữ liệu save
            $data->name = str_replace(array('"', "'"), '’', $dataSend['name']);
            $data->image = $dataSend['image'];
            $data->id_member = $infoUser->id_member;
            $data->description = str_replace(array('"', "'"), '’', $dataSend['description']);
            // tạo slug
            $data->slug = createSlugMantan($data->name).'-'.time();
            $modelTrademarks->save($data);

            $mess= '<p class="text-success">Lưu thông tin thành công</p>';

        }

        $conditions = array('id_member'=>$infoUser->id_member);
        $listData = $modelTrademarks->find()->where($conditions)->all()->toList();

        setVariable('listData', $listData);
        setVariable('mess', $mess);
    }else{
        return $controller->redirect('/login');
    }
}

function deleteTrademarkProduct($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;

    $metaTitleMantan = 'Xóa nhãn hiệu sản phẩm';
    if(!empty($session->read('infoUser'))){
        $infoUser = $session->read('infoUser');

        $modelTrademarks = $controller->loadModel('Trademarks');

        $modelProducts = $controller->loadModel('Products');

        if(!empty($_GET['id'])){
            $conditions = array('id'=> $_GET['id'], 'id_member'=>$infoUser->id_member);
            
            $data = $modelTrademarks->find()->where($conditions)->first();

            $checkProduct = $modelProducts->find()->where(array('id_trademark'=>$data->id))->all()->toList();
            if(empty($checkProduct)){
                if(!empty($data)){
                    $modelTrademarks->delete($data);
                    return array('code'=>1);
                }else{
                     return array('code'=>0);
                 }
            }else{
                 return array('code'=>0);
            }
        }
    }else{
        return $controller->redirect('/login');
    }
}

function listProduct(){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    $metaTitleMantan = 'Danh sách sản phẩm';
    
    if(!empty($session->read('infoUser'))){

        $mess= '';
        
        if(!empty($_GET['error'])){
            switch ($_GET['error']) {
                case 'requestProduct':
                    $mess= '<p class="text-danger">Bạn cần tạo sản phẩm trước</p>';
                    break;
                case 'requestDelete':
                    $mess= '<p class="text-danger">Bạn không được xóa sản phẩm này</p>';
                    break;
                case 'requestDeleteSuccess':
                    $mess= '<p class="text-success">Bạn xóa thành công</p>';
                    break;
            }
        }

        $modelMembers = $controller->loadModel('Members');
        $modelProducts = $controller->loadModel('Products');
        $modelTrademarks = $controller->loadModel('Trademarks');
        
        $user = $session->read('infoUser');

        $conditions = array('id_member'=>$user->id_member, 'id_spa'=>$session->read('id_spa'));
        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        $order = array('id'=>'desc');

        if(!empty($_GET['code'])){
            $conditions['code'] =  $_GET['code'];
        }

        if(!empty($_GET['id_category'])){
            $conditions['id_category'] = $_GET['id_category'];
        }

        if(!empty($_GET['id_trademark'])){
            $conditions['id_trademark'] = $_GET['id_trademark'];
        }

        if(!empty($_GET['status'])){
            $conditions['status'] = $_GET['status'];
        }

        if(!empty($_GET['name'])){
            $conditions['name LIKE'] = '%'.$_GET['name'].'%';
        }

       
        $listData = $modelProducts->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

        $totalData = $modelProducts->find()->where($conditions)->all()->toList();
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

        $conditionsCategorie = array('type' => 'category_product', 'id_member'=>$user->id_member);
        $order = array('name'=>'asc');
        $listCategory = $modelCategories->find()->where($conditionsCategorie)->order($order)->all()->toList();

        $conditionsTrademar = array('id_member'=>$user->id_member);
        $listTrademar = $modelTrademarks->find()->where($conditionsTrademar)->all()->toList();

        setVariable('page', $page);
        setVariable('totalPage', $totalPage);
        setVariable('back', $back);
        setVariable('next', $next);
        setVariable('urlPage', $urlPage);
        setVariable('totalData', $totalData);
        
        setVariable('listData', $listData);
        setVariable('listCategory', $listCategory);
        setVariable('listTrademar', $listTrademar);
        setVariable('mess', $mess);
    }else{
        return $controller->redirect('/login');
    }
}

function addProduct($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;
    global $urlHomes;

    $metaTitleMantan = 'Thông tin sản phẩm';
    
    if(!empty($session->read('infoUser'))){
        $modelMembers = $controller->loadModel('Members');
        $modelProducts = $controller->loadModel('Products');
        $modelTrademarks = $controller->loadModel('Trademarks');

        $infoUser = $session->read('infoUser');
        $mess= '';

        // lấy data edit
        if(!empty($_GET['id'])){
            $data = $modelProducts->get( (int) $_GET['id']);

        }else{
            $data = $modelProducts->newEmptyEntity();
            $data->created_at = date('Y-m-d H:i:s');
            $data->quantity = 0;
        }

        if ($isRequestPost) {
            $dataSend = $input['request']->getData();

            if(!empty($dataSend['name'])){
                if(empty($dataSend['code'])) $dataSend['code'] = createToken(10);
                if(empty($dataSend['image'])) $dataSend['image'] = $urlHomes.'/plugins/databot_spa/view/home/assets/img/default-thumbnail.jpg';

                // tạo dữ liệu save
                $data->name = @$dataSend['name'];
                $data->image = @$dataSend['image'];
                $data->code = @$dataSend['code'];
                $data->id_category =(int) @$dataSend['id_category'];
                $data->description = @$dataSend['description'];
                $data->id_trademark =(int) @$dataSend['id_trademark'];
                $data->id_member = $infoUser->id_member;
                $data->id_spa = (int) $session->read('id_spa');
                $data->price = (int)@$dataSend['price'];
                $data->status = $dataSend['status'];
                $data->updated_at = date('Y-m-d H:i:s');
                $data->commission_staff_fix = (int) @$dataSend['commission_staff_fix'];
                $data->commission_staff_percent = (int) @$dataSend['commission_staff_percent'];
                $data->commission_affiliate_fix = (int) @$dataSend['commission_affiliate_fix'];
                $data->commission_affiliate_percent = (int) @$dataSend['commission_affiliate_percent'];
                
                $data->slug = createSlugMantan(trim($dataSend['name'])).'-'.time();
                
                $modelProducts->save($data);

                $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

                if(!empty($_GET['id'])){
                    return $controller->redirect('/listProduct?mess=2');
                }else{
                    return $controller->redirect('/listProduct?mess=1');
                }
                
            }else{
                $mess= '<p class="text-danger">Bạn chưa nhập tên</p>';
            }
        }
        
        $conditionsCategorie = array('type' => 'category_product', 'id_member'=>$infoUser->id_member);
        $order = array('name'=>'asc');
        $listCategory = $modelCategories->find()->where($conditionsCategorie)->order($order)->all()->toList();

        $conditionsTrademar = array('id_member'=>$infoUser->id_member);
        $order = array('name'=>'asc');
        $listTrademar = $modelTrademarks->find()->where($conditionsTrademar)->order($order)->all()->toList();

        if(empty($listCategory)){
            return $controller->redirect('/listCategoryProduct/?error=requestCategoryProduct');
        }

        if(empty($listTrademar)){
            return $controller->redirect('/listTrademarkProduct/?error=requestCategoryTrademark');
        }

        setVariable('data', $data);
        setVariable('listCategory', $listCategory);
        setVariable('listTrademar', $listTrademar);
    }else{
        return $controller->redirect('/login');
    }
}

function deleteProduct($input){
    global $controller;
    global $session;
    
    $modelProduct = $controller->loadModel('Products');
    $modelOrderDetails = $controller->loadModel('OrderDetails');
    $modelWarehouseProducts = $controller->loadModel('WarehouseProductDetails');
    $modelCombo = $controller->loadModel('Combos');
    
    if(!empty($session->read('infoUser'))){
        $infoUser = $session->read('infoUser');

        if(!empty($_GET['id'])){
            $data = $modelProduct->get($_GET['id']);
            $checkOrder = $modelOrderDetails->find()->where(array('id_product'=>$data->id,'type'=>'product','id_member'=>$infoUser->id_member))->all()->toList();

            if(!empty($checkOrder)){
                return $controller->redirect('/listProduct?error=requestDelete');

            }

            $checkWarehouseProducts = $modelWarehouseProducts->find()->where(array('id_product'=>$data->id,'id_member'=>$infoUser->id_member))->all()->toList();

            $checkCombo = $modelCombo->find()->where(array('id_member'=>$infoUser->id_member))->all()->toList();

            if(!empty($checkCombo)){
                foreach($checkCombo as $key => $item){
                    if(!empty($item->product)){
                        $product = json_decode(@$item->product, true);
                        foreach($product as $k => $value){
                            if($k==$data->id){
                                return $controller->redirect('/listProduct?error=requestDelete');
                            }
                        }
                    }
                }
            }

            if(!empty($checkWarehouseProducts)){
                return $controller->redirect('/listProduct?error=requestDelete');

            }
            if($data){
                $modelProduct->delete($data);
                return $controller->redirect('/listProduct?error=requestDeleteSuccess');
            }
        }

        return $controller->redirect('/listProduct');
    }else{
        return $controller->redirect('/login');
    }
}

function addProductWarehouse($input){
    global $isRequestPost;
    global $metaTitleMantan;
    global $session;
    global $controller;

    $metaTitleMantan = 'Thông tin sản phẩm';
    
    if(!empty($session->read('infoUser'))){
        $modelMembers = $controller->loadModel('Members');
        $modelProducts = $controller->loadModel('Products');
        $modelWarehouses = $controller->loadModel('Warehouses');
        $modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
        $modelWarehouseProductDetails = $controller->loadModel('WarehouseProductDetails');
        $modelBill = $controller->loadModel('Bills');
        $modelDebts = $controller->loadModel('Debts');
        $modelPartner = $controller->loadModel('Partners');

        $user = $session->read('infoUser');

        $conditionsWarehouse = array('id_member'=>$user->id_member, 'id_spa'=>$session->read('id_spa'));
        $listWarehouse = $modelWarehouses->find()->where($conditionsWarehouse)->all()->toList();

        if ($isRequestPost) {
            $dataSend = $input['request']->getData();

            $warehouse = $modelWarehouses->get($dataSend['idWarehouse']);
            $dataWP = $modelWarehouseProducts->newEmptyEntity();
            $dataWP->id_member = $user->id_member;
            $dataWP->id_spa = $user->id_spa;
            $dataWP->id_staff = $user->id;
            $dataWP->id_warehouse = $dataSend['idWarehouse'];
            $dataWP->created_at =  date('Y-m-d H:i:s');
            $dataWP->id_partner = $dataSend['idPartner'];

            $modelWarehouseProducts->save($dataWP);

            $total = 0;

            foreach($dataSend['idHangHoa'] as $key => $value){
                $total += (int)$dataSend['price'][$key]* (int)$dataSend['soluong'][$key];
                $product = $modelWarehouseProductDetails->newEmptyEntity();

                $product->id_member = $user->id_member;
                $product->id_warehouse_product = $dataWP->id;
                $product->id_warehouse = $dataWP->id_warehouse;
                $product->id_product = $value;
                $product->impor_price = (int) $dataSend['price'][$key];
                $product->quantity = (int) $dataSend['soluong'][$key];
                $product->inventory_quantity = (int) $dataSend['soluong'][$key];
                $product->created_at =  date('Y-m-d H:i:s');

                $modelWarehouseProductDetails->save($product);

                $pro = $modelProducts->get($value);
                $pro->quantity += (int)$dataSend['soluong'][$key]; 
                $modelProducts->save($pro);

            }
            

            if($dataSend['typeBill']=='cong_no'){
                // lưu vào công nợ
                $debt = $modelDebts->newEmptyEntity();
                
                $debt->created_at = date('Y-m-d H:i:s');
                $debt->status = 0;
                $debt->time = time();
                $debt->id_member = @$user->id_member;
                $debt->id_spa = $session->read('id_spa');
                $debt->id_staff = $user->id;
                $debt->total = (int) $total;
                $debt->note =  'nhập lô hàng có ID là '.$dataWP->id.' vào kho '.$warehouse->name.' ngày '. date('Y-m-d H:i:s');
                $debt->type = 1; //0: Thu, 1: chi
                $debt->updated_at = date('Y-m-d H:i:s');
                $debt->id_customer = (int)@$dataSend['idPartner'];
                $debt->full_name = @$dataSend['partner_name'];
                $debt->id_warehouse_product = $dataWP->id;

                $modelDebts->save($debt);
            }else{
                // lưu vào bill 
                $bill = $modelBill->newEmptyEntity();
                
                $bill->created_at = date('Y-m-d H:i:s');
                $bill->time = time();
                $bill->id_member = @$user->id_member;
                $bill->id_spa = $session->read('id_spa');
                $bill->id_staff = $user->id;
                $bill->total = (int) $total;
                $bill->note = 'nhập lô hàng có ID là '.$dataWP->id.' vào kho '.$warehouse->name.' ngày '. date('Y-m-d H:i:s');
                $bill->type = 1; //0: Thu, 1: chi
                $bill->updated_at = date('Y-m-d H:i:s');
                $bill->type_collection_bill = $dataSend['typeBill'];
                $bill->id_customer = (int)@$dataSend['idPartner'];
                $bill->full_name = @$dataSend['partner_name'];
                $bill->id_warehouse_product = $dataWP->id;

                $modelBill->save($bill);

            }
             return $controller->redirect('/importHistorytWarehouse');
        }

        $order = array('name'=>'asc');

        $conditionsProduct = array('id_member'=>$user->id_member,'id_spa'=>$session->read('id_spa'));
        $listProduct = $modelProducts->find()->where($conditionsProduct)->order($order)->all()->toList();

        if(empty($listProduct)){
            return $controller->redirect('/listProduct/?error=requestProduct');
        }

        $conditionsWarehouse = array('id_member'=>$user->id_member,'id_spa'=>$session->read('id_spa'));
        $listWarehouse = $modelWarehouses->find()->where($conditionsWarehouse)->order($order)->all()->toList();

        if(empty($listWarehouse)){
            return $controller->redirect('/listWarehouse/?error=requestWarehouse');
        }

        $conditionsPartner = array('id_member'=>$user->id_member);
        $listPartner = $modelPartner->find()->where($conditionsPartner)->order($order)->all()->toList();

        if(empty($listWarehouse)){
            return $controller->redirect('/listPartner/?error=requestPartner');
        }



        setVariable('listWarehouse', $listWarehouse);
    }else{
        return $controller->redirect('/login');
    }
}

function importHistorytWarehouse($input){
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    $metaTitleMantan = 'Lịch sử nhập hàng vào kho';
    
    if(!empty($session->read('infoUser'))){
        $modelMembers = $controller->loadModel('Members');
        $modelProducts = $controller->loadModel('Products');
        $modelWarehouses = $controller->loadModel('Warehouses');
        $modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
        $modelWarehouseProductDetails = $controller->loadModel('WarehouseProductDetails');
        $modelPartner = $controller->loadModel('Partners');

        $user = $session->read('infoUser');

        $conditions = array('WarehouseProducts.id_member'=>$user->id_member, 'WarehouseProducts.id_spa'=>$session->read('id_spa'));
        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        $order = array('WarehouseProducts.id'=>'desc');

        if(!empty($_GET['id'])){
            $conditions['WarehouseProducts.id'] = $_GET['id'];
        }

        if(!empty($_GET['id_Warehouse'])){
            $conditions['id_warehouse'] = $_GET['id_Warehouse'];
        }

        if(!empty($_GET['id_partner'])){
            $conditions['id_partner'] = $_GET['id_partner'];
        }

        if(empty($_GET['searchProduct'])){
            $_GET['id_product'] = '';
        }

        if(!empty($_GET['id_product'])){
            $conditions['wpd.id_product'] = $_GET['id_product'];
        
            $listData = $modelWarehouseProducts->find()->join([
                            'table' => 'warehouse_product_details',
                            'alias' => 'wpd',
                            'type' => 'INNER',
                            'conditions' => 'wpd.id_warehouse_product = WarehouseProducts.id',
                        ])->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

            $totalData = $modelWarehouseProducts->find()->join([
                            'table' => 'warehouse_product_details',
                            'alias' => 'wpd',
                            'type' => 'INNER',
                            'conditions' => 'wpd.id_warehouse_product = WarehouseProducts.id',
                        ])->where($conditions)->all()->toList();
            $totalData = count($totalData);
        }else{
            $listData = $modelWarehouseProducts->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

            $totalData = $modelWarehouseProducts->find()->where($conditions)->all()->toList();
            $totalData = count($totalData);
        }

        if(!empty($listData)){
            foreach($listData as $key => $item){
                $listData[$key]->Warehouse = $modelWarehouses->find()->where(array('id'=>$item->id_warehouse))->first();
                $listData[$key]->parent = $modelPartner->find()->where(array('id'=>$item->id_partner))->first();
                $conditionDetailed = array('id_warehouse_product'=>$item->id);

                if(!empty($_GET['id_product'])){
                    $conditionDetailed['id_product'] = $_GET['id_product'];
                }

                $product = $modelWarehouseProductDetails->find()->where($conditionDetailed)->all()->toList();
                if(!empty($product)){
                    foreach($product as $k => $value){
                        $product[$k]->prod = $modelProducts->find()->where(array('id'=>$value->id_product))->first();

                    }
                    $listData[$key]->product = $product;

                }
            }
        }

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

        $order = array('name'=>'asc');

        $conditionsWarehouse = array('id_member'=>$user->id_member,'id_spa'=>$session->read('id_spa'));
        $listWarehouse = $modelWarehouses->find()->where($conditionsWarehouse)->all()->toList();

        setVariable('page', $page);
        setVariable('totalPage', $totalPage);
        setVariable('back', $back);
        setVariable('next', $next);
        setVariable('urlPage', $urlPage);
        setVariable('totalData', $totalData);
        
        setVariable('listData', $listData);
        setVariable('listWarehouse', $listWarehouse);
        setVariable('mess', @$mess);

    }else{
        return $controller->redirect('/login');
    }
}


?>