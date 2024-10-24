<?php include(__DIR__.'/../../../../hethongdaily/view/home/header.php'); ?>

<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listCampaign">Chiến dịch</a> /</span>
    Danh sách
  </h4>

  <p><a href="/addCampaign" class="btn btn-primary"><i class="bx bx-plus"></i> Thêm mới</a></p>

  <!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          <div class="col-md-1">
            <label class="form-label">ID</label>
            <input type="text" class="form-control" name="id" value="<?php if(!empty($_GET['id'])) echo $_GET['id'];?>">
          </div>

          <div class="col-md-3">
            <label class="form-label">Tên chiến dịch</label>
            <input type="text" class="form-control" name="name" value="<?php if(!empty($_GET['name'])) echo $_GET['name'];?>">
          </div>
          
          <div class="col-md-2">
            <label class="form-label">&nbsp;</label>
            <button type="submit" class="btn btn-primary d-block">Tìm kiếm</button>
          </div>
        </div>
      </div>
    </div>
  </form>
  <!--/ Form Search -->

  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Danh sách chiến dịch</h5>
    <div id="desktop_view">
      <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr class="">
                <th>ID</th>
                <th>Tên chiến dịch</th>
                <th>Đăng ký</th>
                <th>Checkin</th>
                <th>Chưa Checkin</th>
                <th>Sửa</th> 
                <th>Xóa</th> 
                <!--
                <th>Lựa chọn</th>
                -->
              </tr>
            </thead>
            <tbody>
              <?php 
              if(!empty($listData)){
                foreach ($listData as $item) {
                  $image = '';
                  if(!empty($item->image)){
                    $image = '<br/><br/><img src="'.$item->image.'" width="100"/>';
                  }
                  echo '<tr>
                          <td>'.$item->id.'</td>
                          <td>'.$item->name.''.$image.'</td>
                          <td><a href="/listCustomerCampaign/?id='.$item->id.'">'.number_format($item->number_reg).' người</a></td>
                          <td><a href="/listCustomerCampaign/?id='.$item->id.'&checkin=1">'.number_format($item->number_checkin).' người</a></td>
                          <td><a href="/listCustomerCampaign/?id='.$item->id.'&checkin=2">'.number_format($item->yet_checkin).' người</a></td>
                           <td align="center">
                            <a class="dropdown-item" href="/addCampaign/?id='.$item->id.'">
                              <i class="bx bx-edit-alt me-1"></i>
                            </a>
                          </td>

                          <td align="center">
                            <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/deleteCampaign/?id='.$item->id.'">
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
    </div>
    <div id="mobile_view">
      <?php 
         if(!empty($listData)){
              foreach ($listData as $item) {
                 
                  
                echo '<div class="col-sm-12 p-2 m-2 border border-secondary mb-3">
                        <p><strong>ID: </strong>'.$item->id.'</p>
                        <p><strong>Tên chiến dịch: </strong>'.$item->name.'</p>
                        <p><strong>Đăng ký: </strong><a href="/listCustomerCampaign/?id='.$item->id.'">'.number_format($item->number_reg).' người</a></p>
                        <p><strong>Checkin: </strong><a href="/listCustomerCampaign/?id='.$item->id.'&checkin=1">'.number_format($item->number_checkin).' người</a></p>
                        <p><strong>Chưa Checkin: </strong><a href="/listCustomerCampaign/?id='.$item->id.'&checkin=2">'.number_format($item->yet_checkin).' người</a></p>
                        <p align="center">
                        
                          <a class="btn btn-success" href="/addCampaign/?id='.$item->id.'">
                              <i class="bx bx-edit-alt me-1" style="font-size: 22px;"></i>
                          </a>
                             &nbsp;&nbsp;&nbsp;&nbsp;
                          
                          <a class=" btn btn-danger" title="Xóa sản phẩm" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/deleteCampaign/?id='.$item->id.'">
                              <i class="bx bxs-trash me-1" style="font-size: 22px;"></i>
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



<?php include(__DIR__.'/../../../../hethongdaily/view/home/footer.php'); ?>