<?php include(__DIR__.'/../header.php'); ?>
<style type="text/css">
  .ui-menu{
    z-index: 100000 !important;
  }
</style>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Phiếu thu</h4>
  <p><a class="btn btn-primary"  data-bs-toggle="modal" style="color: white;" data-bs-target="#basicModal" ><i class='bx bx-plus'></i> Thêm mới</a></p>

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
            <label class="form-label">Tên khách hàng</label>
            <input type="text" class="form-control" name="customer_buy" id="customer_buy" value="<?php if(!empty($_GET['customer_buy'])) echo $_GET['customer_buy'];?>">
            <input type="hidden" class="form-control" name="id_customer" id="id_customer" value="<?php if(!empty($_GET['s'])) echo $_GET['id_customer'];?>">
          </div>

          <div class="col-md-3">
            <label class="form-label">Hình thức thanh toán</label>
            <select  name="type_collection_bill" id="type_collection_bill" class="form-select color-dropdown">
              <option value="">Chọn hình thức thanh toán</option>
              <option value="tien_mat" <?php if(!empty($_GET['type_collection_bill']) && $_GET['type_collection_bill']=='tien_mat') echo 'selected'; ?>>Tiền mặt</option>
              <option value="chuyen_khoan" <?php if(!empty($_GET['type_collection_bill']) && $_GET['type_collection_bill']=='chuyen_khoan') echo 'selected'; ?>>Chuyển khoản</option>
              <option value="the_tin_dung" <?php if(!empty($_GET['type_collection_bill']) && $_GET['type_collection_bill']=='the_tin_dung') echo 'selected'; ?>>Quẹt thẻ</option>
              <option value="vi_dien_tu" <?php if(!empty($_GET['type_collection_bill']) && $_GET['type_collection_bill']=='vi_dien_tu') echo 'selected'; ?>>Ví điện tử</option>
              <option value="hinh_thuc_khac" <?php if(!empty($_GET['type_collection_bill']) && $_GET['type_collection_bill']=='hinh_thuc_khac') echo 'selected'; ?>>Hình thức khác</option> 
            </select>
          </div>

          <div class="col-md-2">
            <label class="form-label">Đối tượng thanh toán</label>
            <select  name="type_order" id="type_order" class="form-select color-dropdown">
              <option value="">Chọn đối tượng thanh toán</option>
              <option value="1" <?php if(!empty($_GET['type_order']) && $_GET['type_order']==1) echo 'selected'; ?>>Đại lý</option>
              <option value="2" <?php if(!empty($_GET['type_order']) && $_GET['type_order']==2) echo 'selected'; ?>>Khách hàng</option>
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
    <h5 class="card-header">Danh sách phiếu thu - <span class="text-danger"><?php echo number_format($totalMoney);?>đ</span></h5>
    <?php echo @$mess; ?>
   
    <div id="desktop_view">
      <div class="card-body row">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr class="">
                <th>ID</th>
                <th>Thời gian</th>
                <th>Thông tin</th>
                <th>Đối tượng</th>
                <th>Hình thức</th>
                <th>Số tiền</th>
                <th>Nội dung</th>
                <th>In phiếu</th>
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
                    }elseif($item->type_order==6){
                      $type = 'Hoa hồng đại lý';
                      $link = 'listTransactionAgencyHistorie';
                    }

                    $type_collection_bill;
                    if($item->type_collection_bill=='tien_mat'){
                      $type_collection_bill = 'Tiền mặt';
                    }elseif($item->type_collection_bill=='chuyen_khoan'){
                      $type_collection_bill = 'Chuyển khoản';
                    }elseif($item->type_collection_bill=='the_tin_dung'){
                      $type_collection_bill = 'Thẻ tin dụng';
                    }elseif($item->type_collection_bill=='vi_dien_tu'){
                      $type_collection_bill = 'ví điện tử';
                    }elseif($item->type_collection_bill=='hinh_thuc_khac'){
                      $type_collection_bill = 'hình thức khác';
                    }

                    $info = '';
                    if(!empty($item->member)){
                      $info = 'Tên đại lý: '.$item->member->name.'<br/>
                              Số điện thoại:'.$item->member->phone;
                    }elseif(!empty($item->customer)){
                      $info = 'Tên khách hàng: '.$item->customer->full_name.'<br/>
                              Số điện thoại:'.$item->customer->phone;
                    }

                    $aLink = '';
                  if(!empty($item->id_order)){
                     $aLink ='<a href="'.$link.'" target="_blank">Xem đơn hàng tại đây</a>';
                  }


                    echo '<tr>
                            <td>'.$item->id.'</td>
                            <td>'.date('d/m/Y H:i', $item->created_at).'</td>
                            <td>'.$info.'</td>
                            <td>'.$type.'</td>
                            <td>'.$type_collection_bill.'</td>
                            <td>'.number_format($item->total).'đ</td>
                            <td>'.$item->note.'<br/>
                              '.$aLink.'
                            </td>
                            
                            <td align="center">
                              <a class="dropdown-item" href="/printCollectionBill/?id='.$item->id.'&url=listCollectionBill">
                                <i class="bx  bx-printer me-1"></i>
                              </a>
                              </a>
                            </td>
                          </tr>';
                  }
                }else{
                  echo '<tr>
                          <td colspan="10" align="center">Chưa có phiếu thu nào</td>
                        </tr>';
                }
              ?>
            </tbody>

          </table>
        </div>
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
                  }elseif($item->type_order==6){
                      $type = 'Hoa hồng đại lý';
                      $link = 'listTransactionAgencyHistorie';
                    }

                  $type_collection_bill;
                  if($item->type_collection_bill=='tien_mat'){
                    $type_collection_bill = 'Tiền mặt';
                  }elseif($item->type_collection_bill=='chuyen_khoan'){
                    $type_collection_bill = 'Chuyển khoản';
                  }elseif($item->type_collection_bill=='the_tin_dung'){
                    $type_collection_bill = 'Thẻ tín dụng';
                  }elseif($item->type_collection_bill=='vi_dien_tu'){
                    $type_collection_bill = 'Ví điện tử';
                  }elseif($item->type_collection_bill=='hinh_thuc_khac'){
                    $type_collection_bill = 'Hình thức khác';
                  }

                  $info = '';
                  if(!empty($item->member)){
                    $info = 'Tên đại lý: '.$item->member->name.'<br/>
                            Số điện thoại:'.$item->member->phone;
                  }elseif(!empty($item->customer)){
                    $info = 'Tên khách hàng: '.$item->customer->full_name.'<br/>
                            Số điện thoại:'.$item->customer->phone;
                  }
                  $aLink = '';
                  if(!empty($item->id_order)){
                     $aLink ='<a href="'.$link.'" target="_blank">Xem đơn hàng tại đây</a>';
                  }
                  
                echo '<div class="col-sm-12 p-2 m-2 border border-secondary mb-3">
                        <p><strong>ID: </strong>'.$item->id.'</p>
                        <p><strong>Thời gian: </strong>'.date('d/m/Y H:i', $item->created_at).'</p>
                        <p><strong>Thông tin: </strong>'.$info.'</p>
                        <p><strong>Đối tượng: </strong>'.$type.'</p>
                        <p><strong>Hình thức thanh toán: </strong>'.$type_collection_bill.'</p>
                        <p><strong>Số tiền: </strong>'.number_format($item->total).'đ</p>
                        <p><strong>Nội dung: </strong>'.$item->note.'<br/>
                          '.$aLink.'
                        </p>

                          <p align="center">
                          <a class="btn btn-success" href="/printCollectionBill/?id='.$item->id.'&url=listCollectionBill">
                            <i class="bx  bx-printer me-1"></i>
                          </a>
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
  </div>
    <div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div  class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header form-label border-bottom">
          <h5 class="modal-title" id="exampleModalLabel1">Thêm mới phiếu thu</h5>
          <button type="button" class="btn-close"data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="addCollectionBill" method="GET">
          <div class=" modal-body row">
            <div class="col-md-12">
              <label for="full_name" class="form-label">Đối tượng đặt hàng (*)</label><br/>
              <input type="radio" id="typeUser" name="typeUser" value="customer" checked /> Khách lẻ 
              &nbsp;&nbsp;&nbsp;
              <input type="radio" id="typeUser" name="typeUser" value="member" /> Đại lý 
               &nbsp;&nbsp;&nbsp;
              <input type="radio" id="typeUser" name="typeUser" value="none" /> Không phải là đối tượng nào 
            </div>
            <div class="col-md-12" id="member"  style="display: none;">
              <label class="form-label">Đại lý</label>
              <input type="text" value="" id="namemember_buy" class="form-control" placeholder="" name="namemember_buy">
              <input type="hidden" value="" id="idmember_buy" class="form-control" placeholder="" name="idmember_buy">
            </div>
            <div class="col-md-12" id="customer">
              <label class="form-label">Khách hàng </label>
              <input type="text" value="" id="name_customer_buy" class="form-control" placeholder="" name="name_customer_buy">
              <input type="hidden" value="" id="id_customer_buy" class="form-control" placeholder="" name="id_customer_buy">
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
            <div class="col-md-12 mb-3">
              <label class="form-label">Nội dung thu tiền </label>
              <textarea  class="form-control" rows="5" name="note"></textarea>
            </div>
            <div class="col-md-4">
              <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--/ Responsive Table -->
