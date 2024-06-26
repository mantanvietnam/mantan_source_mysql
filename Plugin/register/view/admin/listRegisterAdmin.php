<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Đăng Ký</h4>

  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Danh sách đăng ký</h5>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th>ID</th>
            <th>Họ tên</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Khoá học</th>
            <th>Địa chỉ</th>
            <th>Trung tâm</th>
            <th>Xóa</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            if(!empty($listData)){
              foreach ($listData as $item) {
                echo '<tr>
                        <td>'.$item->id.'</td>
                        <td>'.$item->name.'</td>
                        <td>'.$item->email.'</td>
                        <td>'.$item->phone_number.'</td>
                        <td>'.$item->course.'</td>
                        <td>'.$item->address.'</td>
                        <td>'.$item->centre.'</td>

                        <td align="center">
                          <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/plugins/admin/register-view-admin-deleteRegisterAdmin/?id='.$item->id.'">
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
    <!--/ Basic Pagination -->
  </div>
  <!--/ Responsive Table -->
</div>