<?php 

$menus= array();
$menus[0]['title']= 'Projects';

$menus[0]['sub'][0]= array('title'=>'Thông tin Projects',
                            'url'=>'/plugins/admin/project-view-admin-project-listProjectAdmin',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listProjectAdmin',
                        );
$menus[0]['sub'][1]= array('title'=>'Thông tin Library',
                            'url'=>'/plugins/admin/project-view-admin-library-listLibraryAdmin',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listLibraryAdmin',
                        );
$menus[0]['sub'][2]= array('title'=>'Thông tin Mediapress',
                            'url'=>'/plugins/admin/project-view-admin-mediapre-listMediapreAdmin',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listMediapreAdmin',
                        );

$menus[0]['sub'][3]= array('title'=>'Cài đặt trang Media ',
                            'url'=>'/plugins/admin/project-view-admin-mediapre-settingMediaAdmin',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'settingMediaAdmin',
                        );

$menus[0]['sub'][4]= array('title'=>'Cài đặt trang Aboutus ',
                            'url'=>'/plugins/admin/project-view-admin-project-settingAboutusAdmin',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'settingAboutusAdmin',
                        );
$menus[0]['sub'][5]= array('title'=>'Thông tin Opportunities ',
                            'url'=>'/plugins/admin/project-view-admin-opportunities-listOpportunitiesAdmin',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listOpportunitiesAdmin',
                        );
$menus[0]['sub'][6]= array('title'=>'Thông tin Warm Team ',
                            'url'=>'/plugins/admin/project-view-admin-mediapre-sttingWarmteamAdmin',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'sttingWarmteamAdmin',
                        );
$menus[0]['sub'][6]= array('title'=>'Thông tin Event',
                            'url'=>'/plugins/admin/project-view-admin-event-listEventAdmin',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listEventAdmin',
                        );
addMenuAdminMantan($menus);

function getEvent(){
   global $controller;
    global $urlCurrent;
    global $metaTitleMantan;
    global $modelCategories;

    $metaTitleMantan = 'Danh sách Event';

    $modelEvent = $controller->loadModel('Events');

    $month = getdate()['mon'];
    $year = getdate()['year'];

    
    return $modelEvent->find()->limit(2)->page(1)->where(array('moth' => $month))->all()->toList(); 
}
?>
