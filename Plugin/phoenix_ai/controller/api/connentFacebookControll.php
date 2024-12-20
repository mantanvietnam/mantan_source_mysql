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
                if(!empty($dataSend['content_facebook'])){
                    $question = $dataSend['content_facebook'];
                }
            }

            $reply_ai = callAIphoenixtech($question,$conversation_id);

            $reply = '<h1>Viết 10 bài viết đăng Facebook</h1>'.$reply_ai['result'];
            $reply_ai['result'] = $reply;

              $chat = array('result'=>$reply_ai['result'],'conversation_id'=>$reply_ai['conversation_id'], 'topic'=>@$dataSend['topic']);


                $session->write('content_facebook', $chat);

             
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

function chatcontentFacebookAPI($input){
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

                $conversation_id = @$dataSend['conversation_id'];
            
                $reply_ai = callAIphoenixtech($question,$conversation_id);
                
                $chat = array();
                if(!empty($session->read('content_facebook'))){
                     $chat = $session->read('content_facebook');
                }

                // $chat[] = array('question'=>$dataSend['question'],'result'=>$reply_ai['result'],'conversation_id'=>$reply_ai['conversation_id'],'number'=>$number );

                $chat['result'] .= $reply_ai['result'];


                $session->write('content_facebook', $chat);

                return array('code'=> 1, 'mess'=>'lấy dữ liệu thành công', 'data'=>$reply_ai);
            }
        }
         return array('code'=> 0, 'mess'=>'lỗi hệ thống');
       
    }
     return array('code'=> 0, 'mess'=>'chưa đăng nhập');
}

function savecontentFacebookAPI($input){
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
            if(!empty($session->read('content_facebook'))){
                     $chat = $session->read('content_facebook');
            }


            if(empty($dataSend['conversation_id']) && empty($dataSend['result'])){
                return array('code'=> 0, 'mess'=>'lỗi hệ thống');  
            }

            $checkContent = $modelContentFacebookAi->find()->where(['conversation_id'=>$dataSend['conversation_id'],'type'=>'content_facebook'])->first();

            if(empty($checkContent)){
                $checkContent = $modelContentFacebookAi->newEmptyEntity();
                $checkContent->conversation_id = $dataSend['conversation_id'];
                $checkContent->created_at = time();
                $checkContent->type = 'content_facebook';
            }
            $title = 'Viết 10 chủ đề bài viết đăng Facebook';
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

function sendcontentFacebookAdsAPI($input){
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
         

       

           $question ='Please answer me in Tiếng Việt language and also respond in Tiếng Việt language . Hãy đóng vai 1 chuyên gia về marketing, bạn sẽ giải quyết các yêu cầu của khách hàng một cách chuyên nghiệp và đưa ra giải pháp hiệu quả nhất tới khách hàng.\nHãy đưa ra 1 bản phân tích về chân dung khách hàng, cho '.@$dataSend['product_servce'].', bao gồm\n- Demographic\n- Kênh truyền thông (hay tham gia và tương tác)\n- Nỗi đau, Vấn đề\n- Thách thức của họ gặp phải để đạt được mục tiêu mà '.@$dataSend['product_servce'].' chính là giải pháp\n- Khao khát của họ\n- Hành vi tiêu dùng\n- Những rào cản nào khiến họ không mua sản phẩm/dịch vụ\nliên quan tới sản phẩm/dịch vụ '.@$dataSend['product_servce'].', trình bày dưới dạng danh sách';

            /*if(!empty($dataSend['topic'])){
                $question .= 'chủ đề về '.$dataSend['topic'];
            }
            if(!empty($dataSend['customer_target'])){
                $question .=  'người tiếp cận '.$dataSend['customer_target'];
            }*/
            if(!empty($conversation_id)){
                if(!empty($dataSend['content_facebook_ads'])){
                    $question = $dataSend['content_facebook_ads'];
                }
            }

              $reply_ai = callAIphoenixtech($question,$conversation_id);

             $reply = '<h1>Phân tích chân dung khách hàng</h1>'.$reply_ai['result'];
            $reply_ai['result'] = $reply;

              $chat = array('result'=>$reply_ai['result'],'conversation_id'=>$reply_ai['conversation_id'], 'topic'=>@$dataSend['product_servce']);


                $session->write('content_facebook_ads', $chat);

             
               return array('code'=> 1, 'mess'=>'lấy dữ liệu thành công', 'data'=>$reply_ai,'question'=>$question);
        }
         return array('code'=> 0, 'mess'=>'lỗi hệ thống');
       
    }
      return array('code'=> 0, 'mess'=>'chưa đăng nhập');
}

