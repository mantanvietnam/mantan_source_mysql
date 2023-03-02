<?php getHeader();?>
<main>
    <section class="banner">
        <div class="container">
            <div class="row g-0">
                <div class="col-12 col-md-6">
                    <div class="contain-left">
                        <div class="form">
                            <form action="/search-lesson" method="key" id="form_search">
                                <input name="key" onchange="$('#form_search').submit();" type="text" class="form-control" value="" placeholder="Tìm kiếm khóa học">

                                <button type="submit" class="btn-circle">
                                    <i class="fa-solid fa-search"></i>
                                </button>
                            </form>
                        </div>
                        <div class="heading">
                            <h5 class="text-uppercase text-secondary-custom"><?php echo @$setting_value['slogan'];?></h5>
                            <h1 class="text-neutral-1"><?php echo @$setting_value['text_banner'];?></h1>
                            <a href="<?php echo @$setting_value['link_button'];?>">
                                <button class="btn btn-custom-primary">Khám Phá Khoá Học</button>
                            </a>
                            <div class="mouse">
                                <img src="<?php echo $urlThemeActive;?>/assets/img/banner-mouse-icon.png" alt="">
                            </div>
                            <div class="banner-underline">
                                <img src="<?php echo $urlThemeActive;?>/assets/img/banner-underline.svg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="contain-right">
                        <div class="image-contain">
                            <img src="<?php echo @$setting_value['background_banner'];?>" alt="">
                        </div>
                        <div class="card-absolute-contain">
                            <div class="card-absolute">
                                <div class="d-flex">
                                    <div class="card-ab-img">
                                        <img src="<?php echo $urlThemeActive;?>/assets/img/card-ab-img.png" alt="">
                                    </div>
                                    <div class="card-ab-content">
                                        <h6>Học về khởi nghiệp</h6>
                                        <p>Hôm nay</p>
                                        <a href="/login">
                                            <button class="btn bg-secondary-1 text-white">Tham gia ngay</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="chuong-trinh-dao-tao">
        <div class="container">
            <h2 class="text-center text-secondary-custom"><?php echo @$setting_value['title_training'];?></h2>
            <p class="text-neutral-4 text-center head-text"><?php echo @$setting_value['description_training'];?></p>
            <div class="my-slider" loop="5">
                <?php 
                    if(!empty($listLessons)){
                        foreach ($listLessons as $item) {
                            $popupLogin = (empty($session->read('infoUser')))?'return showPopup(\'login-check\');':'';

                            echo '<div class="item p-3">
                                    <div class="card-course-contain-index">
                                        <a href="/course/'.$item->slug.'.html" onclick="'.$popupLogin.'">
                                            <div class="card">
                                                <div class="card-top">
                                                    <img src="'.$item->image.'" alt="'.$item->title.'">
                                                </div>
                                                <div class="card-body">
                                                    <h5 class="card-title">'.$item->title.'</h5>
                                                    <p class="card-text">
                                                        <span>Chuyên đề: </span>
                                                        <b>'.$item->name_category.'</b>
                                                    </p>
                                                    <p class="card-text">
                                                        <span>Thời gian học: </span>
                                                        <b>'.$item->time_learn.' phút</b>
                                                    </p>
                                                    <p class="card-text">
                                                        <span>Số lượt xem: </span>
                                                        <b>'.number_format($item->view).'</b>
                                                    </p>
                                                </div>
                                                <div class="card-bottom">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <button class="btn btn-custom-primary">Tham gia ngay</button>
                                                    
                                                        <button class="btn text-primary-custom">
                                                            Làm bài thi
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>';
                        }
                    }
                ?>
            </div>
            <div class="detail-all-courses">
                <div class="d-flex justify-content-center">
                    <a href="/training">
                        <button class="btn btn-yellow">Xem thêm các khoá học</button>
                    </a>
                </div>
            </div>
        </div>
    </section>
    
    <section class="list-post">
        <div class="container">
            <h2><?php echo @$setting_value['title_news'];?></h2>
            <div class="row g-3" loop="6">
                <?php 
                    if(!empty($listPosts)){
                        foreach ($listPosts as $item) {
                            echo '  
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <a href="/'.$item->slug.'.html">
                                            <div class="card-ne-contain">
                                                <div class="card">
                                                    <img src="'.$item->image.'" class="card-img-top" alt="'.$item->title.'">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center card-head">
                                                            <div class="title">
                                                                <h5 class="mb-0">'.$item->title.'</h5>
                                                            </div>
                                                        </div>
                                                        <p class="card-text mb-0">'.$item->description.'</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    ';
                        }
                    }
                ?>
                
            </div>
            <div class="d-flex justify-content-center">
                <a href="/posts/">
                    <button class="btn-yellow">Xem thêm</button>
                </a>
            </div>
        </div>
    </section>
</main>
<?php getFooter();?>
