<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light"><a href="/plugins/admin/tayho360-admin-place-listPlaceAdmin">Di tích và danh lam</a> /</span>
    <?php 
     if(!empty($_GET['id'])){
        echo "Sửa thông tin";

    }else{
       echo "Thêm mới";
    }

     ?>
  </h4>

  <!-- Basic Layout -->
    <div class="row">
      <div class="col-xl">
        <div class="card mb-12">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Thông tin di tích và danh lam</h5>
          </div>
          <div class="card-body">
            <p><?php echo @$mess;
        ?></p>
            <?= $this->Form->create(); ?>
            <div class="row">
       
            <div class="col-md-12">
                <ul class="nav nav-tabs" role="tablist">
                          <li class="nav-item">
                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#tab1" aria-controls="navs-top-home" aria-selected="true">
                             Thông tin di tích và danh lam
                            </button>
                          </li>
                          <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#tab5" aria-controls="navs-top-image" aria-selected="false">
                             Hình ảnh
                            </button>
                          </li>                       
                </ul>
                <div id="tabs">

                <div class="tab-content">
                    <div class="tab-pane fade active show" id="tab1" role="tabpanel">
                        <div class="row" >
                            <div class="mb-3 form-group col-sm-6">
                                <i>Tiêu đề<span class="required">*</span>:</i>
                                <input type="text" maxlength="100" name="name" id="name" value="<?php echo @$data['name'] ?>" class="form-control" required="">
                            </div>
                             <div class="mb-3 form-group col-sm-6">
                                <i>Trạng thái:</i>&ensp;
                                <input type="radio" name="status" class="" id="status" value="1" <?php if(@ $data['status']==1) echo 'checked="checked"';   ?> > Hiển thị&ensp;
                                <input type="radio" name="status" class="" id="status" value="0" <?php if(@ $data['status']==0) echo 'checked="checked"';   ?> > Ẩn
                            </div>
                             <div class="mb-3 form-group col-sm-6">
                                <i>Địa chỉ:</i>
                                <input type="text" maxlength="100" name="address" id="address" value="<?php echo @$data['address'] ?>" class="form-control">
                            </div>
                            <div class="mb-3 form-group col-sm-6">
                                <i>Điện thoại:</i>
                                <input type="text" name="phone" class="form-control" id="phone" value="<?php echo @$data['phone'] ?>">
                            </div>
                            <div class="mb-3 form-group col-sm-6">
                                <i>Email:</i>
                                <input type="text" name="email" class="form-control" id="email" value="<?php echo @$data['email'] ?>">
                            </div>
                             <div class="mb-3 form-group col-sm-6">
                                <i>Ảnh 360:</i>
                                 <input type="text" name="image360" class="form-control" id="image360" value="<?php echo @$data['image360'] ?>">
                               
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Xếp hạng:</label>
                                <select class="form-select" id="rating" name="rating" onchange="getDistrict();">
                                    <option value="">Chọn xếp hạng</option>
                                    <?php
                                    foreach (rating() as $category) {
                                        if( @$data['rating']!=$category['id']){
                                            echo '<option value="' . $category['id'] . '">' . $category['name'] . '</option>';
                                        }else{
                                            echo '<option selected value="' . $category['id'] . '">' . $category['name'] . '</option>';
                                        }
                                        
                                    }
                                    ?>
                                </select> 
                            </div>
                             <div class="mb-3 form-group col-sm-3">
                                <i>Vĩ độ (lat):</i>
                                <input type="text" name="latitude" class="form-control" id="latitude" value="<?php echo @$data['latitude'] ?>">
                            </div>
                             <div class="mb-3 form-group col-sm-3">
                                <i>Kinh độ (long):</i>
                                <input type="text" name="longitude" class="form-control" id="longitude" value="<?php echo @$data['longitude'] ?>">
                            </div>
                            
                            <div class="mb-3 form-group col-sm-6">
                                <i>Mô tả ngắn:</i>
                               <textarea name="introductory" id="introductory" onkeyup="" class="form-control" rows="5"><?php echo @$data['introductory'] ?></textarea>
                            </div>
                         
                            <div class="mb-3 form-group col-sm-12">
                                <i>Nội dung bài viết</i>
                               <?php
                                        showEditorInput('content','content',@$data['content'],1);
                                    ?>                                          
                            </div>
                        </div>
                    </div> 
                    <div class="tab-pane fade" id="tab5" role="tabpanel">
                        <div class="row">
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Ảnh đại diện:</label>
                                    <?php showUploadFile('image','image',@$data['image'],1001); ?>
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Ảnh:</label>
                                    <?php showUploadFile('image2','image2',@$data['image2'],1002); ?>
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Ảnh:</label>
                                    <?php showUploadFile('image3','image3',@$data['image3'],1003); ?>
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Ảnh:</label>
                                    <?php showUploadFile('image4','image4',@$data['image4'],1004); ?>
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Ảnh:</label>
                                    <?php showUploadFile('image5','image5',@$data['image5'],1005); ?>
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Ảnh:</label>
                                    <?php showUploadFile('image6','image6',@$data['image6'],1006); ?>
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Ảnh:</label>
                                    <?php showUploadFile('image7','image7',@$data['image7'],1007); ?>
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Ảnh:</label>
                                    <?php showUploadFile('image8','image8',@$data['image8'],1008); ?>
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Ảnh:</label>
                                    <?php showUploadFile('image9','image9',@$data['image9'],1009); ?>
                            </div>
                            <div class="mb-3 form-group col-md-6">
                                <label for="">Ảnh:</label>
                                    <?php showUploadFile('image10','image10',@$data['image10'],10010); ?>
                            </div>      
                        </div> 
                    </div>  
                </div>

            </div>
            </div>
        
  

              <button style=" margin: 10px; width: 80px;" type="submit" class="btn btn-primary">Lưu</button>
          </div>
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>

    </div>
</div>