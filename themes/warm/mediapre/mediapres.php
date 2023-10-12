<?php 
    global $settingThemes;
    global $modelAlbums;
    global $modelAlbuminfos;
?>
<?php getHeader();
    //debug($listData);
    // debug($data);
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

        <section id="section-press-title">
            <div class="title-section">
                <h1>WARM Press releases</h1>
                <div class="title-divide-section"></div>
            </div>

            <div class="media-press-list">
                <?php foreach($listData as $key => $item){
                if($key%2 == 0){
          ?>
                <div class="media-press-item">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-12 media-press-left">
                                <div class="media-press-title">
                                    <h2><?php echo $item->name ?></h2>
                                </div>
                                <div class="media-press-description">
                                    <p><?php echo $item->description ?></p>
                                </div>

                                <div class="media-press-button">
                                    <button>PUBLISHED ON <?php echo date('d F Y', $item->time_create)?></button>

                                    <div class="button-publications">
                                        <a href="<?php echo $item->link ?>" target="_blank">Download</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-12 media-press-right">
                                <div class="media-press-image">
                                    <img src="<?php echo $item->image ?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 <?php   }else{ ?>
                <!--Media press Ngược -->
                <div class="media-press-item media-press-item-reverse">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-12 media-press-left">
                                <div class="media-press-title">
                                    <h2><?php echo $item->name ?></h2>
                                </div>
                                <div class="media-press-description">
                                    <p><?php echo $item->description ?></p>
                                </div>

                                <div class="media-press-button">
                                    <button>PUBLISHED ON <?php echo date('d F Y', $item->time_create) ?></button>

                                    <div class="button-publications">
                                        <a href="<?php echo $item->link ?> " target="_blank">Download</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-12 media-press-right">
                                <div class="media-press-image">
                                    <img src="<?php echo $item->image ?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php   }} ?>
               
            </div>
        </section>
<!-- 
        <section id="section-pagination">
            <div class="demo-inline-spacing">
              <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                  <?php
                    if($totalPage>0){
                        if ($page > 5) {
                            $startPage = $page - 5;
                        } else {
                            $startPage = 1;
                        }

                        if ($totalPage > $page + 5) {
                            $endPage = $page + 5;
                        } else {
                            $endPage = $totalPage;
                        }
                        
                        echo '<li class="page-item first">
                                <a class="page-link" href="'.$urlPage.'1"
                                  ><i class="tf-icon bx bx-chevrons-left"></i
                                ></a>
                              </li>';
                        
                        for ($i = $startPage; $i <= $endPage; $i++) {
                            $active= ($page==$i)?'active':'';

                            echo '<li class="page-item '.$active.'">
                                    <a class="page-link" href="'.$urlPage.$i.'">'.$i.'</a>
                                  </li>';
                        }

                        echo '<li class="page-item last">
                                <a class="page-link" href="'.$urlPage.$totalPage.'"
                                  ><i class="tf-icon bx bx-chevrons-right"></i
                                ></a>
                              </li>';
                    }
                  ?>
                </ul>
              </nav>
            </div>
        </section> -->
    </main>
<?php getFooter();?>