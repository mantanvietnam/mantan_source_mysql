<?php

$menus = array();
$menus[0]['title'] = 'Cố lên nao';

$menus[0]['sub'][0] = array(
    'title' => 'Danh sách thành viên',
    'url' => '/plugins/admin/colennao-view-admin-user-listUserAdmin',
    'classIcon' => 'bx bx-cog',
    'permission' => 'listUserAdmin',
);



addMenuAdminMantan($menus);

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

function createToken($length = 30): string
{
    $chars = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    return substr(str_shuffle($chars), 0, $length) . time();
}

function getUserByToken($accessToken, $checkActive = true)
{
    global $controller;

    $modelUser = $controller->loadModel('Users');
    $conditions = [
        'token' => $accessToken
    ];

    if ($checkActive) {
        $conditions['status'] = 'active';
    }

    $user = $modelUser->find()->where($conditions)->first();
    return $user;
}


?>