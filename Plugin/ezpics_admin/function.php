<?php
use Google\Auth\Credentials\ServiceAccountCredentials;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Exception\RequestException;

global $keyFirebase;
global $urlCreateImage;
global $projectId;

$urlCreateImage = 'http://172.16.33.6:3000/convert';

$keyFirebase = 'AAAAlFXHK5c:APA91bGHAy5l3EfnEkWqG5GppbxbPEhs8WH-JRkiUu2YNqrUEExLJSZ8FouSG9XCCSTOns3wcNAxS42YQ1GPL5iRB1hKVstExY2J5_z9k1eIVZEsnPm3XNXTaJwwqfUol9ujxCLoB5_8';
$projectId = 'ezpics-91e75';

$menus= array();
$menus[0]['title']= 'Ezpics';
$menus[0]['sub'][0]= array( 'title'=>'Người dùng',
                            'url'=>'/plugins/admin/ezpics_admin-view-admin-member-listMemberAdmin',
                            'classIcon'=>'bx bx-user',
                            'permission'=>'listMemberAdmin'
                        );
$menus[0]['sub'][]= array( 'title'=>'Người dùng sắp hết hạn Pro',
                            'url'=>'/plugins/admin/ezpics_admin-view-admin-member-listMemberDeadlineProAdmin',
                            'classIcon'=>'bx bx-user',
                            'permission'=>'listMemberDeadlineProAdmin'
                        );

$menus[0]['sub'][]= array( 'title'=>'Mẫu thiết kế',
                            'url'=>'/plugins/admin/ezpics_admin-view-admin-product-listProductAdmin',
                            'classIcon'=>'bx bx-paint',
                            'permission'=>'listProductAdmin'
                        );
$menus[0]['sub'][]= array( 'title'=>'Mẫu thiết kế xu hướng',
                            'url'=>'/plugins/admin/ezpics_admin-view-admin-product-listProductTrendAdmin',
                            'classIcon'=>'bx bx-paint',
                            'permission'=>'listProductTrendAdmin'
                        );
$menus[0]['sub'][]= array( 'title'=>' Chuyển mẫu thiết kế cho Designer khác',
                            'url'=>'/plugins/admin/ezpics_admin-view-admin-member-transferManagerAdmin',
                            'classIcon'=>'bx bx-transfer',
                            'permission'=>'transferManagerAdmin'
                        );

$menus[0]['sub'][]= array( 'title'=>'Mẫu chữ',
                            'url'=>'/plugins/admin/ezpics_admin-view-admin-styleText-listStyleTextAdmin',
                            'classIcon'=>'bx bxs-cylinder',
                            'permission'=>'listStyleTextAdmin'
                        );

$menus[0]['sub'][]= array( 'title'=>'Kho mẫu thiết kế',
                            'url'=>'/plugins/admin/ezpics_admin-view-admin-warehouse-listWarehouseAdmin',
                            'classIcon'=>'bx bxs-cylinder',
                            'permission'=>'listWarehouseAdmin'
                        );
$menus[0]['sub'][]= array( 'title'=>'Kho mẫu thiết kế xu hướng',
                            'url'=>'/plugins/admin/ezpics_admin-view-admin-warehouse-listWarehouseTrendAdmin',
                            'classIcon'=>'bx bxs-cylinder',
                            'permission'=>'listWarehouseTrendAdmin'
                        );

