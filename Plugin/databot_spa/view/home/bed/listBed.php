<?php include(__DIR__.'/../header.php'); ?>
<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Giười</h4>

    <!-- Basic Layout -->
      <div class="row">
        <div class="col-xl">
          <div class="card mb-6">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Giường</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Tên tên giường</th>
                        <th>Phòng</th>
                        <th class="text-center">Sửa</th>
                        <th class="text-center">Xóa</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      <?php 
                        if(!empty($listData)){
                          foreach ($listData as $item) {
                            echo '<tr>
                                    <td>'.$item->name.'</td>
                                    <td>'.$item->room->name.'</td>
                                    <td align="center">
                                      <a class="dropdown-item" href="javascript:void(0);" onclick="editData('.$item->id.', \''.$item->name.'\', \''.$item->id_room.'\' );">
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
                                  <td colspan="3" align="center">Chưa có giường</td>
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
                  <label class="form-label" for="basic-default-phone">Tên giường</label>
                  <input type="text" class="form-control phone-mask" name="name" id="name" value="" />
                </div>
                <div class="mb-3">
                  <label class="form-label" for="basic-default-fullname">Phòng</label>
                  <select class="form-select" name="id_room" id="id_room">
                        <?php foreach($listRoom as $key => $item){ ?>
                        <option value="<?php echo $item->id ?>" ><?php echo $item->name ?></option>
                      <?php } ?>
                      </select>
                </div>


                <button type="submit" class="btn btn-primary">Lưu</button>
              <?= $this->Form->end() ?>
            </div>
          </div>
        </div>

      </div>
    
  </div>

  <script type="text/javascript">
    function editData(id, name, id_room){
      $('#idEdit').val(id);
      $('#name').val(name);
      let element = document.getElementById('id_room');
      element.value = id_room;
    }

    function deleteCategory(id){
      var check = confirm('Bạn có chắc chắn muốn xóa không?');

      if(check){
        $.ajax({
          method: "GET",
          url: "/deleteBed/?id="+id,
          data: {}
        })
          .done(function( msg ) {
            window.location = '/listBed';
          })
          .fail(function() {
            window.location = '/listBed';
          });
      }
    }
  </script>
<?php include(__DIR__.'/../footer.php'); ?>