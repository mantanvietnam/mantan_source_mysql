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

?>