$menus[0]['sub'][]= array('title'=>'Giao dịch',
                            'url'=>'/',
                            'classIcon'=>'bx bx-history',
                            'permission'=>'transactionHistoryEzpics',
                            'sub'=> array(array('title'=>'Nạp tiền',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-transaction-listTransactionHistoryBankingEzpics',
                                                'classIcon'=>'bx bx-history',
                                                'permission'=>'listTransactionHistoryBankingEzpics',
                                            ),
                                            array('title'=>'Rút tiền',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-transaction-listTransactionHistoryWithdrawMoneyEzpics',
                                                'classIcon'=>'bx bx-history',
                                                'permission'=>'listTransactionHistoryWithdrawMoneyEzpics',
                                            ),
                                            array('title'=>'Bán mẫu thiết kế',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-transaction-listTransactionHistorySellingDesignsEzpics',
                                                'classIcon'=>'bx bx-history',
                                                'permission'=>'listTransactionHistorySellingDesignsEzpics',
                                            ),
                                            array('title'=>'Mua mẫu thiết kế',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-transaction-listTransactionHistoryBuyProductEzpics',
                                                'classIcon'=>'bx bx-history',
                                                'permission'=>'listTransactionHistoryBuyProductEzpics',
                                            ),
                                             array('title'=>'Chiết khấu mẫu thiết kế',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-transaction-listTransactionHistoryDiscountProductEzpics',
                                                'classIcon'=>'bx bx-history',
                                                'permission'=>'listTransactionHistoryDiscountProductEzpics',
                                            ),
                                            array('title'=>'Xóa ảnh nền',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-transaction-listTransactionHistoryRemoveImageEzpics',
                                                'classIcon'=>'bx bx-history',
                                                'permission'=>'listTransactionHistoryRemoveImageEzpics',
                                            ),
                                            array('title'=>'Bán kho mẫu thiết kế',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-transaction-listTransactionHistorySellingWarehouseEzpics',
                                                'classIcon'=>'bx bx-history',
                                                'permission'=>'listTransactionHistorySellingWarehouseEzpics',
                                            ),
                                            array('title'=>'Mua kho mẫu thiết kế',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-transaction-listTransactionHistoryBuyWarehouseEzpics',
                                                'classIcon'=>'bx bx-history',
                                                'permission'=>'listTransactionHistoryBuyWarehouseEzpics',
                                            ),
                                            array('title'=>'Tạo nội dung',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-transaction-listTransactionHistoryCreateConnetnEzpics',
                                                'classIcon'=>'bx bx-history',
                                                'permission'=>'listTransactionHistoryCreateConnetnEzpics',
                                            ),
                                            array('title'=>'Nâng cấp Pro',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-transaction-listTransactionProEzpics',
                                                'classIcon'=>'bx bx-history',
                                                'permission'=>'listTransactionProEzpics',
                                            ),
                                            array('title'=>'Tạo kho mẫu thiết kế',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-transaction-listTransactionHistoryCreateWarehousesEzpics',
                                                'classIcon'=>'bx bx-history',
                                                'permission'=>'listTransactionHistoryCreateWarehousesEzpics',
                                            ),
                                            array('title'=>'Cộng Ecoin',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-transaction-listTransactionHistoryPlusEcoinEzpics',
                                                'classIcon'=>'bx bx-history',
                                                'permission'=>'listTransactionHistoryPlusEcoinEzpics',
                                            ),
                                            array('title'=>'Từ Ecoin',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-transaction-listTransactionHistoryMinusEcoinEzpics',
                                                'classIcon'=>'bx bx-history',
                                                'permission'=>'listTransactionHistoryMinusEcoinEzpics',
                                            ),
                                        
                                    )
                        );

$menus[0]['sub'][]= array( 'title'=>'Thông báo',
                            'url'=>'/',
                            'classIcon'=>'bx bx-bell',
                            'permission'=>'addNotificationAdmin',
                            'sub'=> array(array('title'=>'Thông báo chung',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-notification-addNotificationAdmin',
                                                'classIcon'=>'bx bx-history',
                                                'permission'=>'addNotificationAdmin',
                                            ),
                                        array('title'=>'Thông báo tin tức mới ',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-notification-addNotificationPostNewAdmin',
                                                'classIcon'=>'bx bx-history',
                                                'permission'=>'addNotificationPostNewAdmin',
                                            ),
                                        array('title'=>'Thông báo sản phẩn mới ',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-notification-addNotificationProductNewAdmin',
                                                'classIcon'=>'bx bx-history',
                                                'permission'=>'addNotificationProductNewAdmin',
                                            ),
                                )
                        );

$menus[0]['sub'][]= array('title'=>'Liên hệ',
                            'url'=>'/',
                            'classIcon'=>'bx bxs-contact',
                            'permission'=>'settingsEzpics',
                            'sub'=> array(array('title'=>'Thông tin đăng kí design',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-contact-listDesignRegistrationAdmin',
                                                'classIcon'=>'bx bx-category',
                                                'permission'=>'listDesignRegistrationAdmin',
                                            ),
                                        array('title'=>'Order mẫu thiết kế',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-contact-listOrderProductAdmin',
                                                'classIcon'=>'bx bx-category',
                                                'permission'=>'listOrderProductAdmin',
                                            ),
                                        array('title'=>'Báo xấu mẫu thiết kế',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-contact-listBaddesignAdmin',
                                                'classIcon'=>'bx bx-category',
                                                'permission'=>'listBaddesignAdmin',
                                            ),
                                    )
                        );

