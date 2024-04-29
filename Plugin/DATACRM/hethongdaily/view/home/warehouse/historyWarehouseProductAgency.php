<?php include(__DIR__.'/../header.php'); ?>

<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/warehouseProductAgency">Kho hàng</a> /</span>
    Lịch sử xuất nhập tồn
  </h4>

  <p><a href="/addRequestProductAgency" class="btn btn-primary"><i class='bx bx-plus'></i> Nhập hàng vào kho</a></p>

  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Lịch sử xuất nhập tồn</h5>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th width="5%">ID</th>
            <th width="10%">Thời gian</th>
            <th width="10%">Hình ảnh</th>
            <th width="15%">Hàng hóa</th>
            <th width="10%">Kiểu giao dịch</th>
            <th width="10%">Số lượng</th>
            <th width="25%">Ghi chú</th>
            <th width="10%">Đơn hàng</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          if(!empty($listData)){
            foreach ($listData as $item) {
              $type= '';
              $idOrder= '';
              
              if($item->type == 'minus'){
                $type= '<p class="text-danger">Xuất</p>';
                $idOrder = '<a href="/orderCustomerAgency/?id='.$item->id_order.'">'.$item->id_order.'</a>';
              }elseif($item->type == 'plus'){
                $type= '<p class="text-success">Nhập</p>';
                $idOrder = '<a href="/requestProductAgency/?id='.$item->id_order_member.'">'.$item->id_order_member.'</a>';
              }


              echo '<tr>
              <td>'.$item->id.'</td>
              <td>'.date('H:i d/m/Y', $item->create_at).'</td>
              <td align="center"><img src="'.$item->product->image.'" width="100" /></td>
              <td>'.$item->product->title.'</td>
              <td>'.$type.'</td>
              <td>'.number_format($item->quantity).'</td>
              <td>'.$item->note.'</td>
              <td>'.$idOrder.'</td>
             
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