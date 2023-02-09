<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Trang tĩnh</h4>

  <p><a href="/pages/add" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p>

  <!-- Responsive Table -->
  <div class="card">
    <h5 class="card-header">Danh sách trang tĩnh</h5>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr class="text-nowrap">
            <th>Ngày đăng</th>
            <th>Tiêu đề</th>
            <th>Sửa</th>
            <th>Xóa</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            if(!empty($listData)){
              foreach ($listData as $item) {
                echo '<tr>
                        <td>'.date('d/m/Y', $item->time).'</td>
                        <td><a href="/pages/info/'.$item->slug.'-'.$item->id.'.html" target="_blank">'.$item->title.'</a></td>
                        <td align="center">
                          <a class="dropdown-item" href="/posts/add/?id='.$item->id.'">
                            <i class="bx bx-edit-alt me-1"></i>
                          </a>
                        </td>
                        <td align="center">
                          <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/pages/delete/?id='.$item->id.'">
                            <i class="bx bx-trash me-1"></i>
                          </a>
                        </td>
                      </tr>';
              }
            }else{
              echo '<tr>
                      <td colspan="10" align="center">Chưa có bài viết</td>
                    </tr>';
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <!--/ Responsive Table -->
</div>