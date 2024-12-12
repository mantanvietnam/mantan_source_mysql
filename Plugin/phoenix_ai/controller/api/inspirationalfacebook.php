<?php 
function sendinspirationalfacebookAPI($input){
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

     if(!empty($session->read('infoUser'))){
        $mess = '';
        $conversation_id = '';
        $member = $session->read('infoUser');
        

        $modelinspirationalfacebookAis = $controller->loadModel('ContentFacebookAis');
        $modelHistoryChatAis = $controller->loadModel('HistoryChatAis');

        $reply_ai = array();
        $dataSend = array();
        if($isRequestPost){
            $dataSend = $input['request']->getData();
            $question = 'Viết 10 bài đăng Facebook truyền cảm hứng (5)';

       

           $question ='Please answer me in Tiếng Việt language and also respond in Tiếng Việt language . Bạn là một chuyên gia chiến lược truyền thông xã hội,  Nhiệm vụ của bạn là tạo ra 1 kế hoạch đăng bài với 10 ý tưởng nội dung với chủ đề '.@$dataSend['topic'].' có khả năng lan truyền mạnh mẽ cho Facebook fanpage sao cho hấp dẫn, phù hợp, và hướng đến đối tượng khách hàng tiềm năng trong lĩnh vực này,'.@$dataSend['customer_target'].'. Mỗi ý tưởng nên bao gồm một chủ đề cụ thể liên quan đến lĩnh vực và xem xét các xu hướng nổi bật hoặc tính thời vụ để tối đa hóa sự tương tác. Đảm bảo rằng các ý tưởng phù hợp với sở thích đa dạng của khán giả trong lĩnh vực và được thay đổi phong phú để giữ cho nội dung luôn mới mẻ và thú vị';

           /* if(!empty($dataSend['topic'])){
                $question .= 'chủ đề về '.$dataSend['topic'];
            }
            if(!empty($dataSend['customer_target'])){
                $question .=  'người tiếp cận '.$dataSend['customer_target'];
            }*/
            if(!empty($conversation_id)){
                if(!empty($dataSend['content_inspirational'])){
                    $question = $dataSend['content_inspirational'];
                }
            }

              $reply_ai = callAIphoenixtech($question,$conversation_id);


              $chat = array('result'=>$reply_ai['result'],'conversation_id'=>$reply_ai['conversation_id'], 'topic'=>@$dataSend['topic']);


                $session->write('content_inspirational', $chat);

             
               return array('code'=> 1, 'mess'=>'lấy dữ liệu thành công', 'data'=>$reply_ai);
        }
         return array('code'=> 0, 'mess'=>'lỗi hệ thống');
       
    }
      return array('code'=> 0, 'mess'=>'chưa đăng nhập');
}



function chatinspirationalfacebookAPI($input){
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    if(!empty($session->read('infoUser'))){
        $mess = '';
        $conversation_id = '';
        $member = $session->read('infoUser');
        

        $modelinspirationalfacebookAis = $controller->loadModel('ContentFacebookAis');
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
                if(!empty($session->read('content_inspirational'))){
                     $chat = $session->read('content_inspirational');
                }

                // $chat[] = array('question'=>$dataSend['question'],'result'=>$reply_ai['result'],'conversation_id'=>$reply_ai['conversation_id'],'number'=>$number );

                $chat['result'] .= $reply_ai['result'];


                $session->write('content_inspirational', $chat);

                return array('code'=> 1, 'mess'=>'lấy dữ liệu thành công', 'data'=>$reply_ai);
            }
        }
         return array('code'=> 0, 'mess'=>'lỗi hệ thống');
       
    }
     return array('code'=> 0, 'mess'=>'chưa đăng nhập');
}

function saveinspirationalfacebookAPI($input){
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    if(!empty($session->read('infoUser'))){
        $mess = '';
        $conversation_id = '';
        $member = $session->read('infoUser');

        $modelinspirationalfacebookAi = $controller->loadModel('ContentFacebookAis');

        if($isRequestPost){
            $dataSend = $input['request']->getData();

             $chat = array();
            if(!empty($session->read('content_inspirational'))){
                     $chat = $session->read('content_inspirational');
            }


            if(empty($dataSend['conversation_id']) && empty($dataSend['result'])){
                return array('code'=> 0, 'mess'=>'lỗi hệ thống');  
            }

            $checkContent = $modelinspirationalfacebookAi->find()->where(['conversation_id'=>$dataSend['conversation_id'],'type'=>'content_inspirational'])->first();

            if(empty($checkContent)){
                $checkContent = $modelinspirationalfacebookAi->newEmptyEntity();
                $checkContent->conversation_id = $dataSend['conversation_id'];
                $checkContent->created_at = time();
                $checkContent->type = 'content_inspirational';
            }
            $title = 'Viết 10 chủ đề bài viết đăng Facebook';

            if(!empty($dataSend['title'])){
                $title = $dataSend['title'];  
            }
            $checkContent->title = @$title;
            $checkContent->topic = @$chat['topic'];
            $checkContent->content_ai = @$dataSend['result'];
            $checkContent->id_member = @$member->id;
            $checkContent->updated_at = time();
            $checkContent->customer_target = @$dataSend['target'];

            $modelinspirationalfacebookAi->save($checkContent);

             return array('code'=> 1, 'mess'=>'Lưu thành công', 'data'=>$checkContent);

        }
        return array('code'=> 0, 'mess'=>'lỗi hệ thống');
    }
    return array('code'=> 0, 'mess'=>'chưa đăng nhập');

}

