<?php

$menus = array();
$menus[0]['title'] = 'Cố lên nao';

$menus[0]['sub'][0] = array(
    'title' => 'Danh sách thành viên',
    'url' => '/plugins/admin/colennao-view-admin-user-listUserAdmin',
    'classIcon' => 'bx bx-cog',
    'permission' => 'listUserAdmin',
);
$menus[0]['sub'][1]= array(	'title'=>'Khóa học',
							'url'=>'/plugins/admin/colennao-view-admin-courses-listCourse',
							'classIcon'=>'bx bxs-graduation',
							'permission'=>'listCourse'
						);
$menus[0]['sub'][2]= array(	'title'=>'Bài học',
							'url'=>'/plugins/admin/colennao-view-admin-lesson-listLesson',
							'classIcon'=>'bx bx-list-ul',
							'permission'=>'listLesson'
                    );
$menus[0]['sub'][3]= array(	'title'=>'Bài khảo sát',
                            'url'=>'/plugins/admin/colennao-view-admin-tests-listTest',
                            'classIcon'=>'bx bxs-meh-alt',
                            'permission'=>'listTest'
                    );
$menus[0]['sub'][4]= array(	'title'=>'Câu hỏi bài khảo sát',
							'url'=>'/plugins/admin/colennao-view-admin-questions-listQuestion',
							'classIcon'=>'bx bx-question-mark',
							'permission'=>'listQuestion'
						);
$menus[0]['sub'][5]= array(	'title'=>'Giảm cân',
                            'url'=>'/plugins/admin/colennao-view-admin-fasting-listfastingadmin',
                            'classIcon'=>'bx bxs-wink-tongue',
                            'permission'=>'listfastingadmin'
                    );
$menus[0]['sub'][10]= array('title'=>'Cài đặt',
        'url'=>'/',
        'classIcon'=>'bx bx-cog',
        'permission'=>'settings',
        'sub'=> array(  
                        array(	'title'=>'Phương pháp',
                                'url'=>'/plugins/admin/colennao-view-admin-category-listCategorylosingweight',
                                'classIcon'=>'bx bxs-data',
                                'permission'=>'listCategorylosingweight'
                                ),
        )

    );
$menus[0]['sub'][6]= array( 'title'=>'Bảng giá ',
                            'url'=>'/plugins/admin/colennao-view-admin-pricelist-listPriceList',
                            'classIcon'=>'bx bx-money',
                            'permission'=>'listPriceList'
                    );
$menus[0]['sub'][8]= array( 'title'=>'Thử thách  ',
                            'url'=>'/plugins/admin/colennao-view-admin-challenge-listChallenge',
                            'classIcon'=>'bx bxs-bolt',
                            'permission'=>'listChallenge'
                    );
$menus[1]['title'] = 'Liên hệ';
$menus[1]['sub'][1]= array( 'title'=>'Thông tin liên hệ  ',
                            'url'=>'/plugins/admin/colennao-view-admin-contacts-listContactAdmin',
                            'classIcon'=>'bx bxs-meh-alt',
                            'permission'=>'listContactAdmin'
                    );
addMenuAdminMantan($menus);
function createPaginationMetaData($totalItem, $itemPerPage, $currentPage): array
{
    global $urlCurrent;

    $balance = $totalItem % $itemPerPage;
    $totalPage = ($totalItem - $balance) / $itemPerPage;
    if ($balance > 0)
        $totalPage += 1;

    $back = $currentPage - 1;
    $next = $currentPage + 1;
    if ($back <= 0)
        $back = 1;
    if ($next >= $totalPage)
        $next = $totalPage;

    if (isset($_GET['page'])) {
        $urlPage = str_replace('&page=' . $_GET['page'], '', $urlCurrent);
        $urlPage = str_replace('page=' . $_GET['page'], '', $urlPage);
    } else {
        $urlPage = $urlCurrent;
    }
    if (strpos($urlPage, '?') !== false) {
        if (count($_GET) >= 1) {
            $urlPage = $urlPage . '&page=';
        } else {
            $urlPage = $urlPage . 'page=';
        }
    } else {
        $urlPage = $urlPage . '?page=';
    }

    return [
        'page' => $currentPage,
        'totalPage' => $totalPage,
        'back' => $back,
        'next' => $next,
        'urlPage' => $urlPage
    ];
}

function createToken($length = 30): string
{
    $chars = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    return substr(str_shuffle($chars), 0, $length) . time();
}

function getUserByToken($accessToken, $checkActive = true)
{
    global $controller;

    $modelUser = $controller->loadModel('Users');
    $conditions = [
        'token' => $accessToken
    ];

    if ($checkActive) {
        $conditions['status'] = 'active';
    }

    $user = $modelUser->find()->where($conditions)->first();
    return $user;
}



function apiResponse(int $code = 0, $messages = '', $data = [], array $meta = []): array
{
    return [
        'data' => $data ?? [],
        'code' => $code ?? '',
        'messages' => $messages ?? '',
        'meta' => $meta ?? []
    ];
}

function sendEmailCodeForgotPassword($email = '', $fullName = '', $code = '')
{
    $to = array();

    if (!empty($email)) {
        $to[] = trim($email);

        $cc = array();
        $bcc = array();
        $subject = 'Mã xác thực cấp lại mật khẩu mới';

        $content = '<!DOCTYPE html>
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
                        <em style="    margin: 10px 0 10px;display: inline-block;">Xin chào ' . $fullName . ' !</em> <br>
                        <br/>
                        Mã xác thực cấp lại mật khẩu mới của bạn là: <b>' . $code . '</b>
                        
                        <br><br>
                        
                        Trân trọng ./
                    </div>
                    <div class="thong_tin">
                        <div class="line"><div class="line1"></div></div>
                        <div class="cty">
                            <span style="font-weight: bold;">CÔNG TY TNHH GIẢI PHÁP SỐ TOP TOP</span> <br>
                            <span>Ứng dụng Co Len Nao </span>
                        </div>
                        <ul class="list-unstyled" style="    font-size: 15px;">
                            <li>Hỗ trợ: </li>
                            <li>Mobile: </li>
                            <li>Website: <a href="#"></a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </body>
        </html>';

        sendEmail($to, $cc, $bcc, $subject, $content);
    }
}
function getNameFromIdlosingweight($id) {
    global $controller;
    $modelCategories = $controller->loadModel('Categories');
	$conditions = array('type' => 'category_losingweight');
    $data = $modelCategories->find()->where(['id' => (int)$id],$conditions)->first();

    if ($data) {
        return $data->name;
    }
    
    return null; 
}

?>