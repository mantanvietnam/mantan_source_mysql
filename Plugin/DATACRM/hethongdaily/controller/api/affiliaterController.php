<?php 
// lấy danh sách cộng tác viên
function listAffiliaterAPI($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;

    $metaTitleMantan = 'Danh sách người tiếp thị';

    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token'],'listAffiliaterAgency');

            if(!empty($infoMember)){
                if(empty($infoMember->grant_permission)){
                    return array('code'=>4, 'mess'=>'Bạn không có quyền');
                }
              
                $modelAffiliaters = $controller->loadModel('Affiliaters');
                $modelOrders = $controller->loadModel('Orders');
                $modelCustomers = $controller->loadModel('Customers');
                $modelTransactionAffiliateHistories = $controller->loadModel('TransactionAffiliateHistories');

                $conditions = array('id_member'=>$infoMember->id);
                $limit = 20;
                $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
                if($page<1) $page = 1;
                $order = array('id'=>'desc');

                if(!empty($dataSend['id'])){
                    $conditions['id'] = (int) $dataSend['id'];
                }

                if(!empty($dataSend['name'])){
                    $conditions['name LIKE'] = '%'.$dataSend['name'].'%';
                }

                if(!empty($dataSend['phone'])){
                    $conditions['phone'] = $dataSend['phone'];
                }

                if(!empty($dataSend['id_father'])){
                    $conditions['id_father'] = $dataSend['id_father'];
                }

                if(!empty($dataSend['email'])){
                    $conditions['email'] = $dataSend['email'];
                }

       
                $listData = $modelAffiliaters->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

                if(!empty($listData)){
                    foreach ($listData as $key => $value) {
                        $order = $modelOrders->find()->where(['id_aff'=>$value->id])->all()->toList();
                        $customer = $modelCustomers->find()->where(['id_aff'=>$value->id])->all()->toList();
                        $moneys = $modelTransactionAffiliateHistories->find()->where(['id_affiliater'=>$value->id, 'status'=>'new'])->all()->toList();

                        $money_back = 0;
                        if(!empty($moneys)){
                            foreach ($moneys as $item) {
                                $money_back += $item->money_back;
                            }
                        }

                        $listData[$key]->number_order = count($order);
                        $listData[$key]->number_customer = count($customer);
                        $listData[$key]->money_back = $money_back;

                        $listData[$key]->aff = $modelAffiliaters->find()->where(['id'=>$value->id_father])->first();
                    }
                }
            // phân trang
            $totalData = $modelAffiliaters->find()->where($conditions)->all()->toList();
            $totalData = count($totalData);

            $return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công', 'listData'=>$listData, 'totalData'=>$totalData);
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

// thêm sủa cộng tác viên
function addAffiliaterAPI($input)
{
    global $controller;
    global $isRequestPost;
    global $metaTitleMantan;
    global $modelCategories;
    global $urlHomes;


    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token']) && !empty($dataSend['name']) && !empty($dataSend['phone'])){
            $infoMember = getMemberByToken($dataSend['token'],'addAffiliaterAgency');

            if(!empty($infoMember)){
                if(empty($infoMember->grant_permission)){
                    return array('code'=>5, 'mess'=>'Bạn không có quyền');
                }

                $modelAffiliaters = $controller->loadModel('Affiliaters');
                $modelMembers = $controller->loadModel('Members');
                $modelCustomers = $controller->loadModel('Customers');

                $mess= '';

                // lấy data edit
                if(!empty($dataSend['id'])){
                    $data = $modelAffiliaters->find()->where(array('id_member'=>$infoMember->id, 'id'=>(int)$dataSend['id']))->first();
                }else{
                    $data = $modelAffiliaters->newEmptyEntity();
                }

                $dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone']));
                $dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

                $conditions = ['phone'=>$dataSend['phone']];
                $checkPhone = $modelAffiliaters->find()->where($conditions)->first();

                if(empty($checkPhone) || (!empty($dataSend['id']) && $dataSend['id']==$checkPhone->id) ){


                    $dataSend['phone_father'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone_father']));
                    $dataSend['phone_father'] = str_replace('+84','0',$dataSend['phone_father']);

                    $father =  $modelAffiliaters->find()->where(array('phone'=>$dataSend['phone_father']))->first();

                    if(isset($_FILES['avatar']) && empty($_FILES['avatar']["error"])){
                        $avatar = uploadImage($infoMember->id, 'avatar', 'affiliater_'.$dataSend['phone']);
                    }

                    if(!empty($avatar['linkOnline'])){
                        $data->avatar = $avatar['linkOnline'].'?time='.time();
                    }else{
                        if(empty($data->avatar)){
                            $data->avatar = $urlHomes.'/plugins/hethongdaily/view/home/assets/img/avatar-default-crm.png';
                        }
                    }



                    // tạo dữ liệu save
                    $data->name = $dataSend['name'];
                    $data->address = $dataSend['address'];
                    $data->phone = $dataSend['phone'];
                    $data->email = $dataSend['email'];
                    $data->description = $dataSend['description'];
                    
                    $data->linkedin = $dataSend['linkedin'];
                    $data->web = $dataSend['web'];
                    $data->instagram = $dataSend['instagram'];
                    $data->zalo = $dataSend['zalo'];
                    $data->facebook = $dataSend['facebook'];
                    $data->twitter = $dataSend['twitter'];
                    $data->tiktok = $dataSend['tiktok'];
                    $data->youtube = $dataSend['youtube'];
                    
                    $data->id_father =(int) @$father->id;
                    $data->id_system = $infoMember->id_system;

                    $data->id_customer = 0;
                    $data->id_member = $infoMember->id;

                    if(empty($dataSend['id'])){
                        if(empty($dataSend['password'])) $dataSend['password'] = $dataSend['phone'];
                        $data->password = md5($dataSend['password']);

                        $data->created_at = time();
                    }else{
                        if(!empty($dataSend['password'])){
                            $data->password = md5($dataSend['password']);
                        }
                    }

                    $modelAffiliaters->save($data);

                    if(!empty($dataSend['id'])){
                        $note = $infoMember->type_tv.' '. $infoMember->name.' sửa thông tin cộng tắc viên '.$data->name.' có id là:'.$data->id;
                    }else{
                        $note = $infoMember->type_tv.' '. $infoMember->name.' thêm thông tin cộng tắc viên '.$data->name.' có id là:'.$data->id;
                    }

                    addActivityHistory($infoMember,$note,'addAffiliaterAgency',$data->id);

                    $return = array('code'=>1, 'mess'=>'Lưu dữ liệu thành công','data'=>$data);
                }else{
                    $return = array('code'=>4, 'mess'=>'Số điện thoại đã tồn tại');
                }       

            }else{
                $return = array('code'=>3, 'mess'=>'Sai mã token');
            }
        }else{
            $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
         $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
    }

    return $return;
}

// lấy chi tiết cộng tác viên
function getAffiliaterAPI($input)
{
    global $controller;
    global $isRequestPost;
    global $metaTitleMantan;
    global $modelCategories;
    global $urlHomes;
    global $session;


    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['id'])){
            if(!empty($dataSend['token'])){
                $infoMember = getMemberByToken($dataSend['token'],'listAffiliaterAPI');
            }else{
                $infoMember =  checklogin('listAffiliaterAgency');
            }
            if(!empty($infoMember)){
                if(empty($infoMember->grant_permission)){
                    return array('code'=>5, 'mess'=>'Bạn không có quyền');
                }

                $modelAffiliaters = $controller->loadModel('Affiliaters');
                $modelOrders = $controller->loadModel('Orders');
                $modelCustomers = $controller->loadModel('Customers');
                $modelTransactionAffiliateHistories = $controller->loadModel('TransactionAffiliateHistories');

           
                    $data = $modelAffiliaters->find()->where(array('id_member'=>$infoMember->id, 'id'=>(int)$dataSend['id']))->first();

                    if(!empty($data)){
                         $order = $modelOrders->find()->where(['id_aff'=>$data->id])->all()->toList();
                        $customer = $modelCustomers->find()->where(['id_aff'=>$data->id])->all()->toList();
                        $moneys = $modelTransactionAffiliateHistories->find()->where(['id_affiliater'=>$data->id, 'status'=>'new'])->all()->toList();

                        $money_back = 0;
                        if(!empty($moneys)){
                            foreach ($moneys as $item) {
                                $money_back += $item->money_back;
                            }
                        }
                        $data->number_order = count($order);
                        $data->number_customer = count($customer);
                        $data->money_back = $money_back;

                        $data->aff = $modelAffiliaters->find()->where(['id'=>$data->id_father])->first();

                        $return = array('code'=>1, 'mess'=>'Lây dữ liệu thành công','data'=>$data);

                    }else{
                        $return = array('code'=>4, 'mess'=>'Dữ liệu không tồn tại');
                    }
            }else{
                $return = array('code'=>3, 'mess'=>'Sai mã token');
            }
        }else{
            $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
         $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
    }

    return $return;
}

