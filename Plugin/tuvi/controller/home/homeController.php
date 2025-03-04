<?php
function registerform($input) {
    global $metaTitleMantan;
 
    global $controller;
    $metaTitleMantan = 'Đăng ký tài khoản';
    $modelCustomer = $controller->loadModel('customers');
  
    $mess = '';

    // Check if request is a POST
    if ($input['request']->is('POST')) {
        $dataSend = $input['request']->getData();
        // Validate required fields
        if (!empty($dataSend['full_name']) &&
            !empty($dataSend['phone_number']) &&
            !empty($dataSend['email']) &&
            !empty($dataSend['birth_day']) &&
            !empty($dataSend['birth_month']) &&
            !empty($dataSend['birth_year']) &&
            !empty($dataSend['birth_hour']) &&
            !empty($dataSend['birth_minute']) &&
            !empty($dataSend['gender'])
        ) {
            $data = $modelCustomer->newEmptyEntity();

            // Clean up phone number
            $dataSend['phone_number'] = trim(str_replace(array(' ', '.', '-'), '', $dataSend['phone_number']));
            $dataSend['phone_number'] = str_replace('+84', '0', $dataSend['phone_number']);

            // Check if the email is already registered
            $conditions = ['email' => $dataSend['email']];
            $checkCustomer = $modelCustomer->find()->where($conditions)->first();

            // If email is not already registered
            if (empty($checkCustomer)) {
                // Format birth datetime
                $birth_datetime = sprintf(
                    '%04d-%02d-%02d %02d:%02d:00',
                    $dataSend['birth_year'],
                    $dataSend['birth_month'],
                    $dataSend['birth_day'],
                    $dataSend['birth_hour'],
                    $dataSend['birth_minute']
                );

                // Set customer data
                $data->full_name = $dataSend['full_name'];
                $data->phone_number = $dataSend['phone_number'];
                $data->email = $dataSend['email'];
                $data->birth_datetime = $birth_datetime;
                $data->gender = $dataSend['gender'];

                // Save data to the database
                if ($modelCustomer->save($data)) {
                    return $controller->redirect('/');
                } else {
                    $mess = '<p class="text-danger">Lỗi khi lưu dữ liệu. Vui lòng thử lại.</p>';
                }
            } else {
                $mess = '<p class="text-danger">Email đã được đăng ký</p>';
            }
        } else {
            $mess = '<p class="text-danger">Vui lòng nhập đầy đủ thông tin</p>';
        }
    }

    // Pass the message variable to the view
    setVariable('mess', $mess);
}

?>
