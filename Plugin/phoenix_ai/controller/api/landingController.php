<?php 
function sendContentlandingAPI($input){
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

       

          $question ='Please answer me in Tiếng Việt language and also respond in Tiếng Việt language . Dựa vào thông sản phẩm, dịch vụ '.$dataSend['topic'].', hãy xác nhận bằng cách viết, Hãy đóng vai 1 chuyên gia số tạo landing page gỏi, bắt đầu tạo cho tôi 1 landing page đỉnh cao cho sản phẩm/dịch vụ '.$dataSend['topic'].'. Bạn chỉ cần tạo ra kết quả cuối cùng, không cần nhắc lại các chỉ dẫn. Sử dụng ngôn ngữ tự nhiên, chân thực và cuốn hút, Bạn sẽ bắt đầu chỉ với 2 bước như sau:\nBắt đầu  với việc đưa ra 3 1 tiêu đề chính gây tò mò, lôi cuốn, làm nổi bật lợi ích  của sản phẩm/dịch vụ nói trên\nVới mỗi tiêu đề chính, hãy đưa ra 1 tiêu đề phụ, thu hút sự chú ý của n gười đọc và làm nổi bật các lợi ích của sản phẩm, có sử dụng con số. ';

       //   $question ='   Please answer me in Tiếng Việt language and also respond in Tiếng Việt language . Dựa vào thông sản phẩm, dịch vụ '.$dataSend['topic'].', hãy xác nhận bằng cách viết"';

           /* if(!empty($dataSend['topic'])){
                $question .= 'chủ đề về '.$dataSend['topic'];
            }
            if(!empty($dataSend['customer_target'])){
                $question .=  'người tiếp cận '.$dataSend['customer_target'];
            }*/
            if(!empty($conversation_id)){
                if(!empty($dataSend['content_landing'])){
                    $question = $dataSend['content_landing'];
                }
            }
              $reply_ai = callAIphoenixtech($question,$conversation_id);
         

              $chat = array('result'=>$reply_ai['result'],'conversation_id'=>$reply_ai['conversation_id'], 'topic'=>@$dataSend['topic']);


                $session->write('content_landing', $chat);

             
               return array('code'=> 1, 'mess'=>'lấy dữ liệu thành công', 'data'=>$reply_ai,'question'=>$question);
        }
         return array('code'=> 0, 'mess'=>'lỗi hệ thống');
       
    }
      return array('code'=> 0, 'mess'=>'chưa đăng nhập');
}

