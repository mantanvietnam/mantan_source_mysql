<?php 
function sendContenLanding($input){
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;
    global $metaTitleMantan;

    if(!empty($session->read('infoUser'))){
        $metaTitleMantan = 'Tạo landing page đỉnh cao';
        $modelContentFacebookAi = $controller->loadModel('ContentFacebookAis');
        $member =$session->read('infoUser');
        if(!empty($_GET['id'])){
            $dataContent = $modelContentFacebookAi->find()->where(['id'=>$_GET['id'],'type'=>'content_landing', 'id_member'=>$member->id])->first();
        }

        if(!empty($dataContent)){
            $chat = array('result'=>$dataContent->content_ai,'conversation_id'=>$dataContent->conversation_id, 'topic'=>@$dataContent->topic);
            $session->write('content_landing', $chat);

        }
        $data = array();
        if(!empty($session->read('content_landing'))){
            $data = $session->read('content_landing');
        }
       
          $bostAi =listBostAi()[11];   

    
    
        setVariable('data', @$data);
        setVariable('bostAi', @$bostAi);
        setVariable('dataContent', @$dataContent);

        
    }else{
        return $controller->redirect('/login');
    }
}
 ?>