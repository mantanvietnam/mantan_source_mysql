<?php 
function listCustomerGiftAgency($input)
{
    global $controller;
    global $urlHomes;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $metaTitleMantan = 'Danh sách quà tặng';

     $user = checklogin('listCustomerGiftAgency'); 
    if(!empty($user)){
      if(empty($user->grant_permission)){
        return $controller->redirect('/statisticAgency');
      }
        
        $modelCustomerGifts = $controller->loadModel('CustomerGifts');
        $modelProducts = $controller->loadModel('Products');
        $modelRatingPointCustomer = $controller->loadModel('RatingPointCustomers');


        $conditions = array('id_member'=>$user->id);
        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        $order = array('id'=>'desc');

        if(!empty($_GET['name'])){
            $slug = createSlugMantan($_GET['name']);
            $conditions['slug LIKE'] = '%'.$slug.'%';
        }


       
       $listData = $modelCustomerGifts->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
       if(!empty($listData)){
             foreach ($listData as $key => $value) {
                $listData[$key]->product = $modelProducts->find()->where(['id'=>$value->id_product])->first();
                $listData[$key]->rating = $modelRatingPointCustomer->find()->where(['id'=>$value->id_rating])->first();
  
            }
       }

       

        // phân trang
        $totalData = $modelCustomerGifts->find()->where($conditions)->all()->toList();
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

        $mess ='';
        if(@$_GET['mess']=='saveSuccess'){
            $mess= '<p class="text-success" style="padding: 0px 1.5em;">Lưu dữ liệu thành công</p>';
        }elseif(@$_GET['mess']=='deleteSuccess'){
            $mess= '<p class="text-success" style="padding: 0px 1.5em;">Xóa dữ liệu thành công</p>';
        }elseif(@$_GET['mess']=='deleteError'){
            $mess= '<p class="text-danger" style="padding: 0px 1.5em;">Xóa dữ liệu không thành công</p>';
        }

        setVariable('page', $page);
        setVariable('totalPage', $totalPage);
        setVariable('back', $back);
        setVariable('mess', $mess);
        setVariable('next', $next);
        setVariable('urlHomes', $urlHomes);
        setVariable('urlPage', $urlPage);
        
        setVariable('listData', $listData);
    }else{
        return $controller->redirect('/login');
    }
}

function addCustomerGiftAgency($input)
{
    global $controller;
    global $isRequestPost;
    global $metaTitleMantan;
    global $modelCategories;
    global $urlHomes;
    global $session;


    
    $user = checklogin('addCustomerGiftAgency'); 
    if(!empty($user)){
      if(empty($user->grant_permission)){
        return $controller->redirect('/listCustomerGiftAgency');
      }
        $metaTitleMantan = 'Thông tin quà tặng';

        $modelCustomerGifts = $controller->loadModel('CustomerGifts');
        $modelProducts = $controller->loadModel('Products');
        $modelRatingPointCustomer = $controller->loadModel('RatingPointCustomers');

        $mess= '';

        // lấy data edit
        if(!empty($_GET['id'])){
            $data = $modelCustomerGifts->get( (int) $_GET['id']);
        }else{
            $data = $modelCustomerGifts->newEmptyEntity();
            $data->created_at = time();
        }

        if ($isRequestPost) {
            $dataSend = $input['request']->getData();


            if(isset($_FILES['image']) && empty($_FILES['image']["error"])){
                if(!empty($data->id)){
                    $fileName = 'image_gifts_'.$data->id;
                }else{
                    $fileName = 'image_gifts_'.time().rand(0,1000000);
                }

                $image = uploadImage($user->id, 'image', $fileName);
            }

            if(!empty($image['linkOnline'])){
                $data->image = $image['linkOnline'].'?time='.time();
            }else{
                if(empty($data->image)){
                    $data->image = $urlHomes.'/plugins/hethongdaily/view/home/assets/img/default-thumb.jpg';
                }
            }



            // tạo dữ liệu save
            $data->name = $dataSend['name'];
            $data->description = $dataSend['description'];
            $data->price = $dataSend['price'];
            $data->quantity = $dataSend['quantity'];
            $data->id_member = $user->id;
            $data->point = $dataSend['point'];
            $data->id_rating = $dataSend['id_rating'];
            $data->id_product = $dataSend['id_product'];
            $data->status = 'active';

                    // tạo slug
            $slug = createSlugMantan($dataSend['name']);
            $slugNew = $slug;
            $number = 0;

            if(empty($data->slug) || $data->slug!=$slugNew){
                do{
                    $conditions = array('slug'=>$slugNew);
                    $listData = $modelCustomerGifts->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

                    if(!empty($listData)){
                        $number++;
                        $slugNew = $slug.'-'.$number;
                    }
                }while (!empty($listData));
            }

            $data->slug = $slugNew;

            
            $modelCustomerGifts->save($data);

             if(!empty($_GET['id'])){
                      $note = $user->type_tv.' '. $user->name.' sửa thông tin quà tặng '.$data->name.' có id là:'.$data->id;
                }else{
                      $note = $user->type_tv.' '. $user->name.' thêm thông tin quà tặng '.$data->name.' có id là:'.$data->id;
                }


                addActivityHistory($user,$note,'addCustomerGiftAgency',$data->id);

            return $controller->redirect('/listCustomerGiftAgency?mess=saveSuccess');
        }
    
        $conditions = array('status' => 'active');
        $listProduct = $modelProducts->find()->where($conditions)->all()->toList();
        $listRating = $modelRatingPointCustomer->find()->where($conditions)->all()->toList();

        setVariable('data', $data);
        setVariable('mess', $mess);
        setVariable('listProduct', $listProduct);
        setVariable('listRating', $listRating);

    }else{
        return $controller->redirect('/login');
    }
}

