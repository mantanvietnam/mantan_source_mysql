<?php getHeader();?>

<main id="video-learning">
    <section class="video-learning-title">
        <div class="container text-left">
            <h1><?php echo $data->title;?></h1>
            <p>
                Khoá học bởi <span class="author text-primary-custom"><?php echo $data->author;?></span>
            </p>
        </div>
    </section>
    <section class="video-learning-iframe">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="iframe-contain d-flex justify-content-center">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $data->youtube_code;?>"
                            title="YouTube video player" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                </div>
                <div class="col-lg-4">
                    <section class="list-bai-hoc-contain rounded-4 p-4">
                        <div class="head d-flex align-items-center mb-3">
                            <img src="<?php echo $urlThemeActive;?>/assets/img/list-lesson.svg" class="me-3" alt="">
                            <h5 class="mb-0 text-primary-custom"><?php echo count($tests);?> bài thi</h5>
                        </div>
                        <div class="list">
                            <ul class="list-unstyled" loop="30">
                                <?php 
                                if(!empty($tests)){
                                    foreach ($tests as $key => $value) {
                                        echo '<li class="mb-3">
                                                    <a href="/test/'.$value->slug.'.html">
                                                        <div class="lesson-item active">
                                                            <div class="d-flex align-items-center">
                                                                <img src="'.$urlThemeActive.'/assets/img/lesson-img.png" class="thumb me-3" alt="">
                                                                <div>
                                                                    <h5 class="mb-0">'.$value->title.'</h5>
                                                                    <span>'.$value->time_test.' phút từ '.date('H:i d/m/Y', $value->time_start).' đến '.date('H:i d/m/Y', $value->time_end).'</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>';
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                        <p><?php echo $data->description;?></p>
                    </section>
                </div>
            </div>
        </div>
    </section>
    <section class="video-learning-detail">
        <div class="container">
            <div class="row g-3 g-lg-0 justify-content-lg-between">
                <div class="col-12 col-lg-12">
                    <div class="contain pe-lg-5">
                        <h3 class="text-primary-custom">Nội dung đào tạo</h3>
                        <div class="nav-content">
                            <div class="course-detail">
                                <div class="content"><?php echo $data->content;?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="more-courses">
        <div class="container">
            <h2 class="">Các bài học liên quan</h2>
            <div class="my-slider-more-courses" loop="5">
                <?php
                if(!empty($otherData)){
                    foreach ($otherData as $key => $item) {
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
                                                        <span>Thời gian học: </span>
                                                        <b>'.$item->time_learn.' phút</b>
                                                    </p>
                                                    <p class="card-text">
                                                        <span>Số lượt xem: </span>
                                                        <b>'.number_format($item->view).'</b>
                                                    </p>
                                                </div>
                                                <div class="card-bottom">
                                                    <div class="text-center justify-content-between align-items-center">
                                                        <button class="btn btn-custom-primary">Tham gia ngay</button>
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
        </div>

    </section>
</main>

<?php getFooter();?>
