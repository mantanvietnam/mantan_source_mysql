<?php include(__DIR__.'/../header.php'); ?>

<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listbook"></a></span>
    Danh sách đầu sách
  </h4>

  <p><a href="/addbook" class="btn btn-primary"><i class="bx bx-plus"></i> Thêm mới</a></p>

</p>

<!-- Form Search -->
<form method="get" action="">
  <div class="card mb-4">
    <h5 class="card-header">Tìm kiếm sách</h5>
    <div class="card-body">
      <div class="row gx-3 gy-2 align-items-center">
        <div class="col-md-1">
          <label class="form-label">ID</label>
          <input type="text" class="form-control" name="id" value="<?php if(!empty($_GET['id'])) echo $_GET['id'];?>">
        </div>

        <div class="col-md-3">
          <label class="form-label">Tên sách</label>
          <input type="text" class="form-control" name="name" value="<?php if(!empty($_GET['name'])) echo $_GET['name'];?>">
        </div>
        <div class="col-md-3">
          <label class="form-label">Mã xuất bản</label>
          <input type="text" class="form-control" name="book_code" value="<?php if(!empty($_GET['book_code'])) echo $_GET['book_code'];?>">
        </div>
        <div class="col-md-3">
            <label class="form-label">Nhà xuất bản</label>
            <select name="publishing_id" class="form-control">
                <option value="">Chọn Nhà xuất bản</option>
                <?php if (!empty($listcategorypublishers)): ?>
                    <?php foreach ($listcategorypublishers as $publisher): ?>
                        <option value="<?= $publisher->id; ?>" 
                            <?= (!empty($_GET['publishing_id']) && $_GET['publishing_id'] == $publisher->id) ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($publisher->name); ?>
                        </option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="">Không có nhà xuất bản nào</option>
                <?php endif; ?>
            </select>
        </div>

        <div class="col-md-3">
          <label class="form-label">Loại sách</label>
          <input type="text" class="form-control" name="typebook" value="<?php if(!empty($_GET['typebook'])) echo $_GET['typebook'];?>">
        </div>
        <div class="col-md-3">
          <label class="form-label">Tác giả</label>
          <input type="text" class="form-control" name="author" value="<?php if(!empty($_GET['author'])) echo $_GET['author'];?>">
        </div>
        <!-- <div class="col-md-2">
          <label class="form-label">Ngày thêm sách</label>
          <input type="date" class="form-control" name="published_date" value="<?php if(!empty($_GET['published_date'])) echo $_GET['published_date'];?>">
        </div> -->
        <div class="col-md-2">
            <label class="form-label">Ngày thêm</label>
            <input  type="text" class="form-control datepicker" name="published_date" id="published_date" value="<?php if(!empty($_GET['published_date'])) echo $_GET['published_date']; ?>" placeholder="dd/mm/yyyy">
        </div>
        <div class="col-md-2">
          <label class="form-label">Trạng thái</label>
          <select name="status" class="form-select color-dropdown">
            <option value="">Tất cả</option>
            <option value="active" <?php if(!empty($_GET['status']) && $_GET['status']=='active') echo 'selected';?>>Kích hoạt</option>
            <option value="lock" <?php if(!empty($_GET['status']) && $_GET['status']=='lock') echo 'selected';?>>Khóa</option>
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
  <h5 class="card-header">Danh sách đầu sách - <span class="text-danger"><?php echo number_format(@$totalData);?> </span></h5>
  <?php echo @$mess;?>
  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr class="">
          <th>ID</th>
          <th>Tên sách</th>
          <th>Tác giả</th>
          <th>Nhà xuất bản</th>
          <th>Danh mục sách</th>
          <th>Trạng thái</th>
          <th>Sửa</th>
          <th>Xóa</th>
        </tr>
      </thead>
      <tbody>
      <?php
        $categories = $modelCategories->find()->all()->toArray();
        $categoryNames = array_column($categories, 'name', 'id');

        $publishers = $modelCategories->find()->all()->toArray();
        $publisherNames = array_column($publishers, 'name', 'id');
        ?>
        <?php 
          if (!empty($listData)) {
              foreach ($listData as $item) {
                  // Tra cứu tên danh mục và nhà xuất bản từ mảng
                  $categoryName = isset($categoryNames[$item->id_category]) ? $categoryNames[$item->id_category] : 'Chưa có danh mục';
                  $publisherName = isset($publisherNames[$item->publishing_id]) ? $publisherNames[$item->publishing_id] : 'Chưa có nhà xuất bản';
                  
                  $status = '<span class="text-danger">Khóa</span>';
                  if ($item->status == 'active') { 
                      $status = '<span class="text-success">Kích hoạt</span>';
                  }

                  echo '<tr>
                      <td>'.$item->id.'</td>
                      <td>'.$item->name.'</td>
                      <td>'.$item->author.'</td>
                      <td>'.$categoryName.'</td>
                      <td>'.$publisherName.'</td>
                      <td>'.$status.'</td>
                      <td width="5%" align="center">
                          <a class="dropdown-item" href="/addbook/?id='.$item->id.'">
                              <i class="bx bx-edit-alt me-1"></i>
                          </a>
                      </td>
                      <td align="center">
                          <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/deletebook/?id='.$item->id.'">
                              <i class="bx bx-trash me-1"></i>
                          </a>
                      </td>
                  </tr>';
              }
          } else {
              echo '<tr>
                  <td colspan="8" align="center">Chưa có dữ liệu</td>
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
      if ($totalPage > 0) {
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

<?php include(__DIR__.'/../footer.php'); ?>
