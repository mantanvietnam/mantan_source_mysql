<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listPublisher">Hệ thống Nhà Xuất Bản</a> /</span>
    <?php echo !empty($data->id) ? 'Chỉnh sửa Nhà Xuất Bản' : 'Thêm Nhà Xuất Bản'; ?>
  </h4>
  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin Nhà Xuất Bản</h5>
          </div>
          <div class="card-body">
            <p><?php echo @$mess; ?></p>
            <form enctype="multipart/form-data" method="post" action="">
              <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken; ?>" />
              <div class="row">
                <div class="col-12">
                  <div class="mb-4">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label class="form-label" for="publisher-name">Tên Nhà Xuất Bản (*)</label>
                          <input required type="text" class="form-control" name="name" id="name" value="<?php echo @$data->name; ?>" />
                        </div>

                        <div class="mb-3">
                          <label class="form-label">Trạng thái</label>
                          <select class="form-select" name="status" id="status">
                            <option value="active" <?php echo (!empty($data->status) && $data->status == 'active') ? 'selected' : ''; ?>>Kích hoạt</option>
                            <option value="lock" <?php echo (!empty($data->status) && $data->status == 'lock') ? 'selected' : ''; ?>>Khóa</option>
                          </select>
                        </div>
                      <div class="mb-3">
                          <label class="form-label" for="publisher-description">Mô tả</label>
                          <input required type="text" class="form-control" name="description" id="description" value="<?php echo @$data->description; ?>" />
                      </div>
                    </div>
                    </div>
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
