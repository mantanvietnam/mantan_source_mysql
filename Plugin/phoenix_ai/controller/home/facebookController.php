<?php 
function sendContentFacebook($input){
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;
    global $metaTitleMantan;

    if(!empty($session->read('infoUser'))){
        $metaTitleMantan = 'Viết 10 chủ đề bài viết đăng Facebook';
        $modelContentFacebookAi = $controller->loadModel('ContentFacebookAis');
        $member =$session->read('infoUser');
        if(!empty($_GET['id'])){
            $dataContent = $modelContentFacebookAi->find()->where(['id'=>$_GET['id'],'type'=>'content_facebook', 'id_member'=>$member->id])->first();
        }

        if(!empty($dataContent)){
            $chat = array('result'=>$dataContent->content_ai,'conversation_id'=>$dataContent->conversation_id, 'topic'=>@$dataContent->topic);
            $session->write('content_facebook', $chat);

        }
        $data = array();
        if(!empty($session->read('content_facebook'))){
            $data = $session->read('content_facebook');
        }
       
          $bostAi =listBostAi()[1];

    
        setVariable('data', $data);
        setVariable('bostAi', $bostAi);
        setVariable('dataContent', @$dataContent);

        
    }else{
        return $controller->redirect('/login');
    }
}

function infoContentFacebook($input){
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    if(!empty($session->read('infoUser'))){
       
        $modelContentFacebookAi = $controller->loadModel('ContentFacebookAis');
        $member =$session->read('infoUser');
        if(!empty($_GET['id'])){
            $dataContent = $modelContentFacebookAi->find()->where(['id'=>$_GET['id'],'type'=>'content_facebook', 'id_member'=>$member->id])->first();
        }

        if(!empty($dataContent)){
            $chat = array('result'=>$dataContent->content_ai,'conversation_id'=>$dataContent->conversation_id, 'topic'=>@$dataContent->topic);
            $session->write('content_facebook', $chat);

        }
        $data = array();
        if(!empty($session->read('content_facebook'))){
            $data = $session->read('content_facebook');
        }
       
          $bostAi =listBostAi()[1];

    
        setVariable('data', $data);
        setVariable('bostAi', $bostAi);
        setVariable('dataContent', @$dataContent);

        
    }else{
        return $controller->redirect('/login');
    }
}


function sendContentFacebookAds($input){
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;
    global $metaTitleMantan;

    if(!empty($session->read('infoUser'))){
        $metaTitleMantan = 'Viết mẫu quảng cáo Facebook';
       
        $modelContentFacebookAi = $controller->loadModel('ContentFacebookAis');
        $member =$session->read('infoUser');
        if(!empty($_GET['id'])){
            $dataContent = $modelContentFacebookAi->find()->where(['id'=>$_GET['id'],'type'=>'content_facebook_ads', 'id_member'=>$member->id])->first();
        }

        if(!empty($dataContent)){
            $chat = array('result'=>$dataContent->content_ai,'conversation_id'=>$dataContent->conversation_id, 'topic'=>@$dataContent->topic);
            $session->write('content_facebook_ads', $chat);

        }
        $data = array();
        if(!empty($session->read('content_facebook_ads'))){
            $data = $session->read('content_facebook_ads');
        }
       
          $bostAi =listBostAi()[5];

    
        setVariable('data', $data);
        setVariable('bostAi', $bostAi);
        setVariable('dataContent', @$dataContent);

        
    }else{
        return $controller->redirect('/login');
    }
}
 ?>