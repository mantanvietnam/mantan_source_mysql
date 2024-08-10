<?php include(__DIR__.'/../header.php'); ?>
<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listAffiliaterAgencyn">Tiếp thị liên kết</a> /</span>
    Danh sách người tiếp thị
  </h4>

  <p><a href="/addAffiliaterAgency" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p>

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
            <label class="form-label">ID người giới thiệu</label>
            <input type="text" class="form-control" name="id_father" value="<?php if(!empty($_GET['id_father'])) echo $_GET['id_father'];?>">
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
    <h5 class="card-header">Danh sách người giới thiệu</h5>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th>ID</th>
            <th>Hình ảnh</th>
            <th>Thông tin</th>
            <th>Tiếp thị</th>
            <th>Công nợ</th>
            <th>Người giới thiệu</th>
            <th>Sửa</th>
            <th>Xóa</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          if(!empty($listData)){
            foreach ($listData as $item) {
              $link_aff = $urlHomes.'book-online/?aff='.$item->phone;

              echo '<tr>
              <td>'.$item->id.'</td>

              <td><img src="'.$item->avatar.'" width="80" /></td>
             
              <td>
                '.$item->name.'<br/>
                '.$item->phone.'<br/>
                '.$item->address.'<br/>
                '.$item->email.'<br/><br/>
                <a target="_blank" href="'.$link_aff.'">'.$link_aff.'</a>
              </td>
             
              <td>
                <a href="/orderCustomerAgency/?id_aff='.$item->id.'">Đã bán được '.number_format($item->number_order).' đơn hàng</a>
                <br/><br/>
               
              </td>

              <td><a href="/listTransactionAffiliaterAgency?id_affiliater='.$item->id.'">'.number_format($item->money_back).'đ</a></td>

              <td>'.@$item->aff->name.' '.@$item->aff->phone.'</td>

              <td align="center">
                <a class="dropdown-item" href="/addAffiliaterAgency?id='.$item->id.'">
                  <i class="bx bx-edit-alt me-1"></i>
                </a>
              </td>

              <td align="center">
                <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="deleteAffiliaterAgency/?id='.$item->id.'">
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
<?php include(__DIR__.'/../footer.php'); ?>