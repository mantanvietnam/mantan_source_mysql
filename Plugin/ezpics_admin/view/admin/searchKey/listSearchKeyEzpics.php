<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Thông tin lịch sử  tìm kiếm </h4>
 <!-- <p><a href="/plugins/admin/ezpics_admin-view-admin-discountCode-addDiscountCodeAdmin" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p> -->
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
    <h5 class="card-header">Thông tin lịch sử  tìm kiếm </h5>
      <p><?php echo @$mess;?></p>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th>ID</th>
            <th>Tên </th>
            <th>số   </th>
            <!-- <th>sữa</th> -->
            <th>Xóa</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            if(!empty($listData)){
              foreach ($listData as $item) {
                $data = '';
                if(!empty($item->deadline_at)){
                  $data = $item->deadline_at->format('d/m/Y');
                }
                if($item->discount>101){
                  $discount = number_format($item->discount).'đ';
                }else{
                   $discount = $item->discount.'%';
                }

                echo '<tr>
                        <td>'.$item->id.'</td>
                        <td>'.@$item->keyword.'</td>
                        <td>'.@$item->number_search.'</td>
                        <td align="center">
                          <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/plugins/admin/ezpics_admin-view-admin-searchKey-deleteSearchKeyAdmin/?id='.$item->id.'">
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

       <?php  if(!empty($listData)){
              foreach ($listData as $items) { ?>
                        
                        <div class="modal fade" id="basicModal<?php echo $items->id; ?>"  name="id">
                                
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Sửa keyword: <?php echo $items->id; ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
                              </div>
                             <form action="/plugins/admin/ezpics_admin-view-admin-searchKey-addSearchKeyAdmin" method="GET">
                               <div class="modal-footer">
                                <input type="hidden" value="<?php echo $items->id; ?>"  name="id">
                                <input type="hidden" value="0"  name="status">
                                <div class="card-body">
                                  <div class="row gx-3 gy-2 align-items-center">
                                    <div class="col-md-12">
                                      <input type="hidden" value="<?php echo $items->id; ?>"  name="id">
                                    </div>
                                    <div class="col-md-12">
                                      <label class="form-label" for="basic-default-phone">keyword</label>
                                      <input type="text" value="<?php echo $items->keyword; ?>" class="form-control" name="keyword">
                                    </div>
                                  </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Lưu</button>
                              </div>
                             </form>
                              
                            </div>
                          </div>
                        </div>
                      <?php }} ?>

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