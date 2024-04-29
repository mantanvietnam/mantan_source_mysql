<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Nhóm khách hàng</h4>

    <!-- Basic Layout -->
      <div class="row">
        <div class="col-xl">
          <div class="card mb-6">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Cài đặt nhóm khách hàng</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Tên nhóm</th>
                        <th class="text-center">Sửa</th>
                        <th class="text-center">Xóa</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      <?php 
                        if(!empty($listData)){
                          foreach ($listData as $item) {
                            $ezpics_config = [];
                            if(!empty($item->description)){
                              $ezpics_config = json_decode($item->description, true);
                            }

                            echo '<tr>
                                    <td align="center">'.$item->id.'</td>
                                    <td>
                                      <span class="text-danger">'.$item->name.'</span><br/>
                                      <a href="/listCustomerAgency/?id_group='.$item->id.'">'.number_format($item->number_customer).' khách hàng</a>
                                    </td>
                                    <td align="center">
                                      <a class="dropdown-item" href="javascript:void(0);" onclick="editData('.$item->id.', \''.$item->name.'\', \''.@$ezpics_config['id_ezpics'].'\', \''.@$ezpics_config['ezpics_full_name'].'\', \''.@$ezpics_config['ezpics_phone'].'\', \''.@$ezpics_config['ezpics_code'].'\', \''.@$ezpics_config['ezpics_avatar'].'\', \''.@$ezpics_config['ezpics_name_member'].'\' );">
                                        <i class="bx bx-edit-alt me-1"></i>
                                      </a>
                                    </td>
                                    <td align="center">
                                      <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa nhóm khách hàng này không?\');" href="/deleteGroupCustomerAgency/?id='.$item->id.'">
                                        <i class="bx bx-trash me-1"></i>
                                      </a>
                                    </td>
                                  </tr>';
                          }
                        }else{
                          echo '<tr>
                                  <td colspan="10" align="center">Chưa có nhóm khách hàng</td>
                                </tr>';
                        }
                      ?>
                      
                      
                    </tbody>
                  </table>
                </div>
            </div>
          </div>
        </div>

        <div class="col-xl">
          <div class="card mb-6">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Thông tin</h5>
            </div>
            <div class="card-body">
              <?= $this->Form->create(); ?>
                <input type="hidden" name="idCategoryEdit" id="idCategoryEdit" value="" />
                <div class="mb-3">
                  <label class="form-label" for="basic-default-phone">Tên nhóm</label>
                  <input type="text" class="form-control phone-mask" name="name" id="name" value="" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-phone">ID thẻ khách hàng Ezpics</label>
                  <input type="text" class="form-control phone-mask" name="id_ezpics" id="id_ezpics" value="" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-phone">Biến trường họ tên</label>
                  <input type="text" class="form-control phone-mask" name="ezpics_full_name" id="ezpics_full_name" value="" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-phone">Biến trường số điện thoại</label>
                  <input type="text" class="form-control phone-mask" name="ezpics_phone" id="ezpics_phone" value="" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-phone">Biến trường mã khách hàng</label>
                  <input type="text" class="form-control phone-mask" name="ezpics_code" id="ezpics_code" value="" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-phone">Biến trường ảnh đại diện</label>
                  <input type="text" class="form-control phone-mask" name="ezpics_avatar" id="ezpics_avatar" value="" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-phone">Biến trường tên đại lý</label>
                  <input type="text" class="form-control phone-mask" name="ezpics_name_member" id="ezpics_name_member" value="" />
                </div>

                <button type="submit" class="btn btn-primary">Lưu</button>
              <?= $this->Form->end() ?>
            </div>
          </div>
        </div>

      </div>
    
  </div>

  <script type="text/javascript">
    function editData(id, name, id_ezpics, ezpics_full_name, ezpics_phone, ezpics_code, ezpics_avatar, ezpics_name_member){
      $('#idCategoryEdit').val(id);
      $('#name').val(name);
      $('#id_ezpics').val(id_ezpics);
      $('#ezpics_full_name').val(ezpics_full_name);
      $('#ezpics_phone').val(ezpics_phone);
      $('#ezpics_code').val(ezpics_code);
      $('#ezpics_avatar').val(ezpics_avatar);
      $('#ezpics_name_member').val(ezpics_name_member);
    }
  </script>

<?php include(__DIR__.'/../footer.php'); ?>