<?php 

require_once __DIR__ . '/lib/google/vendor/autoload.php';

global $urlCreateImage;


$urlCreateImage = 'http://14.225.238.137:3000/convert';

$menus= array();
$menus[0]['title']= 'Quản lý SPA';

$menus[0]['sub'][0]= array('title'=>'Tài khoản quản trị SPA',
                            'url'=>'/plugins/admin/databot_spa-view-admin-member-listMemberAdmin.php',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listMemberAdmin.php',
                        );
$menus[0]['sub'][1]= array('title'=>'Danh sách SPA',
                            'url'=>'/plugins/admin/databot_spa-view-admin-spa-listSpaAdmin.php',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listSpaAdmin.php',
                        );

addMenuAdminMantan($menus);

global $urlHomes;
global $google_clientId;
global $google_clientSecret;
global $google_redirectURL;

/*
$google_clientId= '637094275991-k51plafaifed1t08s9h9aukvl8g540md.apps.googleusercontent.com';
$google_clientSecret= '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';
*/
$google_clientId= '637094275991-2f53f5g9ls2d34r05ugshhugb57ng4rm.apps.googleusercontent.com';
$google_clientSecret= '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';

$google_redirectURL= $urlHomes . 'ggCallback';
        

function createToken($length=30)
{
    $chars = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    return substr(str_shuffle($chars), 0, $length).time();
}

global $type_collection_bill;
$type_collection_bill = array(      'tien_mat'=>'Tiền mặt',
                                    'chuyen_khoan'=>'Chuyển khoản',
                                    'the_tin_dung'=>'Quẹt thẻ',
                                    'vi_dien_tu'=>'Ví điện tử',
                                    'hinh_thuc_khac'=>'Hình thức khác',
                                );

