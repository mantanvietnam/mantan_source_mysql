<?php 

function findnear(){

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

                );
            }
        }

         setVariable('listData', $listData); 




}
 ?>