<?php
function product($input)
{
	global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;
	global $metaKeywordsMantan;
	global $metaDescriptionMantan;
	global $metaImageMantan;
    global $session;

    $metaTitleMantan = 'Chi tiết sản phẩm';

    $modelProduct = $controller->loadModel('Products');
    $modelQuestion = $controller->loadModel('QuestionProducts');
    $modelDiscountCodes = $controller->loadModel('DiscountCodes');
    $modelEvaluate = $controller->loadModel('Evaluates');
    $modelView = $controller->loadModel('Views');
    $modelCategorieProduct = $controller->loadModel('CategorieProducts');

    if(!empty($_GET['id']) || !empty($input['request']->getAttribute('params')['pass'][1])){
        if(!empty($_GET['id'])){
            $conditions = array('id'=>$_GET['id']);
        }else{
            $slug= str_replace('.html', '', $input['request']->getAttribute('params')['pass'][1]);
            $conditions = array('slug'=>$slug);
        }

        $conditions['status'] = 'active';
        
        $product = $modelProduct->find()->where($conditions)->first();

        if(!empty($product)){
            $product->view ++;
            $modelProduct->save($product);

            if(!empty($session->read('infoUser'))){
                $infoUser = $session->read('infoUser');

                $checkview = $modelView->find()->where(['id_customer'=>$infoUser->id,'id_product'=>$product->id])->first();
                if(empty($checkview)){
                    $view = $modelView->newEmptyEntity();
                    $view->id_customer = $infoUser->id;
                    $view->id_product = $product->id;
                    $modelView->save($view);
                }
            }
        	$metaTitleMantan = $product->title;
        	$metaImageMantan = $product->image;
        	$metaKeywordsMantan = $product->keyword;
        	$metaDescriptionMantan = $product->description;
            
            $product->images = json_decode($product->images, true);
            if(!empty($product->evaluate)){
                $product->evaluate = json_decode(@$product->evaluate, true);
            }


            $conditionsCategorie = ['id_product'=>$product->id];
            $category = $modelCategorieProduct->find()->where(array($conditionsCategorie))->all()->toList();
            if(!empty($category)){
                foreach ($category as $key => $item) {
                    if(!empty($item->id_category)){
                        $category[$key]->name_category = @$modelCategories->find()->where(array('id'=>$item->id_category))->first()->name;
                          
                    }

                         
    
                }
                $product->category = $category;
            }

            // SẢN PHẨM KHÁC
            $category = $modelCategorieProduct->find()->where(array('id_product'=> $product->id))->first();

            if(!empty($category)){
                $conditions = array('Products.id !='=>$product->id, 'cp.id_category'=>@$category->id_category, 'status'=>'active');
			}else{
                $conditions = array('Products.id !='=>$product->id, 'status'=>'active');
            }

            $limit = 4;
			$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
			if($page<1) $page = 1;
		    $order = array('Products.id'=>'desc');

            $product->question = $modelQuestion->find()->where(['id_product'=>$product->id])->all()->toList();
            $product->evaluates = $modelEvaluate->find()->where(['id_product'=>$product->id])->all()->toList();
            $product->evaluatecount = count($modelEvaluate->find()->where(['id_product'=>$product->id])->all()->toList());


            $DiscountCode = $modelDiscountCodes->find()->where(['status'=>1])->all()->toList();
            $CodeDiscount = array();
            foreach($DiscountCode as $key => $item){
                if(!empty($item->id_product)){
                    $discount = explode(',', $item->id_product);
                   
                    if(in_array($product->id, $discount)){
                        $CodeDiscount[] = $item; 
                    }
                }
            }
           
            $product->discountCode = $DiscountCode;

            $point = 0;
            if(!empty($product->evaluates)){
                foreach($product->evaluates as $key => $item){
                    $point += $item->point;
                }
            }
            if(!empty($product->evaluatecount)){
                $product->point = $point/$product->evaluatecount;
            }
            
            $product->question0 = $modelQuestion->find()->where(['id_product'=>0])->all()->toList();
		     $present = array();

            if(!empty($product->id_product)){
                $id_product = explode(',', @$product->id_product);
               
                foreach($id_product as $item){
                    $presentf = $modelProduct->find()->where(['code'=>$item])->first();
                    if(!empty($presentf)){
                        $present[] = $presentf;
                    }
                }
            }

            $product->present = $present;

		    $other_product = $modelProduct->find()
                        ->join([
                            'table' => 'categorie_products',
                            'alias' => 'cp',
                            'type' => 'INNER',
                            'conditions' => 'cp.id_product = Products.id',
                        ])
                        ->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();;

            if(!empty($other_product)){
                foreach($other_product as $key => $item){
                    $other_product[$key]->evaluatecount = count($modelEvaluate->find()->where(['id_product'=>$item->id])->all()->toList());
                    $other_product[$key]->evaluate = $modelEvaluate->find()->where(['id_product'=>$item->id])->all()->toList();

                    $point = 0;
                    if(!empty($other_product[$key]->evaluate)){
                        foreach($other_product[$key]->evaluate as $k => $s){
                            $point += $s->point;
                        }
                    }

                    if(!empty($other_product[$key]->evaluatecount)){

                        $other_product[$key]->point = $point/$other_product[$key]->evaluatecount;
                    }
                }
            }
            
            // NHÀ SẢN XUẤT
            $manufacturer = $modelCategories->find()->where(['id'=>$product->id_manufacturer])->first();

            // DANH MỤC SẢN PHẨM
            // /$category = $modelCategories->find()->where(['id'=>$product->id_category])->first();

            // LƯU LỊCH SỬ XEM
            if(empty($session->read('product_view'))){
                $list_product_view[$product->id] = $product;
                $session->write('product_view', $list_product_view);
            }else{
                $list_product_view = $session->read('product_view');

                if(empty($list_product_view[$product->id])){
                    $list_product_view[$product->id] = $product;
                    $session->write('product_view', $list_product_view);
                }
            }
            
            
            setVariable('product', $product);
            setVariable('other_product', $other_product);
            // setVariable('category', $category);
            setVariable('manufacturer', $manufacturer);
            setVariable('list_product_view', $list_product_view);
        }else{
            return $controller->redirect('/');
        }
    }else{
        return $controller->redirect('/');
    }
}

