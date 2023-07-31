<?php 
function createImageFromTemplate($input)
{
	global $isRequestPost;
	global $controller;
	global $session;
	global $modelCategories;

	$modelMember = $controller->loadModel('Members');
	$modelProduct = $controller->loadModel('Products');
	$modelProductDetail = $controller->loadModel('ProductDetails');
	$modelFont = $controller->loadModel('Font');

	if(!empty($_GET['id'])){
		$product = $modelProduct->find()->where(array('id'=>$_GET['id']))->first();

		if(!empty($product)){
			$layers = $modelProductDetail->find()->where(array('products_id'=>$product->id))->all()->toList();
			$fonts = $modelFont->find()->order(['name'=>'asc'])->all()->toList();

			$categories = $modelCategories->find()->where(['type'=>'product_categories'])->order(['name'=>'asc'])->all()->toList();

            $infoLayer = getLayerProductForEdit($_GET['id']); 

			setVariable('product', $product);
			setVariable('layers', $layers);
			setVariable('fonts', $fonts);
			setVariable('categories', $categories);
            setVariable('infoLayer', $infoLayer);
		}
	}
}

function editDesign($input)
{
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategories;

    $modelMember = $controller->loadModel('Members');
    $modelProduct = $controller->loadModel('Products');
    $modelProductDetail = $controller->loadModel('ProductDetails');
    $modelFont = $controller->loadModel('Font');

    if(!empty($_GET['id']) && !empty($_GET['token'])){
        $checkPhone = $modelMember->find()->where(array('token'=>$_GET['token']))->first();

        if(!empty($checkPhone)){
            $product = $modelProduct->find()->where(array('id'=>$_GET['id']))->first();

            if(!empty($product)){
                if($product->user_id == $checkPhone->id){
                    $session->write('infoUser', $checkPhone);

                    $layers = $modelProductDetail->find()->where(array('products_id'=>$product->id))->all()->toList();
                    $fonts = $modelFont->find()->order(['name'=>'asc'])->all()->toList();

                    $categories = $modelCategories->find()->where(['type'=>'product_categories'])->order(['name'=>'asc'])->all()->toList();

                    setVariable('product', $product);
                    setVariable('layers', $layers);
                    setVariable('fonts', $fonts);
                    setVariable('categories', $categories);
                }
            }
        }
    }
}

function dataEditThemeUser($input)
{
	global $session;
	global $isRequestPost;
	global $controller;
	global $modelCategories;

	$modelMember = $controller->loadModel('Members');
	$modelProduct = $controller->loadModel('Products');
	$modelProductDetail = $controller->loadModel('ProductDetails');
	$modelFont = $controller->loadModel('Font');

    /*
    $token = '9X2F1pDURKduwSNA5oIiVBCme47qHy16800858251';
    $checkPhone = $modelMember->find()->where(array('token'=>$token))->first();
    $session->write('infoUser', $checkPhone);
    */

    if(!empty($_POST['id'])){
    	$dataSend = $input['request']->getData();

        $session->write('widthWindow', $dataSend['width']);

        return getLayerProductForEdit($dataSend['id']); 
    }else{
        return ['error' => ['Bạn chưa đăng nhập']];
    }
}

function getListLayer($input)
{
    global $session;
    global $isRequestPost;
    global $controller;
    global $modelCategories;

    $modelMember = $controller->loadModel('Members');
    $modelProduct = $controller->loadModel('Products');
    $modelProductDetail = $controller->loadModel('ProductDetails');
    $modelFont = $controller->loadModel('Font');

    /*
    $token = '9X2F1pDURKduwSNA5oIiVBCme47qHy16800858251';
    $checkPhone = $modelMember->find()->where(array('token'=>$token))->first();
    $session->write('infoUser', $checkPhone);
    */

    if(empty($session->read('infoUser')) && !empty($_POST['token'])){
        $checkPhone = $modelMember->find()->where(array('token'=>$_POST['token']))->first();

        if(!empty($checkPhone)){
            $session->write('infoUser', $checkPhone);
        }
    }

    if(!empty($session->read('infoUser')) && $isRequestPost){
        $dataSend = $input['request']->getData();

        $session->write('widthWindow', $dataSend['width']);

        $layers = getLayerProductForEdit($dataSend['id']); 

        unset($layers['movelayer']);

        return $layers;
    }else{
        return ['error' => ['Bạn chưa đăng nhập']];
    }
}

