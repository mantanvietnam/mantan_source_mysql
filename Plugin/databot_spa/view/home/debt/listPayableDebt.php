<?php include(__DIR__.'/../header.php');
global $type_collection_bill;
 ?>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Công nợ phải trả</h4>
  <p><a href="/addPayableDebt" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p>

  <!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          <div class="col-md-1">
            <label class="form-label">ID phiếu</label>
            <input type="text" class="form-control" name="id" value="<?php if(!empty($_GET['id'])) echo $_GET['id'];?>">
          </div>

          <div class="col-md-3">
            <label class="form-label">Nhân viên phụ trách</label>
            <select name="id_staff" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <?php 
              if(!empty($listStaffs)){
                foreach ($listStaffs as $key => $value) {
                  if(empty($_GET['id_staff']) || $_GET['id_staff']!=$value->id){
                    echo '<option value="'.$value->id.'">'.$value->name.'</option>';
                  }else{
                    echo '<option selected value="'.$value->id.'">'.$value->name.'</option>';
                  }
                }
              }
              ?>
            </select>
          </div>

          <div class="col-md-3">
            <label class="form-label">Đôi tác</label>
            <input type="text" class="form-control" name="full_name" value="<?php if(!empty($_GET['full_name'])) echo $_GET['full_name'];?>">
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
            <label class="form-label">ID khách hàng</label>
            <input type="text" class="form-control" name="id_customer" value="<?php if(!empty($_GET['id_customer'])) echo $_GET['id_customer'];?>">
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
    <h5 class="card-header">Danh sách công nợ phải trả</h5>
    <?php echo @$mess; ?>
    <div class="row">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th>ID</th>
              <th>Thời gian</th>
              <th>đôi tác</th>
              <th>Nhân viên</th>
              <th>Số tiền </th>
              <th>Số lần trả</th>
              <th>Nội dung phiếu thu</th>
              <th>Sửa</th>
              <th>Trả</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              if(!empty($listData)){
                foreach ($listData as $item) {
                  $status = ' <td align="center" colspan="2" >đã trả xong';
                  if($item->status==0){
                    $status = '<td align="center">
                            <a class="dropdown-item" href="/addPayableDebt/?id='.$item->id.'">
                              <i class="bx bx-edit-alt me-1"></i>
                            </a>
                          </td>
                    <td align="center">Chưa trả xong<br/>
                    <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#basicModal'.$item->id.'" >
                              <i class="bx bxl-paypal me-1"></i>
                            </a></td>
                    ';
                  }
                  echo '<tr>
                          <td>'.$item->id.'</td>
                          <td>'.date('d/m/Y H:i', $item->time).'</td>
                          <td>'.@$item->full_name.'</td>
                          <td>'.$item->staff->name.'</td>
                          <td>
                          Số tiền Nợ: '.number_format($item->total).'đ<br/>
                          Số tiền đã trả: '.number_format($item->total_payment).'đ<br/>
                          Số tiền còn : '.number_format($item->total-$item->total_payment).'đ<br/>
                          </td>
                          <td align="center"><a href="/listBill?id_debt='.$item->id.'" title="chi tiết">'.$item->number_payment.'</a></td>
                          <td>'.$item->note.'</td>
                          '.$status.'
                        </tr>';
                }
              }else{
                echo '<tr>
                        <td colspan="10" align="center">Chưa có công nợ trả nào</td>
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
    <!--/ Thanh toán công nợ -->

    <?php  if(!empty($listData)){
              foreach ($listData as $items) { ?>
                        <div class="modal fade" id="basicModal<?php echo $items->id; ?>"  name="id">
                                
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header form-label border-bottom">
                                <h5 class="modal-title" id="exampleModalLabel1">Thanh toán công nợ </h5>
                                <button type="button" class="btn-close"data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                             <form action="paymentBill" method="GET">
                               <div class="modal-footer">
                                <input type="hidden" value="<?php echo $items->id; ?>"  name="id_debt">
                                <input type="hidden" value="<?php echo $items->id_customer; ?>"  name="id_customer">
                                <input type="hidden" value="<?php echo @$items->full_name; ?>"  name="full_name">
                                <div class="card-body">
                                  <div class="row gx-3 gy-2 align-items-center">
                                    <div class="col-md-12">
                                      <!-- <label class="form-label">Tên người nợ</label>
                                      <input type="text" value="<?php echo $item->full_name ?>" class="form-control" placeholder="Mặc định là 0đ" name="price"> -->
                                      <p><label class="form-label">Đối tác:</label> <?php echo $items->full_name ?></p>
                                      <p><label class="form-label">Số tiền Nợ:</label> <?php echo number_format($items->total) ?> đ</p>
                                      <p><label class="form-label">Số tiền đã trả:</label> <?php echo number_format($items->total_payment) ?> đ</p>
                                      <p><label class="form-label">Số tiền còn:</label> <?php echo number_format($items->total-$items->total_payment) ?> đ</p>
                                      <p><label class="form-label">Số lần trả:</label> <?php echo $items->number_payment ?> lần</p>
                                    </div>
                                    
                                    <div class="col-md-12">
                                      <label class="form-label">Số tiền trả</label>
                                      <input type="number" required value="" class="form-control" placeholder="" name="total">
                                    </div>
                                    <div class="col-md-12">
                                      <label class="form-label">Chọn hình thức thanh toán</label>
                                      <select name="type_collection_bill" class="form-select color-dropdown" required>
                                        <option value="">Chọn hình thức thanh toán</option>
                                        <?php
                                          foreach ($type_collection_bill as $key => $value) {
                                              echo '<option selected value="'.$key.'">'.$value.'</option>';
                                          }
                                        ?>
                                      </select>
                                    </div>
                                    <div class="col-md-12">
                                      <label class="form-label">Nội dung trả </label>
                                      <textarea  class="form-control" rows="5" name="note"></textarea>
                                    </div>
                                  </div>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Thanh thoán </button>
                              </div>
                             </form>
                              
                            </div>
                          </div>
                        </div>
                      <?php }} ?>
  </div>
  <!--/ Responsive Table -->
</div>
<?php include(__DIR__.'/../footer.php'); ?>