function getListPermission()
{
    return array(   array( 'name'=>'Quản lý SPA',
                            'sub'=>array(   array('name'=>'Danh sách Spa ','permission'=>'listSpa'),
                                            array('name'=>'Thêm và sửa Spa ','permission'=>'addSpa'),
                                            array('name'=>'Xóa Spa ','permission'=>'deleteSpa'),
                                    ),
                    ),
                    array( 'name'=>'Quản lý sản phẩm',
                            'sub'=>array(   array('name'=>'Danh sách sản phẩm ','permission'=>'listProduct'),
                                            array('name'=>'Thêm và sửa sản phẩm ','permission'=>'addProduct'),
                                            array('name'=>'Xóa sản phẩm ','permission'=>'deleteProduct'),
                                            array('name'=>'Danh nục sản phẩm ','permission'=>'listCategoryProduct'),
                                            array('name'=>'Xóa danh nục sản phẩm ','permission'=>'deleteCategoryProduct'),
                                            array('name'=>'Nhãn hiệu sản phẩm ','permission'=>'listTrademarkProduct'),
                                            array('name'=>'Xóa nhãn hiệu sản phẩm ','permission'=>'deleteTrademarkProduct'),
                                    ),
                    ),
                    array( 'name'=>'Quản lý dịch vụ',
                            'sub'=>array(   array('name'=>'Danh sách dịch vụ ','permission'=>'listService'),
                                            array('name'=>'Thêm và sửa dịch vụ ','permission'=>'addService'),
                                            array('name'=>'Xóa dịch vụ ','permission'=>'deleteService'),
                                            array('name'=>'Danh nục dịch vụ ','permission'=>'listCategoryService'),
                                            array('name'=>'Xóa danh nục dịch vụ ','permission'=>'deleteCategoryService'),
                                    ),
                    ),
                    array( 'name'=>'Quản lý combo',
                            'sub'=>array(   array('name'=>'Danh sách combo ','permission'=>'listCombo'),
                                            array('name'=>'Thêm và sửa combo ','permission'=>'addCombo'),
                                            array('name'=>'Xóa combo ','permission'=>'deleteCombo'),
                                    ),
                    ), 
                    array( 'name'=>'Quản lý nhân viên',
                            'sub'=>array(   array('name'=>'Danh sách nhân viên ','permission'=>'listStaff'),
                                            array('name'=>'Thêm và sửa nhân viên','permission'=>'addStaff'),
                                            array('name'=>'Khóa nhân viên','permission'=>'lockStaff'),
                                            array('name'=>'Nhóm nhân viên','permission'=>'listGroupStaff'),
                                            array('name'=>'Thêm và sửa nhóm nhân viên','permission'=>'addGroupStaff'),
                                            array('name'=>'Đổi mật khẩu nhân viên','permission'=>'changePassStaff'),
                                    ),
                    ),
                    array( 'name'=>'Quản lý thẻ trả trước',
                            'sub'=>array(   array('name'=>'Danh sách thẻ trả trước ','permission'=>'listPrepayCard'),
                                            array('name'=>'Thêm và sửa thẻ trả trước','permission'=>'addPrepayCard'),
                                            array('name'=>'Xóa thẻ trả trước','permission'=>'deletePrepayCard'),
                                            array('name'=>'Bán thẻ trả trước','permission'=>'buyPrepayCard'),
                                            array('name'=>'In phiêu thu thẻ trả trước','permission'=>'printInfoBillCard'),
                                            array('name'=>'Danh sách khách hàng có thẻ trả trước','permission'=>'listCustomerPrepayCard'),
                                    ),
                    ),
                    array( 'name'=>'Quản lý phòng và giường',
                            'sub'=>array(   array('name'=>'Danh sách phòng','permission'=>'listRoom'),
                                            array('name'=>'Thêm và sửa phòng','permission'=>'addRoom'),
                                            array('name'=>'Xóa phòng','permission'=>'deleteRoom'),
                                            array('name'=>'Danh sách giường','permission'=>'listBed'),
                                            array('name'=>'Thêm và sửa giường','permission'=>'addBed'),
                                            array('name'=>'Xóa giường','permission'=>'deleteBed'),
                                            array('name'=>'sơ đồ giường','permission'=>'listRoomBed'),
                                            array('name'=>'thông tin giường','permission'=>'infoRoomBed'),
                                            array('name'=>'Hủy giường','permission'=>'cancelBed'),
                                            array('name'=>'Trả giường','permission'=>'checkoutBed'),
                                    ),
                    ),
                    array( 'name'=>'Quản lý bán hàng',
                            'sub'=>array(   array('name'=>'Bán sản phẩm','permission'=>'orderProduct'),
                                            array('name'=>'Bác combo','permission'=>'orderCombo'),
                                            array('name'=>'Bán dịch vụ','permission'=>'orderService'),
                                            array('name'=>'Danh đơn sản phẩn','permission'=>'listOrderProduct'),
                                            array('name'=>'Danh đơn combo','permission'=>'listOrderCombo'),
                                            array('name'=>'Danh đơn dịch vụ','permission'=>'listOrderService'),
                                            array('name'=>'Nhận làm dịch vụ','permission'=>'addUserService'),
                                            array('name'=>'In hóa đơn','permission'=>'printInfoOrder'),
                                    ),
                    ),

                    array( 'name'=>'Quản lý khách hàng',
                            'sub'=>array(   array('name'=>'Danh sách khách hàng ','permission'=>'listCustomer'),
                                            array('name'=>'Thêm và sửa khách hàng','permission'=>'addCustomer'),
                                            array('name'=>'Xóa khách hàng','permission'=>'deleteCustomer'),
                                            array('name'=>'Nhóm khách hàng','permission'=>'listGroupStaff'),
                                            array('name'=>'Thêm và sửa nhóm khách hàng','permission'=>'listCategoryCustomer'),
                                            array('name'=>'Xóa nhóm khách hàng','permission'=>'deleteCategoryCustomer'),
                                            array('name'=>'Thêm và sửa nguồn khách hàng','permission'=>'listSourceCustomer'),
                                            array('name'=>'Xóa nguồn khách hàng','permission'=>'deleteSourceCustomer'),
                                    ),
                    ),
                    array( 'name'=>'Quản lý thu chi',
                            'sub'=>array(   array('name'=>'Danh sách phiếu thu','permission'=>'listCollectionBill'),
                                            array('name'=>'Thêm và sửa phiếu thu','permission'=>'addCollectionBill'),
                                            array('name'=>'Xem phiếu thu','permission'=>'detailCollectionBill'),
                                            array('name'=>'Danh sách phiếu chi','permission'=>'listBill'),
                                            array('name'=>'Thêm và sửa phiếu chi','permission'=>'addBill'),
                                            array('name'=>'Xóa phiếu chi','permission'=>'deleteBill'),
                                           
                                    ),
                    ),
                    array( 'name'=>'Quản lý công nợ',
                            'sub'=>array(   array('name'=>'Danh sách công nợ phải trả','permission'=>'listPayableDebt'),
                                            array('name'=>'Thêm và sửa công nợ phải trả','permission'=>'addPayableDebt'),
                                            array('name'=>'Thanh toán công nợ phải trả','permission'=>'paymentBill'),
                                            array('name'=>'Danh sách công nợ phải thu','permission'=>'listCollectionDebt'),
                                            array('name'=>'Thêm và sửa công nợ phải thu','permission'=>'addCollectionDebt'),
                                            array('name'=>'Thanh toán công nợ phải thu','permission'=>'paymentCollectionBill'),
                                          
                                           
                                    ),
                    ),
                    array( 'name'=>'Quản lý kho',
                            'sub'=>array(   array('name'=>'Danh sách kho','permission'=>'listWarehouse'),
                                            array('name'=>'Thêm và sửa kho','permission'=>'addWarehouse'),
                                            array('name'=>'Xóa kho','permission'=>'deleteWarehouse'),
                                            array('name'=>'Lịch sử nhập hàng vào kho','permission'=>'importHistorytWarehouse'),
                                            array('name'=>'Nhập hàng vào kho','permission'=>'addProductWarehouse'),
                                          
                                           
                                    ),
                    ),
                    array( 'name'=>'Quản lý chiến dịch Marketing',
                            'sub'=>array(   array('name'=>'Danh sách Chiến dịch','permission'=>'listCampain'),
                                            array('name'=>'Thêm và sửa Chiến dịch','permission'=>'addCampain'),
                                            array('name'=>'Xóa Chiến dịch','permission'=>'deleteCampain'),
                                            array('name'=>'Lịch sử giao dịch','permission'=>'transactionHistories'),
                                            array('name'=>'Tạo yêu cầu tiền','permission'=>'createRequestAddMoney'),
                                            array('name'=>'Hướng dẫn tích hợp API','permission'=>'guideAddCustomerCampainApi'),
                                          
                                           
                                    ),
                    ),
                );
}

