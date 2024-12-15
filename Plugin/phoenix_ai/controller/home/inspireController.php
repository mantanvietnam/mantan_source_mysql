<?php 
function sendContentInspire($input){
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    if(!empty($session->read('infoUser'))){
        $metaTitleMantan ='Tái chế nội dung đỉnh cao - VIP';
        $modelContentFacebookAi = $controller->loadModel('ContentFacebookAis');
        $member =$session->read('infoUser');
        if(!empty($_GET['id'])){
            $dataContent = $modelContentFacebookAi->find()->where(['id'=>$_GET['id'],'type'=>'content_inspire', 'id_member'=>$member->id])->first();
        }

        if(!empty($dataContent)){
            $chat = array('result'=>$dataContent->content_ai,'conversation_id'=>$dataContent->conversation_id, 'topic'=>@$dataContent->topic);
            $session->write('content_inspire', $chat);

        }
        $data = array();
        if(!empty($session->read('content_inspire'))){
            $data = $session->read('content_inspire');
        }
       
          $bostAi =listBostAi()[12];  
    
        setVariable('data', @$data);
        setVariable('bostAi', @$bostAi);
        setVariable('dataContent', @$dataContent);

        
    }else{
        return $controller->redirect('/login');
    }
}
 ?>
