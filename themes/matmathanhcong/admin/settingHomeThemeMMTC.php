<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Cài đặt trang chủ</h4>

    <!-- Basic Layout -->
    <p><?php echo @$mess;?></p>
    <?= $this->Form->create(); ?>
      <div class="row">
        <!-- Khối header -->
        <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối header</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Ảnh logo</label>
                    <?php showUploadFile('logo','logo', @$setting['logo'],1);?>
                </div>
                
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tên thương hiệu</label>
                  <input type="text" class="form-control" name="name_company" value="<?php echo @$setting['name_company'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Mô tả thương hiệu</label>
                  <textarea name="des_company" class="form-control"><?php echo @$setting['des_company'];?></textarea>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Email</label>
                  <input type="text" class="form-control" name="email" value="<?php echo @$setting['email'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Hotline</label>
                  <input type="text" class="form-control" name="hotline" value="<?php echo @$setting['hotline'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề khối hỏi đáp</label>
                  <input type="text" class="form-control" name="ques_title" value="<?php echo @$setting['ques_title'];?>" />
                </div>

                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
          </div>
        </div>

        <!-- Khối banner -->
        <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối banner</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề banner</label>
                  <input type="text" class="form-control" name="titleBanner" value="<?php echo @$setting['titleBanner'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Mô tả banner</label>
                  <textarea name="descBanner" class="form-control"><?php echo @$setting['descBanner'];?></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
          </div>
        </div>

        <!-- Khối tin tức 1 -->
        <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối tin tức 1</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề tin tức</label>
                  <input type="text" class="form-control" name="title2" value="<?php echo @$setting['title2'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">ID chuyên mục tin tức</label>
                  <input type="text" class="form-control" name="idNews2" value="<?php echo @$setting['idNews2'];?>" />
                </div>

                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
          </div>
        </div>

        <!-- Khối tin tức 1 -->
        <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối tin tức 2</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề tin tức</label>
                  <input type="text" class="form-control" name="title3" value="<?php echo @$setting['title3'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">ID chuyên mục tin tức</label>
                  <input type="text" class="form-control" name="idNews3" value="<?php echo @$setting['idNews3'];?>" />
                </div>

                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
          </div>
        </div>

        <!-- Ý nghĩa của những con số -->
        <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Ý nghĩa của những con số</h5>
            </div>
            <div class="card-body">

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Số 1</label>
                  <textarea name="number1" class="form-control"><?php echo @$setting['number1'];?></textarea>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Số 2</label>
                  <textarea name="number2" class="form-control"><?php echo @$setting['number2'];?></textarea>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Số 3</label>
                  <textarea name="number3" class="form-control"><?php echo @$setting['number3'];?></textarea>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Số 4</label>
                  <textarea name="number4" class="form-control"><?php echo @$setting['number4'];?></textarea>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Số 5</label>
                  <textarea name="number5" class="form-control"><?php echo @$setting['number5'];?></textarea>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Số 6</label>
                  <textarea name="number6" class="form-control"><?php echo @$setting['number6'];?></textarea>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Số 7</label>
                  <textarea name="number7" class="form-control"><?php echo @$setting['number7'];?></textarea>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Số 8</label>
                  <textarea name="number8" class="form-control"><?php echo @$setting['number8'];?></textarea>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Số 9</label>
                  <textarea name="number9" class="form-control"><?php echo @$setting['number9'];?></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
          </div>
        </div>

        <!-- Tài khoản mạng xã hội -->
        <div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Tài khoản mạng xã hội</h5>
            </div>
            <div class="card-body row">
              <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Facebook</label>
                  <input type="text" class="form-control" name="facebook" value="<?php echo @$setting['facebook'];?>" />
                </div>
              </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Youtube</label>
                  <input type="text" class="form-control" name="youtube" value="<?php echo @$setting['youtube'];?>" />
                </div>
              </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">TikTok</label>
                  <input type="text" class="form-control" name="tiktok" value="<?php echo @$setting['tiktok'];?>" />
                </div>
              </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Instagram</label>
                  <input type="text" class="form-control" name="instagram" value="<?php echo @$setting['instagram'];?>" />
                </div>
              </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">LinkedIn</label>
                  <input type="text" class="form-control" name="linkedIn" value="<?php echo @$setting['linkedIn'];?>" />
                </div>
              </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Twitter</label>
                  <input type="text" class="form-control" name="twitter" value="<?php echo @$setting['twitter'];?>" />
                </div>
              </div>

              <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <button type="submit" class="btn btn-primary">Lưu</button>
              </div>
            </div>
          </div>
        </div>



      </div>
    <?= $this->Form->end() ?>
  </div>