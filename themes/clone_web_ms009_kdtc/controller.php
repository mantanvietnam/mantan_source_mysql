<?php
function setting_theme_clone_web($input){
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;
    global $urlHomes;

    $metaTitleMantan = 'Cài đặt giao diện trang chủ ';
    $mess= '';

    $conditions = array('key_word' => 'settingCloneWebMS009KDTCTheme');
    $data = $modelOptions->find()->where($conditions)->first();
    
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
        $dataSend = $input['request']->getData();

        $value = array( 'logo'=> @$dataSend['logo'],
                        'background_top'=> @$dataSend['background_top'],
                        'title_top_nho'=> @$dataSend['title_top_nho'],
                        'title_top_to'=> @$dataSend['title_top_to'],
                        'content_top'=> @$dataSend['content_top'],
                        'image_top'=> @$dataSend['image_top'],
                        'title_dv_nho'=> @$dataSend['title_dv_nho'],
                        'title_dv_to'=> @$dataSend['title_dv_to'],
                        'content_dv'=> @$dataSend['content_dv'],
                        'title_dv_1'=> @$dataSend['title_dv_1'],
                        'content_dv_1'=> @$dataSend['content_dv_1'],
                        'image_dv_1'=> @$dataSend['image_dv_1'],
                        'title_dv_2'=> @$dataSend['title_dv_2'],
                        'content_dv_2'=> @$dataSend['content_dv_2'],
                        'image_dv_2'=> @$dataSend['image_dv_2'],
                        'title_dv_3'=> @$dataSend['title_dv_3'],
                        'content_dv_3'=> @$dataSend['content_dv_3'],
                        'image_dv_3'=> @$dataSend['image_dv_3'],
                        'title_dv_4'=> @$dataSend['title_dv_4'],
                        'content_dv_4'=> @$dataSend['content_dv_4'],
                        'image_dv_4'=> @$dataSend['image_dv_4'],
                        'title_dv_5'=> @$dataSend['title_dv_5'],
                        'content_dv_5'=> @$dataSend['content_dv_5'],
                        'image_dv_5'=> @$dataSend['image_dv_5'],
                        'title_dv_6'=> @$dataSend['title_dv_6'],
                        'content_dv_6'=> @$dataSend['content_dv_6'],
                        'image_dv_6'=> @$dataSend['image_dv_6'],
                        

                        'image_gt'=> @$dataSend['image_gt'],
                        'title_gt_nho'=> @$dataSend['title_gt_nho'],
                        'title_gt_to'=> @$dataSend['title_gt_to'],
                        'content_gt_den'=> @$dataSend['content_gt_den'],
                        'content_gt_tim'=> @$dataSend['content_gt_tim'],
                        'link_gt'=> @$dataSend['link_gt'],
                        'title_ds_nho'=> @$dataSend['title_ds_nho'],
                        'title_ds_to'=> @$dataSend['title_ds_to'],
                        'content_ds'=> @$dataSend['content_ds'],
                        'image_ds'=> @$dataSend['image_ds'],
                        'title_ds_1'=> @$dataSend['title_ds_1'],
                        'content_ds_1'=> @$dataSend['content_ds_1'],
                        'title_ds_2'=> @$dataSend['title_ds_2'],
                        'content_ds_2'=> @$dataSend['content_ds_2'],
                        'title_ds_3'=> @$dataSend['title_ds_3'],
                        'content_ds_3'=> @$dataSend['content_ds_3'],
                        'title_ds_4'=> @$dataSend['title_ds_4'],
                        'content_ds_4'=> @$dataSend['content_ds_4'],
                        'title_ds_5'=> @$dataSend['title_ds_5'],
                        'content_ds_5'=> @$dataSend['content_ds_5'],
                        'title_ds_6'=> @$dataSend['title_ds_6'],
                        'content_ds_6'=> @$dataSend['content_ds_6'],
                        'title_ds_7'=> @$dataSend['title_ds_7'],
                        'content_ds_7'=> @$dataSend['content_ds_7'],
                        'title_ds_8'=> @$dataSend['title_ds_8'],
                        'content_ds_8'=> @$dataSend['content_ds_8'],
                        'title_lh_nho'=> @$dataSend['title_lh_nho'],
                        'title_lh_to'=> @$dataSend['title_lh_to'],
                        'image_lh'=> @$dataSend['image_lh'],
                        'title_sp_nho'=> @$dataSend['title_sp_nho'],
                        'title_sp_to'=> @$dataSend['title_sp_to'],
                        'content_sp'=> @$dataSend['content_sp'],
                        'title_sp_1'=> @$dataSend['title_sp_1'],
                        'content_sp_1'=> @$dataSend['content_sp_1'],
                        'link_sp_1'=> @$dataSend['link_sp_1'],
                        'price_sp_1'=> @$dataSend['price_sp_1'],
                        'image_sp_1'=> @$dataSend['image_sp_1'],
                        'title_sp_2'=> @$dataSend['title_sp_2'],
                        'content_sp_2'=> @$dataSend['content_sp_2'],
                        'link_sp_2'=> @$dataSend['link_sp_2'],
                        'price_sp_2'=> @$dataSend['price_sp_2'],
                        'image_sp_2'=> @$dataSend['image_sp_2'],
                        'title_sp_3'=> @$dataSend['title_sp_3'],
                        'content_sp_3'=> @$dataSend['content_sp_3'],
                        'link_sp_3'=> @$dataSend['link_sp_3'],
                        'price_sp_3'=> @$dataSend['price_sp_3'],
                        'image_sp_3'=> @$dataSend['image_sp_3'],
                        'background_feedback'=> @$dataSend['background_feedback'],
                        'title_tt_nho'=> @$dataSend['title_tt_nho'],
                        'title_tt_to'=> @$dataSend['title_tt_to'],
                        'content_tt'=> @$dataSend['content_tt'],
                        'background_post'=> @$dataSend['background_post'],
                        'name_company'=> @$dataSend['name_company'],
                        'address'=> @$dataSend['address'],
                        'phone'=> @$dataSend['phone'],
                        'email'=> @$dataSend['email'],
                        'facebook'=> @$dataSend['facebook'],
                        'twitter'=> @$dataSend['twitter'],
                        'tiktok'=> @$dataSend['tiktok'],
                        'textfooter'=> @$dataSend['textfooter'],
                        'aboutus'=> @$dataSend['aboutus'],    

                        'id_member'=> @$dataSend['id_member'],              
                        'id_group_customer'=> @$dataSend['id_group_customer'],              
                        'id_campaign'=> @$dataSend['id_campaign'],              
                        'domain_crm'=> $urlHomes,               
                        
                        'id_product_ezpics'=> @$dataSend['id_product_ezpics'],              
                        'variable_name'=> @$dataSend['variable_name'],              
                        'variable_avatar'=> @$dataSend['variable_avatar'],              
                        'variable_qr'=> @$dataSend['variable_qr'],              
                        'variable_phone'=> @$dataSend['variable_phone'],              
                        'variable_time'=> @$dataSend['variable_time'],              
                        'variable_code'=> @$dataSend['variable_code'],              
                        'variable_address'=> @$dataSend['variable_address'],              
                        
                        'title_web'=> @$dataSend['title_web'],              
                        'des_web'=> @$dataSend['des_web'],              
                        'image_web'=> @$dataSend['image_web'],              
                );



        $data->key_word = 'settingCloneWebMS009KDTCTheme';
        $data->value = json_encode($value);

        $modelOptions->save($data);

        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
    }

    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }

    setVariable('data', $data_value);
    setVariable('mess', $mess);   
}

