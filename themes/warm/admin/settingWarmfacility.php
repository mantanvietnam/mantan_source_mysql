<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Warm Theme - Cài đặt trang chủ</h4>

    <!-- Basic Layout -->
    <p><?php echo @$mess;  ?></p>
    <?= $this->Form->create(); ?>
      <div class="row">
        <!-- Khối banner -->
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg- col-xl-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối đầu trang</h5>
            </div>
            <div class="card-body row">
                <div class=" col-md-6 mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề</label>
                  <input type="text" class="form-control" name="title_top" value="<?php echo @$setting['title_top'];?>" />
                </div>

                <div class=" col-md-6 mb-3">
                  <label class="form-label" for="basic-default-fullname">nội dùng đâu tiên </label>
                  <input type="text" class="form-control" name="text_top" value="<?php echo @$setting['text_top'];?>" />
                </div>
                <div class="col-md-12 mb-3">
                <button type="submit" style="width: 90px;" class="btn btn-primary">Lưu</button>
              </div>
            </div>
          </div>
        </div>

         <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg- col-xl-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối thứ 2 </h5>
            </div>
            <div class="card-body row">
                <div class=" col-md-6 mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề</label>
                  <input type="text" class="form-control" name="title_2" value="<?php echo @$setting['title_2'];?>" />
                </div>
                <div class="mb-3  col-md-6 ">
                  <label class="form-label" for="basic-default-fullname">Ảnh </label>
                   <?php showUploadFile('image_2','image_2', @$setting['image_2'],1);?>
                </div>
                <div class=" col-md-12 mb-3">
                  <label class="form-label" for="basic-default-fullname">nội dùng </label>
                   <?php showEditorInput('text_2', 'text_2', @$setting['text_2']);?>
                </div>
                <div class="col-md-12 mb-3">
                <button type="submit" style="width: 90px;" class="btn btn-primary">Lưu</button>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg- col-xl-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối thứ 3 </h5>
            </div>
            <div class="card-body row">
                <div class=" col-md-6 mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề</label>
                  <input type="text" class="form-control" name="title_3" value="<?php echo @$setting['title_3'];?>" />
                </div>
                <div class="mb-3  col-md-6 ">
                  <label class="form-label" for="basic-default-fullname">Ảnh </label>
                   <?php showUploadFile('image_3','image_3', @$setting['image_3'],3);?>
                </div>
                <div class=" col-md-12 mb-3">
                  <label class="form-label" for="basic-default-fullname">nội dùng </label>
                   <?php showEditorInput('text_3', 'text_3', @$setting['text_3']);?>
                </div>
                <div class="col-md-12 mb-3">
                <button type="submit" style="width: 90px;" class="btn btn-primary">Lưu</button>
              </div>
            </div>
          </div>
        </div>

         <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg- col-xl-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối thứ 4</h5>
            </div>
            <div class="card-body row">
                <div class=" col-md-6 mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề</label>
                  <input type="text" class="form-control" name="title_4" value="<?php echo @$setting['title_4'];?>" />
                </div>
                <div class=" col-md-12 mb-3">
                  <label class="form-label" for="basic-default-fullname">nội dùng </label>
                   <?php showEditorInput('text_4', 'text_4', @$setting['text_4']);?>
                </div>
                <div class="col-md-12 mb-3">
                <button type="submit" style="width: 90px;" class="btn btn-primary">Lưu</button>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg- col-xl-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối thứ 5</h5>
            </div>
            <div class="card-body row">
                <div class=" col-md-6 mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề</label>
                  <input type="text" class="form-control" name="title_5" value="<?php echo @$setting['title_5'];?>" />
                </div>
                <div class="mb-3  col-md-6 ">
                  <label class="form-label" for="basic-default-fullname">Ảnh </label>
                   <?php showUploadFile('image_5','image_5', @$setting['image_5'],5);?>
                </div>
                <div class=" col-md-12 mb-3">
                  <label class="form-label" for="basic-default-fullname">nội dùng đầu </label>
                   <?php showEditorInput('text_5_top', 'text_5_top', @$setting['text_5_top']);?>
                </div>
                 <div class=" col-md-12 mb-3">
                  <label class="form-label" for="basic-default-fullname">nội dùng bên trái</label>
                   <?php showEditorInput('text_5_phai', 'text_5_phai', @$setting['text_5_phai']);?>
                </div>
                 <div class=" col-md-12 mb-3">
                  <label class="form-label" for="basic-default-fullname">nội dùng dưới</label>
                   <?php showEditorInput('text_5_duoi', 'text_5_duoi', @$setting['text_5_duoi']);?>
                </div>
                <div class="col-md-12 mb-3">
                <button type="submit" style="width: 90px;" class="btn btn-primary">Lưu</button>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg- col-xl-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối thứ 6</h5>
            </div>
            <div class="card-body row">
                <div class=" col-md-6 mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề</label>
                  <input type="text" class="form-control" name="title_6" value="<?php echo @$setting['title_6'];?>" />
                </div>
                <div class=" col-md-12 mb-3">
                  <label class="form-label" for="basic-default-fullname">nội dùng </label>
                   <?php showEditorInput('text_6', 'text_6', @$setting['text_6']);?>
                </div>
                <div class="col-md-12 mb-3">
                <button type="submit" style="width: 90px;" class="btn btn-primary">Lưu</button>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg- col-xl-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối thứ 7</h5>
            </div>
            <div class="card-body row">
                <div class=" col-md-6 mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề</label>
                  <input type="text" class="form-control" name="title_7" value="<?php echo @$setting['title_7'];?>" />
                </div>
                <div class=" col-md-12 mb-3">
                  <label class="form-label" for="basic-default-fullname">nội dùng </label>
                   <?php showEditorInput('text_7', 'text_7', @$setting['text_7']);?>
                </div>
                <div class="col-md-12 mb-3">
                <button type="submit" style="width: 90px;" class="btn btn-primary">Lưu</button>
              </div>
            </div>
          </div>
        </div>

      </div>
    <?= $this->Form->end() ?>
  </div>