<?php 
$menus= array();
$menus[0]['title']= "Quản lý thư viện";
$menus[0]['sub'] = [];

$menus[0]['sub'][]= array( 'title'=>'Tài khoản người dùng',
                            'url'=>'/plugins/admin/thuvien-view-admin-member-listMemberAdmin',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listMemberAdmin'
                        );



addMenuAdminMantan($menus);

function sendEmailNewPassword($email='', $fullName='', $pass= '')
{
    global $urlHomes;

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
                        <span>MÃ XÁC THỰC CẤP LẠI MẬT KHẨU</span>
                    </div>
                    <div class="main">
                        <em style="    margin: 10px 0 10px;display: inline-block;">Xin chào '.$fullName.' !</em> <br>
                        <br/>
                        Mã xác thực cấp lại mật khẩu mới của bạn là: <b>'.$pass.'</b>
                        
                        <br><br>
                        
                        Trân trọng ./
                    </div>

                </div>
            </div>
        </body>
        </html>';

       sendEmail($to, $cc, $bcc, $subject, $content);      
    }
}


function getListPermission()
{
    global $session;

    $permission = [];
       
   
    $permission[] = array( 'name'=>'Quản lý nhân viên ',
                    'sub'=>array(   array('name'=>'Danh sách người dùng','permission'=>'listMember'),
                                    array('name'=>'Thêm và sửa thông tin người dùng','permission'=>'addMember'),
                                    array('name'=>'Xóa người dùng','permission'=>'deleteMember'),
                                    array('name'=>'Danh sách nhóm quyền người dùng','permission'=>'listPermission'),
                                    array('name'=>'Thêm và sửa nhóm quyền thông tin người dùng','permission'=>'addPermission'),
                                    array('name'=>'Xóa nhóm quyền người dùng','permission'=>'detelePermission'),
                                    array('name'=>'Xem băng lịch sử hành dộng người dùng','permission'=>'listActivityHistory'),
                            )
                        
                    );

    $permission[] = array( 'name'=>'Quản lý chức vụ ',
                    'sub'=>array(   array('name'=>'Danh sách chức vụ','permission'=>'listCategory'),
                                    array('name'=>'Xóa chức vụ','permission'=>'deleteCategory'),
                            )
                        
                    );
    
    $permission[] = array( 'name'=>'Quản lý nhà xuất bản',
                    'sub'=>array(   array('name'=>'Danh sách nhà xuất bản','permission'=>'listPublisher'),
                                    array('name'=>'Thêm và sửa nhà xuất bản','permission'=>'addPublisher'),
                                    array('name'=>'Xóa nhà xuất bản','permission'=>'deletePublisher'),
                            )
                        
                    );

    $permission[] = array( 'name'=>'Quản lý sách ',
    
                    'sub'=>array(   array('name'=>'Danh sách','permission'=>'listbook'),
                                    array('name'=>'Thêm và sửa thông tin sách','permission'=>'addbook'),
                                    array('name'=>'Xóa sách','permission'=>'deletebook'),
                                    array('name'=>'Thêm danh mục sách','permission'=>'categorybook'),
                                 
                            )
                        
                    );
    $permission[] = array( 'name'=>'Quản lý nhập sách',
    
                    'sub'=>array(   array('name'=>'Nhập sách','permission'=>'changequanlitybook'),
                                    array('name'=>'Lịch sử nhập sách','permission'=>'historybook'),
                                  
                            )
                        
                    );
    $permission[] = array( 'name'=>'Quản kho ',
    
                    'sub'=>array(   array('name'=>'Danh toàn nhà','permission'=>'listBuilding'),
                                    array('name'=>'Thêm và sửa thông tin toàn nhà','permission'=>'addBuilding'),
                                    array('name'=>'Xóa toàn nhà','permission'=>'deleteBuilding'),
                            )
                        
                    );

    $permission[] = array( 'name'=>'Quản lý người mượn sách',
    
                    'sub'=>array(   array('name'=>'Danh sách người mượn','permission'=>'listCustomer'),
                                    array('name'=>'Thêm và sửa thông tin người mượn','permission'=>'addCustomer'),
                                    array('name'=>'Xóa thông tin người mượn sách','permission'=>'deleteCustomer'),
                            )
                        
                    );

     $permission[] = array( 'name'=>'Quản lý Kho',
    
                    'sub'=>array(   array('name'=>'Danh sách tòa nhà','permission'=>'listBuilding'),
                                    array('name'=>'Thêm và sửa thông tin tòa nhà','permission'=>'addBuilding'),
                                    array('name'=>'Xóa thông tin tòa nhà','permission'=>'deleteBuilding'),

                                    array('name'=>'Danh sách tầng','permission'=>'listFloor'),
                                    array('name'=>'Thêm và sửa thông tin tầng','permission'=>'addFloor'),
                                    array('name'=>'Xóa thông tin tầng','permission'=>'deleteFloor'),

                                    array('name'=>'Danh sách phòng','permission'=>'listRoom'),
                                    array('name'=>'Thêm và sửa thông tin phòng','permission'=>'addRoom'),
                                    array('name'=>'Xóa thông tin phòng','permission'=>'deleteRoom'),

                                    array('name'=>'Danh sách kệ','permission'=>'listShelf'),
                                    array('name'=>'Thêm và sửa thông tin kệ','permission'=>'addShelf'),
                                    array('name'=>'Xóa thông tin kệ','permission'=>'deleteShelf'),

                                    array('name'=>'Danh sách kho','permission'=>'listWarehouse'),
                                    array('name'=>'Xuất và hủy kho','permission'=>'addWarehouse'),
                                    array('name'=>'Xem lịch sử xuất hủy sách trong kho','permission'=>'historyWarehouse'),
                            )
                        
                    );

        $permission[] = array( 'name'=>'Quản lý mượn sách',
    
                    'sub'=>array(   array('name'=>'Danh sách mượn sách','permission'=>'listOrder'),
                                    array('name'=>'Thêm và sửa thông tin mượn sách','permission'=>'addOrder'),
                                    array('name'=>'Xóa thông tin mượn sách','permission'=>'deleteOrder'),
                                    array('name'=>'Chi tiết thông tin danh sách mượn sách','permission'=>'listOrderDetail'),
                                    array('name'=>'Thêm và sửa chi tiết thông tin mượn sách','permission'=>'addOrderDetail'),
                                    array('name'=>'Xóa thông tin chi tiết mượn sách','permission'=>'deleteOrderDetail'),

                            )
                        
                    );
    
    
    return $permission;
}

