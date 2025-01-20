<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Loại hình di tích</h4>
    <p><a data-bs-toggle="modal" data-bs-target="#basicModal" href="javascript:void();" class="btn btn-primary"><i class='bx bx-plus'></i> Thêm mới</a></p>

    <form action="" method="GET">
      <table class="table table-bordered" style="border: 1px solid #ddd!important; margin-top: 10px;">  
        <tbody>
          <tr>
            <td>
                <label>Tên loại hình di tích</label>
                <input type="" name="name" class="form-control" placeholder="" value="">
            </td>
             <td >
                <br>
                <input type="submit" name="" style="margin-top: 7px;" value="Tìm kiếm">
            </td>
          </tr>
        
        </tbody>
      </table>
    </form>

    <div class="card row">
      <h5 class="card-header">Danh sách Loại hình di tích</h5>
      <p><?php echo @$mess;?></p>
      <div class="table-responsive">
        <table class="table table-bordered mb-3">
          <thead>
            <tr>
              <th>ID</th>
              <th>Tên loại hình</th>
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
                            <a class="dropdown-item" href="javascript:void(0);" onclick="editData('.$item->id.', \''.$item->name.'\' );">
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
                        <td colspan="5" align="center">Chưa có loại hình</td>
                      </tr>';
              }
            ?>
            
            
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="modal fade" id="basicModal">    
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Thông tin loại hình di tích</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <?= $this->Form->create(); ?>
        <div class="modal-footer">
          <div class="card-body">
            <div class="row gx-3 gy-2 align-items-center">
              <div class="col-md-12">
                <input type="hidden" name="idCategoryEdit" id="idCategoryEdit" value="" />
                <div class="mb-3">
                  <label class="form-label" for="basic-default-phone">Tên loại hình</label>
                  <input type="text" class="form-control phone-mask" name="name" id="name" value=""/>
                </div>
              </div>

              <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Lưu thông tin</button> 
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Hủy</button> 
              </div>
            </div>
          </div>
        </div>
        <?= $this->Form->end() ?>
        
      </div>
    </div>
  </div>

  <script type="text/javascript">
    function editData(id, name){
      $('#idCategoryEdit').val(id);
      $('#name').val(name);

      $('#basicModal').modal('show');
    }

    function deleteCategory(id){
      var check = confirm('Bạn có chắc chắn muốn xóa không?');

      if(check){
        $.ajax({
          method: "GET",
          url: "/categories/delete/?id="+id,
          data: {}
        })
          .done(function( msg ) {
            window.location = '/plugins/admin/ditichhienvat-admin-typeHistoricalSites-listTypeHistoricalSites';
          })
          .fail(function() {
            window.location = '/plugins/admin/ditichhienvat-admin-typeHistoricalSites-listTypeHistoricalSites';
          });
      }
    }
  </script>