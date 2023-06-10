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
		$conditions =array();
		$conditions['id'] =  $dataSend['idlayer'];

		$datalayer = $modelProductDetail->find()->where($conditions)->first();

		if(!empty(@$datalayer)){
			if (@$datalayer->products_id == @$dataSend['idproduct']) {
				// lấy sản phẩn 
				$dataProduct = $modelProduct->get($dataSend['idproduct']);
				// lấy tk người dùng 
				$dataMembr = $modelMember->get($dataProduct->user_id);
				if ($dataMembr->token == $dataSend['token']) {
					$modelProductDetail->delete($datalayer);
					
					getLayerProductForEdit($dataSend['idproduct']);
					$return = array('code'=>1, 'mess'=>'bạn xóa layer thành công');
					
				}else{
				$return = array('code'=>0, 'mess'=>'Bạn chưa đăng nhập');
				}
			}else{
				$return = array('code'=>0, 'mess'=>'sản phẩm này không dùng');
			}	
		}else{
			$return = array('code'=>0, 'mess'=>'Id layer không tồn tại');
		}
	}else{
			$return = array('code'=>0, 'mess'=>'bạn chưa có giữ liệu truyền vào');
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

		$dataProduct = $modelProduct->find()->where(array('id'=>$dataSend['idproduct']))->first();
		if(!empty($dataProduct)){

			// lấy tk người dùng 
			$dataMembr = $modelMember->get($dataProduct->user_id);


			if ($dataMembr->token == $dataSend['token']) {
				$productDetail = $modelProductDetail->find()->where(array('products_id'=>$dataSend['idproduct']))->all()->toList();
		            $idlayer = count($productDetail)+1;
				
				$datalayer = $modelProductDetail->newEmptyEntity();
				$datalayer->name =  'layer '.$idlayer;
				$datalayer->content = $dataSend['layer'];
				$datalayer->wight =  @$dataSend['wight'];
				$datalayer->height =  @$dataSend['height'];
				$datalayer->sort =  @$dataSend['sort'];
				$datalayer->products_id = (int) @$dataSend['idproduct'];
				$datalayer->status = 1;
				$datalayer->created_at = date('Y-m-d H:i:s');

				$modelProductDetail->save($datalayer);

				getLayerProductForEdit($dataSend['idproduct']);
				$return = array('code'=>1, 'mess'=>'bạn thêm layer thành công');
				
			}else{
			$return = array('code'=>0, 'mess'=>'Bạn chưa đăng nhập');
			}
		}else{
			$return = array('code'=>0, 'mess'=>'sản phẩm này không dùng');
		}

	}else{
			$return = array('code'=>0, 'mess'=>'bạn chưa có giữ liệu truyền vào');
		}
	return $return;
}
 
// update layer 
function updateLayerAPI($input){

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

		$dataProduct = $modelProduct->find()->where(array('id'=>$dataSend['idproduct']))->first();
		if(!empty($dataProduct)){
			// lấy tk người dùng 
			$dataMembr = $modelMember->get($dataProduct->user_id);
			if ($dataMembr->token == $dataSend['token']) {
				$datalayer = $modelProductDetail->find()->where(array('id'=>$dataSend['idlayer'], 'products_id'=>$dataSend['idproduct']))->first();

				if(!empty($datalayer)){
					$content = json_decode($datalayer->content, true);

	            	$content[$dataSend['field']] = str_replace(array('"', "'"), '’', $dataSend['value']);

	            	$datalayer->content = json_encode($content);
					$datalayer->status = 1;

					// lưu data 
					$modelProductDetail->save($datalayer);
					getLayerProductForEdit($dataSend['idproduct']);
					$return = array('code'=>1, 'mess'=>'bạn sửa layer thành công');
				}else{
					$return = array('code'=>0, 'mess'=>'Layer bạn không dúng');
				}
				
			}else{
				$return = array('code'=>0, 'mess'=>'Bạn chưa đăng nhập');
			}
		}else{
			$return = array('code'=>0, 'mess'=>'sản phẩm này không dùng');
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

		$dataProduct = $modelProduct->find()->where(array('id'=>$dataSend['idproduct']))->first();

			if(!empty($dataProduct)){
				// lấy tk người dùng 
				$dataMembr = $modelMember->get($dataProduct->user_id);
				if ($dataMembr->token == $dataSend['token']) {
					$datalayer = $modelProductDetail->find()->where(array('products_id' => $dataSend['idproduct']))->all()->toList();

					$return = array('code'=>1,
									'data'=> $datalayer,
					 				'mess'=>'bạn lấy data thành công',
					 			);

				}else{
					$return = array('code'=>0, 'mess'=>'Bạn chưa đăng nhập');
				}
			}else{
				$return = array('code'=>0, 'mess'=>'sản phẩm này không dùng');
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
		             $return = array('code'=>1, 'mess'=>'bạn thêm ảnh thành công');
				
		        }else{
		           $return = array('code'=>0, 'mess'=>'bạn không có ảnh');
				
		        }}
		    }else{
		       $return = array('code'=>0, 'mess'=>'bạn chưa đăng nhập');
				
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

			    $datalayer = $modelProductDetail->find()->where(array('id'=>$dataSend['idlayer'], 'products_id'=>$dataSend['idproduct']))->first();
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
function addLayerText($input){


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

		$dataProduct = $modelProduct->find()->where(array('id'=>$dataSend['idproduct']))->first();

		if(!empty($dataProduct)){
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
		}else{
			$return = array('code'=>0, 'mess'=>'sản phẩm này không dùng');
		}
	}
	return $return;

}

// líst ảnh 
function listImage($input){
	global $isRequestPost;
	global $controller;
	global $modelCategories;


	$modelManagerFile = $controller->loadModel('ManagerFile');
	$modelMember = $controller->loadModel('Members');
	
	$return = array('code'=>0);

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		$user = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

		if(!empty($user)){
			$dataImage = $modelManagerFile->find()->where(array('user_id' => $user->id))->all()->toList();

					$return = array('code'=>1,
									'data'=> $dataImage,
					 				'mess'=>'bạn lấy data thành công',
					 			);


		}else{
					$return = array('code'=>0, 'mess'=>'Bạn chưa đăng nhập');
				}

	}
	return $return;

}

// líst font chữa 
function listFont($input){
	global $isRequestPost;
	global $controller;
	global $modelCategories;


	$modeFont = $controller->loadModel('Font');
	$modelMember = $controller->loadModel('Members');
	
	$return = array('code'=>0);

	if($isRequestPost){
		$dataSend = $input['request']->getData();

		$user = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();

		if(!empty($user)){
			$dataImage = $modeFont->find()->where(array())->all()->toList();

					$return = array('code'=>1,
									'data'=> $dataImage,
					 				'mess'=>'bạn lấy data thành công',
					 			);


		}else{
					$return = array('code'=>0, 'mess'=>'Bạn chưa đăng nhập');
				}

	}
	return $return;

}

?>