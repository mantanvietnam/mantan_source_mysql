<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Nhân bản website</h4>

  <!-- Responsive Table -->
  <div class="card">
    <h5 class="card-header">Danh sách giao diện</h5>
    
    <div class="card-body row">
      
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th>STT</th>
              <th>Giao diện</th>
              <th>Số người dùng</th>
              <th>Cài đặt giao diện</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              if(!empty($listFolder)){
                $stt = 0;
                foreach ($listFolder as $item) {
                  $stt ++;
                  echo '<tr>
                          <td>'.$stt.'</td>
                          <td>'.$item.'</td>
                          <td><a href="/plugins/admin/clone_web-view-admin-website-listWebMemberAdmin?theme='.$item.'">'.@$static[$item].' đại lý</a></td>

                          <td align="center">
                            <a class="dropdown-item" href="/plugins/admin/clone_web-view-admin-theme-settingThemeCloneWebAdmin/?theme='.$item.'">
                              <i class="bx bx-edit-alt me-1"></i>
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

    </div>
  </div>
  <!--/ Responsive Table -->
</div>