<?php 
require_once __DIR__ . '/lib/google/vendor/autoload.php';
require_once __DIR__ . '/lib/zalo/vendor/autoload.php';
date_default_timezone_set('Asia/Ho_Chi_Minh');
global $urlCreateImage;


$urlCreateImage = 'http://14.225.238.137:3000/convert';

$menus= array();
$menus[0]['title']= 'Quản lý dịch vụ';

$menus[0]['sub'][0]= array('title'=>'Tài khoản quản trị',
                            'url'=>'/plugins/admin/databot_spa-view-admin-member-listMemberAdmin',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listMemberAdmin',
                        );
$menus[0]['sub'][1]= array('title'=>'Danh sách cơ sở kinh doanh',
                            'url'=>'/plugins/admin/databot_spa-view-admin-spa-listSpaAdmin',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listSpaAdmin',
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
                                    'cong_no'=>'Công nợ',
                                    'hinh_thuc_khac'=>'Hình thức khác',
                                );

function getListPermission()
{
    global $session;

    $permission = [];
    $infoUser = $session->read('infoUser');

    if(!empty($infoUser->module)){
        if(in_array('static', $infoUser->module)){
            $permission[] = array( 'name'=>'Thống kê',
                                    'sub'=>array(   array('name'=>'Thống kê hoa hồng nhân viên','permission'=>'listAgency'),
                                                    array('name'=>'Thống kê doanh thu','permission'=>'revenueStatistical'),
                                            ),
                            );
        }

        if(in_array('room', $infoUser->module)){
            $permission[] = array( 'name'=>'Quản lý phòng và giường',
                                    'sub'=>array(   array('name'=>'Danh sách phòng','permission'=>'listRoom'),
                                                    array('name'=>'Xóa phòng','permission'=>'deleteRoom'),
                                                    
                                                    array('name'=>'Danh sách giường','permission'=>'listBed'),
                                                    array('name'=>'Xóa giường','permission'=>'deleteBed'),
                                                    array('name'=>'Sơ đồ giường','permission'=>'listRoomBed'),
                                                    array('name'=>'Thông tin giường','permission'=>'infoRoomBed'),

                                                    array('name'=>'Nhận khách vào giường','permission'=>'checkinbed'),
                                                    array('name'=>'Hủy giường','permission'=>'cancelBed'),
                                                    array('name'=>'Trả giường','permission'=>'checkoutBed'),
                                                    
                                            ),
                            );
        }

        if(in_array('bill', $infoUser->module)){
            $permission[] = array( 'name'=>'Quản lý phiếu thu chi',
                                    'sub'=>array(   array('name'=>'Danh sách phiếu thu','permission'=>'listCollectionBill'),
                                                    array('name'=>'Thêm và sửa phiếu thu','permission'=>'addCollectionBill'),
                                                    array('name'=>'Xem phiếu thu','permission'=>'detailCollectionBill'),
                                                    array('name'=>'In phiếu thu','permission'=>'printCollectionBill'),

                                                    array('name'=>'Danh sách phiếu chi','permission'=>'listBill'),
                                                    array('name'=>'Thêm và sửa phiếu chi','permission'=>'addBill'),
                                                    array('name'=>'Xóa phiếu chi','permission'=>'deleteBill'),
                                                    array('name'=>'In phiếu chi','permission'=>'printBill'),
                                                   
                                            ),
                            );

            $permission[] = array( 'name'=>'Quản lý công nợ',
                                    'sub'=>array(   array('name'=>'Danh sách công nợ phải trả','permission'=>'listPayableDebt'),
                                                    array('name'=>'Thêm và sửa công nợ phải trả','permission'=>'addPayableDebt'),
                                                    array('name'=>'Thanh toán công nợ phải trả','permission'=>'paymentBill'),
                                                    
                                                    array('name'=>'Danh sách công nợ phải thu','permission'=>'listCollectionDebt'),
                                                    array('name'=>'Thêm và sửa công nợ phải thu','permission'=>'addCollectionDebt'),
                                                    array('name'=>'Thanh toán công nợ phải thu','permission'=>'paymentCollectionBill'),
                                            ),
                            );
        }

        if(in_array('calendar', $infoUser->module)){
            $permission[] = array( 'name'=>'Quản lý đặt lịch hẹn',
                                    'sub'=>array(   array('name'=>'Danh sách lịch hẹn','permission'=>'listBook'),
                                                    array('name'=>'Thêm và sửa lịch hẹn','permission'=>'addBook'),
                                                    array('name'=>'Xóa lịch hẹn','permission'=>'deleteBook'),
                                                   
                                            ),
                            );
        }

        if(in_array('campain', $infoUser->module)){
            $permission[] = array( 'name'=>'Quản lý chiến dịch Marketing',
                                    'sub'=>array(   array('name'=>'Danh sách chiến dịch','permission'=>'listCampain'),
                                                    array('name'=>'Thêm và sửa chiến dịch','permission'=>'addCampain'),
                                                    array('name'=>'Xóa chiến dịch','permission'=>'deleteCampain'),

                                                    array('name'=>'Danh sách khách theo chiến dịch','permission'=>'listCustomerCampaign'),
                                                    array('name'=>'Xóa khách đăng ký tham gia chiến dịch','permission'=>'deleteCustomerCampain'),
                                            ),
                            );
        }

        if(in_array('combo', $infoUser->module)){
            $permission[] = array( 'name'=>'Quản lý combo',
                                    'sub'=>array(   array('name'=>'Danh sách combo ','permission'=>'listCombo'),
                                                    array('name'=>'Thêm và sửa combo ','permission'=>'addCombo'),
                                                    array('name'=>'Xóa combo ','permission'=>'deleteCombo'),
                                            ),
                            );
        }

        if(in_array('customer', $infoUser->module)){
            $permission[] = array( 'name'=>'Quản lý khách hàng',
                                    'sub'=>array(   array('name'=>'Danh sách khách hàng ','permission'=>'listCustomer'),
                                                    array('name'=>'Thêm và sửa khách hàng','permission'=>'addCustomer'),
                                                    array('name'=>'Thêm khách hàng bằng Excel','permission'=>'addDataCustomer'),
                                                    array('name'=>'Xóa khách hàng','permission'=>'deleteCustomer'),
                                                    array('name'=>'Nhóm khách hàng','permission'=>'listCategoryCustomer'),
                                                    array('name'=>'Xóa nhóm khách hàng','permission'=>'deleteCategoryCustomer'),
                                                    array('name'=>'Thêm và sửa nguồn khách hàng','permission'=>'listSourceCustomer'),
                                                    array('name'=>'Xem hố sơ bệnh án khách hàng','permission'=>'listmedicalHistories'),
                                                    array('name'=>'Thêm hố sơ bệnh án khách hàng','permission'=>'addMedicalHistories'),

                                                    
                                            ),
                            );

            $permission[] = array( 'name'=>'Quản lý cửa hàng',
                                    'sub'=>array(   array('name'=>'Danh sách cửa hàng ','permission'=>'listSpa'),
                                                    array('name'=>'Thêm và sửa cửa hàng ','permission'=>'addSpa'),
                                                    array('name'=>'Xóa cửa hàng ','permission'=>'deleteSpa'),
                                            ),
                            );
        }

        if(in_array('prepaid_cards', $infoUser->module)){
            $permission[] = array( 'name'=>'Quản lý thẻ trả trước',
                                    'sub'=>array(   array('name'=>'Danh sách thẻ trả trước ','permission'=>'listPrepayCard'),
                                                    array('name'=>'Thêm và sửa thẻ trả trước','permission'=>'addPrepayCard'),
                                                    array('name'=>'Xóa thẻ trả trước','permission'=>'deletePrepayCard'),
                                                    array('name'=>'bán thẻ trả trước','permission'=>'buyPrepayCard'),
                                                    array('name'=>'In phiếu thu thẻ trả trước','permission'=>'printInfoBillCard'),
                                                    array('name'=>'Danh sách khách hàng có thẻ trả trước','permission'=>'listCustomerPrepayCard'),
                                            ),
                            );
        }

        if(in_array('product', $infoUser->module)){
            $permission[] = array( 'name'=>'Quản lý sản phẩm',
                                    'sub'=>array(   array('name'=>'Danh sách sản phẩm ','permission'=>'listProduct'),
                                                    array('name'=>'Thêm và sửa sản phẩm ','permission'=>'addProduct'),
                                                    array('name'=>'Xóa sản phẩm ','permission'=>'deleteProduct'),
                                                    array('name'=>'Danh nục sản phẩm ','permission'=>'listCategoryProduct'),
                                                    array('name'=>'Xóa danh nục sản phẩm ','permission'=>'deleteCategoryProduct'),
                                                    array('name'=>'Nhãn hiệu sản phẩm ','permission'=>'listTrademarkProduct'),
                                                    array('name'=>'Xóa nhãn hiệu sản phẩm ','permission'=>'deleteTrademarkProduct'),
                                            ),
                            );

            $permission[] = array( 'name'=>'Quản lý dịch vụ',
                                    'sub'=>array(   array('name'=>'Danh sách dịch vụ ','permission'=>'listService'),
                                                    array('name'=>'Thêm và sửa dịch vụ ','permission'=>'addService'),
                                                    array('name'=>'Xóa dịch vụ ','permission'=>'deleteService'),
                                                    array('name'=>'Danh mục dịch vụ ','permission'=>'listCategoryService'),
                                                    array('name'=>'Xóa danh mục dịch vụ ','permission'=>'deleteCategoryService'),
                                            ),
                            );

            $permission[] = array( 'name'=>'Quản lý đối tác',
                                    'sub'=>array(   array('name'=>'Danh sách đối tác','permission'=>'listPartner'),
                                                    array('name'=>'Thêm và sửa đối tác','permission'=>'addPartner'),
                                                    array('name'=>'Xóa đối tác','permission'=>'deletePartner'),
                                            ),
                            );

            $permission[] = array( 'name'=>'Quản lý kho',
                                    'sub'=>array(   array('name'=>'Danh sách kho','permission'=>'listWarehouse'),
                                                    array('name'=>'Thêm và sửa kho','permission'=>'addWarehouse'),
                                                    array('name'=>'Xóa kho','permission'=>'deleteWarehouse'),
                                                    array('name'=>'Lịch sử nhập hàng vào kho','permission'=>'importHistorytWarehouse'),
                                                    array('name'=>'Nhập hàng vào kho','permission'=>'addProductWarehouse'),
                                                  
                                                   
                                            ),
                            );
        }

        if(in_array('product', $infoUser->module) || in_array('combo', $infoUser->module) || in_array('prepaid_cards', $infoUser->module)){
            $order['name'] = 'Quản lý bán hàng';
            $order['sub'] = [];

            if(in_array('product', $infoUser->module)){
                $order['sub'][] = array('name'=>'Bán sản phẩm','permission'=>'orderProduct');
                $order['sub'][] = array('name'=>'Bán dịch vụ','permission'=>'orderService');
            }

            if(in_array('combo', $infoUser->module)){
                $order['sub'][] = array('name'=>'Bán combo','permission'=>'orderCombo');
            }

            if(in_array('prepaid_cards', $infoUser->module)){
                $order['sub'][] = array('name'=>'Bán thẻ trả trước','permission'=>'buyPrepayCard');
            }

            if(in_array('product', $infoUser->module)){
                $order['sub'][] = array('name'=>'Danh sách đơn sản phẩn','permission'=>'listOrderProduct');
            }

            if(in_array('combo', $infoUser->module)){
                $order['sub'][] = array('name'=>'Danh sách đơn combo','permission'=>'listOrderCombo');
            }

            if(in_array('prepaid_cards', $infoUser->module)){
                $order['sub'][] = array('name'=>'Danh sách đơn dịch vụ','permission'=>'listOrderService');
            }

            if(in_array('product', $infoUser->module)){
                $order['sub'][] = array('name'=>'Nhận khách làm dịch vụ','permission'=>'addUserService');
            }

            $order['sub'][] = array('name'=>'In hóa đơn','permission'=>'printInfoOrder');

            $permission[] = $order;
        }

        if(in_array('staff', $infoUser->module)){
            $permission[] = array( 'name'=>'Quản lý nhân viên',
                                    'sub'=>array(   array('name'=>'Danh sách nhân viên ','permission'=>'listStaff'),
                                                    array('name'=>'Thêm và sửa nhân viên','permission'=>'addStaff'),
                                                    array('name'=>'Khóa nhân viên','permission'=>'lockStaff'),
                                                    array('name'=>'Nhóm nhân viên','permission'=>'listGroupStaff'),
                                                    array('name'=>'Thêm và sửa nhóm nhân viên','permission'=>'addGroupStaff'),
                                                    array('name'=>'Xóa nhóm nhân viên','permission'=>'deteleGroupStaff'),
                                                    array('name'=>'Đổi mật khẩu nhân viên','permission'=>'changePassStaff'),
                                                    array('name'=>'Danh sách tiền thưởng nhân viên','permission'=>'listStaffBonus'),
                                                    array('name'=>'Thêm và sửa tiền thưởng nhân viên','permission'=>'addStaffBonus'),
                                                    array('name'=>'Xóa tiền thưởng nhân viên','permission'=>'deleteStaffBonus'),
                                            ),
                            );
        }

        if(in_array('zalo', $infoUser->module)){
            $permission[] = array( 'name'=>'Quản lý Zalo',
                                    'sub'=>array(   array('name'=>'Nạp tiền tài khoản Zalo OA','permission'=>'createRequestAddMoney'),
                                                    array('name'=>'Lịch sử giao dịch','permission'=>'transactionHistories'),

                                                    array('name'=>'Cài đặt Zalo OA','permission'=>'settingZaloMarketing'),
                                                    
                                                    array('name'=>'Gửi tin nhắn Zalo OA','permission'=>'sendMessZaloOA'),
                                                    
                                                    //array('name'=>'Gửi yêu cầu kết bạn Zalo','permission'=>'addFriendZaloMarketing'),
                                                    
                                            ),
                            );
        }
    }
    return $permission;
}

