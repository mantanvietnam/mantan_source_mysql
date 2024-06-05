<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listPosition">Chức danh</a> /</span>
    Cài đặt
  </h4>
  <!-- Basic Layout -->
    <div class="row">
      <div class="col-md-8">
        <div class="card mb-3">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Chức danh hệ thống</h5>
          </div>
          <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Chức danh</th>
                      <th>Chiết khấu</th>
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
                                  <td>
                                    <span class="text-danger">'.$item->name.'</span><br/>
                                    '.number_format($item->number_member).' đại lý
                                  </td>
                                  <td>Giảm <b>'.(int) $item->description.'%</b> khi đơn hàng tối thiểu <b>'.number_format((int) $item->keyword).'đ</b></td>
                                  <td align="center">
                                    <a class="dropdown-item" href="javascript:void(0);" onclick="editData('.$item->id.', \''.$item->name.'\', \''.$item->keyword.'\', \''.$item->description.'\');">
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
                                <td colspan="5" align="center">Chưa có chức danh</td>
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
        <div class="card mb-3">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin</h5>
          </div>
          <div class="card-body">
            <?= $this->Form->create(); ?>
              <input type="hidden" name="idCategoryEdit" id="idCategoryEdit" value="" />
              <div class="mb-3">
                <label class="form-label" for="basic-default-phone">Chức danh</label>
                <input type="text" class="form-control phone-mask" name="name" id="name" value="" />
              </div>

              <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Mức chiết khấu (tính theo %)</label>
                <input type="text" class="form-control" placeholder="" name="description" id="description" value="" />
              </div>

              <div class="mb-3">
                <label class="form-label" for="basic-default-fullname">Giá trị đơn hàng tối thiểu</label>
                <input type="text" class="form-control" placeholder="" name="keyword" id="keyword" value="" />
              </div>

              <button type="submit" class="btn btn-primary">Lưu</button>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>

<script type="text/javascript">
  function editData(id, name, keyword, description){
    $('#idCategoryEdit').val(id);
    $('#name').val(name);
    $('#keyword').val(keyword);
    $('#description').val(description);
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
          window.location = '/listPosition';
        })
        .fail(function() {
          window.location = '/listPosition';
        });
    }
  }
</script>
<?php include(__DIR__.'/../footer.php'); ?>