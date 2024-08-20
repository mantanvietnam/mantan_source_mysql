<?php
function listCampaign($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    if(!empty($session->read('infoUser'))){
        $metaTitleMantan = 'Danh sách chiến dịch sự kiện';

        $modelCampaigns = $controller->loadModel('Campaigns');
        $modelCampaignCustomers = $controller->loadModel('CampaignCustomers');

        $conditions = array('id_member'=>$session->read('infoUser')->id);
        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        $order = array('id'=>'desc');

        if(!empty($_GET['id'])){
            $conditions['id'] = (int) $_GET['id'];
        }

        if(!empty($_GET['name'])){
            $conditions['name LIKE'] = '%'.$_GET['name'].'%';
        }

        $listData = $modelCampaigns->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();
        
        foreach ($listData as $key => $value) {
            $customer_reg = $modelCampaignCustomers->find()->where(['id_campaign'=>$value->id, 'id_member'=>$session->read('infoUser')->id])->all()->toList();
            $customer_checkin = $modelCampaignCustomers->find()->where(['id_campaign'=>$value->id, 'id_member'=>$session->read('infoUser')->id, 'time_checkin >'=>0])->all()->toList();
            $yet_checkin = $modelCampaignCustomers->find()->where(['id_campaign'=>$value->id, 'id_member'=>$session->read('infoUser')->id, 'time_checkin'=>0])->all()->toList();

            $listData[$key]->number_reg = count($customer_reg);
            $listData[$key]->number_checkin = count($customer_checkin);
            $listData[$key]->yet_checkin = count($yet_checkin);
        }

        // phân trang
        $totalData = $modelCampaigns->find()->where($conditions)->all()->toList();
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
        
        setVariable('listData', $listData);
    }else{
        return $controller->redirect('/login');
    }
}

function addCampaign($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;
    global $urlHomes;

    if(!empty($session->read('infoUser'))){
        $metaTitleMantan = 'Thông tin chiến dịch sự kiện';

        $modelCampaigns = $controller->loadModel('Campaigns');

        $mess= '';

        // lấy data edit
        if(!empty($_GET['id'])){
            $data = $modelCampaigns->get( (int) $_GET['id']);
        }else{
            $data = $modelCampaigns->newEmptyEntity();

            $data->create_at = time();
            $data->location = '[]';
            $data->team = '[]';
            $data->ticket = '[]';
        }

        if ($isRequestPost) {
            $dataSend = $input['request']->getData();

            if(!empty($dataSend['name'])){
                $img_background = $urlHomes.'/plugins/campaign_event/view/home/image/background.gif';
                if(!empty($dataSend['img_background'])){
                    $img_background = $dataSend['img_background'];
                }

                $img_logo = '';
                if(!empty($dataSend['img_logo'])){
                    $img_logo = $dataSend['img_logo'];
                }

                if(empty($img_logo)){
                    $system = $modelCategories->find()->where(['id'=>(int) $session->read('infoUser')->id_system])->first();

                    if(!empty($system->image)){
                        $img_logo = $system->image;
                    }else{
                        $img_logo = $urlHomes.'/plugins/campaign_event/view/home/image/logo-phoenix.png';
                    }
                }

                $image = '';
                if(!empty($dataSend['image'])){
                    $image = $dataSend['image'];
                }

                if(empty($image)){
                    $system = $modelCategories->find()->where(['id'=>(int) $session->read('infoUser')->id_system])->first();

                    if(!empty($system->image)){
                        $image = $system->image;
                    }else{
                        $image = $urlHomes.'/plugins/campaign_event/view/home/image/logo-phoenix.png';
                    }
                }

                // tạo dữ liệu save
                $data->name = $dataSend['name'];
                $data->name_show = $dataSend['name_show'];
                $data->text_welcome = $dataSend['text_welcome'];
                $data->codeSecurity = $dataSend['codeSecurity'];
                $data->codePersonWin = trim($dataSend['codePersonWin']);
                $data->noteCheckin = $dataSend['noteCheckin'];
                $data->colorText = $dataSend['colorText'];
                $data->status = $dataSend['status'];
                $data->description = $dataSend['description'];
                $data->img_background = $img_background;
                $data->img_logo = $img_logo;
                $data->image = $image;
                $data->id_member = $session->read('infoUser')->id;
                $data->location = json_encode($dataSend['location']);

                $ticket = [];
                for($i=1;$i<=10;$i++){
                    if(!empty($dataSend['ticket_name'][$i])){
                        $ticket[$i]['name'] = $dataSend['ticket_name'][$i];
                        $ticket[$i]['price'] = (int) @$dataSend['ticket_price'][$i];
                    }
                }

                $team = [];
                for($i=1;$i<=20;$i++){
                    if(!empty($dataSend['team'][$i])){
                        $team[$i]['name'] = $dataSend['team'][$i];
                        $team[$i]['id_member'] = (int) @$dataSend['team_boss'][$i];
                    }
                }

                $data->ticket = json_encode($ticket);
                $data->team = json_encode($team);
                
                $modelCampaigns->save($data);

                $mess= '<p class="text-success">Lưu dữ liệu thành công</p>';
            }else{
                $mess= '<p class="text-danger">Gửi thiếu dữ liệu</p>';
            }
        }

        $data->location = json_decode($data->location, true);
        $data->team = json_decode($data->team, true);
        $data->ticket = json_decode($data->ticket, true);

        setVariable('data', $data);
        setVariable('mess', $mess);
    }else{
        return $controller->redirect('/login');
    }
}

function deleteCampaign($input){
    global $controller;
    global $session;

    $modelCampaigns = $controller->loadModel('Campaigns');
    $modelCampaignCustomers = $controller->loadModel('CampaignCustomers');
    
    if(!empty($session->read('infoUser'))){
        if(!empty($_GET['id'])){
            $data = $modelCampaigns->find()->where(['id'=>(int) $_GET['id'], 'id_member'=>$session->read('infoUser')->id])->first();
            
            if($data){
                $modelCampaignCustomers->deleteAll(['id_campaign'=>$data->id, 'id_member'=>$session->read('infoUser')->id]);
                $modelCampaigns->delete($data);
            }
        }

        return $controller->redirect('/listCampaign');
    }else{
        return $controller->redirect('/login');
    }
}