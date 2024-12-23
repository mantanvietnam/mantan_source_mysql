<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">AI tìm kiếm ảnh</h4>

  <p><a onclick="return confirm('Bạn có chắc chắn muốn xóa không?');" href="/plugins/admin/phoenix_ai-view-admin-ai_search_image-deleteAllSearchImageEventAdmin" class="btn btn-primary"><i class="bx bx-trash me-1"></i> Xóa tất cả</a></p>

  
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

          <div class="col-md-2">
            <label class="form-label">Tên sự kiện</label>
            <input type="text" class="form-control" name="name" value="<?php if(!empty($_GET['name'])) echo $_GET['name'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <option value="lock" <?php if(!empty($_GET['status']) && $_GET['status']=='lock') echo 'selected';?> >Đang xử lý</option>
              <option value="active" <?php if(!empty($_GET['status']) && $_GET['status']=='active') echo 'selected';?> >Hoàn thành</option>
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
    <div class="row">
      <div class="col-md-6">
        <h5 class="card-header">Danh sách AI tìm ảnh</h5>
      </div>
    </div>

    <div class="card-body row">
      <p><?php echo @$mess;?></p>  
      <div id="desktop_view">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead class="colum-header">
                <tr>
                    <th class="table-column" scope="col">ID</th>
                    <th class="table-column" scope="col">Tên sự kiện</th>
                    <th class="table-column" scope="col">Link drive ảnh</th>
                    <th class="table-column" scope="col">Trạng thái</th>
                    <th class="table-column" scope="col">Link AI</th>
                    <th class="table-column" scope="col">QR code</th>
                    <th class="table-column" scope="col">Sửa</th>
                    <th class="table-column" scope="col">Xóa</th>
                </tr>
            </thead>
            <tbody>
              <?php if (!empty($listData)){ ?>
                <?php foreach ($listData as $item){ ?>
                    <?php
                    $status = '<span class="text-danger">Khóa</span>';
                    $linkAI = '';
                    $image = '';
                    $showLinkAI = 'Hệ thống đang tạo AI tìm ảnh cho bạn';

                    if ($item->status == 'active'){
                        $status = '<span class="text-success">Kích hoạt</span>';
                        $linkAI = 'https://ai.phoenixtech.vn/ai-search-image/?idCollection=' . $item->collection_ai . '&idDrive=' . $item->id_drive;
                        $showLinkAI = '<a class="mb-3" href="' . $linkAI . '" target="_blank">' . $linkAI . '</a>';

                        $image ='<img id="" src="https://api.qrserver.com/v1/create-qr-code/?size=500x500&data=' . urlencode($linkAI) . '" width="100">';
                    }

                    $linkDrive = 'https://drive.google.com/drive/folders/' . $item->id_drive . '?usp=drive_link';
                    ?>
                    <tr>
                        <td><?= $item->id ?></td>
                        <td width="300"><?= $item->name ?></td>
                        <td><a href="<?= $linkDrive ?>" target="_blank">Xem ảnh</a></td>
                        <td><?= $status ?></td>
                        <td><?= $showLinkAI ?></td>
                        <td><?= $image ?></td>
                        <td width="5%" align="center">
                            <a class="dropdown-item" href="javascript: void(0);" data-bs-toggle="modal" data-bs-target="#addNewData" onclick="edit(<?= $item->id ?>, '<?= addslashes($item->name) ?>', '<?= $item->id_drive ?>');">
                                <i class="bx bx-edit-alt me-1"></i>
                            </a>
                        </td>
                        <td align="center">
                            <a class="dropdown-item" onclick="return confirm('Bạn có chắc chắn muốn xóa không?');" href="/plugins/admin/phoenix_ai-view-admin-ai_search_image-deleteSearchImageEventAdmin/?id=<?= $item->id ?>">
                                <i class="bx bx-trash me-1"></i>
                            </a>
                        </td>
                    </tr>
                      <?php } ?>
                  <?php }else{ ?>
                      <tr>
                          <td colspan="7" align="center">Chưa có dữ liệu</td>
                      </tr>
                  <?php } ?> 
              </tbody>
          </table>
          
        </div>
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