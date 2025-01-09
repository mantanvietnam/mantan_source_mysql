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
                'identity' => $data->identity,
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

function saveCustomerAPI() {
    global $isRequestPost;
    global $controller;

    $modelCustomers = $controller->loadModel('Customers');
    $return = array();
    $dataSend = $_REQUEST;

    if (!empty($dataSend['full_name']) && isset($dataSend['phone'])) {
        $fullName = trim($dataSend['full_name']);
        $email = isset($dataSend['email']) ? trim($dataSend['email']) : '';
        $phone = trim($dataSend['phone']);
        $buiding_id = trim($dataSend['buiding_id']);
        $identity = trim($dataSend['identity']);
        $address = isset($dataSend['address']) ? trim($dataSend['address']) : '';
        $birthday = isset($dataSend['birthday']) ? trim($dataSend['birthday']) : null;

        // Chỉ xử lý nếu $birthday không phải null hoặc chuỗi rỗng
        if (!empty($birthday)) {
            $birthday = strtotime(str_replace("/", "-", $birthday));
        } else {
            $birthday = null;
        }

        $existingCustomer = $modelCustomers->find()->where(['phone' => $phone, 'identity' => $identity])->first();

        if ($existingCustomer) {
            $return = array(
                'success' => false,
                'message' => 'Khách hàng đã tồn tại.'
            );
        } else {
            $newCustomer = $modelCustomers->newEmptyEntity();
            $newCustomer->name = $fullName;
            $newCustomer->email = $email;
            $newCustomer->phone = $phone;
            $newCustomer->identity = $identity;
            $newCustomer->address = $address;
            $newCustomer->birthday = $birthday;
            $newCustomer->buiding_id = $buiding_id;
            $newCustomer->status = "active";
            $newCustomer->created_at = time();

            if ($modelCustomers->save($newCustomer)) {
                $return = array(
                    'success' => true,
                    'message' => 'Thêm khách hàng mới thành công.',
                    'customer' => array(
                        'id' => $newCustomer->id,
                        'full_name' => $newCustomer->name,
                        'email' => $newCustomer->email,
                        'phone' => $newCustomer->phone,
                        'identity' => $newCustomer->identity,
                        'address' => $newCustomer->address,
                        'birthday' => $birthday
                    )
                );
            } else {
                $return = array(
                    'success' => false,
                    'message' => 'Không thể lưu thông tin khách hàng.'
                );
            }
        }
    } else {
        $return = array(
            'success' => false,
            'message' => 'Dữ liệu không hợp lệ.'
        );
    }

    return $return;
}



?>
