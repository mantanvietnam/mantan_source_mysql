<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">	 Theme - Home Setting</h4>

    <!-- Basic Layout -->
    <p><?php echo @$mess;?></p>
    <?= $this->Form->create(); ?>
      <div class="row">
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
          <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0 form-label">Khối banner</h5>
            </div>
            <div class="card-body row ">
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                  <label class="form-label" for="basic-default-fullname">Logo</label>
                   <?php showUploadFile('image_logo','image_logo', @$setting['image_logo'],1);?>
                </div>

                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                  <label class="form-label" for="basic-default-fullname">id slide</label>
                  <input type="text" class="form-control" name="id_slide" value="<?php echo @$setting['id_slide'];?>" />
                </div>
                <div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">Logo</label>
                   <?php showUploadFile('image1','image1', @$setting['image1'],2);?>
                </div><div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">Logo</label>
                   <?php showUploadFile('image2','image2', @$setting['image2'],3);?>
                </div><div class="mb-3 col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
                  <label class="form-label" for="basic-default-fullname">Logo</label>
                   <?php showUploadFile('image3','image3', @$setting['image3'],4);?>
                </div>
                 
                <div class="mb-3 col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <button type="submit" class="btn btn-primary" style="width:75px; height: 35px;">Lưu</button>
              </div>
            </div>
          </div>
        </div>

        
      </div>
    <?= $this->Form->end() ?>
  </div>

  text-welcome