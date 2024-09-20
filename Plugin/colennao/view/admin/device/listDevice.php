<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Nhóm thiết bị</h4>

    <!-- Basic Layout -->
      <div class="row">
        <div class="col-xl">
          <div class="card mb-6">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Cài đặt thiết bị</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>ảnh </th>
                        <th>Tên thiết bị</th>
                        <th class="text-center">Sửa</th>
                        <th class="text-center">Xóa</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      <?php 
                        if(!empty($listData)){
                          foreach ($listData as $item) {
                            echo '<tr>
                                    <td align="center">'.$item->id.'</td>
                                   <td align="center"><img src="' . $item->image . '" width="60" />
                                    <td>
                                      <span class="text-danger">'.$item->name.'</span><br/>
                                      
                                    </td>
                                    <td align="center">
                                      <a class="dropdown-item" href="javascript:void(0);" onclick="editData('.$item->id.', \''.$item->name.'\', \''.$item->link.'\',\''.$item->description.'\',  );">
                                        <i class="bx bx-edit-alt me-1"></i>
                                      </a>
                                    </td>
                                    <td align="center">
                                      <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa thiết bị nào này không?\');" href="/deleteDevice/?id='.$item->id.'">
                                        <i class="bx bx-trash me-1"></i>
                                      </a>
                                    </td>
                                  </tr>';
                          }
                        }else{
                          echo '<tr>
                                  <td colspan="10" align="center">Chưa có thiết bị nào</td>
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
              <form enctype="multipart/form-data" method="post" action="">
              <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
                <input type="hidden" name="idCategoryEdit" id="idCategoryEdit" value="" />
                <div class="mb-3">
                  <label class="form-label" for="basic-default-phone">Tên thiết bị</label>
                  <input type="text" class="form-control phone-mask" name="name" id="name" value="" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-phone">hình ảnh</label>
                  <input type="file" class="form-control phone-mask" name="image" id="image" value=""/>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-phone">link mua</label>
                  <input type="text" class="form-control phone-mask" name="link" id="link" value="" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-phone">Mô tả ngắn </label>
                  <input type="text" class="form-control phone-mask" name="description" id="description" value="" />
                </div>

                <button type="submit" class="btn btn-primary">Lưu</button>
              </form>
            </div>
          </div>
        </div>

      </div>
    
  </div>

  <script type="text/javascript">
    function editData(id, name, link, description){
      $('#idCategoryEdit').val(id);
      $('#name').val(name);
      $('#link').val(link);
      $('#description').val(description);
    }
  </script>