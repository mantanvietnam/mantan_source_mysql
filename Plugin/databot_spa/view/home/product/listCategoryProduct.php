<?php include(__DIR__.'/../header.php'); ?>
<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Danh mục sản phẩm</h4>

    <!-- Basic Layout -->
      <div class="row">
        <div class="col-md-7">
          <div class="card mb-6">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Danh mục</h5>
            </div>

            <div class="card-body row">
                <?php echo $mess;?>
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Tên danh mục</th>
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
                                      <a class="dropdown-item" href="javascript:void(0);" onclick="editData('.$item->id.', \''.$item->name.'\', \''.$item->image.'\', \''.$item->keyword.'\', \''.$item->description.'\' );">
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
                  <label class="form-label" for="basic-default-phone">Tên Danh mục</label>
                  <input
                    type="text"
                    class="form-control phone-mask"
                    name="name"
                    id="name"
                    value=""
                  />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Hình minh họa</label>
                  <?php showUploadFile('image','image','',0);?>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Từ khóa</label>
                  <input type="text" class="form-control" placeholder="" name="keyword" id="keyword" value="" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Mô tả</label>
                  <input type="text" class="form-control" placeholder="" name="description" id="description" value="" />
                </div>

                <button type="submit" class="btn btn-primary">Lưu</button>
              <?= $this->Form->end() ?>
            </div>
          </div>
        </div>

      </div>
    
  </div>

  <script type="text/javascript">
    function editData(id, name, image, keyword, description){
      $('#idCategoryEdit').val(id);
      $('#name').val(name);
      $('#image').val(image);
      $('#keyword').val(keyword);
      $('#description').val(description);
    }

    function deleteCategory(id){
      var check = confirm('Bạn có chắc chắn muốn xóa không?');

      if(check){
        $.ajax({
          method: "GET",
          url: "/apis/deleteCategoryProduct/?id="+id,
          data: {},
          success:function(res){
                  //console.log(res);
                  if(res.code==1){
                    window.location = '/listCategoryProduct?error=requestCategoryDeleteSuccess';
                  }else{
                    window.location = '/listCategoryProduct?error=requestCategoryDelete';
                  }
                }
        });
      }
    }
  </script>
<?php include(__DIR__.'/../footer.php'); ?>