function sendEmailnewpassword($email='', $fullName='', $pass= '')
{
    $to = array();

    if(!empty($email)){
        $to[]= trim($email);
    
        $cc = array();
        $bcc = array();
        $subject = '[QLDV] ' . 'Mã xác thực cấp lại mật khẩu mới';

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
                            <span style="font-weight: bold;">PHẦN MỀM QUẢN LÝ DỊCH VỤ</span> <br>
                            <span>Phần mềm quản lý dịch vụ chuyên nghiệp</span>
                        </div>
                        <ul class="list-unstyled" style="    font-size: 15px;">
                            <li>Hỗ trợ: Trần Ngọc Mạnh</li>
                            <li>Mobile: 081.656.0000</li>
                            <li>Website: <a href="https://quanlydichvu.com">https://quanlydichvu.com</a></li>
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
        $subject = '[QLDV] ' . 'Nạp thành công '.number_format($coin).'đ vào tài khoản';

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
                        Bạn đã nạp thành công '.number_format($coin).'đ vào tài khoản của bạn trên hệ thống Quản lý dịch vụ
                        
                        <br><br>
                        
                        Trân trọng ./
                    </div>
                    <div class="thong_tin">
                        <div class="line"><div class="line1"></div></div>
                        <div class="cty">
                            <span style="font-weight: bold;">PHẦN MỀM QUẢN LÝ DỊCH VỤ</span> <br>
                            <span>Phần mềm quản lý dịch vụ chuyên nghiệp</span>
                        </div>
                        <ul class="list-unstyled" style="    font-size: 15px;">
                            <li>Hỗ trợ: Trần Ngọc Mạnh</li>
                            <li>Mobile: 081.656.0000</li>
                            <li>Website: <a href="https://quanlydichvu.com">https://quanlydichvu.com</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </body>
        </html>';

        sendEmail($to, $cc, $bcc, $subject, $content);
    }
}

