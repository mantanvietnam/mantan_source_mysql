<?php

function getPostListApi($input): array
{
    global $modelPosts;

    $conditions = array('type'=>'post');
    $limit = $_GET['limit'] ?? 10;
    $page = $_GET['page'] ?? 1;
    $order = array('pin'=>'desc');

    $listData = $modelPosts->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    return apiResponse(0, 'Lấy danh sách bài đăng thành công', $listData);
}

function getPostDetailApi($input): array
{
    global $modelPosts;

    $data = $modelPosts->newEmptyEntity();

    if(!empty($_GET['id'])){
        $data = $modelPosts->find()->where(['id'=>(int) $_GET['id']])->first();

        if(!empty($data)){
            $data->view ++;
            $modelPosts->save($data);
        }
    }

    return apiResponse(0, 'Lấy thông tin bài đăng thành công', $data);
}
