<?php
if(file_exists(__DIR__.'/../../../../../themes/'.$theme.'/setting_theme_clone_web.php')){
    include(__DIR__.'/../../../../../themes/'.$theme.'/setting_theme_clone_web.php');

    echo '<div class="container-xxl flex-grow-1">
            <div class="card">
                <div class="card-body row">
                    <p><b>Quy ước biến thay thế thông tin đại lý:</b></p>

                    <div class="col-md-6">
                        <p><b>%name%</b>: Họ tên của đại lý</p>
                        <p><b>%position%</b>: Chức danh của đại lý</p>
                        <p><b>%avatar%</b>: Link ảnh đại diện của đại lý</p>
                        <p><b>%phone%</b>: Số điện thoại của đại lý</p>
                        <p><b>%email%</b>: Email của đại lý</p>
                        <p><b>%address%</b>: Địa chỉ của đại lý</p>
                        <p><b>%birthday%</b>: Ngày sinh của đại lý</p>
                        <p><b>%description%</b>: Giới thiệu bản thân của đại lý</p>
                        <p><b>%banner%</b>: Link banner chia sẻ của đại lý</p>
                    </div>

                    <div class="col-md-6">
                        <p><b>%facebook%</b>: Link trang facebook của đại lý</p>
                        <p><b>%tiktok%</b>: Link trang tiktok của đại lý</p>
                        <p><b>%youtube%</b>: Link trang youtube của đại lý</p>
                        <p><b>%zalo%</b>: Link trang zalo của đại lý</p>
                        <p><b>%web%</b>: Link trang web của đại lý</p>
                        <p><b>%twitter%</b>: Link trang twitter của đại lý</p>
                        <p><b>%linkedin%</b>: Link trang linkedin của đại lý</p>
                    </div>
                    
                </div>
            </div>
        </div>';
}else{
    echo '<div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
                <div class="card-body row">
                    <center>Bạn cần tạo file setting_theme_clone_web.php trong thư mục giao diện</center>
                </div>
            </div>
        </div>';
}
?>