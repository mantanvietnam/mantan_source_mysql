<?php
    getHeader();
    global $urlThemeActive;
?>
<main>
    <section class="post-head">
        <img src="<?php echo @$post->image; ?>">
    </section>
    <section class="post-content">
        <div class="container">
            <h1><?php echo @$post->title; ?></h1>
            <div class="post-content-main">
                <?php echo @$post->content; ?>
            </div>
        </div>
    </section>


    <div class="post-more-header container">
        <h3>Tin tức khác</h3>
    </div>

    <section class="more">
        <div class="container">
            <div class="row g-4">
                <?php 
                    if(!empty($otherPosts)){
                        foreach ($otherPosts as $key => $value) {
                            $link = '/'.$value->slug.'.html';

                            
                            echo '<div class="col-12 col-lg-6">
                                    <div class="contain">
                                        <div class="post-card card">
                                            <div class="d-flex">
                                                <div class="card-img-custom">
                                                    <img src="'.$value->image.'" alt="">
                                                </div>
                                                <div class="card-content-custom">
                                                    <div class="content-contain">
                                                        <h5><a href="'.$link.'">'.$value->title.'</a></h5>
                                                        <p>'.$value->content.'</p>
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <span class="">'.date('d/m/Y', $value->time).'</span>
                                                        </div>
                                                    </div>
                                                </div>
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
    <section class="form-custom">
        <div class="container">
            <h3>ĐĂNG KÝ NHẬN ƯU ĐÃI</h3>
            <div class="form-contain">
                <form action="">
                    <div class="row g-3">
                        <div class="col-12 col-lg-6 mt-0 mb-2">
                            <div class="form-field">
                                <label for="">Họ và tên<sup>*</sup></label>
                                <input required type="text" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 mt-0 mb-2">
                            <div class="form-field">
                                <label for="">Email<sup>*</sup></label>
                                <input required type="email" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 mt-0 mb-2">
                            <div class="form-field">
                                <label for="">Số điện thoại<sup>*</sup></label>
                                <input required type="phone" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 mt-0 mb-2">
                            <div class="form-field">
                                <label for="">Khóa học<sup>*</sup></label>
                                <input required type="text" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 mt-0 mb-2">
                            <div class="form-field">
                                <label for="">Địa chỉ<sup>*</sup></label>
                                <input required type="text" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 mt-0 mb-2">
                            <div class="form-field">
                                <label for="">Chọn trung tâm<sup>*</sup></label>
                                <input required type="text" class="form-control" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="submit d-flex justify-content-center">
                        <button type="submit" class="custom-button button-reg">ĐĂNG KÝ NGAY</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
<?php
getFooter();
?>