<?php
function getListCustomerCampaignAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    $modelCampaigns = $controller->loadModel('Campaigns');
    $modelCampaignCustomers = $controller->loadModel('CampaignCustomers');
    
    $modelCustomers = $controller->loadModel('Customers');
    $modelCustomerHistories = $controller->loadModel('CustomerHistories');

    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token']);

            if(!empty($infoMember)){
                if(!empty($dataSend['id'])){
                    $infoCampaign = $modelCampaigns->find()->where(['id'=>$dataSend['id'], 'id_member'=>$infoMember->id])->first();

                    if(!empty($infoCampaign)){
                        $conditions = array('id_member'=>$infoMember->id, 'id_campaign'=>$dataSend['id']);
                        $limit = (!empty($dataSend['limit']))?(int)$dataSend['limit']:20;
                        $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
                        if($page<1) $page = 1;
                        $order = array('id'=>'desc');

                        if(!empty($dataSend['id_customer'])){
                            $conditions['id_customer'] = (int) $dataSend['id_customer'];
                        }

                        if(!empty($dataSend['phone_customer'])){
                            $checkCustomer = $modelCustomers->find()->where(['phone'=>$dataSend['phone_customer']])->first();

                            $conditions['id_customer'] = (int) @$checkCustomer->id;
                        }

                        if(!empty($dataSend['id_location'])){
                            $conditions['id_location'] = (int) $dataSend['id_location'];
                        }

                        if(!empty($dataSend['id_team'])){
                            $conditions['id_team'] = (int) $dataSend['id_team'];
                        }

                        if(!empty($dataSend['id_ticket'])){
                            $conditions['id_ticket'] = (int) $dataSend['id_ticket'];
                        }

                        if(!empty($dataSend['checkin'])){
                            if($dataSend['checkin']==1){
                                $conditions['time_checkin >'] = 0;
                            }elseif($dataSend['checkin']==2){
                                $conditions['time_checkin'] = 0;
                            }
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
                                $listData[$key]->history = $modelCustomerHistories->find()->where(['id_customer'=>$value->id_customer])->order(['id'=>'desc'])->first();
                            }
                        }
                        
                        $totalData = $modelCampaignCustomers->find()->where($conditions)->all()->toList();
                        
                        $return = array('code'=>0, 'listData'=>$listData, 'totalData'=>count($totalData), 'infoCampaign'=>$infoCampaign);
                    }else{
                        $return = array('code'=>4, 'mess'=>'Không tồn tại chiến dịch cần tìm');
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

function deleteCustomerCampaignAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    $modelCampaigns = $controller->loadModel('Campaigns');
    $modelCampaignCustomers = $controller->loadModel('CampaignCustomers');
    
    $modelCustomers = $controller->loadModel('Customers');
    $modelCustomerHistories = $controller->loadModel('CustomerHistories');

    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token']);

            if(!empty($infoMember)){
                if(!empty($dataSend['id_campaign']) && !empty($dataSend['id_customer'])){
                    $infoCampaign = $modelCampaigns->find()->where(['id'=>(int) $dataSend['id_campaign'], 'id_member'=>$infoMember->id])->first();

                    if(!empty($infoCampaign)){
                        $data = $modelCampaignCustomers->find()->where(['id_campaign'=>(int) $dataSend['id_campaign'], 'id_customer'=>(int) $dataSend['id_customer'], 'id_member'=>$infoMember->id])->first();
                        
                        if($data){
                            $modelCampaignCustomers->delete($data);
                        }
                        
                        $return = array('code'=>0, 'mess'=>'Xóa dữ liệu thành công');
                    }else{
                        $return = array('code'=>4, 'mess'=>'Không tồn tại chiến dịch cần tìm');
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

function saveCustomerCampaignAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    $modelCampaigns = $controller->loadModel('Campaigns');
    $modelCampaignCustomers = $controller->loadModel('CampaignCustomers');
    
    $modelCustomers = $controller->loadModel('Customers');
    $modelCustomerHistories = $controller->loadModel('CustomerHistories');

    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token']);

            if(!empty($infoMember)){
                if(!empty($dataSend['id_campaign']) && !empty($dataSend['full_name']) && !empty($dataSend['phone'])){
                    $infoCampaign = $modelCampaigns->find()->where(['id'=>(int) $dataSend['id_campaign'], 'id_member'=>$infoMember->id])->first();

                    if(!empty($infoCampaign)){
                        $dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone']));
                        $dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

                        $customer = $modelCustomers->find()->where(['phone'=>$dataSend['phone']])->first();

                        if(empty($customer)){
                            $customer = createCustomerNew($dataSend['full_name'], $dataSend['phone'], '', '', 0, 0, $infoMember->id);
                        }

                        // tạo dữ liệu save
                        if(!empty($customer->id)){
                            $checkCampaignCustomer = $modelCampaignCustomers->find()->where(['id_campaign'=>(int) $infoCampaign->id, 'id_member'=>$infoMember->id, 'id_customer'=>$customer->id])->first();

                            if(empty($checkCampaignCustomer)){
                                $checkCampaignCustomer = $modelCampaignCustomers->newEmptyEntity();

                                $checkCampaignCustomer->create_at = time();
                                $checkCampaignCustomer->id_member = $infoMember->id;
                                $checkCampaignCustomer->id_customer = $customer->id;
                                $checkCampaignCustomer->id_campaign = $infoCampaign->id;
                                $checkCampaignCustomer->id_location = (int) @$dataSend['id_location'];
                                $checkCampaignCustomer->id_team = (int) @$dataSend['id_team'];
                                $checkCampaignCustomer->id_ticket = (int) @$dataSend['id_ticket'];
                                $checkCampaignCustomer->note = @$dataSend['note'];

                                if(!empty($dataSend['checkin'])){
                                    $checkCampaignCustomer->time_checkin = time();
                                }else{
                                    $checkCampaignCustomer->time_checkin = 0;
                                }
                                
                                $modelCampaignCustomers->save($checkCampaignCustomer);
                            }else{
                                $checkCampaignCustomer->id_location = (int) @$dataSend['id_location'];
                                $checkCampaignCustomer->id_team = (int) @$dataSend['id_team'];
                                $checkCampaignCustomer->id_ticket = (int) @$dataSend['id_ticket'];
                                $checkCampaignCustomer->note = @$dataSend['note'];

                                if(!empty($dataSend['checkin'])){
                                    $checkCampaignCustomer->time_checkin = time();
                                }else{
                                    $checkCampaignCustomer->time_checkin = 0;
                                }
                                
                                $modelCampaignCustomers->save($checkCampaignCustomer);
                            }

                            $return = array('code'=>0, 'mess'=>'Lưu dữ liệu thành công');
                        }else{
                            $return = array('code'=>5, 'mess'=>'Lỗi tạo dữ liệu khách hàng');
                        }
                    }else{
                        $return = array('code'=>4, 'mess'=>'Không tồn tại chiến dịch cần tìm');
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

function checkinCustomerCampaignAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    $modelCampaigns = $controller->loadModel('Campaigns');
    $modelCampaignCustomers = $controller->loadModel('CampaignCustomers');
    
    $modelCustomers = $controller->loadModel('Customers');
    $modelCustomerHistories = $controller->loadModel('CustomerHistories');

    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token']);

            if(!empty($infoMember)){
                if(!empty($dataSend['id_campaign']) && !empty($dataSend['id_customer'])){
                    $infoCampaign = $modelCampaigns->find()->where(['id'=>(int) $dataSend['id_campaign'], 'id_member'=>$infoMember->id])->first();

                    if(!empty($infoCampaign)){
                        $checkData = $modelCampaignCustomers->find()->where(['id_campaign'=>(int) $dataSend['id_campaign'], 'id_customer'=>(int) $dataSend['id_customer'], 'id_member'=>$infoMember->id])->first();
                        
                        if($checkData){
                            if(!empty($dataSend['checkin'])){
                                $checkData->time_checkin = time();
                            }else{
                                $checkData->time_checkin = 0;
                            }

                            $modelCampaignCustomers->save($checkData);

                            $return = array('code'=>0, 'mess'=>'Lưu trạng thái checkin thành công');
                        }else{
                            $return = array('code'=>5, 'mess'=>'Không tìm được khách đăng ký cần checkin');
                        }
                    }else{
                        $return = array('code'=>4, 'mess'=>'Không tồn tại chiến dịch cần tìm');
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


function getListCampaignCustomerAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    $modelCampaigns = $controller->loadModel('Campaigns');
    $modelCampaignCustomers = $controller->loadModel('CampaignCustomers');
    $modelMember = $controller->loadModel('Members');
    
    $modelCustomers = $controller->loadModel('Customers');
    $modelCustomerHistories = $controller->loadModel('CustomerHistories');

    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        
        $boss = $modelMember->find()->where(['id_father'=>0])->first();
        $conditions = array('id_member'=>$boss->id, 'status'=>'active');
        $limit = (!empty($dataSend['limit']))?(int)$dataSend['limit']:20;
        $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
        if($page<1) $page = 1;
        $order = array('id'=>'desc');

        if(!empty($dataSend['id'])){
            $conditions['id'] = (int) $dataSend['id'];
        }

        if(!empty($dataSend['name'])){
            $conditions['name LIKE'] = '%'.$dataSend['name'].'%';
        }
        $listData = $modelCampaigns->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

        foreach ($listData as $key => $value) {
            $customer_reg = $modelCampaignCustomers->find()->where(['id_campaign'=>$value->id, 'id_member'=>$boss->id])->all()->toList();
            $customer_checkin = $modelCampaignCustomers->find()->where(['id_campaign'=>$value->id, 'id_member'=>$boss->id, 'time_checkin >'=>0])->all()->toList();
            $yet_checkin = $modelCampaignCustomers->find()->where(['id_campaign'=>$value->id, 'id_member'=>$boss->id, 'time_checkin'=>0])->all()->toList();

            $listData[$key]->number_reg = count($customer_reg);
            $listData[$key]->number_checkin = count($customer_checkin);
            $listData[$key]->yet_checkin = count($yet_checkin);
        }

        $totalData = $modelCampaigns->find()->where($conditions)->all()->toList();
        
        $return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'listData'=>$listData, 'totalData'=>count($totalData));
        
    }else{
        $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
    }

    return $return;
}

function getCampaignCustomerAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    $modelCampaigns = $controller->loadModel('Campaigns');
    $modelCampaignCustomers = $controller->loadModel('CampaignCustomers');
    $modelMember = $controller->loadModel('Members');
    
    $modelCustomers = $controller->loadModel('Customers');
    $modelCustomerHistories = $controller->loadModel('CustomerHistories');

    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['id'])){
            $boss = $modelMember->find()->where(['id_father'=>0])->first();
            $conditions = array('id_member'=>$boss->id);
            $conditions['id'] = (int) $dataSend['id'];

            $data = $modelCampaigns->find()->where($conditions)->first();
            if(!empty($data)){

                $customer_reg = $modelCampaignCustomers->find()->where(['id_campaign'=>$data->id, 'id_member'=>$boss->id])->all()->toList();
                $customer_checkin = $modelCampaignCustomers->find()->where(['id_campaign'=>$data->id, 'id_member'=>$boss->id, 'time_checkin >'=>0])->all()->toList();
                $yet_checkin = $modelCampaignCustomers->find()->where(['id_campaign'=>$data->id, 'id_member'=>$boss->id, 'time_checkin'=>0])->all()->toList();
                $image_drive = array();
                if(!empty($data->id_drive)){
                    $datadrive = getListFileDrive($data->id_drive);
                    if(!empty($datadrive)){
                        foreach($datadrive as $key => $item){
                            $image_drive[$key]['thumbnailLink'] = $item['thumbnailLink'];
                            $image_drive[$key]['downloadUrl'] = $item['downloadUrl'];
                            $image_drive[$key]['id'] = $item['id'];
                        }
                    }
                }

                $data->image_drive = $image_drive;
                $data->number_reg = count($customer_reg);
                $data->number_checkin = count($customer_checkin);
                $data->yet_checkin = count($yet_checkin);

                $data->location= json_decode($data->location, true);
                $data->ticket= json_decode($data->ticket, true);
                $data->team= json_decode($data->team, true);
                $return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'data'=>$data);
            }
            
        }else{
         $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
     }
 }else{
    $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
}

return $return;
}

function registerCampaignCustomerAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    $modelCampaigns = $controller->loadModel('Campaigns');
    $modelCampaignCustomers = $controller->loadModel('CampaignCustomers');
    $modelMember = $controller->loadModel('Members');
    
    $modelCustomers = $controller->loadModel('Customers');

    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token']) && !empty($dataSend['id'])){
            $infoCustomer = getCustomerByToken($dataSend['token']);

            if(!empty($infoCustomer)){
                $boss = $modelMember->find()->where(['id_father'=>0])->first();
                $conditions = array('id_member'=>$boss->id);
                $conditions['id'] = (int) $dataSend['id'];

                $data = $modelCampaigns->find()->where($conditions)->first();
                if(!empty($data)){
                     // tạo dữ liệu save-
                    $checkCampaignCustomer = $modelCampaignCustomers->find()->where(['id_campaign'=>(int) $data->id, 'id_member'=>$boss->id, 'id_customer'=>$infoCustomer->id])->first();
                    if(empty($checkCampaignCustomer)){
                        $checkCampaignCustomer = $modelCampaignCustomers->newEmptyEntity();

                        $checkCampaignCustomer->create_at = time();
                        $checkCampaignCustomer->id_member = $boss->id;
                        $checkCampaignCustomer->id_customer = $infoCustomer->id;
                        $checkCampaignCustomer->id_campaign = $data->id;
                        $checkCampaignCustomer->id_location = (int) @$dataSend['id_location'];
                        $checkCampaignCustomer->id_team = (int) @$dataSend['id_team'];
                        $checkCampaignCustomer->id_ticket = (int) @$dataSend['id_ticket'];
                        $checkCampaignCustomer->note = @$dataSend['note'];

                        if(!empty($dataSend['checkin'])){
                            $checkCampaignCustomer->time_checkin = time();
                        }else{
                            $checkCampaignCustomer->time_checkin = 0;
                        }
                        
                        $modelCampaignCustomers->save($checkCampaignCustomer);
                    }else{
                        $checkCampaignCustomer->id_location = (int) @$dataSend['id_location'];
                        $checkCampaignCustomer->id_team = (int) @$dataSend['id_team'];
                        $checkCampaignCustomer->id_ticket = (int) @$dataSend['id_ticket'];
                        $checkCampaignCustomer->note = @$dataSend['note'];

                        if(!empty($dataSend['checkin'])){
                            $checkCampaignCustomer->time_checkin = time();
                        }else{
                            $checkCampaignCustomer->time_checkin = 0;
                        }
                        
                        $modelCampaignCustomers->save($checkCampaignCustomer);
                    }

                    $return = array('code'=>1, 'mess'=>'Lưu dữ liệu thành công');
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

// lấy danh sách các chiến dịch người dùng tham gia
function  listCampaignCustomerJoinAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    $modelCampaigns = $controller->loadModel('Campaigns');
    $modelCampaignCustomers = $controller->loadModel('CampaignCustomers');
    $modelMember = $controller->loadModel('Members');
    
    $modelCustomers = $controller->loadModel('Customers');

    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        
        if(!empty($dataSend['token'])){
            $infoCustomer = getCustomerByToken($dataSend['token']);

            if(!empty($infoCustomer)){
                $boss = $modelMember->find()->where(['id_father'=>0])->first();
                $data = $modelCampaignCustomers->find()->where(['id_member'=>$boss->id, 'id_customer'=>$infoCustomer->id])->all()->toList();

                $listData = array();
                
                if(!empty($data)){
                    foreach($data as $key => $item){
                        $infoCampaignJoin = $modelCampaigns->find()->where(['id'=>$item->id_campaign, 'status'=>'active'])->first();

                        if(!empty($infoCampaignJoin)){
                            $listData[$key] = $infoCampaignJoin;
                        } 
                    }
                }

                $return = array('code'=>1, 'mess'=>'lấy dữ liệu thành công', 'listData'=>$listData);
                
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

function  checkCustomerJoinCampaignAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    $modelCampaigns = $controller->loadModel('Campaigns');
    $modelCampaignCustomers = $controller->loadModel('CampaignCustomers');
    $modelMember = $controller->loadModel('Members');
    
    $modelCustomers = $controller->loadModel('Customers');

    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        
        if(!empty($dataSend['token']) && !empty($dataSend['id_campaign'])){
            $infoCustomer = getCustomerByToken($dataSend['token']);

            if(!empty($infoCustomer)){
                $boss = $modelMember->find()->where(['id_father'=>0])->first();
                $conditions = array('id_member'=>$boss->id);
                $conditions['id'] = (int) $dataSend['id_campaign'];

                $data = $modelCampaigns->find()->where($conditions)->first();
                if(!empty($data)){
                    $checkCampaignCustomer = $modelCampaignCustomers->find()->where(['id_campaign'=>(int) $data->id, 'id_member'=>$boss->id, 'id_customer'=>$infoCustomer->id])->first();

                    if(!empty($checkCampaignCustomer)){
                        $return = array('code'=>1, 'mess'=>'bạn đã tham gia sự kiện này rồi ');
                    }else{
                        $return = array('code'=>2, 'mess'=>'bạn chưa tham gia sự kiện này ');
                    }
                }else{
                    $return = array('code'=>5, 'mess'=>'Sự kiện này không tồn tại');

                }
                
            }else{
                $return = array('code'=>3, 'mess'=>'Sai mã token');
            }
        }else{
            $return = array('code'=>4, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
        $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
    }

    return $return;
}

function getCustomerCampaignAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    $modelCampaigns = $controller->loadModel('Campaigns');
    $modelCampaignCustomers = $controller->loadModel('CampaignCustomers');
    
    $modelCustomers = $controller->loadModel('Customers');
    $modelCustomerHistories = $controller->loadModel('CustomerHistories');

    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token']);

            if(!empty($infoMember)){
                if(!empty($dataSend['id_campaign']) && !empty($dataSend['id_customer'])){
                    $infoCampaign = $modelCampaigns->find()->where(['id'=>(int) $dataSend['id_campaign'], 'id_member'=>$infoMember->id])->first();

                    if(!empty($infoCampaign)){
                        $data = $modelCampaignCustomers->find()->where(['id_campaign'=>(int) $dataSend['id_campaign'], 'id_customer'=>(int) $dataSend['id_customer'], 'id_member'=>$infoMember->id])->first();
                        
                        if(!empty($data)){
                            $checkCustomer = $modelCustomers->find()->where(['id'=>$data->id_customer])->first();

                            $data->customer = @$checkCustomer;

                            // lịch sử chăm sóc
                            $data->history = $modelCustomerHistories->find()->where(['id_customer'=>$data->id_customer])->order(['id'=>'desc'])->first();
                        }
                        
                        $return = array('code'=>0, 'mess'=>'lấy dữ liệu thành công' ,'data'=>$data);
                    }else{
                        $return = array('code'=>4, 'mess'=>'Không tồn tại chiến dịch cần tìm');
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

function addCallCustomerCampaignAPI($input){
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $isRequestPost;

    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token']) && !empty($dataSend['id_campaign']) && !empty($dataSend['id_customer']) && !empty($dataSend['action_now']) && !empty($dataSend['id_staff']) && !empty($dataSend['status'])){
            $user = getMemberByToken($dataSend['token']);

            if(!empty($user)){
                $modelCampaigns = $controller->loadModel('Campaigns');
                $modelCampaignCustomers = $controller->loadModel('CampaignCustomers');
                $modelCustomers = $controller->loadModel('Customers');
                $modelStaff = $controller->loadModel('Staffs');
                $modelCustomerHistories = $controller->loadModel('CustomerHistories');

                $checkCampaign = $modelCampaignCustomers->find()->where(['id_campaign'=>(int) $dataSend['id_campaign'],'id_customer'=>(int) $dataSend['id_customer'], 'id_member'=>$user->id])->first();
                if(!empty($checkCampaign)){
                    $checkCampaign->number_call += 1;
                    $checkCampaign->id_staff = (int)$dataSend['id_staff'];
                    $checkCampaign->status = $dataSend['status'];  
                    $data = $modelCustomerHistories->newEmptyEntity();
                    $data->id_customer = (int) $checkCampaign->id_customer;
                    $data->note_now = $dataSend['note'];
                    $data->action_now = $dataSend['action_now'];
                    $data->id_staff_now = $user->id;
                    $data->id_staff = (int)$dataSend['id_staff'];
                    $data->status = $dataSend['status'];
                    $data->id_campaign = $checkCampaign->id_campaign;
                    $data->number_call = $checkCampaign->number_call;
                    $data->time_now = time();
                 
                    $modelCustomerHistories->save($data);
                    $modelCampaignCustomers->save($checkCampaign);

                    return array('code'=>1, 'mess'=>'bạn xác nhận thành công' ,'data'=>$data);
                }
                return array('code'=>4, 'mess'=>'Dữ liệu không tồn tại');
            }
            return array('code'=>3, 'mess'=>'Sai mã token');
        }
        return array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
    }
    return array('code'=>0, 'mess'=>'Dữ liệu phải là POST');
}
?>