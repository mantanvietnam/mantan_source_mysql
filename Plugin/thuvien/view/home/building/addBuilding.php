<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listBuilding">Huyện</a> /</span>
    Thông tin huyện
  </h4>
  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin huyện</h5>
          </div>
          <div class="card-body">
            <p><?php echo @$mess;?></p>
            <form enctype="multipart/form-data" method="post" action="">
              <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
              <div class="row">
                <div class="col-12">
                  <div class=" mb-4">
                    
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label" for="basic-default-phone">Tên Huyện(*)</label>
                              <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                            </div>

                            <div class="mb-3">
                              <label class="form-label" for="basic-default-fullname">Số điện thoại (*)</label>
                              <input type="text" required  class="form-control" placeholder="" name="phone" id="phone" value="<?php echo @$data->phone;?>" />
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label" for="basic-default-phone">Địa chỉ</label>
                              <input type="text" class="form-control phone-mask" name="address" id="name" value="<?php echo @$data->address;?>" />
                            </div>
                            <div class="mb-3">
                              <label class="form-label" for="basic-default-phone">Giới thiện</label>
                              <textarea class="form-control" name="description"><?php echo @$data->description ?></textarea>
                            </div>
                          </div>
                        </div>
                     
                  </div>
                </div>
              </div>

              <button type="submit" class="btn btn-primary" style="width: 70px;">Lưu</button>
            </form>
          </div>
        </div>
      </div>

    </div>
</div>


<?php include(__DIR__.'/../footer.php'); ?>