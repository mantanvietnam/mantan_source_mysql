<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light"><a href="/plugins/admin/go_draw-view-admin-agency_order_product-listAgencyOrderProductAdmin">Đơn hàng</a> /</span>
        Thông tin đơn hàng
    </h4>

    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-12">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Thông tin sản phẩm</h5>
                </div>
                <div class="card-body">
                    <div id="alert-message"><?php echo $mess;?></div>
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="nav-align-top mb-4">

                                <div class="tab-content">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Tên đại lý (*)</label>
                                            <div class="d-flex">
                                                <select name="agency_id" class="form-select color-dropdown" disabled>
                                                    <?php
                                                    if (!empty($listAgency)):
                                                        foreach ($listAgency as $agencyitem):
                                                            ?>
                                                          <option value="<?php echo $agencyitem->id; ?>" <?php if (@$agency->agency_id == $agencyitem->id) echo 'selected'; ?>><?php echo $agencyitem->name; ?></option>
                                                        <?php
                                                        endforeach;
                                                    endif;
                                                    ?>
                                                </select>
                                                <a class="btn btn-primary" href="<?php echo '/plugins/admin/go_draw-view-admin-agency-viewDetailAgencyAdmin/?id=' . @$agency->agency_id; ?>">
                                                  <i class="bx bx-edit-alt me-1"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="col-md-6 d-flex mb-3 align-items-end">
                                            <div>
                                                <?php if (@$data->status === 0) : ?>
                                                  <button type="button" class="btn btn-primary" onclick="acceptOrder(<?php echo @$data->id; ?>);">
                                                    Phê duyệt
                                                  </button>
                                                <?php elseif (@$data->status === 2): ?>
                                                  <button type="button" class="btn btn-danger" onclick="payOrder(<?php echo @$data->id; ?>);" id="btn-pay-order">
                                                    Thanh toán
                                                  </button>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Tổng tiền</label>
                                            <input disabled type="text" name="total_price" class="form-control" value="<?php echo number_format(@$data->total_price);?>">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                          <label class="form-label">Trạng thái</label>
                                          <select name="status" class="form-select color-dropdown" disabled>
                                            <option value="0" <?php if(@$data->status == 0) echo 'selected';?> >Đơn hàng mới</option>
                                            <option value="1" <?php if(@$data->status == 1) echo 'selected';?> >Đã xuất kho</option>
                                            <option value="2" <?php if(@$data->status == 2) echo 'selected';?> >Đã nhập kho</option>
                                            <option value="3" <?php if(@$data->status == 3) echo 'selected';?> >Đã thanh toán</option>
                                          </select>
                                        </div>
                                    </div>

                                    <h5>Các sản phẩm trong đơn hàng</h5>
                                    <?php
                                    if (!empty($listItem)){
                                        echo '<table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <td>ID sản phẩm</td>
                                                        <td>Tên sản phẩm</td>
                                                        <td>Số lượng</td>
                                                        <td>Giá tiền</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    ';

                                        foreach ($listItem as $key => $item){
                                            echo '<tr>
                                                        <td>'.$item->product_id.'</td>
                                                        <td>'.$item->name_product.'</td>
                                                        <td>'.number_format($item->amount).'</td>
                                                        <td>'.number_format($item->price).'</td>
                                                    </tr>';
                                                
                                        }

                                        echo '</tbody></table>';
                                    }
                                    ?>
                                        
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <?php
      global $csrfToken;
    ?>
    <script type="text/javascript">

      function acceptOrder(id)
      {
        var r = confirm('Bạn có chắc chắn muốn duyệt đơn hàng này không?');
        
        const token = "<?php echo $csrfToken;?>";

        if(r == true){
            $.ajax({
              method: "POST",
              url: '/apis/acceptAgencyOrderProductAdminApi',
              headers: {'X-CSRF-Token': token},
              data: {id:id},
              success: function (result) {
                if (result.code) {
                  $('#alert-message').append(`<p class="text-danger">${result.messages}</p>`);
                } else {
                  window.location.reload();
                }
              },
              error: function (error) {
                $('#alert-message').append(`<p class="text-danger">Đã xảy ra lỗi</p>`);
              },
              complete: function () {
                setTimeout(function () {
                  $('#alert-message').empty();
                }, 3000);
              }
            });
        }
      }

      function payOrder(id)
      {
        var r = confirm('Bạn có chắc chắn muốn thanh toán đơn hàng này không?');
        const token = "<?php echo $csrfToken;?>";

        if(r == true){
            $.ajax({
              method: "POST",
              url: '/apis/payAgencyOrderProductAdminApi',
              headers: {'X-CSRF-Token': token},
              data: {id:id},
              success: function (result) {
                if (result.code) {
                  $('#alert-message').append(`<p class="text-danger">${result.messages}</p>`);
                } else {
                  window.location.reload();
                }
              },
              error: function (error) {
                $('#alert-message').append(`<p class="text-danger">Đã xảy ra lỗi</p>`);
              },
              complete: function () {
                setTimeout(function () {
                  $('#alert-message').empty();
                }, 3000);
              }
            });
        }
      }
    </script>
</div>
