<?php include(__DIR__.'/../header.php'); ?>

<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/orderMemberAgency">Đơn hàng đại lý</a> /</span>
    Danh sách đơn hàng
  </h4>

  <?php 
  if($user->create_order_agency == 1){
    echo '<p>
            <a href="/addOrderAgency" class="btn btn-primary"><i class="bx bx-plus"></i> Tạo đơn hàng mới</a> 
            <button type="button" class="btn btn-danger" onclick="copyToClipboard(\''.$urlHomes.'info/?id='.$user->id.'&tabShow=productAgency\', \'Đã copy thành công link liên kết để đại lý tự tạo đơn\');"><i class="bx bx-link"></i> Liên kết đại lý tạo đơn</button>
          </p>';
  }
  ?>

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
            <label class="form-label">Tên/Điện thoại đại lý</label>
            <input type="text" class="form-control" name="phone" id="phone" value="<?php if(!empty($_GET['phone'])) echo $_GET['phone'];?>">
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
    <h5 class="card-header">Danh sách đơn hàng đại lý - <span class="text-danger"><?php echo number_format($totalMoney);?>đ</span></h5>
    <p>Quy trình: đơn mới -> duyệt đơn -> giao hàng -> hoàn thành -> thu tiền</p>
    <div id="desktop_view">
      <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr class="">
                <th width="5%">ID</th>
                <th width="10%">Đại lý mua</th>
                <th width="40%" style=" padding: 0; ">
                  <table  class="table table-borderless" >
                    <thead>
                      <th colspan="4" class="text-center">Thông tin đơn hàng</th> 
                      <tr>
                        <th width="40%">Sản phẩm</th>
                        <th width="40%">Giá bán</th>
                        <th width="20%">Số lượng </th>
                      </tr>
                    </thead>
                  </table>
                </th>
                <th width="10%">Chi phí phát sinh</th>
                <th width="10%">Tổng tiền</th>
                <th width="10%">Chiết khấu</th>
                <th width="10%">Trạng thái</th>
                <th width="12%" colspan="2" class="text-center">Xử lý</th>
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

                  if($item->status_pay=='wait' && $item->status!='cancel'){
                    $btnPay= '<br/><br/><a class="btn btn-warning" href="" data-bs-toggle="modal" data-bs-target="#basicModal'.$item->id.'">Thu tiền</a>';
                  }

                  if($item->status=='new'){ 
                   $status= '<p style="color: #00aeee;">Đơn mới</p>';
                  
                   $btnProcess= ' <br/><br/> <a class="btn btn-primary" style="color: #fff;" onclick="updateOrderMemberAgency('.$item->id.', \'browser\')" >Duyệt</a> 
                   <br/><br/> <a class="btn btn-danger" style="color: #fff;" onclick="updateOrderMemberAgency('.$item->id.', \'cancel\')">Hủy</a>';
                 }elseif($item->status=='browser'){

                   $status= '<p style="color: #0333f6;">Đã duyệt</p>';
                   $btnProcess= '<a class="btn btn-primary" style="bacground-color: #7503f6; color: #fff;" onclick="updateOrderMemberAgency('.$item->id.', \'delivery\')">Giao hàng </a> <br/><br/> 
                   <a class="btn btn-danger"  style="color: #fff;"  onclick="updateOrderMemberAgency('.$item->id.', \'cancel\')" \>Hủy</a>';
                 }elseif($item->status=='delivery'){
                   $status= '<p style="color: #7503f6;">Đang giao</p>';
                   $btnProcess= '<a class="btn btn-primary"  style="color: #fff;"  onclick="updateOrderMemberAgency('.$item->id.', \'done\')">Hoàn thành</a> <br/><br/> <a class="btn btn-danger"  style="color: #fff;"  onclick="updateOrderMemberAgency('.$item->id.', \'cancel\')">Hủy</a>';
                 }elseif($item->status=='done'){
                   $status= '<p style="color: #00ee4b;">Đã xong</p>';
                 }else{
                   $status= '<p style="color: red;">Đã hủy</p>';
                 }

                if($item->status=='new' && $item->status_pay=='wait'){ 
                     $btnEdit = '<a class="dropdown-item"   href="/editOrderMemberAgency/?id='.$item->id.'"><i class="bx bx-edit-alt me-1"></i></a> <br/><br/> <a class="dropdown-item"  onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/deleteOrderMemberAgency/?id='.$item->id.'&back='.urlencode($urlCurrent).'""><i class="bx bx-trash me-1"></i></a>';
                }

                 $statusPay= '';
                 if($item->status_pay=='wait'){ 
                   $statusPay= '<p style="color: #00aeee;">Chưa thanh toán</p>';
                 }elseif($item->status_pay=='done'){
                   $statusPay= '<p style="color: #0333f6;">Đã thanh toán</p>';
                 }

                 $showMoney = number_format($item->total).'đ';
                 if($item->money > 0 && $item->money!=$item->total){
                  $showMoney .= '<br/><del>'.number_format($item->money).'đ</del>';
                }



                echo '<tr>
                <td><a href="/printBillOrderMemberAgency/?id_order_member='.$item->id.'" target="_blank">'.$item->id.'</a><br/><br/>'.date('H:i d/m/Y', $item->create_at).'</td>
                <td>
                '.$item->buyer->name.'<br/>
                '.$item->buyer->phone.'
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

                        $unit = @$value->product->unit;
                        if(!empty($value->id_unit) && !empty($value->product->unitConversion)){
                            foreach($value->product->unitConversion as $keyunti => $value_unit){
                              if($value->id_unit==$value_unit->id){
                                 $unit = @$value_unit->unit;
                              }
                            }
                        }

                        if($priceBuy != $priceOld){
                          $showPrice = number_format($priceBuy).'đ<br/><del>'.number_format($priceOld).'đ</del><br/><br/>Giảm <b>'.$showDiscount.'</b> mỗi sản phẩm';
                        }else{
                          $showPrice = number_format($priceBuy).'đ';
                        }

                        echo '<tr> 
                                <td  width="40%">'.$value->product->title.'</td>
                                <td  width="40%">'.$showPrice.'</td>
                                <td  width="20%" align="center">'.number_format($value->quantity).' '.@$unit.'</td>
                              </tr>';
                  }
                } 
                echo '  </tbody>
                </table>
                </td>
                <td>';
              if(!empty($item->costsIncurred)){
                $costsIncurred =  json_decode($item->costsIncurred, true);
                foreach($costsIncurred as $name => $cost){
                  echo $name.': '.number_format($cost).'đ<br/>';
                }
              }
                 

                echo '</td>
                <td>'.$showMoney.'</td>

                <td>'.$item->discount.'%</td>

                <td align="center"> <span id="status'.@$item->id.'">'.$status.' </span> <span id="statusPay'.@$item->id.'">'.$statusPay.'</span></td>
                <td align="center"> <span id="btnProcess'.@$item->id.'">'.$btnProcess.' </span> <span id="btnPay'.@$item->id.'">'.$btnPay.'</span></td>
                <td align="center"> <span id="btnEdit'.@$item->id.'">'.$btnEdit.' </span></td>
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
                   $status= '<p style="color: #00aeee;">Đơn mới</p>';
                   $btnProcess= '<a class="btn btn-info"  style="color: #fff;" href="/editOrderMemberAgency/?id='.$item->id.'">sửa</a>  <a class="btn btn-primary"  style="color: #fff;" onclick="updateOrderMemberAgency('.$item->id.', \'browser\')" >Duyệt</a>  <a class="btn btn-danger"  style="color: #fff;"  style="color: #fff;" onclick="updateOrderMemberAgency('.$item->id.', \'cancel\')" >Hủy</a>';
                 }elseif($item->status=='browser'){
                   $status= '<p style="color: #0333f6;">Đã duyệt</p>';
                   $btnProcess= '<a class="btn btn-primary" style="bacground-color: #7503f6; color: #fff;" onclick="updateOrderMemberAgency('.$item->id.', \'delivery\')">Giao hàng</a>  <a class="btn btn-danger" style="color: #fff;"  style="color: #fff;" onclick="updateOrderMemberAgency('.$item->id.', \'cancel\')">Hủy</a>';
                 }elseif($item->status=='delivery'){
                   $status= '<p style="color: #7503f6;">Đang giao</p>';
                   $btnProcess= '<a class="btn btn-primary" style="bacground-color: #00ee4b; color: #fff;" onclick="updateOrderMemberAgency('.$item->id.', \'done\')" >Hoàn thành</a>  <a class="btn btn-danger"  style="color: #fff;" onclick="updateOrderMemberAgency('.$item->id.', \'cancel\')">Hủy</a>';
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

                 $showMoney = number_format($item->total).'đ';
                 if($item->money > 0 && $item->money!=$item->total){
                  $showMoney .= '<br/><del>'.number_format($item->money).'đ</del>';
                }

               

                  
                echo '<div class="col-sm-12 p-2 m-2 border border-secondary mb-3">
                      <p><strong>ID đơn hàng: </strong><a href="/printBillOrderMemberAgency/?id_order_member='.$item->id.'" target="_blank">'.$item->id.'</a></p>
                          <p><strong>Thời gian: </strong>'.date('H:i d/m/Y', $item->create_at).'</p>
                          <p><strong>Thông tin đại lý: </strong>
                          '.$item->buyer->name.'<br/>
                          '.$item->buyer->phone.'
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
                              <td  width="10%" style="padding: 0.625rem 0.4rem; border-width: 1px;">'.number_format($value->quantity).' '.$unit.'</td>
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

                          echo'<p><strong>Tổng tiền: </strong>'.$showMoney.'</p>

                          <p><strong>chiếu khấu: </strong>'.$item->discount.'%</p>

                          <p><strong>Trạng thái: </strong><span id="mobile_status'.@$item->id.'">'.$status.'</spa><span id="mobile_statusPay'.@$item->id.'">'.$statusPay.'</span></p>
                          <p align="center"><span id="mobile_btnProcess'.@$item->id.'">'.$btnProcess.'</spa><span id="mobile_btnPay'.@$item->id.'">'.$btnPay.'</span></p> 

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
              <p><label>Tên khách hàng:</label> <?php echo $items->buyer->full_name ?></p>
              <p><label>Điện thoại:</label> <?php echo @$items->buyer->phone ?></p>
              <p><label>Email:</label> <?php echo @$items->buyer->email ?></p>
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
                                <td  width="20%">'.$value->quantity.' '.$unit.'</td>
                              </tr>';
                      }} ?>
                    </tbody>
                </table>
                <p><label>Thành tiền:</label> <?php echo number_format(@$items->money) ?>đ</p>
                <p><label>Giảm:</label> <?php echo number_format(@$items->money-$items->total) ?>đ</p>
                <p><label>Tổng cộng:</label> <?php echo number_format(@$items->total) ?>đ</p>
                <form id="" action="/updateOrderMemberAgency" class="form-horizontal" method="get" enctype=""> 
                 <div class="" style="display: block;">
                  <div class="row gx-3 gy-2 align-items-center mb-3">
                    <div class="col-md-12">
                      <input type="hidden" value="<?php echo $items->id; ?>"  name="id" id="id<?php echo $items->id; ?>">
                      <input type="hidden" value="done"  name="status_pay">
                      <!-- <input type="hidden" value="<?php echo urlencode($urlCurrent); ?>"  name="back"> -->
                      <label class="form-label">Chọn hình thức thanh toán</label>
                      <select  name="type_collection_bill" id="type_collection_bill<?php echo $items->id; ?>" required="" class="form-select color-dropdown">
                        <option value="">Chọn hình thức thanh toán</option>
                        <option value="tien_mat">Tiền mặt</option>
                        <option value="chuyen_khoan">Chuyển khoản</option>
                        <option value="the_tin_dung">Quẹt thẻ</option>
                        <option value="vi_dien_tu">Ví điện tử</option>
                        <option value="cong_no">Công nợ</option>
                        <option value="hinh_thuc_khac">Hình thức khác</option> 
                      </select>
                      <label class="form-label">Ghi chú</label>
                      <textarea class="form-control phone-mask" rows="3" id="note<?php echo $items->id; ?>" name="note"></textarea>
                    </div>
                  </div>
                  <button type="button" class="btn btn-primary " onclick="updateOrderMemberWait(<?php echo $items->id; ?>)">Thanh toán</button>
                </div>
              </form>
              </div>
            </div>
            </div>
          </div>
