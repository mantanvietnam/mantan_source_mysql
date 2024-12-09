<?php 
function writecontentimage($input){
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    if(!empty($session->read('infoUser'))){
       
        $modelcontentblogimage = $controller->loadModel('ContentFacebookAis');
        $member =$session->read('infoUser');
        if(!empty($_GET['id'])){
            $dataContent = $modelcontentblogimage->find()->where(['id'=>$_GET['id'],'type'=>'write_contentimage', 'id_member'=>$member->id])->first();
        }

        if(!empty($dataContent)){
            $chat = array('result'=>$dataContent->content_ai,'conversation_id'=>$dataContent->conversation_id, 'topic'=>@$dataContent->topic);
            $session->write('write_contentimage', $chat);

        }
        $data = array();
        if(!empty($session->read('write_contentimage'))){
            $data = $session->read('write_contentimage');
        }
       
        $bostAi =listBostAi()[3];    
      
        setVariable('data', $data);
        setVariable('bostAi', $bostAi);
        setVariable('dataContent', @$dataContent);

        
    }else{
        return $controller->redirect('/login');
    }
}
<<<<<<< Updated upstream
function wirefacebookcontent($input){
=======
function writecontentfacebook($input){
>>>>>>> Stashed changes
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    if(!empty($session->read('infoUser'))){
       
        $modelcontentblogimage = $controller->loadModel('ContentFacebookAis');
        $member =$session->read('infoUser');
        if(!empty($_GET['id'])){
<<<<<<< Updated upstream
            $dataContent = $modelcontentblogimage->find()->where(['id'=>$_GET['id'],'type'=>'content_creativefacebook_ads', 'id_member'=>$member->id])->first();
=======
            $dataContent = $modelcontentblogimage->find()->where(['id'=>$_GET['id'],'type'=>'write_contentfacebook', 'id_member'=>$member->id])->first();
>>>>>>> Stashed changes
        }

        if(!empty($dataContent)){
            $chat = array('result'=>$dataContent->content_ai,'conversation_id'=>$dataContent->conversation_id, 'topic'=>@$dataContent->topic);
<<<<<<< Updated upstream
            $session->write('content_creativefacebook_ads', $chat);

        }
        $data = array();
        if(!empty($session->read('content_creativefacebook_ads'))){
            $data = $session->read('content_creativefacebook_ads');
=======
            $session->write('write_contentfacebook', $chat);

        }
        $data = array();
        if(!empty($session->read('write_contentfacebook'))){
            $data = $session->read('write_contentfacebook');
>>>>>>> Stashed changes
        }
       
        $bostAi =listBostAi()[7];    
      
        setVariable('data', $data);
        setVariable('bostAi', $bostAi);
        setVariable('dataContent', @$dataContent);

        
    }else{
        return $controller->redirect('/login');
    }
}
<<<<<<< Updated upstream
function wirefacebookcontentsix($input){
=======
function createsampleADS($input){
>>>>>>> Stashed changes
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    if(!empty($session->read('infoUser'))){
       
        $modelcontentblogimage = $controller->loadModel('ContentFacebookAis');
        $member =$session->read('infoUser');
        if(!empty($_GET['id'])){
<<<<<<< Updated upstream
            $dataContent = $modelcontentblogimage->find()->where(['id'=>$_GET['id'],'type'=>'content_facebooksix_ads', 'id_member'=>$member->id])->first();
=======
            $dataContent = $modelcontentblogimage->find()->where(['id'=>$_GET['id'],'type'=>'write_sampleads', 'id_member'=>$member->id])->first();
>>>>>>> Stashed changes
        }

        if(!empty($dataContent)){
            $chat = array('result'=>$dataContent->content_ai,'conversation_id'=>$dataContent->conversation_id, 'topic'=>@$dataContent->topic);
<<<<<<< Updated upstream
            $session->write('content_facebooksix_ads', $chat);

        }
        $data = array();
        if(!empty($session->read('content_facebooksix_ads'))){
            $data = $session->read('content_facebooksix_ads');
=======
            $session->write('write_sampleads', $chat);

        }
        $data = array();
        if(!empty($session->read('write_sampleads'))){
            $data = $session->read('write_sampleads');
>>>>>>> Stashed changes
        }
       
        $bostAi =listBostAi()[8];    
      
        setVariable('data', $data);
        setVariable('bostAi', $bostAi);
        setVariable('dataContent', @$dataContent);

        
    }else{
        return $controller->redirect('/login');
    }
}
?>