// xóa cộng tác viên
function deleteAffiliaterAPI($input){
    global $controller;
    global $isRequestPost;
   
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token']) && !empty($dataSend['id'])){
            $infoMember = getMemberByToken($dataSend['token'],'deleteAffiliaterAgency');

            if(!empty($infoMember)){
                if(empty($infoMember->grant_permission)){
                    return array('code'=>4, 'mess'=>'Bạn không có quyền');
                }

                $modelAffiliaters = $controller->loadModel('Affiliaters');
                $modelTransactionAffiliateHistories = $controller->loadModel('TransactionAffiliateHistories');
                
                $data = $modelAffiliaters->find()->where(array('id_member'=>$infoMember->id, 'id'=>(int)$dataSend['id']))->first();
                    
                if(!empty($data)){
                    $note = $infoMember->type_tv.' '. $infoMember->name.' xóa thông tin cộng tác viên '.$data->name.' có id là:'.$data->id;
                    addActivityHistory($infoMember,$note,'deleteAffiliaterAgency',$data->id);
                    $modelTransactionAffiliateHistories->deleteAll(array('id_affiliater'=>$data));
                    $modelAffiliaters->delete($data);
                    $return = array('code'=>1, 'mess'=>'xóa dữ liệu thành công ');
                }else{
                     $return = array('code'=>4, 'mess'=>'Dữ liệu không tồn tại ');
                }
            }else{
                $return = array('code'=>3, 'mess'=>'Sai mã token');
            }
        }else{
            $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
         $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
    }

    return $return;
}