$menus[0]['sub'][]= array('title'=>'Top designer',
                            'url'=>'/',
                            'classIcon'=>'bx bx-filter-alt',
                            'permission'=>'topDesigner',
                            'sub'=> array(array('title'=>'Bán được nhiều mẫu nhất',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-topDesigner-listSellTopDesignerAdmin',
                                                'classIcon'=>'bx bx-category',
                                                'permission'=>'listSellTopDesignerAdmin',
                                            ),
                                        array('title'=>'Thu nhập cao nhất',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-topDesigner-listIncomeTopDesignerAdmin',
                                                'classIcon'=>'bx bx-category',
                                                'permission'=>'listIncomeTopDesignerAdmin',
                                            ),
                                        array('title'=>'Tạo được nhiều mẫu nhất',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-topDesigner-listCreateTopDesignerAdmin',
                                                'classIcon'=>'bx bx-category',
                                                'permission'=>'listCreateTopDesignerAdmin',
                                            ),
                                    )
                        );

$menus[0]['sub'][]= array('title'=>'Cài đặt',
                            'url'=>'/',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settingsEzpics',
                            'sub'=> array(array('title'=>'Danh mục thiết kế',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-category-listCategoryEzpics',
                                                'classIcon'=>'bx bx-category',
                                                'permission'=>'listCategoryEzpics',
                                            ),
                                        array('title'=>'Mã giảm giá',
                                            'url'=>'/plugins/admin/ezpics_admin-view-admin-discountCode-listDiscountCodeAdmin',
                                            'classIcon'=>'bx bx-category',
                                            'permission'=>'listDiscountCodeAdmin',
                                        ),
                                        array('title'=>'Thư viện ảnh',
                                            'url'=>'/plugins/admin/ezpics_admin-view-admin-ingredient-listIngredientAdmin',
                                            'classIcon'=>'bx bx-category',
                                            'permission'=>'listIngredientAdmin',
                                        ),
                                        array('title'=>'Danh mục thư viện ảnh',
                                            'url'=>'/plugins/admin/ezpics_admin-view-admin-ingredient-listCategoryIngredientEzpics',
                                            'classIcon'=>'bx bx-category',
                                            'permission'=>'listCategoryIngredientEzpics',
                                        ),
                                        array('title'=>'Lịch sử tìm kiếm',
                                            'url'=>'/plugins/admin/ezpics_admin-view-admin-searchKey-listSearchKeyEzpics',
                                            'classIcon'=>'bx bx-category',
                                            'permission'=>'listSearchKeyEzpics',
                                        ),
                                    )
                        );
$menus[0]['sub'][]= array( 'title'=>'Thống kê',
                            'url'=>'',
                            'classIcon'=>'bx bx-line-chart',
                            'permission'=>'homeAdmin',
                             'sub'=> array(array('title'=>'Thống kê nhanh',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-chart-statisticalAdmin',
                                                'classIcon'=>'bx bx-category',
                                                'permission'=>'statisticalAdmin',
                                            ),
                                        array('title'=>'Thống kê người dùng mới',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-chart-chartUserNewAdmin',
                                                'classIcon'=>'bx bx-category',
                                                'permission'=>'listCategoryEzpics',
                                            ),
                                        array('title'=>'Thống kê mẫu được duyệt',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-chart-chartSampleApprovedAdmin',
                                                'classIcon'=>'bx bx-category',
                                                'permission'=>'listfontAdmin',
                                            ),
                                        array('title'=>'Thống kê nạp tiền',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-chart-chartLoadMoneyAdmin',
                                                'classIcon'=>'bx bx-category',
                                                'permission'=>'listfontAdmin',
                                            ),
                                        array('title'=>'Thống kê đăng nhập',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-chart-chartUserLastloginAdmin',
                                                'classIcon'=>'bx bx-category',
                                                'permission'=>'listfontAdmin',
                                            ),
                                        array('title'=>'Thống kê lượng mua mẫu thiết kế',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-chart-chartOrberProductAdmin',
                                                'classIcon'=>'bx bx-category',
                                                'permission'=>'listfontAdmin',
                                            ),
                                    )
                        );
