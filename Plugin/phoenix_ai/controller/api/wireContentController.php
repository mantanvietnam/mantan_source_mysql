<?php 
function wirecontentimageAPI($input){
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
            $question ='Please answer me in Tiếng Việt language and also respond in Tiếng Việt language . As BlogPro, a seasoned blog writer with 10 years of experience, you are tasked with creating a detailed and comprehensive blog post outline based on the following content or tittle.\nThis outline should include 7 main headings (H2s), each broken down into relevant subheadings (H3s and H4s). Remember to strategically incorporate the primary and secondary keywords into the outline to optimize it for SEO. Heres an example of the structure you should follow:\nBlog Title: (in h1, suggest me a clickbait title too for this content/topic)\nIntroduction (with primary keyword)\nHeading 2\nSubheading 3\nSummary\n(repeat for all headings/subheadings)\n* Conclusion\n\nCONTENT/TITLE:\''.@$dataSend['topic'];
            /* if(!empty($dataSend['topic'])){
                $question .= 'chủ đề về '.$dataSend['topic'];
            }
            if(!empty($dataSend['customer_target'])){
                $question .=  'người tiếp cận '.$dataSend['customer_target'];
            }*/
            if(!empty($conversation_id)){
                if(!empty($dataSend['write_contentimage'])){
                    $question = $dataSend['write_contentimage'];
                }
            }
              $reply_ai = callAIphoenixtech($question,$conversation_id);

               $reply = '<h1>Tạo 5 mẫu quảng cáo sáng tạo dựa trên mẫu cho trước</h1>'.$reply_ai['result'];
            $reply_ai['result'] = $reply;

              $chat = array('result'=>$reply_ai['result'],
                            'conversation_id'=>$reply_ai['conversation_id'],
                            'topic'=>@$dataSend['topic'],
                            );
           

                $session->write('write_contentimage', $chat);

             
               return array('code'=> 1, 'mess'=>'lấy dữ liệu thành công', 'data'=>$reply_ai,);
        }
         return array('code'=> 0, 'mess'=>'lỗi hệ thống');
       
    }
      return array('code'=> 0, 'mess'=>'chưa đăng nhập');
}
function chatcontentwirtetimageAPI($input){
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
                    $question = "Based on the above outline, please create an engaging introduction paragraph, please ensure to: Create a compelling hook that immediately grabs the reader's attention. Connect with the reader by addressing them directly or discussing a problem they might be facing. Clearly convey the value the blog post will provide, demonstrating the benefit to the reader early on. Use powerful, emotional language that evokes curiosity and interest. Just give me the output, no explaination";
                }elseif($dataSend['number_question']==2){
                    $question = "Based on the above outline, please create an engaging introduction paragraph, please ensure to: Create a compelling hook that immediately grabs the reader's attention. Connect with the reader by addressing them directly or discussing a problem they might be facing. Clearly convey the value the blog post will provide, demonstrating the benefit to the reader early on. Use powerful, emotional language that evokes curiosity and interest. Just give me the output, no explaination";
                }elseif($dataSend['number_question']==3){
                    $question = "Based on the above outline, please create an engaging introduction paragraph, please ensure to: Create a compelling hook that immediately grabs the reader's attention. Connect with the reader by addressing them directly or discussing a problem they might be facing. Clearly convey the value the blog post will provide, demonstrating the benefit to the reader early on. Use powerful, emotional language that evokes curiosity and interest. Just give me the output, no explaination";
                }elseif($dataSend['number_question']==4){
                    $question = "Based on the above outline, please create an engaging introduction paragraph, please ensure to: Create a compelling hook that immediately grabs the reader's attention. Connect with the reader by addressing them directly or discussing a problem they might be facing. Clearly convey the value the blog post will provide, demonstrating the benefit to the reader early on. Use powerful, emotional language that evokes curiosity and interest. Just give me the output, no explaination";
                }elseif($dataSend['number_question']==5){
                    $question = "Based on the above outline, please create an engaging introduction paragraph, please ensure to: Create a compelling hook that immediately grabs the reader's attention. Connect with the reader by addressing them directly or discussing a problem they might be facing. Clearly convey the value the blog post will provide, demonstrating the benefit to the reader early on. Use powerful, emotional language that evokes curiosity and interest. Just give me the output, no explaination";
                }elseif($dataSend['number_question']==6){
                    $question = "Based on the above outline, please create an engaging introduction paragraph, please ensure to: Create a compelling hook that immediately grabs the reader's attention. Connect with the reader by addressing them directly or discussing a problem they might be facing. Clearly convey the value the blog post will provide, demonstrating the benefit to the reader early on. Use powerful, emotional language that evokes curiosity and interest. Just give me the output, no explaination";
                }elseif($dataSend['number_question']==7){
                    $question = "Based on the above outline, please create an engaging introduction paragraph, please ensure to: Create a compelling hook that immediately grabs the reader's attention. Connect with the reader by addressing them directly or discussing a problem they might be facing. Clearly convey the value the blog post will provide, demonstrating the benefit to the reader early on. Use powerful, emotional language that evokes curiosity and interest. Just give me the output, no explaination";
                }elseif($dataSend['number_question']==8){
                    $question = "Based on the above outline, please create an engaging introduction paragraph, please ensure to: Create a compelling hook that immediately grabs the reader's attention. Connect with the reader by addressing them directly or discussing a problem they might be facing. Clearly convey the value the blog post will provide, demonstrating the benefit to the reader early on. Use powerful, emotional language that evokes curiosity and interest. Just give me the output, no explaination";
                }



            }


                $conversation_id = @$dataSend['conversation_id'];
            
                $reply_ai = callAIphoenixtech($question,$conversation_id);
                
                $chat = array();
                if(!empty($session->read('write_contentimage'))){
                     $chat = $session->read('write_contentimage');
                }

                // $chat[] = array('question'=>$dataSend['question'],'result'=>$reply_ai['result'],'conversation_id'=>$reply_ai['conversation_id'],'number'=>$number );

                $chat['result'] .= $reply_ai['result'];


                $session->write('write_contentimage', $chat);

                return array('code'=> 1, 'mess'=>'lấy dữ liệu thành công', 'data'=>$reply_ai);
            
        }
         return array('code'=> 0, 'mess'=>'lỗi hệ thống');
       
    }
     return array('code'=> 0, 'mess'=>'chưa đăng nhập');
}

