<?php 
function listPostAPI($input){
    
    global $controller;
    global $isRequestPost;
    $modelPost = $controller->loadModel('tablepost');
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        $totalData = $modelPost->find()->all()->toList();
        $formattedData = [];
        foreach ($totalData as $item) {
            $formattedData[] = [
                'vi' => [
                    'id' => $item->id,
                    'image' => $item->image,
                    'title' => $item->title,
                    'description' => $item->description,
                    'author' => $item->author,
					'time' => $item->time,
					'content' => $item->content,

                ],

                'en' => [
                    'id' => $item->id,
                    'image' => $item->image,
                    'titleen' => $item->titleen,
                    'descriptionen' => $item->descriptionen,
                    'authoren' => $item->authoren,
					'time' => $item->time,
					'contentenen' => $item->contentenen,

                ]
            ];
        }
        $return = array('code'=>1,'listData'=>$formattedData);
    }else{
        return array('code'=>0,'mess'=>'gửi sai kiểu post');
    }
   
       return $return;
}

function detailPostAPI($input){
   
   $return= array('code'=>0);
   global $controller;
   global $isRequestPost;
   $metaTitleMantan = 'chi tiết tin tức';
   $modelPost = $controller->loadModel('tablepost');
   
   if($isRequestPost){
        $dataSend =$input['request']->getData(); 
        if(!empty($dataSend['id'])){
            $data = $modelPost->get($dataSend['id']);
            $formattedData = [];
            if (!empty($data)) {
                $formattedData[] = [
                    'vi' => [
                        'id' => $data->id,
                        'image' => $data->image,
                        'title' => $data->title,
                        'description' => $data->description,
                        'author' => $data->author,
                        'time' => $data->time,
                        'content' => $data->content,
    
                    ],
                    'en' => [
                        'id' => $data->id,
                        'image' => $data->image,
                        'titleen' => $data->titleen,
                        'descriptionen' => $data->descriptionen,
                        'authoren' => $data->authoren,
                        'time' => $data->time,
                        'contentenen' => $data->contentenen,
    
                    ]
                ];
            }else{
                $return = array('code'=>0,'mess'=>'Không có dữ liệu');
            }
            $return = array('code'=>1,'data'=>$formattedData,);
        }else{
            $return = array('code'=>0,'mess'=>'gửi thiếu dữ liệu');
        }

   }else{
        $return = array('code'=>0,'mess'=>'gửi sai kiểu post');
   }

   return $return;
}

function listPostLegalPrivacyghimAPI($input){
    
    global $controller;
    global $isRequestPost;
    $modelPost = $controller->loadModel('Posts');
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        $conditions = array('type'=>'page','pin'=>1);
        if(!empty($dataSend['name'])){
            $key = createSlugMantan($dataSend['name']);
            $conditions['slug LIKE'] = '%'.$key.'%';
        }
        $order = array('created'=>'desc');
        $totalData = $modelPost->find()->where($conditions)->all()->toList();
        $return = array('code'=>1,'listData'=>$totalData);
    }else{
        return array('code'=>0,'mess'=>'gửi sai kiểu post');
    }
   
       return $return;
}

function listPostLegalPrivacyAPI($input){
    
    global $controller;
    global $isRequestPost;
    $modelPost = $controller->loadModel('Posts');
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        $conditions = array('type'=>'page');
        if(!empty($dataSend['name'])){
            $key = createSlugMantan($dataSend['name']);
            $conditions['slug LIKE'] = '%'.$key.'%';
        }
        $order = array('created'=>'desc');
        $totalData = $modelPost->find()->where($conditions)->all()->toList();
        $return = array('code'=>1,'listData'=>$totalData);
    }else{
        return array('code'=>0,'mess'=>'gửi sai kiểu post');
    }
   
       return $return;
}

function detailPostLegalPrivacyAPI($input){
   
   $return= array('code'=>0);
   global $controller;
   global $isRequestPost;
   $metaTitleMantan = 'chi tiết tin tức';
   $modelPost = $controller->loadModel('Posts');
   
   if($isRequestPost){
        $dataSend =$input['request']->getData(); 
        if(!empty($dataSend['id'])){
            $data = $modelPost->find()->where(array('type'=>'page','id'=>(int)$dataSend['id']))->first();
            $month = array('type'=>'page');
            $order = array('time'=>'desc');
            $otherData = $modelPost->find()->limit(10)->page(1)->where($month)->order($order)->all()->toList();
            $return = array('code'=>1,'data'=>$data,'otherData'=>$otherData);
        }else{
             $return = array('code'=>0,'mess'=>'Gửi thiếu dữ liệu');
        }
   }else{
        $return = array('code'=>0,'mess'=>'gửi sai kiểu post');
   }

   return $return;
}

?>