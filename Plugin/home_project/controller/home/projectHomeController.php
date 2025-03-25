<?php 

function projectDetail($input)
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
    global $modelProduct;

    $metaTitleMantan = 'Chi tiết sản phẩm';

    $modelCommerce = $controller->loadModel('Commerce');
    $modelCommerceItems = $controller->loadModel('CommerceItems');
    $modelProductProjects = $controller->loadModel('ProductProjects');
    $order = array('id' => 'desc');

    if (!empty($_GET['id']) || !empty($input['request']->getAttribute('params')['pass'][1])) {
        if (!empty($_GET['id'])) {
            $conditions = array('id' => $_GET['id']);
        } else {
            $slug = str_replace('.html', '', $input['request']->getAttribute('params')['pass'][1]);
            $conditions = array('slug' => $slug);
        }
    }

    $conditions['status'] = 'active';

    $project = $modelProductProjects->find()->where($conditions)->first();

    if (!empty($project)) {
        $metaTitleMantan = $project->name;
        $metaImageMantan = $project->image;
        $metaDescriptionMantan = strip_tags($project->description);

        $project->images = json_decode($project->images, true);

        if (!empty($project->id_kind)) {
            $listKind = $modelCategories->find()
                ->where(['id' => $project->id_kind])
                ->first();
        } else {
            $listKind = null;
        }

        if (!empty($project->id_kind)) {
            $infoKind = $modelCategories->find()->where(['id' => $project->id_kind])->first();
            $project->infoKind = $infoKind;
        }

        if (!empty($project->id_apart_type)) {
            $listType = $modelCategories->find()
                ->where(['id' => $project->id_apart_type])
                ->first();
        } else {
            $listType = null;
        }
        if (!empty($project->id_apart_type)) {
            $infoType = $modelCategories->find()->where(['id' => $project->id_apart_type])->first();
            $project->infoType = $infoType;
        }

        $commerceData = $modelCommerce->find()->where(['id_product' => $project->id])->all()->toList();

        $allViews = [];

        if (!empty($project->view_id)) {
            $viewMain = new \stdClass();
            $viewMain->main_view_id = $project->view_id;
            $viewMain->view_type = 'main';
            $viewMain->id = $project->id;
            $viewMain->name = $project->name;
            $viewMain->investor = $project->investor;
            $viewMain->acreage = $project->acreage;
            $viewMain->infoType = $project->infoType;
            $viewMain->direction = $project->direction;
            $viewMain->address = $project->address;
            $viewMain->ownership_type = $project->ownership_type;
            $viewMain->preferential_policy = $project->preferential_policy;
            $viewMain->construction_density = $project->construction_density;
            $viewMain->construction_date = $project->construction_date;
            $viewMain->studio_apartment = $project->studio_apartment;
            $viewMain->key_amenities = $project->key_amenities;
            $viewMain->is_overview = true;
            $allViews[] = $viewMain;
        }

        if (!empty($commerceData)) {
            foreach ($commerceData as $commerce) {
                $commerce->items = $modelCommerceItems->find()->where(['id_detail' => $commerce->id])->all()->toList();
                $allViews[] = $commerce;
            }
        }

        usort($allViews, function($a, $b) {
            return $a->main_view_id <=> $b->main_view_id;
        });

        $listDataproduct_projects = $modelProductProjects->find()->limit(3)->order($order)->all()->toList();
        setVariable('listDataproduct_projects', $listDataproduct_projects);
        setVariable('project', $project);
        setVariable('listKind', $listKind);
        setVariable('listType', $listType);
        setVariable('allViews', $allViews);
        
        $view1 = [];
        $view2 = [];
        $view3 = [];
        $view4 = [];
        $view5 = [];
        $view6 = [];
        $view7 = [];
        $view8 = [];
        $viewMain = null;

        foreach ($allViews as $view) {
            if (isset($view->is_overview) && $view->is_overview) {
                $viewMain = $view;
            } elseif (isset($view->view_type)) {
                if ($view->view_type === 1) {
                    $view1[] = $view;
                } elseif ($view->view_type === 2) {
                    $view2[] = $view;
                } elseif ($view->view_type === 3) {
                    $view3[] = $view;
                } elseif ($view->view_type === 4) {
                    $view4[] = $view;
                } elseif ($view->view_type === 5) {
                    $view5[] = $view;
                } elseif ($view->view_type === 6) {
                    $view6[] = $view;
                } elseif ($view->view_type === 7) {
                    $view7[] = $view;
                } elseif ($view->view_type === 8) {
                    $view8[] = $view;
                }
            }
        }

        setVariable('view1', $view1);
        setVariable('view2', $view2);
        setVariable('view3', $view3);
        setVariable('view4', $view4);
        setVariable('view5', $view5);
        setVariable('view6', $view6);
        setVariable('view7', $view7);
        setVariable('view8', $view8);
        setVariable('viewMain', $viewMain);
    } else {
        return $controller->redirect('/');
    }
}