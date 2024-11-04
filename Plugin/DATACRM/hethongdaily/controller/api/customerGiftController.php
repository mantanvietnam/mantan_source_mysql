<?php 
function listCustomerGiftAPI($input)
{
    global $controller;
    global $urlHomes;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $isRequestPost;
    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token'],'listCustomerGiftAgency');
            if(!empty($infoMember)){
                if(empty($infoMember->grant_permission)){
                    return array('code'=>4, 'mess'=>'Bạn không có quyền');
                }
                $modelCustomerGifts = $controller->loadModel('CustomerGifts');
                $modelProducts = $controller->loadModel('Products');
                $modelRatingPointCustomer = $controller->loadModel('RatingPointCustomers');

                $conditions = array('id_member'=>$infoMember->id);
                $limit = 20;
                $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
                if($page<1) $page = 1;
                $order = array('id'=>'desc');

                if(!empty($dataSend['name'])){
                    $slug = createSlugMantan($dataSend['name']);
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

                $return = array('code'=>0, 'mess'=> 'lấy dữ liệu thành công','listData'=>$listData, 'totalData'=>$totalData);  
            }else{
                 $return = array('code'=>3, 'mess'=>'Sai mã token');
            }
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }

    return $return;
}

function getCustomerGiftAPI($input){
    global $isRequestPost;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;
    global $controller;

    $return = array('code'=>0);
    $modelCustomerGifts = $controller->loadModel('CustomerGifts');
    $modelProducts = $controller->loadModel('Products');
    $modelRatingPointCustomer = $controller->loadModel('RatingPointCustomers');
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token']) && !empty($dataSend['id'])){
            $infoMember = getMemberByToken($dataSend['token'],'listCustomerGiftAgency');

            if(!empty($infoMember)){
                if(empty($infoMember->grant_permission)){
                    return array('code'=>4, 'mess'=>'Bạn không có quyền');
                }
                $conditions = array('id_member'=>$infoMember->id, 'id'=>(int) $dataSend['id']);
         
                $data = $modelCustomerGifts->find()->where($conditions)->first();
                if(!empty($data)){
                    $data->product = $modelProducts->find()->where(['id'=>$data->id_product])->first();
                    $data->rating = $modelRatingPointCustomer->find()->where(['id'=>$data->id_rating])->first();
               }

                $return = array('code'=>1, 'mess'=> 'lấy dữ liệu thành công','data'=>$data);  
            }else{
                 $return = array('code'=>3, 'mess'=>'Sai mã token');
            }
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
            $return = array('code'=>0, 'mess'=>'gửi sai kiểu POST');

    }

    return $return;
}

function addCustomerGiftAPI($input)
{
    global $controller;
    global $isRequestPost;
    global $metaTitleMantan;
    global $modelCategories;
    global $urlHomes;
    global $session;

    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token']) && !empty($dataSend['name'])){
            $infoMember = getMemberByToken($dataSend['token'],'addCustomerGiftAgency');

            if(!empty($infoMember)){
                if(empty($infoMember->grant_permission)){
                    return array('code'=>4, 'mess'=>'Bạn không có quyền');
                }

                $metaTitleMantan = 'Thông tin quà tặng';

                $modelCustomerGifts = $controller->loadModel('CustomerGifts');
                $modelProducts = $controller->loadModel('Products');
                $modelRatingPointCustomer = $controller->loadModel('RatingPointCustomers');

                $mess= '';

                // lấy data edit
                if(!empty($dataSend['id'])){
                    $data = $modelCustomerGifts->find->where(['id'=> (int) $dataSend['id'], 'id_member'=> $infoMember->id])->first();
                }else{
                    $data = $modelCustomerGifts->newEmptyEntity();
                    $data->created_at = time();
                }

                if(isset($_FILES['image']) && empty($_FILES['image']["error"])){
                    if(!empty($data->id)){
                        $fileName = 'image_gifts_'.$data->id;
                    }else{
                        $fileName = 'image_gifts_'.time().rand(0,1000000);
                    }
                    $image = uploadImage($infoMember->id, 'image', $fileName);
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
                $data->price =  (int)$dataSend['price'];
                $data->quantity = (int) $dataSend['quantity'];
                $data->id_member = $infoMember->id;
                $data->point =  (int)$dataSend['point'];
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

                if(!empty($dataSend['id'])){
                      $note = $infoMember->type_tv.' '. $infoMember->name.' sửa thông tin quà tặng '.$data->name.' có id là:'.$data->id;
                }else{
                      $note = $infoMember->type_tv.' '. $infoMember->name.' thêm thông tin quà tặng '.$data->name.' có id là:'.$data->id;
                }


                addActivityHistory($infoMember,$note,'addCustomerGiftAgency',$data->id);
                
                return array('code'=>1, 'mess'=>'Bạn lưu thành công');
            }else{
                 $return = array('code'=>3, 'mess'=>'Sai mã token');
            }
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
            $return = array('code'=>0, 'mess'=>'gửi sai kiểu POST');

    }

    return $return;
}

