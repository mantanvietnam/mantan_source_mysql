<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Trainer Course Theme - Cài đặt trang Khoá Học cho HLV</h4>

    <p><?php echo @$mess;?></p>
    <?= $this->Form->create(); ?>

    <div class="row">
        <!-- Khối Giới thiệu chung -->
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối Giới thiệu chung</h5>
            </div>
            <div class="card-body row">
              <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề chung</label>
                  <input type="text" class="form-control" name="trainer_title" value="<?php echo @$setting['trainer_title'];?>" />
                </div>
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Thông tin chung</label>
                  <textarea class="form-control" name="content_info_trainer_course"><?php echo @$setting['content_info_trainer_course'];?></textarea>
                </div>
              </div>
              <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <button type="submit" class="btn btn-primary">Lưu</button>
              </div>
            </div>
          </div>
        </div>
        <!-- Khối Nội Dung -->
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối Nội Dung</h5>
            </div>
            <div class="card-body row">
              <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề 1</label>
                  <input type="text" class="form-control" name="trainer_title_1" value="<?php echo @$setting['trainer_title_1'];?>" />
                </div>
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Nội dung 1</label>
                  <textarea class="form-control" name="trainer_content_1"><?php echo @$setting['trainer_content_1'];?></textarea>
                </div>
              </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề 2</label>
                  <input type="text" class="form-control" name="trainer_title_2" value="<?php echo @$setting['trainer_title_2'];?>" />
                </div>
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Nội dung 2</label>
                  <textarea class="form-control" name="trainer_content_2"><?php echo @$setting['trainer_content_2'];?></textarea>
                </div>
              </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề 3</label>
                  <input type="text" class="form-control" name="trainer_title_3" value="<?php echo @$setting['trainer_title_3'];?>" />
                </div>
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Nội dung 3</label>
                  <textarea class="form-control" name="trainer_content_3"><?php echo @$setting['trainer_content_3'];?></textarea>
                </div>
              </div>
              <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <button type="submit" class="btn btn-primary">Lưu</button>
              </div>
            </div>
          </div>
        </div>
        <!-- Khối Đoạn Văn -->
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối Đoạn Văn</h5>
            </div>
            <div class="card-body row">
              <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Đoạn Văn</label>
                  <textarea class="form-control" name="trainer_paragraph"><?php echo @$setting['trainer_paragraph'];?></textarea>
                </div>
              </div>
              <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <button type="submit" class="btn btn-primary">Lưu</button>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>