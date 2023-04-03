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


    function destination(){
        global $urlHomes;


        return array(   '1'=>array('id'=>1,'name'=>'DI TÍCH VĂN HÓA LỊCH SỬ','class'=>'fa-print','image'=>'/themes/tayho360//img/thaianhimg/iconditich.png','urlSlug'=>'di_tich_lich_su'),
            //'2'=>array('id'=>2,'name'=>'DANH LAM','class'=>'fa-print','image'=>'/themes/tayho360//img/thaianhimg/icondanhlam.png','urlSlug'=>'di_tich_lich_su'),   
            '2'=>array('id'=>3,'name'=>'LỄ HỘI','class'=>'fa-print','image'=>'/themes/tayho360//img/thaianhimg/iconlehoi.png','urlSlug'=>'pho_co'),   
            '3'=>array('id'=>4,'name'=>'LÀNG NGHỀ','class'=>'fa-print','image'=>'/themes/tayho360//img/thaianhimg/iconlangnghe.png','urlSlug'=>'tour'),  
            '4'=>array('id'=>5,'name'=>'CƠ QUAN HÀNH CHÍNH','class'=>'fa-print','image'=>'/themes/tayho360//img/thaianhimg/iconcoquan.png','urlSlug'=>'co_quan_hanh_chinh'),   
            '5'=>array('id'=>6,'name'=>'TRUNG TÂM HỘI NGHỊ SỰ KIỆN','class'=>'fa-print','image'=>'/themes/tayho360//img/thaianhimg/icontrungtam.png','urlSlug'=>'le_hoi'), 
            '6'=>array('id'=>7,'name'=>'KHÁCH SẠN','class'=>'fa-print','image'=>'/themes/tayho360//img/thaianhimg/iconkhachsan.png','urlSlug'=>'khach_san'),   
            '7'=>array('id'=>8,'name'=>'NHÀ HÀNG QUÁN ĂN','class'=>'fa-print','image'=>'/themes/tayho360//img/thaianhimg/iconnhahang.png','urlSlug'=>'nha_hang'),   
            '8'=>array('id'=>9,'name'=>'DỊCH VỤ HỖ TRỢ DU LỊCH','class'=>'fa-print','image'=>'/themes/tayho360//img/thaianhimg/iconhotro.png','urlSlug'=>'giai_tri'),  
        );                                  
             
    }

 function getFindnear(){

      global $urlHomes;
    global $controller;
       

        $modelGovernanceAgency = $controller->loadModel('Governanceagencys');
        $governanceAgency= $modelGovernanceAgency->find()->limit(200)->page(1)->where(array())->order(array())->all()->toList();

        $modelFestival = $controller->loadModel('Festivals');
        $festival= $modelFestival->find()->limit(200)->page(1)->where(array())->order(array())->all()->toList();

        $modelRestaurant = $controller->loadModel('Restaurants');
        $restaurant= $modelRestaurant->find()->limit(200)->page(1)->where(array())->order(array())->all()->toList();

        $modelTour = $controller->loadModel('Tours');
        $tour= $modelTour->find()->limit(200)->page(1)->where(array())->order(array())->all()->toList();

        $modelHotel = $controller->loadModel('Hotels');
        $hotel= $modelHotel->find()->limit(200)->page(1)->where(array())->order(array())->all()->toList();

        $modelHistoricalsite = $controller->loadModel('Historicalsites');
        $historicalsite= $modelHistoricalsite->find()->limit(200)->page(1)->where(array())->order(array())->all()->toList();





        $listData = array();

        if(!empty($governanceAgency)){
            foreach($governanceAgency as $keyGovernanceAgency => $listGovernanceAgency){
                $listData[] =  array('name'=> $listGovernanceAgency->name,
                                    'address'=> $listGovernanceAgency->address,
                                    'phone'=> $listGovernanceAgency->phone,
                                    'image'=> $listGovernanceAgency->image,
                                    'lat'=> $listGovernanceAgency->latitude,
                                    'long'=> $listGovernanceAgency->longitude,
                                    'urlSlug'=> 'chi_tiet_co_quan_hanh_chinh/'.$listGovernanceAgency->urlSlug.'.html',
                                    'type'=> 'co_quan_hanh_chinh',
                                     'icon'=> '/themes/tayho360/assets/icon/hanhchinh.png',

                );
            }
        } 

         if(!empty($historicalsite)){
            foreach($historicalsite as $keyGovernanceAgency => $listhistoricalsite){
                $listData[] =  array('name'=> $listhistoricalsite->name,
                                    'address'=> $listhistoricalsite->address,
                                    'phone'=> $listhistoricalsite->phone,
                                    'image'=> $listhistoricalsite->image,
                                    'lat'=> $listhistoricalsite->latitude,
                                    'long'=> $listhistoricalsite->longitude,
                                    'urlSlug'=> 'chi_tiet_di_tich_lich_su/'.$listhistoricalsite->urlSlug.'.html',
                                    'type'=> 'di_tich_lich_su',
                                     'icon'=> '/themes/tayho360/assets/icon/ditich.png',

                );
            }
        } 

        if(!empty($festival)){
            foreach($festival as $keyfestival => $listFestival){
                $listData[] =  array('name'=> $listFestival->name,
                                    'address'=> $listFestival->address,
                                    'phone'=> $listFestival->phone,
                                    'image'=> $listFestival->image,
                                    'lat'=> $listFestival->latitude,
                                    'long'=> $listFestival->longitude,
                                    'urlSlug'=> 'chi_tiet_le_hoi/'.$listFestival->urlSlug.'.html',
                                    'type'=> 'le_hoi',
                                     'icon'=> '/themes/tayho360/assets/icon/lehoi.png',

                );
            }
        }
      if(!empty($restaurant)){
            foreach($restaurant as $keyrestaurant => $listRestaurant){
                $listData[] =  array('name'=> $listRestaurant->name,
                                    'address'=> $listRestaurant->address,
                                    'phone'=> $listRestaurant->phone,
                                    'image'=> $listRestaurant->image,
                                    'lat'=> $listRestaurant->latitude,
                                    'long'=> $listRestaurant->longitude,
                                    'urlSlug'=> 'chi_tiet_nha_hang/'.$listRestaurant->urlSlug.'.html',
                                    'type'=> 'nha_hang',
                                     'icon'=> '/themes/tayho360/assets/icon/nhahanh.png',

                );
            }
        }
     if(!empty($tour)){
            foreach($tour as $keyTour => $listTour){
                $listData[] =  array('name'=> $listTour->name,
                                    'address'=> $listTour->address,
                                    'phone'=> $listTour->phone,
                                    'image'=> $listTour->image,
                                    'lat'=> $listTour->latitude,
                                    'long'=> $listTour->longitude,
                                    'urlSlug'=> 'chi_tiet_tour/'.$listTour->urlSlug.'.html',
                                    'type'=> 'tour',
                                     'icon'=> '/themes/tayho360/assets/icon/hotro.png',

                );
            }
        }
        if(!empty($hotel)){
            foreach($hotel as $keyHotel => $listHotel){
                $listData[] =  array('name'=> $listHotel->name,
                                    'address'=> $listHotel->address,
                                    'phone'=> $listHotel->phone,
                                    'image'=> $listHotel->image,
                                    'lat'=> $listHotel->latitude,
                                    'long'=> $listHotel->longitude,
                                    'urlSlug'=> 'chi_tiet_khach_san/'.$listHotel->urlSlug.'.html',
                                    'type'=> 'khach_san',
                                    'icon'=> '/themes/tayho360/assets/icon/khachsan.png',

                );
            }
        }
return $listData;

}
?>