<?php	

 function listNewsAdmin($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $controller;
    global $urlCurrent;

    $metaTitleMantan = 'Danh sách tin tức';

    $modelPosts = $controller->loadModel('Posts');

    $conditions = array('type'=>'post');
    $limit = 20;
    $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
    if($page<1) $page = 1;

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }

    if(!empty($_GET['title'])){
        $conditions['title LIKE'] = '%'.$_GET['title'].'%';
    }

    if(!empty($_GET['idCategory'])){
        $conditions['idCategory'] = (int) $_GET['idCategory'];
    }

    $listData = $modelPosts->find()->limit($limit)->page($page)->where($conditions)->order(['id' => 'DESC'])->all()->toList();

    $totalData = $modelPosts->find()->where($conditions)->all()->toList();
    $totalData = count($totalData);

    $balance = $totalData % $limit;
    $totalPage = ($totalData - $balance) / $limit;
    if ($balance > 0)
        $totalPage+=1;

    $back = $page - 1;
    $next = $page + 1;
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

    // lấy danh sách danh mục
    $conditions = array('type' => 'post');
    $listCategory = $modelCategories->find()->where($conditions)->order(['parent'=>'asc', 'id'=>'asc'])->all()->toList();

    $categories = [];
    if(!empty($listCategory)){
        foreach ($listCategory as $key => $value) {
            if($value->parent == 0){
                $categories[$value->id]['name'] = $value->name;
            }else{
                foreach ($categories as $key1 => $value1) {
                    if($key1 == $value->parent){
                        $categories[$key1]['sub'][$value->id]['name'] = $value->name;
                    }elseif(!empty($categories[$key1]['sub'])){
                        foreach ($categories[$key1]['sub'] as $key2 => $value2) {
                            if($key2 == $value->parent){
                                $categories[$key1]['sub'][$key2]['sub'][$value->id]['name'] = $value->name;
                            }elseif(!empty($categories[$key1]['sub'][$key2]['sub'])){
                                foreach ($categories[$key1]['sub'][$key2]['sub'] as $key3 => $value3) {
                                    if($key3 == $value->parent){
                                        $categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$value->id]['name'] = $value->name;
                                    }elseif(!empty($categories[$key1]['sub'][$key2]['sub'][$key3]['sub'])){
                                        foreach ($categories[$key1]['sub'][$key2]['sub'][$key3]['sub'] as $key4 => $value4) {
                                            if($key4 == $value->parent){
                                                $categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$key4]['sub'][$value->id]['name'] = $value->name;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    setVariable('page', $page);
    setVariable('totalPage', $totalPage);
    setVariable('back', $back);
    setVariable('next', $next);
    setVariable('urlPage', $urlPage);

    setVariable('listData', $listData);
    setVariable('listCategory', $categories);
}

function addNewsAdmin($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $controller;
    global $urlCurrent;

    $metaTitleMantan = 'Tin tức';

    $modelPosts = $controller->loadModel('Posts');
    $modelSlugs = $controller->loadModel('Slugs');
    $modelCategoryConnects = $controller->loadModel('CategoryConnects');
    $modelProductProjects = $controller->loadModel('ProductProjects');
    
    $mess = '';

    // lấy data edit
    if(!empty($_GET['id'])){
        $infoPost = $modelPosts->find()->where(['id'=>(int) $_GET['id']])->first();

        if(!empty($infoPost)){
            $categories = $modelCategoryConnects->find()->where(['keyword'=>'post', 'id_parent'=>(int) $_GET['id']])->all()->toList();
            $infoPost->categories = [];

            if(!empty($categories)){
                foreach ($categories as $key => $value) {
                    $infoPost->categories[] = $value->id_category;
                }
            }

            $projects = $modelCategoryConnects->find()->where([
                'keyword' => 'post_project',
                'id_parent' => (int)$_GET['id']
            ])->all()->toList();
    
            $infoPost->id_product = [];
            if (!empty($projects)) {
                foreach ($projects as $project) {
                    $infoPost->id_product[] = $project->id_category;
                }
            }
        }
    }else{
        $infoPost = $modelPosts->newEmptyEntity();
    }

    if ($isRequestPost) {
        $dataSend = $input['request']->getData();

        if(!empty($dataSend['title'])){
            // xử lý thời gian đăng
            $today= getdate();
            $datePost = explode('/', $dataSend['date']);
            
            if(!empty($datePost))
            {
                $time= mktime($today['hours'], $today['minutes'], $today['seconds'], $datePost[1], $datePost[0], $datePost[2]);
            }

            if(empty($dataSend['idCategory'])){
                $dataSend['idCategory'] = [];
            }

            // tạo dữ liệu save
            $infoPost->title = str_replace(array('"', "'"), '’', $dataSend['title']);
            $infoPost->author = $dataSend['author'];
            $infoPost->pin = (int) $dataSend['pin'];
            $infoPost->time = $time;
            $infoPost->image = $dataSend['image'];
            $infoPost->idCategory = (int) @$dataSend['idCategory'][0];
            $infoPost->keyword = $dataSend['keyword'];
            $infoPost->description = $dataSend['description'];
            $infoPost->content = $dataSend['content'];
            $infoPost->type = 'post';

            // tạo slug
            $slug = createSlugMantan($infoPost->title);
            $slugNew = $slug;
            $number = 0;

            $checkSlug = $modelSlugs->find()->where(['slug'=>$slugNew])->first();

            if(empty($infoPost->slug) || $infoPost->slug!=$slugNew || empty($checkSlug) ){
                do{
                    $conditions = array('slug'=>$slugNew);
                    $listData = $modelSlugs->find()->where($conditions)->order(['id' => 'DESC'])->all()->toList();

                    if(!empty($listData)){
                        $number++;
                        $slugNew = $slug.'-'.$number;
                    }
                }while (!empty($listData));
            
                // lưu url slug
                saveSlugURL($slugNew, 'homes', 'info_page');
                
                if(!empty($infoPost->slug)){
                    deleteSlugURL($infoPost->slug);
                }
            }
            
            $infoPost->slug = $slugNew;

            $modelPosts->save($infoPost);

            // tạo dữ liệu bảng chuyên mục
            $modelCategoryConnects->deleteAll(['id_parent'=>$infoPost->id, 'keyword'=>'post']);

            if(!empty($dataSend['idCategory'])){
                foreach ($dataSend['idCategory'] as $idCategory) {
                    $categoryConnects = $modelCategoryConnects->newEmptyEntity();

                    $categoryConnects->keyword = 'post';
                    $categoryConnects->id_parent = $infoPost->id;
                    $categoryConnects->id_category = $idCategory;

                    $modelCategoryConnects->save($categoryConnects);
                }
            }

            //tạo dữ liệu cho bảng dự án 
            $modelCategoryConnects->deleteAll(['id_parent'=>$infoPost->id, 'keyword'=>'post_project']);

            if (!empty($dataSend['id_product'])) {
                foreach ($dataSend['id_product'] as $id_product) {
                    $categoryConnects = $modelCategoryConnects->newEmptyEntity();
            
                    $categoryConnects->keyword = 'post_project';
                    $categoryConnects->id_parent = $infoPost->id;
                    $categoryConnects->id_category = $id_product;
            
                    $modelCategoryConnects->save($categoryConnects);
                }
            }

            $infoPost->categories = $dataSend['idCategory'];

            $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
        }else{
            $mess= '<p class="text-danger">Nhập thiếu dữ liệu</p>';
        }
    }

    // lấy danh sách danh mục
    $conditions = array('type' => 'post');
    $listCategory = $modelCategories->find()->where($conditions)->order(['parent'=>'asc', 'id'=>'asc'])->all()->toList();

    //lấy danh sách dự án
    $listProjects = $modelProductProjects->find()->all()->toList();

    $categories = [];
    if(!empty($listCategory)){
        foreach ($listCategory as $key => $value) {
            if($value->parent == 0){
                $categories[$value->id]['name'] = $value->name;
            }else{
                foreach ($categories as $key1 => $value1) {
                    if($key1 == $value->parent){
                        $categories[$key1]['sub'][$value->id]['name'] = $value->name;
                    }elseif(!empty($categories[$key1]['sub'])){
                        foreach ($categories[$key1]['sub'] as $key2 => $value2) {
                            if($key2 == $value->parent){
                                $categories[$key1]['sub'][$key2]['sub'][$value->id]['name'] = $value->name;
                            }elseif(!empty($categories[$key1]['sub'][$key2]['sub'])){
                                foreach ($categories[$key1]['sub'][$key2]['sub'] as $key3 => $value3) {
                                    if($key3 == $value->parent){
                                        $categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$value->id]['name'] = $value->name;
                                    }elseif(!empty($categories[$key1]['sub'][$key2]['sub'][$key3]['sub'])){
                                        foreach ($categories[$key1]['sub'][$key2]['sub'][$key3]['sub'] as $key4 => $value4) {
                                            if($key4 == $value->parent){
                                                $categories[$key1]['sub'][$key2]['sub'][$key3]['sub'][$key4]['sub'][$value->id]['name'] = $value->name;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    setVariable('infoPost', $infoPost);
    setVariable('mess', $mess);
    setVariable('listCategory', $categories);
    setVariable('listProjects', $listProjects);
}

function deleteNewsAdmin($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $controller;
    global $urlCurrent;

    $metaTitleMantan = 'Tin tức';

    $modelPosts = $controller->loadModel('Posts');
    
    if(!empty($_GET['id'])){
        $data = $modelPosts->get($_GET['id']);
        
        if($data){
             $modelPosts->delete($data);
             
             deleteSlugURL($data->slug);

             return $controller->redirect('/plugins/admin/home_project-view-admin-news-listNewsAdmin');
        }
    }

    return $controller->redirect('/admins');
}