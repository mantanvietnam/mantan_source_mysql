<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/hethongdaily-view-admin-customer-listCustomerAdmin">Khách hàng</a> /</span>
    Danh sách khách hàng
  </h4>

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
            <label class="form-label">Tên khách hàng</label>
            <input type="text" class="form-control" name="full_name" value="<?php if(!empty($_GET['full_name'])) echo $_GET['full_name'];?>">
          </div>

          <div class="col-md-2">
            <label class="form-label">Điện thoại khách</label>
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
            <label class="form-label">Điện thoại đại lý</label>
            <input type="text" class="form-control" name="phone_member" value="<?php if(!empty($_GET['phone_member'])) echo $_GET['phone_member'];?>">
          </div>
          
          <div class="col-md-2">
            <label class="form-label">&nbsp;</label>
            <button type="submit" class="btn btn-primary d-block">Tìm kiếm</button>
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
    <h5 class="card-header">Danh sách khách hàng - <?php echo number_format($totalData);?></h5>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th>ID</th>
            <th>Khách hàng</th>
            <th>Đơn hàng</th>
            <th>Đại lý</th>
            <th>Phân nhóm</th>
            <th>Xem</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          if(!empty($listData)){
            foreach ($listData as $item) {
              $status= '<br/><span class="text-danger">Khóa<span>';
              if($item->status=='active'){ 
                  $status= '<br/><span class="text-success">Kích hoạt<span>';
              }

              $sex = '<br/>Nữ';
              if($item->sex==1){ 
                  $sex = '<br/>Nam';
              }

              $birthday = '';
              if(!empty($item->birthday_date) && !empty($item->birthday_month) && !empty($item->birthday_year)){
                  $birthday = '<br/>'.$item->birthday_date.'/'.$item->birthday_month.'/'.$item->birthday_year;
              }

              $address = '';
              if(!empty($item->address)){
                  $address .= '<br/>'.$item->address;
              }

              $email = '';
              if(!empty($item->email)){
                  $email .= '<br/>'.$item->email;
              }

               $blue_check = '<span style="color: red;">chưa có tích xanh</span> <br/>
                   <a class="dropdown-item"  title="tích xanh" onclick="return confirm(\'Bạn có chắc chắn muốn cho tích xem cho người dùng không?\');" href="/blueCheckCustomerAdmin?id='.$item->id.'&status=active">
                             <i class="bx bxs-check-shield me-1" style="font-size: 22px;"></i>
                            </a>';
                  if($item->blue_check=='active'){
                    $blue_check = '<span style="color: #60bc2f;">đã có tích xanh</span> <br/>
                   <a class="dropdown-item"  title="bỏ tích xanh" onclick="return confirm(\'Bạn có chắc chắn muốn bỏ tích xanh người dùng không?\');" href="/blueCheckCustomerAdmin?id='.$item->id.'&status=lock">
                              <i class="bx bx-check-shield me-1" style="font-size: 22px;"></i>
                            </a>';
                  }
              
              echo '<tr>
              <td>'.$item->id.'</td>
             
              <td>
                '.$item->full_name.'<br/>
                '.$item->phone.'
                '.$address.'
                '.$email.'
                '.$sex.'
                '.$birthday.'
                '.$status.'<br/>
                '.@$item->token.'<br/>
               
              </td>
             
              <td><a href="/plugins/admin/product-view-admin-order-listOrderAdmin/?id_user='.$item->id.'">Đã mua '.number_format($item->number_order).' đơn</a></td>
              
              <td>'.$item->name_parent.'<br/>
                 '.$blue_check.'
              </td>
              <td>'.$item->groups.'</td>
              <td align="center"><a href="/plugins/admin/hethongdaily-view-admin-customer-infoCustomerAdmin/?id='.$item->id.'"><i class="bx bx-info-circle"></i></a></td>
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