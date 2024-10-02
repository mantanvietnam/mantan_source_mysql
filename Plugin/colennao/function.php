<?php

$menus = array();
$menus[0]['title'] = 'Cố lên nao';

$menus[0]['sub'][0] = array(
    'title' => 'Danh sách thành viên',
    'url' => '/plugins/admin/colennao-view-admin-user-listUserAdmin',
    'classIcon' => 'bx bx-cog',
    'permission' => 'listUserAdmin',
);
$menus[0]['sub'][]= array(	'title'=>'Khóa học',
							'url'=>'/plugins/admin/colennao-view-admin-courses-listCourse',
							'classIcon'=>'bx bxs-graduation',
							'permission'=>'listCourse'
						);
$menus[0]['sub'][]= array(	'title'=>'Bài học',
							'url'=>'/plugins/admin/colennao-view-admin-lesson-listLesson',
							'classIcon'=>'bx bx-list-ul',
							'permission'=>'listLesson'
                    );
$menus[0]['sub'][]= array(	'title'=>'Câu hỏi khảo sát tiếng việt',
							'url'=>'/plugins/admin/colennao-view-admin-questions-listQuestion',
							'classIcon'=>'bx bx-question-mark',
							'permission'=>'listQuestion'
						);
$menus[0]['sub'][]= array(	'title'=>'Giảm cân',
                            'url'=>'/plugins/admin/colennao-view-admin-fasting-listfastingadmin',
                            'classIcon'=>'bx bxs-wink-tongue',
                            'permission'=>'listfastingadmin'
                    );
$menus[0]['sub'][]= array( 'title'=>'Bảng giá ',
                            'url'=>'/plugins/admin/colennao-view-admin-pricelist-listPriceList',
                            'classIcon'=>'bx bx-money',
                            'permission'=>'listPriceList'
                    );
$menus[0]['sub'][]= array( 'title'=>'Thử thách  ',
                            'url'=>'/plugins/admin/colennao-view-admin-challenge-listChallenge',
                            'classIcon'=>'bx bxs-bolt',
                            'permission'=>'listChallenge'
                    );
$menus[0]['sub'][]= array( 'title'=>'cài đặt ngân hàng  ',
                            'url'=>'/plugins/admin/colennao-view-admin-seting-setingBankAccount',
                            'classIcon'=>'bx bxs-bank',
                            'permission'=>'setingBankAccount'
                    );
$menus[0]['sub'][]= array( 'title'=>'cài đặt ngân hàng  ',
                            'url'=>'/plugins/admin/colennao-view-admin-seting-setingBankAccount',
                            'classIcon'=>'bx bxs-bank',
                            'permission'=>'setingBankAccount'
                    );
$menus[0]['sub'][]= array( 'title'=>'Huấn luyện viên',
                            'url'=>'/plugins/admin/colennao-view-admin-coach-listcoach',
                            'classIcon'=>'bx bxs-meh-blank',
                            'permission'=>'listcoach'
                    );

$menus[0]['sub'][]= array( 'title'=>'Giao dịch thanh toán',
                            'url'=>'/plugins/admin/colennao-view-admin-transaction-listTransactionAdmin',
                            'classIcon'=>'bx bx-history',
                            'permission'=>'listTransactionAdmin'
                    );

$menus[0]['sub'][]= array('title'=>'Cài đặt',
        'url'=>'/',
        'classIcon'=>'bx bx-cog',
        'permission'=>'settings',
        'sub'=> array(  
                        array(  'title'=>'Phương pháp',
                                'url'=>'/plugins/admin/colennao-view-admin-category-listCategorylosingweight',
                                'classIcon'=>'bx bxs-data',
                                'permission'=>'listCategorylosingweight'
                                ),
                        array(  'title'=>'Thiết bị',
                                'url'=>'/plugins/admin/colennao-view-admin-device-listDevice',
                                'classIcon'=>'bx bxs-data',
                                'permission'=>'listDevice'
                                ),
                         array(  'title'=>'khu vực tập',
                                'url'=>'/plugins/admin/colennao-view-admin-area-listArea',
                                'classIcon'=>'bx bxs-data',
                                'permission'=>'listArea'
                                ),
        )

    );
$menus[1]['title'] = 'Gói luyện tập';
$menus[1]['sub'][]= array( 'title'=>'Gói luyện tập',
                            'url'=>'/plugins/admin/colennao-view-admin-packageworkouts-listPackageWorkouts',
                            'classIcon'=>'bx bxs-meh-alt',
                            'permission'=>'listPackageWorkouts'
                    );
