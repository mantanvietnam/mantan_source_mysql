<?php 
function sendcontentBlogFacebook($input){
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    if(!empty($session->read('infoUser'))){
        $data = array();
        if(!empty($session->read('plan_10facebook_posts'))){
            $data = $session->read('plan_10facebook_posts');
        }

       
          $bostAi =listBostAi()[1];

    
        setVariable('data', $data);
        setVariable('bostAi', $bostAi);


    }else{
        return $controller->redirect('/login');
    }
}

function chat(){

    global $session;
    $data = array();
    if(!empty($session->read('chat'))){
        $data = $session->read('chat');
    }
    
     setVariable('data', $data);
}

 ?>