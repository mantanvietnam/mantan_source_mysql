<?php include(__DIR__.'/../header.php'); ?>

<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Mẫu thiết kế bán</h4>
  <?php if ($infoUser->number_spa >= $totalData){ ?>
     <p><a href="/addSpa" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p>
  <?php } ?>
 

  <!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">

          <div class="col-md-2">
            <label class="form-label">Tên mẫu</label>
            <input type="text" class="form-control" name="name" value="<?php if(!empty($_GET['name'])) echo $_GET['name'];?>">
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
    <h5 class="card-header">Danh sách SPA  </h5>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="" style="text-align: center;">
            <th>ID</th>
            <th>Tên</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Sửa</th>
            <th>Xóa</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            if(!empty($listData)){
              foreach ($listData as $item) {
                

                echo '<tr>
                        <td>'.$item->id.'</td>
                        <td>'.$item->name.'</td>
                        <td>'.$item->phone.'</td>
                        <td>'.$item->email.'</td>
                        <td>'.$item->address.'</td>
                        <td align="center">
                           <a  class="dropdown-item" href="/addSpa?id='.$item->id.'" title="sửa thông tin mẫu thiết kế">
                            <i class="bx bx bx-edit-alt me-1"></i>
                          </a>
                        </td>

                        <td align="center">
                          <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa mẫu thiết kế không?\');" href="/deleteSpa/?id='.$item->id.'">
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