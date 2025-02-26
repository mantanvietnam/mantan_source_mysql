<?php
function listCustomerCampaign($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $user = checklogin('listCampaign');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/statisticAgency');
        }
        $metaTitleMantan = 'Danh sách khách đăng ký chiến dịch sự kiện';

        $modelCampaigns = $controller->loadModel('Campaigns');
        $modelCampaignCustomers = $controller->loadModel('CampaignCustomers');
        $modelCustomers = $controller->loadModel('Customers');
        $modelStaff = $controller->loadModel('Staffs');
        $modelMember = $controller->loadModel('Members');
        $modelCustomerHistories = $controller->loadModel('CustomerHistories');

        if(!empty($_GET['id'])){
            $infoCampaign = $modelCampaigns->find()->where(['id'=>(int) $_GET['id'], 'id_member'=>$user->id])->first();

            if(!empty($infoCampaign)){
                $infoCampaign->location = json_decode($infoCampaign->location, true);
                $infoCampaign->team = json_decode($infoCampaign->team, true);
                $infoCampaign->ticket = json_decode($infoCampaign->ticket, true);

                $conditions = array('id_member'=>$user->id, 'id_campaign'=>(int) $_GET['id']);
                $limit = 20;
                $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
                if($page<1) $page = 1;
                $order = array('id'=>'desc');

                if(!empty($_GET['id_customer'])){
                    $conditions['id_customer'] = (int) $_GET['id_customer'];
                }

                if(!empty($_GET['phone_customer'])){
                    $checkCustomer = $modelCustomers->find()->where(['phone'=>$_GET['phone_customer']])->first();

                    $conditions['id_customer'] = (int) @$checkCustomer->id;
                }

                if(!empty($_GET['id_location'])){
                    $conditions['id_location'] = (int) $_GET['id_location'];
                }

                if(!empty($_GET['id_team'])){
                    $conditions['id_team'] = (int) $_GET['id_team'];
                }

                if(!empty($_GET['id_ticket'])){
                    $conditions['id_ticket'] = (int) $_GET['id_ticket'];
                }

                if(!empty($_GET['status'])){
                    $conditions['status IN'] = $_GET['status'];
                }

                if(isset($_GET['id_staff'])){
                    $conditions['id_staff'] = $_GET['id_staff'];
                }


                if(!empty($_GET['checkin'])){
                    if($_GET['checkin']==1){
                        $conditions['time_checkin >'] = 0;
                    }elseif($_GET['checkin']==2){
                        $conditions['time_checkin'] = 0;
                    }
                    
                }

                if(!empty($_GET['action']) && $_GET['action']=='Excel'){
                    $listData = $modelCampaignCustomers->find()->where($conditions)->order($order)->all()->toList();
                    
                    $titleExcel =   [
                        ['name'=>'ID', 'type'=>'text', 'width'=>5],
                        ['name'=>'Ngày đăng ký', 'type'=>'text', 'width'=>15],
                        ['name'=>'Họ và tên', 'type'=>'text', 'width'=>25],
                        ['name'=>'Số điện thoại', 'type'=>'text', 'width'=>25],
                        ['name'=>'Địa chỉ', 'type'=>'text', 'width'=>25],
                        ['name'=>'Email', 'type'=>'text', 'width'=>25],
                        ['name'=>'Khu vực', 'type'=>'text', 'width'=>25],
                        ['name'=>'Đội nhóm', 'type'=>'text', 'width'=>25],
                        ['name'=>'Hạng vé', 'type'=>'text', 'width'=>25], 
                    ];

                    $dataExcel = [];
                    if(!empty($listData)){
                        foreach ($listData as $key => $value) {
                            // thông tin khách hàng
                            $checkCustomer = $modelCustomers->find()->where(['id'=>$value->id_customer])->first();

                            $dataExcel[] = [
                                                $checkCustomer->id,   
                                                date('d/m/Y', $value->create_at),
                                                $checkCustomer->full_name,   
                                                $checkCustomer->phone,   
                                                $checkCustomer->address,   
                                                $checkCustomer->email,   
                                                @$infoCampaign->location[$value->id_location],
                                                @$infoCampaign->team[$value->id_team]['name'],
                                                @$infoCampaign->ticket[$value->id_ticket]['name']
                                            ];
                        }
                    }
                    
                    export_excel($titleExcel,$dataExcel,createSlugMantan($infoCampaign->name));die;
                }

                $listData = $modelCampaignCustomers->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
                
                if(!empty($listData)){
                    foreach ($listData as $key => $value) {
                        // thông tin khách hàng
                        $checkCustomer = $modelCustomers->find()->where(['id'=>$value->id_customer])->first();

                        $listData[$key]->customer_name = @$checkCustomer->full_name;
                        $listData[$key]->customer_phone = @$checkCustomer->phone;
                        $listData[$key]->customer_avatar = @$checkCustomer->avatar;

                        // lịch sử chăm sóc
                        $history = $modelCustomerHistories->find()->where(['id_customer'=>@$value->id_customer,'id_campaign'=>@$value->id_campaign])->order(['id'=>'desc'])->first();
                        if(!empty($history)){
                            if(!empty($history->id_staff)){
                                $history->staff = $modelStaff->find()->where(['id'=>$history->id_staff])->first();
                            }else{
                                $history->staff = $modelMember->find()->where(['id'=>$history->id_staff_now])->first();
                            }
                            $listData[$key]->history = $history;
                        }
                    }
                }

                // phân trang
                $totalData = $modelCampaignCustomers->find()->where($conditions)->all()->toList();
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

                $conditions = array('id_member'=>$user->id);
                $listStaff = $modelStaff->find()->where($conditions)->all()->toList();

                setVariable('page', $page);
                setVariable('totalPage', $totalPage);
                setVariable('back', $back);
                setVariable('next', $next);
                setVariable('urlPage', $urlPage);
                setVariable('totalData', $totalData);
                setVariable('listStaff', $listStaff);
                
                setVariable('listData', $listData);
                setVariable('infoCampaign', $infoCampaign);
            }else{
                return $controller->redirect('/listCampaign');
            }
        }else{
            return $controller->redirect('/listCampaign');
        }
    }else{
        return $controller->redirect('/login');
    }
}

