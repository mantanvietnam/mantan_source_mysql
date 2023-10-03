<?php 
function listProductAdmin($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;

    $metaTitleMantan = 'Danh sách mẫu thiết kế';

	$modelMembers = $controller->loadModel('Members');
	$modelProducts = $controller->loadModel('Products');

	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
	$order = array('id'=>'desc');

	if(!empty($_GET['order'])){
		if($_GET['order']==1){
			$order = array('sold'=>'desc');
		}elseif($_GET['order']==2){
			$order = array('views'=>'desc');
		}
	}

	if(!isset($_GET['type'])) $_GET['type'] = 'user_create';
	//if(!isset($_GET['status'])) $_GET['status'] = 1;

	if(!empty($_GET['id'])){
		$conditions['id'] = (int) $_GET['id'];
	}

	if(!empty($_GET['phone'])){
		$conditionsMember['phone'] = str_replace([' ','.','-'],'',$_GET['phone']);
		$member = $modelMembers->find()->where($conditionsMember)->first();
		if(!empty($member)){
			$conditions['user_id'] = (int) $member->id;
		}else{
			$conditions['user_id'] = 0;
		}
	}

	if(!empty($_GET['category_id'])){
		$conditions['category_id'] = $_GET['category_id'];
	}

	if(!empty($_GET['type'])){
		$conditions['type'] = $_GET['type'];
	}

	if(isset($_GET['status'])){
		if($_GET['status']!=''){
			$conditions['status'] = $_GET['status'];
		}
	}

	if(!empty($_GET['name'])){
		$conditions['OR'] = [
								['name LIKE'=>'%'.$_GET['name'].'%'],
								['keyword LIKE'=>'%'.$_GET['name'].'%']
							];
	}

	if(!empty($_GET['date_start'])){
		$date_start = explode('/', $_GET['date_start']);
		$date_start = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
		$conditions['created_at >='] = date('Y-m-d H:i:s', $date_start);
	}

	if(!empty($_GET['date_end'])){
		$date_end = explode('/', $_GET['date_end']);
		$date_end = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
		$conditions['created_at <='] = date('Y-m-d H:i:s', $date_end);
	}

    $listData = $modelProducts->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
    	foreach ($listData as $key => $value) {
    		$listData[$key]->designer = $modelMembers->get($value->user_id);
    	}
    }

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

    $conditions = array('type'=>'product_categories');
	$order = array('name'=>'asc');
	$listCategory = $modelCategories->find()->where($conditions)->order($order)->all()->toList();

    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    setVariable('totalData', $totalData);

    
    
    setVariable('listData', $listData);
    setVariable('listCategory', $listCategory);
}

