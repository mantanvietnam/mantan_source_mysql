<?php 
$menus= array();
$menus[0]['title']= 'Tây Hồ 360';
/*$menus[0]['sub'][0]= array(	'title'=>'Điểm đến di tích và danh lam',
							'url'=>'/plugins/admin/tayho360-admin-historicalSites-listHistoricalSitesAdmin.php',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listHistoricalSitesAdmin'
						);*/


$menus[0]['sub'][0]= array('title'=>'Cơ quan hành chính',
							'url'=>'/plugins/admin/tayho360-admin-governanceAgencys-listGovernanceAgencysAdmin.php',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listGovernanceAgencysAdmin',
							
						);
$menus[0]['sub'][1]= array('title'=>'Lễ hội',
							'url'=>'/plugins/admin/tayho360-admin-festival-listFestivalAdmin.php',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listFestivalAdmin',
							
						);
$menus[0]['sub'][2]= array('title'=>'Dịch vụ hỗ trợ du lịch',
							'url'=>'/plugins/admin/tayho360-admin-tour-listTourAdmin.php',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listTourAdmin',
							
						);
$menus[0]['sub'][3]= array('title'=>'Điểm đến làng nghề',
							'url'=>'/plugins/admin/tayho360-admin-craftvillage-listCraftvillageAdmin.php',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listTourAdmin',
							
						);
$menus[0]['sub'][4]= array('title'=>'Nhà hàng',
							'url'=>'/plugins/admin/tayho360-admin-restaurant-listRestaurantAdmin.php',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listTourAdmin',
							
						);
$menus[0]['sub'][5]= array('title'=>'Khách sạn',
							'url'=>'/plugins/admin/tayho360-admin-hotel-listHotelAdmin.php',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listTourAdmin',
							
						);
$menus[0]['sub'][6]= array('title'=>'Ảnh 360',
							'url'=>'/plugins/admin/tayho360-admin-image360-listImage360Admin.php',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listTourAdmin',
							
						);
$menus[0]['sub'][7]= array('title'=>'Sự kiện',
							'url'=>'/plugins/admin/tayho360-admin-event-listEventAdmin.php',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listTourAdmin',
							
						);
addMenuAdminMantan($menus);


function getmonth(){ 
    return array(
        '1'=>array('id'=>'1','name'=>'Tháng 1'),
        '2'=>array('id'=>'2','name'=>'Tháng 2'),
        '3'=>array('id'=>'3','name'=>'Tháng 3'),
        '4'=>array('id'=>'4','name'=>'Tháng 4'),
        '5'=>array('id'=>'5','name'=>'Tháng 5'),
        '6'=>array('id'=>'6','name'=>'Tháng 6'),
        '7'=>array('id'=>'7','name'=>'Tháng 7'),
        '8'=>array('id'=>'8','name'=>'Tháng 8'),
        '9'=>array('id'=>'9','name'=>'Tháng 9'),
        '10'=>array('id'=>'10','name'=>'Tháng 10'),
        '11'=>array('id'=>'11','name'=>'Tháng 11'),
        '12'=>array('id'=>'12','name'=>'Tháng 12'),
    );
}