function savecontentimageAPI($input){
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

        if($isRequestPost){
            $dataSend = $input['request']->getData();

             $chat = array();
            if(!empty($session->read('write_contentimage'))){
                     $chat = $session->read('write_contentimage');
            }


            if(empty($dataSend['conversation_id']) && empty($dataSend['result'])){
                return array('code'=> 0, 'mess'=>'lỗi hệ thống');  
            }

            $checkContent = $modelContentimage->find()->where(['conversation_id'=>$dataSend['conversation_id'],'type'=>'write_contentimage'])->first();
            
            if(empty($checkContent)){
                $checkContent = $modelContentimage->newEmptyEntity();
                $checkContent->conversation_id = $dataSend['conversation_id'];
                $checkContent->created_at = time();
                $checkContent->type = 'write_contentimage';
            }
            $title = 'Viết bài blog dựa trên nội dung/tiêu đề, có ảnh';

            if(!empty($dataSend['title'])){
                $title = $dataSend['title'];  
            }
            $checkContent->title = @$title;
            $checkContent->topic = @$chat['topic'];
            $checkContent->content_ai = @$dataSend['result'];
            $checkContent->id_member = @$member->id;
            $checkContent->updated_at = time();
            $checkContent->customer_target = @$dataSend['target'];

            $modelContentimage->save($checkContent);

             return array('code'=> 1, 'mess'=>'Lưu thành công', 'data'=>$checkContent);

        }
        return array('code'=> 0, 'mess'=>'lỗi hệ thống');
    }
    return array('code'=> 0, 'mess'=>'chưa đăng nhập');

}

