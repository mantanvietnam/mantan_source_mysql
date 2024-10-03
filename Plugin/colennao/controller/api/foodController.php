<?php 
function listfoodAPI($input)
{

    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách food';

    $modelfood = $controller->loadModel('food');
    if($isRequestPost){
		    $dataSend = $input['request']->getData();
            $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
            $limit = (!empty($dataSend['limit']))?(int)$dataSend['limit']:20;
            $conditions = array();
            if($page<1) $page = 1;
            $order = array('id'=>'desc');
            if (!empty($dataSend['name'])) {
                $conditions['name LIKE'] = '%' . $dataSend['name'] . '%';
            }
            $listData = $modelfood->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
            $totalData = $modelfood->find()->where($conditions)->all()->toList();
            $totalData = count($totalData);
            $formattedData = [];
            foreach ($listData as $item) {
                $formattedData[] = [
                    'vi' => [
                        'id' => $item->id,
                        'image' => $item->image,
                        'name' => $item->name,

                        'description' => $item->description,
                        'numberday' => $item->month,
                        'icon' => $item->icon,
                        'timestart' => $item->timestart,
                        'timenow' => $item->timenow,
                        
                    ],
    
                    'en' => [
                        'id' => $item->id,
                        'image' => $item->image,
                        'nameen' => $item->nameen,

                        'description' => $item->contenten,
                        'numberday' => $item->month,
                        'icon' => $item->icon,
                        'timestart' => $item->timestart,
                        'timenow' => $item->timenow,
                        
                    ],
                ];
            }



            $return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'listData'=>$formattedData, 'totalData'=>$totalData);
    }else{
        $return = array('code'=>0, 'mess'=>'gửi sai kiểu dữ liệu');
    }

    return $return;
}
function updatefoodApi($input): array
{
    global $controller;
    global $isRequestPost;
    global $imageType;
    global $ownerType;

    $modelfood = $controller->loadModel('food');
    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        $currentUser = getUserByToken($dataSend['token']);
        if (empty($currentUser)) {
            return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
        }
        if (isset($dataSend['timestart'])) {
            $currentUser->timestart = (int) $dataSend['timestart'];
        }
        if (isset($dataSend['timenow'])) {
            $currentUser->timenow = (int) $dataSend['timenow'];
        }
        $modelfood->save($currentUser);

        return apiResponse(0, 'Cập nhật thông tin thành công',$currentUser);
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}
function getfoodAPI($input) {
    global $controller;
    global $isRequestPost;

    $modelfood = $controller->loadModel('food');
    $modelbreakfast = $controller->loadModel('breakfast');
    $modellunch = $controller->loadModel('lunch');
    $modeldinner = $controller->loadModel('dinner');
    $modelsnacks = $controller->loadModel('snacks');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['id']) ) {
            $conditions = array('id' => (int)$dataSend['id']);
            $data = $modelfood->find()->where($conditions)->first();

            if (!empty($data)) {
                $idFood = $data->id_food;
                $breakfastData = $modelbreakfast->find()->where(['id_food' => $dataSend['id']])->all();
                $lunchData = $modellunch->find()->where(['id_food' => $dataSend['id']])->all();
                $dinnerData = $modeldinner->find()->where(['id_food' => $dataSend['id']])->all();
                $snacksData = $modelsnacks->find()->where(['id_food' => $dataSend['id']])->all();
                $datafood = []; 
                if (!empty($data)) {
                    $datafood[] = [
                        'vi' => [
                            'id' => $data->id,
                            'image' => $data->image,
                            'name' => $data->name,
                            'description' => $data->description,
                            'numberday' => $data->month,
                            'icon' => $data->icon,
                            'timestart' => $data->timestart,
                            'timenow' => $data->timenow,
                        ],
                        'en' => [
                            'id' => $data->id,
                            'image' => $data->image,
                            'nameen' => $data->nameen,
                            'description' => $data->contenten,
                            'numberday' => $data->month,
                            'icon' => $data->icon,
                            'timestart' => $data->timestart,
                            'timenow' => $data->timenow,
                        ],
                    ];
                }
                $databreakfast = []; 
                if (!empty($breakfastData)) {
                    foreach ($breakfastData as $data) {
                        $databreakfast[] = [
                            'vi' => [
                                'id' => $data->id,
                                'image' => $data->image,
                                'name' => $data->name,
                                'content' => $data->content,
                                'ingredients' => $data->ingredients,
                                'eatformat' => $data->eatformat,
                                'id_food' => $data->id_food,
                                'time' => $data->time,
                                'timeeat' => $data->timeeat,
                            ],
                            'en' => [
                                'id' => $data->id,
                                'image' => $data->image,
                                'nameen' => $data->nameen,
                                'contenten' => $data->contenten,
                                'ingredientsen' => $data->ingredientsen,
                                'eatformaten' => $data->eatformaten,
                                'id_food' => $data->id_food,
                                'time' => $data->time,
                                'timeeat' => $data->timeeat,
                            ],
                        ];
                    }
                }
                $datalunch = []; 
                if (!empty($lunchData)) {
                    foreach ($lunchData as $data) {
                        $datalunch[] = [
                            'vi' => [
                                'id' => $data->id,
                                'image' => $data->image,
                                'name' => $data->name,
                                'content' => $data->content,
                                'ingredients' => $data->ingredients,
                                'eatformat' => $data->eatformat,
                                'id_food' => $data->id_food,
                                'time' => $data->time,
                                'timeeat' => $data->timeeat,
                            ],
                            'en' => [
                                'id' => $data->id,
                                'image' => $data->image,
                                'nameen' => $data->nameen,
                                'contenten' => $data->contenten,
                                'ingredientsen' => $data->ingredientsen,
                                'eatformaten' => $data->eatformaten,
                                'id_food' => $data->id_food,
                                'time' => $data->time,
                                'timeeat' => $data->timeeat,
                            ],
                        ];
                    }
                }
                $datadinner = []; 
                if (!empty($dinnerData)) {
                    foreach ($dinnerData as $data) {
                        $datadinner[] = [
                            'vi' => [
                                'id' => $data->id,
                                'image' => $data->image,
                                'name' => $data->name,
                                'content' => $data->content,
                                'ingredients' => $data->ingredients,
                                'eatformat' => $data->eatformat,
                                'id_food' => $data->id_food,
                                'time' => $data->time,
                                'timeeat' => $data->timeeat,
                            ],
                            'en' => [
                                'id' => $data->id,
                                'image' => $data->image,
                                'nameen' => $data->nameen,
                                'contenten' => $data->contenten,
                                'ingredientsen' => $data->ingredientsen,
                                'eatformaten' => $data->eatformaten,
                                'id_food' => $data->id_food,
                                'time' => $data->time,
                                'timeeat' => $data->timeeat,
                            ],
                        ];
                    }
                }
                $datasnacks = []; 
                if (!empty($snacksData)) {
                    foreach ($snacksData as $data) {
                        $datasnacks[] = [
                            'vi' => [
                                'id' => $data->id,
                                'image' => $data->image,
                                'name' => $data->name,
                                'content' => $data->content,
                                'ingredients' => $data->ingredients,
                                'eatformat' => $data->eatformat,
                                'id_food' => $data->id_food,
                                'time' => $data->time,
                                'timeeat' => $data->timeeat,
                            ],
                            'en' => [
                                'id' => $data->id,
                                'image' => $data->image,
                                'nameen' => $data->nameen,
                                'contenten' => $data->contenten,
                                'ingredientsen' => $data->ingredientsen,
                                'eatformaten' => $data->eatformaten,
                                'id_food' => $data->id_food,
                                'time' => $data->time,
                                'timeeat' => $data->timeeat,
                            ],
                        ];
                    }
                }
                $return = array(
                    'code' => 1,
                    'mess' => 'Lấy dữ liệu thành công',
                    'data' => $datafood,
                    'breakfast' => $databreakfast,
                    'lunch' => $datalunch,
                    'dinner' => $datadinner,
                    'snacks' => $datasnacks
                );
            } else {
                $return = array('code' => 3, 'mess' => 'Id không tồn tại');
            }
        } else {
            $return = array('code' => 2, 'mess' => 'Gửi thiếu dữ liệu hoặc ID không hợp lệ');
        }
    } else {
        $return = array('code' => 0, 'mess' => 'Gửi sai kiểu POST');
    }

    return $return;
}
function getdayfoodAPI($input) {
    global $controller;
    global $isRequestPost;

    $modelfood = $controller->loadModel('food');
    $modelbreakfast = $controller->loadModel('breakfast');
    $modellunch = $controller->loadModel('lunch');
    $modeldinner = $controller->loadModel('dinner');
    $modelsnacks = $controller->loadModel('snacks');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['id']) && !empty($dataSend['time'])) {
            $conditions = array('id' => (int)$dataSend['id']);
            $data = $modelfood->find()->where($conditions)->first();

            if (!empty($data)) {
                $idFood = $data->id_food;
                $breakfastData = $modelbreakfast->find()->where(['id_food' => $dataSend['id'],'time'=>$dataSend['time']])->all();
                $lunchData = $modellunch->find()->where(['id_food' => $dataSend['id'],'time'=>$dataSend['time']])->all();
                $dinnerData = $modeldinner->find()->where(['id_food' => $dataSend['id'],'time'=>$dataSend['time']])->all();
                $snacksData = $modelsnacks->find()->where(['id_food' => $dataSend['id'],'time'=>$dataSend['time']])->all();
                $datafood = []; 
                if (!empty($data)) {
                    $datafood[] = [
                        'vi' => [
                            'id' => $data->id,
                            'image' => $data->image,
                            'name' => $data->name,
                            'description' => $data->description,
                            'numberday' => $data->month,
                            'icon' => $data->icon,
                            'timestart' => $data->timestart,
                            'timenow' => $data->timenow,
                        ],
                        'en' => [
                            'id' => $data->id,
                            'image' => $data->image,
                            'nameen' => $data->nameen,
                            'description' => $data->contenten,
                            'numberday' => $data->month,
                            'icon' => $data->icon,
                            'timestart' => $data->timestart,
                            'timenow' => $data->timenow,
                        ],
                    ];
                }
                $databreakfast = []; 
                if (!empty($breakfastData)) {
                    foreach ($breakfastData as $data) {
                        $databreakfast[] = [
                            'vi' => [
                                'id' => $data->id,
                                'image' => $data->image,
                                'name' => $data->name,
                                'content' => $data->content,
                                'ingredients' => $data->ingredients,
                                'eatformat' => $data->eatformat,
                                'id_food' => $data->id_food,
                                'time' => $data->time,
                                'timeeat' => $data->timeeat,
                            ],
                            'en' => [
                                'id' => $data->id,
                                'image' => $data->image,
                                'nameen' => $data->nameen,
                                'contenten' => $data->contenten,
                                'ingredientsen' => $data->ingredientsen,
                                'eatformaten' => $data->eatformaten,
                                'id_food' => $data->id_food,
                                'time' => $data->time,
                                'timeeat' => $data->timeeat,
                            ],
                        ];
                    }
                }
                $datalunch = []; 
                if (!empty($lunchData)) {
                    foreach ($lunchData as $data) {
                        $datalunch[] = [
                            'vi' => [
                                'id' => $data->id,
                                'image' => $data->image,
                                'name' => $data->name,
                                'content' => $data->content,
                                'ingredients' => $data->ingredients,
                                'eatformat' => $data->eatformat,
                                'id_food' => $data->id_food,
                                'time' => $data->time,
                                'timeeat' => $data->timeeat,
                            ],
                            'en' => [
                                'id' => $data->id,
                                'image' => $data->image,
                                'nameen' => $data->nameen,
                                'contenten' => $data->contenten,
                                'ingredientsen' => $data->ingredientsen,
                                'eatformaten' => $data->eatformaten,
                                'id_food' => $data->id_food,
                                'time' => $data->time,
                                'timeeat' => $data->timeeat,
                            ],
                        ];
                    }
                }
                $datadinner = []; 
                if (!empty($dinnerData)) {
                    foreach ($dinnerData as $data) {
                        $datadinner[] = [
                            'vi' => [
                                'id' => $data->id,
                                'image' => $data->image,
                                'name' => $data->name,
                                'content' => $data->content,
                                'ingredients' => $data->ingredients,
                                'eatformat' => $data->eatformat,
                                'id_food' => $data->id_food,
                                'time' => $data->time,
                                'timeeat' => $data->timeeat,
                            ],
                            'en' => [
                                'id' => $data->id,
                                'image' => $data->image,
                                'nameen' => $data->nameen,
                                'contenten' => $data->contenten,
                                'ingredientsen' => $data->ingredientsen,
                                'eatformaten' => $data->eatformaten,
                                'id_food' => $data->id_food,
                                'time' => $data->time,
                                'timeeat' => $data->timeeat,
                            ],
                        ];
                    }
                }
                $datasnacks = []; 
                if (!empty($snacksData)) {
                    foreach ($snacksData as $data) {
                        $datasnacks[] = [
                            'vi' => [
                                'id' => $data->id,
                                'image' => $data->image,
                                'name' => $data->name,
                                'content' => $data->content,
                                'ingredients' => $data->ingredients,
                                'eatformat' => $data->eatformat,
                                'id_food' => $data->id_food,
                                'time' => $data->time,
                                'timeeat' => $data->timeeat,
                            ],
                            'en' => [
                                'id' => $data->id,
                                'image' => $data->image,
                                'nameen' => $data->nameen,
                                'contenten' => $data->contenten,
                                'ingredientsen' => $data->ingredientsen,
                                'eatformaten' => $data->eatformaten,
                                'id_food' => $data->id_food,
                                'time' => $data->time,
                                'timeeat' => $data->timeeat,
                            ],
                        ];
                    }
                }
                $return = array(
                    'code' => 1,
                    'mess' => 'Lấy dữ liệu thành công',
                    'data' => $datafood,
                    'breakfast' => $databreakfast,
                    'lunch' => $datalunch,
                    'dinner' => $datadinner,
                    'snacks' => $datasnacks
                );
            } else {
                $return = array('code' => 3, 'mess' => 'Id không tồn tại');
            }
        } else {
            $return = array('code' => 2, 'mess' => 'Gửi thiếu dữ liệu hoặc ID không hợp lệ');
        }
    } else {
        $return = array('code' => 0, 'mess' => 'Gửi sai kiểu POST');
    }

    return $return;
}
function listbreakfastAPI($input)
{

    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách breakfast';

    $modelbreakfast = $controller->loadModel('breakfast');
    if($isRequestPost){
		$dataSend = $input['request']->getData();
        $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
        $limit = (!empty($dataSend['limit']))?(int)$dataSend['limit']:20;
        $conditions = array();
        if($page<1) $page = 1;
        $order = array('id'=>'desc');
        if (!empty($dataSend['name'])) {
            $conditions['name LIKE'] = '%' . $dataSend['name'] . '%';
        }
        $listData = $modelbreakfast->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        $totalData = $modelbreakfast->find()->where($conditions)->all()->toList();
        $totalData = count($totalData);
        $databreakfast = []; 
        if (!empty($listData)) {
            foreach ($listData as $data) {
                $databreakfast[] = [
                    'vi' => [
                        'id' => $data->id,
                        'image' => $data->image,
                        'name' => $data->name,
                        'content' => $data->content,
                        'ingredients' => $data->Ingredients,
                        'eatformat' => $data->eatformat,
                        'id_food' => $data->id_food,
                        'time' => $data->time,
                        'timeeat' => $data->timeeat,
                    ],
                    'en' => [
                        'id' => $data->id,
                        'image' => $data->image,
                        'nameen' => $data->nameen,
                        'contenten' => $data->contenten,
                        'ingredientsen' => $data->ingredientsen,
                        'eatformaten' => $data->eatformaten,
                        'id_food' => $data->id_food,
                        'time' => $data->time,
                        'timeeat' => $data->timeeat,
                    ],
                ];
            }
        }
        $return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'listData'=>$databreakfast, 'totalData'=>$totalData);
    }else{
        $return = array('code'=>0, 'mess'=>'gửi sai kiêu dữ liệu');
    }
    return $return;
}
function getbreakfastAPI($input)
{

    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $session;
    global $metaTitleMantan;
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['id'])){
            	$modelbreakfast = $controller->loadModel('breakfast');
            	$conditions = array('id'=>(int)$dataSend['id']);	
            	$data = $modelbreakfast->find()->where($conditions)->first();
                $databreakfast = []; 
                if (!empty($data)) {
                        $databreakfast[] = [
                            'vi' => [
                                'id' => $data->id,
                                'image' => $data->image,
                                'name' => $data->name,
                                'content' => $data->content,
                                'ingredients' => $data->Ingredients,
                                'eatformat' => $data->eatformat,
                                'id_food' => $data->id_food,
                                'time' => $data->time,
                                'timeeat' => $data->timeeat,
                            ],
                            'en' => [
                                'id' => $data->id,
                                'image' => $data->image,
                                'nameen' => $data->nameen,
                                'contenten' => $data->contenten,
                                'ingredientsen' => $data->ingredientsen,
                                'eatformaten' => $data->eatformaten,
                                'id_food' => $data->id_food,
                                'time' => $data->time,
                                'timeeat' => $data->timeeat,
                            ],
                        ];
                    
                }
            	if(!empty($data)){
            		$return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'data'=>$databreakfast);
            	}else{
            		$return = array('code'=>3, 'mess'=>'Id không tồn tại');
            	}
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
        $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
    }

    return $return;
}
function listlunchAPI($input)
{

    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách lunch';

    $modellunch = $controller->loadModel('lunch');
    if($isRequestPost){
		    $dataSend = $input['request']->getData();
            $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
            $limit = (!empty($dataSend['limit']))?(int)$dataSend['limit']:20;
            $conditions = array();
            if($page<1) $page = 1;
            $order = array('id'=>'desc');
            if (!empty($dataSend['name'])) {
                $conditions['name LIKE'] = '%' . $dataSend['name'] . '%';
            }
            $listData = $modellunch->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
            $totalData = $modellunch->find()->where($conditions)->all()->toList();
            $totalData = count($totalData);
            $datalunch = []; 
            if (!empty($listData)) {
                foreach ($listData as $data) {
                    $datalunch[] = [
                        'vi' => [
                            'id' => $data->id,
                            'image' => $data->image,
                            'name' => $data->name,
                            'content' => $data->content,
                            'ingredients' => $data->Ingredients,
                            'eatformat' => $data->eatformat,
                            'id_food' => $data->id_food,
                            'time' => $data->time,
                            'timeeat' => $data->timeeat,
                        ],
                        'en' => [
                            'id' => $data->id,
                            'image' => $data->image,
                            'nameen' => $data->nameen,
                            'contenten' => $data->contenten,
                            'ingredientsen' => $data->ingredientsen,
                            'eatformaten' => $data->eatformaten,
                            'id_food' => $data->id_food,
                            'time' => $data->time,
                            'timeeat' => $data->timeeat,
                        ],
                    ];
                }
            }
            $return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'listData'=>$datalunch, 'totalData'=>$totalData);
    }else{
        $return = array('code'=>0, 'mess'=>'gửi sai dữ liệu kiểu');
    }
    return $return;
}
function getlunchAPI($input)
{

    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $session;
    global $metaTitleMantan;
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['id'])){
            	$modellunch = $controller->loadModel('lunch');
            	$conditions = array('id'=>(int)$dataSend['id']);	
            	$data = $modellunch->find()->where($conditions)->first();
                $datalunch = []; 
                if (!empty($data)) {
                        $datalunch[] = [
                            'vi' => [
                                'id' => $data->id,
                                'image' => $data->image,
                                'name' => $data->name,
                                'content' => $data->content,
                                'ingredients' => $data->Ingredients,
                                'eatformat' => $data->eatformat,
                                'id_food' => $data->id_food,
                                'time' => $data->time,
                                'timeeat' => $data->timeeat,
                            ],
                            'en' => [
                                'id' => $data->id,
                                'image' => $data->image,
                                'nameen' => $data->nameen,
                                'contenten' => $data->contenten,
                                'ingredientsen' => $data->ingredientsen,
                                'eatformaten' => $data->eatformaten,
                                'id_food' => $data->id_food,
                                'time' => $data->time,
                                'timeeat' => $data->timeeat,
                            ],
                        ];
                    
                }
            	if(!empty($data)){
            		$return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'data'=>$datalunch);
            	}else{
            		$return = array('code'=>3, 'mess'=>'Id không tồn tại');
            	}
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
        $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
    }

    return $return;
}
function listdinnerAPI($input)
{

    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách dinner';

    $modeldinner = $controller->loadModel('dinner');
    if($isRequestPost){
		$dataSend = $input['request']->getData();
            $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
            $limit = (!empty($dataSend['limit']))?(int)$dataSend['limit']:20;
            $conditions = array();
            if($page<1) $page = 1;
            $order = array('id'=>'desc');
            if (!empty($dataSend['name'])) {
                $conditions['name LIKE'] = '%' . $dataSend['name'] . '%';
            }
            $listData = $modeldinner->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
            $totalData = $modeldinner->find()->where($conditions)->all()->toList();
            $totalData = count($totalData);
            $datadinner = []; 
            if (!empty($listData)) {
                foreach ($listData as $data) {
                    $datadinner[] = [
                        'vi' => [
                            'id' => $data->id,
                            'image' => $data->image,
                            'name' => $data->name,
                            'content' => $data->content,
                            'ingredients' => $data->Ingredients,
                            'eatformat' => $data->eatformat,
                            'id_food' => $data->id_food,
                            'time' => $data->time,
                            'timeeat' => $data->timeeat,
                        ],
                        'en' => [
                            'id' => $data->id,
                            'image' => $data->image,
                            'nameen' => $data->nameen,
                            'contenten' => $data->contenten,
                            'ingredientsen' => $data->ingredientsen,
                            'eatformaten' => $data->eatformaten,
                            'id_food' => $data->id_food,
                            'time' => $data->time,
                            'timeeat' => $data->timeeat,
                        ],
                    ];
                }
            }
            $return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'listData'=>$datadinner, 'totalData'=>$totalData);
    }else{
        $return = array('code'=>0, 'mess'=>'gửi sai dữ liệu kiểu');
    }
    return $return;
}
function getdinnerAPI($input)
{

    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $session;
    global $metaTitleMantan;
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['id'])){
            	$modeldinner = $controller->loadModel('dinner');
            	$conditions = array('id'=>(int)$dataSend['id']);	
            	$data = $modeldinner->find()->where($conditions)->first();
                $datadinner = []; 
                if (!empty($data)) {
                 
                        $datadinner[] = [
                            'vi' => [
                                'id' => $data->id,
                                'image' => $data->image,
                                'name' => $data->name,
                                'content' => $data->content,
                                'ingredients' => $data->Ingredients,
                                'eatformat' => $data->eatformat,
                                'id_food' => $data->id_food,
                                'time' => $data->time,
                                'timeeat' => $data->timeeat,
                            ],
                            'en' => [
                                'id' => $data->id,
                                'image' => $data->image,
                                'nameen' => $data->nameen,
                                'contenten' => $data->contenten,
                                'ingredientsen' => $data->ingredientsen,
                                'eatformaten' => $data->eatformaten,
                                'id_food' => $data->id_food,
                                'time' => $data->time,
                                'timeeat' => $data->timeeat,
                            ],
                        ];
                    
                }
            	if(!empty($data)){
            		$return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'data'=>$datadinner);
            	}else{
            		$return = array('code'=>3, 'mess'=>'Id không tồn tại');
            	}
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
        $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
    }

    return $return;
}
function listsnacksAPI($input)
{

    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách snacks';

    $modelsnacks = $controller->loadModel('snacks');
    if($isRequestPost){
		$dataSend = $input['request']->getData();
        $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
        $limit = (!empty($dataSend['limit']))?(int)$dataSend['limit']:20;
        $conditions = array();
        if($page<1) $page = 1;
        $order = array('id'=>'desc');
        if (!empty($dataSend['name'])) {
            $conditions['name LIKE'] = '%' . $dataSend['name'] . '%';
        }
        $listData = $modelsnacks->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        $totalData = $modelsnacks->find()->where($conditions)->all()->toList();
        $totalData = count($totalData);
        $datasnacks = []; 
        if (!empty($listData)) {
            foreach ($listData as $data) {
                $datasnacks[] = [
                    'vi' => [
                        'id' => $data->id,
                        'image' => $data->image,
                        'name' => $data->name,
                        'content' => $data->content,
                        'ingredients' => $data->Ingredients,
                        'eatformat' => $data->eatformat,
                        'id_food' => $data->id_food,
                        'time' => $data->time,
                        'timeeat' => $data->timeeat,
                    ],
                    'en' => [
                        'id' => $data->id,
                        'image' => $data->image,
                        'nameen' => $data->nameen,
                        'contenten' => $data->contenten,
                        'ingredientsen' => $data->ingredientsen,
                        'eatformaten' => $data->eatformaten,
                        'id_food' => $data->id_food,
                        'time' => $data->time,
                        'timeeat' => $data->timeeat,
                    ],
                ];
            }
        }
        $return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'listData'=>$datasnacks, 'totalData'=>$totalData);
                
    }else{
        $return = array('code'=>0, 'mess'=>'gửi sai dữ liệu kiểu');
    }
    return $return;
}
function getsnacksAPI($input)
{

    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $session;
    global $metaTitleMantan;
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        if(!empty($dataSend['id'])){
            	$modelsnacks = $controller->loadModel('snacks');
            	$conditions = array('id'=>(int)$dataSend['id']);	
            	$data = $modelsnacks->find()->where($conditions)->first();
                $datasnacks = []; 
                if (!empty($data)) {
                        $datasnacks[] = [
                            'vi' => [
                                'id' => $data->id,
                                'image' => $data->image,
                                'name' => $data->name,
                                'content' => $data->content,
                                'ingredients' => $data->Ingredients,
                                'eatformat' => $data->eatformat,
                                'id_food' => $data->id_food,
                                'time' => $data->time,
                                'timeeat' => $data->timeeat,
                            ],
                            'en' => [
                                'id' => $data->id,
                                'image' => $data->image,
                                'nameen' => $data->nameen,
                                'contenten' => $data->contenten,
                                'ingredientsen' => $data->ingredientsen,
                                'eatformaten' => $data->eatformaten,
                                'id_food' => $data->id_food,
                                'time' => $data->time,
                                'timeeat' => $data->timeeat,
                            ],
                        ];
                    
                }
            	if(!empty($data)){
            		$return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'data'=>$datasnacks);
            	}else{
            		$return = array('code'=>3, 'mess'=>'Id không tồn tại');
            	}
        }else{
             $return = array('code'=>2, 'mess'=>'Gửi thiếu dữ liệu');
        }
    }else{
        $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
    }

    return $return;
}
?>