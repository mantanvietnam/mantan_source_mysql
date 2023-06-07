<?php 
function deleteLayerAPI($input){
	global $isRequestPost;
	global $controller;
	global $modelCategories;

	$modelMember = $controller->loadModel('Members');
	$modelProduct = $controller->loadModel('Products');
	$modelProductDetail = $controller->loadModel('ProductDetails');
	$modelFont = $controller->loadModel('Font');
	$return = array('code'=>0);

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		$datalayer = $modelProductDetail->get($dataSend['idlayer']);
		if ($datalaye->products_id == $dataSend['idproduct']) {
			// lấy sản phẩn 
			$dataProduct = $modelProduct->get($dataSend['idproduct']);
			// lấy tk người dùng 
			$dataMembr = $modelMember->get($dataProduct->user_id);
			if ($dataMembr->token == $dataSend['token']) {
				$modelProductDetail->delete($datalayer);
				$return = array('code'=>1, 'mess'=>'bạn xóa layer thành công');
				getLayerProductForEdit($dataSend['idproduct']);
				
			}else{
			$return = array('code'=>0, 'mess'=>'Token bạn bị sai');
			}
		}
	}
	return $return;
}

// thên layer 
function saveLayerAPI($input){

	global $isRequestPost;
	global $controller;
	global $modelCategories;

	$modelMember = $controller->loadModel('Members');
	$modelProduct = $controller->loadModel('Products');
	$modelProductDetail = $controller->loadModel('ProductDetails');
	$modelFont = $controller->loadModel('Font');
	$return = array('code'=>0);

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		$dataProduct = $modelProduct->get($dataSend['idproduct']);
			// lấy tk người dùng 
			$dataMembr = $modelMember->get($dataProduct->user_id);
			if ($dataMembr->token == $dataSend['token']) {
				
				$datalayer = $modelProductDetail->newEmptyEntity();
				$datalayer->content = $dataSend['layer'];
				$datalayer->wight =  @$dataSend['wight'];
				$datalayer->height =  @$dataSend['height'];
				$datalayer->sort =  @$dataSend['sort'];
				$datalayer->products_id =  @$dataSend['idproduct'];
				$datalayer->status = 1;

				$modelProductDetail->save($datalayer);
				getLayerProductForEdit($dataSend['idproduct']);
				$return = array('code'=>1, 'mess'=>'bạn thêm layer thành công');
				
			}else{
			$return = array('code'=>0, 'mess'=>'Token bạn bị sai');
			}

	}
	return $return;
}
 
// update layer 
function updatelyerAPI($input){

	global $isRequestPost;
	global $controller;
	global $modelCategories;

	$modelMember = $controller->loadModel('Members');
	$modelProduct = $controller->loadModel('Products');
	$modelProductDetail = $controller->loadModel('ProductDetails');
	$modelFont = $controller->loadModel('Font');
	$return = array('code'=>0);

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		$dataProduct = $modelProduct->get($dataSend['idproduct']);
			// lấy tk người dùng 
			$dataMembr = $modelMember->get($dataProduct->user_id);
			if ($dataMembr->token == $dataSend['token']) {
				$datalayer = $modelProductDetail->get($dataSend['idlayer']);
				 $content = json_decode($datalayer->content, true);

            	$content[$dataSend['field']] = str_replace(array('"', "'"), '’', $dataSend['value']);

            	$datalayer->content = json_encode($content);
				$datalayer->wight =  @$dataSend['wight'];
				$datalayer->height =  @$dataSend['height'];
				$datalayer->sort =  @$dataSend['sort'];
				$datalayer->products_id =  @$dataSend['idproduct'];
				$datalayer->status = 1;

				// lưu data 
				$modelProductDetail->save($datalayer);
				getLayerProductForEdit($dataSend['idproduct']);
				$return = array('code'=>1, 'mess'=>'bạn sửa layer thành công');
				
			}else{
			$return = array('code'=>0, 'mess'=>'Token bạn bị sai');
			}

	}
	return $return;
}


// list layer
function listLayerAPI($input){

	global $isRequestPost;
	global $controller;
	global $modelCategories;

	$modelMember = $controller->loadModel('Members');
	$modelProduct = $controller->loadModel('Products');
	$modelProductDetail = $controller->loadModel('ProductDetails');
	$modelFont = $controller->loadModel('Font');
	$return = array('code'=>0);

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		$dataProduct = $modelProduct->get($dataSend['idproduct']);
			// lấy tk người dùng 
			$dataMembr = $modelMember->get($dataProduct->user_id);
			if ($dataMembr->token == $dataSend['token']) {
				$datalayer = $modelProductDetail->find()->where(array('products_id' => $dataSend['idproduct']))->all()->toList();

				$return = array('code'=>1,
								'data'=> $datalayer,
				 				'mess'=>'bạn lấy data thành công',
				 			);

			}

	}
	return $return;
}

