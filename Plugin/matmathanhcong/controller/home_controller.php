<?php
function result($input)
{
    global $controller;
    global $isRequestPost;
    global $session;

    $dataSend = $_GET;

    $modelRequestExports = $controller->loadModel('RequestExports');

    if(!empty($dataSend['name']) && !empty($dataSend['day']) && !empty($dataSend['month']) && !empty($dataSend['year']) && !empty($dataSend['phone'])){
        // chuẩn hóa dữ liệu
        $dataSend['day'] = (int) $dataSend['day'];
        $dataSend['month'] = (int) $dataSend['month'];
        $dataSend['year'] = (int) $dataSend['year'];
        
        $dataSend['birthday'] = $dataSend['day'].'/'.$dataSend['month'].'/'.$dataSend['year'];
        $dataSend['phone']= str_replace(array(' ','.','-'), '', @$dataSend['phone']);
        $dataSend['phone'] = str_replace('+84','0',$dataSend['phone']);

        if($dataSend['day']<1 || $dataSend['day']>31 || $dataSend['month']<1 || $dataSend['month']>12 || $dataSend['year']<1900 || $dataSend['year']>2124){
            return $controller->redirect('/?error=birthday');
        }

        if(strlen($dataSend['phone']) != 10){
            return $controller->redirect('/?error=phone');
        }

        // kiểm tra đã đăng ký chưa
        $checkDataExits = $modelRequestExports->find()->where(['phone'=>$dataSend['phone']])->first();

        if(empty($checkDataExits)){
            $data = $modelRequestExports->newEmptyEntity();

            // lưu database
            $data->avatar = '';
            $data->name = $dataSend['name'];
            $data->birthday = $dataSend['birthday'];
            $data->phone = $dataSend['phone'];
            $data->email = '';
            $data->address = '';
            $data->idMessenger = '';
            $data->affiliate_phone = (!empty($session->read('aff')) && $session->read('aff')!=$dataSend['phone'])?$session->read('aff'):'';
            $data->link_download = '';
            $data->status_pay = 'wait';

            $modelRequestExports->save($data);

            // kiểm tra người giới thiệu
            if(!empty($session->read('aff'))){
                $checkNumberOrder = $modelRequestExports->find()->where(['affiliate_phone'=>$session->read('aff')])->all()->toList();
               
                if(count($checkNumberOrder) >= 3){
                    $info_aff = $modelRequestExports->find()->where(['phone'=>$session->read('aff'), 'status_pay'=>'wait'])->first();
                    
                    if(!empty($info_aff)){
                        $info_aff->status_pay = 'done';
                        $modelRequestExports->save($info_aff);

                        // gửi email
                        if(!empty($info_aff->email)){
                            sendEmailLinkFull($info_aff->email, $info_aff->name, $info_aff->link_download);
                        }

                        // gửi FB
                        if(!empty($info_aff->idMessenger)){
                            $attributesSmax = [];
                            $attributesSmax['linkDownloadMMTC']= $info_aff->link_download;
                            
                            $urlSmax= 'https://api.smax.bot/bots/'.$idBot.'/users/'.$dataSend['idMessenger'].'/send?bot_token='.$tokenBot.'&block_id='.$idBlockDownload.'&messaging_tag="CONFIRMED_EVENT_UPDATE"';
                            
                            $returnSmax= sendDataConnectMantan($urlSmax, $attributesSmax);
                        }
                    }
                }
            }
        }

        $age = 0;
        $date = new \DateTime($dataSend['year'].'/'.$dataSend['month'].'/'.$dataSend['day']);
        $now = new \DateTime();
        $diff = $now->diff($date);
        $age = $diff->y + 1;

        $tach_year = str_split($dataSend['year']);
        $data_year = implode(' + ', $tach_year);
        $kq_year = ketquapheptinhcong($tach_year);

        $tach_day = str_split($dataSend['day']);
        $data_day = implode(' + ', $tach_day);
        $kq_day = ketquapheptinhcong($tach_day);

        $tach_month = str_split($dataSend['month']);
        $data_month = implode(' + ', $tach_month);
        $kq_month = ketquapheptinhcong($tach_month);

        $consoduongdoi = ketquapheptinhcong([$kq_day, $kq_month, $kq_year]);

        $url = 'https://quantri.matmathanhcong.vn/api/Calculate?customer_birthdate='.$dataSend['day'].'/'.$dataSend['month'].'/'.$dataSend['year'].'&customer_name='.urlencode($dataSend['name']);
        
        $infoNumber = file_get_contents($url);
        $infoNumber = json_decode($infoNumber, true);

        $full_number = array_merge($tach_year,$tach_month, $tach_day);

        setVariable('age', $age);
        setVariable('data_year', $data_year);
        setVariable('kq_year', $kq_year);
        setVariable('data_day', $data_day);
        setVariable('kq_day', $kq_day);
        setVariable('data_month', $data_month);
        setVariable('kq_month', $kq_month);
        setVariable('consoduongdoi', $consoduongdoi);
        setVariable('full_number', $full_number);
        setVariable('infoNumber', @$infoNumber['Result']);
    }else{
        return $controller->redirect('/?error=empty');
    }
}

