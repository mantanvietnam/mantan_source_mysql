<?php 
// xóa layer
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
					$return = array('code'=>1, 'mess'=>'Bạn xóa layer thành công');
					
				}else{
				$return = array('code'=>0, 'mess'=>'Bạn chưa đăng nhập');
				}
			}else{
				$return = array('code'=>0, 'mess'=>'Sản phẩm này không dùng');
			}	
		}else{
			$return = array('code'=>0, 'mess'=>'Layer không tồn tại');
		}
	}else{
			$return = array('code'=>0, 'mess'=>'Bạn chưa có dữ liệu truyền vào');
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
					$datalayer->updated_at = date('Y-m-d H:i:s');

					// lưu data 
					$modelProductDetail->save($datalayer);
					//getLayerProductForEdit($dataSend['idproduct']);
					$return = array('code'=>1, 'mess'=>'Bạn sửa layer thành công');
				}else{
					$return = array('code'=>0, 'mess'=>'Layer bạn không dúng');
				}
				
			}else{
				$return = array('code'=>0, 'mess'=>'Bạn chưa đăng nhập');
			}
		}else{
			$return = array('code'=>0, 'mess'=>'Sản phẩm này không dùng');
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
					$layers = getLayerProductForEdit($dataSend['idproduct']);
					  
					unset($layers['movelayer']);
					unset($layers['layer']);
					unset($layers['list_layer_check']);

					if(!empty($layers['data']['productDetail'])){
					 	$productDetail = array();
					 	foreach($layers['data']['productDetail'] as $key => $item){
					 		$item->content  = json_decode($item->content, true);
					 		$productDetail[] = $item;

					 	}
					 	
					 	$layers['data']['productDetail']= $productDetail;
					}


					$return = array('code'=>1,
									'data'=> $layers['data'],
					 				'mess'=>'Bạn lấy data thành công',
					 			);

				}else{
					$return = array('code'=>0, 'mess'=>'Bạn chưa đăng nhập');
				}
			}else{
				$return = array('code'=>0, 'mess'=>'Sản phẩm này không dùng');
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
		            $product = $modelProduct->find()->where(array('id'=>$dataSend['idproduct'], 'user_id'=>$user->id))->first();
		            if(!empty($product)){
			            $sizeBackground = getimagesize($product->thumn);

			            $tyle = $sizeBackground[0]*100/30;
			            if($tyle>30) $tyle = 30;

			            $new = $modelProductDetail->newEmptyEntity();
			            
			            $new->name = 'Layer '.$idlayer;
			            $new->products_id = $dataSend['idproduct'];
			            $new->content = json_encode(getLayer($idlayer,'image',$thumbnail['linkOnline'],$tyle, $tyle));
			            $new->sort = $idlayer;
			            
			            $new->created_at = date('Y-m-d H:i:s');
			            
			            $modelProductDetail->save($new);
			                
			            $new->content = json_decode($new->content , true);
			            $return = array('code'=>1, 'data'=>$new, 'mess'=>'Bạn thêm ảnh thành công');
			         }else{
			        	 $return = array('code'=>0, 'mess'=>'Sản phẩm này không dùng');
			        }
				
		        }else{
		           $return = array('code'=>0, 'mess'=>'Bạn không có ảnh');
				
		        }}
		    }else{
		       $return = array('code'=>0, 'mess'=>'Bạn chưa đăng nhập');
				
		    } 

		}
	
	return $return;

}

