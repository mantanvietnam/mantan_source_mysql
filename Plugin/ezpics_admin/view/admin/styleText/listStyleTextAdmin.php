<script language="javascript" type="text/javascript" src="/plugins/ezpics_admin/view/admin/js/ezpics_admin.js"></script>
<link rel="stylesheet" href="/plugins/ezpics_admin/view/admin/css/ezpics_admin.css" />
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Mẫu chữ</h4>
  <p><a href="/plugins/admin/ezpics_admin-view-admin-styleText-addStyleTextAdmin.php" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p>

  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Danh sách mẫu chữ - <b class="text-danger"><?php echo number_format($totalData);?></b> mẫu</h5>
    <div id="desktop_view">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th>ID</th>
              <th>Mẫu chữ</th>
              <th>Trạng thái</th>
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
                          <td>'.$item->name.'</td>
                          <td>'.$item->status.'</td>
                          
                          <td align="center">
                             <a  class="dropdown-item" href="/plugins/admin/ezpics_admin-view-admin-styleText-addStyleTextAdmin.php?id='.$item->id.'" title="Sửa">
                              <i class="bx bx bx-edit-alt me-1"></i>
                            </a>
                          </td>

                          <td align="center">
                            <a class="btn rounded-pill btn-icon btn-outline-secondary" onclick="return confirm(\'Bạn có chắc chắn muốn xóa mẫu thiết kế không?\');" href="/plugins/admin/ezpics_admin-view-admin-styleText-deleteStyleTextAdmin.php/?id='.$item->id.'">
                              <i class="bx bx-trash me-1"></i>
                            </a>
                          </td>
                        </tr>';
                }
              }else{
                echo '<tr>
                        <td colspan="10" align="center">Chưa có mẫu chữ</td>
                      </tr>';
              }
            ?>
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
  <!--/ Responsive Table -->
</div>