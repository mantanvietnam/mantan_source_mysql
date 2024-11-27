<?php
function getListCampaignAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    $modelCampaigns = $controller->loadModel('Campaigns');
    $modelCampaignCustomers = $controller->loadModel('CampaignCustomers');

    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token'],'listCampaign');

            if(!empty($infoMember)){
                if(empty($infoMember->grant_permission)){
                    return array('code'=>4, 'mess'=>'Bạn không có quyền');
                }
                $conditions = array('id_member'=>$infoMember->id);
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

                if(!empty($listData)){
                    foreach ($listData as $key => $value) {
                        $customer_reg = $modelCampaignCustomers->find()->where(['id_campaign'=>$value->id, 'id_member'=>$infoMember->id])->all()->toList();
			            $customer_checkin = $modelCampaignCustomers->find()->where(['id_campaign'=>$value->id, 'id_member'=>$infoMember->id, 'time_checkin >'=>0])->all()->toList();

			            $listData[$key]->number_reg = count($customer_reg);
			            $listData[$key]->number_checkin = count($customer_checkin);


                    }
                }
                
                $totalData = $modelCampaigns->find()->where($conditions)->all()->toList();
                
                $return = array('code'=>0, 'listData'=>$listData, 'totalData'=>count($totalData));
            }else{
                 $return = array('code'=>3, 'mess'=>'Sai mã token');
            }
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }

    return $return;
}

function saveInfoCampaignAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;
    global $urlHomes;

    $modelCampaigns = $controller->loadModel('Campaigns');
    $modelCampaignCustomers = $controller->loadModel('CampaignCustomers');

    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token'],'addCampaign');

            if(!empty($infoMember)){
                if(empty($infoMember->grant_permission)){
                    return array('code'=>4, 'mess'=>'Bạn không có quyền');
                }
                // lấy data edit
		        if(!empty($dataSend['id'])){
		            $data = $modelCampaigns->get( (int) $dataSend['id']);
		        }else{
		            $data = $modelCampaigns->newEmptyEntity();

		            $data->create_at = time();
		            $data->location = '[]';
		            $data->team = '[]';
		            $data->ticket = '[]';
		        }

		        if(!empty($dataSend['name'])){
	                $img_background = $urlHomes.'/plugins/campaign_event/view/home/image/background.gif';
	                if(isset($_FILES['img_background']) && empty($_FILES['img_background']["error"])){
	                	if(!empty($data->id)){
	                		$file_img_background = 	'img_background_campaign_'.$data->id;
	                	}else{
	                		$file_img_background = 	'img_background_campaign_'.time();
	                	}

                        $image_upload = uploadImage($infoMember->id, 'img_background', $file_img_background);

                        if(!empty($image_upload['linkOnline'])){
                            $img_background = $image_upload['linkOnline'];
                        }
                    }

	                $img_logo = '';
	                if(isset($_FILES['img_logo']) && empty($_FILES['img_logo']["error"])){
	                	if(!empty($data->id)){
	                		$file_img_logo = 	'img_logo_campaign_'.$data->id;
	                	}else{
	                		$file_img_logo = 	'img_logo_campaign_'.time();
	                	}

                        $image_upload = uploadImage($infoMember->id, 'img_background', $file_img_logo);

                        if(!empty($image_upload['linkOnline'])){
                            $img_logo = $image_upload['linkOnline'];
                        }
                    }

                    if(empty($img_logo)){
                    	$system = $modelCategories->find()->where(['id'=>(int) $infoMember->id_system])->first();

                    	if(!empty($system->image)){
	        				$img_logo = $system->image;
	        			}else{
	        				$img_logo = $urlHomes.'/plugins/campaign_event/view/home/image/logo-phoenix.png';
	        			}
                    }

	                // tạo dữ liệu save
	                $data->name = $dataSend['name'];
	                $data->name_show = $dataSend['name_show'];
	                $data->text_welcome = $dataSend['text_welcome'];
	                $data->codeSecurity = $dataSend['codeSecurity'];
	                $data->codePersonWin = trim($dataSend['codePersonWin']);
	                $data->noteCheckin = $dataSend['noteCheckin'];
	                $data->colorText = $dataSend['colorText'];
	                $data->status = $dataSend['status'];
	                $data->img_background = $img_background;
	                $data->img_logo = $img_logo;
	                $data->id_member = $infoMember->id;
	                $data->location = $dataSend['location'];
	                $data->ticket = $dataSend['ticket'];
                    $data->team = $dataSend['team'];
                    $data->id_drive = @$dataSend['id_drive'];
                    $data->id_ai_event = @$dataSend['id_ai_event'];
	                $data->link_drive = @$dataSend['link_drive'];
	                
	                $modelCampaigns->save($data);

                    if(!empty($_GET['id'])){
                        $note = $infoMember->type_tv.' '. $infoMember->name.' sửa thông tin chiến dịch sự kiện '.$data->name.' có id là:'.$data->id;
                    }else{
                        $note = $infoMember->type_tv.' '. $infoMember->name.' thêm thông tin chiến dịch sự kiện '.$data->name.' có id là:'.$data->id;
                    }

                    addActivityHistory($infoMember,$note,'addCampaign',$data->id);

	                $return = array('code'=>0, 'mess'=>'Lưu dữ liệu thành công', 'id_campaign'=>$data->id);
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

function deleteCampaignAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    $modelCampaigns = $controller->loadModel('Campaigns');
    $modelCampaignCustomers = $controller->loadModel('CampaignCustomers');

    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token'],'deleteCampaign');

            if(!empty($infoMember)){
                if(!empty($dataSend['id'])){
		            $data = $modelCampaigns->find()->where(['id'=>(int) $dataSend['id'], 'id_member'=>$infoMember->id])->first();
		            
		            if($data){
                        $note = $infoMember->type_tv.' '. $infoMember->name.' xóa thông tin chiến dịch sự kiện '.$data->name.' có id là:'.$data->id;
                        addActivityHistory($infoMember,$note,'deleteAffiliaterAgency',$data->id);
		                $modelCampaignCustomers->deleteAll(['id_campaign'=>$data->id, 'id_member'=>$infoMember->id]);
		                $modelCampaigns->delete($data);

		                $return = array('code'=>0, 'mess'=>'Xóa dữ liệu thành công');
		            }else{
		            	$return = array('code'=>4, 'mess'=>'Không tồn tại chiến dịch muốn xóa');
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

function getDetailCampaignAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    $modelCampaigns = $controller->loadModel('Campaigns');
    $modelCampaignCustomers = $controller->loadModel('CampaignCustomers');

    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['token'])){
            $infoMember = getMemberByToken($dataSend['token'],'deleteCampaign');

            if(!empty($infoMember)){
                if(!empty($dataSend['id'])){
                    $data = $modelCampaigns->find()->where(['id'=>(int) $dataSend['id'], 'id_member'=>$infoMember->id])->first();
                    
                    if(!empty($data)){
                        $customer_reg = $modelCampaignCustomers->find()->where(['id_campaign'=>$data->id, 'id_member'=>$infoMember->id])->all()->toList();
                        $customer_checkin = $modelCampaignCustomers->find()->where(['id_campaign'=>$data->id, 'id_member'=>$infoMember->id, 'time_checkin >'=>0])->all()->toList();

                        $data->number_reg = count($customer_reg);
                        $data->number_checkin = count($customer_checkin);
                        $return = array('code'=>0, 'data'=>$data, 'mess'=>'Lấy dữ liệu thành công');
                    }else{
                        $return = array('code'=>4, 'mess'=>'Không tồn tại chiến dịch này');
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

?>