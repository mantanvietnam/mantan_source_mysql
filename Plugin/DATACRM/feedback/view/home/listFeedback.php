<?php include(__DIR__.'/../../../hethongdaily/view/home/header.php'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Thông tin Feedback khách hàng </h4>
  <!-- <p><a href="/plugins/admin/feedback-admin-addFeedbackAdmin" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p> -->
  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Danh sách Thông tin Feedback khách hàng </h5>
      <p><?php echo $mess;?></p>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
             <th>ID</th>
            <th>Ảnh đại diện</th>
            <th>họ và tên</th>
             <th>nội dung</th>
            <th>trạnh thái</th>
            <th>Xóa</th> 
          </tr>
        </thead>
        <tbody>
          <?php 
            if(!empty($listData)){
              foreach ($listData as $item) {

                 $status = '<span style="color: #60bc2f;">Kích hoạt</span> <br/>
                   <a class="dropdown-item"  title="khóa tài khoản" onclick="return confirm(\'Bạn có chắc chắn muốn khóa người dùng không?\');" href="/lockFeedback/?id='.$item->id.'&status=lock">
                              <i class="bx bx-lock-alt me-1" style="font-size: 22px;"></i>
                            </a>';
                  if($item->status=='lock'){
                    $status = '<span style="color: red;">Khóa</span> <br/>
                   <a class="dropdown-item"  title="Kích hoạt tài khoản" onclick="return confirm(\'Bạn có chắc chắn muốn Kích hoạt người dùng không?\');" href="/lockFeedback/?id='.$item->id.'&status=active">
                              <i class="bx bx-lock-open-alt me-1" style="font-size: 22px;"></i>
                            </a>';
                  }

                echo '<tr>
                        <td>'.$item->id.'</td>
                        <td><img src="'.$item->infoCustomer->avatar.'" style="width: 100px"></td>
                        <td>'.$item->infoCustomer->full_name.'</td>
                        <td>'.$item->feedback.'</td>
                        
                        <td align="center">'.$status.'</td>
                        <td align="center">
                          <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/deleteFeedback/?id='.$item->id.'">
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

<?php include(__DIR__.'/../../../hethongdaily/view/home/footer.php'); ?>