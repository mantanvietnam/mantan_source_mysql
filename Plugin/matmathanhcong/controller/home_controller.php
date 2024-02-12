<?php
function result($input)
{
    global $controller;
    global $isRequestPost;

    
    $dataSend = $_GET;

    if(!empty($dataSend['name']) && !empty($dataSend['day']) && !empty($dataSend['month']) && !empty($dataSend['year'])){
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

    $modelRequestExports = $controller->loadModel('RequestExports');

    if($isRequestPost){
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['customer_name']) && !empty($dataSend['customer_birthdate']) && !empty($dataSend['customer_phone']) && !empty($dataSend['customer_email']) && !empty($dataSend['customer_address'])){
            // chuẩn hóa dữ liệu
            $dataSend['customer_birthdate'] = str_replace(array('.','-',',',' '), '/', $dataSend['customer_birthdate']);
            $dataSend['customer_phone']= str_replace(array(' ','.','-'), '', @$dataSend['customer_phone']);
            $dataSend['customer_phone'] = str_replace('+84','0',$dataSend['customer_phone']);

            // kiểm tra đã đăng ký chưa
            $checkDataExits = $modelRequestExports->find()->where(['phone'=>$dataSend['customer_phone']])->first();

            if(empty($checkDataExits)){
                $data = $modelRequestExports->newEmptyEntity();

                if(isset($_FILES['avatar']) && empty($_FILES['avatar']["error"])){
                    $avatar = uploadImage(1, 'avatar');

                    if(!empty($avatar['linkOnline'])){
                        // lấy link tải bản full
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

                        // lưu database
                        $data->avatar = $avatar['linkOnline'];
                        $data->name = $dataSend['customer_name'];
                        $data->birthday = $dataSend['customer_birthdate'];
                        $data->phone = $dataSend['customer_phone'];
                        $data->email = $dataSend['customer_email'];
                        $data->address = $dataSend['customer_address'];
                        $data->idMessenger = @$dataSend['idMessenger'];
                        $data->affiliate_phone = (!empty($session->read('aff')) && $session->read('aff')!=$dataSend['customer_phone'])?$session->read('aff'):'';
                        $data->link_download = @$infoFull['Result'];
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

                            echo '<h1>Vui lòng đóng cửa sổ trình duyệt và quay lại khung chat</h1>';die;
                        }

                        setVariable('linkQR', $linkQR);
                    }else{
                        return $controller->redirect('/?error=uploadAvatarFail');
                    }
                }else{
                    return $controller->redirect('/?error=emptyAvatar');
                }
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

                    echo '<h1>Vui lòng đóng cửa sổ trình duyệt và quay lại khung chat</h1>';die;
                }
            }
        }else{
            return $controller->redirect('/?error=empty');
        }
    }else{
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