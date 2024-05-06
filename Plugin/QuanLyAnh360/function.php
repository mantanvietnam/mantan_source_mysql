<?php 

$menus= array();
$menus[0]['title']= 'Quản lý ảnh 360';

$menus[0]['sub'][0]= array('title'=>'Thông tin bối cảnh',
                            'url'=>'/plugins/admin/QuanLyAnh360-view-admin-scene-listSceneAdmin',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listSceneAdmins',
                        );

// /$menus[1]['sub'][6]= ;
addMenuAdminMantan($menus);


function addChildXMLElements(SimpleXMLElement $parent, $xmlString) {
    $xmlChild = new SimpleXMLElement($xmlString);
    foreach ($xmlChild->children() as $child) {
        $parent->addChild($child->getName(), htmlspecialchars((string)$child));
    }
}

function createXML()
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

    $info = '<krpano>';
    

    $roots = '<krpano flare_dir="core" version="1.20.11" gtitle="chuaboc" default_demo_speed="7" autotour_running="false" step="0">

    <include url="core/core.xml" />
    <include url="lensflare.xml" />
    <include url="%SWFPATH%/skin/vtourskin.xml" />
    <include url="%SWFPATH%/skin/hotspot_images.xml" />
    <include url="%SWFPATH%/skin/language.xml" />
    <include url="%SWFPATH%/vrmenu/vrmenu.xml"/>
    <include url="gallery.xml" />
    <include url="data.xml" />
    <!-- <include url="%SWFPATH%/skin/debug.xml" /> -->
    <skin_settings maps="false"
        maps_type="google"
        maps_bing_api_key=""
        maps_google_api_key=""
        maps_zoombuttons="false"
        gyro="true"
        webvr="true"
        webvr_gyro_keeplookingdirection="false"
        webvr_prev_next_hotspots="true"
        littleplanetintro="false"
        title="false"
        menu_thumb="false"
        thumbs="false"
        thumbs_width="100" thumbs_height="66" thumbs_padding="5"
        thumbs_opened="true"
        thumbs_text="true"
        thumbs_dragging="true"
        thumbs_onhoverscrolling="false"
        thumbs_scrollbuttons="true"
        thumbs_scrollindicator="true"
        thumbs_loop="false"
        tooltips_buttons="false"
        tooltips_thumbs="true"
        tooltips_hotspots="false"
        tooltips_mapspots="true"
        deeplinking="false"
        loadscene_flags="MERGE"
        loadscene_blend="BLEND(2.0, easeInCubic)"
        loadscene_blend_prev="BLEND(2.0, easeInCubic)"
        loadscene_blend_next="BLEND(2.0, easeInCubic)"
        loadingtext="Loading..."
        layout_width="100%"
        layout_maxwidth="800"
        layout_maxwidth.touch="780"
        controlbar_width="-24"
        controlbar_height="40"
        controlbar_offset="0"
        controlbar_offset_closed="-40"
        controlbar_overlap.no-fractionalscaling="10"
        controlbar_overlap.fractionalscaling="0"
        design_skin_images="vtourskin.png"
        design_bgcolor=""
        design_bgalpha=""
        design_bgalpha_info="1"
        design_bghotspot="0x2d554b"
        design_bghotspotalpha="0.75"

        design_bgborder="0"
        design_bgroundedge=""
        design_bgshadow="0"
        design_thumbborder_bgborder="3 0xFFFFFF 1.0"
        design_thumbborder_bgborder_active="3 0xFFFF00 1.0"
        design_thumbborder_padding="2"
        design_thumbborder_bgroundedge="3"
        design_text_css="color:#FFFFFF;font-size:16px;"
        design_text_shadow="1"
        />
        <contextmenu fullscreen="true" versioninfo="false">     
            <item name="fs" caption="FULLSCREEN" />
            <item name="kr" caption="Virtual Tour 360"/>
        </contextmenu>

        <vrmenu  angle="-45"
            groups="false"
            onlycat="false" 
            firstgroup="false"
            onlygroups="false"          
            displayprevnext="true"          
            width="240"  
            height="120"
            gpwidth="400"  
            gpheight="200"              
            rows="4" 
            group_rows="2"          
            spacing="20" 
            gpspacing="50"          
            timeout="2000"          
            seen="true"         
            from="-800"         
            closevrmenu="true"          
            fademenu="true"
            menualpha="80"          
            add_txt_thumb="true"
            txt_thumb_css="color:#ffffff;font-size:20px;text-align:center"
            txt_thumb_vcenter="true"
            txt_thumb_hasshadow="true"          
            add_txt_group="true"
            txt_group_css="color:#ffffff;font-size:26px;text-align:center"
            txt_group_vcenter="true"
            txt_group_hasshadow="true"          
            add_thumb_border="true"
            thumb_border_border="0 0x000000 1.00"
            thumb_border_bgcolor="0x000000"
            thumb_border_bgalpha="0"            
            thumb_border_over_border="2 0xffffff 1.00"
            thumb_border_over_bgcolor="0x000000"
            thumb_border_over_bgalpha="0.7"       
        />





        <!-- startup action - load the first scene -->
        <action name="startup" autorun="onstart">
            if(startscene === null OR !scene[get(startscene)], copy(startscene,scene[0].name); );
            loadscene(get(startscene), null, MERGE);
            if(startactions !== null, startactions() );
            for(set(i,0), i LT scene.count, inc(i), 
                set(vi_sub_direct, get(scene[get(scene[get(i)].name)].title_vi));
                set(en_sub_direct, get(scene[get(scene[get(i)].name)].title_en));
                set(cn_sub_direct, get(scene[get(scene[get(i)].name)].title_cn));
                set(scenename, get(scene[get(i)].name));
                js(add_menu());
            );  
            js(load_component());
            js(introsound_off());
        </action>

        <events name="save_view_param" keep="true" onxmlcomplete="save_info_scene();" onloadcomplete="" onmousedown="js(touch_screen();)"/>

        <autorotate enabled="true" waittime="2" accel="1" speed="2" horizon="get(view.vlookat)"/>';

         // Thay đổi thông tin ở phần này 
     foreach($listData as $key => $item){

        $roots .='   <scene name="'.@$item->code.'" title="'.@$item->title_vi.'" title_vi="'.@$item->title_vi.'" title_en="'.@$item->title_en.'" title_cn="'.@$item->title_cn.'" lat="'.@$item->lat.'" lng="'.@$item->lng.'" intro_sound="'.@$item->audio_vi.'" intro_sound_en="'.@$item->audio_en.'" intro_sound_cn="'.@$item->audio_cn.'" info_vi="'.@$item->code.'vi" info_en="'.@$item->code.'en" info_cn="'.@$item->code.'cn" gallery="true" gal="gallery1" thumburl="%SWFPATH%/panos/chuaboc/thumb/'.@$item->code.'.jpg">

            <view hlookat="'.@$item->hlookat.'" vlookat="'.@$item->vlookat.'" fovtype="'.@$item->fovtype.'" fov="'.@$item->fov.'" maxpixelzoom="'.@$item->maxpixelzoom.'" fovmin="'.@$item->fovmin.'" fovmax="'.@$item->fovmax.'" limitview="true" />

            <preview url="%SWFPATH%/panos/chuaboc/'.@$item->code.'/preview.jpg" />

            <image>
                <cube url="%SWFPATH%/panos/chuaboc/'.@$item->code.'/pano_%s.jpg" />
                <cube url="%SWFPATH%/panos/chuaboc/'.@$item->code.'/mobile/pano_%s.jpg" devices="mobile" />
            </image>

            <events name="'.@$item->code.'" onxmlcomplete=""
                onloadcomplete=""
                />

            </scene>';

            /*create_hs(s4, hotspot1,-6.256971599014207, 51.56418353091401,0);
            create_hs(s18, hotspot1,-32.99111173004951, 73.76806350148648,0);
            create_hs(s20, hotspot1,99.8607985987559, 54.43261724823227,0);
            create_hs(s2, hotspot1,-67.02883660923493, 26.54488619469841,0); */               
                

           $info .= ' <data name="'.@$item->code.'vi">
                        <p>'.@$item->info_vn.'</p>
                        </data>
                        <data name="'.@$item->code.'en">
                        <p>'.@$item->info_en.'</p>
                        </data>
                        <data name="'.@$item->code.'cn">
                        <p>'.@$item->info_cn.'</p>
                        </data>
            ';

        }

        $roots .=' </krpano>';
        $info .=' </krpano>';

    $file1 = '../anh360/data/projects/chuaboc/index.xml';
    $file2 = '../anh360/data/projects/chuaboc/data.xml';
    file_put_contents($file1, $roots);
    file_put_contents($file2, $info);

    // Check if the file was created successfully
    if (file_exists($file1) && file_exists($file2)){
        return array('code'=>1);
    } else {
        return array('code'=>2);
    }


}



?>
