<?php 
function setingBankAccount($input){
	global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Cài đặt';
    $mess= '';

    $conditions = array('key_word' => 'setingBankAccount');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
        $dataSend = $input['request']->getData();

        $value = array('rose_ambassador' => @$dataSend['rose_ambassador'], 
                       
                    );
        $data->key_word = 'setingBankAccount';
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

function setingAbout($input){
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Cài đặt';
    $mess= '';

    $conditions = array('key_word' => 'setingAbout');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
        $dataSend = $input['request']->getData();

        $value = array( 
                        'titel_header' => @$dataSend['titel_header'],
                        'titel_header_en' => @$dataSend['titel_header_en'],
                        'desc_header' => @$dataSend['desc_header'],
                        'desc_header_en' => @$dataSend['desc_header_en'],
                        'image_header' => @$dataSend['image_header'],
                        'titel_tamnhin' => @$dataSend['titel_tamnhin'],
                        'titel_tamnhin_en' => @$dataSend['titel_tamnhin_en'],
                        'desc_tamnhin_phantu1' => @$dataSend['desc_tamnhin_phantu1'],
                        'desc_tamnhin_phantu1_en' => @$dataSend['desc_tamnhin_phantu1_en'],
                        'image_tamnhin_phantu1' => @$dataSend['image_tamnhin_phantu1'],
                        'desc_phantu2' => @$dataSend['desc_phantu2'],
                        'desc_tamnhin_phantu2_en' => @$dataSend['desc_tamnhin_phantu2_en'],
                        'image_tamnhin_phantu2' => @$dataSend['image_tamnhin_phantu2'],
                        'titel_sanpham' => @$dataSend['titel_sanpham'],
                        'titel_sanpham_en' => @$dataSend['titel_sanpham_en'],
                        'desc_sanpham' => @$dataSend['desc_sanpham'],
                        'desc_sanpham_en' => @$dataSend['desc_sanpham_en'],
                        'link_sanpham' => @$dataSend['link_sanpham'],
                        'link_sanpham_en' => @$dataSend['link_sanpham_en'],
                        'image_sanpham' => @$dataSend['image_sanpham'],
                        'titel_nhasangnlap' => @$dataSend['titel_nhasangnlap'],
                        'desc_nhasangnlap' => @$dataSend['desc_nhasangnlap'],
                        'titel_nhasangnlap_en' => @$dataSend['titel_nhasangnlap_en'],
                        'desc_nhasangnlap_en' => @$dataSend['desc_nhasangnlap_en'],
                        'image_nhasangnlap' => @$dataSend['image_nhasangnlap'],
                        'id_album' => @$dataSend['id_album'],
                       
                    );
        $data->key_word = 'setingAbout';
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

 ?>
