<?php include(__DIR__.'/../header.php'); ?>
<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">
            <a href="/listStaffBonus">Tiền thưởng phạt nhận viên</a> /
        </span>
        Thông tin tiền thưởng phạt nhận viên
    </h4>
    
    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-12">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Thông tin tiền thưởng phạt nhận viên</h5>
                </div>

                <div class="card-body">
                    <p><?php echo $mess ?? ''; ?></p>
                    <?= $this->Form->create(); ?>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nhân viên</label>
                            <select name="id_staff" class="form-select color-dropdown">
                              <option value="">Tất cả</option>
                              <?php 
                              if(!empty($listStaffs)){
                                foreach ($listStaffs as $key => $value) {
                                  if(empty($data->id_staff) || $data->id_staff !=$value->id){
                                    echo '<option value="'.$value->id.'">'.$value->name.'</option>';
                                  }else{
                                    echo '<option selected value="'.$value->id.'">'.$value->name.'</option>';
                                  }
                                }
                              }
                              ?>
                            </select>
                          </div>
                          <div class="col-md-6 mb-3">
                            <label class="form-label">Hình thức</label>
                            <select name="type" class="form-select color-dropdown">
                              <option value="reward" <?php if(!empty($data->id_staff) && $data->id_staff=='reward') echo 'selected';?> >Thưởng</option>
                              <option value="penalty" <?php if(!empty($data->id_staff) && $data->id_staff=='penalty') echo 'selected';?> >Phạt</option>
                            </select>
                          </div>
                          <div class="col-md-6 mb-3">
                            <label class="form-label">tiền</label>
                             <input required type="number" class="form-control" name="money" id="money" value="<?php echo @$data->money; ?>" />
                          </div>
                          <div class="col-md-6 mb-3">
                            <label class="form-label">Ghi chú</label>
                             <input required type="text" class="form-control" name="note" id="note" value="<?php echo @$data->note; ?>" />
                          </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <?= $this->Form->end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include(__DIR__.'/../footer.php'); ?>
