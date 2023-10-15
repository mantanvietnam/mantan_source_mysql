<?php 
    global $settingThemes;
    global $modelAlbums;
    global $modelAlbuminfos;
?>
<?php getHeader();?>
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
         <!-- WARM publications -->
         <?php foreach($listData as $key => $item){
                if($key%2 == 0){
          ?>
         <section id="section-publications" data-aos="fade-up">
            <div class="title-section">
                <h1>WARM publications</h1>
                <div class="title-divide-section"></div>
            </div>

            <div style="background-image: url(<?php echo $urlThemeActive;?>/asset/img/facility-background.png)" class="publications-content-background">
                <div class="container publications-content">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-12 col-12 publications-content-left">
                            <div class="title-publications-content">
                                <h2><?php echo $item->name ?></h2>
                            </div>

                            <div class="introduce-publications-content">
                                <h3><?php echo $item->description ?></h3>
                            </div>

                            <div class="text-publications-content"><?php echo $item->content ?></div>

                            <div class="button-publications">
                                <a href="<?php echo $item->link ?>"  target="_blank">Download</a>
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-7 col-sm-12 col-12 publications-content-right">
                            <div class="publications-content-right-inner">
                                <img src="<?php echo $item->image ?>" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php   }else{ ?>
           <!-- WARM publications revese -->
        <section id="section-publications" data-aos="fade-up">
            <div class="publications-content-background publications-content-reverse">
                <div class="container publications-content">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12 publications-content-left">
                            <div class="title-publications-content">
                                <h2><?php echo $item->name ?></h2>
                            </div>

                            <div class="introduce-publications-content">
                                <h3><?php echo $item->description ?></h3>
                            </div>

                            <div class="text-publications-content"><?php echo $item->content ?></div>
                            <div class="button-publications">
                                <a href="<?php echo $item->link ?>"  target="_blank">Download</a>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-12 publications-content-right">
                            <div class="publications-content-right-inner">
                                <img src="<?php echo $item->image ?>" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php   }} ?>
        <!-- pagination -->
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
        </section>
    </main>

  <?php getFooter();?>