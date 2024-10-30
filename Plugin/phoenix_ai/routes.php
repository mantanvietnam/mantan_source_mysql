<?php
	global $routesPlugin;

	// tài khoản cá nhân
	$routesPlugin['login']= 'phoenix_ai/view/home/member/login.php';
	$routesPlugin['register']= 'phoenix_ai/view/home/member/register.php';
	$routesPlugin['logout']= 'phoenix_ai/view/home/member/logout.php';
	$routesPlugin['forgotPass']= 'phoenix_ai/view/home/member/forgotPass.php';
	$routesPlugin['confirm']= 'phoenix_ai/view/home/member/confirm.php';
	$routesPlugin['changePass']= 'phoenix_ai/view/home/member/changePass.php';
	$routesPlugin['account']= 'phoenix_ai/view/home/member/account.php';

	// trợ lý ảo AI
	$routesPlugin['ai-virtual-assistant']= 'phoenix_ai/view/home/ai/aiVirtualAssistant.php';
	$routesPlugin['ai-create-clip']= 'phoenix_ai/view/home/ai/aiCreateClip.php';
	$routesPlugin['ai-create-image']= 'phoenix_ai/view/home/ai/aiCreateImage.php';
	$routesPlugin['ai-create-marketing']= 'phoenix_ai/view/home/ai/aiCreateMarketing.php';
	$routesPlugin['ai-create-content']= 'phoenix_ai/view/home/ai/aiCreateContent.php';
	$routesPlugin['ai-search-image-event']= 'phoenix_ai/view/home/ai/aiSearchImageEvent.php';

	$routesPlugin['ai-search-image']= 'phoenix_ai/view/home/ai/aiSearchImage.php';
	
	