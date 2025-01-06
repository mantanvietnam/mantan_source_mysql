<?php 
function sendContentVideo($input){
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;
    global $metaTitleMantan;
    if(!empty($session->read('infoUser'))){
        $metaTitleMantan ='Tái chế nội dung đỉnh cao - VIP';
        $modelContentFacebookAi = $controller->loadModel('ContentFacebookAis');
        $member =$session->read('infoUser');
        if(!empty($_GET['id'])){
            $dataContent = $modelContentFacebookAi->find()->where(['id'=>$_GET['id'],'type'=>'content_video', 'id_member'=>$member->id])->first();
        }

        if(!empty($dataContent)){
            $chat = array('result'=>$dataContent->content_ai,'conversation_id'=>$dataContent->conversation_id, 'topic'=>@$dataContent->topic);
            $session->write('content_video', $chat);

        }
        $data = array();
        if(!empty($session->read('content_video'))){
            $data = $session->read('content_video');
        }
       
          $bostAi =listBostAi()[4];   

    
    
        setVariable('data', @$data);
        setVariable('bostAi', @$bostAi);
        setVariable('dataContent', @$dataContent);

        
    }else{
        return $controller->redirect('/login');
    }
}

function sendContentVideoScript($input){
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;
    global $metaTitleMantan;
    if(!empty($session->read('infoUser'))){
        $metaTitleMantan ='Tái chế nội dung đỉnh cao - VIP';
        $modelContentFacebookAi = $controller->loadModel('ContentFacebookAis');
        $member =$session->read('infoUser');
        if(!empty($_GET['id'])){
            $dataContent = $modelContentFacebookAi->find()->where(['id'=>$_GET['id'],'type'=>'content_video_script', 'id_member'=>$member->id])->first();
        }

        if(!empty($dataContent)){
            $chat = array('result'=>$dataContent->content_ai,'conversation_id'=>$dataContent->conversation_id, 'topic'=>@$dataContent->topic);
            $session->write('content_video_script', $chat);

        }
        $data = array();
        if(!empty($session->read('content_video_script'))){
            $data = $session->read('content_video_script');
        }
       
          $bostAi =listBostAi()[4];   

    
    
        setVariable('data', @$data);
        setVariable('bostAi', @$bostAi);
        setVariable('dataContent', @$dataContent);

        
    }else{
        return $controller->redirect('/login');
    }
}

 ?>
