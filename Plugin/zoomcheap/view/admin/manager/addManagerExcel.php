<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Khách hàng</h4>
  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Nhập danh sách khách hàng có sẵn</h5>
          </div>
          <div class="card-body">
            <p style="color: red;"><?php echo $mess;?></p>
            <p>Tải file excel để nhập liệu: <a href="/plugins/zoomcheap/view/admin/manager/managerExcel.xlsx">DOWNLOAD EXCEL</a></p>
            <form enctype="multipart/form-data" method="post" action="">
              <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Chọn file excel để tải lên</label>
                    <input type="file" name="managerExcel" class="form-control" required>
                  </div>
                </div>
              </div>

              <button type="submit" class="btn btn-primary">Nhập dữ liệu</button>
            </form>
          </div>
        </div>
      </div>

    </div>
</div>