// lấy danh sách giao dịch công tác viên 
function listTransactionAffiliaterAPI($input)
{
    global $controller;
    global $isRequestPost;
   
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token'], 'listTransactionAffiliaterAgency');

            if(!empty($infoMember)){
                if(empty($infoMember->grant_permission)){
                    return array('code'=>4, 'mess'=>'Bạn không có quyền');
                }


                $modelAffiliaters = $controller->loadModel('Affiliaters');
                $modelTransactionAffiliateHistories = $controller->loadModel('TransactionAffiliateHistories');


                $conditions = array('id_member'=>$infoMember->id);
                $limit = 20;
                $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
                if($page<1) $page = 1;
                $order = array('id'=>'desc');

                if(!empty($dataSend['id'])){
                    $conditions['id'] = (int) $dataSend['id'];
                }

                if(!empty($dataSend['phone'])){
                    $conditions = ['phone'=>$dataSend['phone']];
                    $checkPhone = $modelAffiliaters->find()->where($conditions)->first();
                    if(!empty($checkPhone)){
                        $conditions['id_affiliater'] = $checkPhone->id;
                    }else{
                        $conditions['id_affiliater'] = 0;
                    }
                    
                }

                if(!empty($dataSend['id_order'])){
                    $conditions['id_order'] = (int) $dataSend['id_order'];
                }

                if(!empty($_GET['status'])){
                    $conditions['status'] = $_GET['status'];
                }

               
                    $listData = $modelTransactionAffiliateHistories->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

                if(!empty($listData)){
                    foreach ($listData as $key => $value) {
                        $listData[$key]->aff = $modelAffiliaters->find()->where(['id'=>$value->id_affiliater])->first();
                    }
                }
                // phân trang
                $totalData = $modelTransactionAffiliateHistories->find()->where($conditions)->all()->toList();
                $totalData = count($totalData);
                $return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công', 'listData'=>$listData, 'totalData'=>$totalData);

            }else{
                $return = array('code'=>3, 'mess'=>'Sai mã token');
            }
        }else{
            $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
         $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
    }

    return $return;
}

