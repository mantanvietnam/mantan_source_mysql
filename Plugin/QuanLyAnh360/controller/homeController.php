<?php 
function createXML($input)
{
    
    global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;

    $metaTitleMantan = 'Danh sách Library';

    $modelInfoScene = $controller->loadModel('InfoScenes');

    $conditions = array('status'=>1);
   
    $listData = $modelInfoScene->find()->where($conditions)->all()->toList();

    $xml = new DOMDocument('1.0', 'UTF-8');
    

    $roots = '';

    foreach($listData as $key => $item){

        $roots .='<scene name="'.$item->code.'" title_vi="'.$item->title_vi.'" title_en="'.$item->title_en.'" title_cn="'.$item->title_cn.'" lat="'.$item->lat.'" lng="'.$item->lng.'" intro_sound="'.$item->audio_vi.'" intro_sound_en="'.$item->audio_en.'" intro_sound_cn="'.$item->audio_cn.'3" info_vi="'.$item->code.'vi" info_en="'.$item->code.'en" info_cn="'.$item->code.'cn" gallery="true" gal="gallery1">

            <view hlookat="'.$item->hlookat.'" vlookat="'.$item->vlookat.'" fovtype="'.$item->fovtype.'" fov="'.$item->fov.'" maxpixelzoom="'.$item->maxpixelzoom.'" fovmin="'.$item->fovmin.'" fovmax="'.$item->fovmax.'" limitview="true" />

            <preview url="%SWFPATH%/panos/chuyenlaocai/'.$item->code.'/preview.jpg" />

            <image>
                <cube url="%SWFPATH%/panos/chuyenlaocai/'.$item->code.'/pano_%s.jpg" />
                <cube url="%SWFPATH%/panos/chuyenlaocai/'.$item->code.'/mobile/pano_%s.jpg" devices="mobile" />
            </image>

            <events name="s1" onxmlcomplete=""
                onloadcomplete=" 
                create_hs(s11, s11,158.32674693848392, 41.64496653216571,0);
                create_hs(s2, s2,-36.930256918860835, 31.274572349278635,0);
                                
                "
                />

            </scene>';
    }

    $file = '../upload/bang.xml';
file_put_contents($file, $roots);

// Check if the file was created successfully
if (file_exists($file)) {
    echo "XML file created successfully.";
} else {
    echo "Error creating XML file.";
}
    die();


    // $xml->save('../upload/bang.xml');
   
    
    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);
    setVariable('totalData', $totalData);
    setVariable('listData', $listData);

}


?>

