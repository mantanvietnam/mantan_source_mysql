<?php
	global $routesPlugin;

	// api
	$routesPlugin['searchProductAPI']= 'product/searchProductAPI.php';

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
	$routesPlugin['sela']= 'product/view/home/sela.php';
	$routesPlugin['pay']= 'product/view/home/pay.php';
	$routesPlugin['addReview']= 'product/view/home/addReview.php';

	$routesPlugin['addProductToCart']= 'product/view/home/addProductToCart.php';
	$routesPlugin['deleteProductCart']= 'product/view/home/deleteProductCart.php';
	$routesPlugin['clearCart']= 'product/view/home/clearCart.php';
	$routesPlugin['completeOrder']= 'product/view/home/completeOrder.php';
	$routesPlugin['likeProduct']= 'product/view/home/likeProduct.php';
?>