function createcontentfacebookanyAPI($input){

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
            $question ='Please answer me in Tiếng Việt language and also respond in Tiếng Việt language . You are an expert in content transformation and replication, equipped to analyze and recreate the essence of existing content. Your task involves a deep dive into the provided content, focusing on:\n\nTone: Explore the emotional depth and sentiments the content expresses.\nVoice: Capture the unique character and distinctiveness of the content.\nStyle: Assess the approach of the content, whether it’s straightforward, elaborate, factual, or descriptive.\nStructure: Analyze the organization and layout, understanding the strategic flow and composition.\n\nPROVIDED CONTENT:\n\nkhông có\n\nYour objective is to create a Facebook post on this topic: '.@$dataSend['topic'].'  that closely aligns with the style and structure of the analyzed content. The goal is to produce a completely new piece that retains the effectiveness and conversion power of the original.\nJust create me the output, present in a nicely Facebook post, analyze in silence only.';
            /* if(!empty($dataSend['topic'])){
                $question .= 'chủ đề về '.$dataSend['topic'];
            }
            if(!empty($dataSend['customer_target'])){
                $question .=  'người tiếp cận '.$dataSend['customer_target'];
            }*/
            if(!empty($conversation_id)){

                if(!empty($dataSend['write_contentfacebook'])){
                    $question = $dataSend['write_contentfacebook'];

                }
            }
            $reply_ai = callAIphoenixtech($question,$conversation_id);

            $reply = '<h1>Tạo bài viết facebook từ nội dung bất kì</h1>'.$reply_ai['result'];
            $reply_ai['result'] = $reply;

            $chat = array('result'=>$reply_ai['result'],
                            'conversation_id'=>$reply_ai['conversation_id'],
                            'topic'=>@$dataSend['topic'],
                            );
           


                $session->write('write_contentfacebook', $chat);


             
               return array('code'=> 1, 'mess'=>'lấy dữ liệu thành công', 'data'=>$reply_ai,);
        }
         return array('code'=> 0, 'mess'=>'lỗi hệ thống');
       
    }
      return array('code'=> 0, 'mess'=>'chưa đăng nhập');
}

function chatcontentfacebookanyAPI($input){

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
                    $question = "Based on the above outline, please create an engaging introduction paragraph, please ensure to: Create a compelling hook that immediately grabs the reader's attention. Connect with the reader by addressing them directly or discussing a problem they might be facing. Clearly convey the value the blog post will provide, demonstrating the benefit to the reader early on. Use powerful, emotional language that evokes curiosity and interest. Just give me the output, no explaination";
                }



            }


                $conversation_id = @$dataSend['conversation_id'];
            
                $reply_ai = callAIphoenixtech($question,$conversation_id);
                
                $chat = array();

                if(!empty($session->read('write_contentfacebook'))){
                     $chat = $session->read('write_contentfacebook');

                }

                // $chat[] = array('question'=>$dataSend['question'],'result'=>$reply_ai['result'],'conversation_id'=>$reply_ai['conversation_id'],'number'=>$number );

                $chat['result'] .= $reply_ai['result'];



                $session->write('write_contentfacebook', $chat);


                return array('code'=> 1, 'mess'=>'lấy dữ liệu thành công', 'data'=>$reply_ai);
            
        }
         return array('code'=> 0, 'mess'=>'lỗi hệ thống');
       
    }
     return array('code'=> 0, 'mess'=>'chưa đăng nhập');
}


function savecontentfacebookanyAPI($input){

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

        if($isRequestPost){
            $dataSend = $input['request']->getData();

             $chat = array();

            if(!empty($session->read('write_contentfacebook'))){
                     $chat = $session->read('write_contentfacebook');

            }


            if(empty($dataSend['conversation_id']) && empty($dataSend['result'])){
                return array('code'=> 0, 'mess'=>'lỗi hệ thống');  
            }


            $checkContent = $modelContentimage->find()->where(['conversation_id'=>$dataSend['conversation_id'],'type'=>'write_contentfacebook'])->first();

            
            if(empty($checkContent)){
                $checkContent = $modelContentimage->newEmptyEntity();
                $checkContent->conversation_id = $dataSend['conversation_id'];
                $checkContent->created_at = time();

                $checkContent->type = 'write_contentfacebook';
            }
            $title = 'Tạo bài viết từ nội dung bất kỳ về chủ đề '.$chat['topic'];


            if(!empty($dataSend['title'])){
                $title = $dataSend['title'];  
            }
            $checkContent->title = @$title;
            $checkContent->topic = @$chat['topic'];
            $checkContent->content_ai = @$dataSend['result'];
            $checkContent->id_member = @$member->id;
            $checkContent->updated_at = time();
            $checkContent->customer_target = @$dataSend['target'];

            $modelContentimage->save($checkContent);

             return array('code'=> 1, 'mess'=>'Lưu thành công', 'data'=>$checkContent);

        }
        return array('code'=> 0, 'mess'=>'lỗi hệ thống');
    }
    return array('code'=> 0, 'mess'=>'chưa đăng nhập');

}

?>