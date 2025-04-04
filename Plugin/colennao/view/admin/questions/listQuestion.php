<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">CÂU HỎI KHẢO SÁT</h4>
  <p><a href="/plugins/admin/colennao-view-admin-questions-addQuestion" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p>
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
          <label class="form-label">Tên câu hỏi</label>
          <input type="text" class="form-control" name="name" value="<?php if(!empty($_GET['name'])) echo $_GET['name'];?>">
        </div>
        <div class="col-md-3">
            <label class="form-label">dạng câu hỏi</label>
            <select name="type" class="form-control">
                <option value="">Chọn dạng câu hỏi</option>
                <?php if (!empty($listcategoryexercise)): ?>
                    <?php foreach ($listcategoryexercise as $category): ?>
                        <option value="<?= $category->id; ?>" 
                            <?= (!empty($_GET['type']) && $_GET['type'] == $category->id) ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($category->name); ?>
                        </option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="">Không có dạng câu hỏi nào</option>
                <?php endif; ?>
            </select>
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
  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Câu hỏi khảo sát</h5>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th>ID</th>
            <th>Câu hỏi</th>
            <th>Trạng thái</th>
            <th>Dạng câu hỏi</th>
            <th>Sửa</th>
            <th>Xóa</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $categories = $modelCategories->find()->all()->toArray();
        $categoryNames = array_column($categories, 'name', 'id');


        ?>
          <?php 
            if(!empty($listData)){
              foreach ($listData as $item) {
                $categoryName = isset($categoryNames[$item->type]) ? $categoryNames[$item->type] : 'Chưa có tên';
                echo '<tr>
                        <td>'.$item->id.'</td>
                        <td>'.$item->name.'</td>
                        <td>'.$item->status.'</td>
                        <td>'.$categoryName.'</td>
                        <td align="center">
                          <a class="dropdown-item" href="/plugins/admin/colennao-view-admin-questions-addQuestion/?id='.$item->id.'">
                            <i class="bx bx-edit-alt me-1"></i>
                          </a>
                        </td>
                        <td align="center">
                          <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/plugins/admin/colennao-view-admin-questions-deleteQuestion/?id='.$item->id.'">
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