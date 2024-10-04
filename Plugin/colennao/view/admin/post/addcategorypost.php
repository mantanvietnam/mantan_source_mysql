<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/colennao-view-admin-post-listcategorypost">tin tức</a> /</span>
    Thông tin danh mục tin tức
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin danh mục tin tức</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Tên danh mục tin tức (*)</label>
                    <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Tên danh mục tin tức tiếng anh</label>
                    <input type="text" class="form-control phone-mask" name="nameen" id="nameen" value="<?php echo @$data->nameen;?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label">hình mình họa</label>
                    <?php showUploadFile('image','image',@$data->image,0);?>
                  </div>
                </div>
                <div class="col-md-6">

                  <div class="mb-3">
                    <label class="form-label">Mô tả ngắn</label>
                    <textarea maxlength="160" rows="5" class="form-control" name="description" id="description"><?php echo @$data->description;?></textarea>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Mô tả ngắn tiếng anh</label>
                    <textarea maxlength="160" rows="5" class="form-control" name="descriptionen" id="descriptionen"><?php echo @$data->descriptionen;?></textarea>
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