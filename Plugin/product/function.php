<?php 
$menus= array();
$menus[0]['title']= 'Sản phẩm';
$menus[0]['sub'][0]= array(	'title'=>'Sản phẩm',
							'url'=>'/plugins/admin/product-view-admin-product-listProduct.php',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listProduct'
						);

$menus[0]['sub'][1]= array(	'title'=>'Đơn hàng',
							'url'=>'/plugins/admin/product-view-admin-order-listOrderAdmin.php',
							'classIcon'=>'bx bx-cart-add',
							'permission'=>'listOrderAdmin'
						);

$menus[0]['sub'][10]= array('title'=>'Cài đặt',
							'url'=>'/',
							'classIcon'=>'bx bx-cog',
							'permission'=>'settingsProducts',
							'sub'=> array(  array('title'=>'Danh mục sản phẩm',
												'url'=>'/plugins/admin/product-view-admin-category-listCategoryProduct.php',
												'classIcon'=>'bx bx-category',
												'permission'=>'listCategoryProduct',
											),
                                            array('title'=>'Nhà sản xuất',
                                                'url'=>'/plugins/admin/product-view-admin-manufacturer-listManufacturerProduct.php',
                                                'classIcon'=>'bx bx-category',
                                                'permission'=>'listManufacturerProduct',
                                            ),
                                            array('title'=>'Gửi thông báo',
                                                'url'=>'/plugins/admin/product-view-admin-smaxbot-settingSmaxbotAdmin.php',
                                                'classIcon'=>'bx bx-category',
                                                'permission'=>'settingSmaxbotAdmin',
                                            ),

									)
						);


addMenuAdminMantan($menus);

global $modelCategories;

$conditions = array('type' => 'category_product');
$productCategory = $modelCategories->find()->where($conditions)->all()->toList();

if(isset($productCategory)){
	$category[0]['title'] = 'Danh mục sản phẩm';
	$category[0]['sub'] = [];

    foreach ($productCategory as $key => $value) {
    	$category[0]['sub'][] = [	'url' => '/category/'.$value->slug.'.html',
                                  	'name' => $value->name
                              	];
    }
}

$category[1]['title'] = 'Sản phẩm';
$category[1]['sub'] = array(array (	'url' => '/products',
                                    'name' => 'Tất cả sản phẩm'
                                    ),
                                    
                            array (
                              'url' => '/cart',
                              'name' => 'Giỏ hàng'
                            ),
                            
                            array (
                              'url' => '/search',
                              'name' => 'Tìm kiếm sản phẩm'
                            ),
                        );


addMenusAppearance($category);