function allProduct($input)
{
    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;
    global $metaKeywordsMantan;
    global $metaDescriptionMantan;
    global $metaImageMantan;

    $metaTitleMantan = 'Tất cả sản phẩm';

    $modelProduct = $controller->loadModel('Products');
    $modelEvaluate = $controller->loadModel('Evaluates');

    $conditions = ['status'=>'active'];
    $limit = 12;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');

    
    $list_product = $modelProduct->find()->where($conditions)->order($order)->all()->toList();

    if(!empty($list_product)){
        foreach($list_product as $key => $item){
            $list_product[$key]->evaluatecount = count($modelEvaluate->find()->where(['id_product'=>$item->id])->all()->toList());
            $list_product[$key]->evaluate = $modelEvaluate->find()->where(['id_product'=>$item->id])->all()->toList();

            $point = 0;
            if(!empty($list_product[$key]->evaluate)){
                foreach($list_product[$key]->evaluate as $k => $s){
                    $point += $s->point;
                }
            }

            if(!empty($list_product[$key]->evaluatecount)){

                $list_product[$key]->point = $point/$list_product[$key]->evaluatecount;
            }
        }
    }

    // phân trang
    $totalData = $modelProduct->find()->where($conditions)->all()->toList();
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

    $conditions = array('type' => 'category_product', 'status'=>'active');
    $category_all = $modelCategories->find()->where($conditions)->all()->toList();

    $conditions = array('type' => 'manufacturer_product');
    $manufacturer_all = $modelCategories->find()->where($conditions)->all()->toList();

    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    setVariable('totalData', $totalData);
    
    setVariable('list_product', $list_product);
    setVariable('category_all', $category_all);
    setVariable('manufacturer_all', $manufacturer_all);
}

function search($input)
{
    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;
    global $metaKeywordsMantan;
    global $metaDescriptionMantan;
    global $metaImageMantan;

    $metaTitleMantan = 'Tìm kiếm sản phẩm';

    $modelProduct = $controller->loadModel('Products');
    $modelEvaluate = $controller->loadModel('Evaluates');

    $conditions = ['status'=>'active'];
    $limit = 12;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc'); 
    
    if(!empty($_GET['order'])){
       switch ($_GET['order']) {
            case '1':$order = array('sold'=>'desc');break;
            case '2':$order = array('price'=>'desc');break;
            case '3':$order = array('price'=>'asc');break;
            case '4':$order = array('id'=>'desc');break;
        }
    }else{
        $order = array('id'=>'desc'); 
    }

    if(!empty($_GET['key'])){
        $conditions['OR'] = [
                                ['title LIKE'=>'%'.$_GET['key'].'%'],
                                ['keyword LIKE'=>'%'.$_GET['key'].'%']
                            ];
    }

    if(!empty($_GET['sela'])){
        $conditions['flash_sale'] = 1;
    }

    if(!empty($_GET['category'])){
        $conditions['id_category IN'] = $_GET['category'];
    }

    if(!empty($_GET['manufacturer'])){
        $conditions['id_manufacturer IN'] = $_GET['manufacturer'];
    }

    if(!empty($_GET['min-value'])){
        $conditions['price >='] = (int) $_GET['min-value'];
    }

    if(!empty($_GET['max-value'])){
        $conditions['price <='] = (int) $_GET['max-value'];
    }
    $list_product = $modelProduct->find()->where($conditions)->order($order)->all()->toList();

    if(!empty($list_product)){
        foreach($list_product as $key => $item){
            $list_product[$key]->evaluatecount = count($modelEvaluate->find()->where(['id_product'=>$item->id])->all()->toList());
            $list_product[$key]->evaluate = $modelEvaluate->find()->where(['id_product'=>$item->id])->all()->toList();

            $point = 0;
            if(!empty($list_product[$key]->evaluate)){
                foreach($list_product[$key]->evaluate as $k => $s){
                    $point += $s->point;
                }
            }

            if(!empty($list_product[$key]->evaluatecount)){

                $list_product[$key]->point = $point/$list_product[$key]->evaluatecount;
            }
        }
    }


    // phân trang
    $totalData = $modelProduct->find()->where($conditions)->all()->toList();
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

    $conditions = array('type' => 'category_product', 'status'=>'active');
    $category_all = $modelCategories->find()->where($conditions)->all()->toList();

    $conditions = array('type' => 'manufacturer_product');
    $manufacturer_all = $modelCategories->find()->where($conditions)->all()->toList();

    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    setVariable('totalData', $totalData);
    
    setVariable('list_product', $list_product);
    setVariable('category_all', $category_all);
    setVariable('manufacturer_all', $manufacturer_all);
}

