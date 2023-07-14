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
        
        $product = $modelProduct->find()->where($conditions)->first();

        if(!empty($product)){
        	$metaTitleMantan = $product->title;
        	$metaImageMantan = $product->image;
        	$metaKeywordsMantan = $product->keyword;
        	$metaDescriptionMantan = $product->description;
            

            $conditions = array('id !='=>$product->id, 'id_category'=>$product->id_category);
			$limit = 12;
			$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
			if($page<1) $page = 1;
		    $order = array('id'=>'desc');
		    
		    $other_product = $modelProduct->find()->where($conditions)->order($order)->all()->toList();
            
            setVariable('product', $product);
            setVariable('other_product', $other_product);
        }else{
            return $controller->redirect('/');
        }
    }else{
        return $controller->redirect('/');
    }
}
?>