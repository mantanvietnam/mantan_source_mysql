<?php
getHeader();
global $urlThemeActive;

?>

    <main>
        <section id="section-post" class="section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-12">
                        <div class="post-title">
                            <h1><?php echo $post->title; ?>!</h1>
                        </div>

                        <div class="post-date">
                            <i class="fa-regular fa-clock"></i>&nbsp Đăng lúc: <span><?php echo date('d/m/Y',$post->time); ?></span>
                        </div>

                        <div class="post-image">
                            <img src="<?php echo $post->image; ?>" alt="">
                        </div>

                        <div class="post-content">
                            <?php echo $post->content; ?>
                        </div>

                        <div id="section-blog-other" class="section-padding">
                            <div class="section-blog-other-inner">
                                <h2 class="section-title" data-aos="zoom-in">
                                    <span> Các bài viết khác</span>
                                    <div class="title-divide-section"></div>
                                </h2>
                
                                <div class="blog-list" data-aos="zoom-out-right">
                                     <?php
                                            if(!empty($otherPosts)){
                                                foreach ($otherPosts as $item) {
                             echo '<div class="blog-item">
                                        <div class="blog-img">
                                             <a href="/'.@$item->slug.'.html"><img src="'.@$item->image.'" alt=""></a>
                                        </div>
                
                                        <div class="blog-detail">
                                            <div class="blog-title">
                                                <a href="/'.@$item->slug.'.html">
                                                    <h4>'.@$item->title.'</h4>
                                                </a>
                                            </div>
                
                                            <div class="blog-meta">
                                                <i class="fa-regular fa-clock"></i> <span>'.date('d/m/Y',$item->time).'</span>
                                            </div>
                
                                            <div class="blog-devide">
                                                <hr class="solid">
                                            </div>
                
                
                                            <div class="blog-description">
                                                <p>'.@$item->description.'</p>
                                            </div>
                                        </div>
                                    </div>';
                                     } } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- sidebar -->
                    <div class="col-lg-3 sidebar">
                        <div class="page-blog-sidebar">
                            <div class="sidebar-heading">
                                <div class="sidebar-title">
                                    <span>Bài viết nổi bật</span>
                                </div>
                            </div>

                            <div class="sidebar-listpost">
                                
                                <?php  if(!empty(getPostPin())){
                                    foreach(getPostPin() as $key => $item){
                                        echo '<div class="sidebar-post-item">
                                    <div class="row">
                                        <div class="col-5 col-post-image">
                                            <div class="sidebar-post-image">
                                                <img src="'.@$item->image.'" alt="">
                                            </div>
                                        </div>

                                        <div class="col-7 col-post-title">
                                            <div class="sidebar-post-title">
                                                <a href="/'.@$item->slug.'.html">'.@$item->title.'</a>  
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                                    }
                                } ?>                         
                            </div>
                        </div>

                        <div class="category-product-sidebar">
                            <div class="sidebar-heading">
                                <div class="sidebar-title">
                                    <span>Chuyên mục sản phẩm</span>
                                </div>
                            </div>

                            <div class="sidebar-listcate">
                                <ul>
                                     <?php $category = getCategorieProduct();
                                        if(!empty($category)){
                                            foreach($category as $key => $item){
                                                echo '<li><a href="/category/'.$item->slug.'.html">'.$item->name.'</a></li>';
                                            }
                                        }
                                     ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

      
    </main>

<?php
getFooter();?>