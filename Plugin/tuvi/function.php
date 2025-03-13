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



function sendHoroscopeEmail($email, $name, $year, $gender, $conn) {
    // Truy vấn lấy dữ liệu tử vi từ database
    $stmt = $conn->prepare("SELECT * FROM horoscopes WHERE year = ? AND gender = ?");
    $stmt->bind_param("is", $year, $gender);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $link_download = "https://yourwebsite.com/downloads/horoscope_" . $row['id'] . ".pdf";
        
        $to = [trim($email)];
        $subject = '[Tử vi] Link tải bản tử vi đầy đủ của ' . $name;
        
        $content = '<!DOCTYPE html>
        <html lang="vi">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Link tải tử vi của bạn</title>
        </head>
        <body>
            <p>Xin chào ' . htmlspecialchars($name) . ',</p>
            <p>Chúng tôi gửi bạn link tải tử vi dựa trên năm sinh (' . $year . ') và giới tính (' . htmlspecialchars($gender) . '):</p>
            <p><a href="' . $link_download . '">' . $link_download . '</a></p>
            <p>Trân trọng,</p>
            <p>Đội ngũ hỗ trợ</p>
        </body>
        </html>';
        
        sendEmail($to, [], [], $subject, $content);
        return true;
    } else {
        return false;
    }
}

?>