function updateInfoProduct($input)
{
    global $session;
    global $isRequestPost;
    global $controller;

    $modelProduct = $controller->loadModel('Products');
    $modelWarehouses = $controller->loadModel('Warehouses');
    $modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
    $modelWarehouseUsers = $controller->loadModel('WarehouseUsers');
    $modelMember = $controller->loadModel('Members');

    if(!empty($session->read('infoUser')) && $isRequestPost){
        $dataSend = $input['request']->getData();
        $user =  $session->read('infoUser');

        $pro = $modelProduct->find()->where(array('id'=>$dataSend['id'], 'user_id'=>$user->id))->first();

        if (empty($pro)) {
            return ['error' => ['Sản phẩm của bạn đã bị xóa khỏi hệ thống']]; 
        }else{
            if(!empty($dataSend['field']) && isset($dataSend['value'])){
                switch ($dataSend['field']) {
                    case 'category_id':
                        $pro->category_id = (int) $dataSend['value'];
                        break;
                    
                    case 'price':
                        $pro->price = (int) str_replace(',','',$dataSend['value']);
                        break;
                    
                    case 'sale_price':
                        $pro->sale_price = (int) str_replace(',','',$dataSend['value']);
                        break;
                    
                    case 'name':
                        $pro->name = $dataSend['value'];

                        // tạo slug
                        $slug = createSlugMantan($dataSend['value']);
                        $slugNew = $slug;
                        $number = 0;

                        if(empty($pro->slug) || $pro->slug!=$slugNew){
                            do{
                                $conditions = array('slug'=>$slugNew);
                                $listData = $modelProduct->find()->where($conditions)->all()->toList();

                                if(!empty($listData)){
                                    $number++;
                                    $slugNew = $slug.'-'.$number;
                                }
                            }while (!empty($listData));
                        }

                        $pro->slug = $slugNew;

                        break;

                    case 'status':
                        $pro->status = (int) $dataSend['value'];
                        if($pro->status == 1){
                            sendNotificationAdmin('6479b6f4b4a51d8bb38fc547');
                            $warehouseProducts = $modelWarehouseProducts->find()->where(['product_id'=>$pro->id])->all()->toList();
                            if(!empty($warehouseProducts)){
                                foreach($warehouseProducts as $keywp => $product){
                                    $warehouse = $modelWarehouses->find()->where(['id'=>$product->warehouse_id])->first();
                                    $warehouseUser = $modelWarehouseUsers->find()->where(['warehouse_id'=>$warehouse->id])->all()->toList();
                                    foreach($warehouseUser as $keyus => $item){
                                        $user = $modelMember->find()->where(['id'=>$item->user_id])->first();
                                        $dataSendNotification= array('product_id'=>$pro->id, 'title'=>'Thông báo có mẫu thiết kế mới trong kho ','time'=>date('H:i d/m/Y'),'content'=>'Kho mẫu thiết kế "'.$Warehouses->name.'" có mẫu mới là "'.$pro->name.'"!','action'=>'productNewWarehouseNotification');
                                        if(!empty($user->token_device)){
                                            sendNotification($dataSendNotification, $member->token_device);
                                        }
                                    }
                                }
                            }

                        }
                        break;
                }

                $modelProduct->save($pro);

                return ['code' => 1];
            }else{
                return ['error' => ['Không được để trống dữ liệu']]; 
            }
        } 
    }else{
        return ['error' => ['Bạn chưa đăng nhập hoặc phiên đăng nhập đã hết hạn']];
    } 
}

