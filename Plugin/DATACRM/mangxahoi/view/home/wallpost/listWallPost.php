<?php include(__DIR__.'/../../../../hethongdaily/view/home/header.php'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"> Bài viết mạng xã hội</h4>
  <p><a href="/addWallPost" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p>
  <!-- Responsive Table -->
  <!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">     
          <div class="col-md-3">
            <label class="form-label">Tên khách hàng</label>
            <input type="text" class="form-control" name="name_customer" id="name_customer" value="<?php if(!empty($_GET['name_customer'])) echo $_GET['name_customer'];?>">
            <input type="hidden" class="form-control" name="id_customer" id="idcustomer" value="<?php if(!empty($_GET['id_customer'])) echo $_GET['id_customer'];?>">
          </div>
         

          <div class="col-md-1">
            <label class="form-label">&nbsp;</label>
            <button type="submit" class="btn btn-primary d-block">Lọc</button>
          </div>
        </div>
          <!-- <div class="col-md-1">
            <label class="form-label">&nbsp;</label>
            <input type="submit" class="btn btn-danger d-block" value="Excel" name="action">
          </div> -->
        </div>
      </div>
  </form>
  <!--/ Form Search -->
  <div class="card row">
    <h5 class="card-header">Khóa học</h5>
    <?php echo @$mess; ?>
    <div id="desktop_view">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th>ID</th>
              <th>Thong tin khách hàng</th>
              <th>Mội dung bài viết</th>
              <th>Hình ảnh bài viết</th>
              <th>Trạng thái</th>
              <th>Like & comment</th>
              <th>Sửa</th>
              <th>Xóa</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              if(!empty($listData)){
                foreach ($listData as $item) {
                  $image = '<div class="row">';
                  if(!empty($item->listImage)){
                    foreach ($item->listImage as $img) {
                      $image .= '<div class="col-md-4"><img src="'.$img->image.'"  style="width: 60px; height: 60px; padding:2px" /></div>';
                    } 
                  }
                   $image .= '<div>';
                  echo '<tr>
                          <td>'.$item->id.'</td>
                          <td>'.$item->infoCustomer->full_name.'<br/>
                              '.$item->infoCustomer->phone.'<br/>
                              '.$item->infoCustomer->address.'<br/>
                              '.$item->infoCustomer->email.'</td>
                          <td>'.$item->connent.'</td>
                          <td>'.$image.'</td>
                          <td>'.$item->public.'</td>
                          <td>Like: '.$item->like.'</br>
                              Dislike: '.$item->dislike.'</br>
                              Comment: '.$item->comment.'</br>
                          </td>
                          <td align="center">
                            <a class="dropdown-item" href="/addWallPost/?id='.$item->id.'">
                              <i class="bx bx-edit-alt me-1"></i>
                            </a>
                          </td>
                          <td align="center">
                            <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/deleteWallPost?id='.$item->id.'">
                              <i class="bx bx-trash me-1"></i>
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
    <div id="mobile_view" >
      <?php 
         if(!empty($listData)){
                foreach ($listData as $item) {
                  $image = '<div class="row">';
                  if(!empty($item->listImage)){
                    foreach ($item->listImage as $img) {
                      $image .= '<div class="col-md-4"><img src="'.$img->image.'"  style="width: 60px; height: 60px; padding:2px" /></div>';
                    } 
                  }
                   $image .= '<div>';
                  echo '<div>
                          <p>'.$item->id.'</p>
                          <p>'.$item->infoCustomer->full_name.'<br/>
                              '.$item->infoCustomer->phone.'<br/>
                              '.$item->infoCustomer->address.'<br/>
                              '.$item->infoCustomer->email.'</p>
                          <p>'.$item->connent.'</p>
                          <p>'.$image.'</p>
                          <p>'.$item->public.'</p>
                          <p>Like: '.$item->like.'</br>
                              Dislike: '.$item->dislike.'</br>
                              Comment: '.$item->comment.'</br>
                          </p>
                          <p align="center">
                            <a class="dropdown-item" href="/addWallPost/?id='.$item->id.'">
                              <i class="bx bx-edit-alt me-1"></i>
                            </a>
                          </p>
                          <p align="center">
                            <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/deleteWallPost?id='.$item->id.'">
                              <i class="bx bx-trash me-1"></i>
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
                $( "#idcustomer" ).val(ui.item.id);

                return false;
            }
        });
      });
</script>

<?php include(__DIR__.'/../../../../hethongdaily/view/home/footer.php'); ?>