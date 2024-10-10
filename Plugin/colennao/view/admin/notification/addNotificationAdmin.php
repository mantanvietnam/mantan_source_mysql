<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/excgo-view-admin-notification-addNotificationAdmin.php">Thông báo</a> /</span>
    Tạo thông báo
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Tạo thông báo</h5>
          </div>
          <div class="card-body">
            <p><?php echo @$mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Id người dùng</label>
                    <input  type="text" class="form-control phone-mask" name="idUser" placeholder="mỗi id cách nhau dấu phẩy (,)" id="idUser" value="" />
                  </div>
                 </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Tiêu đề (*)</label>
                    <input required type="text" class="form-control phone-mask" value="<?php echo @$dataSend[
                    'title'] ?>" name="title" id="title" value="" />
                  </div>
                </div>
                 <!-- <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Id bài viết</label>
                    <input type="number" class="form-control phone-mask" name="id_post" value="<?php echo @$dataSend[
                    'id_post'] ?>" id="id_post"  />
                  </div>
                </div> -->
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Nội dung thông báo (*)</label>
                    <textarea required class="form-control phone-mask" name="mess"  id="mess"><?php echo @$dataSend[
                    'mess'] ?></textarea>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">tổng lần gửi</label>
                    <input type="number" disabled  class="form-control phone-mask" value="<?php echo @$totalPage; ?>"  value="" />
                    <input type="hidden"  class="form-control phone-mask" value="<?php echo @$totalPage; ?>" name="totalPage" id="totalPage" value="" />
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">số lần gửi</label>
                    <input type="number" disabled  class="form-control phone-mask" value="<?php echo (!empty($next)) ? (int)$next : 1 ?>" name="" id="" value="" />
                    <input type="hidden"  class="form-control phone-mask" value="<?php echo (!empty($next)) ? (int)$next : 1 ?>" name="page" id="page" value="" />
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Gửi thông báo</button>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>