function chatcontentFacebookAdsAPI($input){
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
                if(!empty($session->read('content_facebook_ads'))){
                     $chat = $session->read('content_facebook_ads');
                }

            if(!empty($dataSend['type'])){
                if($dataSend['type']=='ads'){
                    $question = 'Please answer me in Tiếng Việt language and also respond in Tiếng Việt language Youre a professional marketing expert. Your task is to write a captivating social media advertisement to promote a specific product or service as above mentioned or you also can use the product/service details discussed earlier. Remember to incorporate all these elements:\n\n \tStart with a catchy phrase or statement to grab attention.\n \tInclude an interesting statistic related to your product or service.\n \tIdentify at least 3 common problems or pain points that your product/service can solve.\n \tProvide solutions to the problems mentioned above.\n \tWrite your first call to action (CTA) urging customers to take immediate action.\n \tList at least five benefits of using your product or service, highlighting the features, emphasizing how these benefits make the customer feel, and including emojis for emphasis.\n \tEstablish your credibility or the credibility of the product/service.\n \tSet the context or scenario where your product/service is beneficial.\n \tWrite your second CTA, persuading customers to engage with your product/service.\n \tPaint a scenario where your product/service would be useful.\n \tWrite your final CTA, compelling customers to act now.After completing the ad, ask if I want another one drafted. If I respond , ask for my feedback or any changes I\'d like. Based on that feedback, draft the next ad. Continue this process until I respond ';
                }elseif($dataSend['type']=='pas') {
                    $question ='Please answer me in Tiếng Việt language and also respond in Tiếng Việt language . As an AI content assistant, your task is to create a compelling Facebook advertisement using the PAS (Problem, Agitate, Solution) so you can Connect with the reader\'s pain points, Intensify the urgency of the problem and Present your product or service as the solution\nfor our product/service which is '.$chat['topic'].', that target to the audience on ';
                }elseif($dataSend['type']=='hook'){
                    $question ='Please answer me in Tiếng Việt language and also respond in Tiếng Việt language . Develop a Facebook ad copy that deeply resonates with our target customer, ensuring they feel seen and valued. Detail how our product/service nhà nghỉ khách sạn addresses their needs and resolves their concerns, focusing on at least three key benefits they will experience, capture the audience\'s imagination, making them feel as if the product/service elevates their status, leave the target audience feeling eager and excited to Buy Now!  product/serivce. Including emojis for emphasis. \nDraw them in with compelling storytelling and captivating visuals that echo their personal journey. Incorporate elements of social proof to build trust and credibility. Show our audience how our product/service enriches their lives, steering clear from pressuring tactics. Instead, invite them to join us on a journey of discovery and improvement. The ultimate objective of this ad copy should be to inspire our customers to do Buy Now!  in a way that aligns with our business goals and cultivates a positive relationship with our audience';
                }
            }

                $conversation_id = @$dataSend['conversation_id'];
            
                $reply_ai = callAIphoenixtech($question,$conversation_id);
                
                 

                // $chat[] = array('question'=>$dataSend['question'],'result'=>$reply_ai['result'],'conversation_id'=>$reply_ai['conversation_id'],'number'=>$number );

                 if(!empty($dataSend['type'])){
                    if($dataSend['type']=='ads'){
                        $reply = '<h1>Viết mẫu quảng cáo Facebook</h1>'.$reply_ai['result'];
                        $reply_ai['result'] = $reply;
                    }elseif($dataSend['type']=='pas'){
                        $reply = '<h1>Viết mẫu quảng cáo PAS</h1>'.$reply_ai['result'];
                        $reply_ai['result'] = $reply;
                    }elseif($dataSend['type']=='hook'){
                        $reply = '<h1>Viết mẫu quảng cáo thú đẩy</h1>'.$reply_ai['result'];
                        $reply_ai['result'] = $reply;
                    }
                }

                $chat['result'] .= $reply_ai['result'];


                $session->write('content_facebook_ads', $chat);

                return array('code'=> 1, 'mess'=>'lấy dữ liệu thành công', 'data'=>$reply_ai);
            
        }
         return array('code'=> 0, 'mess'=>'lỗi hệ thống');
       
    }
     return array('code'=> 0, 'mess'=>'chưa đăng nhập');
}

function savecontentFacebookAdsAPI($input){
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
            if(!empty($session->read('content_facebook_ads'))){
                     $chat = $session->read('content_facebook_ads');
            }


            if(empty($dataSend['conversation_id']) && empty($dataSend['result'])){
                return array('code'=> 0, 'mess'=>'lỗi hệ thống');  
            }

            $checkContent = $modelContentFacebookAi->find()->where(['conversation_id'=>$dataSend['conversation_id'],'type'=>'content_facebook_ads'])->first();

            if(empty($checkContent)){
                $checkContent = $modelContentFacebookAi->newEmptyEntity();
                $checkContent->conversation_id = $dataSend['conversation_id'];
                $checkContent->created_at = time();
                $checkContent->type = 'content_facebook_ads';
            }
            $title = 'Viết  mẫu quảng cáo Facebook ';
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


function getbosAPI(){
    return listBostAi();
 
}
?>
