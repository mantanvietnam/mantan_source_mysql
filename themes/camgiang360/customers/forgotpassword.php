<?php
// session_start();
getHeader();
?>
    <main class="bg-pt py-4">
        <section class="section-heading lien-he-heading">
            <h3 class="text-uppercase text-center my-5">Tài khoản</h3>
        </section>
        <section id="lien-he-contain">
            <div class="background">
                <div class="container">
                    <div class="row g-0">
                        <div class="col-12 col-lg-7 h-100">
                            <section class="lien-he-form h-100">
                                <form id="formContact" action="" method="post" class="form-custom-1 py-3">
                                    <input type="hidden" value="<?php echo $csrfToken; ?>" name="_csrfToken">
                                    <div class="card h-100">
                                        <div class="card-body p-lg-5">
                                            <h3 CLASS="fs-2 mb-5">Quên mật khẩu</h3>
                                            <div class="row g-3">
                                                <?php echo $mess;?>
                                                <div class="col-12 col-md-12">
                                                    <label class="mb-2">Địa chỉ email</label>
                                                    <input name="email" type="email" class="form-control" placeholder="" required>
                                                </div>
                                                
                                                
                                                <div class="col-12 col-md-4">
                                                    <button id="formBTNSubmit" class="btn btn-primary mb-3" style="">
                                                        Đăng nhập
                                                    </button>
                                                </div>

                                                <div class="col-12 col-md-8 mt-3">
                                                    Bạn đã có tài khoản? <a href="/login">Đăng nhập</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </section>
                        </div>
                        <div class="col-12 col-lg-5">
                            <section class="contact-info">
                                <div class="card contain">
                                    <div class="card-body p-lg-5">
                                        <h3>Liên hệ chúng tôi</h3>
                                        <div class="info-list">
                                            <div class="list-info mb-4">
                                                <div class="d-flex align-items-center">
                                                    <img
                                                        src="<?= $urlThemeActive ?>assets/lou_icon/icon-location-white.svg"
                                                        class="me-3"
                                                        alt="">
                                                    <span>
                                                        <?= $contactSite["address"] ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="list-info mb-4">
                                                <div class="d-flex align-items-center">
                                                    <img
                                                        src="<?= $urlThemeActive ?>assets/lou_icon/icon-phone-white.svg"
                                                        class="me-3"
                                                        alt="">
                                                    <span>
                                                        <?= $contactSite["phone"] ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="list-info mb-4">
                                                <div class="d-flex align-items-center">
                                                    <img src="<?= $urlThemeActive ?>assets/lou_icon/icon-email.svg"
                                                         class="me-3" alt="">
                                                    <span>
                                                        <?= $contactSite["email"] ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="list-info mb-4">
                                                <div class="d-flex align-items-center">
                                                    <img src="<?= $urlThemeActive ?>assets/lou_icon/icon-global.svg"
                                                         class="me-3" alt="">
                                                    <span>
                                                        https://camgiang360.vn
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php
getFooter();


