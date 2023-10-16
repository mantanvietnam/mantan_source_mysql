<?php 
    global $settingThemes;
    global $modelAlbums;
    global $modelAlbuminfos;
?>
<?php getHeader();
?>

<main>
        <section id="section-home-banner" class="section-logo-header">
            <div class="home-banner">
                <div class="logo-banner-box">
                    <div class="container">
                        <div class="logo-warm">
                            <img src="<?php echo $urlThemeActive;?>/asset/img/WARM-horz-EN-_1_.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-opportunities">
            <div class="container">
                <div class="title-section">
                    <h1>Opportunities</h1>
                    <div class="title-divide-section"></div>
                </div>
    
                <div class="title-sub-section">
                    <h2>Terms of reference/ Call for biddings</h2>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <?php if(!empty($listData)){
                        foreach($listData as $key => $item){
                     ?>

                     <div class="col-lg-4 col-md-4 col-sm-6 col-12 opportunity-box">
                        <div class="opportunity-box-inner">
                            <div class="opportunity-text">
                                <div class="opportunity-date">
                                    <p><?php echo date('d/m/Y', $item->time_create); ?></p>
                                </div>
    
                                <div class="opportunity-title">
                                    <p>Request for Quotations: </p>
                                </div>
    
    
                                <div class="opportunity-title-sub">
                                    <p><?php echo $item->name; ?></p>
                                </div>
    
                                <div class="opportunity-content">
                                    <p>Description: </p>
                                </div>
    
                                <div class="opportunity-content-sub">
                                    <p><?php echo $item->description; ?></p>
                                </div>
                            </div>

                            <div class="opportunity-button">
                                <a href="<?php echo $item->link; ?>" target="_blank"><img src="<?php echo $urlThemeActive;?>/asset/img/down-arrow_2989995.svg" alt=""></a>
                            </div>
                        </div>
                    </div> 
                <?php }} ?>
                    
                </div>

                <div class="button-loadmore">
                    <button id="loadMoreBtn">Load more</button>
                </div>
            </div>
        </section>
    </main>

<?php getFooter();?>