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
                                            array('title'=>'bán mẫu thiết kế',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-transaction-listTransactionHistorySellingDesignsEzpics.php',
                                                'classIcon'=>'bx bx-history',
                                                'permission'=>'listTransactionHistorySellingDesignsEzpics',
                                            ),
                                            array('title'=>'Mua mẫu thiết kế',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-transaction-listTransactionHistoryBuyProductEzpics.php',
                                                'classIcon'=>'bx bx-history',
                                                'permission'=>'listTransactionHistoryBuyProductEzpics',
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

$menus[0]['sub'][5]= array('title'=>'Cài đặt',
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

?>