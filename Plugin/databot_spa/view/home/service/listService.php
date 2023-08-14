<?php include(__DIR__.'/../header.php'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Dịch vụ</h4>
  <p><a href="/addService" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p>
  <?php echo $mess;?>
  
  <!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          <div class="col-md-1">
            <label class="form-label">Mã dịch vụ</label>
            <input type="text" class="form-control" name="code" value="<?php if(!empty($_GET['code'])) echo $_GET['code'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Tên dịch vụ</label>
            <input type="text" class="form-control" name="name" value="<?php if(!empty($_GET['name'])) echo $_GET['name'];?>">
          </div>

          <div class="col-md-3">
            <label class="form-label">Danh mục</label>
            <select name="id_category" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <?php
              if(!empty($listCategory)){
                foreach ($listCategory as $key => $value) {
                  if(empty($_GET['id_category']) || $_GET['id_category']!=$value->id){
                    echo '<option value="'.$value->id.'">'.$value->name.'</option>';
                  }else{
                    echo '<option selected value="'.$value->id.'">'.$value->name.'</option>';
                  }
                }
              }
              ?>
            </select>
          </div>

          <div class="col-md-2">
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <option value="1" <?php if(isset($_GET['status']) && $_GET['status']=='1') echo 'selected';?> >Kích hoạt</option>
              <option value="0" <?php if(isset($_GET['status']) && $_GET['status']=='0') echo 'selected';?> >Khóa</option>
            </select>
          </div>

          
          <div class="col-md-1">
            <label class="form-label">&nbsp;</label>
            <button type="submit" class="btn btn-primary d-block">Lọc</button>
          </div>
        </div>
      </div>
    </div>
  </form>
  <!--/ Form Search -->

  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Danh sách dịch vụ</h5>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="" style="text-align: center;">
            <th>Mã dịch vụ</th>
            <th>Ảnh </th>
            <th>Dịch vụ</th>
            <th>Giá bán</th>
            <th>Trạng thái</th>
            <th>Sửa thông tin</th>
            <th>Xóa</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            if(!empty($listData)){
              foreach ($listData as $item) {
                
               
                if($item->status==0){
                 $status = '<span class="text-danger">Kích hoạt</span>';
                
                }elseif($item->status==1){
                  $status = '<span class="text-primary">Khóa</span>';
                }

                echo '<tr>
                        <td>
                          '.$item->id.'
                        </td>
                        <td>
                          <img src="'.$item->image.'" width="100" />
                          
                        </td>
                       
                        <td>'.$item->name.'</td>
                        <td>
                          '.number_format($item->price).'
                        </td>
                        <td>'.$status.'</td>
                        
                        <td align="center">
                           <a  class="dropdown-item" href="/addService?id='.$item->id.'" title="sửa thông tin dịch vụ">
                            <i class="bx bx bx-edit-alt me-1"></i>
                          </a>
                        </td>

                        <td align="center">
                          <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa thiết kế không?\');" href="/deleteService/?id='.$item->id.'">
                            <i class="bx bx-trash me-1"></i>
                          </a>
                        </td>
                      </tr>';
              }
            }else{
              echo '<tr>
                      <td colspan="10" align="center">Chưa có dịch vụ</td>
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
<?php include(__DIR__.'/../footer.php'); ?>