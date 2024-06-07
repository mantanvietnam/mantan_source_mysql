<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/albums/list">Album ảnh</a> /</span>
    <span class="text-muted fw-light"><a href="/albuminfos/list/?id=<?php echo $infoAlbum->id;?>"><?php echo $infoAlbum->title;?></a> /</span>
    Thông tin hình ảnh
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
                  <label class="form-label">Hình ảnh *</label>
                  <?php showUploadFile('image','image',@$infoPost->image,0);?>
                </div>

                <div class="mb-3 col-12 col-sm-12 col-md-12">
                  <label class="form-label">Tiêu đề</label>
                  <input type="text" class="form-control" name="title" value="<?php echo @$infoPost->title;?>" />
                </div>

                <div class="mb-3 col-12 col-sm-12 col-md-12">
                  <label class="form-label">Link liên kết</label>
                  <input type="text" class="form-control" name="link" value="<?php echo @$infoPost->link;?>" />
                </div>
              </div>

              <div class="col-12 col-sm-12 col-md-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-message">Mô tả ngắn</label>
                  <textarea class="form-control" name="description" rows="5"><?php echo @$infoPost->description;?></textarea>
                </div>
              </div>

            </div>
            <button type="submit" class="btn btn-primary">Lưu thông tin</button>
          <?= $this->Form->end() ?>
        </div>
      </div>
    </div>
  </div>
</div>