<?php
    getHeader();
    global $urlThemeActive;
?>
<main>
    <section class="head-component">
        <div class="container">
            <h1><?php echo $category['name']; ?></h1>

            <div class="row post-list">
                <?php 
                    if(!empty($listPosts)){
                        foreach ($listPosts as $key => $value) {
                            $link = '/'.$value->slug.'.html';

                            echo '<div class="post-item col-lg-4 col-md-6 col-12">
                                    <div class="post-box">
                                        <div class="post-box-img">
                                            <a href="'.$link.'"><img src="'.$value->image.'" alt=""></a>
                                        </div>

                                        <div class="post-box-detail">
                                            <h3 class="post-title">
                                                <a href="'.$link.'">'.$value->title.'</a>
                                            </h3>
                                            <div class="post-entry">
                                                <p>'.$value->content.'</p>
                                            </div>
                                            <div class="post-meta">
                                                <span class="post-author">'.date('d/m/Y', $value->time).'</span>
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