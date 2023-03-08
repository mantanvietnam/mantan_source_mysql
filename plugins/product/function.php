<?php 
$menus= array();
$menus[0]['title']= 'Sản phẩm';
$menus[0]['sub'][0]= array(	'title'=>'Sản phẩm',
							'url'=>'/plugins/admin/product-view-admin-product-listProduct.php',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listProduct'
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

									)
						);


addMenuAdminMantan($menus);
