<?php include(__DIR__.'/../header.php'); ?>

<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/requestProductAgency">Yêu cầu nhập hàng</a> /</span>
    Danh sách yêu cầu
  </h4>

  <p><a href="/addRequestProductAgency" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p>

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
            <label class="form-label">Trạng thái đơn hàng</label>
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
            <label class="form-label">Trạng thái thanh toán</label>
            <select name="status_pay" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <option value="wait" <?php if(!empty($_GET['status_pay']) && $_GET['status_pay']=='wait') echo 'selected';?> >Chưa thanh toán</option>
              <option value="done" <?php if(!empty($_GET['status_pay']) && $_GET['status_pay']=='done') echo 'selected';?> >Đã thanh toán</option>
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
           
        </div>
      </div>
    </div>
  </form>
  <!--/ Form Search -->

  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Danh sách yêu cầu nhập hàng</h5>
    <p>Quy trình: đơn mới -> duyệt đơn -> giao hàng -> hoàn thành -> nhập hàng vào kho</p>
    <div id="desktop_view">
      <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr class="">
                <th width="10%">ID</th>
                <th width="50%" style=" padding: 0; ">
                  <table  class="table table-borderless" >
                    <thead>
                      <th colspan="4" class="text-center">Thông tin đơn hàng</th> 
                      <tr>
                        <th width="50%" style="padding: 0.625rem 0.4rem; border-width: 3px;">Sản phẩm</th>
                        <th width="30%" style="padding: 0.625rem 0.4rem; border-width: 3px;">Giá bán</th>
                        <th width="20%" style="padding: 0.625rem 0.4rem; border-width: 3px;">Số lượng</th>
                      </tr>
                    </thead>
                  </table>
                </th>
                <th width="10%">Thành tiền</th>
                <th width="10%">Chiết khấu</th>
                <th width="10%">Trạng thái</th>
                <th width="10%">Hành động</th>
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

                  $statusPay= '';
                  if($item->status_pay=='wait'){ 
                   $statusPay= '<p style="color: #00aeee;">Chưa thanh toán</p>';
                  }elseif($item->status_pay=='done'){
                   $statusPay= '<p style="color: #0333f6;">Đã thanh toán</p>';
                  }

                  $action = '';
                  if($item->status!='done' && $item->status!='cancel'){
                    $action = '<a href="/updateMyOrderMemberAgency/?id='.$item->id.'&status=done" class="btn btn-danger">Nhập kho</a>';
                  }
                  
                  echo '<tr>
                  <td>'.$item->id.'<br/><br/>'.date('H:i d/m/Y', $item->create_at).'</td>
                  <td style=" padding: 0;display: contents; ">
                    <table  class="table table-borderless">
                      <tbody>';
                        if(!empty($item->detail_order)){ 
                          foreach($item->detail_order as $k => $value){
                            $priceBuy = $value->price;
                            $priceOld = $value->price;
                            $showDiscount = '';

                            if($value->discount > 0){
                              $priceDiscount = $value->discount;

                              if($priceDiscount<=100){
                                  $priceDiscount= $priceBuy*$value->discount/100;
                                  $showDiscount = $value->discount.'%';
                              }else{
                                  $showDiscount = number_format($value->discount).'đ';
                              }

                              $priceBuy -= $priceDiscount;
                            }

                            if($priceBuy != $priceOld){
                              $showPrice = number_format($priceBuy).'đ<br/><del>'.number_format($priceOld).'đ</del><br/><br/>Giảm <b>'.$showDiscount.'</b> mỗi sản phẩm';
                            }else{
                              $showPrice = number_format($priceBuy).'đ';
                            }
                            

                            echo '<tr> 
                                   <td  width="50%" style="padding: 0.625rem 0.4rem; border-width: 3px;">'.$value->product.'</td>
                              <td  width="30%" style="padding: 0.625rem 0.4rem; border-width: 3px;">'.$showPrice.'</td>
                              <td  width="20%" style="padding: 0.625rem 0.4rem; border-width: 3px;">'.$value->quantity.'</td>
                                  </tr>';
                          }
                        } 
                    echo '  </tbody>
                    </table>
                  </td>
                  <td>
                    '.number_format($item->money).'đ
                    <p><del>'.number_format($item->total).'đ</del></p>
                  </td>
                  
                  <td>'.$item->discount.'%</td>
                  
                  <td align="center">'.$status.$statusPay.'</td>
                  <td>'.$action.'</td>
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
    </div>
     <div id="mobile_view">
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

                  $statusPay= '';
                  if($item->status_pay=='wait'){ 
                   $statusPay= '<p style="color: #00aeee;">Chưa thanh toán</p>';
                  }elseif($item->status_pay=='done'){
                   $statusPay= '<p style="color: #0333f6;">Đã thanh toán</p>';
                  }

                  $action = '';
                  if($item->status!='done' && $item->status!='cancel'){
                    $action = '<a href="/updateMyOrderMemberAgency/?id='.$item->id.'&status=done" class="btn btn-danger">Nhập kho</a>';
                  }
                  
                echo '<div class="col-sm-12 p-2 m-2 border border-secondary mb-3">
                      <p><strong>ID đơn hàng: </strong><a href="/printBillOrderMemberAgency/?id_order_member='.$item->id.'" target="_blank">'.$item->id.'</a></p>
                          <p><strong>Thời gian: </strong>'.date('H:i d/m/Y', $item->create_at).'</p>
                          
                          <p style=" padding: 0;display: contents; ">
                          <table  class="table">
                            <thead style="border-width: 3px;">
                              <th colspan="2" class="text-center">Thông tin đơn hàng</th> 
                              <tr>
                                <th width="50%" style="padding: 0.625rem 0.4rem; border-width: 3px;">Sản phẩm</th>
                                <th width="30%" style="padding: 0.625rem 0.4rem; border-width: 3px;">Giá bán</th>
                                <th width="10%" style="padding: 0.625rem 0.4rem; border-width: 3px;">Số lượng</th>
                              </tr>
                            </thead>
                          <tbody style="border-width: 3px;">';
                          if(!empty($item->detail_order)){ 
                            foreach($item->detail_order as $k => $value){
                              $priceBuy = $value->price;
                            $priceOld = $value->price;
                            $showDiscount = '';

                            if($value->discount > 0){
                              $priceDiscount = $value->discount;

                              if($priceDiscount<=100){
                                  $priceDiscount= $priceBuy*$value->discount/100;
                                  $showDiscount = $value->discount.'%';
                              }else{
                                  $showDiscount = number_format($value->discount).'đ';
                              }

                              $priceBuy -= $priceDiscount;
                            }

                            if($priceBuy != $priceOld){
                              $showPrice = number_format($priceBuy).'đ<br/><del>'.number_format($priceOld).'đ</del><br/><br/>Giảm <b>'.$showDiscount.'</b> mỗi sản phẩm';
                            }else{
                              $showPrice = number_format($priceBuy).'đ';
                            }

 
                              echo '<tr> 
                              <td  width="50%" style="padding: 0.625rem 0.4rem; border-width: 3px;">'.$value->product.'</td>
                              <td  width="30%" style="padding: 0.625rem 0.4rem; border-width: 3px;">'.$showPrice.'</td>
                              <td  width="20%" style="padding: 0.625rem 0.4rem; border-width: 3px;">'.$value->quantity.'</td>
                              </tr>';
                            }
                          } 
                          echo '  </tbody>
                          </table>
                          </p>
                          <p><strong>Tổng tiền: </strong>'.$item->total.'</p>

                          <p><strong>chiếu khấu: </strong>'.$item->discount.'%</p>

                          <p><strong>Trạng thái: </strong>'.$status.$statusPay.'</p>
                          <p align="center">'.$action.'</p> 

                        </div>';
          }
         
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