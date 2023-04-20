<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/tayho360-admin-image360-listImage360Admin.php">Ảnh 360</a> /</span>
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
            <h5 class="mb-0">Thông tin ảnh 360</h5>
          </div>
          <div class="card-body">
            <p><?php echo @$mess;
        ?></p>
            <?= $this->Form->create(); ?>
             <div class="row" >
            <div class="mb-3 form-group col-sm-6">
                <i>Tiêu đề<span class="required">*</span>:</i>
                <input type="text" maxlength="100" name="name" id="name" value="<?php echo @$data['name'] ?>" class="form-control" required="">
            </div>
             <div class="mb-3 form-group col-sm-6">
                <i>Trạng thái:</i>&ensp;
                <input type="radio" name="status" class="" id="status" value="1" <?php if(@ $data['status']==1) echo 'checked="checked"';   ?> > Hiển thị&ensp;
                <input type="radio" name="status" class="" id="status" value="0" <?php if(@ $data['status']==0) echo 'checked="checked"';   ?> > Ẩn
            </div>
            <div class="mb-3 form-group col-sm-6">
               <i>Ảnh đại diện*:</i>
                <br>
                <?php
                if (!empty($data['image'])) {
                    $image = $data['image'];
                } else {
                    $image = '';
                }

                showUploadFile('image', 'image', $image);
                ?>
            </div>
             <div class="mb-3 form-group col-sm-6">
                <i>Ảnh 360:</i>
                 <input type="text" name="image360" class="form-control" id="image360" value="<?php echo @$data['image360'] ?>">
               
            </div>
           
            <div class="mb-3 form-group col-sm-6">
                <i>Mô tả ngắn:</i>
               <textarea name="introductory" id="introductory" onkeyup="" class="form-control" rows="5"><?php echo @$data['introductory'] ?></textarea>
            </div>
        </div>
        
  

              <button style=" margin: 10px; " type="submit" class="btn btn-primary">Lưu</button>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>