$menus[0]['sub'][]= array('title'=>'Mẫu câu hỏi',
                            'url'=>'/',
                            'classIcon'=>'bx bx-spreadsheet',
                            'permission'=>'settingsEzpics',
                            'sub'=> array(array('title'=>'Danh mục câu hỏi',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-question-listCategoryQuestion',
                                                'classIcon'=>'bx bx-category',
                                                'permission'=>'listCategoryQuestion',
                                            ),
                                        array('title'=>'Câu hỏi',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-question-listQuestion',
                                                'classIcon'=>'bx bx-category',
                                                'permission'=>'listQuestion',
                                            ),
                                     
                                    )
                        );



addMenuAdminMantan($menus);
global $ftp_server_upload_image;
global $ftp_username_upload_image;
global $ftp_password_upload_image;
global $ftp_password_upload_image;
global $recommenders;
global $type_ingredient;


$recommenders = 5;
$ftp_server_upload_image = "103.74.123.202";
$ftp_username_upload_image = "ezpics";
$ftp_password_upload_image = "uImzVeNYgF";

/*
function sendNotification($data,$target)
{
    global $keyFirebase;
    $url = 'https://fcm.googleapis.com/fcm/send';

    $fields = array();
    
    $fields['data'] = $data;
    $fields['priority'] = 'high';
    $fields['content_available'] = true;

    $fields['notification'] = ['title'=>$data['title'], 'body'=>$data['content']];
    
    if(is_array($target)){
        $number_send = count($target)-1;

        if($number_send < 1000){
            $fields['registration_ids'] = $target;
        }else{
            $start_count = 0;
            $end_count = 990;

            do{
                $mini_target = [];

                for($i = $start_count; $i <= $end_count; $i++){
                    $mini_target[] = $target[$i];
                }

                sendNotification($data,$mini_target);

                $start_count = $end_count+1;
                $end_count = $start_count + 990;

                if($start_count < $number_send && $end_count > $number_send){
                    $end_count = $number_send;
                }
            }while ($end_count<=$number_send);
        }
        
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
*/

// Hàm chia nhỏ mảng thành các nhóm 100 token
function splitArrayIntoChunks($array=[], $chunkSize=100) {
    $chunks = [];
    
    if(is_array($array)){
        if(count($array)>=$chunkSize){
            for ($i = 0; $i < count($array); $i += $chunkSize) {
                $chunks[] = array_slice($array, $i, $chunkSize);
            }
        }else{
            $chunks[] = $array;
        }
    }

    return $chunks;
}

function getTokenFirebaseV1()
{
    require __DIR__.'/library/google-auth-library-php/vendor/autoload.php';

    $linkFileJson = __DIR__.'/library/ezpics-91e75-firebase-adminsdk-gjyts-e0c16579ba.json';

    // Đường dẫn tới file JSON bạn đã tải về từ Firebase
    putenv('GOOGLE_APPLICATION_CREDENTIALS='.$linkFileJson);

    // Tạo một handler cho Guzzle
    $handler = HandlerStack::create();

    // Tạo client Guzzle với handler
    $client = new Client(['handler' => $handler]);

    // Sử dụng ServiceAccountCredentials với HTTP handler đúng
    $scopes = ['https://www.googleapis.com/auth/firebase.messaging'];
    $creds = new ServiceAccountCredentials($scopes, $linkFileJson);

    // Lấy Access Token với HTTP handler là callable hợp lệ
    $authToken = $creds->fetchAuthToken(function ($request) use ($client) {
        try {
            // Trả về đối tượng phản hồi (ResponseInterface) thay vì mảng đã giải mã
            return $client->send($request);
        } catch (RequestException $e) {
            // Xử lý lỗi nếu có
            return null;
        }
    });

    return $authToken['access_token'];
}