function sela($input)
{
    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;
    global $metaKeywordsMantan;
    global $metaDescriptionMantan;
    global $metaImageMantan;

    $metaTitleMantan = 'Sản phẩm khuyến Mãi';

    $modelProduct = $controller->loadModel('Products');
    $modelEvaluate = $controller->loadModel('Evaluates');
    $modelDiscountCode = $controller->loadModel('DiscountCodes');

    $conditions = ['status'=>'active', 'flash_sale'=>1];
    $limit = 12;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');

    
    $list_product = $modelProduct->find()->where($conditions)->order($order)->all()->toList();

    if(!empty($list_product)){
        foreach($list_product as $key => $item){
            $list_product[$key]->evaluatecount = count($modelEvaluate->find()->where(['id_product'=>$item->id])->all()->toList());
            $list_product[$key]->evaluate = $modelEvaluate->find()->where(['id_product'=>$item->id])->all()->toList();

            $point = 0;
            if(!empty($list_product[$key]->evaluate)){
                foreach($list_product[$key]->evaluate as $k => $s){
                    $point += $s->point;
                }
            }

            if(!empty($list_product[$key]->evaluatecount)){

                $list_product[$key]->point = $point/$list_product[$key]->evaluatecount;
            }
        }
    }
    $DiscountCode = $modelDiscountCode->find()->limit(3)->where(array('status'=>1))->order($order)->all()->toList();

    // phân trang
    $totalData = $modelProduct->find()->where($conditions)->all()->toList();
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

    $conditions = array('type' => 'category_product', 'status'=>'active');
    $category_all = $modelCategories->find()->where($conditions)->all()->toList();

    $conditions = array('type' => 'manufacturer_product');
    $manufacturer_all = $modelCategories->find()->where($conditions)->all()->toList();

    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    setVariable('totalData', $totalData);
    
    setVariable('list_product', $list_product);
    setVariable('category_all', $category_all);
    setVariable('manufacturer_all', $manufacturer_all);
    setVariable('DiscountCode', $DiscountCode);
}

function viewProduct($input){
    global $controller;
    global $session;
 

    $metaTitleMantan = 'Tất cả sản phẩm dã xem';

    $modelProduct = $controller->loadModel('Products');
    $modelView = $controller->loadModel('Views');

    if(!empty($session->read('infoUser'))){
        $infoUser = $session->read('infoUser');
        $listData = $modelView->find()->where(['id_customer'=>$infoUser->id])->all()->toList();
        if(!empty($listData)){
            foreach($listData as $key => $item){
                $product = $modelProduct->find()->where(['id'=>$item->id_product])->first();
                if(!empty($product)){
                    $listData[$key]->product = $product;
                }
            }   
        }
        setVariable('listData', $listData);
    }else{
        $controller->redirect('/');
    }
}

function likeProduct($input){
    global $controller;
    global $session;
 

    $metaTitleMantan = 'Tất cả sản phẩm yêu thích';

    $modelProduct = $controller->loadModel('Products');
    $modelLike = $controller->loadModel('Likes');

    if(!empty($session->read('infoUser'))){
        $infoUser = $session->read('infoUser');
        $listData = $modelLike->find()->where(['idcustomer'=>$infoUser->id, 'type'=> 'product'])->all()->toList();
        if(!empty($listData)){
            foreach($listData as $key => $item){
                $product = $modelProduct->find()->where(['id'=>$item->idobject])->first();
                if(!empty($product)){
                    $listData[$key]->product = $product;
                }
            }   
        }
        setVariable('listData', $listData);
    }else{
        $controller->redirect('/');
    }
}

function addReview(){
     global $controller;
    global $session;
 

    $metaTitleMantan = 'Tất cả sản phẩm yêu thích';

    $modelReview = $controller->loadModel('Reviews');

    if(!empty($session->read('infoUser'))){
        if(!empty($_GET['note'])){
            $infoUser = $session->read('infoUser');

            $data = $modelReview->newEmptyEntity();

            $data->id_user = $infoUser->id;
            $data->note = @$_GET['note']; 
            $data->status = 'lock';


            $modelReview->save($data);

            return array('code'=>1, 'mess'=>"Bạn gửi thành công");
        }else{
           return array('code'=>0, 'mess'=>"Bạn chưa nhập nội dung");
        }
    }else{
       return array('code'=>0, 'mess'=>"Bạn chưa đăng nhập");
    }
}
?>