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
                            $conditions['time_checkin >'] = 0;
                        }

                        $listData = $modelCampaignCustomers->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
                        
                        if(!empty($listData)){
                            foreach ($listData as $key => $value) {
                                // thông tin khách hàng
                                $checkCustomer = $modelCustomers->find()->where(['id'=>$value->id_customer])->first();

                                $listData[$key]->customer_name = @$checkCustomer->full_name;
                                $listData[$key]->customer_phone = @$checkCustomer->phone;

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