function savelayer($input)
{
    global $session;
    global $isRequestPost;
    global $controller;

    $modelProduct = $controller->loadModel('Products');
    $modelProductDetail = $controller->loadModel('ProductDetails');

    if(!empty($session->read('infoUser')) && $isRequestPost){
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['id']) && !empty($dataSend['layer'])){
            $dataSend['layer'] = json_decode($dataSend['layer'], true);
            
            foreach($dataSend['layer'] as $idlayer => $layer) {
                $item =  $modelProductDetail->find()->where(array('id'=>$idlayer, 'products_id'=>$dataSend['id']))->first();
                
                if(!empty($item)){
                    $item->content = json_encode($layer);
                    $modelProductDetail->save($item);
                }else{
                    return ['error' => ['Layer '.$idlayer.' không tồn tại']]; 
                }
            }

            return ['data' => ['Đã câp nhật']]; 
        }else{
            return ['error' => ['Gửi thiếu dữ liệu']]; 
        } 
    }else{
        return ['error' => ['Bạn chưa đăng nhập hoặc phiên đăng nhập đã hết hạn']]; 
    } 
}

function updateLayer($input)
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

function copyLayer($input)
{
    global $session;
    global $isRequestPost;
    global $controller;

    $modelProduct = $controller->loadModel('Products');
    $modelProductDetail = $controller->loadModel('ProductDetails');

    if(!empty($session->read('infoUser')) && $isRequestPost){
        $user =  $session->read('infoUser');
        $dataSend = $input['request']->getData();
        
        // lấy thông tin layer hiện tại
        $item =  $modelProductDetail->get($dataSend['id']);

        // tạo layer mới
        $productDetail = $modelProductDetail->find()->where(array('products_id'=>$item->products_id))->all()->toList();
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
            
        return getLayerProductForEdit($item->products_id);

    }else{
        return ['error' => ['Bạn chưa đăng nhập hoặc phiên đăng nhập đã hết hạn']]; 
    } 
}

function deleteLayer($input)
{
    global $session;
    global $isRequestPost;
    global $controller;

    $modelProduct = $controller->loadModel('Products');
    $modelProductDetail = $controller->loadModel('ProductDetails');

    if(!empty($session->read('infoUser')) && $isRequestPost){
        $dataSend = $input['request']->getData();

        $listLayer = $modelProductDetail->find()->where(array('products_id'=>$dataSend['idproduct']))->all()->toList();

        if (count($listLayer) > 1) {
            $item = $modelProductDetail->get($dataSend['id']);
            $modelProductDetail->delete($item);
            
            return getLayerProductForEdit($dataSend['idproduct']); 
        }else{
            return ['error' => ['Sản phẩm cần tối thiểu 1 Layer']]; 
        }  
    }else{
        return ['error' => ['Bạn chưa đăng nhập hoặc phiên đăng nhập đã hết hạn']]; 
    } 
}

function removeBackgroundLayer($input)
{
    global $session;
    global $isRequestPost;
    global $controller;
    global $price_remove_background;

    $modelProduct = $controller->loadModel('Products');
    $modelProductDetail = $controller->loadModel('ProductDetails');

    $modelManagerFile = $controller->loadModel('ManagerFile');
    $modelMember = $controller->loadModel('Members');
    $modelOrder = $controller->loadModel('Orders');

    if(!empty($session->read('infoUser')) && $isRequestPost){
        $dataSend = $input['request']->getData();

        $infoLayer = $modelProductDetail->find()->where(array('id'=>$dataSend['id'],'products_id'=>$dataSend['idproduct']))->first();

        if(!empty($infoLayer->content)){
            $content = json_decode($infoLayer->content);

            if(!empty($content->type) && $content->type=='image' && !empty($content->banner)){
                $infoUser = $modelMember->find()->where(array('id'=>$session->read('infoUser')->id))->first();

                if(!empty($infoUser)){
                    if($infoUser->account_balance >= $price_remove_background){
                        $link_local = explode('apis.ezpics.vn', $content->banner);
                        $link_local = trim($link_local[1],'/');
                       
                        $banner = 'https://apis.ezpics.vn/'.removeBackground($link_local, true);

                        $content->banner = $banner;

                        $infoLayer->content = json_encode($content);

                        $modelProductDetail->save($infoLayer);

                        // lưu vào database
                        $data = $modelManagerFile->newEmptyEntity();

                        $data->link = $banner;
                        $data->user_id = $infoUser->id;
                        $data->type = 2; // 0 là user up, 1 là cap, 2 là payment
                        $data->created_at = date('Y-m-d H:i:s');

                        $modelManagerFile->save($data);

                        // trừ tiền tài khoản
                        $infoUser->account_balance -= $price_remove_background;
                        $infoUser->buyingMoney += $price_remove_background;
                        $modelMember->save($infoUser);

                        // lưu lịch sử giao dịch
                        $order = $modelOrder->newEmptyEntity();
                        
                        $order->code = 'RB'.time().$infoUser->id.rand(0,10000);
                        $order->member_id = $infoUser->id;
                        $order->file_id = $data->id;
                        $order->total = $price_remove_background;
                        $order->status = 2; // 1: chưa xử lý, 2 đã xử lý
                        $order->type = 4; // 0: mua hàng, 1: nạp tiền, 2: rút tiền, 3: bán hàng, 4: xóa ảnh nền
                        $order->meta_payment = 'Xóa ảnh nền';
                        $order->created_at = date('Y-m-d H:i:s');
                        
                        $modelOrder->save($order);

                        return getLayerProductForEdit($dataSend['idproduct']); 
                    }else{
                        return ['error' => ['Tài khoản không đủ tiền']]; 
                    }
                }else{
                    return ['error' => ['Tài khoản không tồn tại hoặc sai mã token']]; 
                }
            }else{
                return ['error' => ['Layer không tồn tại hoặc không phải layer ảnh']]; 
            }
        }else{
            return ['error' => ['Layer không tồn tại']]; 
        }
    }else{
        return ['error' => ['Bạn chưa đăng nhập hoặc phiên đăng nhập đã hết hạn']]; 
    } 
}

