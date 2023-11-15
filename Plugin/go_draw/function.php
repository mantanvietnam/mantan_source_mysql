<?php

$menus = array();
$menus[0]['title'] = 'Sản phẩm';
$menus[0]['sub'][0] = array('title' => 'Cài đặt sản phẩm',
    'url' => '/plugins/admin/go_draw-view-admin-product-listProductAdmin.php',
    'classIcon' => 'bx bxs-data',
    'permission' => 'listProduct'
);

$menus[0]['sub'][] = array('title' => 'Đơn hàng combo',
    'url' => '/plugins/admin/go_draw-view-admin-agency_order-listAgencyOrderAdmin.php',
    'classIcon' => 'bx bx-cart-add',
    'permission' => 'listOrderAdmin'
);

$menus[0]['sub'][] = array('title' => 'Đơn hàng sản phẩm',
    'url' => '/plugins/admin/go_draw-view-admin-agency_order_product-listAgencyOrderProductAdmin.php',
    'classIcon' => 'bx bx-cart-add',
    'permission' => 'listAgencyOrderProductAdmin'
);

$menus[0]['sub'][] = array('title' => 'Đại lý',
    'url' => '/plugins/admin/go_draw-view-admin-agency-listAgencyAdmin.php',
    'classIcon' => 'bx bx-home',
    'permission' => 'listAgencyAdmin'
);

$menus[0]['sub'][] = array('title' => 'Combo sản phẩm',
    'url' => '/plugins/admin/go_draw-view-admin-combo-listComboAdmin.php',
    'classIcon' => 'bx bx-collection',
    'permission' => 'listComboAdmin'
);

$menus[0]['sub'][] = array('title' => 'Thành viên',
    'url' => '/plugins/admin/go_draw-view-admin-user-listUserAdmin.php',
    'classIcon' => 'bx bx-user',
    'permission' => 'listUserAdmin'
);

$menus[0]['sub'][] = array('title' => 'Lịch sử đơn hàng',
    'url' => '/',
    'classIcon' => 'bx bx-cog',
    'permission' => 'listOrderHistoryAdmin',
    'sub' => array(
        array('title' => 'Đơn hàng của đại lý',
            'url' => '/plugins/admin/go_draw-view-admin-order_history-listAgencyOrderHistoryAdmin.php',
            'classIcon' => 'bx bx-category',
            'permission' => 'listAgencyOrderHistoryAdmin',
        ),
        array('title' => 'Đơn hàng của user',
            'url' => '/plugins/admin/go_draw-view-admin-order_history-listUserOrderHistoryAdmin.php',
            'classIcon' => 'bx bx-category',
            'permission' => 'listUserOrderHistoryAdmin',
        ),
        array('title' => 'Đơn hàng combo của user',
            'url' => '/plugins/admin/go_draw-view-admin-order_history-listUserOrderComboHistoryAdmin.php',
            'classIcon' => 'bx bx-category',
            'permission' => 'listUserOrderComboHistoryAdmin',
        ),

    )
);

$menus[0]['sub'][] = array('title' => 'Cài đặt',
    'url' => '/',
    'classIcon' => 'bx bx-cog',
    'permission' => 'settingsProducts',
    'sub' => array(
        array('title' => 'Danh mục sản phẩm',
        'url' => '/plugins/admin/go_draw-view-admin-category-listCategoryAdmin.php',
        'classIcon' => 'bx bx-category',
        'permission' => 'listCategoryAdmin',
        ),
        array('title' => 'Nhà sản xuất',
            'url' => '/plugins/admin/product-view-admin-manufacturer-listManufacturerProduct.php',
            'classIcon' => 'bx bx-category',
            'permission' => 'listManufacturerProduct',
        ),
        array('title' => 'Gửi thông báo',
            'url' => '/plugins/admin/product-view-admin-smaxbot-settingSmaxbotAdmin.php',
            'classIcon' => 'bx bx-category',
            'permission' => 'settingSmaxbotAdmin',
        ),

    )
);

global $domain;
$domain = 'https://godraw.2top.vn/';

global $defaultImage;
$defaultImage = 'plugins/go_draw/view/image/default-image.jpg';

global $defaultAvatar;
$defaultAvatar = 'plugins/go_draw/view/image/default-avatar.png';

addMenuAdminMantan($menus);

global $modelCategories;

$conditions = array('type' => 'category_product');
$productCategory = $modelCategories->find()->where($conditions)->all()->toList();

if (isset($productCategory)) {
    $category[0]['title'] = 'Danh mục sản phẩm';
    $category[0]['sub'] = [];

    foreach ($productCategory as $key => $value) {
        $category[0]['sub'][] = [
            'url' => '/category/' . $value->slug . '.html',
            'name' => $value->name
        ];
    }
}

$category[1]['title'] = 'Sản phẩm';
$category[1]['sub'] = array(array('url' => '/products',
    'name' => 'Tất cả sản phẩm'
),

    array(
        'url' => '/cart',
        'name' => 'Giỏ hàng'
    ),

    array(
        'url' => '/search',
        'name' => 'Tìm kiếm sản phẩm'
    ),
);


addMenusAppearance($category);

function createPaginationMetaData($totalItem, $itemPerPage, $currentPage): array
{
    global $urlCurrent;

    $balance = $totalItem % $itemPerPage;
    $totalPage = ($totalItem - $balance) / $itemPerPage;
    if ($balance > 0)
        $totalPage += 1;

    $back = $currentPage - 1;
    $next = $currentPage + 1;
    if ($back <= 0)
        $back = 1;
    if ($next >= $totalPage)
        $next = $totalPage;

    if (isset($_GET['page'])) {
        $urlPage = str_replace('&page=' . $_GET['page'], '', $urlCurrent);
        $urlPage = str_replace('page=' . $_GET['page'], '', $urlPage);
    } else {
        $urlPage = $urlCurrent;
    }
    if (strpos($urlPage, '?') !== false) {
        if (count($_GET) >= 1) {
            $urlPage = $urlPage . '&page=';
        } else {
            $urlPage = $urlPage . 'page=';
        }
    } else {
        $urlPage = $urlPage . '?page=';
    }

    return [
        'page' => $currentPage,
        'totalPage' => $totalPage,
        'back' => $back,
        'next' => $next,
        'urlPage' => $urlPage
    ];
}

function apiResponse(int $code = 0, $messages = '', $data = [], array $meta = []): array
{
    return [
        'data' => $data ?? [],
        'code' => $code ?? '',
        'messages' => $messages ?? '',
        'meta' => $meta ?? []
    ];
}
