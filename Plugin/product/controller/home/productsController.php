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

    $metaTitleMantan = 'Chi tiết sản phẩm';

    $modelProduct = $controller->loadModel('Products');

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
        	$metaTitleMantan = $product->title;
        	$metaImageMantan = $product->image;
        	$metaKeywordsMantan = $product->keyword;
        	$metaDescriptionMantan = $product->description;
            
            $product->images = json_decode($product->images, true);

            // SẢN PHẨM KHÁC
            $conditions = array('id !='=>$product->id, 'id_category'=>$product->id_category, 'status'=>'active');
			$limit = 12;
			$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
			if($page<1) $page = 1;
		    $order = array('id'=>'desc');
		    
		    $other_product = $modelProduct->find()->where($conditions)->order($order)->all()->toList();
            
            // NHÀ SẢN XUẤT
            $manufacturer = $modelCategories->find()->where(['id'=>$product->id_manufacturer])->first();

            // DANH MỤC SẢN PHẨM
            $category = $modelCategories->find()->where(['id'=>$product->id_category])->first();

            setVariable('product', $product);
            setVariable('other_product', $other_product);
            setVariable('category', $category);
            setVariable('manufacturer', $manufacturer);
        }else{
            return $controller->redirect('/');
        }
    }else{
        return $controller->redirect('/');
    }
}

function products($input)
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

    $conditions = ['status'=>'active'];
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');
    
    $list_product = $modelProduct->find()->where($conditions)->order($order)->all()->toList();

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

    $conditions = array('type' => 'category_product');
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

    $conditions = ['status'=>'active'];
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');

    if(!empty($_GET['key'])){
        $conditions['OR'] = [
                                ['title LIKE'=>'%'.$_GET['key'].'%'],
                                ['keyword LIKE'=>'%'.$_GET['key'].'%']
                            ];
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

    $conditions = array('type' => 'category_product');
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
?>