// addLayerImage
function addLayerImageAPI($input){
    global $isRequestPost;
    global $controller;
    $return = array('code'=>0);

    $modelManagerFile = $controller->loadModel('ManagerFile');
    $modelMember = $controller->loadModel('Members');
    $modelProductDetail = $controller->loadModel('ProductDetails');
    $modelProduct = $controller->loadModel('Products');
    if($isRequestPost){
    	$dataSend = $input['request']->getData();

	    $user = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

	    if(!empty($user)){
	        if(isset($_FILES['file']) && empty($_FILES['file']["error"])){
            $thumbnail = uploadImage($user->id, 'file');

	            if(!empty($thumbnail['linkOnline'])){
		            $dataSend = $input['request']->getData();

		            $f = $modelManagerFile->newEmptyEntity();
		            
		            $f->link = $thumbnail['linkOnline'];
		            $f->user_id = $user->id;
		            $f->type = 0; // 0 là user up, 1 là cap, 2 là payment   
		            $f->created_at = date('Y-m-d H:i:s');
		            
		            $modelManagerFile->save($f);

		            $productDetail = $modelProductDetail->find()->where(array('products_id'=>$dataSend['idproduct']))->all()->toList();
		            $idlayer = count($productDetail)+1;

		            // layer mới
		            $product = $modelProduct->get($dataSend['idproduct']);
		            $sizeBackground = getimagesize($product->thumn);

		            $tyle = $sizeBackground[0]*100/(int)$dataSend['width'];
		            if($tyle>30) $tyle = 30;

		            $new = $modelProductDetail->newEmptyEntity();
		            
		            $new->name = 'Layer '.$idlayer;
		            $new->products_id = $dataSend['idproduct'];
		            $new->content = json_encode(getLayer($idlayer,'image',$thumbnail['linkOnline'],$tyle, $tyle));
		            $new->sort = $idlayer;
		            $new->height = $tyle;
		            $new->wight = $tyle;
		            $new->created_at = date('Y-m-d H:i:s');
		            
		            $modelProductDetail->save($new);
		                
		             getLayerProductForEdit($dataSend['idproduct']);
		             $return = array('code'=>1, 'mess'=>'bạn sửa layer thành công');
				
		        }else{
		           $return = array('code'=>0, 'mess'=>'bạn không có ảnh');
				
		        }}
		    }else{
		       $return = array('code'=>0, 'mess'=>'bạn chưa đăng nhập');
				
		    } 

		}
	}
	return $return;

}


//thay ảnh có sắn trên server
function changeLayerImageAPI(){
	global $isRequestPost;
    global $controller;

    $modelManagerFile = $controller->loadModel('ManagerFile');
    $modelMember = $controller->loadModel('Members');
    $modelProductDetail = $controller->loadModel('ProductDetails');
    $modelProduct = $controller->loadModel('Products');
    if($isRequestPost){
    	$dataSend = $input['request']->getData();

	    $user = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

	    $thumbnail = $modelManagerFile->find()->where(array('id'=>$dataSend['idfile'],'user_id'=>$user->id))->first();

	    if(!empty($thumbnail)){
	    	$product = $modelProduct->get($dataSend['idproduct']);
	    	if(!empty($product)){
	            $sizeBackground = getimagesize($product->thumn);

			     $tyle = $sizeBackground[0]*100/(int)$dataSend['width'];
				            if($tyle>30) $tyle = 30;

			    $datalayer = $modelProductDetail->get($dataSend['idlayer']);
			    if(!empty($datalayer)){
				    $datalayer->content = json_encode(getLayer($idlayer,'image',$thumbnail['linkOnline'],$tyle, $tyle));

				    $modelProductDetail->save($datalayer);
					                
					return getLayerProductForEdit($dataSend['idproduct']);
					$return = array('code'=>1, 'mess'=>'bạn sửa layer thành công');
				}else{
					$return = array('code'=>0, 'mess'=>'bạn chọn layer chưa đúng');
				}
			}else{
				$return = array('code'=>0, 'mess'=>'bạn chọn mẫu thiêt kế chưa đúng');
			}
	    }else{
			$return = array('code'=>0, 'mess'=>'bạn không có ảnh');
		}
	}
	return $return;

}

