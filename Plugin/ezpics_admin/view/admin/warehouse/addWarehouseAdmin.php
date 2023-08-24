<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listWarehouse">Kho mẫu thiết kế</a> /</span>
    Thông tin kho mẫu thiết kế
  </h4>
  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin kho mẫu thiết kế</h5>
          </div>
          <div class="card-body">
            <p><?php echo @$mess;?></p>
            <form enctype="multipart/form-data" method="post" action="">
              <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Tài khoản designer (*)</label>
                    <input required type="text" class="form-control phone-mask" name="user" id="user" value="" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Tên kho mẫu thiết kế (*)</label>
                    <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name; ?>" />
                  </div>
                  
                  <div class="mb-3">
                    <label class="form-label">Giá bán (*)</label>
                    <input type="number" min="0" class="form-control phone-mask" name="price" id="price" value="<?php echo @$data->price; ?>" required />
                  </div>
                  
                  <div class="mb-3">
                    <label class="form-label">Số ngày sử dụng (*)</label>
                    <input type="number" min="1" class="form-control phone-mask" name="date_use" id="date_use" value="<?php echo @$data->date_use; ?>" required />
                  </div>
                  
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Giá tạo kho</label>
                    <input type="text" class="form-control phone-mask" name="price_creates" id="price_creates" value="0" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Từ khóa (*)</label>
                    <input required type="text" class="form-control phone-mask" name="keyword" id="keyword" value="<?php echo @$data->keyword; ?>" />
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