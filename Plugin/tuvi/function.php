<?php
global $keyFirebase;

$keyFirebase = 'AAAAmV3l9xI:APA91bH_cEaRYEz8d-_JbIDDk32k1aqlt8PgB7ctT8Qx-0ErMU70ja_aT9QTsT5rUG2xdPOxxIhFLGxRpUAIr1LaBxCiRF2KH5aMD0T5NN4kARg1KKwGsPIAl2g3PYF8XYa0FAB0CZYi';

$menus= array();
$menus[0]['title']= 'Cộng Tác Viên';
$menus[0]['sub'][]= array(	'title'=>'Danh sách Cộng Tác Viên',
							'url'=>'/plugins/admin/tuvi-view-admin-collaborator-listCollaboratorAdmin',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listCollaboratorAdmin',
							
						);
$menus[0]['sub'][]= array(	'title'=>'Cài đặt hoa hồng',
							'url'=>'/plugins/admin/tuvi-view-admin-collaborator-settingAffiliateAdmin',
							'classIcon'=>'bx bx-cog',
							'permission'=>'settingAffiliateAdmin'
						);

$menus[1]['title']= 'Khách hàng';
$menus[1]['sub'][]= array(	'title'=>'Danh Sách Khách Hàng',
							'url'=>'/plugins/admin/tuvi-view-admin-customers-listCustomersAdmin',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listCustomersAdmin',
							
							);

$menus[3]['title']= 'Tử Vi';
$menus[3]['sub'][]= array(	'title'=>'Danh Sách Tử Vi',
							'url'=>'/plugins/admin/tuvi-view-admin-horoscope-listHoroscopeAdmin',
							'classIcon'=>'bx bxs-data',
							'permission'=>'listHoroscopeAdmin',
							
							);
addMenuAdminMantan($menus);

function processAddMoney($money = 0, $transaction_id = '') {
    global $controller;

    $modelTransaction = $controller->loadModel('Transaction');
    $modelCustomer = $controller->loadModel('Customers');
    $modelHoroscopes = $controller->loadModel('Horoscope');

    if ($money <= 0 || empty($transaction_id)) {
        return ['code' => 0, 'mess' => 'Dữ liệu không hợp lệ!'];
    }

    $transaction = $modelTransaction->find()->where(['transaction_id' => $transaction_id])->first();

    if (!$transaction) {
        return ['code' => 0, 'mess' => 'Không tìm thấy giao dịch!'];
    }

    $customer = $modelCustomer->find()->where(['id' => $transaction->id_customer])->first();
    if (!$customer || empty($customer->email)) {
        return ['code' => 0, 'mess' => 'Không tìm thấy thông tin khách hàng hoặc khách hàng chưa đăng ký email!'];
    }

    $horoscope = $modelHoroscopes->find()->where(['id' => $customer->id_horoscoper])->first();
    if (!$horoscope) {
        return ['code' => 0, 'mess' => 'Không tìm thấy dữ liệu tử vi!'];
    }

    $transaction->status = 1;
    $transaction->timeupdate = time();

    if ($modelTransaction->save($transaction)) {
        $sendEmailResult = sendPaymentSuccessEmailWithHoroscope(
            $customer->email,
            $customer->name,
            $transaction->total,
            $customer->birth_year,
            $customer->gender,
            $horoscope
        );

        return ['code' => 1, 'mess' => 'Thanh toán thành công, email đã được gửi!', 'email_status' => $sendEmailResult];
    } else {
        return ['code' => 0, 'mess' => 'Lỗi khi cập nhật giao dịch!'];
    }
}

require_once __DIR__ . '/library/TCPDF-main/tcpdf.php';

