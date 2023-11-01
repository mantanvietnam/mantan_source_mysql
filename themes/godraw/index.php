<?php getHeader();?>

<style>
	footer {
		display: none;
	}
</style>
<main>
    <div class="full-home-slider">
        <div class="item-slide">
            <section class="box-banner-home">
                <div class="video-banner">
                    <video loop="loop" autoplay="autoplay" muted="" defaultmuted="" playsinline="" oncontextmenu="return false;" preload="auto">
                        <source src="https://zhizhibo.vn/demo/kallisto/video/Us_Hero_Banner_Compress.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <div class="social-home">
                    <ul>
                        <li><a href="" target="_blank"><img src="<?php echo $urlThemeActive;?>/images/sc-1.svg" class="img-fluid" alt=""></a></li>
                        <li><a href="" target="_blank"><img src="<?php echo $urlThemeActive;?>/images/sc-2.svg" class="img-fluid" alt=""></a></li>
                        <li><a href="" target="_blank"><img src="<?php echo $urlThemeActive;?>/images/sc-3.svg" class="img-fluid" alt=""></a></li>
                        <li><a href="" target="_blank"><img src="<?php echo $urlThemeActive;?>/images/sc-4.svg" class="img-fluid" alt=""></a></li>
                        <li><a href="" target="_blank"><img src="<?php echo $urlThemeActive;?>/images/sc-5.svg" class="img-fluid" alt=""></a></li>
                    </ul>
                </div>
                <div class="btn-main text-center text-uppercase"><a href="">GALLERY</a></div>
            </section>
        </div>
        <div class="item-slide">
            <section class="box-gallery">
                <div class="container">
                    <div class="content-slide-gallery">
                        <div class="title-slide-vote">
                            <div class="icon"><img src="<?php echo $urlThemeActive;?>/images/top-vote.svg" class="img-fluid" alt=""></div>
                            <span>TOP VOTE</span>Community gallery
                        </div>
                        <div class="content-slider">
                            <div class="slider-hot-nav">
                                <div class="slide-top slider-nav">
                                    <?php
                                    for ($x = 0; $x <= 7; $x++) { ?>
                                        <div class="item-slide">
                                            <div class="item-avr"><img src="<?php echo $urlThemeActive;?>/images/slide.jpg" class="img-fluid w-100" alt=""></div>
                                        </div>
                                    <?php }
                                    ?>
                                </div>
                            </div>
                            <div class="slide-bot">
                                <div class="slider-for">
                                    <?php
                                    for ($x = 0; $x <= 7; $x++) { ?>
                                        <div class="item-slide">
                                            <div class="item-for">
                                                <div class="avr"><img src="<?php echo $urlThemeActive;?>/images/slide.jpg" class="img-fluid w-100" alt=""></div>
                                                <div class="icon-screen"><img src="<?php echo $urlThemeActive;?>/images/screen.svg" class="img-fluid" alt=""></div>
                                                <div class="heart">
                                                    <span>25</span><img src="<?php echo $urlThemeActive;?>/images/heart.svg" class="img-fluid" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    <?php }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="view-all all-top-view">
                        <a href="">
                            <img src="<?php echo $urlThemeActive;?>/images/serch.svg" class="img-fluid" alt=""><span>VIEW ALL</span>
                        </a>
                    </div>
                </div>
            </section>
        </div>
        <div class="item-slide">
            <section class="box-search">
                <div class="container">
                    <div class="content-search">
                        <div class="head-search">
                            <ul class="d-flex justify-content-center">
                                <li><img src="<?php echo $urlThemeActive;?>/images/search-1.svg" class="img-fluid" alt=""></li>
                                <li>Find places to experience</li>
                                <li><img src="<?php echo $urlThemeActive;?>/images/search-2.svg" class="img-fluid" alt=""></li>
                            </ul>
                        </div>
                        <form action="">
                            <div class="frm-search">
                                <div class="item">
                                    <input type="text" placeholder="search ...." class="txt_field">
                                    <div class="icon">
                                        <svg width="35" height="36" viewBox="0 0 35 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4.41162 35.9102L13.4617 26.8599C15.4217 27.9099 17.6618 28.5098 20.0518 28.5098C27.7918 28.5098 34.0818 22.23 34.0818 14.48C34.0818 6.72998 27.8018 0.450195 20.0518 0.450195C12.3018 0.450195 6.02173 6.72998 6.02173 14.48C6.02173 17.97 7.30163 21.1499 9.42163 23.6099L0.761719 32.27L4.41162 35.9102ZM20.0518 23.3501C15.1418 23.3501 11.1816 19.38 11.1816 14.48C11.1816 9.57998 15.1518 5.6001 20.0518 5.6001C24.9518 5.6001 28.9216 9.56998 28.9216 14.48C28.9216 19.37 24.9518 23.3501 20.0518 23.3501Z" fill="#F2F2F2"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="item text-center">
                                    <button><img src="<?php echo $urlThemeActive;?>/images/search-3.svg" class="img-fluid" alt=""></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
        <div class="item-slide">
            <section class="box-maps">
                <div class="container">
                    <div class="title text-center mb-0">
                        <span>Find places to experience</span>
                        <svg width="1182" height="58" viewBox="0 0 1182 58" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1181.45 57.9501H0.28125V46.8002C0.28125 21.1802 21.0513 0.410156 46.6713 0.410156H1135.05C1160.67 0.410156 1181.44 21.1802 1181.44 46.8002V57.9501H1181.45Z" fill="#1A3A89"/>
                        </svg>
                    </div>
                    <div class="content-maps">
                        <div class="maps-left">
                            <div class="content-maps-left">
                                <div class="search-maps-left">
                                    <form action="">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="item"><input type="text" class="txt_field w-100" placeholder="search ...."></div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-6">
                                                <div class="item"><input type="text" class="txt_field w-100" placeholder="...."></div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-6">
                                                <div class="item"><input type="text" class="txt_field w-100" placeholder="...."></div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="list-showroom">
                                    <div class="item-showroom">
                                        <div class="avr"><img src="https://plugins.webmau68.com/wp-content/uploads/2022/04/noi-that-o-to-hoang-thanh-zestech.jpg" class="img-fluid w-100" alt=""></div>
                                        <div class="info">
                                            <h3>Place showroom 1</h3>
                                            <ul>
                                                <li>586 Lê Đại Hành, TDP Hưng Bình, Phường Sông Trí, Thị xã Kỳ Anh, Tỉnh Hà Tĩnh</li>
                                                <li>0987.022.025 - 0947.022.025</li>
                                                <li>admin@your-domain.com</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="item-showroom">
                                        <div class="avr"><img src="https://plugins.webmau68.com/wp-content/uploads/2022/04/noi-that-o-to-hoang-thanh-zestech.jpg" class="img-fluid w-100" alt=""></div>
                                        <div class="info">
                                            <h3>Place showroom 1</h3>
                                            <ul>
                                                <li>586 Lê Đại Hành, TDP Hưng Bình, Phường Sông Trí, Thị xã Kỳ Anh, Tỉnh Hà Tĩnh</li>
                                                <li>0987.022.025 - 0947.022.025</li>
                                                <li>admin@your-domain.com</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="item-showroom">
                                        <div class="avr"><img src="https://plugins.webmau68.com/wp-content/uploads/2022/04/noi-that-o-to-hoang-thanh-zestech.jpg" class="img-fluid w-100" alt=""></div>
                                        <div class="info">
                                            <h3>Place showroom 1</h3>
                                            <ul>
                                                <li>586 Lê Đại Hành, TDP Hưng Bình, Phường Sông Trí, Thị xã Kỳ Anh, Tỉnh Hà Tĩnh</li>
                                                <li>0987.022.025 - 0947.022.025</li>
                                                <li>admin@your-domain.com</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="item-showroom">
                                        <div class="avr"><img src="https://plugins.webmau68.com/wp-content/uploads/2022/04/noi-that-o-to-hoang-thanh-zestech.jpg" class="img-fluid w-100" alt=""></div>
                                        <div class="info">
                                            <h3>Place showroom 1</h3>
                                            <ul>
                                                <li>586 Lê Đại Hành, TDP Hưng Bình, Phường Sông Trí, Thị xã Kỳ Anh, Tỉnh Hà Tĩnh</li>
                                                <li>0987.022.025 - 0947.022.025</li>
                                                <li>admin@your-domain.com</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="item-showroom">
                                        <div class="avr"><img src="https://plugins.webmau68.com/wp-content/uploads/2022/04/noi-that-o-to-hoang-thanh-zestech.jpg" class="img-fluid w-100" alt=""></div>
                                        <div class="info">
                                            <h3>Place showroom 1</h3>
                                            <ul>
                                                <li>586 Lê Đại Hành, TDP Hưng Bình, Phường Sông Trí, Thị xã Kỳ Anh, Tỉnh Hà Tĩnh</li>
                                                <li>0987.022.025 - 0947.022.025</li>
                                                <li>admin@your-domain.com</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="item-showroom">
                                        <div class="avr"><img src="https://plugins.webmau68.com/wp-content/uploads/2022/04/noi-that-o-to-hoang-thanh-zestech.jpg" class="img-fluid w-100" alt=""></div>
                                        <div class="info">
                                            <h3>Place showroom 1</h3>
                                            <ul>
                                                <li>586 Lê Đại Hành, TDP Hưng Bình, Phường Sông Trí, Thị xã Kỳ Anh, Tỉnh Hà Tĩnh</li>
                                                <li>0987.022.025 - 0947.022.025</li>
                                                <li>admin@your-domain.com</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="item-showroom">
                                        <div class="avr"><img src="https://plugins.webmau68.com/wp-content/uploads/2022/04/noi-that-o-to-hoang-thanh-zestech.jpg" class="img-fluid w-100" alt=""></div>
                                        <div class="info">
                                            <h3>Place showroom 1</h3>
                                            <ul>
                                                <li>586 Lê Đại Hành, TDP Hưng Bình, Phường Sông Trí, Thị xã Kỳ Anh, Tỉnh Hà Tĩnh</li>
                                                <li>0987.022.025 - 0947.022.025</li>
                                                <li>admin@your-domain.com</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="item-showroom">
                                        <div class="avr"><img src="https://plugins.webmau68.com/wp-content/uploads/2022/04/noi-that-o-to-hoang-thanh-zestech.jpg" class="img-fluid w-100" alt=""></div>
                                        <div class="info">
                                            <h3>Place showroom 1</h3>
                                            <ul>
                                                <li>586 Lê Đại Hành, TDP Hưng Bình, Phường Sông Trí, Thị xã Kỳ Anh, Tỉnh Hà Tĩnh</li>
                                                <li>0987.022.025 - 0947.022.025</li>
                                                <li>admin@your-domain.com</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="maps-right">
                            <div class="avr-maps"><img src="<?php echo $urlThemeActive;?>/images/maps.jpg" class="img-fluid w-100" alt=""></div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>

<?php getFooter();?>


