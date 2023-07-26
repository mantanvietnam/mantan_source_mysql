<?php
	global $routesPlugin;

	// api
	$routesPlugin['searchProductAPI']= 'product/searchProductAPI.php';

	// frontend
	$routesPlugin['products']= 'product/view/home/products.php';
	$routesPlugin['category']= 'product/view/home/category.php';
	$routesPlugin['manufacturer']= 'product/view/home/manufacturer.php';
	$routesPlugin['product']= 'product/view/home/product.php';
	$routesPlugin['search-product']= 'product/view/home/search.php';
	$routesPlugin['cart']= 'product/view/home/cart.php';

	$routesPlugin['addProductToCart']= 'product/view/home/addProductToCart.php';
	$routesPlugin['deleteProductCart']= 'product/view/home/deleteProductCart.php';
	$routesPlugin['clearCart']= 'product/view/home/clearCart.php';
?>