<?php getHeader();?>
<?php
 // debug($themeSettings['Option']);
 ?>
    <main id="content">
        <!-- ====BANNER==== -->
        <section class="elementor-top-section" style="background-image: url(<?php echo @$setting['image']; ?>); background-size: 100%; background-repeat: no-repeat;">
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
                        <h2 class="elementor-heading-title animate__animated animate__bounce"><?php echo @$setting['textSlide']; ?></h2>
                        <div class="text-center">
                            <a href="/cau-chuyen-cua-toi.html" class="my_story" target="blank">
                                    <span class="img-post"> <i class="far fa-arrow-alt-circle-right" style="padding-right: 5px;"></i>Câu chuyện của tôi</a>
                        </div> 
                    </div>

                    <div class="col-md-6">
                        <img src="<?php echo @$setting['avatar']; ?>" class="avatar" alt="" style="width: 100%;">
                    </div>
                </div>
            </div>
        </section>

        <!-- ====Tầm nhìn và sứ mệnh==== -->
        <section class="view" id="sumenh">
            <div class="container">
                <!-- <div class="row"> -->
                <h2><?php echo @$setting['textSlide0']; ?></h2>
                <p>“ <span style="font-weight: 400;"><?php echo @$setting['textSlide1']; ?></span> “
                </p>
                <div class="r-425">
                    <img src="<?php echo @$setting['avatar4']; ?>" class=" animate__animated" alt="">
                </div>
                <!-- </div> -->
            </div>
        </section>



        <!-- ====Banner 2==== -->
        <section class="elementor-bottom-section"  style="background-image: url(<?php echo @$setting['background1']; ?>); background-size: 100%; background-repeat: no-repeat;" id="gioithieu">
            <div class="elementor-background-overlay"></div>
            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none">
                    <path class="elementor-shape-fill" d="M0,6V0h1000v100L0,6z"></path>
                </svg>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <img src="<?php echo @$setting['avatar2']; ?>" alt="" style="max-width: 385px;">
                    </div>

                    <div class="col-md-7">
                        <div style="height: 100px;" class="height"></div>
                        <h2 class="elementor-heading-title " style="font-family: Roboto;"><?php echo @$setting['fullName']; ?></h2>
                       
                        <p><?php echo @$setting['personIntroduction']; ?></p>
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
                            <h3 ><?php echo @$setting['numberStatic0']; ?></h3>
                            <p class="" ><?php echo @$setting['numberStatic1']; ?></p>
                            <p class="pt-3" style="font-size: 15px"><?php echo @$setting['nameStatic1']; ?></p>
                            <p class="pt-3"><?php echo @$setting['numberStatic2']; ?>+</p>
                            <p class="pt-3"style="font-size: 15px"><?php echo @$setting['nameStatic2']; ?> </p>
                            <p class="pt-3"><?php echo @$setting['numberStatic3']; ?>+</p>
                            <p class="pt-3" style="font-size: 15px"><?php echo @$setting['nameStatic3']; ?></p>
                        </div>
                        <div class="text-center pt-3">
                            <img src="<?php echo @$setting['imageLearn1000']; ?>" style="width: 100%;" alt="">
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img src="<?php echo @$setting['imageLearn1']; ?>" style="width: 100%;" alt="">
                    </div>
                </div>
            </div>
        </section>

        <!-- ====Bí quyết==== -->
        <section class="video" style="background-image: url(<?php echo @$setting['background2']; ?>);  background-size: 100%; background-repeat: no-repeat;" id="hoatdong"  >
            <div class="elementor-background-overlay"></div>
            <div class="container">
                <div class="row" style="padding: 100px 0;">
                    <div class="col-md-6">
                     <!--    <h5>Video</h5> -->
                        <h2><?php echo @$setting['textvideo']; ?></h2>
                        <div class="button-play">
                            <a href="<?php echo @$setting['youtube']; ?>" target="_blank" class="youtube-link">Xem kênh youtube<i style="margin-left: 5px;"
                                    class="fas fa-play-circle"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        
                        <iframe width="100%" height="300px" src="https://www.youtube.com/embed/<?php echo @$setting['video']; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </section>

        <!-- ====CẢM NHẬN==== -->
        <section class="feeling" >
            <div class="container">
                <div class="row" style="padding-bottom: 30px;">
                    <div class="col-md-12">
                        <h2><?php echo @$setting['video0']; ?></h2>
                    </div>
                    <div class="col-md-12">
                        <div class="owl-carousel list-feeling owl-theme">
                            <div class="item">
                                <iframe width="100%" height="240px" src="https://www.youtube.com/embed/<?php echo @$setting['video1']; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            <div class="item">
                                <iframe width="100%" height="240px" src="https://www.youtube.com/embed/<?php echo @$setting['video2']; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            <div class="item">
                                <iframe width="100%" height="240px" src="https://www.youtube.com/embed/<?php echo @$setting['video3']; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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
                    <h2><?php echo @$setting['baivietmannhat']; ?></h2>
                </div>
                <div class="row">
                    <?php
                       if(!empty($listDataNew)){
                            foreach($listDataNew as $item){
                                echo '<div class="col-md-4">
                                        <div class = "thumbnail">
                                            <img src = "'.$item->image.'" alt ="" style="width:100%;">
                                        </div>

                                        <div class ="item">
                                            <h5>'.$item->title.'</h5>
                                            <p>'.$item->description.'</p>
                                            <a href="/'.$item->slug.'.html" title="">Xem tiếp >></a>
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
                        <h2><?php echo @$setting['chuyenthongbaochi']; ?>
                                    <span class="img-post"></h2>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 col-lg-3">
                                <a href="<?php echo @$setting['link1']; ?>" target="blank">
                                    <span class="img-post">
                                        <img src="<?php echo @$setting['imageLearn12']; ?>" style="width: 100%; height: auto;" alt="">
                                    </span>
                                    <div class="infor-post">
                                        <h4 class="title-post">
                                           <?php echo @$setting['titleLearn1']; ?>
                                        </h4>
                                        <p class="post-detail"><?php echo @$setting['decsLearn1']; ?></p>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <a href="<?php echo @$setting['link2']; ?>" target="blank">
                                    <span class="img-post">
                                        <img src="<?php echo @$setting['imageLearn13']; ?>" style="width: 100%; height: auto;" alt="">
                                    </span>
                                    <div class="infor-post">
                                        <h4 class="title-post">
                                           <?php echo @$setting['titleLearn2']; ?>
                                        </h4>
                                        <p class="post-detail"><?php echo @$setting['decsLearn2']; ?></p>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <a href="<?php echo @$setting['link3']; ?>" target="blank">
                                    <span class="img-post">
                                        <img src="<?php echo @$setting['imageLearn14']; ?>" style="width: 100%; height: auto;" alt="">
                                    </span>
                                    <div class="infor-post">
                                        <h4 class="title-post">
                                            <?php echo @$setting['titleLearn3']; ?>
                                        </h4>
                                        <p class="post-detail"><?php echo @$setting['decsLearn4']; ?></p>
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <a href="<?php echo @$setting['link4']; ?>" target="blank">
                                    <span class="img-post">
                                        <img src="<?php echo @$setting['imageLearn15']; ?>" style="width: 100%; height: auto;" alt="">
                                    </span>
                                    <div class="infor-post">
                                        <h4 class="title-post">
                                            <?php echo @$setting['titleLearn6']; ?>
                                        </h4>
                                        <p class="post-detail"><?php echo @$setting['decsLearn5']; ?></p>
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
    <!-- ====FOOTER==== -->
   <?php getFooter ();?>