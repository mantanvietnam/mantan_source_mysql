<?php 
function listRatingPointAPI($input){
    global $isRequestPost;
    global $metaTitleMantan;
    global $session;
    global $controller;

    $metaTitleMantan = 'Danh sách xếp hạng thành viên';
    $modelRatingPointCustomer = $controller->loadModel('RatingPointCustomers');
    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token']);

            if(!empty($infoMember)){
                
                $conditions = ['status'=>'active'];
                $listData = $modelRatingPointCustomer->find()->where($conditions)->all()->toList();


                $return = array('code'=>0, 'mess'=> 'lấy dữ liệu thành công','listData'=>$listData);  
            }else{
                 $return = array('code'=>3, 'mess'=>'Sai mã token');
            }
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }

    return $return;
}

function getRatingPointAPI($input){
    global $isRequestPost;
    global $metaTitleMantan;
    global $session;
    global $controller;

    $metaTitleMantan = 'Danh sách xếp hạng thành viên';
    $modelRatingPointCustomer = $controller->loadModel('RatingPointCustomers');
    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token']) && !empty($dataSend['id'])){
            $infoMember = getMemberByToken($dataSend['token']);

            if(!empty($infoMember)){
         
                $data = $modelRatingPointCustomer->find()->where(['id'=>(int) $dataSend['id']])->first();

                $return = array('code'=>0, 'mess'=> 'lấy dữ liệu thành công','data'=>$data);  
               
                
            }else{
                 $return = array('code'=>3, 'mess'=>'Sai mã token');
            }
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }

    return $return;
}

function addRatingPointAPI($input){
    global $isRequestPost;
    global $metaTitleMantan;
    global $session;
    global $controller;

    $metaTitleMantan = 'Danh sách xếp hạng thành viên';
    $modelRatingPointCustomer = $controller->loadModel('RatingPointCustomers');
    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token']);

            if(!empty($infoMember)){
                
                if(!empty($infoMember->id_father)){
                    return array('code'=>4, 'mess'=>'Bạn không phải là boss');
                }

                // Tạo subquery để tìm giá trị point_min cao nhất
                $subquery = $modelRatingPointCustomer->find();
                $subquery->select(['max_point_min' => $subquery->func()->max('point_min')]);

                    
               // tính ID category
                if(!empty($dataSend['id'])){
                    $infoCategory = $modelRatingPointCustomer->get( (int) $dataSend['id']);

                    // tạo dữ liệu save
                    $infoCategory->name = str_replace(array('"', "'"), '’', $dataSend['name']);
                    $infoCategory->point_min = (int) $dataSend['point_min'];
                    $infoCategory->status = 'active';
                    $infoCategory->note = @$dataSend['note'];
                    $modelRatingPointCustomer->save($infoCategory);
                    return array('code'=>1, 'mess'=>'Bạn lưu thành công');
                }else{
                    // Tìm bản ghi có giá trị point_min cao nhất
                    $query = $modelRatingPointCustomer->find()->where(['point_min' => $subquery])->first();        
                    if(empty($query) || $query->point_min < (int)$dataSend['point_min']){
                        $infoCategory = $modelRatingPointCustomer->newEmptyEntity();            
                        $infoCategory->created_at = time(); 
                        $infoCategory->name = str_replace(array('"', "'"), '’', $dataSend['name']);
                        $infoCategory->point_min = (int) $dataSend['point_min'];
                        //$infoCategory->status = 'active';
                        $infoCategory->note = @$dataSend['note'];                    
                        $modelRatingPointCustomer->save($infoCategory);
                        return array('code'=>1, 'mess'=>'Bạn lưu thành công');
                    }else{
                        return array('code'=>5, 'mess'=>'Điểm phải lơn hơn hạng trước');

                    }                
                }
                
            }else{
                 $return = array('code'=>3, 'mess'=>'Sai mã token');
            }
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }

    return $return;
}

function deleteRatingPointAPI($input){
    global $controller;
    global $session;
    $modelRatingPointCustomer = $controller->loadModel('RatingPointCustomers');
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token']);

            if(!empty($infoMember)){
                if(!empty($infoMember->id_father)){
                    return array('code'=>4, 'mess'=>'Bạn không phải là boss');
                }
                if(!empty($_GET['id'])){
                    $data = $modelRatingPointCustomer->get($_GET['id']);
                    
                    if($data){
                        $data->status = 'lock';
                        $modelRatingPointCustomer->save($data);
                        //deleteSlugURL($data->slug);
                    }
                }
                 $return = array('code'=>1, 'mess'=>'xóa dữ liệu thành công');

            }else{
                 $return = array('code'=>3, 'mess'=>'Sai mã token');
            }
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }

    return $return;
}

function listPointCustomerAPI($input){
     global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $modelCategoryConnects;

    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token']);

            if(!empty($infoMember)){
       

                $modelCustomers = $controller->loadModel('Customers');
                $modelPointCustomer = $controller->loadModel('PointCustomers');
                $modelRatingPointCustomer = $controller->loadModel('RatingPointCustomers');
                $modelOrders = $controller->loadModel('Orders');
                $modelCustomerGifts = $controller->loadModel('CustomerGifts');

                
                $conditions = array('id_member'=>$infoMember->id);
                $limit = 20;
                $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
                if($page<1) $page = 1;
                $order = array('id'=>'desc');
               

                if(!empty($dataSend['id'])){
                    $conditions['id'] = (int) $dataSend['id'];
                }

                if(!empty($dataSend['id_rating'])){
                    $conditions['id_rating'] = $dataSend['id_rating'];
                }

                if(!empty($dataSend['phone_customer'])){
                    $customer = $modelCustomers->find()->where(['phone'=>$dataSend['phone_customer']])->first();
                    if(!empty($customer->id)){
                        $conditions['id_customer'] = $customer->id;
                    }else{
                        $conditions['id_customer'] = 0; 
                    }
                }

               
                $listData = $modelPointCustomer->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

                if(!empty($listData)){
                    foreach ($listData as $key => $value) {
                        $listData[$key]->rating = $modelRatingPointCustomer->find()->where(['id'=>$value->id_rating])->first();
                        $listData[$key]->customer = $modelCustomers->find()->where(['id'=>$value->id_customer])->first();
                        $listData[$key]->gift = $modelCustomerGifts->find()->where(['point <='=>$value->point])->all()->toList();
                        
                    }
                }

                $totalData = count($modelPointCustomer->find()->where($conditions)->all()->toList());

              
                $return = array('code'=>0, 'mess'=> 'lấy dữ liệu thành công','listData'=>$listData,'totalData'=>$totalData);  
            }else{
                 $return = array('code'=>3, 'mess'=>'Sai mã token');
            }
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }

    return $return;
}
 ?>