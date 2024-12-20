<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listCustomer">Quản lý Người Mượn Sách</a> /</span>
    <?php echo !empty($data->id) ? 'Chỉnh sửa Người Mượn' : 'Thêm Người Mượn'; ?>
  </h4>
  <!-- Basic Layout -->
  <div class="row">
    <div class="col-xl">
      <div class="card mb-12">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Thông tin Người Mượn</h5>
        </div>
        <div class="card-body">
          <p><?php echo @$mess; ?></p>
          <form enctype="multipart/form-data" method="post" action="">
            <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken; ?>" />
            <div class="row">
              <!-- Cột trái -->
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label" for="customer-name">Tên Người Mượn (*)</label>
                  <input required type="text" class="form-control" name="name" id="name" value="<?php echo @$data->name; ?>" />
                </div>
                <div class="mb-3">
                  <label class="form-label" for="customer-phone">Số Điện Thoại (*)</label>
                  <input required type="text" class="form-control" name="phone" id="phone" value="<?php echo @$data->phone; ?>" />
                </div>
                <div class="mb-3">
                  <label class="form-label" for="customer-email">Email</label>
                  <input type="email" class="form-control" name="email" id="email" value="<?php echo @$data->email; ?>" />
                </div>
              </div>
              <!-- Cột phải -->
              <div class="col-md-6">
                <div class="mb-3">
                  <label class="form-label" for="customer-address">Địa Chỉ (*)</label>
                  <input required type="text" class="form-control" name="address" id="address" value="<?php echo @$data->address; ?>" />
                </div>
                <div class="mb-3">
                  <label class="form-label" for="customer-birthday">Ngày Sinh</label>
                  <input autocomplete="off" type="text" class="form-control datepicker" name="birthday" id="birthday" value="<?php echo @$data->birthday ? date('d/m/Y', @$data->birthday) : ''; ?>" placeholder="dd/mm/yyyy"/>
                </div>

                <div class="mb-3">
                  <label class="form-label">Trạng thái</label>
                  <select class="form-select" name="status" id="status">
                    <option value="active" <?php echo (!empty($data->status) && $data->status == 'active') ? 'selected' : ''; ?>>Kích hoạt</option>
                    <option value="lock" <?php echo (!empty($data->status) && $data->status == 'lock') ? 'selected' : ''; ?>>Khóa</option>
                  </select>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary" style="width: 70px;">Lưu</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include(__DIR__.'/../footer.php'); ?>
