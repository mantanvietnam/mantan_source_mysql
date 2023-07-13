<?php include(__DIR__.'/../header.php'); ?>

<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Kho mẫu thiết kế</h4>
  <p><a href="/addWarehouse" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p>

  <!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          <div class="col-md-1">
            <label class="form-label">ID</label>
            <input type="text" class="form-control" name="id" value="<?php if(!empty($_GET['id'])) echo $_GET['id'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Tên kho</label>
            <input type="text" class="form-control" name="name" value="<?php if(!empty($_GET['name'])) echo $_GET['name'];?>">
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
  <div class="card">
    <h5 class="card-header">Danh sách kho mẫu thiết kế - <b class="text-danger"><?php echo number_format($totalData);?></b> kho</h5>
    <div id="desktop_view">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th>ID</th>
              <th>Ảnh đại diện</th>
              <th>Kho mẫu thiết kế</th>
              <th>Thống kê</th>
              <th>Giá bán</th>
              <th>Ngày dùng</th>
              <th>Sửa</th>
              <th>Xóa</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              if(!empty($listData)){
                foreach ($listData as $item) {
                  $link_share = 'https://designer.ezpics.vn/detailWarehouse/'.$item->slug.'-'.$item->id.'.html';

                  echo '<tr>
                          <td>
                            '.$item->id.'
                          </td>
                          <td>
                            <img src="'.$item->thumbnail.'" width="100" /><br/>
                            '.date('d/m/Y', strtotime($item->created_at)).'
                          </td>
                          <td><a href="'.$link_share.'">'.$item->name.'</a></td>
                          
                          <td>
                            Xem: '.number_format($item->views).'<br/>
                            Mua: <a href="/listWarehouseUser/?warehouse_id='.$item->id.'">'.number_format($item->number_user).'</a><br/>
                            Mẫu: <a href="/listProduct/?warehouse_id='.$item->id.'">'.number_format($item->number_product).'</a>
                          </td>
                          <td>
                            '.number_format($item->price).'
                          </td>
                          <td>
                            '.number_format($item->date_use).'
                          </td>
                          
                          <td align="center">
                            <a class="dropdown-item" href="/addWarehouse/?id='.$item->id.'">
                              <i class="bx bx-edit"></i>
                            </a>
                          </td>

                          <td align="center">
                            <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa kho mẫu thiết kế không?\');" href="/deleteWarehouse/?id='.$item->id.'">
                              <i class="bx bx-trash me-1"></i>
                            </a>
                          </td>
                        </tr>';
                }
              }else{
                echo '<tr>
                        <td colspan="10" align="center">Chưa có kho mẫu thiết kế</td>
                      </tr>';
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
    <div id="mobile_view">
      <?php 
              if(!empty($listData)){
                foreach ($listData as $item) {
                  ?>
                    <div class="col-sm-12 p-2 m-2 border border-secondary mb-3">
                      <p><b>Kho <?php echo @$item->id ?>:</b> <?php echo $item->name ?></p>
                      <p><img src="<?php echo @$item->thumbnail ?>" style="width: 100%;" /></p>
                      <p><b>thống kê:  </b><br/>
                        Xem: <?php echo number_format($item->views); ?><br/>
                        Mua: <a href="/listWarehouseUser/?warehouse_id='.$item->id.'"><?php echo number_format($item->number_user); ?></a><br/>
                        Mẫu: <a href="/listProduct/?warehouse_id='.$item->id.'"><?php echo number_format($item->number_product); ?></a>
                      </p>
                      <p><b>Giá:  </b><?php echo number_format($item->price); ?></p>
                      <div class="mb-3 row">
                        <div class="col-md-6" style="width: 50%;">
                          <a class="dropdown-item btn btn-primary d-block" href="/addWarehouse/?id='.$item->id.'">
                                  <i class="bx bx-edit"></i> sửa
                                </a>
                        </div>
                        <div class="col-md-6" style="width: 50%;">
                            <a class="btn btn-danger d-block" onclick="return confirm(\'Bạn có chắc chắn muốn xóa kho mẫu thiết kế không?\');" href="/deleteWarehouse/?id='.$item->id.'">
                                  <i class="bx bx-trash me-1"></i> xóa
                                </a>
                        </div>
                      </div>
                    </div>
             <?php   }
        }else{
          echo '<div class="col-sm-12 item">
                  <p class="text-danger">Chưa có dữ liệu</p>
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