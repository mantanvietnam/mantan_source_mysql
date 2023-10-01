<?php getHeader();?>
    <article>
        <div class="container setting-news-detail">
            <div class="row">
                <div class="col-9">
                    <form class="d-flex form-search search-mobile">
                        <input class="form-control me-2" type="search" placeholder="Tìm kiếm..." aria-label="Search">
                        <button class="btn btn-outline-success" pac type="submit">Search</button>
                    </form>
                    <nav class="breadcrumb-news-detail" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item color-post"><a href="#">Tin tức</a></li>
                          <li class="breadcrumb-item color-post active" aria-current="page"><a href="#"><?php echo @$category->name;?></a></li>
                          <li class="breadcrumb-item post-now" aria-current="page"><a href="#"></a></li>

                        </ol>
                    </nav>
                    <div class="titel-news-detail">
                        <h1 class="text-title"> <?php echo $post->title; ?></h1>
                        <div class="time-news-detail">
                            <p>Đăng bởi: <span><?php echo $post->author; ?></span>  <span><?php echo date('d/m/Y', $post->time); ?></span> - <span><?php echo $post->view; ?></span> lượt xem</p>
                        </div>                        
                    </div>
                    <div class="intro-news-detail">
                        <?php echo $post->content; ?>
                    </div>
                    <div class="related-news">
                        <h4>Bài viết liên quan</h4>
                        <?php 
                            if(!empty($otherPosts)){
                                foreach($otherPosts as $key => $value){
                                    echo '<a href="'.$value->slug.'.html"><p>'.$value->title.'</p></a>';
                                }
                            }

                        ?>

                    </div>
                </div>
                <?php getSidebar();?>

            </div>
        </div>
    </article>   
<?php getFooter();?>