function listProductTrendAdmin($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;

    $metaTitleMantan = 'Danh sách mẫu thiết kế';

	$modelMembers = $controller->loadModel('Members');
	$modelProducts = $controller->loadModel('Products');

	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
	$order = array('id'=>'desc');

	if(!isset($_GET['type'])) $_GET['type'] = 'user_create';
	//if(!isset($_GET['status'])) $_GET['status'] = 1;

	if(!empty($_GET['id'])){
		$conditions['id'] = (int) $_GET['id'];
	}

	if(!empty($_GET['phone'])){
		$conditionsMember['phone'] = str_replace([' ','.','-'],'',$_GET['phone']);
		$member = $modelMembers->find()->where($conditionsMember)->first();
		if(!empty($member)){
			$conditions['user_id'] = (int) $member->id;
		}else{
			$conditions['user_id'] = 0;
		}
	}

	if(!empty($_GET['category_id'])){
		$conditions['category_id'] = $_GET['category_id'];
	}

	if(!empty($_GET['type'])){
		$conditions['type'] = $_GET['type'];
	}

	
		$conditions['status'] = 2;
		

	if(!empty($_GET['name'])){
		$conditions['OR'] = [
								['name LIKE'=>'%'.$_GET['name'].'%'],
								['keyword LIKE'=>'%'.$_GET['name'].'%']
							];
	}

	if(!empty($_GET['date_start'])){
		$date_start = explode('/', $_GET['date_start']);
		$date_start = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
		$conditions['created_at >='] = date('Y-m-d H:i:s', $date_start);
	}

	if(!empty($_GET['date_end'])){
		$date_end = explode('/', $_GET['date_end']);
		$date_end = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
		$conditions['created_at <='] = date('Y-m-d H:i:s', $date_end);
	}

	$conditions['trend'] = 1;

    $listData = $modelProducts->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    if(!empty($listData)){
    	foreach ($listData as $key => $value) {
    		$listData[$key]->designer = $modelMembers->get($value->user_id);
    	}
    }

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

    $conditions = array('type'=>'product_categories');
	$order = array('name'=>'asc');
	$listCategory = $modelCategories->find()->where($conditions)->order($order)->all()->toList();

	$mess = '';
	if(isset($_GET['mess'])){
		if(@$_GET['mess']==0){
	        $mess= '<p class="text-success" style="padding-left: 1.5em;">Bỏ mẫu thiết kế thành công</p>';
	    }elseif(@$_GET['mess']==1){
	        $mess= '<p class="text-success" style="padding-left: 1.5em;">Thêm mẫu thiết kế thành công</p>';
	    }elseif(@$_GET['mess']==2){
	        $mess= '<p class="text-success" style="padding-left: 1.5em;">Sản phẩm này chưa được duyệt</p>';
	    }
	}

    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    setVariable('totalData', $totalData);
    
    setVariable('listData', $listData);
    setVariable('listCategory', $listCategory);
    setVariable('mess', $mess);
}

function lockProductAdmin($input)
{
	global $controller;

	$modelProducts = $controller->loadModel('Products');
	$modelmember = $controller->loadModel('Members');
	
	if(!empty($_GET['id'])){
		$data = $modelProducts->get($_GET['id']);
		if($data){
			$member = $modelmember->get($data->user_id);	

			$data->status = (int) $_GET['status'];
			if($_GET['status']==2){
				$data->approval_date = date('Y-m-d H:i:s');
			}else{
				$data->approval_date = null;
			}

         	$modelProducts->save($data);

         	@$conditions = array();

         	$conditions['user_id'] = (int) $data->user_id;
         	$conditions['status'] = 2;

         	$totalData = $modelProducts->find()->where($conditions)->all()->toList();
    		$totalData = count($totalData);

         	if($_GET['status']==2){
    			if($totalData == 10){
    				$member->level = 1;
    			}elseif($totalData == 30){
    				$member->level = 2;
    			}elseif($totalData == 50){
    				$member->level = 3;
    			}elseif($totalData == 100){
    				$member->level = 4;
    			}elseif($totalData == 300){
    				$member->level = 5;
    			}elseif($totalData == 500){
    				$member->level = 6;
    			}elseif($totalData == 1000){
    				$member->level = 7;
    			}elseif($totalData == 3000){
    				$member->level = 8;
    			}elseif($totalData == 5000){
    				$member->level = 9;
    			}elseif($totalData == 10000){
    				$member->level = 10;
    			}

                $dataSendNotification= array('ìd'=>$data->id, 'title'=>'Sản phẩm mới đã được duyệt','time'=>date('H:i d/m/Y'),'content'=>'Chúng tôi vui mừng thông báo rằng mẫu thiết kế "'.$data->name.'" của bạn đã được duyệt và có thể đăng bán. Cảm ơn bạn vì đã gửi mẫu thiết kế cho chúng tôi !','action'=>'productNew');
                if(!empty($member->token_device)){
                	sendNotification($dataSendNotification, $member->token_device);
                }
                sendEmailsuccessfulProduct($member->email, $member->name,$data->name );
            }else{
            	if($totalData = 9){
    				$member->level = 0;
    			}elseif($totalData == 29){
    				$member->level = 1;
    			}elseif($totalData == 49){
    				$member->level = 2;
    			}elseif($totalData == 99){
    				$member->level = 3;
    			}elseif($totalData == 299){
    				$member->level = 4;
    			}elseif($totalData == 499){
    				$member->level = 5;
    			}elseif($totalData == 999){
    				$member->level = 6;
    			}elseif($totalData == 2999){
    				$member->level = 7;
    			}elseif($totalData == 4999){
    				$member->level = 8;
    			}elseif($totalData == 9999){
    				$member->level = 9;
    			}

    			if(!empty($_GET['note'])){
                	$dataSendNotification= array('title'=>'Mẫu thiết kế không được duyệt','time'=>date('H:i d/m/Y'),'content'=>'Lí do từ chối của mẫu "'.$data->name.'" là: '.$_GET['note'] ,'action'=>'adminSendNotification');
            	}else{
            		$dataSendNotification= array('title'=>'Mẫu thiết kế không được duyệt','time'=>date('H:i d/m/Y'),'content'=>'Rất tiếc vì mẫu thiết kế của bạn chưa được duyệt. Bạn vui lòng kiểm tra lại mẫu thiết kế "'.$data->name.'"','action'=>'adminSendNotification');
            	}
            	if(!empty($member->token_device)){
                	sendNotification($dataSendNotification, $member->token_device);
            	}
                sendEmailunsuccessfulProduct($member->email, $member->name, $data->name, $_GET['note']);
            }
            
            $modelmember->save($member);
            
        }
	}

	if(!empty($_GET['page'])){
		return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-product-listProductAdmin.php?page='.$_GET['page']);
	}else{
		return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-product-listProductAdmin.php');
	}

	
}