function checklogin($permission=''){
    global $session;
    global $controller;

    $modelMember = $controller->loadModel('Members');
     $user = '';
   if(!empty($session->read('infoUser'))){
        $user = $session->read('infoUser');
        if($user->type=='boss'){
             $user->grant_permission = 1;

        }else{
            $info_member = $modelMember->find()->where(['id'=>$user->id])->first();
            if(!empty($info_member)){
                $user->permission = $info_member->permission;
            }
            if(!empty($permission)){
                if(!empty($user->permission) && in_array($permission, json_decode($user->permission, true))){
                        $user->grant_permission = 1;
                }else{
                    $user->grant_permission = 0;
                }
            }else{
                $user->grant_permission = 1;
            }
        }        
    }else{
       $user ='';  
    }  
      
    return $user; 
}

function addActivityHistory($user=array(),$note='',$keyword='',$id_key=0){


    global $controller;
    $modelActivityHistory = $controller->loadModel('ActivityHistorys');

    $history = $modelActivityHistory->newEmptyEntity();
    $history->note = $note;
    $history->type = $user->type;
    $history->id_staff = $user->id_staff;
    $history->id_member = $user->id;
    $history->keyword = $keyword;
    $history->time = time();
    $history->id_key = $id_key;
    $modelActivityHistory->save($history);


}

?>