function addCustomerCampaign($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;
    global $urlHomes;

     $user = checklogin('addCustomerCampaign');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/listCustomerCampaign');
        }
        $metaTitleMantan = 'Khách đăng ký chiến dịch sự kiện';

        $modelCampaigns = $controller->loadModel('Campaigns');
        $modelCampaignCustomers = $controller->loadModel('CampaignCustomers');
        $modelCustomers = $controller->loadModel('Customers');
        $modelTokenDevices = $controller->loadModel('TokenDevices');

        $mess= '';

        if(!empty($_GET['id_campaign'])){
            $checkCampaign = $modelCampaigns->find()->where(['id'=>(int) $_GET['id_campaign'], 'id_member'=>$user->id])->first();
        }

        if(!empty($checkCampaign)){
            $checkCampaign->location = json_decode($checkCampaign->location, true);
            $checkCampaign->team = json_decode($checkCampaign->team, true);
            $checkCampaign->ticket = json_decode($checkCampaign->ticket, true);

            // lấy data edit
            if(!empty($_GET['id'])){
                $data = $modelCampaignCustomers->get( (int) $_GET['id']);

                $customer = $modelCustomers->find()->where(['id'=>(int) @$data->id_customer])->first();

                $data->full_name = @$customer->full_name;
                $data->phone = @$customer->phone;
            }else{
                $data = $modelCampaignCustomers->newEmptyEntity();

                $data->create_at = time();
            }

            if ($isRequestPost) {
                $dataSend = $input['request']->getData();

                if(!empty($dataSend['full_name']) && !empty($dataSend['phone'])){
                    $dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone']));
                    $dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

                    $customer = $modelCustomers->find()->where(['phone'=>$dataSend['phone']])->first();

                    if(empty($customer)){
                        $customer = createCustomerNew($dataSend['full_name'], $dataSend['phone'], '', '', 0, 0, $user->id);
                    }

                    // tạo dữ liệu save
                    if(!empty($customer->id)){
                        $checkCampaignCustomer = $modelCampaignCustomers->find()->where(['id_campaign'=>(int) $checkCampaign->id, 'id_member'=>$user->id, 'id_customer'=>$customer->id])->first();

                        if(empty($checkCampaignCustomer)){
                            $data->id_member = $user->id;
                            $data->id_customer = $customer->id;
                            $data->id_campaign = $checkCampaign->id;
                            $data->id_location = (int) $dataSend['id_location'];
                            $data->id_team = (int) $dataSend['id_team'];
                            $data->id_ticket = (int) $dataSend['id_ticket'];
                            $data->note = $dataSend['note'];

                            if(!empty($dataSend['checkin'])){
                                $data->time_checkin = time();
                            }else{
                                $data->time_checkin = 0;
                            }
                            
                            $modelCampaignCustomers->save($data);

                            // bắn thông báo khách đăng ký hoặc checkin chiến dịch
                            if( 
                                (!empty($user->noti_reg_campaign) && empty($dataSend['checkin'])) ||
                                (!empty($user->noti_checkin_campaign) && !empty($dataSend['checkin']))
                            
                            ){
                                $actionCampaign = 'đăng ký tham gia';
                                if(!empty($dataSend['checkin'])){
                                    $actionCampaign = 'checkin';
                                }

                                $dataSendNotification= array('title'=>'Khách '.$actionCampaign.' chiến dịch','time'=>date('H:i d/m/Y'),'content'=>$customer->full_name.' đã '.$actionCampaign.' chiến dịch '.$checkCampaign->name,'action'=>'addCustomerCampaign', 'id_campaign'=>$checkCampaign->id);
                                $token_device = [];

                                $listTokenDevice =  $modelTokenDevices->find()->where(['id_member'=>$user->id])->all()->toList();

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
                        }else{
                            $checkCampaignCustomer->id_location = (int) $dataSend['id_location'];
                            $checkCampaignCustomer->id_team = (int) $dataSend['id_team'];
                            $checkCampaignCustomer->id_ticket = (int) $dataSend['id_ticket'];
                            $checkCampaignCustomer->note = $dataSend['note'];

                            if(!empty($dataSend['checkin'])){
                                $checkCampaignCustomer->time_checkin = time();
                            }else{
                                $checkCampaignCustomer->time_checkin = 0;
                            }
                            
                            $modelCampaignCustomers->save($checkCampaignCustomer);
                        }

                        if(!empty($_GET['id'])){
                            $note = $user->type_tv.' '. $user->name.' sửa thông tin khách hàng '.$customer->full_name.' tham gia chiến dịch sự kiện '.$checkCampaign->name.' có id là:'.$data->id;
                        }else{
                            $note = $user->type_tv.' '. $user->name.' thêm thông tin khách hàng '.$customer->full_name.' tham gia chiến dịch sự kiện '.$checkCampaign->name.' có id là:'.$data->id;
                        }

                        addActivityHistory($user,$note,'addCustomerCampaign',$data->id);

                        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
                    }else{
                        $mess= '<p class="text-danger">Lỗi tạo dữ liệu khách hàng</p>';
                    }
                }else{
                    $mess= '<p class="text-danger">Gửi thiếu dữ liệu</p>';
                }
            }

            setVariable('data', $data);
            setVariable('mess', $mess);
            setVariable('infoCampaign', $checkCampaign);
        }else{
            return $controller->redirect('/listCampaign');
        }
    }else{
        return $controller->redirect('/login');
    }
}

