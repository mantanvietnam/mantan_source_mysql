<?php include(__DIR__.'/../header.php'); ?>

<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/changequanlitybook">Nhập sách</a>/</span>
    Lịch sử nhập sách
  </h4>


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
  <h5 class="card-header">số lượng bản ghi  - <span class="text-danger"><?php echo number_format(@$totalData);?> </span></h5>
  <?php echo @$mess;?>
  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr class="">
          <th>ID</th>
          <th>Tên sách</th>
          <th>số lượng</th>
          <th>Kiểu</th>
          <th>Xóa</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        if (!empty($listhistorybook)) {
          foreach ($listhistorybook as $item) {
            global $controller;
            $modelbooks = $controller->loadModel('books');
            $book = $modelbooks->find()
                               ->where(['id' => $item->id_book]) 
                               ->first();
    
            $bookName = $book ? $book->name : 'Tên sách không tìm thấy';
            echo '<tr>
            <td>'.$item->id.'</td>
            <td>'.$bookName.'</td>
            <td>'.$item->number.'</td>
            <td>'.$item->type.'</td>
            <td align="center">
              <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/deletehistorybook/?id='.$item->id.'">
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
