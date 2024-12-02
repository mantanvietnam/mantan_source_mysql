<?php 
function sendcontentFacebookAPI($input){
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

     if(!empty($session->read('infoUser'))){
        $mess = '';
        $conversation_id = '';
        $member = $session->read('infoUser');
        if(!empty($session->read('connent_facebook_conversation_id'))){
        	$conversation_id = $session->read('connent_facebook_conversation_id');
        }

        $modelContentFacebookAis = $controller->loadModel('ContentFacebookAis');
        $modelHistoryChatAis = $controller->loadModel('HistoryChatAis');

        $reply_ai = array();
        $dataSend = array();
        if($isRequestPost){
            $dataSend = $input['request']->getData();
            $question = 'Lên kế hoạch và Ý tưởng nội dung Viết 10 bài viết quảng Facebook, ';

       

           $question ='Please answer me in Tiếng Việt language and also respond in Tiếng Việt language . Bạn là một chuyên gia chiến lược truyền thông xã hội,  Nhiệm vụ của bạn là tạo ra 1 kế hoạch đăng bài với 10 ý tưởng nội dung với chủ đề '.@$dataSend['topic'].' có khả năng lan truyền mạnh mẽ cho Facebook fanpage sao cho hấp dẫn, phù hợp, và hướng đến đối tượng khách hàng tiềm năng trong lĩnh vực này,'.@$dataSend['customer_target'].'. Mỗi ý tưởng nên bao gồm một chủ đề cụ thể liên quan đến lĩnh vực và xem xét các xu hướng nổi bật hoặc tính thời vụ để tối đa hóa sự tương tác. Đảm bảo rằng các ý tưởng phù hợp với sở thích đa dạng của khán giả trong lĩnh vực và được thay đổi phong phú để giữ cho nội dung luôn mới mẻ và thú vị';

           /* if(!empty($dataSend['topic'])){
                $question .= 'chủ đề về '.$dataSend['topic'];
            }
            if(!empty($dataSend['customer_target'])){
                $question .=  'người tiếp cận '.$dataSend['customer_target'];
            }*/
            if(!empty($conversation_id)){
                if(!empty($dataSend['plan_10facebook_posts'])){
                    $question = $dataSend['plan_10facebook_posts'];
                }
            }

              $reply_ai = callAIphoenixtech($question,$conversation_id);


              $chat = array('result'=>$reply_ai['result'],'conversation_id'=>$reply_ai['conversation_id']);


                $session->write('plan_10facebook_posts', $chat);

             
               return array('code'=> 1, 'mess'=>'lấy dữ liệu thành công', 'data'=>$reply_ai);
        }
         return array('code'=> 0, 'mess'=>'lỗi hệ thống');
       
    }
      return array('code'=> 0, 'mess'=>'chưa đăng nhập');
}


function chatAPI($input){
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

   // if(!empty($session->read('infoUser'))){
        $mess = '';
        $conversation_id = '';
        $member = $session->read('infoUser');
        if(!empty($session->read('connent_facebook_conversation_id'))){
            $conversation_id = $session->read('connent_facebook_conversation_id');
        }

        $modelContentFacebookAis = $controller->loadModel('ContentFacebookAis');
        $modelHistoryChatAis = $controller->loadModel('HistoryChatAis');

        $reply_ai = array();
        $dataSend = array();
        if($isRequestPost){
            $dataSend = $input['request']->getData();
           if(!empty($dataSend['question'])){
                $question = $dataSend['question'];
                $number = $dataSend['number'];

                $conversation_id = @$dataSend['conversation_id'];
            
                $reply_ai = callAIphoenixtech($question,$conversation_id);
                
                $chat = array();
                if(!empty($session->read('chat'))){
                     $chat = $session->read('chat');
                }

                $chat[] = array('question'=>$dataSend['question'],'result'=>$reply_ai['result'],'conversation_id'=>$reply_ai['conversation_id'],'number'=>$number );


                $session->write('chat', $chat);

                return array('code'=> 1, 'mess'=>'lấy dữ liệu thành công', 'data'=>$reply_ai);
            }
        }
         return array('code'=> 0, 'mess'=>'lỗi hệ thống');
       
    /*}
     return array('code'=> 0, 'mess'=>'chưa đăng nhập');*/
}

function chatconnentFacebookAPI($input){
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    if(!empty($session->read('infoUser'))){
        $mess = '';
        $conversation_id = '';
        $member = $session->read('infoUser');
        if(!empty($session->read('connent_facebook_conversation_id'))){
            $conversation_id = $session->read('connent_facebook_conversation_id');
        }

        $modelContentFacebookAis = $controller->loadModel('ContentFacebookAis');
        $modelHistoryChatAis = $controller->loadModel('HistoryChatAis');

        $reply_ai = array();
        $dataSend = array();
        if($isRequestPost){
            $dataSend = $input['request']->getData();
           if(!empty($dataSend['question'])){
                $question = $dataSend['question'];

                $conversation_id = @$dataSend['conversation_id'];
            
                $reply_ai = callAIphoenixtech($question,$conversation_id);
                
                $chat = array();
                if(!empty($session->read('plan_10facebook_posts'))){
                     $chat = $session->read('plan_10facebook_posts');
                }

                // $chat[] = array('question'=>$dataSend['question'],'result'=>$reply_ai['result'],'conversation_id'=>$reply_ai['conversation_id'],'number'=>$number );

                $chat['result'] .= $reply_ai['result'];


                $session->write('plan_10facebook_posts', $chat);

                return array('code'=> 1, 'mess'=>'lấy dữ liệu thành công', 'data'=>$reply_ai);
            }
        }
         return array('code'=> 0, 'mess'=>'lỗi hệ thống');
       
    }
     return array('code'=> 0, 'mess'=>'chưa đăng nhập');
}



 ?>
