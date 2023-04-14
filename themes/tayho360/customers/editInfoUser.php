<?php
getHeader();
global $urlThemeActive;
global $session;
$info = $session->read('infoUser');
?>
<main>
        <div class="container py-5">
            <section id="user-page">
                <div class="row g-0">
                    <div class="col-12 col-lg-3 bg-white">
                        <section class="side-bar h-100">
                            <div class="background h-100">
                                <a href="/infoUser" >Cá nhân</a>
                                <a href="/pourpassword">Đổi mật khẩu</a>
                                <a href="/editInfoUser" class="active">Sửa thông tin </a>
                            </div>
                        </section>
                    </div>
                    <div class="col-12 col-lg-9 bg-white">
                        <section class="content p-2 p-md-4 pe-md-5">
                            <div class="user-edit pe-md-5">
                                <form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data"  onsubmit="functions.submitForgot(); return false;">
                                    <input type="hidden" value="<?php echo $csrfToken;?>" name="_csrfToken">
                                    <div class="top">
                                        <div class="d-flex">
                                            <div class="edit-user-photo me-3">
                                                <label for="" style="font-size: 23px; margin-bottom: 10px;">Ảnh đạt diện</label>

                                                <div class="m_bg_img" style="">
                                                    <input type="file" onchange="readURL1(this);" name="avatar">

                                                    <img id="img1" src="<?php echo @$info->avatar ?>" style="width: 110px" class="img-responsive">
                                                </div>
                                            </div>
                                            <div>
                                               <!--  <div class="d-flex align-items-center justify-content-between mb-2">
                                                    <h1 class="user-name mb-0">Esther Howard</h1>
                                                </div>
                                                <address>8502 Preston Rd. Inglewood, Maine 98380</address> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="body mt-3">
                                        <div class="row g-3">
                                                <div class="col-12">
                                                    <div class="form-group-user">
                                                        <label for="">Họ và tên</label>
                                                        <input type="text" placeholder="Esther Howard" name="full_name" value="<?php echo @$info->full_name ?>" class="form-control"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group-user">
                                                        <label for="">Địa chỉ</label>
                                                        <input type="text" value="<?php echo @$info->address ?>" name="address" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-12">
                                                    <div class="form-group-user">
                                                        <label for="">Số điện thoại</label>
                                                        <input type="text"  name="phone" value="<?php echo @$info->phone ?>" class="form-control"
                                                            required>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-12 col-md-6">
                                                    <div class="form-group-user">
                                                        <label for="">Email</label>
                                                        <input type="text" placeholder="abc@gmail.com" value="<?php echo @$info->phone ?>" class="form-control"
                                                            required>
                                                    </div>
                                                </div> -->
                                                <button class="mt-3 btn button-submit-custom">Lưu</button>
                                            
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </section>
                    </div>
                </div>
            </section>
        </div>
    </main>

       <script>
        function readURL1(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#img1')
                        .attr('src', e.target.result);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }


    </script>
     <style>
    .thaydoi{
        padding: 0 20px;
    }
    .m_bg_img {
     width: 140px;
     height: 140px;
     overflow: hidden;
     display: flex;
     justify-content: center;
     align-items: center;
     border: 1px solid #ddd;
     max-width: 100%;
     border-radius: 50%;
     overflow: hidden;
     background: white;
 }
 input[type=file] {
    display: block;
    filter: alpha(opacity=0);
    height: 100%;
    width: 100%;
    opacity: 0;
    position: absolute;
    right: 0;
    text-align: right;
    top: 0;
    cursor: pointer;
    z-index: 5;
}
.m_bg_img img {
    max-width: 100%!important;
}
</style>        

    <?php
getFooter();?>