$menus[1]['sub'][]= array( 'title'=>'Bài luyện tập  ',
                            'url'=>'/plugins/admin/colennao-view-admin-workout-listWorkout',
                            'classIcon'=>'bx bxs-meh-alt',
                            'permission'=>'listContactAdmin'
                    );
$menus[2]['title'] = 'Liên hệ';
$menus[2]['sub'][1]= array( 'title'=>'Thông tin liên hệ  ',
                            'url'=>'/plugins/admin/colennao-view-admin-contacts-listContactAdmin',
                            'classIcon'=>'bx bxs-meh-alt',
                            'permission'=>'listContactAdmin'
                    );

$menus[3]['title'] = 'FOOD';
$menus[3]['sub'][1]= array( 'title'=>'Nhóm đồ ăn',
                            'url'=>'/plugins/admin/colennao-view-admin-food-listgroupfood',
                            'classIcon'=>'bx bxs-meh-alt',
                            'permission'=>'listgroupfood'
                        );
$menus[3]['sub'][2]= array( 'title'=>'Bữa sáng',
                            'url'=>'/plugins/admin/colennao-view-admin-breakfastfood-listbreakfastfood',
                            'classIcon'=>'bx bxs-meh-alt',
                            'permission'=>'listbreakfastfood'
                        );
$menus[3]['sub'][3]= array( 'title'=>'Bữa trưa',
                            'url'=>'/plugins/admin/colennao-view-admin-lunchfood-listlunchfood',
                            'classIcon'=>'bx bxs-meh-alt',
                            'permission'=>'listlunchfood'
                        );
$menus[3]['sub'][4]= array( 'title'=>'Bữa tối',
                            'url'=>'/plugins/admin/colennao-view-admin-dinnerfood-listdinnerfood',
                            'classIcon'=>'bx bxs-meh-alt',
                            'permission'=>'listdinnerfood'
                        );
$menus[3]['sub'][5]= array( 'title'=>'Bữa ăn nhẹ',
                            'url'=>'/plugins/admin/colennao-view-admin-snackfood-listsnacksfood',
                            'classIcon'=>'bx bxs-meh-alt',
                            'permission'=>'listsnacksfood'
                        );
 $menus[3]['sub'][6]= array( 'title'=>'Điều kiện tiếng việt',
                            'url'=>'/plugins/admin/colennao-view-admin-condition-listcondition',
                            'classIcon'=>'bx bxs-meh-alt',
                            'permission'=>'listcondition'
                            );

$menus[3]['sub'][7]= array( 'title'=>'Điều kiện tiếng anh',
                            'url'=>'/plugins/admin/colennao-view-admin-condition-listconditioneng',
                            'classIcon'=>'bx bxs-meh-alt',
                            'permission'=>'listconditioneng'
                            );
$menus[3]['sub'][8]= array( 'title'=>'Tin tức',
                            'url'=>'/plugins/admin/colennao-view-admin-post-listtablepost',
                            'classIcon'=>'bx bxs-meh-alt',
                            'permission'=>'listtablepost'
                            );


addMenuAdminMantan($menus);

global $transactionKey;
$transactionKey = 'COLENNAO';


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
        $conditions['status_pay_package'] = 1;
    }

    $user = $modelUser->find()->where($conditions)->first();
    if(!empty($user->phone)){
         $user->link_affiliate = '/affiliater?affsource='.@$user->phone;
    }
   
    return $user;
}



function apiResponse(int $code = 0, $messages = '', $data = [], $totalData = 1, array $meta = []): array
{
    return [
        'data' => $data ?? [],
        'code' => $code ?? '',
        'messages' => $messages ?? '',
        'meta' => $meta ?? [],
        'totalData' => $totalData ?? 1
    ];
}

