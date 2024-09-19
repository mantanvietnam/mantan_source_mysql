<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">Theme ìno</h4>

  <!-- Responsive Table -->
  <div class="card">
    <h5 class="card-header">Danh sách giao diện</h5>
    
    <div class="card-body row">
      
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr class="">
              <th>STT</th>
              <th>ảnh</th>
              <th>tên</th>
              <th>giá bán</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php 
              if(!empty($data)){
                foreach ($data as $item) {
                  echo '<tr>
                          <td>'.$item['id'].'</td>
                          <td><img src="'.$item['image'].'" width="100" /></td>
                          <td>'.$item['name'].'</td>
                          <td>'.number_format($item['price']).'đ</td>
                          <td align="center">
                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#basicModal'.$item['id'].'" >
                              <i class="bx bx-edit-alt me-1"></i>
                            </a>
                          </td>
                        </tr>';
                }
              }else{
                echo '<tr>
                        <td colspan="10" align="center">Chưa có dữ liệu</td>
                      </tr>';
              }
            ?>
          </tbody>
        </table>
      </div>

    </div>
  </div>
  <?php 
   if(!empty($data)){
                foreach ($data as $item) {
                  echo ' <div class="modal fade" id="basicModal'.$item['id'] .'"  name="id">

      <div class="modal-dialog" role="document" style=" max-width: 43rem;">
        <div class="modal-content" style="padding: 20px;">
          <div class="modal-header form-label border-bottom">
            <h5 class="modal-title" id="exampleModalLabel1">Sửa giá bán </h5>
            <button type="button" class="btn-close"data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="row">
            <div class="col-md-6">
                  <img src="'.$item['image'].'" style="width: 100%; height:460px;"/>
                <div style=" text-align: center; font-size: 20px; padding: 10px 0; ">
                  <p>'.$item['name'].'</p>
                </div>
            </div>
            <div class="col-md-6">
            <form  method="get" action="/editPriceAdmin">
            	<div class="mb-3">
            		<label class="form-label">giá bán(*)</label>
                	<input type="text" class="form-control phone-mask" name="price" id="price" value="'.$item['price'].'"/>
                	<input type="hidden" class="form-control phone-mask" name="id" id="id" value="'.$item['id'].'"/>
             	</div>
             	<button type="submit" class="btn btn-primary">Lưu</button> 
          	</form>
               </div>
             </div>
           </div>
         </div>
       </div>';
                }
              }


   ?>
  <!--/ Responsive Table -->
</div>