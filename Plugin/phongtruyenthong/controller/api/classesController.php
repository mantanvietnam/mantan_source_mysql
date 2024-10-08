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
				$listData[$key]->images = json_decode($listData[$key]->images, true);
				$listData[$key]->des_image = json_decode($listData[$key]->des_image, true);
				$listData[$key]->audio_image = json_decode($listData[$key]->audio_image, true);

				if(!empty($value->video)){
					$codeYoutube = '';

					$codeYoutube = explode('v=', $value->video);

					if(!empty($codeYoutube[1])){
						$codeYoutube = explode('&', $codeYoutube[1]);

						$codeYoutube = $codeYoutube[0];
					}else{
						$codeYoutube = '';
					}

					$listData[$key]->video = 'https://www.youtube.com/embed/'.$codeYoutube;
				}
			}
		}
		
		return ['code'=>0, 'listData'=>$listData];
	}else{
    	return ['code'=>1, 'mess'=>'Chưa gửi dữ liệu'];
    }
}