function sendEmailRegAcc($email='', $fullName='', $user= '', $pass= '')
{
    $to = array();

    if(!empty($email)){
        $to[]= trim($email);
    
        $cc = array();
        $bcc = array();
        $subject = '[QLDV] ' . 'Tài khoản phần mềm quản lý dịch vụ';

        $content='<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Tài khoản phần mềm quản lý dịch vụ</title>
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
                        <span>THÔNG TIN TÀI KHOẢN</span>
                    </div>
                    <div class="main">
                        <em style="    margin: 10px 0 10px;display: inline-block;">Xin chào '.$fullName.' !</em> <br>
                        <br/>
                        Bạn đã đăng ký sử dụng phần mềm quản lý SPA thành công, thông tin tài khoản của bạn như sau:
                        <br/><br/>
                        Link đăng nhập: <a href="https://quanlydichvu.com">https://quanlydichvu.com</a><br/>
                        Tài khoản: '.$user.'<br/>
                        Mật khẩu: '.$pass.'<br/>
                        <br><br>
                        
                        Trân trọng ./
                    </div>
                    <div class="thong_tin">
                        <div class="line"><div class="line1"></div></div>
                        <div class="cty">
                            <span style="font-weight: bold;">PHẦN MỀM QUẢN LÝ DỊCH VỤ</span> <br>
                            <span>Phần mềm quản lý dịch vụ chuyên nghiệp</span>
                        </div>
                        <ul class="list-unstyled" style="    font-size: 15px;">
                            <li>Hỗ trợ: Trần Ngọc Mạnh</li>
                            <li>Mobile: 081.656.0000</li>
                            <li>Website: <a href="https://quanlydichvu.com">https://quanlydichvu.com</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </body>
        </html>';

        sendEmail($to, $cc, $bcc, $subject, $content);
    }
}

