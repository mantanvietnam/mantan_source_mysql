<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Thông tin đặt bàn nhà hàng</h4>
  <!-- <p><a href="/plugins/admin/tayho360-admin-restaurant-addRestaurantAdmin" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p> -->
  <!-- Responsive Table -->
 <!--  <form action="" method="GET">
           <table class="table table-bordered" style="border: 1px solid #ddd!important; margin-top: 10px;">  
            <tbody><tr>
                <td>
                    <label>Tên nhà hàng</label>
                    <input type="" name="name" class="form-control" placeholder="Tên nhà hàng" value="">
                </td>
                 <td >
                    <br>
                    <input type="submit" name="" style="margin-top: 7px;" value="Tìm kiếm">
                </td>
               <td >
                    <input type="submit" name="excel" value="Xuất excel">
                </td> 
            </tr>
        
        </tbody></table>
    </form> -->
  <div class="card row">
    <h5 class="card-header">Danh sách Thông tin đặt bàn nhà hàng</h5>
      <p><?php echo @$mess;?></p>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th>Tên nhà hàng</th>
            <th>Tên khách hàng</th>
            <th>Số điện thoại</th>
            <th>Số người</th>
            <th>Thời gian đặt</th>
            <th>CHú ý</th>
            <!-- <th>Sửa</th> -->
            <th>Xóa</th> 
          </tr>
        </thead>
        <tbody>
          <?php 
            if(!empty($listData)){
              foreach ($listData as $item) {

                 $title = getRestaurant($item->idrestaurant);
                    $type= 'Nhà hàng';
                    if(!empty($title)){
                    $url= 'chi_tiet_nha_hang/'.$title->urlSlug.'.html';
                  
?>
              <tr>
                        <td><a href="/../../<?php echo $url ?>"><?php echo @$title->name ?></a><br>SĐT: <?php echo @$title->phone ?></td>
                         <td><?php echo @$item->name; ?></td>
                        <td><?php echo @$item->phone ?></td>
                        <td><?php echo @$item->numberpeople; ?></td>
                        <td><?php echo date('d-m-Y h:i',@$item->timebook); ?></td>
                        <td><?php echo @$item->note; ?></td>
                        
                      <!--   <td align="center">
                          <a class="dropdown-item" href="tayho360-admin-restaurant-addRestaurantAdmin/?id=<?php echo @$item->id ?>">
                            <i class="bx bx-edit-alt me-1"></i>
                          </a>
                        </td> -->
                        <td align="center">
                          <a class="dropdown-item" onclick="return confirm('Bạn có chắc chắn muốn xóa không?');" href="/plugins/admin/tayho360-admin-restaurant-deleteBookTableAdmin/?id=<?php echo @$item->id ?>">
                            <i class="bx bx-trash me-1"></i>
                          </a>
                        </td>
                      </tr>
            <?php  }}
            }else{?>
           <tr>
                      <td colspan="10" align="center">Chưa có dữ liệu</td>
                    </tr>
           <?php    }
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