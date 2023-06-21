<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listWarehouse">Kho mẫu thiết kế</a> /</span>
    Thông tin khách mua kho mẫu thiết kế
  </h4>
  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin khách mua kho mẫu thiết kế</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <form enctype="multipart/form-data" method="post" action="">
              <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Tài khoản khách hàng (*)</label>
                    <input required type="text" class="form-control phone-mask" name="phone" id="phone" value="<?php echo @$data->phone; ?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Giá bán (*)</label>
                    <input type="number" min="0" class="form-control phone-mask" name="price" id="price" value="" required />
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Kho mẫu thiết kế (*)</label>
                    <select class="form-select" name="warehouses_id" id="warehouses_id" required>
                        <option value="">Chọn kho mẫu</option>
                        <?php 
                          foreach ($listWarehouses as $key => $item) {
                            if($item->id == $data->warehouses_id){
                              echo '<option selected value="'.$item->id.'">'.$item->name.'</option>';
                            }else{
                              echo '<option  value="'.$item->id.'">'.$item->name.'</option>';
                            }
                          }
                        ?>
                      </select>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Hình minh họa</label>
                    <input type="file" name="thumbnail" value="<?php echo @$data->thumbnail; ?>" class="form-control">
                  </div>

                </div>

                <div class="col-md-12">
                  <div class="mb-3">
                    <label class="form-label">Mô tả về mẫu thiết kế</label>
                    <textarea class="form-control" name="description" rows="5"><?php echo @$data->description; ?></textarea>
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

<?php include(__DIR__.'/../footer.php'); ?>