<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Thông tin bài viết</h4>

  <!-- Basic Layout -->
  <div class="row">
    <div class="col-xl">
      <div class="card mb-4">
        <div class="card-body">
          <?= $this->Form->create(); ?>
            <input type="hidden" name="idEdit" value="" />
            <div class="row">
              <div class="col-12 col-sm-12 col-md-6">
                <div class="mb-3 col-12 col-sm-12 col-md-12">
                  <label class="form-label">Tiêu đề *</label>
                  <input type="text" class="form-control" name="title" value="" required />
                </div>

                <div class="mb-3 col-12 col-sm-12 col-md-12">
                  <label class="form-label">Tác giả</label>
                  <input type="text" class="form-control" name="author" value="" />
                </div>

                <div class="mb-3 col-12 col-sm-12 col-md-12">
                  <label class="form-label">Ghim lên đầu</label>
                  <div class="row">
                    <div class="col-6">
                      <input type="radio" name="pin" value="1" /> Có 
                    </div>
                    <div class="col-6">
                      <input type="radio" name="pin" value="0" checked /> Không 
                    </div>
                  </div>
                </div>

                <div class="mb-3 col-12 col-sm-12 col-md-12">
                  <label class="form-label">Thời gian đăng *</label>
                  <input type="date" class="form-control" name="date" value="<?php echo date('d/m/Y');?>" required />
                </div>

                
              </div>

              <div class="col-12 col-sm-12 col-md-6">

                <div class="mb-3 col-12 col-sm-12 col-md-12">
                  <label class="form-label">Từ khóa</label>
                  <input type="text" class="form-control" name="keyword" value="" />
                </div>

                <div class="mb-3 col-12 col-sm-12 col-md-12">
                  <label class="form-label" for="basic-default-message">Mô tả ngắn *</label>
                  <textarea class="form-control" name="description" required rows="3"></textarea>
                </div>

                <div class="mb-3 col-12 col-sm-12 col-md-12">
                  <label class="form-label">Hình minh họa *</label>
                  <input type="text" class="form-control" name="image" value="" required />
                </div>

              </div>

              <div class="col-12 col-sm-12 col-md-12">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-message">Nội dung bải viết</label>
                  <textarea class="form-control" id="content" name="content" style="height: 500px;"></textarea>
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

<script type="text/javascript">
  bkLib.onDomLoaded(function() {
    new nicEditor({maxHeight : 500}).panelInstance('content');
  }); // Thay thế text area có id là area1 trở thành WYSIWYG editor sử dụng nicEditor
</script>