function chatContentlandingAPI($input){
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
                if(!empty($session->read('content_landing'))){
                     $chat = $session->read('content_landing');
                }  


                if(empty($chat['topic'])){
                    $chat['topic'] = 'Dựa vào nội dung trên';
                }
            

             if(!empty($dataSend['type'])){
                if($dataSend['type']==1){
                    $question = 'Hãy đóng vai 1 chuyên gia số 1 về copywritting, bắt đầu tạo cho tôi 1 landing page đỉnh cao cho sản phẩm/dịch vụ nói trên. Bạn chỉ cần tạo ra kết quả cuối cùng, không cần nhắc lại các chỉ dẫn. Sử dụng ngôn ngữ tự nhiên, chân thực và cuốn hút, Bạn sẽ bắt đầu chỉ với 2 bước như sau:\nBắt đầu  với việc đưa ra 3 1 tiêu đề chính gây tò mò, lôi cuốn, làm nổi bật lợi ích  của sản phẩm/dịch vụ nói trên\nVới mỗi tiêu đề chính, hãy đưa ra 1 tiêu đề phụ, thu hút sự chú ý của n gười đọc và làm nổi bật các lợi ích của sản phẩm, có sử dụng con số. Please answer me in Tiếng Việt language and also respond in Tiếng Việt language.' ;
                }elseif($dataSend['type']==2){
                    $question = 'Tiếp đó, trình bày vấn đề và nỗi đau của đối tượng khách hàng tiềm năng, Nhấn mạnh vào nỗi đau của khách hàng và làm cho nó trở thành không thể chịu đựng được. Hé lộ giải pháp mà sản phẩm cung cấp. Please answer me in Tiếng Việt language and also respond in Tiếng Việt language. ';
                }elseif($dataSend['type']==3){
                    $question = "Đưa ra 1 câu chuyện before after, sử dụng ngôn ngữ visual và emotion cảm xúc chân thực và tự nhiên, gần gũi, kể chuyện thật sinh động khiến người nghe cảm nhận như họ đang sống trong câu chuyện đó. Please answer me in Tiếng Việt language and also respond in Tiếng Việt language.";
                }elseif($dataSend['type']==4){
                    $question = "Hãy đưa ra các ưu điểm và lợi ích độc đáo của sản phẩm \n 1 cách thật sự sống động để khách hàng như cảm thấy chân thực những lợi ích này.. Please answer me in Tiếng Việt language and also respond in Tiếng Việt language.";
                }elseif($dataSend['type']==5){
                    $question = "TIếp tục với phần mô tả cụ thể về sản phẩm/dịch vụ 1 cách sống động, chân thực và tại sao nó có ích tới khách hàng. Please answer me in Tiếng Việt language and also respond in Tiếng Việt language.";
                }elseif($dataSend['type']==6){
                    $question = "Hãy sử dụng giọng điệu thuyết phục để viết ra nội dung xử lý 1 lý do từ chối có thể có của khách hàng để giúp họ tự tin sử dụng và có động lực mua sản phẩm/dịch vụ. Please answer me in Tiếng Việt language and also respond in Tiếng Việt language.";
                }elseif($dataSend['type']==7){
                    $question = "Sử dụng giọng điệu thuyết phục và cực kỳ hào hứng, hãy Thêm vào quà tặng giá trị cao có liên quan và giải quyết mong muốn hoặc nỗi đau của khách hàng.. Please answer me in Tiếng Việt language and also respond in Tiếng Việt language.";
                }elseif($dataSend['type']==8){
                    $question = "Testimonial\nThêm 3 lời chứng thực chân thực từ người dùng phù hợp với chân dung khách hàng\nSự giới hạn\nĐưa ra các giới hạn để làm cho hành động trở nên nhanh chóng.\nGiá bán\nĐưa ra giá bán ưu đãi đặc biệt trong giới hạn.\nKêu gọi hành động\nKêu gọi hành động ngắn gọn, đơn giản, dễ hiểu.. Please answer me in Tiếng Việt language and also respond in Tiếng Việt language.";
                }
            }


                $conversation_id = @$dataSend['conversation_id'];
            
                $reply_ai = callAIphoenixtech($question,$conversation_id);
                
                

                // $chat[] = array('question'=>$dataSend['question'],'result'=>$reply_ai['result'],'conversation_id'=>$reply_ai['conversation_id'],'number'=>$number );

                $chat['result'] .= $reply_ai['result'];


                $session->write('content_landing', $chat);

                return array('code'=> 1, 'mess'=>'lấy dữ liệu thành công', 'data'=>$reply_ai);
            
        }
         return array('code'=> 0, 'mess'=>'lỗi hệ thống');
       
    }
     return array('code'=> 0, 'mess'=>'chưa đăng nhập');
}

function saveContentlandingAPI($input){
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
            if(!empty($session->read('content_landing'))){
                     $chat = $session->read('content_landing');
            }


            if(empty($dataSend['conversation_id']) && empty($dataSend['result'])){
                return array('code'=> 0, 'mess'=>'lỗi hệ thống');  
            }

            $checkContent = $modelContentFacebookAi->find()->where(['conversation_id'=>$dataSend['conversation_id'],'type'=>'content_landing'])->first();

            if(empty($checkContent)){
                $checkContent = $modelContentFacebookAi->newEmptyEntity();
                $checkContent->conversation_id = $dataSend['conversation_id'];
                $checkContent->created_at = time();
                $checkContent->type = 'content_landing';
            }
            $title = 'Tạo landing page đỉnh cao cho chủ đề '.$chat['topic'];

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