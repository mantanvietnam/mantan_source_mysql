<?php 
function searchCustomerAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $modelCategories;

    $return= array();
    $modelCustomers = $controller->loadModel('Customers');

    $dataSend = $_REQUEST;

    
    $conditions = [];

    if(!empty($dataSend['term'])){
        $conditions['full_name LIKE'] = '%'.$dataSend['term'].'%';
    }

    if(!empty($dataSend['id'])){
        $conditions['id'] = (int) $dataSend['id'];
    }

    if(!empty($dataSend['phone'])){
        $dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone']));
        $dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

        $conditions['phone'] = $dataSend['phone'];
    }

    if(!empty($dataSend['email'])){
        $conditions['email'] = $dataSend['email'];
    }

    if(!empty($dataSend['status'])){
        $conditions['status'] = $dataSend['status'];
    }

    if(!empty($dataSend['id_member'])){
        $conditions['id_parent'] = (int) $dataSend['id_member'];
    }

    $listData= $modelCustomers->find()->where($conditions)->all()->toList();
    
    if($listData){
        foreach($listData as $data){
            $return[]= array(   'id'=>$data->id,
                                'label'=>$data->full_name.' '.$data->phone,
                                'value'=>$data->id,
                                'full_name'=>$data->full_name,
                                'avatar'=>$data->avatar,
                                'phone'=>$data->phone,
                                'id_member'=>$data->id_parent,
                                'email'=>$data->email,
                                'status'=>$data->status,
                                'created_at'=>$data->created_at,
                                'address'=>$data->address,
                            );
        }
    }else{
        $return= array(array(   'id'=>0, 
                                'label'=>'Không tìm được khách hàng, hãy tạo thông tin cho khách hàng mới', 
                                'value'=>'', 
                            )
                );
    }
        

    return $return;
}

function getListCustomerAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    $modelCustomers = $controller->loadModel('Customers');
    $modelOrders = $controller->loadModel('Orders');
    $modelCustomerHistories = $controller->loadModel('CustomerHistories');

    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token']);

            if(!empty($infoMember)){
                // danh sách nhóm khách hàng
                $conditions = array('type' => 'group_customer', 'parent'=>$infoMember->id);
                $listGroup = $modelCategories->find()->where($conditions)->all()->toList();
                $listNameGroup = [];
                if(!empty($listGroup)){
                    foreach ($listGroup as $key => $value) {
                        $listNameGroup[$value->id] = $value->name;
                    }
                }

                $conditions = array('id_parent'=>$infoMember->id);
                $limit = (!empty($dataSend['limit']))?(int)$dataSend['limit']:20;
                $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
                if($page<1) $page = 1;
                $order = array('id'=>'desc');

                $listData = $modelCustomers->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

                if(!empty($listData)){
                    foreach ($listData as $key => $value) {
                        // thống kê đơn hàng
                        $order = $modelOrders->find()->where(['id_user'=>$value->id])->all()->toList();
                        $listData[$key]->number_order = count($order);

                        // lịch sử chăm sóc
                        $listData[$key]->history = $modelCustomerHistories->find()->where(['id_customer'=>$value->id])->order(['id'=>'desc'])->first();

                        // nhóm khách hàng
                        $group_customers = $modelCategoryConnects->find()->where(['keyword'=>'group_customers', 'id_parent'=>(int) $value->id])->all()->toList();
                        $value->groups = [];

                        if(!empty($group_customers)){
                            foreach ($group_customers as $group) {
                                if(!empty($listNameGroup[$group->id_category])){
                                    $value->groups[] = $listNameGroup[$group->id_category];
                                }
                            }
                        }

                        $listData[$key]->groups = $value->groups;
                    }
                }
                
                $totalData = $modelCustomers->find()->where($conditions)->all()->toList();
                
                $return = array('code'=>0, 'listData'=>$listData, 'totalData'=>count($totalData), 'listGroup'=>$listGroup);
            }else{
                 $return = array('code'=>3, 'mess'=>'Sai mã token');
            }
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }

    return $return;
}

function getInfoCustomerAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    $modelCustomers = $controller->loadModel('Customers');
    $modelOrders = $controller->loadModel('Orders');
    $modelCustomerHistories = $controller->loadModel('CustomerHistories');

    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token']);

            if(!empty($infoMember)){
                if(!empty($dataSend['id_customer'])){
                    $infoCustomer = $modelCustomers->find()->where(['id'=>(int) $dataSend['id_customer'], 'id_parent'=>$infoMember->id])->first();

                    if(!empty($infoCustomer)){
                        // danh sách nhóm khách hàng
                        $conditions = array('type' => 'group_customer', 'parent'=>$infoMember->id);
                        $listGroup = $modelCategories->find()->where($conditions)->all()->toList();
                        $listNameGroup = [];
                        if(!empty($listGroup)){
                            foreach ($listGroup as $key => $value) {
                                $listNameGroup[$value->id] = $value->name;
                            }
                        }

                        // thống kê đơn hàng
                        $order = $modelOrders->find()->where(['id_user'=>$infoCustomer->id])->all()->toList();
                        $infoCustomer->number_order = count($order);

                        // lịch sử chăm sóc
                        $infoCustomer->history = $modelCustomerHistories->find()->where(['id_customer'=>$infoCustomer->id])->order(['id'=>'desc'])->first();

                        // nhóm khách hàng
                        $group_customers = $modelCategoryConnects->find()->where(['keyword'=>'group_customers', 'id_parent'=>(int) $infoCustomer->id])->all()->toList();
                        $infoCustomer->groups = [];

                        if(!empty($group_customers)){
                            foreach ($group_customers as $group) {
                                if(!empty($listNameGroup[$group->id_category])){
                                    $infoCustomer->groups[] = $listNameGroup[$group->id_category];
                                }
                            }
                        }

                        $return = array('code'=>0, 'infoCustomer'=>$infoCustomer);
                    }else{
                        $return = array('code'=>4, 'mess'=>'Tài khoản khách hàng không tồn tại hoặc bạn khách hàng này không do bạn quản lý nữa');
                    }
                    
                }else{
                    $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
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

function saveInfoCustomerAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $session;
    global $urlHomes;
    global $modelCategoryConnects;
    global $modelCategories;

    $modelCustomers = $controller->loadModel('Customers');
    $modelOrders = $controller->loadModel('Orders');
    $modelCustomerHistories = $controller->loadModel('CustomerHistories');
    $modelMembers = $controller->loadModel('Members');

    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token']) || !empty($dataSend['id_member'])){
            if(!empty($dataSend['token'])){
                $infoMember = getMemberByToken($dataSend['token']);
            }else{
                $infoMember = $modelMembers->find()->where(['id'=>(int) $dataSend['id_member']])->first();
            }

            if(!empty($infoMember)){
                if( !empty($dataSend['full_name']) && 
                    !empty($dataSend['phone'])
                ){
                    $dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone']));
                    $dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

                    if(!empty($dataSend['id'])){
                        $infoCustomer = $modelCustomers->find()->where(['id'=>(int) $dataSend['id'], 'id_parent'=>$infoMember->id])->first();
                        
                        if(empty($infoCustomer)){
                            return array('code'=>4, 'mess'=>'Khách hàng không thuộc quyền quản lý của đại lý');
                        }
                    }else{
                        $infoCustomer = $modelCustomers->find()->where(['phone'=>$dataSend['phone']])->first();

                        if(!empty($infoCustomer)){
                            if($infoCustomer->id_parent != $infoMember->id){
                                return array('code'=>5, 'mess'=>'Khách hàng đã có dữ liệu trong hệ thống');
                            }
                        }else{
                            $infoCustomer = $modelCustomers->newEmptyEntity();

                            $infoCustomer->status = 'active';
                            $infoCustomer->pass = md5($dataSend['phone']);
                            $infoCustomer->phone = $dataSend['phone'];
                            $infoCustomer->created_at = time();
                        }
                    }

                    $infoCustomer->full_name = $dataSend['full_name'];
                    
                    if(!empty($dataSend['email'])){
                        $infoCustomer->email = $dataSend['email'];
                    }elseif(empty($infoCustomer->email)){
                        $infoCustomer->email  = '';
                    }

                    if(!empty($dataSend['address'])){
                        $infoCustomer->address = $dataSend['address'];
                    }elseif(empty($infoCustomer->address)){
                        $infoCustomer->address  = '';
                    }

                    if(!empty($dataSend['id_messenger'])){
                        $infoCustomer->id_messenger = $dataSend['id_messenger'];
                    }elseif(empty($infoCustomer->id_messenger)){
                        $infoCustomer->id_messenger  = '';
                    }

                    if(!empty($dataSend['id_zalo'])){
                        $infoCustomer->id_zalo = $dataSend['id_zalo'];
                    }elseif(empty($infoCustomer->id_zalo)){
                        $infoCustomer->id_zalo  = '';
                    }

                    if(!empty($dataSend['sex'])){
                        $infoCustomer->sex = (int) $dataSend['sex'];
                    }elseif(empty($infoCustomer->sex)){
                        $infoCustomer->sex  = 0;
                    }

                    if(!empty($dataSend['id_city'])){
                        $infoCustomer->id_city = (int) $dataSend['id_city'];
                    }elseif(empty($infoCustomer->id_city)){
                        $infoCustomer->id_city  = 0;
                    }

                    if(!empty($dataSend['birthday_date'])){
                        $infoCustomer->birthday_date = (int) $dataSend['birthday_date'];
                    }elseif(empty($infoCustomer->birthday_date)){
                        $infoCustomer->birthday_date  = 0;
                    }

                    if(!empty($dataSend['birthday_month'])){
                        $infoCustomer->birthday_month = (int) $dataSend['birthday_month'];
                    }elseif(empty($infoCustomer->birthday_month)){
                        $infoCustomer->birthday_month  = 0;
                    }

                    if(!empty($dataSend['birthday_year'])){
                        $infoCustomer->birthday_year = (int) $dataSend['birthday_year'];
                    }elseif(empty($infoCustomer->birthday_year)){
                        $infoCustomer->birthday_year  = 0;
                    }

                    if(!empty($dataSend['birthday'])){
                        $birthday = explode('/', $dataSend['birthday']);

                        if(count($birthday) == 3){
                            $infoCustomer->birthday_date = (int) $birthday[0];
                            $infoCustomer->birthday_month = (int) $birthday[1];
                            $infoCustomer->birthday_year = (int) $birthday[2];
                        }
                    }

                    if(!empty($dataSend['id_aff'])){
                        $infoCustomer->id_aff = (int) $dataSend['id_aff'];
                    }elseif(empty($infoCustomer->id_aff)){
                        $infoCustomer->id_aff  = 0;
                    }

                    if(!empty($dataSend['id_group'])){
                        $dataSend['id_group'] = explode(',', $dataSend['id_group']);

                        $infoCustomer->id_group = (int) $dataSend['id_group'][0];
                    }elseif(empty($infoCustomer->id_group)){
                        $infoCustomer->id_group  = 0;
                    }

                    if(!empty($dataSend['facebook'])){
                        $infoCustomer->facebook = $dataSend['facebook'];
                    }elseif(empty($infoCustomer->facebook)){
                        $infoCustomer->facebook  = '';
                    }

                    // nếu up file ảnh avatar lên
                    if(!is_string($dataSend['avatar'])){
                        $dataSend['avatar'] = '';
                    }

                    if(isset($_FILES['avatar']) && empty($_FILES['avatar']["error"])){
                        $avatar = uploadImage($infoMember->id, 'avatar');

                        if(!empty($avatar['linkOnline'])){
                            $dataSend['avatar'] = $avatar['linkOnline'];
                        }
                    }

                    if(empty($dataSend['avatar'])){
                        if(empty($infoCustomer->avatar)){
                            $dataSend['avatar'] = $urlHomes.'/plugins/hethongdaily/view/home/assets/img/avatar-default-crm.png';
                        }else{
                            $dataSend['avatar'] = $infoCustomer->avatar;
                        }
                    }

                    $infoCustomer->avatar = $dataSend['avatar'];
                    $infoCustomer->id_parent = $infoMember->id;

                    $modelCustomers->save($infoCustomer);

                    if(!empty($dataSend['id_group'])){
                        foreach ($dataSend['id_group'] as $id_group) {
                            $categoryConnects = $modelCategoryConnects->find()->where(['keyword'=>'group_customers', 'id_parent'=>(int) $infoCustomer->id, 'id_category'=>(int)$id_group])->first();

                            if(empty($categoryConnects)){
                                $categoryConnects = $modelCategoryConnects->newEmptyEntity();

                                $categoryConnects->keyword = 'group_customers';
                                $categoryConnects->id_parent = $infoCustomer->id;
                                $categoryConnects->id_category = (int) $id_group;

                                $modelCategoryConnects->save($categoryConnects);
                            }
                        }
                    }

                    // lưu lịch sử chăm sóc khách hàng
                    if(empty($dataSend['id'])){
                        $note_now = 'Đại lý '.$infoMember->name.' ('.$infoMember->phone.') tạo dữ liệu khách hàng';
                        $action_now = 'create';
                    }else{
                        $note_now = 'Đại lý '.$infoMember->name.' ('.$infoMember->phone.') sửa dữ liệu khách hàng';
                        $action_now = 'edit';
                    }

                    $customer_histories = $modelCustomerHistories->newEmptyEntity();

                    $customer_histories->id_customer = $infoCustomer->id;
                    $customer_histories->time_now = time();
                    $customer_histories->note_now = $note_now;
                    $customer_histories->action_now = $action_now;
                    $customer_histories->id_staff_now = $infoMember->id;
                    $customer_histories->status = 'done';

                    $modelCustomerHistories->save($customer_histories);

                    $return = array('code'=>0, 'mess'=>'Lưu dữ liệu thành công', 'id_customer_crm'=>$infoCustomer->id);
                    $return['set_attributes']['id_customer_crm']= $infoCustomer->id;
                }else{
                    $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
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

function deleteGroupCustomerAPI($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;
    global $modelCategoryConnects;

    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        
        if(!empty($dataSend['token']) && !empty($dataSend['id'])){
            $infoMember = getMemberByToken($dataSend['token']);

            if(!empty($infoMember)){
                $infoCategory = $modelCategories->find()->where(['id'=>(int) $dataSend['id'], 'parent'=>$infoMember->id])->first();

                if(!empty($infoCategory)){
                    $modelCategories->delete($infoCategory);

                    $modelCategoryConnects->deleteAll(['keyword'=>'group_customers', 'id_category'=>(int)$dataSend['id']]);

                    $return = array('code'=>0, 'mess'=>'Xóa nhóm khách hàng thành công');
                }else{
                    $return = array('code'=>4, 'mess'=>'Không phải nhóm khách hàng của bạn');
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

function addGroupCustomerAPI($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;

    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        
        if(!empty($dataSend['token']) && !empty($dataSend['name'])){
            $infoMember = getMemberByToken($dataSend['token']);

            if(!empty($infoMember)){
                if(!empty($dataSend['id'])){
                    $infoCategory = $modelCategories->find()->where(['id'=>(int) $dataSend['id'], 'parent'=>$infoMember->id])->first();

                    if(empty($infoCategory)){
                        return array('code'=>4, 'mess'=>'Không phải nhóm khách hàng của bạn');
                    }
                }else{
                    $infoCategory = $modelCategories->newEmptyEntity();
                }

                $infoCategory->name = str_replace(array('"', "'"), '’', $dataSend['name']);
                $infoCategory->parent = $infoMember->id;
                $infoCategory->image = '';
                $infoCategory->keyword = '';
                $infoCategory->description = '';
                $infoCategory->type = 'group_customer';
                $infoCategory->slug = createSlugMantan($infoCategory->name);

                $modelCategories->save($infoCategory);

                $return = array('code'=>0, 'mess'=>'Lưu nhóm khách hàng thành công', 'id_group'=>$infoCategory->id);
                
            }else{
                $return = array('code'=>3, 'mess'=>'Sai mã token');
            }
        }else{
            $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }

    return $return;
}

function listGroupCustomerAPI($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;
    global $modelCategoryConnects;

    $return = array('code'=>1);

    $modelCustomers = $controller->loadModel('Customers');
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token']);

            if(!empty($infoMember)){
                $listData = $modelCategories->find()->where(['type'=>'group_customer', 'parent'=>$infoMember->id])->all()->toList();

                if(!empty($listData)){
                    foreach ($listData as $key => $value) {
                        $customers = $modelCategoryConnects->find()->where(['keyword'=>'group_customers','id_category'=>$value->id])->all()->toList();
                        $listData[$key]->number_customer = count($customers);
                    }
                }

                $return = array('code'=>0, 'listData'=>$listData);
                
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