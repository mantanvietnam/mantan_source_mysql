<?php 
global $keyFirebase;

$keyFirebase = 'BH3viH2U-wjNvMEzEEuAa7iCfLV5LKGEqFxc4VKSs0cbGfHqTkQyV4ZRJPiG1W5HqpDBmWpPheBCVD7fVuLIeLI';

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
                                        array('title'=>'Mua mẫu thiết kế',
                                                'url'=>'/plugins/admin/ezpics_admin-view-admin-transaction-listTransactionHistoryBuyProductEzpics.php',
                                                'classIcon'=>'bx bx-history',
                                                'permission'=>'listTransactionHistoryBuyProductEzpics',
                                            ),
                                    )
                        );

$menus[0]['sub'][3]= array( 'title'=>'Thông báo',
                            'url'=>'/plugins/admin/ezpics_admin-view-admin-notification-addNotificationAdmin.php',
                            'classIcon'=>'bx bx-bell',
                            'permission'=>'addNotificationAdmin'
                        );

$menus[0]['sub'][4]= array('title'=>'Cài đặt',
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

}