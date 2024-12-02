<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><a href="/plugins/admin/colennao-view-admin-user-listUserAdmin">Thành viên</a> /</span>
        Lịch sử kết quả khảo sát</h4>
 
  <!-- <p><a href="#" class="btn btn-primary"><i class='bx bx-plus'></i> Nhập excel</a></p> -->

  <!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Thông tin người dùng</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          

        <div class="col-md-6">
            <p><label class="form-label">Tên thành viên:</label> <?php echo @$data->info->full_name; ?></p>
        </div>
        <div class="col-md-6">
           <p><label class="form-label">Số điện thoại:</label> <?php echo @$data->info->phone; ?></p>
        </div>

        <div class="col-md-6">
            <p><label class="form-label">Email:</label> <?php echo @$data->info->email; ?></p>
        </div>

        <div class="col-md-6">
            <p><label class="form-label">Địa chi: </label> <?php echo @$data->info->address; ?></p>
        </div>

        <div class="col-md-6">
            <p><label class="form-label">Nhóm luyện tập: </label> <?php echo @$data->name_people->name; ?></p>
        </div>

        </div>
      </div>
    </div>
  </form>
  <!--/ Form Search -->

  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Danh sách câu hỏi</h5>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
        <tr class="">
              <th>câu hỏi </th>
              <th>câu trả lời</th>
        </tr>
        </thead>
        <tbody>
        <?php

        
        
        if (!empty($data->answers)) {
            foreach ($data->answers as $item) {
                 echo '<tr>
                    <td>'.$item['questions'].'</td>
                    <td>'.$item['answers'].'</td>
                  </tr>';
            }
        } else {
            echo '<tr>
                    <td colspan="2" align="center">Chưa có dữ liệu</td>
                  </tr>';
        }
        ?>
        </tbody>
      </table>
    </div>

    <!-- Phân trang -->
    <div class="demo-inline-spacing">
      <nav aria-label="Page navigation">
        <!-- <ul class="pagination justify-content-center">
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
        </ul> -->
      </nav>
    </div>
    <!--/ Basic Pagination -->
  </div>
  <!--/ Responsive Table -->
</div>