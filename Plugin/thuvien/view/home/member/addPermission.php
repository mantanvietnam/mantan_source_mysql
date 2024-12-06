<?php include(__DIR__.'/../header.php'); ?>
<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listPermission">Nhóm phân quyền </a> /</span>
    Thông tin nhóm phân quyền  
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin nhóm phân quyền </h5>
          </div>
          <div class="card-body">
            <p><?php echo @$mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                  <div class="mb-3 col-md-6">
                    <label class="form-label" for="basic-default-phone">Tên nhóm phân quyền(*)</label>
                    <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-email">Phân quyền chức năng</label>

                    <label class="col-sm-12 control-label">

                      <input type="checkbox" id="selectAll" onclick="checkboxAll(this,'checkAll');"> <label for="selectAll">Tất cả</label>

                    </label>
                      
                      <div class="col-sm-12" style="margin-left: 20px;">
                          <div class="form-group" id="checkAll">
                              <div class="col-sm-12">
                                  <script type="text/javascript">
                                      function addCheck(idCheckbox)
                                      {
                                          $('#'+idCheckbox).attr( 'checked', true );
                                      }

                                      function checkboxAll(source, className) {
                                          const checkboxes = document.getElementsByClassName(className);
                                          for(let i = 0; i < checkboxes.length; i++) {
                                              checkboxes[i].checked = source.checked;
                                          }
                                      }
                                  </script>
                                  <ul class="list-unstyled list_addPer">
                                      <?php 
                                      foreach ($listPermissionMenu as $keyGroup=>$permissionMenu) { 
                                          $checkGroup= false;
                                          echo '<li class="has_sub_staff">
                                          <span><input type="checkbox" class="checkAll" id="check'.$keyGroup.'"> <label for="">'.$permissionMenu['name'].'</label></span>
                                          <ul class="list-unstyled sub_staff" style="margin-left: 20px;">';
                                          foreach ($permissionMenu['sub'] as $key=>$menu2) { 
                                              $check= '';
                                              if (isset($data->permission) && in_array($menu2['permission'], $data->permission)) {
                                                  $check= 'checked';
                                                  $checkGroup= true;
                                              }
                                              if($menu2['permission']=='managerLogout'){
                                                  $check= 'checked';
                                                  $checkGroup= true;
                                              }
                                              echo '<li><input '.$check.' class="checkAll" name="check_list_permission[]" value="'.$menu2['permission'].'" type="checkbox" id="check'.$keyGroup.'_'.$key.'"> <label for="check'.$keyGroup.'_'.$key.'">'.$menu2['name'].'</label></li>';
                                          }
                                          echo '  </ul>
                                          </li>';

                                          if($checkGroup){
                                              echo '<script type="text/javascript">addCheck("check'.$keyGroup.'");</script>';
                                          }
                                      }
                                      ?>
                                  </ul>
                                  <script>
                                      $(document).ready(function() {
                                          $('.list_addPer ul').hide();
                                          $('.has_sub_staff span label').click(function(){
                                              if($(this).parent().next('.sub_staff').hasClass('show')){
                                                  $(this).parent().next('.sub_staff').slideUp();
                                                  $(this).parent().next('.sub_staff').removeClass('show');
                                              } else{
                                                  $(this).parent().next('.sub_staff').slideDown();
                                                  $(this).parent().next('.sub_staff').addClass('show');
                                              }
                                          });
                                          $(".has_sub_staff span input").click(function(){
                                              $(this).parent().parent().find('input').prop('checked', this.checked);    
                                          });
                                      });
                                  </script>
                              </div>
                          </div> 
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

<?php include(__DIR__.'/../footer.php'); ?>