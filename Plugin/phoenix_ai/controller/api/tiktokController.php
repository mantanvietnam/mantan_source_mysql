<?php 
function sendContenttTiktokAPI($input){
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

     if(!empty($session->read('infoUser'))){
        $mess = '';
        $conversation_id = '';
        $member = $session->read('infoUser');
        

        $modelContentFacebookAis = $controller->loadModel('ContentFacebookAis');
        $modelHistoryChatAis = $controller->loadModel('HistoryChatAis');

        $reply_ai = array();
        $dataSend = array();
        if($isRequestPost){
            $dataSend = $input['request']->getData();

			$type = implode(',', $dataSend['type']);       

           $question ='Please answer me in Tiếng Việt language and also respond in Tiếng Việt language . Hãy đóng vai 1 chuyên gia social media manager, giúp tạo cho tôi 1 lịch bài đăng content planner cho kênh Tiktok trong 30 ngày về chủ đề '.$dataSend['topic'].', phù hợp với sở thích và giá trị của đối tượng mục tiêu của tôi, '.$dataSend['customer_target'].' , với các thể loại nội dung sau: '.$type.'. Đảm bảo rằng không quá 15% nội dung đề cập trực tiếp đến sản phẩm/dịch vụ; trọng tâm phải là tạo ra nội dung hấp dẫn, có tính lan truyền liên quan đến lĩnh vực sản phẩm/dịch vụ (không cần giải thích lại yêu cầu của tôi, hãy trình bày kết quả in đậm tiêu đề H1: Kế hoạch nội dung 30 ngày cho Tiktok)\n\nPlease arrange each video title in a nice bulleted order. Each day the content is different.' ;

           /* if(!empty($dataSend['topic'])){
                $question .= 'chủ đề về '.$dataSend['topic'];
            }
            if(!empty($dataSend['customer_target'])){
                $question .=  'người tiếp cận '.$dataSend['customer_target'];
            }*/
            if(!empty($conversation_id)){
                if(!empty($dataSend['content_tiktok'])){
                    $question = $dataSend['content_tiktok'];
                }
            }
            $reply_ai = callAIphoenixtech($question,$conversation_id);
            $reply = '<h1>Tạo kịch bản Youtube</h1>'.$reply_ai['result'];
            $reply_ai['result'] = $reply;


            $chat = array('result'=>$reply_ai['result'],'conversation_id'=>@$reply_ai['conversation_id'], 'topic'=>@$dataSend['topic']);


                $session->write('content_tiktok', $chat);
            // $reply_ai['result'] = $html;
            // $reply_ai['abc'] = $abc;
             
               return array('code'=> 1, 'mess'=>'lấy dữ liệu thành công', 'data'=>$chat);
        }
         return array('code'=> 0, 'mess'=>'lỗi hệ thống');
       
    }
      return array('code'=> 0, 'mess'=>'chưa đăng nhập');
}

