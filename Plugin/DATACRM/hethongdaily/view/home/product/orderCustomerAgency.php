<?php include(__DIR__.'/../header.php'); ?>

<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/orderCustomerAgency">Đơn hàng lẻ</a> /</span>
    Danh sách đơn hàng
  </h4>

  <p>
    <a href="/addOrderCustomer" class="btn btn-primary"><i class="bx bx-plus"></i> Tạo đơn hàng mới</a> 
    <button type="button" class="btn btn-danger" onclick="copyToClipboard('<?php echo $urlHomes.'info/?id='.$user->id.'&tabShow=products';?>', 'Đã copy thành công link liên kết để khách hàng tự tạo đơn');"><i class="bx bx-link"></i> Liên kết khách hàng tạo đơn</button>
  </p>

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
            <label class="form-label">Trạng thái thanh toán</label>
            <select name="status_pay" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <option value="wait" <?php if(!empty($_GET['status_pay']) && $_GET['status_pay']=='wait') echo 'selected';?> >Chưa thanh toán</option>
              <option value="done" <?php if(!empty($_GET['status_pay']) && $_GET['status_pay']=='done') echo 'selected';?> >Đã thanh toán</option>
            </select>
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
          <?php if($user->id_father==0){ ?>
             <div class="col-md-2">
              <label class="form-label">nhân viên phục trách </label>
              <select name="id_staff" class="form-select color-dropdown">
                <option value="0">chọn nhân viên</option>
                <?php
                if(!empty($listStaff)){
                  foreach($listStaff as $value){
                    $selected = '';
                    if(!empty($_GET['id_staff']) && $_GET['id_staff']==$value->id){
                      $selected = 'selected';
                    }
                    echo '<option '.$selected.' value="'.$value->id.'">'.$value->name.'</option>';
                  }
                }
                ?>
              </select>
          </div>
        <?php   } ?>

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
    <h5 class="card-header">Danh sách đơn hàng - <span class="text-danger"><?php echo number_format($totalMoney);?>đ</span></h5>
    <p>Quy trình: đơn mới -> duyệt đơn -> giao hàng -> hoàn thành</p>
    <div id="desktop_view">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th width="5%">ID</th>
              <th width="15%">Thông tin giao hàng</th>
              <th width="45%" style=" padding: 0; ">
                <table  class="table table-borderless" >
                  <thead>
                    <th colspan="4" class="text-center">Thông tin đơn hàng</th> 
                    <tr>
                      <th width="40%">Sản phẩm</th>
                      <th width="40%">Giá bán</th>
                      <th width="20%">Số lượng</th>
                    </tr>
                  </thead>
                </table>
              </th>
              <th width="10%">Số tiền</th>
               <?php if($user->id_father==0){
                  echo '<th width="10%">Nhân viên phụ trách</th>';
               } ?>
          

              <th width="10%">Trạng thái</th>
              <th width="15%" colspan="2" class="text-center">Xử lý</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            if(!empty($listData)){
              foreach ($listData as $item) {
                $status= '';

                $btnProcess= '';
                $btnPay= '';
                $btnEdit = '';
               /* $btnProcess = '<select class="form-select form-select-sm" id="handle" onchange="actionSelect(this);" name="handle">
                    <option value="">Chọn xử lý</option>';
                  if($item->status_pay=='wait' && $item->status!='cancel'){
                    $btnPay= '<option data-bs-toggle="modal" value="4" data-bs-target="#basicModal'.$item->id.'">Thu tiền</option>';
                  }

                  if($item->status=='new'){ 
                   $status= '<p style="color: #00aeee;">Đơn mới</p>';
                 
                      $btnProcess .= '   <option data-link="/editOrderCustomerAgency/?id='.$item->id.'" value="1">Sửa</option>
                      <option data-link="/updateStatusOrderAgency/?id='.$item->id.'&status=browser&back='.urlencode($urlCurrent).'" value="2">Duyệt</option>
                      <option data-link="/updateStatusOrderAgency/?id='.$item->id.'&status=cancel&back='.urlencode($urlCurrent).'" value="3" onclick="return confirm(\'Bạn có chắc chắn muốn huy không?\');">Hủy</option>'.$btnPay.'</select>';
                 
                 }elseif($item->status=='browser'){
                   $status= '<p style="color: #0333f6;">Đã duyệt</p>';
                   $btnProcess .= '  <option data-link="/updateStatusOrderAgency/?id='.$item->id.'&status=delivery&back='.urlencode($urlCurrent).'" value="2">Giao hàng</option>
                      <option data-link="/updateStatusOrderAgency/?id='.$item->id.'&status=cancel&back='.urlencode($urlCurrent).'" value="3" onclick="return confirm(\'Bạn có chắc chắn muốn huy không?\');">Hủy</option>'.$btnPay.'</select>';
                 }elseif($item->status=='delivery'){
                   $status= '<p style="color: #7503f6;">Đang giao</p>';
                   $btnProcess .= '  <option data-link="updateStatusOrderAgency/?id='.$item->id.'&status=done&back='.urlencode($urlCurrent).'" value="2">Hoàn thành</option>
                      <option data-link="/updateStatusOrderAgency/?id='.$item->id.'&status=cancel&back='.urlencode($urlCurrent).'" value="3" onclick="return confirm(\'Bạn có chắc chắn muốn huy không?\');">Hủy</option>'.$btnPay.'</select>';
                 }elseif($item->status=='done'){
                   $status= '<p style="color: #00ee4b;">Đã xong</p>';
                     if($item->status_pay=='wait'){
                       $btnProcess .= $btnPay.'</select>';
                     }else{
                       $btnProcess= '';
                     }
                     
                 }else{
                   $status= '<p style="color: red;">Đã hủy</p>';
                      $btnProcess= '';
                 }*/
                 if($item->status_pay=='wait' && $item->status!='cancel'){
                  $btnPay= '<br/><br/><a class="btn btn-warning" href="" data-bs-toggle="modal" data-bs-target="#basicModal'.$item->id.'">Thu tiền</a>';
                }

                if($item->status=='new'){ 
                 $status = '<p style="color: #00aeee;">Đơn mới</p>';
                 $btnEdit = '<a class="dropdown-item" href="/editOrderCustomerAgency/?id='.$item->id.'"><i class="bx bx-edit-alt me-1"></i></a> <br/><br/>';

                 $btnProcess= '<a class="btn btn-primary" style="color: #fff;" onclick="updateOrderCustomer('.$item->id.',  \'browser\')">Duyệt</a>  <br/><br/> <a class="btn btn-danger" style="color: #fff;" onclick="updateOrderCustomer('.$item->id.',  \'cancel\')" >Hủy</a>';
                }elseif($item->status=='browser'){
                 $status= '<p style="color: #0333f6;">Đã duyệt</p>';

                 $btnProcess= '<a class="btn btn-primary" style="bacground-color: #7503f6; color: #fff;" onclick="updateOrderCustomer('.$item->id.',  \'delivery\')">Giao hàng</a>  <br/><br/> <a class="btn btn-danger" style="color: #fff;" onclick="updateOrderCustomer('.$item->id.',  \'cancel\')">Hủy</a>';
                }elseif($item->status=='delivery'){
                 $status= '<p style="color: #7503f6;">Đang giao</p>';

                 $btnProcess= '<a class="btn btn-primary" style="bacground-color: #00ee4b; color: #fff;" onclick="updateOrderCustomer('.$item->id.',  \'done\')">Hoàn thành</a>  <br/><br/> <a class="btn btn-danger" style="color: #fff;" onclick="updateOrderCustomer('.$item->id.',  \'cancel\')" >Hủy</a>';
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
                
                echo '<tr>
                <td><a href="/printBillOrderCustomerAgency/?id_order='.$item->id.'" target="_blank">'.$item->id.'</a><br/><br/>'.date('H:i d/m/Y', $item->create_at).'</td>
               
                <td>
                  <a href="/listCustomerAgency/?id='.$item->id_user.'">'.$item->full_name.'</a><br/>
                  '.$item->phone.'<br/>
                  '.$item->address.'<br/>
                  '.$item->email.'
                </td>
               
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
                           $unit = @$value->product->unit;
                              if(!empty($value->id_unit) && !empty($value->product->unitConversion)){
                                foreach($value->product->unitConversion as $keyunti => $value_unit){
                                  if($value->id_unit==$value_unit->id){
                                    $unit = @$value_unit->unit;
                                  }
                                }
                              }

                          echo '<tr> 
                                  <td  width="40%">'.$value->product->title.'</td>
                                  <td  width="40%">'.$showPrice.'</td>
                                  <td  width="20%" align="center">'.number_format($value->quantity).' '.$unit.'</td>
                                </tr>';
                        }
                      } 
                  echo '  </tbody>
                  </table>';

                  if(!empty($item->note_user)){
                    echo '<p style="padding: 20px;"><b>Ghi chú khách hàng</b>: '.$item->note_user.'</p>';
                  }

                  if(!empty($item->note_admin)){
                    echo '<p style="padding: 20px;"><b>Ghi chú admin</b>: '.$item->note_admin.'</p>';
                  }
                echo '</td>
                <td>';
              if(!empty($item->costsIncurred)){
                $costsIncurred =  json_decode($item->costsIncurred, true);
                foreach($costsIncurred as $name => $cost){
                  echo $name.': '.number_format($cost).'đ<br/>';
                }
              }
                 

                echo number_format($item->total).'đ</td>';
                 if($user->id_father==0){
                  echo '<td>';
                  if(!empty($item->staff)){
                    echo $item->staff->name;
                  }

                  echo '</td>';
                 }
                echo '<td align="center"> <span id="status'.@$item->id.'">'.$status.' </span> <span id="statusPay'.@$item->id.'">'.$statusPay.'</span></td>
                <td align="center"> <span id="btnProcess'.@$item->id.'">'.$btnProcess.' </span> <span id="btnPay'.@$item->id.'">'.$btnPay.'</span></td>
                <td align="center"> 
                  <span id="btnEdit'.@$item->id.'">'.$btnEdit.' </span>
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
    </div>
    <div id="mobile_view">
      <?php 
         if(!empty($listData)){
              foreach ($listData as $item) {
                $status= '';
                $btnProcess= '';
                $btnPay= '';

                 if($item->status_pay=='wait' && $item->status!='cancel'){
                  $btnPay= '<br/><br/><a class="btn btn-warning" href="" data-bs-toggle="modal" data-bs-target="#basicModal'.$item->id.'">Thu tiền</a>';
                }

                if($item->status=='new'){ 
                 $status = '<p style="color: #00aeee;">Đơn mới</p>';
                 $btnEdit = '<a class="dropdown-item" href="/editOrderCustomerAgency/?id='.$item->id.'"><i class="bx bx-edit-alt me-1"></i></a> <br/><br/>';

                 $btnProcess= '<a class="btn btn-primary" style="color: #fff;" onclick="updateOrderCustomer('.$item->id.',  \'browser\')">Duyệt</a>  <br/><br/> <a class="btn btn-danger" style="color: #fff;" onclick="updateOrderCustomer('.$item->id.',  \'cancel\')">Hủy</a>';
                }elseif($item->status=='browser'){
                 $status= '<p style="color: #0333f6;">Đã duyệt</p>';

                 $btnProcess= '<a class="btn btn-primary" style="bacground-color: #7503f6; color: #fff;" onclick="updateOrderCustomer('.$item->id.',  \'delivery\')">Giao hàng</a>  <br/><br/> <a class="btn btn-danger" style="color: #fff;" onclick="updateOrderCustomer('.$item->id.',  \'cancel\')">Hủy</a>';
                }elseif($item->status=='delivery'){
                 $status= '<p style="color: #7503f6;">Đang giao</p>';

                 $btnProcess= '<a class="btn btn-primary" style="bacground-color: #00ee4b; color: #fff;" onclick="updateOrderCustomer('.$item->id.',  \'done\')">Hoàn thành</a>  <br/><br/> <a class="btn btn-danger" style="color: #fff;" onclick="updateOrderCustomer('.$item->id.',  \'cancel\')" >Hủy</a>';
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

                  
                echo '<div class="col-sm-12 p-2 m-2 border border-secondary mb-3">
                      <p><strong>ID đơn hàng: </strong><a href="/printBillOrderCustomerAgency/?id_order='.$item->id.'" target="_blank">'.$item->id.'</a></p>
                          <p><strong>Thời gian: </strong>'.date('H:i d/m/Y', $item->create_at).'</p>
                          <p><strong>Thông tin khách hàng: </strong>
                          <a href="/listCustomerAgency/?id='.$item->id_user.'">'.$item->full_name.'</a><br/>
                              '.$item->phone.'<br/>
                              '.$item->address.'<br/>
                              '.$item->email.'
                          </p>
                          <p style=" padding: 0;display: contents; ">
                          <table  class="table">
                            <thead style="border-width: 1px;">
                              <th colspan="4" class="text-center">Thông tin đơn hàng</th> 
                              <tr>
                                <th width="50%" style="padding: 0.625rem 0.4rem; border-width: 1px;">Sản phẩm</th>
                                <th width="30%" style="padding: 0.625rem 0.4rem; border-width: 1px;">Giá bán</th>
                                <th width="10%" style="padding: 0.625rem 0.4rem; border-width: 1px;">Số lượng</th>
                                <th width="10%" style="padding: 0.625rem 0.4rem; border-width: 1px;">Giảm giá</th>
                              </tr>
                            </thead>
                          <tbody style="border-width: 1px;">';
                          if(!empty($item->detail_order)){ 
                            foreach($item->detail_order as $k => $value){
                              $discount= '';                        
                              if($value->discount>100){
                                $discount= number_format($value->discount).'đ';
                              }elseif($value->discount>0){
                                $discount= number_format($value->discount).'%';
                              }

                               $unit = @$value->product->unit;
                              if(!empty($value->id_unit) && !empty($value->product->unitConversion)){
                                foreach($value->product->unitConversion as $keyunti => $value_unit){
                                  if($value->id_unit==$value_unit->id){
                                    $unit = @$value_unit->unit;
                                  }
                                }
                              }

                              echo '<tr> 
                              <td  width="50%" style="padding: 0.625rem 0.4rem; border-width: 1px;">'.$value->product->title.'</td>
                              <td  width="30%" style="padding: 0.625rem 0.4rem; border-width: 1px;">'.number_format($value->price).'đ</td>
                              <td  width="10%" style="padding: 0.625rem 0.4rem; border-width: 1px;">'.$value->quantity.' '.$unit.'</td>
                              <td  width="10%" style="padding: 0.625rem 0.4rem; border-width: 1px;">'.$discount.'</td>
                              </tr>';
                            }
                          } 
                          echo '  </tbody>
                          </table>
                          </p>';
                            if(!empty($item->costsIncurred)){
                              echo  '<p><strong>chi phí phát sinh: </strong><br/>';
                              $costsIncurred =  json_decode($item->costsIncurred, true);
                              foreach($costsIncurred as $name => $cost){
                                echo $name.': '.number_format($cost).'đ<br/>';
                              }
                                echo  '</p>';
                            }

                          if(!empty($item->note_user)){
                            echo '<p style="padding: 20px;"><b>Ghi chú khách hàng</b>: '.$item->note_user.'</p>';
                          }

                          if(!empty($item->note_admin)){
                            echo '<p style="padding: 20px;"><b>Ghi chú admin</b>: '.$item->note_admin.'</p>';
                          }

                          echo'<p><strong>Tổng tiền: </strong>'.number_format($item->total).'</p>

                          <p><strong>Trạng thái: </strong><span id="mobile_status'.@$item->id.'">'.$status.'</spa><span id="mobile_statusPay'.@$item->id.'">'.$statusPay.'</span></p>
                          <p align="center"><span id="mobile_btnProcess'.@$item->id.'">'.$btnProcess.'</spa><span id="mobile_btnPay'.@$item->id.'">'.$btnPay.'</span></p> 
                          <p align="center">
                            <a class="btn btn-secondary" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/deleteOrderCustomerAgency/?id='.$item->id.'">
                              <i class="bx bx-trash me-1"></i> Xóa
                            </a>
                          </p>
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
 <?php 
  if(!empty($listData)){
    foreach ($listData as $items) {?>
      <div class="modal fade" id="basicModal<?php echo $items->id; ?>"  name="id">

        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel1">Thông tin Thanh toán</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-footer" style="display: block;">
              <p><label>ID:</label> <?php echo $items->id ?></p>
              <p><label>Tên khách hàng:</label> <?php echo $items->full_name ?></p>
              <p><label>Điện thoại:</label> <?php echo @$items->customer->phone ?></p>
              <p><label>Email:</label> <?php echo @$items->customer->email ?></p>
                <table class="table table-bordered" style=" text-align: center; ">
                  <thead>
                    <tr>
                      <th >Sản Phẩm</th>
                      <th >Giá bán</th>
                      <th >Số lượng </th>                                                 
                    </tr>
                  </thead>
                  <tbody>
                    <?php  if(!empty($items->detail_order)){ 
                      foreach($items->detail_order as $k => $value){

                       $unit = @$value->product->unit;
                       if(!empty($value->id_unit) && !empty($value->product->unitConversion)){
                        foreach($value->product->unitConversion as $keyunti => $value_unit){
                          if($value->id_unit==$value_unit->id){
                            $unit = @$value_unit->unit;
                          }
                        }
                      }
                        echo '<tr> 
                                <td  width="50%">'.$value->product->title.'</td>
                                <td  width="30%">'.number_format($value->price).'đ</td>
                                <td  width="20%">'.number_format($value->quantity).' '.$unit.'</td>
                              </tr>';
                      }} ?>
                    </tbody>
                </table>
                <p><label>Tổng cộng:</label> <?php echo number_format(@$items->total) ?>đ</p>
                <form id="" action="/updateStatusOrderAgency" class="form-horizontal" method="get" enctype=""> 
                 <div class="" style="display: block;">
                  <div class="row gx-3 gy-2 align-items-center mb-3">
                    <div class="col-md-12">
                      <input type="hidden" value="<?php echo $items->id; ?>"  name="id">
                      <input type="hidden" value="done"  name="status_pay">
                      <!-- <input type="hidden" value="<?php echo urlencode($urlCurrent); ?>"  name="back"> -->
                      <label class="form-label">Chọn hình thức thanh toán</label>
                      <select  name="type_collection_bill" id="type_collection_bill<?php echo $items->id ?>" required="" class="form-select color-dropdown">
                        <option value="">Chọn hình thức thanh toán</option>
                        <option value="tien_mat">Tiền mặt</option>
                        <option value="chuyen_khoan">Chuyển khoản</option>
                        <option value="the_tin_dung">Quẹt thẻ</option>
                        <option value="vi_dien_tu">Ví điện tử</option>
                        <option value="cong_no">Công nợ</option>
                        <option value="hinh_thuc_khac">Hình thức khác</option> 
                      </select>
                      <label class="form-label">Ghi chú</label>
                      <textarea class="form-control phone-mask" rows="3" name="note"></textarea>
                    </div>
                  </div>
                  <button type="button" class="btn btn-primary"  style="color: #fff;" onclick="updateOrderCustomerWait(<?php echo $items->id ?>)">Thanh toán</button>
                </div>
              </form>
              </div>
            </div>
            </div>
          </div>
<?php }} ?>

<script type="text/javascript">
  function actionSelect(select)
{
    var action= select.value;

    console.log(action);
    if(action==3){
       var check= confirm('Bạn có chắc chắn muốn hủy sản phẩm này không?');
      if(check == true){
         var link= $(select).find('option:selected').attr('data-link');
        window.location= link;
      }
    }else if(action==4){ 
       var link= $(select).find('option:selected').attr('data-bs-target');
        $(link).modal('show');
    }else{
       var link= $(select).find('option:selected').attr('data-link');
        window.location= link;
    }  
}


function updateOrderCustomer(id, status){

    if(status=='browser'){
      confirmation = confirm('Bạn có chắc chắn phê duyệt đơn có ID '+id+' không?');
    }else if(status=='delivery'){
      confirmation = confirm('Bạn có chắc chắn xuất kho (đang giao hàng) đơn có ID '+id+' không?');
    }else if(status=='done'){
      confirmation = confirm('Bạn có chắc chắn hoàn thành đơn có ID '+id+' không?');
    }else if(status=='cancel'){
      confirmation = confirm('Bạn có chắc chắn hủy bỏ đơn có ID '+id+' không?');
    }
    if(confirmation == true){
      $.ajax({
          method: "POST",
          url: "/apis/updateStatusOrderAPI",
          data: { 
            id: id,
            status: status,
          }
        }).done(function( msg ) {
            var htmlbtnProcess = '';
            var htmlstatus = '';
            var htmlstatusPay = '';
            var htmlbtnEdit = '';
            var htmlbtnPay = '';

            if (msg.code === 0) {
                 if(msg.status=='new'){ 
                  htmlstatus = '<p style="color: #00aeee;">Đơn mới</p>';
                    htmlbtnProcess= ' <br/><br/> <a class="btn btn-primary"  style="color: #fff;" onclick="updateOrderCustomer('+id+',  \'browser\')" >Duyệt</a> \
                     <br/><br/> <a class="btn btn-danger">Hủy</a>';
                 }else if(msg.status=='browser'){
                   htmlstatus = '<p style="color: #0333f6;">Đã duyệt</p>';
                   htmlbtnProcess= '<a class="btn btn-primary"  style="color: #fff;" onclick="updateOrderCustomer('+id+', \'delivery\')" >Giao hàng</a> <br/><br/> \
                   <a class="btn btn-danger"  style="color: #fff;" onclick="updateOrderCustomer('+id+',  \'cancel\'")">Hủy</a>';
                 }else if(msg.status=='delivery'){
                   htmlstatus = '<p style="color: #7503f6;">Đang giao</p>';
                   htmlbtnProcess= '<a class="btn btn-primary" style="bacground-color: #00ee4b; color: #fff;" onclick="updateOrderCustomer('+id+',  \'done\')">Hoàn thành</a> <br/><br/> <a class="btn btn-danger"  style="color: #fff; style="color: #fff;" onclick="updateOrderCustomer('+id+',  \'cancel\')">Hủy</a>';
                 }else if(msg.status=='done'){
                  htmlstatus = '<p style="color: #00ee4b;">Đã xong</p>';
                 }else{
                   htmlstatus = '<p style="color: red;">Đã hủy</p>';
                 }
                 if(msg.status_pay=='wait'){ 
                   htmlstatusPay= '<p style="color: #00aeee;">Chưa thanh toán</p>';
                 }else if(msg.status_pay=='done'){
                   htmlstatusPay= '<p style="color: #0333f6;">Đã thanh toán</p>';
                 }

                 if(msg.status=='new' && msg.status_pay=='wait'){ 
                    htmlbtnEdit = '<a class="dropdown-item" href="/editOrderMemberAgency/?id='+id+'"><i class="bx bx-edit-alt me-1"></i></a> <br/><br/> <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/deleteOrderMemberAgency/?id='+id+'&back=<?php  echo urlencode($urlCurrent); ?>">\
                    <i class="bx bx-trash me-1"></i></a>';
                }

                if(msg.status_pay=='wait' && msg.status!='cancel'){
                    htmlbtnPay= '<br/><br/><a class="btn btn-warning" href="" data-bs-toggle="modal" data-bs-target="#basicModal'+id+'">Thu tiền</a>';
                  }
                    $('#status'+id).html(htmlstatus);
                    $('#statusPay'+id).html(htmlstatusPay);
                    $('#btnProcess'+id).html(htmlbtnProcess);
                    $('#btnPay'+id).html(htmlbtnPay);
                    $('#btnEdit'+id).html(htmlbtnEdit);
                    $('#mobile_status'+id).html(htmlstatus);
                    $('#mobile_statusPay'+id).html(htmlstatusPay);
                    $('#mobile_btnProcess'+id).html(htmlbtnProcess);
                    $('#mobile_btnPay'+id).html(htmlbtnPay);
            }
        });
      }

  }


  function updateOrderCustomerWait(id){
    var type_collection_bill = $('#type_collection_bill'+id).val();
    var note = $('#note'+id).val();
    confirmation = confirm('Bạn có chắc chắn thanh toán đơn có ID '+id+' không?');

    console.log(type_collection_bill);
    console.log(note);
    console.log(id);
    if(confirmation == true && type_collection_bill !=''){
      $.ajax({
          method: "POST",
          url: "/apis/updateStatusOrderAPI",
          data: { 
            id: id,
            status_pay: 'done',
            note: note,
            type_collection_bill: type_collection_bill,
          }
        }).done(function( msg ) {
            var htmlbtnProcess = '';
            var htmlstatus = '';
            var htmlstatusPay = '';
            var htmlbtnEdit = '';
            var htmlbtnPay = '';
            if (msg.code === 0) {
                 if(msg.status=='new'){ 
                  htmlstatus = '<p style="color: #00aeee;">Đơn mới</p>';
                    htmlbtnProcess= ' <br/><br/> <a class="btn btn-primary"  style="color: #fff;color: #fff;" onclick="updateOrderCustomer('+id+',  \'browser\')" >Duyệt</a> \
                     <br/><br/> <a class="btn btn-danger" style="color: #fff;"  style="color: #fff;" onclick="updateOrderCustomer('+id+',  \'cancel\')"  >Hủy</a>';
                 }else if(msg.status=='browser'){
                   htmlstatus = '<p style="color: #0333f6;">Đã duyệt</p>';
                   htmlbtnProcess= '<a class="btn btn-primary"  style="color: #fff;color: #fff;" onclick="updateOrderCustomer('+id+', \'delivery\')" >Giao hàng</a> <br/><br/> \
                   <a class="btn btn-danger"  style="color: #fff;color: #fff;" onclick="updateOrderCustomer('+id+',  \'cancel\'")">Hủy</a>';
                 }else if(msg.status=='delivery'){
                   htmlstatus = '<p style="color: #7503f6;">Đang giao</p>';
                   htmlbtnProcess= '<a class="btn btn-primary" style="bacground-color: #00ee4b; color: #fff;" onclick="updateOrderCustomer('+id+',  \'done\')">Hoàn thành</a> <br/><br/> <a class="btn btn-danger"  style="color: #fff; style="color: #fff;" onclick="updateOrderCustomer('+id+',  \'cancel\')">Hủy</a>';
                 }else if(msg.status=='done'){
                  htmlstatus = '<p style="color: #00ee4b;">Đã xong</p>';
                 }else{
                   htmlstatus = '<p style="color: red;">Đã hủy</p>';
                 }
                 if(msg.status_pay=='wait'){ 
                   htmlstatusPay= '<p style="color: #00aeee;">Chưa thanh toán</p>';
                 }else if(msg.status_pay=='done'){
                   htmlstatusPay= '<p style="color: #0333f6;">Đã thanh toán</p>';
                 }

                 if(msg.status=='new' && msg.status_pay=='wait'){ 
                    htmlbtnEdit = '<a class="dropdown-item" href="/editOrderMemberAgency/?id='+id+'"><i class="bx bx-edit-alt me-1"></i></a> <br/><br/> <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/deleteOrderMemberAgency/?id='+id+'&back=<?php  echo urlencode($urlCurrent); ?>">\
                    <i class="bx bx-trash me-1"></i></a>';
                }

                if(msg.status_pay=='wait' && msg.status!='cancel'){
                    htmlbtnPay= '<br/><br/><a class="btn btn-warning" href="" data-bs-toggle="modal" data-bs-target="#basicModal'+id+'">Thu tiền</a>';
                  }
                    $('#status'+id).html(htmlstatus);
                    $('#statusPay'+id).html(htmlstatusPay);
                    $('#btnProcess'+id).html(htmlbtnProcess);
                    $('#btnPay'+id).html(htmlbtnPay);
                    $('#btnEdit'+id).html(htmlbtnEdit);
                    $('#mobile_status'+id).html(htmlstatus);
                    $('#mobile_statusPay'+id).html(htmlstatusPay);
                    $('#mobile_btnProcess'+id).html(htmlbtnProcess);
                    $('#mobile_btnPay'+id).html(htmlbtnPay);
                    $('#basicModal'+id).modal('hide');
            }
        });
    }
  }
</script>
<?php include(__DIR__.'/../footer.php'); ?>