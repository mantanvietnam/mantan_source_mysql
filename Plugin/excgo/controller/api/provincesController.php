<?php

function getListProvinceApi($input): array
{
    global $controller;
    global $isRequestPost;

    $modelProvinces = $controller->loadModel('Provinces');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        $limit = (!empty($dataSend['limit'])) ? $dataSend['limit'] : 20;
        $page = (!empty($dataSend['page'])) ? $dataSend['page'] : 1;
        $conditions = ['status' => 1];
        if ($page < 1) $page = 1;

        if (!empty($dataSend['name'])) {
            $conditions['name LIKE'] = '%' . $dataSend['name'] . '%';
        }

        if (!empty($dataSend['bsx'])) {
            $conditions['bsx LIKE'] = '%' . $dataSend['bsx'] . '%';
        }

        if (!empty($dataSend['parent_id'])) {
            $conditions['parent_id'] = $dataSend['parent_id'];
        } else {
            $conditions['parent_id'] = 0;
        }

        if (!isset($dataSend['access_token'])) {
            $listProvince = $modelProvinces->find()
                ->where($conditions)
                ->limit($limit)
                ->page($page)
                ->order([
                    'id' => 'ASC'
                ])->all()
                ->toList();

            $totalProvince = $modelProvinces->find()
                ->where($conditions)
                ->all()
                ->toList();
            $paginationMeta = createPaginationMetaData(
                count($totalProvince),
                $limit,
                $page
            );

            return apiResponse(0, 'Lấy danh sách tỉnh thành công', $listProvince, $paginationMeta);
        } else {
            $currentUser = getUserByToken($dataSend['access_token']);

            if (empty($currentUser)) {
                return apiResponse(3, 'Tài khoản không tồn tại hoặc sai mã token');
            }

            $query = $modelProvinces->find();
            $listProvince = $modelProvinces->find()
                ->join([
                    'table' => 'pinned_provinces',
                    'alias' => 'PinnedProvinces',
                    'type' => 'LEFT',
                    'conditions' => [
                        'PinnedProvinces.province_id = Provinces.id',
                        'PinnedProvinces.user_id' => $currentUser->id
                    ],
                ])->select([
                    'Provinces.id',
                    'Provinces.name',
                    'Provinces.bsx',
                    'Provinces.gps',
                    'Provinces.status',
                    'is_pinned' => $query->newExpr()
                        ->case()
                        ->when($query->newExpr()->add(['PinnedProvinces.id IS NOT NULL']))
                        ->then(1)
                        ->else(0)
                ])->where($conditions)
                ->limit($limit)
                ->page($page)
                ->order([
                    'PinnedProvinces.id IS NULL' => 'ASC', // Tỉnh nào được ghim sẽ sắp xếp lên trước
                    'PinnedProvinces.created_at' => 'DESC', // Tỉnh nào được ghim gần nhất xếp lên trước
                    'Provinces.name' => 'ASC' // Các tỉnh còn lại sắp xếp theo tên
                ])->all()
                ->toList();

            $totalProvince = $modelProvinces->find()
                ->where($conditions)
                ->all()
                ->toList();
            $paginationMeta = createPaginationMetaData(
                count($totalProvince),
                $limit,
                $page
            );

            return apiResponse(0, 'Lấy danh sách tỉnh thành công', $listProvince, $paginationMeta);
        }
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}
