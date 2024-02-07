<?php 
function settingHomeThemeMMTC($input)
{
	global $modelOptions;
	global $metaTitleMantan;
	global $isRequestPost;

    $metaTitleMantan = 'Cài đặt giao diện trang chủ';
    $mess= '';

    $conditions = array('key_word' => 'settingHomeThemeMMTC');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
    	$dataSend = $input['request']->getData();

    	$value = array( 'logo' => $dataSend['logo'],
    					'name_company' => $dataSend['name_company'],
                        'des_company' => $dataSend['des_company'],
    					'titleBanner' => $dataSend['titleBanner'],
                        'descBanner' => $dataSend['descBanner'],
                        'title2' => $dataSend['title2'],
                        'idNews2' => $dataSend['idNews2'],
                        'title3' => $dataSend['title3'],
                        'idNews3' => $dataSend['idNews3'],

                        'number1' => $dataSend['number1'],
                        'number2' => $dataSend['number2'],
                        'number3' => $dataSend['number3'],
                        'number4' => $dataSend['number4'],
                        'number5' => $dataSend['number5'],
                        'number6' => $dataSend['number6'],
                        'number7' => $dataSend['number7'],
                        'number8' => $dataSend['number8'],
                        'number9' => $dataSend['number9'],

                        'ques_title' => $dataSend['ques_title'],

                        'facebook' => $dataSend['facebook'],
                        'youtube' => $dataSend['youtube'],
                        'tiktok' => $dataSend['tiktok'],
                        'instagram' => $dataSend['instagram'],
                        'linkedIn' => $dataSend['linkedIn'],
                        'twitter' => $dataSend['twitter'],
                        
                        'email' => $dataSend['email'],
                        'hotline' => $dataSend['hotline'],

    					
                    );

        $data->key_word = 'settingHomeThemeMMTC';
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
    global $modelPosts;
    global $controller;
    global $settingThemes;

    $conditions = array('type'=>'post', 'idCategory'=>(int) @$settingThemes['idNews2']);
    $limit = 12;
    $page = 1;
    $order = array('id'=>'desc');

    $listNews2 = $modelPosts->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    // lấy phản hồi
    $feedbacks = [];
    if(function_exists('getListFeedback')){
        $feedbacks = getListFeedback();
    }

    // ứng dụng
    $conditions = array('type'=>'post', 'idCategory'=>(int) @$settingThemes['idNews3']);
    $listNews3 = $modelPosts->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
    

    setVariable('listNews2', $listNews2);
    setVariable('listNews3', $listNews3);
    setVariable('feedbacks', $feedbacks);
}

function postTheme($input)
{
    
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
    
}

function videoTheme($input)
{
    
}

?>