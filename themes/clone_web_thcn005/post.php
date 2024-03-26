<?php getHeader();?>
       
<section id="blog">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-3 mb-3">
                <h1><?php echo $post->title;?></h1>
            </div>
            <div class="col-md-12">
                <?php echo $post->content;?>
            </div>
        </div>
    </div>
</section>

<?php getFooter();?>