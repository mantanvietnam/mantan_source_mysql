<?php 
function listDevice($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;
    global $modelCategoryConnects;

    $modelDevices = $controller->loadModel('Devices');

        $metaTitleMantan = 'Thiết bị';

        if ($isRequestPost) {
            $dataSend = $input['request']->getData();
            
            // tính ID category
            if(!empty($dataSend['idCategoryEdit'])){
                $data = $modelDevices->get( (int) $dataSend['idCategoryEdit']);
            }else{
                $data = $modelDevices->newEmptyEntity();
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
            $data->name = str_replace(array('"', "'"), '’', $dataSend['name']);
            $data->link = $dataSend['link'];
            $data->description = $dataSend['description'];




            $modelDevices->save($data);
             return $controller->redirect('/plugins/admin/colennao-view-admin-device-listDevice');

        }

        $conditions = array();
        $listData = $modelDevices->find()->where($conditions)->order(['id'=>'desc'])->all()->toList();

       
        setVariable('listData', $listData);
    
}

function deleteDevice(){
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;

    $metaTitleMantan = 'Thông tin thách thức';
    
    $modelDevices = $controller->loadModel('Devices');


    if(!empty($_GET['id'])){
        $data = $modelDevices->find()->where(['id'=>(int) $_GET['id']])->first();
        if($data){

            $modelDevices->delete($data);
        }
    }
    return $controller->redirect('/plugins/admin/colennao-view-admin-device-listDevice');


}
 ?>