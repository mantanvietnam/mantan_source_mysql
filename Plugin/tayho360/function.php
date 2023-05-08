<?php 

global $keyFirebase;

$keyFirebase = 'AAAAmV3l9xI:APA91bH_cEaRYEz8d-_JbIDDk32k1aqlt8PgB7ctT8Qx-0ErMU70ja_aT9QTsT5rUG2xdPOxxIhFLGxRpUAIr1LaBxCiRF2KH5aMD0T5NN4kARg1KKwGsPIAl2g3PYF8XYa0FAB0CZYi';

$menus= array();
$menus[0]['title']= 'Tây Hồ 360';



$menus[0]['sub'][0]= array('title'=>'Cơ quan hành chính',
							'url'=>'/plugins/admin/tayho360-admin-governanceAgencys-listGovernanceAgencysAdmin.php',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listGovernanceAgencysAdmin',
							
						);
$menus[0]['sub'][1]= array('title'=>'Dịch vụ hỗ trợ du lịch',
                            'url'=>'/plugins/admin/tayho360-admin-service-listServiceAdmin.php',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listTourAdmin',
                            
                        );
$menus[0]['sub'][2]= array('title'=>'Lễ hội',
							'url'=>'/plugins/admin/tayho360-admin-festival-listFestivalAdmin.php',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listFestivalAdmin',
							
						);
$menus[0]['sub'][4]= array('title'=>'Điểm đến làng nghề',
							'url'=>'/plugins/admin/tayho360-admin-craftvillage-listCraftvillageAdmin.php',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listCraftvillageAdmin',
							
						);

$menus[0]['sub'][6]= array('title'=>'Danh lam',
							'url'=>'/plugins/admin/tayho360-admin-place-listPlaceAdmin.php',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listPlaceAdmin',
							
						);
$menus[0]['sub'][7]= array('title'=>'Ảnh 360',
							'url'=>'/plugins/admin/tayho360-admin-image360-listImage360Admin.php',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listImage360Admin',
							
						);
$menus[0]['sub'][8]= array('title'=>'Sự kiện',
							'url'=>'/plugins/admin/tayho360-admin-event-listEventAdmin.php',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listEventAdmin',
							
						);
$menus[0]['sub'][9]= array('title'=>'Trung tâm hội nghị sự kiện',
                            'url'=>'/plugins/admin/tayho360-admin-eventcenter-listEventcenterAdmin.php',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listEventcenterAdmin',
                            
                        );

$menus[0]['sub'][5]= array('title'=>'Nhà hàng',
                            'url'=>'/plugins/admin/tayho360-admin-restaurant-listRestaurantAdmin.php',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listRestaurantAdmin',
                            
                        );

$menus[0]['sub'][10]= array('title'=>'Đặt bàn nhà hàng',
                            'url'=>'/plugins/admin/tayho360-admin-restaurant-listBookTableAdmin.php',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listBookTableAdmin',
                            
                        );
$menus[0]['sub'][3]= array('title'=>'Tour',
                            'url'=>'/plugins/admin/tayho360-admin-tour-listTourAdmin.php',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listTourAdmin',
                            
                        );
$menus[0]['sub'][11]= array('title'=>'Đặt tour',
                            'url'=>'/plugins/admin/tayho360-admin-tour-listBookTourAdmin.php',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listBookTourAdmin',
                            
                        );
$menus[0]['sub'][12]= array('title'=>'Đặt khách sạn',
                            'url'=>'/plugins/admin/tayho360-admin-hotel-listBookhotelAdmin.php',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listBookTourAdmin',
                            
                        );

