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



require_once __DIR__ . '/library/TCPDF-main/tcpdf.php';

function sendHoroscopeEmail($email, $name, $birth_year, $gender, $horoscope) {
    $pdf = new TCPDF();
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Tử vi');
    $pdf->SetTitle("Tử vi $birth_year - $gender");
    $pdf->SetHeaderData('', 0, "Tử vi của $birth_year", "Năm sinh: $birth_year - Giới tính: $gender");
    $pdf->AddPage();
    
    $content = "<h1>Tử vi của $birth_year</h1>";
    $content .= "<p><strong>Năm sinh:</strong> $birth_year</p>";
    $content .= "<p><strong>Giới tính:</strong> $gender</p>";
    $content .= "<p><strong>Tổng quan:</strong> " . htmlspecialchars($horoscope->overview) . "</p>";
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