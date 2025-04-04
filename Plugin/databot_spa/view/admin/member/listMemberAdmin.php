<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Người dùng</h4>
  <p><a href="/plugins/admin/ezpics_admin-view-admin-member-addMemberAdmin" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p>

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

          <div class="col-md-2">
            <label class="form-label">Họ tên</label>
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
              <option value="1" <?php if(!empty($_GET['status']) && $_GET['status']==1) echo 'selected';?> >Kích hoạt</option>
              <option value="0" <?php if(isset($_GET['status']) && $_GET['status']==0) echo 'selected';?> >Khóa</option>
            </select>
          </div>

          <div class="col-md-2">
            <label class="form-label">Loại tài khoản</label>
            <select name="type" class="form-select color-dropdown">
              <option value="">Tất cả</option>
              <option value="1" <?php if(!empty($_GET['type']) && $_GET['type']==1) echo 'selected';?> >Member</option>
              <option value="0" <?php if(!empty($_GET['type']) && $_GET['type']==0) echo 'selected';?> >Nhân viên</option>
            </select>
          </div>
          <div class="col-md-2">
            <label class="form-label">Sắp xếp </label>
            <select name="order" class="form-select color-dropdown">
              <option value="">Mới nhất</option>
              <option value="1" <?php if(!empty($_GET['order']) && $_GET['order']=='1') echo 'selected';?> >Hoạt động gần đây</option>
            </select>
          </div>
          
          <div class="col-md-1">
            <label class="form-label">&nbsp;</label>
            <button type="submit" class="btn btn-primary d-block">Lọc</button>
          </div>
          <div class="col-md-1">
            <label class="form-label">&nbsp;</label>
            <input type="submit" class="btn btn-danger d-block" value="Excel" name="action">
          </div>
        </div>
      </div>
    </div>
  </form>
  <!--/ Form Search -->

  <!-- Responsive Table -->
  <div class="card row">
    <div class="row">
      <div class="col-md-6">
        <h5 class="card-header">Danh sách người dùng - <b class="text-danger"><?php echo number_format($totalData);?></b> người dùng</h5>
      </div>
     
    </div>
     <p><?php echo @$mess;?></p>  
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th>ID</th>
            <th>Thông tin </th>
            <th>Ngày đăng ký</th>
            <th>Đăng nhập</th>
            <th>Hết hạn</th>
            <th>Loại tài khoản</th>
            <!-- <th>Trạng thái</th> -->
            <th>Sửa</th>
            <th>Khóa</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            if(!empty($listData)){
              foreach ($listData as $item) {
                $type = 'Nhân viên';
                if($item->type==1){
                  $type = 'Chủ Spa';
                }

                $status = 'Kích hoạt <br/>
                 <a class="dropdown-item"  title="khóa tài khoản" onclick="return confirm(\'Bạn có chắc chắn muốn khóa người dùng không?\');" href="/plugins/admin/ezpics_admin-view-admin-member-lockMemberAdmin/?id='.$item->id.'&status=1">
                            <i class="bx bx-lock-alt me-1" style="font-size: 22px;"></i>
                          </a>';
                if($item->status==0){
                  $status = 'Khóa <br/>
                 <a class="dropdown-item"  title="Kích hoạt tài khoản" onclick="return confirm(\'Bạn có chắc chắn muốn Kích hoạt người dùng không?\');" href="/plugins/admin/ezpics_admin-view-admin-member-lockMemberAdmin/?id='.$item->id.'&status=2">
                            <i class="bx bx-lock-open-alt me-1" style="font-size: 22px;"></i>
                          </a>';
                }

                echo '<tr>
                        <td>'.$item->id.'</td>
                        <td>'.$item->name.'<br/>
                          '.$item->phone.'<br/>
                          '.$item->email.'<br/>
                        </td>
                        <td>'.date('d-m-Y', $item->created_at).'</td>
                        <td>'.date('d-m-Y', $item->last_login).'</td>
                        <td>'.date('d-m-Y', $item->dateline_at).'</td>
                        <td>'.$type.'</td>
                       
                        
                         <td align="center">
                          <a class="dropdown-item" href="/plugins/admin/databot_spa-view-admin-member-addMemberAdmin/?id='.$item->id.'">
                            <i class="bx bx-edit-alt me-1" style="font-size: 22px;"></i>
                          </a>
                        </td>
                        <td align="center">'.$status.'</td>
                      </tr>';
              }
            }else{
              echo '<tr>
                      <td colspan="10" align="center">Chưa có người dùng</td>
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