<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/ditichhienvat-admin-ward-listWardAdmin">Phường Xã</a> /</span>
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
            <p><?php echo $mess;
        ?></p>
            <?= $this->Form->create(); ?>
             <div class="row" >
            <div class="mb-3 form-group col-sm-6">
                <i>Tiêu đề<span class="required">*</span>:</i>
                <input type="text" maxlength="100" name="name" id="name" value="<?php echo @$data['name'] ?>" class="form-control" required="">
            </div>
            <!--  <div class="mb-3 form-group col-sm-6">
                <i>Địa chỉ:</i>
                <input type="text" maxlength="100" name="address" id="address" value="<?php echo @$data['address'] ?>" class="form-control">
            </div>
            <div class="mb-3 form-group col-sm-6">
                <i>Điện thoại:</i>
                <input type="text" name="phone" class="form-control" id="phone" value="<?php echo @$data['phone'] ?>">
            </div>
            <div class="mb-3 form-group col-sm-6">
                <i>Email:</i>
                <input type="text" name="email" class="form-control" id="email" value="<?php echo @$data['email'] ?>">
            </div>
            <div class="mb-3 form-group col-sm-6">
               <i>Ảnh đại diện</i>
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
                <i>Vĩ độ (lat):</i>
                <input type="text" name="latitude" class="form-control" id="latitude" value="<?php echo @$data['latitude'] ?>">
            </div>
             <div class="mb-3 form-group col-sm-6">
                <i>Kinh độ (long):</i>
                <input type="text" name="longitude" class="form-control" id="longitude" value="<?php echo @$data['longitude'] ?>">
            </div>
            
            <div class="mb-3 form-group col-sm-6">
                <i>Mô tả ngắn:</i>
               <textarea name="introductory" id="introductory" onkeyup="" class="form-control" rows="5"><?php echo @$data['introductory'] ?></textarea>
            </div>
         
            <div class="mb-3 form-group col-sm-12">
                <i>Nội dung bài viết</i>
               <?php
                        showEditorInput('content','content',@$data['content'],1);
                    ?>                                          
            </div> -->
        </div>
        
  

              <button style=" margin: 10px; " type="submit" class="btn btn-primary">Lưu</button> 
              <a class="btn btn-danger" href="/plugins/admin/ditichhienvat-admin-ward-listWardAdmin">Hủy</a> 
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>