<?php 

function addMoneyTPBankApi($input): array
{
    global $transactionKey;
    global $isRequestPost;

    if ($isRequestPost) {
        if (!empty($_POST['message'])) {
            $keyApp = strtoupper($transactionKey);
            $message = strtoupper($_POST['message']);

            $description = explode('ND: ', $message);
            $description = trim($description[1]);
            $description = str_replace(array('IBFT ', 'THANH TOAN QR ', 'QR - '), '', $description);

            $money = explode('PS:+', $message);
            $money = explode('SD:', $money[1]);
            $money = (int)str_replace(array('.', 'VND'), '', $money[0]);

            if ($money > 0 && strlen(strstr($description, $keyApp)) > 0) {
                // xóa dấu chấm
                $removeDot = explode('.', $description);
                if (count($removeDot) > 1) {
                    for ($i = 0; $i < count($removeDot); $i++) {
                        if (strlen(strstr($removeDot[$i], $keyApp)) > 0) {
                            $description = $removeDot[$i];
                            break;
                        }
                    }
                }

                // xóa dấu chấm phẩy
                $removeDot = explode(';', $description);
                if (count($removeDot) > 1) {
                    for ($i = 0; $i < count($removeDot); $i++) {
                        if (strlen(strstr($removeDot[$i], $keyApp)) > 0) {
                            $description = $removeDot[$i];
                            break;
                        }
                    }
                }

                // xóa dấu gạch ngang
                $removeDot = explode('-', $description);
                if (count($removeDot) > 1) {
                    for ($i = 0; $i < count($removeDot); $i++) {
                        if (strlen(strstr($removeDot[$i], $keyApp)) > 0) {
                            $description = $removeDot[$i];
                            break;
                        }
                    }
                }


                $removeSpace = explode(' ', trim($description));
                $id_ransaction = $removeSpace[0];

                $mess = processAddMoney($money, $id_ransaction);

                return apiResponse(0, $mess);
            } else {
                return apiResponse(3, 'Sai cú pháp hoặc số tiền không đủ');
            }
        } else {
            return apiResponse(2, 'Gửi thiếu nội dung SMS');
        }
    }

    return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

function listTransactionApi($input)
{
    global $controller;
    global $metaTitleMantan;
    global $isRequestPost;

    $metaTitleMantan = 'Danh sách thách thức';
    $modelTransactions = $controller->loadModel('Transactions');

    if($isRequestPost){
        $dataSend = $input['request']->getData();   
         if(!empty($dataSend['token'])){
            $user = getUserByToken($dataSend['token']);
            $modelChallenge = $controller->loadModel('Challenges');
            $modelCourse = $controller->loadModel('Courses');
            $modelPackageWorkout = $controller->loadModel('PackageWorkouts');
            $modelPriceList = $controller->loadModel('PriceLists');
            if (!empty($user)) {
                $dataSend = $input['request']->getData();
                $conditions = array('id_user'=>$user->id);
                $limit = (!empty($dataSend['limit'])) ? (int)$dataSend['limit'] : 20;
                $page = (!empty($dataSend['page'])) ? (int)$dataSend['page'] : 1;
                if ($page < 1) $page = 1;
                if (!empty($dataSend['id']) && is_numeric($dataSend['id'])) {
                    $conditions['id'] = $dataSend['id'];

                }

                if (!empty($dataSend['title'])) {
                    $conditions['title LIKE'] = '%' . $dataSend['title'] . '%';
                }

                $condition = array('id_user'=> $user->id);

               
                
                $listData = $modelTransactions->find()->limit($limit)->page($page)->where($conditions)->order(['id' => 'desc'])->all()->toList();        

                if(!empty($listData)){
                    foreach($listData as $key => $item){
                        $listData[$key]->email = $user->email;


                        if($item->type==2){
                           $data =  $modelChallenge->find()->where(['id'=>$item->id_challenge])->first();
                           if(!empty($data)){
                                $listData[$key]->name_en = $data->title_en;
                                $listData[$key]->name = $data->title;
                            }
                        }elseif($item->type==1){
                            $data = $modelCourse->find()->where(['id'=>$item->id_course])->first();
                            if(!empty($data)){
                                $listData[$key]->name_en = $data->titleen;
                                $listData[$key]->name = $data->title;
                            }
                        }elseif($item->type==3){
                            $data = $modelPackageWorkout->find()->where(['id'=>$item->id_package])->first();
                            if(!empty($data)){
                                $listData[$key]->name_en = $data->title_en;
                                $listData[$key]->name = $data->title;
                            }
                        }elseif($item->type==4){
                           $data =  $modelPriceList->find()->where(['id'=>$item->id_price])->first();
                           if(!empty($data)){
                                $listData[$key]->name_en = $data->name_en;
                                $listData[$key]->name = $data->name;
                            }
                        }


                    }
                }
               
                $totalData = count($modelTransactions->find()->where($conditions)->all()->toList());
                    
                return apiResponse(0, 'lấy dữ liệu thành công', $listData, $totalData);
            }
             return apiResponse(3, 'Tài khoản không tồn tại hoặc chưa đăng nhập');
        } 
        return apiResponse(2, 'Gửi thiếu dữ liệu');  
    }
     return apiResponse(1, 'Bắt buộc sử dụng phương thức POST');
}

 ?>