<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Bài học</h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin bài học</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Tên bài học (*)</label>
                    <input required type="text" class="form-control phone-mask" name="title" id="title" value="<?php echo @$data->title;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Danh mục</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="id_category" id="id_category">
                        <option value="">Chọn danh mục</option>
                        <?php 
                          foreach ($listCategory as $key => $item) {
                            if(empty($data->id_category) || $data->id_category!=$item->id){
                              echo '<option value="'.$item->id.'">'.$item->name.'</option>';
                            }else{
                              echo '<option selected value="'.$item->id.'">'.$item->name.'</option>';
                            }
                          }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Trạng thái</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="status" id="status">
                        <option value="active" <?php if(!empty($data->status) && $data->status=='active') echo 'selected'; ?> >Kích hoạt</option>
                        <option value="lock" <?php if(!empty($data->status) && $data->status=='lock') echo 'selected'; ?> >Khóa</option>
                      </select>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Mã video Youtube</label>
                    <input type="text" class="form-control phone-mask" name="youtube_code" id="youtube_code" value="<?php echo @$data->youtube_code;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Số lượt xem</label>
                    <input disabled type="number" class="form-control phone-mask" name="view" id="view" value="<?php echo (int) @$data->view;?>" />
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Hình minh họa</label>
                    <?php showUploadFile('image','image',@$data->image,0);?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Người đào tạo</label>
                    <input type="text" class="form-control phone-mask" name="author" id="author" value="<?php echo @$data->author;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Thời gian học (phút)</label>
                    <input required type="number" class="form-control phone-mask" name="time_learn" id="time_learn" value="<?php echo @$data->time_learn;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Mô tả ngắn</label>
                    <textarea maxlength="160" rows="5" class="form-control" name="description" id="description"><?php echo @$data->description;?></textarea>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="mb-3">
                    <label class="form-label">Nội dung bài học</label>
                    <?php showEditorInput('content', 'content', @$data->content);?>
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