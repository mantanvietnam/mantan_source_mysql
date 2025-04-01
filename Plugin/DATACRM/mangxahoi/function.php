<?php 


$menus= array();
$menus[0]['title']= "Mạng xã hội";
$menus[0]['sub'] = [];

$menus[0]['sub'][]= array( 'title'=>'Cài đặt keyword nhạy cảm',
                            'url'=>'/plugins/admin/mangxahoi-view-admin-keyword-listkeywordAdmin',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listkeywordAdmin'
                        );



addMenuAdminMantan($menus);


function getSubComment($id_father, $modelComment,$modelCustomer){
     $listData = $modelComment->find()->where(['id_father'=>$id_father])->all()->toList();
     $select = ['Customers.id','Customers.full_name','Customers.phone','Customers.email','Customers.address','Customers.sex','Customers.id_city','Customers.id_messenger','Customers.avatar','Customers.status','Customers.id_parent','Customers.id_level','Customers.birthday_date','Customers.birthday_month','Customers.birthday_year','Customers.id_aff','Customers.created_at','Customers.id_group','Customers.facebook','Customers.id_zalo'];
    if(!empty($listData)){
        foreach ($listData as $key => $value) {
            $listData[$key]->subcomment = getSubComment($value->id, $modelComment,$modelCustomer);
            $listData[$key]->infoCustomer = $modelCustomer->find()->select($select)->where(['id'=>$value->id_customer])->first();
        }
    }

    return $listData;
}


function deletelikeIdObject($id_object, $keyword){
    global $controller;
    $modelLike = $controller->loadModel('Likes');
    $modelCustomer = $controller->loadModel('Customers');

    $conditions = ['id_object IN'=>$id_object,'keyword'=>$keyword];
    $modelLike->deleteAll($conditions);
    return 'ok';
}

function deleteCommentIdObject($id_object, $keyword){
    global $controller;
    $modelComment = $controller->loadModel('Comments');
    $modelCustomer = $controller->loadModel('Customers');

    $conditions = ['id_object IN'=>$id_object,'keyword'=>$keyword];
    $modelComment->deleteAll($conditions);
    return 'ok';
}

function checkKeyword($keyword){
    global $controller;
     $modelKeyword = $controller->loadModel('Keywords');
     $listData = $modelKeyword->find()->where(array())->order(['id'=>'desc'])->all()->toList();
     if(!empty($listData) && !empty($keyword)){
        foreach($listData as $key => $item){
            $keyword =  str_replace($item->keyword, $item->replacement, $keyword);
        }
     }
    return $keyword;
}


function saveNotification($notification, $id_user, $id=null, $type='customer'){
    global $controller;
    if(is_array($id_user)){
        foreach($id_user as $key => $item){
            $id_user[$key] ='"'.$item.'"';
        }
    }else{
         $id_user = ['"'.$id_user.'"'];
    }
    $modelNotification = $controller->loadModel('Notifications');
    $data = $modelNotification->newEmptyEntity();
    $data->id_user = implode(',', $id_user);
    $data->title = $notification['title'];
    $data->created_at = time();
    $data->action = $notification['action'];
    $data->type = $type;
    $data->content = $notification['content'];
    $data->id_object = $id;
    $modelNotification->save($data);
    return $data;
}

function sendEmailCustomerRequestCheck($userName = '',$phone='')
{
    global $controller;
    global $modelOptions;

    if(function_exists('listPonint')){
        $listPonint =  listPonint();
    }

    if(!empty($listPonint['email_notification'])){
        $listSupportAdmin = explode(',', $listPonint['email_notification']);

        $to = $listSupportAdmin;

        $cc = array();
        $bcc = array();
        $subject = '[CRM] ' . 'Khách hàng yêu cầu tích xanh';

        $content='<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Thông tin nạp tiền EXC-GO</title>
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
                        <span>Yêu cầu tích xanh</span>
                    </div>
                    <div class="main">
                        <em style="    margin: 10px 0 10px;display: inline-block;">Xin chào Admin!</em> <br>
                        <br/>
                        khách hàng: '.$userName.'. đã gửi yêu cầu tích xanh 
                        <br>
                        SỐ điện thoại: '.$phone.' 

                        <br>
                        
                        Trân trọng ./
                    </div>
                    <div class="thong_tin">
                        <div class="line"><div class="line1"></div></div>
                        <div class="cty">
                            <span style="font-weight: bold;">Phoenixcamp</span> <br>
                        </div>
                        <ul class="list-unstyled" style="font-size: 15px;">
                            <li>Hỗ trợ: Trần Ngọc Mạnh</li>
                            <li>Mobile: 0816560000</li>
                            <li>Website: <a href="#">https://crm.phoenixcamp.vn/</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </body>
        </html>';

        sendEmail($to, $cc, $bcc, $subject, $content);
    }
}

function zipImage($urlLocalFile='')
{
    if(!empty($urlLocalFile)){
        if(function_exists('getKey') && function_exists('getByIdCategoryKey')){
            $getid =getByIdCategoryKey();
            $keyTinipng = getKey($getid['id_tinypng']);
        }else{
            $keyTinipng = '';
        }
      
        if(!empty($keyTinipng) && file_exists($urlLocalFile)){
            require_once("library/tinify/vendor/autoload.php");
            Tinify\setKey($keyTinipng);

            Tinify\fromFile($urlLocalFile)->toFile($urlLocalFile);
        }
    }
}

function getsocial(){
    return array('like',
                'dislike',
                'love', 
                'wow',
                'care',
                'haha',
                'sad',
                'angry',);
}

?>