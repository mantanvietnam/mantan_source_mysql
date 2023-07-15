<?php include(__DIR__.'/../header.php'); ?>

<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Khách mua kho mẫu thiết kế</h4>
  <p><a href="/addWarehouseUser/?warehouse_id=<?php echo @$_GET['warehouse_id'];?>" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p>

  <!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          <div class="col-md-3">
            <label class="form-label">Tài khoản khách hàng</label>
            <input type="text" class="form-control" name="phone" value="<?php if(!empty($_GET['phone'])) echo $_GET['phone'];?>">
          </div>

          <div class="col-md-3">
            <label class="form-label">Kho mẫu</label>
            <select name="warehouse_id" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <?php
              if(!empty($listWarehouse)){
                foreach ($listWarehouse as $key => $value) {
                  if(empty($_GET['warehouse_id']) || $_GET['warehouse_id']!=$value->id){
                    echo '<option value="'.$value->id.'">'.$value->name.'</option>';
                  }else{
                    echo '<option selected value="'.$value->id.'">'.$value->name.'</option>';
                  }
                }
              }
              ?>
            </select>
          </div>
          
          <div class="col-md-1">
            <label class="form-label">&nbsp;</label>
            <button type="submit" class="btn btn-primary d-block">Lọc</button>
          </div>
        </div>
      </div>
    </div>
  </form>
  <!--/ Form Search -->

  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Danh sách khách hàng mua kho mẫu thiết kế - <b class="text-danger"><?php echo number_format($totalData);?></b> khách</h5>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="" style="text-align: center;">
            <th>Ảnh đại diện</th>
            <th>Khách hàng</th>
            <th>Kho mẫu</th>
            <th>Giá mua</th>
            <th>Ngày mua</th>
            <th>Ngày hết</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            if(!empty($listData)){
              foreach ($listData as $item) {
                echo '<tr>
                        <td align="center">
                          <img src="'.$item->infoUser->avatar.'" width="100" />
                        </td>
                        <td>
                          '.$item->infoUser->name.'<br/>
                          '.$item->infoUser->phone.'<br/>
                          '.$item->infoUser->email.'
                        </td>
                        <td>'.$item->infoWarehouse->name.'</td>
                        <td>
                          '.number_format($item->price).'
                        </td>
                        <td>
                          '.date('d/m/Y', strtotime($item->created_at)).'
                        </td>
                        <td>
                          '.date('d/m/Y', strtotime($item->deadline_at)).'
                        </td>
                      </tr>';
              }

            }else{
              echo '<tr>
                      <td colspan="10" align="center">Chưa có khách hàng nào</td>
                    </tr>';
            }
          ?>
        </tbody>
      </table>
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