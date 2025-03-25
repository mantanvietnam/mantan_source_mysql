<?php 
function searchProductApi($input)
{
	global $controller;
	global $session;
	

	$return = [];

	if(!empty($session->read('infoUser'))){
		$modelProducts = $controller->loadModel('Products');

		if(!empty($_GET['key'])){
            $conditions = array('id_member'=>$session->read('infoUser')->id_member,'id_spa'=>$session->read('id_spa'));
            $conditions['OR'] = [['name LIKE' => '%'.$_GET['key'].'%'], ['code' => $_GET['key']]];
          
            $order = array('name' => 'asc');

            $listData = $modelProducts->find()->where($conditions)->order($order)->all()->toList();
            
            if($listData){
                foreach($listData as $data){
                    $return[]= array('id'=>$data->id,
                    				'label'=>$data->name.' '.number_format($data->price).'đ',
                    				'value'=>$data->id,
                    				'name'=>$data->name,
                    				'price'=>$data->price,
                    				'quantity'=>$data->quantity,
                    				'code'=>$data->code,
                    				'price'=>$data->price,
                    			);
                }
            }
        }
	}

	return $return;
}

function listProductAPI($input){
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $urlCurrent;
    global $controller;
    global $isRequestPost;

    if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listProduct','product');
			if(!empty($infoUser)){
		        $modelProduct = $controller->loadModel('Products');

				$conditions = array('id_member'=>$infoUser->id_member, 'id_spa'=>$infoUser->id_spa);
				$limit = 20;
				$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
				if($page<1) $page = 1;
				$order = array('id'=>'desc');

				if(!empty($dataSend['code'])){
		            $conditions['code'] =  $dataSend['code'];
		        }
		        
		        if(!empty($dataSend['id_category'])){
		            $conditions['id_category'] = $dataSend['id_category'];
		        }

				if(isset($dataSend['status'])){
		            if($dataSend['status']!=''){
		                $conditions['status'] = $dataSend['status'];
		            }
		        }

				if(!empty($dataSend['name'])){
					$conditions['name LIKE'] = '%'.$dataSend['name'].'%';
				}
			    
		        $listData = $modelProduct->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

			    $totalData = $modelProduct->find()->where($conditions)->count();

	    		return apiResponse(1,'lấy dữ liệu thành công',$listData, $totalData);		  	
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}

function detailProductAPI($input){	
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    $modelMembers = $controller->loadModel('Members');
	$modelSpas = $controller->loadModel('Spas');
	$modelProduct = $controller->loadModel('Products');
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token']) && !empty($dataSend['id'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listProduct','product');
			if(!empty($infoUser)){

	        $data = $modelProduct->find()->where(['id'=> (int) $dataSend['id'], 'id_member'=>$infoUser->id_member])->first();
	        if(!empty($data)){
			    return apiResponse(1,'Bạn lấy dữ liệu thành công',$data);
			}
			return apiResponse(4,'Dữ liệu không tồn tại' );
		}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}

function addProductAPI($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;
    global $urlHomes;


    if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token']) && !empty($dataSend['name'])){
			$infoUser = getMemberByToken($dataSend['token'], 'addProduct','product');
			if(!empty($infoUser)){
		        $modelMembers = $controller->loadModel('Members');
				$modelProduct = $controller->loadModel('Products');
		        $modelTrademarks = $controller->loadModel('Trademarks');


		        // lấy data edit
		        if(!empty($dataSend['id'])){
		            $data = $modelProduct->get( (int) $dataSend['id']);
		        }else{
		            $data = $modelProduct->newEmptyEntity();
		            $data->created_at = time();
		        }

                if(isset($_FILES['image']) && empty($_FILES['image']["error"])){
						$image = uploadImage($infoUser->phone, 'image', 'image_service'.time());
				}
				if(!empty($image['linkOnline'])){
					$data->image = $image['linkOnline'].'?time='.time();
			    }

			    if(empty($data->image)){
			    	$data->image = $urlHomes.'/plugins/databot_spa/view/home/assets/img/default-thumbnail.png';
			    }
                if(empty($dataSend['code']) && empty($dataSend['id'])) $dataSend['code'] = createToken(10);

                // tạo dữ liệu save
                if(!empty($dataSend['name'])){
                	$data->name = @$dataSend['name'];
            	}
                $data->updated_at = time();
                if(!empty($dataSend['code'])){
                	$data->code = @$dataSend['code'];
                }
            	if(!empty($dataSend['id_category'])){
                	$data->id_category =(int) @$dataSend['id_category'];
            	}

            

            	if(!empty($dataSend['id_trademark'])){
                	$data->id_trademark =(int) @$dataSend['id_trademark'];
            	}
           		
           		if(!empty($dataSend['description'])){
                $data->description = @$dataSend['description'];
                }
                $data->id_member = $infoUser->id_member;
               	$data->id_spa = (int) $infoUser->id_spa;

	            if(!empty($dataSend['price'])){
	                $data->price = (int)@$dataSend['price'];
	            }
	            if(isset($dataSend['status'])){
	                $data->status = @$dataSend['status'];
	            }
	            if(!empty($dataSend['duration'])){
	                $data->duration = @$dataSend['duration'];
	            }
	            if(!empty($dataSend['commission_staff_fix'])){
	                $data->commission_staff_fix = (int) @$dataSend['commission_staff_fix'];
	            }
	            if(!empty($dataSend['commission_staff_percent'])){
	                $data->commission_staff_percent = (int) @$dataSend['commission_staff_percent'];
	            }
	            if(!empty($dataSend['commission_affiliate_fix'])){
	                $data->commission_affiliate_fix = (int) @$dataSend['commission_affiliate_fix'];
	            }
	            if(!empty($dataSend['commission_affiliate_percent'])){
	                $data->commission_affiliate_percent = (int) @$dataSend['commission_affiliate_percent'];
	            }
                
                $data->slug = createSlugMantan(trim($dataSend['name'])).'-'.time();
                
                $modelProduct->save($data);

                return apiResponse(1,'Lưu dữ liệu thành công',$data);
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}

	return apiResponse(0,'Gửi sai phương thức POST');
}

