<?php 
function listArea($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;
    global $modelCategoryConnects;

    $modelAreas = $controller->loadModel('Areas');

        $metaTitleMantan = 'Khu vực tập';
        $mess = '';

        if ($isRequestPost) {
            $dataSend = $input['request']->getData();
            
            // tính ID category
            if(!empty($dataSend['idCategoryEdit'])){
                $data = $modelAreas->get( (int) $dataSend['idCategoryEdit']);
            }else{
                $data = $modelAreas->newEmptyEntity();
                $data->created_at = time();
            }

            if(isset($_FILES['image']) && empty($_FILES['image']["error"])){
            	if(!empty($data->id)){
            		$fileName = 'image__workout'.$data->id;
            	}else{
            		$fileName = 'image__workout'.time().rand(0,1000000);
            	}

            	$image = uploadImage(1, 'image', $fileName);
            }
           

            if(!empty($image['linkOnline'])){
            	$data->image = $image['linkOnline'].'?time='.time();
            }else{
            	if(empty($data->image)){
            		$data->image = '';
            	}
            }
            if(!empty($dataSend['name']) && !empty($dataSend['name_en'])){
                $data->name = str_replace(array('"', "'"), '’', $dataSend['name']);
                $data->description = $dataSend['description'];
                $data->name_en = str_replace(array('"', "'"), '’', $dataSend['name_en']);
                $data->description_en = $dataSend['description_en'];
                $modelAreas->save($data);
                  return $controller->redirect('/plugins/admin/colennao-view-admin-area-listArea');
            }else{
                $mess = '<p class="text-danger">Bạn thiếu dữ liệu</p>';
            }
        }

        $conditions = array();
        $listData = $modelAreas->find()->where($conditions)->order(['id'=>'desc'])->all()->toList();
       
        setVariable('listData', $listData);
        setVariable('mess', $mess);
}

function deleteArea(){
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;

    $metaTitleMantan = 'Thông tin thách thức';
    
    $modelAreas = $controller->loadModel('Areas');


    if(!empty($_GET['id'])){
        $data = $modelAreas->find()->where(['id'=>(int) $_GET['id']])->first();
        if($data){

            $modelAreas->delete($data);
        }
    }
    return $controller->redirect('/plugins/admin/colennao-view-admin-area-listArea');


}
 ?>