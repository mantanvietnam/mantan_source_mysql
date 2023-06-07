<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listProduct">Mẫu thiết kế</a> /</span>
    Thông tin mẫu thiết kế
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin mẫu thiết kế</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <form enctype="multipart/form-data" method="post" action="">
              <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Tên mẫu thiết kế (*)</label>
                    <input required type="text" class="form-control phone-mask" name="name" id="name" value="" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Danh mục (*)</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="category_id" id="category_id" required>
                        <option value="">Chọn danh mục</option>
                        <?php 
                          foreach ($listCategory as $key => $item) {
                            echo '<option value="'.$item->id.'">'.$item->name.'</option>';
                          }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Kích cỡ mẫu thiết kế (*)</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="size" id="size" required>
                        <option value="">Theo ảnh nền</option>
                        <?php 
                          $sizes = getSizeProduct();
                          if(!empty($sizes)){
                            foreach($sizes as $size){
                              echo '<option value="'.$size['width'].'-'.$size['height'].'">'.$size['name'].'</option>';
                            }
                          }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Từ khóa</label>
                    <input required type="text" class="form-control phone-mask" name="keyword" id="keyword" value="" />
                  </div>

                  
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Hình minh họa</label>
                    <input type="file" name="thumbnail" class="form-control">
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Hình nền (*)</label>
                    <input type="file" name="background" required class="form-control">
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Giá bán (*)</label>
                    <input type="number" min="0" max="99000" class="form-control phone-mask" name="sale_price" id="sale_price" value="0" required />
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Giá thị trường</label>
                    <input type="number" min="0" class="form-control phone-mask" name="price" id="price" value="0" />
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