//lấy chi tết công tác viên
function getTransactionAffiliaterAPI($input)
{
    global $controller;
    global $isRequestPost;
   
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token']) && !empty($dataSend['id'])){
            $infoMember = getMemberByToken($dataSend['token'],'listTransactionAffiliaterAgency');

            if(!empty($infoMember)){
                if(empty($infoMember->grant_permission)){
                    return array('code'=>4, 'mess'=>'Bạn không có quyền');
                }

                $modelAffiliaters = $controller->loadModel('Affiliaters');
                $modelTransactionAffiliateHistories = $controller->loadModel('TransactionAffiliateHistories');

                $conditions = array('id_member'=>$infoMember->id, 'id'=>$dataSend['id']);
               
                $data = $modelTransactionAffiliateHistories->find()->where($conditions)->order($order)->first();

                if(!empty($data)){
                        $listData[$key]->aff = $modelAffiliaters->find()->where(['id'=>$value->id_affiliater])->first();
                }
                $return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công', 'data'=>$data);

            }else{
                $return = array('code'=>3, 'mess'=>'Sai mã token');
            }
        }else{
            $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
         $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
    }

    return $return;
}

// thanh toán tiền hoa hồng cho cộng tác viên
function payTransactionAffiliaterAPI($input)
{
    global $controller;
    global $isRequestPost;
   
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token']) && !empty($dataSend['id'])){
            $infoMember = getMemberByToken($dataSend['token'], 'payTransactionAffiliaterAgency');

            if(!empty($infoMember)){
                if(empty($infoMember->grant_permission)){
                    return array('code'=>4, 'mess'=>'Bạn không có quyền');
                }
                
                $modelTransactionAffiliateHistories = $controller->loadModel('TransactionAffiliateHistories');
                $modelAffiliaters = $controller->loadModel('Affiliaters');
                $modelBill = $controller->loadModel('Bills');
                    
                $data = $modelTransactionAffiliateHistories->find()->where(array('id_member'=>$infoMember->id, 'id'=>(int)$dataSend['id']))->first();
                    
                if(!empty($data)){
                    $aff = $modelAffiliaters->get($data->id_affiliater);
                    $data->status = 'done';

                    $modelTransactionAffiliateHistories->save($data);
                    $time= time();
                     // bill cho người mua
                    $billbuy = $modelBill->newEmptyEntity();
                    $billbuy->id_member_sell = 0;
                    $billbuy->id_member_buy =  $infoMember->id;
                    $billbuy->total = $data->money_back;
                    $billbuy->id_order = $data->id;
                    $billbuy->type = 2;
                    $billbuy->type_order = 4; 
                    $billbuy->created_at = $time;
                    $billbuy->updated_at = $time;
                    $billbuy->id_debt = 0;
                    $billbuy->type_collection_bill =  @$dataSend['type_collection_bill'];
                    $billbuy->id_customer = 0;
                    $billbuy->id_aff = $data->id_affiliater;
                    $billbuy->note = 'Thanh toán chiết khấu cho người tiếp thị tên là '.@$aff->name.' '.@$aff->phone.'  giao dịch có id '.$data->id;
                    $modelBill->save($billbuy);
                    $note = $user->type_tv.' '. $user->name.' '.$billbuy->note;
                    addActivityHistory($infoMember,$note,'payTransactionAffiliaterAgency',$billbuy->id);
                    $return = array('code'=>1, 'mess'=>'Thanh toán thành công');
                }else{
                    $return = array('code'=>2, 'mess'=>'Dữ liệu không tồn tại');
                }
            }else{
                $return = array('code'=>3, 'mess'=>'Sai mã token');
            }
        }else{
            $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
         $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
    }

    return $return;
}

