<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Chuyên mục album</h4>

    <!-- Basic Layout -->
      <div class="row">
        <div class="col-xl">
          <div class="card mb-6">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Danh sách</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Tên chuyên mục</th>
                        <th class="text-center">Sửa</th>
                        <th class="text-center">Xóa</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      <?php 
                        if(!empty($category_post)){
                          foreach ($category_post as $key=>$value) {
                            echo '<tr>
                                    <td>'.$key.'</td>
                                    <td><a target="_blank" href="/'.$value['slug'].'.html">'.$value['name'].'</a></td>
                                    <td align="center">
                                      <a class="dropdown-item" href="javascript:void(0);" onclick="editData('.$key.', \''.$value['name'].'\', '.$value['parent'].', \''.$value['image'].'\', \''.$value['keyword'].'\', \''.$value['description'].'\' );">
                                        <i class="bx bx-edit-alt me-1"></i>
                                      </a>
                                    </td>
                                    <td align="center">
                                      <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/categories/delete/?id='.$key.'">
                                        <i class="bx bx-trash me-1"></i>
                                      </a>
                                    </td>
                                  </tr>';
                          
                            if(!empty($value['sub'])){
                              foreach ($value['sub'] as $key1=>$value1) {
                                echo '<tr>
                                        <td>'.$key1.'</td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;<a target="_blank" href="/'.$value1['slug'].'.html">'.$value1['name'].'</a></td>
                                        <td align="center">
                                          <a class="dropdown-item" href="javascript:void(0);" onclick="editData('.$key1.', \''.$value1['name'].'\', '.$value1['parent'].', \''.$value1['image'].'\', \''.$value1['keyword'].'\', \''.$value1['description'].'\' );">
                                            <i class="bx bx-edit-alt me-1"></i>
                                          </a>
                                        </td>
                                        <td align="center">
                                          <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/categories/delete/?id='.$key1.'">
                                            <i class="bx bx-trash me-1"></i>
                                          </a>
                                        </td>
                                      </tr>';
                              
                                if(!empty($value1['sub'])){
                                  foreach ($value1['sub'] as $key2=>$value2) {
                                    echo '<tr>
                                            <td>'.$key2.'</td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target="_blank" href="/'.$value2['slug'].'.html">'.$value2['name'].'</a></td>
                                            <td align="center">
                                              <a class="dropdown-item" href="javascript:void(0);" onclick="editData('.$key2.', \''.$value2['name'].'\', '.$value2['parent'].', \''.$value2['image'].'\', \''.$value2['keyword'].'\', \''.$value2['description'].'\' );">
                                                <i class="bx bx-edit-alt me-1"></i>
                                              </a>
                                            </td>
                                            <td align="center">
                                              <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/categories/delete/?id='.$key2.'">
                                                <i class="bx bx-trash me-1"></i>
                                              </a>
                                            </td>
                                          </tr>';
                                  
                                    if(!empty($value2['sub'])){
                                      foreach ($value2['sub'] as $key3=>$value3) {
                                        echo '<tr>
                                                <td>'.$key3.'</td>
                                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target="_blank" href="/'.$value3['slug'].'.html">'.$value3['name'].'</a></td>
                                                <td align="center">
                                                  <a class="dropdown-item" href="javascript:void(0);" onclick="editData('.$key3.', \''.$value3['name'].'\', '.$value3['parent'].', \''.$value3['image'].'\', \''.$value3['keyword'].'\', \''.$value3['description'].'\' );">
                                                    <i class="bx bx-edit-alt me-1"></i>
                                                  </a>
                                                </td>
                                                <td align="center">
                                                  <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/categories/delete/?id='.$key3.'">
                                                    <i class="bx bx-trash me-1"></i>
                                                  </a>
                                                </td>
                                              </tr>';
                                      
                                        if(!empty($value3['sub'])){
                                          foreach ($value3['sub'] as $key4=>$value4) {
                                            echo '<tr>
                                                    <td>'.$key4.'</td>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target="_blank" href="/'.$value4['slug'].'.html">'.$value4['name'].'</a></td>
                                                    <td align="center">
                                                      <a class="dropdown-item" href="javascript:void(0);" onclick="editData('.$key4.', \''.$value4['name'].'\', '.$value4['parent'].', \''.$value4['image'].'\', \''.$value4['keyword'].'\', \''.$value4['description'].'\' );">
                                                        <i class="bx bx-edit-alt me-1"></i>
                                                      </a>
                                                    </td>
                                                    <td align="center">
                                                      <a class="dropdown-item" onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\');" href="/categories/delete/?id='.$key4.'">
                                                        <i class="bx bx-trash me-1"></i>
                                                      </a>
                                                    </td>
                                                  </tr>';
                                          }
                                        }
                                      }
                                    }
                                  }
                                }
                              }
                            }
                          }
                        }else{
                          echo '<tr>
                                  <td colspan="3" align="center">Chưa có chuyên mục</td>
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
                  <label class="form-label" for="basic-default-phone">Tên chuyên mục</label>
                  <input
                    type="text"
                    class="form-control phone-mask"
                    name="name"
                    id="name"
                    value=""
                  />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-email">Chuyên mục cha</label>
                  <div class="input-group input-group-merge">
                    <select class="form-select" name="parent" id="parent">
                      <option value="0">Chuyên mục gốc</option>
                      <?php 
                        if(!empty($category_post)){
                          foreach ($category_post as $key=>$value) {
                            echo '<option value="'.$key.'">'.$value['name'].'</option>';

                            if(!empty($value['sub'])){
                              foreach ($value['sub'] as $key1=>$value1) {
                                echo '<option value="'.$key1.'">&nbsp;&nbsp;&nbsp;&nbsp;'.$value1['name'].'</option>';

                                if(!empty($value1['sub'])){
                                  foreach ($value1['sub'] as $key2=>$value2) {
                                    echo '<option value="'.$key2.'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$value2['name'].'</option>';

                                    if(!empty($value2['sub'])){
                                      foreach ($value2['sub'] as $key3=>$value3) {
                                        echo '<option value="'.$key3.'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$value3['name'].'</option>';

                                        if(!empty($value3['sub'])){
                                          foreach ($value3['sub'] as $key4=>$value4) {
                                            echo '<option value="'.$key4.'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$value4['name'].'</option>';
                                          }
                                        }
                                      }
                                    }
                                  }
                                }
                              }
                            }
                          }
                        }
                      ?>
                    </select>
                  </div>
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
    function editData(id, name, parent, image, keyword, description){
      $('#idCategoryEdit').val(id);
      $('#name').val(name);
      $('#parent').val(parent);
      $('#image').val(image);
      $('#keyword').val(keyword);
      $('#description').val(description);
    }
  </script>