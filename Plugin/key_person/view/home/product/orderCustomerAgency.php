<?php include(__DIR__.'/../header.php'); ?>

<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/orderCustomerAgency">Đơn hàng lẻ</a> /</span>
    Danh sách đơn hàng
  </h4>

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
              <option value="browser" <?php if(!empty($_GET['status']) && $_GET['status']=='browser') echo 'selected';?> >Đã duyệt</option>
              <option value="delivery" <?php if(!empty($_GET['status']) && $_GET['status']=='delivery') echo 'selected';?> >Đang giao</option>
              <option value="done" <?php if(!empty($_GET['status']) && $_GET['status']=='done') echo 'selected';?> >Đã xong</option>
              <option value="cancel" <?php if(!empty($_GET['status']) && $_GET['status']=='cancel') echo 'selected';?> >Đã hủy</option>
            </select>
          </div>
           <div class="col-md-2">
            <label class="form-label">Từ ngày</label>
            <input type="text" class="form-control datepicker" name="date_start" value="<?php if(!empty($_GET['date_start'])) echo $_GET['date_start'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Đến ngày</label>
            <input type="text" class="form-control datepicker" name="date_end" value="<?php if(!empty($_GET['date_end'])) echo $_GET['date_end'];?>">
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
    <h5 class="card-header">Danh sách đơn hàng</h5>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th width="5%">ID</th>
            <th width="20%">Thông tin giao hàng</th>
            <th width="35%" style=" padding: 0; ">
              <table  class="table table-borderless" >
                <thead>
                  <th colspan="3" class="text-center">thông tin đơn hàng</th> 
                  <tr>
                    <th width="50%">Sản phẩn</th>
                    <th width="30%">Giá bán</th>
                    <th width="20%">Số lượng </th>
                  </tr>
                </thead>
              </table>
            </th>
            <th width="10%">Số tiền</th>
            <th width="10%">Thời gian tạo</th>
            <th width="10%">Trạng thái</th>
            <th width="5%">Xử lý</th>
            <th width="5%">Xóa</th>
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
              <td width="5%">'.$item->id.'</td>
             
              <td width="20%">
                '.$item->full_name.'<br/>
                '.$item->phone.'<br/>
                '.$item->address.'<br/>
                '.$item->email.'
              </td>
             
              <td width="35%" style=" padding: 0;display: contents; ">
                <table  class="table table-borderless">
                  <tbody>';
                    if(!empty($item->detail_order)){ 
                      foreach($item->detail_order as $k => $value){
                        echo '<tr> 
                                <td  width="50%">'.$value->product.'</td>
                                <td  width="30%">'.number_format($value->price).'đ</td>
                                <td  width="20%">'.$value->quantity.'</td>
                              </tr>';
                      }
                    } 
                echo '  </tbody>
                </table>
              </td>
              <td width="10%">'.number_format($item->total).'đ</td>
              <td width="10%">'.date('H:i d/m/Y', $item->create_at).'</td>
              <td width="10%" align="center">'.$status.'</td>
              <td width="5%" align="center">
                <a class="dropdown-item" href="/viewOrderCustomerAgency/?id='.$item->id.'">
                  <i class="bx bx-edit-alt me-1"></i>
                </a>
              </td>
              <td width="5%" align="center">
                <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/deleteOrderCustomerAgency/?id='.$item->id.'">
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

<?php include(__DIR__.'/../footer.php'); ?>