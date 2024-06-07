

<?php getHeader();?>


    <main>
        <section id="section-banner-top">
            <div class="container">
                <div class="banner-contain">
                    <div class="desktop-banner">
                        <img src="<?=$urlThemeActive?>asset/image/teamwork.png" alt="">
                    </div>
                    <div class="banner-contain-title">
                        <p>Tin Tức</p>
                        <h3>Những <span>Tin tức</span> mới <br> từ chúng tôi</h3>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-all-posts">
            <div class="container">
                <div class="list-post">
                    <div class="row">
                   
                    <?php if(!empty($listDataPost)){
                            foreach($listDataPost as $item){ ?>
                        <div class="item-post col-lg-4 col-md-6 col-sm-12">
                       
                            <div class="post-content">
                                <div class="post-img">
                                    <a href=""><img src="<?php echo $item->image; ?>" alt=""></a>
                                </div>
                                <div class="post-detail">
                                    <div class="post-timepost">
                                        <i class="fa-regular fa-calendar-days" aria-hidden="true"></i>
                                        <p><?php echo $item->time; ?></p>
                                    </div>
                                    <div class="post-title">
                                        <a href="/<?php echo @$item->slug ?>.html" tabindex="0"><?php echo $item->title; ?></a>
                                    </div>
                                    <div class="post-text">
                                        <p><?php echo $item->description; ?></p>
                                    </div>
                                    <div class="post-btn">
                                        <a href="/<?php echo @$item->slug ?>.html">Xem chi tiết <i class="fa-solid fa-arrow-right-long"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }} ?>
                    </div>
                </div>
                <div class="post-pagenation">
                    <div class="pagenation-arrow pagenation-prev">
                        <button><i class="fa-solid fa-chevron-left"></i></button>
                    </div>

                    <div class="page-number">
                        <button>1</button>
                        <button>2</button>
                        <button class="no-event">...</button>
                        <button>5</button>
                        <button>6</button>
                    </div>

                    <div class="pagenation-arrow pagenation-next">
                        <button><i class="fa-solid fa-chevron-right"></i></button>
                    </div>
                </div>
            </div>

        </section>

    </main>

<?php 
    getFooter();
?>


