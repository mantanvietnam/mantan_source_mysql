<?php 
function listCategoryProduct($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $metaTitleMantan = 'Danh sách danh mục sản phẩm';
    if(!empty($session->read('infoUser'))){
        $infoUser = $session->read('infoUser');

        if ($isRequestPost) {
            $dataSend = $input['request']->getData();
            
            // tính ID category
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

            // tạo slug
            $slug = createSlugMantan($infoCategory->name);
            $slugNew = $slug;
            $number = 0;
            do{
                $conditions = array('slug'=>$slugNew,'type'=>'category_product', 'id_member'=>$infoUser->id_member);
                $listData = $modelCategories->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

                if(!empty($listData)){
                    $number++;
                    $slugNew = $slug.'-'.$number;
                }
            }while (!empty($listData));

            $infoCategory->slug = $slugNew;

            $modelCategories->save($infoCategory);

        }

        $conditions = array('type' => 'category_product', 'id_member'=>$infoUser->id_member);
        $listData = $modelCategories->find()->where($conditions)->all()->toList();

        setVariable('listData', $listData);
    }else{
        return $controller->redirect('/login');
    }
}

function deleteCategoryProduct($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $metaTitleMantan = 'Danh sách danh mục sản phẩm';
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

    $metaTitleMantan = 'Danh sách danh mục sản phẩm';
    if(!empty($session->read('infoUser'))){
        $infoUser = $session->read('infoUser');
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
            $data->slug = createSlugMantan($data->name);
            $modelTrademarks->save($data);

        }

        $conditions = array('id_member'=>$infoUser->id_member);
        $listData = $modelTrademarks->find()->where($conditions)->all()->toList();

        setVariable('listData', $listData);
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

    $metaTitleMantan = 'Danh sách danh mục sản phẩm';
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

    $metaTitleMantan = 'Danh sách danh mục sản phẩm';
    if(!empty($session->read('infoUser'))){
        $metaTitleMantan = 'Danh sách mẫu thiết kế  bán';

        $modelMembers = $controller->loadModel('Members');
        $modelProducts = $controller->loadModel('Products');
        $user = $session->read('infoUser');
        
        $modelTrademarks = $controller->loadModel('Trademarks');

        $conditions = array('id_member'=>$user->id_member, 'id_spa'=>$user->id_spa);
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

        if(isset($_GET['status'])){
            if($_GET['status']!=''){
                $conditions['status'] = $_GET['status'];
            }
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

    $metaTitleMantan = 'Danh sách danh mục sản phẩm';
    if(!empty($session->read('infoUser'))){
        $modelMembers = $controller->loadModel('Members');
        $modelProducts = $controller->loadModel('Products');
        $infoUser = $session->read('infoUser');
        
        $modelTrademarks = $controller->loadModel('Trademarks');
        $mess= '';

        // lấy data edit
        if(!empty($_GET['id'])){
            $data = $modelProducts->get( (int) $_GET['id']);

        }else{
            $data = $modelProducts->newEmptyEntity();
             $data->created = getdate()[0];
        }


        if ($isRequestPost) {
            $dataSend = $input['request']->getData();

            if(!empty($dataSend['name'])){
                // tạo dữ liệu save
                $data->name = @$dataSend['name'];
                $data->image = @$dataSend['image'];
                $data->code = @$dataSend['code'];
                $data->id_category =(int) @$dataSend['id_category'];
                $data->description = @$dataSend['description'];
                $data->id_trademark =(int) @$dataSend['id_trademark'];
                $data->id_member = $infoUser->id_member;
                $data->id_spa = (int) $infoUser->id_spa;
                $data->price = (int)@$dataSend['price'];
                $data->price_old = (int) @$dataSend['price_old'];
                $data->hot = (int) @$dataSend['hot'];
                $data->code = @$dataSend['code'];
                $data->status = @$dataSend['status'];
                
                $data->slug = createSlugMantan(trim($dataSend['name']));
                
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
        $listTrademar = $modelTrademarks->find()->where($conditionsTrademar)->all()->toList();

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
    $infoUser = $session->read('infoUser');
    if(!empty($infoUser)){
    
        if(!empty($_GET['id'])){
            $data = $modelProduct->get($_GET['id']);
            
            if($data){
                $modelProduct->delete($data);
            }
        }

        return $controller->redirect('listProduct.php');
    }else{
        return $controller->redirect('/login');
    }
}

?>