// cài hoa hồng cho cộng tác viên
function settingAffiliateAPI($input){
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;
    global $modelCategories;
    global $session;
    global $controller;

    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token']) && !empty($dataSend['id'])){
            $infoMember = getMemberByToken($dataSend['token'],'settingAffiliateAgency');

            if(!empty($infoMember)){
                if(empty($infoMember->grant_permission)){
                    return array('code'=>4, 'mess'=>'Bạn không có quyền');
                }

                $conditions = array('key_word' => 'settingAffiliateAgency'.$infoMember->id);

                $data = $modelOptions->find()->where($conditions)->first();
                if(empty($data)){
                    $data = $modelOptions->newEmptyEntity();
                }
                    $dataSend = $input['request']->getData();

                    $value = array( 'percent1' => (double) $dataSend['percent1'],
                                    'percent2' => (double) $dataSend['percent2'],
                                    'percent3' => (double) $dataSend['percent3'],
                                    'percent4' => (double) $dataSend['percent4'],
                                    'percent5' => (double) $dataSend['percent5'],
                                    'percent6' => (double) $dataSend['percent6'],
                                    'percent7' => (double) $dataSend['percent7'],
                                    'percent8' => (double) $dataSend['percent8'],
                                    'percent9' => (double) $dataSend['percent9'],
                                    'percent10' => (double) $dataSend['percent10'],
                                );

                    $data->key_word = 'settingAffiliateAgency'.$infoMember->id;
                    $data->value = json_encode($value);

                    $modelOptions->save($data);

                $data_value = array();
                if(!empty($data->value)){
                    $data_value = json_decode($data->value, true);
                }

                $note = $infoMember->type_tv.' '. $infoMember->name.' cập nhập hoa hồng cho cộng tắc viên ';
                    

                addActivityHistory($infoMember,$note,'settingAffiliateAgency',$data->id);

           
                 $return = array('code'=>1, 'mess'=>'Lữu dữ liệu thành công', 'data'=>$data_value);

             }else{
                $return = array('code'=>3, 'mess'=>'Sai mã token');
            }
        }else{
            $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
         $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
    }

    return $return;
}

// lày tiền hoa hồng cho cộng tác viên
function getAffiliateAPI($input){
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;
    global $modelCategories;
    global $session;
    global $controller;

    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token']) && !empty($dataSend['id'])){
            $infoMember = getMemberByToken($dataSend['token'],'listAffiliaterAgency');

            if(!empty($infoMember)){
                 if(empty($infoMember->grant_permission)){
                    return array('code'=>4, 'mess'=>'Bạn không có quyền');
                }
                $conditions = array('key_word' => 'settingAffiliateAgency'.$infoMember->id);

                $data = $modelOptions->find()->where($conditions)->first();
                if(empty($data)){
                 
                    $data_value = array();
                    if(!empty($data->value)){
                        $data_value = json_decode($data->value, true);
                    }

               
                     $return = array('code'=>1, 'mess'=>'Lữu dữ liệu thành công', 'data'=>$data_value);
                }else{
                    $return = array('code'=>3, 'mess'=>'Dữ không tồn tại ');
                }

             }else{
                $return = array('code'=>3, 'mess'=>'Sai mã token');
            }
        }else{
            $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
         $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
    }

    return $return;
}

?>