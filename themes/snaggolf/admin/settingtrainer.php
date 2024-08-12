<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">SnagGolf Theme - Cài đặt trang chủ</h4>

    <p><?php echo @$mess;?></p>
    <?= $this->Form->create(); ?>
    <div class="row">
        <!-- Khối logo -->
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Khối banner</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Banner</label>
                  <?php showUploadFile('banner','banner', @$setting['banner'],1);?>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">nội dung banner</label>
                    <input type="text" class="form-control" name="contentbanner" value="<?php echo @$setting['contentbanner'];?>" />
                </div>
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề dưới banner</label>
                    <input type="text" class="form-control" name="titledeepbanner" value="<?php echo @$setting['titledeepbanner'];?>" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Nội dung</label>
                    <input type="text" class="form-control" name="contentbanner2" value="<?php echo @$setting['contentbanner2'];?>" />
                </div>
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Đối tượng áp dụng</label>
                    <input type="text" class="mb-1 form-control" name="li1" value="<?php echo @$setting['li1'];?>" />
                    <label class="form-label" for="basic-default-fullname">Nội dung áp dụng</label>
                    <input type="text" class="mb-1 form-control" name="li2" value="<?php echo @$setting['li2'];?>" />
                    <input type="text" class="mb-1 form-control" name="li3" value="<?php echo @$setting['li3'];?>" />
                    <input type="text" class="form-control mb-1" name="li4" value="<?php echo @$setting['li4'];?>" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Quyền lợi</label>
                    <input type="text" class="mb-1 form-control" name="li5" value="<?php echo @$setting['li5'];?>" />
                    <label class="form-label" for="basic-default-fullname">Nội dung quyền lợi</label>
                    <input type="text" class="mb-1 form-control" name="li6" value="<?php echo @$setting['li6'];?>" />
                    <input type="text" class="mb-1 form-control" name="li7" value="<?php echo @$setting['li7'];?>" />
                    <input type="text" class="mb-1 form-control" name="li8" value="<?php echo @$setting['li8'];?>" />
                    <input type="text" class="mb-1 form-control" name="li9" value="<?php echo @$setting['li9'];?>" />
                    <input type="text" class="form-control mb-1" name="li10" value="<?php echo @$setting['li10'];?>" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Yêu cầu</label>
                    <input type="text" class="form-control mb-1" name="li11" value="<?php echo @$setting['li11'];?>" />
                    <label class="form-label" for="basic-default-fullname">Nội dung yêu cầu</label>
                    <input type="text" class="form-control mb-1" name="li12" value="<?php echo @$setting['li12'];?>" />
                    <input type="text" class="form-control mb-1" name="li13" value="<?php echo @$setting['li13'];?>" />
                    <input type="text" class="form-control mb-1" name="li14" value="<?php echo @$setting['li14'];?>" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">nội dung bên dưới cùng thứ 1</label>
                    <input type="text" class="form-control" name="li15" value="<?php echo @$setting['li15'];?>" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">nội dung bên dưới cùng thứ 2</label>
                    <input type="text" class="form-control" name="li16" value="<?php echo @$setting['li16'];?>" />
                </div>
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
          </div>
        </div>
    </div>
</div>