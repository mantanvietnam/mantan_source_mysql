<?php
getHeader();
global $urlThemeActive;
?>
  <main>
        <section class="banner-top-style-1">
            <img class="w-100" src="<?= $urlThemeActive ?>assets/lou_img/banner.png" alt="">
        </section>
        <section id="tour-list" class="bg-pt">
            <div class="container form-main-position">
                <div class="form-search-tour">
                    <form action="">
                        <div class="d-flex flex-column flex-md-row justify-content-between">
                            <div class="input-form-contain w-100">
                                <div class="row g-3">
                                    <div class="col-12 col-md-4">
                                        <div class="d-flex form-input">
                                            <div class="round-icon d-none d-md-block"></div>
                                            <div class="form-group w-100">
                                                <label for="">Địa điểm</label>
                                                <input type="text" class="form-control" placeholder="Địa điểm" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="d-flex form-input">
                                            <div class="round-icon d-none d-md-block"></div>
                                            <div class="form-group w-100">
                                                <label for="">Ngày</label>
                                                <input type="date" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="d-flex form-input">
                                            <div class="round-icon d-none d-md-block"></div>
                                            <div class="form-group w-100 no-border">
                                                <label for="">Thời gian</label>
                                                <input type="time" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-form-contain">
                                <button class="btn button-submit-custom">
                                    <img src="<?= $urlThemeActive ?>assets/lou_icon/icon-search-white.svg" alt="">
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="container">
                <h1 class="text-center">Tour du lịch</h1>
                <div class="tour-du-lich-list">
                    <div class="row g-3">
                    	<?php if(!empty(@$listData)){
                    	foreach($listData as $key => $value) ?>
                        <div class="col-12 col-md-6 col-lg-4">
                            <a href="/chi_tiet_tour/<?php echo $value->urlSlug ?>.html" class="text-decoration-none">
                                <div class="tour-du-lich-card">
                                    <div class="card border-0 w-100">
                                        <div class="card-top">
                                            <img src="<?php echo $value->image ?>" class="card-img-top"
                                                alt="...">
                                            <div class="card-overlay"></div>
                                            <div class="card-num-day">
                                               <?php echo $value->timetravel ?>
                                            </div>
                                        </div>
                                        <div class="card-body p-lg-4">
                                            <h5 class="card-title"><?php echo $value->name ?></h5>
                                            <p class="card-time"><?php echo date("d/m/Y", @$value->datestart).' - '. date("d/m/Y", @$value->dateend); ?></p>
                                            <div class="d-flex align-items-center card-num-location">
                                                <img class="me-2" src="<?= $urlThemeActive ?>assets/lou_icon/icon-location-white-card.svg"
                                                    alt="">
                                                <span><?php echo $value->address ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php } ?>
                        
                        <div class="col-12">
                            <section id="pagination-page">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination">
                                       <?php
							            if(@$totalPage>0){
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
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php
getFooter();?>