<?php 

$menus= array();
$menus[0]['title']= 'Dự án';

$menus[0]['sub'][0]= array('title'=>'Thông tin Dự án',
                            'url'=>'/plugins/admin/product_project-view-admin-product_project-listProductProjectAdmin.php',
                            'classIcon'=>'bx bxs-data',
                            'permission'=>'listProductProjectAdmin',
                        );

$menus[0]['sub'][1]= array('title'=>'Cài đặt',
							'url'=>'/',
							'classIcon'=>'bx bx-cog',
							'permission'=>'settingsProducts',
							'sub'=> array(  array('title'=>'Danh mục Loại dự án',
												'url'=>'/plugins/admin/product_project-view-admin-kind-listKindAdmin.php',
												'classIcon'=>'bx bx-category',
												'permission'=>'listKindAdmin',
											),
                    

									)
						);



addMenuAdminMantan($menus);

global $modelCategories;

$conditions = array('type' => 'category_kind');
$productCategory = $modelCategories->find()->where($conditions)->all()->toList();

if(isset($productCategory)){
	$category[0]['title'] = 'Danh mục dự án';
	$category[0]['sub'] = [];

    foreach ($productCategory as $key => $value) {
    	$category[0]['sub'][] = [	'url' => '/category-project/'.$value->slug.'.html',
                                  	'name' => $value->name
                              	];
    }
}


addMenusAppearance($category);


?>