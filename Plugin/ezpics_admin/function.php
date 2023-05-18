<?php 
global $keyFirebase;

$keyFirebase = 'AAAAlFXHK5c:APA91bGHAy5l3EfnEkWqG5GppbxbPEhs8WH-JRkiUu2YNqrUEExLJSZ8FouSG9XCCSTOns3wcNAxS42YQ1GPL5iRB1hKVstExY2J5_z9k1eIVZEsnPm3XNXTaJwwqfUol9ujxCLoB5_8';

$menus= array();
$menus[0]['title']= 'Ezpics';
$menus[0]['sub'][0]= array( 'title'=>'Người dùng',
                            'url'=>'/plugins/admin/ezpics_admin-view-admin-member-listMemberAdmin.php',
                            'classIcon'=>'bx bx-user',
                            'permission'=>'listMemberAdmin'
                        );

$menus[0]['sub'][1]= array( 'title'=>'Mẫu thiết kế',
                            'url'=>'/plugins/admin/ezpics_admin-view-admin-product-listProductAdmin.php',
                            'classIcon'=>'bx bx-paint',
                            'permission'=>'listProductAdmin'
                        );


$menus[0]['sub'][2]= array('title'=>'Giao dịch',
                            'url'=>'/',
                            'classIcon'=>'bx bx-history',
                            'permission'=>'transactionHistoryEzpics',
                            'sub'=> array(array('title'=>'Nạp tiền',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-transaction-listTransactionHistoryBankingEzpics.php',
                                                'classIcon'=>'bx bx-history',
                                                'permission'=>'listTransactionHistoryBankingEzpics',
                                            ),
                                            array('title'=>'Rút tiền',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-transaction-listTransactionHistoryWithdrawMoneyEzpics.php',
                                                'classIcon'=>'bx bx-history',
                                                'permission'=>'listTransactionHistoryWithdrawMoneyEzpics',
                                            ),
                                            array('title'=>'Bán mẫu thiết kế',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-transaction-listTransactionHistorySellingDesignsEzpics.php',
                                                'classIcon'=>'bx bx-history',
                                                'permission'=>'listTransactionHistorySellingDesignsEzpics',
                                            ),
                                            array('title'=>'Mua mẫu thiết kế',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-transaction-listTransactionHistoryBuyProductEzpics.php',
                                                'classIcon'=>'bx bx-history',
                                                'permission'=>'listTransactionHistoryBuyProductEzpics',
                                            ),
                                             array('title'=>'Chiết khấu mẫu thiết kế',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-transaction-listTransactionHistoryDiscountProductEzpics.php',
                                                'classIcon'=>'bx bx-history',
                                                'permission'=>'listTransactionHistoryDiscountProductEzpics',
                                            ),
                                            array('title'=>'Xóa ảnh nền',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-transaction-listTransactionHistoryRemoveImageEzpics.php',
                                                'classIcon'=>'bx bx-history',
                                                'permission'=>'listTransactionHistoryRemoveImageEzpics',
                                            ),
                                        
                                    )
                        );

$menus[0]['sub'][3]= array( 'title'=>'Thông báo',
                            'url'=>'/',
                            'classIcon'=>'bx bx-bell',
                            'permission'=>'addNotificationAdmin',
                            'sub'=> array(array('title'=>'Thông báo chung',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-notification-addNotificationAdmin.php',
                                                'classIcon'=>'bx bx-history',
                                                'permission'=>'addNotificationAdmin',
                                            ),
                                        array('title'=>'Thông báo tin tức mới ',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-notification-addNotificationPostNewAdmin.php',
                                                'classIcon'=>'bx bx-history',
                                                'permission'=>'addNotificationPostNewAdmin',
                                            ),
                                        array('title'=>'Thông báo sản phẩn mới ',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-notification-addNotificationProductNewAdmin.php',
                                                'classIcon'=>'bx bx-history',
                                                'permission'=>'addNotificationProductNewAdmin',
                                            ),
                                )
                        );

$menus[0]['sub'][4]= array('title'=>'Liên hệ',
                            'url'=>'/',
                            'classIcon'=>'bx bxs-contact',
                            'permission'=>'settingsEzpics',
                            'sub'=> array(array('title'=>'Thông tin đăng kí design',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-contact-listDesignRegistrationAdmin.php',
                                                'classIcon'=>'bx bx-category',
                                                'permission'=>'listDesignRegistrationAdmin',
                                            ),
                                        array('title'=>'Order mẫu thiết kế',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-contact-listOrderProductAdmin.php',
                                                'classIcon'=>'bx bx-category',
                                                'permission'=>'listOrderProductAdmin',
                                            ),
                                        array('title'=>'Báo xấu mẫu thiết kế',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-contact-listBaddesignAdmin.php',
                                                'classIcon'=>'bx bx-category',
                                                'permission'=>'listBaddesignAdmin',
                                            ),
                                    )
                        );

