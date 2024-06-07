<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Bài viết</h4>

  <p><a href="/posts/add" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p>

  <!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          <div class="col-md-1">
            <label class="form-label">ID</label>
            <input type="text" class="form-control" name="id" value="<?php if(!empty($_GET['id'])) echo $_GET['id'];?>">
          </div>

          <div class="col-md-3">
            <label class="form-label">Tiêu đề bài viết</label>
            <input type="text" class="form-control" name="title" value="<?php if(!empty($_GET['title'])) echo $_GET['title'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Chuyên mục</label>
            <select name="idCategory" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <?php 
                $category = [];
                if(!empty($listCategory)){
                  foreach ($listCategory as $key => $value) {
                    $selected = '';
                    if(!empty($_GET['idCategory']) && $_GET['idCategory']==$key){
                      $selected = 'selected';
                    }

                    echo '<option '.$selected.' value="'.$key.'" >'.$value['name'].'</option>';

                    $category[$key] = $value['name'];

                    if(!empty($value['sub'])){
                      foreach ($value['sub'] as $key1 => $value1) {
                        $selected = '';
                        if(!empty($_GET['idCategory']) && $_GET['idCategory']==$key1){
                          $selected = 'selected';
                        }

                        echo '<option '.$selected.' value="'.$key1.'" >&nbsp;&nbsp;&nbsp;'.$value1['name'].'</option>';

                        $category[$key1] = $value1['name'];

                        if(!empty($value1['sub'])){
                          foreach ($value1['sub'] as $key2 => $value2) {
                            $selected = '';
                            if(!empty($_GET['idCategory']) && $_GET['idCategory']==$key2){
                              $selected = 'selected';
                            }

                            echo '<option '.$selected.' value="'.$key2.'" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$value2['name'].'</option>';

                            $category[$key2] = $value2['name'];

                            if(!empty($value2['sub'])){
                              foreach ($value2['sub'] as $key3 => $value3) {
                                $selected = '';
                                if(!empty($_GET['idCategory']) && $_GET['idCategory']==$key3){
                                  $selected = 'selected';
                                }

                                echo '<option '.$selected.' value="'.$key3.'" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$value3['name'].'</option>';

                                $category[$key3] = $value3['name'];

                                if(!empty($value3['sub'])){
                                  foreach ($value3['sub'] as $key4 => $value4) {
                                    $selected = '';
                                    if(!empty($_GET['idCategory']) && $_GET['idCategory']==$key4){
                                      $selected = 'selected';
                                    }

                                    echo '<option '.$selected.' value="'.$key4.'" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$value4['name'].'</option>';

                                    $category[$key4] = $value4['name'];
                                  }
                                }
                              }
                            }
                          }
                        }
                      }
                    }
                  }
                }
              ?>
            </select>
          </div>
          
          <div class="col-md-1">
            <label class="form-label">&nbsp;</label>
            <button type="submit" class="btn btn-primary d-block">Lọc</button>
          </div>
        </div>
      </div>
    </div>
  </form>
  <!--/ Form Search -->

  <!-- Responsive Table -->
  <div class="card">
    <h5 class="card-header">Danh sách bài viết</h5>
    <div class="card-body row">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th>ID</th>
              <th>Chuyên mục</th>
              <th>Tiêu đề</th>
              <th>Xem</th>
              <th>Sửa</th>
              <th>Xóa</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              if(!empty($listData)){
                foreach ($listData as $item) {
                  echo '<tr>
                          <td>'.$item->id.'</td>
                          <td>'.@$category[$item->idCategory].'</td>
                          <td>
                            <a target="_blank" href="/'.$item->slug.'.html">'.$item->title.'</a>
                            <p>Ngày đăng: '.date('d/m/Y', $item->time).'</p>
                          </td>
                          <td>'.number_format($item->view).'</td>
                          <td align="center">
                            <a class="dropdown-item" href="/posts/add/?id='.$item->id.'">
                              <i class="bx bx-edit-alt me-1"></i>
                            </a>
                          </td>
                          <td align="center">
                            <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/posts/delete/?id='.$item->id.'">
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

      <!-- Phân trang -->
      <div class="demo-inline-spacing">
        <nav aria-label="Page navigation">
          <ul class="pagination justify-content-center">
            <?php
              if($totalPage>0){
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
                          <a class="page-link" href="'.$urlPage.'1"
                            ><i class="tf-icon bx bx-chevrons-left"></i
                          ></a>
                        </li>';
                  
                  for ($i = $startPage; $i <= $endPage; $i++) {
                      $active= ($page==$i)?'active':'';

                      echo '<li class="page-item '.$active.'">
                              <a class="page-link" href="'.$urlPage.$i.'">'.$i.'</a>
                            </li>';
                  }

                  echo '<li class="page-item last">
                          <a class="page-link" href="'.$urlPage.$totalPage.'"
                            ><i class="tf-icon bx bx-chevrons-right"></i
                          ></a>
                        </li>';
              }
            ?>
          </ul>
        </nav>
      </div>
      <!--/ Basic Pagination -->
    </div>
  </div>
  <!--/ Responsive Table -->
</div>