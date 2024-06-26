
<?php getheader();?>

<?php 

if ($album->has('listImages')) {
    $listImages = $album->get('listImages');
} 
else {
    return false;
}


?>
    <main>
        <section class="section-detail-albums">
            <div class="container">
                <div class="title-detail-albums">
                    <h1>Album Template</h1>
                </div>
                <div class="row justify-content-between">
                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="list-slide-detail-albums">
                        <?php foreach ($listImages as $image=>$value) { ?>
                            <div class="card-slide-detail-albums">
                                <img src="<?php echo $value->image?>" alt="">
                            </div>
                        <?php } ?>
                        </div>
                    </div>
                    <div class=" col-xl-5 col-lg-12 col-md-12 col-sm-12 col-12 right-detail-albums">
                        <div class="describe-detail-albums">
                            <h2><?= $album->description?></h2>
                           
                        </div>
                        <div class="Categories-albums">
                            <h2>Categories: <span><?php echo date('d/m/Y', $value->time_create);?></span></h2>
                            <h2>Tags: <span><?= $album->title?></span></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container" style="margin-top: 130px;">
                <div class="title-list-detail">
                    <h2>IMAGE:</h2>
                </div>
                <div class="row">
                <?php foreach ($listImages as $image=>$value) { ?>
                    <div class="col-md-3 col-sm-3 list-image-albums">
                        <div class="img-detail">
                            <a href="<?php echo $value->image?>" data-fancybox="gallery" data-caption="Caption">
                                <img src="<?php echo $value->image?>" alt="">
                            </a>
                        </div>
                    </div>
                <?php } ?>
                </div>
            </div>
        </section>
    </main>
<?php 
    getFooter();
?>