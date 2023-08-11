<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listProduct">Dịch vụ </a> /</span>
    Thông tin dịch vụ
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin dịch vụ</h5>
          </div>
          <div class="card-body">
            <p><?php echo @$mess;?></p>
            <form enctype="multipart/form-data" method="post" action="">
              <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Tên dịch vụ  (*)</label>
                    <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>"/>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Mã dịch vụ</label>
                    <input type="text" class="form-control phone-mask" name="code" id="code" value="<?php echo @$data->code;?>"/>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Danh mục (*)</label>
                    <select name="id_category" class="form-select color-dropdown" required>
                      <option value="">Chọn nhóm dịch vụ</option>
                      <?php
                      if(!empty($listCategory)){
                        foreach ($listCategory as $key => $value) {
                          if(empty(@$data->id_category) || @$data->id_category!=$value->id){
                            echo '<option value="'.$value->id.'">'.$value->name.'</option>';
                          }else{
                            echo '<option selected value="'.$value->id.'">'.$value->name.'</option>';
                          }
                        }
                      }
                      ?>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Thời lượng (phút)</label>
                    <input  type="number" class="form-control phone-mask" name="duration" id="duration" value="<?php echo @$data->duration;?>"/>
                  </div>
                  
                  <div class="mb-3 ">
                    <label class="form-label">Trạng thái:</label>
                    <select name="status" class="form-select color-dropdown" required>
                      <option value="1">Kích hoạt</option>
                      <option value="0" <?php if(isset($data->status) && $data->status==0) echo 'selected';?> >Khóa</option>
                    </select>
                  </div>
                </div>
                
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Ảnh dịch vụ</label>
                    <?php showUploadFile('image','image',@$data->image,0);?>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Giá mặc định (*)</label>
                    <input required type="text" class="form-control phone-mask" name="price" id="price" value="<?php echo @$data->price;?>"/>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Giá ưu đãi </label>
                    <input  type="text" class="form-control phone-mask" name="price_old" id="price_old" value="<?php echo @$data->price_old;?>"/>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Mô tả dịch vụ </label>
                    <textarea class="form-control phone-mask" rows="5" name="description"><?php echo @$data->description;?></textarea>
                  </div>
                </div>
              </div>

              <button type="submit" class="btn btn-primary">Lưu</button> 
            </form>
          </div>
        </div>
      </div>

    </div>
</div>

<?php include(__DIR__.'/../footer.php'); ?>