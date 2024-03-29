<?php
	global $routesPlugin;

	// api
	$routesPlugin['searchProductAPI']= 'product/searchProductAPI.php'; // tìm kiếm sản phẩm
	$routesPlugin['getCategoryProductAPI']= 'product/getCategoryProductAPI.php'; // lấy danh mục sản phẩm
	$routesPlugin['getProductByCategoryAPI']= 'product/getProductByCategoryAPI.php'; // lấy sản phẩm theo danh mục
	$routesPlugin['searchEvaluateAPI']= 'product/searchEvaluateAPI.php';
	$routesPlugin['getInfoProductAPI']= 'product/getInfoProductAPI.php';
	$routesPlugin['getNewProductAPI']= 'product/getNewProductAPI.php';

	// frontend
	$routesPlugin['allProduct']= 'product/view/home/allProduct.php';
	$routesPlugin['category']= 'product/view/home/category.php';
	$routesPlugin['manufacturer']= 'product/view/home/manufacturer.php';
	$routesPlugin['product']= 'product/view/home/product.php';
	$routesPlugin['viewProduct']= 'product/view/home/viewProduct.php';
	$routesPlugin['listOrder']= 'product/view/home/listOrder.php';
	$routesPlugin['detailOrder']= 'product/view/home/detailOrder.php';
	$routesPlugin['search-product']= 'product/view/home/search.php';
	$routesPlugin['cart']= 'product/view/home/cart.php';
	$routesPlugin['sale']= 'product/view/home/sela.php';
	$routesPlugin['pay']= 'product/view/home/pay.php';
	$routesPlugin['discount']= 'product/view/home/discount.php';
	$routesPlugin['addReview']= 'product/view/home/addReview.php';

	$routesPlugin['addProductToCart']= 'product/view/home/addProductToCart.php';
	$routesPlugin['deleteProductCart']= 'product/view/home/deleteProductCart.php';
	$routesPlugin['clearCart']= 'product/view/home/clearCart.php';
	$routesPlugin['completeOrder']= 'product/view/home/completeOrder.php';
	$routesPlugin['likeProduct']= 'product/view/home/likeProduct.php';
	$routesPlugin['addNumberShare']= 'product/view/home/addNumberShare.php';
	$routesPlugin['getOrderAPI']= 'product/view/home/getOrderAPI.php';

	// việt hóa
	$routesPlugin['danh-muc']= 'product/view/home/category.php';
	$routesPlugin['san-pham']= 'product/view/home/product.php';
	$routesPlugin['gio-hang']= 'product/view/home/cart.php';
	$routesPlugin['cua-hang']= 'product/view/home/allProduct.php';
	$routesPlugin['thanh-toan']= 'product/view/home/pay.php';
?>