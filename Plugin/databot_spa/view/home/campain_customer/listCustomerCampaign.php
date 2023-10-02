<?php include(__DIR__.'/../header.php'); ?>

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>


<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Người dùng tham gia chiến dịch</h4>
  <p><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#addCustomerCampaign" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm người đăng ký mới</a></p>
  <?php echo $mess;?>
  
  <!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          <div class="col-md-2">
            <label class="form-label">ID người dùng</label>
            <input type="text" class="form-control" name="id_customer" value="<?php if(!empty($_GET['id_customer'])) echo $_GET['id_customer'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Tên người dùng</label>
            <input type="text" class="form-control" name="name" value="<?php if(!empty($_GET['name'])) echo $_GET['name'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Số điện thoại</label>
            <input type="text" class="form-control" name="phone" value="<?php if(!empty($_GET['phone'])) echo $_GET['phone'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Email</label>
            <input type="text" class="form-control" name="email" value="<?php if(!empty($_GET['email'])) echo $_GET['email'];?>">
          </div>
          
          <div class="col-md-1">
            <label class="form-label">&nbsp;</label>
            <button type="submit" class="btn btn-primary d-block">Lọc</button>
          </div>
        </div>
      </div>
    </div>
  </form>
  <!--/ Form Search -->

  <!-- Responsive Table -->
  <div class="card">
    <h5 class="card-header">Danh sách chiến dịch</h5>

    <div class="card-body row">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="" style="text-align: center;">
              <th>Mã đăng ký</th>
              <th>Họ tên</th>
              <th>Điện thoại</th>
              <th>Xóa</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              if(!empty($listData)){
                foreach ($listData as $item) {

                  echo '<tr>
                          <td>'.$item->code.'</td>
                         
                          <td>'.$item->customers['name'].'</td>
                          <td>'.$item->customers['phone'].'</td>

                          <td align="center">
                            <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa khách đăng ký không?\');" href="/deleteCustomerCampain/?id='.$item->id.'">
                              <i class="bx bx-trash me-1"></i>
                            </a>
                          </td>
                        </tr>';
                }
              }else{
                echo '<tr>
                        <td colspan="10" align="center">Chưa có khách nào đăng ký chiến dịch</td>
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

<div class="modal fade" id="addCustomerCampaign"  name="id">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Thêm người dùng vào chiến dịch</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
     <?= $this->Form->create(); ?>
       <div class="modal-footer">
        <input type="hidden" value=""  name="id_customer" id="id_customer">
       
        <input type="text" value="" class="form-control" name="" placeholder="Nhập thông tin của khách hàng để tìm kiếm: họ tên, điện thoại, email" id="info_customer">
        
        <button type="submit" class="btn btn-primary">Lưu</button>
      </div>
     <?= $this->Form->end() ?>
      
    </div>
  </div>
</div>

<style type="text/css">
  .ui-autocomplete { z-index:2147483647; }
</style>

<script type="text/javascript">
    $(function() {
        function split( val ) {
          return val.split( /,\s*/ );
        }

        function extractLast( term ) {
          return split( term ).pop();
        }

        $("#info_customer")
        // don't navigate away from the field on tab when selecting an item
        .bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB && $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }

            $('#id_customer').val(0);
        })
        .autocomplete({
            source: function( request, response ) {
                $.getJSON( "/apis/searchCustomerApi", {
                    key: extractLast( request.term )
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
               
                $('#info_customer').val(ui.item.name);
                $('#id_customer').val(ui.item.id);
          
                return false;
            }
        });
    });
</script>


<?php include(__DIR__.'/../footer.php'); ?>