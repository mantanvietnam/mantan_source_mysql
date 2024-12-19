<script language="javascript" type="text/javascript" src="/plugins/ezpics_admin/view/admin/js/ezpics_admin.js"></script>
<link rel="stylesheet" href="/plugins/ezpics_admin/view/admin/css/ezpics_admin.css" />
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Giao dịch thanh toán cho cộng tác viên</h4>

  <!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          <div class="col-md-2">
            <label class="form-label">SĐT người dùng</label>
            <input type="text" class="form-control" name="phone" value="<?php if(!empty($_GET['phone'])) echo $_GET['phone'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <option value="new" <?php if(!empty($_GET['status']) && $_GET['status']=='new') echo 'selected';?> >Chưa Thanh toán</option>
              <option value="done" <?php if(!empty($_GET['status']) && $_GET['status']=='done') echo 'selected';?> >Đã Thanh toán</option>
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
        </div>
      </div>
    </div>
  </form>
  <!--/ Form Search -->

  <!-- Responsive Table -->
  <div class="card row">
    <div class="row">
      <div class="col-md-6">
        <h5 class="card-header">Giao dịch thanh toán - <b class="text-danger"><?php echo number_format($totalData);?></b> giao dịch</h5>
      </div>
      <div class="col-md-6">
        <h5 class="card-header" style="float: right;">Tổng số tiền là   <b class="text-danger"><?php echo number_format($totalMoney);?></b> đ</h5>
      </div>
    </div>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th>ID</th>
              <th>Thời gian</th>
              <th>Số tiền</th>
              <th>Người dùng</th>
              <th>tài khoản ngân hàng</th>
              <th>Trạng thái</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              if(!empty($listData)){
                foreach ($listData as $item) {
                  $status = '<span class="text-danger">Chưa xử lý</span><br/><a class="btn rounded-pill btn-icon btn-outline-secondary" title="chưa thanh toán" data-bs-toggle="modal"
                            data-bs-target="#basicModal'.$item->id.'" ><i class="bx bxs-message-square-check"></i></a>';
                  if($item->status=='done'){
                    $status = '<span class="text-success">Đã thanh toán</span>';
                  }


                  echo '<tr>
                          <td>'.$item->id.'</td>
                          <td>'.date('H:i d/m/Y', $item->created_at).'</td>
                          <td>'.number_format($item->total).'đ</td>
                          
                          <td>
                            '.$item->user->full_name.'<br/>
                            '.$item->user->phone.'<br/>
                            '.$item->user->email.'
                          </td>
                          <td>Chủ tk: '.$item->account_name.'<br/>
                            Ngân hàng: '.$item->code_bank.'<br/>
                            Số tk: '.$item->account_number.'
                          </td>
                          <td>'.$status.'</td>
                          
                          
                        </tr>';
                }
              }else{
                echo '<tr>
                        <td colspan="10" align="center">Chưa có giao dịch</td>
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
   <div class="col-lg-4 col-md-6">
                      <!-- <small class="text-light fw-semibold">Default</small> -->
                      <div class="mt-3">
                        <!-- Button trigger modal -->
                        
                        <!-- Modal -->
                      <?php  if(!empty($listData)){
              foreach ($listData as $items) { ?>
                        <div class="modal fade" id="basicModal<?php echo $items->id; ?>"  name="id">
                                
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Thông sử lý giao dịch </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"aria-label="Close"></button>
                              </div>

                            <div style=" padding: 20px; ">
                              <p><label>ID:</label> <?php echo $items->id ?></p>
                              <p><label>MÃ giao dịch:</label> <?php echo $items->code ?></p>
                              <p><label>Tên:</label> <?php echo $items->user->full_name ?></p>
                              <p><label>Điện thoại:</label> <?php echo $items->user->phone ?></p>
                              <p><label>Email:</label> <?php echo $items->user->email ?></p>
                              <p><label>Chủ tk: </label> <?php echo $items->account_name ?></p>
                              <p><label>Ngân hàng: </label> <?php echo $items->code_bank ?></p>
                              <p><label>Số tk: </label> <?php echo $items->account_number ?></p>
                              <p><?php echo $items->note; ?></p>
                              <p><label>số tiền dư trong tk  :</label> <?php echo number_format($items->user->total_coin); ?> VND</p>
                              <p><label>tiền rút :</label> <?php echo number_format($items->total); ?>  VNĐ</p>
                              
                                <a class="btn btn-primary" onclick="return confirm('Bạn có chắc chắn muốn sử lý giao dịch này không?');" href="/transactioncMoneyAdmin?id=<?php echo $items->id; ?>&page=<?php echo @$_GET['page']; ?>" title="Xác nhận chuyển tiền  ">Xác nhận cho khách</a>
                            </div>
                             
                              
                            </div>
                          </div>
                        </div>
                      <?php }} ?>
                      </div>
                    </div>
    <!--/ Basic Pagination -->
  </div>
</div>