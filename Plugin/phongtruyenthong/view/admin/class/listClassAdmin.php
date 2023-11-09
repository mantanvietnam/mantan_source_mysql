<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Lớp học</h4>
  
  <p><a href="/plugins/admin/phongtruyenthong-view-admin-class-addClassAdmin.php" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p>

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
            <label class="form-label">Tên lớp học</label>
            <input type="text" class="form-control" name="name" value="<?php if(!empty($_GET['name'])) echo $_GET['name'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Niên khóa</label>
            <select name="id_year" class="form-control">
              <option value="">Tất cả</option>
              <?php
                if(!empty($years)){
                  foreach($years as $item){
                    if(empty($_GET['id_year']) || $_GET['id_year']!=$item->id){
                      echo '<option value="'.$item->id.'">'.$item->name.'</option>';
                    }else{
                      echo '<option selected value="'.$item->id.'">'.$item->name.'</option>';
                    }
                  }
                }
              ?>
            </select>
          </div>

          <div class="col-md-2">
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <option value="active" <?php if(!empty($_GET['status']) && $_GET['status']=='active') echo 'selected';?> >Kích hoạt</option>
              <option value="lock" <?php if(!empty($_GET['status']) && $_GET['status']=='lock') echo 'selected';?> >Khóa</option>
            </select>
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
  <div class="card row">
    <h5 class="card-header">Danh sách lớp học</h5>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th>ID</th>
            <th>Hình minh họa</th>
            <th>Thông tin lớp</th>
            <th>Tài khoản</th>
            <th>Ghi chú</th>
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
                        <td><img src="'.$item->image.'" width="100" /></td>
                      
                        <td>'.$item->name_year.'<br/>'.$item->name.'<br/><img src="'.$item->image_label.'" width="150" /></td>
                        <td>'.$item->user.'<br/><br/><a target="_blank" href="'.$item->video.'">'.$item->video.'</a></td>
                        <td>'.@nl2br($item->note_admin).'<br/>'.$item->status.'</td>
                        <td align="center">
                          <a class="dropdown-item" href="/plugins/admin/phongtruyenthong-view-admin-class-addClassAdmin.php/?id='.$item->id.'">
                            <i class="bx bx-edit-alt me-1"></i>
                          </a>
                        </td>
                        <td align="center">
                          <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/plugins/admin/phongtruyenthong-view-admin-class-deleteClassAdmin.php/?id='.$item->id.'">
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