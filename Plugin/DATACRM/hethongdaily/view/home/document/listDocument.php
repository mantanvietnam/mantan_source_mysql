<?php include(__DIR__.'/../header.php'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><?php echo $title ?></h4>

  <p><a href="/add<?php echo $slug ?>" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p>

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
            <label class="form-label">Tiêu đề</label>
            <input type="text" class="form-control" name="title" value="<?php if(!empty($_GET['title'])) echo $_GET['title'];?>">
          </div>
          <div class="col-md-2">
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <option value="active" <?php if(!empty($_GET['status']) && $_GET['status']=='active') echo 'selected';?> >Kích hoạt</option>
              <option value="lock" <?php if(!empty($_GET['status']) && $_GET['status']=='lock') echo 'selected';?> >Khóa</option>
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
    <h5 class="card-header">Danh sách <?php echo $title ?></h5><?php echo @$mess;?>
    <ul class="nav nav-tabs" role="tablist">
      <li class="nav-item">
        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
          Mọi người
        </button>
      </li>
      <li class="nav-item">
        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-info" aria-controls="navs-top-info" aria-selected="false">
          của tôi
        </button>
      </li>
      
    </ul>
    <div class="tab-content">
      <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">

        <div class="card-body row">
          <div id="desktop_view">
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr class="">
                    <th>ID</th>
                    <th>Tiêu đề</th>
                    <th><?php echo $title ?></th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    if(!empty($conditioneverybody)){
                      foreach ($conditioneverybody as $item) {
                        echo '<tr>
                                <td>'.$item->id.'</td>
                                <td>
                                  '.$item->title.'
                                  <p>Ngày tạo: '.date('d/m/Y', $item->created_at).'</p>
                                </td>
                                <td><a href="/list'.$slug.'info?id_document='.$item->id.'">'.$item->number_document.'</a></td>
                                
                              </tr>';
                      }
                    }else{
                      echo '<tr>
                              <td colspan="5" align="center">Chưa có dữ liệu nào! </td>
                            </tr>';
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <div id="mobile_view">
      <?php 
         if(!empty($conditioneverybody)){
              foreach ($conditioneverybody as $item) {
                
                echo '<div class="col-sm-12 p-2 m-2 border border-secondary mb-3">
                        <p><strong>ID: </strong>'.$item->id.'</p>
                        <p><strong>Tiêu đề: </strong>'.$item->title.'</p>
                        <p><strong>Thời gian: </strong>'.date('d/m/Y', $item->created_at).'</td>
                        <p><strong>'.$title.': </strong><a href="/list'.$slug.'info?id_document='.$item->id.'">'.$item->number_document.'</a></p>
                       

                        </div>';
          }
         
        }else{
          echo '<div class="col-sm-12 item">
                  <p class="text-danger">Chưa có dữ liệu</p>
                </div>';
        }
      ?>
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
      <div class="tab-pane fade" id="navs-top-info" role="tabpanel">
        <div class="card-body row">
          <div id="desktop_views">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr class="">
                  <th>ID</th>
                  <th>Tiêu đề</th>
                  <th><?php echo $title ?></th>
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
                              <td>
                                <a target="_blank" href="/'.$item->slug.'.html">'.$item->title.'</a>
                                <p>Ngày tạo: '.date('d/m/Y', $item->created_at).'</p>
                              </td>
                              <td><a href="/list'.$slug.'info?id_document='.$item->id.'">'.$item->number_document.'</a></td>
                              <td align="center">
                                <a class="dropdown-item" href="/add'.$slug.'?id='.$item->id.'">
                                  <i class="bx bx-edit-alt me-1"></i>
                                </a>
                              </td>
                              <td align="center">
                                <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="deleteDocument?type='.$type.'&id='.$item->id.'">
                                  <i class="bx bx-trash me-1"></i>
                                </a>
                              </td>
                            </tr>';
                    }
                  }else{
                    echo '<tr>
                            <td colspan="5" align="center">Chưa có dữ liệu nào! </td>
                          </tr>';
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
            <div id="mobile_views">
      <?php 
         if(!empty($listData)){
              foreach ($listData as $item) {
                
                echo '<div class="col-sm-12 p-2 m-2 border border-secondary mb-3">
                        <p><strong>ID: </strong>'.$item->id.'</p>
                        <p><strong>Tiêu đề: </strong>'.$item->title.'</p>
                        <p><strong>Thời gian: </strong>'.date('d/m/Y', $item->created_at).'</td>
                        <p><strong>'.$title.': </strong><a href="/list'.$slug.'info?id_document='.$item->id.'">'.$item->number_document.'</a></p>
                        <p align="center">
                                <a class="dropdown-item" href="/add'.$slug.'?id='.$item->id.'">
                                  <i class="bx bx-edit-alt me-1"></i>
                                </a><a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="deleteDocument?type='.$type.'&id='.$item->id.'">
                                  <i class="bx bx-trash me-1"></i>
                                </a>
                              </p>

                        </div>';
          }
         
        }else{
          echo '<div class="col-sm-12 item">
                  <p class="text-danger">Chưa có dữ liệu</p>
                </div>';
        }
      ?>
    </div>

          <!-- Phân trang -->
         <!--  <div class="demo-inline-spacing">
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
          </div> -->
          <!--/ Basic Pagination -->
        </div>
      </div>
    </div>
    
  </div>
  <!--/ Responsive Table -->
</div>
    <script type="text/javascript">
      $(document).ready(function() {
  if($(window).width()<1024){
    $('#desktop_views').remove();
    $('#mobile_views').show();
  }else{
    $('#mobile_views').remove();
    $('#desktop_views').show();
  }
});
    </script>
<?php include(__DIR__.'/../footer.php'); ?>