function sendEmailnewpassword($email='', $fullName='', $pass= '')
{
    $to = array();

    if(!empty($email)){
        $to[]= trim($email);
    
        $cc = array();
        $bcc = array();
        $subject = '[SPA] ' . 'Mã xác thực cấp lại mật khẩu mới';

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
                        Mã xác thực cấp lại mật khẩu mới của bạn là: <b>'.$pass.'</b>
                        
                        <br><br>
                        
                        Trân trọng ./
                    </div>
                    <div class="thong_tin">
                        <div class="line"><div class="line1"></div></div>
                        <div class="cty">
                            <span style="font-weight: bold;">CÔNG TY TNHH GIẢI PHÁP SỐ TOP TOP</span> <br>
                            <span>Phần mềm quản lý Spa chuyên nghiệp</span>
                        </div>
                        <ul class="list-unstyled" style=" font-size: 15px;">
                            <li>Hỗ trợ: Vũ Tuyên Hoàng</li>
                            <li>Mobile: 0828266622</li>
                            <li>Website: <a href="https://databot.vn">https://databot.vn</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </body>
        </html>';

       sendEmail($to, $cc, $bcc, $subject, $content);      
    }
}

function getSpa($id)
{
    global $modelOption;
    global $controller;
    
    $modelSpa = $controller->loadModel('Spas');
        
    $data = $modelSpa->find()->where(['id'=>intval($id)])->first();       
    
    return $data;
}

function getUserId($id)
{
    global $modelOption;
    global $controller;
    
    $modelMembers = $controller->loadModel('Members');
        
    $data = $modelMembers->find()->where(['id'=>intval($id)])->first();       
    
    return $data;
}

