<?php 
    getheader();
    global $settingThemes;
?>
<main>
    
        
        <section class="section-card-albums">
            <div class="container">
                <div class="row">
                <?php foreach ($listAlbums as $key => $value) { ?> 
                  
                    <div class="col-md-6 col-lg-4 col-lg-4 col-12 card-albums-all-information">
                        <div class="image-albums-card">
                            <a href=""><img src="<?php echo $value->image; ?>" alt=""></a>
                        </div>
                        <div class="information-card-albums">
                            <div class="main-information-card-albums">
                                <a class="h2-title-above-slide" href="/<?= $value->slug?>.html"><?php echo $value->title; ?></a>
                                <p class="paragrap-titleabove-slide"><?php echo $value->description; ?></p>

                            </div>
                        </div>
                    </div>
                    <?php } ?>

                </div>
                <?php 
                echo $totalPage;
                
                ?>
            </div>

        </section>

</main>
<?php 
    getFooter();
?>
