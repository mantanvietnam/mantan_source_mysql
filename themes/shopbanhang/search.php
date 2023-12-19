<?php
getHeader();
global $urlThemeActive;
$setting = setting();

$slide_home= slide_home($setting['id_slide']);
?>
  <main>
        <section id="section-breadcrumb">
            <div class="breadcrumb-center">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                  <li class="breadcrumb-item"><a href="#">Blog</a></li>
                </ul>
            </div>
        </section>

        <!-- <section id="section-banner-blog">
            <div class="banner-blog">
                <img src="<?php echo $urlThemeActive ?>asset/image/background-home.png" alt="">
            </div>
        </section> -->

        <section id="section-banner-home">
            <div class="container">
                <div class="banner-home-slide">
                    <?php if(!empty($slide_home->imageinfo)){
                        foreach($slide_home->imageinfo as $key => $item){ ?>
                <div class="banner-home-item">
                    <a href="<?php echo $item->link ?>">
                    <img src="<?php echo $item->image ?>" alt="">
                    </a>
                </div>
            <?php }} ?>
                </div>
            </div>
        </section>

        <section id="section-blog-content">
            <div class="container">
                <div class="form-search-blog">
                    <form action="/search">
                        <input type="text" class="form-control" name="key" id="" value="<?php echo @$_GET['key']; ?>" placeholder="Tìm kiếm bài viết">
                        <input type="submit" style="display:none" name="">
                    </form>
                </div>

                
            </div>
        </section>

      

        <section id="section-blog-last">
            <div class="blog-last-inner">
                <div class="container">
                    <div class="row">
                         <?php if(!empty($listPosts)){ 
                        		foreach($listPosts as $key => $item){
                                    $Category = getByIdCategory($item->idCategory);
                        		?>
                        <div class="blog-last-item col-lg-4 col-md-4 col-sm-4 col-12">
                            <div class="blog-last-title">
                                <a href="/<?php echo @$item->slug ?>.html"><?php echo @$item->title ?></a>
                            </div>

                            <div class="blog-last-meta">
                                <p class="blog-last-date"><?php echo date('H:i d/m/Y', $item->time); ?></p>
                                <p class="blog-last-category"></p>
                            </div>

                            <div class="blog-last-image">
                                <a href="/<?php echo @$item->slug ?>.html"><a href=""><img src="<?php echo @$item->image ?>" alt=""></a></a>
                            </div>
                        </div>
                        <?php }} ?>
                       
                    </div>
                </div>
            </div>
        </section>

        <section id="section-blog-contact">
            <div class="container">
                <div class="title-section">
                    <h2>Đăng ký để nhận bản tin</h2>
                </div>

                <div class="title-section-sub">
                    <p>Để cập nhập những tin tức về sức khỏe, làm đẹp,.. và những ưu đãi đặc biệt sớm nhất</p>
                </div>

                <div class="form-blog-contact">
                    <form action="">
                        <div class="input-blog-contact">
                            <input type="email" class="form-control" placeholder="Nhập email của bạn" required>
                            <button type="submit" class="btn btn-primary">Đăng ký</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
<?php
getFooter();?>