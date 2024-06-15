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
            <label class="form-label">Tên đại lý</label>
            <input type="text" class="form-control" name="member_buy" id="member_buy" value="<?php if(!empty($_GET['member_buy'])) echo $_GET['member_buy'];?>">
            <input type="hidden" class="form-control" name="id_member_buy" id="id_member_buy" value="<?php if(!empty($_GET['id_member_buy'])) echo $_GET['id_member_buy'];?>">
          </div>
          <div class="col-md-3">
            <label class="form-label">Tên Khách hàng</label>
            <input type="text" class="form-control" name="customer_buy" id="customer_buy" value="<?php if(!empty($_GET['customer_buy'])) echo $_GET['customer_buy'];?>">
            <input type="hidden" class="form-control" name="id_customer" id="id_customer" value="<?php if(!empty($_GET['s'])) echo $_GET['id_customer'];?>">
          </div>
          <div class="col-md-2">
            <label class="form-label">Đối tượng thanh toán</label>
            <select  name="type_order" id="type_order" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <option value="1" <?php if(!empty($_GET['type_order']) && $_GET['type_order']==1) echo 'selected'; ?>>Đại lý</option>
              <option value="2" <?php if(!empty($_GET['type_order']) && $_GET['type_order']==2) echo 'selected'; ?>>Khách hàng</option>
            </select>
          </div>
          <div class="col-md-2">
            <label class="form-label">Trạng thái</label>
            <select  name="status" id="status" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <option value="0" <?php if(@$_GET['status']==0) echo 'selected'; ?>>Chưa trả hết</option>
              <option value="1" <?php if(@$_GET['status']==1) echo 'selected'; ?>>Đã trả hết</option>
            </select>
          </div>
          <div class="col-md-2">
            <label class="form-label">Tạo từ ngày</label>
            <input type="text" class="form-control datepicker" name="date_start" value="<?php if(!empty($_GET['date_start'])) echo $_GET['date_start'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Đến ngày</label>
            <input type="text" class="form-control datepicker" name="date_end" value="<?php if(!empty($_GET['date_end'])) echo $_GET['date_end'];?>">
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
    <div class="card-body row">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th>ID</th>
              <th>Thời gian</th>
              <th>Thông tin</th>
              <th>đối tượng</th>
              <th>Số tiền </th>
              <th>Số lần trả</th>
              <th>Nội dung</th>
              <th >Trả</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              if(!empty($listData)){
                foreach ($listData as $item) {
                   $type = '';
                  if($item->type_order==1){
                    $type = 'Đại lý';
                  }elseif($item->type_order==2){
                    $type = 'Khách hàng';
                  }

                  $status = ' <td align="center">đã trả xong';
                  if($item->status==0){
                    $status = '
                    <td align="center">Chưa trả xong<br/>
                    </td>
                    ';
                  }
                    $info = '';
                  if(!empty($item->member)){
                    $info = 'Tên đại lý:'.$item->member->name.'<br/>
                            Số điện thoại:'.$item->member->phone;
                  }elseif(!empty($item->customer)){
                    $info = 'Tên khách hàng:'.$item->customer->full_name.'<br/>
                            Số điện thoại:'.$item->customer->phone;
                  }
                  
                  echo '<tr>
                          <td>'.$item->id.'</td>
                          <td>'.date('d/m/Y H:i', $item->created_at).'</td>
                          <td>'.$info.'</td>
                          <td>'.$type.'</td>
                          <td>
                          Số tiền Nợ: '.number_format($item->total).'đ<br/>
                          Số tiền đã trả: '.number_format($item->total_payment).'đ<br/>
                          Số tiền còn : '.number_format($item->total-$item->total_payment).'đ<br/>
                          </td>
                          <td align="center"><a href="/listBill?id_debt='.$item->id.'" title="chi tiết">'.$item->number_payment.'</a></td>
                          <td>'.$item->note.'<br/>
                            <a href="/requestProductAgency?id='.$item->id_order.'" target="_blank">Xem đơn hàng tại đây</a>
                          </td>
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
<!-- <td align="center">
                            <a class="dropdown-item" href="/addPayableDebt/?id='.$item->id.'">
                              <i class="bx bx-edit-alt me-1"></i>
                            </a>
                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#basicModal'.$item->id.'" >
                              <i class="bx bxl-paypal me-1"></i>
                            </a>
                          </td> -->
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
                                              echo '<option value="'.$key.'">'.$value.'</option>';
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