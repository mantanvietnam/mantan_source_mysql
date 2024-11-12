<?php
function listTransactionHistories($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;

    $user = checklogin('listTransactionHistories');   
    if(!empty($user)){
        if(empty($user->grant_permission) && !empty($user->id_father)){
            return $controller->redirect('/');
        }
        $metaTitleMantan = 'Lịch sử giao dịch';

        $modelTransactionHistories = $controller->loadModel('TransactionHistories');
        $modelMembers = $controller->loadModel('Members');

        $user = $modelMembers->get($user->id);

        $conditions = array('id_member'=>$user->id);
        $limit = 20;
        $page = (!empty($_GET['page']))?(int)$_GET['page']:1;
        if($page<1) $page = 1;
        $order = array('id'=>'desc');

        if(!empty($_GET['id'])){
            $conditions['id'] = (int) $_GET['id'];
        }

        if(!empty($_GET['date_start'])){
            $date_start = explode('/', $_GET['date_start']);
            $conditions['create_at >='] = mktime(0,0,0,$date_start[1],$date_start[0],$date_start[2]);
        }

        if(!empty($_GET['date_end'])){
            $date_end = explode('/', $_GET['date_end']);
            $conditions['create_at <='] = mktime(23,59,59,$date_end[1],$date_end[0],$date_end[2]);
                
        }

        $listData = $modelTransactionHistories->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

        // phân trang
        $totalData = $modelTransactionHistories->find()->where($conditions)->all()->toList();
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
        setVariable('member', $user);
    }else{
        return $controller->redirect('/login');
    }
}

function addMoney($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;
    global $session;
    global $isRequestPost;

        $user = checklogin('addMoney');   
    $modelMembers = $controller->loadModel('Members');
    if(!empty($user)){
        if(empty($user->grant_permission) && !empty($user->id_father)){
            return $controller->redirect('/');
        }
        $metaTitleMantan = 'Nạp tiền tài khoản';

        if(!empty($user->type=='staff')){
            $user = $modelMembers->find()->where(['id'=>$user->id_member])->first();
        }

            $boss = $modelMembers->find()->where(['id_father'=>0])->first();
            $dataPost= array('amount'=>@$_GET['money'],'description'=>$boss->phone.' '.$user->id);
            $listData= sendDataConnectMantan('https://icham.vn/apis/getinfobankAPI', $dataPost);
            $listData= str_replace('ï»¿', '', utf8_encode($listData));
            $return= json_decode($listData, true);
       

        if(!empty($return)){
            $data = array();
            $data['number_bank'] = $return['accountNumber'];
            $data['accountName'] = $return['accountName'];
            $data['code_bank'] = $return['bin'];
            $data['content'] = $return['description'];
            $data['amount'] = $return['amount'];
            $data['name_bank'] = $return['code_bank'];

            $data['linkQR'] = 'https://img.vietqr.io/image/'.$data['code_bank'].'-'.$data['number_bank'].'-compact2.png?amount='.(int) $data['amount'].'&addInfo='.$data['content'].'&accountName='.$data['accountName'];



            setVariable('data', $data);
        }else{
            return $controller->redirect('/listTransactionHistories');
        }
    }else{
        return $controller->redirect('/login');
    }
}


?>