function sendEmailCodeForgotPassword($email = '', $fullName = '', $code = '')
{
    $to = array();

    if (!empty($email)) {
        $to[] = trim($email);

        $cc = array();
        $bcc = array();
        $subject = 'Mã xác thực ';

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
                        Mã xác thực của bạn là: <b>' . $code . '</b>
                        
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


function listBank(): array
{
    return [
        ['id' => 1, 'name' => 'An Bình', 'code' => 'ABBANK'],
        ['id' => 2, 'name' => 'ANZ Việt Nam', 'code' => 'ANZVL'],
        ['id' => 3, 'name' => 'Á Châu', 'code' => 'ACB'],
        ['id' => 4, 'name' => 'Bắc Á', 'code' => 'Bac A Bank'],
        ['id' => 5, 'name' => 'Bản Việt', 'code' => 'Viet Capital Bank'],
        ['id' => 6, 'name' => 'Bảo Việt', 'code' => 'BAOVIET Bank'],
        ['id' => 7, 'name' => 'Bưu điện Liên Việt', 'code' => 'LienVietPostBank'],
        ['id' => 8, 'name' => 'Chính sách xã hội Việt Nam', 'code' => 'VBSP'],
        ['id' => 9, 'name' => 'CIMB Việt Nam', 'code' => 'CIMB'],
        ['id' => 10, 'name' => 'Công thương Việt Nam', 'code' => 'VietinBank'],
        ['id' => 11, 'name' => 'Dầu khí toàn cầu', 'code' => 'GPBank'],
        ['id' => 12, 'name' => 'Đại Chúng Việt Nam', 'code' => 'PVcomBank'],
        ['id' => 13, 'name' => 'Đại Dương', 'code' => 'OceanBank'],
        ['id' => 14, 'name' => 'Đầu tư và Phát triển Việt Nam', 'code' => 'BIDV'],
        ['id' => 15, 'name' => 'Đông Á', 'code' => 'DongA Bank'],
        ['id' => 16, 'name' => 'Đông Nam Á', 'code' => 'SeABank'],
        ['id' => 17, 'name' => 'Hàng Hải', 'code' => 'MSB'],
        ['id' => 18, 'name' => 'Hong Leong Việt Nam', 'code' => 'HLBVN'],
        ['id' => 19, 'name' => 'Hợp tác xã Việt Nam', 'code' => 'Co-opBank'],
        ['id' => 20, 'name' => 'HSBC Việt Nam', 'code' => 'HSBC'],
        ['id' => 21, 'name' => 'Indovina', 'code' => 'IVB'],
        ['id' => 22, 'name' => 'Kiên Long', 'code' => 'Kienlongbank'],
        ['id' => 23, 'name' => 'Kỹ Thương', 'code' => 'Techcombank'],
        ['id' => 24, 'name' => 'Liên doanh Việt Nga', 'code' => 'VRB'],
        ['id' => 25, 'name' => 'Nam Á', 'code' => 'Nam A Bank'],
        ['id' => 26, 'name' => 'Ngoại Thương Việt Nam', 'code' => 'Vietcombank'],
        ['id' => 27, 'name' => 'NN&PT Nông thôn Việt Nam', 'code' => 'Agribank'],
        ['id' => 28, 'name' => 'Phát triển Thành phố Hồ Chí Minh', 'code' => 'HDBank'],
        ['id' => 29, 'name' => 'Phát triển Việt Nam', 'code' => 'VDB'],
        ['id' => 30, 'name' => 'Phương Đông', 'code' => 'OCB'],
        ['id' => 31, 'name' => 'Public Bank Việt Nam', 'code' => 'PBVN'],
        ['id' => 32, 'name' => 'Quân Đội', 'code' => 'MB'],
        ['id' => 33, 'name' => 'Quốc dân', 'code' => 'NCB'],
        ['id' => 34, 'name' => 'Quốc Tế', 'code' => 'VIB'],
        ['id' => 35, 'name' => 'Sài Gòn', 'code' => 'SCB'],
        ['id' => 36, 'name' => 'Sài Gòn – Hà Nội', 'code' => 'SHB'],
        ['id' => 37, 'name' => 'Sài Gòn Công Thương', 'code' => 'SAIGONBANK'],
        ['id' => 38, 'name' => 'Sài Gòn Thương Tín', 'code' => 'Sacombank'],
        ['id' => 39, 'name' => 'Shinhan Việt Nam', 'code' => 'SHBVN'],
        ['id' => 40, 'name' => 'Standard Chartered Việt Nam', 'code' => 'SCBVL'],
        ['id' => 41, 'name' => 'Tiên Phong', 'code' => 'TPBank'],
        ['id' => 42, 'name' => 'UOB Việt Nam', 'code' => 'UOB'],
        ['id' => 43, 'name' => 'Việt Á', 'code' => 'VietABank'],
        ['id' => 44, 'name' => 'Việt Nam Thịnh Vượng', 'code' => 'VPBank'],
        ['id' => 45, 'name' => 'Việt Nam Thương Tín', 'code' => 'Vietbank'],
        ['id' => 46, 'name' => 'Woori Việt Nam', 'code' => 'Woori'],
        ['id' => 47, 'name' => 'Xăng dầu Petrolimex', 'code' => 'PG Bank'],
        ['id' => 48, 'name' => 'Xây dựng', 'code' => 'CB'],
        ['id' => 49, 'name' => 'Xuất Nhập Khẩu', 'code' => 'Eximbank'],

    ];
}

function getBankAccount(){
    global $controller;
    global $modelOptions;
    $conditions = array('key_word' => 'setingBankAccount');
    $data = $modelOptions->find()->where($conditions)->first();

    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }
    return $data_value;
}

function processAddMoney($money, $id_ransaction= 0): string
{
    global $controller;
    global $transactionType;

    $modelUser = $controller->loadModel('Users');
    $modelTransactions = $controller->loadModel('Transactions');

    


    if ($money >= 1000) {
        if(!empty($id_ransaction)) {
            $transactions = $modelTransactions->find()->where(['id' =>(int)$id_ransaction, 'status'=>1])->first();

            if(!empty($transactions)){
                    if($transactions->total<= $money){
                       

                        if($transactions->type==2){
                            createChallengeUser($transactions->id_user, $transactions->id_challenge, $transactions->id);
                        }elseif($transactions->type==1){
                            createCourseUser($transactions->id_user, $transactions->id_course, $transactions->id);
                        }elseif($transactions->type==3){
                             createPackageUser($transactions->id_user,$transactions->id_package,$transactions->id);
                        }

                         $transactions->status = 2;
                        $modelTransactions->save($transactions);
                    }
                    return 'bạn mua thành công';
                }

               return 'số tiền bạn chưa đủ';
            }


            return 'id không tồn tại';
        }

    return 'Số tiền nạp phải lớn hơn 1.000đ';
}

function createChallengeUser($id_user, $id_challenge,$id_transaction){
    global $controller;
    $modelChallenge = $controller->loadModel('Challenges');
    $modelUser = $controller->loadModel('Users');
    $modelFeedbackChallenge = $controller->loadModel('FeedbackChallenges');
    $modelResultChallenges = $controller->loadModel('ResultChallenges');
    $modelUserChallenges = $controller->loadModel('UserChallenges');
    $modelTransactions = $controller->loadModel('Transactions');
    $modelTipChallenges = $controller->loadModel('TipChallenges');
    $transactions = $modelTransactions->find()->where(['id' =>(int)$id_ransaction])->first();

    if(!empty($id_user) && !empty($id_challenge)) {

        $Challenge = $modelChallenge->find()->where(array('id'=>(int)$id_challenge,'status'=>'active'))->first();
        $user = $modelUser->find()->where(array('id'=>(int)$id_user))->first();

        if(!empty($Challenge) && !empty($user)){
            $tip = $modelTipChallenges->find()->where(['id_challenge'=>$Challenge->id])->all()->toList();
            $checkUserChallenge = $modelUserChallenges->find()->where(['id_challenge'=>$Challenge->id,'id_user'=>$user->id])->first();
            if(empty($checkUserChallenge)){
                $checkUserChallenge = $modelUserChallenges->newEmptyEntity();
                $checkUserChallenge->id_user = $user->id;
                $checkUserChallenge->name = $Challenge->title;
                $checkUserChallenge->name_en = $Challenge->title_en;
                $checkUserChallenge->id_challenge = $Challenge->id;

                $checkUserChallenge->totalDay = $Challenge->day;
                $checkUserChallenge->status = 0;
                $checkUserChallenge->date_start = time();
                $checkUserChallenge->created_at = time();
                $checkUserChallenge->id_transaction = (int)$id_transaction;
                $checkUserChallenge->note = '';

                if(@$transactions->type_use=='trial'){
                    $month = 1;
                    if(!empty($Challenge->time_trial)){
                        $month = $Challenge->time_trial;
                    }
                    
                    $checkUserChallenge->deadline = strtotime('+'.$month.' month', time());
                }else{
                    $checkUserChallenge->deadline = 0;
                }
                

                $listTip = array();

                if(!empty($tip)){
                    foreach($tip as $key => $value){
                        $listTip[] = array('id'=>$value->id,
                            'tip'=>$value->tip,
                            'tip_en'=>$value->tip_en,
                            'status'=>''

                        );
                    }
                }

                $checkUserChallenge->tip = json_encode($listTip);

                $modelUserChallenges->save($checkUserChallenge);

            }
        }
    }
    return 'id không tồn tại';
}

function createCourseUser($id_user, $id_Courses,$id_transaction){

    global $controller;
    $modelUser = $controller->loadModel('Users');
    $modelCourses = $controller->loadModel('Courses');
    $modelUserCourse = $controller->loadModel('UserCourses');
    $modelLesson = $controller->loadModel('Lessons');

    if(!empty($id_user) && !empty($id_Courses)) {

        $courses = $modelCourses->find()->where(array('id'=>(int)$id_Courses))->first();
        $user = $modelUser->find()->where(array('id'=>(int)$id_user))->first();

        if(!empty($courses) && !empty($user)){
            $lessons = $modelLesson->find()->where(['id_course'=>$courses->id])->all()->toList();
            $checkUsercourses = $modelUserCourse->find()->where(['id_course'=>$courses->id,'id_user'=>$user->id])->first();
            if(empty($checkUsercourses)){
                $checkUsercourses = $modelUserCourse->newEmptyEntity();
                $checkUsercourses->id_user = $user->id;
                $checkUsercourses->name = $courses->title;
                $checkUsercourses->titleen = $courses->titleen;
                $checkUsercourses->id_course = $courses->id;
                $checkUsercourses->created_at = time();
                $checkUsercourses->id_transaction = (int)$id_transaction;
                $checkUsercourses->note = '';

                $listlessons = array();

                if(!empty($lessons)){
                    foreach($lessons as $key => $value){
                        $listlessons[] = array('id'=>$value->id,
                            'title'=>$value->title,
                            'title_en'=>$value->titleen,
                            'status'=>'not',
                            'youtube_code'=>$value->youtube_code,

                        );
                    }
                }
                $checkUsercourses->status_lesson = json_encode($listlessons);
                $modelUserCourse->save($checkUsercourses);
            }
        }

    }
    return 'id không tồn tại';

}

function createPackageUser($id_user, $id_package,$id_transaction=0){
    global $controller;
    $modelUserPackages = $controller->loadModel('UserPackages');
    $modelUser = $controller->loadModel('Users');

    $modelTransactions = $controller->loadModel('Transactions');
    $modelPackageWorkout = $controller->loadModel('PackageWorkouts');

    $transactions = $modelTransactions->find()->where(['id' =>(int)$id_transaction])->first();

    if(!empty($id_user) && !empty($transactions)) {

        $package = $modelPackageWorkout->find()->where(array('id'=>(int)$id_package,'status'=>'active'))->first();
        $user = $modelUser->find()->where(array('id'=>(int)$id_user))->first();

        if(!empty($package) && !empty($user)){

            $checkUserPackages = $modelUserPackages->find()->where(['id_package'=>$package->id,'id_user'=>$user->id])->first();
            if(empty($checkUserPackages)){
                $checkUserPackages = $modelUserPackages->newEmptyEntity();
                $checkUserPackages->id_user = $user->id;
                $checkUserPackages->name = $package->title;
                $checkUserPackages->name_en = $package->title_en;
                $checkUserPackages->id_package = $package->id;

                $checkUserPackages->date_start = time();
                $checkUserPackages->created_at = time();
                $checkUserPackages->id_transaction = (int)$id_transaction;
                $checkUserPackages->note = '';

                if(!empty($transactions->type_use)){
                    $number_day = 0;
                    if(!empty($package->price_package)){
                        $price_package = json_decode($package->price_package, true);
                        foreach($price_package as $key => $item){
                            if($item['id']==(int)$transactions->type_use){
                                $number_day = (int)$item['number_day'];
                            }
                        }
                    }
                    
                    $checkUserPackages->deadline = strtotime('+'.$number_day.' days', time());
                }else{
                    $checkUserPackages->deadline = 0;
                }
                $user->status_pay_package = 1;
                $modelUser->save($user);
                $modelUserPackages->save($checkUserPackages);

            }
        }
    }
    return 'id không tồn tại';
}


global $listArea;



global $listLevel;

$listLevel = [1=> array('id'=> 1, 'name'=> 'Người mới', 'name_en'=>''),
    2 => array( 'id'=> 2,'name'=> 'Trung bình', 'name_en'=>''),
    3=> array( 'id'=> 3,'name'=> 'Trình độ cao', 'name_en'=>''),
];

global $listUnit;

$listUnit = [array('id'=>1,'title'=> 'Hệ mét' , 'unit'=>'kg, m, cm và gam'),
            array('id'=>2,'title'=> 'Hệ thống đế quốc' , 'unit'=>'lbs, ft, in và oz'),
];

?>