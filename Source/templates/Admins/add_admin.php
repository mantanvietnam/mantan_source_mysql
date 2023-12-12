<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/admins/listAdmin">Tài khoản</a> /</span>
    Thông tin tài khoản
  </h4>

  <!-- Basic Layout -->
  <div class="row">
    <div class="col-xl">
      <div class="card mb-4">
        <div class="card-body">
          <p><?php echo @$mess;?></p>
          <?= $this->Form->create(); ?>
            <div class="row">
              <div class="col-12 col-sm-12 col-md-12">
                <div class="mb-3">
                  <label class="form-label">Tài khoản *</label>
                  <input type="text" class="form-control" name="user" value="<?php echo @$infoAccAdmin->user;?>" <?php if(!empty($infoAccAdmin->user)) echo 'disabled'; ?>  />
                </div>

                <div class="mb-3">
                  <label class="form-label">Mật khẩu *</label>
                  <input type="text" class="form-control" name="password" value="" autocomplete="no" <?php if(!empty($infoAccAdmin->user)) echo 'disabled'; ?>  />
                </div>

                <div class="mb-3">
                  <label class="form-label">Họ tên *</label>
                  <input type="text" class="form-control" name="fullName" value="<?php echo @$infoAccAdmin->fullName;?>" required />
                </div>

                <div class="mb-3">
                  <label class="form-label">Email</label>
                  <input type="email" class="form-control" name="email" value="<?php echo @$infoAccAdmin->email;?>" />
                </div>

                <div class="mb-3">
                  <label class="form-label">Quyền hạn</label>
                  <select name="type" id="type" class="form-select color-dropdown" onchange="showPermission();">
                    <option value="boss" <?php if(!empty($infoAccAdmin->type) && $infoAccAdmin->type=='boss') echo 'selected';?> >Tất cả các quyền</option>
                    <option value="staff" <?php if(!empty($infoAccAdmin->type) && $infoAccAdmin->type=='staff') echo 'selected';?> >Giới hạn quyền</option>
                  </select>
                </div>
              </div>

              <div id="list_permission" style="display: none;" class="row">
              <?php 
              if(!empty($permissions)){
                foreach ($permissions as $key => $permission) {
                  $checked = '';
                  if(in_array($permission['permission'], $infoAccAdmin->permission)){
                    $checked = 'checked';
                  }

                  echo '<div class="col-4 col-sm-4 col-md-3 mb-3">
                          <label class="form-label">
                            <input '.$checked.' type="checkbox" name="permission[]" value="'.$permission['permission'].'"> '.$permission['name'].'
                          </label>
                        </div>';
                }
              }
              ?>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Lưu thông tin</button>
          <?= $this->Form->end() ?>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function showPermission()
  {
    if($('#type').val() == 'staff'){
      $('#list_permission').show();
    }else{
      $('#list_permission').hide();
    }
  }

  showPermission();
</script>