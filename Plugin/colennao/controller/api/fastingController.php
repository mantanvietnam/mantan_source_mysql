<?php 
function listfastingAPI($input)
{

    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách tin tức giảm cân';
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
                    'imageauthor' => $item->imageauthor,
                    'title' => $item->title,
                    'description' => $item->description,
                    'author' => $item->author,
                    'textsource1' => $item->textsource1,
                    'textsource2' => $item->textsource2,
                    'linksource1' => $item->linksource1,
                    'linksource2' => $item->linksource2,
                  
					
                    'slug' => $item->slug,
                ],

                'en' => [
                    'titleen' => $item->titleen,
                    'image' => $item->image,
                    'imageauthor' => $item->imageauthor,
                    'nameen' => $item->nameen,
                    'descriptionen' => $item->descriptionen,
                    'authoren' => $item->authoren,
                    'textsource1' => $item->textsource1,
                    'textsource2' => $item->textsource2,
                    'linksource1' => $item->linksource1,
                    'linksource2' => $item->linksource2,
					
					
					
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
                        'imageauthor' => $data->imageauthor,
                        'title' => $data->title,
                        'description' => $data->description,
                        'author' => $data->author,
                        'textsource1' => $data->textsource1,
                        'textsource2' => $data->textsource2,
                        'linksource1' => $data->linksource1,
                        'linksource2' => $data->linksource2,
                        'slug' => $data->slug,
					],
	
					'en' => [
                        'id' => $data->id,
                        'titleen' => $data->titleen,
                        'image' => $data->image,
                        'imageauthor' => $data->imageauthor,
                        'nameen' => $data->nameen,
                        'descriptionen' => $data->descriptionen,
                        'authoren' => $data->authoren,
                        'textsource1' => $data->textsource1,
                        'textsource2' => $data->textsource2,
                        'linksource1' => $data->linksource1,
                        'linksource2' => $data->linksource2,
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