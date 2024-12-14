<?php
function searchCustomerAPI()
{
    global $isRequestPost;
    global $controller;

    $return = array();
    $modelCustomer = $controller->loadModel('Customers');

    $dataSend = $_REQUEST;

    $conditions = [];

    if (!empty($dataSend['term'])) {
        $conditions['OR'] = [
            'name LIKE' => '%' . $dataSend['term'] . '%',
            'phone LIKE' => '%' . $dataSend['term'] . '%',
        ];
    }

    if (!empty($dataSend['id'])) {
        $conditions['id'] = (int) $dataSend['id'];
    }

    $listData = $modelCustomer->find()->where($conditions)->all()->toList();

    if ($listData) {
        foreach ($listData as $data) {
            $return[] = array(
                'label' => $data->name . ' (' . $data->phone . ')',
                'id' => $data->id,
                'value' => $data->id,
                'name' => $data->name,
                'email' => $data->email,
                'phone' => $data->phone,
                'address' => $data->address,
                'status' => $data->status,
            );
        }
    } else {
        $return = array(
            array(
                'id' => 0,
                'label' => 'Không tìm thấy dữ liệu',
                'value' => '',
            )
        );
    }

    return $return;
}
?>
