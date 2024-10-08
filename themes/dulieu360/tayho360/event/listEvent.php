<?php
getHeader();
global $urlThemeActive;
?>
 <main class="">
        <section id="su-kien-banner">
            <div class="backgound-slider-contain">
                <div class="su-kien-slider">
                    <?php 
                        if(!empty($listData)){
                        foreach($listData as $item){ ?>
                    <div class="">
                        <img src="<?php echo $item->image ?>" class="w-100" alt="">
                    </div>
                     <?php }} ?>
                    
                </div>
                <div class="banner-content-overlay p-5">
                    <div class="content p-4">
                        <h1>samsung xây trung tâm r&d
                            220 triệu usd tại khu tây hồ tây</h1>
                        <p>
                            Samsung Việt Nam vừa chính thức công bố về việc bắt đầu xây dựng trung tâm nghiên cứu và
                            phát triển mới (R&D) với quy mô lớn nhất khu vực Đông Nam Á tại khu đô thị Tây Hồ Tây, Hà
                            Nội.
                            <br>
                            Samsung cho biết việc xây dựng trung tâm R&D đã được triển khai nhanh chóng sau 2 cuộc họp
                            quan trọng giữa Thủ tướng Nguyễn Xuân Phúc và Phó chủ tịch Tập đoàn Samsung Lee Jae-yong vào
                            năm 2018 tại Hà Nội và năm 2019 tại Seoul...
                        </p>
                        <a href="" class="btn button-outline-primary-custom">Xem thêm</a>
                    </div>
                </div>
            </div>
        </section>
        <section id="su-kien-list-event">
            <div class="background" style="background-image: url('../assets/lou_img/su-kien-list-event.png')">
                <section class="section-heading mt-4">
                    <h3 class="text-uppercase text-center">sự kiện</h3>
                    <p class="text-center">Những sự kiện diễn ra ở Tây Hồ</p>
                </section>
                <div class="container">
                    <div class="row g-3">
                    	<?php 
                    	if(!empty($listData)){
                    	foreach($listData as $item){ ?>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="card card-event">
                                <img class="card-img-top" src="<?php echo $item->image ?>" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">
                                       <?php echo $item->name ?>
                                    </h5>
                                    <p class="card-time">
                                        <?php echo date("d/m/Y", @$item->datestart).' - '. date("d/m/Y", @$item->dateend); ?>
                                    </p>
                                    <a href="/chi_tiet_su_kien/<?php echo $item->urlSlug ?>.html" class="btn button-outline-primary-custom">Xem thêm</a>
                                </div>
                            </div>
                        </div>
                        <?php }} ?>
                    </div>
                    
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
        </section>
    </main>

<?php
getFooter();?>