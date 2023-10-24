<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/go_draw-view-admin-category-listCategoryAdmin.php">Danh mục</a> /</span>
    Thông tin danh mục
  </h4>

  <!-- Basic Layout -->
  <div class="row">
    <div class="col-xl">
      <div class="card mb-12">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Thông tin sản phẩm</h5>
        </div>
        <div class="card-body">
          <p><?php echo $mess;?></p>
          <?= $this->Form->create(); ?>
          <div class="row">
            <div class="col-12">
              <div class="nav-align-top mb-4">

                <div class="tab-content">
                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Tên danh mục (*)</label>
                      <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                    </div>

                    <div class="col-md-6 mb-3">
                      <label class="form-label">Mô tả</label>
                      <textarea maxlength="160" rows="3" class="form-control" name="description" id="description"><?php echo @$data->description;?></textarea>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <label class="form-label">Hình minh họa</label>
                      <div class="mb-3">
                        <div class="input-group">
                          <input type="text" class="form-control" aria-label="" aria-describedby="btnGroupAddonUpload"
                                 name="image" id="image" value="<?php echo @$data->image;?>"
                          >
                          <div class="input-group-prepend">
                            <div class="btn btn-secondary input-group-text" onclick="BrowseServerImage();" id="btnGroupAddonUpload">Upload</div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <img id="show-image" src="<?php echo @$data->image ?: 'https://godraw.2top.vn/plugins/go_draw/view/image/default-image.jpg'; ?>" alt=""
                        style="max-width: 400px; max-height: 400px"
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <button type="submit" class="btn btn-primary">Lưu</button>
            <?= $this->Form->end() ?>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="/ckfinder/ckfinder.js"></script>
  <script type="text/javascript">
    function BrowseServerImage(number = 0)
    {
      let finder = new CKFinder();
      finder.basePath = "../";
      finder.selectActionFunction = SetFileFieldImage;
      finder.popup();
    }

    function SetFileFieldImage(fileUrl)
    {
      $("#image").val(fileUrl);
      $("#show-image").attr('src', fileUrl);
    }
  </script>
</div>
