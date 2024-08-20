<?php include(__DIR__.'/../header.php'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Quà tặng</h4>
  <p><a href="/addCustomerGiftAgency" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a> 

  <!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">

          <div class="col-md-3">
            <label class="form-label">Tên quà tặng</label>
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
    <h5 class="card-header">Danh sách Quà tặng </h5>
    <div id="desktop_view">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th>ID</th>
              <th>Hình minh họa</th>
              <th>Tên sản phẩm</th>
              <th>Giá trị</th>
              <th>Số lượng</th>
              <th>Điểm quy đổi</th>
              <th>sản phẩn</th>
              <th>Hạng</th>
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
                          <td><img src="'.$item->image.'" width="100" /></td>
                          <td>'.@$item->name.'</td>
                          <td> '.number_format($item->price).' đ</td>
                          <td>'.@$item->quantity.'</td>
                          <td>'.@$item->point.'</td>
                          <td>'.@$item->product->title.'</td>
                          <td>'.@$item->rating->name.'</td>
                          <td align="center">
                            <a class="dropdown-item" href="/addCustomerGiftAgency/?id='.$item->id.'">
                              <i class="bx bx-edit-alt me-1"></i>
                            </a>
                          </td>
                          <td align="center">
                            <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn khóa không?\');" href="/deleteCustomerGiftAgency/?id='.$item->id.'">
                              <i class="bx bxs-trash me-1"></i>
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
                        <center><img src="'.$item->image.'" style=" width:50%" /></center><br/>
                        <p><strong> Tên Quà tặng: </strong>'.@$item->name.'</p>
                        <p><strong> Giá trị: </strong>'.number_format(@$item->price).'</p>
                        <p><strong> Số lượng: </strong>'.@$item->quantity.'</p>
                        <p><strong> Điểm quy đổi: </strong>'.number_format(@$item->unit).'đ</p>
                        <p><strong> Sản phẩm: </strong>'.@$item->product->title.'</p>
                        <p><strong> Xếp hạng: </strong>'.@$item->rating->name.'</p>
                        <p align="center">
                        
                          <a class="btn btn-success" href="/addCustomerGiftAgency/?id='.$item->id.'">
                              <i class="bx bx-edit-alt me-1" style="font-size: 22px;"></i>
                          </a>
                             &nbsp;&nbsp;&nbsp;&nbsp;
                          
                          <a class=" btn btn-danger" title="Xóa sản phẩm" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/deleteCustomerGiftAgency/?id='.$item->id.'">
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
<?php include(__DIR__.'/../footer.php'); ?>