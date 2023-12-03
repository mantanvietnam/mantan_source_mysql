<?php getHeader();global $settingThemes;?>

<style>
	footer {
		display: none;
	}
</style>
<main>
    <div class="social-home">
        <ul>
            <li><a href="<?php echo @$settingThemes['facebook'];?>" target="_blank"><img title="FACEBOOK" src="<?php echo $urlThemeActive;?>/images/facebook.png" class="img-fluid btn-effect" alt=""></a></li>

            <li><a href="<?php echo @$settingThemes['youtube'];?>" target="_blank"><img title="YOUTUBE" src="<?php echo $urlThemeActive;?>/images/youtube.png" class="img-fluid btn-effect" alt=""></a></li>
            
            <li><a href="<?php echo @$settingThemes['telegram'];?>" target="_blank"><img title="TELEGRAM" src="<?php echo $urlThemeActive;?>/images/telegram.png" class="img-fluid btn-effect" alt=""></a></li>
            
            <li><a href="<?php echo @$settingThemes['instagram'];?>" target="_blank"><img title="INSTAGRAM" src="<?php echo $urlThemeActive;?>/images/instagram.png" class="img-fluid btn-effect" alt=""></a></li>
            
            <li><a href="<?php echo @$settingThemes['twitter'];?>" target="_blank"><img title="ZALO" src="<?php echo $urlThemeActive;?>/images/twitter.png" class="img-fluid btn-effect" alt=""></a></li>
        </ul>
    </div>

    <div class="full-home-slider" id="fullpage">
         <!-- Trang chủ -->
         <div class="item-slide section" id="slide-home">
            <!-- <div class="social-intro social-mobile">
                <ul>
                    <li><a href="<?php echo @$settingThemes['facebook'];?>" target="_blank"><img src="<?php echo $urlThemeActive;?>/images/facebook.png" class="img-fluid btn-effect" alt=""></a></li>

                    <li><a href="<?php echo @$settingThemes['youtube'];?>" target="_blank"><img src="<?php echo $urlThemeActive;?>/images/youtube.png" class="img-fluid btn-effect" alt=""></a></li>
                    
                    <li><a href="<?php echo @$settingThemes['telegram'];?>" target="_blank"><img src="<?php echo $urlThemeActive;?>/images/telegram.png" class="img-fluid btn-effect" alt=""></a></li>
                    
                    <li><a href="<?php echo @$settingThemes['instagram'];?>" target="_blank"><img src="<?php echo $urlThemeActive;?>/images/instagram.png" class="img-fluid btn-effect" alt=""></a></li>
                    
                    <li><a href="<?php echo @$settingThemes['twitter'];?>" target="_blank"><img src="<?php echo $urlThemeActive;?>/images/twitter.png" class="img-fluid btn-effect" alt=""></a></li>
                </ul>
            </div> -->
            <section class="box-banner-home box-banner-home-unset">
                <div class="video-banner">
                    <video class="videohome" loop="loop" muted="false" autoplay="autoplay" playsinline="" oncontextmenu="return false;" preload="auto">
                        <source src="<?php echo @$settingThemes['video_background_1'];?>" type="video/mp4">
                    </video>
                    <div class="auto-run-text">
                        <marquee scrollamount="5" direction="right">Chào mừng bạn đến với GôDraw</marquee>
                    </div>
                    
                </div>

                <div class="video-background-bottom">
                    <!-- <img src="/themes/godraw/images/backgroundhomevideo.jpg" alt=""> -->

                    <section id="sevices-ft">
                        <div class="container">
                            <div class="sevices-ft-line"></div>
                            <div class="sevices-ft-content">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="sevices-ft-detail">
                                            <div class="sevices-ft-title">
                                                <img src="<?php echo $urlThemeActive;?>/images/svfoot-icon.png" alt="">
                                                <p>WELCOME to GÔDRAW</p>
                                            </div>
                                            <div class="sevices-ft-text">
                                                <p>Là quy trình vẽ thông minh giúp bạn có thể hoàn thiện các bức tranh sơn dầu một cách chuyên nghiệp nhất, tác phẩm của bạn khi hoàn thiện sẽ có chất lượng tương đương với một họa sỹ chuyên nghiệp.</p>
                                            </div>
                                            <div class="sevices-ft-btn">
                                                <a href="">

                                                    <img src="<?php echo $urlThemeActive;?>/images/bgft-btn.png" alt="">
                                                    <p>Về chúng tôi</p>
                                                </a>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6">
                                        <div class="sevices-ft-list">
                                            <div class="sevices-ft-list-title">
                                                <img src="<?php echo $urlThemeActive;?>/images/bg1.png" alt="">
                                                <div class="sevices-ft-list-name">
                                                    <img src="<?php echo $urlThemeActive;?>/images/home-icon.png" alt=""> DỊCH VỤ
                                                </div>
                                            </div>
                                            <div class="sevices-ft-list-items">
                                                <ul>
                                                    <li><i class="fa-solid fa-circle"></i> Khách hàng doanh nghiệp</li>
                                                    <li><i class="fa-solid fa-circle"></i> Tổ chức Workshop</li>
                                                    <li><i class="fa-solid fa-circle"></i> Giáo dục nghệ thuật</li>
                                                    <li><i class="fa-solid fa-circle"></i> Khách hàng cá nhân</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6">
                                        <div class="sevices-ft-list">
                                            <div class="sevices-ft-list-title">
                                                <img src="<?php echo $urlThemeActive;?>/images/bg1.png" alt="">
                                                <div class="sevices-ft-list-name">
                                                    <img src="<?php echo $urlThemeActive;?>/images/home-icon.png" alt=""> Sản phẩm
                                                </div>
                                            </div>
                                            <div class="sevices-ft-list-items">
                                                <ul>
                                                    <li><i class="fa-solid fa-circle"></i> Giải trí - Thư dãn </li>
                                                    <li><i class="fa-solid fa-circle"></i> Quảng bá du lịch</li>
                                                    <li><i class="fa-solid fa-circle"></i> Ấn phẩm truyền thông</li>
                                                    <li><i class="fa-solid fa-circle"></i>Trợ vẽ thông minh</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                
                <!-- <div class="btn-main text-center text-uppercase"><a href="">THƯ VIỆN ẢNH</a></div> -->
            </section>
        </div>

        <!-- Top tranh yêu thích -->
        <div class="item-slide section" id="slide-home-top">
            <div class="social-intro social-mobile">
                <ul>
                    <li><a href="<?php echo @$settingThemes['facebook'];?>" target="_blank"><img src="<?php echo $urlThemeActive;?>/images/facebook.png" class="img-fluid btn-effect" alt=""></a></li>

                    <li><a href="<?php echo @$settingThemes['youtube'];?>" target="_blank"><img src="<?php echo $urlThemeActive;?>/images/youtube.png" class="img-fluid btn-effect" alt=""></a></li>
                    
                    <li><a href="<?php echo @$settingThemes['telegram'];?>" target="_blank"><img src="<?php echo $urlThemeActive;?>/images/telegram.png" class="img-fluid btn-effect" alt=""></a></li>
                    
                    <li><a href="<?php echo @$settingThemes['instagram'];?>" target="_blank"><img src="<?php echo $urlThemeActive;?>/images/instagram.png" class="img-fluid btn-effect" alt=""></a></li>
                    
                    <li><a href="<?php echo @$settingThemes['twitter'];?>" target="_blank"><img src="<?php echo $urlThemeActive;?>/images/twitter.png" class="img-fluid btn-effect" alt=""></a></li>
                </ul>
            </div>

            <section class="box-gallery">
                <div class="container">
                    <div class="content-slide-gallery">
                        <div class="title-slide-vote">
                            <div class="icon" style="margin-right: 10px;"><img src="<?php echo $urlThemeActive;?>/images/top.gif" class="img-fluid" alt=""></div>
                            <a href="/topImage" class="zoom-effect"><span>TOP</span>Tranh yêu thích</a>
                        </div>
                        <div class="content-slider">
                            <div class="slider-hot-nav" id="item-slide-full-mobile">
                                <div class="slide-top slider-nav">
                                    <?php
                                    if(!empty($topImages)){
                                        foreach ($topImages as $key => $value) {
                                            echo '  <div class="item-slide " >
                                                        <div class="item-avr">
                                                            <img src="'.$value->image.'" class="img-fluid w-100" alt="'.$value->name.'">
                                                        </div>
                                                    </div>';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="slide-bot">
                                <!-- <img class="khung-tranh" src="<?php echo $urlThemeActive;?>/images/frame-fn.png" alt=""> -->
                                <div class="slider-for">
                                    <?php
                                    if(!empty($topImages)){
                                        foreach ($topImages as $key => $value) {
                                            echo '  <div class="item-slide">
                                                        <div class="item-for">
                                                            <div class="avr">
                                                                <a href="/detailImage/?id='.$value->id.'">
                                                                    <img src="'.$value->image.'" class="img-fluid" alt="">
                                                                </a>
                                                            </div>
                                                            
                                                            <div class="icon-screen">
                                                                <img src="'.$urlThemeActive.'/images/screen.svg" class="img-fluid" alt="">
                                                            </div>
                                                            
                                                            <div class="heart">
                                                                <span>'.number_format($value->vote).'</span><img src="'.$urlThemeActive.'/images/heart.svg" class="img-fluid" alt="">
                                                            </div>
                                                        </div>
                                                    </div>';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="view-all all-top-view">
                        <a href="/topImage">
                            <img src="<?php echo $urlThemeActive;?>/images/serch.svg" class="img-fluid" alt=""><span>XEM THÊM</span>
                        </a>
                    </div>
                </div>
            </section>
        </div>

        <!-- Dịch vụ -->
        <div class="item-slide section" id="slide-home-service">
            <section class="box-toturial">
            
                    <!-- <div class="avr-top text-center"><img src="<?php echo $urlThemeActive;?>images/tutorial.svg" class="img-fluid" alt=""></div> -->
                    <div class="container">
                        <div class="sevices-title">
                            <div class="sevices-logo">
                                <img src="<?php echo $urlThemeActive;?>/images/bag-icon.png" alt="">
                            </div>
                            <p>DỊCH VỤ</p>
                            <!-- <span>GÔDRAW</span> -->
                        </div>
                        <section id="sevices">
                            <div class="sevices-content">
                                <div class="row">
                                    <div class="item-sevices col-lg-4 col-md-4 col-sm-12 col-12">
                                        <div class="item-sevices-name">
                                            <p>Khách hàng doanh nghiệp</p>
                                            <div class="item-sevices-name-bg">
                                                <img src="<?php echo $urlThemeActive;?>/images/bg2.png" alt="">
                                            </div>
                                        </div>
                                        <div class="item-sevices-img">
                                            <a href="/tin-moi-nhat.html"><img src="<?php echo $urlThemeActive;?>/images/sv-item.png" alt=""></a>
                                        </div>
                                        <div class="item-sevices-detail">
                                            <div class="background-bottom-service">
                                                <img class="background-service-bottom" src="<?php echo $urlThemeActive;?>/images/bottomservice.png" alt="">
                                            </div>

                                            <p>
                                                <span class="text-red-service">HỢP TÁC TRIỂN KHAI DỊCH VỤ GÔ DRAW TẠI QUÁN CAFE VÀ CÁC KHU VUI CHƠI GIẢI TRÍ</span>
                                                <br>
                                                <br>
                                                - Cung cấp dịch vụ vẽ tranh tiên phong độc quyền
                                                <br>
                                                - Đổi mới phong cách, tạo không gian vui chơi
                                                <br>
                                                - Quảng bá thương hiệu doanh nghiệp
                                                <br>
                                                - Tăng trưởng doanh thu lợi nhuận
                                                <br>
                                                - Không chi phí đầu tư
                                            </p>
                                            <div class="item-services-btn">
                                                <a href="/tin-moi-nhat.html">
                                                    <img class="icon-hand" src="<?php echo $urlThemeActive;?>/images/hand-icon.png" alt=""> see more
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="item-sevices col-lg-4 col-md-4 col-sm-12 col-12">
                                        <div class="item-sevices-name">
                                            <p>Workshop hội nghị</p>
                                            <div class="item-sevices-name-bg">
                                                <img src="<?php echo $urlThemeActive;?>/images/bg2.png" alt="">
                                            </div>
                                        </div>
                                        <div class="item-sevices-img">
                                            <a href="/tin-moi-nhat.html"><img src="<?php echo $urlThemeActive;?>/images/sv-item.png" alt=""></a>
                                        </div>
                                        <div class="item-sevices-detail">
                                            <div class="background-bottom-service">
                                                <img class="background-service-bottom" src="<?php echo $urlThemeActive;?>/images/bottomservice.png" alt="">
                                            </div>

                                            <p>
                                                <span class="text-red-service">HỢP TÁC TỔ CHỨC WORKSHOP THEO KHUNG THỜI GIAN</span>
                                                <br>
                                                <br>
                                                - Cung cấp dịch vụ vẽ tranh tiên phong độc quyền
                                                <br>
                                                - Tạo sân chơi thỏa mãn đam mê
                                                <br>
                                                - Quảng bá thương hiệu doanh nghiệp
                                                <br>
                                                - Tối ưu chi phí, doanh thu và lơi nhuận
                                            </p>

                                            <div class="item-services-btn">
                                                <a href="/tin-moi-nhat.html">
                                                    <img class="icon-hand" src="<?php echo $urlThemeActive;?>/images/hand-icon.png" alt=""> see more
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="item-sevices col-lg-4 col-md-4 col-sm-12 col-12">
                                        <div class="item-sevices-name">
                                            <p>Khách hàng cá nhân</p>
                                            <div class="item-sevices-name-bg">
                                                <img src="<?php echo $urlThemeActive;?>/images/bg2.png" alt="">
                                            </div>
                                        </div>
                                        <div class="item-sevices-img">
                                            <a href="/tin-moi-nhat.html"><img src="<?php echo $urlThemeActive;?>/images/sv-item.png" alt=""></a>
                                        </div>
                                        <div class="item-sevices-detail">
                                            <div class="background-bottom-service">
                                                <img class="background-service-bottom" src="<?php echo $urlThemeActive;?>/images/bottomservice.png" alt="">
                                            </div>

                                            <p>
                                                <span class="text-red-service">CUNG CẤP TRẢI NGHIỆM DỊCH VỤ VẼ TRANH GÔ DRAW TẠI CÁC ĐIỂM VẼ</span>
                                                <br>
                                                <br>
                                                - Cung cấp dịch vụ vẽ tranh tiên phong độc quyền
                                                <br>
                                                - Đổi mới phong cách, tạo không gian vui chơi
                                                <br>
                                                - Quảng bá thương hiệu doanh nghiệp
                                                <br>
                                                - Tăng trưởng doanh thu và lợi nhuận
                                                <br>
                                                - Không chi phí đầu tư
                                                <br>
                                                <br>
                                                <span class="text-red-service">CUNG CẤP DỊCH VỤ VẼ TRANH THEO Ý TƯỞNG</span>
                                                <br>
                                                <br>
                                                - Cung cấp dịch vụ vẽ tranh tiên phong độc quyền
                                                <br>
                                                - Đổi mới phong cách, tạo không gian vui chơi
                                                <br>
                                                - Quảng bá thương hiệu doanh nghiệp
                                                <br>
                                                - Tăng trưởng doanh thu và lợi nhuận
                                                <br>
                                                - Không chi phí đầu tư
                                            </p>
                                            <div class="item-services-btn">
                                                <a href="/tin-moi-nhat.html">
                                                    <img class="icon-hand" src="<?php echo $urlThemeActive;?>/images/hand-icon.png" alt=""> see more
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
    
            </section>
        </div>

     
        
        <!-- Danh sách đại lý -->
        <div class="item-slide section slide-relative" id="slide-home-shop">
            <section class="">
                <!--
                <img id="go-now1" src="<?php echo $urlThemeActive;?>/images/go-now.gif" class="img-fluid" alt="">
                <img id="go-now2" src="<?php echo $urlThemeActive;?>/images/go-now.gif" class="img-fluid" alt="">
                <img id="go-now3" src="<?php echo $urlThemeActive;?>/images/go-now.gif" class="img-fluid" alt="">
                <div class="container">
                    <div class="content-search">
                        <div class="head-search">
                            <img class="header-client img-fluid" src="<?php echo $urlThemeActive;?>/images/daily_button.png" alt="">
                        </div>
                        <a href="/search-agency"><img class="btn-client img-fluid" src="<?php echo $urlThemeActive;?>/images/go_button.png" alt=""></a>
                    </div>
                </div>
                -->
                <div class="container">
                    <div class="row">
                        <div class="col-12 title-search-home">
                            <div class="title text-center mb-0">
                                <span>ĐỊA ĐIỂM CÓ DỊCH VỤ VẼ GÔ DRAW</span>
                                <!-- <svg width="1182" height="58" viewBox="0 0 1182 58" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1181.45 57.9501H0.28125V46.8002C0.28125 21.1802 21.0513 0.410156 46.6713 0.410156H1135.05C1160.67 0.410156 1181.44 21.1802 1181.44 46.8002V57.9501H1181.45Z" fill="#1A3A89"/>
                                </svg> -->
                            </div>
                        </div>
                    </div>
                  
                    <div class="">
                        <div class="seach-shop-agency">
                              <!-- form select -->
                              <form action="/search-agency" method="get">
                                        <div class="row box-search-agency">                    
                                            <div class="col-md-2 col-6">
                                                <p>Tìm điểm vẽ</p>
                                                <input placeholder="Nhập điểm vẽ ..." type="text" name="name_agency" value="" class="form-control">
                                            </div>    
                                            <div class="col-md-2 col-6">
                                                <p>Tỉnh thành</p>
                                                <select name="province_id" id="province_id" class="form-control" onchange="selectCity();">
                                                    <option value="">Chọn tỉnh thành</option>
                                                    <?php 
                                                    if(!empty($listCity)){
                                                        foreach ($listCity as $key => $value) {
                                                            echo '<option value="'.$value->province_id.'">'.$value->name.'</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>    
                                            <div class="col-md-3 col-6">
                                                <p>Quận huyện</p>
                                                <select name="district_id" id="district_id" class="form-control" onchange="selectDistrict();">
                                                    <option value="">Chọn quận huyện</option>
                                                </select>
                                            </div>  
                                            <div class="col-md-3 col-6">
                                                <p>Xã phường</p>
                                                <select name="ward_id" id="ward_id" class="form-control">
                                                    <option value="">Chọn phường xã</option>
                                                </select>
                                            </div>    
                                            <div class="col-md-2">
                                                <p>&nbsp;</p>
                                                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                                            </div>  
                                        </div>
                                    </form>  
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="content-maps-left">
                                    <div class="list-showroom">
                                        <?php 
                                        if(!empty($listAgency)){
                                            foreach ($listAgency as $key => $value) {
                                                echo '<div class="item-showroom">
                                                        <div class="avr"><img src="'.@$value->image.'" class="img-fluid w-100" alt=""></div>
                                                        <div class="info">
                                                            <h3>
                                                                <a target="_blank" href="/store/?id='.$value->id.'">'.@$value->name.'</a>
                                                            </h3>
                                                            <ul>
                                                                <li>'.@$value->address.'</li>
                                                                <li>'.@$value->phone.'</li>
                                                                <li>'.@$value->email.'</li>
                                                            </ul>
                                                        </div>
                                                    </div>';
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="avr-maps">
                                    <?php include(__DIR__.'/godraw/findnear_openstreet_map.php');?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              
            </section>

            <div class="item-slide-relative box-footer">
                <div class="content-footer">
                    <div class="logo-foter">
                        <div class="logo"><img src="/plugins/go_draw/view/agency/images/logo-footer.svg" class="img-fluid" alt=""></div>
                        <div class="txt-logo">
                            <h4>CÔNG TY CỔ PHẦN GIẢI PHÁP NGHỆ THUẬT THÔNG MiNH</h4>
                            <ul>
                                <li>Địa chỉ : <?php echo @$contactSite['address'];?></li>
                                <li>Điện thoại: </span> <?php echo @$contactSite['phone'];?></li>
                                <li>Email: </span> </span><?php echo @$contactSite['email'];?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="social">
                        <ul>
                            <li><a href=""><img src="/plugins/go_draw/view/agency/images/sc-1.svg" class="img-fluid" alt=""></a></li>
                            <li><a href=""><img src="/plugins/go_draw/view/agency/images/sc-2.svg" class="img-fluid" alt=""></a></li>
                            <li><a href=""><img src="/plugins/go_draw/view/agency/images/sc-3.svg" class="img-fluid" alt=""></a></li>
                            <li><a href=""><img src="/plugins/go_draw/view/agency/images/sc-4.svg" class="img-fluid" alt=""></a></li>
                            <li><a href=""><img src="/plugins/go_draw/view/agency/images/sc-5.svg" class="img-fluid" alt=""></a></li>
                        </ul>
                    </div>
                    <div class="subscribe-fter">
                        <div class="support">
                            <a href="/contact"></a>
                            <div class="icon">
                                <svg width="19" height="24" viewBox="0 0 19 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.7996 4.96973C13.7996 4.59973 13.7996 4.29996 13.7996 4.20996C13.7996 2.63996 12.7295 0 9.43945 0H9.27954C5.71954 0 4.90942 2.69996 4.90942 4.20996C4.90942 4.30996 4.90942 4.59973 4.90942 4.96973C4.55942 4.96973 4.26953 5.25986 4.26953 5.60986V7.18994C4.26953 7.53994 4.54942 7.83008 4.90942 7.83008C4.91942 7.83008 4.92945 7.83008 4.93945 7.83008C5.19945 10.1101 7.83954 12.6899 9.27954 12.6899H9.43945C10.9195 12.6899 13.5195 10.1201 13.7795 7.83008C13.7895 7.83008 13.7993 7.83008 13.8093 7.83008C14.1593 7.83008 14.4495 7.54994 14.4495 7.18994V5.60986C14.4395 5.25986 14.1496 4.96973 13.7996 4.96973Z" fill="white"/>
                                    <path d="M5.01123 13.8599C2.31123 13.8599 0.121094 16.05 0.121094 18.75V23.7598H9.47119L5.16113 13.8501H5.01123V13.8599Z" fill="white"/>
                                    <path d="M13.9326 13.8599H13.5127L9.47266 23.77H18.8225V18.7598C18.8225 16.0498 16.6326 13.8599 13.9326 13.8599Z" fill="white"/>
                                    <path d="M9.35938 14.3999L6.85938 12.9697V15.7598L9.35938 14.3999Z" fill="white"/>
                                    <path d="M9.35938 14.3999L11.8594 12.9697V15.7598L9.35938 14.3999Z" fill="white"/>
                                    <path d="M10.1504 14.3999C10.1504 14.8399 9.79035 15.1899 9.36035 15.1899C8.92035 15.1899 8.57031 14.8399 8.57031 14.3999C8.57031 13.9599 8.92035 13.6099 9.36035 13.6099C9.79035 13.6099 10.1504 13.9599 10.1504 14.3999Z" fill="white"/>
                                </svg>
                            </div>
                            <span>Hỗ trợ</span>
                        </div>
                        <div class="content-subscribe">
                            <div class="head-sub">
                                <h4>ĐĂNG KÝ NHẬN EMAIL TỪ CHÚNG TÔI</h4>
                                <div class="icon"><img src="/plugins/go_draw/view/agency/images/subscribe.svg" class="img-fluid" alt=""></div>
                            </div>
                            <div class="sub-form">
                                <form action="">
                                    <input type="text" class="txt_field" value="" placeholder="Entering email here">
                                    <input type="submit" value="Đăng ký" class="btn_field">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="copyright text-center">
                    <div class="container">
                        <p>Copyright © 2023 GÔDRAW. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sửa -->
        <!-- <div class="item-slide">
            <section class="box-maps">
                <div class="container">
                    <div class="title text-center mb-0">
                        <span>Danh sách đại lý GÔDRAW</span>
                        <svg width="1182" height="58" viewBox="0 0 1182 58" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1181.45 57.9501H0.28125V46.8002C0.28125 21.1802 21.0513 0.410156 46.6713 0.410156H1135.05C1160.67 0.410156 1181.44 21.1802 1181.44 46.8002V57.9501H1181.45Z" fill="#1A3A89"/>
                        </svg>
                    </div>
                    <div class="content-maps">
                        <div class="maps-left">
                            <div class="content-maps-left">
                               
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
        </div> -->
        
        <!-- footer thêm -->
        <!-- <div class="item-slide ">
            <div class="item-slide-relative box-footer">
                <div class="content-footer">
                    <div class="logo-foter">
                        <div class="logo"><img src="/plugins/go_draw/view/agency/images/logo-footer.svg" class="img-fluid" alt=""></div>
                        <div class="txt-logo">
                            <h4>CÔNG TY CỔ PHẦN NGHỆ THUẬT THÔNG MiNH</h4>
                            <ul>
                                <li>Addres : So. 34A Tran Phu - Q. Ba Dinh - Tp. Ha Noi</li>
                                <li>Hotline: 09.8888.9999 - 09.6666.8888</li>
                            </ul>
                        </div>
                    </div>
                    <div class="social">
                        <ul>
                            <li><a href=""><img src="/plugins/go_draw/view/agency/images/sc-1.svg" class="img-fluid" alt=""></a></li>
                            <li><a href=""><img src="/plugins/go_draw/view/agency/images/sc-2.svg" class="img-fluid" alt=""></a></li>
                            <li><a href=""><img src="/plugins/go_draw/view/agency/images/sc-3.svg" class="img-fluid" alt=""></a></li>
                            <li><a href=""><img src="/plugins/go_draw/view/agency/images/sc-4.svg" class="img-fluid" alt=""></a></li>
                            <li><a href=""><img src="/plugins/go_draw/view/agency/images/sc-5.svg" class="img-fluid" alt=""></a></li>
                        </ul>
                    </div>
                    <div class="subscribe-fter">
                        <div class="support">
                            <a href=""></a>
                            <div class="icon">
                                <svg width="19" height="24" viewBox="0 0 19 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.7996 4.96973C13.7996 4.59973 13.7996 4.29996 13.7996 4.20996C13.7996 2.63996 12.7295 0 9.43945 0H9.27954C5.71954 0 4.90942 2.69996 4.90942 4.20996C4.90942 4.30996 4.90942 4.59973 4.90942 4.96973C4.55942 4.96973 4.26953 5.25986 4.26953 5.60986V7.18994C4.26953 7.53994 4.54942 7.83008 4.90942 7.83008C4.91942 7.83008 4.92945 7.83008 4.93945 7.83008C5.19945 10.1101 7.83954 12.6899 9.27954 12.6899H9.43945C10.9195 12.6899 13.5195 10.1201 13.7795 7.83008C13.7895 7.83008 13.7993 7.83008 13.8093 7.83008C14.1593 7.83008 14.4495 7.54994 14.4495 7.18994V5.60986C14.4395 5.25986 14.1496 4.96973 13.7996 4.96973Z" fill="white"/>
                                    <path d="M5.01123 13.8599C2.31123 13.8599 0.121094 16.05 0.121094 18.75V23.7598H9.47119L5.16113 13.8501H5.01123V13.8599Z" fill="white"/>
                                    <path d="M13.9326 13.8599H13.5127L9.47266 23.77H18.8225V18.7598C18.8225 16.0498 16.6326 13.8599 13.9326 13.8599Z" fill="white"/>
                                    <path d="M9.35938 14.3999L6.85938 12.9697V15.7598L9.35938 14.3999Z" fill="white"/>
                                    <path d="M9.35938 14.3999L11.8594 12.9697V15.7598L9.35938 14.3999Z" fill="white"/>
                                    <path d="M10.1504 14.3999C10.1504 14.8399 9.79035 15.1899 9.36035 15.1899C8.92035 15.1899 8.57031 14.8399 8.57031 14.3999C8.57031 13.9599 8.92035 13.6099 9.36035 13.6099C9.79035 13.6099 10.1504 13.9599 10.1504 14.3999Z" fill="white"/>
                                </svg>
                            </div>
                            <span>Support</span>
                        </div>
                        <div class="content-subscribe">
                            <div class="head-sub">
                                <h4>REGISTER TO RECEIVE EMAIL FROM US</h4>
                                <div class="icon"><img src="/plugins/go_draw/view/agency/images/subscribe.svg" class="img-fluid" alt=""></div>
                            </div>
                            <div class="sub-form">
                                <form action="">
                                    <input type="text" class="txt_field" value="" placeholder="Entering email here">
                                    <input type="submit" value="Subscribe" class="btn_field">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="copyright text-center">
                    <div class="container">
                        <p>Copyright © 2023 GÔDRAW. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</main>

<?php getFooter();?>

<script type="text/javascript">
$(document).ready(function(){
    <?php 
    if(!empty($_GET['view'])){
        switch ($_GET['view']) {
            case 'home':
                echo "$('.full-home-slider').slick('slickGoTo', 0);";
                break;

            case 'gallery':
                echo "$('.full-home-slider').slick('slickGoTo', 1);";
                break;

            case 'service':
                echo "$('.full-home-slider').slick('slickGoTo', 2);";
                break;
                        
            case 'store':
                echo "$('.full-home-slider').slick('slickGoTo', 3);";
                break;
        }
    }
    ?>
    
});
</script>

<script type="text/javascript">
    function selectDistrict()
    {
        var district_select = $('#district_id').val();

        var ward_option = '<option value="">Chọn xã phường</option>';
        var i;

        if(district_select != ""){
            $.ajax({
              method: "POST",
              url: "/apis/getWardAPI",
              data: { district_id: district_select }
            })
            .done(function( msg ) {
                if(msg.length>0){
                    for(i=0;i<msg.length;i++){
                        if(msg[i].wards_id != ward_id){
                            ward_option += '<option value="'+msg[i].wards_id+'">'+msg[i].name+'</option>';
                        }else{
                            ward_option += '<option selected value="'+msg[i].wards_id+'">'+msg[i].name+'</option>';
                        }
                    }
                }

                $('#ward_id').html(ward_option);
            });
        }else{
            $('#ward_id').html(ward_option);
        }
    }

    function selectCity()
    {
        var province_id = $('#province_id').val();
        var district_option = '<option value="">Chọn quận huyện</option>';
        var i;

        if(province_id != ""){
            $.ajax({
              method: "POST",
              url: "/apis/getDistrictAPI",
              data: { province_id: province_id }
            })
            .done(function( msg ) {
                if(msg.length>0){
                    for(i=0;i<msg.length;i++){
                        district_option += '<option value="'+msg[i].district_id+'">'+msg[i].name+'</option>';
                    }
                }

                $('#district_id').html(district_option);

                selectDistrict();
            });
        }else{
            $('#district_id').html(district_option);

            selectDistrict();
        }
    }
</script>