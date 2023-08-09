<?php 



$menus= array();
$menus[0]['title']= 'Exc-go';

$menus[1]['sub'][0]= array('title'=>'Thông tin thành viên',
                            'url'=>'/plugins/admin/exc_go-view-admin-member-listMemberAdmin.php',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'listMemberAdmin',
                        );

$menus[2]['sub'][0]= array('title'=>'Thông tin xe',
                            'url'=>'/plugins/admin/exc_go-view-admin-car-listCarAdmin.php',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'listCarAdmin',
                        );

addMenuAdminMantan($menus);

$keyFirebase = 'AAAAlFXHK5c:APA91bGHAy5l3EfnEkWqG5GppbxbPEhs8WH-JRkiUu2YNqrUEExLJSZ8FouSG9XCCSTOns3wcNAxS42YQ1GPL5iRB1hKVstExY2J5_z9k1eIVZEsnPm3XNXTaJwwqfUol9ujxCLoB5_8';

global $typeCar;

$typeCar = ['4'=>'Xe 4 chỗ',
            '5'=>'Xe 5 chỗ',
            '7'=>'Xe 7 chỗ',
            '9'=>'Xe 9 chỗ',
            '16'=>'Xe 16 chỗ',
            '29'=>'Xe 29 chỗ',
            '32'=>'Xe  32 chỗ',
            '96'=>'Xe 96 chỗ',
            '45'=>'Xe 45 chỗ',
            '55'=>'Xe 55 chỗ',
            '65'=>'Xe 65 chỗ',
            ];

function createToken($length=30)
{
    $chars = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    return substr(str_shuffle($chars), 0, $length).time();
}



