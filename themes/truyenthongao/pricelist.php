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
                                <a href="#" class="pricing__card-button">Đăng ký ngay</a>
                                <div class="pricing__card-features">
                                    <div class="feature-item">
                                        <i class="fas fa-check"></i>
                                        <span><?=@$settingThemes['pricelistreceivebasic1']?></span>
                                    </div>
                                    <div class="feature-item">
                                        <i class="fas fa-check"></i>
                                        <span><?=@$settingThemes['pricelistreceivebasic2']?></span>
                                    </div>
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
                                <a href="#" class="pricing__card-button">Đăng ký ngay</a>
                                <div class="pricing__card-features">
                                    <div class="feature-item">
                                        <i class="fas fa-check"></i>
                                        <span><?=@$settingThemes['pricelistreceivefull1']?></span>
                                    </div>
                                    <div class="feature-item">
                                        <i class="fas fa-check"></i>
                                        <span><?=@$settingThemes['pricelistreceivefull2']?></span>
                                    </div>
                                    <div class="feature-item">
                                        <i class="fas fa-check"></i>
                                        <span><?=@$settingThemes['pricelistreceivefull3']?></span>
                                    </div>
                                    <div class="feature-item">
                                        <i class="fas fa-check"></i>
                                        <span><?=@$settingThemes['pricelistreceivefull4']?></span>
                                    </div>
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
                                <a href="#" class="pricing__card-button">Đăng ký ngay</a>
                                <div class="pricing__card-features">
                                    <div class="feature-item">
                                        <i class="fas fa-check"></i>
                                        <span><?=@$settingThemes['pricelistreceiveadvanced1']?></span>
                                    </div>
                                    <div class="feature-item">
                                        <i class="fas fa-check"></i>
                                        <span><?=@$settingThemes['pricelistreceiveadvanced2']?></span>
                                    </div>
                                    <div class="feature-item">
                                        <i class="fas fa-check"></i>
                                        <span><?=@$settingThemes['pricelistreceiveadvanced3']?></span>
                                    </div>
                                    <div class="feature-item">
                                        <i class="fas fa-check"></i>
                                        <span><?=@$settingThemes['pricelistreceiveadvanced4']?></span>
                                    </div>
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