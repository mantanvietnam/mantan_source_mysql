<?php include(__DIR__.'/../header.php'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Khách hàng</h4>
  <p><a href="/addCustomer" class="btn btn-primary" ><i class='bx bx-plus'></i> Thêm mới</a> <a href="/addDataCustomer" class="btn btn-primary" ><i class='bx bx-plus'></i> Thêm mới bằng Excel</a></p>

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
            <label class="form-label">Họ tên</label>
            <input type="text" class="form-control" name="name" value="<?php if(!empty($_GET['name'])) echo $_GET['name'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Điện thoại</label>
            <input type="text" class="form-control" name="phone" value="<?php if(!empty($_GET['phone'])) echo $_GET['phone'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="<?php if(!empty($_GET['email'])) echo $_GET['email'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">NV phụ trách</label>
            <select name="id_staff" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <?php 
                if(!empty($listStaff)){
                  foreach ($listStaff as $key => $value) {
                    if(empty($_GET['id_staff']) || $_GET['id_staff']!=$value->id){
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
  <div class="card">
    <h5 class="card-header">Danh sách khách hàng</h5>
    <div class="card-body row">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th>ID</th>
              <th>Ảnh đại điện</th>
              <th>Khách hàng</th>
              <th>Điểm</th>
              <th>NV phụ trách</th>
              <th>Thẻ thành viên</th>
              <th>Hồ sơ khách hàng</th>
              <th>Thần số học</th>
              <th>Sửa</th>
              <th>Xóa</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              if(!empty($listData)){
                foreach ($listData as $item) {
                  $link = "https://designer.ezpics.vn/create-image-series/?id=";
                  if(!empty($item->category->parent)){
                    $link .= $item->category->parent;
                  }
                  if(!empty($item->category->image)){
                    $link .= '&'.$item->category->image.'='.$item->avatar;
                  }

                  if(!empty($item->category->keyword)){
                    $link .= '&'.$item->category->keyword.'='.$item->name;
                  }

                  if(!empty($item->category->description)){
                    $link .= '&'.$item->category->description.'='.$item->id;
                  }

                  echo '<tr>
                          <td>'.$item->id.'</td>
                          <td>
                            <img src="' . $item->avatar . '" width="100" />
                          </td>
                          <td>'.$item->name.'</br>
                         '.$item->phone.'</br>
                          '.$item->email.'</td>
                          <td>'.number_format($item->point).'</td>
                          <td>'.@$listStaff[$item->id_staff]->name.'</td>
                          
                          <td align="center">
                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                            data-bs-target="#basicModal'.$item->id.'" target="_blank">
                              <i class="bx bx-image" ></i>
                            </a>
                          </td>
                          <td align="center">
                            <a class="dropdown-item" href="/listMedicalHistories/?id_customer='.$item->id.'">
                              <i class="bx bx-show"></i>
                            </a>
                          </td>
                           <td align="center">
                            <a class="dropdown-item" target="_blank" href="/downloadLinkNumerology/?id='.$item->id.'">
                              Link tải
                            </a>
                          </td>
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

                   if(!empty($items->category->slug)){
                    $link .= '&'.$items->category->slug.'='.$items->phone;
                  }
                  
               ?>
                        <div class="modal fade" id="basicModal<?php echo $items->id; ?>"  name="id">
                                
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <?php if(!empty($items->category->image)){ ?>
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Ảnh thẻ </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
                              </div>
                              
                              <div>
                                <img id="imageToDownload" src="<?php echo $link ?>" style="width: 100%;">
                              </div>
                            
                                <a href="javascript:void(0);" id="downloadButton" class="btn btn-warning mb-2 mt-3">
                                    <i class="fa-solid fa-cloud-arrow-down"></i> Tải ảnh
                                </a>
                               
                              <?php }else{
                                echo ' <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Bạn chưa cài ảnh in hàng hoạt EZPICS </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
                              </div>';
                              } ?>
                            </div>
                          </div>
                        </div>
                        <?php }} ?>

<script>
document.getElementById('downloadButton').addEventListener('click', function() {
    var image = document.getElementById('imageToDownload');
    var imageUrl = image.getAttribute('src');
    var imageName = imageUrl.substring(imageUrl.lastIndexOf('/') + 1);
    
    // Tạo một đối tượng XMLHttpRequest
    var xhr = new XMLHttpRequest();
    xhr.open('GET', imageUrl, true);
    xhr.responseType = 'blob'; // Đảm bảo dữ liệu trả về là dạng blob (binary large object)
    
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Tạo một URL dữ liệu từ dữ liệu nhận được
            var url = window.URL.createObjectURL(xhr.response);
            
            // Tạo một liên kết để tải xuống
            var a = document.createElement('a');
            a.href = url;
            a.download = imageName+'.png';
            
            // Simulate click để tải ảnh về
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        }
    };
    
    xhr.send();
});
</script>

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