<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listProductAgency">Sản phẩm</a> /</span>
    Nhập dữ liệu sản phẩm
  </h4>
  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
           
          </div>
          <div class="card-body">
            <p><?php echo @$mess;?></p>
            <p>Tải file excel để nhập liệu: <a href="/plugins/hethongdaily/view/home/product/list_data_san_pham.xlsx">DOWNLOAD EXCEL</a></p>
            
            <form enctype="multipart/form-data" method="post" action="">
              <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Chọn file excel để tải lên</label>
                    <input type="file" name="dataProduct" class="form-control" required>
                  </div>
                </div>
              </div>

              <button type="submit" class="btn btn-primary">Nhập danh sách sản phẩm</button>
            </form>
          </div>
        </div>
      </div>

    </div>
</div>

<?php include(__DIR__.'/../footer.php'); ?>