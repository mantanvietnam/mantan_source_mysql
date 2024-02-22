<?php
getHeader();
global $urlThemeActive;
?>

    <main>
        <section id="section-banner" style="background-image:url(<?php echo $urlThemeActive ?>asset/img/bachgroudbannerl.jpg) ;">
            <div class="banner-overlay"></div>
            <div class="banner-content">
                <div class="container text-center">
                    <div class="title-banner">
                        <h2><?php echo @$setting['full_name'] ?><span><?php echo @$setting['full_name'] ?></span></h2>
                    </div>

                    <div class="description-banner">
                        <p><?php echo @$setting['content_top1'] ?></p>
                    </div>

                    <div class="link-banner">
                        <button class="btn">
                            <a href="<?php echo @$setting['link1'] ?>">Đăng ký ngay</a>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-service">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="service-item" style="background-image: url(<?php echo @$setting['image_hd1'] ?>)">
                            <div class="service-title">
                                <h3><?php echo @$setting['title_hd1'] ?>
                                    <br>
                                    <strong class="text-yeallow"><?php echo @$setting['title_hdv1'] ?></strong>
                                </h3>
                            </div>
                            <hr>
                            <div class="service-content">
                                <p><?php echo @$setting['content_hd1'] ?></p>
                            </div>  
                        </div>                
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="service-item" style="background-image: url(<?php echo @$setting['image_hd2'] ?>)">
                            <div class="service-title">
                                <h3><?php echo @$setting['title_hd2'] ?>
                                    <br>
                                    <strong class="text-yeallow"><?php echo @$setting['title_hdv2'] ?></strong>
                                </h3>
                            </div>
                            <hr>
                            <div class="service-content">
                                <p><?php echo @$setting['content_hd2'] ?></p>
                            </div>  
                        </div>                
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="service-item" style="background-image: url(<?php echo @$setting['image_hd3'] ?>)">
                            <div class="service-title">
                                <h3><?php echo @$setting['title_hd3'] ?>
                                    <br>
                                    <strong class="text-yeallow"><?php echo @$setting['title_hdv3'] ?></strong>
                                </h3>
                            </div>
                            <hr>
                            <div class="service-content">
                                <p><?php echo @$setting['content_hd3'] ?></p>
                            </div>  
                        </div>                
                    </div>
                </div>
            </div>
        </section>

        <section id="section-introduce" style="background-image: url(<?php echo $urlThemeActive ?>asset/img/bg-tin-tuc.png);">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="introduce-content">
                            <div class="introduce-title">
                                <h2>
                                    <span class="text-yeallow">
                                        <?php echo @$setting['title_gt1'] ?>
                                    </span>
                                    <br>
                                    <?php echo @$setting['title_gt2'] ?>
                                </h2>
                            </div>

                            <div class="introduce-devide"></div>

                            <div class="introduce-content"><?php echo @$setting['content2'] ?></div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="produce-img">
                            <img src="<?php echo @$setting['image_portrait1'] ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-start-today">
            <div class="container">
                <div class="section-title">
                    <h2>
                       <?php echo @$setting['title_bd1'] ?>
                        <span class="text-yeallow"><?php echo @$setting['title_bd2'] ?></span>
                    </h2>
                </div>

                <div class="start-today-content">
                    <p><?php echo @$setting['content_bd'] ?></p>
                </div>

                <div class="start-today-button">
                    <button class="btn btn-1">
                        <a href="<?php echo @$setting['link2'] ?>">Liên hệ với chúng tôi</a>
                    </button>

                    <button class="btn">
                        <a href="<?php echo @$setting['link3'] ?>">Đăng ký ngay</a>
                    </button>

   
                </div>
            </div>
        </section>

        <section id="section-help" style="background-image: url(<?php echo $urlThemeActive ?>asset/img/home-nine-footer-back.jpeg);">
            <div class="background-overlay"></div>
            <div class="container">
                <div class="help-section-title">
                    <h2>
                         <?php echo @$setting['title_dv1'] ?>
                        <span class="text-yeallow">  <?php echo @$setting['title_dvv1'] ?></span>
                    </h2>

                    <p  <?php echo @$setting['content_dv'] ?></p>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="help-item">
                            <div class="help-title">
                                <h3>  <?php echo @$setting['service1'] ?></h3>
                            </div>
                            
                            <div class="help-detail">
                                <div class="help-content">  <?php echo @$setting['content_dv1'] ?></div>
    
                                <div class="help-link">
                                    <button class="btn">
                                        <a href="  <?php echo @$setting['linkdv1'] ?>">Đăng ký ngay</a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="help-item">
                            <div class="help-title">
                                <h3>  <?php echo @$setting['service2'] ?></h3>
                            </div>
                            
                            <div class="help-detail">
                                <div class="help-content">  <?php echo @$setting['content_dv2'] ?></div>
    
                                <div class="help-link">
                                    <button class="btn">
                                        <a href="  <?php echo @$setting['linkdv2'] ?>">Đăng ký ngay</a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="help-item">
                            <div class="help-title">
                                <h3>  <?php echo @$setting['service3'] ?></h3>
                            </div>
                            
                            <div class="help-detail">
                                <div class="help-content">  <?php echo @$setting['content_dv3'] ?></div>
    
                                <div class="help-link">
                                    <button class="btn">
                                        <a href="  <?php echo @$setting['linkdv3'] ?>">Đăng ký ngay</a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </section>

        <section id="section-news">
            <div class="container">
                <div class="section-title text-center">
                    <h2>
                        <?php echo @$setting['title_tt1'] ?> 
                        <span class="text-yeallow"><?php echo @$setting['title_ttv1'] ?></span>
                    </h2>

                    <p><?php echo @$setting['content_tt'] ?></p>
                </div>
                
                <div class="news-list">
                   <?php if(!empty($listDataPost)){
                        foreach($listDataPost as $item){
                            echo '<div class="news-item">
                        <div class="new-item-inner">
                            <div class="news-image">
                                <a href="/'.$item->slug.'.html"><img src="'.$item->image.'" alt=""></a>
                            </div>

                            <div class="news-detail">
                                <div class="news-title">
                                    <a href="/'.$item->slug.'.html">'.$item->title.'</a>
                                </div>
    
                                <div class="news-date">
                                    <span>'.date('d/m/Y',$item->time_create).'</span>
                                </div>
    
                                <div class="news-description">'.$item->description.'</div>
    
                                <div class="news-link">
                                    <a href="/'.$item->slug.'.html">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                    </div>';
                        }
                   } ?>
                    

                    
                </div>
            </div>
        </section>

        <section id="section-contact" style="background-image:url(<?php echo $urlThemeActive ?>asset/img/home-nine-footer-back.jpeg) ;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <img src="<?php echo @$setting['image_contac'] ?>" alt="">
                    </div>

                    <div class="col-lg-5">
                        <div class="title-form">
                            <h2>
                                <?php echo @$setting['title_lh'] ?>
                                <span class="text-yeallow"><?php echo @$setting['title_lhv'] ?></span>
                            </h2>

                            <p><?php echo @$setting['content_lh'] ?><span class="text-yeallow"><?php echo @$setting['content_lhv'] ?></span> </p>
                        </div>

                        <div class="form-contact">
                            <form>
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Họ và tên">
                                </div>

                                <div class="mb-3">
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Email">
                                </div>

                                <div class="mb-3">
                                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Số điện thoại">
                                </div>

                                <div class="mb-3">
                                    <textarea name="" id="" cols="60" rows="10" placeholder="Ghi chú"></textarea>
                                </div>
                                
        
                                <button type="submit" class="btn btn-primary">Gửi</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>


<?php
getFooter();
?>
  