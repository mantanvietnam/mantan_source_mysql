<?php 
$menus= array();
$menus[0]['title']= "Di tích và hiện vật";
$menus[0]['sub'][0]= array(	'title'=>'Phường / Xã',
							'url'=>'/plugins/admin/ditichhienvat-admin-ward-listWardAdmin',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listWardAdmin'
						);
$menus[0]['sub'][]= array(	'title'=>'Di tích lịch sử',
							'url'=>'/plugins/admin/ditichhienvat-admin-historicalSites-listHistoricalSitesAdmin',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listHistoricalSitesAdmin'
						);
$menus[0]['sub'][]= array(	'title'=>'Hiện vật',
							'url'=>'/plugins/admin/ditichhienvat-admin-artifact-listArtifactAdmin',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listArtifactAdmin'
						);

$menus[0]['sub'][]= array(	'title'=>'Danh mục hiện vật',
							'url'=>'/plugins/admin/ditichhienvat-admin-categoryartifact-listCategoryartifactAdmin',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listCategoryartifactAdmin'
						);

$menus[0]['sub'][]= array( 'title'=>'Loại hình di tích',
                            'url'=>'/plugins/admin/ditichhienvat-admin-typeHistoricalSites-listTypeHistoricalSites',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listTypeHistoricalSites'
                        );

addMenuAdminMantan($menus);

$category[1]['title'] = 'Di tích';
$category[1]['sub'] = array(array (	'url' => '/di_tich_lich_su',
                                    'name' => 'Di tích lịch sử'
                                    ),
							array (	'url' => '/ban_do',
                                    'name' => 'Bản đồ di tích'
                                    ),
                            array ( 'url' => '/di_tich_yeu_thich',
                                    'name' => 'Điểm đến di tích'
                                    ),
                        );


addMenusAppearance($category);


function getHistoricalSite($id){
    global $modelOption;
    global $controller;
    $modelHistoricalSite = $controller->loadModel('HistoricalSites');
        $data = $modelHistoricalSite->find()->where(['id'=>intval($id)])->first();     
        return $data;
}

function getArtifact($id){
    global $modelOption;
    global $controller;
    $modelArtifact = $controller->loadModel('Artifacts');
        $data = $modelArtifact->find()->where(['id'=>intval($id)])->first();     
        return $data;
}
?>