function deleteCustomerCampaign($input)
{
    global $controller;
    global $session;

    $modelCampaigns = $controller->loadModel('Campaigns');
    $modelCampaignCustomers = $controller->loadModel('CampaignCustomers');
    $user = checklogin('deleteCustomerCampaign');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/listCustomerCampaign');
        }

        if(!empty($_GET['id'])){
            $data = $modelCampaignCustomers->find()->where(['id'=>(int) $_GET['id'], 'id_member'=>$user->id])->first();

            
            if(!empty($data)){
                $checkCampaign = $modelCampaigns->find()->where(['id'=>(int) $data->id_campaign])->first();
                $customer = $modelCustomers->find()->where(['id'=>$data->id_customer])->first();
                 $note = $user->type_tv.' '. $user->name.' xóa tthông tin khách hàng '.$customer->full_name.' tham gia chiến dịch sự kiện '.$checkCampaign->name.' có id là:'.$data->id;
                addActivityHistory($user,$note,'deleteAffiliaterAgency',$data->id);
                $modelCampaignCustomers->delete($data);
            }
        }

        return $controller->redirect('/listCampaign');
    }else{
        return $controller->redirect('/login');
    }
}

function checkinCampaign($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;
    global $urlHomes;

    $user = checklogin('checkinCampaign');   
    if(!empty($user)){
        if(empty($user->grant_permission)){
            return $controller->redirect('/listCustomerCampaign');
        }
        $metaTitleMantan = 'Khách đăng ký chiến dịch sự kiện';

        $modelCampaigns = $controller->loadModel('Campaigns');
        $modelCampaignCustomers = $controller->loadModel('CampaignCustomers');
        $modelCustomers = $controller->loadModel('Customers');
        $modelTokenDevices = $controller->loadModel('TokenDevices');

        if(!empty($_GET['id'])){
            $checkData = $modelCampaignCustomers->find()->where(['id'=>(int) $_GET['id'], 'id_member'=>$user->id])->first();

            if(!empty($checkData)){
                $customer = $modelCustomers->find()->where(['id'=>$checkData->id_customer])->first();
                $checkCampaign = $modelCampaigns->find()->where(['id'=>$checkData->id_campaign])->first();

                if(!empty($_GET['checkin'])){
                    $checkData->time_checkin = time();
                }else{
                    $checkData->time_checkin = 0;
                }

                $modelCampaignCustomers->save($checkData);

                // bắn thông báo khách checkin chiến dịch
                if( !empty($user->noti_checkin_campaign)){
                    $actionCampaign = 'hủy checkin';
                    if(!empty($_GET['checkin'])){
                        $actionCampaign = 'checkin';
                    }

                    $dataSendNotification= array('title'=>'Khách '.$actionCampaign.' chiến dịch','time'=>date('H:i d/m/Y'),'content'=>$customer->full_name.' đã '.$actionCampaign.' chiến dịch '.$checkCampaign->name,'action'=>'checkinCustomerCampaign', 'id_campaign'=>$checkCampaign->id);
                    $token_device = [];

                    $listTokenDevice =  $modelTokenDevices->find()->where(['id_member'=>$user->id])->all()->toList();

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

                 $note = $user->type_tv.' '. $user->name.' đã checkin cho khách hàng '.$customer->full_name.' tham gia chiến dịch sự kiện '.$checkCampaign->name.' có id là:'.$checkData->id;
                addActivityHistory($user,$note,'deleteAffiliaterAgency',$checkData->id);

                return $controller->redirect('/listCustomerCampaign/?id='.$checkData->id_campaign);
            }
        }

        return $controller->redirect('/listCampaign');
    }else{
        return $controller->redirect('/login');
    }
}

function addCallCustomerCampaign($input){
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $user = checklogin('listCampaign');   
    if(!empty($user)){
        $modelCampaigns = $controller->loadModel('Campaigns');
        $modelCampaignCustomers = $controller->loadModel('CampaignCustomers');
        $modelCustomers = $controller->loadModel('Customers');
        $modelStaff = $controller->loadModel('Staffs');
        $modelCustomerHistories = $controller->loadModel('CustomerHistories');

        if(!empty($_GET['id'])){
            $checkCampaign = $modelCampaignCustomers->find()->where(['id'=>(int) $_GET['id'], 'id_member'=>$user->id])->first();
            if(!empty($checkCampaign)){
                $checkCampaign->number_call += 1;
                $checkCampaign->id_staff = (int)$_GET['id_staff'];
                $checkCampaign->status = $_GET['status'];  
                $data = $modelCustomerHistories->newEmptyEntity();
                $data->id_customer = (int) $checkCampaign->id_customer;
                $data->note_now = $_GET['note'];
                $data->action_now = $_GET['action_now'];
                $data->id_staff_now = $user->id;
                $data->id_staff = (int)$_GET['id_staff'];
                $data->status = $_GET['status'];
                $data->id_campaign = $checkCampaign->id_campaign;
                $data->number_call = $checkCampaign->number_call;
                $data->time_now = time();
                
                $modelCustomerHistories->save($data);
                $modelCampaignCustomers->save($checkCampaign);
            }
        }
        return $controller->redirect('/listCustomerCampaign?id='.$checkCampaign->id_campaign);
    }else{
        return $controller->redirect('/login');
    }
}


?>