function deleteCustomerGiftAPI($input){
    global $controller;
    global $session;
    global $isRequestPost;

    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token']) && !empty($dataSend['id'])){
            $infoMember = getMemberByToken($dataSend['token'],'deleteCustomerGiftAgency');

            if(!empty($infoMember)){
                if(empty($infoMember->grant_permission)){
                    return array('code'=>4, 'mess'=>'Bạn không có quyền');
                }
                $modelCustomerGift = $controller->loadModel('CustomerGifts');
        

                $conditions = array('id_member'=>$infoMember->id, 'id'=>(int) $dataSend['id']);
         
                $data = $modelCustomerGifts->find()->where($conditions)->first();
                if(!empty($data)){
                    $note = $infoMember->type_tv.' '. $infoMember->name.' xóa thông tin quà tặng '.$data->name.' có id là:'.$data->id;
                    addActivityHistory($infoMember,$note,'deleteCustomerGiftAgency',$data->id);
                    $modelCustomerGift->delete($data);
                    $return = array('code'=>1, 'mess'=>'xóa dữ liệu thành công');
                }else{
                    $return = array('code'=>4, 'mess'=>'xóa dữ liệu không thành công');
                }
            }else{
                 $return = array('code'=>3, 'mess'=>'Sai mã token');
            }
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
            $return = array('code'=>0, 'mess'=>'gửi sai kiểu POST');

    }

    return $return;
}

