<?php include(__DIR__.'/../header.php'); ?>
<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Nhóm khách hàng</h4>

    <!-- Basic Layout -->
      <div class="row">
        <div class="col-md-7">
          <div class="card mb-6">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Danh sách nhóm khách hàng</h5>
            </div>
            <div class="card-body row">
                <?php echo $mess;?>
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
                            echo '<tr>
                                    <td>'.$item->id.'</td>
                                    <td>'.$item->name.'</td>
                                    <td align="center">
                                      <a class="dropdown-item" href="javascript:void(0);" onclick="editData('.$item->id.', \''.$item->name.'\', \''.$item->parent.'\', \''.$item->image.'\', \''.$item->keyword.'\', \''.$item->description.'\', \''.$item->slug.'\' );">
                                        <i class="bx bx-edit-alt me-1"></i>
                                      </a>
                                    </td>
                                    <td align="center">
                                      <a class="dropdown-item" onclick="deleteCategory('.$item->id.');" href="javascript:void(0);">
                                        <i class="bx bx-trash me-1"></i>
                                      </a>
                                    </td>
                                  </tr>';
                          }
                        }else{
                          echo '<tr>
                                  <td colspan="13" align="center">Chưa có chủ đề</td>
                                </tr>';
                        }
                      ?>
                      
                      
                    </tbody>
                  </table>
                </div>
            </div>
          </div>
        </div>

        <div class="col-md-5">
          <div class="card mb-6">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Thông tin</h5>
            </div>
            <div class="card-body">
              <?= $this->Form->create(); ?>
                <input type="hidden" name="idCategoryEdit" id="idCategoryEdit" value="" />
                <div class="mb-3">
                  <label class="form-label" for="basic-default-phone">Tên nhóm</label>
                  <input type="text" class="form-control phone-mask" name="name" id="name" value=""/>
                </div>
                <div class="mb-3">
                  <label class="form-label" for="basic-default-phone">Id ảnh in hàng hoạt EZPICS </label>
                  <input type="text" class="form-control phone-mask" name="id_product" id="id_product" value=""/>
                </div>
                <div class="mb-3">
                  <label class="form-label" for="basic-default-phone">Tên biến họ và tên khách hàng</label>
                  <input type="text" class="form-control phone-mask" name="value_name" id="value_name" value=""/>
                </div>
                <div class="mb-3">
                  <label class="form-label" for="basic-default-phone">Tên biến avatar khách hàng</label>
                  <input type="text" class="form-control phone-mask" name="value_avatar" id="value_avatar" value=""/>
                </div>
                <div class="mb-3">
                  <label class="form-label" for="basic-default-phone">Tên biến điện thoại khách hàng</label>
                  <input type="text" class="form-control phone-mask" name="value_phone" id="value_phone" value=""/>
                </div>
                <div class="mb-3">
                  <label class="form-label" for="basic-default-phone">Tên biến id khách hàng</label>
                  <input type="text" class="form-control phone-mask" name="value_id" id="value_id" value=""/>
                </div>

                <button type="submit" class="btn btn-primary">Lưu</button>
              <?= $this->Form->end() ?>
            </div>
          </div>
        </div>

      </div>
    
  </div>

  <script type="text/javascript">
    function editData(id, name,id_product,value_avatar,value_name,value_id,value_phone){
      $('#idCategoryEdit').val(id);
      $('#name').val(name);
      $('#id_product').val(id_product);
      $('#value_name').val(value_name);
      $('#value_avatar').val(value_avatar);
      $('#value_id').val(value_id);
      $('#value_phone').val(value_phone);
    }

    function deleteCategory(id){
      var check = confirm('Bạn có chắc chắn muốn xóa không?');

      if(check){
        $.ajax({
          method: "GET",
          url: "/apis/deleteCategoryCustomer/?id="+id+"&type=Category",
          data: {},
          success:function(res){
                  console.log(res);
                  if(res.code==1){
                    window.location = '/listCategoryCustomer?error=requestCategoryDeleteSuccess';
                  }else{
                    window.location = '/listCategoryCustomer?error=requestCategoryDelete';
                  }
                }

        });
      }
    }
  </script>
<?php include(__DIR__.'/../footer.php'); ?>