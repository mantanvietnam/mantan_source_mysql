<?php 
function listChallenge($input)
{
    global $controller;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách thách thức';
    $modelChallenge = $controller->loadModel('Challenges');
    $modelFeedbackChallenge = $controller->loadModel('FeedbackChallenges');
    $modelResultChallenges = $controller->loadModel('ResultChallenges');
    $modelTipChallenges = $controller->loadModel('TipChallenges');

    $conditions = array();
    $limit = (!empty($_GET['limit'])) ? (int)$_GET['limit'] : 20;
    $page = (!empty($_GET['page'])) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;

    if (!empty($_GET['id']) && is_numeric($_GET['id'])) {
        $conditions['id'] = $_GET['id'];
    }

    if (!empty($_GET['title'])) {
        $conditions['title LIKE'] = '%' . $_GET['title'] . '%';
    }

    
    $listData = $modelChallenge->find()->limit($limit)->page($page)->where($conditions)->order(['id' => 'desc'])->all()->toList();
    if(!empty($listData)){
        foreach($listData as $key => $item){
            $listData[$key]->feedback = count($modelFeedbackChallenge->find()->where(['id_challenge'=>$item->id])->all()->toList());
            $listData[$key]->result = count($modelResultChallenges->find()->where(['id_challenge'=>$item->id])->all()->toList());
        }
    }
    
    $totalUser = $modelChallenge->find()->where($conditions)->all()->toList();
    $paginationMeta = createPaginationMetaData(count($totalUser),$limit,$page); 
        

    

    setVariable('page', $page);
    setVariable('totalPage', $paginationMeta['totalPage']);
    setVariable('back', $paginationMeta['back']);
    setVariable('next', $paginationMeta['next']);
    setVariable('urlPage', $paginationMeta['urlPage']);
    setVariable('listData', $listData);
}