function sendEmailCodeForgotPassword($email='', $fullName='', $code= '')
{
    $to = array();

    if(!empty($email)){
        $to[]= trim($email);
    
        $cc = array();
        $bcc = array();
        $subject = 'Mã xác thực cấp lại mật khẩu mới';

        $content='<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Mã xác thực cấp lại mật khẩu mới</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css">
            <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
            <style>
                .bao{background: #fafafa;margin: 40px;padding: 20px 20px 40px;}
                .logo{

                }
                .logo img{height: 115px;margin:  0 auto;display:  block;margin-bottom: 15px;}
                .nd{background: white;max-width: 750px;margin: 0 auto;border-radius: 12px;overflow:  hidden;border: 2px solid #e6e2e2;line-height: 2;}
                .head{background: #3fb901; color:white;text-align: center;padding: 15px 10px;font-size: 17px;text-transform: uppercase;}
                .main{padding: 10px 20px;}
                .thong_tin{padding: 0 20px 20px;}
                .line{position: relative;height: 2px;}
                .line1{position: absolute;top: 0;left: 0;width: 100%;height: 100%;background-image: linear-gradient(to right, transparent 50%, #737373 50%);background-size: 26px 100%;}
                .cty{text-align:  center;margin: 20px 0 30px;}
                .main .fa{color:green;}
                table{margin:auto;}
                @media screen and (max-width: 768px){
                    .bao{margin:0;}
                }
                @media screen and (max-width: 767px){
                    .bao{padding:6px; }
                    .nd{text-align: inherit;}
                }
            </style>
        </head>
        <body>
            <div class="bao">
                <div class="nd">
                    <div class="head">
                        <span>MÃ XÁC THỰC</span>
                    </div>
                    <div class="main">
                        <em style="    margin: 10px 0 10px;display: inline-block;">Xin chào '.$fullName.' !</em> <br>
                        <br/>
                        Mã xác thực cấp lại mật khẩu mới của bạn là: <b>'.$code.'</b>
                        
                        <br><br>
                        
                        Trân trọng ./
                    </div>
                    <div class="thong_tin">
                        <div class="line"><div class="line1"></div></div>
                        <div class="cty">
                            <span style="font-weight: bold;">CÔNG TY TNHH GIẢI PHÁP SỐ TOP TOP</span> <br>
                            <span>Ứng dụng thiết kế hình ảnh Ezpics</span>
                        </div>
                        <ul class="list-unstyled" style="    font-size: 15px;">
                            <li>Hỗ trợ: Vũ Tuyên Hoàng</li>
                            <li>Mobile: 0828266622</li>
                            <li>Website: <a href="https://ezpics.vn">https://ezpics.vn</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </body>
        </html>';

        sendEmail($to, $cc, $bcc, $subject, $content);
    }
}

function listBank()
{
    return [
            ['id'=>1, 'name'=>'An Bình', 'code'=>'ABBANK'],
            ['id'=>2, 'name'=>'ANZ Việt Nam', 'code'=>'ANZVL'],
            ['id'=>3, 'name'=>'Á Châu', 'code'=>'ACB'],
            ['id'=>4, 'name'=>'Bắc Á', 'code'=>'Bac A Bank'],
            ['id'=>5, 'name'=>'Bản Việt', 'code'=>'Viet Capital Bank'],
            ['id'=>6, 'name'=>'Bảo Việt', 'code'=>'BAOVIET Bank'],
            ['id'=>7, 'name'=>'Bưu điện Liên Việt', 'code'=>'LienVietPostBank'],
            ['id'=>8, 'name'=>'Chính sách xã hội Việt Nam', 'code'=>'VBSP'],
            ['id'=>9, 'name'=>'CIMB Việt Nam', 'code'=>'CIMB'],
            ['id'=>10, 'name'=>'Công thương Việt Nam', 'code'=>'VietinBank'],
            ['id'=>11, 'name'=>'Dầu khí toàn cầu', 'code'=>'GPBank'],
            ['id'=>12, 'name'=>'Đại Chúng Việt Nam', 'code'=>'PVcomBank'],
            ['id'=>13, 'name'=>'Đại Dương', 'code'=>'OceanBank'],
            ['id'=>14, 'name'=>'Đầu tư và Phát triển Việt Nam', 'code'=>'BIDV'],
            ['id'=>15, 'name'=>'Đông Á', 'code'=>'DongA Bank'],
            ['id'=>16, 'name'=>'Đông Nam Á', 'code'=>'SeABank'],
            ['id'=>17, 'name'=>'Hàng Hải', 'code'=>'MSB'],
            ['id'=>18, 'name'=>'Hong Leong Việt Nam', 'code'=>'HLBVN'],
            ['id'=>19, 'name'=>'Hợp tác xã Việt Nam', 'code'=>'Co-opBank'],
            ['id'=>20, 'name'=>'HSBC Việt Nam', 'code'=>'HSBC'],
            ['id'=>21, 'name'=>'Indovina', 'code'=>'IVB'],
            ['id'=>22, 'name'=>'Kiên Long', 'code'=>'Kienlongbank'],
            ['id'=>23, 'name'=>'Kỹ Thương', 'code'=>'Techcombank'],
            ['id'=>24, 'name'=>'Liên doanh Việt Nga', 'code'=>'VRB'],
            ['id'=>25, 'name'=>'Nam Á', 'code'=>'Nam A Bank'],
            ['id'=>26, 'name'=>'Ngoại Thương Việt Nam', 'code'=>'Vietcombank'],
            ['id'=>27, 'name'=>'NN&PT Nông thôn Việt Nam', 'code'=>'Agribank'],
            ['id'=>28, 'name'=>'Phát triển Thành phố Hồ Chí Minh', 'code'=>'HDBank'],
            ['id'=>29, 'name'=>'Phát triển Việt Nam', 'code'=>'VDB'],
            ['id'=>30, 'name'=>'Phương Đông', 'code'=>'OCB'],
            ['id'=>31, 'name'=>'Public Bank Việt Nam', 'code'=>'PBVN'],
            ['id'=>32, 'name'=>'Quân Đội', 'code'=>'MB'],
            ['id'=>33, 'name'=>'Quốc dân', 'code'=>'NCB'],
            ['id'=>34, 'name'=>'Quốc Tế', 'code'=>'VIB'],
            ['id'=>35, 'name'=>'Sài Gòn', 'code'=>'SCB'],
            ['id'=>36, 'name'=>'Sài Gòn – Hà Nội', 'code'=>'SHB'],
            ['id'=>37, 'name'=>'Sài Gòn Công Thương', 'code'=>'SAIGONBANK'],
            ['id'=>38, 'name'=>'Sài Gòn Thương Tín', 'code'=>'Sacombank'],
            ['id'=>39, 'name'=>'Shinhan Việt Nam', 'code'=>'SHBVN'],
            ['id'=>40, 'name'=>'Standard Chartered Việt Nam', 'code'=>'SCBVL'],
            ['id'=>41, 'name'=>'Tiên Phong', 'code'=>'TPBank'],
            ['id'=>42, 'name'=>'UOB Việt Nam', 'code'=>'UOB'],
            ['id'=>43, 'name'=>'Việt Á', 'code'=>'VietABank'],
            ['id'=>44, 'name'=>'Việt Nam Thịnh Vượng', 'code'=>'VPBank'],
            ['id'=>45, 'name'=>'Việt Nam Thương Tín', 'code'=>'Vietbank'],
            ['id'=>46, 'name'=>'Woori Việt Nam', 'code'=>'Woori'],
            ['id'=>47, 'name'=>'Xăng dầu Petrolimex', 'code'=>'PG Bank'],
            ['id'=>48, 'name'=>'Xây dựng', 'code'=>'CB'],
            ['id'=>49, 'name'=>'Xuất Nhập Khẩu', 'code'=>'Eximbank'],
            
            ];
}

function sendNotification($data,$target){
    global $keyFirebase;
    $url = 'https://fcm.googleapis.com/fcm/send';

    $fields = array();
    
    $fields['data'] = $data;
    $fields['priority'] = 'high';
    $fields['content_available'] = true;

    $fields['notification'] = ['title'=>$data['title'], 'body'=>$data['content']];
    
    if(is_array($target)){
        $fields['registration_ids'] = $target;
    }else{
        $fields['to'] = $target;
    }

    $headers = array(
        'Content-Type:application/json',
        'Authorization:key='.$keyFirebase
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
    if ($result === FALSE) {

    }
    curl_close($ch);

    return $result;
}

function getListCity()
{
    return array(   
        '1'=>array('id'=>1,'name'=>'Hà Nội','gps'=>'21.025905,105.846576','bsx'=>array(29,30,31,32,33)),
        '2'=>array('id'=>2,'name'=>'TP Hồ Chí Minh','gps'=>'10.820645,106.632518','bsx'=>array(50,51,52,53,54,55,56,57,58,59)),
        '3'=>array('id'=>3,'name'=>'Đà Nẵng','gps'=>'16.053866,108.203836','bsx'=>array(43)),
        '4'=>array('id'=>4,'name'=>'Hải Phòng','gps'=>'20.843685,106.694454','bsx'=>array(15,16)),
        '5'=>array('id'=>5,'name'=>'Cần Thơ','gps'=>'10.044264,105.748773','bsx'=>array(65)),
        '6'=>array('id'=>6,'name'=>'An Giang','gps'=>'10.503183,105.119829','bsx'=>array(67)),
        '7'=>array('id'=>7,'name'=>'Bà Rịa - Vũng Tàu','gps'=>'10.563561,107.276515','bsx'=>array(72)),
        '8'=>array('id'=>8,'name'=>'Bắc Giang','gps'=>'21.362262,106.176664','bsx'=>array(13,98)),
        '9'=>array('id'=>9,'name'=>'Bắc Kạn','gps'=>'22.240912,105.819391','bsx'=>array(97)),
        '10'=>array('id'=>10,'name'=>'Bạc Liêu','gps'=>'9.291818,105.467610','bsx'=>array(94)),
        '11'=>array('id'=>11,'name'=>'Bắc Ninh','gps'=>'21.136271,106.083659','bsx'=>array(99)),
        '12'=>array('id'=>12,'name'=>'Bến Tre','gps'=>'10.137806,106.565089','bsx'=>array(71)),
        '13'=>array('id'=>13,'name'=>'Bình Định','gps'=>'14.169255,108.899803','bsx'=>array(77)),
        '14'=>array('id'=>14,'name'=>'Bình Dương','gps'=>'11.207645,106.578304','bsx'=>array(61)),
        '15'=>array('id'=>15,'name'=>'Bình Phước','gps'=>'11.680601,106.825329','bsx'=>array(93)),
        '16'=>array('id'=>16,'name'=>'Bình Thuận','gps'=>'10.947979,107.826546','bsx'=>array(86)),
        '17'=>array('id'=>17,'name'=>'Cà Mau','gps'=>'8.820449,105.084218','bsx'=>array(69)),
        '18'=>array('id'=>18,'name'=>'Cao Bằng','gps'=>'22.803639,105.711757','bsx'=>array(11)),
        '19'=>array('id'=>19,'name'=>'Đắk Lắk','gps'=>'12.865012,108.003386','bsx'=>array(47)),
        '20'=>array('id'=>20,'name'=>'Đắk Nông','gps'=>'12.107715,107.830821','bsx'=>array(48)),
        '21'=>array('id'=>21,'name'=>'Điện Biên','gps'=>'21.752904,103.101496','bsx'=>array(27)),
        '22'=>array('id'=>22,'name'=>'Đồng Nai','gps'=>'10.714318,107.005192','bsx'=>array(60)),
        '23'=>array('id'=>23,'name'=>'Đồng Tháp','gps'=>'10.581382,105.688341','bsx'=>array(66)),
        '24'=>array('id'=>24,'name'=>'Gia Lai','gps'=>'13.870961,108.282026','bsx'=>array(81)),
        '25'=>array('id'=>25,'name'=>'Hà Giang','gps'=>'22.522165,104.765151','bsx'=>array(23)),
        '26'=>array('id'=>26,'name'=>'Hà Nam','gps'=>'20.447984,105.919875','bsx'=>array(90)),
        '27'=>array('id'=>27,'name'=>'Hà Tĩnh','gps'=>'18.264984,105.696628','bsx'=>array(38)),
        '28'=>array('id'=>28,'name'=>'Hải Dương','gps'=>'20.781788,106.289502','bsx'=>array(34)),
        '29'=>array('id'=>29,'name'=>'Hậu Giang','gps'=>'9.790570,105.576663','bsx'=>array(95)),
        '30'=>array('id'=>30,'name'=>'Hòa Bình','gps'=>'20.730707,105.474031','bsx'=>array(28)),
        '31'=>array('id'=>31,'name'=>'Hưng Yên','gps'=>'20.833808,106.010205','bsx'=>array(89)),
        '32'=>array('id'=>32,'name'=>'Khánh Hòa','gps'=>'12.307491,108.871089','bsx'=>array(79)),
        '33'=>array('id'=>33,'name'=>'Kiên Giang','gps'=>'10.009664,105.197401','bsx'=>array(68)),
        '34'=>array('id'=>34,'name'=>'Kon Tum','gps'=>'14.313554,107.920630','bsx'=>array(82)),
        '35'=>array('id'=>35,'name'=>'Lai Châu','gps'=>'22.324320,102.843735','bsx'=>array(25)),
        '36'=>array('id'=>36,'name'=>'Lâm Đồng','gps'=>'11.641015,107.497746','bsx'=>array(49)),
        '37'=>array('id'=>37,'name'=>'Lạng Sơn','gps'=>'21.820741,106.547897','bsx'=>array(12)),
        '38'=>array('id'=>38,'name'=>'Lào Cai','gps'=>'22.513893,103.856868','bsx'=>array(24)),
        '39'=>array('id'=>39,'name'=>'Long An','gps'=>'10.695005,105.960820','bsx'=>array(62)),
        '40'=>array('id'=>40,'name'=>'Nam Định','gps'=>'20.413892,106.162605','bsx'=>array(18)),
        '41'=>array('id'=>41,'name'=>'Nghệ An','gps'=>'19.395257,104.889498','bsx'=>array(37)),
        '42'=>array('id'=>42,'name'=>'Ninh Bình','gps'=>'20.247371,105.970816','bsx'=>array(35)),
        '43'=>array('id'=>43,'name'=>'Ninh Thuận','gps'=>'11.708233,108.886415','bsx'=>array(85)),
        '44'=>array('id'=>44,'name'=>'Phú Thọ','gps'=>'21.307744,105.125561','bsx'=>array(19)),
        '45'=>array('id'=>45,'name'=>'Quảng Bình','gps'=>'17.650996,106.225225','bsx'=>array(73)),
        '46'=>array('id'=>46,'name'=>'Quảng Nam','gps'=>'15.582603,107.985250','bsx'=>array(92)),
        '47'=>array('id'=>47,'name'=>'Quảng Ngãi','gps'=>'15.033132,108.631560','bsx'=>array(76)),
        '48'=>array('id'=>48,'name'=>'Quảng Ninh','gps'=>'21.151562,107.203928','bsx'=>array(14)),
        '49'=>array('id'=>49,'name'=>'Quảng Trị','gps'=>'16.725876,107.103291','bsx'=>array(74)),
        '50'=>array('id'=>50,'name'=>'Sóc Trăng','gps'=>'9.605473,105.973519','bsx'=>array(83)),
        '51'=>array('id'=>51,'name'=>'Sơn La','gps'=>'9.600734,105.978154','bsx'=>array(26)),
        '52'=>array('id'=>52,'name'=>'Tây Ninh','gps'=>'11.357658,106.130780','bsx'=>array(70)),
        '53'=>array('id'=>53,'name'=>'Thái Bình','gps'=>'20.506917,106.374343','bsx'=>array(17)),
        '54'=>array('id'=>54,'name'=>'Thái Nguyên','gps'=>'21.587135,105.824038','bsx'=>array(20)),
        '55'=>array('id'=>55,'name'=>'Thanh Hóa','gps'=>'20.091208,105.301704','bsx'=>array(36)),
        '56'=>array('id'=>56,'name'=>'Thừa Thiên Huế','gps'=>'16.344361,107.581729','bsx'=>array(75)),
        '57'=>array('id'=>57,'name'=>'Tiền Giang','gps'=>'10.438860,106.253686','bsx'=>array(63)),
        '58'=>array('id'=>58,'name'=>'Trà Vinh','gps'=>'9.934929,106.336861','bsx'=>array(84)),
        '59'=>array('id'=>59,'name'=>'Tuyên Quang','gps'=>'22.058060,105.244858','bsx'=>array(22)),
        '60'=>array('id'=>60,'name'=>'Vĩnh Long','gps'=>'10.244966,105.958561','bsx'=>array(64)),
        '61'=>array('id'=>61,'name'=>'Vĩnh Phúc','gps'=>'21.301371,105.591167','bsx'=>array(88)),
        '62'=>array('id'=>62,'name'=>'Yên Bái','gps'=>'21.718615,104.929472','bsx'=>array(21)),
        '63'=>array('id'=>63,'name'=>'Phú Yên','gps'=>'13.096341,109.292911','bsx'=>array(78)),

    );
}

?>