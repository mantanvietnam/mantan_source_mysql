<?php 
function sendconnentBlogController($input){
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    if(!empty($session->read('infoUser'))){
        $mess = '';
        $member = $session->read('infoUser');

        $modelContentFacebookAis = $controller->loadModel('ContentFacebookAis');
        $modelHistoryChatAis = $controller->loadModel('HistoryChatAis');

        }else{
        return $controller->redirect('/login');
    }


    $string = callAIphoenixtech('Lên kế hoạch Ý tưởng nội dung, Mô tả, Chủ đề, Tiêu đề hấp dẫn, Viết 10 bài viết quảng Facebook, chủ đền về quần áo Phong cách trẻ mùa dồng , người tiếp cận khách trẻ nam nữ đội tuổi 19 đến 35 tuổi viết bài dày','d1fb4891-6045-4517-82a7-d0f002ed5b51');
    $string1 = callAIphoenixtech('viết bài 1 thành bài hoàn chỉnh',$string['conversation_id']);
    $string2 = callAIphoenixtech('viết bài 2 thành bài hoàn chỉnh',$string['conversation_id']);
    
    debug($string);
    debug($string1);
    debug($string2);
    
     die;
}

 ?>