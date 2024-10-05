<?php 
function listPriceList($input){
    global $isRequestPost;
    global $modelCategories;
    global $metaTitleMantan;
    global $controller;
    global $session;

    $metaTitleMantan = 'Cài đặt bản giá ';

    $modelPriceList = $controller->loadModel('PriceLists');
    
        if ($isRequestPost) {
            $dataSend = $input['request']->getData();
            
            // tính ID category
            if(!empty($dataSend['id'])){
                $data = $modelPriceList->find()->where(['id'=>(int) $dataSend['id']])->first();

                if(empty($data)){
                    $data = $modelPriceList->newEmptyEntity();
                }
            }else{
                $data = $modelPriceList->newEmptyEntity();
            }

            // tạo dữ liệu save
            $data->name = str_replace(array('"', "'"), '’', $dataSend['name']);
            $data->name_en = str_replace(array('"', "'"), '’', $dataSend['name_en']);
            $data->status = $dataSend['status'];
            $data->price = (int) $dataSend['price'];
            $data->price_old = (int) $dataSend['price_old'];
            $data->days = (int) $dataSend['days'];
            

            $modelPriceList->save($data);

        }

        $conditions = array();
        $listData = $modelPriceList->find()->where($conditions)->all()->toList();

        setVariable('listData', $listData);
    
}

function deletePriceList($input){
    global $controller;
    global $session;
    global $modelPriceList;
    $modelPriceList = $controller->loadModel('PriceLists');
    if(!empty($_GET['id'])){
        $data = $modelPriceList->get($_GET['id']);            
        if($data){
            //$data->status = 'lock';
            $modelPriceList->delete($data);
        }

    }
    // return $controller->redirect('/listProductAgency');
}

 ?>