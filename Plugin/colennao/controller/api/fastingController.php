<?php 
function listfastingAPI($input)
{

    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách các kiểu giảm cân';
    $modelfasting = $controller->loadModel('fasting');
    if($isRequestPost){
		$dataSend = $input['request']->getData();

	    $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
	    $limit = (!empty($dataSend['limit']))?(int)$dataSend['limit']:20;
	    if($page<1) $page = 1;
	    $order = array('id'=>'desc');
	    $listData = $modelfasting->find()->limit($limit)->page($page)->where()->order($order)->all()->toList();
	    // phân trang

	    $totalData = $modelfasting->find()->where()->all()->toList();
	    $totalData = count($totalData);
		$formattedData = [];
        foreach ($listData as $item) {
            $formattedData[] = [
                'vi' => [
                    'id' => $item->id,
                    'image' => $item->image,
                    'name' => $item->name,
                    'description' => $item->description,
                    'time_start' => $item->time_start,
					'time_end' => $item->time_end,
					'complete' => $item->complete,
					'method' => $item->method,
                    'slug' => $item->slug,
                ],

                'en' => [
                    'id' => $item->id,
                    'image' => $item->image,
                    'nameen' => $item->nameen,
                    'descriptionen' => $item->descriptionen,
                    'time_start' => $item->time_start,
					'time_end' => $item->time_end,
					'complete' => $item->complete,
					'method' => $item->method,
                    'slug' => $item->slug,

                ]
            ];
        }


		$return = array('code'=>1, 'mess'=>'Lấy dữ liệu thành công ', 'listData'=>$formattedData, 'totalData'=>$totalData);
	        
	}else{
	    $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
	}
    return $return;

	
}
function getfastingAPI($input)
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
        if (!empty($dataSend['id'])) {
			$modelfasting = $controller->loadModel('fasting');
            $conditions = array('id' => (int)$dataSend['id']);	
            $data = $modelfasting->find()->where($conditions)->first();
            if (!empty($data)) { 
                $formattedData[] = [
					'vi' => [
						'id' => $data->id,
						'image' => $data->image,
						'name' => $data->name,
						'description' => $data->description,
						'time_start' => $data->time_start,
						'time_end' => $data->time_end,
						'complete' => $data->complete,
						'method' => $data->method,
						'slug' => $data->slug,
					],
	
					'en' => [
						'id' => $data->id,
						'image' => $data->image,
						'nameen' => $data->nameen,
						'descriptionen' => $data->descriptionen,
						'time_start' => $data->time_start,
						'time_end' => $data->time_end,
						'complete' => $data->complete,
						'method' => $data->method,
						'slug' => $data->slug,
	
					]
			
                ];
                $return = array('code' => 1, 'mess' => 'Lấy dữ liệu thành công', 'data' => $formattedData,);
            } else {
                $return = array('code' => 3, 'mess' => 'Id không tồn tại');
            }
        } else {
            $return = array('code' => 2, 'mess' => 'Gửi thiếu dữ liệu');
        }
        
    }else{
        $return = array('code'=>0, 'mess'=>' gửi sai kiểu POST ');
    }

    return $return;
}
?>