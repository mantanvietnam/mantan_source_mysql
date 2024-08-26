<?php include(__DIR__.'/../header.php'); ?>
<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/affiliate-view-admin-transaction-listTransactionAffiliaterAdmin">Lịch sử giao dịch</a> /</span>
    Danh sách giao dịch hoa hông cộng tác viên
  </h4>

  <p><a href="/listTransactionAffiliaterAgency" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p>

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
            <label class="form-label">Tên đại lý</label>
            <input type="text" class="form-control" name="name_agency" id="name_agency" value="<?php if(!empty($_GET['name_agency'])) echo $_GET['name_agency'];?>">
            <input type="hidden" class="form-control" name="id_agency_introduce" id="id_agency_introduce" value="<?php if(!empty($_GET['id_agency_introduce'])) echo $_GET['id_agency_introduce'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">ID đơn hàng</label>
            <input type="text" class="form-control" name="id_order" value="<?php if(!empty($_GET['id_order'])) echo $_GET['id_order'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <option value="new" <?php if(!empty($_GET['status']) && $_GET['status']=='new') echo 'selected';?> >Chưa thanh toán</option>
              <option value="done" <?php if(!empty($_GET['status']) && $_GET['status']=='done') echo 'selected';?> >Đã thanh toán</option>
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
    <h5 class="card-header">Danh sách giao dịch</h5>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th>ID</th>
            <th>Đại lý</th>
            <th>ID đơn hàng</th>
            <th>Giá trị đơn hàng</th>
            <th>Hoa hồng bán</th>
            <th>Trạng thái</th>
            <th>Thanh toán</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          if(!empty($listData)){
            foreach ($listData as $item) {
              $status = 'Đã thanh toán';
              $pay = '';

              if($item->status == 'new'){
                  $status = 'Chưa thanh toán';

                  $pay = '<a class="dropdown-item"  data-bs-toggle="modal" data-bs-target="#basicModal'.$item->id.'">
                            <i class="bx bxs-credit-card"></i>
                          </a>';
              }

              echo '<tr>
              <td>'.$item->id.'</td>

              <td>
                <a href="/addMember?id='.$item->agency->id.'">'.$item->agency->name.'</a><br/>
                '.$item->agency->phone.'<br/>
              </td>
             
              <td><a href="/orderMemberAgency?id='.$item->id_order_member.'">'.$item->id_order_member.'</a></td>

              <td>'.number_format($item->money_total).'đ</td>
              <td>'.number_format($item->money_back).'đ</td>
              
              <td>'.$status.'</td>

              <td align="center">'.$pay.'</td>
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
<?php  if(!empty($listData)){
              foreach ($listData as $items) {
                

                   $info = '';
                  if(!empty($items->agency)){
                    $info = '<p><label class="form-label">Tên đại lý:</label> '.$items->agency->name.'</p>
                            <p><label class="form-label">Số điện thoại:</label> '.$items->agency->phone.'</p>';
                  }


               ?>
                        <div class="modal fade" id="basicModal<?php echo $items->id; ?>"  name="id">
                                
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header form-label border-bottom">
                                <h5 class="modal-title" id="exampleModalLabel1">Thanh toán tiền hoa hồng cho dại lý giới thiệu </h5>
                                <button type="button" class="btn-close"data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                             <form action="payTransactionAgency" method="GET">
                               <div class="modal-footer">
                                <input type="hidden" value="<?php echo $items->id; ?>"  name="id">
                                <div class="card-body">
                                  <div class="row gx-3 gy-2 align-items-center">
                                    <div class="col-md-12">
                                      <?php echo $info; ?>
                                      <p><label class="form-label">Số tiền thanh thoán:</label> <?php echo number_format($items->money_back) ?> đ</p>
                                      
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
    // tìm sản phẩm
    $(function() {
        function split( val ) {
          return val.split( /,\s*/ );
        }

        function extractLast( term ) {
          return split( term ).pop();
        }

        $( "#name_agency" )
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
                
                $( "#name_agency" ).val(ui.item.name);
                $( "#id_agency_introduce" ).val(ui.item.id);

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
</script>


<?php include(__DIR__.'/../footer.php'); ?>