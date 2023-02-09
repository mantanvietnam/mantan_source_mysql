<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">2TOP CRM</h4>
  <p><a href="/plugins/admin/2top_crm-view-admin-customer-addCustomerCRM.php" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p>
  <!-- Responsive Table -->
  <div class="card">
    <h5 class="card-header">Danh sách khách hàng</h5>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr class="text-nowrap">
            <th>Ảnh đại diện</th>
            <th>Họ tên</th>
            <th>Email</th>
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
                        <td><img src="'.$item->full_name.'" width="100" /></td>
                        <td>'.$item->full_name.'</td>
                        <td>'.$item->email.'</td>
                        <td>'.$item->phone.'</td>
                        <td>'.$item->status.'</td>
                        <td align="center">
                          <a class="dropdown-item" href="/plugins/admin/2top_crm-view-admin-customer-addCustomerCRM.php/?id='.$item->id.'">
                            <i class="bx bx-edit-alt me-1"></i>
                          </a>
                        </td>
                        <td align="center">
                          <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa khách hàng không?\');" href="/plugins/admin/2top_crm-view-admin-customer-deleteCustomerCRM.php/?id='.$item->id.'">
                            <i class="bx bx-trash me-1"></i>
                          </a>
                        </td>
                      </tr>';
              }
            }else{
              echo '<tr>
                      <td colspan="10" align="center">Chưa có khách hàng</td>
                    </tr>';
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <!--/ Responsive Table -->
</div>