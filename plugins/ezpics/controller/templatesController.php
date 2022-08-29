<?php 
function createTemplate($input){
	global $session;
	global $controller;

	if(empty($session->read('infoUser'))){
		return $controller->redirect('/login');
	}
}
?>