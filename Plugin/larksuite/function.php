<?php 
    $menus= array();
    $menus[0]['title']= 'Lark suite';
    $menus[0]['sub'][0]= array( 'title'=>'Lark suite Setting',
                            'url'=>'/plugins/admin/larksuite-settingLarkSuite',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'settingLarkSuite'
                        );
 addMenuAdminMantan($menus);

    
function getLarkSuite(){
    $today= getdate();
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Cài đặt giao diện trang chủ ';
    $static= '';

    $conditions = array('key_word' => 'lark_suite');
    $data = $modelOptions->find()->where($conditions)->first();
    if(!empty($data->value)){
         $static = json_decode(@$data->value, true);
    }
     return $static;
}

?>