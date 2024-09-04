<?php 
$menus= array();
$menus[0]['title']= 'Camera AI';
/*$menus[0]['sub'][0]= array(	'title'=>'Sản phẩm',
							'url'=>'/plugins/admin/product-view-admin-product-listProduct',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listProduct'
						);*/

$menus[0]['sub'][0]= array(	'title'=>'Quản lý xã phường',
							'url'=>'/plugins/admin/camera_ai-view-admin-precinct-listAdminPrecinct',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listAdminPrecinct'
						);
$menus[0]['sub'][1]= array('title'=>'Địa điểm camera',
							'url'=>'/plugins/admin/camera_ai-view-admin-locationcamera-listAdminLocationcamera',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listAdminLocationcamera'

						);
$menus[0]['sub'][10]= array('title'=>'Cài đặt',
							'url'=>'/',
							'classIcon'=>'bx bx-cog',
							'permission'=>'settingsCamera',
							'sub'=> array(  
											array(	'title'=>'Nhóm camera',
													'url'=>'/plugins/admin/camera_ai-view-admin-category-listCategoryGroupcamera',
													'classIcon'=>'bx bxs-data',
													'permission'=>'listCategoryGroupcamera'
													),
											array(	'title'=>'Chức năng camera',
													'url'=>'/plugins/admin/camera_ai-view-admin-category-listCategoryDeportmentcamera',
													'classIcon'=>'bx bxs-data',
													'permission'=>'listCategoryDeportmentcamera'
											),
							)

						);

addMenuAdminMantan($menus);

function getNameFromIdprecinct($id) {
    global $controller;
    $modelprecinct = $controller->loadModel('precinct');

    $data = $modelprecinct->find()->where(['id' => (int)$id])->first();

    if ($data) {
        return $data->name;
    }
    
    return null; 
}
function getNameFromIdgroupcamera($id) {
    global $controller;
    $modelCategories = $controller->loadModel('Categories');
	$conditions = array('type' => 'category_groupcamera');
    $data = $modelCategories->find()->where(['id' => (int)$id],$conditions)->first();

    if ($data) {
        return $data->name;
    }
    
    return null; 
}
function getNameFromIddeportmentcamera($id) {
    global $controller;
    $modelCategories = $controller->loadModel('Categories');
	$conditions = array('type' => 'Category_deportment');
    $data = $modelCategories->find()->where(['id' => (int)$id],$conditions)->first();

    if ($data) {
        return $data->name;
    }
    
    return null; 
}
?> 