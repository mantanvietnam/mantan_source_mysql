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
$menus[0]['sub'][2]= array('title'=>'Thông tin Mediapre',
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
addMenuAdminMantan($menus);


?>