function addLayer($input)
{
    global $session;
    global $isRequestPost;
    global $controller;

    $modelProduct = $controller->loadModel('Products');
    $modelProductDetail = $controller->loadModel('ProductDetails');

    if(!empty($session->read('infoUser')) && $isRequestPost){
        $dataSend = $input['request']->getData();
        $user =  $session->read('infoUser');
        
        $product = $modelProduct->get($dataSend['idproduct']);
        $sizeBackground = getimagesize($product->thumn);

        $productDetail = $modelProductDetail->find()->where(array('products_id'=>$dataSend['idproduct']))->all()->toList();
        $idlayer = count($productDetail)+1;

        $new = $modelProductDetail->newEmptyEntity();   
       
        $new->name = 'Layer '.$idlayer;
        $new->products_id = $dataSend['idproduct'];
        $new->content = json_encode(getLayer($idlayer,$dataSend['type'],@$dataSend['banner'],$dataSend['width'], $dataSend['height']));
        $new->sort = $idlayer;
        $new->created_at = date('Y-m-d H:i:s');
        
        $modelProductDetail->save($new);
        
        return getLayerProductForEdit($dataSend['idproduct']);
    }else{
        return ['error' => ['Bạn chưa đăng nhập hoặc phiên đăng nhập đã hết hạn']]; 
    } 
}

function createLayerVariable($input)
{
    global $session;
    global $isRequestPost;
    global $controller;

    $modelProduct = $controller->loadModel('Products');
    $modelProductDetail = $controller->loadModel('ProductDetails');

    if(!empty($session->read('infoUser')) && $isRequestPost){
        $dataSend = $input['request']->getData();
        $user =  $session->read('infoUser');
        
        $product = $modelProduct->get($dataSend['idproduct']);

        if(!empty($product) && $product->type=='user_series' && !empty($dataSend['nameVariable'])){
            if(empty($dataSend['text'])) $dataSend['text'] = '%'.$dataSend['nameVariable'].'%';
            if(empty($dataSend['variableLabel'])) $dataSend['variableLabel'] = $dataSend['nameVariable'];

            $dataSend['banner'] = 'https://apis.ezpics.vn/plugins/ezpics_api/view/image/default-thumbnail-vuong.jpg';


            $productDetail = $modelProductDetail->find()->where(array('products_id'=>$dataSend['idproduct']))->all()->toList();
            $idlayer = count($productDetail)+1;

            $new = $modelProductDetail->newEmptyEntity();   
           
            $new->name = 'Layer '.$idlayer;
            $new->products_id = $dataSend['idproduct'];
            $new->content = json_encode(getLayer($idlayer,$dataSend['type'],@$dataSend['banner'],$dataSend['width'], $dataSend['height'], $dataSend['text'], $dataSend['nameVariable'], $dataSend['variableLabel']));
            $new->sort = $idlayer;
            $new->created_at = date('Y-m-d H:i:s');
            
            $modelProductDetail->save($new);
        }
        
        return getLayerProductForEdit($dataSend['idproduct']);
    }else{
        return ['error' => ['Bạn chưa đăng nhập hoặc phiên đăng nhập đã hết hạn']]; 
    } 
}

