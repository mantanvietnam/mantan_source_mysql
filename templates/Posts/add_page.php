<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/pages/list">Bài viết</a> /</span>
    Thông tin bài viết
  </h4>

  <!-- Basic Layout -->
  <div class="row">
    <div class="col-xl">
      <div class="card mb-4">
        <div class="card-body">
          <p><?php echo @$mess;?></p>
          <?= $this->Form->create(); ?>
            <div class="row">
              <div class="col-12 col-sm-12 col-md-6">
                <div class="mb-3 col-12 col-sm-12 col-md-12">
                  <label class="form-label">Tiêu đề *</label>
                  <input type="text" class="form-control" name="title" value="<?php echo @$infoPost->title;?>" required />
                </div>

                <div class="mb-3 col-12 col-sm-12 col-md-12">
                  <label class="form-label">Tác giả</label>
                  <input type="text" class="form-control" name="author" value="<?php echo @$infoPost->author;?>" />
                </div>

                <div class="mb-3 col-12 col-sm-12 col-md-12">
                  <label class="form-label">Ghim lên đầu</label>
                  <div class="row">
                    <div class="col-6">
                      <input type="radio" name="pin" value="1" <?php if(!empty($infoPost->pin) && $infoPost->pin==1) echo 'checked';?> /> Có 
                    </div>
                    <div class="col-6">
                      <input type="radio" name="pin" value="0" <?php if(empty($infoPost->pin)) echo 'checked';?> /> Không 
                    </div>
                  </div>
                </div>

                <div class="mb-3 col-12 col-sm-12 col-md-12">
                  <label class="form-label">Thời gian đăng *</label>
                  <input type="text" class="form-control datepicker" name="date" value="<?php if(empty($infoPost->time)) $infoPost->time = time();echo date('d/m/Y', $infoPost->time);?>" required />
                </div>

                
              </div>

              <div class="col-12 col-sm-12 col-md-6">

                <div class="mb-3 col-12 col-sm-12 col-md-12">
                  <label class="form-label">Từ khóa</label>
                  <input type="text" class="form-control" name="keyword" value="<?php echo @$infoPost->keyword;?>" />
                </div>

                <div class="mb-3 col-12 col-sm-12 col-md-12">
                  <label class="form-label" for="basic-default-message">Mô tả ngắn *</label>
                  <textarea class="form-control" name="description" required rows="3"><?php echo @$infoPost->description;?></textarea>
                </div>

                <div class="mb-3 col-12 col-sm-12 col-md-12">
                  <label class="form-label">Hình minh họa *</label>
                  <?php showUploadFile('image','image',@$infoPost->image,0);?>
                </div>

              </div>

              <div class="col-12 col-sm-12 col-md-12">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-message">Nội dung bải viết</label>
                  <?php showEditorInput('content', 'content', @$infoPost->content);?>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Lưu bài viết</button>
          <?= $this->Form->end() ?>
        </div>
      </div>
    </div>
  </div>
</div>