function sendNotification($data=[], $deviceTokens)
{
    /*
    $data = [
                'title'=>'Bạn được cộng tiền hoa hồng giới thiệu',
                'time'=>date('H:i d/m/Y'),
                'content'=>'Trần Mạnh ơi. Bạn được cộng 100.000 VND do thành viên Kim Oanh đã nạp tiền. Bấm vào đây để kiểm tra ngay nhé.',
                'action'=>'addMoneySuccess',
                'image'=>'',
            ];
    */


    global $keyFirebase;
    global $projectId;

    $tokenFirebase = getTokenFirebaseV1(); // Bearer token
    $number_error = 0;
    
    if(!empty($tokenFirebase)){
        // Chia danh sách token thành các nhóm 100
        if(is_string($deviceTokens)){
            $deviceTokens = [$deviceTokens];
        }

        $chunks = splitArrayIntoChunks($deviceTokens, 100);
        

        $headers = [
            'Authorization: Bearer ' . $tokenFirebase,
            'Content-Type: application/json'
        ];

        $url = 'https://fcm.googleapis.com/v1/projects/' . $projectId . '/messages:send';

        foreach ($chunks as $chunk) {
            // Tạo thông báo cho mỗi nhóm 100 thiết bị
            $messages = [];
            foreach ($chunk as $token) {
                $messages[] = [
                    "message" => [
                        "token" => $token,
                        "notification" => [
                                            'title' => $data['title'],
                                            'body' => $data['content'],
                                            //'sound' => "default",
                                        ],
                        "data" => $data,
                    ]
                ];
            }

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            // Gửi từng tin nhắn cho nhóm thiết bị hiện tại
            foreach ($messages as $message) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));
                $result = curl_exec($ch);
                /*
                debug($message);
                debug($result);die;
                */
                // Xử lý kết quả
                if ($result === FALSE) {
                    $number_error ++;
                }
            }

            curl_close($ch);
        }
    }

    return $number_error;
}

function getMember($id){
    global $modelOption;
    global $controller;
    $modelMembers = $controller->loadModel('Members');
        $data = $modelMembers->find()->where(['id'=>intval($id)])->first();       
        return $data;
}

function sendEmailsuccessfulDesigner($email='', $fullName='', $certificate='')
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
                            <span style="font-weight: bold;">CÔNG TY TNHH EZIPCS</span> <br>
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

        $attachments = [];
        if(!empty($certificate)){
            $attachments = [
                                ['type'=>'image/png', 'link'=>$certificate]
                            ];
        }

        sendEmail(@$to, @$cc, @$bcc, @$subject, @$content, 'default', $attachments);
    }
}

function sendEmailunsuccessfuldesigner($email='', $fullName='', $note='')
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
                        Lý do từ chối: '.$note.'</b>
                        
                        <br><br>
                        
                        Trân trọng ./
                    </div>
                    <div class="thong_tin">
                        <div class="line"><div class="line1"></div></div>
                        <div class="cty">
                            <span style="font-weight: bold;">CÔNG TY TNHH EZIPCS</span> <br>
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

function sendEmailsuccessfulProduct($email='', $fullName='',$nameProduct='', $certificate='')
{
    $to = array();

    if(!empty($email)){
        $to[]= trim($email);
    
        $cc = array();
        $bcc = array();
        $subject = '[Ezpics] ' . 'Mẫu mới đã được duyệt';

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
                        <span>Mẫu mới đã được duyệt</span>
                    </div>
                    <div class="main">
                        <em style="    margin: 10px 0 10px;display: inline-block;">Xin chào '.$fullName.' !</em> <br>
                        <br/>
                       <b> Mẫu '.$nameProduct.' của bạn đã được duyệt</b>
                        
                        <br><br>
                        
                        Trân trọng ./
                    </div>
                    <div class="thong_tin">
                        <div class="line"><div class="line1"></div></div>
                        <div class="cty">
                            <span style="font-weight: bold;">CÔNG TY TNHH EZIPCS</span> <br>
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

        $attachments = [];
        if(!empty($certificate)){
            $attachments = [
                                ['type'=>'image/png', 'link'=>$certificate]
                            ];
        }

        sendEmail(@$to, @$cc, @$bcc, @$subject, @$content, 'default', $attachments);
    }
}

