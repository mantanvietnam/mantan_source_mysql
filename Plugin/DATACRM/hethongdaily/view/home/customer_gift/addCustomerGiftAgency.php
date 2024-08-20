<?php include(__DIR__.'/../header.php'); ?>
<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/listCustomerGiftAgency">Quà tặng</a> /</span>
    Thông tin quà tặng
  </h4>

  <!-- Basic Layout nav-align-top-->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-body">
            <p><?php echo @$mess; ?></p>
            <form enctype="multipart/form-data" method="post" action="">
              <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken;?>" />
              <div class="row">
                <div class="col-12">
                  <div class=" mb-4">
                   
                        <div class="row">
                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label">Tên quà tặng(*)</label>
                              <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                            </div>
                             <div class="mb-3">
                              <label class="form-label">Hình minh họa (*)</label>
                              <input type="file" class="form-control phone-mask" name="image" id="image" value=""/>
                              <?php
                              if(!empty($data->image)){
                                echo '<br/><img src="'.$data->image.'" width="80" />';
                              }
                              ?>
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Sản Phẩm</label>
                              <div class="input-group input-group-merge">
                                <select class="form-select" name="id_product" id="id_product">
                                  <option value="0">Chọn sản Phẩm</option>
                                    <?php if(!empty($listProduct)){
                                            foreach($listProduct as $key => $item){
                                              $selected = '';
                                              if(@$data->id_product == $item->id){
                                                $selected = 'selected';
                                              }
                                              echo '<option value="'.$item->id.'" '.$selected.' >'.$item->title.'</option>';
                                            } 
                                    } ?>
                                </select>
                              </div>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Sếp hạng (*)</label>
                              <div class="input-group input-group-merge">
                                <select  required class="form-select" name="id_rating" id="id_rating">
                                  <option value="">Chọn hạng</option>
                                    <?php if(!empty($listRating)){
                                            foreach($listRating as $key => $item){
                                              $selected = '';
                                              if(@$data->id_rating == $item->id){
                                                $selected = 'selected';
                                              }
                                              echo '<option value="'.$item->id.'" '.$selected.' >'.$item->name.' ('.$item->point_min.')</option>';
                                            } 
                                    } ?>
                                </select>
                              </div>
                            </div>
                            
                          </div>

                          <div class="col-md-6">
                            <div class="mb-3">
                              <label class="form-label">Điểm quy đổi (*)</label>
                              <input type="text" required class="form-control phone-mask" name="point" id="point" value="<?php echo @$data->point;?>" />
                            </div>
                           
                            <div class="mb-3">
                              <label class="form-label">Giá  Trị</label>
                              <input type="text"  class="form-control phone-mask" name="price" id="price" value="<?php echo @$data->price;?>" />
                            </div>

                            <div class="mb-3">
                              <label class="form-label">Số lượng</label>
                              <input type="text" class="form-control phone-mask" name="quantity" id="quantity" value="<?php echo @$data->quantity;?>" />
                            </div>
                            

                            <div class="mb-3">
                              <label class="form-label">Mô tả ngắn</label>
                              <textarea maxlength="160" rows="5" class="form-control" name="description" id="description"><?php echo @$data->description;?></textarea>
                            </div>
                          </div>
                        </div>
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