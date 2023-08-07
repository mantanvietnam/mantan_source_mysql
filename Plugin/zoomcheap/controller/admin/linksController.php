<?php 
function addLinkExcel($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Nhập dữ liệu link cố địn';

    $modelManagers = $controller->loadModel('Managers');
    $modelLinks = $controller->loadModel('Links');

    $mess = '';
    if($isRequestPost){
        $linkExcel = uploadAndReadExcelData('linkExcel');

        if($linkExcel){
            unset($linkExcel[0]);

            foreach ($linkExcel as $row) {
                $row[2] = str_replace(array(' ','.','-'), '', $row[2]);
                $row[2] = str_replace('+84','0',$row[2]);

                $checkPhone = $modelManagers->find()->where(array('phone'=>$row[2]))->first();

                if(!empty($checkPhone)){
                    // tạo link mới
                    $data = $modelLinks->newEmptyEntity();

                    $data->title = $row[0];
                    $data->code = $row[1];
                    $data->idManager = $checkPhone->id;
                    $data->goto = $row[4];
                    $data->idOrder = 0;
                    $data->modified = $row[3];
                    $data->created = $row[3];
                    
                    $modelLinks->save($data);
                }

            }

            $mess = 'Lưu dữ liệu thành công';
        }
    }

    setVariable('mess', $mess);
}