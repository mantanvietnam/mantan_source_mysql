<?php 
function saveKindAPI($input) {
    global $isRequestPost;
    global $controller;
    global $modelCategories;

    $return = array();

     
    if($isRequestPost){
        $dataSend = $input['request']->getData();
        $idCategoryEdit = isset($dataSend['idCategoryEdit']) ? (int) $dataSend['idCategoryEdit'] : 0;
        $name = trim($dataSend['name']);
        $image = isset($dataSend['image']) ? trim($dataSend['image']) : '';
        $keyword = isset($dataSend['keyword']) ? trim($dataSend['keyword']) : '';
        $description = isset($dataSend['description']) ? trim($dataSend['description']) : '';
        $parent = isset($dataSend['parent']) ? (int) $dataSend['parent'] : 0;
        $type = 'category_kind';

        if ($idCategoryEdit > 0) {
            // Cập nhật chuyên mục
            $category = $modelCategories->find()->where(['id' => $idCategoryEdit])->first();
            if ($category) {
                $category->name = $name;
                $category->image = $image;
                $category->keyword = $keyword;
                $category->description = $description;
                $category->parent = $parent;

                if ($modelCategories->save($category)) {
                    $return = array(
                        'success' => true,
                        'message' => 'Cập nhật chuyên mục thành công.',
                        'category' => array(
                            'id' => $category->id,
                            'name' => $category->name,
                            'image' => $category->image,
                            'keyword' => $category->keyword,
                            'description' => $category->description,
                            'parent' => $category->parent
                        )
                    );
                } else {
                    $return = array(
                        'success' => false,
                        'message' => 'Không thể cập nhật chuyên mục.'
                    );
                }
            } else {
                $return = array(
                    'success' => false,
                    'message' => 'Chuyên mục không tồn tại.'
                );
            }
        } else {
            // Thêm mới chuyên mục
            $newCategory = $modelCategories->newEmptyEntity();
            $newCategory->name = $name;
            $newCategory->image = $image;
            $newCategory->keyword = $keyword;
            $newCategory->description = $description;
            $newCategory->parent = $parent;
            $newCategory->type = $type;
            $newCategory->created_at = time();

            // Tạo slug duy nhất
            $slug = createSlugMantan($name);
            $slugNew = $slug;
            $number = 0;
            do {
                $conditions = array('slug' => $slugNew, 'type' => $type);
                $listData = $modelCategories->find()->where($conditions)->all()->toList();

                if (!empty($listData)) {
                    $number++;
                    $slugNew = $slug . '-' . $number;
                }
            } while (!empty($listData));

            $newCategory->slug = $slugNew;

            if ($modelCategories->save($newCategory)) {
                $return = array(
                    'success' => true,
                    'message' => 'Thêm chuyên mục mới thành công.',
                    'category' => array(
                        'id' => $newCategory->id,
                        'name' => $newCategory->name,
                        'image' => $newCategory->image,
                        'keyword' => $newCategory->keyword,
                        'description' => $newCategory->description,
                        'parent' => $newCategory->parent
                    )
                );
            } else {
                $return = array(
                    'success' => false,
                    'message' => 'Không thể lưu chuyên mục.'
                );
            }
        }
    } else {
        $return = array(
            'success' => false,
            'message' => 'Dữ liệu không hợp lệ.'
        );
    }

    return $return;
}
