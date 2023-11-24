<?php 
function listOrderAdmin($input)
{
	global $controller;
	global $urlCurrent;
	global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Danh sách đơn hàng';

	$modelOrder = $controller->loadModel('Orders');

	$conditions = array();
	$limit = 20;
	$page = (!empty($_GET['page']))?(int)$_GET['page']:1;
	if($page<1) $page = 1;
    $order = array('id'=>'desc');

    if(!empty($_GET['id'])){
        $conditions['id'] = (int) $_GET['id'];
    }

    if(!empty($_GET['full_name'])){
        $conditions['full_name LIKE'] = '%'.$_GET['full_name'].'%';
    }

    if(!empty($_GET['phone'])){
        $conditions['phone'] = $_GET['phone'];
    }

    if(!empty($_GET['status'])){
        $conditions['status'] = $_GET['status'];
    }

    
    $listData = $modelOrder->find()->limit($limit)->page($page)->where($conditions)->order($order)->all()->toList();

    // phân trang
    $totalData = $modelOrder->find()->where($conditions)->all()->toList();
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
}

function deleteOrderAdmin($input)
{
    global $controller;

    $modelOrder = $controller->loadModel('Orders');
    $modelOrderDetail = $controller->loadModel('OrderDetail');
    
    if(!empty($_GET['id'])){
        $data = $modelOrder->get((int) $_GET['id']);
        
        if($data){
            $modelOrder->delete($data);
            $modelOrderDetail->deleteAll(['id_order'=>$data->id]);
        }
    }

    return $controller->redirect('/plugins/admin/product-view-admin-order-listOrderAdmin.php');
}

function viewOrderAdmin($input)
{
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Chi tiết đơn hàng';

    $modelProduct = $controller->loadModel('Products');
    $modelOrder = $controller->loadModel('Orders');
    $modelOrderDetail = $controller->loadModel('OrderDetails');

    if(!empty($_GET['id'])){
        $order = $modelOrder->find()->where(['id'=>(int) $_GET['id'] ])->first();

        if(!empty($order)){
            $detail_order = $modelOrderDetail->find()->where(['id_order'=>$order->id])->all()->toList();

            if(!empty($detail_order)){
                foreach ($detail_order as $key => $value) {
                    $product = $modelProduct->find()->where(['id'=>$value->id_product ])->first();
                    

                    $present = array();

                    if(!empty($product->id_product) ){
                    $id_product = explode(',', @$product->id_product);
                    foreach($id_product as $item){
                        $presentf = $modelProduct->find()->where(['code'=>$item])->first();
                        if(!empty($presentf)){
                            $present[] = $presentf;
                        }
                    }
                    
            }
            $product->present = $present;
                $detail_order[$key]->product = $product;
                }
            }
            setVariable('order', $order);
            setVariable('detail_order', $detail_order);
        }else{
            return $controller->redirect('/plugins/admin/product-view-admin-order-listOrderAdmin.php');
        }
    }else{
        return $controller->redirect('/plugins/admin/product-view-admin-order-listOrderAdmin.php');
    }
}

function treatmentOrder($input){
    global $controller;
    global $urlCurrent;
    global $modelCategories;
    global $metaTitleMantan;

    $metaTitleMantan = 'Chi tiết đơn hàng';


    $modelOrder = $controller->loadModel('Orders');

    if(!empty($_GET['id'])){
        $order = $modelOrder->find()->where(['id'=>(int) $_GET['id'] ])->first();

        $order->status = $_GET['status'];

        $modelOrder->save($order);
         return $controller->redirect('/plugins/admin/product-view-admin-order-listOrderAdmin.php');

    }
}

?>