function sendPaymentSuccessEmailWithHoroscope($email, $name, $amount, $birth_year, $gender, $horoscope) {
    $pdf = new TCPDF();
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Tử vi');
    $pdf->SetTitle("Tử vi $birth_year - $gender");
    $pdf->SetHeaderData('', 0, "Tử vi của $birth_year", "Năm sinh: $birth_year - Giới tính: $gender");
    $pdf->SetFont('dejavusans', '', 12);
    $pdf->AddPage();

    $description = strip_tags(html_entity_decode($horoscope->description ?? "Không có dữ liệu", ENT_QUOTES, 'UTF-8'));
    $direction = strip_tags(html_entity_decode($horoscope->direction ?? "Không có dữ liệu", ENT_QUOTES, 'UTF-8'));
    $five_elements = strip_tags(html_entity_decode($horoscope->five_elements ?? "Không có dữ liệu", ENT_QUOTES, 'UTF-8'));
    $mascot = strip_tags(html_entity_decode($horoscope->mascot ?? "Không có dữ liệu", ENT_QUOTES, 'UTF-8'));
    $name_by_age = strip_tags(html_entity_decode($horoscope->name_by_age ?? "Không có dữ liệu", ENT_QUOTES, 'UTF-8'));

    if (!empty($horoscope->image)) {
        $pdf->Image($horoscope->image, 15, 30, 50);
        $pdf->Ln(50);
    }

    $content = "<h1>Tử vi của $birth_year</h1>";
    $content .= "<p><strong>Năm sinh:</strong> $birth_year</p>";
    $content .= "<p><strong>Giới tính:</strong> $gender</p>";
    $content .= "<p><strong>Mô tả:</strong> $description</p>";
    $content .= "<p><strong>Hướng hợp:</strong> $direction</p>";
    $content .= "<p><strong>Ngũ hành:</strong> $five_elements</p>";
    $content .= "<p><strong>Linh vật:</strong> $mascot</p>";
    $content .= "<p><strong>Tên theo tuổi:</strong> $name_by_age</p>";
    $pdf->writeHTML($content, true, false, true, false, '');

    // Lưu file PDF
    $folderPath = dirname(__DIR__, 2) . '/upload/';
    if (!file_exists($folderPath)) {
        mkdir($folderPath, 0777, true);
    }

    $filePath = $folderPath . 'tuvi_' . $birth_year . '_' . $gender . '.pdf';
    $pdf->Output($filePath, 'F');

    // Gửi email
    $to = [trim($email)];
    $subject = '[Thanh toán thành công] & [Tử vi của bạn]';

    $emailContent = "<p>Xin chào $name,</p>";
    $emailContent .= "<p>Chúng tôi xác nhận rằng bạn đã thanh toán thành công số tiền <strong>" . number_format($amount) . "đ</strong>.</p>";
    $emailContent .= "<p>Bạn có thể xem bản tử vi của mình theo năm sinh ($birth_year) và giới tính ($gender) trong file đính kèm.</p>";
    $emailContent .= "<p>Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi!</p>";
    $emailContent .= "<p>Trân trọng,</p><p>Đội ngũ hỗ trợ</p>";

    $attachments = [
        [
            'name' => 'TuVi_' . $birth_year . '_' . $gender . '.pdf',
            'type' => 'application/pdf',
            'link' => $filePath
        ]
    ];

    return sendEmailv2($to, [], [], $subject, $emailContent, 'default', $attachments);
}


function sendHoroscopeEmail($email, $name, $birth_year, $gender, $horoscope) {
    $pdf = new TCPDF();
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Tử vi');
    $pdf->SetTitle("Tử vi $birth_year - $gender");
    $pdf->SetHeaderData('', 0, "Tử vi của $birth_year", "Năm sinh: $birth_year - Giới tính: $gender");
    $pdf->SetFont('dejavusans', '', 12);
    $pdf->AddPage();

    $description = strip_tags(html_entity_decode($horoscope->description ?? "Không có dữ liệu", ENT_QUOTES, 'UTF-8'));
    $direction = strip_tags(html_entity_decode($horoscope->direction ?? "Không có dữ liệu", ENT_QUOTES, 'UTF-8'));
    $five_elements = strip_tags(html_entity_decode($horoscope->five_elements ?? "Không có dữ liệu", ENT_QUOTES, 'UTF-8'));
    $mascot = strip_tags(html_entity_decode($horoscope->mascot ?? "Không có dữ liệu", ENT_QUOTES, 'UTF-8'));
    $name_by_age = strip_tags(html_entity_decode($horoscope->name_by_age ?? "Không có dữ liệu", ENT_QUOTES, 'UTF-8'));

    if (!empty($horoscope->image)) {
        $pdf->Image($horoscope->image, 15, 30, 50);
        $pdf->Ln(50);
    }
    
    $content = "<h1>Tử vi của $birth_year</h1>";
    $content .= "<p><strong>Năm sinh:</strong> $birth_year</p>";
    $content .= "<p><strong>Giới tính:</strong> $gender</p>";
    $content .= "<p><strong>Mô tả:</strong> $description</p>";
    $content .= "<p><strong>Hướng hợp:</strong> $direction</p>";
    $content .= "<p><strong>Ngũ hành:</strong> $five_elements</p>";
    $content .= "<p><strong>Linh vật:</strong> $mascot</p>";
    $content .= "<p><strong>Tên theo tuổi:</strong> $name_by_age</p>";
    $pdf->writeHTML($content, true, false, true, false, '');

    $folderPath = dirname(__DIR__, 2) . '/upload/';
    if (!file_exists($folderPath)) {
        mkdir($folderPath, 0777, true);
    }

    $filePath = $folderPath . 'tuvi_' . $birth_year . '_' . $gender . '.pdf';
    $pdf->Output($filePath, 'F');

    $to = [trim($email)];
    $subject = '[Tử vi] Bản tử vi đầy đủ của ' . $birth_year;

    $emailContent = "<p>Xin chào $name,</p>";
    $emailContent .= "<p>Chúng tôi gửi bạn bản tử vi theo năm sinh ($birth_year) và giới tính ($gender) ở file đính kèm.</p>";
    $emailContent .= "<p>Trân trọng,</p><p>Đội ngũ hỗ trợ</p>";

    $attachments = [
        [
            'name' => 'TuVi_' . $birth_year . '_' . $gender . '.pdf',
            'type' => 'application/pdf',
            'link' => $filePath
        ]
    ];

    return sendEmailv2($to, [], [], $subject, $emailContent, 'default', $attachments);
}
?>