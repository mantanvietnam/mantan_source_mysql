<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/project-view-admin-project-listProjectAdmin">Project</a> /</span>
    Thông tin Project
  </h4>
  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin Project</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-phone">Title (*)</label>
                    <input required type="text" class="form-control phone-mask" name="title" id="title" value="<?php echo @$data->title;?>" />
                  </div>
                   <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-phone">Project name (*)</label>
                    <input required type="text" class="form-control phone-mask" name="name_project" id="name_project" value="<?php echo @$data->name_project;?>" />
                  </div>

                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-phone">Project duration</label>
                    <input  type="text" class="form-control phone-mask" name="duration" id="duration" value="<?php echo @$data->duration;?>" />
                  </div>

                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-phone">Lead agency</label>
                    <input  type="text" class="form-control phone-mask" name="lead_agency" id="lead_agency" value="<?php echo @$data->lead_agency;?>" />
                  </div>

                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-phone">Implementing agency</label>
                    <input  type="text" class="form-control phone-mask" name="implementing_agency" id="implementing_agency" value="<?php echo @$data->implementing_agency;?>" />
                  </div>

                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-phone">Donors</label>
                    <input  type="text" class="form-control phone-mask" name="donor" id="donor" value="<?php echo @$data->donor;?>" />
                  </div>

                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-phone">Total investment cost</label>
                    <input  type="text" class="form-control phone-mask" name="investment" id="investment" value="<?php echo @$data->investment;?>" />
                  </div>

                  <div class="mb-3 col-md-6">
                    <label class="form-label">Đường dẫn</label>
                    <input type="text" class="form-control phone-mask" name="slug_drive" id="slug_drive" value="<?php echo @$data->slug_drive;?>" />
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
                        <option value="active" <?php if(!empty($data->status) && $data->status=='active') echo 'selected'; ?> >Kích hoạt</option>
                        <option value="lock" <?php if(!empty($data->status) && $data->status=='lock') echo 'selected'; ?> >Khóa</option>
                      </select>
                    </div>
                  </div>
                  <div class="mb-3 col-md-6">
                    <label class="form-label">ID ảnh</label>
                    <input required type="text" class="form-control phone-mask" name="id_photo" id="id_photo" value="<?php echo @$data->id_photo;?>" />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label class="form-label">ID Vieo</label>
                    <input required type="text" class="form-control phone-mask" name="id_video" id="id_video" value="<?php echo @$data->id_video;?>" />
                  </div>
                  
                  <div class="mb-3 col-md-6">
                    <label class="form-label">ID Tin tức 1</label>
                    <input required type="text" class="form-control phone-mask" name="id_post" id="id_post" value="<?php echo @$data->id_post;?>" />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label class="form-label">ID Tin tức 2</label>
                    <input required type="text" class="form-control phone-mask" name="id_post2" id="id_post2" value="<?php echo @$data->id_post2;?>" />
                  </div>
                  <div class="mb-3 col-md-6">
                    <div class="mb-3">
                      <label class="form-label">Hình banner</label>
                      <?php showUploadFile('banner','banner',@$data->banner,1);?>
                    </div>
                  </div>
                  <div class="mb-3 col-md-6">
                    <label class="form-label">Mô tả ngắn</label>
                    <textarea maxlength="160" rows="5" class="form-control" name="description" id="description"><?php echo @$data->description;?></textarea>
                  </div>
              </div>
              <button type="submit" class="btn btn-primary">Lưu</button>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>