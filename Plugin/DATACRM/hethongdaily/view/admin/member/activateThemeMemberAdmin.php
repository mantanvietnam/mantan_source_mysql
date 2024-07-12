<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/hethongdaily-view-admin-member-listMemberAdmin">Hệ thống</a> /</span>
    Thông tin theme
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin theme</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-phone">Tên đại lý (*)</label>
                    <input disabled="" type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Số điện thoại (*)</label>
                    <input type="text"  disabled=""  class="form-control" placeholder="" name="phone" id="phone" value="<?php echo @$data->phone;?>" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="basic-default-fullname">Hình đại diện</label>
                    <img src="<?php echo @$data->avatar;?>" style="height: 100px; width: auto;" >
                  </div>
                </div>
                  
               <?php

               $list_theme_info = explode(",", $data->list_theme_info);

               if(!empty(listThemeInfo())){
                foreach(listThemeInfo() as $key => $item){
                  $checked = '';

                  if (in_array($item['id'], $list_theme_info)) {
                    $checked = 'checked';
                  }

                 echo '<div class="col-md-4">
                 <img src="'.$item['image'].'" style="width: 100%; height:550px;"/>
                 <div style=" text-align: center; font-size: 20px; padding: 10px 0; ">
                 <a>Giá : '.number_format($item['price']).'đ</p>
                 <input type="checkbox" name="list_theme_info[]" value="'.$item['id'].'" '.$checked.' > 
                 </div>
                 </div>';
               }
             }
             ?>

                
              </div>
              <button type="submit" class="btn btn-primary">Lưu</button>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>

<script type="text/javascript">
  function selectSystem()
  {
    var id_system = $('#id_system').val();
    var listPosition = '<option value="">Chọn chức danh</option><option value="0">Chủ hệ thống</option>';

    if(id_system != ''){
      $.ajax({
        method: "POST",
        url: "/apis/getListPositionAPI",
        data: { id_system: id_system}
      })
      .done(function( msg ) {
        if(msg.length > 0){
          for (var i = 0; i < msg.length; i++) {
            listPosition += '<option value="'+msg[i].id+'">'+msg[i].name+'</option>';
          }
        }

        $('#id_position').html(listPosition); 
        $('#id_position').val(id_position_default);  
      });
    }else{
      $('#id_position').html(listPosition);
    }
  }

  var id_position_default = '<?php echo @$data->id_position?>';
  selectSystem();
</script>