function addChallenge($input){
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;


    $metaTitleMantan = 'Thông tin thách thức';
    
    $modelChallenge = $controller->loadModel('Challenges');
    $modelFeedbackChallenge = $controller->loadModel('FeedbackChallenges');
    $modelResultChallenges = $controller->loadModel('ResultChallenges');
    $modelUserChallenges = $controller->loadModel('UserChallenges');
    $modelTipChallenges = $controller->loadModel('TipChallenges');
    $modelcoach = $controller->loadModel('coach');
        $mess= '';
        // lấy data edit
        if(!empty($_GET['id'])){
            $data = $modelChallenge->get( (int) $_GET['id']);

        }else{
            $data = $modelChallenge->newEmptyEntity();
            $data->created_at = time();
        }


        if ($isRequestPost) {
            $dataSend = $input['request']->getData();

            

            if(!empty($dataSend['title'])){
                if(isset($_FILES['image']) && empty($_FILES['image']["error"])){
                    if(!empty($data->id)){
                        $fileName = 'image_product_'.$data->id;
                    }else{
                        $fileName = 'image_product_'.time().rand(0,1000000);
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

                 if(isset($_FILES['image_app']) && empty($_FILES['image_app']["error"])){
                    if(!empty($data->id)){
                        $fileName = 'image_app'.$data->id;
                    }else{
                        $fileName = 'image_app'.time().rand(0,1000000);
                    }

                    $image_app = uploadImage(1, 'image_app', $fileName);
                }

                if(!empty($image_app['linkOnline'])){
                    $data->image_app = $image_app['linkOnline'].'?time='.time();
                }else{
                    if(empty($data->image_app)){
                        $data->image_app = '';
                    }
                }


                // tạo dữ liệu save
                $data->title = @$dataSend['title'];
                $data->title_en = @$dataSend['title_en'];
                $data->id_coach =(int) @$dataSend['id_coach'];
                $data->status = @$dataSend['status'];
                $data->day =count($dataSend['tip']);
                $data->price =0;
                $data->price_trial =0;

                $data->time_trial =(int)  @$dataSend['time_trial'];
                $data->description = @$dataSend['description'];
                $data->description_en = @$dataSend['description_en'];

                $modelChallenge->save($data);


                    if(!empty($dataSend['title_reult'])){
                        $conditions = ['id_challenge'=>$data->id];
                        $modelResultChallenges->deleteAll($conditions);
                        foreach ($dataSend['title_reult'] as $key => $title_reult) {
                            $image = '';
                            if(!empty($title_reult)){
                                if(isset($_FILES['image_result'.$key]) && empty($_FILES['image_result'.$key]["error"])){
                                    if(!empty($data->id)){
                                        $fileName = 'image_result'.$key.'image_result'.$data->id;
                                    }else{
                                        $fileName = 'image_result'.$key.'image_result'.time().rand(0,1000000);
                                    }

                                    $images = uploadImage(1, 'image_result'.$key, $fileName);
                            

                                    if(!empty($images['linkOnline'])){
                                        $image= $images['linkOnline'].'?time='.time();
                                    }
                                }elseif(!empty($dataSend['image_result_cu'])){
                                    $image = $dataSend['image_result_cu'][$key];
                                }
                            
                                $info = $modelResultChallenges->newEmptyEntity();

                                $info->title = @$title_reult;
                                $info->image = $image;
                                $info->id_challenge = $data->id;
                                $info->description = @$dataSend['description_result'][$key];
                                $info->description_en = @$dataSend['description_result_en'][$key];
                                $info->title_en = @$dataSend['title_reult_en'][$key];
                                $info->slug = createSlugMantan(trim(@$title_info));
                                $modelResultChallenges->save($info);
                            }
                                
                        }
                    }else{
                        $conditions = ['id_challenge'=>$data->id];
                        $modelResultChallenges->deleteAll($conditions);
                    }


                    if(!empty($dataSend['full_name'])){
                        $conditions = ['id_challenge'=>$data->id];
                        $modelFeedbackChallenge->deleteAll($conditions);
                        foreach ($dataSend['full_name'] as $key => $full_name) {
                            $image = '';
                            if(!empty($full_name)){
                                if(isset($_FILES['image_feedback'.$key]) && empty($_FILES['image_feedback'.$key]["error"])){
                                    if(!empty($data->id)){
                                        $fileName = 'image_feedback'.$key.'image_feedback'.$data->id;
                                    }else{
                                        $fileName = 'image_feedback'.$key.'image_feedback'.time().rand(0,1000000);
                                    }

                                    $images = uploadImage(1, 'image_feedback'.$key, $fileName);
                            

                                    if(!empty($images['linkOnline'])){
                                        $image= $images['linkOnline'].'?time='.time();
                                    }
                                }elseif(!empty($dataSend['image_feedback_cu'])){
                                    $image = $dataSend['image_feedback_cu'][$key];
                                }
                            
                                $info = $modelFeedbackChallenge->newEmptyEntity();

                                $info->full_name = @$full_name;
                                $info->image = $image;
                                $info->id_challenge = $data->id;
                                $info->weight = (int) @$dataSend['weight'][$key];
                                $info->feedback = @$dataSend['feedback'][$key];
                                $info->feedback_en = @$dataSend['feedback_en'][$key];
                                $info->slug = createSlugMantan(trim(@$title_info));


                                $modelFeedbackChallenge->save($info);
                            }
                        }
                    }else{
                        $conditions = ['id_challenge'=>$data->id];
                        $modelFeedbackChallenge->deleteAll($conditions);
                    }
                    if(!empty($dataSend['tip'])){
                        foreach ($dataSend['tip'] as $key => $tip) {
                            if(!empty($tip)){
                               if(!empty($dataSend['id_tip'][$key])){
                                    $save = $modelTipChallenges->find()->where(['id'=>(int)$dataSend['id_tip'][$key], 'id_challenge'=>$data->id])->first();
                                }else{
                                    $save = $modelTipChallenges->newEmptyEntity();
                                }

                                $save->tip = @$tip;
                                $save->tip_en = @$dataSend['tip_en'][$key];
                                $save->id_challenge = $data->id;
                                $save->day = (int)$dataSend['day_number'][$key];


                                $modelTipChallenges->save($save);
                            }
                                
                        }
                    }else{
                        $conditions = ['id_challenge'=>$data->id];
                        $modelTipChallenges->deleteAll($conditions);
                    }

                    $listResult = $modelTipChallenges->find()->where(['id_challenge'=>$data->id])->all()->toList();
                    $lUserChallenges = $modelUserChallenges->find()->where(['id_challenge'=>$data->id])->all()->toList();

                    if(!empty($lUserChallenges)){
                        foreach($lUserChallenges as $key => $value){
                            $tip = json_decode($value->tip, true);
                            $listTip =[];
                            if(!empty($listResult)){
                                foreach($listResult as $key => $item){
                                    foreach($tip as $s){
                                        if($s['id'] == $item->id){
                                            $ss= $s;
                                        }
                                    }
                                    $status = '';
                                     if(!empty($ss)){
                                        $status = $ss['status'];
                                     }

                                    $listTip[] = array('id'=>$item->id,
                                        'tip'=>$item->tip,
                                        'tip_en'=>$item->tip_en,
                                        'status'=> $status,
                                    );
                                }
                            }
                            $value->tip = json_encode($listTip);
                            $modelUserChallenges->save($value);
                        }
                    }
                }
                


                $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';

        }
        $coach = $modelcoach->find()->where()->all()->toList();
        if(!empty($data->id)){
            $listFeedback = $modelFeedbackChallenge->find()->where(['id_challenge'=>$data->id])->all()->toList();
            $listResult = $modelResultChallenges->find()->where(['id_challenge'=>$data->id])->all()->toList();
            $listTip = $modelTipChallenges->find()->where(['id_challenge'=>$data->id])->all()->toList();

            setVariable('listFeedback', $listFeedback);
            setVariable('listResult', $listResult);
            setVariable('listTip', $listTip);
        }


        setVariable('mess', $mess);
        setVariable('data', $data);       
        setVariable('coach', $coach);       
    
}


function deleteChallenge(){
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;

    $metaTitleMantan = 'Thông tin thách thức';
    
    $modelChallenge = $controller->loadModel('Challenges');
    $modelFeedbackChallenge = $controller->loadModel('FeedbackChallenges');
    $modelResultChallenges = $controller->loadModel('ResultChallenges');


    if(!empty($_GET['id'])){
        $data = $modelChallenge->find()->where(['id'=>(int) $_GET['id']])->first();
        if($data){
            $conditions = ['id_challenge'=>$data->id];
            $modelFeedbackChallenge->deleteAll($conditions);
            $modelResultChallenges->deleteAll($conditions);

            $modelChallenge->delete($data);
        }
    }
    return $controller->redirect('/plugins/admin/colennao-view-admin-challenge-listChallenge');


}


?>