function convert_number_to_words($number) {

        $hyphen      = ' ';
        $conjunction = '  ';
        $separator   = ' ';
        $negative    = 'âm ';
        $decimal     = ' phẩy ';
        $dictionary  = array(
            0                   => 'Không',
            1                   => 'Một',
            2                   => 'Hai',
            3                   => 'Ba',
            4                   => 'Bốn',
            5                   => 'Năm',
            6                   => 'Sáu',
            7                   => 'Bảy',
            8                   => 'Tám',
            9                   => 'Chín',
            10                  => 'Mười',
            11                  => 'Mười một',
            12                  => 'Mười hai',
            13                  => 'Mười ba',
            14                  => 'Mười bốn',
            15                  => 'Mười năm',
            16                  => 'Mười sáu',
            17                  => 'Mười bảy',
            18                  => 'Mười tám',
            19                  => 'Mười chín',
            20                  => 'Hai mươi',
            30                  => 'Ba mươi',
            40                  => 'Bốn mươi',
            50                  => 'Năm mươi',
            60                  => 'Sáu mươi',
            70                  => 'Bảy mươi',
            80                  => 'Tám mươi',
            90                  => 'Chín mươi',
            100                 => 'trăm',
            1000                => 'nghìn',
            1000000             => 'triệu',
            1000000000          => 'tỷ',
            1000000000000       => 'nghìn tỷ',
            1000000000000000    => 'nghìn triệu triệu',
            1000000000000000000 => 'tỷ tỷ'
        );

        if (!is_numeric($number)) {
            return false;
        }

        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
    // overflow
            trigger_error(
                'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
                E_USER_WARNING
            );
            return false;
        }

        if ($number < 0) {
            return $negative . convert_number_to_words(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
            case $number < 21:
            $string = $dictionary[$number];
            break;
            case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
            case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
            default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
        }

        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }

        return $string;
}

function process_add_money($number=0, $phone=0)
{
    global $modelOption;
    global $controller;
    global $recommenders;

    $number = (int) $number;
    $order_id = (int) $order_id;

    if($number>=1000){
        $modelTransactionHistories = $controller->loadModel('TransactionHistories');
        $modelMember = $controller->loadModel('Members');

        if(!empty($phone)){
            $data = $modelMember->find()->where(array('phone'=> $phone))->first();
            
            if(!empty($data)){
                // cập nhập số dư tài khoản
                $data->coin += $number;
                $modelMember->save($data);
                
                // tạo lịch sử giao dịch
                $histories = $modelTransactionHistories->newEmptyEntity();

                $histories->id_member = $data->id;
                $histories->coin = $number;
                $histories->type = 'plus';
                $histories->note = 'Chuyển khoản ngân hàng, số dư tài khoản sau giao dịch là '.number_format($data->coin).'đ';
                $histories->create_at = time();
                
                $modelTransactionHistories->save($histories);

                // gửi email
                if(!empty($data->email) && !empty($data->name)){
                    sendEmailAddMoney($data->email, $data->name, $number);
                }

                return 'Nạp tiền thành công cho tài khoản '.$data->phone;
            
            }else{
                return 'Tài khoản '.$data->phone.' không tồn tại';
            }
        }else{
            return 'Nội dung sai cú pháp';
        }
    }else{
        return 'Số tiền nạp phải lớn hơn 1.000đ';
    }
}

function sendEmailAddMoney($email='', $fullName='', $coin= '')
{
    $to = array();

    if(!empty($email)){
        $to[]= trim($email);
    
        $cc = array();
        $bcc = array();
        $subject = '[DATASPA] ' . 'Nạp thành công '.number_format($coin).'đ vào tài khoản';

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
                        Bạn đã nạp thành công '.number_format($coin).'đ vào tài khoản của bạn trên hệ thống Data SPA
                        
                        <br><br>
                        
                        Trân trọng ./
                    </div>
                    <div class="thong_tin">
                        <div class="line"><div class="line1"></div></div>
                        <div class="cty">
                            <span style="font-weight: bold;">CÔNG TY TNHH GIẢI PHÁP SỐ TOP TOP</span> <br>
                            <span>Phần mềm quản lý SPA</span>
                        </div>
                        <ul class="list-unstyled" style="    font-size: 15px;">
                            <li>Hỗ trợ: Trần Ngọc Mạnh</li>
                            <li>Mobile: 0816560000</li>
                            <li>Website: <a href="https://dataspa.vn">https://dataspa.vn</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </body>
        </html>';

        sendEmail($to, $cc, $bcc, $subject, $content);
    }
}

function checkLoginManager($permission='') {
    global $session;
    global $controller;

    

    if(!empty($session->read('infoUser'))){
        $infoUser = $session->read('infoUser');
        if($infoUser->type==1){
            $return = 1;
        }else{
            if(!empty($infoUser->list_permission) && in_array($permission, $infoUser->list_permission)){
                $return = 1;
            }else{
                $return = 0;
            }
        }
    }else{
        $return = 0;
    }
      
    return $return;
}
?>