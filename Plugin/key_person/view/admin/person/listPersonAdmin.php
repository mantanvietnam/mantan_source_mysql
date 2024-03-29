<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/key_person-view-admin-person-listPersonAdmin"> Đại lý</a> /</span>
    Danh sách đại lý
  </h4>
  <p><a href="/plugins/admin/key_person-view-admin-person-addPersonAdmin" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a>
  </p>

  <!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
      

          <div class="col-md-3">
            <label class="form-label">Tên đại lý</label>
            <input type="text" class="form-control" name="full_name" value="<?php if(!empty($_GET['full_name'])) echo $_GET['full_name'];?>">
          </div>

          <div class="col-md-3">
            <label class="form-label">Điện thoại</label>
            <input type="text" class="form-control" name="phone" value="<?php if(!empty($_GET['phone'])) echo $_GET['phone'];?>">
          </div>
          <div class="col-md-3">
            <label class="form-label">Khu vực</label>
            <select name="id_category" class="form-control">
              <option value="">Tất cả</option>
              <?php
                if(!empty($categories)){
                  foreach($categories as $item){
                    if(empty($_GET['id_category']) || $_GET['id_category']!=$item->id){
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
    <h5 class="card-header">Danh sách khách hàng</h5>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th>ID</th>
            <th>Ảnh</th>
            <th>Thông tin đại lý</th>
            <th>Khu vực</th>
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
             
              <td>
                '.$item->name.'<br/>
                '.$item->phone.'<br/>
                '.$item->address.'<br/>
                '.$item->email.'
              </td>
              <td>'.$item->name_category.'</td>
              <td align="center">
                          <a class="dropdown-item" href="/plugins/admin/key_person-view-admin-person-addPersonAdmin/?id='.$item->id.'">
                            <i class="bx bx-edit-alt me-1"></i>
                          </a>
                        </td>
                        <td align="center">
                          <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/plugins/admin/key_person-view-admin-person-deletePerson/?id='.$item->id.'">
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