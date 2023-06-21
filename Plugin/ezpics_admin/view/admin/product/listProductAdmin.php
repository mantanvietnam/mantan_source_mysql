<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Mẫu thiết kế</h4>

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

          <div class="col-md-2">
            <label class="form-label">Tên mẫu</label>
            <input type="text" class="form-control" name="name" value="<?php if(!empty($_GET['name'])) echo $_GET['name'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">SĐT designer</label>
            <input type="text" class="form-control" name="phone" value="<?php if(!empty($_GET['phone'])) echo $_GET['phone'];?>">
          </div>

          <div class="col-md-3">
            <label class="form-label">Danh mục</label>
            <select name="category_id" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <?php
              if(!empty($listCategory)){
                foreach ($listCategory as $key => $value) {
                  if(empty($_GET['category_id']) || $_GET['category_id']!=$value->id){
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
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-select color-dropdown">
              <option value="" <?php if(isset($_GET['status']) && $_GET['status']=='') echo 'selected';?> >Tất cả</option>
              <option value="1" <?php if(!empty($_GET['status']) && $_GET['status']=='1') echo 'selected';?> >Chờ duyệt</option>
              <option value="2" <?php if(!empty($_GET['status']) && $_GET['status']=='2') echo 'selected';?> >Đang đăng bán</option>
              <option value="0" <?php if(isset($_GET['status']) && $_GET['status']=='0') echo 'selected';?> >Chưa đăng bán</option>
              
            </select>
          </div>

          <div class="col-md-2">
            <label class="form-label">Loại sản phẩm</label>
            <select name="type" class="form-select color-dropdown">
              <option value="user_create" <?php if(!empty($_GET['type']) && $_GET['type']=='user_create') echo 'selected';?> >Mẫu gốc</option>
              <option value="user_edit" <?php if(!empty($_GET['type']) && $_GET['type']=='user_edit') echo 'selected';?> >Mẫu sao chép</option>
              <option value="" <?php if(isset($_GET['type']) && $_GET['type']=='') echo 'selected';?>>Tất cả</option>
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
        </div>
      </div>
    </div>
  </form>
  <!--/ Form Search -->

  <!-- Responsive Table -->
  <div class="card">
    <h5 class="card-header">Danh sách mẫu thiết kế - <b class="text-danger"><?php echo number_format($totalData);?></b> mẫu</h5>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th>ID</th>
            <th>Ảnh thiết kế</th>
            <th>Ảnh đại diện</th>
            <th>Mẫu thiết kế</th>
            <!-- <th>Chủ mẫu</th> -->
            <th>Thống kê</th>
            <th>Giá bán</th>
            <th>Trạng thái</th>
            <!-- <th>Khóa</th> -->
            <th>Xóa</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            if(!empty($listData)){
              foreach ($listData as $item) {
                 $linkopenapp = '';
                $type = '<span class="text-danger">Mẫu sao chép</span>';
                if($item->type=='user_create'){
                  $type = '<span class="text-success">Mẫu gốc</span>';
                }

                if($item->status==0){
                 $status = '<span class="text-danger">Chưa đăng bán</span>';
                
                }elseif($item->status==1){
                  $status = '<span class="text-primary">Chờ duyệt</span>
                  <br>
                   <a class="btn rounded-pill btn-icon btn-secondary" onclick="return confirm(\'Bạn có chắc chắn muốn duyệt mẫu thiết kế không?\');" href="/plugins/admin/ezpics_admin-view-admin-product-lockProductAdmin.php/?id='.$item->id.'&status=2&page='.@$_GET['page'].'" title="Duyệt"><i class="bx bxs-message-square-check" ></i></a>
                    <br/>
                    <br/>
                     <a class="btn rounded-pill btn-icon btn-outline-secondary" onclick="return confirm(\'Bạn có chắc chắn Tử chối mẫu thiết kế không?\');" href="/plugins/admin/ezpics_admin-view-admin-product-lockProductAdmin.php/?id='.$item->id.'&status=0&page='.@$_GET['page'].'" title="Từ chối"><i class="bx  bxs-message-square-x"></i></a>';
                }elseif($item->status==2){
                   $status = '<span class="text-success">Đang đăng bán</span><br>
                   <a class="btn rounded-pill btn-icon btn-outline-secondary" onclick="return confirm(\'Bạn có chắc chắn muốn hủy hiển thị mẫu thiết kế không ?\');" href="/plugins/admin/ezpics_admin-view-admin-product-lockProductAdmin.php/?id='.$item->id.'&status=0&page='.@$_GET['page'].'" title="Hủy hiển thị"><i class="bx bx-shield-x"></i></a>
                   ';

                   $linkopenapp = '<p id="id'.$item->id.'" style="color: red;"></p><button type="button" class="btn rounded-pill btn-icon btn-outline-secondary" onclick="copyToClipboard(\'https://designer.ezpics.vn/detail/'. $item->slug.'-'.$item->id.'.html\',\'id'.$item->id.'\')"><i class="bx bxs-share-alt"></i></button>';
                }

                $thumbnail = '';
                if(!empty($item->thumbnail)){
                  $thumbnail = '<img src="'.$item->thumbnail.'" width="100" />';
                }

                echo '<tr>
                        <td>
                          <a target="_blank" href="https://apis.ezpics.vn/edit-design/?id='.$item->id.'&token='.$item->designer->token.'">'.$item->id.'</a><br/>
                          '.date('d/m/Y', strtotime($item->created_at)).'
                        </td>
                        <td>
                          <img src="'.$item->image.'" width="100" /><br/>Tác giả<br/>
                           '.$item->designer->name.'<br/>
                          '.$item->designer->phone.'<br/>
                          '.$item->designer->email.'
                          
                        </td>
                        <td>'.$thumbnail.'</td>
                        <td>'.$item->name.'<br/>'.$type.'<br/>'.@$linkopenapp.'</td>
                        <td>
                          Sell: '.number_format($item->sold).'<br/>
                          View: '.number_format($item->views).'<br/>
                          Like: '.number_format($item->favorites).'<br/>
                        </td>
                        <td>
                          '.number_format($item->sale_price).'<br/>
                          <del>'.number_format($item->price).'</del>
                        </td>
                        <td style="text-align: center;">'.$status.'</td>
                        <td align="center">
                          <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa mẫu thiết kế không?\');" href="/plugins/admin/ezpics_admin-view-admin-product-deleteProductAdmin.php/?id='.$item->id.'">
                            <i class="bx bx-trash me-1"></i>
                          </a>
                        </td>
                      </tr>';
              }
            }else{
              echo '<tr>
                      <td colspan="10" align="center">Chưa có mẫu thiết kế</td>
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
  function copyToClipboard(textCopy,messId) {
    // Create a "hidden" input
    var aux = document.createElement("input");

    // Assign it the value of the specified element
    aux.setAttribute("value", textCopy);

    // Append it to the body
    document.body.appendChild(aux);

    // Highlight its content
    aux.select();

    // Copy the highlighted text
    document.execCommand("copy");

    // Remove it from the body
    document.body.removeChild(aux);

    // show mess
    $('#'+messId).html('Đã sao chép');

    setInterval(emptyMess, 3000,messId);

}
</script>