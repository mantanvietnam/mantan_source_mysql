<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Adult Course Theme - Cài đặt trang Khoá Học cho người lớn</h4>

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
                  <label class="form-label" for="basic-default-fullname">Giới thiệu</label>
                  <input type="text" class="form-control" name="introduction_adult_course" value="<?php echo @$setting['introduction_adult_course'];?>" />
                </div>
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Thông tin chung</label>
                  <textarea class="form-control" name="content_info_adult_course"><?php echo @$setting['content_info_adult_course'];?></textarea>
                </div>
              </div>
              <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <button type="submit" class="btn btn-primary">Lưu</button>
              </div>
            </div>
          </div>
        </div>
        <!-- Khối chi tiết khoá học -->
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối chi tiết khoá học</h5>
            </div>
            <div class="card-body row">
              <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Thời gian</label>
                  <input type="text" class="form-control" name="time_adult_course" value="<?php echo @$setting['time_adult_course'];?>" />
                </div>
              </div>
              <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Địa điểm</label>
                  <input type="text" class="form-control" name="place_adult_course" value="<?php echo @$setting['place_adult_course'];?>" />
                </div>
              </div>
              <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <button type="submit" class="btn btn-primary">Lưu</button>
              </div>
            </div>
          </div>
        </div>
        <!-- Khối nội dung chính -->
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối nội dung chính</h5>
            </div>
            <div class="card-body row">
              <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề 1</label>
                  <input type="text" class="form-control" name="title_adult_course_1" value="<?php echo @$setting['title_adult_course_1'];?>" />
                </div>
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Nội dung 1</label>
                  <textarea class="form-control" name="content_adult_course_1"><?php echo @$setting['content_adult_course_1'];?></textarea>
                </div>
              </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề 2</label>
                  <input type="text" class="form-control" name="title_adult_course_2" value="<?php echo @$setting['title_adult_course_2'];?>" />
                </div>
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Nội dung 2</label>
                  <textarea class="form-control" name="content_adult_course_2"><?php echo @$setting['content_adult_course_2'];?></textarea>
                </div>
              </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề 3</label>
                  <input type="text" class="form-control" name="title_adult_course_3" value="<?php echo @$setting['title_adult_course_3'];?>" />
                </div>
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Nội dung 3</label>
                  <textarea class="form-control" name="content_adult_course_3"><?php echo @$setting['content_adult_course_3'];?></textarea>
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