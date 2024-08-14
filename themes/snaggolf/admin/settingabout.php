<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">SnagGolf Theme - Cài đặt trang về chúng tôi</h4>

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
                  <label class="form-label" for="basic-default-fullname">Banner about</label>
                  <?php showUploadFile('bannerabout','bannerabout', @$setting['bannerabout'],1);?> 
                 
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề trang about</label>
                    <input type="text" class="form-control" name="titleabout" value="<?php echo @$setting['titleabout'];?>" />
                </div>
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề thứ nhất</label>
                    <input type="text" class="form-control" name="title1" value="<?php echo @$setting['title1'];?>" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Nội dung tiêu đề thứ nhất</label>
                    <input type="text" class="form-control" name="contentabout1" value="<?php echo @$setting['contentabout1'];?>" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề thứ hai</label>
                    <input type="text" class="form-control" name="title2" value="<?php echo @$setting['title2'];?>" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Nội dung tiêu đề thứ hai</label>
                    <input type="text" class="form-control" name="contentabout2" value="<?php echo @$setting['contentabout2'];?>" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Tiêu đề thứ ba</label>
                    <input type="text" class="form-control" name="title3" value="<?php echo @$setting['title3'];?>" />
                </div>
                <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Nội dung tiêu đề thứ ba</label>
                    <input type="text" class="form-control" name="contentabout3" value="<?php echo @$setting['contentabout3'];?>" />
                </div>
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
            
          </div>
        </div>
    </div>
</div>