function deleteProductAPI($input){
    global $controller;
    global $session;

    $modelService = $controller->loadModel('Services');
    $modelOrderDetails = $controller->loadModel('OrderDetails');

    if(!empty(checkLoginManager('deleteService', 'product'))){
        $infoUser = $session->read('infoUser');
        $modelCombo = $controller->loadModel('Combos');

        

        if(!empty($dataSend['id'])){
            $data = $modelService->get($dataSend['id']);

            $checkCombo = $modelCombo->find()->where(array('id_member'=>$infoUser->id_member))->all()->toList();

            if(!empty($checkCombo)){
                foreach($checkCombo as $key => $item){
                    if(!empty($item->service)){
                        $service = json_decode(@$item->service, true);
                        foreach($service as $k => $value){
                            if($k==$data->id){
                                return $controller->redirect('/listService?error=requestDelete');
                            }
                        }
                    }
                }
            }

            $checkOrder = $modelOrderDetails->find()->where(array('id_product'=>$data->id,'type'=>'service','id_member'=>$infoUser->id_member))->all()->toList();

            if(!empty($checkOrder)){
                return $controller->redirect('/listService?error=requestDelete');

            }
            
            if($data){
                $modelService->delete($data);
                return $controller->redirect('/listService?error=requestDeleteSuccess');
            }
        }

        return $controller->redirect('/listService');
    }else{
        return $controller->redirect('/');
    }
}

function listCategoryProductAPI($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listCategoryProduct','product');
			if(!empty($infoUser)){ 
				$limit = 20;
				$order = ['status'=>'desc','id' => 'DESC'];

				$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
				if($page<1) $page = 1;
		        $conditions = array('type' => 'category_product', 'id_member'=>$infoUser->id_member);
		        $listData = $modelCategories->find()->limit($limit)->page($page)->where($conditions)->all()->toList();
		        $totalData = $modelCategories->find()->where($conditions)->count();

		      	return apiResponse(1,'lấy dữ liệu thành công',$listData, $totalData);		  	
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}

function addCategoryProductAPI($input){	
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    $modelMembers = $controller->loadModel('Members');
	$modelSpas = $controller->loadModel('Spas');
	$modelMemberGroup = $controller->loadModel('MemberGroups');
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token']) && !empty($dataSend['name'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listCategoryProduct','staff');
			if(!empty($infoUser)){

		// lấy data edit
	    if(!empty($dataSend['id'])){
	        $data = $modelCategories->find()->where(['id'=> (int) $dataSend['id'], 'type'=>'category_product'])->first();
	    }else{
	        $data = $modelCategories->newEmptyEntity();
	        $data->created_at = time();
	    }
	  
	        	// tạo dữ liệu save
			    $data->name = @$dataSend['name'];
			    $data->type = 'category_product';
			    $data->slug = createSlugMantan($data->name).'-'.time();

			    $modelCategories->save($data);

			    return apiResponse(1,'Lưu dữ liệu thành công',$data);
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}

	return apiResponse(0,'Gửi sai phương thức POST');
}

function detailCategoryProductAPI($input){	
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    $modelMembers = $controller->loadModel('Members');
	$modelSpas = $controller->loadModel('Spas');
	$modelMemberGroup = $controller->loadModel('MemberGroups');
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token']) && !empty($dataSend['id'])){
			$infoUser = getMemberByToken($dataSend['token'], 'deleteCategoryProduct','product');
			if(!empty($infoUser)){

	        $data = $modelCategories->find()->where(['id'=> (int) $dataSend['id'], 'type'=>'category_product'])->first();
	        if(!empty($data)){
			    return apiResponse(1,'Bạn lấy dữ liệu thành công',$data);
			}
			return apiResponse(4,'Dữ liệu không tồn tại' );
		}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}

