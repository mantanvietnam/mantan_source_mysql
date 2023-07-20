<?php
function settingAllSEO($input)
{
	global $modelOptions;
	global $metaTitleMantan;
	global $isRequestPost;

    $metaTitleMantan = 'Cài đặt All SEO';
    $mess= '';

    $conditions = array('key_word' => 'allSeo');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
    	$dataSend = $input['request']->getData();

        $value['general']['title']= $dataSend['generalTitle'];
        $value['general']['keyword']= $dataSend['generalKeyword'];
        $value['general']['description']= $dataSend['generalDescription'];
        $value['general']['image']= $dataSend['image'];
        
        $value['category']['title']= $dataSend['categoryTitle'];
        $value['category']['keyword']= $dataSend['categoryKeyword'];
        $value['category']['description']= $dataSend['categoryDescription'];
        
        $value['post']['title']= $dataSend['postTitle'];
        $value['post']['keyword']= $dataSend['postKeyword'];
        $value['post']['description']= $dataSend['postDescription'];
        
        $value['expand']['title']= $dataSend['expandTitle'];
        $value['expand']['keyword']= $dataSend['expandKeyword'];
        $value['expand']['description']= $dataSend['expandDescription'];


        $data->key_word = 'allSeo';
        $data->value = json_encode($value);

        $modelOptions->save($data);

        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
    }

    $data_value = array();
    if(!empty($data->value)){
        $data_value = json_decode($data->value, true);
    }

    setVariable('data_value', $data_value);
    setVariable('mess', $mess);
}
?>