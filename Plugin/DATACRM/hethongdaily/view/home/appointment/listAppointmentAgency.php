<?php include(__DIR__.'/../header.php'); ?>

<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/orderCustomerAgency">Khách hàng</a> /</span>
    Danh sách khách hàng
  </h4>

  <p><a href="/addAppointmentAgency" class="btn btn-primary"><i class="bx bx-plus"></i> Thêm mới</a> </p>

  <!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          
          <div class="col-md-3">
            <label class="form-label">Tên khách hàng</label>
            <input type="text" class="form-control" name="name_customer" id='name_customer' value="<?php if(!empty($_GET['name_customer'])) echo $_GET['name_customer'];?>">
            <input type="hidden" class="form-control" name="id_customer" id='id_customer' value="<?php if(!empty($_GET['id_customer'])) echo $_GET['id_customer'];?>">
          </div>

          <!-- <div class="col-md-3">
            <label class="form-label">tên đại lý</label>
            <input type="text" class="form-control" name="name_parent" id='name_parent' value="<?php if(!empty($_GET['name_parent'])) echo $_GET['name_parent'];?>">
            <input type="hidden" class="form-control" name="id_parent" id='id_parent' value="<?php if(!empty($_GET['id_parent'])) echo $_GET['id_parent'];?>">
          </div> -->

           <div class="col-md-3">
            <label class="form-label">Từ ngày</label>
            <input type="text" class="form-control datepicker" name="date_start" value="<?php if(!empty($_GET['date_start'])) echo $_GET['date_start'];?>">
          </div>

          <div class="col-md-3">
            <label class="form-label">Đến ngày</label>
            <input type="text" class="form-control datepicker" name="date_end" value="<?php if(!empty($_GET['date_end'])) echo $_GET['date_end'];?>">
          </div>
          <div class="col-md-3">
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <option value="0" <?php if(isset($_GET['status']) && $_GET['status']=='0') echo 'selected';?> >Chưa xác nhận </option>
              <option value="1" <?php if(!empty($_GET['status']) && $_GET['status']=='1') echo 'selected';?> >Xác nhận</option>
              <option value="2" <?php if(!empty($_GET['status']) && $_GET['status']=='2') echo 'selected';?> >Không đến</option>
              <option value="3" <?php if(!empty($_GET['status']) && $_GET['status']=='3') echo 'selected';?> >Đã đến</option>
              <option value="4" <?php if(!empty($_GET['status']) && $_GET['status']=='4') echo 'selected';?> >Hủy lịch</option>
            </select>
          </div>
          
          <div class="col-md-2">
            <label class="form-label">&nbsp;</label>
            <button type="submit" class="btn btn-primary d-block">Tìm kiếm</button>
          </div>
          
          <!-- <div class="col-md-1">
            <label class="form-label">&nbsp;</label>
            <input type="submit" class="btn btn-danger d-block" value="Excel" name="action">
          </div> -->
        </div>
      </div>
    </div>
  </form>
  <!--/ Form Search -->

  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Danh sách khách hàng</h5>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th>ID</th>
            <th>Khách hàng</th>
            <th>Thời gian hẹn</th>
            <th>Đại lý hẹn</th>
            <th>nội dung hẹn</th>
            <th>Trạng thái</th>
            <th>Sửa</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          if(!empty($listData)){
            foreach ($listData as $item) {
               if($item->status==0){
                $status= 'Chưa xác nhận';
              }elseif($item->status==1){
                $status= 'Xác nhận';
              }elseif($item->status==2){
                $status= 'Không đến';
              }elseif($item->status==3){
                $status= 'Đã đến';
              }elseif($item->status==4){
                $status= 'Hủy lịch';
                  }
              echo '<tr>
              <td>'.$item->id.'</td>
              <td>'.$item->name.'<br>
                  '.$item->phone.'<br>
                  '.$item->email.'<br>
              </td>
              <td>'.$item->time->format('Y-m-d H:i').'</td>
              <td>'.$item->parent->name.'</td>
              <td>'.$item->note.'</td>
              <td>'.$status.'</td>

              <td width="5%" align="center">
                <a class="dropdown-item" href="/addAppointmentAgency/?id='.$item->id.'">
                  <i class="bx bx-edit-alt me-1"></i>
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