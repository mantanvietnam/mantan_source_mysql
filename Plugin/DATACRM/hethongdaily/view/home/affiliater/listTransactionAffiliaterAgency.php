<?php include(__DIR__.'/../header.php'); ?>
<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/affiliate-view-admin-transaction-listTransactionAffiliaterAdmin">Lịch sử giao dịch</a> /</span>
    Danh sách giao dịch
  </h4>

  <p><a href="/listTransactionAffiliaterAgency" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p>

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
            <label class="form-label">ID người tiếp thị</label>
            <input type="text" class="form-control" name="id_affiliater" value="<?php if(!empty($_GET['id_affiliater'])) echo $_GET['id_affiliater'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">ID đơn hàng</label>
            <input type="text" class="form-control" name="id_order" value="<?php if(!empty($_GET['id_order'])) echo $_GET['id_order'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <option value="new" <?php if(!empty($_GET['status']) && $_GET['status']=='new') echo 'selected';?> >Chưa thanh toán</option>
              <option value="done" <?php if(!empty($_GET['status']) && $_GET['status']=='done') echo 'selected';?> >Đã thanh toán</option>
            </select>
          </div>
          
          <div class="col-md-2">
            <label class="form-label">&nbsp;</label>
            <button type="submit" class="btn btn-primary d-block">Tìm kiếm</button>
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
  <div class="card row">
    <h5 class="card-header">Danh sách giao dịch</h5>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th>ID</th>
            <th>Người tiếp thị</th>
            <th>ID đơn hàng</th>
            <th>Giá trị đơn hàng</th>
            <th>Hoa hồng bán</th>
            <th>Trạng thái</th>
            <th>Thanh toán</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          if(!empty($listData)){
            foreach ($listData as $item) {
              $status = 'Đã thanh toán';
              $pay = '';

              if($item->status == 'new'){
                  $status = 'Chưa thanh toán';

                  $pay = '<a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn đã thanh toán chưa?\');" href="/payTransactionAffiliaterAgency/?id='.$item->id.'">
                            <i class="bx bxs-credit-card"></i>
                          </a>';
              }

              echo '<tr>
              <td>'.$item->id.'</td>

              <td>
                <a href="/listAffiliaterAgency?id='.$item->aff->id.'">'.$item->aff->name.'</a><br/>
                '.$item->aff->phone.'<br/>
              </td>
             
              <td><a href="/orderCustomerAgency?id='.$item->id_order.'">'.$item->id_order.'</a></td>

              <td>'.number_format($item->money_total).'đ</td>
              <td>'.number_format($item->money_back).'đ</td>
              
              <td>'.$status.'</td>

              <td align="center">'.$pay.'</td>
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
<?php include(__DIR__.'/../footer.php'); ?>