function deleteProductAdmin($input){
	global $controller;

	$modelProduct = $controller->loadModel('Products');
	$modelMember = $controller->loadModel('Members');
	$modelProductDetail = $controller->loadModel('ProductDetails');
	$modelProductFavorite = $controller->loadModel('ProductFavorite');
	
	if(!empty($_GET['id'])){
		$data = $modelProduct->get($_GET['id']);
		
		if($data){
         	// xóa mẫu thiết kế
			$modelProduct->delete($data);

			// xóa layer
			$conditions = ['products_id'=>$data->id];
			$modelProductDetail->deleteAll($conditions);

			// xóa yêu thích
			$conditions = ['product_id'=>$data->id];
			$modelProductFavorite->deleteAll($conditions);
        }
	}

	return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-product-listProductAdmin.php');
}

function addTrendProductAdmin($input)
{
	global $controller;

	$modelProducts = $controller->loadModel('Products');
	$modelmember = $controller->loadModel('Members');
	
	if(!empty($_GET['id'])){
		$data = $modelProducts->find()->where(array('id'=>$_GET['id'],'status'=>2))->first();
		if($data){
			if(isset($_GET['status'])){
				$data->trend =$_GET['status'];
         		$modelProducts->save($data);

         		if(!empty($_GET['page'])){
					return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-product-listProductTrendAdmin.php?mess='.$_GET['status'].'&page='.$_GET['page']);
				}else{
					return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-product-listProductTrendAdmin.php?mess='.$_GET['status']);
				}
        	}
        }else{
        	if(!empty($_GET['page'])){
					return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-product-listProductTrendAdmin.php?mess=2page='.$_GET['page']);
				}else{
					return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-product-listProductTrendAdmin.php?mess=2');
				}
        }
	}	
}

