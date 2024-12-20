<?php include(__DIR__.'/../header.php'); ?>

<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Danh sách đơn hàng</h4>
  <p>
      <a href="/addOrder" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a> &nbsp;&nbsp;&nbsp;
      <a href="/addMoney" class="btn btn-danger"><i class='bx bx-plus'></i> Nạp tiền (<?php echo number_format($session->read('infoUser')->coin);?>đ)</a>
  </p>

  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Danh sách đơn thuê Zoom</h5>
    
    <div class="row mb-3">
      <div class="col-6 col-sm-6 col-md-3">
        <b>Zoom 100:</b><?php if ($numberAcc100 > 0): ?>
                          <span class="text-primary"><?php echo $numberAcc100; ?></span>
                        <?php else: ?>
                          <span class="text-danger"><?php echo $numberAcc100; ?> ( Tạm Hết )</span>
                        <?php endif; ?>
      </div>
      <div class="col-6 col-sm-6 col-md-3">
        <b>Zoom 300:</b><?php if ($numberAcc300 > 0): ?>
                          <span class="text-primary"><?php echo $numberAcc300; ?></span>
                        <?php else: ?>
                          <span class="text-danger"><?php echo $numberAcc300; ?> ( Tạm Hết )</span>
                        <?php endif; ?>
      </div>
      <div class="col-6 col-sm-6 col-md-3">
        <b>Zoom 500:</b><?php if ($numberAcc500 > 0): ?>
                          <span class="text-primary"><?php echo $numberAcc500; ?></span>
                        <?php else: ?>
                          <span class="text-danger"><?php echo $numberAcc500; ?> ( Tạm Hết )</span>
                        <?php endif; ?>
      </div>
      <div class="col-6 col-sm-6 col-md-3">
        <b>Zoom 1000:</b><?php if ($numberAcc1000 > 0): ?>
                          <span class="text-primary"><?php echo $numberAcc1000; ?></span>
                        <?php else: ?>
                          <span class="text-danger"><?php echo $numberAcc1000; ?> ( Tạm Hết )</span>
                        <?php endif; ?>
      </div>
    </div>

    <div id="desktop_view">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th>ID</th>
              <th>Thời gian thuê</th>
              <th>Loại Zoom</th>
              <th>Giá thuê</th>
              <th>Phòng họp</th>
              <th class="text-center">người tham gia</th>
              <th>Cloud Recording</th>
            </tr>
          </thead>
          <tbody>
          <?php 
              if (!empty($listData)) : 
                  foreach ($listData as $item) : 
                      if ($item->dateEnd > time()) {
                          if (empty($item->idRoom)) {
                              $room = '<a href="/createRoom/?idOrder=' . $item->id . '" class="btn btn-primary">Tạo phòng</a>';
                          } else {
                              $room = '<a href="/room/?id=' . $item->idRoom . '">Xem phòng</a>';
                          }
                      } else {
                          $room = '<p class="text-danger">Đơn hết hạn</p>';
                      }

                      $extend_time_use = '';
                      if ($item->extend_time_use) $extend_time_use = 'Bật gia hạn tự động';

                      $timeBuy = ($item->dateEnd - $item->dateStart) / 3600;

                      if ($timeBuy < 24) {
                          $timeBuy = $timeBuy . ' giờ';
                      } else {
                          $timeBuy = $timeBuy / 24;
                          $timeBuy = $timeBuy . ' ngày';
                      }
                      ?>
                      <tr>
                          <td><?php echo $item->id; ?></td>
                          <td>
                              <p class="text-success"><?php echo date('H:i d/m/Y', $item->dateStart); ?></p>
                              <p class="text-danger"><?php echo date('H:i d/m/Y', $item->dateEnd); ?></p>
                              <p><?php echo $timeBuy; ?></p>
                              <?php echo $extend_time_use; ?>
                          </td>
                          <td><?php echo $item->type; ?></td>
                          <td><?php echo number_format($item->price); ?>đ</td>
                          <td><?php echo $room; ?></td>
                          <td class="text-center">
                            <?php if (
                                isset($item->infoRoom->info['id']) &&
                                isset($item->infoZoom->client_id) &&
                                isset($item->infoZoom->client_secret) &&
                                isset($item->infoZoom->account_id)
                            ): ?>
                                <a href="/listparticipants/?clientid=<?= urlencode($item->infoZoom->client_id) ?>&clientsecret=<?= urlencode($item->infoZoom->client_secret) ?>&accountid=<?= urlencode($item->infoZoom->account_id) ?>&idmeeting=<?= urlencode($item->infoRoom->info['id']) ?>">
                                    <i class='bx bxs-user-pin' style="font-size: 40px;"></i>
                                </a>  
                            <?php else: ?>
                                <a href="/listparticipants/">
                                    <i class='bx bxs-user-pin' style="font-size: 40px;"></i>
                                </a> 
                            <?php endif; ?>
                          </td>
                          <td class="text-center">
                            <?php if (
                                isset($item->infoRoom->info['id']) &&
                                isset($item->infoZoom->client_id) &&
                                isset($item->infoZoom->client_secret) &&
                                isset($item->infoZoom->account_id)
                            ): ?>
                                <a href="/listCloud/?clientid=<?= urlencode($item->infoZoom->client_id) ?>&clientsecret=<?= urlencode($item->infoZoom->client_secret) ?>&accountid=<?= urlencode($item->infoZoom->account_id) ?>&idmeeting=<?= urlencode($item->infoRoom->info['id']) ?>">
                                    <i class="bx bx-cloud fs-1"></i>
                                </a>  
                            <?php else: ?>
                                <a href="/listCloud/">
                                    <i class="bx bx-cloud fs-1"></i>
                                </a> 
                            <?php endif; ?>
                          </td>
                      </tr>
                      <?php 
                  endforeach;
              else :
                  ?>
                  <tr>
                      <td colspan="10" align="center">Chưa có đơn thuê nào</td>
                  </tr>
              <?php 
            endif; 
            ?>
          </tbody>
        </table>
      </div>
    </div>
    <div id="mobile_view">
      <?php 
              if(!empty($listData)){
                foreach ($listData as $item) {
                  if($item->dateEnd > time()){
                    if(empty($item->idRoom)){
                      $room = '<a href="/createRoom/?idOrder='.$item->id.'" class="btn btn-primary">Tạo phòng</a>';
                    }else{
                      $room = '<a href="/room/?id='.$item->idRoom.'">Xem phòng</a>';
                    }
                  }else{
                    $room = '<p class="text-danger">Đơn hết hạn</p>';
                  }

                  ?>
                    <div class="col-sm-12 p-2 m-2 border border-secondary mb-3">
                      <p><b>Đơn hàng:</b> <?php echo @$item->id ?></p>
                      <p><span class="text-success"><?php echo date('H:i d/m/Y', $item->dateStart).'</span> - <span class="text-danger">'.date('H:i d/m/Y', $item->dateEnd).'</span>';?></p>
                      <p><b>Zoom:</b> <?php echo $item->type;?></p>
                      <p><b>Giá:</b> <?php echo number_format($item->price);?>đ</p>
                      <p><?php echo $room;?></p>
                    </div>
             <?php   }
        }else{
          echo '<div class="col-sm-12 item">
                  <p class="text-danger">Chưa có đơn thuê nào</p>
                </div>';
        }
      ?>
    </div>

    <!-- Phân trang -->
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
    <!--/ Basic Pagination -->
  </div>
  <!--/ Responsive Table -->
</div>

<?php include(__DIR__.'/../footer.php'); ?>