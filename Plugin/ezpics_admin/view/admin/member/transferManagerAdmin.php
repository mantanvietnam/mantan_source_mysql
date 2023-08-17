<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/ezpics_admin-view-admin-member-listMemberAdmin.php">Người dùng</a> /</span>
    Chuyển mẫu thiết kế cho Designer khác 
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Chuyển mẫu thiết kế cho Designer khác</h5>
          </div>
          <div class="card-body">
            <p style="color: #00ff66;"><?php echo @$mess;?></p>
            <?= $this->Form->create(); ?>
              <div class="row">
                <div class="mb-3 col-md-6">
                  <label class="form-label" for="basic-default-phone">Tài khoản chuyển (*)</label>
                  <input required type="text" class="form-control phone-mask" name="user_from" id="user_from" value="" />
                </div>
                <div class="mb-3 col-md-6">
                  <label class="form-label" for="basic-default-fullname">Tài khoản nhận (*)</label>
                  <input type="text" required class="form-control" oninput="getWarehouseByUser()" placeholder="" name="user_to" id="user_to" value="" />
                </div>
                <div class="mb-3 col-md-6">
                  <label class="form-label" for="basic-default-fullname">ID mẫu thiết kế</label>
                  <input type="text" class="form-control" placeholder="Nếu để trống thì chuyển đổi tất cả mẫu thiết kế !!!" name="id_product" id="id_product" value="" />
                </div>
                <div class="mb-3 col-md-6">
                  <div id="warehouse"></div>
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Lưu</button>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>

<script type="text/javascript">
  
  function getWarehouseByUser(){
      var user = document.getElementById("user_to").value;
      
        $.ajax({
            method: 'POST',
            url: '/apis/getWarehouseByUser',
            data: { user: user },
            success:function(res){
              if(res['code']==1){
                html = '<label class="form-label" for="basic-default-fullname">Kho</label><br/>';
                for(i=0;i<res['data'].length;i++){
                  html+= '<input type="checkbox" id="warehouse_id" name="warehouse_id[]" value="'+res['data'][i]['id']+'" /> '+res['data'][i]['name']+'<br/>'
                }
                document.getElementById('warehouse').innerHTML = html;
              }else{
                document.getElementById('warehouse').innerHTML = '';
              }
            }
        })

        
            
    };

</script>