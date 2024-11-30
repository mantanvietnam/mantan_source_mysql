<?php 
function sendconnentFacebookAPI($input){
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

           $question = 'Viết 10 bài quảng cáo Facebook để bán sản phẩm '.@$dataSend['topic'].' cho đối tượng khách hàng là '.@$dataSend['customer_target'].'. Đảm bảo rằng bài viết mang cảm xúc '.@$dataSend['feeling'].', đồng thời nhấn mạnh những lợi ích là '.@$dataSend['benefit'].'. Kết thúc với một CTA '.@$dataSend['end'].'. Thêm 3 emoji vào đâu và cuối câu .';

           /* if(!empty($dataSend['topic'])){
                $question .= 'chủ đề về '.$dataSend['topic'];
            }
            if(!empty($dataSend['customer_target'])){
                $question .=  'người tiếp cận '.$dataSend['customer_target'];
            }*/
            if(!empty($conversation_id)){
                if(!empty($dataSend['chat'])){
                    $question = $dataSend['chat'];
                }
            }

              $reply_ai = callAIphoenixtech($question,$conversation_id);

              if(!empty($reply_ai['result']) && !empty($reply_ai['conversation_id'])){
              		 $session->write('connent_facebook_conversation_id', $reply_ai['conversation_id']);

		            $checkContentFacebook = $modelContentFacebookAis->find()->where(['conversation_id'=>$conversation_id, 'id_member'=>$member->id])->first();

		            if(empty($checkContentFacebook)){
		            	$save =  $modelContentFacebookAis->newEmptyEntity();
		            	$save->title = 'Viết 10 bài viết quảng Facebook';
		            	$save->conversation_id = $conversation_id;
		            	$save->topic = $dataSend['topic'];
		            	$save->content_ai =  $reply_ai['result'];
		            	$save->id_member = $member->id;
		            	$save->created_at =time();
		            	$save->status = 'active';
		            	$save->type = 'content_facebook';
		            	$save->customer_target = $dataSend['customer_target'];
		            	$save->feeling = $dataSend['feeling'];
		            	$save->benefit = $dataSend['benefit'];
		            	$save->end = $dataSend['end'];
		            	$save->question =$question;

		            	$modelContentFacebookAis->save($save);

		            }else{
		            	$save =  $modelHistoryChatAis->newEmptyEntity();
		            	$save->id_member = $member->id;
		            	$save->conversation_id = $conversation_id;
		            	$save->question =  @$dataSend['chat'];
		            	$save->reply_ai =$reply_ai['result'];
		            	$save->id_content = $checkContentFacebook->id;
		            	$save->content ='';
		            	$save->created_at = time();
		            	$save->type ='content_facebook';
		            }

		            return array('code'=> 1, 'mess'=>'lấy dữ liệu thành công', 'data'=>$reply_ai);

              }
               return array('code'=> 0, 'mess'=>'lỗi hệ thống');
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

 ?>
