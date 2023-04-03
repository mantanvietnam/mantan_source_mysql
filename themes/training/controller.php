<?php 
function settingHomeThemeTraining($input)
{
	global $modelOptions;
	global $metaTitleMantan;
	global $isRequestPost;

    $metaTitleMantan = 'Cài đặt giao diện trang chủ - Training Theme';
    $mess= '';

    $conditions = array('key_word' => 'settingHomeThemeTraining');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
    	$dataSend = $input['request']->getData();

    	$value = array( 'slogan' => $dataSend['slogan'],
                        'text_banner' => $dataSend['text_banner'],
                        'link_button' => $dataSend['link_button'],
                        'title_training' => $dataSend['title_training'],
                        'description_training' => $dataSend['description_training'],
                        'number_post_training' => (!empty($dataSend['number_post_training']))?(int) $dataSend['number_post_training']:12,
                        'title_news' => $dataSend['title_news'],
                        'number_post_news' => (!empty($dataSend['number_post_news']))?(int) $dataSend['number_post_news']:12,
                        'brand_name' => $dataSend['brand_name'],
                        'title_subscribe' => $dataSend['title_subscribe'],
                        'description_subscribe' => $dataSend['description_subscribe'],
                        'id_menu_footer' => $dataSend['id_menu_footer'],
                        'facebook' => $dataSend['facebook'],
                        'youtube' => $dataSend['youtube'],
                        'tiktok' => $dataSend['tiktok'],
                        'instagram' => $dataSend['instagram'],
                        'linkedIn' => $dataSend['linkedIn'],
                        'logo' => $dataSend['logo'],
                        'background_banner' => $dataSend['background_banner'],
                    );

        $data->key_word = 'settingHomeThemeTraining';
        $data->value = json_encode($value);

        $modelOptions->save($data);

        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
    }

    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }

    setVariable('setting', $data_value);
    setVariable('mess', $mess);
}

function indexTheme($input)
{
	global $controller;
	global $modelCategories;
	
	$modelLesson = $controller->loadModel('Lessons');
	$modelPost = $controller->loadModel('Posts');

	// lấy danh sách bài học mới nhất
	$conditions = array();
	$limit = 3;
	$page = 1;
    $order = array('id'=>'desc');
    
    $listLessons = $modelLesson->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    $category = array();
    if(!empty($listLessons)){
    	foreach ($listLessons as $key => $value) {
    		if(empty($category[$value->id_category])){
    			$category[$value->id_category] = $modelCategories->get( (int) $value->id_category);
    		}
    		
    		$listLessons[$key]->name_category = (!empty($category[$value->id_category]->name))?$category[$value->id_category]->name:'';
    	}
    }

    // lấy danh sách tin tức mới nhất
    $conditions = array('type'=>'post');
	$limit = 3;
	$page = 1;
    $order = array('id'=>'desc');
    
    $listPosts = $modelPost->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    setVariable('listLessons', $listLessons);
    setVariable('listPosts', $listPosts);
}

function postTheme($input)
{
	global $controller;
	global $modelCategories;

	$modelLesson = $controller->loadModel('Lessons');

	// lấy danh mục đào tạo
	$conditions = array('type' => '2top_crm_training');
    $listCategoryLessons = $modelCategories->find()->where($conditions)->all()->toList();

    // lấy danh sách bài học mới nhất
	$conditions = array();
	$limit = 5;
	$page = 1;
    $order = array('id'=>'desc');
    
    $listLessons = $modelLesson->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    setVariable('listCategoryLessons', $listCategoryLessons);
    setVariable('listLessons', $listLessons);
}

function searchTheme($input)
{

}

function categoryPostTheme($input)
{

}

function categoryAlbumTheme($input)
{

}

function categoryVideoTheme($input)
{

}

function albumTheme($input)
{
    global $controller;
    global $modelCategories;

    $modelLesson = $controller->loadModel('Lessons');

    // lấy danh mục đào tạo
    $conditions = array('type' => '2top_crm_training');
    $listCategoryLessons = $modelCategories->find()->where($conditions)->all()->toList();

    // lấy danh sách bài học mới nhất
    $conditions = array();
    $limit = 5;
    $page = 1;
    $order = array('id'=>'desc');
    
    $listLessons = $modelLesson->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    setVariable('listCategoryLessons', $listCategoryLessons);
    setVariable('listLessons', $listLessons);
}

function videoTheme($input)
{
    global $controller;
    global $modelCategories;

    $modelLesson = $controller->loadModel('Lessons');

    // lấy danh mục đào tạo
    $conditions = array('type' => '2top_crm_training');
    $listCategoryLessons = $modelCategories->find()->where($conditions)->all()->toList();

    // lấy danh sách bài học mới nhất
    $conditions = array();
    $limit = 5;
    $page = 1;
    $order = array('id'=>'desc');
    
    $listLessons = $modelLesson->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    setVariable('listCategoryLessons', $listCategoryLessons);
    setVariable('listLessons', $listLessons);
}

?>