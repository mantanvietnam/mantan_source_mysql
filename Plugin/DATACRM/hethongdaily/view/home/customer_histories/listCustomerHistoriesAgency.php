<?php include(__DIR__.'/../header.php'); ?>

<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/orderCustomerAgency">Khách hàng</a> /</span>
    Lịch sử chăm sóc khách hàng
  </h4>

  <p><a href="/addCustomerHistoriesAgency" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p>

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
            <input type="text" class="form-control" name="name_customer" id="name_customer" value="<?php if(!empty($_GET['name_customer'])) echo $_GET['name_customer'];?>">
            <input type="hidden" class="form-control" name="id_customer" id="id_customer" value="<?php if(!empty($_GET['id_customer'])) echo $_GET['id_customer'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Hành động chăm sóc</label>
            <select name="action_now" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <option value="call" <?php if(!empty($_GET['action_now']) && $_GET['action_now']=='call') echo 'selected';?> >Gọi điện</option>
              <option value="message" <?php if(!empty($_GET['action_now']) && $_GET['action_now']=='message') echo 'selected';?> >Nhắn tin</option>
              <option value="go_meet" <?php if(!empty($_GET['action_now']) && $_GET['action_now']=='go_meet') echo 'selected';?> >Đi gặp</option>
              <option value="online_meeting" <?php if(!empty($_GET['action_now']) && $_GET['action_now']=='online_meeting') echo 'selected';?> >Họp online</option>
              <option value="other" <?php if(!empty($_GET['action_now']) && $_GET['action_now']=='other') echo 'selected';?> >Khác</option>
            </select>
          </div>

          <div class="col-md-2">
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <option value="new" <?php if(!empty($_GET['status']) && $_GET['status']=='new') echo 'selected';?> >Chưa xử lý</option>
              <option value="done" <?php if(!empty($_GET['status']) && $_GET['status']=='done') echo 'selected';?> >Đã hoàn thành</option>
            </select>
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
    <h5 class="card-header">
      <a href="/calendarCustomerHistoriesAgency" class="btn btn-danger">Xem dạng Lịch</a>
    </h5>
    <h5 class="card-header">Lịch sử chăm sóc khách hàng</h5>
    <div id="desktop_view">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th>ID</th>
              <th>Thời gian</th>
              <th>Khách hàng</th>
              <th>Nội dung</th>
              <th>Trạng thái</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            if(!empty($listData)){
              foreach ($listData as $item) {
                $status= '<span class="text-danger">Chưa xử lý</span>';
                if($item->status=='done'){ 
                  $status= '<span class="text-success">Đã hoàn thành</span>';
                }
                
                echo '<tr>
                <td>'.$item->id.'</td>
                <td>'.date('H:i d/m/Y', $item->time_now).'</td>

                <td>
                <a href="/listCustomerAgency?id='.$item->id_customer.'">'.$item->info_customer->full_name.'</a><br/>
                '.$item->info_customer->phone.'
                </td>
                <td>'.$item->note_now.'</td>
                
                <td>'.$status.'</td>

                
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
                 $status= '<span class="text-danger">Chưa xử lý</span>';
                if($item->status=='done'){ 
                  $status= '<span class="text-success">Đã hoàn thành</span>';
                }
                echo '<div class="col-sm-12 p-2 m-2 border border-secondary mb-3">
                        <p><strong> Thông tin khách hàng: </strong><a href="/listCustomerAgency?id='.$item->id_customer.'">'.$item->info_customer->full_name.'</a><br/>'.$item->info_customer->phone.'</p>
                        <p><strong> Thời gian: </strong>'.date('H:i d/m/Y', $item->time_now).'</p>
                        <p><strong> Nội dung: </strong>'.$item->note_now.'</p>
                        <p><strong> Trạng thái: </strong>'.$status.'</p>

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
<script type="text/javascript">
  $(function() {
       function split( val ) {
          return val.split( /,\s*/ );
        }

        function extractLast( term ) {
          return split( term ).pop();
        }

        $( "#name_customer" )
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
                
                $( "#name_customer" ).val(ui.item.full_name);
                $( "#id_customer" ).val(ui.item.id);

                return false;
            }
        });
      });
</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<?php include(__DIR__.'/../footer.php'); ?>