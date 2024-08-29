<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/camera_ai-view-admin-precinct-listAdminPrecinct">Phường Xã</a> /</span>
    <?php 
     if(!empty($_GET['id'])){
        echo "Sửa thông tin";

    }else{
       echo "Thêm mới";
    }

     ?>
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Phường Xã</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
             <div class="row">
                <div class="mb-3 form-group col-sm-6">
                    <i>Tên Xã/Phường<span class="required">*</span>:</i>
                    <input type="text" maxlength="100" name="name" id="name" value="<?php echo $data->name ?>" class="form-control" required="">
                </div>
             </div>
                <button style=" margin: 10px; " type="submit" class="btn btn-primary">Lưu</button>
             <?= $this->Form->end() ?>
          </div>
        </div>
      </div>
    </div>