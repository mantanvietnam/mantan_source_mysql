<script language="javascript" type="text/javascript" src="/plugins/ezpics_admin/view/admin/js/ezpics_admin.js"></script>
<link rel="stylesheet" href="/plugins/ezpics_admin/view/admin/css/ezpics_admin.css" />
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Thông tin Order mẫu thiết kế</h4>
  <!-- <p><a href="/plugins/admin/tayho360-admin-event-addEventAdmin.php" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p> -->
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
  <div class="card">
    <h5 class="card-header">Thông tin Order mẫu thiết kế</h5>
    <p><?php echo @$mess;?></p>
    <div id="desktop_view">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th>ID</th>
              <th>ảnh</th>
              <th>Thông tin</th>
              <th>Ngày Order</th> 
              <th>Nội dung</th> 
              <!-- <th>Sửa</th>  -->
              <th>Xóa</th> 
            </tr>
          </thead>
          <tbody>
            <?php 
              if(!empty($listData)){
                 //debug($listData);
                foreach ($listData as $item) {
                  $Member = getMember($item->customer_id);
                   //  debug($customer);
                if($item->status==1){
                    $status = 'đã xử lý';
                }else{
                    $status = 'chưa xử lý';
                }

                  echo '<tr>
                          <td>'.$item->id.'</td>
                          <td><img src="'.@$Member->avatar.'" width="100" height="100" ></td>
                          <td>'.@$Member->name.'<br>'.@$Member->email.'<br>'.@$Member->phone.'</td>
                          <td>'.$item->created_at.'</td>
                          <td>'.$item->content.'</td>
                          
                         
                         
                          <td align="center">
                            <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/plugins/admin/ezpics_admin-view-admin-contact-deleteOrderProductAdmin.php/?id='.$item->id.'">
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

             <!--
              <td>'.$status.'</td>
              <td align="center">
                            <a class="dropdown-item"  href="/plugins/admin/ezpics_designer-view-admin-member-addMemberAdmin.php/?id='.$item->id.'">
                              <i class="bx bx-edit-alt me-1"></i>
                            </a>
                          </td> -->
          </tbody>
        </table>
      </div>
    </div>

     <div id="mobile_view">
      <?php 
        if(!empty($listData)){
          foreach ($listData as $item) {
            $Member = getMember($item->customer_id);

            if($item->status==1){
                $status = 'Đã xử lý';
            }elseif($item->status==2){
                $status = 'Từ chối';
            }else{
                $status = 'Chưa xử lý';
            }

            echo '<div class="col-sm-12 p-2 m-2 border border-secondary mb-3">
                    <p><b>Người dùng '.$item->id.':</b> '.@$Member->name.'</p>
                    <p><img src="'.@$Member->avatar.'" width="100" height="100" ></p>
                    <p>'.@$Member->name.'<br>'.@$Member->email.'<br>'.@$Member->phone.'</p>
                    <p><b>Nội dung:</b> '.@$item->content.'</p>
                    <p align="center">
                      <a class="btn btn-danger" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/plugins/admin/ezpics_admin-view-admin-contact-deleteOrderProductAdmin.php/?id='.$item->id.'">
                        <i class="bx bx-trash me-1"></i> Xóa
                      </a>
                    </p>
                  </div>';
          }
         
        }else{
          echo '<div class="col-sm-12 item">
                  <p class="text-danger">Chưa có dữ liệu</p>
                </div>';
        }
      ?>
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