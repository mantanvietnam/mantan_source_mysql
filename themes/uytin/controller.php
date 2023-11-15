<?php 
function settingHomeTheme($input){
    global $modelOptions;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Cài đặt giao diện trang chủ ';
    $mess= '';

    $conditions = array('key_word' => 'settingHomeThemeUyTin');
    $data = $modelOptions->find()->where($conditions)->first();
    if(empty($data)){
        $data = $modelOptions->newEmptyEntity();
    }

    if($isRequestPost){
        $dataSend = $input['request']->getData();

        // khối đầu trang
        $value['logo']= @$dataSend['logo'];
        $value['title1']= @$dataSend['title1'];
        $value['content1']= @$dataSend['content1'];
        $value['linkgetstarted']= @$dataSend['linkgetstarted'];
        $value['imagetop1']= @$dataSend['imagetop1'];
        $value['submit1']= @$dataSend['submit1'];

        // khối thứ 2: SẢN PHẨM - DỊCH VỤ
        $value['minuscule5']= @$dataSend['minuscule5'];  
        $value['title5']= @$dataSend['title5'];  

        $value['checkbox1']= @$dataSend['checkbox1'];    
        $value['checkbox2']= @$dataSend['checkbox2'];    
        $value['checkbox3']= @$dataSend['checkbox3'];    
        $value['checkbox4']= @$dataSend['checkbox4'];    
        $value['checkbox5']= @$dataSend['checkbox5'];    
        $value['checkbox6']= @$dataSend['checkbox6'];    
        $value['checkbox7']= @$dataSend['checkbox7'];    
        $value['checkbox8']= @$dataSend['checkbox8'];    
        $value['checkbox9']= @$dataSend['checkbox9'];   

        // khối thứ 3
        $value['title8']= @$dataSend['title8'];
        $value['tminuscule8']= @$dataSend['tminuscule8'];    

        $value['title801']= @$dataSend['title801'];  
        $value['content801']= @$dataSend['content801'];
        $value['link801']= @$dataSend['link801'];

        $value['title802']= @$dataSend['title802'];  
        $value['content802']= @$dataSend['content802'];
        $value['link802']= @$dataSend['link802'];

        $value['title803']= @$dataSend['title803'];  
        $value['content803']= @$dataSend['content803'];
        $value['link803']= @$dataSend['link803'];
        
        $value['title804']= @$dataSend['title804'];  
        $value['content804']= @$dataSend['content804'];
        $value['link804']= @$dataSend['link804'];

        $value['title805']= @$dataSend['title805'];  
        $value['content805']= @$dataSend['content805'];
        $value['link805']= @$dataSend['link805'];

        $value['title806']= @$dataSend['title806'];  
        $value['content806']= @$dataSend['content806'];
        $value['link806']= @$dataSend['link806'];

        // khối thứ 4: SLIDE ĐỐI TÁC
        $value['titletaitro']= @$dataSend['titletaitro'];
        $value['idslidetaitro']= @$dataSend['idslidetaitro'];
        $value['nametaitro']= @$dataSend['nametaitro'];
        
        // khối thứ 5: feedback khách hàng
        $value['tminuscule11']= @$dataSend['tminuscule11'];
        $value['title11']= @$dataSend['title11'];

        // khối thứ 6: đội ngũ nhân sự
        $value['tminuscule12']= @$dataSend['tminuscule12'];
        $value['title12']= @$dataSend['title12'];

        $value['avatar121']= @$dataSend['avatar121'];
        $value['fullName121']= @$dataSend['fullName121'];
        $value['content121']= @$dataSend['content121'];
        $value['positions121']= @$dataSend['positions121'];
        
        $value['avatar122']= @$dataSend['avatar122'];
        $value['fullName122']= @$dataSend['fullName122'];
        $value['content122']= @$dataSend['content122'];
        $value['positions122']= @$dataSend['positions122'];

        $value['avatar123']= @$dataSend['avatar123'];
        $value['fullName123']= @$dataSend['fullName123'];
        $value['content123']= @$dataSend['content123'];
        $value['positions123']= @$dataSend['positions123'];

        $value['avatar124']= @$dataSend['avatar124'];
        $value['fullName124']= @$dataSend['fullName124'];
        $value['content124']= @$dataSend['content124'];
        $value['positions124']= @$dataSend['positions124'];

        // khối thứ 7: tin tức mới
        $value['tminuscule14']= @$dataSend['tminuscule14'];
        $value['title14']= @$dataSend['title14'];

        // khối thứ 8: chân trang
        $value['company']= @$dataSend['company'];
        $value['nenFooter']= @$dataSend['nenFooter'];

        $value['facebook']= @$dataSend['facebook'];
        $value['youtube']= @$dataSend['youtube'];
        $value['tiktok']= @$dataSend['tiktok'];
        $value['zalo']= @$dataSend['zalo'];


        $data->key_word = 'settingHomeThemeUyTin';
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

function indexTheme($input){
    global $modelAlbums;
    global $modelAlbuminfos;
    global $themeSettings;
    global $modelPosts;

    // SLIDE ĐỐI TÁC
    $slide_tai_tro = [];
    if(!empty($themeSettings['idslidetaitro'])){
        $slide_tai_tro = $modelAlbuminfos->find()->where(['id_album'=>(int) $themeSettings['idslidetaitro']])->all()->toList();
    }

    $news = $modelPosts->find()->where(['type'=>'post'])->all()->toList();

    setVariable('slide_tai_tro', $slide_tai_tro);
    setVariable('news', $news);

}
?>