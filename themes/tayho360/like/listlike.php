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
                    <p class="text-center">Những điểm đến yêu thích của bạn ở Tây Hồ</p>
                </div>
                <div class="body">
                    <div class="list-diem-den-yeu-thich">
                        <div class="row g-3">
                            <?php 
				            if(!empty($listData)){
				              foreach ($listData as $item) {
				                 $custom =  getCustomer($item->idcustomer);
				                  if($item->tiype=="co_quan_hanh_chinh"){
				                    $title = getGovernanceAgency($item->idobject);
				                    $type= 'Cơ quan hành chính';
				                    $url= 'chi_tiet_co_quan_hanh_chinh/'.$title->urlSlug.'.html';
				                    $name = $title->name;
				                    $address=@$title->address;
				                    $image=@$title->image;

				                  }elseif($item->tiype=="dich_vu_ho_tro_du_lich"){
				                    $title = getService($item->idobject);
				                    $type= 'Dịch vụ hỗ trợ du lịch';
				                    $url= 'chi_tiet_dich_vu_ho_tro_du_lich/'.$title->urlSlug.'.html';
				                    $name = $title->name;
				                    $address=@$title->address;
				                    $image=@$title->image;
				                  }elseif($item->tiype=="danh_lam"){
				                    $title = getPlace($item->idobject);
				                    $type= 'Danh lam thắng cảnh';
				                    $url= 'chi_tiet_danh_lam/'.$title->urlSlug.'.html';
				                    $name = $title->name;
				                    $address=@$title->address;
				                    $image=@$title->image;
				                  }elseif($item->tiype=="le_hoi"){
				                    $title = getFestival($item->idobject);
				                    $type= 'Lễ hội';
				                    $url= 'chi_tiet_le_hoi/'.$title->urlSlug.'.html';
				                    $name = $title->name;
				                    $address=@$title->address;
				                    $image=@$title->image;
				                  }elseif($item->tiype=="nha_hang"){
				                    $title = getRestaurant($item->idobject);
				                    $type= 'Nhà hàng';
				                    $url= 'chi_tiet_nha_hang/'.$title->urlSlug.'.html';
				                    $name = $title->name;
				                    $address=@$title->address;
				                    $image=@$title->image;
				                  }elseif($item->tiype=="tung_tam_hoi_nghi_su_kien"){
				                    $title = getEventcenter($item->idobject);
				                    $type= 'Nhà hàng';
				                    $url= 'chi_tiet_tung_tam_hoi_nghi_su_kien/'.$title->urlSlug.'.html';
				                    $name = $title->name;
				                    $address=@$title->address;
				                    $image=@$title->image;
				                  }elseif($item->tiype=="lang_nghe"){
				                    $title = getCraftvillage($item->idobject);
				                    $type= 'Làng nghề';
				                    $url= 'chi_tiet_lang_nghe/'.$title->urlSlug.'.html';
				                    $name = $title->name;
				                    $address=@$title->address;
				                    $image=@$title->image;
				                  }elseif($item->tiype=="khach_san"){
				                    $title = getHotel($item->idobject);
				                    $type= 'Khách sạn';
				                    $url= 'chi_tiet_khach_san/'.$title['data']['Hotel']['slug'].'.html';
				                    $name = $title['data']['Hotel']['name'];
				                    $address=@$title['data']['Hotel']['address'];
				                   $image=@$title['data']['Hotel']['image'][0];
				                  } ?>
                            <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                                <div class="card-diem-den-yeu-thich-contain">
                                    <div class="card-diem-den-yeu-thich">
                                        <div class="card">
                                            <img src="<?php echo @$image ?>"
                                                class="card-img-top w-100" alt="">
                                            <div class="img-overlay">
                                            </div>
                                            <img class="heart" src="<?= $urlThemeActive ?>assets/lou_icon/icon-heart-white.svg" alt="">
                                            <div class="card-body">
                                                <h5 class="card-title "><a href="<?php echo @$url; ?>"><?php echo @$name; ?></a></h5>
                                                <div class="d-flex align-items-center card-num-location">
                                                    <img class="me-2" src="<?= $urlThemeActive ?>assets/lou_icon/icon-card-diem-den.svg"
                                                        alt="">
                                                    <span><?php echo @$address; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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