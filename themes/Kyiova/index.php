<?php
getHeader();
global $urlThemeActive;

?>
<main>

        <section id="section-search">
            <div class="overlay" id="overlay">
                <button type="button" class="close-btn" onclick="closeOverlay()"><i class="fa-solid fa-xmark"></i></button>

                <div class="overlay-content">

                    <form class="search-form">
                        <input type="text" class="search-input" placeholder="Nhập từ khóa">
                        <button type="submit" class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
            </div>
        </section>


        <section id="section-banner" style="padding-bottom: 70px">
            <div class="banner-slide">
              <!--   <div class="banner-slide-item">
                    <img src="./asset/image/bg1.jpg" alt="">
                </div> -->

               <?php if(!empty($slide_home->imageinfo)){
                    foreach($slide_home->imageinfo as $key => $item){ ?>
                        <div class="banner-home-item">
                            <a href="<?php echo $item->link ?>">
                                <img src="<?php echo $item->image ?>" alt="">
                            </a>
                        </div>
                    <?php }} ?>
            </div>
        </section>

        <section id="section-service" class="section-padding">
            <div class="container">
                <div class="title-box">
                    <h2 class="section-title" data-aos="zoom-in">
                        <span>TẠI SAO BẠN NÊN CHỌN Chúng tôi ?</span>
                        <div class="title-divide-section"></div>
                    </h2>
                </div>

                <div class="service-list" data-aos="zoom-out-up">
                    <div class="row">
                        <div class="col-lg-3 col-md-12">
                            <div class="service-item">
                                <div class="service-image">
                                    <i class="fa-solid <?php echo @$setting['icon1'] ?>"></i>
                                </div>

                                <div class="service-detail">
                                    <div class="service-title">
                                        <h4><?php echo @$setting['titel1'] ?></h4>
                                    </div>

                                    <div class="service-description">
                                        <p><?php echo @$setting['content1'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-12">
                            <div class="service-item">
                                <div class="service-image">
                                    <i class="fa-solid <?php echo @$setting['icon2'] ?>"></i>
                                </div>

                                <div class="service-detail">
                                    <div class="service-title">
                                        <h4><?php echo @$setting['titel2'] ?></h4>
                                    </div>

                                    <div class="service-description">
                                        <p><?php echo @$setting['content2'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-12">
                            <div class="service-item">
                                 <div class="service-image">
                                    <i class="fa-solid <?php echo @$setting['icon3'] ?>"></i>
                                </div>

                                <div class="service-detail">
                                    <div class="service-title">
                                        <h4><?php echo @$setting['titel3'] ?></h4>
                                    </div>

                                    <div class="service-description">
                                        <p><?php echo @$setting['content3'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-12">
                            <div class="service-item">
                                 <div class="service-image">
                                    <i class="fa-solid <?php echo @$setting['icon4'] ?>"></i>
                                </div>

                                <div class="service-detail">
                                    <div class="service-title">
                                        <h4><?php echo @$setting['titel4'] ?></h4>
                                    </div>

                                    <div class="service-description">
                                        <p><?php echo @$setting['content4'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="section-album" class="section-padding">
            <div class="container">
                <div class="title-box">
                    <h2 class="section-title" data-aos="zoom-in">
                        <span>Thư viện ảnh</span>
                        <div class="title-divide-section"></div>
                    </h2>
                </div>

                <div class="album-list" data-aos="fade-right">
                    <div class="row">
                        <?php if(!empty($listAlbum)){
                            foreach($listAlbum as $key => $item){
                                echo '<div class="col-lg-3 col-md-12">
                            <div class="album-item">
                                <a href="thu-vien-anh/'.@$item->slug.'.html">
                                    <img src="'.@$item->image.'" alt="">
                                </a>
                            </div>
                        </div>';
                            }
                        } ?>
                        

                       
                    </div>
                </div>

            </div>
        </section>

        <section id="section-video" class="section-padding">
            <div class="container">
                <div class="title-box">
                    <h2 class="section-title" data-aos="zoom-in">
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

        <section id="section-home-contact" class="section-padding">
            <div class="section-home-background" style="background-image: url(./asset/image/Nui-Phu-Si-BG.jpg);">
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
                            <!-- <form action=""> -->
                                <div class="form-contact-home">
                                    <input type="text" class="form-control" name="emailSubscribe" id="emailSubscribe"ria-describedby="emailHelp" required>
                                    <button onclick="addSubscribe()"  type="">Đăng ký</button>
                                </div>
                            <!-- </form> -->
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-category-product" class="section-padding">
            <div class="container">
                <div class="title-box">
                    <h2 class="section-title" data-aos="zoom-in">
                        <span>Danh mục sản phẩm</span>
                        <div class="title-divide-section"></div>
                    </h2>
                </div>
                <div class="category-product-slide" data-aos="fade-left">
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
        <section id="section-product-hot" class="section-padding">
            <div class="container">
                <div class="title-box">
                    <h2 class="section-title" data-aos="zoom-in">
                        <span><?php echo @$setting['titel_category_product1']; ?></span>
                        <div class="title-divide-section"></div>
                    </h2>
                </div>
                <div class="product-new-slide" data-aos="zoom-out-up">
                    <?php if(!empty($listproduct1)){
                        foreach($listproduct1 as $key => $item){
                            echo '
                    <div class="product-hot-item">
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

        <section id="section-product-hot" class="section-padding">
            <div class="container">
                <div class="title-box">
                    <h2 class="section-title" data-aos="zoom-in">
                        <span><?php echo @$setting['titel_category_product2']; ?></span>
                        <div class="title-divide-section"></div>
                    </h2>
                </div>
                <div class="row" data-aos="zoom-out-up">
                     <?php if(!empty($listproduct2)){
                        foreach($listproduct2 as $key => $item){
                            echo '
                    <div class="col-lg-4 col-md-12 product-hot-item">
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
            }?>

                </div>
            </div>
        </section>

        <section id="section-register" class="section-padding">
            <div class="section-home-background" style="background-image: url(<?php echo $urlThemeActive ?>/asset/image/Nui-Phu-Si-BG.jpg);">
                <div class="section-home-overlay"></div>
                <div class="container">
                    <div class="register-title">
                        <h3><?php echo @$setting['titel6']; ?></h3>
                    </div>
                    <div class="register-subtitle">
                        <span><?php echo @$setting['content6']; ?></span>
                    </div>
                    <div class="register-button-group">
                        <div class="register-button-item" data-aos="zoom-out">
                            <a href="<?php echo @$setting['link1']; ?>">Đăng ký tư vấn</a>
                        </div>

                        <div class="register-button-item" data-aos="zoom-out">
                            <a href="<?php echo @$setting['phone']; ?>">HOTLINE: <?php echo @$setting['phone']; ?> </a>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <section id="section-blog" class="section-padding">
            <div class="container">
                <div class="title-box">
                    <h2 class="section-title" data-aos="zoom-in">
                        <span> TIN TỨC</span>
                        <div class="title-divide-section"></div>
                    </h2>
                </div>

                <div class="blog-list" data-aos="zoom-out-right">
                    
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