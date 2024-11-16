<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Loại cây trồng</h4>
  
  <p><a href="/plugins/admin/ngayhoixanh-view-admin-tree-addTreeAdmin/?id_location=<?php echo @$_GET['id_location'];?>" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p>

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
            <label class="form-label">Tên chương trình</label>
            <input type="text" class="form-control" name="name_program" value="<?php if(!empty($_GET['name_program'])) echo $_GET['name_program'];?>">
          </div>

          <div class="col-md-3">
            <label class="form-label">Tên loại cây</label>
            <input type="text" class="form-control" name="name_tree" value="<?php if(!empty($_GET['name_tree'])) echo $_GET['name_tree'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Địa điểm</label>
            <select name="id_location" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <?php
                if(!empty($listLocation)){
                  foreach($listLocation as $key=>$item){
                    if(empty($_GET['id_location']) || $_GET['id_location']!=$item->id){
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
            <label class="form-label">Sắp xếp theo</label>
            <select name="orderby" class="form-select color-dropdown">
              <option value="">Thời gian tạo</option>
              <option value="id_location" <?php if(!empty($_GET['orderby']) && $_GET['orderby']=='id_location') echo 'selected';?> >Địa điểm</option>
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
    <h5 class="card-header">Danh sách địa điểm</h5>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th>ID</th>
            <th>Tỉnh thành</th>
            <th>Địa điểm</th>
            <th>Tên chương trình</th>
            <th>Loài cây</th>
            <th>Số lượng</th>
            <th>Hình ảnh</th>
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
                        <td>'.$listCity[$item->info_location->id_city].'</td>
                        <td>'.$item->info_location->name.'</td>
                        <td>'.$item->name_program.'</td>
                        <td>'.$item->name_tree.'</td>
                        <td>'.$item->number_tree.'</td>
                        <td><a href="/plugins/admin/ngayhoixanh-view-admin-image_tree-listImageTreeAdmin/?id_tree='.$item->id.'">'.$item->number_image.' ảnh</a></td>
                      
                        <td align="center">
                          <a class="dropdown-item" href="/plugins/admin/ngayhoixanh-view-admin-tree-addTreeAdmin/?id='.$item->id.'">
                            <i class="bx bx-edit-alt me-1"></i>
                          </a>
                        </td>
                        <td align="center">
                          <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/plugins/admin/ngayhoixanh-view-admin-tree-deleteTreeAdmin/?id='.$item->id.'&id_location='.@$_GET['id_location'].'">
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