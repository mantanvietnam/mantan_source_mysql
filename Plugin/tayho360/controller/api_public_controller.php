<?php
function getTokenConnectAPI($input)
{
    global $isRequestPost;
    global $controller;

    $modelTokenApis = $controller->loadModel('TokenApis');

    $return = ['code'=>1, 'token'=>'', 'mess'=>'', 'deadline'=>''];

    if($isRequestPost){
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['user']) && !empty($dataSend['pass'])){
            $checkToken = $modelTokenApis->find()->where(['user'=>$dataSend['user'], 'pass'=>md5($dataSend['pass'])])->first();

            if(!empty($checkToken)){
                $checkToken->token = createTokenCode();
                $checkToken->deadline = time() + 30*24*60*60;

                $modelTokenApis->save($checkToken);

                $return = ['code'=>0, 'token'=>$checkToken->token, 'mess'=>'Lấy mã thành công', 'deadline'=>$checkToken->deadline];
            }else{
                $return = ['code'=>2, 'token'=>'', 'mess'=>'Sai tài khoản', 'deadline'=>''];
            }
        }else{
            $return = ['code'=>3, 'token'=>'', 'mess'=>'Gửi thiếu dữ liệu', 'deadline'=>''];
        }
    }else{
        $return = ['code'=>4, 'token'=>'', 'mess'=>'Gửi sai kiểu POST', 'deadline'=>''];
    }

    return $return;
}

