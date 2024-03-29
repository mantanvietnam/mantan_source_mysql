<?php
function category($input)
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

    $metaTitleMantan = 'Danh mục sản phẩm';

    $modelProduct = $controller->loadModel('Products');
    $modelEvaluate = $controller->loadModel('Evaluates');
    $modelCategorieProduct = $controller->loadModel('CategorieProducts');

    if(!empty($_GET['id']) || !empty($input['request']->getAttribute('params')['pass'][1])){
        if(!empty($_GET['id'])){
            $conditions = array('id'=>$_GET['id'], 'status'=>'active');
        }else{
            $slug= str_replace('.html', '', $input['request']->getAttribute('params')['pass'][1]);
            $conditions = array('slug'=>$slug, 'type' => 'category_product', 'status'=>'active');
        }
        
        $category = $modelCategories->find()->where($conditions)->first();

        if(!empty($category)){
        	$metaTitleMantan = $category->name;
        	$metaImageMantan = $category->image;
        	$metaKeywordsMantan = $category->keyword;
        	$metaDescriptionMantan = $category->description;
            

            $conditions = array('cp.id_category'=>$category->id,'status'=>'active');
			$limit = 20;
			$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
			if($page<1) $page = 1;
		    $order = array('Products.id'=>'desc');

            $list_product = $modelProduct->find()
                        ->join([
                            'table' => 'categorie_products',
                            'alias' => 'cp',
                            'type' => 'INNER',
                            'conditions' => 'cp.id_product = Products.id',
                        ])
                        ->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
            $totalData = $modelProduct->find()
                        ->join([
                            'table' => 'categorie_products',
                            'alias' => 'cp',
                            'type' => 'INNER',
                            'conditions' => 'cp.id_product = Products.id',
                        ])
                        ->where($conditions)->all()->toList();

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
            
            setVariable('category', $category);
            setVariable('list_product', $list_product);
            setVariable('category_all', $category_all);
            setVariable('manufacturer_all', $manufacturer_all);
        }else{
            return $controller->redirect('/');
        }
    }else{
        return $controller->redirect('/');
    }
}

function manufacturer($input)
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

    $metaTitleMantan = 'Nhà sản xuất sản phẩm';

    $modelProduct = $controller->loadModel('Products');

    if(!empty($_GET['id']) || !empty($input['request']->getAttribute('params')['pass'][1])){
        if(!empty($_GET['id'])){
            $conditions = array('id'=>$_GET['id']);
        }else{
            $slug= str_replace('.html', '', $input['request']->getAttribute('params')['pass'][1]);
            $conditions = array('slug'=>$slug, 'type' => 'manufacturer_product');
        }
        
        $category = $modelCategories->find()->where($conditions)->first();

        if(!empty($category)){
        	$metaTitleMantan = $category->name;
        	$metaImageMantan = $category->image;
        	$metaKeywordsMantan = $category->keyword;
        	$metaDescriptionMantan = $category->description;
            

            $conditions = array('id_manufacturer'=>$category->id, 'status'=>'active');
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
            
            setVariable('category', $category);
            setVariable('list_product', $list_product);
            setVariable('category_all', $category_all);
            setVariable('manufacturer_all', $manufacturer_all);
        }else{
            return $controller->redirect('/');
        }
    }else{
        return $controller->redirect('/');
    }
}
?>