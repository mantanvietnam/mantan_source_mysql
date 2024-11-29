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

        $reply_ai = array();
        $dataSend = array();
        if($isRequestPost){
            $dataSend = $input['request']->getData();
            $question = 'Lên kế hoạch và Ý tưởng nội dung Viết 10 bài viết quảng Facebook, ';

           $question = 'Viết 10 bài quảng cáo Facebook để bán sản phẩm '.@$dataSend['topic'].' cho đối tượng khách hàng là '.@$dataSend['customer_target'].'. Đảm bảo rằng bài viết mang cảm xúc '.@$dataSend['feeling'].', đồng thời nhấn mạnh những lợi ích là '.@$dataSend['benefit'].'. Kết thúc với một CTA '.@$dataSend['end'].'. Thêm 3 emoji vào đâu và cuối câu .';

           /* if(!empty($dataSend['topic'])){
                $question .= 'chủ đề về '.$dataSend['topic'];
            }
            if(!empty($dataSend['customer_target'])){
                $question .=  'người tiếp cận '.$dataSend['customer_target'];
            }*/
            $conversation_id ='';
            if(!empty($dataSend['conversation_id'])){
                $conversation_id =  $dataSend['conversation_id'];

                if(!empty($dataSend['chat'])){
                    $question = $dataSend['chat'];
                }
            }

            $reply_ai = callAIphoenixtech($question,$conversation_id);



        }
        setVariable('reply_ai', $reply_ai);
        setVariable('dataSend', $dataSend);
    }else{
        return $controller->redirect('/login');
    }
}

 ?>