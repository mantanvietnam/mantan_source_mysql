<?php
	$menus= array();
    $menus[0]['title']= 'Subscribe';
	/*$menus[0]['sub'][0]= array(	'title'=>'Gửi email thông báo',
								'url'=>'/plugins/admin/subscribe-view-admin-send_subscribe',
								'classIcon'=>'bx bx-mail-send',
								'permission'=>'send_subscribe');*/

	$menus[0]['sub'][1]= array(	'title'=>'Danh sách email',
								'url'=> '/plugins/admin/subscribe-view-admin-list_subscribe',
								'classIcon'=>'bx bx-envelope',
								'permission'=>'list_subscribe');
	
    addMenuAdminMantan($menus);


function sendEmailPostNew($title, $link){

	global $controller;

	$modelSubscribes = $controller->loadModel('Subscribes');
	$listData = $modelSubscribes->find()->limit(99)->page(1)->where(array())->all()->toList();
	 if(!empty($listData)){

	foreach($listData as $key => $item){
			$to = array();
		 $to[]= trim($item->email);
	
   

	    $cc = array();
	    $bcc = array();
	    $subject = '[WARM] You received 1 new post from warm';

	    $content='<!DOCTYPE html>
	    <html lang="en">
	    <head>
	    <meta charset="UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <title>Thông tin đơn hàng </title>
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css">
	    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	    <style>
	    .bao{background: #fafafa;margin: 40px;padding: 20px 20px 40px;}
	    .logo{

	    }
	    .logo img{height: 115px;margin:  0 auto;display:  block;margin-bottom: 15px;}
	    .nd{background: white;margin: 0 auto;border-radius: 12px;overflow:  hidden;border: 2px solid #e6e2e2;line-height: 2;}
	    .head{background: #3fb901; color:white;text-align: center;padding: 15px 10px;font-size: 17px;text-transform: uppercase;}
	    .main{padding: 10px 20px;}
	    .thong_tin{padding: 0 20px 20px;}
	    .line{position: relative;height: 2px;}
	    .line1{position: absolute;top: 0;left: 0;width: 100%;height: 100%;background-image: linear-gradient(to right, transparent 50%, #737373 50%);background-size: 26px 100%;}
	    .cty{text-align:  center;margin: 20px 0 30px;}
	    .main .fa{color:green;}
	    table{margin:auto;}
	    @media screen and (max-width: 768px){
	      .bao{margin:0;}
	    }
	    @media screen and (max-width: 767px){
	      .bao{padding:6px; }
	      .nd{text-align: inherit;}
	    }
	    .table thead th , .table-bordered th , td{
	      vertical-align: bottom;
	      border: 1px solid #dee2e6;
	    }
	    </style>
	    </head>
	    <body>
	    <div class="bao">
	    <div class="nd">
	    <div class="main" style=" font-size: 16px;">
	    <h2 style=" text-align: center; font-size: 27px; ">You received 1 new post from warm</h2>
	    
	    <p>Title: '.$title.'</p>
	    <p>Link: <a href="'.$link.'">'.$link.'</a></p>
	   

	    
	    <br>
	    Trân trọng ./
	    <div style="white: 50%">
	    <br/><img src="http://warm.creatio.vn/themes/warm//asset/img/WARM-horz-EN-_1_.jpg" style="width: 200px;" alt="" jslog="138226; u014N:xr6bB; 53:WzAsMF0."> <br/>
	    <strong>DELEGATION OF THE EUROPEAN UNION TO VIETNAM</strong> <br/>
	    <a href="http://warm.creatio.vn/">http://warm.creatio.vn/</a> <br/>
	    Địa chỉ:24th floor, West wing, Lotte Center Hanoi 54 Lieu Giai street, Ba Dinh district, Hanoi, Vietnam <br/>
	    Điện thoại :84 (0)24 3941 0099 <br/>
	    </div>
	    </div>


	    </div>
	    </div>
	    </body>
	    </html>';

	    sendEmail($to, $cc, $bcc, $subject, $content);
	}
  }
}
?>