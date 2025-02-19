<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Danh sách bảng giá</h4>

    <!-- Basic Layout -->
      <div class="row">
        <div class="col-md-8">
          <div class="card mb-6">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Bảng giá</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Tên gói</th>
                        <th>giá</th>
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
                                    <td>'.$item->name.'
                                    </br>
                                    thời gian:'.number_format(@$item->days).' ngày
                                    </td>
                                    <td>giá cũ: '.number_format(@$item->price_old).'đ</br>
                                    giá mới:'.number_format(@$item->price).'đ</td>
                                    <td align="center">
                                      <a class="dropdown-item" href="javascript:void(0);" onclick="editData('.$item->id.', \''.$item->name.'\', \''.$item->price_old.'\', \''.$item->price.'\', \''.$item->days.'\', \''.$item->status.'\', \''.$item->name_en.'\', \''.$item->id_apple.'\' );">
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
                                  <td colspan="5" align="center">Chưa có chủ đề</td>
                                </tr>';
                        }
                      ?>
                      
                      
                    </tbody>
                  </table>
                </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card mb-6">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Thông tin</h5>
            </div>
            <div class="card-body">
              <?= $this->Form->create(); ?>
                <input type="hidden" name="id" id="id" value="" />
                <div class="mb-3">
                  <label class="form-label" for="basic-default-phone">Tiêu đề tiếng Việt</label>
                  <input type="text" class="form-control phone-mask" name="name" id="name" value=""/>
                </div>
                <div class="mb-3">
                  <label class="form-label" for="basic-default-phone">Tiêu đề tiếng anh</label>
                  <input type="text" class="form-control phone-mask" name="name_en" id="name_en" value=""/>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Giá cũ</label>
                  <input type="number" class="form-control" placeholder="" name="price_old" id="price_old" value="" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Giá mới</label>
                  <input type="number" class="form-control" placeholder="" name="price" id="price" value="" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Số ngày</label>
                  <input type="number" class="form-control" placeholder="" name="days" id="days" value="" />
                </div>
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">id apple</label>
                  <input type="text" class="form-control" placeholder="" name="id_apple" id="id_apple" value="" />
                </div>
                <div class="mb-3">
                  <label class="form-label">Trạng thái</label>
                  <div class="input-group input-group-merge">
                    <select class="form-select" name="status" id="status">
                      <option value="active">Kích hoạt</option>
                      <option value="lock">Khóa</option>
                    </select>
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
    function editData(id,name,price_old,price,days,status,name_en,id_apple){
      $('#id').val(id);
      $('#name').val(name);
      $('#name_en').val(name_en);
      $('#price_old').val(price_old);
      $('#price').val(price);
      $('#days').val(days);
      $('#status').val(status);
      $('#id_apple').val(id_apple);
    }

    function deleteCategory(id){
      var check = confirm('Bạn có chắc chắn muốn xóa không?');

      if(check){
        $.ajax({
          method: "GET",
          url: "/deletePriceList/?id="+id,
          data: {}
        })
          .done(function( msg ) {
            window.location = '/plugins/admin/colennao-view-admin-pricelist-listPriceList';
          })
          .fail(function() {
            window.location = '/plugins/admin/colennao-view-admin-pricelist-listPriceList';
          });
      }
    }
  </script>