function getListGovernanceAPI($input)
{
    global $controller;
    global $isRequestPost;
    
    $modelGovernanceAgency = $controller->loadModel('GovernanceAgencys');
    $modelTokenApis = $controller->loadModel('TokenApis');

    $return= array('code'=>1,'listData'=>[], 'mess'=>'');
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        
        if(!empty($dataSend['token'])){
            $checkToken = $modelTokenApis->find()->where(['token'=>$dataSend['token'], 'deadline >='=>time()])->first();

            if(!empty($checkToken)){
                $conditions = array('status'=>1);
                if(empty($dataSend['page'])) $dataSend['page'] = 1;
                if(empty($dataSend['limit'])) $dataSend['limit'] = 25;
                $order = ['created'=>'desc'];

                $totalData= $modelGovernanceAgency->find()->where($conditions)->limit($dataSend['limit'])->page($dataSend['page'])->order($order)->all()->toList();

                $return= array('code'=>0,'listData'=>$totalData, 'mess'=>'Lấy dữ liệu thành công');
            }else{
                $return= array('code'=>2,'listData'=>[], 'mess'=>'Sai mã token hoặc mã token hết hạn');
            }
        }else{
            $return= array('code'=>3,'listData'=>[], 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
        $return= array('code'=>4,'listData'=>[], 'mess'=>'Gửi sai kiểu POST');
    }

    return $return;
}

function getInfoGovernanceAPI($input)
{
    global $controller;
    global $isRequestPost;
    
    $modelGovernanceAgency = $controller->loadModel('GovernanceAgencys');
    $modelTokenApis = $controller->loadModel('TokenApis');

    $return= array('code'=>1,'data'=>[], 'mess'=>'');
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        
        if(!empty($dataSend['token']) && !empty($dataSend['id'])){
            $checkToken = $modelTokenApis->find()->where(['token'=>$dataSend['token'], 'deadline >='=>time()])->first();

            if(!empty($checkToken)){
                $data= $modelGovernanceAgency->find()->where(['id'=>(int) $dataSend['id'] ])->first();

                $return= array('code'=>0,'data'=>$data, 'mess'=>'Lấy dữ liệu thành công');
            }else{
                $return= array('code'=>2,'data'=>[], 'mess'=>'Sai mã token hoặc mã token hết hạn');
            }
        }else{
            $return= array('code'=>3,'data'=>[], 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
        $return= array('code'=>4,'data'=>[], 'mess'=>'Gửi sai kiểu POST');
    }

    return $return;
}

function searchGovernanceAPI($input)
{
    global $controller;
    global $isRequestPost;
    
    $modelGovernanceAgency = $controller->loadModel('GovernanceAgencys');
    $modelTokenApis = $controller->loadModel('TokenApis');

    $return= array('code'=>1,'listData'=>[], 'mess'=>'');
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        
        if(!empty($dataSend['token'])){
            $checkToken = $modelTokenApis->find()->where(['token'=>$dataSend['token'], 'deadline >='=>time()])->first();

            if(!empty($checkToken)){
                $conditions = array('status'=>1);
                if(empty($dataSend['page'])) $dataSend['page'] = 1;
                if(empty($dataSend['limit'])) $dataSend['limit'] = 25;
                $order = ['created'=>'desc'];

                if(!empty($dataSend['name'])){
                    $conditions['name LIKE'] = '%'.$dataSend['name'].'%';
                }

                $totalData= $modelGovernanceAgency->find()->where($conditions)->limit($dataSend['limit'])->page($dataSend['page'])->order($order)->all()->toList();

                $return= array('code'=>0,'listData'=>$totalData, 'mess'=>'Lấy dữ liệu thành công');
            }else{
                $return= array('code'=>2,'listData'=>[], 'mess'=>'Sai mã token hoặc mã token hết hạn');
            }
        }else{
            $return= array('code'=>3,'listData'=>[], 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
        $return= array('code'=>4,'listData'=>[], 'mess'=>'Gửi sai kiểu POST');
    }

    return $return;
}

/* ---------------------------------------------- */
function getListCraftVillageAPI($input)
{
    global $controller;
    global $isRequestPost;
    
    $modelCraftvillage = $controller->loadModel('Craftvillages');
    $modelTokenApis = $controller->loadModel('TokenApis');

    $return= array('code'=>1,'listData'=>[], 'mess'=>'');
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        
        if(!empty($dataSend['token'])){
            $checkToken = $modelTokenApis->find()->where(['token'=>$dataSend['token'], 'deadline >='=>time()])->first();

            if(!empty($checkToken)){
                $conditions = array('status'=>1);
                if(empty($dataSend['page'])) $dataSend['page'] = 1;
                if(empty($dataSend['limit'])) $dataSend['limit'] = 25;
                $order = ['created'=>'desc'];

                $totalData= $modelCraftvillage->find()->where($conditions)->limit($dataSend['limit'])->page($dataSend['page'])->order($order)->all()->toList();

                $return= array('code'=>0,'listData'=>$totalData, 'mess'=>'Lấy dữ liệu thành công');
            }else{
                $return= array('code'=>2,'listData'=>[], 'mess'=>'Sai mã token hoặc mã token hết hạn');
            }
        }else{
            $return= array('code'=>3,'listData'=>[], 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
        $return= array('code'=>4,'listData'=>[], 'mess'=>'Gửi sai kiểu POST');
    }

    return $return;
}

function getInfoCraftVillageAPI($input)
{
    global $controller;
    global $isRequestPost;
    
    $modelCraftvillage = $controller->loadModel('Craftvillages');
    $modelTokenApis = $controller->loadModel('TokenApis');

    $return= array('code'=>1,'data'=>[], 'mess'=>'');
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        
        if(!empty($dataSend['token']) && !empty($dataSend['id'])){
            $checkToken = $modelTokenApis->find()->where(['token'=>$dataSend['token'], 'deadline >='=>time()])->first();

            if(!empty($checkToken)){
                $data= $modelCraftvillage->find()->where(['id'=>(int) $dataSend['id'] ])->first();

                $return= array('code'=>0,'data'=>$data, 'mess'=>'Lấy dữ liệu thành công');
            }else{
                $return= array('code'=>2,'data'=>[], 'mess'=>'Sai mã token hoặc mã token hết hạn');
            }
        }else{
            $return= array('code'=>3,'data'=>[], 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
        $return= array('code'=>4,'data'=>[], 'mess'=>'Gửi sai kiểu POST');
    }

    return $return;
}

function searchCraftVillageAPI($input)
{
    global $controller;
    global $isRequestPost;
    
    $modelCraftvillage = $controller->loadModel('Craftvillages');
    $modelTokenApis = $controller->loadModel('TokenApis');

    $return= array('code'=>1,'listData'=>[], 'mess'=>'');
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        
        if(!empty($dataSend['token'])){
            $checkToken = $modelTokenApis->find()->where(['token'=>$dataSend['token'], 'deadline >='=>time()])->first();

            if(!empty($checkToken)){
                $conditions = array('status'=>1);
                if(empty($dataSend['page'])) $dataSend['page'] = 1;
                if(empty($dataSend['limit'])) $dataSend['limit'] = 25;
                $order = ['created'=>'desc'];

                if(!empty($dataSend['name'])){
                    $conditions['name LIKE'] = '%'.$dataSend['name'].'%';
                }

                $totalData= $modelCraftvillage->find()->where($conditions)->limit($dataSend['limit'])->page($dataSend['page'])->order($order)->all()->toList();

                $return= array('code'=>0,'listData'=>$totalData, 'mess'=>'Lấy dữ liệu thành công');
            }else{
                $return= array('code'=>2,'listData'=>[], 'mess'=>'Sai mã token hoặc mã token hết hạn');
            }
        }else{
            $return= array('code'=>3,'listData'=>[], 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
        $return= array('code'=>4,'listData'=>[], 'mess'=>'Gửi sai kiểu POST');
    }

    return $return;
}
/* ----------------------------------------- */
function getListPlaceAPI($input)
{
    global $controller;
    global $isRequestPost;
    
    $modelPlace = $controller->loadModel('Places');
    $modelTokenApis = $controller->loadModel('TokenApis');

    $return= array('code'=>1,'listData'=>[], 'mess'=>'');
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        
        if(!empty($dataSend['token'])){
            $checkToken = $modelTokenApis->find()->where(['token'=>$dataSend['token'], 'deadline >='=>time()])->first();

            if(!empty($checkToken)){
                $conditions = array('status'=>1);
                if(empty($dataSend['page'])) $dataSend['page'] = 1;
                if(empty($dataSend['limit'])) $dataSend['limit'] = 25;
                $order = ['created'=>'desc'];

                $totalData= $modelPlace->find()->where($conditions)->limit($dataSend['limit'])->page($dataSend['page'])->order($order)->all()->toList();

                $return= array('code'=>0,'listData'=>$totalData, 'mess'=>'Lấy dữ liệu thành công');
            }else{
                $return= array('code'=>2,'listData'=>[], 'mess'=>'Sai mã token hoặc mã token hết hạn');
            }
        }else{
            $return= array('code'=>3,'listData'=>[], 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
        $return= array('code'=>4,'listData'=>[], 'mess'=>'Gửi sai kiểu POST');
    }

    return $return;
}

function getInfoPlaceAPI($input)
{
    global $controller;
    global $isRequestPost;
    
    $modelPlace = $controller->loadModel('Places');
    $modelTokenApis = $controller->loadModel('TokenApis');

    $return= array('code'=>1,'data'=>[], 'mess'=>'');
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        
        if(!empty($dataSend['token']) && !empty($dataSend['id'])){
            $checkToken = $modelTokenApis->find()->where(['token'=>$dataSend['token'], 'deadline >='=>time()])->first();

            if(!empty($checkToken)){
                $data= $modelPlace->find()->where(['id'=>(int) $dataSend['id'] ])->first();

                $return= array('code'=>0,'data'=>$data, 'mess'=>'Lấy dữ liệu thành công');
            }else{
                $return= array('code'=>2,'data'=>[], 'mess'=>'Sai mã token hoặc mã token hết hạn');
            }
        }else{
            $return= array('code'=>3,'data'=>[], 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
        $return= array('code'=>4,'data'=>[], 'mess'=>'Gửi sai kiểu POST');
    }

    return $return;
}

function searchPlaceAPI($input)
{
    global $controller;
    global $isRequestPost;
    
    $modelPlace = $controller->loadModel('Places');
    $modelTokenApis = $controller->loadModel('TokenApis');

    $return= array('code'=>1,'listData'=>[], 'mess'=>'');
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        
        if(!empty($dataSend['token'])){
            $checkToken = $modelTokenApis->find()->where(['token'=>$dataSend['token'], 'deadline >='=>time()])->first();

            if(!empty($checkToken)){
                $conditions = array('status'=>1);
                if(empty($dataSend['page'])) $dataSend['page'] = 1;
                if(empty($dataSend['limit'])) $dataSend['limit'] = 25;
                $order = ['created'=>'desc'];

                if(!empty($dataSend['name'])){
                    $conditions['name LIKE'] = '%'.$dataSend['name'].'%';
                }

                $totalData= $modelPlace->find()->where($conditions)->limit($dataSend['limit'])->page($dataSend['page'])->order($order)->all()->toList();

                $return= array('code'=>0,'listData'=>$totalData, 'mess'=>'Lấy dữ liệu thành công');
            }else{
                $return= array('code'=>2,'listData'=>[], 'mess'=>'Sai mã token hoặc mã token hết hạn');
            }
        }else{
            $return= array('code'=>3,'listData'=>[], 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
        $return= array('code'=>4,'listData'=>[], 'mess'=>'Gửi sai kiểu POST');
    }

    return $return;
}
/* ----------------------------------------- */
function getListRestaurantAPI($input)
{
    global $controller;
    global $isRequestPost;
    
    $modelRestaurant = $controller->loadModel('Restaurants');
    $modelTokenApis = $controller->loadModel('TokenApis');

    $return= array('code'=>1,'listData'=>[], 'mess'=>'');
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        
        if(!empty($dataSend['token'])){
            $checkToken = $modelTokenApis->find()->where(['token'=>$dataSend['token'], 'deadline >='=>time()])->first();

            if(!empty($checkToken)){
                $conditions = array('status'=>1);
                if(empty($dataSend['page'])) $dataSend['page'] = 1;
                if(empty($dataSend['limit'])) $dataSend['limit'] = 25;
                $order = ['created'=>'desc'];

                $totalData= $modelRestaurant->find()->where($conditions)->limit($dataSend['limit'])->page($dataSend['page'])->order($order)->all()->toList();

                $return= array('code'=>0,'listData'=>$totalData, 'mess'=>'Lấy dữ liệu thành công');
            }else{
                $return= array('code'=>2,'listData'=>[], 'mess'=>'Sai mã token hoặc mã token hết hạn');
            }
        }else{
            $return= array('code'=>3,'listData'=>[], 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
        $return= array('code'=>4,'listData'=>[], 'mess'=>'Gửi sai kiểu POST');
    }

    return $return;
}

function getInfoRestaurantAPI($input)
{
    global $controller;
    global $isRequestPost;
    
    $modelRestaurant = $controller->loadModel('Restaurants');
    $modelTokenApis = $controller->loadModel('TokenApis');

    $return= array('code'=>1,'data'=>[], 'mess'=>'');
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        
        if(!empty($dataSend['token']) && !empty($dataSend['id'])){
            $checkToken = $modelTokenApis->find()->where(['token'=>$dataSend['token'], 'deadline >='=>time()])->first();

            if(!empty($checkToken)){
                $data= $modelRestaurant->find()->where(['id'=>(int) $dataSend['id'] ])->first();

                $return= array('code'=>0,'data'=>$data, 'mess'=>'Lấy dữ liệu thành công');
            }else{
                $return= array('code'=>2,'data'=>[], 'mess'=>'Sai mã token hoặc mã token hết hạn');
            }
        }else{
            $return= array('code'=>3,'data'=>[], 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
        $return= array('code'=>4,'data'=>[], 'mess'=>'Gửi sai kiểu POST');
    }

    return $return;
}

function searchRestaurantAPI($input)
{
    global $controller;
    global $isRequestPost;
    
    $modelRestaurant = $controller->loadModel('Restaurants');
    $modelTokenApis = $controller->loadModel('TokenApis');

    $return= array('code'=>1,'listData'=>[], 'mess'=>'');
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        
        if(!empty($dataSend['token'])){
            $checkToken = $modelTokenApis->find()->where(['token'=>$dataSend['token'], 'deadline >='=>time()])->first();

            if(!empty($checkToken)){
                $conditions = array('status'=>1);
                if(empty($dataSend['page'])) $dataSend['page'] = 1;
                if(empty($dataSend['limit'])) $dataSend['limit'] = 25;
                $order = ['created'=>'desc'];

                if(!empty($dataSend['name'])){
                    $conditions['name LIKE'] = '%'.$dataSend['name'].'%';
                }

                $totalData= $modelRestaurant->find()->where($conditions)->limit($dataSend['limit'])->page($dataSend['page'])->order($order)->all()->toList();

                $return= array('code'=>0,'listData'=>$totalData, 'mess'=>'Lấy dữ liệu thành công');
            }else{
                $return= array('code'=>2,'listData'=>[], 'mess'=>'Sai mã token hoặc mã token hết hạn');
            }
        }else{
            $return= array('code'=>3,'listData'=>[], 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
        $return= array('code'=>4,'listData'=>[], 'mess'=>'Gửi sai kiểu POST');
    }

    return $return;
}

/* ----------------------------------------- */
function getListHotelAPI($input)
{
    global $controller;
    global $isRequestPost;
    
    $modelHotel = $controller->loadModel('Hotels');
    $modelTokenApis = $controller->loadModel('TokenApis');

    $return= array('code'=>1,'listData'=>[], 'mess'=>'');
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        
        if(!empty($dataSend['token'])){
            $checkToken = $modelTokenApis->find()->where(['token'=>$dataSend['token'], 'deadline >='=>time()])->first();

            if(!empty($checkToken)){
                $conditions = array('status'=>1);
                if(empty($dataSend['page'])) $dataSend['page'] = 1;
                if(empty($dataSend['limit'])) $dataSend['limit'] = 25;
                $order = ['created'=>'desc'];

                $totalData= $modelHotel->find()->where($conditions)->limit($dataSend['limit'])->page($dataSend['page'])->order($order)->all()->toList();

                $return= array('code'=>0,'listData'=>$totalData, 'mess'=>'Lấy dữ liệu thành công');
            }else{
                $return= array('code'=>2,'listData'=>[], 'mess'=>'Sai mã token hoặc mã token hết hạn');
            }
        }else{
            $return= array('code'=>3,'listData'=>[], 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
        $return= array('code'=>4,'listData'=>[], 'mess'=>'Gửi sai kiểu POST');
    }

    return $return;
}

function getInfoHotelAPI($input)
{
    global $controller;
    global $isRequestPost;
    
    $modelHotel = $controller->loadModel('Hotels');
    $modelTokenApis = $controller->loadModel('TokenApis');

    $return= array('code'=>1,'data'=>[], 'mess'=>'');
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        
        if(!empty($dataSend['token']) && !empty($dataSend['id'])){
            $checkToken = $modelTokenApis->find()->where(['token'=>$dataSend['token'], 'deadline >='=>time()])->first();

            if(!empty($checkToken)){
                $data= $modelHotel->find()->where(['id'=>(int) $dataSend['id'] ])->first();

                $return= array('code'=>0,'data'=>$data, 'mess'=>'Lấy dữ liệu thành công');
            }else{
                $return= array('code'=>2,'data'=>[], 'mess'=>'Sai mã token hoặc mã token hết hạn');
            }
        }else{
            $return= array('code'=>3,'data'=>[], 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
        $return= array('code'=>4,'data'=>[], 'mess'=>'Gửi sai kiểu POST');
    }

    return $return;
}

function searchHotelAPI($input)
{
    global $controller;
    global $isRequestPost;
    
    $modelHotel = $controller->loadModel('Hotels');
    $modelTokenApis = $controller->loadModel('TokenApis');

    $return= array('code'=>1,'listData'=>[], 'mess'=>'');
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        
        if(!empty($dataSend['token'])){
            $checkToken = $modelTokenApis->find()->where(['token'=>$dataSend['token'], 'deadline >='=>time()])->first();

            if(!empty($checkToken)){
                $conditions = array('status'=>1);
                if(empty($dataSend['page'])) $dataSend['page'] = 1;
                if(empty($dataSend['limit'])) $dataSend['limit'] = 25;
                $order = ['created'=>'desc'];

                if(!empty($dataSend['name'])){
                    $conditions['name LIKE'] = '%'.$dataSend['name'].'%';
                }

                $totalData= $modelHotel->find()->where($conditions)->limit($dataSend['limit'])->page($dataSend['page'])->order($order)->all()->toList();

                $return= array('code'=>0,'listData'=>$totalData, 'mess'=>'Lấy dữ liệu thành công');
            }else{
                $return= array('code'=>2,'listData'=>[], 'mess'=>'Sai mã token hoặc mã token hết hạn');
            }
        }else{
            $return= array('code'=>3,'listData'=>[], 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
        $return= array('code'=>4,'listData'=>[], 'mess'=>'Gửi sai kiểu POST');
    }

    return $return;
}
/* ----------------------------------------- */
function getListHistoricalSitesAPI($input)
{
    global $controller;
    global $isRequestPost;
    
    $modelHistoricalsite = $controller->loadModel('Historicalsites');
    $modelTokenApis = $controller->loadModel('TokenApis');

    $return= array('code'=>1,'listData'=>[], 'mess'=>'');
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        
        if(!empty($dataSend['token'])){
            $checkToken = $modelTokenApis->find()->where(['token'=>$dataSend['token'], 'deadline >='=>time()])->first();

            if(!empty($checkToken)){
                $conditions = array('status'=>1);
                if(empty($dataSend['page'])) $dataSend['page'] = 1;
                if(empty($dataSend['limit'])) $dataSend['limit'] = 25;
                $order = ['created'=>'desc'];

                $totalData= $modelHistoricalsite->find()->where($conditions)->limit($dataSend['limit'])->page($dataSend['page'])->order($order)->all()->toList();

                $return= array('code'=>0,'listData'=>$totalData, 'mess'=>'Lấy dữ liệu thành công');
            }else{
                $return= array('code'=>2,'listData'=>[], 'mess'=>'Sai mã token hoặc mã token hết hạn');
            }
        }else{
            $return= array('code'=>3,'listData'=>[], 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
        $return= array('code'=>4,'listData'=>[], 'mess'=>'Gửi sai kiểu POST');
    }

    return $return;
}

function getInfoHistoricalSitesAPI($input)
{
    global $controller;
    global $isRequestPost;
    
    $modelHistoricalsite = $controller->loadModel('Historicalsites');
    $modelTokenApis = $controller->loadModel('TokenApis');

    $return= array('code'=>1,'data'=>[], 'mess'=>'');
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        
        if(!empty($dataSend['token']) && !empty($dataSend['id'])){
            $checkToken = $modelTokenApis->find()->where(['token'=>$dataSend['token'], 'deadline >='=>time()])->first();

            if(!empty($checkToken)){
                $data= $modelHistoricalsite->find()->where(['id'=>(int) $dataSend['id'] ])->first();

                $return= array('code'=>0,'data'=>$data, 'mess'=>'Lấy dữ liệu thành công');
            }else{
                $return= array('code'=>2,'data'=>[], 'mess'=>'Sai mã token hoặc mã token hết hạn');
            }
        }else{
            $return= array('code'=>3,'data'=>[], 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
        $return= array('code'=>4,'data'=>[], 'mess'=>'Gửi sai kiểu POST');
    }

    return $return;
}

function searchHistoricalSitesAPI($input)
{
    global $controller;
    global $isRequestPost;
    
    $modelHistoricalsite = $controller->loadModel('Historicalsites');
    $modelTokenApis = $controller->loadModel('TokenApis');

    $return= array('code'=>1,'listData'=>[], 'mess'=>'');
    
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        
        if(!empty($dataSend['token'])){
            $checkToken = $modelTokenApis->find()->where(['token'=>$dataSend['token'], 'deadline >='=>time()])->first();

            if(!empty($checkToken)){
                $conditions = array('status'=>1);
                if(empty($dataSend['page'])) $dataSend['page'] = 1;
                if(empty($dataSend['limit'])) $dataSend['limit'] = 25;
                $order = ['created'=>'desc'];

                if(!empty($dataSend['name'])){
                    $conditions['name LIKE'] = '%'.$dataSend['name'].'%';
                }

                $totalData= $modelHistoricalsite->find()->where($conditions)->limit($dataSend['limit'])->page($dataSend['page'])->order($order)->all()->toList();

                $return= array('code'=>0,'listData'=>$totalData, 'mess'=>'Lấy dữ liệu thành công');
            }else{
                $return= array('code'=>2,'listData'=>[], 'mess'=>'Sai mã token hoặc mã token hết hạn');
            }
        }else{
            $return= array('code'=>3,'listData'=>[], 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
        $return= array('code'=>4,'listData'=>[], 'mess'=>'Gửi sai kiểu POST');
    }

    return $return;
}