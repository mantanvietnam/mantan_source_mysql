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
                        return apiResponse(3, 'Không tìm thấy danh mục với ID đã cung cấp');
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
                return apiResponse(4, 'Lỗi khi lưu dữ liệu vào cơ sở dữ liệu');
            }
            return apiResponse(5, 'Tài khoản không tồn tại hoặc chưa đăng nhập');
        }
        return apiResponse(6, 'Thiếu dữ liệu bắt buộc: access_token');
    }
    return apiResponse(0, 'Yêu cầu không hợp lệ. Vui lòng sử dụng phương thức POST.');
}


