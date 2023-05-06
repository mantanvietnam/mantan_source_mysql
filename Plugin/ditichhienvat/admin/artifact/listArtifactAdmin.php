<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Thông tin hiện vật</h4>
  <p><a href="/plugins/admin/ditichhienvat-admin-artifact-addArtifactAdmin.php" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a>
  &nbsp;&nbsp;&nbsp;
  <!--   <a href="/plugins/admin/ditichhienvat-admin-artifact-addWordArtfactAdmin.php" class="btn btn-danger"><i class='bx bxs-file-doc'></i> Thêm word</a> -->
  </p>

  <!-- Responsive Table -->
  <form action="" method="GET">
           <table class="table table-bordered" style="border: 1px solid #ddd!important; margin-top: 10px;">  
            <tbody><tr>
                <td>
                    <label>Tên hiện vật</label>
                    <input type="" name="name" class="form-control" placeholder="Tên hiện vật" value="">
                </td>
                <td>
                    <label>MÃ</label>
                    <input type="" name="sign" class="form-control" placeholder="Mã" value="<?php echo @$_GET['sign'] ?>">
                </td>
                 <td >
                    <br>
                    <input type="submit" name="" style="margin-top: 7px;" value="Tìm kiếm">
                </td>
               <!--  <td >
                    <input type="submit" name="excel" value="Xuất excel">
                </td> -->
            </tr>
        
        </tbody></table>
    </form>
  <div class="card">
    <h5 class="card-header">Danh sách Thông tin hiện vật</h5>
      <p><?php echo $mess;?></p>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th>MÃ</th>
            <th>Hình ảnh</th>
            <th>Tên hiện vật</th>
            <th>Thuộc di tích</th>
            <th>Chất liệu</th>
            <th>Niên đại</th>
            <th>Sửa</th>
            <th>Xóa</th> 
          </tr>
        </thead>
        <tbody>
          <?php 
            if(!empty($listData)){
              global $controller;
              foreach ($listData as $item) {
                 $dataHistoricalsite = getHistoricalSite($item->idHistoricalsite);
                echo '<tr>
                        <td>'.$item->sign.'</td>
                        <td><img src="'.$item->image.'" width="100"></td>
                        <td>'.$item->name.'</td>
                        <td>'.@$dataHistoricalsite->name.'</td>
                        <td>'.$item->material.'</td>
                        <td>'.$item->period.'</td>
                        
                        <td align="center">
                          <a class="dropdown-item" href="ditichhienvat-admin-artifact-addArtifactAdmin.php/?id='.$item->id.'" >
                            <i class="bx bx-edit-alt me-1"></i>
                          </a>
                        </td>
                        <td align="center">
                          <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/plugins/admin/ditichhienvat-admin-artifact-deleteArtifactAdmin.php/?id='.$item->id.'">
                            <i class="bx bx-trash me-1"></i>
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
  <!--/ Responsive Table -->
</div>