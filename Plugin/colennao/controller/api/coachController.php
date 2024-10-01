<?php 
function listcoachAPI($input)
{

    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách huấn luyện viên';

    $modelcoach = $controller->loadModel('coach');
    if($isRequestPost){
		$dataSend = $input['request']->getData();
	    $page = (!empty($dataSend['page']))?(int)$dataSend['page']:1;
	    $limit = (!empty($dataSend['limit']))?(int)$dataSend['limit']:20;
	    if($page<1) $page = 1;
	    $order = array('id'=>'desc');

	    $listData = $modelcoach->find()->limit($limit)->page($page)->where()->order($order)->all()->toList();
	    // phân trang
	    $totalData = $modelcoach->find()->where()->all()->toList();
	    $totalData = count($totalData);
		$formattedData = [];
        foreach ($listData as $item) {
            $formattedData[] = [
                'vi' => [
                    'id' => $item->id,
                    'avatar' => $item->avatar,
                    'name' => $item->name,
                    'description' => $item->description,
                    'ifcontact' => $item->ifcontact,
                    'slug' => $item->slug,
                ],

                'en' => [
                    'id' => $item->id,
                    'avatar' => $item->avatar,
                    'nameen' => $item->nameen,
                    'descriptionen' => $item->descriptionen,
                    'ifcontact' => $item->ifcontact,
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
function getCouchAPI($input)
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
			$modelcoach = $controller->loadModel('coach');
            $conditions = array('id' => (int)$dataSend['id']);	
            $data = $modelcoach->find()->where($conditions)->first();
            if (!empty($data)) { 
                $formattedData[] = [
					'vi' => [
						'id' => $data->id,
						'avatar' => $data->avatar,
						'name' => $data->name,
						'description' => $data->description,
						'ifcontact' => $data->ifcontact,
						'slug' => $data->slug,
					],
					'en' => [
						'id' => $data->id,
						'avatar' => $data->avatar,
						'nameen' => $data->nameen,
						'descriptionen' => $data->descriptionen,
						'ifcontact' => $data->ifcontact,
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