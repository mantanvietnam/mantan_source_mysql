<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Kho hàng đại lý</h4>

  <!-- Form Search -->
  <form method="get" action="">
    <input type="hidden" name="id_member" value="<?php echo @$_GET['id_member'];?>">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          <div class="col-md-2">
            <label class="form-label">ID sản phẩm</label>
            <input type="text" class="form-control" name="id_product" value="<?php if(!empty($_GET['id_product'])) echo $_GET['id_product'];?>">
          </div>
          
          <div class="col-md-2">
            <label class="form-label">&nbsp;</label>
            <button type="submit" class="btn btn-primary d-block">Tìm kiếm</button>
          </div>
        </div>
      </div>
    </div>
  </form>
  <!--/ Form Search -->

  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Kho hàng đại lý</h5>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th width="5%">ID sản phẩm</th>
            <th width="20%">Hình ảnh</th>
            <th width="40%">Sản phẩm</th>
            <th width="15%">Số lượng tồn</th>
            <th width="20%">Lịch sử xuất nhập</th>
          </tr>
        </thead>
        <tbody>
        <?php 
          if(!empty($listData)){
            foreach ($listData as $item) {
              echo '  <tr>
                        <td>'.$item->id_product.'</td>
                        <td><img src="'.$item->product->image.'" width="100" /></td>
                        <td>'.$item->product->title.'</td>
                        <td>'.number_format($item->quantity).'</td>
                        <td><a href="/plugins/admin/hethongdaily-view-admin-warehouse-listHistoriesProductWarehouseMemberAdmin/?id_product='.$item->id_product.'&id_member='.$item->id_member.'">'.@$item->histories->note.'</a></td>
                      </tr>';
            }
          }else{
            echo '<tr>
                    <td colspan="10" align="center">Chưa có dữ liệu</td>
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