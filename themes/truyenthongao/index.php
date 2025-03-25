
<?php 
    getHeader();
    global $settingThemes;
?>
        <main>
            <section class="bgr-img" style="background-image: url('<?= @$settingThemes['banner'];?>');">
                <section class="hero-section text-white">
                    <div class="container">
                        <h1 class="display-4"><?= @$settingThemes['titleheader'];?></h1>
                        <p class="lead"><?= @$settingThemes['descriptionheader'];?></p>
                    </div>
                </section>
                <section class="features-section py-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-3 text-center mb-4">
                                <div class="feature d-flex ">
                                    <img src="<?= @$settingThemes['image1'];?>" alt="">
                                    <h5><?= @$settingThemes['titlecontent1'];?></h5>
                                </div>
                            </div>
                            <div class="col-lg-3 text-center mb-4">
                                <div class="feature d-flex ">
                                    <img src="<?= @$settingThemes['image2'];?>" alt="">
                                    <h5><?= @$settingThemes['titlecontent2'];?></h5>
                                </div>
                            </div>
                            <div class="col-lg-3 text-center mb-4">
                                <div class="feature d-flex ">
                                    <img src="<?= @$settingThemes['image3'];?>" alt="">
                                    <h5><?= @$settingThemes['titlecontent3'];?></h5>
                                </div>
                            </div>
                            <div class="col-lg-3 text-center mb-4">
                                <div class="feature d-flex ">
                                    <img src="<?= @$settingThemes['image4'];?>" alt="">
                                    <h5><?= @$settingThemes['titlecontent4'];?></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </section>
            <section>
                <div class="container">
                <div class="client-member">
                    <p class="d-flex align-items-center justify-content-center"><?= @$settingThemes['titlecustomer'] ?></p>
                    <div class="brand customer-slider">
                        <?php foreach ($id_slidelistcustomer as $data): ?>
                            <img src="<?php echo $data->image; ?>" alt="Logo khách hàng">
                        <?php endforeach; ?>
                    </div>
                </div>
                </div>
            </section>

            <section class="education-section">
                <div class="container-fluid">
                    <div class="content-wrapper">
                        <!-- Left Column with Heading and Video -->
                        <div class="left-column">
                            <h2><?=@$settingThemes['titleintroduce']?></h2>

                            <div class="video-container">
                                 <iframe 
                                    width="100%" 
                                    height="315" 
                                    src="https://www.youtube.com/embed/<?=@$youtube_code?>" 
                                    title="YouTube video player" 
                                    frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen>
                                </iframe>
                            </div>
                        </div>

                        <!-- Right Column with Information -->
                        <div class="right-column">
                            <p><?=@$settingThemes['descriptionintroduce']?></p>

                            <div class="info-item">
                                <i class="fa-solid fa-circle-check fa-2xl" style="color: #74C0FC;"></i>
                                <div class="info-item-text">
                                    <h3><?=@$settingThemes['vision']?></h3>
                                    <p><?=@$settingThemes['descriptionvision']?></p>
                                </div>
                            </div>
                            <div class="info-item">
                                <i class="fa-solid fa-circle-check fa-2xl" style="color: #74C0FC;"></i>
                                <div class="info-item-text">
                                    <h3><?=@$settingThemes['mission']?></h3>
                                    <p><?=@$settingThemes['descriptionmission']?></p>
                                </div>
                            </div>
                            <div class="info-item">
                                <i class="fa-solid fa-circle-check fa-2xl" style="color: #74C0FC;"></i>
                                <div class="info-item-text">
                                    <h3><?=@$settingThemes['target']?></h3>
                                    <p><?=@$settingThemes['descriptiontarget']?></p>
                                </div>
                            </div>
                            <div class="info-item">
                                <i class="fa-solid fa-circle-check fa-2xl" style="color: #74C0FC;"></i>
                                <div class="info-item-text">
                                    <h3><?=@$settingThemes['business']?></h3>
                                    <p><?=@$settingThemes['descriptionbusiness']?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="schools">
                <div class="container">
                    <!-- Stats Counter -->
                    <div class="schools__stats row text-center mb-5">
                        <h2 class="schools__title col-lg-4"><?=@$settingThemes['titleoperational']?></h2>
                        <div class="parameter col-lg-8">
                            <div class="schools__stat">
                                <h3 class="schools__stat-number"><?=@$settingThemes['numberactive']?></h3>
                                <p class="schools__stat-label"><?=@$settingThemes['yearactive']?></p>
                            </div>
                            <div class="schools__stat">
                                <h3 class="schools__stat-number"><?=@$settingThemes['numbercustomer']?></h3>
                                <p class="schools__stat-label"><?=@$settingThemes['customer']?></p>
                            </div>
                            <div class="schools__stat">
                                <h3 class="schools__stat-number"><?=@$settingThemes['numberevents']?></h3>
                                <p class="schools__stat-label"><?=@$settingThemes['events']?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Schools Grid -->
                    <div class="schools__grid row g-4">
                        <?php foreach ($id_active as $data):?>
                        <div class="col-md-4">
                            <div class="schools__card">
                                <img src="<?php echo $data->image;?>" alt="Trường THPT chuyên Lào Cai" class="schools__card-img">
                                <div class="schools__card-content">
                                    <h4 class="schools__card-title"><b><?php echo $data->title;?></b></h4>
                                    <p class="schools__card-address"><?php echo $data->description;?></p>
                                    <a href="<?php echo $data->link;?>" class="schools__card-link">Tìm hiểu thêm</a>
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>

                    </div>

                    <div class="button__schools text-center mt-4">
                        <a href="/operational" class="schools__view-all btn btn-primary">Xem toàn bộ</a>
                    </div>
                </div>
            </section>

            <section class="pricing">
                <div class="container">
                    <div class="pricing__header">
                        <h2 class="pricing__title"><?=@$settingThemes['pricelist']?></h2>
                        <p class="pricing__description">
                            <?=@$settingThemes['descriptionpricelist']?>
                        </p>
                    </div>

                    <div class="row g-4">
                        <!-- Gói cơ bản -->
                        <div class="col-md-4">
                            <div class="pricing__card">
                                <div class="pricing__card-header">
                                    <h3 class="pricing__card-title"><?=@$settingThemes['pricelistbasic']?></h3>
                                    <p class="pricing__card-subtitle"><?=@$settingThemes['pricelistsmallbasic']?></p>
                                </div>
                                <div class="pricing__card-price">
                                    <h4 class="price"><?=@$settingThemes['pricelistreducebasic']?></h4>
                                    <p class="original-price"><?=@$settingThemes['pricelistPresentbasic']?></p>
                                    <p class="price-note"><?=@$settingThemes['pricelistbasicvat']?></p>
                                </div>
                                <a href="/contact" class="pricing__card-button">Đăng ký ngay</a>
                                <div class="pricing__card-features">
                                <?php for ($i = 1; $i <= 10; $i++): ?>
                                    <?php if (!empty($settingThemes["pricelistreceivebasic$i"])): ?>
                                        <div class="feature-item">
                                            <i class="fas fa-check"></i>
                                            <span><?= $settingThemes["pricelistreceivebasic$i"] ?></span>
                                        </div>
                                    <?php endif; ?>
                                <?php endfor; ?>

                                </div>
                            </div>
                        </div>

                        <!-- Gói đầy đủ -->
                        <div class="col-md-4">
                            <div class="pricing__card">
                                <div class="pricing__card-header">
                                    <h3 class="pricing__card-title"><?=@$settingThemes['pricelistfull']?></h3>
                                    <p class="pricing__card-subtitle"><?=@$settingThemes['pricelistsmallfull']?></p>
                                </div>
                                <div class="pricing__card-price">
                                    <h4 class="price"><?=@$settingThemes['pricelistreducefull']?></h4>
                                    <p class="original-price"><?=@$settingThemes['pricelistPresentfull']?></p>
                                    <p class="price-note"><?=@$settingThemes['pricelistfullvat']?></p>
                                </div>
                                <a href="/contact" class="pricing__card-button">Đăng ký ngay</a>
                                <div class="pricing__card-features">
                                <?php for ($i = 1; $i <= 10; $i++): ?>
                                    <?php if (!empty($settingThemes["pricelistreceivefull$i"])): ?>
                                        <div class="feature-item">
                                            <i class="fas fa-check"></i>
                                            <span><?= $settingThemes["pricelistreceivefull$i"] ?></span>
                                        </div>
                                    <?php endif; ?>
                                <?php endfor; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Gói nâng cao -->
                        <div class="col-md-4">
                            <div class="pricing__card pricing__card--premium">
                            <div class="pricing__card-header">
                                    <h3 class="pricing__card-title"><?=@$settingThemes['pricelistadvanced']?></h3>
                                    <p class="pricing__card-subtitle"><?=@$settingThemes['pricelistsmalladvanced']?></p>
                                </div>
                                <div class="pricing__card-price">
                                    <h4 class="price"><?=@$settingThemes['pricelistreduceadvanced']?></h4>
                                    <p class="original-price"><?=@$settingThemes['pricelistPresentadvanced']?></p>
                                    <p class="price-note"><?=@$settingThemes['pricelistadvancedvat']?></p>
                                </div>
                                <a href="/contact" class="pricing__card-button">Đăng ký ngay</a>
                                <div class="pricing__card-features">
                                    <?php for ($i = 1; $i <= 10; $i++): ?>
                                        <?php if (!empty($settingThemes["pricelistreceiveadvanced$i"])): ?>
                                            <div class="feature-item">
                                                <i class="fas fa-check"></i>
                                                <span><?= $settingThemes["pricelistreceiveadvanced$i"] ?></span>
                                            </div>
                                        <?php endif; ?>
                                    <?php endfor; ?>

                                </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pricing__note">
                        <i class="fas fa-info-circle"></i>
                        <span><?=@$settingThemes['prilistfooter']?></span>
                    </div>
                </div>
            </section>

            <section class="testimonial-section">
                <div class="container"> 
                    <h2 class="text-center section-title">Khách hàng nói gì về chúng tôi</h2>

                    <div class="slick-center-mode">
                        <?php foreach ($datafeedback as $data): ?>
                        <div class="testimonial-item" style="padding: 20px; margin: 0 20px; border: solid 1px; transition: all linear 0.2s;">
                            <div class="testimonial-info" style="display: grid; grid-template-columns: auto auto; gap: 15px;">
                                <div style="">
                                    <img src="<?php echo $data->avatar;?>" alt="">
                                </div>
                                <div>
                                    <h4 style="text-transform: capitalize;"><?php echo $data->position;?></h4>
                                    <p><?php echo $data->full_name;?></p>
                                </div>
                            </div>
                            <div class="testimonial-sub">
                                <p><?php echo $data->content;?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                </div>
            </section>

            <section class="news">
                <div class="container">
                    <div class="news__wrapper">
                        <p class="news__title d-flex align-items-center justify-content-center">Tin tức - Sự kiện</p>
                        <div class="news__carousel">
                             <div class="news__list">
                            <div class="row">
                                <?php foreach ($listDatatop as $key => $value) { ?>
                                    <div class="col-md-4">
                                        <a href="<?php echo $value->slug;?>.html" style="text-decoration: none;">
                                            <div class="news__item">
                                                <div class="news__item-image">
                                                    <img src="<?php echo $value->image;?>" alt="Tin tức 1">
                                                </div>
                                                <div class="news__item-content">
                                                    <h3 class="news__item-title" style="color:#212529"><?php echo $value->title;?></h3>
                                                    <p class="news__item-desc"><?php echo $value->description;?></p>
                                                    <div class="news__item-footer d-flex justify-content-between align-items-center">
                                                        <span class="news__item-date"><?php echo date('d/m/Y', $value->time);?></span>
                                                        <button class="news__item-btn">
                                                            <i class="fa-solid fa-arrow-right fa-xl"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        </div>
                        <!-- View All Button -->
                        <div class="text-center">
                            <a href="\posts" class="news__btn-all" style="text-decoration:none">Xem toàn bộ</a>
                        </div>
                    </div>
                </div>
            </section>

        </main>
<?php getFooter();?>