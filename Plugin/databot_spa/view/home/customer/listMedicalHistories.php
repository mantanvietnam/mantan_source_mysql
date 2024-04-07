<?php include(__DIR__.'/../header.php'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Hồ sơ khách hàng</h4>
  <p><a href="/addMedicalHistories/?id_customer=<?php echo @$dataCustomer->id ?>" class="btn btn-primary" ><i class='bx bx-plus'></i> Thêm mới phiếu khám</a> </p>

  <!-- Form Search -->
  <form method="get" action="">
    <div class="card mb-4">
      <h5 class="card-header">Thông tin khách hàng</h5>
      <div class="card-body">
        <div class="row gx-3 gy-2 align-items-center">
          <div class="col-md-6">
            <label class="form-label">Họ tên: </label><span>&emsp; <?php echo @$dataCustomer->name ?></span>
          </div>
          <div class="col-md-6">
            <label class="form-label">Điện thoại: </label><span>&emsp; <?php echo @$dataCustomer->phone ?></span>
          </div>
          <div class="col-md-6">
            <label class="form-label">Địa chỉ: </label><span>&emsp; <?php echo @$dataCustomer->address ?></span>
          </div>
            <div class="col-md-6">
            <label class="form-label">Email: </label><span>&emsp; <?php echo @$dataCustomer->email ?></span>
          </div>
         
        </div>
      </div>
    </div>
  </form>
  <!--/ Form Search -->

  <!-- Responsive Table -->
  <div class="nav-align-top mb-4">
    <ul class="nav nav-tabs" role="tablist">
      <li class="nav-item">
        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
          Lịch sử khách hàng
        </button>
      </li>
      <li class="nav-item">
        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-rule" aria-controls="navs-top-info" aria-selected="false">
         Lịch sử dụng dịch vụ
       </button>
     </li>
     <li class="nav-item">
      <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-info" aria-controls="navs-top-info" aria-selected="false">
        Lịch sử dùng sản phẩm
     </button>
   </li>
 </ul>
 <div class="card-body tab-content ">
  <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
    <div class="card-body row">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th>ID</th>
              <th>Thời gian</th>
              <th>Hiện trạng</th>
              <th>Chuẩn đoán</th>
              <th>Phương pháp</th>
              <th>Chú ý</th>
              <th>Sửa</th>
            </tr>
          </thead>
          <tbody>
            <?php if(!empty($Medical)){
              foreach($Medical as $item){
                $image = '';
                if(!empty($item->image)){
                  $image = '<br/><img src="'.$item->image.'" width="80" />';
                }
                echo '<tr>
                        <td>'.$item->id.'</td>
                        <td>'.date('H:i d/m/Y', strtotime(@$item->created_at)).'</td>
                        <td>'.$item->title.$image.'</td>
                        <td>'.$item->result.'</td>
                        <td>'.$item->treatment_plan.'</td>
                        <td>'.$item->note.'</td>
                        
                        <td align="center">
                          <a class="dropdown-item" href="/addMedicalHistories/?id='.$item->id.'&id_customer='.$item->id_customer.'">
                            <i class="bx bx-edit-alt me-1"></i>
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
  </div>
  <div class="tab-pane fade" id="navs-top-rule" role="tabpanel">
    <div class="card-body row">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
             <th>ID</th>
              <th>Tên dịch vụ</th>
              <th>Nhân viên thực hiện</th>
              <th>Thời gian sử dụng</th>
              <th>Kết quả sau điều trị</th>
            </tr>
          </thead>
          <tbody>
              <?php if(!empty($service)){
                  foreach($service as $item){
                echo '<tr>
                        <td>'.$item->id.'</td>
                        <td>'.@$item->service->name.'</td>
                        <td>'.@$item->staff->name.'</td>
                        <td>'.date('H:i d/m/Y', strtotime(@$item->created_at)).'</td>
                        <td>'.$item->note.'</td>
                      </tr>';
              }
            }else{
              echo '<tr>
                      <td colspan="10" align="center">Chưa có dữ liệu</td>
                    </tr>';
            } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="tab-pane fade" id="navs-top-info" role="tabpanel">
    <div class="card-body row">
      <div class="table-responsive">
       <table class="table table-bordered" style=" text-align: center; ">
        <thead>
          <tr>
            <th rowspan='2'>ID</th>
            <th rowspan='2'>Thời gian</th>
            <th rowspan='2'>Khách hàng</th>
            <th rowspan="2">Thành tiền </th>
            <th colspan="4">Thông tin sản phẩn </th>
          </tr>
          <tr>
            <th>Sản phẩn</th>
            <th>Giá bán</th>
            <th>Số lượng </th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (!empty($productOrder)) {
            foreach ($productOrder as $key => $item) {
              $type = 'Chưa thanh toán';
              if ($item->status == 1) {
                $type = 'Đã thanh toán';
              } elseif ($item->status == 2) {
                $type = 'Dang sử lý';
              } elseif ($item->status == 3) {
                $type = 'Hủy';
              }
              $checkin = '';
              if (!empty($item->bed) && $item->status == 0) {
                $checkin = '<a class="dropdown-item" href="/checkinbed?id_order=' . $item->id . '&id_bed=' . $item->id_bed . '" title="check in"><i class="bx bx-exclude me-1"></i></a>';
              }

              if ($item->promotion > 101) {
                $promotion = number_format($item->promotion) . 'đ';
              } else {
                $promotion = $item->promotion . '%';
              }
              ?>
              <tr>
                <td rowspan='<?php echo count($item->product); ?>'>
                  <?php echo $item->id ?>
                </td>
                <td rowspan='<?php echo count($item->product); ?>'>
                  <?php echo date('Y-m-d H:i:s', $item->time); ?>
                </td>
                <td rowspan='<?php echo count($item->product); ?>'>
                  <?php echo $item->full_name ?>
                </td>
                <td rowspan='<?php echo count($item->product); ?>'
                  style="text-align: left;">Chưa giảm giá
                  <?php echo number_format(@$item->total) ?>đ<br />
                  Giảm giá:
                  <?php echo $promotion ?><br />
                  Tổng cộng:
                  <?php echo number_format(@$item->total_pay) ?>đ<br />
                  Trạng thái:
                  <?php echo $type ?>
                </td>
                <?php if (!empty($item->product)) {
                  foreach ($item->product as $k => $value) {

                    ?>

                    <td>
                      <?php echo $value->prod->name ?>
                    </td>
                    <td>
                      <?php echo number_format($value->price) ?>đ
                    </td>
                    <td>
                      <?php echo $value->quantity ?>
                    </td>

                  </tr>
                <?php }
              }
            }
          } else {
            echo '<tr>
            <td colspan="10" align="center">Chưa có đơn nào</td>
            </tr>';
          } ?>
        </tbody>
      </table>
      </div>
    </div>
  </div>
</div>
</div>


    <!-- Phân trang -->
   <!--  <div class="demo-inline-spacing">
      <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
          <?php
            if(@$totalPage>0){
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
    </div> -->
    <!--/ Basic Pagination -->
  </div>
  <!--/ Responsive Table -->
</div>



<?php include(__DIR__.'/../footer.php'); ?>