function giveGiftCustomerAPI($input){
    global $controller;
    global $session;
    global $isRequestPost;

     if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token']) && !empty($dataSend['id_gift']) && !empty($dataSend['id_customer'])){
            $infoMember = getMemberByToken($dataSend['token'],'giveGiftCustomer');

            if(!empty($infoMember)){
                if(empty($infoMember->grant_permission)){
                    return array('code'=>4, 'mess'=>'Bạn không có quyền');
                }
                $modelCustomerGifts = $controller->loadModel('CustomerGifts');
                $modelCustomer = $controller->loadModel('Customers');
                $modelPointCustomer = $controller->loadModel('PointCustomers');
                $modelProduct = $controller->loadModel('Products');
                $modelCustomerHistorieGift = $controller->loadModel('CustomerHistorieGifts');
                $modelRatingPointCustomer = $controller->loadModel('RatingPointCustomers');
                $modelWarehouseProducts = $controller->loadModel('WarehouseProducts');
                $modelWarehouseHistories = $controller->loadModel('WarehouseHistories');
        
                $gift = $modelCustomerGifts->find()->where(['id'=>(int)$dataSend['id_gift'], 'id_member'=>$infoMember->id])->first();
                $pointCustomer = $modelPointCustomer->find()->where(['id_customer'=>(int)$dataSend['id_customer'], 'id_member'=>$infoMember->id])->first();
                $customer = $modelCustomer->find()->where(['id'=>(int)$dataSend['id_customer']])->first();
                if(!empty($gift->point) && !empty($pointCustomer->point) && !empty($customer)){
                    if($gift->point < $pointCustomer->point){
                        $pointCustomer->point -= $gift->point;

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
                        $historieGift->id_member = $infoMember->id;
                        $historieGift->note = 'Tặng quà cho khách hàng '.$customer->full_name.' '.$customer->phone;
                        $historieGift->created_at = time();
                        $modelCustomerHistorieGift->save($historieGift);

                        // xử lý sản phẩm
                        if(!empty($gift->id_product)){
                           $product = $modelProduct->find()->where(['id'=>$gift->id_product])->first();
                           if(!empty($product)){
                                // trừ hàng trong kho người bán
                                $checkProductExits = $modelWarehouseProducts->find()->where(['id_product'=>$product->id, 'id_member'=>$infoMember->id])->first();

                                if(empty($checkProductExits)){
                                    $checkProductExits = $modelWarehouseProducts->newEmptyEntity();
                                    $checkProductExits->quantity = 0;
                                }

                                $checkProductExits->id_member = $infoMember->id;
                                $checkProductExits->id_product = $product->id;
                                $checkProductExits->quantity -= 1;

                                $modelWarehouseProducts->save($checkProductExits);

                                $saveWarehouseHistories = $modelWarehouseHistories->newEmptyEntity();

                                $saveWarehouseHistories->id_member = $infoMember->id;
                                $saveWarehouseHistories->id_product = $product->id;
                                $saveWarehouseHistories->quantity = 1;
                                $saveWarehouseHistories->note = 'Tặng quà cho khách hàng '.$customer->full_name.' '.$customer->phone;
                                $saveWarehouseHistories->create_at = time();
                                $saveWarehouseHistories->type = 'minus';
                                $saveWarehouseHistories->id_historie_gift = $historieGift->id;

                                $modelWarehouseHistories->save($saveWarehouseHistories);
                            }
                        }
                        $note = $infoMember->type_tv.' '. $infoMember->name.' đổi quà '.$gift->name.' cho khách hàng '.$customer->full_name.' có id lịch sử đổi quà là:'.$historieGift->id;

                        addActivityHistory($infoMember,$note,'giveGiftCustomer',$historieGift->id);
                        $return = array('code'=>1, 'mess'=>'Đổi quà tặng cho khách hàng thành công');
                    }else{
                        $return = array('code'=>4, 'mess'=>'Khách hàng chưa đủ điểm để nhận phần quà này');
                    }
                }else{
                    $return = array('code'=>4, 'mess'=>'Phần quà tặng này không tồn tại');

                }
            }else{
                 $return = array('code'=>3, 'mess'=>'Sai mã token');
            }
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
            $return = array('code'=>0, 'mess'=>'gửi sai kiểu POST');

    }

    return $return;
}

function listHistorieCustomerGiftAPI($input){
    global $controller;
    global $urlHomes;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $isRequestPost;

    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token'],'listHistorieCustomerGiftAgency');

            if(!empty($infoMember)){
                 if(empty($infoMember->grant_permission)){
                    return array('code'=>4, 'mess'=>'Bạn không có quyền');
                }
                $modelCustomerGifts = $controller->loadModel('CustomerGifts');
                $modelCustomer = $controller->loadModel('Customers');
                $modelPointCustomer = $controller->loadModel('PointCustomers');
                $modelCustomerHistorieGift = $controller->loadModel('CustomerHistorieGifts');

                $conditions = array('id_member'=>$infoMember->id);
                $limit = 20;
                $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
                if($page<1) $page = 1;
                $order = array('id'=>'desc');

                if(!empty($dataSend['phone_customer'])){
                    $customer = $modelCustomer->find()->where(['phone'=>$dataSend['phone_customer']])->first();
                    if(!empty($customer->id)){
                        $conditions['id_customer'] = $customer->id;
                    }else{
                        $conditions['id_customer'] = 0; 
                    }
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

                 $return = array('code'=>1, 'mess'=> 'lấy dữ liệu thành công','listData'=>$listData,'totalData'=>$totalData);  
            }else{
                 $return = array('code'=>3, 'mess'=>'Sai mã token');
            }
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
            $return = array('code'=>0, 'mess'=>'gửi sai kiểu POST');

    }

    return $return;
}
 ?>

