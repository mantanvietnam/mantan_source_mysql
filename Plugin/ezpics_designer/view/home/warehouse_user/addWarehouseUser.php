<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listWarehouse">Kho mẫu thiết kế</a> /</span>
    Thêm khách mua kho mẫu thiết kế
  </h4>
  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thêm khách mua kho mẫu thiết kế</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <form enctype="multipart/form-data" method="post" action="">
              <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Tài khoản khách hàng (*)</label>
                    <input required type="text" class="form-control phone-mask" name="phone" id="phone" value="" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Giá bán (*)</label>
                    <input type="number" min="0" class="form-control phone-mask" name="price" id="price" value="" required />
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Kho mẫu thiết kế (*)</label>
                    <select name="warehouse_id" id="warehouse_id" class="form-select color-dropdown" required onchange="getDataOption();">
                      <option value="">Chọn kho mẫu</option>
                      <?php
                      if(!empty($listWarehouses)){
                        foreach ($listWarehouses as $key => $value) {
                          if(empty($_GET['warehouse_id']) || $_GET['warehouse_id']!=$value->id){
                            echo '<option data-price="'.$value->price.'" data-date="'.$value->date_use.'" value="'.$value->id.'">'.$value->name.'</option>';
                          }else{
                            echo '<option data-price="'.$value->price.'" data-date="'.$value->date_use.'"  selected value="'.$value->id.'">'.$value->name.'</option>';
                          }
                        }
                      }
                      ?>
                    </select>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Số ngày sử dụng (*)</label>
                    <input type="number" min="0" class="form-control phone-mask" name="date_use" id="date_use" value="" required />
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="mb-3">
                    <label class="form-label">Ghi chú</label>
                    <textarea class="form-control" name="description" rows="5"></textarea>
                  </div>
                </div>
                
              </div>

              <button type="submit" class="btn btn-primary">Lưu</button>
            </form>
          </div>
        </div>
      </div>

    </div>
</div>

<script type="text/javascript">
  function getDataOption()
  {
    var selectedOption = $('#warehouse_id').find('option:selected');
    var dataPrice = selectedOption.data('price');
    var dataDate = selectedOption.data('date');

    $('#date_use').val(dataDate);
    $('#price').val(dataPrice);
  }

  getDataOption();
</script>

<?php include(__DIR__.'/../footer.php'); ?>