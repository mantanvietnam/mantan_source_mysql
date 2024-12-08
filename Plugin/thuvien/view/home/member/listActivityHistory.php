<?php include(__DIR__.'/../header.php'); ?>

<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listStaff">Người dung</a> /</span>
    Danh sách lịch sử hàng động người dùng
  </h4>
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
            <label class="form-label">Tên người dùng</label>
            <input type="text" class="form-control" name="name_member" id="name_member" value="<?php if(!empty($_GET['name_member'])) echo $_GET['name_member'];?>">
            <input type="hidden" class="form-control" name="id_member" id="id_member" value="<?php if(!empty($_GET['id_member'])) echo $_GET['id_member'];?>">
          </div>
                   
          <div class="col-md-2">
          <label class="form-label">&nbsp;</label>
            <button type="submit" class="btn btn-primary d-block">Tìm kiếm</button>
          </div>
          
         <!--  <div class="col-md-1">
            <input type="submit" class="btn btn-danger d-block" value="Excel" name="action">
          </div> -->
        </div>
      </div>
    </div>
  </form>
  <!--/ Form Search -->

  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Danh sách lịch sử hàng động người dùng </h5>
    <?php echo @$mess;?>
    <div id="desktop_view">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th>ID</th>
              <th>thời gian </th>
              <th>tên người dùng </th>
              <th>Nội dung</th>
              <th>Tài khoản</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            if(!empty($listData)){
              foreach ($listData as $item) {
               
                $infoStaff = $item->infoStaff->name.'<br/>'.$item->infoStaff->phone;
                if(!empty($item->infoStaff->address)) $infoStaff .= '<br/>'.$item->infoStaff->address;
                if(!empty($item->infoStaff->email)) $infoStaff .= '<br/>'.$item->infoStaff->email;                
                echo '<tr>
                <td>'.$item->id.'</td>
                <td>'.date('d/m/Y H:i', $item->time).'</td>
                <td>'.$infoStaff.'</td>
                <td>'.$item->note.'</td>
                <td>'.$item->type.'</td>
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
                $status= 'Nhân viên';
                if($item->type=='member'){ 
                  $status= 'Boss';
                }
                  
                echo '<div class="col-sm-12 p-2 m-2 border border-secondary mb-3">
                        <p><strong> Nhân viên: </strong>: '.$item->infoStaff->name.' (ID: '.$item->id_staff.')</p>
                        <p><strong> Điện thoại: </strong>: '.$item->infoStaff->phone.'</p>
                        <p><strong> Địa chỉ: </strong>: '.$item->infoStaff->address.'</p>
                        <p><strong> Nội dung: </strong>: '.$item->note.'</p>
                        <p><strong> Tài khoản: </strong>: '.$status.'</p>
                        <p><strong> Thời gian: </strong>: '.date('d/m/Y H:i', $item->time).'</p>
                        
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


<script type="text/javascript">
    // tìm sản phẩm
    $(function() {
        function split( val ) {
          return val.split( /,\s*/ );
        }

        function extractLast( term ) {
          return split( term ).pop();
        }

        

        $( "#name_staff" )
        // don't navigate away from the field on tab when selecting an item
        .bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB && $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }
        })
        .autocomplete({
            source: function( request, response ) {
                $.getJSON( "/apis/searchMemberAPI  ", {
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
                
                $( "#name_member" ).val(ui.item.label);
                $( "#id_member" ).val(ui.item.id);
                //$( "#promotion" ).val(ui.item.discount);
                

                return false;
            }
        });
    });
</script>

<?php include(__DIR__.'/../footer.php'); ?>