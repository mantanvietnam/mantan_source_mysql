<?php
	global $urlThemeActive; 
	getHeader(); 
?>
<main>

        <section id="section-post-detail">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-12">
                        <div class="post-content">
                            <div class="post-breadcrumbs">
                                <p><a href="/">Home</a> <i class="fa-solid fa-caret-right"></i> <a href="/posts">Tin tức</a> <i class="fa-solid fa-caret-right"></i> <?php echo @$post->title; ?></p>
                            </div>

                            <div class="post-title">
                                <h1><?php echo @$post->title; ?></h1>
                                <p><i class="fa-regular fa-calendar-days"></i> <?php echo date('d/m/Y', $post->time);?></p>
                            </div>

                            <div class="post-content-detail-img">
                                <img src="<?php echo @$post->image; ?>">
                            </div>

                            <div class="post-content-detail">
                                <?php echo @$post->description; ?>
                            </div>
                        </div>

                        <div class="other-post">
                            <div class="other-post-title">
                                <h2>
                                    Bài viết liên quan
                                </h2>
                            </div>
                            <div class="list-other-post">
                                <div class="row">
                                    <?php 
                                            if(!empty($otherPosts)){
                                                foreach ($otherPosts as $key => $value) {
                                                    $link = '/'.$value->slug.'.html';

                                                    echo '<div class="col-lg-6 col-md-6 col-sm-12">
                                                            <div class="item-other-post">
                                                                <div class="item-other-post-img">
                                                                    <a href="'.$link.'" tabindex="0"><img src="'.$value->image.'" alt=""></a>
                                                                </div>

                                                                <div class="item-other-post-date">
                                                                    <p>
                                                                        <i class="fa-regular fa-calendar-days aria-hidden="true"></i> <span class="date">'.date('d/m/Y', $value->time).'</span>
                                                                    </p>
                                                                </div>

                                                                <div class="item-other-post-name">
                                                                    <h3 class="item-other-post-title">
                                                                        <a href="'.$link.'">'.$value->title.'</a>
                                                                    </h3>
                                                                </div>

                                                                <div class="post-text">
                                                                    <p>'.$value->description.'</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        ';
                                                    }
                                                }
                                            ?>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-4 col-12">
                        <div class="outstanding-post">
                            <h3>
                                Bài viết nổi bật
                            </h3>

                            <div class="list-outstanding-post">
                                <div class="row">
                                    <?php 
                                        if(!empty($otherPosts)){
                                            foreach ($otherPosts as $key => $value) {
                                                $link = '/'.$value->slug.'.html';

                                                echo '<div class="item-outstanding-post col-lg-12 no-padding">
                                                        <div class="col-lg-5 no-padding outstanding-np">
                                                            <div class="outstanding-post-img">
                                                                <a href="'.$link.'"><img src="'.$value->image.'" alt=""></a>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-7">
                                                            <div class="outstanding-post-info">
                                                                <h3 class="outstanding-post-title">
                                                                    <a href="'.$link.'">'.$value->title.'</a>
                                                                </h3>
                                                                <p>
                                                                    <i class="fa-regular fa-calendar-days aria-hidden="true"></i> <span class="date">'.date('d/m/Y', $value->time).'</span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>';
                                                }
                                            }
                                        ?>
                                </div>
                            </div>
                        </div>

                        <div class="post-detail-pg-services fixedsticky">
                            <h3>
                                Dịch vụ tại Top Top
                            </h3>

                            <div class="pg-slide-services">
                                <div class="pg-item-img">
                                    <img src="<?php echo @$urlThemeActive; ?>/asset/image/toptop-pen.jpg" alt="">
                                </div>

                                <div class="pg-item-img">
                                    <img src="<?php echo @$urlThemeActive; ?>/asset/image/toptop-pen.jpg" alt="">
                                </div>

                                <div class="pg-item-img">
                                    <img src="<?php echo @$urlThemeActive; ?>/asset/image/toptop-pen.jpg" alt="">
                                </div>

                            </div>

                            <div class="pg-list-services">
                                <div class="list-pg-services">
                                    <div class="row">
                                        <div class="item-pg-services col-lg-12 col-md-6 col-sm-12">
                                            <div class="services-block">
                                                <div class="pg-services-img">
                                                    <a href=""><img src="<?php echo @$urlThemeActive; ?>/asset/image/toptop-car.jpg" alt=""></a>
                                                </div>

                                                <div class="pg-services-info">
                                                    <a href="">Thiết Kế Website Thời Trang Đẹp, Ấn Tượng, Thu Hút Khách Hàng</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item-pg-services col-lg-12 col-md-6 col-sm-12">
                                            <div class="services-block">
                                                <div class="pg-services-img">
                                                    <a href=""><img src="<?php echo @$urlThemeActive; ?>/asset/image/toptop-car.jpg" alt=""></a>
                                                </div>

                                                <div class="pg-services-info">
                                                    <a href="">Thiết Kế Website Thời Trang Đẹp, Ấn Tượng, Thu Hút Khách Hàng</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item-pg-services col-lg-12 col-md-6 col-sm-12">
                                            <div class="services-block">
                                                <div class="pg-services-img">
                                                    <a href=""><img src="<?php echo @$urlThemeActive; ?>/asset/image/toptop-car.jpg" alt=""></a>
                                                </div>

                                                <div class="pg-services-info">
                                                    <a href="">Thiết Kế Website Thời Trang Đẹp, Ấn Tượng, Thu Hút Khách Hàng</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item-pg-services col-lg-12 col-md-6 col-sm-12">
                                            <div class="services-block">
                                                <div class="pg-services-img">
                                                    <a href=""><img src="<?php echo @$urlThemeActive; ?>/asset/image/toptop-car.jpg" alt=""></a>
                                                </div>

                                                <div class="pg-services-info">
                                                    <a href="">Thiết Kế Website Thời Trang Đẹp, Ấn Tượng, Thu Hút Khách Hàng</a>
                                                </div>
                                            </div>
                                        </div>



                                    </div>

                                </div>
                            </div>

                            <div class="all-services-btn">
                                <a href="/services">Xem thêm tất cả dịch vụ của Top Top <i class="fa-solid fa-arrow-right-long"></i></a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

    </main>
<?php getFooter(); ?>