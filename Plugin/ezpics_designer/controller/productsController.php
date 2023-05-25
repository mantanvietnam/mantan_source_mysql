<?php 
function listProduct($input)
{
	global $controller;
	global $urlCurrent;
	global $metaTitleMantan;
	global $modelCategories;
	global $session;

	if(!empty($session->read('infoUser'))){
	    $metaTitleMantan = 'Danh sách mẫu thiết kế';

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

    $ftp_server = "13.215.88.179";
    $ftp_username = "admin_apis";
    $ftp_password = "sIu6v%OHwfmKxcx-";

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

	        if(!empty($dataSend['name']) && !empty($dataSend['background'])){
	        	$thumb = 'https://apis.ezpics.vn/plugins/ezpics_api/view/image/default-thumbnail.jpg';
        		$thumbnailUser = '';

	        	if(isset($_FILES['background']) && empty($_FILES['background']["error"])){
		            $background = uploadImageFTP($infoUser->id, 'background', $ftp_server, $ftp_username, $ftp_password);

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
		            $thumbnail = uploadImageFTP($infoUser->id, 'thumbnail', $ftp_server, $ftp_username, $ftp_password);

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
		        $data->status = (int) $dataSend['status'];
		        $data->type = 'user_create';
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

		        $sizeThumb = getimagesize($thumb);

		        $data->width = $sizeThumb[0];
		        $data->height = $sizeThumb[1];

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
		        $newLayer->content = '{"type":"text","text":"Layer 1","color":"#111","size":"18px","font":"Arial","status":"1","text_align":"left","postion_x":"991","postion_y":"303","brightness":"100","contrast":"100","saturate":"100","opacity":"1","gachchan":"none","uppercase":"none","innghieng":"normal","indam":"normal","gradient_color1":null,"gradient_color2":null,"gradient_color3":null,"gradient_color4":null,"gradient_color5":null,"gradient_color6":null,"linear_position":"to top left","postion_color1":"0","postion_color2":"100","postion_color3":null,"postion_color4":null,"postion_color5":null,"postion_color6":null,"vien":"0px","rotate":null,"banner":null,"gianchu":"1px","giandong":"1px","blur":"0","invert":"0","width":"0px","height":"0px","sepia":"0","grayscale":"0","gradient":"0","sort":"1","postion_left":"50","postion_top":"50"}';

		        $newLayer->wight = (int) @$sizeBackground[0];
		        $newLayer->height = (int) @$sizeBackground[1];
		        $newLayer->sort = 1;
		        $newLayer->status = 1;
		        $newLayer->created_at = date('Y-m-d H:i:s');
		        $newLayer->opacity = 100;
		        $newLayer->gradient = 0;
		        $newLayer->rotate = 0;
		        
		        $modelProductDetail->save($newLayer);

		        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
		    }else{
		    	$mess= '<p class="text-danger">Bạn chưa nhập tên mẫu thiết kế hoặc ảnh nền</p>';
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

			if($product->type == 'user_create' && $product->status == 1){
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
?>