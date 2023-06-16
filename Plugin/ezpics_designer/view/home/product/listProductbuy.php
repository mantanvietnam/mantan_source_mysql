<?php include(__DIR__.'/../header.php'); ?>

<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Mẫu thiết kế mua</h4>

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
    <h5 class="card-header">Danh sách mẫu thiết kế mua - <b class="text-danger"><?php echo number_format($totalData);?></b> mẫu</h5>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th>ID</th>
            <th>Ảnh thiết kế</th>
            <th>Ảnh đại diện</th>
            <th>Mẫu thiết kế</th>
            <th>Sửa</th>
            <th>Xóa</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            if(!empty($listData)){
              foreach ($listData as $item) {
                $link_share = 'https://designer.ezpics.vn/detail/'.$item->slug.'-'.$item->id.'.html';

                $type = '<span class="text-danger">Mẫu sao chép</span>';
                if($item->type=='user_create'){
                  $type = '<span class="text-success">Mẫu gốc</span>';
                }

                if($item->status==0){
                 $status = '<span class="text-danger">Chưa đăng bán</span>';
                
                }elseif($item->status==1){
                  $status = '<span class="text-primary">Chờ duyệt</span>';
                }elseif($item->status==2){
                   $status = '<span class="text-success">Đang đăng bán</span>';
                }

                $image = (!empty($item->thumbnail))?$item->thumbnail:$item->image;

                echo '<tr>
                        <td>
                          '.$item->id.'
                        </td>
                        <td>
                          <img src="'.$item->image.'" width="100" />
                          
                        </td>
                        <td>
                          <img src="'.$image.'" width="100" /><br/>
                          '.date('d/m/Y', strtotime($item->created_at)).'
                        </td>
                        <td>'.$item->name.'<br/>'.$type.'</td>
                        
                        
                        
                        <td align="center">
                          <a target="_blank" class="dropdown-item" href="https://apis.ezpics.vn/edit-design/?id='.$item->id.'&token='.$session->read('infoUser')->token.'">
                            <i class="bx bx-edit"></i>
                          </a>
                        </td>

                        <td align="center">
                          <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa mẫu thiết kế không?\');" href="/deleteProduct/?id='.$item->id.'">
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
  function copyToClipboard(text) {
    // Tạo một thẻ textarea ẩn
    var textarea = document.createElement("textarea");
    textarea.value = text;

    // Thêm thẻ textarea vào trang web
    document.body.appendChild(textarea);

    // Chọn toàn bộ nội dung trong thẻ textarea
    textarea.select();

    // Sao chép nội dung vào bộ nhớ đệm
    document.execCommand("copy");

    // Xóa thẻ textarea
    document.body.removeChild(textarea);

    alert('Sao chép link chia sẻ vào bộ nhớ đệm thành công');
  }
</script>

<?php include(__DIR__.'/../footer.php'); ?>