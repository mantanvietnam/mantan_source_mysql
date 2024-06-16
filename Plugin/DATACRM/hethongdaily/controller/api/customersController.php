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
        $dataSend['phone LIKE'] = '%'.str_replace('+84','0',$dataSend['phone']).'%';

        $conditions['phone LIKE'] = '%'.$dataSend['phone'].'%';
    }

    if(!empty($dataSend['email'])){
        $conditions['email LIKE'] =  '%'.$dataSend['email'].'%';
    }

    if(!empty($dataSend['status'])){
        $conditions['status'] = $dataSend['status'];
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

                $conditions = array('CategoryConnects.id_category'=>$infoMember->id, 'CategoryConnects.keyword'=>'member_customers');
                $limit = (!empty($dataSend['limit']))?(int)$dataSend['limit']:20;
                $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
                if($page<1) $page = 1;
                $order = array('Customers.id'=>'desc');
                $join = [
                    [
                        'table' => 'category_connects',
                        'alias' => 'CategoryConnects',
                        'type' => 'LEFT',
                        'conditions' => [
                            'Customers.id = CategoryConnects.id_parent'
                        ],
                    ]
                ];
                $select = ['Customers.id','Customers.full_name','Customers.phone','Customers.email','Customers.address','Customers.sex','Customers.id_city','Customers.id_messenger','Customers.avatar','Customers.status','Customers.id_parent','Customers.id_level','Customers.birthday_date','Customers.birthday_month','Customers.birthday_year','Customers.id_aff','Customers.created_at','Customers.id_group','Customers.facebook','Customers.id_zalo'];

                $listData = $modelCustomers->find()->join($join)->select($select)->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

                if(!empty($listData)){
                    foreach ($listData as $key => $value) {
                        // thống kê đơn hàng
                        $order = $modelOrders->find()->where(['id_user'=>$value->id])->all()->toList();
                        $listData[$key]->number_order = count($order);

                        // lịch sử chăm sóc
                        $listData[$key]->history = $modelCustomerHistories->find()->where(['id_customer'=>$value->id])->order(['id'=>'desc'])->first();

                        // nhóm khách hàng
                        $group_customers = $modelCategoryConnects->find()->where(['keyword'=>'group_customers', 'id_parent'=>(int) $value->id])->all()->toList();
                        $value->name_groups = [];
                        $value->id_groups = [];

                        if(!empty($group_customers)){
                            foreach ($group_customers as $group) {
                                if(!empty($listNameGroup[$group->id_category])){
                                    $value->name_groups[] = $listNameGroup[$group->id_category];
                                    $value->id_groups[] = $group->id_category;
                                }
                            }
                        }

                        $listData[$key]->groups = $value->groups;
                    }
                }
                
                $totalData = $modelCustomers->find()->join($join)->select($select)->where($conditions)->all()->toList();
                
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
                    $join = [
                        [
                            'table' => 'category_connects',
                            'alias' => 'CategoryConnects',
                            'type' => 'LEFT',
                            'conditions' => [
                                'Customers.id = CategoryConnects.id_parent'
                            ],
                        ]
                    ];
                    $select = ['Customers.id','Customers.full_name','Customers.phone','Customers.email','Customers.address','Customers.sex','Customers.id_city','Customers.id_messenger','Customers.avatar','Customers.status','Customers.id_parent','Customers.id_level','Customers.birthday_date','Customers.birthday_month','Customers.birthday_year','Customers.id_aff','Customers.created_at','Customers.id_group','Customers.facebook','Customers.id_zalo'];

                    $infoCustomer = $modelCustomers->find()->join($join)->select($select)->where(['Customers.id'=>(int) $dataSend['id_customer'], 'CategoryConnects.id_category'=>$infoMember->id, 'CategoryConnects.keyword'=>'member_customers'])->first();

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
                        $infoCustomer->name_groups = [];
                        $infoCustomer->id_groups = [];

                        if(!empty($group_customers)){
                            foreach ($group_customers as $group) {
                                if(!empty($listNameGroup[$group->id_category])){
                                    $infoCustomer->name_groups[] = $listNameGroup[$group->id_category];
                                    $infoCustomer->id_groups[] = $group->id_category;
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
    $modelTokenDevices = $controller->loadModel('TokenDevices');

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
                    $infoCustomer = $modelCustomers->find()->where(['id'=>(int) $dataSend['id']])->first();

                    if(empty($infoCustomer)){
                        return array('code'=>4, 'mess'=>'Không tìm được khách hàng');
                    }
                }else{
                    $infoCustomer = $modelCustomers->find()->where(['phone'=>$dataSend['phone']])->first();

                        // nếu đã có dữ liệu khách hàng
                    if(!empty($infoCustomer)){
                        $infoCustomer->id_parent = $infoMember->id;
                        $infoCustomer->full_name = $dataSend['full_name'];

                        if(!empty($dataSend['email'])){
                            $infoCustomer->email = $dataSend['email'];
                        }

                        if(!empty($dataSend['address'])){
                            $infoCustomer->address = $dataSend['address'];
                        }

                        if(isset($_FILES['avatar']) && empty($_FILES['avatar']["error"])){
                            $avatar = uploadImage($infoMember->id, 'avatar', 'avatar_'.$infoCustomer->phone);

                            if(!empty($avatar['linkOnline'])){
                                $infoCustomer->avatar = $avatar['linkOnline'];
                            }
                        }else{
                            if(!empty($dataSend['avatar'])){
                                $infoCustomer->avatar = $dataSend['avatar'];
                            }
                        }

                        if(!empty($dataSend['id_group'])){
                            $dataSend['id_group'] = explode(',', $dataSend['id_group']);
                        }

                            // in thẻ thành viên
                        if(empty($infoCustomer->img_card_member)){
                            if(!empty($dataSend['id_group'])){
                                $infoCustomer->id_group = (int) $dataSend['id_group'][0];

                                $infoGroup = $modelCategories->find()->where(['id'=>(int) $dataSend['id_group'][0], 'type' => 'group_customer', 'parent'=>$infoMember->id])->first();

                                if(!empty($infoGroup->description)){
                                    $ezpics_config = json_decode($infoGroup->description, true);

                                    if(!empty($ezpics_config['id_ezpics'])){
                                        $img_card_member = "https://designer.ezpics.vn/create-image-series/?id=".$ezpics_config['id_ezpics']."&".$ezpics_config['ezpics_full_name']."=".$infoCustomer->full_name."&".$ezpics_config['ezpics_phone']."=".$infoCustomer->phone."&".$ezpics_config['ezpics_code']."=KH".$infoCustomer->phone."&".$ezpics_config['ezpics_avatar']."=".$infoCustomer->avatar."&".$ezpics_config['ezpics_name_member']."=".$infoMember->name;

                                            //$image_data = file_get_contents($img_card_member);
                                            //file_put_contents(__DIR__."/../../../../upload/admin/images/".$infoMember->id."/card_member_".$infoCustomer->phone.".png", $image_data);

                                            //$infoCustomer->img_card_member = $urlHomes."upload/admin/images/".$infoMember->id."/card_member_".$infoCustomer->phone.".png";
                                        $infoCustomer->img_card_member = $img_card_member;
                                    }
                                }

                            }
                        }

                        $modelCustomers->save($infoCustomer);

                            // lưu bảng đại lý
                        $statusCustomerMember = saveCustomerMember($infoCustomer->id, $infoMember->id);

                        if($statusCustomerMember == 'new'){
                                // bắn thông báo có dữ liệu khách hàng mới
                            if(!empty($infoMember->noti_new_customer) && empty($dataSend['token'])){
                                $dataSendNotification= array('title'=>'Khách hàng mới','time'=>date('H:i d/m/Y'),'content'=>$infoCustomer->full_name.' đã trở thành khách hàng mới của bạn','action'=>'addCustomer');
                                $token_device = [];

                                $listTokenDevice =  $modelTokenDevices->find()->where(['id_member'=>$infoMember->id])->all()->toList();

                                if(!empty($listTokenDevice)){
                                    foreach ($listTokenDevice as $tokenDevice) {
                                        if(!empty($tokenDevice->token_device)){
                                            $token_device[] = $tokenDevice->token_device;
                                        }
                                    }

                                    if(!empty($token_device)){
                                        $return = sendNotification($dataSendNotification, $token_device);
                                    }
                                }
                            }
                        }

                        if(!empty($dataSend['clear_group'])){
                            $modelCategoryConnects->deleteAll(['id_parent'=>$infoCustomer->id, 'keyword'=>'group_customers']);
                        }

                            // lưu bảng nhóm khách hàng
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

                            // lưu bảng chiến dịch
                        if(!empty($dataSend['id_campaign']) && function_exists('getInfoCampaign')){
                            $modelCampaignCustomers = $controller->loadModel('CampaignCustomers');

                            $infoCampaign = getInfoCampaign($dataSend['id_campaign'], $infoMember->id);

                            if(!empty($infoCampaign)){
                                $checkCampaign = $modelCampaignCustomers->find()->where(['id_member'=>$infoMember->id, 'id_customer'=>(int) $infoCustomer->id, 'id_campaign'=>(int) $dataSend['id_campaign']])->first();

                                if(empty($checkCampaign)){
                                    $checkCampaign = $modelCampaignCustomers->newEmptyEntity();

                                    $checkCampaign->id_member = $infoMember->id;
                                    $checkCampaign->id_customer = $infoCustomer->id;
                                    $checkCampaign->id_campaign = (int) $dataSend['id_campaign'];
                                    $checkCampaign->create_at = time();
                                }

                                if(!empty($dataSend['id_location'])){
                                    $checkCampaign->id_location = (int) @$dataSend['id_location'];
                                }elseif(empty($checkCampaign->id_location)){
                                    $checkCampaign->id_location = 0;
                                }

                                if(!empty($dataSend['id_ticket'])){
                                    $checkCampaign->id_ticket = (int) @$dataSend['id_ticket'];
                                }elseif(empty($checkCampaign->id_ticket)){
                                    $checkCampaign->id_ticket = 0;
                                }

                                if(!empty($dataSend['id_team'])){
                                    $checkCampaign->id_team = (int) @$dataSend['id_team'];
                                }elseif(empty($checkCampaign->id_team)){
                                    $checkCampaign->id_team = 0;
                                }

                                if(!empty($dataSend['note_campaign'])){
                                    $checkCampaign->note = @$dataSend['note_campaign'];
                                }elseif(empty($checkCampaign->note)){
                                    $checkCampaign->note = '';
                                }

                                if(!empty($dataSend['checkin'])){
                                    $checkCampaign->time_checkin = time();
                                }elseif(empty($checkCampaign->time_checkin)){
                                    $checkCampaign->time_checkin = 0;
                                }

                                $modelCampaignCustomers->save($checkCampaign);

                                    // bắn thông báo khách đăng ký hoặc checkin chiến dịch
                                if( empty($dataSend['token']) && (
                                    (!empty($infoMember->noti_reg_campaign) && empty($dataSend['checkin'])) ||
                                    (!empty($infoMember->noti_checkin_campaign) && !empty($dataSend['checkin']))
                                )
                            ){
                                    $actionCampaign = 'đăng ký tham gia';
                                    if(!empty($dataSend['checkin'])){
                                        $actionCampaign = 'checkin';
                                    }

                                    $dataSendNotification= array('title'=>'Khách '.$actionCampaign.' chiến dịch','time'=>date('H:i d/m/Y'),'content'=>$infoCustomer->full_name.' đã '.$actionCampaign.' chiến dịch '.$infoCampaign->name,'action'=>'addCustomerCampaign', 'id_campaign'=>$infoCampaign->id);
                                    $token_device = [];

                                    $listTokenDevice =  $modelTokenDevices->find()->where(['id_member'=>$infoMember->id])->all()->toList();

                                    if(!empty($listTokenDevice)){
                                        foreach ($listTokenDevice as $tokenDevice) {
                                            if(!empty($tokenDevice->token_device)){
                                                $token_device[] = $tokenDevice->token_device;
                                            }
                                        }

                                        if(!empty($token_device)){
                                            $return = sendNotification($dataSendNotification, $token_device);
                                        }
                                    }
                                }
                            }
                        }

                        if(empty($infoCustomer->img_card_member)) $infoCustomer->img_card_member = '';

                        return array('code'=>5, 'mess'=>'Khách hàng đã có dữ liệu trong hệ thống, cập nhập dữ liệu thành công', 'id_customer_crm'=>$infoCustomer->id, "img_card_member"=>$infoCustomer->img_card_member);

                    }else{
                        $infoCustomer = $modelCustomers->newEmptyEntity();

                        $infoCustomer->status = 'active';
                        $infoCustomer->pass = md5($dataSend['phone']);
                        $infoCustomer->phone = $dataSend['phone'];
                        $infoCustomer->created_at = time();
                    }
                }

                $infoCustomer->full_name = $dataSend['full_name'];

                if(empty($infoCustomer->created_at)){
                    $infoCustomer->created_at = time();
                }

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

                if(!empty($dataSend['facebook'])){
                    $infoCustomer->facebook = $dataSend['facebook'];
                }elseif(empty($infoCustomer->facebook)){
                    $infoCustomer->facebook  = '';
                }

                    // nếu up file ảnh avatar lên
                if(empty($dataSend['avatar']) || !is_string($dataSend['avatar'])){
                    $dataSend['avatar'] = '';
                }

                if(isset($_FILES['avatar']) && empty($_FILES['avatar']["error"])){
                    $avatar = uploadImage($infoMember->id, 'avatar', 'avatar_'.$infoCustomer->phone);

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

                    // in thẻ thành viên
                if(!empty($dataSend['id_group'])){
                    $dataSend['id_group'] = explode(',', $dataSend['id_group']);

                    $infoCustomer->id_group = (int) $dataSend['id_group'][0];

                    $infoGroup = $modelCategories->find()->where(['id'=>(int) $dataSend['id_group'][0], 'type' => 'group_customer', 'parent'=>$infoMember->id])->first();

                    if(!empty($infoGroup->description)){
                        $ezpics_config = json_decode($infoGroup->description, true);

                        if(!empty($ezpics_config['id_ezpics'])){
                            $img_card_member = "https://designer.ezpics.vn/create-image-series/?id=".$ezpics_config['id_ezpics']."&".$ezpics_config['ezpics_full_name']."=".$infoCustomer->full_name."&".$ezpics_config['ezpics_phone']."=".$infoCustomer->phone."&".$ezpics_config['ezpics_code']."=KH".$infoCustomer->phone."&".$ezpics_config['ezpics_avatar']."=".$infoCustomer->avatar."&".$ezpics_config['ezpics_name_member']."=".$infoMember->name;

                                //$image_data = file_get_contents($img_card_member);
                                //file_put_contents(__DIR__."/../../../../upload/admin/images/".$infoMember->id."/card_member_".$infoCustomer->phone.".png", $image_data);

                                //$infoCustomer->img_card_member = $urlHomes."upload/admin/images/".$infoMember->id."/card_member_".$infoCustomer->phone.".png";
                            $infoCustomer->img_card_member = $img_card_member;
                        }
                    }

                }elseif(empty($infoCustomer->id_group)){
                    $infoCustomer->id_group  = 0;
                }

                $infoCustomer->avatar = $dataSend['avatar'];
                $infoCustomer->id_parent = $infoMember->id;

                $modelCustomers->save($infoCustomer);

                    // lưu bảng đại lý
                saveCustomerMember($infoCustomer->id, $infoMember->id);

                if(!empty($dataSend['clear_group'])){
                    $modelCategoryConnects->deleteAll(['id_parent'=>$infoCustomer->id, 'keyword'=>'group_customers']);
                }

                    // lưu bảng nhóm khách hàng
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

                    // bắn thông báo có dữ liệu khách hàng mới
                if(!empty($infoMember->noti_new_customer) && empty($dataSend['token'])){
                    $dataSendNotification= array('title'=>'Khách hàng mới','time'=>date('H:i d/m/Y'),'content'=>$infoCustomer->full_name.' đã trở thành khách hàng mới của bạn','action'=>'addCustomer');
                    $token_device = [];

                    $listTokenDevice =  $modelTokenDevices->find()->where(['id_member'=>$infoMember->id])->all()->toList();

                    if(!empty($listTokenDevice)){
                        foreach ($listTokenDevice as $tokenDevice) {
                            if(!empty($tokenDevice->token_device)){
                                $token_device[] = $tokenDevice->token_device;
                            }
                        }

                        if(!empty($token_device)){
                            $return = sendNotification($dataSendNotification, $token_device);
                        }
                    }
                }

                    // lưu bảng chiến dịch
                if(!empty($dataSend['id_campaign']) && function_exists('getInfoCampaign')){
                    $modelCampaignCustomers = $controller->loadModel('CampaignCustomers');

                    $infoCampaign = getInfoCampaign($dataSend['id_campaign'], $infoMember->id);

                    if(!empty($infoCampaign)){
                        $checkCampaign = $modelCampaignCustomers->find()->where(['id_member'=>$infoMember->id, 'id_customer'=>(int) $infoCustomer->id, 'id_campaign'=>(int) $dataSend['id_campaign']])->first();

                        if(empty($checkCampaign)){
                            $checkCampaign = $modelCampaignCustomers->newEmptyEntity();

                            $checkCampaign->id_member = $infoMember->id;
                            $checkCampaign->id_customer = $infoCustomer->id;
                            $checkCampaign->id_campaign = (int) $dataSend['id_campaign'];
                            $checkCampaign->create_at = time();
                        }

                        $checkCampaign->id_location = (int) @$dataSend['id_location'];
                        $checkCampaign->id_team = (int) @$dataSend['id_team'];
                        $checkCampaign->id_ticket = (int) @$dataSend['id_ticket'];
                        $checkCampaign->note = @$dataSend['note_campaign'];

                        if(!empty($dataSend['checkin'])){
                            $checkCampaign->time_checkin = time();
                        }else{
                            $checkCampaign->time_checkin = 0;
                        }

                        $modelCampaignCustomers->save($checkCampaign);

                            // bắn thông báo khách đăng ký hoặc checkin chiến dịch
                        if( empty($dataSend['token']) && (
                            (!empty($infoMember->noti_reg_campaign) && empty($dataSend['checkin'])) ||
                            (!empty($infoMember->noti_checkin_campaign) && !empty($dataSend['checkin']))
                        )
                    ){
                            $actionCampaign = 'đăng ký tham gia';
                            if(!empty($dataSend['checkin'])){
                                $actionCampaign = 'checkin';
                            }

                            $dataSendNotification= array('title'=>'Khách '.$actionCampaign.' chiến dịch','time'=>date('H:i d/m/Y'),'content'=>$infoCustomer->full_name.' đã '.$actionCampaign.' chiến dịch '.$infoCampaign->name,'action'=>'addCustomerCampaign', 'id_campaign'=>$infoCampaign->id);
                            $token_device = [];

                            $listTokenDevice =  $modelTokenDevices->find()->where(['id_member'=>$infoMember->id])->all()->toList();

                            if(!empty($listTokenDevice)){
                                foreach ($listTokenDevice as $tokenDevice) {
                                    if(!empty($tokenDevice->token_device)){
                                        $token_device[] = $tokenDevice->token_device;
                                    }
                                }

                                if(!empty($token_device)){
                                    $return = sendNotification($dataSendNotification, $token_device);
                                }
                            }
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

                $return = array('code'=>0, 'mess'=>'Lưu dữ liệu thành công', 'id_customer_crm'=>$infoCustomer->id, "img_card_member"=>$infoCustomer->img_card_member);
                $return['set_attributes']['id_customer_crm']= $infoCustomer->id;
                $return['set_attributes']['img_card_member']= $infoCustomer->img_card_member;
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


function saveInfoCustomerAjax($input){
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;
    global $urlHomes;
    global $modelCategoryConnects;

    if(!empty($session->read('infoUser'))){
        $metaTitleMantan = 'Thông tin khách hàng';

        $modelCustomers = $controller->loadModel('Customers');
        $modelCustomerHistories = $controller->loadModel('CustomerHistories');
        $modelTokenDevices = $controller->loadModel('TokenDevices');


        $data = $modelCustomers->newEmptyEntity();

        $note_now = 'Đại lý '.$session->read('infoUser')->name.' tạo mới thông tin khách hàng';
        $action_now = 'create';
        

        $mess= array();
        
        if($isRequestPost){
            $dataSend = $input['request']->getData();

            $id_group = explode(",", $dataSend['id_group']);

            if(!empty($dataSend['full_name'])){
                if(!empty($dataSend['phone'])){
                    $dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone']));
                    $dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

                    $checkPhone = $modelCustomers->find()->where(['phone'=>$dataSend['phone']])->first();

                    if(!empty($checkPhone)){
                        return array('code'=> 0 , 'mess'=> '<p class="text-danger">Số điện thoại này đã được sử dụng rồi</p>');
                        
                    }else{
                        $data->phone = $dataSend['phone'];
                        $data->status = 'active';
                        $data->id_messenger = '';
                        $data->id_zalo = '';
                        $data->pass = md5($data->phone);
                        $data->id_parent = $session->read('infoUser')->id;
                        $data->created_at = time();
                    }
                }else{
                    return array('code'=> 0 , 'mess'=> '<p class="text-danger">Nhập thiếu dữ liệu số điện thoại</p>');
                }
                

                if(empty($mess)){
                    $data->full_name = $dataSend['full_name'];

                    if(!empty($dataSend['email'])){
                        $data->email = $dataSend['email'];
                    }elseif(empty($data->email)){
                        $data->email = '';
                    }

                    if(!empty($dataSend['address'])){
                        $data->address = $dataSend['address'];
                    }elseif(empty($data->address)){
                        $data->address = '';
                    }
                    
                    if(isset($dataSend['sex']) && $dataSend['sex'] != ''){
                        $data->sex = (int) $dataSend['sex'];
                    }elseif(empty($data->sex)){
                        $data->sex = 0;
                    }

                    if(!empty($dataSend['id_city'])){
                        $data->id_city = (int) @$dataSend['id_city'];
                    }elseif(empty($data->id_city)){
                        $data->id_city = 0;
                    }

                    if(!empty($dataSend['avatar'])){
                        $data->avatar = $dataSend['avatar'];
                    }elseif(empty($data->avatar)){
                        $data->avatar = $urlHomes."/plugins/hethongdaily/view/home/assets/img/avatar-default-crm.png";
                    }

                    if(!empty($dataSend['birthday_date'])){
                        $data->birthday_date = (int) $dataSend['birthday_date'];
                    }elseif(empty($data->birthday_date)){
                        $data->birthday_date = 0;
                    }

                    if(!empty($dataSend['birthday_month'])){
                        $data->birthday_month = (int) $dataSend['birthday_month'];
                    }elseif(empty($data->birthday_month)){
                        $data->birthday_month = 0;
                    }
                    
                    if(!empty($dataSend['birthday_year'])){
                        $data->birthday_year = (int) $dataSend['birthday_year'];
                    }elseif(empty($data->birthday_year)){
                        $data->birthday_year = 0;
                    }

                    if(!empty($dataSend['birthday_year'])){
                        $data->birthday_year = (int) $dataSend['birthday_year'];
                    }elseif(empty($data->birthday_year)){
                        $data->birthday_year = 0;
                    }

                    if(!empty($id_group[0])){
                        $data->id_group = (int) $id_group[0];
                    }elseif(empty($data->id_group)){
                        $data->id_group = 0;
                    }

                    if(!empty($dataSend['facebook'])){
                        $data->facebook = @$dataSend['facebook'];
                    }elseif(empty($data->facebook)){
                        $data->facebook = '';
                    }

                    $modelCustomers->save($data);

                    // bắn thông báo có dữ liệu khách hàng mới
                    if(empty($_GET['id'])){
                        if(!empty($session->read('infoUser')->noti_new_customer)){
                            $dataSendNotification= array('title'=>'Khách hàng mới','time'=>date('H:i d/m/Y'),'content'=>$data->full_name.' đã trở thành khách hàng mới của bạn','action'=>'addCustomer');
                            $token_device = [];

                            $listTokenDevice =  $modelTokenDevices->find()->where(['id_member'=>$session->read('infoUser')->id])->all()->toList();

                            if(!empty($listTokenDevice)){
                                foreach ($listTokenDevice as $tokenDevice) {
                                    if(!empty($tokenDevice->token_device)){
                                        $token_device[] = $tokenDevice->token_device;
                                    }
                                }

                                if(!empty($token_device)){
                                    $return = sendNotification($dataSendNotification, $token_device);
                                }
                            }
                        }
                    }

                    // lưu bảng đại lý
                    saveCustomerMember($data->id, $session->read('infoUser')->id);

                    // tạo dữ liệu bảng chuyên mục
                    $modelCategoryConnects->deleteAll(['id_parent'=>$data->id, 'keyword'=>'group_customers']);

                    if(!empty($id_group)){
                        foreach ($id_group as $id_group) {
                            $categoryConnects = $modelCategoryConnects->newEmptyEntity();

                            $categoryConnects->keyword = 'group_customers';
                            $categoryConnects->id_parent = $data->id;
                            $categoryConnects->id_category = (int) $id_group;

                            $modelCategoryConnects->save($categoryConnects);
                        }
                    }


                    // lưu lịch sử khách hàng
                    $customer_histories = $modelCustomerHistories->newEmptyEntity();

                    $customer_histories->id_customer = $data->id;
                    
                    $customer_histories->time_now = time();
                    $customer_histories->note_now = $note_now;
                    $customer_histories->action_now = $action_now;
                    $customer_histories->id_staff_now = $session->read('infoUser')->id;
                    $customer_histories->status = 'done';

                    $modelCustomerHistories->save($customer_histories);

                    return array('code'=> 1 , 'mess'=> '<p class="text-success">Lưu dữ liệu thành công</p>','idCus'=>$data->id,'cus_name'=>$data->full_name );
                }
            }else{
                return array('code'=> 0 , 'mess'=> '<p class="text-danger">Bạn không được để trống các trường bắt buộc</p>');
            }
        }

    }else{
        return array('code'=> 0 , 'mess'=> '<p class="text-danger">Bạn chưa đăng nhập</p>');
    }
}

// API đăng ký
function saveRegisterCustomerAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $session;

    $modelCustomer = $controller->loadModel('Customers');
    $modelMember = $controller->loadModel('Members');

    $return = array('code'=>0);
    if($isRequestPost){
        $dataSend = $input['request']->getData();

        if( !empty($dataSend['full_name']) && 
            !empty($dataSend['email']) &&
            !empty($dataSend['pass']) &&
            !empty($dataSend['passAgain']) &&
            !empty($dataSend['phone']) &&
            !empty($dataSend['address']) &&
            !empty($dataSend['birthday'])
        ){

            if(!empty($dataSend['phone_agency'])){
                $agency = $modelMember->find()->where(array('phone'=>$dataSend['phone_agency']))->first();
                if(!empty($agency)){
                    $id_parent = $agency->id;
                }else{
                    $id_parent = $modelMember->find()->where(array('id_father'=>0))->first()->id;
                }
            }else{
                $id_parent = $modelMember->find()->where(array('id_father'=>0))->first()->id;
            }

            if(isset($_FILES['avatar']) && empty($_FILES['avatar']["error"])){
                $avatars = uploadImage($id_parent, 'avatar', 'avatar_'.$id_parent);
            }
            if(!empty($avatars['linkOnline'])){
                $avatar = $avatars['linkOnline'];
            }else{
                $avatar = '';
            }

            if($dataSend['pass'] == $dataSend['passAgain']){
                $data = $modelCustomer->newEmptyEntity();

                $dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', @$dataSend['phone']));
                $dataSend['phone'] = str_replace('+84','0',@$dataSend['phone']);

                $conditions = array();
                $conditions['phone'] = $dataSend['phone'];
                $checkCustomer = $modelCustomer->find()->where($conditions)->first();


                if(empty($checkCustomer)){
                        // tạo dữ liệu save
                    $data->full_name = $dataSend['full_name'];
                    $data->phone = $dataSend['phone'];
                    $data->email = $dataSend['email'];
                    $data->address = (!empty($dataSend['address']))?$dataSend['address']:'';
                    $data->sex = (int) @$dataSend['sex'];
                    $data->id_city = 0;
                    $data->id_messenger = 0;
                    $data->avatar = $avatar;
                    $data->status = 'active';
                    $data->id_parent = (int) @$id_parent;
                    $data->id_level = (int) @$dataSend['id_level'];
                    $data->status = 'active';
                    $data->pass = md5($dataSend['pass']);
                    $data->token = createToken();
                    $data->token_device = @$dataSend['token_device'];
                    $data->created_at = time();

                    if(empty($dataSend['birthday'])) $dataSend['birthday']='0/0/0';
                    $birthday_date = 0;
                    $birthday_month = 0;
                    $birthday_year = 0;

                    $birthday = explode('/', trim($dataSend['birthday']));
                    if(count($birthday)==3){
                        $birthday_date = (int) $birthday[0];
                        $birthday_month = (int) $birthday[1];
                        $birthday_year = (int) $birthday[2];
                    }

                    $data->birthday_date = (int) @$birthday_date;
                    $data->birthday_month = (int) @$birthday_month;
                    $data->birthday_year = (int) @$birthday_year;

                    $modelCustomer->save($data);

                    $conditions = array('phone'=>$dataSend['phone'], 'pass'=>md5($dataSend['pass']));
                    $info_customer = $modelCustomer->find()->where($conditions)->first();

                    if($info_customer){
                        $return = array('code'=>1,
                            'infoUser'=> $info_customer,
                            'messages'=>'Đăng ký thành công',
                        );
                    }else{  
                        $return = array('code'=>2,
                            'infoUser'=> $info_customer,
                            'messages'=>'Đăng ký thất bại do lỗi hệ thống',
                        );
                    }
                }else{
                    $return = array('code'=>3,
                        'infoUser'=> null,
                        'messages'=>'Số điện thoại này đã được đăng ký',
                    );
                }
            }else{
                $return = array('code'=>4,
                    'infoUser'=> null,
                    'messages'=>'Mật khẩu nhập lại chưa đúng',
                );
            }
        }else{
            $return = array('code'=>5,
                'infoUser'=> null,
                'messages'=>'Bạn gửi thiếu thông tin',
            );
        }
    }else{
         $return = array('code'=>0,
                        'infoUser'=> null,
                        'messages'=>'gửi sai kiểu POST',
                    );
    }
    

    return $return;
}

// API đăng nhập
function checkLoginCustomerAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $session;

    $modelCustomer = $controller->loadModel('Customers');

    $return = array('code'=>0);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['phone']) && !empty($dataSend['pass'])){
            $conditions = array('phone'=>$dataSend['phone'], 'pass'=>md5($dataSend['pass']),'status'=>'active');
            $info_customer = $modelCustomer->find()->where($conditions)->first();



            if(!empty($info_customer)){
                $info_customer->token = createToken();
                if(!empty($dataSend['token_device']) && $info_customer->token_device != $dataSend['token_device']){
                    // gửi thông báo đăng xuất
                    $dataSendNotification= array('title'=>'Đăng xuất','time'=>date('H:i d/m/Y'),'content'=>'Tài khoản của bạn đã được đăng nhập trên một thiết bị khác','action'=>'login');

                    sendNotification($dataSendNotification, $info_customer->token_device);
                }
                $info_customer->token_device = @$dataSend['token_device'];
                $modelCustomer->save($info_customer);

                $return = array('code'=>1,
                    'infoUser'=> $info_customer,
                    'messages'=>'Bạn đăng nhập thành công',
                );
            }

        }else{
            $return = array('code'=>2,
                'messages'=>'Tài khoản không tồn tại hoặc sai mật khẩu',
            );

        }
    }else{
        $return = array('code'=>0,
                        'infoUser'=> null,
                        'messages'=>'gửi sai kiểu POST',
                    );
    }

    

    return $return;
}

// lấy mật khẩu 
function forgotPasswordCustomerApi($input)
{
    global $controller;
    global $isRequestPost;
    $return = array('code'=>0);
    $modelCustomer = $controller->loadModel('Customers');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (isset($dataSend['phone'])) {
            $dataSend['phone'] = str_replace([' ', '.', '-'], '', $dataSend['phone']);
            $dataSend['phone'] = str_replace('+84', '0', $dataSend['phone']);
            $user = $modelCustomer->find()->where([
                'phone' => $dataSend['phone'],
            ])->first();

            if (!$user) {
                return  array('code'=>3,
                    'messages'=>'Số điện thoại chưa được đăng kí cho bất kì tài khoản nào',
                );
            }

            if ($user->status != 'active') {
                return array('code'=>4,
                    'messages'=>'Tài khoản đang bị khóa',
                ); 
            }

            if (!$user->email) {
                return  array('code'=>5,
                    'messages'=>'Tài khoản chưa có thông tin email',
                );
            }

            $code = rand(100000, 999999);
            $user->reset_password_code = $code;
            $modelCustomer->save($user);
            sendEmailCodeForgotPassword($user->email, $user->name, $code);

            $return = array('code'=>1,
                'messages'=>'Gửi email mã xác thực thành công',
            );
        }else{
            $return = array('code'=>2,
                'messages'=>'Chưa nhập số điện thoại',
            );
        }

    }else{
        $return = array('code'=>0,
                        'infoUser'=> null,
                        'messages'=>'gửi sai kiểu POST',
                    );
    }

    return $return;
}

function resetPasswordCustomerApi($input)
{
    global $controller;
    global $isRequestPost;

    $modelCustomer = $controller->loadModel('Customers');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (isset($dataSend['phone_number'])
            && isset($dataSend['code'])
            && isset($dataSend['new_password'])
            && isset($dataSend['password_confirmation'])
        ) {
            $dataSend['phone_number'] = str_replace([' ', '.', '-'], '', $dataSend['phone_number']);
        $dataSend['phone_number'] = str_replace('+84', '0', $dataSend['phone_number']);
        $user = $modelCustomer->find()->where([
            'phone_number' => $dataSend['phone_number'],
        ])->first();

        if (!$user) {
            return  array('code'=>3,
                'messages'=>'Số điện thoại chưa được đăng kí cho bất kì tài khoản nào',
            );
        }

        if ($user->status != 'active') {
            return array('code'=>4,
                'messages'=>'Tài khoản đang bị khóa',
            ); 
        }

        if ($user->reset_password_code !== $dataSend['code']) {
            return array('code'=>5,
                'messages'=>'Mã cấp lại mật khẩu không chính xác',);
        }

        if ($dataSend['new_password'] !== $dataSend['password_confirmation']) {
            return array('code'=>6,
                'messages'=>'Mật khẩu nhập lại không chính xác',
            );
        }

        $user->password = md5($dataSend['new_password']);
        $user->reset_password_code = null;
        $user->access_token = createToken();
        $user->device_token = @$dataSend['device_token'];
        $modelCustomer->save($user);

        return array('code'=>1,
                'messages'=>'Đổi mật khẩu thành công',
            );
    }

        return array('code'=> 2,'messages'=> 'Gửi thiếu dữ liệu');
    }else{
        return array('code'=> 0,'messages'=> 'gửi sai kiểu POST');
    }

}

function logoutCustomerApi($input): array
{
    global $controller;
    global $isRequestPost;
    
    $modelCustomer = $controller->loadModel('Customers');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (isset($dataSend['token'])) {
            $user =  $modelCustomer->find()->where(['token' => $dataSend['token']])->first();

            if (!empty($user)) {
                $user->token = null;
                $user->device_token = null;
                $modelCustomer->save($user);

                return array('code'=>1,'messages'=>'Đăng xuất thành công');
            }

            return array('code'=>3,'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2,'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
}

?>