<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/albums/list">Album ảnh</a> /</span>
    Thông tin album hình ảnh
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
                  <label class="form-label">Thời gian đăng *</label>
                  <input type="text" class="form-control datepicker" name="date" value="<?php if(empty($infoPost->time_create)) $infoPost->time_create = time();echo date('d/m/Y', $infoPost->time_create);?>" required />
                </div>

                <div class="mb-3 col-12 col-sm-12 col-md-12">
                  <label class="form-label">Hình minh họa *</label>
                  <?php showUploadFile('image','image',@$infoPost->image,0);?>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-email">Trạng thái</label>
                  <div class="input-group input-group-merge">
                    <select class="form-select" name="status" id="status">
                      <option value="active" <?php if(!empty($infoPost->status) && $infoPost->status=='active') echo 'selected'; ?> >Kích hoạt</option>
                      <option value="lock" <?php if(!empty($infoPost->status) && $infoPost->status=='lock') echo 'selected'; ?> >Khóa</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="col-12 col-sm-12 col-md-6">
                <div class="mb-3 col-12 col-sm-12 col-md-12">
                  <label class="form-label">Chuyên mục *</label>
                  <select name="idCategory" class="form-select" required>
                    <option value="">Chọn chuyên mục</option>
                    <?php 
                      if(!empty($listCategory)){
                        foreach ($listCategory as $key => $value) {
                          if(empty($infoPost->id_category) || $infoPost->id_category!=$value->id){
                            echo '<option value="'.$value->id.'">'.$value->name.'</option>';
                          }else{
                            echo '<option selected value="'.$value->id.'">'.$value->name.'</option>';
                          }
                        }
                      }
                    ?>
                  </select>
                </div>

                <div class="mb-3 col-12 col-sm-12 col-md-12">
                  <label class="form-label">Tác giả</label>
                  <input type="text" class="form-control" name="author" value="<?php echo @$infoPost->author;?>" />
                </div>

                

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