function deleteCustomerGiftAgency($input){
    global $controller;
    global $session;

    $user = checklogin('deleteCustomerGiftAgency');  
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/listCustomerGiftAgency');
        }

        $modelCustomerGift = $controller->loadModel('CustomerGifts');
        
        if(!empty($_GET['id'])){
            $data = $modelCustomerGift->get($_GET['id']);
            
            if($data){
                 $note = $user->type_tv.' '. $user->name.' xóa thông tin quà tặng '.$data->name.' có id là:'.$data->id;
                

            addActivityHistory($user,$note,'deleteCustomerGiftAgency',$data->id);
                $modelCustomerGift->delete($data);
                return $controller->redirect('/listCustomerGiftAgency?mess=deleteSuccess');
            }
            return $controller->redirect('/listCustomerGiftAgency?mess=deleteError');
        }
        return $controller->redirect('/listCustomerGiftAgency?mess=deleteError');


    }else{
        return $controller->redirect('/login');
    }
}

function giveGiftCustomer($input){
    global $controller;
    global $session;

    $user = checklogin('giveGiftCustomer'); 
    if(!empty($user)){
      if(empty($user->grant_permission)){
        return $controller->redirect('/listPointCustomer');
      }
        $modelCustomerGifts = $controller->loadModel('CustomerGifts');
        $modelCustomer = $controller->loadModel('Customers');
        $modelPointCustomer = $controller->loadModel('PointCustomers');
        $modelProduct = $controller->loadModel('Products');
        $modelCustomerHistorieGift = $controller->loadModel('CustomerHistorieGifts');
        $modelRatingPointCustomer = $controller->loadModel('RatingPointCustomers');
        $modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
        $modelWarehouseHistories = $controller->loadModel('WarehouseHistories');
        
        if(!empty($_GET['id_gift']) && !empty($_GET['id_customer'])){
            $gift = $modelCustomerGifts->find()->where(['id'=>(int)$_GET['id_gift'], 'id_member'=>$user->id])->first();
            $pointCustomer = $modelPointCustomer->find()->where(['id_customer'=>(int)$_GET['id_customer'], 'id_member'=>$user->id])->first();
            $customer =$modelCustomer->find()->where(['id'=>(int)$_GET['id_customer']])->first();
            if(!empty($gift->point) && !empty($pointCustomer->point)){
                if(($gift->point+$pointCustomer->point_now) <= $pointCustomer->point){
                    $pointCustomer->point_now += $gift->point;

                    $rating = $modelRatingPointCustomer->find()->where(['point_min <=' => $pointCustomer->point])->order(['point_min' => 'DESC'])->first();
                    if(!empty($rating)){
                        $pointCustomer->id_rating = $rating->id;
                    }

                    $modelPointCustomer->save($pointCustomer);

                    // tạo lịch sửa 
                    $historieGift = $modelCustomerHistorieGift->newEmptyEntity();

                    $historieGift->id_gifts = $gift->id;
                    $historieGift->id_customer = $pointCustomer->id_customer;
                    $historieGift->point = $gift->point;
                    $historieGift->id_member = $user->id;
                    $historieGift->note = 'Tặng quà cho khách hàng '.$customer->full_name.' '.$customer->phone;
                    $historieGift->created_at = time();
                    $modelCustomerHistorieGift->save($historieGift);

                    // xử lý sản phẩm
                    if(!empty($gift->id_product)){
                       $product = $modelProduct->find()->where(['id'=>$gift->id_product])->first();
                       if(!empty($product)){
                            // trừ hàng trong kho người bán
                            $checkProductExits = $modelWarehouseProducts->find()->where(['id_product'=>$product->id, 'id_member'=>$user->id])->first();

                            if(empty($checkProductExits)){
                                $checkProductExits = $modelWarehouseProducts->newEmptyEntity();
                                $checkProductExits->quantity = 0;
                            }

                            $checkProductExits->id_member = $user->id;
                            $checkProductExits->id_product = $product->id;
                            $checkProductExits->quantity -= 1;

                            $modelWarehouseProducts->save($checkProductExits);

                            $saveWarehouseHistories = $modelWarehouseHistories->newEmptyEntity();

                            $saveWarehouseHistories->id_member = $user->id;
                            $saveWarehouseHistories->id_product = $product->id;
                            $saveWarehouseHistories->quantity = 1;
                            $saveWarehouseHistories->note = 'Tặng quà cho khách hàng '.$customer->full_name.' '.$customer->phone;
                            $saveWarehouseHistories->create_at = time();
                            $saveWarehouseHistories->type = 'minus';
                            $saveWarehouseHistories->type_sale = 'free';
                            $saveWarehouseHistories->id_historie_gift = $historieGift->id;

                            $modelWarehouseHistories->save($saveWarehouseHistories);


                       }
                    }

                    $note = $user->type_tv.' '. $user->name.' đổi quà '.$gift->name.' cho khách hàng '.$customer->full_name.' có id lịch sử đổi quà là:'.$historieGift->id;

                    addActivityHistory($user,$note,'giveGiftCustomer',$historieGift->id);
                    return $controller->redirect('/listPointCustomer?mess=done');
                }
            }
        }

        return $controller->redirect('/listPointCustomer?mess=error');

    }else{
        return $controller->redirect('/login');
    }

}

