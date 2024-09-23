<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Bài luyện tập </h4>
 
  <p><a href="/plugins/admin/colennao-view-admin-workout-addWorkout" class="btn btn-primary"><i class='bx bx-plus'></i>Thêm mới</a></p> 

  <!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          <div class="col-md-3">
            <label class="form-label">ID</label>
            <input type="text" class="form-control" name="id"
                   value="<?php if (!empty($_GET['id'])) echo $_GET['id']; ?>">
          </div>

          <div class="col-md-3">
            <label class="form-label">Tiêu đề</label>
            <input type="text" class="form-control" name="name"
                   value="<?php if (!empty($_GET['name'])) echo $_GET['name']; ?>">
          </div>


          <div class="col-md-3">
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <option value="active" <?php if (isset($_GET['status']) && $_GET['status'] == 'active') echo 'selected'; ?> >Kích hoạt
              </option>
              <option value="lock" <?php if (isset($_GET['status']) && $_GET['status'] == 'lock') echo 'selected'; ?> >Khóa
              </option>
            </select>
          </div>

          <div class="col-md-2">
            <label class="form-label">&nbsp;</label>
            <button type="submit" class="btn btn-primary d-block">Tìm kiếm</button>
          </div>
          <!-- <div class="col-md-2">
            <label class="form-label">&nbsp;</label>
            <button type="submit" name="excel" class="btn btn-primary d-block" value="Excel">Xuất Excle</button>
          </div> -->
        </div>
      </div>
    </div>
  </form>
  <!--/ Form Search -->

  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Danh sách bài luyện tập  </h5>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
        <tr class=""><th>ID</th>
              <th>Hình Ảnh</th>
              <th>tiêu đề</th>
              <th>sô bài tập</th>
              <th>Trạng thái</th>
              <th>Hàng động</th> 
        </tr>
        </thead>
        <tbody>
        <?php

        
        
        if (!empty($listData)) {
            foreach ($listData as $item) {
                

                if ($item->status == 'active') {
                    $status = 'Đã kích hoạt ';
                } else {
                    $status = ' Đã khóa ';
                }

              echo '<tr>
                 <td align="center">' . $item->id . '
                  </td><td align="center"><img src="' . $item->image . '" width="100" />
                  </td>
                  <td>'.$item->title . '  </td>
                  <td> <a href="/plugins/admin/colennao-view-admin-workout-listExerciseWorkout/?id_workout=' . $item->id . '"
                 >'.$item->total_exercise . '</a> </td>
                 
                 <td>'.$status.'</td>
                 <td> 
                 <p align="center">
                 <a class="btn btn-primary" 
                 href="/plugins/admin/colennao-view-admin-workout-addWorkout/?id=' . $item->id . '"
                 >
                 <i class="bx bx-edit-alt me-1" style="font-size: 22px;"></i>
                 </a>
                 </p>
                 <p align="center">
                 <a class="btn btn-success" href="/plugins/admin/colennao-view-admin-workout-deleteWorkout/?id=' . $item->id . '">
                 <i class="bx bx-trash me-1" style="font-size: 22px;"></i>
                 </a>
                 </p>
                 </td>
                 
                 </tr>';
            }
        } else {
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
            if (isset($totalPage) && isset($page) && isset($urlPage)) {
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
                        <a class="page-link" href="' . $urlPage . '1"
                          ><i class="tf-icon bx bx-chevrons-left"></i
                        ></a>
                      </li>';

                    for ($i = $startPage; $i <= $endPage; $i++) {
                        $active = ($page == $i) ? 'active' : '';

                        echo '<li class="page-item ' . $active . '">
                            <a class="page-link" href="' . $urlPage . $i . '">' . $i . '</a>
                          </li>';
                    }

                    echo '<li class="page-item last">
                        <a class="page-link" href="' . $urlPage . $totalPage . '"
                          ><i class="tf-icon bx bx-chevrons-right"></i
                        ></a>
                      </li>';
                }
            }
            ?>
        </ul>
      </nav>
    </div>
    <!--/ Basic Pagination -->
  </div>
  <!--/ Responsive Table -->
</div>