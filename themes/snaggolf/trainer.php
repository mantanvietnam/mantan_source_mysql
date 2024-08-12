<?php
    getHeader();
    global $settingTrainer;
?>

<main>
    <section class="post-head page-trainer-head">
        <img src="<?= $settingTrainer['banner']?>" alt="">
        <div class="">
            <div class="container">
                <h1>
                    <span class="train-subtitle"><?= $settingTrainer['contentbanner']?></span></h1>
            </div>
        </div>
    </section>
    <section class="page-trainer-content">
        <div class="container">
            <h2><?= $settingTrainer['titledeepbanner']?></h2>
            <p><?= $settingTrainer['contentbanner2']?></p>
            <section class="attr-custom adult">
                <div class="row g-4 g-xl-5">
                    <div class="col-12 col-lg-4">
                        <div class="card-custom shadow-blue">
                            <div class="image-attr">
                                <div class="d-flex align-items-center justify-content-center">
                                    <img src="http://snaggolftour.com/app/Theme/snagGolf/assets/img/attr-user.png" alt="">
                                    <h5 class="mb-0"><?= $settingTrainer['li1']?></h5>
                                </div>
                            </div>
                            <ul>
                                <li>
                                    <?= $settingTrainer['li2']?>
                                </li>
                                <li><?= $settingTrainer['li3']?></li>
                                <li><?= $settingTrainer['li4']?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="card-custom shadow-yelow">
                            <div class="image-attr">
                                <div class="d-flex align-items-center justify-content-center">
                                    <img src="http://snaggolftour.com/app/Theme/snagGolf/assets/img/attr-gift.png" alt="">
                                    <h5 class="mb-0 text-custom-yelow"><?= $settingTrainer['li5']?></h5>
                                </div>
                            </div>
                            <ul>
                                <li>
                                    <?= $settingTrainer['li6']?>
                                </li>
                                <li>
                                    <?= $settingTrainer['li7']?>
                                </li>
                                <li>
                                    <?= $settingTrainer['li8']?>
                                </li>
                                <li>
                                    <?= $settingTrainer['li9']?>
                                </li>
                                <li>
                                    <?= $settingTrainer['li10']?>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="card-custom shadow-green">
                            <div class="image-attr">
                                <div class="d-flex align-items-center justify-content-center">
                                    <img src="http://snaggolftour.com/app/Theme/snagGolf/assets/img/attr-message.png" alt="">
                                    <h5 class="mb-0 text-custom-green"><?= $settingTrainer['li11']?></h5>
                                </div>
                            </div>
                            <ul>
                                <li>
                                    <?= $settingTrainer['li12']?>
                                </li>
                                <li>
                                    <?= $settingTrainer['li13']?>
                                </li>
                                <li>
                                    <?= $settingTrainer['li14']?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            <div class="last">
                <p><?= $settingTrainer['li15']?></p>

<p>&nbsp;</p>

<p><?= $settingTrainer['li16']?></p>
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
<?php getFooter();?>