</div>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@3.10.5/dist/locale-all.min.js'></script>
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

<script type="text/javascript">
    // tìm sản phẩm
    $(function() {
        function split( val ) {
          return val.split( /,\s*/ );
        }

        function extractLast( term ) {
          return split( term ).pop();
        }

         //  tìm kiếm cho from thêm 
        $( "#namemember_buy" )
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
                
                $( "#namemember_buy" ).val(ui.item.name);
                $( "#idmember_buy" ).val(ui.item.id);

                return false;
            }
        });

        $( "#name_customer_buy" )
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
                
                $( "#name_customer_buy" ).val(ui.item.full_name);
                $( "#id_customer_buy" ).val(ui.item.id);

                return false;
            }
        });


    });
</script>

<script>
  document.querySelectorAll('input[name="typeUser"]').forEach((elem) => {
    elem.addEventListener("change", (event) => {
      var typeUser = $('input[name="typeUser"]:checked').val();

      $('#customer').hide();
      $('#member').hide();

      if(typeUser == 'member'){
        $('#member').show();
      }else if(typeUser == 'customer'){
        $('#customer').show();
       
      }else{
        $('#customer').hide();
        $('#member').hide();
      }
    });
  });
</script>

<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css"> -->
<!-- <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> -->
<?php include(__DIR__.'/../footer.php'); ?>s