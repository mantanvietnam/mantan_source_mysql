<?php 
function sendconnentBlogController($input){
    global $isRequestPost;
    global $controller;
    global $session;
    global $modelCategoryConnects;
    global $modelCategories;

    if(!empty($session->read('infoUser'))){
        $data = array();
        if(!empty($session->read('chat'))){
            $data = $session->read('chat');
        }
        
        setVariable('data', $data);
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