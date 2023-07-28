<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Chi tiết đơn hàng</h4>

  <!-- Responsive Table -->
  <div class="card row">
    <h5 class="card-header">Danh sách sản phẩm</h5>
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr class="">
            <th>ID</th>
            <th>Hình ảnh</th>
            <th>Sản phẩm</th>
            <th>Số lượng</th>
            <th>Đơn giá</th>
            <th>Thành tiền</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            if(!empty($detail_order)){
              $total = 0;

              foreach ($detail_order as $item) {
                $price_buy = $item->product->price * $item->quantity;
                $total += $price_buy;

                echo '<tr>
                        <td>'.$item->id_product.'</td>
                        <td><img src="'.$item->product->image.'" width="80" /></td>
                        <td>'.$item->product->title.'</td>
                        <td>'.$item->quantity.'</td>
                        <td>'.number_format($item->product->price).'đ</td>
                        <td>'.number_format($price_buy).'đ</td>
                      </tr>';
              }

              echo '<tr><td colspan="10">Tổng tiền: '.number_format($total).'</td></tr>';
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
  <!--/ Responsive Table -->
</div>