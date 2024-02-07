<?php getHeader();?>
    <main>
        <section id="section-breadcrumb">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                      <li class="breadcrumb-item active" aria-current="page"><?php echo @$category->name;?></li>
                    </ol>
                </nav>
            </div>
        </section>

        <section id="section-news">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12 detailNews-left">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-12 detailNews-content-box">
                                <div class="detailNews-heading">
                                    <div class="detailNews-title">
                                        <h1 class="mb-3"><?php echo $post->title;?></h1>
                                    </div>
                                    <div class="detailNews-meta">
                                        <span class="author"><?php echo date('d/m/Y', $post->time);?></span> 
                                        <span class="date"><?php echo number_format($post->views);?> view</span> 
                                        <?php 
                                        if(!empty($post->author)){
                                            echo '<span class="date">Tác giả: '.$post->author.'</span>';
                                        }
                                        ?>
                                    </div>
                                </div>

                                <div class="detailNews-content">
                                    <div class="detailNews-word"><?php echo $post->content;?></div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-12 post-related">
                                <div class="post-related-box">
                                    <div class="post-related-heading">
                                        <span>Bài viết liên quan</span>
                                    </div>
                                </div>

                                <div class="post-related-slide row">
                                    <?php 
                                    if(!empty($otherPosts)){
                                        foreach ($otherPosts as $key => $value) {
                                            $link = '/'.$value->slug.'.html';

                                            echo '<div class="post-item col-md-4">
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
                </div>
            </div>     
        </section>
    </main>

<?php getFooter();?>