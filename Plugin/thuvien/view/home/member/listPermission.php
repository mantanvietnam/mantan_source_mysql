  <?php include(__DIR__.'/../header.php'); ?>

<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listPermission">Nhóm phân quyền </a> /</span>
    Danh sách phân quyền 
  </h4>

  <p><a href="/addPermission" class="btn btn-primary"><i class="bx bx-plus"></i> Thêm mới</a></p> 

  </p>

  <!-- Form Search -->
 <!--  <form method="get" action="">
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
          
     
        </div>
      </div>
    </div>
  </form> -->
  <!--/ Form Search -->

  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Danh sách nhóm phân quyền </h5>
    <?php echo @$mess;?>
    <div id="desktop_view">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th>ID</th>
              <th>Tên nhóm</th>
              <th>Quyền Hạn</th>
              <th>Sửa</th>
              <th>Xoá</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            if(!empty($listData)){
              foreach ($listData as $item) {
              $permission =  '<ul style="margin-left: 15px;">';
                foreach ($listPermissionMenu as $keyGroup => $permissionMenu)
                { 
                  $checkGroup= false;
                  $permission .=  '<li id="liPermission-'.$keyGroup.'-'.$key.'">
                  <span>'.$permissionMenu['name'].'</span>
                  <ul style="margin-left: 30px;">';
                  foreach ($permissionMenu['sub'] as $menu2) { 
                    if(!empty($item->permission)){
                      if (isset($item->permission) && in_array(@$menu2['permission'], $item->permission)) {
                        $permission .= '<li>'.$menu2['name'].'</li>';
                         $checkGroup= true;
                       }
                    }
                  }
                  $permission .=  '  </ul>
                  </li>';

                  if(!$checkGroup){
                  $permission .= '<script type="text/javascript">$("#liPermission-'.$keyGroup.'-'.$key.'" ).remove();</script>';
                  }
                }

                $permission .= '</ul>';
                echo '<tr>
                <td>'.$item->id.'</td>
                <td>'.$item->name.'</td>
                <td>'.@$permission.'</td>
               

                <td width="5%" align="center">
                <a class="dropdown-item" href="/addPermission/?id='.$item->id.'">
                <i class="bx bx-edit-alt me-1"></i>
                </a>
                </td>

                <td align="center">
                <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/addPermission/?id='.$item->id.'">
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
              $permission =  '<ul style="margin-left: 0px;">';
                foreach ($listPermissionMenu as $keyGroup => $permissionMenu)
                { 
                  $checkGroup= false;
                  $permission .=  '<li id="liPermissions-'.$keyGroup.'-'.$key.'">
                  <span>'.$permissionMenu['name'].'</span>
                  <ul style="margin-left: 0px;">';
                  foreach ($permissionMenu['sub'] as $menu2) { 
                    if (isset($item->permission) && in_array($menu2['permission'], $item->permission)) {
                     $permission .= '<li>'.$menu2['name'].'</li>';
                      $checkGroup= true;
                    }
                  }
                  $permission .=  '  </ul>
                  </li>';

                  if(!$checkGroup){
                  $permission .= '<script type="text/javascript">$("#liPermissions-'.$keyGroup.'-'.$key.'" ).remove();</script>';
                  }
                }

                $permission .= '</ul>';
                echo '<div class="col-sm-12 p-2 m-2 border border-secondary mb-3">
               <p><strong> tên nhóm: </strong>:'.$item->name.'</p>
                <p><strong> quyền hạn: </strong>:'.@$permission.'</p>
               

                <p align="center">
                <a class="btn btn-success" href="/addGroupStaff/?id='.$item->id.'">
                <i class="bx bx-edit-alt me-1"></i>
                </a>
                 &nbsp;&nbsp;&nbsp;&nbsp;
                <a class="btn btn-danger" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/deteleGroupStaff/?id='.$item->id.'">
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