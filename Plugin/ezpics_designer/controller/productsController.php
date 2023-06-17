<?php 
function listProduct($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Danh sách mẫu thiết kế  bán';

		$modelMembers = $controller->loadModel('Members');
		$modelProducts = $controller->loadModel('Products');
		$user = $session->read('infoUser');

		$conditions = array('user_id'=>$user->id);
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		$order = array('id'=>'desc');

		//if(!isset($_GET['type'])) $_GET['type'] = 'user_create';
		//if(!isset($_GET['status'])) $_GET['status'] = 1;

		if(!empty($_GET['id'])){
			$conditions['id'] = (int) $_GET['id'];
		}

		if(!empty($_GET['category_id'])){
			$conditions['category_id'] = $_GET['category_id'];
		}


		$conditions['type'] = 'user_create';

		if(!empty($_GET['type'])){
			$conditions['type'] = $_GET['type'];
		}

		if(isset($_GET['status'])){
			if($_GET['status']!=''){
				$conditions['status'] = $_GET['status'];
			}
		}

		if(!empty($_GET['name'])){
			$conditions['name LIKE'] = '%'.$_GET['name'].'%';
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
	}else{
		return $controller->redirect('/login');
	}
}

// danh sách mẫu thiết kế hàng loạt
function listProductSeries($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Danh sách mẫu thiết kế in hàng loạt';

		$modelMembers = $controller->loadModel('Members');
		$modelProducts = $controller->loadModel('Products');
		$user = $session->read('infoUser');

		$conditions = array('user_id'=>$user->id,'type'=>'user_series');
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		$order = array('id'=>'desc');

		if(!empty($_GET['id'])){
			$conditions['id'] = (int) $_GET['id'];
		}

		if(!empty($_GET['category_id'])){
			$conditions['category_id'] = $_GET['category_id'];
		}

		if(isset($_GET['status'])){
			if($_GET['status']!=''){
				$conditions['status'] = $_GET['status'];
			}
		}

		if(!empty($_GET['name'])){
			$conditions['name LIKE'] = '%'.$_GET['name'].'%';
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
	}else{
		return $controller->redirect('/login');
	}
}

function listProductbuy($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Danh sách mẫu thiết kế mua';

		$modelMembers = $controller->loadModel('Members');
		$modelProducts = $controller->loadModel('Products');
		$user = $session->read('infoUser');

		$conditions = array('user_id'=>$user->id);
		$limit = 20;
		$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
		if($page<1) $page = 1;
		$order = array('id'=>'desc');

		//if(!isset($_GET['type'])) $_GET['type'] = 'user_create';
		//if(!isset($_GET['status'])) $_GET['status'] = 1;

		if(!empty($_GET['id'])){
			$conditions['id'] = (int) $_GET['id'];
		}

		if(!empty($_GET['category_id'])){
			$conditions['category_id'] = $_GET['category_id'];
		}


		$conditions['type'] = 'user_edit';

		

		if(isset($_GET['status'])){
			if($_GET['status']!=''){
				$conditions['status'] = $_GET['status'];
			}
		}

		if(!empty($_GET['name'])){
			$conditions['name LIKE'] = '%'.$_GET['name'].'%';
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
	}else{
		return $controller->redirect('/login');
	}
}

