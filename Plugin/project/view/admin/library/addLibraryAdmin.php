<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/project-view-admin-library-listLibraryAdmin">Library</a> /</span>
    Thông tin Library
  </h4>
  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin Library</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-phone">Title (*)</label>
                    <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                  </div>  

                  <div class="mb-3 col-md-6">
                    <div class="mb-3">
                      <label class="form-label">Hình minh họa</label>
                      <?php showUploadFile('image','image',@$data->image,0);?>
                    </div>
                  </div>

                  <div class="mb-3 col-md-6">
                    <label class="form-label">Trạng thái</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="status" id="status">
                        <option value="1" <?php if(!empty($data->status) && $data->status=='active') echo 'selected'; ?> >Kích hoạt</option>
                        <option value="0" <?php if(!empty($data->status) && $data->status=='lock') echo 'selected'; ?> >Khóa</option>
                      </select>
                    </div>
                  </div>

                  <div class="mb-3 col-md-6">
                    <label class="form-label">Đường dẫn</label>
                    <input required type="text" class="form-control phone-mask" name="link" id="link" value="<?php echo @$data->link;?>" />
                  </div>

                  <div class="mb-3 col-md-6">
                    <label class="form-label">Mô tả ngắn</label>
                    <textarea rows="5" class="form-control" name="description" id="description"><?php echo @$data->description;?></textarea>
                  </div>

                  <div class="mb-3 col-md-6">
                    <label class="form-label">nội dung</label>
                    <textarea rows="5" class="form-control" name="content" id="content"><?php echo @$data->content;?></textarea>
                  </div>

                </div>
              <button type="submit" class="btn btn-primary">Lưu</button>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>