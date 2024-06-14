<?php
    getHeader();
    global $urlThemeActive;
    global $settingTrainer;
?>

<main>
    <section class="post-head page-trainer-head">
        <img src="<?php echo $urlThemeActive; ?>assets/img/page-trainer-header.png" alt="">
        <div class="">
            <div class="container">
                <h1>
                    <?php echo @$settingTrainer['trainer_title']; ?>
                </h1>
            </div>
        </div>
    </section>
    <section class="page-trainer-content">
        <div class="container">
            <h2>Thông tin chung</h2>
            <p>
                <?php echo @$settingTrainer['content_info_trainer_course']; ?>
            </p>
            <section class="attr-custom adult">
                <div class="row g-4 g-xl-5">
                    <div class="col-12 col-lg-4">
                        <div class="card-custom shadow-blue">
                            <div class="image-attr">
                                <div class="d-flex align-items-center justify-content-center">
                                    <img src="<?php echo $urlThemeActive; ?>assets/img/attr-user.png" alt="">
                                    <h5 class="mb-0"><?php echo @$settingTrainer['trainer_title_1']; ?></h5>
                                </div>
                            </div>
                            <ul>
                                <?php echo @$settingTrainer['trainer_content_1']; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="card-custom shadow-yelow">
                            <div class="image-attr">
                                <div class="d-flex align-items-center justify-content-center">
                                    <img src="<?php echo $urlThemeActive; ?>assets/img/attr-gift.png" alt="">
                                    <h5 class="mb-0 text-custom-yelow"><?php echo @$settingTrainer['trainer_title_2']; ?></h5>
                                </div>
                            </div>
                            <ul>
                                <?php echo @$settingTrainer['trainer_content_2']; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="card-custom shadow-green">
                            <div class="image-attr">
                                <div class="d-flex align-items-center justify-content-center">
                                    <img src="<?php echo $urlThemeActive; ?>assets/img/attr-message.png" alt="">
                                    <h5 class="mb-0 text-custom-green"><?php echo @$settingTrainer['trainer_title_3']; ?></h5>
                                </div>
                            </div>
                            <ul>
                                <?php echo @$settingTrainer['trainer_content_3']; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            <div class="last">
                <?php echo @$settingTrainer['trainer_paragraph']; ?>
            </div>
            <div class="d-flex justify-content-center">
                <span>
                    <button class="custom-button button-reg button-green" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        ĐĂNG KÝ NGAY
                    </button>
                </span>
            </div>
        </div>
    </section>
</main>


<?php
getFooter();
?>