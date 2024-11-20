<?php include(__DIR__.'/../header.php'); ?>

<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/warehouseProductAgency">Kho hàng</a> /</span>
    Danh sách hàng hóa trong kho
  </h4>

  <p><a href="/addRequestProductAgency" class="btn btn-primary"><i class='bx bx-plus'></i> Nhập hàng vào kho</a></p>

   <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          

          <div class="col-md-3">
            <label class="form-label">Tên sản phẩm</label>
            <input type="text" class="form-control" name="name_product" id="name_product" value="<?php if(!empty($_GET['name_product'])) echo $_GET['name_product'];?>">
            <input type="hidden" class="form-control" name="id_product" id="id_product" value="<?php if(!empty($_GET['id_product'])) echo $_GET['id_product'];?>">
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

  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Danh sách hàng hóa trong kho</h5>
    <div id="desktop_view">
      <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr class="">
                <th width="5%">ID</th>
                <th width="10%">Hình ảnh</th>
                <th width="30%">Hàng hóa</th>
                <th width="10%">Số lượng</th>
                <th width="15%">Giá bán</th>
                <th width="25%">Xuất nhập lần cuối</th>
                <th width="5%">Sửa</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              if(!empty($listData)){
                foreach ($listData as $item) {
                   echo '<tr>
                  <td>'.$item->id.'</td>
                  <td align="center"><img src="'.@$item->product->image.'" width="100" /></td>
                  <td>'.@$item->product->title.'</td>
                  <td>'.number_format($item->quantity).'</td>
                  <td>'.number_format(@$item->product->price).'</td>
                  <td><a href="/historyWarehouseProductAgency/?id_product='.$item->id_product.'">'.@$item->history->note.'</a></td>
                  <td align="center">
                    <a onclick="editProductWarehouse('.$item->id.');" class="dropdown-item" href="javascript:void(0);">
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
    </div>
    <div id="mobile_view">
      <?php 
         if(!empty($listData)){
              foreach ($listData as $item) {
                
                echo '<div class="col-sm-12 p-2 m-2 border border-secondary mb-3">
                        <center><img src="'.@$item->product->image.'" style="width:50%;" /></center>
                        <p><strong>ID: </strong>'.@$item->id.'</p>
                        <p><strong>Sản phẩm: </strong>'.@$item->product->title.'</td>
                        <p><strong>Số lượng: </strong>'.number_format($item->quantity).'</p>
                        <p><strong>Giá bán: </strong>'.number_format(@$item->product->price).'</p>
                        <p><strong>Xuất nhập lần cuối: </strong><a href="/historyWarehouseProductAgency/?id_product='.$item->id_product.'">'.@$item->history->note.'</a></p>
                        <p align="center">
                          <a onclick="editProductWarehouse('.$item->id.');" class="dropdown-item" href="javascript:void(0);">
                            <i class="bx bx-edit-alt me-1"></i>
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

<div class="modal fade" id="editProductWarehouse"  name="id">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Sửa số lượng tồn kho</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
     <form action="/editProductWarehouse" method="POST">
        <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>">
       <div class="modal-footer">
        <input type="hidden" value="0"  name="idWarehouseProduct" id="idWarehouseProduct">
        
        <div class="card-body">
          <div class="row gx-3 gy-2 align-items-center">
            <div class="col-md-12">
              <label class="form-label">Số lượng tồn kho thực tế (*)</label>
              <input type="number" value="" class="form-control" placeholder="" name="number" min="0" required>
            </div>
            <div class="col-md-12">
              <label class="form-label">Lý do chỉnh sửa (*)</label>
              <textarea class="form-control" placeholder="" name="note" required></textarea>
            </div>
          </div>
        </div>
        
        <button type="submit" class="btn btn-primary">Cập nhập dữ liệu</button>
      </div>
     </form>
      
    </div>
  </div>
</div>

<script type="text/javascript">
  function editProductWarehouse(id){
    $('#idWarehouseProduct').val(id);

    $('#editProductWarehouse').modal('show');
  }
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

        $( "#name_product" )
        // don't navigate away from the field on tab when selecting an item
        .bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB && $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }
        })
        .autocomplete({
            source: function( request, response ) {
                $.getJSON( "/apis/searchProductAPI", {
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

                
                $( "#name_product" ).val(ui.item.title);
                $( "#id_product" ).val(ui.item.id);
                return false;
            }
        });
    });
</script>

<?php include(__DIR__.'/../footer.php'); ?>