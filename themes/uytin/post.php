<?php getHeader(); ?>

<section class="view-category">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="path-category">
                    <p class="path-text">
                        <a href="index.php">
                            <i>Trang chủ</i>
                        </a> 
                        / 
                        <a href="<?php echo $category->slug;?>.html">
                            <i><?php echo $category->name;?></i>
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 reviewLg__cont">
                <h1 style="margin-top: 0 !important;"><?php echo $post->title; ?></h1>
                <?php echo $post->content; ?>
            </div>
        </div>
    </div>
</section>

<?php   getFooter(); ?>