function resultvip($input)
{
    global $controller;
    global $isRequestPost;
    global $session;
    global $bank_number;
    global $bank_name;
    global $price_full;
    global $key_banking;
    global $idBot;
    global $tokenBot;
    global $idBlockConfirm;
    global $idBlockDownload;
    global $modelOptions;
    global $urlHomes;

    $modelRequestExports = $controller->loadModel('RequestExports');

    if($isRequestPost){
        $dataSend = $input['request']->getData();

        if(empty($dataSend['chatbot'])) $dataSend['chatbot'] = 'smax';

        if(!empty($dataSend['customer_name']) && !empty($dataSend['customer_birthdate']) && !empty($dataSend['customer_phone'])){
            if(empty($dataSend['customer_email'])){
                $dataSend['customer_email'] = "matmathanhcong@gmail.com";
            }

            if(empty($dataSend['customer_address'])){
                $dataSend['customer_address'] = "18 Thanh Bình, Mộ Lao, Hà Đông, Hà Nội";
            }

            // chuẩn hóa dữ liệu
            $dataSend['customer_birthdate'] = str_replace(array('.','-',',',' '), '/', $dataSend['customer_birthdate']);
            $dataSend['customer_phone']= str_replace(array(' ','.','-'), '', @$dataSend['customer_phone']);
            $dataSend['customer_phone'] = str_replace('+84','0',$dataSend['customer_phone']);

            $customer_birthdate = explode('/', $dataSend['customer_birthdate']);
            $customer_birthdate[0] = (int) $customer_birthdate[0];
            $customer_birthdate[1] = (int) $customer_birthdate[1];
            $customer_birthdate[2] = (int) $customer_birthdate[2];
            
            if($customer_birthdate[0]<1 || $customer_birthdate[0]>31 || $customer_birthdate[1]<1 || $customer_birthdate[1]>12 || $customer_birthdate[2]<1900 || $customer_birthdate[2]>2124){
                if(!empty($dataSend['idMessenger'])){
                    echo 'Sai định dạng ngày tháng năm sinh';die;
                }else{
                    return $controller->redirect('/?error=birthday');
                }
            }

            if(strlen($dataSend['customer_phone']) != 10){
                if(!empty($dataSend['idMessenger'])){
                    echo 'Sai định dạng số điện thoại';die;
                }else{
                    return $controller->redirect('/?error=phone');
                }
            }

            if (!filter_var($dataSend['customer_email'], FILTER_VALIDATE_EMAIL)) {
                if(!empty($dataSend['idMessenger'])){
                    echo 'Sai định dạng email';die;
                }else{
                    return $controller->redirect('/?error=email');
                }
            }

            $customer_name = explode(' ', $dataSend['customer_name']);
            if(count($customer_name)<2){
                if(!empty($dataSend['idMessenger'])){
                    echo 'Họ tên phải có từ 2 từ trở lên';die;
                }else{
                    return $controller->redirect('/?error=name');
                }
            }

            // kiểm tra đã đăng ký chưa
            $checkDataExits = $modelRequestExports->find()->where(['phone'=>$dataSend['customer_phone']])->first();

            if(empty($checkDataExits->link_download)){
                if(empty($checkDataExits)){
                    $data = $modelRequestExports->newEmptyEntity();
                }else{
                    $data = $checkDataExits;
                }

                if(!is_string($dataSend['avatar'])){
                    $dataSend['avatar'] = '';
                }

                if(isset($_FILES['avatar']) && empty($_FILES['avatar']["error"])){
                    $avatar = uploadImage(1, 'avatar');

                    if(!empty($avatar['linkOnline'])){
                        $dataSend['avatar'] = $avatar['linkOnline'];
                    }else{
                        return $controller->redirect('/?error=uploadAvatarFail');
                    }
                }

                if(empty($dataSend['avatar'])){
                    $dataSend['avatar'] = $urlHomes.'/plugins/matmathanhcong/view/home/img/avatar-default-crm.png';
                }
                
                // lấy link tải bản full
                /*
                $url = 'https://quantri.matmathanhcong.vn/api/Calculate/GetLinkByModelApi';

                $dataPush = [   'customer_name' => $dataSend['customer_name'],
                                'customer_birthdate' => $dataSend['customer_birthdate'],
                                'customer_phone' => $dataSend['customer_phone'],
                                'customer_email' => $dataSend['customer_email'],
                                'customer_address' => $dataSend['customer_address'],
                                'user_avatar' => $avatar['linkOnline'],
                                'customer_avatar' => $avatar['linkOnline'],
                            ];

                $infoFull = sendDataConnectMantan($url, $dataPush);
                $infoFull = json_decode($infoFull, true);
                */
                //$infoFull = getLinkFullMMTCAPI($dataSend['customer_name'], $dataSend['customer_birthdate'], $dataSend['customer_phone'], $dataSend['customer_email'], $dataSend['customer_address'], $dataSend['avatar'], 1);
                $infoFull = '';
                // lưu database
                $data->avatar = $dataSend['avatar'];
                $data->name = $dataSend['customer_name'];
                $data->birthday = $dataSend['customer_birthdate'];
                $data->phone = $dataSend['customer_phone'];
                $data->email = trim($dataSend['customer_email']);
                $data->address = $dataSend['customer_address'];
                
                if($dataSend['chatbot']=='smax'){
                    $data->idMessenger = @$dataSend['idMessenger'];
                }else{
                    $data->idZalo = @$dataSend['idMessenger'];
                }

                $data->affiliate_phone = (!empty($session->read('aff')) && $session->read('aff')!=$dataSend['customer_phone'])?$session->read('aff'):'';
                $data->link_download = @$infoFull;
                $data->status_pay = 'wait';

                $modelRequestExports->save($data);

                // tạo link thanh toán
                $linkQR = 'https://img.vietqr.io/image/TPB-'.$bank_number.'-compact2.png?amount='.$price_full.'&addInfo='.$data->id.'%20'.$key_banking.'&accountName='.$bank_name;

                // gửi Zalo đơn hàng
                $urlZNS = 'https://quantri.databot.vn/sendZNS309784';
                $dataZNS = ['phone'=> $data->phone,
                            'customer_name' => $data->name,
                            'order_code' => 'MMTC-'.$data->id,
                            'payment_status' => 'Chờ thanh toán',
                            'product_name' => 'Bản luận giải đầy đủ Mật Mã Thành Công',
                            'author' => 'Trần Toản',
                            'cost' => $price_full,
                            'note' => 'Link giới thiệu https://matmathanhcong.vn/?aff='.$data->phone
                            ];

                $mesZNS = sendDataConnectMantan($urlZNS, $dataZNS);

                // kiểm tra người giới thiệu
                if(!empty($session->read('aff'))){
                    $checkNumberOrder = $modelRequestExports->find()->where(['affiliate_phone'=>$session->read('aff')])->all()->toList();
                   
                    if(count($checkNumberOrder) >= 3){
                        $info_aff = $modelRequestExports->find()->where(['phone'=>$session->read('aff'), 'status_pay'=>'wait'])->first();
                        
                        if(!empty($info_aff)){
                            $info_aff->status_pay = 'done';
                            $modelRequestExports->save($info_aff);

                            // gửi email
                            if(!empty($info_aff->email)){
                                sendEmailLinkFull($info_aff->email, $info_aff->name, $info_aff->link_download);
                            }

                            // gửi FB
                            if(!empty($info_aff->idMessenger)){
                                $attributesSmax = [];
                                $attributesSmax['linkDownloadMMTC']= $info_aff->link_download;
                                
                                $urlSmax= 'https://api.smax.bot/bots/'.$idBot.'/users/'.$dataSend['idMessenger'].'/send?bot_token='.$tokenBot.'&block_id='.$idBlockDownload.'&messaging_tag="CONFIRMED_EVENT_UPDATE"';
                                
                                $returnSmax= sendDataConnectMantan($urlSmax, $attributesSmax);
                            }
                        }
                    }
                }

                // gửi tin nhắn Messenger
                if(!empty($dataSend['idMessenger'])){
                    // gửi Smax Bot
                    if(!empty($idBot)
                        && !empty($tokenBot)
                        && !empty($idBlockConfirm)
                    ) {
                        $attributesSmax = [];
                        $attributesSmax['linkQRBankingMMTC']= $linkQR;
                        //$attributesSmax['linkAffMMTC']= 'https://matmathanhcong.vn/?aff='.$data->phone;
                        $attributesSmax['linkAffMMTC']= 'https://m.me/100405719654447?ref=Dang-ky-Mat-ma-thanh-cong-affiliate.'.$data->phone;
                        $attributesSmax['phone']= $data->phone;
                        
                        $urlSmax= 'https://api.smax.bot/bots/'.$idBot.'/users/'.$dataSend['idMessenger'].'/send?bot_token='.$tokenBot.'&block_id='.$idBlockConfirm.'&messaging_tag="CONFIRMED_EVENT_UPDATE"';
                        
                        $returnSmax= sendDataConnectMantan($urlSmax, $attributesSmax);
                    }

                    // gửi tin nhắn chatbot Zalo
                    if(!empty($dataSend['chatbot']) && $dataSend['chatbot'] == 'zalo'){
                        if(function_exists('sendMessZalo')){
                            $id_oa = '';
                            $app_id = '';
                            $user_id_zalo = $dataSend['idMessenger'];
                            //$text = 'Link tải bản đầy đủ Mật Mã Thành Công của '.$dataSend['customer_name'].': '.@$infoFull;
                            $text = 'Chúng tôi sẽ gửi link tải bản đầy đủ Thần Số Học về email của bạn ngay khi hệ thống xử lý xong yêu cầu';
                            $image = '';

                            sendMessZalo($id_oa, $app_id, $user_id_zalo, $text, $image);

                            return ['code'=>0, 'mess'=>'Gửi link thành công'];
                        }
                    }

                    echo '<h1>Vui lòng đóng cửa sổ trình duyệt và quay lại khung chat</h1>';die;
                }


                setVariable('linkQR', $linkQR);
                setVariable('infoFull', $infoFull);
            }else{
                // tạo link thanh toán
                $linkQR = 'https://img.vietqr.io/image/TPB-'.$bank_number.'-compact2.png?amount='.$price_full.'&addInfo='.$checkDataExits->id.'%20'.$key_banking.'&accountName='.$bank_name;

                // gửi tin nhắn Messenger
                if(!empty($dataSend['idMessenger'])){
                    if(!empty($idBot)
                        && !empty($tokenBot)
                        && !empty($idBlockConfirm)
                    ) {
                        $attributesSmax = [];
                        $attributesSmax['linkQRBankingMMTC']= $linkQR;
                        //$attributesSmax['linkAffMMTC']= 'https://matmathanhcong.vn/?aff='.$data->phone;
                        $attributesSmax['linkAffMMTC']= 'https://m.me/100405719654447?ref=Dang-ky-Mat-ma-thanh-cong-affiliate.'.$checkDataExits->phone;
                        $attributesSmax['phone']= $checkDataExits->phone;
                        
                        $urlSmax= 'https://api.smax.bot/bots/'.$idBot.'/users/'.$dataSend['idMessenger'].'/send?bot_token='.$tokenBot.'&block_id='.$idBlockConfirm.'&messaging_tag="CONFIRMED_EVENT_UPDATE"';
                        
                        $returnSmax= sendDataConnectMantan($urlSmax, $attributesSmax);
                    }

                    // gửi tin nhắn chatbot Zalo
                    if(!empty($dataSend['chatbot']) && $dataSend['chatbot'] == 'zalo'){
                        if(function_exists('sendMessZalo')){
                            $id_oa = '';
                            $app_id = '';
                            $user_id_zalo = $dataSend['idMessenger'];
                            $text = 'Link tải bản đầy đủ Mật Mã Thành Công của '.$dataSend['customer_name'].': '.$checkDataExits->link_download;
                            $image = '';

                            sendMessZalo($id_oa, $app_id, $user_id_zalo, $text, $image);
                        }

                        return ['code'=>1];
                    }

                    echo '<h1>Vui lòng đóng cửa sổ trình duyệt và quay lại khung chat</h1>';die;
                }

                setVariable('linkQR', $linkQR);
                setVariable('infoFull', $checkDataExits->link_download);
            }

            $data_value = [];
            $conditions = array('key_word' => 'settingMMTCAPI');
            $settingMMTCAPI = $modelOptions->find()->where($conditions)->first();
            if(!empty($settingMMTCAPI->value)){
                $data_value = json_decode($settingMMTCAPI->value, true);
            }

            setVariable('settingMMTCAPI', $data_value);
        }else{
            if(!empty($dataSend['idMessenger'])){
                return ['code'=>2, 'mess'=>'Gửi thiếu dữ liệu'];
            }

            return $controller->redirect('/?error=empty');
        }
    }else{
        if(!empty($dataSend['idMessenger'])){
            return ['code'=>2, 'mess'=>'Gửi sai định dạng POST'];
        }

        return $controller->redirect('/?error=empty');
    }
}

