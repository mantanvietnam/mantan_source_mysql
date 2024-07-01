<?php 
    getheader();

?>
<main>
        <section id="news-details-section">
            <div class="container">
                <div class="news-title">
                    <h1><?php echo $post->title;?></h1>
                </div>
                <div class="news-main">
                    <div class="row">
                        <div class="col-lg-7">

                            <div class="news-left-site">
                                <div class="news-date">
                                    <p><a href="">Trang chủ</a>/<a href="">Tin tức</a>/ <?php echo $post->title;?></p>
                                    <span><i class="fa-solid fa-calendar-days"></i> <?php echo date('d/m/Y', $post->time);?></span>
                                </div>
                                <div class="news-detail">
                                    <h4><?php echo $post->description;?></h4>
                                    <p><?php echo $post->content;?>
                                    </p>
                                </div>
                            </div>

                        </div>
     
                        <div class="col-lg-4">
                            <div><h2 class="title-news-other">Tin tức khác</h2></div>
                            <div class="news-right-site">
                        <?php if (!empty($otherPosts)): ?>
                            <?php foreach ($otherPosts as $key => $value): ?>
                                <div class="news-right-site-img">
                                    <a href="<?php echo @$value->slug ?>.html">
                                        <div class="right-site-img">
                                            <img src="<?php echo $value->image;?>" />
                                        </div>
                                        <div class="right-site-name-img">
                                            <p>
                                            <?php echo $value->title;?>
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

    </main>
<?php 
    getFooter();
?>