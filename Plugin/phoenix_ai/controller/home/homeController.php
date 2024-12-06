<?php 
function dashboard($input){
	 global $session;
	 global $controller;
    $data = array();
    if(!empty($session->read('infoUser'))){
       
            $data = listBostAi();
        
        
         setVariable('data', $data);
    }else{
        return $controller->redirect('/login');
    }
}

function chat(){

    global $session;
    global $controller;
    $data = array();
    if(!empty($session->read('infoUser'))){
        if(!empty($session->read('chat'))){
            $data = $session->read('chat');
        }
        
         setVariable('data', $data);
    }else{
        return $controller->redirect('/login');
    }
}

 ?>