<?php 
function listUserEzpics($input)
{
	
}

// for home
function login($input)
{
	global $session;
	global $controller;

	if(!empty($session->read('infoUser'))){
		return $controller->redirect('/account');
	}
}

function account($input)
{
	global $session;
	global $controller;

	if(empty($session->read('infoUser'))){
		return $controller->redirect('/login');
	}
}

function logout($input)
{
	global $session;
	global $controller;

	$session->destroy();
    return $controller->redirect('/');
}

?>