<?php 


function listabc($input){
    if (isset($_GET['email']) && isset($_GET['numberAcc100'])) {
        $email = $_GET['email'];
        $numberAcc100 = (int)$_GET['numberAcc100'];
    
        // Gọi hàm để gửi thông báo và lưu kết quả trả về
        $result = sendLowRoomNotification($email, $numberAcc100);
        
        // In ra kết quả trả về
        echo $result;
    } else {
        echo 'Vui lòng cung cấp email và số lượng phòng.';
    }



}




?>