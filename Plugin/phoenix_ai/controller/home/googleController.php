<?php 
function sendContentGoogleAds($input){
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    if(!empty($session->read('infoUser'))){
       
        $modelContentFacebookAi = $controller->loadModel('ContentFacebookAis');
        $member =$session->read('infoUser');
        if(!empty($_GET['id'])){
            $dataContent = $modelContentFacebookAi->find()->where(['id'=>$_GET['id'],'type'=>'content_googles_ads', 'id_member'=>$member->id])->first();
        }

        if(!empty($dataContent)){
            $chat = array('result'=>$dataContent->content_ai,'conversation_id'=>$dataContent->conversation_id, 'topic'=>@$dataContent->topic);
            $session->write('content_googles_ads', $chat);

        }
        $data = array();
        if(!empty($session->read('content_googles_ads'))){
            $data = $session->read('content_googles_ads');
        }
       
          $bostAi =listBostAi()[6];

    
        setVariable('data', $data);
        setVariable('bostAi', $bostAi);
        setVariable('dataContent', @$dataContent);

        
    }else{
        return $controller->redirect('/login');
    }
}
 ?>