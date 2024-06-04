<?php include(__DIR__.'/../header.php'); ?>

<div class="container-xxl flex-grow-1 container-p-y">

  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/warehouseProductAgency">Kho hàng</a> /</span>
    Xem tồn kho
  </h4>

  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Danh sách hàng hóa trong kho của đại lý tuyến dưới</h5>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th width="5%">ID</th>
            <th width="10%">Hình ảnh</th>
            <th width="30%">Hàng hóa</th>
            <th width="15%">Số lượng</th>
            <th width="15%">Giá bán</th>
            <th width="25%">Xuất nhập lần cuối</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          if(!empty($listData)){
            foreach ($listData as $item) {
               echo '<tr>
              <td>'.$item->id.'</td>
              <td align="center"><img src="'.$item->product->image.'" width="100" /></td>
              <td>'.$item->product->title.'</td>
              <td>'.number_format($item->quantity).'</td>
              <td>'.number_format($item->product->price).'</td>
              <td>'.@$item->history->note.'</td>
             
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