<?php
 getHeader();
if (!isset($post)) $post = [];
if (!isset($otherPosts)) $otherPosts = [];
 ?>
<main>
        <section id="section-breadcrumb">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                      <li class="breadcrumb-item active" aria-current="page"><?php echo $post->title;?></li>
                    </ol>
                </nav>
            </div>
        </section>

        <section id="section-news">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-12 col-12 detailNews-left">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-12 detailNews-content-box">
                                <div class="detailNews-heading">
                                    <div class="detailNews-title">
                                        <h1><?php echo $post->title;?></h1>
                                    </div>
                                    <div class="detailNews-meta">
                                         <?php 
                                        if(!empty($post->author)){
                                            echo '<span class="author">Tác giả: '.$post->author.'</span>';
                                        }
                                        ?>
                                        <span class="date"><?php echo date('d/m/Y', $post->time);?></span>
                                    </div>
                                </div>

                                <div class="detailNews-content">
                                    <div class="detailNews-featured-img">
                                        <img src="../asset/img/background-anime-dep-ruc-ruc-ro.jpg" alt="">
                                    </div>

                                    <div class="detailNews-word">
                                        <?php echo $post->content;?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-12 post-related">
                                <div class="post-related-box">
                                    <div class="post-related-heading">
                                        <span>Bài viết liên quan</span>
                                    </div>
                                </div>

                                <div class="post-related-slide">
                                    <?php 
                                    if(!empty($otherPosts)){
                                        foreach ($otherPosts as $key => $value) {
                                            $link = '/'.$value->slug.'.html';

                                            echo '<div class="post-item">
                                                    <div class="post-box">
                                                        <div class="post-box-img">
                                                            <a href="'.$link.'"><img src="'.$value->image.'" alt=""></a>
                                                        </div>
                    
                                                        <div class="post-box-detail">
                                                            <h3 class="post-title">
                                                                <a href="'.$link.'">'.$value->title.'</a>
                                                            </h3>
                                                            <div class="post-entry">
                                                                <p>'.$value->description.'</p>
                                                            </div>
                                                            <div class="post-meta">
                                                                <span class="date">'.date('d/m/Y', $value->time).'</span>
                                                            </div>
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

                    <div class="col-lg-3 col-md-12 col-12 news-right"> 
                        <div class="box-post-info">
                            <div class="accordion">
                                <!-- Bài viết mới -->
                                <div class="accordion-item accordion-post-new">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapsePostNew" aria-expanded="true" aria-controls="panelsStayOpen-collapsePostNew">
                                            Bài viết mới nhất
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapsePostNew" class="accordion-collapse collapse show">
                                        <div class="accordion-body">
                                            <div class="post-new">
                                                <div class="post-new-item">
                                                    <div class="post-new-img">
                                                        <img src="../asset/img/background-anime-dep-ruc-ruc-ro.jpg" alt="">
                                                    </div>
                                                    <div class="post-new-detail">
                                                        <h3 class="post-new-title">
                                                            <a href="">Nước tăng lực không có Caffeine?</a>
                                                        </h3>
                                                        <div class="post-new-meta">
                                                            <span class="post-new-cate">Tin tức</span>
                                                            <span class="post-new-date">- 14.02.2023</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="post-new">
                                                <div class="post-new-item">
                                                    <div class="post-new-img">
                                                        <img src="../asset/img/background-anime-dep-ruc-ruc-ro.jpg" alt="">
                                                    </div>
                                                    <div class="post-new-detail">
                                                        <h3 class="post-new-title">
                                                            <a href="">Nước tăng lực không có Caffeine?</a>
                                                        </h3>
                                                        <div class="post-new-meta">
                                                            <span class="post-new-cate">Tin tức</span>
                                                            <span class="post-new-date">- 14.02.2023</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="post-new">
                                                <div class="post-new-item">
                                                    <div class="post-new-img">
                                                        <img src="../asset/img/background-anime-dep-ruc-ruc-ro.jpg" alt="">
                                                    </div>
                                                    <div class="post-new-detail">
                                                        <h3 class="post-new-title">
                                                            <a href="">Nước tăng lực không có Caffeine?</a>
                                                        </h3>
                                                        <div class="post-new-meta">
                                                            <span class="post-new-cate">Tin tức</span>
                                                            <span class="post-new-date">- 14.02.2023</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="post-new">
                                                <div class="post-new-item">
                                                    <div class="post-new-img">
                                                        <img src="../asset/img/background-anime-dep-ruc-ruc-ro.jpg" alt="">
                                                    </div>
                                                    <div class="post-new-detail">
                                                        <h3 class="post-new-title">
                                                            <a href="">Nước tăng lực không có Caffeine?</a>
                                                        </h3>
                                                        <div class="post-new-meta">
                                                            <span class="post-new-cate">Tin tức</span>
                                                            <span class="post-new-date">- 14.02.2023</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Danh mục bài viết -->
                                <div class="accordion-item accordion-post-cate">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapsePostCate" aria-expanded="true" aria-controls="panelsStayOpen-collapsePostCate">
                                            Danh mục bài viết
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapsePostCate" class="accordion-collapse collapse show">
                                        <div class="accordion-body">
                                            <!-- Danh mục menu -->
                                            <div class="menu-cat">
                                                <ul class="menu-cat-list">                                                    <li class="menu-cat-lv0">
                                                        <a href="">Khuyến mãi</a>
                                                    </li>

                                                    <li class="menu-cat-lv0">
                                                        <a href="">Hướng dẫn sử dụng</a>
                                                    </li>

        
                                                </ul>
                                            </div>

                                            <!--  -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>     
        </section>
    </main>
<?php getFooter();?>