// addLayerImageUrl
function addLayerImageUrlAPI($input){
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
	            if(!empty($dataSend['imageUrl'])){

		            $f = $modelManagerFile->newEmptyEntity();
		            
		            $f->link = $dataSend['imageUrl'];
		            $f->user_id = $user->id;
		            $f->type = 0; // 0 là user up, 1 là cap, 2 là payment   
		            $f->created_at = date('Y-m-d H:i:s');
		            
		            $modelManagerFile->save($f);

		            $productDetail = $modelProductDetail->find()->where(array('products_id'=>$dataSend['idproduct']))->all()->toList();
		            $idlayer = count($productDetail)+1;

		            // layer mới
		            $product = $modelProduct->find()->where(array('id'=>$dataSend['idproduct'], 'user_id'=>$user->id))->first();
		            if(!empty($product)){
			            $sizeBackground = getimagesize($product->thumn);

			            $tyle = $sizeBackground[0]*100/30;
			            if($tyle>30) $tyle = 30;

			            $new = $modelProductDetail->newEmptyEntity();
			            
			            $new->name = 'Layer '.$idlayer;
			            $new->products_id = $dataSend['idproduct'];
			            $new->content = json_encode(getLayer($idlayer,'image',$dataSend['imageUrl'],$tyle, $tyle));
			            $new->sort = $idlayer;
			            
			            $new->created_at = date('Y-m-d H:i:s');
			            
			            $modelProductDetail->save($new);
			                
			            $new->content = json_decode($new->content , true);
			            $return = array('code'=>1, 'data'=>$new, 'mess'=>'Bạn thêm ảnh thành công');
			         }else{
			        	 $return = array('code'=>4, 'mess'=>'Sản phẩm này không dùng');
			        }
				
		        }else{
		           $return = array('code'=>3, 'mess'=>'Bạn không có ảnh');
				
		        }
		    }else{
		       $return = array('code'=>2, 'mess'=>'Bạn chưa đăng nhập');
				
		    } 

		}
	
	return $return;

}

//thay ảnh có sắn trên server
function changeLayerImageAPI($input){
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
	    	$product = $modelProduct->find()->where(array('id'=>$dataSend['idproduct'],  'user_id'=>$user->id))->first();
	    	if(!empty($product)){
	            $sizeBackground = getimagesize($product->thumn);

	            $productDetail = $modelProductDetail->find()->where(array('products_id'=>$dataSend['idproduct']))->all()->toList();
		        $idlayer = count($productDetail)+1;

			     $tyle = $sizeBackground[0]*100/(int)(isset($dataSend['width']))? $dataSend['width']:100;
				            if($tyle>30) $tyle = 30;

			    $datalayer = $modelProductDetail->find()->where(array('id'=>$dataSend['idlayer'], 'products_id'=>$dataSend['idproduct']))->first();
			    if(!empty($datalayer)){
				    $replace = json_decode($datalayer->content);
            		$replace->banner = $thumbnail['link'];
            		$datalayer->content = json_encode($replace);
            		$datalayer->updated_at = date('Y-m-d H:i:s');

				    $modelProductDetail->save($datalayer);
					                
					//getLayerProductForEdit($dataSend['idproduct']);
					$return = array('code'=>1, 'mess'=>'Bạn sửa layer thành công', 'link'=>$thumbnail['link']);
				}else{
					$return = array('code'=>0, 'mess'=>'Bạn chọn layer chưa đúng');
				}
			}else{
				$return = array('code'=>0, 'mess'=>'Bạn chọn mẫu thiêt kế chưa đúng');
			}
	    }else{
			$return = array('code'=>0, 'mess'=>'Bạn không có ảnh');
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
		            $product = $modelProduct->find()->where(array('id'=>$dataSend['idproduct'], 'user_id'=>$user->id))->first();
		            if(!empty($product)){
			            $sizeBackground = getimagesize($product->thumn);

			           /* $tyle = $sizeBackground[0]*100/(int)(isset(@$dataSend['width']))? @$dataSend['width']:100;
			            if($tyle>30) $tyle = 30;*/

			            $new = $modelProductDetail->find()->where(array('id'=>$dataSend['idlayer'], 'products_id '=>$dataSend['idproduct']))->first();
			            if(!empty($new)){
				            $replace = json_decode($new->content);
            				$replace->banner = $thumbnail['linkOnline'];
            				$new->content = json_encode($replace);
            				$new->updated_at = date('Y-m-d H:i:s');
				            
				            $modelProductDetail->save($new);
				                
				            $return = array('code'=>1, 'mess'=>'Bạn sửa layer thành công', 'link'=>$thumbnail['linkOnline']);
				        }else{
			        	   $return = array('code'=>5, 'mess'=>'Layer này không đúng');
			        	}     
			        }else{
			        	$return = array('code'=>4, 'mess'=>'Sản phẩm này không dùng');
			        }
				
		        }else{
		           $return = array('code'=>3, 'mess'=>'Bạn không có ảnh');
				
		        }}
		    }else{
		       $return = array('code'=>2, 'mess'=>'Bạn chưa đăng nhập');
				
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
					$datalayer->content = json_encode(getLayer($idlayer, 'text', '', '80', '30', @$dataSend['text'],'','', $dataSend['font'],$dataSend['color'] ,$dataSend['size']));
					$datalayer->name =  'layer '.$idlayer;
					$datalayer->created_at = date('Y-m-d H:i:s');
					$datalayer->products_id =  @$dataSend['idproduct'];
					$datalayer->sort = 1;

					$modelProductDetail->save($datalayer);
					$datalayer->content = json_decode($datalayer->content , true);
					$return = array('code'=>1, 'data'=>$datalayer, 'mess'=>'Bạn thêm layer thành công');
					
				}else{
				$return = array('code'=>0, 'mess'=>'Bạn chữa đăng nhập');
				}
		}else{
			$return = array('code'=>0, 'mess'=>'Sản phẩm này không dùng');
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
					 				'mess'=>'Bạn lấy data thành công',
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
					 				'mess'=>'Bạn lấy data thành công',
					 			);


		}else{
					$return = array('code'=>0, 'mess'=>'Bạn chưa đăng nhập');
				}

	}
	return $return;

}

