<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/key_person-view-admin-person-listPersonAdmin">Đại lý</a> /</span>
    Thông tin Đại lý
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin Đại lý</h5>
          </div>
          <div class="card-body">
            <p><?php echo @$mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-12">
                  <div class="nav-align-top mb-4">
                        <div class="row">
                          <div class="col-md-6 mb-3">
                            <label class="form-label">tên đại lý (*)</label>
                            <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                          </div>
                          <div class="col-md-6 mb-3">
                            <label class="form-label">điện thoại (*)</label>
                            <input required type="text" class="form-control phone-mask" name="phone" id="phone" value="<?php echo @$data->phone;?>" />
                          </div>
                          <div class="col-md-6 mb-3">
                            <label class="form-label">Địa chỉ (*)</label>
                            <input required type="text" class="form-control phone-mask" name="address" id="address" value="<?php echo @$data->address;?>" />
                          </div>
                          <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input  type="text" class="form-control phone-mask" name="email" id="email" value="<?php echo @$data->email;?>" />
                          </div>
                          <div class="col-md-6 mb-3">
                            <label class="form-label">link facebook </label>
                            <input  type="text" class="form-control phone-mask" name="facebook" id="facebook" value="<?php echo @$data->facebook;?>" />
                          </div>
                          <div class="col-md-6 mb-3">
                            <label class="form-label">zalo </label>
                            <input  type="text" class="form-control phone-mask" name="zalo" id="zalo" value="<?php echo @$data->zalo;?>" />
                          </div>
                          <div class="col-md-6  mb-3">
                            <label class="form-label">Khu vực</label>
                            <select name="id_category" class="form-control  mb-3" >
                              <option value="">chon </option>
                              <?php
                                if(!empty($listCategory)){
                                  foreach($listCategory as $item){
                                    if(@$data->id_category!=$item->id){
                                      echo '<option value="'.$item->id.'">'.$item->name.'</option>';
                                    }else{
                                      echo '<option selected value="'.$item->id.'">'.$item->name.'</option>';
                                    }
                                  }
                                }
                              ?>
                            </select>
                            <label class="form-label">Hình minh họa</label>
                              <?php showUploadFile('image','image',@$data->image,0);?>
                          </div>

                            <div class="col-md-6 mb-3">
                              <label class="form-label">chú ý (*)</label>
                              <textarea name="note" class="form-control phone-mask" rows="5"><?php echo @$data->answer; ?></textarea>
                            </div>
                  </div>
                </div>
              </div>

              <button type="submit" class="btn btn-primary" style="width: 80px;">Lưu</button>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>