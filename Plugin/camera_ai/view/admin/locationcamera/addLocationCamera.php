<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/camera_ai-view-admin-locationcamera-listAdminLocationcamera">Camera</a> /</span>
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
            <h5 class="mb-0">Camera</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
             <div class="row">
                <div class="mb-3 form-group col-md-6">
                    <label for="">Ảnh:</label>
                    <?php showUploadFile('image','image',@$data['image'],1); ?>
                </div> 
                <div class="mb-3 form-group col-sm-6">
                    <i>Tên camera<span class="required">*</span>:</i>
                    <input type="text" maxlength="100" name="name" id="name" value="<?php echo $data->name ?>" class="form-control" required="">
                </div>
                <div class="mb-3 form-group col-sm-6">
                    <i>SDT</i>
                    <input type="text" name="phone" id="phone" value="<?php echo $data->phone ?>" class="form-control">
                </div>
                <div class="mb-3 form-group col-sm-6">
                    <i>Địa chỉ</i>
                    <input type="text" name="address" id="address" value="<?php echo $data->address ?>" class="form-control">
                </div>
                <div class="mb-3 form-group col-sm-6">
                    <i>Vị trí</i>
                    <input type="text" name="location" id="location" value="<?php echo $data->location ?>" class="form-control">
                </div>
                <div class="mb-3 form-group col-sm-6">
                    <i>Xã/phường</i>
                    <select name="precinct" id="precinct" class="form-control">
                        <option value="">Chọn xã/phường</option>
                        <?php if (!empty($listData)): ?>
                            <?php foreach ($listData as $key => $value): ?>
                                <option value="<?php echo $value->id; ?>" <?php echo ($data->precinct == $value->id) ? 'selected' : ''; ?>>
                                    <?php echo $value->name; ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="mb-3 form-group col-sm-6">
                    <i>Chức năng camera</i>
                    <select name="cameratype" id="cameratype" class="form-control">
                        <option value="">Chọn chức năng</option>
                        <?php if (!empty($listdeportment)): ?>
                            <?php foreach ($listdeportment as $key => $value): ?>
                                <option value="<?php echo $value->id; ?>" <?php echo ($data->cameratype == $value->id) ? 'selected' : ''; ?>>
                                    <?php echo $value->name; ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="mb-3 form-group col-sm-6">
                    <i>Danh mục</i>
                    <select name="deportment" id="deportment" class="form-control">
                        <option value="">Chọn danh mục</option>
                        <?php if (!empty($listgroupcamera)): ?>
                            <?php foreach ($listgroupcamera as $key => $value): ?>
                                <option value="<?php echo $value->id; ?>" <?php echo ($data->deportment == $value->id) ? 'selected' : ''; ?>>
                                    <?php echo $value->name; ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="mb-3 form-group col-sm-6">
                    <i>Mô tả ngắn</i>
                    <textarea  maxlength="160" rows="5" type="text" name="description" id="description" value="<?php echo $data->description?>" class="form-control" ></textarea>
                </div>
             </div>
                <button style=" margin: 10px; " type="submit" class="btn btn-primary">Lưu</button>
             <?= $this->Form->end() ?>
          </div>
        </div>
      </div>
    </div>