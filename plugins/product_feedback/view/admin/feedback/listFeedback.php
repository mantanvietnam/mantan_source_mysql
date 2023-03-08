<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Đánh giá chất lượng sản phẩm</h4>
  <p><a href="/plugins/admin/product_feedback-view-admin-feedback-addFeedback.php" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p>
  <!-- Responsive Table -->
  <div class="card">
    <h5 class="card-header">Đánh giá</h5>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th>ID</th>
            <th>Khách hàng</th>
            <th>Sản phẩm - Dịch vụ</th>
            <th>Tiêu chí đánh giá</th>
            <th>Điểm số</th>
            <th>Ghi chú</th>
            <th>Sửa</th>
            <th>Xóa</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            if(!empty($listData)){
              foreach ($listData as $item) {
                $row = count($item->point_detail);
                if($row==0) $row=1;

                for($i=0;$i<$row;$i++){
                  echo '<tr>';
                  
                  if($i==0){
                    echo '<td rowspan="'.$row.'">'.$item->id.'</td>
                          <td rowspan="'.$row.'" align="center">
                            <img src="'.$item->customer->avatar.'" width="100" /><br/>
                            '.$item->customer->full_name.'<br/>
                            '.$item->customer->phone.'<br/>
                          </td>
                          <td rowspan="'.$row.'">'.$item->product->title.'</td>';
                  }else{
                    
                  }
                          
                  echo '  <td>'.@$criteria[$item->point_detail[$i]->id_criteria].'</td>
                          <td>'.$item->point_detail[$i]->point.'</td>';
                          
                  if($i==0){
                    echo '<td rowspan="'.$row.'">'.$item->note.'</td>

                          <td align="center" rowspan="'.$row.'">
                            <a class="dropdown-item" href="/plugins/admin/product_feedback-view-admin-feedback-addFeedback.php/?id='.$item->id.'">
                              <i class="bx bx-edit-alt me-1"></i>
                            </a>
                          </td>
                          <td align="center" rowspan="'.$row.'">
                            <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/plugins/admin/product_feedback-view-admin-feedback-deleteFeedback.php/?id='.$item->id.'">
                              <i class="bx bx-trash me-1"></i>
                            </a>
                          </td>';
                  }else{
                    
                  }        
                          
                  echo '</tr>';
                }
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