<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Thông tin mã giảm giá </h4>
 <p><a href="/plugins/admin/excgo-view-admin-reward-addRewardAdmin" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p>
  <!-- Responsive Table -->
  <form action="" method="GET">
           <!-- table class="table table-bordered" style="border: 1px solid #ddd!important; margin-top: 10px;">  
            <tbody><tr>
                <td>
                    <label>ID </label>
                    <input type="" name="id" class="form-control" placeholder="ID" value="<?php echo @$_GET['id'] ?>">
                </td>
                <td>
                    <label>Tên </label>
                    <input type="" name="name" class="form-control" placeholder="Tên" value="<?php echo @$_GET['name'] ?>">
                </td>
                <td>
                    <label>Điện thoại </label>
                    <input type="" name="phone" class="form-control" placeholder="Điện thoại" value="<?php echo @$_GET['phone'] ?>">
                </td>
                <td>
                    <label>Email </label>
                    <input type="" name="email" class="form-control" placeholder="Email" value="<?php echo @$_GET['email'] ?>">
                </td>
                 <td >
                    <br>
                    <input type="submit" name="" style="margin-top: 7px;" value="Tìm kiếm">
                </td>
               <td >
                    <input type="submit" name="excel" value="Xuất excel">
                </td> 
            </tr>
        
        </tbody></table> -->
    </form>
  <div class="card row">
    <h5 class="card-header">Thông tin phần thưởng</h5>
      <p><?php echo @$mess;?></p>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th>ID</th>
            <th>Tên </th>
            <th>Ngày bắt đầu</th>
            <th>Kết thúc</th>
            <th>Số Cuốc xe</th>
            <th>Tiền thưởng</th>
            <th>Trạng thái</th>
            <th>Kiểu thưởng</th>
            <th>sữa</th>
            <th>Xóa</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            if(!empty($listData)){
              foreach ($listData as $item) {
                $start_date = '';
                if(!empty($item->start_date)){
                  $start_date = date('d/m/Y',$item->start_date);
                }

                $end_date = '';
                if(!empty($item->end_date)){
                  $end_date = date('d/m/Y',$item->end_date);
                }
               
                $status = 'Khóa';
                if(!empty($item->status)){
                  $status = 'Kích hoạt';
                }

                $type = 'Thưởng cả tổng số cuốc';
                if(!empty($item->type==2)){
                  $type = 'Thưởng từng cuốc';
                }

                echo '<tr>
                        <td>'.$item->id.'</td>
                        <td>'.@$item->name.'</td>
                        <td>'.$start_date.'</td>
                        <td>'.$end_date.'</td>
                        <td>'.$item->quantity_booking.'</td>
                        <td>'.number_format(@$item->money).'đ</td>
                        <td>'.@$status.'</td>
                        <td>'.@$type.'</td>
                         <td align="center">
                          <a class="dropdown-item" href="/plugins/admin/excgo-view-admin-reward-addRewardAdmin/?id='.$item->id.'">
                            <i class="bx bx-edit-alt me-1"></i>
                          </a>
                        </td>
                        <td align="center">
                          <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/plugins/admin/excgo-view-admin-reward-deleteRewardAdmin/?id='.$item->id.'">
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
            if(@$totalPage>0){
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