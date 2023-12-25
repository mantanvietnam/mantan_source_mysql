<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/ezpics_api-view-admin-font-listFontAdmin">Font chữ</a> /</span>
    Thông tin font chữ
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin  font chữ</h5>
          </div>
          <div class="card-body">
            <p><?php echo @$mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Tên font (*)</label>
                    <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Font WOFF</label>
                    <?php showUploadFile('font','font',@$data->font,0);?>
                  </div>    
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Font WOFF2</label>
                    <?php showUploadFile('font_woff2','font_woff2',@$data->font_woff2,1);?>
                  </div>     
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Font TTF</label>
                    <?php showUploadFile('font_ttf','font_ttf',@$data->font_ttf,2);?>
                  </div>    
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Chữ đậm</label>
                    <select class="form-select color-dropdown" name="weight" required>
                      <option value="">Chọn độ đậm</option>
                      <option value="normal" <?php if(!empty($data->weight) && $data->weight=='normal') echo 'selected';?> >Bình thường</option>
                      <option value="bold" <?php if(!empty($data->weight) && $data->weight=='bold') echo 'selected';?> >Chữ đậm</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Chữ nghiêng</label>
                    <select class="form-select color-dropdown" name="style" required>
                      <option value="">Chọn kiểu nghiêng</option>
                      <option value="normal" <?php if(!empty($data->style) && $data->style=='normal') echo 'selected';?> >Bình thường</option>
                      <option value="italic" <?php if(!empty($data->style) && $data->style=='italic') echo 'selected';?> >Chữ nghiêng</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Font OTF</label>
                    <?php showUploadFile('font_otf','font_otf',@$data->font_otf,3);?>
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