function checkLoginManager($permission='', $module='') {
    global $session;
    global $controller;

    $return = 0;

    if(!empty($session->read('infoUser'))){
        $infoUser = $session->read('infoUser');
        
        if(!empty($infoUser->module) && in_array($module, $infoUser->module)){
            if($infoUser->type==1){
                $return = 1;
            }else{
                if(!empty($infoUser->list_permission) && in_array($permission, $infoUser->list_permission)){
                    $return = 1;
                }else{
                    //$return = 0;
                    header('Location: /error_permission');
                    die;
                    //return $controller->redirect('/error_permission');
                }
            }
        }else{
            //$return = 0;
            header('Location: /error_permission');
            die;
            //return $controller->redirect('/error_permission');
        }
    }else{
        //$return = 0;
        header('Location: /login');
        die;
        //return $controller->redirect('/login');
    }
      
    return $return;
}

function base64url_encode($plainText)
{
    $base64 = base64_encode($plainText);
    $base64 = trim($base64, "=");
    $base64url = strtr($base64, '+/', '-_');
    return ($base64url);
}

function getAccessTokenZaloOA($id_oa='', $app_id='')
{
    global $controller;

    if(!empty($id_oa) && !empty($app_id)){
        $modelMembers = $controller->loadModel('Members');

        $zalo_oa = $modelMembers->find()->where(['id_app_zalo'=>$app_id, 'id_oa_zalo'=>$id_oa])->first();

        if(!empty($zalo_oa->secret_app_zalo) && !empty($zalo_oa->code_zalo_oa)){
            $url_zns = 'https://oauth.zaloapp.com/v4/oa/access_token';
            $header_zns = ['Content-Type: application/x-www-form-urlencoded', 'secret_key: '.$zalo_oa->secret_app_zalo];
            $data_send_zns = [
                                "code" => $zalo_oa->code_zalo_oa,
                                "app_id" => $app_id,
                                "grant_type" =>  'authorization_code',
                                "code_verifier" => time(),
                            ];

            $return_zns = sendDataConnectMantan($url_zns,$data_send_zns,$header_zns);
            $return_zns = json_decode($return_zns, true);

            if(!empty($return_zns['access_token']) && !empty($return_zns['refresh_token']) && !empty($return_zns['expires_in'])){
                $zalo_oa->access_token_zalo_oa = $return_zns['access_token'];
                $zalo_oa->refresh_token_zalo_oa = $return_zns['refresh_token'];
                $zalo_oa->deadline_token_zalo_oa = time() + $return_zns['expires_in'] - 600;

                $modelMembers->save($zalo_oa);
            }

            return $return_zns;
        }
    }

    return ['error'=>1, 'message'=>'Gửi thiếu dữ liệu'];
}

