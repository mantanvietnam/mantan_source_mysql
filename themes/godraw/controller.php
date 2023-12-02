<?php 
function settingHomeThemeGodraw($input)
{
	global $modelOptions;
	global $metaTitleMantan;
	global $isRequestPost;

    $metaTitleMantan = 'Cài đặt giao diện trang chủ';
    $mess= '';

    $conditions = array('key_word' => 'settingHomeThemeGodraw');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
    	$dataSend = $input['request']->getData();

    	$value = array( 

    					'facebook' => $dataSend['facebook'],
    					'youtube' => $dataSend['youtube'],
    					'tiktok' => $dataSend['tiktok'],
    					'instagram' => $dataSend['instagram'],
    					'linkedIn' => $dataSend['linkedIn'],
    					'twitter' => $dataSend['twitter'],
                        'telegram' => $dataSend['telegram'],
                        
                        'video_background_1' => $dataSend['video_background_1'],
                        'video_trailer' => $dataSend['video_trailer'],
                        'company_name' => $dataSend['company_name'],

                        'id_category_product' => $dataSend['id_category_product'],
                        'id_category_service' => $dataSend['id_category_service'],
                        'id_category_procedure' => $dataSend['id_category_procedure'],

                        'id_menu_news' => $dataSend['id_menu_news'],
                        'id_slide_news' => $dataSend['id_slide_news'],

    					
                    );

        $data->key_word = 'settingHomeThemeGodraw';
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

function home($input)
{   
    global $controller;
    global $modelPosts;
    global $settingThemes;
    
    $modelUserPictures = $controller->loadModel('UserPictures');
    $modelAgencies = $controller->loadModel('Agencies');

    $listAgency = $modelAgencies->find()->where(['status'=>1, 'deleted_at IS'=>null])->all()->toList();

    $topImages = $modelUserPictures->find()->page(1)->limit(20)->order(['vote'=>'desc'])->all()->toList();

    $listPost1 = [];
    if(!empty($settingThemes['id_category_product'])){
        $listPost1 = $modelPosts->find()->where(['type'=>'post', 'idCategory'=>(int) $settingThemes['id_category_product']])->all()->toList();
    }

    $listPost2 = [];
    if(!empty($settingThemes['id_category_service'])){
        $listPost2 = $modelPosts->find()->where(['type'=>'post', 'idCategory'=>(int) $settingThemes['id_category_service']])->all()->toList();
    }

    $listPost3 = [];
    if(!empty($settingThemes['id_category_procedure'])){
        $listPost3 = $modelPosts->find()->where(['type'=>'post', 'idCategory'=>(int) $settingThemes['id_category_procedure']])->all()->toList();
    }
    
    $listCity = [];
    if(function_exists('getProvince')){
        $listCity = getProvince();
    }

    setVariable('isCssHome', true);
    setVariable('topImages', $topImages);
    setVariable('listAgency', $listAgency);
    setVariable('listPost1', $listPost1);
    setVariable('listPost2', $listPost2);
    setVariable('listPost3', $listPost3);
    setVariable('listCity', $listCity);
}

function indexTheme($input)
{
    
}

function postTheme($input)
{
    
}

function searchTheme($input)
{

}

function categoryPostTheme($input)
{
    global $modelAlbums;
    global $modelAlbuminfos;
    global $settingThemes;

    $slide_news = [];
    if(!empty($settingThemes['id_slide_news'])){
        $slide_news = $modelAlbuminfos->find()->where(['id_album'=>(int) $settingThemes['id_slide_news']])->all()->toList();
    }
    
    setVariable('slide_news', $slide_news);
}

function categoryAlbumTheme($input)
{

}

function categoryVideoTheme($input)
{

}

function albumTheme($input)
{
    
}

function videoTheme($input)
{
    
}

?>