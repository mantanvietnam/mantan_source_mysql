<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">2TOP CRM</h4>
  <p><a href="/plugins/admin/2top_crm_donate-view-admin-donate-addDonateCharityCRM.php" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p>
  <!-- Responsive Table -->
  <div class="card">
    <h5 class="card-header">Danh sách đóng góp</h5>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr class="text-nowrap">
            <th>Chương trình từ thiện</th>
            <th>Hình đại diện</th>
            <th>Người ủng hộ</th>
            <th>Số tiền</th>
            <th>Lời nhắn</th>
            <th>Xóa</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            if(!empty($listData)){
              foreach ($listData as $item) {
                echo '<tr>
                        <td>'.$listCharities[$item->id_charity]->title.'</td>
                        <td><img src="'.$item->avatar.'" width="100" /></td>
                        <td>
                          '.$item->full_name.'<br/>
                          '.$item->phone.'<br/>
                          '.$item->email.'
                        </td>
                        <td>'.number_format($item->coin).'đ</td>
                        <td>'.$item->note.'</td>
                        <td align="center">
                          <a class="dropdown-item" href="/plugins/admin/2top_crm_donate-view-admin-donate-addDonateCharityCRM.php/?id='.$item->id.'">
                            <i class="bx bx-edit-alt me-1"></i>
                          </a>
                        </td>

                        <td align="center">
                          <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/plugins/admin/2top_crm_donate-view-admin-donate-deleteDonateCharityCRM.php/?id='.$item->id.'">
                            <i class="bx bx-trash me-1"></i>
                          </a>
                        </td>
                      </tr>';
              }
            }else{
              echo '<tr>
                      <td colspan="10" align="center">Chưa có đóng góp nào</td>
                    </tr>';
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <!--/ Responsive Table -->
</div>