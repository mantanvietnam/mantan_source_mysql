<?php 
function categoryProject($input)
{
    global $controller;
    global $isRequestPost;
    global $modelOptions;
    global $modelCategories;
    global $urlCurrent;
    global $metaTitleMantan;
    global $metaKeywordsMantan;
    global $metaDescriptionMantan;
    global $metaImageMantan;

    $metaTitleMantan = 'Danh mục dự án';

    $modelProductProjects = $controller->loadModel('ProductProjects');
    $modelProduct = $controller->loadModel('Products');

    if(!empty($_GET['id']) || !empty($input['request']->getAttribute('params')['pass'][1])){
        if(!empty($_GET['id'])){
            $conditions = array('id'=>$_GET['id']);
        }else{
            $slug= str_replace('.html', '', $input['request']->getAttribute('params')['pass'][1]);
            $conditions = array('slug'=>$slug, 'type' => 'category_kind');
        }
        
        $category = $modelCategories->find()->where($conditions)->first();

        if(!empty($category)){
            $metaTitleMantan = $category->name;
            $metaImageMantan = $category->image;
            $metaKeywordsMantan = $category->keyword;
            $metaDescriptionMantan = $category->description;
            

            $conditions = array('id_kind'=>$category->id);
            $limit = 20;
            $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
            if($page<1) $page = 1;
            $order = array('id'=>'desc');
            
            $list_project = $modelProductProjects->find()->where($conditions)->order($order)->all()->toList();

            if(!empty($list_project)){
                foreach ($list_project as $key => $value) {
                    $list_project[$key]->infoProduct = [];

                    if(!empty($value->id_product)){
                        $id_products = explode(',', $value->id_product);
                        foreach ($id_products as $id_product) {
                            $list_project[$key]->infoProduct[] = $modelProduct->find()->where(['id'=>(int) $id_product])->first();
                        }
                    }
                }
            }
            // phân trang
            $totalData = $modelProductProjects->find()->where($conditions)->all()->toList();
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

            setVariable('page', $page);
            setVariable('totalPage', $totalPage);
            setVariable('back', $back);
            setVariable('next', $next);
            setVariable('urlPage', $urlPage);
            setVariable('totalData', $totalData);
            
            setVariable('category', $category);
            setVariable('list_project', $list_project);
        }else{
            return $controller->redirect('/');
        }
    }else{
        return $controller->redirect('/');
    }
}

?>