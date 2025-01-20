<?php
getHeader();
global $urlThemeActive;
?>
<main>
        <section class="banner-top-style-1">
            <img class="w-100" src="<?= $urlThemeActive ?>assets/lou_img/banner.png" alt="">
        </section>
        <section id="diem-den-yeu-thich" class="bg-pt">
            <div class="container">
                <div class="form-input-search">
                    <!-- <form action="">
                        <div class="d-flex align-items-center">
                            <img src="<?= $urlThemeActive ?>assets/lou_icon/icon-input-search.svg" alt="">
                            <input type="text" placeholder="Tìm kiếm" class="form-control">
                        </div>
                    </form> -->
                    
                </div>
            </div>
            <div class="container">
                <div class="head">
                    <h1 class="text-center">Điểm đến yêu thích</h1>
                    <p class="text-center">Những điểm đến yêu thích của bạn ở Cẩm Giàng</p>
                </div>
                <div class="body">
                    <div class="list-diem-den-yeu-thich">
                        <div class="row g-3">
                            <?php 
                            if(!empty($listData)){
                              foreach ($listData as $item) {
                                 $custom =  getCustomer($item->idcustomer);
                                  if($item->type=="co_quan_hanh_chinh"){
                                    $GovernanceAgency = getGovernanceAgency($item->idobject);
                                    $type= 'Cơ quan hành chính';
                                    if(!empty(@$GovernanceAgency)){
                                    ?>
                                        <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                                        <div class="card-diem-den-yeu-thich-contain">
                                            <div class="card-diem-den-yeu-thich">
                                                <div class="card">
                                                    <img src="<?php echo @$GovernanceAgency->image; ?>"
                                                        class="card-img-top w-100" alt="">
                                                    <div class="img-overlay">
                                                    </div>
                                                    <div class="card-body">
                                                        <h5 class="card-title "><a href="/<?php echo 'chi_tiet_co_quan_hanh_chinh/'.$GovernanceAgency->urlSlug.'.html' ?>"><?php echo @$GovernanceAgency->name; ?></a></h5>
                                                        <div class="d-flex align-items-center card-num-location">
                                                            <img class="me-2" src="<?= $urlThemeActive ?>assets/lou_icon/icon-card-diem-den.svg"
                                                                alt=""><?php echo @$GovernanceAgency->address; ?>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                 <?php }
                                  }elseif($item->type=="dich_vu_ho_tro_du_lich"){
                                    $Service = getService($item->idobject);
                                    $type= 'Dịch vụ hỗ trợ du lịch';
                                
                                     if(!empty(@$Service)){
                                    ?>
                                        <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                                        <div class="card-diem-den-yeu-thich-contain">
                                            <div class="card-diem-den-yeu-thich">
                                                <div class="card">
                                                    <img src="<?php echo @$Service->image ?>"
                                                        class="card-img-top w-100" alt="">
                                                    <div class="img-overlay">
                                                    </div>
                                                    <div class="card-body">
                                                        <h5 class="card-title "><a href="/<?php echo 'chi_tiet_dich_vu_ho_tro_du_lich/'.$Service->urlSlug.'.html'; ?>"><?php echo @$Service->name ?></a></h5>
                                                        <div class="d-flex align-items-center card-num-location">
                                                            <img class="me-2" src="<?= $urlThemeActive ?>assets/lou_icon/icon-card-diem-den.svg"
                                                                alt=""><?php echo @$Service->address; ?>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                 <?php }
                                  }elseif($item->type=="danh_lam"){
                                    $Place = getPlace($item->idobject);
                                    $type= 'Danh lam thắng cảnh';
                                    $address=@$Place->address;
                                     if(!empty(@$Place)){
                                    ?>
                                        <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                                        <div class="card-diem-den-yeu-thich-contain">
                                            <div class="card-diem-den-yeu-thich">
                                                <div class="card">
                                                    <img src="<?php echo @$Place->image; ?>"
                                                        class="card-img-top w-100" alt="">
                                                    <div class="img-overlay">
                                                    </div>
                                                    <div class="card-body">
                                                        <h5 class="card-title "><a href="/<?php echo 'chi_tiet_danh_lam/'.$Place->urlSlug.'.html'; ?>"><?php echo $Place->name; ?></a></h5>
                                                        <div class="d-flex align-items-center card-num-location">
                                                            <img class="me-2" src="<?= $urlThemeActive ?>assets/lou_icon/icon-card-diem-den.svg"
                                                                alt=""><?php echo $Place->address; ?>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                 <?php }
                                  }elseif($item->type=="le_hoi"){
                                    $Festival = getFestival($item->idobject);
                                
                                     if(!empty(@$Festival)){
                                    ?>
                                        <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                                        <div class="card-diem-den-yeu-thich-contain">
                                            <div class="card-diem-den-yeu-thich">
                                                <div class="card">
                                                    <img src="<?php echo @$Festival->image; ?>"
                                                        class="card-img-top w-100" alt="">
                                                    <div class="img-overlay">
                                                    </div>
                                                    <div class="card-body">
                                                        <h5 class="card-title "><a href="/<?php echo 'chi_tiet_le_hoi/'.$Festival->urlSlug.'.html'; ?>"><?php echo @$Festival->name;; ?></a></h5>
                                                        <div class="d-flex align-items-center card-num-location">
                                                            <img class="me-2" src="<?= $urlThemeActive ?>assets/lou_icon/icon-card-diem-den.svg"
                                                                alt=""><?php echo @$Festival->address; ?>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                 <?php }
                                  }elseif($item->type=="nha_hang"){
                                    $Restaurant = getRestaurant($item->idobject);
                                    $type= 'Nhà hàng';
                                    if(!empty(@$Restaurant)){
                                    ?>
                                        <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                                        <div class="card-diem-den-yeu-thich-contain">
                                            <div class="card-diem-den-yeu-thich">
                                                <div class="card">
                                                    <img src="<?php echo @$Restaurant->image ?>"
                                                        class="card-img-top w-100" alt="">
                                                    <div class="img-overlay">
                                                    </div>
                                                    <div class="card-body">
                                                        <h5 class="card-title "><a href="/<?php echo 'chi_tiet_nha_hang/'.@$Restaurant->urlSlug.'.html' ?>"><?php echo @$Restaurant->name; ?></a></h5>
                                                        <div class="d-flex align-items-center card-num-location">
                                                            <img class="me-2" src="<?= $urlThemeActive ?>assets/lou_icon/icon-card-diem-den.svg"
                                                                alt=""><?php echo $Restaurant->address; ?>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                 <?php }
                                  }elseif($item->type=="tung_tam_hoi_nghi_su_kien"){
                                    $Eventcenter = getEventcenter($item->idobject);
                                     if(!empty(@$Eventcenter)){
                                    ?>
                                        <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                                        <div class="card-diem-den-yeu-thich-contain">
                                            <div class="card-diem-den-yeu-thich">
                                                <div class="card">
                                                    <img src="<?php echo @$Eventcenter->image ?>"
                                                        class="card-img-top w-100" alt="">
                                                    <div class="img-overlay">
                                                    </div>
                                                    <div class="card-body">
                                                        <h5 class="card-title "><a href="/<?php echo 'chi_tiet_tung_tam_hoi_nghi_su_kien/'.$Eventcenter->urlSlug.'.html'; ?>"><?php echo @$Eventcenter->name; ?></a></h5>
                                                        <div class="d-flex align-items-center card-num-location">
                                                            <img class="me-2" src="<?= $urlThemeActive ?>assets/lou_icon/icon-card-diem-den.svg"
                                                                alt=""><?php echo $Eventcenter->address; ?>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                 <?php }
                                  }elseif($item->type=="lang_nghe"){
                                    $Craftvillage = getCraftvillage($item->idobject);
                                     if(!empty(@$Craftvillage)){
                                    ?>
                                        <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                                        <div class="card-diem-den-yeu-thich-contain">
                                            <div class="card-diem-den-yeu-thich">
                                                <div class="card">
                                                    <img src="<?php echo @$Craftvillage->image ?>"
                                                        class="card-img-top w-100" alt="">
                                                    <div class="img-overlay">
                                                    </div>
                                                    <div class="card-body">
                                                        <h5 class="card-title "><a href="/<?php echo 'chi_tiet_lang_nghe/'.$Craftvillage->urlSlug.'.html'; ?>"><?php echo @$Craftvillage->name; ?></a></h5>
                                                        <div class="d-flex align-items-center card-num-location">
                                                            <img class="me-2" src="<?= $urlThemeActive ?>assets/lou_icon/icon-card-diem-den.svg"
                                                                alt=""><?php echo $Craftvillage->address; ?>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                 <?php }
                                  }elseif($item->type=="dich_tich_lich_su"){
                                    $HistoricalSite = getHistoricalSite($item->idobject);
                                    $type= 'Danh lam thắng cảnh';
                                    $address=@$HistoricalSite->address;
                                     if(!empty(@$HistoricalSite)){
                                    ?>
                                        <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                                        <div class="card-diem-den-yeu-thich-contain">
                                            <div class="card-diem-den-yeu-thich">
                                                <div class="card">
                                                    <img src="<?php echo @$HistoricalSite->image; ?>"
                                                        class="card-img-top w-100" alt="">
                                                    <div class="img-overlay">
                                                    </div>
                                                    <div class="card-body">
                                                        <h5 class="card-title "><a href="/<?php echo 'chi_tiet_di_tich_lich_su/'.$HistoricalSite->urlSlug.'.html'; ?>"><?php echo $HistoricalSite->name; ?></a></h5>
                                                        <div class="d-flex align-items-center card-num-location">
                                                            <img class="me-2" src="<?= $urlThemeActive ?>assets/lou_icon/icon-card-diem-den.svg"
                                                                alt=""><?php echo $HistoricalSite->address; ?>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                 <?php }
                                  }elseif($item->type=="khach_san"){
                                    $Hotel = getHotel($item->idobject);
                                    
                                    if(!empty(@$Hotel)){
                                    ?>
                                        <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                                        <div class="card-diem-den-yeu-thich-contain">
                                            <div class="card-diem-den-yeu-thich">
                                                <div class="card">
                                                    <img src="<?php echo @$Hotel->image; ?>"
                                                        class="card-img-top w-100" alt="">
                                                    <div class="img-overlay">
                                                    </div>
                                                    <div class="card-body">
                                                        <h5 class="card-title "><a href="<?php echo 'chi_tiet_khach_san/'.$Hotel->urlSlug.'.html'; ?>"><?php echo $Hotel->name; ?></a></h5>
                                                        <div class="d-flex align-items-center card-num-location">
                                                            <img class="me-2" src="<?= $urlThemeActive ?>assets/lou_icon/icon-card-diem-den.svg"
                                                                alt=""><?php echo $Hotel->address; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                 <?php }
                                  } ?>
                            
                           <?php }} ?>
                           
                            <div class="col-12" id="pagination-page">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php
getFooter();?>