function sortLayer($input)
{
    global $session;
    global $isRequestPost;
    global $controller;

    $modelProduct = $controller->loadModel('Products');
    $modelProductDetail = $controller->loadModel('ProductDetails');

    if(!empty($session->read('infoUser')) && $isRequestPost){
        $dataSend = $input['request']->getData();
        $user =  $session->read('infoUser');

        $pro = $modelProduct->find()->where(array('id'=>$dataSend['id'], 'user_id'=>$user->id))->first();

        if (!empty($pro)) {
            $pro->productDetail = $modelProductDetail->find()->where(array('products_id'=>$pro->id))->order(['sort' => 'ASC'])->all()->toList();

            if(!empty($pro->productDetail)) {
                // đánh lại thứ tự
                foreach($pro->productDetail as $k => $item){
                    $pro->productDetail[$k]->sort = $k+1;
                }

                $stt_dow = 1;
                $stt_up = 2;
                $check = "1";
                $sort = "1";
                    
                foreach($pro->productDetail as $k => $item){
                    // đẩy xuống cuối (lớp trên cùng)
                    if ($dataSend['sort'] == 1) {
                        if ($item->id == $dataSend['layerid']) {
                            $item->sort = count($pro->productDetail);
                        }else{
                            $item->sort = $stt_dow;
                            $stt_dow++;
                        }
                    }

                    // đẩy lên đầu (lớp dưới cùng)
                    if ($dataSend['sort'] == 2) {
                        if ($item->id == $dataSend['layerid']) {
                            $item->sort = 1;
                        }else{
                            $item->sort = $stt_up;
                            $stt_up++;
                        }
                    }

                    // lên 1 lớp
                    if ($dataSend['sort'] == 3) {
                        if ($item->id == $dataSend['layerid']) {
                            $sort = $item->sort;
                            $item->sort++;
                            $check = $k;
                        }

                        // xử lý cho lớp ngay sau lớp được chọn
                        if ($check !== "1") {
                            if ($sort !== "1") {
                                if ($item->id != $dataSend['layerid']) {
                                    $item->sort = $sort;
                                    $check = "1";
                                    $sort = "1";
                                }
                            }
                        }
                    }

                    // xuống 1 lớp
                    if ($dataSend['sort'] == 4) {
                        if ($item->id == $dataSend['layerid']) {
                            if($item->sort>1){
                                $sort = $item->sort;
                                $check = $k - 1;
                                $item->sort --; 
                            }
                        }
                    }

                    $modelProductDetail->save($item);
                }

                if ($dataSend['sort'] == 4) {
                    if ($check !== "1") {
                        if ($sort !== "1") {
                            $dta = $pro->productDetail;
                            if (isset($dta[$check])) {
                                $dta[$check]->sort = $sort;
                                $modelProductDetail->save($dta[$check]);
                                $check = "1";
                                $sort = "1";
                            }
                        }
                    }
                }

                return getLayerProductForEdit($dataSend['id']);
            }else{
                return ['error' => ['Sản phẩm chưa xây dựng các Layer']]; 
            }
        }else{
            return ['error' => ['Có lỗi trong quá trình xẩy ra. Vui lòng thử lại sau']]; 
        }  
    }else{
        return ['error' => ['Bạn chưa đăng nhập hoặc phiên đăng nhập đã hết hạn']]; 
    } 
}

