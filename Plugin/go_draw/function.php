<?php

$menus = array();
$menus[0]['title'] = 'Sản phẩm';
$menus[0]['sub'][0] = array('title' => 'Cài đặt sản phẩm',
    'url' => '/plugins/admin/go_draw-view-admin-product-listProductAdmin.php',
    'classIcon' => 'bx bxs-data',
    'permission' => 'listProduct'
);

/*
$menus[0]['sub'][] = array('title' => 'Đơn hàng combo',
    'url' => '/plugins/admin/go_draw-view-admin-agency_order-listAgencyOrderAdmin.php',
    'classIcon' => 'bx bx-cart-add',
    'permission' => 'listOrderAdmin'
);
*/
$menus[0]['sub'][] = array('title' => 'Đơn hàng đại lý',
    'url' => '/plugins/admin/go_draw-view-admin-agency_order_product-listAgencyOrderProductAdmin.php',
    'classIcon' => 'bx bx-cart-add',
    'permission' => 'listAgencyOrderProductAdmin'
);

$menus[0]['sub'][] = array('title' => 'Tài khoản đại lý',
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

$menus[0]['sub'][] = array('title' => 'Danh mục sản phẩm',
    'url' => '/plugins/admin/go_draw-view-admin-category-listCategoryAdmin.php',
        'classIcon' => 'bx bx-category',
        'permission' => 'listCategoryAdmin',
);



global $domain;
$domain = 'https://godraw.vn/';

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

function convert_number_to_words($number) 
    {

        $hyphen      = ' ';
        $conjunction = '  ';
        $separator   = ' ';
        $negative    = 'âm ';
        $decimal     = ' phẩy ';
        $dictionary  = array(
            0                   => 'Không',
            1                   => 'Một',
            2                   => 'Hai',
            3                   => 'Ba',
            4                   => 'Bốn',
            5                   => 'Năm',
            6                   => 'Sáu',
            7                   => 'Bảy',
            8                   => 'Tám',
            9                   => 'Chín',
            10                  => 'Mười',
            11                  => 'Mười một',
            12                  => 'Mười hai',
            13                  => 'Mười ba',
            14                  => 'Mười bốn',
            15                  => 'Mười năm',
            16                  => 'Mười sáu',
            17                  => 'Mười bảy',
            18                  => 'Mười tám',
            19                  => 'Mười chín',
            20                  => 'Hai mươi',
            30                  => 'Ba mươi',
            40                  => 'Bốn mươi',
            50                  => 'Năm mươi',
            60                  => 'Sáu mươi',
            70                  => 'Bảy mươi',
            80                  => 'Tám mươi',
            90                  => 'Chín mươi',
            100                 => 'trăm',
            1000                => 'nghìn',
            1000000             => 'triệu',
            1000000000          => 'tỷ',
            1000000000000       => 'nghìn tỷ',
            1000000000000000    => 'nghìn triệu triệu',
            1000000000000000000 => 'tỷ tỷ'
        );

        if (!is_numeric($number)) {
            return false;
        }

        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
    // overflow
            trigger_error(
                'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
                E_USER_WARNING
            );
            return false;
        }

        if ($number < 0) {
            return $negative . convert_number_to_words(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
            case $number < 21:
            $string = $dictionary[$number];
            break;
            case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
            case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = @$dictionary[$hundreds] . ' ' . @$dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
            default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
        }

        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }

        return $string;
    }