<?php }} ?>
<script type="text/javascript">
    // tìm sản phẩm
    $(function() {
        function split( val ) {
          return val.split( /,\s*/ );
        }

        function extractLast( term ) {
          return split( term ).pop();
        }

        $( "#phone" )
        // don't navigate away from the field on tab when selecting an item
        .bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB && $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }
        })
        .autocomplete({
            source: function( request, response ) {
                $.getJSON( "/apis/searchMemberAPI", {
                    term: extractLast( request.term )
                }, response );
            },
            search: function() {
                // custom minLength
                var term = extractLast( this.value );

                if ( term.length < 2 ) {
                    return false;
                }
            },
            focus: function() {
                // prevent value inserted on focus
                return false;
            },
            select: function( event, ui ) {
                var terms = split( this.value );
                // remove the current input
                terms.pop();
                // add the selected item
                terms.push( ui.item.label );
                
                $( "#phone" ).val(ui.item.phone);

                return false;
            }
        });
    });

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

  function updateOrderMemberAgency(id, status){

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
          url: "/apis/updateStatusOrderMemberAPI",
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
                    htmlbtnProcess= ' <br/><br/> <a class="btn btn-primary"  style="color: #fff;"  onclick="updateOrderMemberAgency('+id+',  \'browser\')" >Duyệt</a> \
                     <br/><br/> <a class="btn btn-danger">Hủy</a>';
                 }else if(msg.status=='browser'){
                   htmlstatus = '<p style="color: #0333f6;">Đã duyệt</p>';
                   htmlbtnProcess= '<a class="btn btn-primary"  style="color: #fff;"  onclick="updateOrderMemberAgency('+id+', \'delivery\')" >Giao hàng</a> <br/><br/> \
                   <a class="btn btn-danger"  style="color: #fff;"  onclick="updateOrderMemberAgency('+id+',  \'cancel\'")">Hủy</a>';
                 }else if(msg.status=='delivery'){
                   htmlstatus = '<p style="color: #7503f6;">Đang giao</p>';
                   htmlbtnProcess= '<a class="btn btn-primary" style="bacground-color: #00ee4b; color: #fff" onclick="updateOrderMemberAgency('+id+',  \'done\')">Hoàn thành</a> <br/><br/> <a class="btn btn-danger"  style="color: #fff;" onclick="updateOrderMemberAgency('+id+',  \'cancel\')">Hủy</a>';
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


  function updateOrderMemberWait(id){
    var type_collection_bill = $('#type_collection_bill'+id).val();
    var note = $('#note'+id).val();
    confirmation = confirm('Bạn có chắc chắn thanh toán đơn có ID '+id+' không?');
    if(confirmation == true && type_collection_bill !=''){
      $.ajax({
          method: "POST",
          url: "/apis/updateStatusOrderMemberAPI",
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
                    htmlbtnProcess= ' <br/><br/> <a class="btn btn-primary"  style="color: #fff;"  onclick="updateOrderMemberAgency('+id+',  \'browser\')" >Duyệt</a> \
                     <br/><br/> <a class="btn btn-danger" style="color: #fff;"   onclick="updateOrderMemberAgency('+id+',  \'cancel\')"  >Hủy</a>';
                 }else if(msg.status=='browser'){
                   htmlstatus = '<p style="color: #0333f6;">Đã duyệt</p>';
                   htmlbtnProcess= '<a class="btn btn-primary"  style="color: #fff;"  onclick="updateOrderMemberAgency('+id+', \'delivery\')" >Giao hàng</a> <br/><br/> \
                   <a class="btn btn-danger"  style="color: #fff;"  onclick="updateOrderMemberAgency('+id+',  \'cancel\'")">Hủy</a>';
                 }else if(msg.status=='delivery'){
                   htmlstatus = '<p style="color: #7503f6;">Đang giao</p>';
                   htmlbtnProcess= '<a class="btn btn-primary" style="bacground-color: #00ee4b; color: #fff" onclick="updateOrderMemberAgency('+id+',  \'done\')">Hoàn thành</a> <br/><br/> <a class="btn btn-danger"  style="color: #fff;" onclick="updateOrderMemberAgency('+id+',  \'cancel\')">Hủy</a>';
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