function createsampleadsAPI($input){
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

     if(!empty($session->read('infoUser'))){
        $mess = '';
        $conversation_id = '';
        $member = $session->read('infoUser');
        

        $modelinspirationalfacebookAis = $controller->loadModel('ContentFacebookAis');
        $modelHistoryChatAis = $controller->loadModel('HistoryChatAis');

        $reply_ai = array();
        $dataSend = array();
        if($isRequestPost){
            $dataSend = $input['request']->getData();
            $question = 'Tạo 5 mẫu quảng cáo sáng tạo dựa trên nội dung cho trước';

       

           $question ='Please respond to the content in Vietnamese.Lets create 5 ads with the content '.@$dataSend['topic'].' Write professional, impressive advertising content';

           /* if(!empty($dataSend['topic'])){
                $question .= 'chủ đề về '.$dataSend['topic'];
            }
            if(!empty($dataSend['customer_target'])){
                $question .=  'người tiếp cận '.$dataSend['customer_target'];
            }*/
            if(!empty($conversation_id)){
                if(!empty($dataSend['write_sampleads'])){
                    $question = $dataSend['write_sampleads'];
                }
            }

              $reply_ai = callAIphoenixtech($question,$conversation_id);


              $chat = array('result'=>$reply_ai['result'],'conversation_id'=>$reply_ai['conversation_id'], 'topic'=>@$dataSend['topic']);


                $session->write('write_sampleads', $chat);

             
               return array('code'=> 1, 'mess'=>'lấy dữ liệu thành công', 'data'=>$reply_ai);
        }
         return array('code'=> 0, 'mess'=>'lỗi hệ thống');
       
    }
      return array('code'=> 0, 'mess'=>'chưa đăng nhập');
}


function chatsampleadsAPI($input){

    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    if(!empty($session->read('infoUser'))){
        $mess = '';
        $conversation_id = '';
        $member = $session->read('infoUser');
        

        $modelContentimage = $controller->loadModel('ContentFacebookAis');
        $modelHistoryChatAis = $controller->loadModel('HistoryChatAis');

        $reply_ai = array();
        $dataSend = array();
        if($isRequestPost){
            $dataSend = $input['request']->getData();
            
            if(!empty($dataSend['question'])){
                $question = $dataSend['question'];

            }    
             if(!empty($dataSend['number_question'])){
                if($dataSend['number_question']==1){
                    $question = "Please answer me in Vietnamese.Create a sample follow-up ad";

                }



            }


                $conversation_id = @$dataSend['conversation_id'];
            
                $reply_ai = callAIphoenixtech($question,$conversation_id);
                
                $chat = array();

                if(!empty($session->read('write_sampleads'))){
                     $chat = $session->read('write_sampleads');

                }

                // $chat[] = array('question'=>$dataSend['question'],'result'=>$reply_ai['result'],'conversation_id'=>$reply_ai['conversation_id'],'number'=>$number );

                $chat['result'] .= $reply_ai['result'];



                $session->write('write_sampleads', $chat);


                return array('code'=> 1, 'mess'=>'lấy dữ liệu thành công', 'data'=>$reply_ai);
            
        }
         return array('code'=> 0, 'mess'=>'lỗi hệ thống');
       
    }
     return array('code'=> 0, 'mess'=>'chưa đăng nhập');
}

function savesampleadsAPI($input){
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    if(!empty($session->read('infoUser'))){
        $mess = '';
        $conversation_id = '';
        $member = $session->read('infoUser');

        $modelinspirationalfacebookAi = $controller->loadModel('ContentFacebookAis');

        if($isRequestPost){
            $dataSend = $input['request']->getData();

             $chat = array();
            if(!empty($session->read('write_sampleads'))){
                     $chat = $session->read('write_sampleads');
            }


            if(empty($dataSend['conversation_id']) && empty($dataSend['result'])){
                return array('code'=> 0, 'mess'=>'lỗi hệ thống');  
            }

            $checkContent = $modelinspirationalfacebookAi->find()->where(['conversation_id'=>$dataSend['conversation_id'],'type'=>'write_sampleads'])->first();

            if(empty($checkContent)){
                $checkContent = $modelinspirationalfacebookAi->newEmptyEntity();
                $checkContent->conversation_id = $dataSend['conversation_id'];
                $checkContent->created_at = time();
                $checkContent->type = 'write_sampleads';
            }
            $title = 'Tạo 5 mẫu quảng cáo sáng tạo dựa trên nội dung cho trước';

            if(!empty($dataSend['title'])){
                $title = $dataSend['title'];  
            }
            $checkContent->title = @$title;
            $checkContent->topic = @$chat['topic'];
            $checkContent->content_ai = @$dataSend['result'];
            $checkContent->id_member = @$member->id;
            $checkContent->updated_at = time();
            $checkContent->customer_target = @$dataSend['target'];

            $modelinspirationalfacebookAi->save($checkContent);

             return array('code'=> 1, 'mess'=>'Lưu thành công', 'data'=>$checkContent);

        }
        return array('code'=> 0, 'mess'=>'lỗi hệ thống');
    }
    return array('code'=> 0, 'mess'=>'chưa đăng nhập');

}
 ?>