function imagelist($input)
{
    global $session;
    global $isRequestPost;
    global $controller;

    $modelManagerFile = $controller->loadModel('ManagerFile');

    if(!empty($session->read('infoUser'))){
        $user =  $session->read('infoUser');
        $mana = $modelManagerFile->find()->where(['user_id'=>$user->id])->all()->toList();
        $dataSend = $input['request']->getData();

        $function = 'chooseImage';
        if($dataSend['type']=='addNewImage'){
            $function = 'addImage';
        }elseif($dataSend['type']=='changeImage'){
            $function = 'changeImage';
        }

        $list = '<div class="row">';
        foreach($mana as $m){
            $list .= '<div class="col-3 mb-2" onclick="'.$function.'(\''.$m->link.'\');"><img src="'.$m->link.'" width="50"></div>';
        }
        $list .= '</div>';
        return ['success' => $list]; 
    }else{
        return ['error' => ['Bạn chưa đăng nhập hoặc phiên đăng nhập đã hết hạn']];
    }
}

function upImage($input)
{
    global $session;
    global $isRequestPost;
    global $controller;

    $modelManagerFile = $controller->loadModel('ManagerFile');
    $modelProductDetail = $controller->loadModel('ProductDetails');
    $modelProduct = $controller->loadModel('Products');

    if(!empty($session->read('infoUser'))){
        $user =  $session->read('infoUser');
        $return = uploadImage($user->id, 'file');
         
        if (!empty($return['linkOnline'])) {
            $dataSend = $input['request']->getData();

            $f = $modelManagerFile->newEmptyEntity();
            
            $f->link = $return['linkOnline'];
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
            $new->content = json_encode(getLayer($idlayer,'image',$return['linkOnline'],$tyle, $tyle));
            $new->sort = $idlayer;
            $new->created_at = date('Y-m-d H:i:s');
            
            $modelProductDetail->save($new);
                
            return getLayerProductForEdit($dataSend['idproduct']);
        }else{
            return ['error' => [$return['mess']]];
        }
        
    }else{
        return ['error' => ['Bạn chưa đăng nhập']]; 
    } 
}

function upImageThumbnail($input)
{
    global $session;
    global $isRequestPost;
    global $controller;

    $modelManagerFile = $controller->loadModel('ManagerFile');
    $modelProductDetail = $controller->loadModel('ProductDetails');
    $modelProduct = $controller->loadModel('Products');

    if(!empty($session->read('infoUser'))){
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['idproduct'])){
            $user =  $session->read('infoUser');
            $return = uploadImage($user->id, 'file','thumbnail_product_'.$dataSend['idproduct'],'https://apis.ezpics.vn');
             
            if (!empty($return['linkOnline'])) {
                

                // lưu quản lý file
                $f = $modelManagerFile->newEmptyEntity();
                
                $f->link = $return['linkOnline'];
                $f->user_id = $user->id;
                $f->type = 1; // 0 là user up, 1 là cap, 2 là payment   
                $f->created_at = date('Y-m-d H:i:s');
                
                $modelManagerFile->save($f);

                // sản phẩm
                $product = $modelProduct->find()->where(array('id'=>$dataSend['idproduct'], 'user_id'=>$session->read('infoUser')->id))->first();

                if(!empty($product)){
                    $product->thumbnail = $return['linkOnline'];

                    $modelProduct->save($product);
                }
                    
                return getLayerProductForEdit($dataSend['idproduct']);
            }else{
                return ['error' => [ $return['mess'] ]];
            }
        }else{
            return ['error' => ['Gửi thiếu dữ liệu']]; 
        }
    }else{
        return ['error' => ['Bạn chưa đăng nhập']]; 
    } 
}

function replace($input)
{
    global $session;
    global $isRequestPost;
    global $controller;

    $modelManagerFile = $controller->loadModel('ManagerFile');
    $modelProductDetail = $controller->loadModel('ProductDetails');

    if(!empty($session->read('infoUser'))){
        $user =  $session->read('infoUser');
        $return = uploadImage($user->id, 'file');
         
        if (!empty($return['linkOnline'])) {
            $dataSend = $input['request']->getData();

            $f = $modelManagerFile->newEmptyEntity();

            $f->link = $return['linkOnline'];
            $f->user_id = $user->id;
            $f->type = 0; // 0 là user up, 1 là cap, 2 là payment   
            $f->created_at = date('Y-m-d H:i:s');
            
            $modelManagerFile->save($f);

            $new =  $modelProductDetail->find()->where(array('id'=>$dataSend['id']))->first();

            $replace = json_decode($new->content);
            $replace->banner = $return['linkOnline'];
            $new->content = json_encode($replace);
            $modelProductDetail->save($new);
                
            return getLayerProductForEdit($dataSend['idproduct']); 
            
        }else{
            return ['error' => [$return['mess']]];
        }
    }else{
        return ['error' => ['Bạn chưa đăng nhập']]; 
    } 
}