function refreshTokenZaloOA($id_oa='', $app_id='')
{
    global $controller;

    if(!empty($id_oa) && !empty($app_id)){
        $modelMembers = $controller->loadModel('Members');

        $zalo_oa = $modelMembers->find()->where(['id_app_zalo'=>$app_id, 'id_oa_zalo'=>$id_oa])->first();

        if(!empty($zalo_oa->refresh_token_zalo_oa)){
            $url_zns = 'https://oauth.zaloapp.com/v4/oa/access_token';
            $header_zns = ['Content-Type: application/x-www-form-urlencoded', 'secret_key: '.$zalo_oa->secret_app_zalo];
            $data_send_zns = [
                                "refresh_token" => $zalo_oa->refresh_token_zalo_oa,
                                "app_id" => $app_id,
                                "grant_type" =>  'refresh_token',
                            ];

            $return_zns = sendDataConnectMantan($url_zns,$data_send_zns,$header_zns);
            $return_zns = json_decode($return_zns, true);

            if(!empty($return_zns['access_token']) && !empty($return_zns['refresh_token']) && !empty($return_zns['expires_in'])){
                $zalo_oa->access_token_zalo_oa = $return_zns['access_token'];
                $zalo_oa->refresh_token_zalo_oa = $return_zns['refresh_token'];
                $zalo_oa->deadline_token_zalo_oa = time() + $return_zns['expires_in'] - 600;

                $modelMembers->save($zalo_oa);
            }

            return $return_zns;
        }
    }

    return ['error'=>1, 'message'=>'Gửi thiếu dữ liệu'];
}

