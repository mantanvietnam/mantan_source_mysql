
<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="fw-bold py-3 mb-4">Quản lý mẫu ảnh</h4>
  </h4>

  <p><a href="/plugins/admin/snaphair-view-admin-sample-editSamplePhotoAdmin" class="btn btn-primary"><i class="bx bx-plus"></i> Thêm mới</a></p>

  <!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm ảnh mẫu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          <div class="col-md-1">
            <label class="form-label">ID</label>
            <input type="text" class="form-control" name="id" value="<?php if (!empty($_GET['id'])) echo $_GET['id']; ?>">
          </div>

          <div class="col-md-3">
            <label class="form-label">Tên ảnh</label>
            <input type="text" class="form-control" name="name" value="<?php if (!empty($_GET['name'])) echo $_GET['name']; ?>">
          </div>

          <div class="col-md-3">
            <label class="form-label">Màu sắc</label>
            <input type="text" class="form-control" name="color" value="<?php if (!empty($_GET['color'])) echo $_GET['color']; ?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Giới tính</label>
            <select name="sex" class="form-select">
              <option value="">Tất cả</option>
              <option value="male" <?php if (!empty($_GET['sex']) && $_GET['sex'] == 'male') echo 'selected'; ?>>Nam</option>
              <option value="female" <?php if (!empty($_GET['sex']) && $_GET['sex'] == 'female') echo 'selected'; ?>>Nữ</option>
            </select>
          </div>

          <div class="col-md-2">
            <label class="form-label">&nbsp;</label>
            <button type="submit" class="btn btn-primary d-block">Tìm kiếm</button>
          </div>

          <!-- <div class="col-md-1">
            <label class="form-label">&nbsp;</label>
            <input type="submit" class="btn btn-danger d-block" value="Excel" name="action">
          </div> -->
        </div>
      </div>
    </div>
  </form>
  <!--/ Form Search -->

  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Danh sách ảnh mẫu - <span class="text-danger"><?php echo number_format(@$totalData); ?> ảnh</span></h5>
    <?php echo @$mess; ?>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>Tên ảnh</th>
            <th>Hình ảnh</th>
            <th>Màu sắc</th>
            <th>Giới tính</th>
            <th>Danh mục</th>
            <th>Sửa</th>
            <th>Xóa</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          if (!empty($listData)) {
            foreach ($listData as $item) {
                $categoryName = '';
                foreach ($sampleCategories as $category) {
                    if ($category->id == $item->id_sample_cate) {
                    $categoryName = $category->name;
                    break;
                    }
                }
                $imageSrc = '/path/to/placeholder.png';
                if (is_array($item->images) && array_key_exists('image1', $item->images) && !empty($item->images['image1'])) {
                    $imageSrc = htmlspecialchars($item->images['image1']);
                }
              echo '<tr>
              <td>'.$item->id.'</td>
              <td>'.$item->name.'</td>
              <td><img src="' . $imageSrc . '" alt="' . htmlspecialchars($item->name) . '" width="80"></td>
              <td>'.$item->color.'</td>
              <td>'.(($item->sex == 'male') ? 'Nam' : 'Nữ').'</td>
              <td>'.$categoryName.'</td>
              <td align="center">
                <a class="dropdown-item" href="/plugins/admin/snaphair-view-admin-sample-editSamplePhotoAdmin/?id='.$item->id.'">
                  <i class="bx bx-edit-alt me-1"></i>
                </a>
              </td>
              <td align="center">
                <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/deleteSamplePhotoAdmin/?id='.$item->id.'">
                  <i class="bx bx-trash me-1"></i>
                </a>
              </td>
              </tr>';
            }
          } else {
            echo '<tr>
            <td colspan="7" align="center">Chưa có dữ liệu</td>
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
          if (@$totalPage > 0) {
            if ($page > 5) {
              $startPage = $page - 5;
            } else {
              $startPage = 1;
            }

            if (@$totalPage > $page + 5) {
              $endPage = $page + 5;
            } else {
              $endPage = $totalPage;
            }

            echo '<li class="page-item first">
            <a class="page-link" href="'.$urlPage.'1">
              <i class="tf-icon bx bx-chevrons-left"></i>
            </a>
            </li>';

            for ($i = $startPage; $i <= $endPage; $i++) {
              $active = ($page == $i) ? 'active' : '';
              echo '<li class="page-item '.$active.'">
              <a class="page-link" href="'.$urlPage.$i.'">'.$i.'</a>
              </li>';
            }

            echo '<li class="page-item last">
            <a class="page-link" href="'.$urlPage.$totalPage.'">
              <i class="tf-icon bx bx-chevrons-right"></i>
            </a>
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