function listHistorieCustomerGiftAgency($input){
    global $controller;
    global $urlHomes;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $metaTitleMantan = 'Lịch sử quà tặng cho khách hàng';


    $user = checklogin('listHistorieCustomerGiftAgency');  
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/listCustomerGiftAgency');
        }
        $modelCustomerGifts = $controller->loadModel('CustomerGifts');
        $modelCustomer = $controller->loadModel('Customers');
        $modelPointCustomer = $controller->loadModel('PointCustomers');
        $modelCustomerHistorieGift = $controller->loadModel('CustomerHistorieGifts');

        $conditions = array('id_member'=>$user->id);
        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        $order = array('id'=>'desc');

        if(!empty($_GET['id'])){
            $conditions['id'] = (int) $_GET['id'];
        }

        if(!empty($_GET['id_customer'])){
            $conditions['id_customer'] = (int) $_GET['id_customer'];
        }


       
       $listData = $modelCustomerHistorieGift->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
       if(!empty($listData)){
             foreach ($listData as $key => $value) {
                $listData[$key]->gift = $modelCustomerGifts->find()->where(['id'=>$value->id_gifts])->first();
                $listData[$key]->customer = $modelCustomer->find()->where(['id'=>$value->id_customer])->first();
  
            }
       }

       

        // phân trang
        $totalData = $modelCustomerHistorieGift->find()->where($conditions)->all()->toList();
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

        setVariable('page', $page);
        setVariable('totalPage', $totalPage);
        setVariable('back', $back);
        setVariable('next', $next);
        setVariable('urlHomes', $urlHomes);
        setVariable('urlPage', $urlPage);
        setVariable('totalData', $totalData);
        
        setVariable('listData', $listData);
    }else{
        return $controller->redirect('/login');
    }

}
 ?>