function registerEvent($input)
{
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;
    global $session;
    global $controller;
    global $urlHomes;
    global $urlCurrent;

    $metaTitleMantan = 'Đăng ký tham gia sự kiện';
    $mess= '';

    $modelCustomers = $controller->loadModel('Customers');

    $infoMemberWeb = $session->read('infoMemberWeb');

    if($isRequestPost){
        $dataSend = $input['request']->getData();
        $settingTheme = setting();

        if(!empty($dataSend['name']) && !empty($dataSend['phone'])){
            $dataSend['phone'] = trim(str_replace(array(' ','.','-'), '', $dataSend['phone']));
            $dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

            $avatar = '';
            if(isset($_FILES['avatar']) && empty($_FILES['avatar']["error"])){
                $avatar_upload = uploadImage('customer', 'avatar', 'avatar_'.$dataSend['phone']);

                if(!empty($avatar_upload['linkOnline'])){
                    $avatar = str_replace($urlHomes, $settingTheme['domain_crm'], $avatar_upload['linkOnline']);
                }
            }

            $id_agency = 0;
            $id_aff = 0;
            $name_agency = '';
            $id_messenger='';
            $birthday_date=0; 
            $birthday_month=0; 
            $birthday_year=0;

            if(!empty($dataSend['birthday'])){
                $birthday = explode('/', $dataSend['birthday']);

                if(count($birthday) == 3){
                    $birthday_date = (int) $birthday[0];
                    $birthday_month = (int) $birthday[1];
                    $birthday_year = (int) $birthday[2];
                }
            }

            if(empty($dataSend['id_member'])){
                if(!empty($infoMemberWeb)){
                    if($infoMemberWeb->type_member == 'member'){
                        $id_agency = (int) $infoMemberWeb->id;
                        $id_aff = 0;
                    }else{
                        $id_agency = 0;
                        $id_aff = (int) $infoMemberWeb->id;
                    }

                    $name_agency = $infoMemberWeb->name;
                }
            }else{
                $id_agency = (int) $dataSend['id_member'];
                $id_aff = 0;
            }

            $note_history = 'Khách đăng ký tham gia sự kiện từ web '.$urlCurrent.' của '.@$infoMemberWeb->name.' '.@$infoMemberWeb->phone;

            $checkPhone = createCustomerNew(@$dataSend['name'], @$dataSend['phone'], @$dataSend['email'], @$dataSend['address'], (int) @$dataSend['sex'], (int) @$dataSend['id_city'], $id_agency, $id_aff, $name_agency, $id_messenger, $avatar, $birthday_date, $birthday_month, $birthday_year, @$dataSend['id_group'], '', $note_history);

            if(!empty($infoMemberWeb) && $infoMemberWeb->type_member == 'member'){
                saveCustomerMember($checkPhone->id, $infoMemberWeb->id);
            }

            // add vào chiến dịch sự kiện
            if(!empty($dataSend['id_campaign']) && function_exists('getInfoCampaign')){
                $modelCampaignCustomers = $controller->loadModel('CampaignCustomers');
                $modelCampaigns = $controller->loadModel('Campaigns');

                $infoCampaign = getInfoCampaign($dataSend['id_campaign'], $id_agency);

                if(!empty($infoCampaign)){
                    $checkCampaign = $modelCampaignCustomers->find()->where(['id_member'=>$id_agency, 'id_customer'=>(int) $checkPhone->id, 'id_campaign'=>(int) $dataSend['id_campaign']])->first();

                    if(empty($checkCampaign)){
                        $checkCampaign = $modelCampaignCustomers->newEmptyEntity();

                        $checkCampaign->id_member = $id_agency;
                        $checkCampaign->id_customer = $checkPhone->id;
                        $checkCampaign->id_campaign = (int) $dataSend['id_campaign'];
                    }

                    $checkCampaign->id_location = (int) @$dataSend['location'];
                    $checkCampaign->id_team = 0;
                    $checkCampaign->id_ticket = (int) @$dataSend['id_ticket'];
                    $checkCampaign->note = @$dataSend['note_campaign'];
                    $checkCampaign->create_at = time();

                    $infoCampaign->team = json_decode($infoCampaign->team, true);
                    $searchTeam = false;
                    foreach ($infoCampaign->team as $key => $team) {
                        if(!empty($team['name']) && !empty($infoMemberWeb) && $infoMemberWeb->type_member == 'member' && $team['id_member'] == $infoMemberWeb->id){
                            $checkCampaign->id_team = $key;
                            $searchTeam = true;
                            break;
                        }
                    }

                    if($searchTeam == false){
                        $keyNew = 0;
                        foreach ($infoCampaign->team as $key => $team) {
                            if(empty($team['name'])){
                                $keyNew = $key;
                            }
                        }

                        if(empty($keyNew)) $keyNew = count($infoCampaign->team) + 1;

                        if(!empty($infoMemberWeb) && $infoMemberWeb->type_member == 'member'){
                            $infoCampaign->team[$keyNew]['name'] = $infoMemberWeb->name.' '.$infoMemberWeb->phone;
                            $infoCampaign->team[$keyNew]['id_member'] = $infoMemberWeb->id;

                            $checkCampaign->id_team = $keyNew;

                            $infoCampaign->team = json_encode($infoCampaign->team);

                            $modelCampaigns->save($infoCampaign);
                        }
                    }

                    $modelCampaignCustomers->save($checkCampaign);
                }
            }

            // tạo ảnh vé mời
            $linkImage = '';

            if(!empty($settingTheme['id_product_ezpics'])){
                if($dataSend['location'] == 1){
                    $time = 'Ngày 13,14/07';
                    $address = '20 Thuỵ Khuê, Tây Hồ, HN';
                }elseif($dataSend['location'] == 2){
                    $time = 'Ngày 20,21/07';
                    $address = '21 Hoàng Việt, Tân Bình, HCM';
                }
                
                $qr = 'https://api.qrserver.com/v1/create-qr-code/?data='.$urlHomes;

                $linkImage = 'https://designer.ezpics.vn/create-image-series/?id='.$settingTheme['id_product_ezpics'].'&'.$settingTheme['variable_name'].'='.$checkPhone->full_name.'&'.$settingTheme['variable_avatar'].'='.$checkPhone->avatar.'&'.$settingTheme['variable_phone'].'='.$checkPhone->phone.'&'.$settingTheme['variable_time'].'='.$time.'&'.$settingTheme['variable_code'].'=KH'.$checkPhone->id.'&'.$settingTheme['variable_qr'].'='.$qr.'&'.$settingTheme['variable_address'].'='.$address;
            }

            setVariable('infoCustomer', $checkPhone);
            setVariable('linkImage', $linkImage);
        }else{
            $mess= '<p class="text-danger">Gửi thiếu dữ liệu</p>';
        }
    }

    setVariable('mess', $mess);
}

