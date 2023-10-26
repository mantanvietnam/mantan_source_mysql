<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/albums/list">Album ảnh</a> /</span>
    <span class="text-muted fw-light"><a href="/albums/add/?id=<?php echo $infoAlbum->id;?>"><?php echo $infoAlbum->title;?></a> /</span>
    Danh sách hình ảnh
  </h4>

  <p><a href="/albuminfos/add/?id_album=<?php echo $infoAlbum->id;?>" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p>

  <!-- Responsive Table -->
  <div class="card">
    <h5 class="card-header">Danh sách hình ảnh trong album <b><?php echo $infoAlbum->title;?></b></h5>
    
    <div class="card-body row">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th>Hình ảnh</th>
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
                          <td><img src="'.$item->image.'" width="100" /></td>
                          <td><a target="_blank" href="'.$item->link.'">'.$item->title.'</a></td>
                          
                          <td align="center">
                            <a class="dropdown-item" href="/albuminfos/add/?id='.$item->id.'&id_album='.$infoAlbum->id.'">
                              <i class="bx bx-edit-alt me-1"></i>
                            </a>
                          </td>
                          <td align="center">
                            <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/albuminfos/delete/?id='.$item->id.'">
                              <i class="bx bx-trash me-1"></i>
                            </a>
                          </td>
                        </tr>';
                }
              }else{
                echo '<tr>
                        <td colspan="10" align="center">Chưa có hình ảnh</td>
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