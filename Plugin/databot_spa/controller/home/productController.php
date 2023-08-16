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

    $metaTitleMantan = 'Xóa danh mục sản phẩm';

    if(!empty($session->read('infoUser'))){
        $infoUser = $session->read('infoUser');

        if(!empty($_GET['id'])){
            $conditions = array('id'=> $_GET['id'], 'type' => 'category_product', 'id_member'=>$infoUser->id_member);
            
            $data = $modelCategories->find()->where($conditions)->first();
            
            if(!empty($data)){
                $modelCategories->delete($data);
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

        if(!empty($_GET['id'])){
            $conditions = array('id'=> $_GET['id'], 'id_member'=>$infoUser->id_member);
            
            $data = $modelTrademarks->find()->where($conditions)->first();
            
            if(!empty($data)){
                $modelTrademarks->delete($data);
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
            $conditions['code'] = (int) $_GET['code'];
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
    
    if(!empty($session->read('infoUser'))){
        $infoUser = $session->read('infoUser');

        if(!empty($_GET['id'])){
            $data = $modelProduct->get($_GET['id']);
            
            if($data){
                $modelProduct->delete($data);
            }
        }

        return $controller->redirect('/listProduct');
    }else{
        return $controller->redirect('/login');
    }
}
?>