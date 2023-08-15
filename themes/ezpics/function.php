<?php 
$menus= array();
$menus[0]['title']= 'Cài đặt giao diện';
$menus[0]['sub'][0]= array( 'title'=>'Cài đặt trang chủ',
                            'url'=>'/plugins/admin/ezpics-admin-settingHomeTheme.php',
                            'classIcon'=>'bx bx-cog',
                            'permission'=>'settingHomeTheme'
                        );

addMenuAdminMantan($menus);

global $modelOptions;
global $modelMenus;
global $settingThemes;
global $infoUser;
global $session;

// CÀI ĐẶT TRANG CHỦ
$conditions = array('key_word' => 'settingHomeTheme');
$data = $modelOptions->find()->where($conditions)->first();


$settingThemes = array();
if(!empty($data->content)){
    $settingThemes = json_decode($data->content, true);

    if(!empty($settingThemes['idMenu2_footer'])){
        $settingThemes['menu2_footer'] = $modelMenus->find()->where(['id_menu' => (int) $settingThemes['idMenu2_footer'], 'id_parent'=>0])->order(['weighty'=>'ASC'])->all()->toList();
    }
}



// INFO USER LOGIN
$infoUser = $session->read('infoUser');


function getSellTopDesigner(){
    global $isRequestPost;
    global $controller;
    global $session;

    $modelOrder = $controller->loadModel('Orders');
    $modelMember = $controller->loadModel('Members');
    $modelProduct = $controller->loadModel('Products');

    $listDesign = [];

    
        // bán được nhiều mẫu hoặc doanh thu cao trong tuần
        if(empty($_GET['date_start']) && empty($_GET['date_end']) ){
            $conditions = array('created_at >=' => date('Y-m-d H:i:s', strtotime("-30 day")));
        }else{
            if(!empty($_GET['date_start'])){
                    $date_start = explode('/', $_GET['date_start']);
                    $date_start = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
                    $conditions['created_at >='] = date('Y-m-d H:i:s', $date_start);
            }if(!empty($_GET['date_end'])){
                    $date_end = explode('/', $_GET['date_end']);
                    $date_end = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
                    $conditions['created_at <='] = date('Y-m-d H:i:s', $date_end);
            }
        }
       
        $order = array();

        $listData = $modelOrder->find()->limit(5)->page(1)->where($conditions)->order($order)->all()->toList();
        $listDesignStatic = [];



        if(!empty($listData)){
            foreach ($listData as $key => $value) {
                if(empty($listDesignStatic[$value->member_id])){
                    $listDesignStatic[$value->member_id] = 0;
                }

                
                    $listDesignStatic[$value->member_id] ++;
                
            }

            arsort($listDesignStatic);



            foreach ($listDesignStatic as $key => $value) {
                
                    $member = $modelMember->find()->where(['id'=>(int) $key])->first();
                    if(!empty($member)){
                    $member->sold = @$value;
                    unset($member->password);
                    unset($member->token);


                    $listDesign[] = $member;
                }
            }
        }
    
    return $listDesign;
}

function getIncomeTopDesigner(){
    global $isRequestPost;
    global $controller;
    global $session;

    $modelOrder = $controller->loadModel('Orders');
    $modelMember = $controller->loadModel('Members');
    $modelProduct = $controller->loadModel('Products');

    $listDesign = [];

    
        // bán được nhiều mẫu hoặc doanh thu cao trong tuần
        if(empty($_GET['date_start']) && empty($_GET['date_end']) ){
            $conditions = array('created_at >=' => date('Y-m-d H:i:s', strtotime("-30 day")));
        }else{
            if(!empty($_GET['date_start'])){
                    $date_start = explode('/', $_GET['date_start']);
                    $date_start = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
                    $conditions['created_at >='] = date('Y-m-d H:i:s', $date_start);
            }if(!empty($_GET['date_end'])){
                    $date_end = explode('/', $_GET['date_end']);
                    $date_end = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
                    $conditions['created_at <='] = date('Y-m-d H:i:s', $date_end);
            }
        }
        
        $order = array();

        $listData = $modelOrder->find()->limit(5)->page(1)->where($conditions)->order($order)->all()->toList();
        $listDesignStatic = [];

        if(!empty($listData)){
            foreach ($listData as $key => $value) {
                if(empty($listDesignStatic[$value->member_id])){
                    $listDesignStatic[$value->member_id] = 0;
                }

                $listDesignStatic[$value->member_id] += $value->total;
                
                
            }

            arsort($listDesignStatic);

            foreach ($listDesignStatic as $key => $value) {
                $member = $modelMember->find()->where(['id'=>(int) $key])->first();
                if(!empty($member)){
                    $member->sold = $value;
                    unset($member->password);
                    unset($member->token);

                    $listDesign[] = $member;
                }
            }
        }


    
    return $listDesign;
}

function getCreateTopDesigner(){
    global $isRequestPost;
    global $controller;
    global $session;

    $modelOrder = $controller->loadModel('Orders');
    $modelMember = $controller->loadModel('Members');
    $modelProduct = $controller->loadModel('Products');

    $listDesign = [];

    
        // tạo nhiều mẫu bán trong tuần
        if(empty($_GET['date_start']) && empty($_GET['date_end']) ){
            $conditions = array('created_at >=' => date('Y-m-d H:i:s', strtotime("-30 day")));
        }else{
            if(!empty($_GET['date_start'])){
                    $date_start = explode('/', $_GET['date_start']);
                    $date_start = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
                    $conditions['created_at >='] = date('Y-m-d H:i:s', $date_start);
            }if(!empty($_GET['date_end'])){
                    $date_end = explode('/', $_GET['date_end']);
                    $date_end = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
                    $conditions['created_at <='] = date('Y-m-d H:i:s', $date_end);
            }
        }
        
        $order = array();

        $listData = $modelProduct->find()->limit(5)->page(1)->where($conditions)->order($order)->all()->toList();
        $listDesignStatic = [];

        if(!empty($listData)){
            foreach ($listData as $key => $value) {
                if(empty($listDesignStatic[$value->user_id ])){
                    $listDesignStatic[$value->user_id ] = 0;
                }

                $listDesignStatic[$value->user_id] ++;
            }

            arsort($listDesignStatic);

            foreach ($listDesignStatic as $key => $value) {
                $member = $modelMember->find()->where(['id'=>(int) $key])->first();
                $member->sold = $value;
                unset($member->password);
                unset($member->token);

                $listDesign[] = $member;
            }
        }

    return $listDesign;
}
?>