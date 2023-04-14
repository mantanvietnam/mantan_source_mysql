<?php
global $session;
$info = $session->read('infoUser');
getHeader();
?>


<main class="bg-pt" style="background-image: url('/themes/tayho360/assets/lou_img/background-pattern.png')">
    <div class="container py-5">
        <section id="user-page" class="bg-white">
            <div class="row g-0">
                <div class="col-12 col-lg-3">
                    <section class="side-bar h-100">
                        <div class="background h-100">
                            <a href="/infoUser" class="active">Cá nhân</a>
                            <a href="/pourpassword">Đổi mật khẩu</a>
                            <a href="/editInfoUser">Sửa thông tin </a>
                        </div>
                    </section>
                </div>
                <div class="col-12 col-lg-9">
                    <section class="content p-2 p-md-4">
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <div class="user-image px-4">
                                    <img id="img1" src="<?= $info->avatar ?>" style="width: 110px"
                                         class="img-responsive">
                                </div>
                            </div>
                            <div class="col-12 col-md-8">
                                <div class="user-info">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <h1 class="user-name mb-0"><?= $info->full_name ?></h1>
                                    </div>
                                    <div class="info-detail">
                                        <div class="cate-contain mb-4">
                                            <p class="label">Thông tin</p>
                                            <div class="d-flex item">
                                                <span>Số điện thoại</span>
                                                <span><?= $info->phone ?></span>
                                            </div>
                                            <div class="d-flex item">
                                                <span>Email</span>
                                                <span><?= $info->email ?></span>
                                            </div>
                                            <div class="d-flex item">
                                                <span>Địa chỉ</span>
                                                <span><?= $info->address ?></span>
                                            </div>
                                            <!-- <div class="d-flex item">
                                                <span>Liên hệ</span>
                                                <span>https://www.facebook.com/abc</span>
                                            </div> -->
                                        </div>
                                        <!-- <div class="cate-contain">
                                            <p class="label">Chung</p>
                                            <div class="d-flex item">
                                                <span>Ngày sinh</span>
                                                <span>01/01/1999</span>
                                            </div>
                                        </div> -->
                                    </div>

                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    </div>
</main>
<style>
    #img1{
        height: 110px;
        border-radius: 50%;
        object-fit: cover;
    }
</style>
<?php
getFooter();
?>
