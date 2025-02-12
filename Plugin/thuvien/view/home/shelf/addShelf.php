<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listBuilding">Huyện <?php echo @$checkRoom->building->name; ?> </a> / <a href="/listFloor?id_building=<?php echo $checkRoom->id_building; ?>">Tầng <?php echo @$checkRoom->floor->name; ?></a>  / <a href="/listRoom?id_floor=<?php echo $checkRoom->id; ?>">Phòng <?php echo @$checkRoom->name; ?></a></a> / </span>
    Thông tin kệ sách
  </h4>
  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin kệ sách</h5>
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
                              <label class="form-label" for="basic-default-phone">Tên kệ sách(*)</label>
                              <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label" for="basic-default-phone">Giới thiệu</label>
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