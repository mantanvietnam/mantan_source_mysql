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
            // debug($order);
            $pay = json_decode($order->discount, true);
             // debug($pay);

            foreach ($detail_order as $item) {
              $price_buy = $item->price * $item->quantity;
              $total += $price_buy;

              echo '<tr>
              <td>'.$item->id_product.'</td>
              <td><img src="'.$item->product->image.'" width="80" /></td>
              <td>'.$item->product->title.'</td>
              <td>'.$item->quantity.'</td>
              <td>'.number_format($item->price).'đ</td>
              <td>'.number_format($price_buy).'đ</td>
              </tr>';
            }

            echo '<tr>
            <tr><td colspan="10">Quà tặng</td><tr>
            <tr>';
            foreach ($detail_order as $item) {
              if(!empty($item->product->present)){
                foreach ($item->product->present as $present) {
                  echo '<tr>
                  <td>'.$present->id.'</td>
                  <td><img src="'.$present->image.'" width="80" /></td>
                  <td>'.$present->title.'</td>
                  <td>'.$present->numberOrder.'</td>
                  <td>0đ</td>
                  <td>0đ</td>
                  </tr>';
                }}}

                echo '   <tr>
                <td colspan="10">
                Tổng tiền: '.number_format($total).'đ<br/>';
                if(!empty($pay['code1']) && !empty($pay['discount_price1'])){
                  echo '            <div class="cart-price-code-discount">
                  <div class="cart-price-item">
                  <div class="cart-price-item-title"> '. $pay['code1'] .': -'.number_format($pay['discount_price1']).'đ
                  </div>
                  </div>
                  </div>';
                }  
                if(!empty($pay['code2']) && !empty($pay['discount_price2'])){
                  echo '            <div class="cart-price-code-discount">
                  <div class="cart-price-item">
                  <div class="cart-price-item-title"> '. $pay['code2'] .': -'.number_format($pay['discount_price2']).'đ
                  </div>
                  </div>
                  </div>';
                }  
                if(!empty($pay['code3']) && !empty($pay['discount_price3'])){
                  echo '              <div class="cart-price-code-discount">
                  <div class="cart-price-item">
                  <div class="cart-price-item-title"> '. $pay['code3'] .': -'.number_format($pay['discount_price3']).'đ
                  </div>
                  </div>';  
                }
                echo '   
                Thành tiền: '.number_format($order->total).'đ<br/>
                </td>


                </tr>';
              }else{
                echo '<tr>
                <td colspan="10" align="center">Chưa có dữ liệu</td>
                </tr>';
              }
              ?>
            </tbody>
          </table>

          <div class="row m-5 ">
            <?php if($order->status=='new'){ ?>
              <div class="col-md-3"><a href="/plugins/admin/product-view-admin-order-treatmentOrder?status=browser&id=<?php echo $order->id ?>" onclick="return confirm('Bạn có chắc chắn duyệt đơn hàng này không?')" class="btn btn-primary ">Duyệt</a></div>
              <div class="col-md-3"><a href="/plugins/admin/product-view-admin-order-treatmentOrder?status=cancel&id=<?php echo $order->id ?>" onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?');" class="btn btn-danger">hủy</a></div>
            <?php }elseif($order->status=='browser'){ ?>
              <div class="col-md-3"><a href="/plugins/admin/product-view-admin-order-treatmentOrder?status=delivery&id=<?php echo $order->id ?>" onclick="return confirm('Bạn có chắc chắn giao hàng đơn hàng này không?');" class="btn btn-primary">giao hàng </a></div>
              <div class="col-md-3"><a href="/plugins/admin/product-view-admin-order-treatmentOrder?status=cancel&id=<?php echo $order->id ?>" onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?');" class="btn btn-danger">hủy</a></div>

            <?php }elseif($order->status=='delivery'){ ?>
              <div class="col-md-3"><a href="/plugins/admin/product-view-admin-order-treatmentOrder?status=done&id=<?php echo $order->id ?>" onclick="return confirm('Bạn có chắc chắn hoàng thành đơn này?');" class="btn btn-primary">đã xong</a></div>
              <div class="col-md-3"><a href="/plugins/admin/product-view-admin-order-treatmentOrder?status=cancel&id=<?php echo $order->id ?>" onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?');" class="btn btn-danger">hủy</a></div>
            <?php }elseif($order->status=='done'){
              echo '<div class="col-md-3">đã xong</div>';
            } elseif($order->status=='cancel'){
              echo '<div class="col-md-3">đã hủy</div>';
            } ?>
            <div class="col-md-3"><a href="/plugins/admin/product-view-admin-order-listOrderAdmin" class="btn btn-primary">quay lại</a></div>
          </div>


        </div>
      </div>
      <!--/ Responsive Table -->
    </div>