$menus[0]['sub'][5]= array('title'=>'Top designer',
                            'url'=>'/',
                            'classIcon'=>'bx bx-filter-alt',
                            'permission'=>'topDesigner',
                            'sub'=> array(array('title'=>'Bán được nhiều mẫu nhất',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-topDesigner-listSellTopDesignerAdmin.php',
                                                'classIcon'=>'bx bx-category',
                                                'permission'=>'listSellTopDesignerAdmin',
                                            ),
                                        array('title'=>'Thu nhập cao nhất',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-topDesigner-listIncomeTopDesignerAdmin.php',
                                                'classIcon'=>'bx bx-category',
                                                'permission'=>'listIncomeTopDesignerAdmin',
                                            ),
                                        array('title'=>'Tạo được nhiều mẫu nhất',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-topDesigner-listCreateTopDesignerAdmin.php',
                                                'classIcon'=>'bx bx-category',
                                                'permission'=>'listCreateTopDesignerAdmin',
                                            ),
                                    )
                        );

$menus[0]['sub'][6]= array('title'=>'Cài đặt',
                            'url'=>'/',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settingsEzpics',
                            'sub'=> array(array('title'=>'Danh mục thiết kế',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-category-listCategoryEzpics.php',
                                                'classIcon'=>'bx bx-category',
                                                'permission'=>'listCategoryEzpics',
                                            ),
                                    )
                        );




addMenuAdminMantan($menus);

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

function getMember($id){
    global $modelOption;
    global $controller;
    $modelMembers = $controller->loadModel('Members');
        $data = $modelMembers->find()->where(['id'=>intval($id)])->first();       
        return $data;
}

function sendEmailsuccessfulDesigner($email='', $fullName='')
{
    $to = array();

    if(!empty($email)){
        $to[]= trim($email);
    
        $cc = array();
        $bcc = array();
        $subject = '[Ezpics] ' . 'Tài khoản của bạn đã trở thành Designer';

        $content ='<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Thông tin nạp tiền Ezpics</title>
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
                        <span>Chúc mừng bạn trở thành Designer của Ezpics</span>
                    </div>
                    <div class="main">
                        <em style="    margin: 10px 0 10px;display: inline-block;">Xin chào '.$fullName.' !</em> <br>
                        <br/>
                         bạn trở thành Designer của Ezpics thành công</b>
                        
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

        debug($to);
        debug(@$cc);
        debug(@$bcc);
        debug(@$subject);
        debug(@$content);
        die;
       // sendEmail(@$to, @$cc, @$bcc, @$subject, @$content);
    }
}

function sendEmailunsuccessfuldesigner($email='', $fullName='', $content='')
{
    $to = array();

    if(!empty($email)){
        $to[]= trim($email);
    
        $cc = array();
        $bcc = array();
        $subject = '[Ezpics] ' . 'Đơn đăng ký designer không được phê duyệt ';

        $content='<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Thông tin nạp tiền Ezpics</title>
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
                        <span>Đơn đăng ký designer không được phê duyệt </span>
                    </div>
                    <div class="main">
                        <em style="    margin: 10px 0 10px;display: inline-block;">Xin chào '.$fullName.' !</em> <br>
                        <br/>
                        Chúng tôi rất tiếc phải thông báo rằng đơn đăng ký designer của bạn đã bị từ chối.
                        <br/>
                        Lý do từ chối:: '.$content.'</b>
                        
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

function levelmembers(){
    return array('1'=>array('id'=>'1','name'=>'Stone Age', 'note'=>'đạt mốc 10 mẫu thiết kế', 'numberProductMin'=>10,'commission'=>''),
        '2'=>array('id'=>'2','name'=>'Bronze Age', 'note'=>'đạt mốc 30 mẫu thiết kế', 'numberProductMin'=>30,'commission'=>''),
        '3'=>array('id'=>'3','name'=>'Iron Age', 'note'=>'đạt mốc 50 mẫu thiết kế', 'numberProductMin'=>50,'commission'=>''),
        '4'=>array('id'=>'4','name'=>'Ancient Era', 'note'=>'đạt mốc 100 mẫu thiết kế', 'numberProductMin'=>100,'commission'=>''),
        '5'=>array('id'=>'5','name'=>'Medieval Era', 'note'=>'đạt mốc 300 mẫu thiết kế', 'numberProductMin'=>300,'commission'=>''),
        '6'=>array('id'=>'6','name'=>'Enlightenment Era', 'note'=>'đạt mốc 500 mẫu thiết kế', 'numberProductMin'=>500,'commission'=>''),
        '7'=>array('id'=>'7','name'=>'Industrial Era', 'note'=>'đạt mốc 1.000 mẫu thiết kế', 'numberProductMin'=>1000,'commission'=>''),
        '8'=>array('id'=>'8','name'=>'Modern Era', 'note'=>'đạt mốc 3.000 mẫu thiết kế', 'numberProductMin'=>3000,'commission'=>''),
        '9'=>array('id'=>'9','name'=>'Digital Era', 'note'=>'đạt mốc 5.000 mẫu thiết kế', 'numberProductMin'=>5000,'commission'=>''),
        '10'=>array('id'=>'10','name'=>'Innovation Era', 'note'=>'đạt mốc 10.000 mẫu thiết kế', 'numberProductMin'=>10000,'commission'=>''),
    );
}

?>

 
