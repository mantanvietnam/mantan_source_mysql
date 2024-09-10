<?php include(__DIR__.'/../header.php'); ?>

<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listStaff">Nhân viên</a> /</span>
    Danh sách nhân viên
  </h4>

  <p><a href="/addStaff" class="btn btn-primary"><i class="bx bx-plus"></i> Thêm mới</a> 

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
            <label class="form-label">Tên nhân viên</label>
            <input type="text" class="form-control" name="name" value="<?php if(!empty($_GET['name'])) echo $_GET['name'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Điện thoại</label>
            <input type="text" class="form-control" name="phone" value="<?php if(!empty($_GET['phone'])) echo $_GET['phone'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="<?php if(!empty($_GET['email'])) echo $_GET['email'];?>">
          </div>

          

          <div class="col-md-2">
            <label class="form-label">Trạng thái</label>
            <select name="status" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <option value="active" <?php if(!empty($_GET['status']) && $_GET['status']=='active') echo 'selected';?> >Kích hoạt</option>
              <option value="lock" <?php if(!empty($_GET['status']) && $_GET['status']=='lock') echo 'selected';?> >Khóa</option>
            </select>
          </div>
                   
          <div class="col-md-2">
          <label class="form-label">&nbsp;</label>
            <button type="submit" class="btn btn-primary d-block">Tìm kiếm</button>
          </div>
          
         <!--  <div class="col-md-1">
            <input type="submit" class="btn btn-danger d-block" value="Excel" name="action">
          </div> -->
        </div>
      </div>
    </div>
  </form>
  <!--/ Form Search -->

  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Danh sách nhân viên - <span class="text-danger"><?php echo number_format(@$totalData);?> nhân viên</span></h5>
    <?php echo @$mess;?>
    <div id="desktop_view">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th>ID</th>
              <th>Hình đại diện</th>
              <th>tên nhân viên </th>
              <th>số điện thoạt</th>
              <th>đia chỉ</th>
              <th>Email</th>
              <th>Sửa</th>
              <th>Xoá</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            if(!empty($listData)){
              foreach ($listData as $item) {
                $status= '<span class="text-danger">Khóa</span>';
                if($item->status=='active'){ 
                  $status= '<span class="text-success">Kích hoạt</span>';
                }

               

                $infoStaff = $item->name.'<br/>'.$item->phone;
                if(!empty($item->address)) $infoStaff .= '<br/>'.$item->address;
                if(!empty($item->email)) $infoStaff .= '<br/>'.$item->email;
                $infoStaff .= '<br/>'.$status;
                
                echo '<tr>
                <td>'.$item->id.'</td>
                <td><img class="img_avatar" src="'.$item->avatar.'" width="80" height="80" /></td>
                <td>'.$item->name.'</td>
                <td>'.$item->phone.'</td>
                <td>'.$item->address.'</td>
                <td>'.$item->email.'</td>
               

                <td width="5%" align="center">
                <a class="dropdown-item" href="/addStaff/?id='.$item->id.'">
                <i class="bx bx-edit-alt me-1"></i>
                </a>
                </td>

                <td align="center">
                <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/deleteStaff/?id='.$item->id.'">
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
                $status= '<span class="text-danger">Khóa</span>';
                if($item->status=='active'){ 
                  $status= '<span class="text-success">Kích hoạt</span>';
                }

               

                $infoStaff = $item->full_name.'<br/>'.$item->phone;
                if(!empty($item->address)) $infoStaff .= '<br/>'.$item->address;
                if(!empty($item->email)) $infoStaff .= '<br/>'.$item->email;
                if(!empty($item->facebook)) $infoStaff .= '<br/><a href="'.@$item->facebook.'" target="_blank"><i class="bx bxl-facebook-circle"></i></a>';
                  
                echo '<div class="col-sm-12 p-2 m-2 border border-secondary mb-3">
                        <center><img class="img_avatar" src="'.$item->avatar.'" style=" width:50%" /></center><br/>
                        <p><strong> Nhân viên: </strong>: '.$item->full_name.' (ID: '.$item->id.')</p>
                        <p><strong> Điện thoại: </strong>: '.$item->phone.'</p>
                        <p><strong> Địa chỉ: </strong>: '.$item->address.'</p>
                        <p  class="text-center mt-3">
                          <a title="Sửa" class="btn btn-success" href="/addStaff/?id='.$item->id.'">
                            <i class="bx bx-edit-alt me-1"></i>
                          </a> 

                          <a title="Xóa" class="btn btn-danger" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/deleteStaff/?id='.$item->id.'">
                            <i class="bx bx-trash me-1"></i>
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