<?php 
$menus= array();
$menus[0]['title']= "PHOENIX AI";
$menus[0]['sub'] = [];

$menus[0]['sub'][]= array( 'title'=>'Khách hàng',
                            'url'=>'/plugins/admin/phoenix_ai-view-admin-member-listMemberAdmin',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listMemberAdmin'
                        );

$menus[0]['sub'][]= array( 'title'=>'AI trợ lý ảo',
                            'url'=>'/plugins/admin/phoenix_ai-view-admin-dataai-listDataAIAdmin',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listDataAIAdmin'
                        );
$menus[0]['sub'][]= array( 'title'=>'Cài đặt',
                            'url'=>'/plugins/admin/phoenix_ai-view-admin-settingPhoenixAI',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'settingPhoenixAI'
                        );

addMenuAdminMantan($menus);

global $keyDify;

 $keyDify = 'app-4yYewPLJhBWuYUbDMXGuLxQi';

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

function checklogin($permission=''){
    global $session;
    $user = '';

    if(!empty($session->read('infoUser'))){
        $user = $session->read('infoUser');
    }

    return $user; 
}

function callAIphoenixtech($query,$conversation_id=''){
    global $keyDify;

    // $header = array('Authorization'=>'Bearer app-4yYewPLJhBWuYUbDMXGuLxQi', 'Content-Type'=>'application/json');
   // $dataPost= array('query'=>$query,'response_mode'=>'streaming','conversation_id'=>'','user'=>'Dify');

   // $dataPost = '{
   //  "inputs": {},
   //  "query": "'.$query.'",
   //  "response_mode": "streaming",
   //  "conversation_id": "",
   //  "user": "abc-123"
   //  }';

    // debug($header);
    // debug($dataPost);
    //$data= sendDataConnectMantan('https://dify.phoenixtech.vn/v1/chat-messages', $dataPost,$header,'raw');
    // $data= str_replace('ï»¿', '', utf8_encode($data));
    // $data= json_decode($data, true);

    // debug($data);
    // die;

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://dify.phoenixtech.vn/v1/chat-messages',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{
        "inputs": {},
        "query": "'.$query.'",
        "response_mode": "streaming",
        "conversation_id": "'.$conversation_id.'",
        "user": "abc-123"
        }',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer app-4yYewPLJhBWuYUbDMXGuLxQi',
        'Content-Type: application/json'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
   // echo $response;

    

    // Chuỗi đầy đủ từ input

    // Tách chuỗi thành từng phần tử dữ liệu JSON
    $pattern = '/data: (.+?)(?=\ndata: |$)/s';
    preg_match_all($pattern, $response, $matches);

    // Mảng lưu trữ các câu trả lời
    $answers = [];

    // Duyệt qua từng phần tử JSON và trích xuất "answer"
    foreach ($matches[1] as $json) {
        $data = json_decode($json, true);
        if (isset($data['answer'])) {
            $answers[] = $data['answer'];
        }
    }

    // Kết hợp các câu trả lời thành chuỗi hoàn chỉnh
    $result = implode('', $answers);

    // Sử dụng regex để tìm các giá trị conversation_id
    preg_match_all('/"conversation_id":\s*"([^"]+)"/', $response, $matches);

    // Lấy tất cả các conversation_id
    $conversationIds = $matches[1];

    $conversation_id ='';
    foreach ($conversationIds as $id) {
      $conversation_id =$id;
    }


    return array('result'=>$result,'conversation_id'=>$conversation_id);

}

