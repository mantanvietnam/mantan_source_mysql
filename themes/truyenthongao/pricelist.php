<?php 
    getHeader();
    global $settingThemes;
?>
<main>
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
</main>


<?php getFooter();?>