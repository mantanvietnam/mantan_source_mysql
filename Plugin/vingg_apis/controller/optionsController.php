<?php 
function generalDescription($input)
{
	global $modelOptions;
	global $metaTitleMantan;
	global $isRequestPost;

    $metaTitleMantan = 'Cài đặt mô tả chung';
    $mess= '';

    $conditions = array('key_word' => 'generalDescriptionAI');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
    	$dataSend = $input['request']->getData();

        $data->key_word = 'generalDescriptionAI';
        $data->value = $dataSend['description'];

        $modelOptions->save($data);

        $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
    }

    setVariable('data_value', $data->value);
    setVariable('mess', $mess);
}
?>