<?php

function getPostListHoneApi($input): array
{
    global $modelPosts;

    $conditions = array('type'=>'post','pin'=>1,'idCategory'=>3);
    $limit = $_GET['limit'] ?? 10;
    $page = $_GET['page'] ?? 1;
    $order = array('number_order'=>'asc');

    $listData = $modelPosts->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    return apiResponse(0, 'Lấy danh sách bài đăng thành công', $listData);
}

function getBannerLisProvinceApi($input): array
{
    global $modelPosts;
    global $controller;
    global $isRequestPost;

    $modelPostProvince = $controller->loadModel('PostProvinces');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['id_province'])){
            $conditions = array('post.type'=>'post','pin'=>1,'post.idCategory'=>1);
            $conditions['PostProvinces.province_id'] = (int) $dataSend['id_province'];
            $join = array(
                [
                    'table' => 'posts',
                    'alias' => 'post',
                    'type' => 'LEFT',
                    'conditions' => [
                        'post.id = PostProvinces.post_id',
                    ],
                ],
            );

            $select = array('post.id',
                            'post.title',
                            'post.keyword',
                            'post.keyword',
                            'post.author',
                            'post.image',
                            'post.idCategory',
                            'post.description',
                            'post.content',
                            'post.slug',
                            'post.time',
                            'post.view',
                            'PostProvinces.number_order',
                            'PostProvinces.province_id',
                            );

            $order = array('PostProvinces.number_order'=>'asc');

            $listData = $modelPostProvince->find()->join($join)->select($select)->where($conditions)->order($order)->all()->toList();
            

            return apiResponse(0, 'Lấy danh sách bài đăng thành công', $listData);
        }
        return apiResponse(2, 'bạn thiếu dữ liệu');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function getPostLisProvinceApi($input): array
{
    global $modelPosts;
    global $controller;
    global $isRequestPost;

    $modelPostProvince = $controller->loadModel('PostProvinces');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['id_province'])){
            $conditions = array('post.type'=>'post','pin'=>1,'post.idCategory'=>3);
            $conditions['PostProvinces.province_id'] = (int) $dataSend['id_province'];
            $join = array(
                [
                    'table' => 'posts',
                    'alias' => 'post',
                    'type' => 'LEFT',
                    'conditions' => [
                        'post.id = PostProvinces.post_id',
                    ],
                ],
            );

            $select = array('post.id',
                            'post.title',
                            'post.keyword',
                            'post.keyword',
                            'post.author',
                            'post.image',
                            'post.idCategory',
                            'post.description',
                            'post.content',
                            'post.slug',
                            'post.time',
                            'post.view',
                            'PostProvinces.number_order',
                            'PostProvinces.province_id',
                            );

            $order = array('PostProvinces.number_order'=>'asc');

            $listData = $modelPostProvince->find()->join($join)->select($select)->where($conditions)->order($order)->all()->toList();
            

            return apiResponse(0, 'Lấy danh sách bài đăng thành công', $listData);
        }
        return apiResponse(2, 'bạn thiếu dữ liệu');
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}


function getBannerListhomeApi($input): array
{
    global $modelPosts;

    $conditions = array('type'=>'post','pin'=>1,'idCategory'=>1);
    $limit = $_GET['limit'] ?? 10;
    $page = $_GET['page'] ?? 1;
    $order = array('number_order'=>'asc');

    $listData = $modelPosts->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    return apiResponse(0, 'Lấy danh sách bài đăng thành công', $listData);
}

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
