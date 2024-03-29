<?php
getHeader();
global $urlThemeActive;
$setting = setting();
?>
    <style>
        header{
            position: relative;
            background-color: #000
        }
    </style>

    <main>
        <section id="section-blog-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 blog-left">
                        <div class="blog-title">
                            <h2><?php echo $post->title; ?></h2>
                        </div>

                        <div class="blog-meta">
                            Posted on <span><?php echo date('d/m/Y',$post->time); ?></span> by  <span>admin</span>
                        </div>
                        
                        <div class="blog-detail">
                            <?php echo $post->content; ?>
                        </div>
                    </div>

                    <div class="col-lg-4 sidebar">
                        <img src="<?php echo $post->image; ?>" alt="">
                    </div>
                </div>
            </div>
        </section>

        <section id="section-other">
            <div class="container">
                <div class="other-title text-center" data-aos="zoom-in-up">
                    <h2 style="">Bài viết khác</h2>
                </div>

                <div class="blog-list" data-aos="zoom-out">
                    <div class="row">
                        <?php if(!empty($otherPosts)){
                            foreach($otherPosts as $item){
                                echo '<div class="col-lg-3">
                            <div class="blog-item">
                                <a href="'.@$item->slug.'.html">
                                    <div class="blog-img">
                                        <img src="'.@$item->image.'" alt="">
                                    </div>
                                    
                                    <div class="blog-text">
                                        <div class="blog-title">
                                            <p>'.@$item->title.'</p>
                                        </div>
    
                                        <div class="blog-description">
                                            <p>'.@$item->description.'</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>';
                            }
                        } ?>
                   
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php
getFooter();
?>
  