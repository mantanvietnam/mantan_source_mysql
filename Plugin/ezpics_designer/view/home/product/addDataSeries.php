<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listProductSeries">Mẫu in hàng loạt</a> /</span>
    Nhập dữ liệu mẫu in
  </h4>
  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Nhập dữ liệu mẫu in</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <p>Tải file excel để nhập liệu: <a href="/exportFormDataSeries/?id=<?php echo @$_GET['id'];?>">DOWNLOAD EXCEL</a></p>
            <form enctype="multipart/form-data" method="post" action="">
              <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Nội dung file excel</label>
                    <textarea class="form-control" name="content" rows="5"></textarea>
                  </div>
                </div>
              </div>

              <button type="submit" class="btn btn-primary">Xuất file ảnh</button>
            </form>
          </div>
        </div>
      </div>

    </div>
</div>

<?php include(__DIR__.'/../footer.php'); ?>