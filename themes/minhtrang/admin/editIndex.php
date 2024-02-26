<!doctype html>
<html lang="vi">
<head>
    <?php 
        global $themeSettings;
        mantan_header();
        if (function_exists('showSeoHome')) { 
            showSeoHome(); 
        }
        if (function_exists('showContentShareFacebook')) { 
            showContentShareFacebook(); 
        } 
    ?>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- --CSS-- -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
    <link rel="stylesheet" href="<?php echo$urlThemeActive;?>/index.css">
    <link rel="stylesheet" href="<?php echo$urlThemeActive;?>/owlcarousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo$urlThemeActive;?>/owlcarousel/assets/owl.theme.default.min.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="<?php echo$urlThemeActive;?>/owlcarousel/owl.carousel.min.js"></script>
    <?php mantan_header();?>
</head>

<body>
    <script>
        $(document).ready(function() {
            // var top = $("#header").offset().top;
            var top = 300;
            $(window).scroll(function() {
                var y = $(this).scrollTop();
                if (y > top) {
                    $(".r-425 img").addClass('animate__rotateIn');
                    $("a.backtop").css({
                        'opacity': '1',
                        'visibility': 'visible'
                    });
                } else {
                    $("a.backtop").css({
                        'opacity': '0',
                        'visibility': 'hidden'
                    });
                }
            });
            $('a.backtop').click(function() {
                $('body, html').animate({
                    scrollTop: '0'
                }, 700);
                return false
            });
            $('a.btn-search').click(function() {
                $('input.search').toggleClass('d-un');
            })
        });
    </script>
    <!-- ====MENU==== -->
    <header>
        <nav class="navbar navbar-expand-md navbar-dark" style="background-color: #111;">
            <div class="container">
                <div class="mr-auto order-0">
                    <p class="navbar-brand mx-auto" onclick="editThemeMedia('<?php echo @$themeSettings['Option']['value']['logo']; ?>', 'logo');"><img src="<?php echo @$themeSettings['Option']['value']['logo']; ?>" alt=""></p>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="navbar-collapse collapse w-100 order-1 dual-collapse2">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link">Giới thiệu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" >Sứ mệnh</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" >Sự kiện</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" >Tin tức</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" >Hoạt động</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" >Kết nối</a>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </nav>
    </header>
       <main id="content">
        <!-- ====BANNER==== -->
      <section class="elementor-top-section" style="background-image: url(<?php echo @$themeSettings['Option']['value']['image']; ?>);">
            <div class="elementor-background-overlay"></div>
            <div class="elementor-shape">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none">
                    <path class="elementor-shape-fill" d="M0,6V0h1000v100L0,6z"></path>
                </svg>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div style="height: 160px;" class="height"></div>
                        <h2 class="elementor-heading-title animate__animated animate__bounce" onclick="editThemeEditer(this.innerHTML, 'textSlide');"><?php echo @$themeSettings['Option']['value']['textSlide']; ?></h2>
                        <div class="text-center">
                            <a  class="my_story"> <i class="far fa-arrow-alt-circle-right" style="padding-right: 5px;"></i>Câu chuyện của tôi</a>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <img src="<?php echo @$themeSettings['Option']['value']['avatar']; ?>" class="avatar" onclick="editThemeMedia('<?php echo @$themeSettings['Option']['value']['avatar']; ?>', 'avatar');" alt="" style="width: 100%;">
                    </div>
                </div>
            </div>
        </section>


    

        <!-- ====Tầm nhìn và sứ mệnh==== -->
        <section class="view" id="sumenh">
            <div class="container">
                <!-- <div class="row"> -->
                <h2>TẦM NHÌN & SỨ MỆNH</h2>
                <p>“ <span style="font-weight: 400;" onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['textSlide1']; ?>', 'textSlide1');"><?php echo @$themeSettings['Option']['value']['textSlide1']; ?></span> “
                </p>
                <div class="r-425">
                    <img src="<?php echo @$themeSettings['Option']['value']['avatar4']; ?>"  onclick="editThemeMedia('<?php echo @$themeSettings['Option']['value']['avatar4']; ?>', 'avatar4');"  class=" animate__animated" alt="">
                </div>
                <!-- </div> -->
            </div>
        </section>



        <!-- ====Banner 2==== -->
        <section class="elementor-bottom-section" style="background-image: url(<?php echo @$themeSettings['Option']['value']['background1']; ?>);" id="gioithieu">
            <div class="elementor-background-overlay"></div>
            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none">
                    <path class="elementor-shape-fill" d="M0,6V0h1000v100L0,6z"></path>
                </svg>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <img src="<?php echo @$themeSettings['Option']['value']['avatar2']; ?>" onclick="editThemeMedia('<?php echo @$themeSettings['Option']['value']['avatar2']; ?>', 'avatar2');" alt="" style="max-width: 385px;">
                    </div>

                    <div class="col-md-7">
                        <div style="height: 100px;" class="height"></div>
                        <h2 class="elementor-heading-title " onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['fullName']; ?>', 'fullName');"><?php echo @$themeSettings['Option']['value']['fullName']; ?></h2>
                         <div onclick="editThemeEditer(this.innerHTML, 'personIntroduction');">
                                <p><?php echo @$themeSettings['Option']['value']['personIntroduction']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ====Niềm tự hào của tôi==== -->
        <section class="my-pround"  id="sukien">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="text-center" style="padding-top: 100px;">
                            <h3>NIỀM TỰ HÀO CỦA TÔI</h3>
                            <p onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['numberStatic1']; ?>', 'numberStatic1');"> <?php echo @$themeSettings['Option']['value']['numberStatic1']; ?></p>
                            <span onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['nameStatic1']; ?>', 'nameStatic1');"><?php echo @$themeSettings['Option']['value']['nameStatic1']; ?></span>
                            <p onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['numberStatic2']; ?>', 'numberStatic2');"><?php echo @$themeSettings['Option']['value']['numberStatic2']; ?>+</p>
                            <span onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['nameStatic2']; ?>', 'nameStatic2');"><?php echo @$themeSettings['Option']['value']['nameStatic2']; ?> </span>
                            <p onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['numberStatic3']; ?>', 'numberStatic3');"><?php echo @$themeSettings['Option']['value']['numberStatic3']; ?>+</p>
                            <span onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['nameStatic3']; ?>', 'nameStatic3');"><?php echo @$themeSettings['Option']['value']['nameStatic3']; ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img src="<?php echo @$themeSettings['Option']['value']['imageLearn1']; ?>" onclick="editThemeMedia('<?php echo @$themeSettings['Option']['value']['imageLearn1']; ?>', 'imageLearn1');" style="width: 100%;" alt="">
                    </div>
                </div>
            </div>
        </section>

        <!-- ====Bí quyết==== -->
        <section class="video" style="background-image: url(<?php echo @$themeSettings['Option']['value']['background2']; ?>);" id="hoatdong"  >
            <div class="elementor-background-overlay"></div>
            <div class="container">
                <div class="row" style="padding: 100px 0;">
                    <div class="col-md-6">
                     <!--    <h5>Video</h5> -->
                     <div onclick="editThemeEditer(this.innerHTML, 'textvideo');">
                           <h2><?php echo @$themeSettings['Option']['value']['textvideo']; ?></h2>
                     </div>
                        <div class="button-play">
                            <a   onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['youtube']; ?>', 'youtube');" target="_blank" class="youtube-link">Xem kênh youtube<i style="margin-left: 5px;"
                                    class="fas fa-play-circle"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        
                        <iframe width="100%" height="300px" src="https://www.youtube.com/embed/<?php echo @$themeSettings['Option']['value']['video']; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </section>

        <!-- ====FEEDBACK==== -->
        <section class="feedback" id="hoatdong">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>FEEDBACK SAU MỖI KHÓA HUẤN LUYỆN</h2>
                    </div>
                    <div class="col-md-12">
                        <div class="owl-carousel list-feedback owl-theme">
                            <div class="item">
                                <img src="<?php echo @$themeSettings['Option']['value']['imageLearn2']; ?>" onclick="editThemeMedia('<?php echo @$themeSettings['Option']['value']['imageLearn2']; ?>', 'imageLearn2');"  alt="">
                            </div>
                            <div class="item">
                                <img src="<?php echo @$themeSettings['Option']['value']['imageLearn3']; ?>" onclick="editThemeMedia('<?php echo @$themeSettings['Option']['value']['imageLearn3']; ?>', 'imageLearn3');"  alt="">
                            </div>
                            <div class="item">
                                <img src="<?php echo @$themeSettings['Option']['value']['imageLearn4']; ?>" onclick="editThemeMedia('<?php echo @$themeSettings['Option']['value']['imageLearn4']; ?>', 'imageLearn4');"  alt="">
                            </div>
                            <div class="item">
                                <img src="<?php echo @$themeSettings['Option']['value']['imageLearn5']; ?>" onclick="editThemeMedia('<?php echo @$themeSettings['Option']['value']['imageLearn5']; ?>', 'imageLearn5');"  alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ====CẢM NHẬN==== -->
        <section class="feeling" >
            <div class="container">
                <div class="row" style="padding-bottom: 30px;">
                    <div class="col-md-12">
                        <h2>CẢM NHẬN TỪ NGƯỜI KHÁC</h2>
                    </div>
                    <div class="col-md-12">
                        <div class="owl-carousel list-feeling owl-theme">
                            <div class="item">
                                <iframe width="100%" height="240px" src="https://www.youtube.com/embed/<?php echo @$themeSettings['Option']['value']['video1']; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            <div class="item">
                                <iframe width="100%" height="240px" src="https://www.youtube.com/embed/<?php echo @$themeSettings['Option']['value']['video2']; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            <div class="item">
                                <iframe width="100%" height="240px" src="https://www.youtube.com/embed/<?php echo @$themeSettings['Option']['value']['video3']; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

          <!-- =====Tin tức ========== -->
        <section class="section5" id="tintuc">
            <div class="container">
                <div class="media">
                    <h2>BÀI VIẾT GẦN NHẤT</h2>
                </div>
                <div class="row">
                    <?php
                        global $modelNotice;
                        $news= $modelNotice->getNewNotice(3);

                        if(!empty($news)){
                            foreach($news as $item){
                                $urlNotice = getUrlNotice($item['Notice']['id']);
                                echo '<div class="col-md-4">
                                        <div class = "thumbnail">
                                            <img src = "'.$item['Notice']['image'].'" alt ="" style="width:100%;">
                                        </div>

                                        <div class ="item">
                                            <p><h5>'.$item['Notice']['title'].'</h5></p>
                                            <p>'.$item['Notice']['introductory'].'</p>
                                            <p><a title="">Xem tiếp >></a></p>
                                        </div>  
                                    </div>';
                            }
                        }
                    ?>
                </div>  
            </div>
        </section>

        <!-- ====TRUYỀN THÔNG==== -->
        <section class="media" id="ketnoi">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>TRUYỀN THÔNG VÀ BÁO CHÍ</h2>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 col-lg-3">
                                <a >
                                    <span class="img-post">
                                        <img onclick="editThemeMedia('<?php echo @$themeSettings['Option']['value']['imageLearn12']; ?>', 'imageLearn12');"  src="<?php echo @$themeSettings['Option']['value']['imageLearn12']; ?>" style="width: 100%; height: auto;" alt="">
                                    </span>
                                    <div class="infor-post">
                                        <h4 class="title-post" onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['titleLearn1']; ?>', 'titleLearn1');">
                                           <?php echo @$themeSettings['Option']['value']['titleLearn1']; ?>
                                        </h4>
                                        <p class="post-detail" onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['decsLearn1']; ?>', 'decsLearn1');"><?php echo @$themeSettings['Option']['value']['decsLearn1']; ?></p>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <a >
                                    <span class="img-post">
                                        <img onclick="editThemeMedia('<?php echo @$themeSettings['Option']['value']['imageLearn13']; ?>', 'imageLearn13');"  src="<?php echo @$themeSettings['Option']['value']['imageLearn13']; ?>" style="width: 100%; height: auto;" alt="">
                                    </span>
                                    <div class="infor-post">
                                        <h4 class="title-post" onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['titleLearn2']; ?>', 'titleLearn2');">
                                           <?php echo @$themeSettings['Option']['value']['titleLearn2']; ?>
                                        </h4>
                                        <p class="post-detail" onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['decsLearn2']; ?>', 'decsLearn2');"><?php echo @$themeSettings['Option']['value']['decsLearn2']; ?></p>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <a >
                                    <span class="img-post">
                                        <img onclick="editThemeMedia('<?php echo @$themeSettings['Option']['value']['imageLearn14']; ?>', 'imageLearn14');"  src="<?php echo @$themeSettings['Option']['value']['imageLearn14']; ?>" style="width: 100%; height: auto;" alt="">
                                    </span>
                                    <div class="infor-post">
                                        <h4 class="title-post" onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['titleLearn3']; ?>', 'titleLearn3');">
                                            <?php echo @$themeSettings['Option']['value']['titleLearn3']; ?>
                                        </h4>
                                        <p class="post-detail" onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['decsLearn4']; ?>', 'decsLearn4');"><?php echo @$themeSettings['Option']['value']['decsLearn4']; ?></p>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <a >
                                    <span class="img-post">
                                        <img onclick="editThemeMedia('<?php echo @$themeSettings['Option']['value']['imageLearn15']; ?>', 'imageLearn15');"  src="<?php echo @$themeSettings['Option']['value']['imageLearn15']; ?>" style="width: 100%; height: auto;" alt="">
                                    </span>
                                    <div class="infor-post">
                                        <h4 class="title-post" onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['titleLearn6']; ?>', 'titleLearn6');">
                                            <?php echo @$themeSettings['Option']['value']['titleLearn6']; ?>
                                        </h4>
                                        <p class="post-detail" onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['decsLearn5']; ?>', 'decsLearn5');"><?php echo @$themeSettings['Option']['value']['decsLearn5']; ?></p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <a href="" class="backtop">
        <i class="fas fa-arrow-up"></i>
    </a>
      <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3>Kết Nối Với
                        <span class="sign">
                           <?php echo @$themeSettings['Option']['value']['fullName']; ?>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 150" preserveAspectRatio="none">
                                <path d="M7.7,145.6C109,125,299.9,116.2,401,121.3c42.1,2.2,87.6,11.8,87.3,25.7"></path>
                            </svg>
                        </span>
                    </h3>

                </div>
                <div class="col-md-12">
                    <div class="list-contact">
                        <a  onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['facebook']; ?>', 'facebook');"  class="facebook"><i class="fab fa-facebook"></i></a>
                        <a   onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['youtube']; ?>', 'youtube');"   class="youtube"><i class="fab fa-youtube"></i></a>
                        <a   onclick="editThemeText('<?php echo @$themeSettings['Option']['value']['instagram']; ?>', 'instagram');"  class="phone"><i class="fas fa-phone-square-alt"></i></a>
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <center style="color: #fff;">Website được xây dựng bởi <a href="http://manmoweb.com/" target="_blank" title="Công cụ tạo web tự động">Mần Mò Web</a></center>
                </div>
            </div>
        </div>
    </footer>

    <script>
        $(document).ready(function() {
            $('.list-feeling').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 3
                    }
                }
            })
        });
    </script>
<?php include('codeEdit.php');?>
    <script>
        $(document).ready(function() {
            $('.list-feedback').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 4
                    }
                }
            })
        });
    </script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>