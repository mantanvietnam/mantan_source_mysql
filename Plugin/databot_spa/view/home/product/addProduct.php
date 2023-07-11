<?php include(__DIR__.'/../header.php'); ?>

<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listProduct">Sản phẩm </a> /</span>
    Thông tin Sản phẩm 
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin Sản phẩm</h5>
          </div>
          <div class="card-body">
            <p><?php echo @$mess;?></p>
            <form enctype="multipart/form-data" method="post" action="">
              <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Tên sản phẩm  (*)</label>
                    <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>"/>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Mã</label>
                    <input type="text" class="form-control phone-mask" name="code" id="code" value="<?php echo @$data->code;?>"/>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Danh mục</label>
                    <select name="id_category" class="form-select color-dropdown">
                      <option value="">Tất cả</option>
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
                    <label class="form-label">Nhãn hiệu</label>
                    <select name="id_trademark" class="form-select color-dropdown">
                      <option value="">Tất cả</option>
                      <?php
                      if(!empty($listTrademar)){
                        foreach ($listTrademar as $key => $value) {
                          if(empty(@$data->id_trademark) || @$data->id_trademark!=$value->id){
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
                    <label class="form-label">Ưu tiên </label>
                    <input  type="number" class="form-control phone-mask" name="hot" id="hot" value="<?php echo @$data->hot;?>"/>
                  </div>
                </div>
                
                <div class="col-md-6">
                  <div class="mb-3 " style="height: 68px;">
                    <label class="form-label">Trạng thái:</label><br/>
                      <input type="radio" name="status" class="" id="status" value="1" <?php if(@ $data['status']==1) echo 'checked="checked"';   ?> > Hiển thị&ensp;
                      <input type="radio" name="status" class="" id="status" value="0" <?php if(@ $data['status']==0) echo 'checked="checked"';   ?> > Ẩn
                  </div>
                   <div class="mb-3">
                    <label class="form-label">Ảnh sản phẩm (*)</label>
                    <?php showUploadFile('image','image',@$user->image,0);?>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Giá </label>
                    <input required type="text" class="form-control phone-mask" name="price" id="price" value="<?php echo @$data->price;?>"/>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Giá ưu đãi </label>
                    <input  type="text" class="form-control phone-mask" name="price_old" id="price_old" value="<?php echo @$data->price_old;?>"/>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Mô tả sản phẩm </label>
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