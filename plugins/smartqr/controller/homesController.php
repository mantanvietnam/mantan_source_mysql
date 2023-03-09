<?php 
function redirectSmartQR($input)
{
	global $controller;

	$code = @$input['request']->getAttribute('params')['pass'][1];

	if(!empty($code)){
		$modelSmartqr = $controller->loadModel('Smartqrs');

		$conditions = array('code'=>$code);

		$data = $modelSmartqr->find()->where($conditions)->first();

		if(!empty($data->link_web)){
			return $controller->redirect($data->link_web);
		}
	}

	return $controller->redirect('/');
}

function createQRCode($input)
{
	global $controller;

	$code = @$input['request']->getAttribute('params')['pass'][1];

	if(!empty($code)){
		$modelSmartqr = $controller->loadModel('Smartqrs');

		$conditions = array('code'=>$code);

		$data = $modelSmartqr->find()->where($conditions)->first();
		
		if(!empty($data)){
			setVariable('data', $data);
		}
	}
}
?>