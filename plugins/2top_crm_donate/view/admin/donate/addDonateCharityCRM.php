<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/2top_crm_donate-view-admin-donate-listDonateCharityCRM.php">Đóng góp</a> /</span>
    Thông tin đóng góp
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin đóng góp</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Sự kiện từ thiện (*)</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="id_charity" id="id_charity" required>
                        <?php 
                          if(!empty($listCharities)){
                            foreach ($listCharities as $item) {
                              if(empty($data->id_charity) || $data->id_charity!=$item->id){
                                echo '<option value="'.$item->id.'">'.$item->title.'</option>';
                              }else{
                                echo '<option selected value="'.$item->id.'">'.$item->title.'</option>';
                              }
                            }
                          }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Tên người đóng góp (*)</label>
                    <input required type="text" class="form-control phone-mask" name="full_name" id="full_name" value="<?php echo @$data->full_name;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Số điện thoại</label>
                    <input type="text" class="form-control" placeholder="" name="phone" id="phone" value="<?php echo @$data->phone;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Số tiền quyên góp (*)</label>
                    <input type="text" required class="form-control" placeholder="" name="coin" id="coin" value="<?php echo @$data->coin;?>" />
                  </div>

                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" placeholder="" name="email" id="email" value="<?php echo @$data->email;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Hình đại diện</label>
                    <?php showUploadFile('avatar','avatar',@$data->avatar,0);?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Hình lưu niệm</label>
                    <?php showUploadFile('image','image',@$data->image,1);?>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Lời nhắn</label>
                    <textarea class="form-control" id="note" name="note" ><?php echo @$data->note;?></textarea>
                  </div>
                </div>
                
              </div>

              <button type="submit" class="btn btn-primary">Lưu</button>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>