<?php include(__DIR__.'/../header.php');
global $type_collection_bill;
 ?>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Công nợ phải thu</h4>
  <!-- /<p><a href="/addCollectionDebt"  class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p> -->

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
    <h5 class="card-header">Danh sách công nợ phải thu</h5>
    
    <div class="card-body row">
      <?php echo @$mess; ?>
      <div id="desktop_view">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr class="">
                <th>ID</th>
                <th>Thời gian</th>
                <th>Thông tin</th>
                <th>đối tượng</th>
                <th>Số tiền </th>
                <th>Số lần thu</th>
                <th>Nội dung</th>
                <!-- <th>Sửa</th> -->
                <th >Thu</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                if(!empty($listData)){
                  foreach ($listData as $item) {
                     $type = '';
                    $link= '';
                    if($item->type_order==1){
                      $type = 'Đại lý';
                      $link = '/orderMemberAgency?id='.$item->id_order;
                    }elseif($item->type_order==2){
                      $type = 'Khách hàng';
                      $link = '/orderCustomerAgency?id='.$item->id_order;
                    }

                    $status = ' <td align="center" colspan="2" class="text-success" >Đã thu xong';
                    if($item->status==0){
                      $status = '
                      <td align="center">
                        <p class="text-danger">Chưa thu xong</p>
                        <a class="btn btn-danger" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#basicModal'.$item->id.'" >Thu tiền</a>
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
                            Số tiền đã thu: '.number_format($item->total_payment).'đ<br/>
                            Số tiền còn : '.number_format($item->total-$item->total_payment).'đ<br/>
                            </td>
                            <td align="center"><a href="/listCollectionBill?id_debt='.$item->id.'" title="chi tiết">'.$item->number_payment.'</a></td>
                            <td>'.$item->note.'<br/>
                              <a href="'.$link.'" target="_blank">Xem đơn hàng tại đây</a></td>
                            '.$status.'
                          </tr>';
                  }
                }else{
                  echo '<tr>
                          <td colspan="10" align="center">Chưa có công nợ thu nào</td>
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
               $type = '';
                    $link= '';
                    if($item->type_order==1){
                      $type = 'Đại lý';
                      $link = '/orderMemberAgency?id='.$item->id_order;
                    }elseif($item->type_order==2){
                      $type = 'Khách hàng';
                      $link = '/orderCustomerAgency?id='.$item->id_order;
                    }

                    $status = '<p class="text-center text-success">Đã thu xong</p>';
                    if($item->status==0){
                      $status = '
                                  <p class="text-center text-danger">Chưa thu xong</p>
                                  <p class="text-center">
                                    <a class="btn btn-danger" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#basicModal'.$item->id.'" >Thu tiền</a>
                                  </p>
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
                echo '<div class="col-sm-12 p-2 m-2 border border-secondary mb-3">
                        <p><strong>ID: </strong>'.$item->id.'</p>
                        <p><strong>Thời gian: </strong>'.date('d/m/Y H:i', $item->created_at).'</p>
                        <p><strong>Thông tin: </strong>'.$info.'</p>
                        <p><strong>Đối tượng: </strong>'.$type.'</p>
                        <p><strong>Số tiền Nợ: </strong>'.number_format($item->total).'đ</p>
                        <p><strong>Số tiền đã thu: </strong>'.number_format($item->total_payment).'đ</p>
                        <p><strong>Số tiền còn: </strong>'.number_format($item->total-$item->total_payment).'đ</p>
                        <p><strong>Số lần thu: </strong><a href="/listCollectionBill?id_debt='.$item->id.'" title="chi tiết">'.$item->number_payment.'</a></p>
                        <p><strong>Nội dung: </strong>'.$item->note.'<br/>
                              <a href="'.$link.'" target="_blank">Xem đơn hàng tại đây</a></p>
                              '.$status.'

                        </div>';
          }
         
        }else{
          echo '<div class="col-sm-12 item">
                  <p class="text-danger">Chưa có dữ liệu</p>
                </div>';
        }
      ?>
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
              foreach ($listData as $items) {
                 $type = '';
                  if($items->type_order==1){
                    $type = 'Đại lý';
                  }elseif($items->type_order==2){
                    $type = 'Khách hàng';
                  }

                   $info = '';
                  if(!empty($items->member)){
                    $info = '<p><label class="form-label">Tên đại lý nợ:</label> '.$items->member->name.'</p>
                            <p><label class="form-label">Số điện thoại:</label> '.$items->member->phone.'</p>';
                  }elseif(!empty($item->customer)){
                    $info = '<p><label class="form-label">Tên khách hàng nợ:</label> '.$items->customer->full_name.'</p>
                            <p><label class="form-label">Số điện thoại:</label> '.$items->customer->phone.'</p>';
                  }


               ?>
                        <div class="modal fade" id="basicModal<?php echo $items->id; ?>"  name="id">
                                
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header form-label border-bottom">
                                <h5 class="modal-title" id="exampleModalLabel1">Thanh toán công nợ của <?php echo $type; ?> </h5>
                                <button type="button" class="btn-close"data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                             <form action="paymentCollectionBill" method="GET">
                               <div class="modal-footer">
                                <input type="hidden" value="<?php echo $items->id; ?>"  name="id">
                                <div class="card-body">
                                  <div class="row gx-3 gy-2 align-items-center">
                                    <div class="col-md-12">
                                      <?php echo $info; ?>
                                      <p><label class="form-label">Số tiền Nợ:</label> <?php echo number_format($items->total) ?> đ</p>
                                      <p><label class="form-label">Số tiền đã thu:</label> <?php echo number_format($items->total_payment) ?> đ</p>
                                      <p><label class="form-label">Số tiền còn:</label> <?php echo number_format($items->total-$items->total_payment) ?> đ</p>
                                      <p><label class="form-label">Số lần đã thu:</label> <?php echo $items->number_payment ?> lần</p>
                                    </div>
                                    
                                    <div class="col-md-12">
                                      <label class="form-label">Số tiền thu</label>
                                      <input type="number" value="" class="form-control" placeholder="" name="total">
                                    </div>
                                    <div class="col-md-12">
                                      <label class="form-label">Hình thức thanh toán</label>
                                      <select name="type_collection_bill" class="form-select color-dropdown" required>
                                        <option value="">Chọn hình thức thanh toán</option>
                                        <option value="tien_mat">Tiền mặt</option>
                                        <option value="chuyen_khoan">Chuyển khoản</option>
                                        <option value="the_tin_dung">Quẹt thẻ</option>
                                        <option value="vi_dien_tu">Ví điện tử</option>
                                        <option value="hinh_thuc_khac">Hình thức khác</option>
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
<script type="text/javascript">
    // tìm sản phẩm
    $(function() {
        function split( val ) {
          return val.split( /,\s*/ );
        }

        function extractLast( term ) {
          return split( term ).pop();
        }


        //  tìm kiếm cho from tìm khiếm 
        $( "#member_buy" )
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
                console.log(term);
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
                
                $( "#member_buy" ).val(ui.item.name);
                $( "#id_member_buy" ).val(ui.item.id);

                return false;
            }
        });

        $( "#customer_buy" )
        // don't navigate away from the field on tab when selecting an item
        .bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB && $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }
        })
        .autocomplete({
            source: function( request, response ) {
                $.getJSON( "/apis/searchCustomerAPI", {
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
                
                $( "#customer_buy" ).val(ui.item.full_name);
                $( "#id_customer" ).val(ui.item.id);

                return false;
            }
        });


    });
</script>
<?php include(__DIR__.'/../footer.php'); ?>