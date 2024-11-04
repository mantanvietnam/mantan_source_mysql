<?php 
    getHeader();
    global $settingThemes;

?>
    <main>
        <div class="register">
            <div class="container d-flex align-items-center">
                <div class="back d-flex">
                    <p>Sự kiện của tôi</p>
                </div>
            </div>
        </div>

        <section class="p-3 created__my-event">
           <!-- Nav Tabs -->
            <ul class="nav nav-tabs mb-5">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#all-events">Sự kiện tham gia</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#joined-events">Sự kiện đã tạo</a>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content container">
                <!-- Tất cả sự kiện -->
                <div class="tab-pane fade show active" id="all-events">
                    <div class="row">
                        <div class="event pt-5 ">
                            <div class="container">
                                <div class="row">
                                    <div class="news">
                                      <div class="row">
                                      <?php if(!empty($listdataattendedevent)) :?>
                                        <?php foreach($listdataattendedevent as $data):?>
                                            <div class="col-lg-4">
                                                <div class="card-news">
                                                <?php 

                                                    $event = $eventMap[$data->id_events] ?? null; 
                                                    ?>
                                                    <img src="<?= $event ? $event->banner : 'default-banner.jpg' ?>" alt="">
                                                    <div class="text top-text">
                                                        <a class="name" href="/detailevent/<?php echo @$event->slug ?>.html">Khởi nghiệp</a>
                                                        <a class="logo" href="/detailevent/<?php echo @$event->slug ?>.html"><i class="fas fa-arrow-right"></i></a>
                                                    </div>
                                                    <div class="text under-text">
                                                        <p class="date-time">Chủ nhật, ngày 28 tháng 8 năm 2024</p>
                                                        <h4><?=$data->name?></h4>
                                                        <p class="date-time"><?=$data->city?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach;?>
                                      <?php endif;?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if(!empty($listDataevent)):?>
                        <div class="container my-4 d-flex justify-content-center">
                            <nav aria-label="Page navigation">
                            <?php
                              if ($totalPage > 0) {
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
                              ?>
                              <ul class="pagination takeall">
                                <li class="page-item disabled">
                                  <a class="page-link" href="<?php echo $urlPage; ?>1" aria-label="Previous">
                                    <span aria-hidden="true">&lsaquo;</span>
                                  </a>
                                </li>
                                <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
                                <li class="page-item<?php echo ($page == $i) ? 'active' : ''; ?>" aria-current="page">
                                  <a class="page-link" href="<?php echo $urlPage . $i; ?>"><?php echo $i; ?></a>
                                </li>
                                <?php endfor; ?>
                                <li class="page-item">
                                  <a class="page-link" href="<?php echo $urlPage . $totalPage; ?>" aria-label="Next">
                                    <span aria-hidden="true">&rsaquo;</span>
                                  </a>
                                </li>
                              </ul>
                        <?php
                        }
                        ?>
                            </nav>
                        </div>
                        <?php endif;?>

                    </div>
                </div>

                <!-- Đã tham gia -->
                <div class="tab-pane fade" id="joined-events">
                    <div class="row">

                        <!-- Card 1 -->
                    <?php if(!empty($listDataevent)):?>
                      <?php foreach ($listDataevent as $event):?>
                        <div class="col-lg-4 mb-4">
                          <div class="card card-custom">
                            <div class="card-body">
                              <h5 class="card-title"><?=$event['name']?></h5>
                              <p class="card-location"><?=$event['address']?></p>
                              <div class="card-stats">
                                <div class="stat">
                                  <span class="stat-number">512</span>
                                  <span class="stat-label">Người tham gia</span>
                                </div>
                                <div class="stat">
                                  <span class="stat-number">706</span>
                                  <span class="stat-label">Số vé mới</span>
                                </div>
                              </div>
                              <p class="card-date"><?php echo date('d/m/Y', $event->time_start);?></p>
                              <a href="/manageevent?id=<?=$event['id']?>">Quản lý sự kiện</a>
                            </div>
                          </div>
                        </div>
                        <?php endforeach;?>
                      <?php else:?>
                        <div class="container-fl text-center my-5">
                          <div class="no-events-img">
                            <img src="<?=$urlThemeActive?>asset/image/nodata.jpg" alt="No events image">
                          </div>
                          <h4 class="mt-4 fw-bold">Chưa có sự kiện nào được thêm</h4>
                          <p class="text-muted">
                            Để thêm sự kiện vào đây, bạn cần <span class="text-danger">TẠO SỰ KIỆN</span> hoặc <span class="text-danger">THAM GIA SỰ KIỆN</span>.
                          </p>
                          <div class="d-flex justify-content-center gap-3 mt-4">
                            <button class="btn btn-danger px-4 py-2 btn__myevent"><a href="/createevent">Tạo sự kiện mới</a></button>
                            <button class="btn btn-outline-danger px-4 py-2 btn__myevent-red"><a href="">Tham gia sự kiện</a></button>
                          </div>
                        </div>
                      <?php endif;?>
                  
                    </div>
                </div>
            </div>
        </section>

    </main>
<?php getFooter();?>