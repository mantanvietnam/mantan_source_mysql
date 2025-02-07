<?php include(__DIR__.'/../header.php'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Hoa hồng cho nhân viên</h4>
  <p><a href="/addCustomer" class="btn btn-primary" ><i class='bx bx-plus'></i> Thêm mới</a></p>

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
            <label class="form-label">nhân viên</label>

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
          <div class="col-md-2">
            <label class="form-label">Tạo từ ngày</label>
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
  <div class="card">

    <div class="row">
      <div class="col-md-6">
        <h5 class="card-header">Danh sách hoa hồng cho nhân viên</h5>
      </div>
      <div class="col-md-6">
        <h5 class="card-header" style="float: right;">Tổng tiền hoa hồng - <b class="text-danger"><?php echo number_format($totalMoney);?>đ</b> </h5>
      </div>
    </div>
    <div class="card-body row">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="" align="center">
              <th>ID</th>
              <th>nhân viên</th>
              <th>thông tin khách hàng</th>
              <th>Thời gian</th>
              <th>Hoa hồng</th>
              <th>Dịch vụ </th>
              <th>ID đơn</th>
              <th>Loại</th>
              <th>Trạnh thái</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            if(!empty($listData)){
              foreach ($listData as $item) {
                $status = '<span class="text-success">Đã thanh toán</span>';
                if($item->status ==0){
                  $status = '<span class="text-danger">Chưa thanh toán</span>

                  <a class="dropdown-item"  data-bs-toggle="modal" data-bs-target="#basicModal'.$item->id.'">
                  <i class="bx bxs-credit-card"></i>
                  </a>';
                }

                echo '<tr>
                <td>'.$item->id.'</td>

                <td>'.$item->staff->name.'</td>
                <td>'.@$item->order->customer->name.'<br/>
                '.@$item->order->customer->phone.'
                </td>
                <td>'.date('H:i d/m/Y', @$item->created_at).'</td>
                <td>'.number_format($item->money).'đ</td>
                <td>'.@$item->service.'</td>
                <td>'.@$item->id_order.'</td>
                <td>'.@$item->type.'</td>
                <td>'.$status.'</td>
                </tr>';
              }
            }else{
              echo '<tr>
              <td colspan="10" align="center">Chưa có khách hàng</td>
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
  </div>
  <!--/ Responsive Table -->
</div>
<?php  if(!empty($listData)){
      foreach ($listData as $items) {
       $type = '';
       if($items->type_order==1){
        $type = 'Đại lý';
      }elseif($items->type_order==2){
        $type = 'Khách hàng';
      }

      $info = '';
      if(!empty($items->staff)){
        $info = '<p><label class="form-label">Tên người tiếp thị:</label> '.$items->staff->name.'</p>
        <p><label class="form-label">Số điện thoại:</label> '.$items->staff->phone.'</p>';
      }


  ?>
  <div class="modal fade" id="basicModal<?php echo $items->id; ?>"  name="id">

    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header form-label border-bottom">
          <h5 class="modal-title" id="exampleModalLabel1">Thanh toán tiền hoa hồng cho nhân viên  </h5>
          <button type="button" class="btn-close"data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="payAgency" method="GET">
         <div class="modal-footer">
          <input type="hidden" value="<?php echo $items->id; ?>"  name="id">
          <div class="card-body">
            <div class="row gx-3 gy-2 align-items-center">
              <div class="col-md-12">
                <?php echo $info; ?>
                <p><label class="form-label">Số tiền thanh thoán:</label> <?php echo number_format($items->money) ?> đ</p>

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



<script type="text/javascript">
    // tìm khách hàng 
    $(function() {
      function split( val ) {
        return val.split( /,\s*/ );
      }

      function extractLast( term ) {
        return split( term ).pop();
      }

      $( "#full_name" )
        // don't navigate away from the field on tab when selecting an item
        .bind( "keydown", function( event ) {
          if ( event.keyCode === $.ui.keyCode.TAB && $( this ).autocomplete( "instance" ).menu.active ) {
            event.preventDefault();
          }

          $('#id_staff').val(0);
        })
        .autocomplete({
          source: function( request, response ) {
            $.getJSON( "/apis/searchStaffApi", {
              key: extractLast( request.term )
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

                $('#full_name').val(ui.item.label);
                $('#id_staff').val(ui.item.id);

                return false;

                
              }
            });
      });
    </script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <?php include(__DIR__.'/../footer.php'); ?>