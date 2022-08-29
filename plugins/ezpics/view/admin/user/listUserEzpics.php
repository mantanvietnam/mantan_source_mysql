<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Ezpics</h4>
  <!-- Responsive Table -->
  <div class="card">
    <h5 class="card-header">Danh sách người dùng</h5>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr class="text-nowrap">
            <th>Ngày tạo</th>
            <th>Họ tên</th>
            <th>Số dư</th>
            <th>Điện thoại</th>
            <th>Trạng thái</th>
            <th>Sửa</th>
            <th>Xóa</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            if(!empty($listData)){
              foreach ($listData as $item) {
                echo '<tr>
                        <td>'.date('d/m/Y', $item->timeCreate).'</td>
                        <td>'.$item->fullName.'</td>
                        <td>'.number_format($item->coin).'đ</td>
                        <td>'.$item->phone.'</td>
                        <td>'.$item->status.'</td>
                        <td align="center">
                          <a class="dropdown-item" href="/plugins/admin/ezpics-view-admin-user-changePassUserEzpics.php/?id='.$item->id.'">
                            <i class="bx bx-edit-alt me-1"></i>
                          </a>
                        </td>
                        <td align="center">
                          <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn khóa không?\');" href="/plugins/admin/ezpics-view-admin-user-lockUserEzpics.php/?id='.$item->id.'">
                            <i class="bx bx-trash me-1"></i>
                          </a>
                        </td>
                      </tr>';
              }
            }else{
              echo '<tr>
                      <td colspan="10" align="center">Chưa có người dùng</td>
                    </tr>';
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <!--/ Responsive Table -->
</div>