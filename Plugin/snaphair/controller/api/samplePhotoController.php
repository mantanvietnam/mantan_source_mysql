<?php
function listSampleCategoryApi($input)
{
    global $controller;
    global $modelCategories;
    global $metaTitleMantan;
    global $controller;
    global $session;
    global $isRequestPost;


    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['access_token'])) {
            if (function_exists('getUserByToken')) {
                $user = getUserByToken($dataSend['access_token']);
            }

            if (!empty($user)) {
                $conditions = [ 'type' => 'sample_category'];
                $limit = 20;
				$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
				if($page<1) $page = 1;
				$order = array('id'=>'desc');

                if (!empty($dataSend['id'])) {
                    $conditions['id'] = (int)$dataSend['id'];
                }
                if (!empty($dataSend['name'])) {
                    $conditions['name LIKE'] = '%' . $dataSend['name'] . '%';
                }

                $listData = $modelCategories->find()
                    ->limit($limit)
                    ->page($page)
                    ->where($conditions)
                    ->order($order)
                    ->all()
                    ->toList();

                $totalData = $modelCategories->find()->where($conditions)->count();
                $totalPage = ceil($totalData / $limit);

                return apiResponse(1, 'Lấy dữ liệu thành công', [
                    'data' => $listData,
                    'pagination' => [
                        'current_page' => $page,
                        'total_pages' => $totalPage,
                        'total_items' => $totalData,
                        'limit' => $limit
                    ]
                ]);
            }
            return apiResponse(3, 'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }
        return apiResponse(2, 'Thiếu dữ liệu bắt buộc: access_token');
    }
    return apiResponse(0, 'Yêu cầu không hợp lệ. Vui lòng sử dụng phương thức POST.');
}

function saveSampleCategoryApi($input)
{
    global $modelCategories;
    global $isRequestPost;

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['access_token'])) {
            if (function_exists('getUserByToken')) {
                $user = getUserByToken($dataSend['access_token']);
            }

            if (!empty($user)) {
                if (!empty($dataSend['id'])) {
                    $category = $modelCategories->find()->where(['id' => (int)$dataSend['id']])->first();

                    if ($category) {
                        $message = 'Cập nhật danh mục thành công';
                    } else {
                        return apiResponse(2, 'Không tìm thấy danh mục với ID đã cung cấp');
                    }
                } else {
                    $category = $modelCategories->newEmptyEntity();
                    $category->type = 'sample_category';
                    $message = 'Thêm danh mục mới thành công';
                }

                if (!empty($dataSend['name'])) {
                    $category->name = $dataSend['name'];

                    if (empty($dataSend['id']) || !empty($dataSend['update_slug'])) {
                        $slug = createSlugMantan($category->name);
                        $slugNew = $slug;
                        $number = 0;
                        
                        do {
                            $conditions = ['slug' => $slugNew, 'type' => 'sample_category'];
                            $listData = $modelCategories->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();
            
                            if (!empty($listData)) {
                                $number++;
                                $slugNew = $slug . '-' . $number;
                            }
                        } while (!empty($listData));
            
                        $category->slug = $slugNew;
                    }
                }

                $category->parent = 0;
                $category->image = NULL;
                $category->keyword = NULL;
                $category->description =NULL;

                if ($modelCategories->save($category)) {
                    return apiResponse(1, $message, ['id' => $category->id]);
                }
                return apiResponse(3, 'Lỗi khi lưu dữ liệu vào cơ sở dữ liệu');
            }
            return apiResponse(4, 'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }
        return apiResponse(5, 'Thiếu dữ liệu bắt buộc: access_token');
    }
    return apiResponse(0, 'Yêu cầu không hợp lệ. Vui lòng sử dụng phương thức POST.');
}

function deleteSampleCategoryApi($input)
{
    global $modelCategories;
    global $isRequestPost;

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['access_token']) && !empty($dataSend['id'])) {
            if (function_exists('getUserByToken')) {
                $user = getUserByToken($dataSend['access_token']);
            }

            if (!empty($user)) {
                $category = $modelCategories->find()->where(['id' => (int)$dataSend['id']])->first();

                if ($category) {
                    if ($modelCategories->delete($category)) {
                        return apiResponse(1, 'Xóa danh mục thành công', ['id' => $dataSend['id']]);
                    } else {
                        return apiResponse(3, 'Lỗi khi xóa danh mục');
                    }
                } else {
                    return apiResponse(2, 'Không tìm thấy danh mục với ID đã cung cấp');
                }
            }
            return apiResponse(4, 'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }
        return apiResponse(5, 'Thiếu dữ liệu bắt buộc: access_token hoặc id');
    }
    return apiResponse(0, 'Yêu cầu không hợp lệ. Vui lòng sử dụng phương thức POST.');
}

