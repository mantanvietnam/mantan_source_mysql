
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
                    <h1>Chi tiết ALbum</h1>
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
                    <div class=" col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 right-detail-albums">
                        <div class="Categories-albums">
                            <h2 style="display: none;" >Ngày: <span><?php echo date('d/m/Y', $album->time_create);?></span></h2>
                            <h2>Tên Albums: <span><?= $album->title?></span></h2>
                        </div>
                        <div class="describe-detail-albums">
                            <h2><?= $album->description?></h2>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="container" style="">
                <div class="title-list-detail">
                    <h2>Danh sách hình ảnh</h2>
                </div>
                <div class="row">
                <?php foreach ($listImages as $image=>$value) { ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 list-image-albums">
                        <div class="img-detail">
                            <a href="<?php echo $value->image?>" data-fancybox="gallery">
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