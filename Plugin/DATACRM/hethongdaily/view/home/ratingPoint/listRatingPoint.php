<?php include(__DIR__.'/../header.php'); ?>
<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Xếp hạng thành viên</h4>

    <!-- Basic Layout -->
      <div class="row">
        <div class="col-xl">
          <div class="card mb-6">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Xếp hạng thành viên</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Hạng thành viên</th>
                        <th>Điểm tích luỹ tối thiểu</th>
                        <?php  if(empty($user->id_father)){ ?>
                        <th class="text-center">Sửa</th>
                        <th class="text-center">Xóa</th>
                      <?php } ?>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      <?php 
                        if(!empty($listData)){
                          foreach ($listData as $item) {
                            echo '<tr>
                                    <td>'.$item->id.'</td>
                                    <td>'.$item->name.'</td>
                                    <td>'.number_format($item->point_min).'</td>';
                                     if(empty($user->id_father)){
                                    echo '<td align="center">
                                      <a class="dropdown-item" href="javascript:void(0);" onclick="editData('.$item->id.', \''.$item->name.'\', \''.$item->point_min.'\');">
                                        <i class="bx bx-edit-alt me-1"></i>
                                      </a>
                                    </td>
                                    <td align="center">
                                      <a class="dropdown-item" onclick="deleteRatingPoint('.$item->id.');" href="javascript:void(0);">
                                        <i class="bx bx-trash me-1"></i>
                                      </a>
                                    </td>';
                                  }
                                  echo '</tr>';
                          }
                        }else{
                          echo '<tr>
                                  <td colspan="5" align="center">Chưa có xếp hạng nào</td>
                                </tr>';
                        }
                      ?>
                      
                      
                    </tbody>
                  </table>
                </div>
            </div>
          </div>
        </div>
         <?php  if(empty($user->id_father)){ ?>
        <div class="col-xl">
          <div class="card mb-6">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Thông tin</h5>
            </div>
            <div class="card-body">
               <?php echo $mess; ?>
              <?= $this->Form->create(); ?>
                <input type="hidden" name="idEdit" id="idEdit" value="" />
                <div class="mb-3">
                  <label class="form-label" for="basic-default-phone">Tên hạng</label>
                  <input type="text" class="form-control phone-mask" name="name" id="name" value=""/>
                </div>

                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Điểm tích luỹ tối thiểu</label>
                  <input type="number" class="form-control" placeholder="" name="point_min" id="point_min" value="" />
                </div>

                <!-- <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Mô tả</label>
                  <input type="text" class="form-control" placeholder="" name="description" id="description" value="" />
                </div> -->

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
      <?php } ?>
      </div>
    
  </div>

  <script type="text/javascript">
    function editData(id, name, point_min){
      $('#idEdit').val(id);
      $('#name').val(name);
      $('#point_min').val(point_min);
    }

    function deleteRatingPoint(id){
      var check = confirm('Bạn có chắc chắn muốn xóa không?');

      if(check){
        $.ajax({
          method: "GET",
          url: "/deleteRatingPoint?id="+id,
          data: {}
        })
          .done(function( msg ) {
            window.location = '/listRatingPoint';
          })
          .fail(function() {
            window.location = '/listRatingPoint';
          });
      }
    }
  </script>
<?php include(__DIR__.'/../footer.php'); ?>