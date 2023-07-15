<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">2TOP CRM - TỪ THIỆN</h4>
  <p><a href="/plugins/admin/2top_crm_donate-view-admin-charity-addCharityCRM.php" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p>
  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Chương trình từ thiện</h5>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th>ID</th>
            <th>Tên chương trình</th>
            <th>Thời gian diễn ra</th>
            <th>Địa điểm tổ chức</th>
            <th>Số người đóng góp</th>
            <th>Số tiền đóng góp</th>
            <th>Trạng thái</th>
            <th>Thống kê</th>
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
                        <td>'.$item->title.'</td>
                        <td>'.date('d/m/Y', $item->time_event_start).' đến '.date('d/m/Y', $item->time_event_end).'</td>
                        <td>'.$item->address.'</td>
                        <td><a href="/plugins/admin/2top_crm_donate-view-admin-donate-listDonateCharityCRM.php/?id_charity='.$item->id.'">'.number_format($item->person_donate).'</a></td>
                        <td>'.number_format($item->money_donate).'đ</td>
                        <td>'.$item->status.'</td>
                        
                        <td align="center">
                          <a target="_blank" class="dropdown-item" href="/donate/'.$item->slug.'.html">
                            <i class="bx bx-bar-chart-alt me-1"></i>
                          </a>
                        </td>

                        <td align="center">
                          <a class="dropdown-item" href="/plugins/admin/2top_crm_donate-view-admin-charity-addCharityCRM.php/?id='.$item->id.'">
                            <i class="bx bx-edit-alt me-1"></i>
                          </a>
                        </td>
                        
                        <td align="center">
                          <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/plugins/admin/2top_crm_donate-view-admin-charity-deleteCharityCRM.php/?id='.$item->id.'">
                            <i class="bx bx-trash me-1"></i>
                          </a>
                        </td>
                      </tr>';
              }
            }else{
              echo '<tr>
                      <td colspan="10" align="center">Chưa có chương trình từ thiện</td>
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