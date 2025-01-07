<?php 
function sendContentVideoAPI($input){
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

       

           $question ='Please answer me in Tiếng Việt language and also respond in Tiếng Việt language . As an experienced Youtube viral video script expert, your task is to transform any provided text into an engaging video script. This may be a title, an article extract, or a simple idea. You will interpret this content from a first-person perspective, as if you possess all the professional knowledge on the subject. Remember, your goal is not to merely summarize the text, but rather to create an intriguing narrative or offer advice based on the information given.\n\nThe resulting script should be concise, it should incorporate key elements of viral content such as a compelling hook, a concise yet captivating content, and a persuasive call to action. Use exaggeration, analysis, and persuasive language to captivate and retain viewer attention.\n\nHere is how you ll proceed:\n\nThe Hook: Begin with an engaging statement or question that instantly grabs the viewers attention.\n\nClearly stating the videos premise or main idea.\nMain content broken down into digestible segments with relevant B-Roll or cutaways.\nAt least one engagement point asking viewers to interact (like, comment, or share).\nTransitions between major points or segments.\nA brief recap if the content is informational.\nCall To Action: Conclude with a compelling call to action that persuades the viewer to engage further with your content, such as liking, sharing, or following your TikTok account.\nA sign-off or outro thanking viewers.\nAfter crafting your script, focus on creating a catchy and clickbait-worthy title that will make viewers want to click on your video. Remember, the overall tone of the script should be friendly and engaging.\n\nFinally, its crucial to keep in mind that clickbait should still be relevant and truthful to your content, and professional knowledge should be interpreted within the context of the information provided.\n\n\nPROVIDED TEXT OR TITLE:'.@$dataSend['topic'] ;

           /* if(!empty($dataSend['topic'])){
                $question .= 'chủ đề về '.$dataSend['topic'];
            }
            if(!empty($dataSend['customer_target'])){
                $question .=  'người tiếp cận '.$dataSend['customer_target'];
            }*/
            if(!empty($conversation_id)){
                if(!empty($dataSend['content_video'])){
                    $question = $dataSend['content_video'];
                }
            }
              $reply_ai = callAIphoenixtech($question,$conversation_id);
        
            $reply = '<h1>Tạo kịch bản Youtube</h1>'.$reply_ai['result'];
            $reply_ai['result'] = $reply;

              $chat = array('result'=>$reply,'conversation_id'=>$reply_ai['conversation_id'], 'topic'=>@$dataSend['topic']);


                $session->write('content_video', $chat);

             
               return array('code'=> 1, 'mess'=>'lấy dữ liệu thành công', 'data'=>$reply_ai);
        }
         return array('code'=> 0, 'mess'=>'lỗi hệ thống');
       
    }
      return array('code'=> 0, 'mess'=>'chưa đăng nhập');
}

function chatContentVideoAPI($input){
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
                if(!empty($session->read('content_video'))){
                     $chat = $session->read('content_video');
                }  


                if(empty($chat['topic'])){
                    $chat['topic'] = 'Dựa vào nội dung trên';
                }
            

             if(!empty($dataSend['type'])){
                if($dataSend['type']=='tiktok'){
                    $question = 'Please answer me in Tiếng Việt language and also respond in Tiếng Việt language You are the expert scriptwriter for Tiktok.\nYour task is to write a tiktok script with a short, friendly story and call to action based on the text I gave you.\nYou must speak from the first person (first person talking view) and as if the speaker has all the expertise.\nYou are not summarizing the text, you are sharing a story or advice based on what is in the text I have given.\nI want it start with a good story. Use exaggeration, analysis, and persuasive language to connect with your audience, [FIELD1].\n\n#Video Title: Lets rewrite catchy title, clickbait\n\n**Hook: Could you please include hooks for the video script thats engaging and draws in the viewer? The hook could be in the form of a suspenseful question, a shocking statement, an interesting fact, or any other attention-grabbing technique you think would work. Also, please consider using memes in between the scripts to add a humorous touch to the video.\nStory:\nCall To Action: Give an engaging CTA on the above content then\nFINALLY WRITE CTA ACTION LIKE SHARE AND LIKE THIS VIDEO\n\nThank you!\n\nHere is the text:\nDựa vào nội dung '.@$chat['topic'];
                }elseif($dataSend['type']=='facebook'){
                    $question = 'Tạo bài đăng Facebook Dựa vào nội dung ở trên ';
                }elseif($dataSend['type']=='instagram'){
                    $question = "Tạo 1 bài đăng instagram cho nội dung nói trên nhé!";
                }
            }


                $conversation_id = @$dataSend['conversation_id'];
            
                $reply_ai = callAIphoenixtech($question,$conversation_id);

                if(!empty($dataSend['type'])){
                    if($dataSend['type']=='tiktok'){
                        $reply = '<h1>Viết kịch bản Tiktok</h1>'.$reply_ai['result'];
                        $reply_ai['result'] = $reply;
                    }elseif($dataSend['type']=='facebook'){
                        $reply = '<h1>Tạo bài đăng Facebook</h1>'.$reply_ai['result'];
                        $reply_ai['result'] = $reply;
                    }elseif($dataSend['type']=='instagram'){
                        $reply = '<h1>Bài đăng Instagram</h1>'.$reply_ai['result'];
                        $reply_ai['result'] = $reply;
                    }
                }
                
                

                // $chat[] = array('question'=>$dataSend['question'],'result'=>$reply_ai['result'],'conversation_id'=>$reply_ai['conversation_id'],'number'=>$number );



                $chat['result'] .= $reply_ai['result'];


                $session->write('content_video', $chat);

                return array('code'=> 1, 'mess'=>'lấy dữ liệu thành công', 'data'=>$reply_ai);
            
        }
         return array('code'=> 0, 'mess'=>'lỗi hệ thống');
       
    }
     return array('code'=> 0, 'mess'=>'chưa đăng nhập');
}

