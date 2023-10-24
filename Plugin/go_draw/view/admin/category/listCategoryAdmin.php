<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Danh mục</h4>
    <p><a href="/plugins/admin/go_draw-view-admin-category-addCategoryAdmin.php" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p>

  <form method="get" action="">
      <div class="card mb-4">
        <h5 class="card-header">Tìm kiếm dữ liệu</h5>

        <div class="card-body">
          <div class="row gx-3 gy-2 align-items-center">
            <div class="col-md-2">
              <label class="form-label">ID</label>
              <input type="text" class="form-control" name="id" value="<?php if(!empty($_GET['id'])) echo $_GET['id'];?>">
            </div>

            <div class="col-md-5">
              <label class="form-label">Tên danh mục</label>
              <input type="text" class="form-control" name="name" value="<?php if(!empty($_GET['name'])) echo $_GET['name'];?>">
            </div>

            <div class="col-md-2">
              <label class="form-label">&nbsp;</label>
              <button type="submit" class="btn btn-primary d-block" style="width: 100%">Tìm kiếm</button>
            </div>
          </div>
        </div>
      </div>
    </form>
    <!-- Basic Layout -->
      <div class="row">
        <div class="col-xl">
          <div class="card mb-6">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Danh mục</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th class="col-md-4">Tên danh mục</th>
                        <th class="col-md-4">Ảnh</th>
                        <th class="text-center col-md-2">Sửa</th>
                        <th class="text-center col-md-2">Xóa</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      <?php
                        if(!empty($listData)){
                          foreach ($listData as $item) {
                            echo '<tr>
                                    <td>'.$item->name.'</td>
                                    <td class="text-center"><img src="'.$item->image.'" width="100" /></td>
                                    <td align="center">
                                      <a class="btn btn-primary" 
                                        href="/plugins/admin/go_draw-view-admin-category-addCategoryAdmin.php/?id='.$item->id .'"
                                      >
                                        <i class="bx bx-edit-alt me-1"></i>
                                      </a>
                                    </td>
                                    <td align="center">
                                      <a class="btn btn-danger" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" 
                                        href=href="/plugins/admin/go_draw-view-admin-category-deleteCategoryAdmin.php/?id='.$item->id.'"
                                      >
                                        <i class="bx bx-trash me-1"></i>
                                      </a>
                                    </td>
                                  </tr>';
                          }
                        }else{
                          echo '<tr>
                                  <td colspan="3" align="center">Chưa có dữ liệu</td>
                                </tr>';
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
            </div>
          </div>
          <!-- Phân trang -->
          <div class="demo-inline-spacing">
            <nav aria-label="Page navigation">
              <ul class="pagination justify-content-center">
                  <?php
                  if (isset($totalPage) && isset($page) && isset($urlPage)) {
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
                  }
                  ?>
              </ul>
            </nav>
          </div>
        </div>
      </div>
  </div>
