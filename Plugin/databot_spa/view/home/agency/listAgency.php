<?php include(__DIR__.'/../header.php'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Hoa hông cho nhân viên</h4>
  <p><a href="/addCustomer" class="btn btn-primary" ><i class='bx bx-plus'></i> Thêm mới</a></p>

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
            <label class="form-label">nhân viên</label>
            <input type="text" class="form-control" name="name" value="<?php if(!empty($_GET['name'])) echo $_GET['name'];?>">
          </div>
          <div class="col-md-2">
            <label class="form-label">Tạo từ ngày</label>
            <input type="text" class="form-control datepicker" name="date_start" value="<?php if(!empty($_GET['date_start'])) echo $_GET['date_start'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Đến ngày</label>
            <input type="text" class="form-control datepicker" name="date_end" value="<?php if(!empty($_GET['date_end'])) echo $_GET['date_end'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">&nbsp;</label>
            <button type="submit" class="btn btn-primary d-block">Tìm kiếm</button>
          </div>
     
        </div>
      </div>
    </div>
  </form>
  <!--/ Form Search -->

  <!-- Responsive Table -->
  <div class="card">
    <h5 class="card-header">Danh sách hoa hông cho nhân viên</h5>
    <div class="card-body row">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th>ID</th>
              <th>nhân viên</th>
              <th>Thời gian</th>
              <th>Hoa hông</th>
              <th>ID đơn</th>
              <th>Loại</th>
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
                        
                          <td>'.$item->staff->name.'</td>
                          <td>'.date('H:i d/m/Y', strtotime(@$item->created_at)).'</td>
                          <td>'.number_format($item->money).'đ</td>
                          <td>'.@$item->id_order.'</td>
                          <td>'.@$item->type.'</td>
                          
                         
                          <td align="center">
                            <a class="dropdown-item" href="/addCustomer/?id='.$item->id.'">
                              <i class="bx bx-edit-alt me-1"></i>
                            </a>
                          </td>
                          <td align="center">
                            <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa khách hàng không?\');" href="/deleteCustomer/?id='.$item->id.'">
                              <i class="bx bx-trash me-1"></i>
                            </a>
                          </td>
                        </tr>';
                }
              }else{
                echo '<tr>
                        <td colspan="10" align="center">Chưa có khách hàng</td>
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
            if(@$totalPage>0){
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
                 $link = "https://designer.ezpics.vn/create-image-series/?id=";
                  if(!empty($items->category->parent)){
                    $link .= $items->category->parent;
                  }
                  if(!empty($items->category->image)){
                    $link .= '&'.$items->category->image.'='.$items->avatar;
                  }

                  if(!empty($items->category->keyword)){
                    $link .= '&'.$items->category->keyword.'='.$items->name;
                  }

                  if(!empty($items->category->description)){
                    $link .= '&'.$items->category->description.'='.$items->id;
                  }
                  
               ?>
                        <div class="modal fade" id="basicModal<?php echo $items->id; ?>"  name="id">
                                
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Ảnh thẻ </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
                              </div>
                              <div>
                                <img src="<?php echo $link ?>" style="width: 100%;">
                              </div>
                              <a href="data:image/png;base64,<?php echo $link ?>" class="btn btn-warning mb-2 mt-3" download="<?php echo $link ?>">
                                  <i class="bx bx-down-arrow-circle"></i>  Tải ảnh
                                </a>
                                <!-- <a class="btn btn-primary m-3" onclick="downloadImage('')"><i class="bx bx-down-arrow-circle"></i> Tải xuống</a> -->
                            </div>
                          </div>
                        </div>
                        <?php }} ?>

<script type="text/javascript">
  function downloadImage(url) {


///////////
fetch(url { mode: 'cors' })
  .then(response => response.blob())
  .then(blob => {
    // Tạo một đối tượng URL từ đối tượng Blob
    const url = URL.createObjectURL(blob);

    // Tạo một thẻ a để tạo liên kết và tải ảnh
    const a = document.createElement('a');
    a.href = url;
    a.download = 'downloaded_image.jpg'; // Tên file khi tải về
    document.body.appendChild(a);
    a.click();

    // Xóa thẻ a sau khi tải xong
    document.body.removeChild(a);
  })
  .catch(error => console.error('không tản dc ảnh :', error));
}


</script>
<?php include(__DIR__.'/../footer.php'); ?>