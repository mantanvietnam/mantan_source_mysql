<?php 
    getheader();
    
?>
 <main>

<section id="dtf-section-1">
    <div class="dtfs-banner">
        <div class="dtfs-block-1">
            <img src="<?= $field['imagebanner']?>" alt="">
        </div>
        <div class="dtfs-block-2">
            <h1><?= $field['name']?></h1>
        </div>
        <div class="dtfs-block-3">
            <a href=""><img src="<?= $urlThemeActive?>asset/images/Artboard 3 3.png" alt=""></a>
            <p><span>By</span> CECAD</p>
            <div id="mouse-scroll">
                <div class="mouse">
                    <div class="mouse-in"></div>
                </div>
                <div>
                    <span class="down-arrow-1"></span>
                    <span class="down-arrow-2"></span>
                    <span class="down-arrow-3"></span>
                </div>
            </div>
        </div>
        <div class="banner-home">
            <a href=""><i class="fa-solid fa-house"></i></a>
        </div>
    </div>
</section>

<section id="dtf-section-2">
    <div class="container">
        <div class="dtfs2-block-1">
            <div class="dtfs2-block-1-title" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom">
                <h2><?= $field['title1']?></h2>
            </div>
            <div class="dtfs2-block-1-text" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom">
                <p>
                    <?= $field['content1']?>
                </p>
            </div>
        </div>
    </div>
</section>

<section id="dtf-section-3" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-12">
                <div class="dtfs3-block-1">
                    <a href="<?= $urlThemeActive?>asset/images/oei_company_news.png" data-fancybox="gallery">
                    <?php if(!empty($field['image1'])): ?>
                        <img src="<?= $field['image1']?>" alt="Thumbnail">
                    <?php endif;?>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <div class="dtfs3-block-2">
                    <p><?= $field['content2']?></p>
                    
                </div>
            </div>
        </div>
    </div>
</section>

<section id="dtf-section-4">
    <div class="container">
        <div class="dtfs4-block-1-text" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom">
            <p>
                <?= $field['content3']?>
            </p>
        </div>
    </div>
</section>

<section id="dtf-section-5" style="background-image: url(<?= $field['image2']?>);">
</section>

<section id="dtf-section-6">
    <div class="dtfs6-block-1" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom">
        <div class="container">
            <p>
                <?= $field['content4']?>
            </p>
        </div>
    </div>
    <div class="dtfs6-block-2" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom">
        <div class="container">
            <div class="dtfs6-block-2-gallery">
                <a href="<?= $urlThemeActive?>asset/images/original.webp" data-fancybox="gallery">
                <?php if(!empty($field['image3'])):?>
                    <img src="<?= $field['image3']?>" alt="Thumbnail">
                <?php endif;?>
                </a>
                <a href="<?= $urlThemeActive?>asset/images/oei_company_news.png" data-fancybox="gallery">
                <?php if(!empty($field['image4'])) :?>
                    <img src="<?= $field['image4']?>" alt="Thumbnail">
                <?php endif;?>
                </a>
            </div>
        </div>
    </div>
</section>

<section id="dtfs7-block-2">
    <div class="container">
        <div class="dtfs7-block-1" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom">
            <p>© 2024 <a href="">CECAD</a></p>
        </div>
        <div class="dtfs7-block-2" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom">
            <div class="dtfs7-block-2-img">
                <img src="<?= $urlThemeActive?>asset/images/Artboard 3 2.png" alt="">
            </div>
            <div class="dtfs7-block-2-sub">
                <p>Hãy đồng hành cùng chúng tôi qua những câu chuyện trên con đường bảo vệ và gìn giữ thế giới tự nhiên của Việt Nam, vì một tương lai nơi con người và muôn loài hoang dã cùng nhau phát triển.</p>
            </div>
        </div>
    </div>
</section>

</main>
<?php 
    getFooter();
?>