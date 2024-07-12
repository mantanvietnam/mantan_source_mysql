<?php 
// tìm sản phẩm
function searchProductAPI($input)
{
	global $isRequestPost;
	global $controller;

	$return= array();
	$modelProduct = $controller->loadModel('Products');

	$dataSend = $_REQUEST;
    $conditions = [];

	if(!empty($dataSend['term'])){
        $conditions['title LIKE'] = '%'.$dataSend['term'].'%';
    }

    if(!empty($dataSend['id'])){
        $conditions['id'] = (int) $dataSend['id'];
    }

    if(!empty($dataSend['code'])){
        $conditions['code'] = strtoupper($dataSend['code']);
    }

    if(!empty($dataSend['price_min'])){
        $conditions['price >='] = (int) $dataSend['price_min'];
    }

    if(!empty($dataSend['price_max'])){
        $conditions['price <='] = (int) $dataSend['price_max'];
    }

    $listData= $modelProduct->find()->where($conditions)->all()->toList();
        
    if($listData){
        foreach($listData as $data){
            $return[]= array(   'id'=>$data->id,
                                'label'=>$data->title.' - '.number_format($data->price).'đ',
                                'value'=>$data->id,
                                'title'=>$data->title,
                                'price'=>$data->price,
                                'price_old'=>$data->price_old,
                                'description'=>$data->description,
                                'image'=>$data->image,
                                'code'=>$data->code,
                                'quantity'=>$data->quantity,
                                'view'=>$data->view,
                                'unit'=>$data->unit,
                            );
        }
    }else{
        $return= array(array(   'id'=>0, 
                                'label'=>'Không tìm được sản phẩm', 
                                'value'=>'', 
                                'title'=>'',
                                'price'=>'',
                                'price_old'=>'',
                                'description'=>'',
                                'image'=>'',
                                'code'=>'',
                                'quantity'=>'',
                                'view'=>'',
                                'unit'=>'',
                            )
                );
    }
	

	return $return;
}

function searchEvaluateAPI($input)
{
	global $isRequestPost;
	global $controller;

	$return= array();
	$modelEvaluate = $controller->loadModel('Evaluates');

	$dataSend = $_REQUEST;

	if(!empty($dataSend['id_product'])){
		
        $conditions = ['id_product'=>$dataSend['id_product']];
        if(!empty($dataSend['point'])){
        	if($dataSend['point']==6){
        		$conditions['OR'] = [
        							['image !='=>'{"1":"","2":"","3":"","4":"","5":""}'], 
        							['image_video !='=>''],
        							['video !='=>''],
        					];

        	}else{
 		       	$conditions['point'] = $dataSend['point'];
        	}
        }

       
        $listData= $modelEvaluate->find()->where($conditions)->all()->toList();
        
        if(!empty($listData)){
            $return = array('code'=>1, 'data'=>$listData);
        }else{
        	$return= array('code'=>0, 'label'=>'Không tìm được sản phẩm', 'value'=>'', 'title'=>'');
        }
    }
	

	return $return;
}

// lấy sản phẩm theo danh mục
function getProductByCategoryAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $modelCategories;

    $return = ['totalData'=>0, 'listData'=>[]];

    $modelProduct = $controller->loadModel('Products');

    if($isRequestPost){
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['idCategory'])){
            $conditions = array('id'=>$dataSend['idCategory'], 'status'=>'active');
            $category = $modelCategories->find()->where($conditions)->first();

            if(!empty($category)){
                $conditions = array('cp.id_category'=>$category->id,'status'=>'active');
                $limit = (!empty($dataSend['limit']))?(int)$dataSend['limit']:20;
                $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
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

                if(!empty($list_product)){
                    foreach ($list_product as $key => $value) {
                        $list_product[$key]->images = json_decode($value->images, true);
                        $list_product[$key]->evaluate = json_decode($value->evaluate, true);
                    }
                }

                $totalData = $modelProduct->find()
                        ->join([
                            'table' => 'categorie_products',
                            'alias' => 'cp',
                            'type' => 'INNER',
                            'conditions' => 'cp.id_product = Products.id',
                        ])
                        ->where($conditions)->all()->toList();
            
                $return['totalData'] = count($totalData);
                $return['listData'] = $list_product;
            }
        }   
    }

    return $return;
}

function getNewProductAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $modelCategories;

    $return = [];

    $modelProduct = $controller->loadModel('Products');

    
    $dataSend = $input['request']->getData();

    $conditions = array('status'=>'active');
    $limit = (!empty($dataSend['limit']))?(int)$dataSend['limit']:20;
    $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
    if($page<1) $page = 1;
    $order = array('id'=>'desc');

    $list_product = $modelProduct->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($list_product)){
        foreach ($list_product as $key => $value) {
            $list_product[$key]->images = json_decode($value->images, true);
            $list_product[$key]->evaluate = json_decode($value->evaluate, true);
        }
    }

    $return= $list_product;


    return $return;
}

function getInfoProductAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $modelCategories;

    $return = [];

    $modelProduct = $controller->loadModel('Products');
    $modelQuestion = $controller->loadModel('QuestionProducts');
    $modelDiscountCodes = $controller->loadModel('DiscountCodes');
    $modelEvaluate = $controller->loadModel('Evaluates');
    $modelView = $controller->loadModel('Views');
    $modelCategorieProduct = $controller->loadModel('CategorieProducts');

    if($isRequestPost){
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['id']) || !empty($dataSend['slug']) || !empty($dataSend['code'])){
            if(!empty($dataSend['id'])){
                $conditions = array('id'=>$dataSend['id'], 'status'=>'active');
            }elseif(!empty($dataSend['slug'])){
                $conditions = array('slug'=>$dataSend['slug'], 'status'=>'active');
            }elseif(!empty($dataSend['code'])){
                $conditions = array('code'=>$dataSend['code'], 'status'=>'active');
            }

            $product = $modelProduct->find()->where($conditions)->first();

            if(!empty($product)){
                $product->view ++;
                $modelProduct->save($product);

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
                $conditions = array('Products.id !='=>$product->id, 'cp.id_category'=>@$category->id_category, 'status'=>'active');
                $limit = 4;
                $page = 1;
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

                $return['product'] = $product;
                $return['other_product'] = $other_product;
                $return['manufacturer'] = $manufacturer;
            }
        }
    }

    return $return;
}

// tìm mã giảm giá
function searchDiscountCodeReservedAPI($input){
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $return = array('code'=>1);

    $modelDiscountCode = $controller->loadModel('DiscountCodes');
    
    if(!empty($session->read('infoUser'))){
        $infoUser = $session->read('infoUser');
    }

    $conditions = array();
    
    if(!empty($_GET['code'])){
        $conditions['code'] = strtoupper($_GET['code']);
        $conditions['status'] = 1;

        if(!empty($_GET['category'])){
            $conditions['category'] = (int) $_GET['category'];
        }
        
        $data = $modelDiscountCode->find()->where($conditions)->first();

        // kiểm tra người dùng có được áp dụng giảm giá không
        if(!empty($data->id_customers) && !empty($infoUser)){
            $id_customer = explode(',', $data->id_customers);
            
            if(!in_array($infoUser->id, $id_customer)){
                $data = [];
            }
        }

        // kiểm tra sản phẩm có được giảm giá không
        if(!empty($data->id_products) && !empty($dataSend['id_product'])){
            $id_products = explode(',', $data->id_products);
            
            if(!in_array($dataSend['id_product'], $id_products)){
                $data = [];
            }
        }

        if(!empty($data)){
            $return = array('code'=>0, 'data'=>$data);
        }else{
            $return = array('code'=>3, 'mess'=>'Không tồn tại mã khuyến mại cần tìm');
        }
    }else{
        $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
    }

    return $return;
} 
?>