<?php include(__DIR__.'/../../../../hethongdaily/view/home/header.php'); ?>
<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listWebMember">Website đại lý</a> /</span>
    Danh sách website
  </h4>

  <p><a href="/addWebMember" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p>

  <!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Tìm kiếm dữ liệu</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          <div class="col-md-2">
            <label class="form-label">ID đại lý</label>
            <input type="text" class="form-control" name="id_member" value="<?php if(!empty($_GET['id_member'])) echo $_GET['id_member'];?>">
          </div>

          <div class="col-md-3">
            <label class="form-label">Tên miền</label>
            <input type="text" class="form-control" name="domain" value="<?php if(!empty($_GET['domain'])) echo $_GET['domain'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Giao diện</label>
            <input type="text" class="form-control" name="theme" value="<?php if(!empty($_GET['theme'])) echo $_GET['theme'];?>">
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
    <h5 class="card-header">Danh sách website</h5>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th>ID</th>
            <th>Đại lý</th>
            <th>Loại tài khoản</th>
            <th>Tên miền</th>
            <th>Gói giao diện</th>
            <th>Trạng thái</th>
            <th>Sửa</th>
            <th>Xóa</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          if(!empty($listData)){
            foreach ($listData as $item) {
              $status= 'Khóa';
              if($item->status=='active'){ 
                  $status= 'Kích hoạt';
              }

              $type = 'Cộng tác viên';
              if($item->type=='member'){ 
                  $type= 'Đại lý';
              }
              
              echo '<tr>
              <td>'.$item->id.'</td>
             
              <td>
                <a href="/listMember/?id='.$item->member->id.'">'.$item->member->name.'</a><br/>
                '.$item->member->phone.'
              </td>

              <td>'.$type.'</td>
             
              <td><a target="_blank" href="http://'.$item->domain.'">'.$item->domain.'</a></td>
              
              <td>'.$item->theme.'</td>
              <td>'.$status.'</td>

              <td align="center">
                <a class="dropdown-item" href="/addWebMember/?id='.$item->id.'">
                  <i class="bx bx-edit-alt me-1" style="font-size: 22px;"></i>
                </a>
              </td>

              <td align="center">
                <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/deleteWebMember/?id='.$item->id.'">
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
<?php include(__DIR__.'/../../../../hethongdaily/view/home/footer.php'); ?>