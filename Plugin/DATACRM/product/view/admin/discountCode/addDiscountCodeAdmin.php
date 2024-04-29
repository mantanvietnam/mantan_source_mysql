<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/product-view-admin-discountCode-listDiscountCodeAdmin">Mã giảm giá</a> /</span>
    Thông tin mã giảm giá
  </h4>
  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin  mã giảm giá</h5>
          </div>
          <div class="card-body">
            <p><?php echo @$mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Tên mã giảm giá (*)</label>
                    <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Mã (*)</label>
                    <input type="text" required class="form-control" placeholder="" name="code" id="code" value="<?php echo @$data->code;?>" />
                  </div> 
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Ngày hết hạn (*) </label>
                    <input type="text"  class="form-control datepicker" required placeholder="" name="deadline_at" id="deadline_at" value="<?php if(!empty($data->deadline_at)){  echo @$data->deadline_at->format('d/m/Y');}?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Giá tối thiểu được áp dụng </label>
                    <input  type="number" class="form-control phone-mask" name="applicable_price" id="applicable_price" value="<?php echo @$data->applicable_price;?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Trạng thái</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="status" id="status">
                        <option value="1" <?php if($data->status=='1') echo 'selected'; ?> >Hiển thị</option>
                        <option value="0" <?php if($data->status=='0') echo 'selected'; ?> >Ẩn</option>
                      </select>
                    </div>
                  </div>
                   <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Danh mục</label>
                    <select class="form-select form-select" id="category"  name="category" aria-label=".form-select-sm example">
                       <option value="">Tất cả danh mục</option>
                        <?php  foreach($categories as $key => $item){ ?>
                        <option <?php if($data->category==$item->id){ echo 'selected'; } ?> value="<?php echo $item->id; ?>"><?php echo $item->name; ?></option>        
                      <?php } ?>          
                    </select>
                  </div>          
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Phần trăm giảm giá (*)</label>
                    <input type="text" required autocomplete="off" class="form-control" placeholder="" name="discount" id="discount" value="<?php echo @$data->discount;?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Nội dung</label>
                    <input type="text" class="form-control" placeholder="" name="note" id="note" value="<?php echo @$data->note;?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Số lượng (*)</label>
                    <input type="number"  class="form-control" placeholder="" required name="number_user" id="number_user" value="<?php echo @$data->number_user;?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Giá giảm tối đa </label>
                    <input type="number"  class="form-control" placeholder="" name="maximum_price_reduction" id="maximum_price_reduction" value="<?php echo @$data->maximum_price_reduction;?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">ID khách hàng</label>
                    <input type="text" class="form-control" placeholder="Mỗi id cách nhau dấu phẩy" name="id_customers" id="id_customers" value="<?php echo @$data->id_customers;?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">ID sản phẩm</label>
                    <input type="text" class="form-control" placeholder="Mỗi id cách nhau dấu phẩy" name="id_products" id="id_products" value="<?php echo @$data->id_products;?>" />
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Lưu</button>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>

categorydiscount