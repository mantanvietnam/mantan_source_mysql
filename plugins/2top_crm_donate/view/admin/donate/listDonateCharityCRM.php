<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">2TOP CRM - ĐÓNG GÓP</h4>
  <p><a href="/plugins/admin/2top_crm_donate-view-admin-donate-addDonateCharityCRM.php" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p>
  <!-- Responsive Table -->
  <div class="card">
    <h5 class="card-header">Danh sách đóng góp</h5>
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr class="">
            <th>Chương trình từ thiện</th>
            <th>Hình đại diện</th>
            <th>Người ủng hộ</th>
            <th>Số tiền</th>
            <th>Lời nhắn</th>
            <th>Xóa</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            if(!empty($listData)){
              foreach ($listData as $item) {
                echo '<tr>
                        <td>'.$listCharities[$item->id_charity]->title.'</td>
                        <td><img src="'.$item->avatar.'" width="100" /></td>
                        <td>
                          '.$item->full_name.'<br/>
                          '.$item->phone.'<br/>
                          '.$item->email.'
                        </td>
                        <td>'.number_format($item->coin).'đ</td>
                        <td>'.$item->note.'</td>
                        <td align="center">
                          <a class="dropdown-item" href="/plugins/admin/2top_crm_donate-view-admin-donate-addDonateCharityCRM.php/?id='.$item->id.'">
                            <i class="bx bx-edit-alt me-1"></i>
                          </a>
                        </td>

                        <td align="center">
                          <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/plugins/admin/2top_crm_donate-view-admin-donate-deleteDonateCharityCRM.php/?id='.$item->id.'">
                            <i class="bx bx-trash me-1"></i>
                          </a>
                        </td>
                      </tr>';
              }
            }else{
              echo '<tr>
                      <td colspan="10" align="center">Chưa có đóng góp nào</td>
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