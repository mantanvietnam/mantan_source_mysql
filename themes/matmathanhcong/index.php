<?php 
    global $settingThemes;
    getHeader();
?>

<main>

    <section class="box-banner">
        <div class="num-abs abs-1">1</div>
        <div class="num-abs abs-2">2</div>
        <div class="num-abs abs-3">3</div>
        <div class="num-abs abs-4">4</div>
        <div class="num-abs abs-5">5</div>
        <div class="num-abs abs-6">6</div>
        <div class="num-abs abs-7">7</div>
        <div class="num-abs abs-8">8</div>
        <div class="num-abs abs-9">9</div>
        
        <div class="content-banner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="txt-banner">
                            <div class="info-banner">
                                <h1 class="text-uppercase" data-aos="fade-down"><?php echo @$settingThemes['titleBanner'];?></h1>
                                <div class="desc" data-aos="fade-up">
                                    <?php echo @$settingThemes['descBanner'];?>
                                </div>
                                <div class="form-banner text-center" data-aos="zoom-out" data-aos-delay="600">
                                    <form action="/result" method="get">
                                        <div class="item-frm">
                                            <input type="text" placeholder="Họ và Tên" name="name" class="txt_field" required>
                                        </div>
                                        
                                        <div class="item-frm">
                                            <div class="row">
                                                <div class="col-md-4 col-sm-4 col-4">
                                                    <input required type="number" name="day" placeholder="Ngày" class="txt_field" onKeyUp="if(this.value>31){this.value='31';}else if(this.value<0){this.value='0';}" />
                                                </div>
                                                
                                                <div class="col-md-4 col-sm-4 col-4">
                                                    <input required type="number" name="month" placeholder="Tháng" class="txt_field" onKeyUp="if(this.value>12){this.value='12';}else if(this.value<0){this.value='0';}" />
                                                </div>
                                                
                                                <div class="col-md-4 col-sm-4 col-4">
                                                    <input required type="number" name="year" placeholder="Năm sinh" class="txt_field" onKeyUp="if(this.value>new Date().getFullYear()){this.value=new Date().getFullYear();}else if(this.value<0){this.value='1950';}" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item-frm"><input type="submit" value="TRA CỨU" class="btn_field"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="box-tintuc bg-tintuc pd-50">
        <div class="container">   
            <div class="title-news text-center min-height-600 fs-title">
                <h1><?php echo @$settingThemes['title2'];?></h1>
            </div> 
            <div class="intro-news">
                <div class="row">
                    <div class="col-12">
                        <div class="slick-wrapper">
                            <div class="slick-news">
                                <?php 
                                if(!empty($listNews2)){
                                    foreach ($listNews2 as $key => $value) {
                                        echo '  <div class="slide-item">
                                                    <a href="/'.$value->slug.'.html">
                                                        <div class="img-news">
                                                            <img src="'.$value->image.'">
                                                        </div>
                                                        <div class="text-title-news">
                                                            <h4>'.$value->title.'</h4>
                                                            <p>'.$value->description.'</p>
                                                        </div>
                                                    </a>
                                                    
                                                </div>';
                                    }
                                }
                                ?>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="box-nguyencuu-sohoc pd-50 bg-tintuc">
        <div class="container">
            <div class="row pd-sohoc border-sohoc dp-block">
                <div class="col-6 col-text-sohoc">
                    <div class="title-text-nghiencuu-sohoc">
                        <h3> NHÀ NGUYÊN CỨU THẦN SỐ HỌC PITAGO</h3>
                        <h1>THẦY TRẦN TOẢN</h1>
                    </div>
                    
                    <ul class="list-text-nc-sohoc">
                       <li>CEO Tra cứu thần số học Trần Toản - Nhà nghiên cứu thần số học</li> 
                       <li>Nhà sáng lập hệ thống Tra cứu thần số học hàng đầu Việt Nam</li>
                       <li>Hơn 7 năm nghiên cứu  và ứng dụng Nhân số học vào đời sống</li>
                       <li>Hơn 100 khóa đào tạo thần số học cho đại chúng Việt Nam</li>
                       <li>Cố vấn định hướng cho hơn 50 doanh nghiệp lớn nhỏ trong kỷ nguyên chuyển đổi số</li>

                    </ul>
                </div>

                <div class="col-6 col-image-sohoc">
                    <div class="devvn_image_absolute absolute devvn_image_7">
                        <div class="devvn_image_inner">
                            <div class="devvn_image_background">

                            </div>
                        </div>
                    </div>
                    <img class="image-nc-sohoc" src="<?php echo $urlThemeActive;?>/images/faq.svg" alt="">
                </div>
            </div>
        </div>
    </section>

    <section class="box-phanhoi pd-50 bg-tintuc">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="slick-wrapper">
                        <div class="slick-phanhoi">
                            <?php 
                            if(!empty($feedbacks)){
                                foreach ($feedbacks as $key => $value) {
                                    echo '  <div class="slide-item">
                                                <div class="intro-phanhoi">
                                                        <div class="box-text-phanhoi">
                                                            <img class="avata-phanhoi" src="'.$value->avatar.'" alt="">
                                                            <p class="people-phanhoi">'.$value->full_name.'</p>
                                                            <p class="text-phanhoi">'.$value->content.'</p>
                                                            
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
        </div>

    </section>

    <script type="text/javascript">
        $(document).ready(function(){
          $('.slick-phanhoi').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            dots:true,
            infinite: false,
            arrows: false,
            responsive:[
                    {
                        breakpoint:769,settings:{
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint:451,settings:{
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            infinite: false,
                            arrows:false,
                            autoplay:true,
                            autoplaySpeed:3000,
                        }
                    }
                ]
          });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('.slick-news').slick({
                slidesToShow: 3,
                slidesToScroll: 3,
                dots:true,
                infinite: false,
                rows: 2,
                responsive:[
                    {
                        breakpoint:769,settings:{
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint:451,settings:{
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            rows:2,
                            infinite: false,
                            arrows:false,
                            autoplay:true,
                            autoplaySpeed:3000,
                        }
                    }
                ]
            });
        });
    </script>

    <section class="box-ungdung-sohoc bg-sohoc pd-50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="title-ungdung-sohoc">
                        <h2><?php echo @$settingThemes['title3'];?></h2>
                    </div>

                    <div class="row intro-ungdung-sohoc">
                        <?php 
                        if(!empty($listNews3)){
                            foreach ($listNews3 as $key => $value) {
                                echo '  <div class="col-6 mg-bt-30 width-100">
                                            <div class="content-ungdung">
                                                <div class="flex-ungdung">
                                                    <div class="intro-ungdung-left bg-image pd-20 pd-10-5">
                                                        <img src="'.$value->image.'" alt="">

                                                    </div>
                                                    <div class="intro-ungdung-right pd-20 pd-15-5">
                                                        <h4>'.$value->title.'</h4>
                                                        <p class="list-text-sohoc">
                                                            '.$value->description.'
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="frame-button btn_field">
                                                    <a href="/'.$value->slug.'.html" class="custom-btn btn-14">TÌM HIỂU THÊM</a>
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
    </section>

    <section class="devvn_box_meaningfuls pd-50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="devvn_tabs_ux_element_js devvn-tabbed-content">
                        <div class="devvn_tab_left col-6 wt-100">
                            <ul class="nav nav-line nav-uppercase nav-size-normal nav-left" id="list-number-hover">
                                <li class="tab has-icon" data-id="tab_1">
                                    <a href="javascript:void(0)" data-tab="tab_1" onclick="openCity(event, 'tab_1')" onclick="openCity(event, 'Paris')" class="tablinks">
                                        <img class="image_public" src="<?php echo $urlThemeActive;?>/images/number1.png" alt="">
                                        <img class="image_hover" src="<?php echo $urlThemeActive;?>/images/number-hover-1.png" alt="">
                                    </a>
                                </li>
                                <li class="tab has-icon" data-id="tab_2">
                                    <a href="javascript:void(0)" data-tab="tab_2" onclick="openCity(event, 'tab_2')" class="tablinks" >
                                        <img class="image_public" src="<?php echo $urlThemeActive;?>/images/number2.png" alt="">
                                        <img class="image_hover" src="<?php echo $urlThemeActive;?>/images/number-hover-2.png" alt="">
                                    </a>
                                </li>
                                <li class="tab has-icon" data-id="tab_3">
                                    <a href="javascript:void(0)" data-tab="tab_3" onclick="openCity(event, 'tab_3')" class="tablinks" >
                                        <img class="image_public" src="<?php echo $urlThemeActive;?>/images/number3.png" alt="">
                                        <img class="image_hover" src="<?php echo $urlThemeActive;?>/images/number-hover-3.png" alt="">
                                    </a>
                                </li>
                                <li class="tab has-icon" data-id="#tab_4">
                                    <a href="javascript:void(0)" data-tab="tab_4" onclick="openCity(event, 'tab_4')" class="tablinks">
                                        <img class="image_public" src="<?php echo $urlThemeActive;?>/images/number4.png" alt="">
                                        <img class="image_hover" src="<?php echo $urlThemeActive;?>/images/number-hover-4.png" alt="">
                                    </a>
                                </li>
                                <li class="tab has-icon" data-id="tab_5">
                                    <a href="javascript:void(0)" data-tab="tab_5" onclick="openCity(event, 'tab_5')" class="tablinks" >
                                        <img class="image_public" src="<?php echo $urlThemeActive;?>/images/number5.png" alt="">
                                        <img class="image_hover" src="<?php echo $urlThemeActive;?>/images/number-hover-5.png" alt="">
                                    </a>
                                </li>
                                <li class="tab has-icon" data-id="tab_6">
                                    <a href="javascript:void(0)" data-tab="tab_6" onclick="openCity(event, 'tab_6')" class="tablinks" >
                                        <img class="image_public" src="<?php echo $urlThemeActive;?>/images/number6.png" alt="">
                                        <img class="image_hover" src="<?php echo $urlThemeActive;?>/images/number-hover-6.png" alt="">
                                    </a>
                                </li>
                                <li class="tab has-icon" data-id="tab_7">
                                    <a href="javascript:void(0)" data-tab="tab_7" onclick="openCity(event, 'tab_7')" class="tablinks" >
                                        <img class="image_public" src="<?php echo $urlThemeActive;?>/images/number7.png" alt="">
                                        <img class="image_hover" src="<?php echo $urlThemeActive;?>/images/number-hover-7.png" alt="">
                                    </a>
                                </li>
                                <li class="tab has-icon" data-id="tab_8">
                                    <a href="javascript:void(0)" data-tab="tab_8" onclick="openCity(event, 'tab_8')" class="tablinks" >
                                        <img class="image_public" src="<?php echo $urlThemeActive;?>/images/number8.png" alt="">
                                        <img class="image_hover" src="<?php echo $urlThemeActive;?>/images/number-hover-8.png" alt="">
                                    </a>
                                </li>
                                <li class="tab has-icon" data-id="tab_9">
                                    <a href="javascript:void(0)" data-tab="tab_9"  onclick="openCity(event, 'tab_9')"class="tablinks"  >
                                        <img class="image_public" src="<?php echo $urlThemeActive;?>/images/number9.png" alt="">
                                        <img class="image_hover" src="<?php echo $urlThemeActive;?>/images/number-hover-9.png" alt="">
                                    </a>
                                </li>
                                <li class="tab has-icon"  data-id="tab_11">
                                    <a  href="javascript:void(0)" data-tab="tab_10" onclick="openCity(event, 'tab_10')" class="tablinks" >
                                        <img class="image_public" src="<?php echo $urlThemeActive;?>/images/number11.png" alt="">
                                        <img class="image_hover" src="<?php echo $urlThemeActive;?>/images/number-hover-11.png" alt="">
                                    </a>
                                </li>
                                <li class="tab has-icon" data-id="tab_11">
                                    <a href="javascript:void(0)" data-tab="tab_11" onclick="openCity(event, 'tab_11')" class="tablinks">
                                        <img class="image_public" src="<?php echo $urlThemeActive;?>/images/number12.png" alt="">
                                        <img class="image_hover" src="<?php echo $urlThemeActive;?>/images/number-hover-12.png" alt="">
                                    </a>
                                </li>
                            </ul>

                            <script>
                                $('.devvn_box_meaningfuls .nav').on('click', 'li', function(){
                                    $('.devvn_box_meaningfuls .nav li').removeClass('active');
                                    $(this).addClass('active');
                                });
                            </script>

                        </div>

                        <div class="devvn_tab_right col-6 wt-100">                    
                            <div class="devvn_tab_bottom">
                                <div class="tab-panel-title">
                                    <h3 class="uppercase text-left"><b></b>Ý NGHĨA CÁC CON SỐ<br>TRONG THẦN SỐ HỌC<b></b></h3>
                                </div>
                                
                                <div class="content-tab-slide nav nav-line nav-uppercase nav-size-normal nav-left">
                                    <?php 
                                        for ($i=1; $i<=9 ; $i++) { 
                                            echo '  <div class="tab-content tabcontent" id="tab_'.$i.'" style="display: none;">
                                                        <div class="panel  entry-content" >
                                                            <div class="info">
                                                                <h3>Ý Nghĩa Của Thần Số Học Số '.$i.'</h3>
                                                            </div>
                                                            <p>'.@$settingThemes['number'.$i].'</p>
                                                        </div>
                                                    </div>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function openCity(evt, cityName) {
          var i, tabcontent, tablinks;
          tabcontent = document.getElementsByClassName("tabcontent");
          for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
          }
          tablinks = document.getElementsByClassName("tablinks");
          for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
          }
          document.getElementById(cityName).style.display = "block";
          evt.currentTarget.className += " active";
        }
    </script>

    <section class="box-faq" id="faq">
        <div class="container">
            <div class="title text-center"  data-aos="fade-up">
                <h2><?php echo @$settingThemes['ques_title']; ?></h2>
            </div>
            <div class="content-faq">
                <div class="row">
                    <div class="col-md-6 setting-faq-left">
                        <div class="list-faq">
                            <?php 
                            if(!empty($questions)){
                                foreach ($questions as $key => $value) {
                                    echo '  <div class="item-faq"  data-aos="fade-up">
                                                <div class="quess">
                                                    <div class="icon">
                                                        <img src="'.$urlThemeActive.'/images/icon-faq.svg" class="img-fluid" alt="">
                                                    </div>
                                                    <div class="txt-quess">'.$value->question.'</div>
                                                    <div class="icon-arr">
                                                        <img src="'.$urlThemeActive.'/images/arrow.png" class="img-fluid" alt="">
                                                    </div>
                                                </div>
                                                <div class="answer">
                                                    '.$value->answer.'
                                                </div>
                                            </div>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="avarta-faq text-center"  data-aos="fade-up">
                            <img src="<?php echo $urlThemeActive;?>/images/faq.svg" class="img-fluid" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php getFooter();?>  