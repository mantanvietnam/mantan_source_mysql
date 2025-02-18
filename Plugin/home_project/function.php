<?php 

$menus= array();
$menus[0]['title']= 'Dự án';

$menus[0]['sub'][0]= array('title'=>'Dự án',
							'url'=>'/',
							'classIcon'=>'bx bx-building-house',
							'permission'=>'settingsProducts',
							'sub'=> array(  array('title'=>'Phân cấp dự án',
												'url'=>'/plugins/admin/home_project-view-admin-kind-listKindAdmin',
												'classIcon'=>'bx bx-layer',
												'permission'=>'listKindAdmin',
											),
											array('title'=>'Thông tin về loại mô hình',
												'url'=>'/plugins/admin/home_project-view-admin-product_project-listTypeAdmin',
												'classIcon'=>'bx bx-info-circle',
												'permission'=>'listTypeAdmin',
											),
											array('title'=>'Thông tin dự án',
												'url'=>'/plugins/admin/home_project-view-admin-product_project-listProductProjectAdmin',
												'classIcon'=>'bx bx-info-circle',
												'permission'=>'listProductProjectAdmin',
											),
									)
						);

$menus[0]['sub'][1]= array('title'=>'Tin tức dự án',
						'url'=>'/',
						'classIcon'=>'bx bx-news',
						'permission'=>'settingsProducts',
						'sub'=> array(  array('title'=>'Chuyên mục',
											'url'=>'/categories/post',
											'classIcon'=>'bx bx-category',
											'permission'=>'post',
										),
										array('title'=>'Bài viết',
											'url'=>'/plugins/admin/home_project-view-admin-news-listNewsAdmin',
											'classIcon'=>'bx bx-category',
											'permission'=>'listNewsAdmin',
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