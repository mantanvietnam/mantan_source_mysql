<?php
function registerform($input) {
    global $metaTitleMantan;
 
    global $controller;
    $metaTitleMantan = 'Đăng ký tài khoản';
    $modelCustomer = $controller->loadModel('customers');
  $modelCollaborator = $controller->loadModel('Collaborator');
 
    $mess = '';

                
    $conditions = [];

    if (!empty($_GET['ref'])) {
        $conditions['phone'] = $_GET['ref'];
    } $collaborator = $modelCollaborator->find()->where($conditions)->first();
    
    $collaborator = $modelCollaborator->find()->where($conditions)->first();
    if ($input['request']->is('POST')) {
        $dataSend = $input['request']->getData();
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
            $dataSend['phone_number'] = trim(str_replace(array(' ', '.', '-'), '', $dataSend['phone_number']));
            $dataSend['phone_number'] = str_replace('+84', '0', $dataSend['phone_number']);
            $conditions = ['email' => $dataSend['email']];
            $checkCustomer = $modelCustomer->find()->where($conditions)->first();
            if (empty($checkCustomer)) {
                $birth_datetime = sprintf(
                    '%04d-%02d-%02d %02d:%02d:00',
                    $dataSend['birth_year'],
                    $dataSend['birth_month'],
                    $dataSend['birth_day'],
                    $dataSend['birth_hour'],
                    $dataSend['birth_minute']
                );
                $data->full_name = $dataSend['full_name'];
                $data->phone_number = $dataSend['phone_number'];
                $data->email = $dataSend['email'];
                $data->birth_datetime = $birth_datetime;
                $data->gender = $dataSend['gender'];
                $data->id_collaborator  = $collaborator->id;

                if ($modelCustomer->save($data)) {
                    return $controller->redirect('/information?id=' . $data->id);
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
 
    setVariable('mess', $mess);
}
//khi người dùng nhập thông tin xong xong so sánh năm sinh và giới tính xem có trùng với dữ liệu trong bảng database horoscopes không nếu trùng thì hiển thị thông tin mascots trong bảng horoscopes có năm sinh và giới tính trùng với năm sinh và giới tính người dùng nhập vào
function information($input) {
    global $metaTitleMantan;
    global $controller;

    $metaTitleMantan = 'Thông tin chi tiết';

    $modelCustomer = $controller->loadModel('customers');
    $modelHoroscopes = $controller->loadModel('Horoscope');

    $mess = ''; 
    $overview = null;
    $dataSend = $input['request']->getQuery();

    if (!empty($dataSend['id'])) {
        $conditions = ['id' => $dataSend['id']];
    } else {
        $conditions = ['id IS' => null];
    }

    $customer = $modelCustomer->find()->where($conditions)->first();

    if ($customer) {
        if (!empty($customer->birth_datetime) && !empty($customer->gender)) {
            $birth_year = $customer->birth_datetime->format('Y');
            $gender = $customer->gender;

            $conditions = [
                'year' => $birth_year,
                'gender' => $gender
            ];

            $horoscope = $modelHoroscopes->find()->where($conditions)->first();
           
            if ($horoscope) {
                $overview = $horoscope->overview;
                $price = $horoscope->price;
            } else {
                $mess = "Không tìm thấy thông tin phù hợp.";
            }
        } else {
            $mess = "Dữ liệu khách hàng không hợp lệ.";
        }
    } else {
        $mess = "Không tìm thấy khách hàng.";
    }

    setVariable('mess', $mess);
    setVariable('overview', $overview);
    setVariable('price', $price);
}

// function information($input) {
//     global $metaTitleMantan;
//     global $controller;

//     $metaTitleMantan = 'Thông tin chi tiết';

//     $modelCustomer = $controller->loadModel('customers');
//     $modelHoroscopes = $controller->loadModel('Horoscope');

//     $mess = ''; 
//     $overview = null;
//     $dataSend = $input['request']->getQuery();

//     if (!empty($dataSend['id'])) {
//         $conditions = ['id' => $dataSend['id']];
//     } else {
//         $conditions = ['id IS' => null];
//     }

//     $customer = $modelCustomer->find()->where($conditions)->first();

//     if ($customer) {
//         if (!empty($customer->birth_datetime) && !empty($customer->gender) && !empty($customer->email) && !empty($customer->full_name)) {
//             $birth_year = $customer->birth_datetime->format('Y');
//             $gender = $customer->gender;
//             $email = $customer->email;
//             $name = $customer->full_name;

//             $conditions = [
//                 'year' => $birth_year,
//                 'gender' => $gender
//             ];

//             $horoscope = $modelHoroscopes->find()->where($conditions)->first();
           
//             if ($horoscope) {
//                 $overview = $horoscope->overview;

//                 $sendStatus = sendHoroscopeEmail($email, $name, $birth_year, $gender, $horoscope);

//                 if ($sendStatus) {
//                     $mess = "Email đã được gửi đến $email.";
//                 } else {
//                     $mess = "Lỗi khi gửi email. Vui lòng thử lại.";
//                 }
//             } else {
//                 $mess = "Không tìm thấy thông tin phù hợp.";
//             }
//         } else {
//             $mess = "Dữ liệu khách hàng không hợp lệ hoặc thiếu thông tin.";
//         }
//     } else {
//         $mess = "Không tìm thấy khách hàng.";
//     }

//     setVariable('mess', $mess);
//     setVariable('overview', $overview);
// }

?>
