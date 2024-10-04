<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/colennao-view-admin-post-listtablepost">tin tức</a> /</span>
    Thông tin tin tức
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin tin tức</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Tên tin tức (*)</label>
                    <input required type="text" class="form-control phone-mask" name="title" id="title" value="<?php echo @$data->title;?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Tên tin tức tiếng anh</label>
                    <input type="text" class="form-control phone-mask" name="titleen" id="titleen" value="<?php echo @$data->titleen;?>" />
                  </div>
                  <div class="mb-3">
                      <label class="form-label">Chọn danh mục tin tức</label>
                      <select class="form-control" name="id_categorypost" id="id_categorypost">
                          <option value="">Chọn danh mục</option>
                          <?php if (!empty($datacategorypost)): ?>
                              <?php foreach ($datacategorypost as $category): ?>
                                  <option value="<?php echo $category->id; ?>" <?php echo (isset($data->id_categorypost) && $data->id_categorypost == $category->id) ? 'selected' : ''; ?>>
                                      <?php echo $category->name; // Hoặc tên danh mục bạn muốn hiển thị ?>
                                  </option>
                              <?php endforeach; ?>
                          <?php endif; ?>
                      </select>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Tên tác giả</label>
                    <input type="text" class="form-control phone-mask" name="author" id="author" value="<?php echo @$data->author;?>" />
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Tên tác giả tiếng anh</label>
                    <input type="text" class="form-control phone-mask" name="authoren" id="authoren" value="<?php echo @$data->authoren;?>" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">hình mình họa</label>
                    <?php showUploadFile('image','image',@$data->image,0);?>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Mô tả ngắn</label>
                    <textarea maxlength="160" rows="5" class="form-control" name="description" id="description"><?php echo @$data->description;?></textarea>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Mô tả ngắn tiếng anh</label>
                    <textarea maxlength="160" rows="5" class="form-control" name="descriptionen" id="descriptionen"><?php echo @$data->descriptionen;?></textarea>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Thời gian</label>
                    <input type="datetime-local" class="form-control" name="time" id="time" value="<?php echo isset($data->time) ? date('Y-m-d\TH:i', $data->time) : ''; ?>" />
                  </div>
                </div>
                <div class="col-md-6"> 
                    <div class="mb-3">
                    <label class="form-label">Nội dung</label>
                    <?php showEditorInput('content', 'content', @$data->content);?>
                    </div>
                </div>
                <div class="col-md-6"> 
                    <div class="mb-3">
                    <label class="form-label">Nội dung tiếng anh</label>
                    <?php showEditorInput('contentenen', 'contentenen', @$data->contentenen);?>
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