// thay ảnh không có sắn trên server
function changeLayerImageNew($input){
    global $isRequestPost;
    global $controller;
    $return = array('code'=>0);

    $modelManagerFile = $controller->loadModel('ManagerFile');
    $modelMember = $controller->loadModel('Members');
    $modelProductDetail = $controller->loadModel('ProductDetails');
    $modelProduct = $controller->loadModel('Products');
    if($isRequestPost){
    	$dataSend = $input['request']->getData();

	    $user = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

	    if(!empty($user)){
	        if(isset($_FILES['file']) && empty($_FILES['file']["error"])){
            $thumbnail = uploadImage($user->id, 'file');

	            if(!empty($thumbnail['linkOnline'])){
		            $dataSend = $input['request']->getData();

		            $f = $modelManagerFile->newEmptyEntity();
		            
		            $f->link = $thumbnail['linkOnline'];
		            $f->user_id = $user->id;
		            $f->type = 0; // 0 là user up, 1 là cap, 2 là payment   
		            $f->created_at = date('Y-m-d H:i:s');
		            
		            $modelManagerFile->save($f);

		            $productDetail = $modelProductDetail->find()->where(array('products_id'=>$dataSend['idproduct']))->all()->toList();
		            $idlayer = count($productDetail)+1;

		            // layer mới
		            $product = $modelProduct->get($dataSend['idproduct']);
		            $sizeBackground = getimagesize($product->thumn);

		            $tyle = $sizeBackground[0]*100/(int)$dataSend['width'];
		            if($tyle>30) $tyle = 30;

		            $new = $modelProductDetail->get($dataSend['idlayer']);
		            
		            $new->name = 'Layer '.$idlayer;
		            $new->products_id = $dataSend['idproduct'];
		            $new->content = json_encode(getLayer($idlayer,'image',$thumbnail['linkOnline'],$tyle, $tyle));
		            $new->sort = $idlayer;
		            $new->height = $tyle;
		            $new->wight = $tyle;
		            $new->created_at = date('Y-m-d H:i:s');
		            
		            $modelProductDetail->save($new);
		                
		             getLayerProductForEdit($dataSend['idproduct']);
		             $return = array('code'=>1, 'mess'=>'bạn sửa layer thành công');
				
		        }else{
		           $return = array('code'=>0, 'mess'=>'bạn không có ảnh');
				
		        }}
		    }else{
		       $return = array('code'=>0, 'mess'=>'bạn chưa đăng nhập');
				
		    } 
	}
	return $return;

}

// addLayerText
function addLayerText(){


	global $isRequestPost;
	global $controller;
	global $modelCategories;

	$modelMember = $controller->loadModel('Members');
	$modelProduct = $controller->loadModel('Products');
	$modelProductDetail = $controller->loadModel('ProductDetails');
	$modelFont = $controller->loadModel('Font');
	$return = array('code'=>0);

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		$dataProduct = $modelProduct->get($dataSend['idproduct']);
		$productDetail = $modelProductDetail->find()->where(array('products_id'=>$dataSend['idproduct']))->all()->toList();
		$idlayer = count($productDetail)+1;
			// lấy tk người dùng 
			$dataMembr = $modelMember->get($dataProduct->user_id);
			if ($dataMembr->token == $dataSend['token']) {
				
				$datalayer = $modelProductDetail->newEmptyEntity();
				$datalayer->content = json_encode(getLayertext($idlayer, 'text', @$dataSend['text'], $dataSend['color'],$dataSend['size'], $dataSend['font'], $dataSend['wight'], $dataSend['height']));
				$datalayer->wight =  @$dataSend['wight'];
				$datalayer->name =  'layer '.$idlayer;
				$datalayer->height =  @$dataSend['height'];
				$datalayer->sort =  @$dataSend['sort'];
				$datalayer->products_id =  @$dataSend['idproduct'];
				$datalayer->status = 1;

				$modelProductDetail->save($datalayer);
				getLayerProductForEdit($dataSend['idproduct']);
				$return = array('code'=>1, 'mess'=>'bạn thêm layer thành công');
				
			}else{
			$return = array('code'=>0, 'mess'=>'Token bạn bị sai');
			}

	}
	return $return;

}

function updateLayerAPI($input)
{
    global $session;
    global $isRequestPost;
    global $controller;

    $modelProduct = $controller->loadModel('Products');
    $modelProductDetail = $controller->loadModel('ProductDetails');

    if(!empty($session->read('infoUser')) && $isRequestPost){
        $dataSend = $input['request']->getData();
        
        $item =  $modelProductDetail->find()->where(array('id'=>$dataSend['id'], 'products_id'=>$dataSend['idproduct']))->first();
        
        if(!empty($item)){
            $content = json_decode($item->content, true);

            $content[$dataSend['field']] = str_replace(array('"', "'"), '’', $dataSend['value']);

            $item->content = json_encode($content);

            $modelProductDetail->save($item);

            return getLayerProductForEdit($dataSend['idproduct']); 
        }else{
            return ['error' => ['Layer '.$idlayer.' không tồn tại']]; 
        }

        return ['data' => ['Đã câp nhật']]; 
    }else{
        return ['error' => ['Bạn chưa đăng nhập hoặc phiên đăng nhập đã hết hạn']]; 
    } 
}


?>