function deleteProduct($input){
	global $controller;
	global $session;

	if(!empty($session->read('infoUser'))){
		$modelProduct = $controller->loadModel('Products');
		$modelMember = $controller->loadModel('Members');
		$modelProductDetail = $controller->loadModel('ProductDetails');
		$modelProductFavorite = $controller->loadModel('ProductFavorite');
		
		if(!empty($_GET['id'])){
			$data = $modelProduct->get($_GET['id']);
			$user = $session->read('infoUser');
			
			if($data && $data->user_id == $user->id){
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

		return $controller->redirect('/listProduct');
	}else{
		return $controller->redirect('/login');
	}
}

function addProduct($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $ftp_server_upload_image;
	global $ftp_username_upload_image;
	global $ftp_password_upload_image;

    if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Thông tin mẫu thiết kế';

		$modelProduct = $controller->loadModel('Products');
		$modelMember = $controller->loadModel('Members');
		$modelProductDetail = $controller->loadModel('ProductDetails');
		$modelManagerFile = $controller->loadModel('ManagerFile');
		$mess= '';

		// lấy data edit
	    $data = $modelProduct->newEmptyEntity();
	    $infoUser = $session->read('infoUser');

		if ($isRequestPost) {
	        $dataSend = $input['request']->getData();

	        if(!empty($dataSend['name'])){
	        	$thumb = 'https://apis.ezpics.vn/plugins/ezpics_api/view/image/default-thumbnail.jpg';
        		$thumbnailUser = '';

	        	if(isset($_FILES['background']) && empty($_FILES['background']["error"])){
		            $background = uploadImageFTP($infoUser->id, 'background', $ftp_server_upload_image, $ftp_username_upload_image, $ftp_password_upload_image, 'https://apis.ezpics.vn/');

		            if(!empty($background['linkOnline'])){
		                $thumb = $background['linkOnline'];

		                // lưu vào database file
		                $dataFile = $modelManagerFile->newEmptyEntity();

		                $dataFile->link = $background['linkOnline'];
		                $dataFile->user_id = $infoUser->id;
		                $dataFile->type = 0; // 0 là user up, 1 là cap, 2 là payment
		                $dataFile->created_at = date('Y-m-d H:i:s');

		                $modelManagerFile->save($dataFile);
		            }
		        }

		        if(isset($_FILES['thumbnail']) && empty($_FILES['thumbnail']["error"])){
		            $thumbnail = uploadImageFTP($infoUser->id, 'thumbnail', $ftp_server_upload_image, $ftp_username_upload_image, $ftp_password_upload_image, 'https://apis.ezpics.vn/');

		            if(!empty($thumbnail['linkOnline'])){
		                $thumbnailUser = $thumbnail['linkOnline'];

		                // lưu vào database file
		                $dataFile = $modelManagerFile->newEmptyEntity();

		                $dataFile->link = $thumbnail['linkOnline'];
		                $dataFile->user_id = $infoUser->id;
		                $dataFile->type = 1; // 0 là user up, 1 là cap, 2 là payment
		                $dataFile->created_at = date('Y-m-d H:i:s');

		                $modelManagerFile->save($dataFile);
		            }
		        }

		        // tạo dữ liệu save
		        $data->name = $dataSend['name'];
		        $data->price = (int) $dataSend['price'];
		        $data->sale_price = (int) $dataSend['sale_price'];
		        $data->content = null;
		        $data->sale = null;
		        $data->related_packages = null;
		        $data->status = 0;
		        $data->type = (!empty($_GET['type']) && $_GET['type']=='user_series')?'user_series':'user_create';
		        $data->sold = 0;
		        $data->image = $thumb;
		        $data->thumn = $thumb;
		        $data->user_id = $infoUser->id;
		        $data->product_id = 0;
		        $data->note_admin = '';
		        $data->created_at = date('Y-m-d H:i:s');
		        $data->views = 0;
		        $data->favorites = 0;
		        $data->category_id = $dataSend['category_id'];
		        $data->thumbnail = $thumbnailUser;
		        $data->keyword = $dataSend['keyword'];
		        $data->description = $dataSend['description'];

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

		        // tạo link deep
	            $url_deep = 'https://firebasedynamiclinks.googleapis.com/v1/shortLinks?key=AIzaSyC2G5JcjKx1Mw5ZndV4cfn2RzF1SmQZ_O0';
	            $data_deep = ['dynamicLinkInfo'=>[  'domainUriPrefix'=>'https://ezpics.page.link',
	                                                'link'=>'https://ezpics.page.link/detailProduct?id='.$data->id,
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

		        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
		    }else{
		    	$mess= '<p class="text-danger">Bạn chưa nhập tên mẫu thiết kế</p>';
		    }
	    }

	    $conditions = array('type' => 'product_categories');
	    $listCategory = $modelCategories->find()->where($conditions)->all()->toList();

	    setVariable('data', $data);
	    setVariable('mess', $mess);
	    setVariable('listCategory', $listCategory);
	}else{
		return $controller->redirect('/login');
	}
}

function detailProduct($input)
{
	global $controller;
	global $metaTitleMantan;
	global $metaKeywordsMantan;
	global $metaDescriptionMantan;
	global $metaImageMantan;

	$modelProduct = $controller->loadModel('Products');
	$modelMembers = $controller->loadModel('Members');

	$link_open_app = '';
	
	if(!empty($input['request']->getAttribute('params')['pass'][1])){
		$slug = str_replace('.html', '', $input['request']->getAttribute('params')['pass'][1]);
		$slug = explode('-', $slug);
		$count = count($slug)-1;
		$id = (int) $slug[$count];

		$product = $modelProduct->find()->where(['id'=>$id])->first();

		if(!empty($product)){
			$user = $modelMembers->get($product->user_id);

			if(!empty($product->thumbnail)){
				$product->image = $product->thumbnail;
			}

			$metaTitleMantan = 'Mẫu thiết kế: '.$product->name;
			$metaDescriptionMantan = 'Mẫu thiết kế: '.$product->name.' của tác giả '.$user->name.' đang được bán trên Ezpics với giá '.number_format($product->sale_price).'đ';
			$metaImageMantan = $product->image;

			if($product->type == 'user_create' && $product->status == 2){
				$link_open_app =  (!empty($product->link_open_app))?$product->link_open_app:'https://ezpics.page.link/vn1s';
			}else{
				$link_open_app =  'https://ezpics.page.link/vn1s';
			}

			setVariable('product', $product);
			setVariable('user', $user);
		}else{
			$link_open_app =  'https://ezpics.page.link/vn1s';
		}
	}else{
		$link_open_app =  'https://ezpics.page.link/vn1s';
	}

	setVariable('link_open_app', $link_open_app);
}

function detailSeries($input)
{
	global $controller;
	global $metaTitleMantan;
	global $metaKeywordsMantan;
	global $metaDescriptionMantan;
	global $metaImageMantan;

	$modelProduct = $controller->loadModel('Products');
	$modelMembers = $controller->loadModel('Members');
	$modelProductDetail = $controller->loadModel('ProductDetails');

	$link_open_app = '';
	
	if(!empty($input['request']->getAttribute('params')['pass'][1])){
		$slug = str_replace('.html', '', $input['request']->getAttribute('params')['pass'][1]);
		$slug = explode('-', $slug);
		$count = count($slug)-1;
		$id = (int) $slug[$count];

		$product = $modelProduct->find()->where(['id'=>$id])->first();

		if(!empty($product) && $product->type == 'user_series' && $product->status == 1){
			$product->views ++;
			$modelProduct->save($product);

			$user = $modelMembers->get($product->user_id);

			if(!empty($product->thumbnail)){
				$product->image = $product->thumbnail;
			}

			$metaTitleMantan = 'Mẫu thiết kế: '.$product->name;
			$metaDescriptionMantan = 'Ảnh được tạo từ mẫu thiết kế: '.$product->name.' của tác giả '.$user->name.' trên Ezpics';
			$metaImageMantan = $product->image;

			$listLayer = $modelProductDetail->find()->where(array('products_id'=>$product->id))->all()->toList();

			setVariable('product', $product);
			setVariable('user', $user);
			setVariable('listLayer', $listLayer);
		}else{
			return $controller->redirect('https://ezpics.vn');
		}
	}else{
		return $controller->redirect('https://ezpics.vn');
	}
}

function createImageSeries($input)
{
	global $controller;
	global $urlCreateImage;
	global $ftp_server_upload_image;
	global $ftp_username_upload_image;
	global $ftp_password_upload_image;

	$modelProduct = $controller->loadModel('Products');
	$modelProductDetail = $controller->loadModel('ProductDetails');

	$dataImage = '';
	
	if(!empty($_REQUEST['id'])){
		$id = (int) $_REQUEST['id'];

		$product = $modelProduct->find()->where(['id'=>$id])->first();

		if(!empty($product) && $product->type == 'user_series' && $product->status == 1){
			$product->export_image ++;
			$modelProduct->save($product);

			$urlThumb = 'https://apis.ezpics.vn/createImageFromTemplate/?id='.$id;

			$listLayer = $modelProductDetail->find()->where(array('products_id'=>$product->id))->all()->toList();

			$listRemoveImage = [];
			if(!empty($listLayer)){
        		foreach ($listLayer as $layer) {
        			$content = json_decode($layer->content, true);

        			if(!empty($content['variable'])){
        				if(!empty($_REQUEST[$content['variable']])){
    						$urlThumb .= '&'.$content['variable'].'='.$_REQUEST[$content['variable']];
    					}

        				if($content['type'] == 'image'){
        					if(isset($_FILES[$content['variable']]) && empty($_FILES[$content['variable']]["error"])){
					            $image = uploadImageFTP($product->user_id, $content['variable'], $ftp_server_upload_image, $ftp_username_upload_image, $ftp_password_upload_image, 'https://apis.ezpics.vn/');

					            if(!empty($image['linkOnline'])){
					            	$urlThumb .= '&'.$content['variable'].'='.$image['linkOnline'];

					            	$listRemoveImage[] = '/public_html/'.$image['linkLocal'];
					            }
					        }
        				}
        			}
        		}
        	}
        	
			$url = $urlCreateImage.'?url='.urlencode($urlThumb).'&width='.$product->width.'&height='.$product->height;
		
	        $dataImage = sendDataConnectMantan($url);

	        // xóa ảnh người dùng up lên sau khi chụp xong
	        if(!empty($listRemoveImage)){
	        	foreach ($listRemoveImage as $item) {
	        		removeFileFTP($item, $ftp_server_upload_image, $ftp_username_upload_image, $ftp_password_upload_image);
	        	}
	        }
		}
	}

	setVariable('dataImage', $dataImage);
}

function addDataSeries($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;
    global $session;

    if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Nhập dữ liệu cho mẫu in hàng loạt';

		$modelProduct = $controller->loadModel('Products');
		$modelProductDetail = $controller->loadModel('ProductDetails');
		$mess= '';

		if(!empty($_GET['id'])){
			$id = (int) $_GET['id'];

			$product = $modelProduct->find()->where(['id'=>$id])->first();

			if(!empty($product) && $product->type == 'user_series' && $product->status == 1){
				$listLayer = $modelProductDetail->find()->where(array('products_id'=>$product->id))->all()->toList();
			}else{
				return $controller->redirect('/listProductSeries');
			}
		}else{
			return $controller->redirect('/listProductSeries');
		}
	}else{
		return $controller->redirect('/login');
	}
}
?>