function indexTheme($input)
{
    global $modelAlbums;
    global $modelAlbuminfos;
    global $modelOptions;
    global $modelNotices;
    global $modelPosts;
    global $controller;

    $conditions = array('key_word' => 'settingCloneWebMS009KDTCTheme');
    $data = $modelOptions->find()->where($conditions)->first();

    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }

    $order = array('id'=>'desc');

    $listDataNew= $modelPosts->find()->limit(4)->where(array('type'=>'post'))->order($order)->all()->toList();

    $album_home = $modelAlbums->find()->where(['id'=>(int)@$data_value['id_album']])->first();

    if(!empty($album_home)){
        $album_home->imageinfo = $modelAlbuminfos->find()->limit(6)->where(['id_album'=>(int)$album_home->id])->order(['id'=>'desc'])->all()->toList();
    }

    $infoCampaign = [];
    if(!empty($data_value['id_campaign'])){
        $modelCampaigns = $controller->loadModel('Campaigns');

        $infoCampaign = $modelCampaigns->find()->where(['id'=>$data_value['id_campaign']])->first();

        if(!empty($infoCampaign)){
            $infoCampaign->location = json_decode($infoCampaign->location, true);
            $infoCampaign->team = json_decode($infoCampaign->team, true);
            $infoCampaign->ticket = json_decode($infoCampaign->ticket, true);
        }
    }

    setVariable('setting', $data_value);
    setVariable('listDataNew', $listDataNew);
    setVariable('album_home', $album_home);
    setVariable('infoCampaign', $infoCampaign);

}
?>