<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/tayho360-admin-tour-listTourAdmin.php">Dịch vụ hỗ trợ du lịch</a> /</span>
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
            <h5 class="mb-0">Thông tin dịch vụ hỗ trợ du lịch</h5>
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
             <div class="mb-3 form-group col-sm-3">
                <i>Vĩ độ (lat):</i>
                <input type="text" name="latitude" class="form-control" id="latitude" value="<?php echo @$data['latitude'] ?>">
            </div>
             <div class="mb-3 form-group col-sm-3">
                <i>Kinh độ (long):</i>
                <input type="text" name="longitude" class="form-control" id="longitude" value="<?php echo @$data['longitude'] ?>">
            </div>
              <div class="mb-3 form-group col-sm-3">
                <i>Ngày bắt đầu:</i>
                <input type="date" name="datestart" class="form-control hasDatepicker datepicker" id="datestart" value="<?php echo (!empty($data['datestart']))?  date("Y-m-d", @$data['datestart']) : " " ?>">
            </div>
            <div class="mb-3 form-group col-sm-3">
                <i>Ngày kết thúc:</i>
                <input type="date" name="dateend" class="form-control hasDatepicker datepicker" id="dateend" value="<?php echo (!empty($data['dateend']))?  date("Y-m-d", @$data['dateend']) : " " ?>">
            </div>
            <div class="mb-3 form-group col-sm-3">
                <i>Giá:</i>
                <input type="number" name="price" class="form-control hasDatepicker datepicker" id="price" value="<?php echo  @$data['price'] ?>">
            </div>
            <div class="mb-3 form-group col-sm-3">
                <i>Thời gian tour:</i>
               <input type="text" name="timetravel" class="form-control" id="timetravel" value="<?php echo  @$data['timetravel'] ?>">
            </div>
            
            <div class="mb-3 form-group col-sm-6">
                <i>Gới thiệu:</i>
               <textarea name="introductory" id="introductory" onkeyup="" class="form-control" rows="5"><?php echo @$data['introductory'] ?></textarea>
            </div>
         
            <div class="mb-3 form-group col-sm-12">
                <i>Lịch trình</i>
               <?php
                        showEditorInput('content','content',@$data['content'],1);
                    ?>                                          
            </div>
        </div>
        
  

              <button style=" margin: 10px; " type="submit" class="btn btn-primary">Lưu</button>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>