function callbackBanking($input)
{
    global $modelOptions;
    global $key_banking;
    global $price_full;

    $return['messages']= array(array('text'=>''));

    if(!empty($_POST['message'])){

        $keyApp= strtoupper($key_banking);

        $message = strtoupper($_POST['message']);

        $description = explode('ND: ', $message);
        $description = trim($description[1]);
        $description = str_replace(array('IBFT ','THANH TOAN QR ','QR - '), '', $description);

        $money = explode('PS:+', $message);
        $money = explode('SD:', $money[1]);
        $money = (int) str_replace(array('.','VND'), '', $money[0]);

        if($money>0 && strlen(strstr($description, $keyApp)) > 0){
            // xóa dấu chấm
            $removeDot = explode('.', $description);
            if(count($removeDot)>1){
                for($i=0;$i<count($removeDot);$i++){
                    if(strlen(strstr($removeDot[$i], $keyApp)) > 0){
                        $description = $removeDot[$i];
                        break;
                    }
                }
            }

            // xóa dấu chấm phẩy
            $removeDot = explode(';', $description);
            if(count($removeDot)>1){
                for($i=0;$i<count($removeDot);$i++){
                    if(strlen(strstr($removeDot[$i], $keyApp)) > 0){
                        $description = $removeDot[$i];
                        break;
                    }
                }
            }

            // xóa dấu gạch ngang
            $removeDot = explode('-', $description);
            if(count($removeDot)>1){
                for($i=0;$i<count($removeDot);$i++){
                    if(strlen(strstr($removeDot[$i], $keyApp)) > 0){
                        $description = $removeDot[$i];
                        break;
                    }
                }
            }


            $removeSpace = explode(' ', trim($description));
            $order_id = $removeSpace[0];

            if($money >= $price_full){
                process_send_link($order_id);

                $return['messages']= array(array('text'=>'Gửi link thành công'));
            }else{
                $return['messages']= array(array('text'=>'Chuyển thiếu tiền'));
            }
            
        } else {
            $return['messages']= array(array('text'=>'Sai cú pháp hoặc số tiền không đủ'));
        }
        
    }else{
        $return['messages']= array(array('text'=>'Gửi thiếu nội dung SMS'));
    }

    return $return;
}
?>