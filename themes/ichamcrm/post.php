<?php
	global $urlThemeActive; 
	getHeader(); 
?>
<main>

        <section id="section-post-detail">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="post-content">
                            <div class="post-breadcrumbs">
                                <p>
                                    <a href="/">Trang chủ</a> <i class="fa-solid fa-caret-right"></i> 
                                    
                                    <?php 
                                        if(!empty($category)){
                                            echo '<a href="/'.$category->slug.'.html">'.$category->name.'</a> <i class="fa-solid fa-caret-right"></i> ';
                                        }
                                    ?>
                                    
                                    <?php echo @$post->title; ?>
                                </p>
                            </div>

                            <div class="post-title">
                                <h1><?php echo @$post->title; ?></h1>
                                <p><i class="fa-regular fa-calendar-days"></i> <?php echo date('d/m/Y', $post->time);?></p>
                            </div>

                            <div class="post-content-detail">
                                <?php echo @$post->content; ?>
                            </div>
                        </div>

                        <div class="other-post">
                            <div class="other-post-title">
                                <h2>
                                    Bài viết liên quan
                                </h2>
                            </div>
                            <div class="list-other-post">
                                <div class="row">
                                    <?php 
                                            if(!empty($otherPosts)){
                                                foreach ($otherPosts as $key => $value) {
                                                    $link = '/'.$value->slug.'.html';

                                                    echo '<div class="col-lg-4 col-md-4 col-sm-12">
                                                            <div class="item-other-post">
                                                                <div class="item-other-post-img">
                                                                    <a href="'.$link.'" tabindex="0"><img src="'.$value->image.'" alt=""></a>
                                                                </div>

                                                                <div class="item-other-post-date">
                                                                    <p>
                                                                        <i class="fa-regular fa-calendar-days aria-hidden="true"></i> <span class="date">'.date('d/m/Y', $value->time).'</span>
                                                                    </p>
                                                                </div>

                                                                <div class="item-other-post-name">
                                                                    <h3 class="item-other-post-title">
                                                                        <a href="'.$link.'">'.$value->title.'</a>
                                                                    </h3>
                                                                </div>

                                                                <div class="post-text">
                                                                    <p>'.$value->description.'</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        ';
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
<?php getFooter(); ?>