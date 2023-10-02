<?php include(__DIR__.'/../header.php'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Lịch sử giao dịch</h4>
  <p><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#addMoney"  class="btn btn-primary"><i class='bx bx-plus'></i> Nạp tiền (<?php echo number_format($boss_spa->coin);?>đ)</a></p>

  <!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          <div class="col-md-2">
            <label class="form-label">ID giao dịch</label>
            <input type="text" class="form-control" name="id" value="<?php if(!empty($_GET['id'])) echo $_GET['id'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Tạo từ ngày</label>
            <input type="text" class="form-control datepicker" name="date_start" value="<?php if(!empty($_GET['date_start'])) echo $_GET['date_start'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Đến ngày</label>
            <input type="text" class="form-control datepicker" name="date_end" value="<?php if(!empty($_GET['date_end'])) echo $_GET['date_end'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Loại giao dịch</label>
            <select name="type" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <option value="plus" <?php if(!empty($_GET['type']) && $_GET['type']=='plus') echo 'selected';?>>Cộng tiền</option>
              <option value="minus" <?php if(!empty($_GET['type']) && $_GET['type']=='minus') echo 'selected';?>>Trừ tiền</option>
              
            </select>
          </div>

          <div class="col-md-1">
            <label class="form-label">&nbsp;</label>
            <button type="submit" class="btn btn-primary d-block">Lọc</button>
          </div>

          <div class="col-md-1">
            <label class="form-label">&nbsp;</label>
            <input type="submit" class="btn btn-danger d-block" value="Excel" name="action">
          </div>
        </div>
      </div>
    </div>
  </form>
  <!--/ Form Search -->

  <!-- Responsive Table -->
  <div class="card">
    <h5 class="card-header">Lịch sử giao dịch</h5>
    <?php echo @$mess; ?>
    <div class="card-body row">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th>ID</th>
              <th>Thời gian</th>
              <th>Số tiền</th>
              <th>Loại</th>
              <th>Ghi chú</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              if(!empty($listData)){
                foreach ($listData as $item) {
                  echo '<tr>
                          <td>'.$item->id.'</td>
                          <td>'.date('d/m/Y H:i', $item->create_at).'</td>
                          <td>'.number_format($item->coin).'đ</td>
                          <td>'.$item->type.'</td>
                          <td>'.$item->note.'</td>
                        </tr>';
                }
              }else{
                echo '<tr>
                        <td colspan="10" align="center">Chưa có giao dịch nào</td>
                      </tr>';
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Phân trang -->
    <div class="demo-inline-spacing">
      <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
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
    <!--/ Basic Pagination -->
  </div>
  <!--/ Responsive Table -->
</div>

<div class="modal fade" id="addMoney"  name="id">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Nhập số tiền bạn muốn nạp</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
      <form enctype="multipart/form-data" method="get" action="/createRequestAddMoney">
        <div class="modal-footer">
          <input type="text" value="" class="form-control" name="coin" placeholder="Nhập số đầy đủ số 0" id="coin">
        
          <button type="submit" class="btn btn-primary">Tạo yêu cầu tiền</button>
        </div>
      </form>
      
    </div>
  </div>
</div>

<?php include(__DIR__.'/../footer.php'); ?>