function capImg($input)
{
    global $session;
    global $isRequestPost;
    global $controller;

    $modelManagerFile = $controller->loadModel('ManagerFile');
    $modelProductDetail = $controller->loadModel('ProductDetails');
    $modelProduct = $controller->loadModel('Products');

    if(!empty($session->read('infoUser'))){
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['id']) && !empty($dataSend['base64data'])){
            $data = $dataSend['base64data'];
            $image = explode('base64', $data);
            $user =  $session->read('infoUser');

            $product = $modelProduct->find()->where(array('id'=>$dataSend['id'], 'user_id'=>$user->id))->first();

            $name = __DIR__.'/../../../upload/admin/images/'.$user->id.'/thumb_product_'.$product->id.'.png';

            if (!file_exists(__DIR__.'/../../../upload/admin/images/'.$user->id )) {
                mkdir(__DIR__.'/../../../upload/admin/images/'.$user->id, 0755, true);
            }
            
            // unlink($name);

            file_put_contents($name, base64_decode($image[1]));

            $image = 'https://apis.ezpics.vn/upload/admin/images/'.$user->id.'/thumb_product_'.$product->id.'.png?time='.time();

            $product->image = $image;
            $product->zipThumb = 0;
        
            $modelProduct->save($product);

            //zipImage($name);

            return ['success' => 'Thành công','link' => $image];
        }else{
            return ['error' => ['Gửi thiếu dữ liệu']]; 
        }
    }else{
        return ['error' => ['Bạn chưa đăng nhập']]; 
    } 
}

function zipThumb($input)
{
    global $controller;

    $modelProduct = $controller->loadModel('Products');

    $conditions = array('zipThumb'=>0);
    $limit = 5;
    $page = 1;

    $listProduct = $modelProduct->find()->limit($limit)->page($page)->where($conditions)->all()->toList();

    if(!empty($listProduct)){
        foreach ($listProduct as $key => $value) {
            $name = __DIR__.'/../../../upload/admin/images/'.$value->user_id.'/thumb_product_'.$value->id.'.png';
            
            if(file_exists($name)){
                zipImage($name);
                echo 'Fix image '.$value->id.'<br/>';
            }

            /*
            $thumbnail = explode('upload/admin/images/data/', $value->thumbnail);
            if(!empty($thumbnail[1])){
                $name = __DIR__.'/../../../upload/admin/images/'.$value->user_id.'/'.$thumbnail[1];
            
                if(file_exists($name)){
                    zipImage($name);
                    echo 'Fix thumbnail '.$value->id.'<br/>';
                }
            }
            */

            $value->zipThumb = 1;
            $modelProduct->save($value);
        }
    }
}

function createThumb(){
    global $session;
    global $controller;
    global $urlCreateImage;

    $modelProduct = $controller->loadModel('Products');

    if(!empty($_GET['id'])){
        $id = (int) $_GET['id'];

        return exportImageThumb($id);
    }else{
        return ['error' => 'Gửi thiếu ID sản phẩm'];
    }
}

function checkToolExportImage()
{
    global $urlCreateImage;
    
    $timeout = 5; // Thời gian chờ kết nối, tính bằng giây
    $ip = '14.225.238.137';
    $port = 3000;

    $socket = @fsockopen($ip, $port, $errorCode, $errorMessage, $timeout);
    
    if ($socket) {
        fclose($socket);
        //echo 'IP và port hoạt động.';
        return ['code'=>1];
    } else {
        //echo 'IP và port không hoạt động.';
        return ['code'=>0];
    }
}
?>