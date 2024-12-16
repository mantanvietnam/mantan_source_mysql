<?php 
function sendContentBlogAPI($input){
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

       

           $question ='Please answer me in Tiếng Việt language and also respond in Tiếng Việt language . As BlogPro, a seasoned blog writer with 10 years of experience, you are tasked with creating a detailed and comprehensive blog post outline based on the following content or tittle.\nThis outline should include 7 main headings (H2s), each broken down into relevant subheadings (H3s and H4s). Remember to strategically incorporate the primary and secondary keywords into the outline to optimize it for SEO. Heres an example of the structure you should follow:\nBlog Title: (in h1, suggest me a clickbait title too for this content/topic)\nIntroduction (with primary keyword)\nHeading 2\nSubheading 3\nSummary\n(repeat for all headings/subheadings)\n* Conclusion\n\nCONTENT/TITLE:\''.@$dataSend['topic'];

           /* if(!empty($dataSend['topic'])){
                $question .= 'chủ đề về '.$dataSend['topic'];
            }
            if(!empty($dataSend['customer_target'])){
                $question .=  'người tiếp cận '.$dataSend['customer_target'];
            }*/
            if(!empty($conversation_id)){
                if(!empty($dataSend['content_blog'])){
                    $question = $dataSend['content_blog'];
                }
            }
              $reply_ai = callAIphoenixtech($question,$conversation_id);
         

              $chat = array('result'=>$reply_ai['result'],'conversation_id'=>$reply_ai['conversation_id'], 'topic'=>@$dataSend['topic']);


                $session->write('content_blog', $chat);

             
               return array('code'=> 1, 'mess'=>'lấy dữ liệu thành công', 'data'=>$reply_ai);
        }
         return array('code'=> 0, 'mess'=>'lỗi hệ thống');
       
    }
      return array('code'=> 0, 'mess'=>'chưa đăng nhập');
}

function chatContentBlogAPI($input){
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
            if(!empty($session->read('content_blog'))){
                $chat = $session->read('content_blog');
            }

            
            if(!empty($dataSend['number_question'])){
                if($dataSend['number_question']==1){
                    $question = "Based on the above outline, please create an engaging introduction paragraph, please ensure to:\nCreate a compelling hook that immediately grabs the reader's attention.\nConnect with the reader by addressing them directly or discussing a problem they might be facing.\nClearly convey the value the blog post will provide, demonstrating the benefit to the reader early on.\nUse powerful, emotional language that evokes curiosity and interest. \nJust give me the output, no explaination";
                }elseif($dataSend['number_question']==2){
                    $question = "Continue with writting the first main heading of the blog content based on the outline. Cover the initial sections and no more than 2-3 subsections as detailed in the outline, ensuring each section at least 2 long paragraphs using ngaging Language, Employs vivid, descriptive, or emotive language as if you talking with the reader. Ensure this part transitions smoothly to the next section\nJust give me the output, no explaination";
                }elseif($dataSend['number_question']==3){
                    $question = "Write the second part of the content based on the outline. Cover the initial sections and no more than 2-3 subsections as detailed in the outline, ensuring each section at least 2 long paragraphs using ngaging Language, Employs vivid, descriptive, or emotive language as if you talking with the reader. Ensure this part transitions smoothly to the next section.\nJust give me the output, no explaination";
                }elseif($dataSend['number_question']==4){
                    $question = "Write the third part of the content based on the outline. Cover the initial sections and no more than 2-3 subsections as detailed in the outline, ensuring each section at least 2 long paragraphs  in a natural voice as if you talk with the reader,  includes practical tips, examples or actionable advice. Ensure this part transitions smoothly to the next section.\nJust give me the output, no explaination";
                }elseif($dataSend['number_question']==5){
                    $question = "Write the fourth part of the content based on the outline. Continue covering the initial sections and no more than 3 subsections as detailed in the outline, ensuring each section at least 2 long paragraphs using ngaging Language, Employs vivid, descriptive, or emotive language as if you talking with the reader. Ensure this part transitions smoothly to the next section.\nJust give me the output, no explaination";
                }elseif($dataSend['number_question']==6){
                    $question = "Write the fifth part of the content based on the outline. Continue covering the initial sections and no more than 3 subsections as detailed in the outline, ensuring each section at least 2 long paragraphs using ngaging Language, Employs vivid, descriptive, or emotive language as if you talking with the reader. Ensure this part transitions smoothly to the next section.\nJust give me the output, no explaination";
                }elseif($dataSend['number_question']==7){
                    $question = "Write the sixth part of the content based on the outline. Continue covering the initial sections and no more than 3 subsections as detailed in the outline, ensuring each section at least 2 long paragraphs using ngaging Language, Employs vivid, descriptive, or emotive language as if you talking with the reader. Ensure this part transitions smoothly to the next section.\nJust give me the output, no explaination";
                }elseif($dataSend['number_question']==8){
                    $question = "Write the conclusion for a the post. Summarize the key points discussed in the blog, reinforce the importance of the topic, Create a sense of closure that provides a satisfying ending to the post, Ensure the conclusion is concise and impactful\nInclude a compelling Call to Action (CTA) that encourages reader engagement.\nJust give me the output, no explaination";
                } 
            }


                $conversation_id = @$dataSend['conversation_id'];
            
                $reply_ai = callAIphoenixtech($question,$conversation_id);
                
               

                // $chat[] = array('question'=>$dataSend['question'],'result'=>$reply_ai['result'],'conversation_id'=>$reply_ai['conversation_id'],'number'=>$number );

                $chat['result'] .= $reply_ai['result'];


                $session->write('content_blog', $chat);

                return array('code'=> 1, 'mess'=>'lấy dữ liệu thành công', 'data'=>$reply_ai);
            
        }
         return array('code'=> 0, 'mess'=>'lỗi hệ thống');
       
    }
     return array('code'=> 0, 'mess'=>'chưa đăng nhập');
}

function saveContentBlogAPI($input){
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
            if(!empty($session->read('content_blog'))){
                     $chat = $session->read('content_blog');
            }


            if(empty($dataSend['conversation_id']) && empty($dataSend['result'])){
                return array('code'=> 0, 'mess'=>'lỗi hệ thống');  
            }

            $checkContent = $modelContentFacebookAi->find()->where(['conversation_id'=>$dataSend['conversation_id'],'type'=>'content_blog'])->first();

            if(empty($checkContent)){
                $checkContent = $modelContentFacebookAi->newEmptyEntity();
                $checkContent->conversation_id = $dataSend['conversation_id'];
                $checkContent->created_at = time();
                $checkContent->type = 'content_blog';
            }
            $title = 'Viết bài blog dựa trên nội dung-tiêu đề';
            if(!empty($chat['topic'])){
                $title .=' nội dung muốn viết là '.$chat['topic'];
            }

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