<?php 
function getParameter($input)
{
    global $controller;
    global $modelOptions;
    global $isRequestPost;
     $conditions = array('key_word' => 'setingPaymentAdmin');
    $data = $modelOptions->find()->where($conditions)->first();
    	$return = array();
            if (!empty($data)) { 
            	 $data_value = array();
			    if(!empty($data->value)){
			        $data_value = json_decode($data->value, true);
			    }
                return array('code' => 1, 'mess' => 'Lấy dữ liệu thành công', 'data' => $data_value);
            } 

   return $return;
}
 ?>