function sendEmailunsuccessfulProduct($email='', $fullName='',$nameProduct='',$note='')
{
    $to = array();

    if(!empty($email)){
        $to[]= trim($email);
    
        $cc = array();
        $bcc = array();
        $subject = '[Ezpics] ' . 'Từ chỗi mẫu thiết kế';

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
                        <span>Từ chỗi mẫu thiết kế </span>
                    </div>
                    <div class="main">
                        <em style="    margin: 10px 0 10px;display: inline-block;">Xin chào '.$fullName.' !</em> <br>
                        <br/>
                        Chúng tôi rất tiếc phải thông báo rằng mẫu '.$nameProduct.' của bạn đã bị từ chối.
                        <br/>
                        Lý do từ chối: '.$note.'</b>
                        
                        <br><br>
                        
                        Trân trọng ./
                    </div>
                    <div class="thong_tin">
                        <div class="line"><div class="line1"></div></div>
                        <div class="cty">
                            <span style="font-weight: bold;">CÔNG TY TNHH EZIPCS</span> <br>
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

function sendEmailtransactioncMoney($email='', $fullName='',$order=array(), $certificate='')
{
    $to = array();

    if(!empty($email)){
        $to[]= trim($email);
    
        $cc = array();
        $bcc = array();
        $subject = '[Ezpics] ' . 'Bạn đã rút tiền thành công';

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
                        <span>Bạn đã rút tiền thành công</span>
                    </div>
                    <div class="main">
                        <em style="    margin: 10px 0 10px;display: inline-block;">Xin chào '.$fullName.' !</em> <br>
                        <br/>
                        <b> Số tiền bạn rút là: '.number_format($order->total).'VNĐ</b>
                         <br/>
                        '.$order->note.'
                        <br><br>
                        
                        Trân trọng ./
                    </div>
                    <div class="thong_tin">
                        <div class="line"><div class="line1"></div></div>
                        <div class="cty">
                            <span style="font-weight: bold;">CÔNG TY TNHH EZIPCS</span> <br>
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

        $attachments = [];
        if(!empty($certificate)){
            $attachments = [
                                ['type'=>'image/png', 'link'=>$certificate]
                            ];
        }

        sendEmail(@$to, @$cc, @$bcc, @$subject, @$content, 'default', $attachments);
    }
}

function sendEmailLockWarehouse($email='', $fullName='', $Warehouses='', $status='',$note='')
{
    $to = array();

    if(!empty($email)){
        $to[]= trim($email);

        if($status==0){
            $title = 'Kho mẫu thiết kế tạm khóa';
            $not ='Kho "'.$Warehouses.'" của bạn tạm thời bị khóa.<br/> Lý do khóa: "'.$note.'". ';
        }elseif($status==1){
            $title = 'Kho mẫu thiết kế đã được duyệt';
            $not ='Kho "'.$Warehouses.'" của bạn đã được duyệt. ';
        }
    
        $cc = array();
        $bcc = array();
        $subject = '[Ezpics] ' . 'Thông báo phê duyệt kho mẫu thiết kế';

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
                        <span>'.$title.'</span>
                    </div>
                    <div class="main">
                        <em style="    margin: 10px 0 10px;display: inline-block;">Xin chào '.$fullName.' !</em> <br>
                        <br/>
                         '.$not.'
                        
                        <br><br>
                        
                        Trân trọng ./
                    </div>
                    <div class="thong_tin">
                        <div class="line"><div class="line1"></div></div>
                        <div class="cty">
                            <span style="font-weight: bold;">CÔNG TY TNHH EZIPCS</span> <br>
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

        sendEmail(@$to, @$cc, @$bcc, @$subject, @$content);
    }
}

function sendEmailBuyPro($email='', $fullName='')
{
    $to = array();

    if(!empty($email)){
        $to[]= trim($email);
        $cc = array();
        $bcc = array();
        $subject = '[Ezpics] ' . 'Tài khoản của bạn đã lên bản Pro';

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
                        <span>Tài khoản của bạn đã lên bản Pro</span>
                    </div>
                    <div class="main">
                        <em style="    margin: 10px 0 10px;display: inline-block;">Xin chào '.$fullName.' !</em> <br>
                        <br/>
                        Chúc mừng bạn, tài khoản của bạn đã được nâng cấp lên bản Pro!
                        
                        <br><br>
                        
                        Trân trọng ./
                    </div>
                    <div class="thong_tin">
                        <div class="line"><div class="line1"></div></div>
                        <div class="cty">
                            <span style="font-weight: bold;">CÔNG TY TNHH EZIPCS</span> <br>
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

        sendEmail(@$to, @$cc, @$bcc, @$subject, @$content);
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


function sendEmailAddMoney($email='', $fullName='', $coin= '', $note= '')
{
    $to = array();

    if(!empty($email)){
        $to[]= trim($email);
    
        $cc = array();
        $bcc = array();
        $subject = '[Ezpics] ' . 'Nạp thành công '.number_format($coin).'đ vào tài khoản';

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
                        <span>NẠP TIỀN '.number_format($coin).'Đ</span>
                    </div>
                    <div class="main">
                        <em style="    margin: 10px 0 10px;display: inline-block;">Xin chào '.$fullName.' !</em> <br>
                        <br/>
                        Bạn đã nạp thành công '.number_format($coin).'đ vào tài khoản của bạn trên hệ thống 
                        
                         <br/>
                        <a href="https://ezpics.vn">https://ezpics.vn</a>
                        
                        <br><br>
                        
                        Trân trọng ./
                    </div>
                    <div class="thong_tin">
                        <div class="line"><div class="line1"></div></div>
                        <div class="cty">
                            <span style="font-weight: bold;">CÔNG TY TNHH EZIPCS</span> <br>
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

function sendEmailMinusMoney($email='', $fullName='', $coin= '', $note= '')
{
    $to = array();

    if(!empty($email)){
        $to[]= trim($email);
    
        $cc = array();
        $bcc = array();
        $subject = '[Ezpics] ' . 'Bạn bị trừ tiền '.number_format($coin).'đ trong tài khoản';

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
                        <span>BẠN BỊ TRỪ TIỀN '.number_format($coin).'Đ</span>
                    </div>
                    <div class="main">
                        <em style="    margin: 10px 0 10px;display: inline-block;">Xin chào '.$fullName.' !</em> <br>
                        <br/>
                        Bạn bị trừ tiền  '.number_format($coin).'đ trong tài khoản của bạn trên hệ thống
                        <br/>
                        Lý do bạn bị từ tiền là:  '.$note.'
                         <br/>
                         <a href="https://ezpics.vn">https://ezpics.vn</a>
                        
                        <br><br>
                        
                        Trân trọng ./
                    </div>
                    <div class="thong_tin">
                        <div class="line"><div class="line1"></div></div>
                        <div class="cty">
                            <span style="font-weight: bold;">CÔNG TY TNHH EZIPCS</span> <br>
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

global $noteplusMoney;
global $noteminusMoney;


$noteplusMoney = array( 1=>'Nạp tiền qua chuyển khoản',
                        2=>'Nhập sai nội dung',
                );

$noteminusMoney = array( 1=>'Nạp tiền qua chuyển khoản',
                        2=>'Nhập sai nội dung',
                );

function getSizeProduct()
{
    return [
            ['name'=>'Bài thuyết trình (16:9)','width'=>1920,'height'=>1080],
            ['name'=>'Bài thuyết trình (9:16)','width'=>1080,'height'=>1920],
            ['name'=>'Logo','width'=>500,'height'=>500],
            ['name'=>'Poster (dọc)','width'=>4960,'height'=>7015],
            ['name'=>'Bài đăng Instagram (vuông)','width'=>1080,'height'=>1080],
            ['name'=>'Bài đăng Facebook (ngang)','width'=>940,'height'=>788],
            ['name'=>'Ảnh bìa Facebook','width'=>1640,'height'=>924],
            ['name'=>'Hình nền máy tính','width'=>1920,'height'=>1080],
            ['name'=>'A0 (dọc)','width'=>3179,'height'=>4494],
            ['name'=>'A1 (dọc)','width'=>2245,'height'=>3179],
            ['name'=>'A2 (dọc)','width'=>1587,'height'=>2245],
            ['name'=>'A3 (dọc)','width'=>1123,'height'=>1587],
            ['name'=>'A4 (dọc)','width'=>794,'height'=>1123],
            ['name'=>'A5 (dọc)','width'=>559,'height'=>794],
        ];
}

function getColor(){
    return array(
         ['name'=>'Black','code'=>'#000000'],
         ['name'=>'White','code'=>'#FFFFFF'],
         ['name'=>'Red','code'=>'#FF0000'],
         ['name'=>'Lime','code'=>'#00FF00'],
         ['name'=>'Blue','code'=>'#0000FF'],
         ['name'=>'Yellow','code'=>'#FFFF00'],
         ['name'=>'Cyan / Aqua','code'=>'#00FFFF'],
         ['name'=>'Magenta / Fuchsia','code'=>'#FF00FF'],
         ['name'=>'Silver','code'=>'#C0C0C0'],
         ['name'=>'Orange','code'=>'#FF6D01'],
         ['name'=>'Pink','code'=>'#FFC0CB'],
    );
}

?>