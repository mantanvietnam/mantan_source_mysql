<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Mở rộng</h4>
  <!-- Responsive Table -->
  <div class="card">
    <h5 class="card-header">Gói mở rộng</h5>

    <div class="card-body row">
      <div class="table-responsive text-nowrap">
        <table class="table table-bordered">
          <thead>
            <tr class="text-nowrap">
              <th>Gói mở rộng</th>
              <th>Trạng thái</th>
              <th>Thông tin</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              if(!empty($listFileShow)){
                foreach($listFileShow as $file){
                  $str= '';

                  if($file['active']>=0) {
                    if($file['active']==0) {
                      $str ='<p><a href="/options/activePlugin/?name='.$file['name'].'">Kích hoạt</a> | ';
                    } else if($file['active']==1) {
                      $str ='<p><a href="/options/deactivePlugin/?name='.$file['name'].'">Khóa</a> | ';
                    }

                    $str .= '<a class="text-danger" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/options/deletePlugin/?name='.$file['name'].'">Xóa</a></p>';
                  } else {
                    $str = '<p><a class="text-danger" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/options/deletePlugin/?name='.$file['name'].'">Xóa</a></p>';
                  }

                  switch($file['active'])
                  {
                    case 1: $status = "<span class='text-success'><i class='bx bx-check' ></i></span>";break;
                    case 0: $status = "<span class='text-danger'><i class='bx bx-x'></i></span>";break;
                    case -1: $status = "<span class='text-danger'><i class='bx bx-trash'></i></span>";break;
                    
                  }

                  echo '<tr>
                            <td>'.$file['name'].$str.'</td>
                            <td>'.$status.'</td>
                           <td>
                            <ul>
                              <li>Tên gói: '.@$file['info']->app.'</li>
                              <li>Phiên bản: '.@$file['info']->verName.'</li>
                              <li>Mô tả: '.@$file['info']->des.'</li>
                              <li>Tác giả: '.@$file['info']->author.'</li>
                              <li>Email: '.@$file['info']->email.'</li>
                              <li>Website: '.@$file['info']->web.'</li>
                              <li>Plugin yêu cầu: '.@$file['info']->request.'</li>
                            </ul>
                           </td>
                              </tr>';  
                
                }
              }else{
                echo '<tr>
                        <td colspan="10" align="center">Chưa có gói mở rộng nào</td>
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