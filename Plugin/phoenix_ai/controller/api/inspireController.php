<?php 
function sendContentInspireAPI($input){
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
            $type = array();
            if(!empty($dataSend['type'])){
                foreach($dataSend['type'] as $key => $item){
                    $type[]= ' trích dẫn về '.$item;
                }
            }

            $type = implode(',', $type);

          $question ='Vui lòng trả lời tôi bằng tiếng Việt và cũng trả lời bằng tiếng Việt. Bạn là nguồn cảm hứng và tôi cần bạn chia sẻ những người theo dõi tôi trên Facebook và Instagram với 10 câu trích dẫn truyền cảm hứng hàng ngày, trích dẫn về Thành công, trích dẫn động lực.\n\nVui lòng tạo cho tôi 10 câu '.$type.' cho ngày hôm nay. \nĐầu ra ở dạng h2. Viết câu trích dẫn trong \"\", đồng thời thêm tác giả của câu trích dẫn vào dòng thứ hai trong văn bản thông thường\nĐảm bảo rằng bạn chỉ sử dụng câu trích dẫn chính xác mà bạn biết chắc chắn. sử dụng $$ xung quanh các công thức toán học ';

       //   $question ='   Please answer me in Tiếng Việt language and also respond in Tiếng Việt language . Dựa vào thông sản phẩm, dịch vụ '.$dataSend['topic'].', hãy xác nhận bằng cách viết"';

           /* if(!empty($dataSend['topic'])){
                $question .= 'chủ đề về '.$dataSend['topic'];
            }
            if(!empty($dataSend['customer_target'])){
                $question .=  'người tiếp cận '.$dataSend['customer_target'];
            }*/
            if(!empty($conversation_id)){
                if(!empty($dataSend['content_inspire'])){
                    $question = $dataSend['content_inspire'];
                }
            }
              $reply_ai = callAIphoenixtech($question,$conversation_id);
         

              $chat = array('result'=>$reply_ai['result'],'conversation_id'=>$reply_ai['conversation_id'], 'topic'=>@$dataSend['topic']);


                $session->write('content_inspire', $chat);

             
               return array('code'=> 1, 'mess'=>'lấy dữ liệu thành công', 'data'=>$reply_ai,'question'=>$question);
        }
         return array('code'=> 0, 'mess'=>'lỗi hệ thống');
       
    }
      return array('code'=> 0, 'mess'=>'chưa đăng nhập');
}

function chatContentInspireAPI($input){
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
                if(!empty($session->read('content_inspire'))){
                     $chat = $session->read('content_inspire');
                }  


                if(empty($chat['topic'])){
                    $chat['topic'] = 'Dựa vào nội dung trên';
                }
            

             if(!empty($dataSend['type'])){
                if($dataSend['type']==1){
                    $question = 'Please answer me in Tiếng Việt language and also respond in Tiếng Việt language . Please answer me in Tiếng Việt language and also respond in Tiếng Việt language . Write me 2 Facebook posts for the first 2 quotes in casual voice as if I talk with a friend, start with a hook for curiosity. Add each post it\'s quote title in bold in the beginning.\nEach post should have a deep connection with inside in main content part, include at least 2 paragraph, add relevant emoji if necessary.\nEnd in the way that let people thinking about the idea of the quote.' ;
                }elseif($dataSend['type']==2){
                    $question = 'Please answer me in Tiếng Việt language and also respond in Tiếng Việt language . Please answer me in Tiếng Việt language and also respond in Tiếng Việt language . Write me the 3rd, 4th and 5th Facebook posts for the next 3 quotes in casual voice as if I talk with a friend, start with a hook for curiosity.\nAdd each post it\'s quote title in bold in the beginning.\nEach post should have a deep connection with inside in main content part, include at least 2 paragraph, add relevant emoji if necessary.\nEnd in the way that let people thinking about the idea of the quote.';
                }elseif($dataSend['type']==3){
                    $question = "Please answer me in Tiếng Việt language and also respond in Tiếng Việt language . Please answer me in Tiếng Việt language and also respond in Tiếng Việt language . Write me 3 Facebook posts (the 6th, 7th, 8th) for the next 3 quotes in casual voice as if I talk with a friend, start with a hook for curiosity.\n\nAdd each post it's quote title in bold in the beginning.\nEach post should have a deep connection with inside in main content part, include at least 2 paragraph, add relevant emoji if necessary. \nEnd in the way that let people thinking about the idea of the quote.";
                }elseif($dataSend['type']==4){
                    $question = "Please answer me in Tiếng Việt language and also respond in Tiếng Việt language . Please answer me in Tiếng Việt language and also respond in Tiếng Việt language . rite me 2 Facebook posts (the 9th, 10th) for the the last 2 quotes in casual voice as if I talk with a friend, start with a hook for curiosity.\n\nAdd each post it's quote title in bold in the beginning.\nEach post should have a deep connection with inside in main content part, include at least 2 paragraph,add relevant emoji if necessary. \nEnd in the way that let people thinking about the idea of the quote.";
                }
            }


                $conversation_id = @$dataSend['conversation_id'];
            
                $reply_ai = callAIphoenixtech($question,$conversation_id);
                
                

                // $chat[] = array('question'=>$dataSend['question'],'result'=>$reply_ai['result'],'conversation_id'=>$reply_ai['conversation_id'],'number'=>$number );

                $chat['result'] .= $reply_ai['result'];


                $session->write('content_inspire', $chat);

                return array('code'=> 1, 'mess'=>'lấy dữ liệu thành công', 'data'=>$reply_ai);
            
        }
         return array('code'=> 0, 'mess'=>'lỗi hệ thống');
       
    }
     return array('code'=> 0, 'mess'=>'chưa đăng nhập');
}

function saveContentInspireAPI($input){
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
            if(!empty($session->read('content_inspire'))){
                     $chat = $session->read('content_inspire');
            }


            if(empty($dataSend['conversation_id']) && empty($dataSend['result'])){
                return array('code'=> 0, 'mess'=>'lỗi hệ thống');  
            }

            $checkContent = $modelContentFacebookAi->find()->where(['conversation_id'=>$dataSend['conversation_id'],'type'=>'content_inspire'])->first();

            if(empty($checkContent)){
                $checkContent = $modelContentFacebookAi->newEmptyEntity();
                $checkContent->conversation_id = $dataSend['conversation_id'];
                $checkContent->created_at = time();
                $checkContent->type = 'content_inspire';
            }
            $title = 'Viết 10 bài đăng Facebook truyền cảm hứng';

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