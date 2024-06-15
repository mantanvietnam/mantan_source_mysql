<?php
    getHeader();
    global $urlThemeActive;
?>
<main>
    <section class="head-component">
        <div class="container">
            <h1><?php echo $category['name']; ?></h1>
        </div>
    </section>

    <section class="news-post">
        <div class="container">
            <div class="row g-4">
                <?php 
                    if(!empty($listPosts)){
                        foreach ($listPosts as $key => $value) {
                            $link = '/'.$value->slug.'.html';

                            echo '<div class="col-12 col-md-6 mt-0">
                                    <section class="post-box">
                                        <div class="card-news">
                                            <div class="card">
                                                <div class="head-card">
                                                    <img src="'.$value->image.'" class="card-img-top" alt="...">
                                                    <div class="overlay">
                                                        <span>'.date('d/m/Y', $value->time).'</span>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <h5 class="">
                                                        <a href="'.$link.'">'.$value->title.'</a>
                                                    </h5>
                                                    <p class="">'.$value->content.'</p>
                                                </div>
                                            </div>
                                        </div>
                                    </section>

                                    <div class="post-card card d-block d-lg-none">
                                        <div class="d-flex">
                                            <div class="card-img-custom">
                                                <img src="'.$value->image.'" alt="">
                                            </div>

                                            <div class="card-content-custom">
                                                <div class="content-contain">
                                                    <h5>
                                                        <a href="'.$link.'">'.$value->title.'</a>
                                                    </h5>
                                                    <p>'.$value->content.'</p>
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <span>'.date('d/m/Y', $value->time).'</span>
                                                        <a href="">
                                                            <button>
                                                                <img src="'.$value->image.'" alt="">
                                                            </button>
                                                        </a>
                                                    </div
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
                        <div class="col-12 col-lg-12 mt-0 mb-2 justify-content-center">
                            <div class="form-field">
                                <label for="">Họ và tên <sup>*</sup></label>
                                <input required type="text" name="name" class="form-control" placeholder="">
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

<?php getFooter(); ?>