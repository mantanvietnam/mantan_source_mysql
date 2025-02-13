<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listMember">Hệ thống nhân viên</a> /</span>
    Thông tin nhân viên
  </h4>
  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin nhân viên</h5>
          </div>
          <div class="card-body">
            <p><?php echo @$mess;?></p>
            <form enctype="multipart/form-data" method="post" action="">
              <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
              <div class="row">
                <div class="col-12">
                  <div class=" mb-4">
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
                         Thông tin nhân viên
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-info" aria-controls="navs-top-info" aria-selected="false">
                          Phân quyền 
                        </button>
                      </li>
                    </ul>
                     <div class="tab-content">
                      <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label" for="basic-default-phone">Họ tên (*)</label>
                              <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                            </div>

                            <div class="mb-3">
                              <label class="form-label" for="basic-default-fullname">Số điện thoại (*)</label>
                              <input type="text" required  class="form-control" placeholder="" name="phone" id="phone" value="<?php echo @$data->phone;?>" />
                            </div>
                            <div class="mb-3">
                              <label class="form-label" for="basic-default-fullname">Hình đại diện</label>
                              <input type="file" class="form-control phone-mask" name="avatar" id="avatar" value=""/>
                              <?php
                              if(!empty($data->avatar)){
                                echo '<br/><img src="'.$data->avatar.'" width="80" />';
                              }
                              ?>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">nhóm phân quyền</label>
                                <select class="form-control" name="id_permission" id="id_permission" required>
                                    <option value="" >Chọn nhóm phân quyền</option>
                                    <?php foreach ($dataGroupStaff as $key => $item){
                                      $selected = '';
                                      if(!empty($data->id_permission) && $data->id_permission==$item->id){
                                        $selected = 'selected';
                                      }

                                      echo '<option value="'.$item->id.'" '.$selected.'>'.$item->name.'</option>';
                                    } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Trạng thái</label>
                              <div class="input-group input-group-merge">
                                <select class="form-select" name="status" id="status">
                                  <option value="active" <?php if(!empty($data->status) && $data->status=='active') echo 'selected'; ?> >Kích hoạt</option>
                                  <option value="lock" <?php if(!empty($data->status) && $data->status=='lock') echo 'selected'; ?> >Khóa</option>
                                </select>
                              </div>
                            </div>

                        
                          </div>

                          <div class="col-md-6">
                            
                            <div class="mb-3">
                              <label class="form-label" for="basic-default-fullname">Mật khẩu tài khoản</label>
                              <input type="password" autocomplete="off" class="form-control" placeholder="" name="password" id="password" value="" />
                            </div>
                           
                             <div class="mb-3">
                              <label class="form-label" for="basic-default-phone">Ngày sinh</label>
                              <input autocomplete="off" type="text" class="form-control datepicker" name="birthday" id="name" value="<?php if(!empty($data->status)) echo  date('d/m/Y',@$data->birthday);?>" />
                            </div>

                            <div class="mb-3">
                              <label class="form-label" for="basic-default-fullname">Email</label>
                              <input autocomplete="off" type="text" class="form-control" placeholder="" name="email" id="email" value="<?php echo @$data->email;?>" />
                            </div>

                            <div class="mb-3">
                              <label class="form-label" for="basic-default-phone">Địa chỉ</label>
                              <input type="text" class="form-control phone-mask" name="address" id="name" value="<?php echo @$data->address;?>" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">chức vụ</label>
                                <select class="form-control" name="id_position" id="id_position" required>
                                    <option value="" >Chọn chức vụ</option>
                                    <?php foreach ($listPosition as $key => $item){
                                      $selected = '';
                                      if(!empty($data->id_position) && $data->id_position==$item->id){
                                        $selected = 'selected';
                                      }

                                      echo '<option value="'.$item->id.'" '.$selected.'>'.$item->name.'</option>';
                                    } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                              <label class="form-label" for="basic-default-phone">Giới thiệu bản thân</label>
                              <textarea class="form-control" name="description" id="description"><?php echo @$data->description;?></textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="navs-top-info" role="tabpanel">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label" for="basic-default-email">Phân quyền chức năng</label>

                              <label class="col-sm-12 control-label">

                                <input type="checkbox" id="selectAll" onclick="checkboxAll(this,'checkAll');"> <label for="selectAll">&nbsp;Tất cả</label>

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
                                        <span><input type="checkbox" class="checkAll" id="check'.$keyGroup.'"> <label for="">&nbsp;'.$permissionMenu['name'].'</label></span>
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
                                          echo '<li><input '.$check.' class="checkAll" name="check_list_permission[]" value="'.$menu2['permission'].'" type="checkbox" id="check'.$keyGroup.'_'.$key.'"> <label for="check'.$keyGroup.'_'.$key.'">&nbsp;'.$menu2['name'].'</label></li>';
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
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label" for="basic-default-email">Phân huyện</label>

                              <div class="col-sm-12" style="margin-left: 20px;">
                                <div class="form-group" id="">
                                  <div class="col-sm-12">
                                   
                                    <ul class="list-unstyled list_addPer">
                                      <?php 
                                     foreach ($dataBuilding as $key=> $item) { 
                                          $check= '';
                                          if (!empty($data->id_building)){
                                          if (in_array($item->id, $data->id_building, true)) { 
                                                $check= 'checked';
                                              }
                                            }
                                          echo '<li><input '.$check.' class="" name="id_building[]" value="'.$item->id.'" type="checkbox" id="check'.$item->id.'"> <label for="check'.$item->id.'">&nbsp;'.$item->name.'</label></li>';
                                        }
                                      ?>
                                    </ul>
                                  </div>
                                </div> 
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
              </div>

              <button type="submit" class="btn btn-primary" style="width: 70px;">Lưu</button>
            </form>
          </div>
        </div>
      </div>

    </div>
</div>
<script type="text/javascript">
    function downloadImageFromSrc(url, phone){
      var fileName = 'QR_ICHAM_'+phone+'.jpg';
      var xhr = new XMLHttpRequest();
      xhr.open("GET", url, true);
      xhr.responseType = "blob";
      xhr.onload = function(){
          var urlCreator = window.URL || window.webkitURL;
          var imageUrl = urlCreator.createObjectURL(this.response);
          var tag = document.createElement('a');
          tag.href = imageUrl;
          tag.download = fileName;
          document.body.appendChild(tag);
          tag.click();
          document.body.removeChild(tag);
      }
      xhr.send();
  }
</script>

<?php include(__DIR__.'/../footer.php'); ?>