function listBostAi(){
    return array(
           1 => array('id'=>1,'name'=>'Phoenix Ai', 'boot'=>'Social Media Manager', 'title'=>'Viết 10 bài viết đăng Facebook', 'district'=>'Lên kế hoạch, viết bài cho social media thật đơn giản' , 'type'=>'content_facebook' ,'avatar'=>'/plugins/phoenix_ai/view/home/assets/img/ai1.jpg' , 'url'=>'sendContentFacebook'),
           2 => array('id'=>2,'name'=>'Phoenix Ai', 'boot'=>'Social Media Manager', 'title'=>'Viết bài blog dựa trên nội dung/tiêu đề', 'district'=>'Viết bài blog từ A-Z chuẩn SEO 3000 từ' , 'type'=>'content_blog' ,'avatar'=>'/plugins/phoenix_ai/view/home/assets/img/ai1.jpg' , 'url'=>'sendcontentBlog'),
           3 => array('id'=>3,'name'=>'Phoenix Ai', 'boot'=>'Social Media Manager', 'title'=>'Viết bài blog dựa trên nội dung-tiêu đề, có ảnh', 'district'=>'Viết bài blog từ A-Z chuẩn SEO 3000 từ' , 'type'=>'write_contentimage' ,'avatar'=>'/plugins/phoenix_ai/view/home/assets/img/ai1.jpg' , 'url'=>'writecontentimage'),
           4 => array('id'=>4,'name'=>'Phoenix Ai', 'boot'=>'copywriting', 'title'=>'Tái chế nội dung đỉnh cao - VIP', 'district'=>'Biến 1 nội dung bất kỳ thành nội dung cho video Youtube, Tiktok và bài đăng Facebook, Instagram bạn muốn chỉ với 1 click' , 'type'=>'write_contentimage' ,'avatar'=>'/plugins/phoenix_ai/view/home/assets/img/ai1.jpg' , 'url'=>'sendContentVideo'),
           5 => array('id'=>5,'name'=>'Phoenix Ai', 'boot'=>'copywriting', 'title'=>'Viết mẫu quảng cáo Facebook ', 'district'=>'Giúp bạn tạo ra 1 quảng cáo facebook đỉnh cao và chuyên nghiệp cho sản phẩm của bạn' , 'type'=>'content_facebook_ads' ,'avatar'=>'/plugins/phoenix_ai/view/home/assets/img/ai1.jpg' , 'url'=>'sendContentFacebookAds'),
           6 => array('id'=>6,'name'=>'Phoenix Ai', 'boot'=>'copywriting', 'title'=>'Lên chiến dịch quảng cáo Google Ads ', 'district'=>'Giúp bạn lên kế hoạch chạy quảng cáo Google ads từ A-Z' , 'type'=>'content_google_ads' ,'avatar'=>'/plugins/phoenix_ai/view/home/assets/img/ai1.jpg' , 'url'=>'sendContentGoogleAds'),
           7 => array('id'=>7,'name'=>'Phoenix Ai', 'boot'=>'copywriting', 'title'=>'Tạo 5 mẫu quảng cáo sáng tạo dựa trên mẫu cho trước ', 'district'=>'Giúp bạn tạo ra 5 mẫu quảng cáo sáng tạo' , 'type'=>'content_creativefacebook_ads' ,'avatar'=>'/plugins/phoenix_ai/view/home/assets/img/ai1.jpg' , 'url'=>'wirefacebookcontent'),
           8 => array('id'=>8,'name'=>'Phoenix Ai', 'boot'=>'copywriting', 'title'=>'Tạo 6 bài viết facebook từ nội dung bất kì ', 'district'=>'Giúp bạn tạo ra các bài viết thu hút người xem' , 'type'=>'content_facebooksix_ads' ,'avatar'=>'/plugins/phoenix_ai/view/home/assets/img/ai1.jpg' , 'url'=>'wirefacebookcontentsix'),
           9 => array('id'=>9,'name'=>'Phoenix Ai', 'boot'=>'copywriting', 'title'=>'Lên ý tưởng không giới hạn', 'district'=>'Lên ý tưởng không giới hạn' , 'type'=>'content_tiktok' ,'avatar'=>'/plugins/phoenix_ai/view/home/assets/img/ai1.jpg' , 'url'=>'sendContenTiktok'),
           10 => array('id'=>10,'name'=>'Phoenix Ai', 'boot'=>'copywriting', 'title'=>'Viết 10 bài đăng Facebook truyền cảm hứng (5)', 'district'=>'Viết 10 bài đăng Facebook truyền cảm hứng (5)' , 'type'=>'content_inspirational' ,'avatar'=>'/plugins/phoenix_ai/view/home/assets/img/ai1.jpg' , 'url'=>'sendinspirationalFacebook'),
           
           
    );
}

?>