function sendZNSZalo($template_id='', $params='', $phone='', $id_oa='', $app_id='')
{
    global $controller;

    $modelMembers = $controller->loadModel('Members');

    if(!empty($template_id) && !empty($params) && !empty($phone)){
        if (substr($phone, 0, 1) === '0') {
            // Thay thế số 0 đầu tiên bằng "84"
            $phone = '84' . substr($phone, 1);
        }

        if(empty($id_oa) || empty($app_id)){
            $zalo_oa = $modelMembers->find()->where(['access_token_zalo_oa IS NOT'=>null, 'deadline_token_zalo_oa >='=>time()])->first();

            if(empty($zalo_oa)){
                $zalo_oa = $modelMembers->find()->where(['access_token_zalo_oa IS NOT'=>null])->first();

                refreshTokenZaloOA($zalo_oa->id_oa_zalo, $zalo_oa->id_app_zalo);

                $zalo_oa = $modelMembers->find()->where(['access_token_zalo_oa IS NOT'=>null, 'deadline_token_zalo_oa >='=>time()])->first();
            }
        }else{
            $zalo_oa = $modelMembers->find()->where(['id_oa_zalo'=>$id_oa, 'id_app_zalo'=>$app_id])->first();

            // nếu token hết hạn
            if($zalo_oa->deadline_token_zalo_oa < time()){
                refreshTokenZaloOA($zalo_oa->id_oa_zalo, $zalo_oa->id_app_zalo);

                $zalo_oa = $modelMembers->find()->where(['id_oa_zalo'=>$id_oa, 'id_app_zalo'=>$app_id])->first();
            }
        }

        if(!empty($zalo_oa->access_token_zalo_oa)){
            $url_zns = 'https://business.openapi.zalo.me/message/template';
            $data_send_zns = [
                                "phone" => $phone,
                                "template_id" => $template_id,
                                "template_data" =>  $params,
                                "tracking_id" => time().rand(0,100),
                            ];
            $header_zns = ['Content-Type: application/json', 'access_token: '.$zalo_oa->access_token_zalo_oa];
            $typeData='raw';
            $return_zns = sendDataConnectMantan($url_zns,$data_send_zns,$header_zns,$typeData);
            return json_decode($return_zns, true);
        }else{
            return ['error'=>2, 'message'=>'Không tìm được Zalo OA phù hợp'];
        }
    }

    return ['error'=>1, 'message'=>'Gửi thiếu dữ liệu'];
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


function getMemberByToken($token='', $permission='', $module='customer')
{
    global $controller;
    $modelMember = $controller->loadModel('Members');
    $modelTokenDevice = $controller->loadModel('TokenDevices');
    $user = [];
   
    $checkToken = $modelTokenDevice->find()->where(['token'=>$token])->first();
    if(!empty($checkToken)){
        $infoUser = $modelMember->find()->where(array('id'=>$checkToken->id_member, 'dateline_at >'=>time(), 'status'=>'1' ))->first();

        if(!empty($infoUser->module)){
            $list_module =json_decode($infoUser->module, true);
        }else{
            $list_module = array();
        }
        if(!empty($infoUser)){
            if($infoUser->type==1){
                if(!empty($infoUser->module) && in_array($module, $list_module)){
                    $infoUser->last_login = time();
                    $modelMember->save($infoUser);
                    $infoUser->token = $checkToken->token;
                    $infoUser->id_member = $infoUser->id;
                    return $infoUser;
                }
            }else{
                $checkMember = $modelMember->find()->where(array('id'=>$infoUser->id_member, 'dateline_at >'=>time(), 'status'=>'1' ))->first();
                 if(!empty($checkMember->module)){
                    $checkMember->module =json_decode($infoUser->module, true);
                }else{
                    $checkMember->module = array();
                }
                
                if(!empty($infoUser->list_permission)){
                    $list_permission =json_decode($infoUser->list_permission, true);
                }else{
                    $list_permission = array();
                }
                if(!empty($checkMember->module) && in_array($module, $checkMember->module) && !empty($list_permission) && in_array($permission, $list_permission)){
                        $infoUser->last_login = time();
                        $modelMember->save($infoUser);
                        $infoUser->token = $checkToken->token;
                        return $infoUser;
                }
            }
            

        }
    }
    return $user;
}


?>