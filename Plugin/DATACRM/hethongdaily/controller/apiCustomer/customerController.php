<?php 
// khóa tài khoản
function lockAccountAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $session;

    $modelCustomer = $controller->loadModel('Customers');

    $return = array('code'=>1);
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['token'])){
            $user =  getCustomerByToken($dataSend['token']);

            if(!empty($user)){
                $user->status = 'lock';
                $user->token = '';
                
                $modelCustomer->save($user);
                
                $return = array('code'=>0);
            }else{
                $return = array('code'=>3,
                                    'messages'=>array(array('text'=>'Tài khoản không tồn tại hoặc sai token'))
                                );
            }
        }else{
            $return = array('code'=>2,
                    'messages'=>array(array('text'=>'Gửi thiếu dữ liệu'))
                );
        }
    }

    return $return;
}

// API đăng ký khách hàng 
function saveRegisterCustomerAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $session;
    global $urlHomes;

    $modelCustomer = $controller->loadModel('Customers');
    $modelMember = $controller->loadModel('Members');

    $return = array('code'=>0);
    if($isRequestPost){
        $dataSend = $input['request']->getData();

        if( !empty($dataSend['full_name']) && 
            !empty($dataSend['pass']) &&
            !empty($dataSend['passAgain']) &&
            !empty($dataSend['phone']) 
        ){

            if(!empty($dataSend['phone_agency'])){
                $customer = $modelCustomer->find()->where(array('phone'=>$dataSend['phone_agency']))->first();
                if(!empty($customer)){
                    $id_affsource = $customer->id;
                }else{
                    $id_affsource = 0;
                }
            }else{
                $id_affsource = 0;
            }

            $id_parent = $modelMember->find()->where(array('id_father'=>0))->first()->id;

            if(isset($_FILES['avatar']) && empty($_FILES['avatar']["error"])){
                $avatars = uploadImage($id_parent, 'avatar', 'avatar_'.$id_parent);
            }
            if(!empty($avatars['linkOnline'])){
                $avatar = $avatars['linkOnline'];
            }else{
                $avatar = $urlHomes."/plugins/hethongdaily/view/home/assets/img/avatar-default-crm.png";;
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
                    $data->email = @$dataSend['email'];
                    $data->address = (!empty($dataSend['address']))?$dataSend['address']:'';
                    $data->sex = (int) @$dataSend['sex'];
                    $data->id_city = 0;
                    $data->id_messenger = 0;
                    $data->avatar = $avatar;
                    $data->status = 'active';
                    $data->id_parent = (int) @$id_parent;
                    $data->id_affsource = (int) @$id_affsource;
                    $data->id_level = 0;
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

                    if(!empty($id_parent)){
                        saveCustomerMember($data->id, $id_parent);
                    }

                    $return = array('code'=>1,
                                    'infoUser'=> $data,
                                    'messages'=>'Đăng ký thành công',
                                );
                }else{
                    
                    $checkCustomer->full_name = $dataSend['full_name'];
                    $checkCustomer->email = (!empty($dataSend['email']))?$dataSend['email']:$checkCustomer->email;
                    $checkCustomer->address = (!empty($dataSend['address']))?$dataSend['address']:$checkCustomer->address;
                    $checkCustomer->pass = (!empty($dataSend['pass']))?md5($dataSend['pass']):$checkCustomer->pass;
                    $checkCustomer->token = createToken();
                    $checkCustomer->token_device = (!empty($dataSend['token_device']))?$dataSend['token_device']:$checkCustomer->token_device;

                    $modelCustomer->save($checkCustomer);

                    if(!empty($id_affsource)){
                        $point = listPonint();
                        $note = 'bạn được cộng '.$point['point_introduce_user'].' điểm giới thiệu người mới';
                        accumulatePoint($id_affsource,$point['point_introduce_user'],$note);

                        $dataSendNotification= array('title'=>'bạn giới thiệu được người mới',
                            'time'=>date('H:i d/m/Y'),
                            'content'=>"$checkCustomer->full_name đã đăng ký mã giới thiệu của bạn ",
                            'id_friend'=>"$checkCustomer->id",
                            'action'=>'sendRegisterCustomer');

                        if(!empty($customer->token_device)){
                            sendNotification($dataSendNotification, $customer->token_device);
                        }
                    }

                    $return = array('code'=>1,
                                    'infoUser'=> $checkCustomer,
                                    'messages'=>'Đăng ký thành công',
                                );
                    
                    /*
                    $return = array('code'=>3,
                        'infoUser'=> null,
                        'messages'=>'Số điện thoại này đã được đăng ký',
                    );
                    */
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

// API đăng nhập khách hàng
function checkLoginCustomerAPI($input)
{
    global $isRequestPost;
    global $controller;
    global $session;

    $modelCustomer = $controller->loadModel('Customers');
    $modelTokenDevices = $controller->loadModel('TokenDevices');

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

                if(!empty($dataSend['token_device'])){
                    $checkTokenDevice = $modelTokenDevices->find()->where(['token_device'=>$dataSend['token_device']])->first();

                    if(!empty($checkTokenDevice)){
                        $checkTokenDevice->id_customer = $info_customer->id;
                    }else{
                        $checkTokenDevice = $modelTokenDevices->newEmptyEntity();

                        $checkTokenDevice->token_device = $dataSend['token_device'];
                        $checkTokenDevice->id_customer = $info_customer->id;
                    }

                    $modelTokenDevices->save($checkTokenDevice);
                    $info_customer->token_device = @$dataSend['token_device'];
                }

                
                $modelCustomer->save($info_customer);
                 getCustomerByToken($info_customer->token);

                $return = array('code'=>1,
                    'infoUser'=> $info_customer,
                    'messages'=>'Bạn đăng nhập thành công',
                );
            }else{
                $return = array('code'=>2,
                    'messages'=>'Tài khoản không tồn tại hoặc sai mật khẩu',
                );

            }


        }else{
            $return = array('code'=>3,
                'messages'=>'nhập thiếu dữ liệus',
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

// lấy mật khẩu khách hàng
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

// tạo mật khẩu mới khách hàng
function resetPasswordCustomerApi($input)
{
    global $controller;
    global $isRequestPost;

    $modelCustomer = $controller->loadModel('Customers');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (isset($dataSend['phone'])
            && isset($dataSend['code'])
            && isset($dataSend['new_password'])
            && isset($dataSend['password_confirmation'])
        ) {
            $dataSend['phone'] = str_replace([' ', '.', '-'], '', $dataSend['phone']);
            $dataSend['phone'] = str_replace('+84', '0', $dataSend['phone']);
            
            $user = $modelCustomer->find()->where(['phone' => $dataSend['phone']])->first();

            if (!$user) {
                return  array('code'=>3,'messages'=>'Số điện thoại chưa được đăng kí cho bất kì tài khoản nào');
            }

            if ($user->status != 'active') {
                return array('code'=>4,'messages'=>'Tài khoản đang bị khóa'); 
            }

            if ($user->reset_password_code != $dataSend['code']) {
                return array('code'=>5,'messages'=>'Mã cấp lại mật khẩu không chính xác');
            }

            if ($dataSend['new_password'] != $dataSend['password_confirmation']) {
                return array('code'=>6,'messages'=>'Mật khẩu nhập lại không chính xác');
            }

            $user->pass = md5($dataSend['new_password']);
            $user->reset_password_code = null;
            $user->access_token = createToken();
            $user->device_token = @$dataSend['device_token'];
            
            $modelCustomer->save($user);

            return array('code'=>1,'messages'=>'Đổi mật khẩu thành công');
        }

        return array('code'=> 2,'messages'=> 'Gửi thiếu dữ liệu');
    }else{
        return array('code'=> 0,'messages'=> 'gửi sai kiểu POST');
    }

}

// đăng xuất khách hàng 
function logoutCustomerApi($input)
{
    global $controller;
    global $isRequestPost;
    
    $modelCustomer = $controller->loadModel('Customers');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (isset($dataSend['token'])) {
            $user =  getCustomerByToken($dataSend['token']);

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

// sửa thông tin tài khoản khách hàng
function editInfoCustomerApi($input){
    global $controller;
    global $isRequestPost;
    
    $modelCustomer = $controller->loadModel('Customers');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (isset($dataSend['token'])) {
            $user =  getCustomerByToken($dataSend['token']);

            

            if (!empty($user)) {
                $user = $modelCustomer->find()->where(['id'=>$user->id])->first();
                if(!empty($dataSend['full_name'])){
                    $user->full_name = $dataSend['full_name'];
                }

                if(!empty($dataSend['email'])){
                    $user->email = $dataSend['email'];
                }
                if(!empty($dataSend['address'])){
                    $user->address = $dataSend['address'];
                }
                if(isset($dataSend['sex'])){
                    $user->sex = (int) @$dataSend['sex'];
                }

                if(isset($_FILES['avatar']) && empty($_FILES['avatar']["error"])){
                    $avatars = uploadImage($user->id, 'avatar', 'avatar_customer'.$user->id);
                }
                if(!empty($avatars['linkOnline'])){
                    $user->avatar = $avatars['linkOnline'];
                }

                if(!empty($dataSend['birthday'])){
                    $birthday_date = 0;
                    $birthday_month = 0;
                    $birthday_year = 0;

                    $birthday = explode('/', trim($dataSend['birthday']));
                    if(count($birthday)==3){
                        $birthday_date = (int) $birthday[0];
                        $birthday_month = (int) $birthday[1];
                        $birthday_year = (int) $birthday[2];
                    }

                    $user->birthday_date = (int) @$birthday_date;
                    $user->birthday_month = (int) @$birthday_month;
                    $user->birthday_year = (int) @$birthday_year;
                }

                $modelCustomer->save($user);
                return array('code'=>1,'infoUser'=> $user, 'messages'=>'Lưu dữ liệu thành công');
            }

            return array('code'=>3,'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2,'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
}

// sửa mật khẩu khách hàng 
function editPassCustomerApi($input){
    global $controller;
    global $isRequestPost;
    
    $modelCustomer = $controller->loadModel('Customers');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (isset($dataSend['token'])) {
            $user =  getCustomerByToken($dataSend['token']);
           

            if (!empty($user)) {
                $user = $modelCustomer->find()->where(['id'=>$user->id])->first();
                if ($user->password != md5($dataSend['old_password'])){
                    return array('code'=>5,
                        'messages'=>'Mật khẩu cũ không chính xác');
                }

                if ($dataSend['new_password'] != $dataSend['password_confirmation']) {
                    return array('code'=>6,
                        'messages'=>'Mật khẩu nhập lại không chính xác',
                    );
                }

                $user->password = md5($dataSend['new_password']);

                
                $modelCustomer->save($user);
                return array('code'=>1,'infoUser'=> $user, 'messages'=>'Lưu dữ liệu thành công');
            }

            return array('code'=>3,'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2,'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
}

// lấy thông tin khách hàng 
function getInfoUserCustomerAPI($input){
    global $controller;
    global $isRequestPost;
    
    $modelCustomer = $controller->loadModel('Customers');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (isset($dataSend['token'])) {
            $user =  getCustomerByToken($dataSend['token']);

            if (!empty($user)) {
               
                return array('code'=>1,'data'=> $user, 'messages'=>'Lấy dữ liệu thành công');
            }

            return array('code'=>3,'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2,'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
}

function getLinkMMTCAPI($input)
{
    global $controller;
    global $isRequestPost;
    
    $modelCustomer = $controller->loadModel('Customers');

    $modelCustomerHistorieMmtt = $controller->loadModel('CustomerHistorieMmtts');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (isset($dataSend['token'])) {
            $user =  getCustomerByToken($dataSend['token']);
           

            if (!empty($user)) {
                 $user = $modelCustomer->find()->where(['id'=>$user->id])->first();
                if(function_exists('getMemberById')){
                    $infoMember =  getMemberById($user->id_parent);
                }
               
                if(!empty($user->link_download_mmtc) && empty($dataSend['reload'])){
                    return array('code'=>1,'link'=>$user->link_download_mmtc);
                }else{


                    $checkHistorieMmtt = count($modelCustomerHistorieMmtt->find()->where(['id_user'=>$user->id])->all()->toList());
                    if(!empty($user->max_export_mmtc)){
                        if( $user->max_export_mmtc <= $checkHistorieMmtt){
                            return array('code'=>6,'messages'=>'Bạn đã xuất quá giới hạn cho phép, tối đa bạn chỉ có thể xuất '.$user->max_export_mmtc.' bản thần số học.');
                        }
                    }elseif(!empty($infoMember->infosystem->max_export_mmtc)){
                        if($infoMember->infosystem->max_export_mmtc <= $checkHistorieMmtt){
                            return array('code'=>6,'messages'=>'Bạn đã xuất quá giới hạn cho phép, tối đa bạn chỉ có thể xuất '.$infoMember->infosystem->max_export_mmtc.' bản thần số học.');
                        }
                    }

                    if(!empty($user->birthday_date) && !empty($user->birthday_month) && !empty($user->birthday_year)){
                        $birthday = $user->birthday_date.'/'.$user->birthday_month.'/'.$user->birthday_year;
                        
                        // lấy thần số học
                        if(empty($user->email)){
                            $email = 'datacrmasia@gmail.com';
                        }else{
                            $email = $user->email;
                        }

                        if(empty($user->address)){
                            $address = '18 Thanh Bình, Mộ Lao, Hà Đông, Hà Nội';
                        }else{
                            $address = $user->address;
                        }

                        $linkFull = '';
                        if(function_exists('getLinkFullMMTCAPI')){
                            $linkFull = getLinkFullMMTCAPI($user->full_name, $birthday, $user->phone, $email, $address, $user->avatar, (int) $user->sex, 0, 0);
                        }

                        if(!empty($linkFull)){
                            $user->link_download_mmtc = $linkFull;

                            $modelCustomer->save($user);

                            $history = $modelCustomerHistorieMmtt->newEmptyEntity();
                            $history->id_user = $user->id;
                            $history->id_customer =$user->id;
                            $history->created_at = time();
                            $history->note = '';
                            $history->link_download_mmtc =$user->link_download_mmtc;
                            $modelCustomerHistorieMmtt->save($history);

                            return array('code'=>0,'link'=>$user->link_download_mmtc);
                        }else{
                            return array('code'=>5,'messages'=>'Hệ thống xuất dữ liệu thần số học bị lỗi');
                        }
                    }else{
                        return array('code'=>4,'messages'=>'Chưa có ngày sinh');
                    }
                }
            }

            return array('code'=>3,'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2,'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>1,'messages'=>'Gửi sai kiểu POST');
}

function createLinkMMTCAPI($input)
{   
    global $controller;
    global $isRequestPost;
    global  $urlHomes;
    
    $modelCustomer = $controller->loadModel('Customers');
    $modelCustomerHistorieMmtt = $controller->loadModel('CustomerHistorieMmtts');

    $point = listPonint();


    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token']) && !empty($dataSend['phone']) && !empty($dataSend['birthday']) && !empty($dataSend['full_name'])) {
            $dataSend['phone'] = str_replace([' ', '.', '-'], '', $dataSend['phone']);
            $dataSend['phone'] = str_replace('+84', '0', $dataSend['phone']);

            $user =  getCustomerByToken($dataSend['token']);

            if (!empty($user)){
                if(function_exists('getMemberById')){
                    $infoMember =  getMemberById($user->id_parent);
                }

                $checkHistorieMmtt = count($modelCustomerHistorieMmtt->find()->where(['id_user'=>$user->id])->all()->toList());
                $note = 'bạn bị từ 50 điểm khi xuât thần số học người khác';
                if(!empty($user->max_export_mmtc)){
                    if( $user->max_export_mmtc <= $checkHistorieMmtt){
                        $checkPoint = minuAccumulatePoint($user->id,50,$note);
                        if(empty($checkPoint['code'])){
                            return array('code'=>6,'messages'=>'Bạn đã xuất quá giới hạn cho phép, tối đa bạn chỉ có thể xuất '.$user->max_export_mmtc.' bản thần số học.');
                        }
                    }
                }elseif(!empty($infoMember->infosystem->max_export_mmtc)){
                    if($infoMember->infosystem->max_export_mmtc <= $checkHistorieMmtt){
                        $checkPoint = minuAccumulatePoint($user->id,50,$note);
                        if(empty($checkPoint['code'])){
                            return array('code'=>6,'messages'=>'Bạn đã xuất quá giới hạn cho phép, tối đa bạn chỉ có thể xuất '.$infoMember->infosystem->max_export_mmtc.' bản thần số học.');
                        }
                    }
                }

                if(!empty($checkPoint['code'])){
                    $user->max_export_mmtc += 1;
                    $modelCustomer->save($user);
                }
               
                $checkPhone =  $modelCustomer->find()->where(['phone' => $dataSend['phone']])->first();
                $saveMember = '';
                if(empty($checkPhone)){
                    if(isset($_FILES['avatar']) && empty($_FILES['avatar']["error"])){
                        $avatars = uploadImage($user->id_parent, 'avatar', 'avatar_'.$user->id_parent);
                    }

                    if(!empty($avatars['linkOnline'])){
                        $avatar = $avatars['linkOnline'];
                    }else{
                        $avatar = $urlHomes."/plugins/hethongdaily/view/home/assets/img/avatar-default-crm.png";;
                    }

                    $checkPhone = $modelCustomer->newEmptyEntity();
                    
                    $checkPhone->full_name = $dataSend['full_name'];
                    $checkPhone->phone = $dataSend['phone'];
                    $checkPhone->email = @$dataSend['email'];
                    $checkPhone->address = @$dataSend['address'];
                    $checkPhone->sex = (int) @$dataSend['sex'];
                    $checkPhone->id_city = 0;
                    $checkPhone->id_messenger = 0;
                    $checkPhone->avatar = $avatar;
                    $checkPhone->status = 'active';
                    $checkPhone->id_parent = (int) $user->id_parent;
                    $checkPhone->id_level = 0;
                    $checkPhone->pass = md5($dataSend['phone']);
                    $checkPhone->token = createToken();
                    $checkPhone->created_at = time();

                    $birthday = explode('/', trim($dataSend['birthday']));
                    if(count($birthday)==3){
                        $birthday_date = (int) $birthday[0];
                        $birthday_month = (int) $birthday[1];
                        $birthday_year = (int) $birthday[2];
                    }

                    $checkPhone->birthday_date = (int) @$birthday_date;
                    $checkPhone->birthday_month = (int) @$birthday_month;
                    $checkPhone->birthday_year = (int) @$birthday_year;

                    $modelCustomer->save($checkPhone);

                    // lưu bảng đại lý
                    $saveMember = saveCustomerMember($checkPhone->id, $user->id_parent);
                }else{
                    if(!empty($dataSend['full_name'])){
                        $checkPhone->full_name = $dataSend['full_name'];
                    }

                    if(!empty($dataSend['email'])){
                        $checkPhone->email = $dataSend['email'];
                    }

                    if(!empty($dataSend['address'])){
                        $checkPhone->address = $dataSend['address'];
                    }

                    if(isset($dataSend['sex'])){
                        $checkPhone->sex = (int) $dataSend['sex'];
                    }

                    if(!empty($dataSend['birthday'])){
                        $birthday = explode('/', $dataSend['birthday']);

                        if(count($birthday)==3){
                            $checkPhone->birthday_date = (int) $birthday[0];
                            $checkPhone->birthday_month = (int) $birthday[1];
                            $checkPhone->birthday_year = (int) $birthday[2];
                        }
                    }

                    $modelCustomer->save($checkPhone);
                }
                
                // xuất thần số học
                $birthday = $checkPhone->birthday_date.'/'.$checkPhone->birthday_month.'/'.$checkPhone->birthday_year;

                // lấy thần số học
                if(empty($checkPhone->email)){
                    $email = 'datacrmasia@gmail.com';
                }else{
                    $email = $checkPhone->email;
                }

                if(empty($checkPhone->address)){
                    $address = '18 Thanh Bình, Mộ Lao, Hà Đông, Hà Nội';
                }else{
                    $address = $checkPhone->address;
                }

                $linkFull = '';
                if(function_exists('getLinkFullMMTCAPI')){
                    $linkFull = getLinkFullMMTCAPI($checkPhone->full_name, $birthday, $checkPhone->phone, $email, $address, $checkPhone->avatar, (int) $checkPhone->sex, 0, 0);
                }

                if(!empty($linkFull)){
                    $checkPhone->link_download_mmtc = $linkFull;

                    $modelCustomer->save($checkPhone);

                    $history = $modelCustomerHistorieMmtt->newEmptyEntity();
                    $history->id_user = $user->id;
                    $history->id_customer =$checkPhone->id;
                    $history->created_at = time();
                    $history->note = '';
                    $history->link_download_mmtc =$checkPhone->link_download_mmtc;
                    $modelCustomerHistorieMmtt->save($history);

                    $note = 'bạn được công  '.$point['point_expor_numerology'].'điểm xuất thần số học cho người khác';

                    accumulatePoint($user->id,$point['point_expor_numerology'],$note);

                    return array('code'=>0,'link'=>$checkPhone->link_download_mmtc, 'saveMember'=>$saveMember);

                }else{
                    return array('code'=>5,'messages'=>'Hệ thống xuất dữ liệu thần số học bị lỗi');
                }
            }else{
                return array('code'=>3,'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
            }
        }else{
            return array('code'=>2,'messages'=>'Gửi thiếu dữ liệu');
        }
    }else{
        return array('code'=>1,'messages'=>'Gửi sai kiểu POST');
    }
}

function listCustomerHistorieMmttAPI($input)
{   
    global $controller;
    global $isRequestPost;

    $modelCustomer = $controller->loadModel('Customers');
    $modelCustomerHistorieMmtt = $controller->loadModel('CustomerHistorieMmtts');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['token'])) {
            $user =  getCustomerByToken($dataSend['token']);
            if (!empty($user)){
                $listData =  $modelCustomerHistorieMmtt->find()->where(['id_user'=>$user->id])->all()->toList();

                if(!empty($listData)){
                    foreach ($listData as $key => $value) {
                        $listData[$key]->infoCustomer = $modelCustomer->find()->where(['id'=>$value->id_customer])->first(); 
                    }
                }
                   return array('code'=>1,'messages'=>'Bạn lấy dữ liệu thành công', 'listData'=>$listData);
                  
            }

                return array('code'=>3,'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2,'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>1,'messages'=>'Gửi sai kiểu POST');
}


function getContactSiteAPI(){
    global $infoSite;
    global $contactSite;

    return array('infoSite'=>$infoSite, 'contactSite'=>$contactSite);
}

// lấy thông tin khách hàng 
function getPointCustomerAPI($input){
    global $controller;
    global $isRequestPost;
    
    $modelCustomer = $controller->loadModel('Customers');
    $modelMember = $controller->loadModel('Members');

    $modelPointCustomer = $controller->loadModel('PointCustomers');
    $modelRatingPointCustomer = $controller->loadModel('RatingPointCustomers');
    
    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (isset($dataSend['token'])) {
            $user =  getCustomerByToken($dataSend['token']);

            if (!empty($user)) {

                $conditions = array('id_customer'=>$user->id);

                if(!empty($dataSend['id_member'])){
                    $conditions['id_member']= (int)$dataSend['id_member'];
                }else{
                    $boss = $modelMember->find()->where(['id_father'=>0])->first();
                    $conditions['id_member']=$boss->id; 
                }

                $point = 0;
                $membership = 'Chưa xếp hạng';
                
                $data = $modelPointCustomer->find()->where($conditions)->first();

                if(!empty($data)){
                    if(!empty($data->id_rating)){
                        $membership = $modelRatingPointCustomer->find()->where(['id'=>$data->id_rating])->first()->name;
                    }
                    $point = $data->point;
                }

                $allPoint = $modelRatingPointCustomer->find()->where()->all()->toList();
                $point_max = 0;

                if(!empty($allPoint)){
                    foreach ($allPoint as $key => $value) {
                        if($point_max < $value->point_min){
                            $point_max = $value->point_min;
                        }
                    }
                }
               
                return array('code'=>1,'point'=> $point, 'membership'=>$membership, 'point_max'=>$point_max, 'messages'=>'Lấy dữ liệu thành công');
            }

            return array('code'=>3,'messages'=>'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }

        return array('code'=>2,'messages'=>'Gửi thiếu dữ liệu');
    }

    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
}

function pointStatisticTopWeek($input){
    global $controller;
    global $isRequestPost;
    global  $urlHomes;
    
    $modelCustomer = $controller->loadModel('Customers');
    $modelPointCustomer = $controller->loadModel('PointCustomers');
    $modelMember = $controller->loadModel('Members');
    $modelRatingPointCustomer = $controller->loadModel('RatingPointCustomers');
    if ($isRequestPost) {
        $dataSend = $input['request']->getData();   
        $user = $modelMember->find()->where(['id_father'=>0])->first();
        $conditions = array('id_member'=>$user->id,'updated_at >='=>strtotime('-7 days'));
        $limit = (!empty($dataSend['limit']))?(int)$dataSend['limit']:5;
        $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
        if($page<1) $page = 1;
        $order = array('point'=>'desc');
       $listData = $modelPointCustomer->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        if(!empty($listData)){
            foreach ($listData as $key => $value) {
                $point = $value->point;
                $listData[$key]->rating = $modelRatingPointCustomer->find()->where(['id'=>$value->id_rating])->first();
                $customer = $modelCustomer->find()->where(['id'=>$value->id_customer])->first();
                unset($customer->pass);
                unset($customer->token_device);
                unset($customer->token);
                unset($customer->reset_password_code);
                $listData[$key]->customer = $customer;
                
            }
        }
        return array('code'=>1,'messages'=>'Lấy dữ liệu thành công','listData'=> $listData);


    }

    return array('code'=>0,'messages'=>'Gửi sai kiểu POST');
}

?>