function saveContentVideoAPI($input){
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
            if(!empty($session->read('content_video'))){
                     $chat = $session->read('content_video');
            }


            if(empty($dataSend['conversation_id']) && empty($dataSend['result'])){
                return array('code'=> 0, 'mess'=>'lỗi hệ thống');  
            }

            $checkContent = $modelContentFacebookAi->find()->where(['conversation_id'=>$dataSend['conversation_id'],'type'=>'content_video'])->first();

            if(empty($checkContent)){
                $checkContent = $modelContentFacebookAi->newEmptyEntity();
                $checkContent->conversation_id = $dataSend['conversation_id'];
                $checkContent->created_at = time();
                $checkContent->type = 'content_video';
            }
            $title = 'Tái chế nội dung đỉnh cao - VIP cho nội dung '.$chat['topic'];

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

// Tái chế nội dung kịch bản Video có sắn
function sendContentVideoScriptAPI($input){
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

       

           $question ='Dựa vào nội dung kịch bản dưới đây, hãy giúp tôi viết lại kịch bản giới thiệu sản phẩm dịch vụ '.$dataSend['topic'].' với các yêu cầu sau đây,  Giữ nguyên cấu trúc của kịch bản mẫu, Sử dụng văn phong của kịch bản mẫu, Dưới đây là kịch bản mẫu: '.str_replace(["\n", "\r"], ' ',$dataSend['content_video']).', trình bài xuống đòng từng câu giọng điệu như nội dùng trên';

           /* if(!empty($dataSend['topic'])){
                $question .= 'chủ đề về '.$dataSend['topic'];
            }
            if(!empty($dataSend['customer_target'])){
                $question .=  'người tiếp cận '.$dataSend['customer_target'];
            }*/
            if(!empty($conversation_id)){
                if(!empty($dataSend['content_video_script'])){
                    $question = $dataSend['content_video_script'];
                }
            }
              $reply_ai = callAIphoenixtech($question,$conversation_id);
        
            $reply = '<h1>Tái chế nội dung kịch bản Video có sắn</h1>'.$reply_ai['result'];
            $reply_ai['result'] = $reply;

              $chat = array('result'=>$reply,'conversation_id'=>$reply_ai['conversation_id'], 'topic'=>@$dataSend['topic'], 'question'=>$question);


                $session->write('content_video_script', $chat);

             
               return array('code'=> 1, 'mess'=>'lấy dữ liệu thành công', 'data'=>$reply_ai , 'question'=>$question);
        }
         return array('code'=> 0, 'mess'=>'lỗi hệ thống');
       
    }
      return array('code'=> 0, 'mess'=>'chưa đăng nhập');
}

function saveContentVideoScriptAPI($input){
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
            if(!empty($session->read('content_video_script'))){
                     $chat = $session->read('content_video_script');
            }


            if(empty($dataSend['conversation_id']) && empty($dataSend['result'])){
                return array('code'=> 0, 'mess'=>'lỗi hệ thống');  
            }

            $checkContent = $modelContentFacebookAi->find()->where(['conversation_id'=>$dataSend['conversation_id'],'type'=>'content_video_script'])->first();

            if(empty($checkContent)){
                $checkContent = $modelContentFacebookAi->newEmptyEntity();
                $checkContent->conversation_id = $dataSend['conversation_id'];
                $checkContent->created_at = time();
                $checkContent->type = 'content_video_script';
            }
            $title = 'Tái chế nội dung kịch bản Video có sắn cho nội dung '.$chat['topic'];

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