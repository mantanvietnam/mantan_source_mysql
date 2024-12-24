<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/colennao-view-admin-fasting-listfastingadmin">Tin tức giảm cân</a> /</span>
    Thông tin tin tức giảm cân
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin tin tức giảm cân</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Tên  tin tức giảm cân (*)</label>
                    <input required type="text" class="form-control phone-mask" name="title" id="title" value="<?php echo @$data->title;?>" required />
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Tên  tin tức giảm cân tiếng anh</label>
                    <input  type="text" class="form-control phone-mask" name="titleen" id="titleen" value="<?php echo @$data->titleen;?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Tên tác giả</label>
                    <input  type="text" class="form-control phone-mask" name="author" id="author" value="<?php echo @$data->author;?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Tên tác giả tiếng anh</label>
                    <input  type="text" class="form-control phone-mask" name="authoren" id="authoren" value="<?php echo @$data->authoren;?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label">text source 1</label>
                    <input  type="text" class="form-control phone-mask" name="textsource1" id="textsource1" value="<?php echo @$data->textsource1;?>" />
                  </div>
             
            
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Ảnh minh họa</label>
                    <?php showUploadFile('image','image',@$data->image,0);?>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Ảnh tác giả</label>
                    <?php showUploadFile('imageauthor','imageauthor',@$data->imageauthor,11);?>
                  </div>
                 
                  <div class="mb-3">
                    <label class="form-label">link source 1</label>
                    <input  type="text" class="form-control phone-mask" name="linksource1" id="linksource1" value="<?php echo @$data->linksource1;?>" />
                  </div>
               
                  <div class="mb-3">
                    <label class="form-label">link source 2 </label>
                    <input  type="text" class="form-control phone-mask" name="linksource2" id="linksource2" value="<?php echo @$data->linksource2;?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label">text source 2 </label>
                    <input  type="text" class="form-control phone-mask" name="textsource2" id="textsource2" value="<?php echo @$data->textsource2;?>" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Mô tả </label>
                    <?php showEditorInput('description', 'description', @$data->description);?>
                  </div>
                
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Mô tả tiếng anh</label>
                    <?php showEditorInput('descriptionen', 'descriptionen', @$data->descriptionen);?>
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