$menus[0]['sub'][13]= array( 'title'=>'Thông báo',
                            'url'=>'/plugins/admin/tayho360-admin-notification-addNotificationAdmin.php',
                            'classIcon'=>'bx bx-bell',
                            'permission'=>'addNotificationAdmin'
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

function categoryService(){
    return array('1'=>array('id'=>'1','name'=>'Ngân hàng, phòng giao dịch'),
        '2'=>array('id'=>'2','name'=>'Đơn vị lữ hành, vận chuyển'),
        '3'=>array('id'=>'3','name'=>'Bệnh viện, phòng khám, trạm y tế'),
        '4'=>array('id'=>'3','name'=>'Khác'),
    );
}

function datetour(){
    return array('1'=>array('id'=>'1','name'=>'Ngày 1'),
        '2'=>array('id'=>'2','name'=>'Ngày 2'),
        '3'=>array('id'=>'3','name'=>'Ngày 3'),
    );
}

function rating(){
    return array('1'=>array('id'=>'1','name'=>'Cấp quốc gia'),
        '2'=>array('id'=>'2','name'=>'Cấp thành phố'),
        '3'=>array('id'=>'3','name'=>'Chưa xếp hạng'),
    );
}

    function destination(){
        global $urlHomes;


        return array(   '1'=>array('id'=>1,'name'=>'Di tích văn hóa lịch sử','class'=>'fa-print','image'=>'/themes/tayho360//img/thaianhimg/iconditich.png','urlSlug'=>'di_tich_lich_su'),
            '2'=>array('id'=>2,'name'=>'Danh lam','class'=>'fa-print','image'=>'/themes/tayho360//img/thaianhimg/icondanhlam.png','urlSlug'=>'danh_lam'),   
            '3'=>array('id'=>3,'name'=>'Lễ hội','class'=>'fa-print','image'=>'/themes/tayho360//img/thaianhimg/iconlehoi.png','urlSlug'=>'le_hoi'),   
            '4'=>array('id'=>4,'name'=>'Làng nghề','class'=>'fa-print','image'=>'/themes/tayho360//img/thaianhimg/iconlangnghe.png','urlSlug'=>'lang_nghe'),  
            '5'=>array('id'=>5,'name'=>'Cơ quan hành chính','class'=>'fa-print','image'=>'/themes/tayho360//img/thaianhimg/iconcoquan.png','urlSlug'=>'co_quan_hanh_chinh'),   
            '6'=>array('id'=>6,'name'=>'Trung tâm hội nghị sự kiện','class'=>'fa-print','image'=>'/themes/tayho360//img/thaianhimg/icontrungtam.png','urlSlug'=>'trung_tam_hoi_nghi_su_kien'), 
            '7'=>array('id'=>7,'name'=>'Khách sạn','class'=>'fa-print','image'=>'/themes/tayho360//img/thaianhimg/iconkhachsan.png','urlSlug'=>'khach_san'),   
            '8'=>array('id'=>8,'name'=>'Nhà hàng quán ăn','class'=>'fa-print','image'=>'/themes/tayho360//img/thaianhimg/iconnhahang.png','urlSlug'=>'nha_hang'),   
            '9'=>array('id'=>9,'name'=>'Dịch vụ hỗ trợ du lịch','class'=>'fa-print','image'=>'/themes/tayho360//img/thaianhimg/iconhotro.png','urlSlug'=>'dich_vu_ho_tro_du_lich'),  
             
        );                                  
             
    }

     function getListFurniture(){
        return array(   '1'=>array('id'=>1,'name'=>'Máy in','class'=>'fas fa-print','image'=>'/app/Plugin/mantanHotel/images/print.png','nameEN'=>'Printer'), 
            '2'=>array('id'=>2,'name'=>'Tivi','class'=>'fas fa-tv','image'=>'/app/Plugin/mantanHotel/images/tivi.png','nameEN'=>'Television'), 
            '3'=>array('id'=>3,'name'=>'Wifi','class'=>'fas fa-wifi','image'=>'/app/Plugin/mantanHotel/images/wifi.png','nameEN'=>'Wifi'),
            '4'=>array('id'=>4,'name'=>'Giặt là','class'=>'flaticon-hanger','image'=>'/app/Plugin/mantanHotel/images/bullseye.png','nameEN'=>'Laundry'),
            '5'=>array('id'=>5,'name'=>'Điều hòa','class'=>'flaticon-air-conditioner','image'=>'/app/Plugin/mantanHotel/images/podcast.png','nameEN'=>'Air conditional'),
            '6'=>array('id'=>6,'name'=>'Thang máy','class'=>'flaticon-elevator','image'=>'/app/Plugin/mantanHotel/images/building.png','nameEN'=>'Elevator'),
            '7'=>array('id'=>7,'name'=>'Chỗ để ôtô','class'=>'flaticon-parking-1','image'=>'/app/Plugin/mantanHotel/images/car.png','nameEN'=>'Parking'),
            '8'=>array('id'=>8,'name'=>'Nhà hàng','class'=>'flaticon-room-service-1','image'=>'/app/Plugin/mantanHotel/images/beer.png','nameEN'=>'Restaurant'),
            '9'=>array('id'=>9,'name'=>'Ăn sáng','class'=>'flaticon-restaurant','image'=>'/app/Plugin/mantanHotel/images/coffee.png','nameEN'=>'Breakfast'),
            '10'=>array('id'=>10,'name'=>'Điện thoại','class'=>'flaticon-telephone','image'=>'/app/Plugin/mantanHotel/images/phone.png','nameEN'=>'Phone'),
            '11'=>array('id'=>11,'name'=>'Tủ quần áo','class'=>'flaticon-bathrobe','image'=>'/app/Plugin/mantanHotel/images/street-view.png','nameEN'=>'Wardrobe'),
            '12'=>array('id'=>12,'name'=>'Bình cứu hỏa','class'=>'flaticon-fire-extinguisher','image'=>'/app/Plugin/mantanHotel/images/fire-extinguisher.png','nameEN'=>'Fire extinguisher'), 
            '13'=>array('id'=>13,'name'=>'Truyền hình cáp','class'=>'flaticon-monitor','image'=>'/app/Plugin/mantanHotel/images/cloud-download.png','nameEN'=>'Cable television'), 
            '14'=>array('id'=>14,'name'=>'Bàn làm việc','class'=>'flaticon-reception','image'=>'/app/Plugin/mantanHotel/images/archive.png','nameEN'=>'Desk'), 
            '15'=>array('id'=>15,'name'=>'Bồn tắm','class'=>'flaticon-bathtub','image'=>'/app/Plugin/mantanHotel/images/bath.png','nameEN'=>'Bathtub'), 
            '16'=>array('id'=>16,'name'=>'Bình nóng lạnh','class'=>'flaticon-safebox','image'=>'/app/Plugin/mantanHotel/images/shower.png','nameEN'=>'Heater'), 
            '17'=>array('id'=>17,'name'=>'Tủ lạnh','class'=>'fa-random','image'=>'/app/Plugin/mantanHotel/images/random.png','nameEN'=>'Fridge'), 
            '18'=>array('id'=>18,'name'=>'Bàn uống nước','class'=>'fa-archive','image'=>'/app/Plugin/mantanHotel/images/archive.png','nameEN'=>'Dining table and chairs'), 


            '19'=>array('id'=>19,'name'=>'Mini Bar','class'=>'fas fa-beer','image'=>'/app/Plugin/mantanHotel/images/archive.png','nameEN'=>'Mini Bar'), 
            '20'=>array('id'=>20,'name'=>'Thanh toán bằng thẻ tín dụng','class'=>'fab fa-cc-visa','image'=>'/app/Plugin/mantanHotel/images/archive.png','nameEN'=>'Payment by credit card'), 
            '21'=>array('id'=>21,'name'=>'Máy sấy tóc','class'=>'fas fa-crosshairs','image'=>'/app/Plugin/mantanHotel/images/archive.png','nameEN'=>'Hairdryer'), 
            '22'=>array('id'=>22,'name'=>'Cho thuê xe ô tô, xe máy','class'=>'fas fa-car','image'=>'/app/Plugin/mantanHotel/images/archive.png','nameEN'=>'Car and motorbike rental'), 
            '23'=>array('id'=>23,'name'=>'Hướng dẫn viên du lịch','class'=>'fas fa-male','image'=>'/app/Plugin/mantanHotel/images/archive.png','nameEN'=>'Tour guide'), 
            '24'=>array('id'=>24,'name'=>'Hội trường','class'=>'fas fa-chalkboard-teacher','image'=>'/app/Plugin/mantanHotel/images/archive.png','nameEN'=>'Hall'), 
        );
    }

 function getFindnear(){

      global $urlHomes;
    global $controller;
       $conditions['status']= 1;

        $modelGovernanceAgency = $controller->loadModel('Governanceagencys');
        $governanceAgency= $modelGovernanceAgency->find()->where($conditions)->all();

        $modelFestival = $controller->loadModel('Festivals');
        $festival= $modelFestival->find()->where($conditions)->all();

        $modelRestaurant = $controller->loadModel('Restaurants');
        $restaurant= $modelRestaurant->find()->where($conditions)->all();

        $modelTour = $controller->loadModel('Tours');
        $tour= $modelTour->find()->where($conditions)->all();

        $modelHotel = $controller->loadModel('Hotels');
        $hotel= $modelHotel->find()->where($conditions)->all();

        $modelHistoricalsite = $controller->loadModel('Historicalsites');
        $historicalsite= $modelHistoricalsite->find()->where($conditions)->all();

        $modelPlace = $controller->loadModel('Places');
        $Place= $modelPlace->find()->where($conditions)->all();

        $modelService = $controller->loadModel('Services');
        $service= $modelService->find()->where($conditions)->all();

        $modelEventcenter = $controller->loadModel('Eventcenters');
        $eventcenter= $modelEventcenter->find()->where($conditions)->all();

        $modelCraftvillage = $controller->loadModel('Craftvillages');
        $Craftvillage= $modelCraftvillage->find()->where($conditions)->all();



        $listData = array();

        if(!empty($Craftvillage)){
            foreach($eventcenter as $keyCraftvillage => $listCraftvillage){
                $listData[] =  array('name'=> $listCraftvillage->name,
                                    'address'=> $listCraftvillage->address,
                                    'phone'=> $listCraftvillage->phone,
                                    'image'=> $listCraftvillage->image,
                                    'lat'=> $listCraftvillage->latitude,
                                    'long'=> $listCraftvillage->longitude,
                                    'urlSlug'=> 'chi_tiet_lang_nghe/'.$listCraftvillage->urlSlug.'.html',
                                    'type'=> 'lang_nghe',
                                     'icon'=> '/themes/tayho360/assets/icon/khachsan.png',

                );
            }
        }

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

        if(!empty($service)){
            foreach($service as $keyService => $listService){
                $listData[] =  array('name'=> $listService->name,
                                    'address'=> $listService->address,
                                    'phone'=> $listService->phone,
                                    'image'=> $listService->image,
                                    'lat'=> $listService->latitude,
                                    'long'=> $listService->longitude,
                                    'urlSlug'=> 'chi_tiet_dich_vu_ho_tro_du_lich/'.$listService->urlSlug.'.html',
                                    'type'=> 'dich_vu_ho_tro_du_lich',
                                     'icon'=> '/themes/tayho360/assets/icon/hotro.png',

                );
            }
        }

         if(!empty($eventcenter)){
            foreach($eventcenter as $keyEventcenter => $listEventcenter){
                $listData[] =  array('name'=> $listEventcenter->name,
                                    'address'=> $listEventcenter->address,
                                    'phone'=> $listEventcenter->phone,
                                    'image'=> $listEventcenter->image,
                                    'lat'=> $listEventcenter->latitude,
                                    'long'=> $listEventcenter->longitude,
                                    'urlSlug'=> 'chi_tiet_trung_tam_hoi_nghi_su_kien/'.$listEventcenter->urlSlug.'.html',
                                    'type'=> 'trung_tam_hoi_nghi_su_kien',
                                     'icon'=> '/themes/tayho360/assets/icon/khachsan.png',

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

        if(!empty($Place)){
            foreach($Place as $keyPlace => $listPlace){
                $listData[] =  array('name'=> $listPlace->name,
                                    'address'=> $listPlace->address,
                                    'phone'=> $listPlace->phone,
                                    'image'=> $listPlace->image,
                                    'lat'=> $listPlace->latitude,
                                    'long'=> $listPlace->longitude,
                                    'urlSlug'=> 'chi_tiet_danh_lam/'.$listPlace->urlSlug.'.html',
                                    'type'=> 'danh_lam',
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

        $keyManMo = '5dc8f2652ac5db08348b4567';
        $city = 1;
        $district = 11;

        $dataPost= array('key'=>$keyManMo, 'city'=>1, 'lat'=>'','nameHotel'=> '', 'long'=>'', 'district'=>11, 'limit'=>'','page'=>1);
            $listHotel= sendDataConnectMantan('https://api.quanlyluutru.com/getHotelAroundAPI', $dataPost);
            $listHotel= str_replace('ï»¿', '', utf8_encode($listHotel));
            $listHotel= json_decode($listHotel, true);

        if(!empty($listHotel['data'])){
            foreach($listHotel['data'] as $keyHotel => $Hotel){
                $listData[] =  array('name'=> @$Hotel['Hotel']['name'],
                                    'address'=> @$Hotel['Hotel']['address'],
                                    'phone'=> @$Hotel['Hotel']['phone'],
                                    'image'=> @$Hotel['Hotel']['imageDefault'],
                                    'lat'=> sprintf("%.12f", $Hotel['Hotel']['coordinates_x']) ,
                                    'long'=> sprintf("%.12f", $Hotel['Hotel']['coordinates_y']) ,
                                    'urlSlug'=> 'chi_tiet_khach_san/'.$Hotel['Hotel']['slug'].'.html',
                                    'type'=> 'khach_san',
                                    'icon'=> '/themes/tayho360/assets/icon/khachsan.png',

                );
            }
        }
return $listData;

}

function getGovernanceAgency($id){
    global $modelOption;
    global $controller;
    $modelGovernanceAgency = $controller->loadModel('GovernanceAgencys');
        $data = $modelGovernanceAgency->find()->where(['id'=>intval($id)])->first();     
        return $data;
}

function getFestival($id){
    global $modelOption;
    global $controller;
    $modelFestival = $controller->loadModel('Festivals');
        $data = $modelFestival->find()->where(['id'=>intval($id)])->first();    
        return $data;
}

function getTour($id){
    global $modelOption;
    global $controller;
    $modelTour = $controller->loadModel('Tours');
        $data = $modelTour->find()->where(['id'=>intval($id)])->first();        
        return $data;
}
function getCraftvillage($id){
    global $modelOption;
    global $controller;
    $modelCraftvillage = $controller->loadModel('Craftvillages');
        $data = $modelCraftvillage->find()->where(['id'=>intval($id)])->first();      
        return $data;
}
function getRestaurant($id){
    global $modelOption;
    global $controller;
    $modelRestaurantr = $controller->loadModel('Restaurants');
        $data = $modelRestaurantr->find()->where(['id'=>intval($id)])->first();        
        return $data;
}

function getEvent($id){
    global $modelOption;
    global $controller;
    $modelEvent = $controller->loadModel('Events');
        $data = $modelEvent->find()->where(['id'=>intval($id)])->first();       
        return $data;
}
function getPlace($id){
    global $modelOption;
    global $controller;
    $modelPlace = $controller->loadModel('Places');
        $data = $modelPlace->find()->where(['id'=>intval($id)])->first();        
        return $data;
}
function getService($id){
    
    global $modelOption;
    global $controller;
    $modelService = $controller->loadModel('Services');

        $data = $modelService->find()->where(['id'=>intval($id)])->first();

        return $data;
}

function getEventcenter($id){
    
    global $modelOption;
    global $controller;
    $modelEventcenter = $controller->loadModel('Eventcenters');

        $data = $modelEventcenter->find()->where(['id'=>intval($id)])->first();

        return $data;
}

function getHotel($id){
    global $modelOption;
    global $controller;

       $keyManMo = '5dc8f2652ac5db08348b4567';
     $dataPost= array('key'=>$keyManMo, 'idHotel'=>$id, 'lat'=>'','idUser'=> '', 'long'=>'');
            $listHotel= sendDataConnectMantan('https://api.quanlyluutru.com/getInfoHotelAPI', $dataPost);
            $listHotel= str_replace('ï»¿', '', utf8_encode($listHotel));
            $listHotel= json_decode($listHotel, true);
        $data = $listHotel;     
        return $data;
}
/*function distance($x1, $y1, $x2, $y2) {
    $x1 = (int) $x1; 
    $y1 = (int) $y1; 
    $x2 = (int) $x2; 
    $y2 = (int) $y2;


    if(@$x2 > @$x1){
       $x=  @$x2 - @$x1;
    }else{
        $x= @$x1 - @$x2;
    }

    if(@$y2 > @$y1){
       $y=  @$y2 - @$y1;
    }else{
        $y= @$y1 - @$y2;
    }
    $val = pow(sin($x/2),2)+cos($x1)*cos($y)*pow(sin($y/2),2); 
    //$distance = sqrt(pow($x, 2) + pow($y, 2)); 
    $distance = 6378.8 * (2 * asin(sqrt($val)));; 
    echo $distance;
}*/


function distance($lat1, $lon1, $lat2, $lon2) {
    if((float)$lon1 > (float)$lon2){
       $theta = (float)$lon1 - (float)$lon2;
    }else{
        $theta =(float)$lon2 - (float)$lon1;
    }

  
  $dist = sin(deg2rad((float)$lat1)) * sin(deg2rad((float)$lat2)) + cos(deg2rad((float)$lat1)) * cos(deg2rad((float)$lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  
  
    return ($miles * 1.609344);
 }

 function sendNotification($data,$target){
    global $keyFirebase;
    $url = 'https://fcm.googleapis.com/fcm/send';

    $fields = array();
    
    $fields['data'] = $data;
    $fields['priority'] = 'high';
    $fields['content_available'] = true;

    $fields['notification'] = ['title'=>$data['title'], 'body'=>$data['content']];
    
    if(is_array($target)){
        $fields['registration_ids'] = $target;
    }else{
        $fields['to'] = $target;
    }

    $headers = array(
        'Content-Type:application/json',
        'Authorization:key='.$keyFirebase
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
    if ($result === FALSE) {

    }
    curl_close($ch);

    return $result;
}
?>