function chatConteTiktokAPI($input){
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    if(!empty($session->read('infoUser'))){
        $mess = '';
        $conversation_id = '';
        $member = $session->read('infoUser');
        

        $modelContentFacebookAis = $controller->loadModel('ContentFacebookAis');
        $modelHistoryChatAis = $controller->loadModel('HistoryChatAis');

        $reply_ai = array();
        $dataSend = array();
        if($isRequestPost){
            $dataSend = $input['request']->getData();
            
            if(!empty($dataSend['question'])){
                $question = $dataSend['question'];

            }  

            $chat = array();
                if(!empty($session->read('content_tiktok'))){
                     $chat = $session->read('content_tiktok');
                }  


                if(empty($chat['topic'])){
                    $chat['topic'] = 'Dựa vào nội dung trên';
                }
            

             if(!empty($dataSend['type'])){
                if($dataSend['type']=='facebook'){
                    $question = 'Please answer me in Tiếng Việt language and also respond in Tiếng Việt language Bạn là một chuyên gia chiến lược truyền thông xã hội,  Nhiệm vụ của bạn là tạo ra 1 kế hoạch đăng bài với 30 ý tưởng nội dung với chủ đề như đề cập ở trên có khả năng lan truyền mạnh mẽ cho Facebook fanpage sao cho hấp dẫn, phù hợp, và hướng đến đối tượng khách hàng tiềm năng trong lĩnh vực này, [FIELD1]. \nMỗi ý tưởng nên bao gồm một chủ đề cụ thể liên quan đến lĩnh vực và xem xét các xu hướng nổi bật hoặc tính thời vụ để tối đa hóa sự tương tác. Đảm bảo rằng các ý tưởng phù hợp với sở thích đa dạng của khán giả trong lĩnh vực và được thay đổi phong phú để giữ cho nội dung luôn mới mẻ và thú vị.\nPlease arrange each video title in a nice bulleted order. Each day the content is different.';
                }elseif($dataSend['type']=='blog'){
                    $question = "Please answer me in Tiếng Việt language and also respond in Tiếng Việt language . Bạn là một chuyên gia chiến lược truyền thông xã hội, Nhiệm vụ của bạn là tạo ra 1 bài blog đầy đủ không cần giải thích và lên cá tính năng ưu điểm và đặt điểm nổi bật của sản phẩn dịch vụ ở nội dung trên ";
                }
            }


                $conversation_id = @$dataSend['conversation_id'];
            
                $reply_ai = callAIphoenixtech($question,$conversation_id);
                
                $string =$reply_ai['result'];

				if(!empty($dataSend['type'])){
                    if($dataSend['type']=='facebook'){
                        $reply = '<h1>Kế hoạt nội dung Facebook</h1>'.$reply_ai['result'];
                        $reply_ai['result'] = $reply;
                    }elseif($dataSend['type']=='instagram'){
                        $reply = '<h1>Kế hoạch nội dung Blog</h1>'.$reply_ai['result'];
                        $reply_ai['result'] = $reply;
                    }
                }
                $chat['result'] .= $reply_ai['result'];


                $session->write('content_tiktok', $chat);

                return array('code'=> 1, 'mess'=>'lấy dữ liệu thành công', 'data'=>$reply_ai);
            
        }
         return array('code'=> 0, 'mess'=>'lỗi hệ thống');
       
    }
     return array('code'=> 0, 'mess'=>'chưa đăng nhập');
}

function saveConteTiktokAPI($input){
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    if(!empty($session->read('infoUser'))){
        $mess = '';
        $conversation_id = '';
        $member = $session->read('infoUser');

        $modelContentFacebookAi = $controller->loadModel('ContentFacebookAis');

        if($isRequestPost){
            $dataSend = $input['request']->getData();

             $chat = array();
            if(!empty($session->read('content_tiktok'))){
                     $chat = $session->read('content_tiktok');
            }


            if(empty($dataSend['conversation_id']) && empty($dataSend['result'])){
                return array('code'=> 0, 'mess'=>'lỗi hệ thống');  
            }

            $checkContent = $modelContentFacebookAi->find()->where(['conversation_id'=>$dataSend['conversation_id'],'type'=>'content_tiktok'])->first();

            if(empty($checkContent)){
                $checkContent = $modelContentFacebookAi->newEmptyEntity();
                $checkContent->conversation_id = $dataSend['conversation_id'];
                $checkContent->created_at = time();
                $checkContent->type = 'content_tiktok';
            }
            $title = 'Lên ý tưởng không giới hạn';

            if(!empty($dataSend['title'])){
                $title = $dataSend['title'];  
            }
            $checkContent->title = @$title;
            $checkContent->topic = @$chat['topic'];
            $checkContent->content_ai = @$dataSend['result'];
            $checkContent->id_member = @$member->id;
            $checkContent->updated_at = time();
            $checkContent->customer_target = @$dataSend['target'];

            $modelContentFacebookAi->save($checkContent);

             return array('code'=> 1, 'mess'=>'Lưu thành công', 'data'=>$checkContent);

        }
        return array('code'=> 0, 'mess'=>'lỗi hệ thống');
    }
    return array('code'=> 0, 'mess'=>'chưa đăng nhập');

}
?>