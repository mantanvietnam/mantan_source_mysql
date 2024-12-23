<style type="text/css">
  
.filter-color .checkbox-list li {
  margin: 0 14px 15px 0;
  line-height: normal;
  float: left;
  padding: 0; }

.filter-color .checkbox-list li label {
  border: 1px solid #eaeaea;
  width: 32px;
  height: 32px;
  border-radius: 50%;
  float: left;
  position: relative;
  font-size: 0;
  margin-left: 0;
  margin-bottom: 0; }

  .filter-color .checkbox-list{
    list-style-type: none;
  }

.filter-color .checkbox-list input[type="radio"] {
  display: none; }

.filter-color .checkbox-list input[type="radio"]:checked + label:before {
  content: '';
  position: absolute;
  top: 10px;
  left: 8px;
  height: 6px;
  width: 12px;
  z-index: 99;
  border: 2px solid #dead35;
  border-top-style: none;
  border-right-style: none;
  -webkit-transform: rotate(-45deg);
  transform: rotate(-45deg); }

.filter-color .checkbox-list input[type="radio"]:checked + label {
  box-shadow: 0 0 0 3px #ffffff, 0 0 0 4px var(--shop-color-border); }

</style>
<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listProduct">Mẫu thiết kế</a> /</span>
    Thông tin mẫu thiết kế
  </h4>
  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin mẫu thiết kế</h5>
          </div>
          <div class="card-body">
            <p><?php echo $mess;?></p>
            <form enctype="multipart/form-data" method="post" action="">
              <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Tên mẫu thiết kế (*)</label>
                    <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name; ?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Danh mục (*)</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="category_id" id="category_id" required>
                        <option value="">Chọn danh mục</option>
                        <?php 
                          foreach ($listCategory as $key => $item) {
                            if($item->id == $data->category_id){
                              echo '<option selected value="'.$item->id.'">'.$item->name.'</option>';
                            }else{
                              echo '<option  value="'.$item->id.'">'.$item->name.'</option>';
                            }
                          }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Kích cỡ mẫu thiết kế</label>
                    <div class="input-group input-group-merge">
                      <select class="form-select" name="size" id="size">
                        <option value="">Theo ảnh nền</option>
                        <?php 
                          $sizes = getSizeProduct();
                          if(!empty($sizes)){
                            foreach($sizes as $size){
                               if($size['width'] == $data->width && $size['height'] == $data->height){
                                echo '<option selected  value="'.$size['width'].'-'.$size['height'].'">'.$size['name'].'</option>';
                              }else{
                                echo '<option  value="'.$size['width'].'-'.$size['height'].'">'.$size['name'].'</option>';
                              }
                            }
                          }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Từ khóa (*)</label>
                    <input required type="text" class="form-control phone-mask" name="keyword" id="keyword" value="<?php echo @$data->keyword; ?>" />
                  </div>
                  <?php if(@$_GET['type']!='user_series'){ ?>
                  <div class="mb-3">
                    <label class="form-label">Mô tả về mẫu thiết kế</label>
                    <textarea class="form-control" name="description" rows="5"><?php echo @$data->description; ?></textarea>
                  </div>
                  <?php } ?>

                  <div class="mb-3">
                    <input type="checkbox" name="free_pro" value="1" <?php if(!empty($data->free_pro)) echo 'checked';?>> Miễn phí cho tài khoản EZPICS PRO
                  </div>
                  <div class="mb-3 filter-color">
                    <label class="form-label">Màu chủ đạo (*)</label>
                    <ul class="checkbox-list clearfix">
                      <?php foreach(getColor() as $key => $value){  ?>
                        <li>
                          <input type="radio" required="" id="data-color-<?php echo $key; ?>" value="<?php echo $value['code']; ?>" <?php if(@$data->color==$value['code']){ echo 'checked'; }; ?> name="color" >
                          <label for="data-color-<?php echo $key; ?>" style="background-color: <?php echo $value['code']; ?>"><?php echo $value['name']; ?></label>  
                        </li> 
                        <?php } ?>   
                    </ul> 
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Hình minh họa</label>
                    <input type="file" name="thumbnail" value="<?php echo @$data->thumbnail; ?>" class="form-control">
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Hình nền (*)</label>
                    <input type="file" name="background" value="<?php echo @$data->image; ?>" class="form-control" <?php if(empty($_GET)) echo 'required'; ?>>
                  </div>
                  <?php if(@$_GET['type']!='user_series'){ ?>
                  <div class="mb-3">
                    <label class="form-label">Giá bán (*)</label>
                    <input type="number" min="0" max="99000" class="form-control phone-mask" name="sale_price" id="sale_price" value="<?php echo @$data->sale_price; ?>" required />
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Giá thị trường</label>
                    <input type="number" min="0" class="form-control phone-mask" name="price" id="price"  value="<?php echo @$data->price; ?>" />
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Bỏ vào kho</label>
                    <div>
                      <?php 

                        if(!empty($listWarehouse)){
                          echo '<ul class = "list-inline">';
                          foreach ($listWarehouse as $warehouse) {
                            $check = '';
                            if(!empty($listWarehouseCheck)){
                              $check = (in_array($warehouse->id, $listWarehouseCheck))? 'checked':'';
                            }

                            echo '<li><input type="checkbox" '.$check.' name="warehouse[]" value="'.$warehouse->id.'"> '.$warehouse->name.'</li>';
                          }
                          echo '</ul>';
                        }else{
                          echo 'Bạn chưa có kho mẫu thiết kế riêng, tạo kho <a href="/addWarehouse">TẠI ĐÂY</a>';
                        }
                      ?>
                    </div>
                  </div>
                <?php }else{ ?>
                    <div class="mb-3">
                    <label class="form-label">Mô tả về mẫu thiết kế</label>
                    <textarea class="form-control" name="description" rows="5"><?php echo @$data->description; ?></textarea>
                  </div>
                <?php } ?>
                </div>

                <!-- <div class="col-md-12">
                  <div class="mb-3">
                    <label class="form-label">Bài đăng mẫu kèm hình ảnh </label><br>
                    <?php
                        //showEditorInput('content','content',@$data['content'],0);
                    ?>                      
                    <textarea class="form-control" name="content" rows="5"><?php echo @$data->content; ?></textarea>
                  </div>
                </div> -->
              </div>

              <button type="submit" class="btn btn-primary">Lưu</button>
            </form>
          </div>
        </div>
      </div>

    </div>
</div>