function copyLayerAPI($input)
{
    global $session;
    global $isRequestPost;
    global $controller;

    $modelProduct = $controller->loadModel('Products');
    $modelProductDetail = $controller->loadModel('ProductDetails');

	$modelMember = $controller->loadModel('Members');
	$return = array('code'=>0);

    if($isRequestPost){
        
        $dataSend = $input['request']->getData();

        $user = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();
	        if(!empty($user)){
	        	$dataProduct = $modelProduct->find()->where(array('id'=>$dataSend['idproduct'],'user_id'=>$user->id))->first();

	        if(!empty($dataProduct)){
	        // lấy thông tin layer hiện tại
		        $item =  $modelProductDetail->find()->where(array('id'=>$dataSend['idlayer'],'products_id'=>$dataProduct->id))->first();
		        if(!empty($item)){
		        	  // tạo layer mới
			        $productDetail = $modelProductDetail->find()->where(array('products_id'=>$dataSend['idproduct']))->all()->toList();
			        $idlayer = count($productDetail)+1;

			        $content = json_decode($item->content);
			        $content->text = 'Copy '.$content->text;

			        $new = $modelProductDetail->newEmptyEntity();   
			        
			        $new->name = 'Copy layer '.$idlayer;
			        $new->products_id = $item->products_id;
			        $new->content = json_encode($content);
			        $new->sort = $idlayer;
			        
			        $new->created_at = date('Y-m-d H:i:s');
			        
			        $modelProductDetail->save($new);
			            
			        //getLayerProductForEdit($item->products_id);

			        $return = array('code'=>1, 'mess'=>'Bạn copy layer thành công');
			        
			    }else{
		        	$return = array('code'=>0, 'mess'=>'Layer này không tồn tại');
		    	} 
		    }else{
		        $return = array('code'=>0, 'mess'=>'Sản phẩm này không dùng');
		    }
	    }else{
	        $return = array('code'=>0, 'mess'=>'Bạn chưa đăng nhập');
	    } 
	}
	return $return;
}

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
		$user = $modelMember->find()->where(array('token'=> $dataSend['token']))->first();;
		
		if(!empty($user)){
			// lấy tk người dùng 
			$dataProduct = $modelProduct->find()->where(array('id'=>$dataSend['idProduct'], 'user_id'=>$user->id))->first();
			if (!empty($dataProduct)) {
				$datalayer = $modelProductDetail->find()->where(array('id'=>$dataSend['idLayer'], 'products_id'=>$dataSend['idProduct']))->first();

				if(!empty($datalayer)){

	            	$datalayer->content = json_encode($dataSend['layer']);
	            	$datalayer->sort = @$dataSend['sort'];
					$datalayer->updated_at = date('Y-m-d H:i:s');

					// lưu data 
					$modelProductDetail->save($datalayer);
					$return = array('code'=>1, 'mess'=>'Bạn sửa layer thành công');
				}else{
					$return = array('code'=>4, 'mess'=>'Layer bạn không dúng');
				}
				
			}else{
				$return = array('code'=>3, 'mess'=>'Sản phẩm này không dùng');
			}
		}else{
			
			$return = array('code'=>2, 'mess'=>'Bạn chưa đăng nhập');
		}

	}
	return $return;
}

