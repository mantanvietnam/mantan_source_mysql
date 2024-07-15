<?php include(__DIR__.'/../header.php'); ?>
<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Quy dổi đơn vị</h4>

    <!-- Basic Layout -->
      <div class="row">
        <div class="col-xl">
          <div class="card mb-6">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">đơn vị</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Tên đơn vị</th>
                        <th>số lượng</th>
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
                                    <td>'.$item->unit.'</td>
                                    <td>'.$item->quantity.'</td>
                                    <td>'.$item->price.'</td>
                                    <td align="center">
                                      <a class="dropdown-item" href="javascript:void(0);" onclick="editData('.$item->id.', \''.$item->unit.'\', \''.$item->quantity.'\', \''.$item->price.'\');">
                                        <i class="bx bx-edit-alt me-1"></i>
                                      </a>
                                    </td>
                                    <td align="center">
                                      <a class="dropdown-item" onclick="deleteUnitConversion('.$item->id.');" href="javascript:void(0);">
                                        <i class="bx bx-trash me-1"></i>
                                      </a>
                                    </td>
                                  </tr>';
                          }
                        }else{
                          echo '<tr>
                                  <td colspan="6" align="center">Chưa có dữ liệu</td>
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
                <input type="hidden" name="idEdit" id="idEdit" value="" />
                <div class="mb-3">
                  <label class="form-label" for="basic-default-phone">đơn vị</label>
                  <input type="text" class="form-control phone-mask" name="unit" id="unit" value=""/>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Số lượng</label>
                  <input type="text" class="form-control" placeholder="" name="quantity" id="quantity" value="" />
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">giá bán lẻ</label>
                  <input type="text" class="form-control" placeholder="" name="price" id="price" value="" />
                </div>

                <!-- <div class="mb-3">
                  <label class="form-label">Trạng thái</label>
                  <div class="input-group input-group-merge">
                    <select class="form-select" name="status" id="status">
                      <option value="active"  >Kích hoạt</option>
                      <option value="lock"  >Khóa</option>
                    </select>
                  </div>
                </div> -->

                <button type="submit" class="btn btn-primary">Lưu</button>
              <?= $this->Form->end() ?>
            </div>
          </div>
        </div>

      </div>
    
  </div>

  <script type="text/javascript">
    function editData(id, unit,quantity, price){
      $('#idEdit').val(id);
      $('#unit').val(unit);
      $('#quantity').val(quantity);
      $('#price').val(price);
    }

    function deleteUnitConversion(id){
      var check = confirm('Bạn có chắc chắn muốn xóa không?');

      if(check){
        $.ajax({
          method: "GET",
          url: "/deleteUnitConversion?id="+id,
          data: {}
        })
          .done(function( msg ) {
            window.location = '/listUnitConversion?id_product=<?php echo $_GET['id_product'] ?>';
          })
          .fail(function() {
            window.location = '/listUnitConversion?id_product=<?php echo $_GET['id_product'] ?>';
          });
      }
    }
  </script>
<?php include(__DIR__.'/../footer.php'); ?>