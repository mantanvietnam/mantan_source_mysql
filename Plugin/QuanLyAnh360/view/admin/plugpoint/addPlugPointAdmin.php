<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/QuanLyAnh360-view-admin-scene-listSceneAdmin">Bối cảnh</a> /</span>
    Thông tin bối cảnh
  </h4>
  <!-- Basic Layout -->
  <div class="row">
    <div class="col-xl">
      <div class=" mb-12">
        <div class="card-body">
          <p><?php echo $mess;?></p>
          <?= $this->Form->create(); ?>
          <div class="mb-4">
            <div class="nav-align-top mb-4">
          <div class="card-body tab-content ">
            <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
              <div class="row">
                <div class="mb-3 col-md-6">
                  <label class="form-label" for="basic-default-phone">Mã cảch (*)</label>
                  <input required type="text" class="form-control phone-mask" name="code" id="code" value='<?php echo @$data->code;?>' />
                </div>
                <div class="mb-3 col-md-6">
                  <label class="form-label" for="basic-default-phone">fovtype</label>
                  <select class="form-select" name="icon" id="icon">
                        <option value="0">Chọn icon</option>
                        <?php 
                        global $icon;
                        if(!empty($icon)){
                          foreach ($icon as $key => $item) {
                            if(empty($data->icon) || $data->icon!=$key){
                              echo '<option value="'.$key.'">'.$item.'</option>';
                            }else{
                              echo '<option selected value="'.$key.'">'.$item.'</option>';
                            }
                          }
                        }
                        ?>
                    </select>
                  </div>
                <div class="mb-3 col-md-6">
                  <label class="form-label" for="basic-default-phone">hlookat</label>
                  <input  type="text" class="form-control phone-mask" name="hlookat" id="hlookat" value='<?php echo @$data->hlookat;?>' />
                </div>
                 <div class="mb-3 col-md-6">
                  <label class="form-label" for="basic-default-phone">vlookat</label>
                  <input  type="text" class="form-control phone-mask" name="vlookat" id="vlookat" value='<?php echo @$data->vlookat;?>' />
                </div>
                 
                <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-phone">Trạng thái:</label>&ensp;
                            <input type="radio" name="status" class="" id="status" value="1" <?php if(@ $data['status']==1) echo 'checked="checked"';   ?> > Hiển thị&ensp;
                            <input type="radio" name="status" class="" id="status" value="0" <?php if(@ $data['status']==0) echo 'checked="checked"';   ?> > Ẩn
                        </div>
              </div>
              
            </div>

            
          <button type="submit" class="btn btn-primary">Lưu</button>
          </div>
         
        </div>
      </div>
       <?= $this->Form->end() ?>
    </div>
  </div>

</div>
</div>
</div>
<script>
  $(function(){
    $( ".datepicker" ).datepicker({
      dateFormat: "dd/mm/yy"
    });
  } );
</script>