function deleteCategoryProductAPI($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;


        $infoUser = $session->read('infoUser');
        $modelProduct = $controller->loadModel('Products');
    if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token']) && !empty($dataSend['id'])){
			$infoUser = getMemberByToken($dataSend['token'], 'deleteCategoryProduct','product');
			if(!empty($infoUser)){
	            $conditions = array('id'=> $dataSend['id'], 'type' => 'category_product', 'id_member'=>$infoUser->id_member);
	            
	            $data = $modelCategories->find()->where($conditions)->first();

	            $checkSevice = $modelProduct->find()->where(array('id_category'=>$data->id))->all()->toList();
	            if(empty($checkSevice)){
	                if(!empty($data)){
	                    $modelCategories->delete($data);
	                    return apiResponse(1,'Xóa dữ liệu thành công');
				}
				return apiResponse(4,'Dữ liệu không tồn tại' );
			}
			return apiResponse(5,'không xóa được dữ liệu' );
		}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}

function listTrademarkProductAPI($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $controller;
    global $session;
    $modelTrademark = $controller->loadModel('Trademarks');

    if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listTrademarkProduct','product');
			if(!empty($infoUser)){ 
				$limit = 20;
				$order = ['status'=>'desc','id' => 'DESC'];

				$page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
				if($page<1) $page = 1;
		        $conditions = array('id_member'=>$infoUser->id_member);
		        $listData = $modelTrademark->find()->limit($limit)->page($page)->where($conditions)->all()->toList();
		        $totalData = $modelTrademark->find()->where($conditions)->count();

		      	return apiResponse(1,'lấy dữ liệu thành công',$listData, $totalData);		  	
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}

function addTrademarkProductAPI($input){	
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    $modelMembers = $controller->loadModel('Members');
	$modelSpas = $controller->loadModel('Spas');
    $modelTrademark = $controller->loadModel('Trademarks');
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token']) && !empty($dataSend['name'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listTrademarkProduct','staff');
			if(!empty($infoUser)){

				// lấy data edit
			    if(!empty($dataSend['id'])){
			        $data = $modelTrademark->find()->where(['id'=> (int) $dataSend['id'], 'id_member'=>$infoUser->id_member])->first();
			    }else{
			        $data = $modelTrademark->newEmptyEntity();
			        $data->created_at = time();
			    }
		  
		        	// tạo dữ liệu save
	            $data->name = str_replace(array('"', "'"), '’', $dataSend['name']);
	            $data->id_member = $infoUser->id_member;
	            $data->description = str_replace(array('"', "'"), '’', @$dataSend['description']);
	            // tạo slug
	            $data->slug = createSlugMantan($data->name).'-'.time();

			    $modelTrademark->save($data);

			    return apiResponse(1,'Lưu dữ liệu thành công',$data);
			}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}

	return apiResponse(0,'Gửi sai phương thức POST');
}

function detailTrademarkProductAPI($input){	
	global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;
    global $urlCurrent;

    $modelMembers = $controller->loadModel('Members');
	$modelSpas = $controller->loadModel('Spas');
    $modelTrademark = $controller->loadModel('Trademarks');
	if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token']) && !empty($dataSend['id'])){
			$infoUser = getMemberByToken($dataSend['token'], 'listTrademarkProduct','product');
			if(!empty($infoUser)){

	        $data = $modelTrademark->find()->where(['id'=> (int) $dataSend['id'], 'id_member'=>$infoUser->id_member])->first();
	        if(!empty($data)){
			    return apiResponse(1,'Bạn lấy dữ liệu thành công',$data);
			}
			return apiResponse(4,'Dữ liệu không tồn tại' );
		}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}

function deleteTrademarkProductAPI($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $controller;


    $infoUser = $session->read('infoUser');
    $modelProduct = $controller->loadModel('Products');
    $modelTrademark = $controller->loadModel('Trademarks');
    if($isRequestPost){
		$dataSend = $input['request']->getData();
		if(!empty($dataSend['token']) && !empty($dataSend['id'])){
			$infoUser = getMemberByToken($dataSend['token'], 'deleteTrademarkProduct','product');
			if(!empty($infoUser)){
	            $conditions = array('id'=> $dataSend['id'], 'id_member'=>$infoUser->id_member);
	            
	            $data = $modelTrademark->find()->where($conditions)->first();

	            $checkSevice = $modelProduct->find()->where(array('id_trademark'=>$data->id))->all()->toList();
	            if(empty($checkSevice)){
	                if(!empty($data)){
	                    $modelTrademark->delete($data);
	                    return apiResponse(1,'Xóa dữ liệu thành công');
				}
				return apiResponse(4,'Dữ liệu không tồn tại' );
			}
			return apiResponse(5,'không xóa được dữ liệu' );
		}
			return apiResponse(3,'Tài khoản không tồn tại' );
		}
		return apiResponse(2,'thếu dữ liệu' );
	}
	return apiResponse(0,'Gửi sai phương thức POST');
}
?>