function listSamplePhotoApi($input)
{
    global $controller;
    global $modelCategories;
    global $isRequestPost;

    $modelSamplePhoto = $controller->loadModel('SamplePhoto');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['access_token'])) {
            if (function_exists('getUserByToken')) {
                $user = getUserByToken($dataSend['access_token']);
            }

            if (!empty($user)) {
                $conditions = [];
                $limit = !empty($dataSend['limit']) ? (int)$dataSend['limit'] : 20;
                $page = !empty($dataSend['page']) ? (int)$dataSend['page'] : 1;
                $page = max(1, $page);
                $order = ['id' => 'desc'];

                if (!empty($dataSend['id'])) {
                    $conditions['id'] = (int)$dataSend['id'];
                }
                if (!empty($dataSend['name_cate'])) {
                    $category = $modelCategories->find()
                        ->where(['name LIKE' => '%' . $dataSend['name_cate'] . '%'])
                        ->first();

                    if ($category) {
                        $conditions['id_sample_cate'] = $category->id;
                    } else {
                        return apiResponse(2, 'Không tìm thấy danh mục với tên đã cung cấp');
                    }
                }
                if (!empty($dataSend['name'])) {
                    $conditions['name LIKE'] = '%' . $dataSend['name'] . '%';
                }
                if (!empty($dataSend['color'])) {
                    $conditions['color LIKE'] = '%' . $dataSend['color'] . '%';
                }
                if (isset($dataSend['sex'])) {
                    $conditions['sex'] = $dataSend['sex'];
                }

                $listData = $modelSamplePhoto->find()
                    ->limit($limit)
                    ->page($page)
                    ->where($conditions)
                    ->order($order)
                    ->all()
                    ->toList();

                foreach ($listData as &$item) {
                    if (!empty($item['id_sample_cate'])) {
                        $category = $modelCategories->find()
                            ->where(['id' => $item['id_sample_cate']])
                            ->first();
                        $item['name_cate'] = $category ? $category->name : null;
                    } else {
                        $item['name_cate'] = null;
                    }
                }

                $totalData = $modelSamplePhoto->find()->where($conditions)->count();
                $totalPage = ceil($totalData / $limit);

                return apiResponse(1, 'Lấy danh sách ảnh mẫu thành công', [
                    'data' => $listData,
                    'pagination' => [
                        'current_page' => $page,
                        'total_pages' => $totalPage,
                        'total_items' => $totalData,
                        'limit' => $limit
                    ]
                ]);
            }
            return apiResponse(4, 'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }
        return apiResponse(5, 'Thiếu access_token');
    }
    return apiResponse(0, 'Yêu cầu không hợp lệ. Vui lòng sử dụng phương thức POST.');
}

function saveSamplePhotoApi($input)
{
    global $controller;
    global $modelCategories;
    global $isRequestPost;

    $modelSamplePhoto = $controller->loadModel('SamplePhoto');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();
        if (!empty($dataSend['access_token'])) {
            if (function_exists('getUserByToken')) {
                $user = getUserByToken($dataSend['access_token']);
            }

            if (!empty($user)) {
                if (!empty($dataSend['name']) && !empty($dataSend['image'])) {
                    $data = [];

                    if (!empty($dataSend['id'])) {
                        $data = $modelSamplePhoto->get((int)$dataSend['id']);
                        if (empty($data)) {
                            return apiResponse(6, 'Không tìm thấy ảnh mẫu cần sửa');
                        }
                    } else {
                        $data = $modelSamplePhoto->newEmptyEntity();
                    }

                    $data->name = $dataSend['name'];
                    $data->image = $dataSend['image'];
                    $data->color = !empty($dataSend['color']) ? $dataSend['color'] : null;
                    $data->sex = isset($dataSend['sex']) ? $dataSend['sex'] : null;
                    $data->id_sample_cate = $dataSend['id_sample_cate'] ?? 0;
                    $slug = createSlugMantan($data->name);
                    $slugNew = $slug;
                    $number = 0;
                    do{
                        $conditions = array('slug'=>$slugNew);
                        $listData = $modelSamplePhoto->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();
        
                        if(!empty($listData)){
                            $number++;
                            $slugNew = $slug.'-'.$number;
                        }
                    }while (!empty($listData));
        
                    $data->slug = $slugNew;
                   
                    if ($modelSamplePhoto->save($data)) {
                        $message = !empty($dataSend['id']) ? 'Cập nhật ảnh mẫu thành công' : 'Thêm ảnh mẫu mới thành công';
                        return apiResponse(1, $message, ['id' => $data->id]);
                    } else {
                        return apiResponse(3, 'Lưu dữ liệu không thành công. Vui lòng thử lại.');
                    }
                } else {
                    return apiResponse(2, 'Thiếu dữ liệu bắt buộc (name hoặc image_url)');
                }
            }
            return apiResponse(4, 'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }
        return apiResponse(5, 'Thiếu access_token');
    }
    return apiResponse(0, 'Yêu cầu không hợp lệ. Vui lòng sử dụng phương thức POST.');
}

function deleteSamplePhotoApi($input)
{
    global $controller;
    global $isRequestPost;

    $modelSamplePhoto = $controller->loadModel('SamplePhoto');

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if (!empty($dataSend['access_token'])) {
            if (function_exists('getUserByToken')) {
                $user = getUserByToken($dataSend['access_token']);
            }

            if (!empty($user)) {
                if (!empty($dataSend['id'])) {
                    $photo = $modelSamplePhoto->find()->where(['id' => (int)$dataSend['id']])->first();

                    if ($photo) {
                        if ($modelSamplePhoto->delete($photo)) {
                            return apiResponse(1, 'Xóa ảnh mẫu thành công', ['id' => $dataSend['id']]);
                        } else {
                            return apiResponse(3, 'Lỗi khi xóa ảnh mẫu');
                        }
                    } else {
                        return apiResponse(2, 'Không tìm thấy ảnh mẫu với ID đã cung cấp');
                    }
                } else {
                    return apiResponse(6, 'Thiếu ID của ảnh mẫu cần xóa');
                }
            }
            return apiResponse(4, 'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }
        return apiResponse(5, 'Thiếu access_token');
    }
    return apiResponse(0, 'Yêu cầu không hợp lệ. Vui lòng sử dụng phương thức POST.');
}

