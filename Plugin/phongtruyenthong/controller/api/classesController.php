<?php
function getClassInYearAPI($input)
{
	global $controller;
	global $isRequestPost;
	global $modelCategories;
    global $metaTitleMantan;

	$dataSend = $_REQUEST;

	$modelClasses = $controller->loadModel('Classes');

	if(!empty($dataSend['id_year'])){
		$conditions = ['id_year'=>(int) $dataSend['id_year'], 'status'=>'active'];

		$listData = $modelClasses->find()->where($conditions)->all()->toList();

		if(!empty($listData)){
			foreach ($listData as $key => $value) {
				$listData[$key]->info = nl2br($listData[$key]->info);

				$codeYoutube = '';

				if(!empty($value->video)){
					$codeYoutube = explode('v=', $value->video);

					if(!empty($codeYoutube[1])){
						$codeYoutube = explode('&', $codeYoutube[1]);

						$codeYoutube = $codeYoutube[0];
					}else{
						$codeYoutube = '';
					}
				}

				$listData[$key]->video = 'https://www.youtube.com/embed/'.$codeYoutube;
			}
		}

		return ['code'=>0, 'listData'=>$listData];
	}else{
    	return ['code'=>1, 'mess'=>'Chưa gửi dữ liệu'];
    }
}