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
              <th>Giá bán </th>
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
                          <td>
                            <a class="" data-bs-toggle="modal" data-bs-target="#basicModal'.$item.'" title="Sửa giá bán">
                              '.number_format(@$static[$item]['price']).'đ <i class="bx bx-edit-alt me-1"></i>
                            </a>
                          </td>
                          <td><a href="/plugins/admin/clone_web-view-admin-website-listWebMemberAdmin?theme='.$item.'">'.@$static[$item]['number_theme'].' đại lý</a></td>

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
    <?php 
   if(!empty($listFolder)){
                foreach ($listFolder as $item) {
                  echo ' <div class="modal fade" id="basicModal'.$item.'"  name="id">

      <div class="modal-dialog" role="document" style=" max-width: 25rem;">
        <div class="modal-content" style="padding: 20px;">
          <div class="modal-header form-label border-bottom">
            <h5 class="modal-title" id="exampleModalLabel1">Sửa giá bán </h5>
            <button type="button" class="btn-close"data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="row">
            <div class="mb-3">
                <div style=" font-size: 20px; padding: 10px 0; ">
                  <p>Giao diện : '.$item.'</p>
                </div>
            </div>
            <div class="mb-3">
            <form  method="get" action="/editPriceThemeCloneWebAdmin">
              <div class="mb-3">
                <label class="form-label">giá bán(*)</label>
                  <input type="text" class="form-control phone-mask" name="price" id="price" value="'.@$static[$item]['price'].'"/>
                  <input type="hidden" class="form-control phone-mask" name="theme" id="theme" value="'.$item.'"/>
              </div>
              <button type="submit" class="btn btn-primary">Lưu</button> 
            </form>
               </div>
             </div>
           </div>
         </div>
       </div>';
                }
              }


   ?>
  <!--/ Responsive Table -->
</div>