function updateListLayerAPI($input){
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
		$user = $modelMember->find()->where(array('token'=> $dataSend['token']))->first();;
		
		if(!empty($user)){
			// lấy tk người dùng 
			$dataProduct = $modelProduct->find()->where(array('id'=>$dataSend['idProduct'], 'user_id'=>$user->id))->first();
			if (!empty($dataProduct)) {
				$data = str_replace(array("\r", "\n"), '', $dataSend['listLayer']);
				$data = str_replace('\"', '"', $data);
				$listData = json_decode($data, true);
				
				foreach($listData as $key => $item){
				 	$datalayer = $modelProductDetail->find()->where(array('id'=>$item['id'], 'products_id'=>$dataSend['idProduct']))->first();
				 	if(!empty($datalayer)){
					 	$datalayer->content = json_encode($item['content']);
					 	$datalayer->updated_at = date('Y-m-d H:i:s');
					 	$datalayer->sort = @$item['sort'];
					 	$modelProductDetail->save($datalayer);
				 	}
				}

				//$returnExport = exportImageThumb($dataSend['idProduct']);
					
				$return = array('code'=>1, 'mess'=>'Bạn sửa list layer thành công', 'link'=>@$returnExport['link']);
			}else{
				$return = array('code'=>3, 'mess'=>'Sản phẩm này không dùng');
			}
		}else{
			
			$return = array('code'=>2, 'mess'=>'Bạn chưa đăng nhập');
		}

	}
	return $return;
}

function saveImageProductAPI($input){
	global $session;
    global $isRequestPost;
    global $controller;

    $modelProduct = $controller->loadModel('Products');
    $modelProductDetail = $controller->loadModel('ProductDetails');

	$modelMember = $controller->loadModel('Members');
	$return = array('code'=>0);

    if($isRequestPost){
        
        $dataSend = $input['request']->getData();

        $user = $modelMember->find()->where(array('token'=>$dataSend['token']))->first();
        if(!empty($user)){
	        $dataProduct = $modelProduct->find()->where(array('id'=>$dataSend['idProduct'],'user_id'=>$user->id))->first();
	        if(!empty($dataProduct)){
	        	if(!empty($_FILES["file"]["name"])){
	                $file = '';	                

	                if(isset($_FILES["file"]) && empty($_FILES["file"]["error"])){
		                $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
		                $filename = $_FILES["file"]["name"];
		                $filetype = $_FILES["file"]["type"];
		                $filesize = $_FILES["file"]["size"];
		                
		                // Verify file extension
		                $ext = pathinfo($filename, PATHINFO_EXTENSION);
		                if(!array_key_exists($ext, $allowed)) $mess= '<h3 class="color_red">File upload không đúng định dạng ảnh</h3>';
		                
		                // Verify file size - 1MB maximum
		                $maxsize = 1024 * 1024;
		                if($filesize > $maxsize) $mess= '<h3 class="color_red">File ảnh vượt quá giới hạn cho phép 1Mb</h3>';
		                
		                // Verify MYME type of the file
		                if(in_array($filetype, $allowed)){
		                    // Check whether file exists before uploading it
		                    move_uploaded_file($_FILES["file"]["tmp_name"], __DIR__.'/../../../upload/admin/images/'.$dataProduct->user_id.'/thumb_product_'.$dataProduct->id.'.png');

		                    $image = 'https://apis.ezpics.vn/upload/admin/images/'.$dataProduct->user_id.'/thumb_product_'.$dataProduct->id.'.png?time='.time();
		                    
		                } else{
		                    $mess= '<h3 class="color_red">Upload dữ liệu bị lỗi</h3>';
		                }
		            }
	               	$dataProduct->image = $image;
                	$dataProduct->zipThumb = 0;
            
	                $modelProduct->save($dataProduct);
	                $return = array('code'=>1, 'mess'=>'Lưu ảnh thành công', 'link'=>@$image);
	            }

	    	
	    	}else{
				$return = array('code'=>3, 'mess'=>'Sản phẩm này không dùng');
			}

	    }else{
	        $return = array('code'=>2, 'mess'=>'Bạn chưa đăng nhập');
	    }


    }
    return $return;

}
?>

