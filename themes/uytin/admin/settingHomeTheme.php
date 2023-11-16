<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Cài đặt trang chủ</h4>

    <!-- Basic Layout -->
    <p><?php echo @$mess;?></p>
    <?= $this->Form->create(); ?>
      <div class="row">
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">KHỐI ĐẦU TRANG</h5>
            </div>
            <div class="card-body row">
              <div class=" col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Logo</label>
                  <?php showUploadFile('logo','logo', @$setting['logo'],1);?>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tiêu đề</label>
                  <input type="text" class="form-control" name="title1" value="<?php echo @$setting['title1'];?>" />
                </div>

                 <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Mô tả</label>
                  <textarea name="content1" class="form-control" rows="3"><?php echo @$setting['content1'];?></textarea>
                </div>
              </div>

              <div class=" col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Tên nút bấm</label>
                  <input type="text" class="form-control" name="submit1" value="<?php echo @$setting['submit1'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Link nút bấm</label>
                  <input type="text" class="form-control" name="linkgetstarted" value="<?php echo @$setting['linkgetstarted'];?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Link ảnh bên phải</label>
                  <?php showUploadFile('imagetop1','imagetop1', @$setting['imagetop1'],2);?>
                </div>
              </div>

              <div class=" col-sm-12col-md-6 col-lg-6 col-xl-6">
                <button type="submit" class="btn btn-primary">Lưu</button>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 col-xs-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">KHỐI SẢN PHẨM - DỊCH VỤ</h5>
            </div>
            <div  class="row card-body">
              <div class=" col-sm-12 col-md-6 col-lg-6 col-xl-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề</label>
                    <input type="text" class="form-control" name="title5" value="<?php echo @$setting['title5'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Mô tả</label>
                    <input type="text" class="form-control" name="minuscule5" value="<?php echo @$setting['minuscule5'];?>" />
                  </div>
              </div>

              <div class=" col-sm-12 col-md-6 col-lg-6 col-xl-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Mục tiêu 1</label>
                    <input type="text" class="form-control" name="checkbox1" value="<?php echo @$setting['checkbox1'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Mục tiêu 2</label>
                    <input type="text" class="form-control" name="checkbox2" value="<?php echo @$setting['checkbox2'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Mục tiêu 3</label>
                    <input type="text" class="form-control" name="checkbox3" value="<?php echo @$setting['checkbox3'];?>" />
                  </div>
              </div>

              <div class=" col-sm-12 col-md-6 col-lg-6 col-xl-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Mục tiêu 4</label>
                    <input type="text" class="form-control" name="checkbox4" value="<?php echo @$setting['checkbox4'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Mục tiêu 5</label>
                    <input type="text" class="form-control" name="checkbox5" value="<?php echo @$setting['checkbox5'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Mục tiêu 6</label>
                    <input type="text" class="form-control" name="checkbox6" value="<?php echo @$setting['checkbox6'];?>" />
                  </div>
              </div>

              <div class=" col-sm-12col-md-6 col-lg-6 col-xl-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Mục tiêu 7</label>
                    <input type="text" class="form-control" name="checkbox7" value="<?php echo @$setting['checkbox7'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Mục tiêu 8</label>
                    <input type="text" class="form-control" name="checkbox8" value="<?php echo @$setting['checkbox8'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Mục tiêu 9</label>
                    <input type="text" class="form-control" name="checkbox9" value="<?php echo @$setting['checkbox9'];?>" />
                  </div>
              </div>

              <div class=" col-sm-12col-md-6 col-lg-6 col-xl-6">
                <button type="submit" class="btn btn-primary">Lưu</button>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 col-xs-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">KHỐI THỨ BA</h5>
            </div>
            <div  class="row card-body">
              <div class=" col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề</label>
                    <input type="text" class="form-control" name="title8" value="<?php echo @$setting['title8'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Mô tả</label>
                    <input type="text" class="form-control" name="tminuscule8" value="<?php echo @$setting['tminuscule8'];?>" />
                  </div>
              </div>

              <div class=" col-sm-12 col-md-6 col-lg-6 col-xl-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname"><b>Tiêu đề 1</b></label>
                    <input type="text" class="form-control" name="title801" value="<?php echo @$setting['title801'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Nội dung 1</label>
                    <textarea class="form-control" name="content801" rows="3"><?php echo @$setting['content801'];?></textarea>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Đường link 1</label>
                    <input type="text" class="form-control" name="link801" value="<?php echo @$setting['link801'];?>" />
                  </div>
              </div>

              <div class=" col-sm-12 col-md-6 col-lg-6 col-xl-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname"><b>Tiêu đề 2</b></label>
                    <input type="text" class="form-control" name="title802" value="<?php echo @$setting['title802'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Nội dung 2</label>
                    <textarea class="form-control" name="content802" rows="3"><?php echo @$setting['content802'];?></textarea>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Đường link 2</label>
                    <input type="text" class="form-control" name="link802" value="<?php echo @$setting['link802'];?>" />
                  </div>
              </div>

              <div class=" col-sm-12 col-md-6 col-lg-6 col-xl-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname"><b>Tiêu đề 3</b></label>
                    <input type="text" class="form-control" name="title803" value="<?php echo @$setting['title803'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Nội dung 3</label>
                    <textarea class="form-control" name="content803" rows="3"><?php echo @$setting['content803'];?></textarea>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Đường link 3</label>
                    <input type="text" class="form-control" name="link803" value="<?php echo @$setting['link803'];?>" />
                  </div>
              </div>

              <div class=" col-sm-12 col-md-6 col-lg-6 col-xl-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname"><b>Tiêu đề 4</b></label>
                    <input type="text" class="form-control" name="title804" value="<?php echo @$setting['title804'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Nội dung 4</label>
                    <textarea class="form-control" name="content804" rows="3"><?php echo @$setting['content804'];?></textarea>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Đường link 4</label>
                    <input type="text" class="form-control" name="link804" value="<?php echo @$setting['link804'];?>" />
                  </div>
              </div>

              <div class=" col-sm-12 col-md-6 col-lg-6 col-xl-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname"><b>Tiêu đề 5</b></label>
                    <input type="text" class="form-control" name="title805" value="<?php echo @$setting['title805'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Nội dung 5</label>
                    <textarea class="form-control" name="content805" rows="3"><?php echo @$setting['content805'];?></textarea>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Đường link 5</label>
                    <input type="text" class="form-control" name="link805" value="<?php echo @$setting['link805'];?>" />
                  </div>
              </div>

              <div class=" col-sm-12 col-md-6 col-lg-6 col-xl-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname"><b>Tiêu đề 6</b></label>
                    <input type="text" class="form-control" name="title806" value="<?php echo @$setting['title806'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Nội dung 6</label>
                    <textarea class="form-control" name="content806" rows="3"><?php echo @$setting['content806'];?></textarea>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Đường link 6</label>
                    <input type="text" class="form-control" name="link806" value="<?php echo @$setting['link806'];?>" />
                  </div>
              </div>

              <div class=" col-sm-12col-md-6 col-lg-6 col-xl-6">
                <button type="submit" class="btn btn-primary">Lưu</button>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 col-xs-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">KHỐI SLIDE ĐỐI TÁC</h5>
            </div>
            <div  class="row card-body">
              <div class=" col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề</label>
                    <input type="text" class="form-control" name="titletaitro" value="<?php echo @$setting['titletaitro'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Mô tả</label>
                    <input type="text" class="form-control" name="nametaitro" value="<?php echo @$setting['nametaitro'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">ID album ảnh</label>
                    <input type="text" class="form-control" name="idslidetaitro" value="<?php echo @$setting['idslidetaitro'];?>" />
                  </div>
              </div>

              <div class=" col-sm-12col-md-6 col-lg-6 col-xl-6">
                <button type="submit" class="btn btn-primary">Lưu</button>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 col-xs-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">KHỐI FEEDBACK KHÁCH HÀNG</h5>
            </div>
            <div  class="row card-body">
              <div class=" col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề</label>
                    <input type="text" class="form-control" name="title11" value="<?php echo @$setting['title11'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Mô tả</label>
                    <input type="text" class="form-control" name="tminuscule11" value="<?php echo @$setting['tminuscule11'];?>" />
                  </div>
              </div>

              <div class=" col-sm-12col-md-6 col-lg-6 col-xl-6">
                <button type="submit" class="btn btn-primary">Lưu</button>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 col-xs-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">KHỐI ĐỘI NGŨ NHÂN SỰ</h5>
            </div>
            <div  class="row card-body">
              <div class=" col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề</label>
                    <input type="text" class="form-control" name="title12" value="<?php echo @$setting['title12'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Mô tả</label>
                    <input type="text" class="form-control" name="tminuscule12" value="<?php echo @$setting['tminuscule12'];?>" />
                  </div>
              </div>

              <div class=" col-sm-12 col-md-6 col-lg-6 col-xl-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname"><b>Họ và tên 1</b></label>
                    <input type="text" class="form-control" name="fullName121" value="<?php echo @$setting['fullName121'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Ảnh avatar 1</label>
                    <?php showUploadFile('avatar121','avatar121', @$setting['avatar121'],5);?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Chức danh 1</label>
                    <input type="text" class="form-control" name="positions121" value="<?php echo @$setting['positions121'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Mô tả 1</label>
                    <input type="text" class="form-control" name="content121" value="<?php echo @$setting['content121'];?>" />
                  </div>
              </div>

              <div class=" col-sm-12 col-md-6 col-lg-6 col-xl-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname"><b>Họ và tên 2</b></label>
                    <input type="text" class="form-control" name="fullName122" value="<?php echo @$setting['fullName122'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Ảnh avatar 2</label>
                    <?php showUploadFile('avatar122','avatar122', @$setting['avatar122'],6);?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Chức danh 2</label>
                    <input type="text" class="form-control" name="positions122" value="<?php echo @$setting['positions122'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Mô tả 2</label>
                    <input type="text" class="form-control" name="content122" value="<?php echo @$setting['content122'];?>" />
                  </div>
              </div>

              <div class=" col-sm-12 col-md-6 col-lg-6 col-xl-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname"><b>Họ và tên 3</b></label>
                    <input type="text" class="form-control" name="fullName123" value="<?php echo @$setting['fullName123'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Ảnh avatar 3</label>
                    <?php showUploadFile('avatar123','avatar123', @$setting['avatar123'],7);?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Chức danh 3</label>
                    <input type="text" class="form-control" name="positions123" value="<?php echo @$setting['positions123'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Mô tả 3</label>
                    <input type="text" class="form-control" name="content123" value="<?php echo @$setting['content123'];?>" />
                  </div>
              </div>

              <div class=" col-sm-12 col-md-6 col-lg-6 col-xl-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname"><b>Họ và tên 4</b></label>
                    <input type="text" class="form-control" name="fullName124" value="<?php echo @$setting['fullName124'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Ảnh avatar 4</label>
                    <?php showUploadFile('avatar124','avatar124', @$setting['avatar124'],8);?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Chức danh 4</label>
                    <input type="text" class="form-control" name="positions124" value="<?php echo @$setting['positions124'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Mô tả 4</label>
                    <input type="text" class="form-control" name="content124" value="<?php echo @$setting['content124'];?>" />
                  </div>
              </div>

              <div class=" col-sm-12col-md-6 col-lg-6 col-xl-6">
                <button type="submit" class="btn btn-primary">Lưu</button>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 col-xs-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">KHỐI TIN TỨC MỚI</h5>
            </div>
            <div  class="row card-body">
              <div class=" col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề</label>
                    <input type="text" class="form-control" name="title14" value="<?php echo @$setting['title14'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Mô tả</label>
                    <input type="text" class="form-control" name="tminuscule14" value="<?php echo @$setting['tminuscule14'];?>" />
                  </div>
              </div>

              <div class=" col-sm-12col-md-6 col-lg-6 col-xl-6">
                <button type="submit" class="btn btn-primary">Lưu</button>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 col-xs-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">KHỐI CHÂN TRANG</h5>
            </div>
            <div  class="row card-body">
              <div class=" col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tên công ty</label>
                    <input type="text" class="form-control" name="company" value="<?php echo @$setting['company'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Ảnh nền</label>
                    <?php showUploadFile('nenFooter','nenFooter', @$setting['nenFooter'],4);?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Facebook</label>
                    <input type="text" class="form-control" name="facebook" value="<?php echo @$setting['facebook'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Youtube</label>
                    <input type="text" class="form-control" name="youtube" value="<?php echo @$setting['youtube'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tiktok</label>
                    <input type="text" class="form-control" name="tiktok" value="<?php echo @$setting['tiktok'];?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Zalo</label>
                    <input type="text" class="form-control" name="zalo" value="<?php echo @$setting['zalo'];?>" />
                  </div>
              </div>

              <div class=" col-sm-12col-md-6 col-lg-6 col-xl-6">
                <button type="submit" class="btn btn-primary">Lưu</button>
              </div>
            </div>
          </div>
        </div>

       
      </div>
    <?= $this->Form->end() ?>
  </div>