function updateProductAdmin($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $ftp_server_upload_image;
	global $ftp_username_upload_image;
	global $ftp_password_upload_image;

	$modelProduct = $controller->loadModel('Products');
	$modelMember = $controller->loadModel('Members');
	$modelProductDetail = $controller->loadModel('ProductDetails');
	$modelManagerFile = $controller->loadModel('ManagerFile');
	$modelWarehouses = $controller->loadModel('Warehouses');
	$modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
	
	if(!empty($_GET['id'])){
		 $mess = '';
		$data = $modelProduct->get($_GET['id']);
		if ($isRequestPost) {
	        $dataSend = $input['request']->getData();

	        if(!empty($dataSend['name'])){
	        	
        		if(!empty($data->thumn)){
        			$thumb = $data->thumn;
        		}else{
        			$thumb = 'https://apis.ezpics.vn/plugins/ezpics_api/view/image/default-thumbnail.jpg';
        		}

	        	if(!empty($_FILES['background']['name']) && empty($_FILES['background']["error"])){
		            $background = uploadImageFTP($data->user_id, 'background', $ftp_server_upload_image, $ftp_username_upload_image, $ftp_password_upload_image, 'https://apis.ezpics.vn/');

		            if(!empty($background['linkOnline'])){
		                $thumb = $background['linkOnline'];

		                // lưu vào database file
		                $dataFile = $modelManagerFile->newEmptyEntity();

		                $dataFile->link = $background['linkOnline'];
		                $dataFile->user_id = $data->user_id;
		                $dataFile->type = 0; // 0 là user up, 1 là cap, 2 là payment
		                $dataFile->created_at = date('Y-m-d H:i:s');

		                $modelManagerFile->save($dataFile);
		            }
		        }

		        if(!empty($data->thumbnail)){
        			$thumbnailUser = $data->thumbnail;
        		}else{
        			$thumbnailUser = '';
        		}

		        if(!empty($_FILES['thumbnail']['name']) && empty($_FILES['thumbnail']["error"])){
		            $thumbnail = uploadImageFTP($data->user_id, 'thumbnail', $ftp_server_upload_image, $ftp_username_upload_image, $ftp_password_upload_image, 'https://apis.ezpics.vn/');

		            if(!empty($thumbnail['linkOnline'])){
		                $thumbnailUser = $thumbnail['linkOnline'];

		                // lưu vào database file
		                $dataFile = $modelManagerFile->newEmptyEntity();

		                $dataFile->link = $thumbnail['linkOnline'];
		                $dataFile->user_id = $data->user_id;
		                $dataFile->type = 1; // 0 là user up, 1 là cap, 2 là payment
		                $dataFile->created_at = date('Y-m-d H:i:s');

		                $modelManagerFile->save($dataFile);
		            }
		        }

		        // tạo dữ liệu save
		        $data->name = $dataSend['name'];
		        $data->price = (int) @$dataSend['price'];
		        $data->sale_price = (int) @$dataSend['sale_price'];
		       // $data->content = @$dataSend['content'];
		        $data->sale = null;
		        $data->related_packages = null;
				
		        $data->sold = 0;
		        if(empty($data->image)) $data->image = $thumb;
		        $data->thumn = $thumb;
		        $data->product_id = 0;
		        $data->note_admin = '';
		        $data->created_at = date('Y-m-d H:i:s');
		        $data->views = 0;
		        $data->favorites = 0;
		        $data->category_id = $dataSend['category_id'];
		        $data->thumbnail = $thumbnailUser;
		        $data->keyword = $dataSend['keyword'];
		        $data->description = $dataSend['description'];
		        $data->free_pro = (int) @$dataSend['free_pro'];
		        $data->color = @$dataSend['color'];
		        
		        if(empty($dataSend['size'])){
		        	$sizeThumb = getimagesize($thumb);

			        $data->width = $sizeThumb[0];
			        $data->height = $sizeThumb[1];
		        }else{
		        	$size = explode('-', $dataSend['size']);
		        	$data->width = $size[0];
			        $data->height = $size[1];
		        }

		        // tạo slug
	            $slug = createSlugMantan($dataSend['name']);
	            $slugNew = $slug;
	            $number = 0;

	            if(empty($data->slug) || $data->slug!=$slugNew){
	                do{
	                	$conditions = array('slug'=>$slugNew);
	        			$listData = $modelProduct->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

	        			if(!empty($listData)){
	        				$number++;
	        				$slugNew = $slug.'-'.$number;
	        			}
	                }while (!empty($listData));
	            }

	            $data->slug = $slugNew;

		        $modelProduct->save($data);

		        if(empty($_GET['id'])){
			        // tạo link deep
		            $url_deep = 'https://firebasedynamiclinks.googleapis.com/v1/shortLinks?key=AIzaSyC2G5JcjKx1Mw5ZndV4cfn2RzF1SmQZ_O0';
		            $data_deep = ['dynamicLinkInfo'=>[  'domainUriPrefix'=>'https://ezpics.page.link',
		                                                'link'=>'https://ezpics.page.link/detailProduct?id='.$data->id.'&type='.$data->type,
		                                                'androidInfo'=>['androidPackageName'=>'vn.ezpics'],
		                                                'iosInfo'=>['iosBundleId'=>'vn.ezpics.ezpics']
		                                        ]
		                        ];
		            $header_deep = ['Content-Type: application/json'];
		            $typeData='raw';
		            $deep_link = sendDataConnectMantan($url_deep,$data_deep,$header_deep,$typeData);
		            $deep_link = json_decode($deep_link);

		            $data->link_open_app = @$deep_link->shortLink;
		            $modelProduct->save($data);

		            // tạo layer mặc định đầu tiên
			        $sizeBackground = getimagesize($thumb);
			        $newLayer = $modelProductDetail->newEmptyEntity();  

			        $newLayer->products_id = $data->id;
			        $newLayer->name = 'Layer 1';
			        $newLayer->sort = 1;
			        
			        $content = getLayer(1,'text','',80,0,'Layer 1');
			        $newLayer->content = json_encode($content);

			        $newLayer->created_at = date('Y-m-d H:i:s');
			        
			        $modelProductDetail->save($newLayer);
	        	}

		        // lưu mẫu vào kho
		        if(!empty($dataSend['warehouse'])){
		        	$conditions = ['product_id'=>$data->id];
		        	$modelWarehouseProducts->deleteAll($conditions);

		        	foreach ($dataSend['warehouse'] as $warehouse_id) {
		        		$warehouse_products = $modelWarehouseProducts->newEmptyEntity();

		        		$warehouse_products->warehouse_id = $warehouse_id;
		        		$warehouse_products->product_id = $data->id;
		        		$warehouse_products->user_id = $data->user_id;

		        		$modelWarehouseProducts->save($warehouse_products);

		        		$totalProducts = count($modelWarehouseProducts->find()->where(['warehouse_id'=>$warehouse_id])->all()->toList());
		        		$listWarehouse = $modelWarehouses->get($warehouse_id);
		        		$listWarehouse->number_product = $totalProducts;
		        		$modelWarehouses->save($listWarehouse);
		        	}
		        }

		        return $controller->redirect('/plugins/admin/ezpics_admin-view-admin-product-listProductAdmin.php');
		    }else{
		    	$mess= '<p class="text-danger">Bạn chưa nhập tên mẫu thiết kế</p>';
		    }
	    }

	    $conditions = array('type' => 'product_categories');
	    $listCategory = $modelCategories->find()->where($conditions)->all()->toList();

	    $conditions = array('user_id'=>$data->user_id);
	    $listWarehouse = $modelWarehouses->find()->where($conditions)->all()->toList();

	    $listWarehouseCheck = [];
	    if(!empty($data->id)){
			$listCheck = $modelWarehouseProducts->find()->where(['product_id'=>$data->id])->all()->toList();

			if(!empty($listCheck)){
				foreach ($listCheck as $check) {
					$listWarehouseCheck[] = $check->warehouse_id;
				}
			}
		}	

	    setVariable('data', $data);
	    setVariable('mess', $mess);
	    setVariable('listCategory', $listCategory);
	    setVariable('listWarehouse', $listWarehouse);
	    setVariable('listWarehouseCheck', $listWarehouseCheck);
	}
}
?>