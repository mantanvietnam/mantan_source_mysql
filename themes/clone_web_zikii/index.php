<?php
getHeader();
global $settingThemes;
?>

   <main>

        <!-- <section id="section-search">
            <div class="overlay" id="overlay">
                <button type="button" class="close-btn" onclick="closeOverlay()"><i class="fa-solid fa-xmark"></i></button>

                <div class="overlay-content">

                    <form onsubmit="" action="/search-product" method="get" id="myForm" class="form-custom">
                        <input type="text" name="key" class="search-input" name="key" placeholder="Nhập từ khóa">
                        <button type="submit" class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
            </div>
        </section> -->


        <section id="section-banner" style="padding-bottom: 70px" data-aos="fade-up">
            <div class="banner-slide">

                <?php 
                if(!empty($slide_home->imageinfo)){
                    foreach($slide_home->imageinfo as $key => $item){
                        echo '  <div class="banner-home-item">
                                    <a href="'.$item->link.'">
                                        <img src="'.$item->image.'" alt="">
                                    </a>
                                </div>';
                    }
                } 
                ?>
            </div>
        </section>

        <section id="section-service" class="section-padding" data-aos="fade-up">
            <div class="container">
                <div class="title-box">
                    <h2 class="section-title">
                        <span>TẠI SAO BẠN NÊN CHỌN Chúng tôi ?</span>
                        <div class="title-divide-section"></div>
                    </h2>
                </div>

                <div class="service-list">
                    <div class="row">
                        <div class="col-lg-3 col-md-12">
                            <div class="service-item">
                                <div class="service-image">
                                    <i class="fa-solid <?php echo @$settingThemes['icon1'] ?>"></i>
                                </div>

                                <div class="service-detail">
                                    <div class="service-title">
                                        <h4><?php echo @$settingThemes['titel1'] ?></h4>
                                    </div>

                                    <div class="service-description">
                                        <p><?php echo @$settingThemes['content1'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-12">
                            <div class="service-item">
                                <div class="service-image">
                                    <i class="fa-solid <?php echo @$settingThemes['icon2'] ?>"></i>
                                </div>

                                <div class="service-detail">
                                    <div class="service-title">
                                        <h4><?php echo @$settingThemes['titel2'] ?></h4>
                                    </div>

                                    <div class="service-description">
                                        <p><?php echo @$settingThemes['content2'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-12">
                            <div class="service-item">
                                 <div class="service-image">
                                    <i class="fa-solid <?php echo @$settingThemes['icon3'] ?>"></i>
                                </div>

                                <div class="service-detail">
                                    <div class="service-title">
                                        <h4><?php echo @$settingThemes['titel3'] ?></h4>
                                    </div>

                                    <div class="service-description">
                                        <p><?php echo @$settingThemes['content3'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-12">
                            <div class="service-item">
                                 <div class="service-image">
                                    <i class="fa-solid <?php echo @$settingThemes['icon4'] ?>"></i>
                                </div>

                                <div class="service-detail">
                                    <div class="service-title">
                                        <h4><?php echo @$settingThemes['titel4'] ?></h4>
                                    </div>

                                    <div class="service-description">
                                        <p><?php echo @$settingThemes['content4'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="section-album" class="section-padding" data-aos="fade-up">
            <div class="container">
                <div class="title-box">
                    <h2 class="section-title">
                        <span>Thư viện ảnh</span>
                        <div class="title-divide-section"></div>
                    </h2>
                </div>

                <div class="album-list">
                    <div class="row">
                        <?php if(!empty($listAlbum)){
                            foreach($listAlbum as $key => $item){
                            echo    '<div class="col-lg-3 col-md-6 col-6">
                                        <div class="album-item-col">
                                            <div class="album-item">
                                                <a href="thu-vien-anh/'.@$item->slug.'.html">
                                                    <img src="'.@$item->image.'" alt="">
                                                </a>
                                            </div>

                                            <div class= "album-detail">
                                                <div class="album-name">
                                                    <a href="">'.@$item->title.'</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                            }
                        } ?>
                    </div>
                </div>
                
               
            </div>
        </section>

        <section id="section-video" class="section-padding" data-aos="fade-up">
            <div class="container">
                <div class="title-box">
                    <h2 class="section-title">
                        <span>Video</span>
                        <div class="title-divide-section"></div>
                    </h2>
                </div>

                <div class="video-slide">
                     <?php if(!empty($listVideo)){
                            foreach($listVideo as $key => $item){
                                echo '<div class="video-item">
                                    <iframe src="https://www.youtube.com/embed/'.@$item->youtube_code.'?si=jj6SlWQli1-hgFdC" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                </div>';
                            }
                        } ?>
                    

                    
                </div>
            </div>
        </section>

        <!-- <section id="section-home-contact" class="section-padding" data-aos="fade-up">
            <div class="section-home-background" style="background-image: url(<?php echo $urlThemeActive ?>/asset/image/Nui-Phu-Si-BG.jpg);">
                <div class="section-home-overlay"></div>
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-7">
                            <div class="contact-left">
                                <div class="contact-title">
                                    <h3>Trở thành đại lý của chúng tôi</h3>
                                    <p>Nếu bạn muốn trở thành đại lý phân phối mỹ phẩm của chúng tôi, vui lòng để lại SĐT</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="form-contact-home">
                                <input type="text" class="form-control" name="emailSubscribe" id="emailSubscribe"ria-describedby="emailHelp" required>
                                <button onclick="addSubscribe()"  type="">Đăng ký</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->

        <section id="section-category-product" class="section-padding" data-aos="fade-up">
            <div class="container">
                <div class="title-box">
                    <h2 class="section-title" >
                        <span>Danh mục sản phẩm</span>
                        <div class="title-divide-section"></div>
                    </h2>
                </div>
                <div class="category-product-slide" >
                    <?php if(!empty($listCategorieProduct)){
                        foreach($listCategorieProduct as $key => $item){
                echo '<div class="category-product-item">
                        <div class="category-product-item-inner">
                            <a href="/category/'.$item->slug.'.html">
                                <div class="category-product-image">
                                    <img src="'.$item->image.'" alt="">
                                </div>
                                <div class="category-product-detail">
                                    <div class="category-product-name">
                                        <span>'.$item->name.'</span>
                                    </div>

                                    <div class="category-product-number">
                                        <span>'.$item->number_product.' Sản phẩm</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>';
                        }
                    } ?>
                </div>
            </div>
        </section>

        <!-- Sản phẩm mới nhất -->
        <section id="section-product-hot" class="section-padding" data-aos="fade-up">
            <div class="container">
                <div class="title-box">
                    <h2 class="section-title" >
                        <span><?php echo @$settingThemes['titel_category_product1']; ?></span> 
                        <div class="title-divide-section"></div>
                    </h2>
                </div>
                <div class="product-new-slide" >
                    <?php 
                    if(!empty($listproduct1)){
                        foreach($listproduct1 as $key => $item){
                            echo '  <div class="product-hot-item">
                                        <div class="product-hot-item-inner">
                                            <div class="product-hot-image">
                                                <a href="/san-pham/'.@$item->slug.'.html">
                                                    <img src="'.@$item->image.'" alt="">
                                                </a>
                                            </div>

                                            <div class="product-hot-detail">
                                                <div class="product-hot-name">
                                                    <a href="/san-pham/'.@$item->slug.'.html">'.@$item->title.'</a>
                                                </div>

                                                <div class="product-hot-price">
                                                    <span>'.number_format(@$item->price).' đ</span>
                                                </div>

                                                <div class="product-hot-addcart">
                                                    <a href="/san-pham/'.@$item->slug.'.html">Thêm vào giỏ hàng</a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>';
                        }
                    }
                    ?>
                    
                </div>
            </div>
        </section>

        <section id="section-album" class="section-padding" data-aos="fade-up">
            <div class="container">
                <div class="title-box">
                    <h2 class="section-title">
                        <span>Hình ảnh điều trị</span>
                        <div class="title-divide-section"></div>
                    </h2>
                </div>

                <div class="album-list">
                    <div class="row">
                        <?php 
                        if(!empty($listAlbuminfos)){
                            foreach($listAlbuminfos as $key => $item){
                                echo '  <div class="col-lg-3 col-md-6 col-6">
                                            <div class="album-item">
                                                <a href="thu-vien-anh/'.@$item->slug.'.html">
                                                    <img src="'.@$item->image.'" alt="">
                                                </a>
                                            </div>
                                        </div>';
                            }
                        } 
                        ?>
                    </div>
                </div>

            </div>
        </section>

        <section id="section-register" class="section-padding" data-aos="fade-up">
            <div class="section-home-background" style="background-image: url(<?php echo $urlThemeActive ?>/asset/image/Nui-Phu-Si-BG.jpg);">
                <div class="section-home-overlay"></div>
                <div class="container">
                    <div class="register-title">
                        <h3><?php echo @$settingThemes['titel6']; ?></h3>
                    </div>
                    <div class="register-subtitle">
                        <span><?php echo @$settingThemes['content6']; ?></span>
                    </div>
                    <div class="register-button-group">
                        <div class="register-button-item" data-aos="zoom-in">
                            <a href="<?php echo @$settingThemes['link1']; ?>">Đăng ký tư vấn</a>
                        </div>

                        <div class="register-button-item" data-aos="zoom-in">
                            <a href="tel:<?php echo @$settingThemes['phone']; ?>">HOTLINE: <?php echo @$settingThemes['phone']; ?> </a>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <section id="section-blog" class="section-padding" data-aos="fade-up">
            <div class="container">
                <div class="title-box">
                    <h2 class="section-title" >
                        <span> TIN TỨC</span>
                        <div class="title-divide-section"></div>
                    </h2>
                </div>

                <div class="blog-list">
                    
                    <?php if(!empty($listDataPost)){
                        foreach($listDataPost as $key => $item){
                            echo '<div class="blog-item">
                        <div class="blog-img">
                            <a href="/'.@$item->slug.'.html"><img src="'.$item->image.'" alt=""></a>
                        </div>

                        <div class="blog-detail">
                            <div class="blog-title">
                                <a href="/'.@$item->slug.'.html">
                                    <h4>'.$item->title.'</h4>
                                </a>
                            </div>

                            <div class="blog-meta">
                                <i class="fa-regular fa-clock"></i> <span>'.date('H:i d/m/Y', $item->time).'</span>
                            </div>

                            <div class="blog-devide">
                                <hr class="solid">
                            </div>


                            <div class="blog-description">
                                <p>'.$item->description.'</p>
                            </div>
                        </div>
                    </div>';
                        }
                    } ?>
                    

                   
                </div>
            </div>
        </section>

    </main>
<script type="text/javascript">
    function addSubscribe(){
        var email = $('#emailSubscribe').val();
          console.log(email);
        var modalemailSubscribe =  document.getElementById("modalemailSubscribe");
        var addClass =  document.getElementById("addClass");


       
        $.ajax({
            method: "POST",
            data:{email: email,
                },
            url: "/apis/addSubscribeAPI",
        })
        .done(function(msg) {
            console.log(msg);
             location.reload()

           
        });
    }
</script>

 <?php
getFooter();?>