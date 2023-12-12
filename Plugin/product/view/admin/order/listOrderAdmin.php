<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Đơn hàng</h4>

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

          <div class="col-md-3">
            <label class="form-label">Tên khách hàng</label>
            <input type="text" class="form-control" name="full_name" value="<?php if(!empty($_GET['full_name'])) echo $_GET['full_name'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Điện thoại</label>
            <input type="text" class="form-control" name="phone" value="<?php if(!empty($_GET['phone'])) echo $_GET['phone'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <option value="new" <?php if(!empty($_GET['status']) && $_GET['status']=='new') echo 'selected';?> >Đơn hàng mới</option>
              <option value="done" <?php if(!empty($_GET['status']) && $_GET['status']=='done') echo 'selected';?> >Đã xử lý</option>
            </select>
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
    <h5 class="card-header">Danh sách đơn hàng</h5>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th>ID</th>
            <th>Khách hàng</th>
            <th>Số tiền</th>
            <th>Thời gian tạo</th>
            <th>Trạng thái</th>
            <th>Xử lý</th>
            <th>Xóa</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            if(!empty($listData)){
              foreach ($listData as $item) {
                $status= '';
               if($item->status=='new'){ 
                 $status= '<p style="color: #00aeee;">Đơn mới</p>';
                }elseif($item->status=='browser'){
                   $status= '<p style="color: #0333f6;">Đã duyệt</p>';
                }elseif($item->status=='delivery'){
                     $status= '<p style="color: #7503f6;">Đang giao</p>';
                }elseif($item->status=='done'){
                   $status= '<p style="color: #00ee4b;">Đã xong</p>';
                }else{
                   $status= '<p style="color: red;">Đã hủy</p>';
                }
                echo '<tr>
                        <td>'.$item->id.'</td>
                        <td>
                          '.$item->full_name.'<br/>
                          '.$item->phone.'<br/>
                          '.$item->email.'<br/>
                          '.$item->address.'<br/>
                        </td>
                        <td>'.number_format($item->total).'đ</td>
                        <td>'.date('H:i d/m/Y', $item->create_at).'</td>
                        <td align="center">'.$status.'</td>
                        <td align="center">
                          <a class="dropdown-item" href="/plugins/admin/product-view-admin-order-viewOrderAdmin.php/?id='.$item->id.'">
                            <i class="bx bx-edit-alt me-1"></i>
                          </a>
                        </td>
                        <td align="center">
                          <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/plugins/admin/product-view-admin-order-deleteOrderAdmin.php/?id='.$item->id.'">
                            <i class="bx bx-trash me-1"></i>
                          </a>
                        </td>
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